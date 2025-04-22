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

    if ( isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['radmin_ips']) ) {

        check_admin_referer('radmin_save_ips');

        $raw_ips = sanitize_textarea_field( wp_unslash( $_POST['radmin_ips'] ) );
        $ips     = array_map( 'trim', explode( "\n", $raw_ips ) );
        $ips     = array_filter( $ips, fn( $ip ) => filter_var( $ip, FILTER_VALIDATE_IP ) );

        update_option( 'radmin_allowed_ips', $ips );

        set_transient('radmin_success_message', 'IP addresses updated successfully.', 30);
    }

    $allowed_ips = get_option('radmin_allowed_ips', []);
    $ip_text = implode("\n", $allowed_ips);
    $current_ip = radmin_get_client_ip();

    ?>
<div class="wrap">
    <h1>Restrict Admin Access by IP</h1>
    <?php
        $message = get_transient('radmin_success_message');
        if ($message) {
            echo '<div style="background:white;color:green;padding:1px 14px;"><p><strong>' . esc_html($message) . '</strong></p></div>';
            delete_transient('radmin_success_message');
        }
        ?>
    <p><strong>Your current IP:</strong> <?php echo esc_html($current_ip); ?></p>
    <form method="post">
        <?php wp_nonce_field('radmin_save_ips'); ?>
        <textarea name="radmin_ips" rows="10" cols="50"
            class="large-text code"><?php echo esc_textarea($ip_text); ?></textarea>
        <p>Enter one IP address per line. Invalid IPs will be ignored.</p>
        <?php submit_button('Save IP Addresses'); ?>
    </form>
</div>
<?php
}