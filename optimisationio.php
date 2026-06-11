<?php
/*
Plugin Name: Cache by Folium
Plugin URI: https://foliumstudio.co.uk
Description: Simple efficient WordPress caching.
Author: Folium Studio
Author URI: https://foliumstudio.co.uk
Version: 1.6.15
Requires at least: 4.6
Requires PHP: 7.4
Text Domain: cache-performance
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/** Load all of the necessary class files for the plugin */
spl_autoload_register('Optimisationio::autoload');
/**
 * Init Singleton Class.
 */
define('Optimisationio_CdnEnabler_FILE', __FILE__);
define('Optimisationio_CdnEnabler_DIR', dirname(__FILE__));
define('Optimisationio_CdnEnabler_BASE', plugin_basename(__FILE__));
define('Optimisationio_CdnEnabler_MIN_WP', '3.8');
define('Optimisationio_CACHE_DIR', WP_CONTENT_DIR. '/cache/optimisationio');



class Optimisationio
{
    private static $instance = false;

    const MIN_PHP_VERSION = '5.2.4';
    const MIN_WP_VERSION  = '4.3';
    const TEXT_DOMAIN     = 'cache-performance';
    const OPTION_KEY      = 'Optimisationio_rev3a';
    const FILE            = __FILE__;


    /**
     * Singleton class
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     * Initializes the plugin by setting localization, filters, and
     * administration functions.
     */
    private function __construct()
    {
        if (!$this->testHost()) {
            return;
        }
        add_action('init', array($this, 'textDomain'));

        new Optimisationio_CacheEnabler;
        new Optimisationio_CacheEnablerDisk;
        new Optimisationio_CdnRewrite;
        new Optimisationio_Admin;



    }

    /**
     * PSR-0 compliant autoloader to load classes as needed.
     *
     * @since  2.1
     *
     * @param  string  $classname  The name of the class
     * @return null    Return early if the class name does not start with the
     *                 correct prefix
     */
    public static function autoload($className)
    {
        if (__CLASS__ !== mb_substr($className, 0, strlen(__CLASS__))) {
            return;
        }
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
            $fileName .= DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, 'lib_' . $className);
        $fileName .= '.php';

        // Resolve against this plugin's own directory, and NEVER fatal on a
        // missing class file. An autoloader must let class_exists() return
        // false so other plugins probing for our classes (e.g. wp-disable
        // shares the Optimisationio_ prefix) don't crash the whole site.
        $file = __DIR__ . DIRECTORY_SEPARATOR . $fileName;
        if ( is_readable( $file ) ) {
            require_once $file;
        }
    }

    /**
     * Loads the plugin text domain for translation
     */
    public function textDomain()
    {
        // load_plugin_textdomain() applies the plugin_locale filter internally.
        load_plugin_textdomain(
            self::TEXT_DOMAIN,
            false,
            dirname(plugin_basename(__FILE__)) . '/lang/'
        );
    }

    /**
     * Fired when the plugin is uninstalled.
     */
    public static function uninstall()
    {
        delete_option(self::OPTION_KEY);
        delete_option(self::OPTION_KEY . '_settings');
        delete_option(self::OPTION_KEY . '_cdnsettings');
    }

    // -------------------------------------------------------------------------
    // Environment Checks
    // -------------------------------------------------------------------------

    /**
     * Checks PHP and WordPress versions.
     */
    private function testHost()
    {
        // Check if PHP is too old
        if (version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '<')) {
            // Display notice
            add_action('admin_notices', array(&$this, 'phpVersionError'));
            return false;
        }

        // Check if WordPress is too old
        global $wp_version;
        if (version_compare($wp_version, self::MIN_WP_VERSION, '<')) {
            add_action('admin_notices', array(&$this, 'wpVersionError'));
            return false;
        }
        return true;
    }

    /**
     * Displays a warning when installed on an old PHP version.
     */
    public function phpVersionError()
    {
        echo '<div class="error"><p><strong>';
        printf(
            /* translators: 1: required PHP version, 2: current PHP version, 3: plugin name */
            esc_html__('Error: %3$s requires PHP version %1$s or greater. Your installed PHP version: %2$s', 'cache-performance'),
            esc_html(self::MIN_PHP_VERSION),
            esc_html(PHP_VERSION),
            esc_html($this->getPluginName())
        );
        echo '</strong></p></div>';
    }

    /**
     * Displays a warning when installed in an old Wordpress version.
     */
    public function wpVersionError()
    {
        echo '<div class="error"><p><strong>';
        printf(
            /* translators: 1: required WordPress version, 2: plugin name */
            esc_html__('Error: %2$s requires WordPress version %1$s or greater.', 'cache-performance'),
            esc_html(self::MIN_WP_VERSION),
            esc_html($this->getPluginName())
        );
        echo '</strong></p></div>';
    }

    /**
     * Get the name of this plugin.
     *
     * @return string The plugin name.
     */
    private function getPluginName()
    {
        $data = get_plugin_data(self::FILE);
        return $data['Name'];
    }
}

add_action('plugins_loaded', array('Optimisationio', 'getInstance'));
add_action(
    'plugins_loaded',
    array(
        'Optimisationio_CacheEnabler',
        'instance'
    )
);
register_activation_hook(
    __FILE__,
    array(
        'Optimisationio_CacheEnabler',
        'on_activation'
    )
);
register_deactivation_hook(
    __FILE__,
    array(
        'Optimisationio_CacheEnabler',
        'on_deactivation'
    )
);
register_uninstall_hook(
    __FILE__,
    array(
        'Optimisationio',
        'uninstall'
    )
);
