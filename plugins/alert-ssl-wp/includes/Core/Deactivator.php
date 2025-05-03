<?php
namespace Alert_SSL_WP\Core;

/**
 * Handles plugin deactivation
 */
class Deactivator {
    /**
     * Deactivate the plugin
     */
    public static function deactivate() {
        // Remove scheduled check
        $timestamp = wp_next_scheduled('alert_ssl_wp_daily_check');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'alert_ssl_wp_daily_check');
        }
    }
}
