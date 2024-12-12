<?php
/**
 * Plugin Name: MediaExport Master
 * Plugin URI:  https://envisionlab.github.io/mediaexport-master
 * Description: MediaExport Master is a powerful WordPress plugin that allows you to export your media library data with customizable metadata fields and filters. It can be very useful during migration, seo analysis and security audit.
 * Version:     1.5
 * Author:      Atif Syed
 * Author URI:  https://iatifsyed.github.io/
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mediaexport-master
 *
 * @package MediaExport Master
 */
/*
    Copyright (c) 2024- Atif Syed (contact : https://iatifsyed.github.io/)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; version 2 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'MEDIAEXPORT_MASTER_PATH', plugin_dir_path( __FILE__ ) );
define( 'MEDIAEXPORT_MASTER_URL', plugin_dir_url( __FILE__ ) );

// Include required files
require_once MEDIAEXPORT_MASTER_PATH . 'includes/enqueue-scripts.php';
require_once MEDIAEXPORT_MASTER_PATH . 'includes/admin-page.php';
require_once MEDIAEXPORT_MASTER_PATH . 'includes/export-functions.php';

// Add menu item for the plugin admin page
add_action( 'admin_menu', 'mediaexport_master_add_menu' );
function mediaexport_master_add_menu() {
    add_menu_page(
        'MediaExport Master',
        'MediaExport Master',
        'manage_options',
        'mediaexport-master',
        'mediaexport_master_render_admin_page',
        'dashicons-download',
        25
    );
}
