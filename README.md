# Restrict Admin by IP WordPress Plugin

### Tags: security, admin, login, ip restriction, access control

- Requires at least: 5.2
- Tested up to: 6.8
- Requires PHP: 7.2
- Stable tag: 1.0.0
- License: GPLv2 or later
- License URI: https://www.gnu.org/licenses/gpl-2.0.html

Restrict access to wp-login.php and wp-admin to specific IP addresses. Includes an easy-to-use admin UI to manage allowed IPs and auto-add your current IP.

## Description

**Restrict Admin by IP** is a lightweight security plugin that blocks access to the WordPress login and admin area for all IP addresses except the ones you approve.

Whether you're running a solo blog or a large website, this plugin gives you peace of mind by limiting login access to your trusted IPs.

## Features

- ✅ Block wp-login.php and wp-admin from unauthorized IPs
- ✅ Admin UI to add/remove allowed IP addresses
- ✅ Automatically add your IP on plugin activation
- ✅ Flash message support using PHP sessions
- ✅ Fully compatible with cloud providers like Cloudflare
- ✅ No bloat – just focused security

## Installation

- Upload the plugin folder to the `/wp-content/plugins/` directory.
- Activate the plugin through the 'Plugins' menu in WordPress.
- Go to **Settings → Restrict Admin IPs** to manage your IP list.
- Your current IP will be automatically added on activation.

## Frequently Asked Questions

#### What if I lock myself out?

If your IP is not listed and you log out, you won't be able to access wp-admin or wp-login.php. In that case, either:

- Temporarily disable the plugin via FTP or File Manager.
- Add your IP directly to the `radmin_allowed_ips` option in the database via phpMyAdmin.

#### Will it work behind a proxy like Cloudflare?

**Yes.** The plugin attempts to detect your real IP via `HTTP_CF_CONNECTING_IP`, `X-Forwarded-For`, and other headers.

#### Can I allow multiple users with different IPs?

Yes, just add each IP on a new line in the settings page.

## Screenshots

**Admin interface to manage allowed IPs**
![Settings page showing allowed IPs](https://github.com/anupamsahoo/Restrict-Admin-by-IP/blob/main/assets/screenshot-1.jpg)

**Access denied message when not whitelisted**
![403 error with denied IP message](https://github.com/anupamsahoo/Restrict-Admin-by-IP/blob/main/assets/screenshot-3.png)

**Menu Item**
![403 error with denied IP message](https://github.com/anupamsahoo/Restrict-Admin-by-IP/blob/main/assets/screenshot-2.jpg)

## Changelog

v1.0.0

- Initial release
- Admin UI for IPs
- Auto-detect installing IP
- Session-based success notifications

## License

This plugin is licensed under the GPLv2 or later.
