<?php
/**
 * Plugin Name: Alert SSL WP
 * Plugin URI: https://wordpress.org/plugins/alert-ssl-wp/
 * Description: Monitor your SSL certificate expiration and receive notifications before it expires.
 * Version: 1.0.0
 * Author: Kpitene
 * Author URI: https://kpitene.fr
 * Text Domain: alert-ssl-wp
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Alert_SSL_WP
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Plugin version
define('ALERT_SSL_WP_VERSION', '1.0.0');
define('ALERT_SSL_WP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ALERT_SSL_WP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Autoload classes
spl_autoload_register(function ($class) {
    $prefix = 'Alert_SSL_WP\\';
    $base_dir = ALERT_SSL_WP_PLUGIN_DIR . 'includes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Initialize plugin
function alert_ssl_wp_init() {
    if (class_exists('Alert_SSL_WP\\Core\\Plugin')) {
        $plugin = new Alert_SSL_WP\Core\Plugin();
        $plugin->init();
    }
}
// add_action('plugins_loaded', 'alert_ssl_wp_init');
add_action('init', 'alert_ssl_wp_init');


// add_action('init', function()
// {
//     // since 6.7
//     load_plugin_textdomain(
//         'alert-ssl-wp',
//         false,
//         ALERT_SSL_WP_PLUGIN_DIR . '/languages/'
//     );});

// Activation hook
register_activation_hook(__FILE__, function() {
    if (class_exists('Alert_SSL_WP\\Core\\Activator')) {
        Alert_SSL_WP\Core\Activator::activate();
    }
});

// Deactivation hook
register_deactivation_hook(__FILE__, function() {
    if (class_exists('Alert_SSL_WP\\Core\\Deactivator')) {
        Alert_SSL_WP\Core\Deactivator::deactivate();
    }
});
