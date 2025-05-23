<?php
/**
 * Plugin Name: Restrict Admin by IP
 * Plugin URI: https://github.com/anupamsahoo/Restrict-Admin-by-IP
 * Description: Restricts access to wp-login.php and wp-admin to specific IP addresses. Includes admin UI.
 * Version: 1.0.1
 * Author: Anupam Sahoo
 * Author URI: https://digitalhubz.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: restrict-admin-by-ip
 */

 add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

 require_once plugin_dir_path(__FILE__) . 'admin-ui.php';
 
 function radmin_get_client_ip() {
    $headers = [
        'HTTP_CF_CONNECTING_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_REAL_IP',
        'HTTP_CLIENT_IP',
        'REMOTE_ADDR'
    ];

    foreach ( $headers as $key ) {
        if ( ! empty( $_SERVER[ $key ] ) ) {
            $raw_ip = isset( $_SERVER[ $key ] ) ? sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) ) : '';
            $ip = explode( ',', $raw_ip )[0];
            $ip = sanitize_text_field( trim( $ip ) );

            if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
                return $ip;
            }
        }
    }

    return '0.0.0.0';
}
 
 add_action('init', function () {
     if (is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
         $allowed_ips = get_option('radmin_allowed_ips', []);
         $user_ip = radmin_get_client_ip();
 
         if (!in_array($user_ip, $allowed_ips)) {
             wp_die(
                 'Access denied. Your IP address (' . esc_html($user_ip) . ') is not allowed.',
                 'Access Denied',
                 ['response' => 403]
             );
         }
     }
 });
 
 register_activation_hook(__FILE__, function () {
     $ip = radmin_get_client_ip();
     $existing = get_option('radmin_allowed_ips', []);
     if (!in_array($ip, $existing)) {
         $existing[] = $ip;
         update_option('radmin_allowed_ips', $existing);
     }
 });
 