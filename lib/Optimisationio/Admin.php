<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Optimisationio_Admin
{
    public function __construct()
    {
        if ( class_exists( 'Folium_UI' ) ) {
            Folium_UI::register_plugin(
                array(
                    'slug'        => 'cache-performance',
                    'menu'        => 'optimisationio',
                    'name'        => 'Cache by Folium',
                    'tagline'     => 'Page cache & CDN rewrite',
                    'icon'        => 'C',
                    'icon_url'    => plugins_url('images/cache.png', Optimisationio::FILE),
                    'version'     => 'v1.6.19',
                    'active_chip' => '<span class="fl-dot"></span> <span id="wpd-active-count">0</span> rules',
                    'search_placeholder' => 'Filter settings...',
                    'stats'       => array(
                        array( (string) round( Optimisationio_CacheEnabler::get_cache_size() / 1000 ), 'Kb cached' ),
                        array( 'CDN', 'rewrite' ),
                    ),
                )
            );
            add_action( 'folium_ui_enqueue', array($this, 'on_folium_enqueue') );
            add_action( 'wp_ajax_cache_by_folium_app_save', array($this, 'ajax_app_save') );
            add_action( 'wp_ajax_cache_by_folium_app_reset', array($this, 'ajax_app_reset') );
            add_action( 'wp_ajax_cache_by_folium_app_clear', array($this, 'ajax_app_clear') );
            add_action('admin_menu', array($this, 'submenu_routes'));
        } else {
            add_action('admin_menu', array($this, 'menu'));
        }
    }

    public function menu()
    {
        add_menu_page(__('By Folium', 'cache-performance'), __('By Folium', 'cache-performance'), 'manage_options', 'optimisationio', array($this, 'caheEnabler'));

        $this->submenu_routes();
    }

    public function submenu_routes()
    {
        add_submenu_page('', __('Update Cache Enabler', 'cache-performance'), __('Update Cache Enabler', 'cache-performance'), 'manage_options', 'optimisationio-cache-settings', array($this, 'updateCacheEnabler'));

        add_submenu_page('', __('CDN Enabler', 'cache-performance'), __('CDN Enabler', 'cache-performance'), 'manage_options', 'optimisationio-cdn-enabler', array($this, 'cdnEnabler'));

        add_submenu_page('', __('Update CDN Enabler', 'cache-performance'), __('Update CDN Enabler', 'cache-performance'), 'manage_options', 'optimisationio-update-cdn-enabler', array($this, 'updateCdnEnabler'));


    }

    public function on_folium_enqueue($slug)
    {
        if ('cache-performance' !== $slug) {
            return;
        }
        $base = plugin_dir_path( Optimisationio::FILE );
        $url  = plugin_dir_url( Optimisationio::FILE );
        $css  = $base . 'assets/css/cache-app.css';
        $js   = $base . 'assets/js/cache-app.js';

        wp_enqueue_style(
            'cache-by-folium-app',
            $url . 'assets/css/cache-app.css',
            array( 'folium-ui' ),
            file_exists( $css ) ? (string) filemtime( $css ) : '1.6.19'
        );
        wp_enqueue_script(
            'cache-by-folium-app',
            $url . 'assets/js/cache-app.js',
            array( 'folium-ui', 'folium-app' ),
            file_exists( $js ) ? (string) filemtime( $js ) : '1.6.19',
            true
        );
        wp_localize_script( 'cache-by-folium-app', 'CacheByFoliumData', $this->app_data() );
    }

    private function app_data()
    {
        $cdn_defaults = array(
            'cdn_root_url'            => '',
            'cdn_file_extensions'     => '',
            'cdn_css_root_url'        => '',
            'cdn_css_file_extensions' => '',
            'cdn_js_root_url'         => '',
            'cdn_js_file_extensions'  => '',
        );

        return array(
            'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
            'nonce'       => wp_create_nonce( 'cache_by_folium_app' ),
            'actions'     => array(
                'save'  => 'cache_by_folium_app_save',
                'reset' => 'cache_by_folium_app_reset',
                'clear' => 'cache_by_folium_app_clear',
            ),
            'settings'    => Optimisationio_CacheEnabler::_get_options(),
            'cdnSettings' => wp_parse_args( get_option( Optimisationio::OPTION_KEY . '_cdnsettings', array() ), $cdn_defaults ),
            'cacheSize'   => (string) round( Optimisationio_CacheEnabler::get_cache_size() / 1000 ),
            'wpCache'     => defined( 'WP_CACHE' ) && WP_CACHE,
            'version'     => '1.6.19',
            'links'       => array(
                'plugin'  => 'https://foliumstudio.co.uk/plugins/folium-cache/',
                'reviews' => 'https://wordpress.org/support/plugin/cache-performance/reviews/#new-post',
            ),
        );
    }

    private function ajax_guard()
    {
        if ( ! current_user_can('manage_options') ) {
            wp_send_json_error( array( 'message' => 'forbidden' ), 403 );
        }
        check_ajax_referer( 'cache_by_folium_app', 'nonce' );
    }

    public function ajax_app_save()
    {
        $this->ajax_guard();
        $raw_json = isset( $_POST['data'] ) ? wp_unslash( $_POST['data'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        $raw      = '' !== $raw_json ? json_decode( $raw_json, true ) : array();
        if ( ! is_array( $raw ) ) {
            $raw = array();
        }

        $settings = isset( $raw['settings'] ) && is_array( $raw['settings'] ) ? $raw['settings'] : array();
        $cdn      = isset( $raw['cdnSettings'] ) && is_array( $raw['cdnSettings'] ) ? $raw['cdnSettings'] : array();

        $cache_settings = array(
            'cache_expires'     => isset( $settings['cache_expires'] ) ? absint( $settings['cache_expires'] ) : 0,
            'cache_new_post'    => empty( $settings['cache_new_post'] ) ? 0 : 1,
            'cache_new_comment' => empty( $settings['cache_new_comment'] ) ? 0 : 1,
            'cache_webp'        => empty( $settings['cache_webp'] ) ? 0 : 1,
            'cache_compress'    => empty( $settings['cache_compress'] ) ? 0 : 1,
            'excl_ids'          => isset( $settings['excl_ids'] ) ? sanitize_text_field( wp_unslash( $settings['excl_ids'] ) ) : '',
            'minify_html'       => isset( $settings['minify_html'] ) ? absint( $settings['minify_html'] ) : 0,
        );
        update_option( Optimisationio::OPTION_KEY . '_settings', $cache_settings );

        $cdn_settings = array(
            'cdn_root_url'            => isset( $cdn['cdn_root_url'] ) ? esc_url_raw( $cdn['cdn_root_url'] ) : '',
            'cdn_file_extensions'     => isset( $cdn['cdn_file_extensions'] ) ? sanitize_text_field( $cdn['cdn_file_extensions'] ) : '',
            'cdn_css_root_url'        => isset( $cdn['cdn_css_root_url'] ) ? esc_url_raw( $cdn['cdn_css_root_url'] ) : '',
            'cdn_css_file_extensions' => isset( $cdn['cdn_css_file_extensions'] ) ? sanitize_text_field( $cdn['cdn_css_file_extensions'] ) : '',
            'cdn_js_root_url'         => isset( $cdn['cdn_js_root_url'] ) ? esc_url_raw( $cdn['cdn_js_root_url'] ) : '',
            'cdn_js_file_extensions'  => isset( $cdn['cdn_js_file_extensions'] ) ? sanitize_text_field( $cdn['cdn_js_file_extensions'] ) : '',
        );
        update_option( Optimisationio::OPTION_KEY . '_cdnsettings', $cdn_settings );
        Optimisationio_CacheEnabler::clear_total_cache();

        wp_send_json_success( array( 'cacheSize' => (string) round( Optimisationio_CacheEnabler::get_cache_size() / 1000 ) ) );
    }

    public function ajax_app_reset()
    {
        $this->ajax_guard();
        delete_option( Optimisationio::OPTION_KEY . '_settings' );
        delete_option( Optimisationio::OPTION_KEY . '_cdnsettings' );
        Optimisationio_CacheEnabler::clear_total_cache();
        wp_send_json_success();
    }

    public function ajax_app_clear()
    {
        $this->ajax_guard();
        Optimisationio_CacheEnabler::clear_total_cache();
        wp_send_json_success( array( 'cacheSize' => (string) round( Optimisationio_CacheEnabler::get_cache_size() / 1000 ) ) );
    }

    public function cdnEnabler()
    {
        $defaults = array(
            'cdn_root_url'            => '',
            'cdn_file_extensions'     => '',
            'cdn_css_root_url'        => '',
            'cdn_css_file_extensions' => '',
            'cdn_js_root_url'         => '',
            'cdn_js_file_extensions'  => '',
        );
        $settings = wp_parse_args( get_option(Optimisationio::OPTION_KEY . '_cdnsettings', array()), $defaults );
        $data     = array('settings' => $settings);
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- View::render() returns a template; dynamic values are escaped inside the view.
        echo Optimisationio_View::render('cdn_enabler', $data);
    }
    public function updateCdnEnabler()
    {
        // Capability + CSRF checks.
        if ( ! current_user_can('manage_options') ) {
            wp_die( esc_html__('You do not have permission to do this.', 'cache-performance') );
        }
        check_admin_referer('optimisationio_save_cdn');

        $array = array(
            'cdn_root_url'            => isset($_POST['cdn_root_url']) ? esc_url_raw(wp_unslash($_POST['cdn_root_url'])) : '',
            'cdn_file_extensions'     => isset($_POST['cdn_file_extensions']) ? sanitize_text_field(wp_unslash($_POST['cdn_file_extensions'])) : '',
            'cdn_css_root_url'        => isset($_POST['cdn_css_root_url']) ? esc_url_raw(wp_unslash($_POST['cdn_css_root_url'])) : '',
            'cdn_css_file_extensions' => isset($_POST['cdn_css_file_extensions']) ? sanitize_text_field(wp_unslash($_POST['cdn_css_file_extensions'])) : '',
            'cdn_js_root_url'         => isset($_POST['cdn_js_root_url']) ? esc_url_raw(wp_unslash($_POST['cdn_js_root_url'])) : '',
            'cdn_js_file_extensions'  => isset($_POST['cdn_js_file_extensions']) ? sanitize_text_field(wp_unslash($_POST['cdn_js_file_extensions'])) : '',
        );

        update_option(Optimisationio::OPTION_KEY . '_cdnsettings', $array);
        $this->addMessage('CDN Enabler settings updated successfully');

        $this->redirectUrl(admin_url('admin.php?page=optimisationio-cdn-enabler'));
    }

    public function caheEnabler()
    {
        // wp cache check
        if (!defined('WP_CACHE') || !WP_CACHE) {
            echo wp_kses_post(
                sprintf(
                    '<div class="notice notice-warning"><p>%s</p></div>',
                    sprintf(
                        /* translators: 1: the PHP define() statement, 2: the wp-config.php filename */
                        esc_html__('%1$s is not set in %2$s.', 'cache-performance'),
                        '<code>' . esc_html("define('WP_CACHE', true);") . '</code>',
                        '<code>wp-config.php</code>'
                    )
                )
            );
        }
        $selectoptions = Optimisationio_CacheEnabler::_minify_select();
        $settings      = Optimisationio_CacheEnabler::_get_options();
        $data          = array('settings' => $settings, 'selectoptions' => $selectoptions, 'cacheSize' => (Optimisationio_CacheEnabler::get_cache_size() / 1000) . ' Kb');
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- View::render() returns a template; dynamic values are escaped inside the view.
        echo Optimisationio_View::render('cache_enabler', $data);
    }

    public function updateCacheEnabler()
    {
        // Capability + CSRF checks.
        if ( ! current_user_can('manage_options') ) {
            wp_die( esc_html__('You do not have permission to do this.', 'cache-performance') );
        }
        check_admin_referer('optimisationio_save_cache');

        $array = array(
            'cache_expires'     => isset($_POST['cache_expires']) ? absint($_POST['cache_expires']) : 0,
            'cache_new_post'    => empty($_POST['cache_new_post']) ? 0 : 1,
            'cache_new_comment' => empty($_POST['cache_new_comment']) ? 0 : 1,
            'cache_webp'        => empty($_POST['cache_webp']) ? 0 : 1,
            'cache_compress'    => empty($_POST['cache_compress']) ? 0 : 1,
            'excl_ids'          => isset($_POST['excl_ids']) ? sanitize_text_field(wp_unslash($_POST['excl_ids'])) : '',
            'minify_html'       => isset($_POST['minify_html']) ? absint($_POST['minify_html']) : 0,
        );

        update_option(Optimisationio::OPTION_KEY . '_settings', $array);
        $this->addMessage('Cache Settings updated successfully');

        $this->redirectUrl(admin_url('admin.php?page=optimisationio'));
    }

    private function addMessage($msg, $type = 'success')
    {
        if ($type == 'success') {
            printf(
                "<div class='updated'><p><strong>%s</strong></p></div>",
                esc_html( $msg )
            );
        } else {
            printf(
                "<div class='error'><p><strong>%s</strong></p></div>",
                esc_html( $msg )
            );
        }
    }
    private function redirectUrl($url)
    {
        echo '<script>window.location.href=' . wp_json_encode( esc_url_raw( $url ) ) . ';</script>';
    }

}
