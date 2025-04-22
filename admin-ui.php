<?php

add_action('admin_menu', function () {
    add_options_page(
        'Restrict Admin IPs',
        'Restrict Admin IPs',
        'manage_options',
        'restrict-admin-ip',
        'radmin_settings_page'
    );
});

function radmin_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    // Handle form submit
    if (isset($_SERVER['REQUEST_METHOD']) === 'POST' && isset($_POST['radmin_ips'])) {
        check_admin_referer('radmin_save_ips');

        $raw_ips = sanitize_textarea_field( wp_unslash( $raw_input ) );;
        $ips     = array_map( 'trim', explode( "\n", $raw_ips ) );
        $ips     = array_filter( $ips, fn( $ip ) => filter_var( $ip, FILTER_VALIDATE_IP ) );

        update_option( 'radmin_allowed_ips', $ips );
        // Flash success message
        //$meaasge = 'IP addresses updated successfully.';
        wp_redirect(admin_url('options-general.php?page=restrict-admin-ip&ip_added=yes'));
        exit;
    }

    $allowed_ips = get_option('radmin_allowed_ips', []);
    $ip_text = implode("\n", $allowed_ips);
    $current_ip = radmin_get_client_ip();
    ?>
<div class="wrap">
    <h1>Restrict Admin Access by IP</h1>
    <?php
    if (isset($_GET['ip_added'])) {
        echo '<div style="background:white;color:green;padding:1px 14px;"><p><strong>IP addresses updated successfully.</strong></p></div>';
    }
    ?>
    <p><strong>Your current IP:</strong> <?php echo esc_html($current_ip); ?></p>
    <form method="post">
        <?php wp_nonce_field('radmin_save_ips'); ?>
        <textarea name="radmin_ips" rows="10" cols="50"
            class="large-text code"><?php echo esc_textarea($ip_text); ?></textarea>
        <p>Enter one IP address per line. Invalid IPs will be ignored.</p>
        <?php 
        submit_button('Save IP Addresses'); 
        ?>
    </form>
</div>
<?php
}

// Fallback if function is not loaded from main file
if (!function_exists('radmin_get_client_ip')) {
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
                // Unslash, trim, and sanitize the IP
                $raw_ip = isset( $_SERVER[ $key ] ) ? sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) ) : '';
                $ip = explode( ',', $raw_ip )[0];
                $ip = sanitize_text_field( trim( $ip ) );
    
                // Validate IP format
                if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
                    return $ip;
                }
            }
        }
    
        return '0.0.0.0';
    }
    
}