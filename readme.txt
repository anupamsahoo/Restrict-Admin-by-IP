=== Restrict Admin by IP ===
Contributors: anupammithu
Donate link: https://digitalhubz.com/pay
Tags: security, admin, login, ip restriction, access control
Requires at least: 5.2
Tested up to: 6.8
Requires PHP: 7.2
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Restrict wp-login.php and wp-admin access to specific IPs with an admin UI and auto-add of your current IP.

== Description ==

**Restrict Admin by IP** is a lightweight security plugin that blocks access to the WordPress login and admin area for all IP addresses except the ones you approve.

Whether you're running a solo blog or a large website, this plugin gives you peace of mind by limiting login access to your trusted IPs.

== Features ==

- ✅ Block wp-login.php and wp-admin from unauthorized IPs
- ✅ Admin UI to add/remove allowed IP addresses
- ✅ Automatically add your IP on plugin activation
- ✅ Flash message support using PHP sessions
- ✅ Fully compatible with cloud providers like Cloudflare
- ✅ No bloat – just focused security

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to **Settings → Restrict Admin IPs** to manage your IP list.
4. Your current IP will be automatically added on activation.

== Frequently Asked Questions ==

= What if I lock myself out? =
If your IP is not listed and you log out, you won't be able to access wp-admin or wp-login.php. In that case, either:
- Temporarily disable the plugin via FTP or File Manager.
- Add your IP directly to the `radmin_allowed_ips` option in the database via phpMyAdmin.

= Will it work behind a proxy like Cloudflare? =
Yes. The plugin attempts to detect your real IP via `HTTP_CF_CONNECTING_IP`, `X-Forwarded-For`, and other headers.

= Can I allow multiple users with different IPs? =
Yes, just add each IP on a new line in the settings page.

== Screenshots ==

1. **Admin interface to manage allowed IPs**
   ![Settings page showing allowed IPs](assets/screenshot-1.png)

2. **Access denied message when not whitelisted**
   ![403 error with denied IP message](assets/screenshot-2.png)

== Changelog ==

= 1.0.1 =
* Fixed: Success message now correctly appears after saving IPs
* Improved input validation and escaping
* Minor compatibility fixes

= 1.0.0 =
* Initial release
* Admin UI for IPs
* Auto-detect installing IP

== Upgrade Notice ==

= 1.0.1 =
Improved security and usability with flash success message fix and validation improvements.

= 1.0.0 =
Initial release — restrict access to wp-admin and login page based on allowed IPs.

== License ==

This plugin is licensed under the GPLv2 or later.
