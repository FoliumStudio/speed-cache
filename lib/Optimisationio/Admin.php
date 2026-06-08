<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Optimisationio_Admin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu'));
        add_action( 'admin_enqueue_scripts', array($this,'load_custom_wp_admin_style' ));
    }

    public function menu()
    {
        add_menu_page(__('Folium Studio', 'cache-performance'), __('Folium Studio', 'cache-performance'), 'manage_options', 'optimisationio', array($this, 'caheEnabler'));

        add_submenu_page('', __('Update Cache Enabler', 'cache-performance'), __('Update Cache Enabler', 'cache-performance'), 'manage_options', 'optimisationio-cache-settings', array($this, 'updateCacheEnabler'));

        add_submenu_page('', __('CDN Enabler', 'cache-performance'), __('CDN Enabler', 'cache-performance'), 'manage_options', 'optimisationio-cdn-enabler', array($this, 'cdnEnabler'));

        add_submenu_page('', __('Update CDN Enabler', 'cache-performance'), __('Update CDN Enabler', 'cache-performance'), 'manage_options', 'optimisationio-update-cdn-enabler', array($this, 'updateCdnEnabler'));


    }

    public function load_custom_wp_admin_style($hook)
    {
        if(preg_match('/optimisationio/i', $hook)) {
            wp_enqueue_style( 'custom_wp_admin_css', plugins_url('css/optimisationio.css', Optimisationio::FILE) );
        }

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
            echo sprintf(
                '<div class="notice notice-warning"><p>%s</p></div>',
                sprintf(
                    /* translators: 1: the PHP define() statement, 2: the wp-config.php filename */
                    __("%1\$s is not set in %2\$s.", 'cache-performance'),
                    "<code>define('WP_CACHE', true);</code>",
                    "wp-config.php"
                )
            );
        }
        $selectoptions = Optimisationio_CacheEnabler::_minify_select();
        $settings      = Optimisationio_CacheEnabler::_get_options();
        $data          = array('settings' => $settings, 'selectoptions' => $selectoptions, 'cacheSize' => (Optimisationio_CacheEnabler::get_cache_size() / 1000) . ' Kb');
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
                $msg
            );
        } else {
            printf(
                "<div class='error'><p><strong>%s</strong></p></div>",
                $msg
            );
        }
    }
    private function redirectUrl($url)
    {
        echo '<script>window.location.href=' . wp_json_encode( esc_url_raw( $url ) ) . ';</script>';
    }

}
