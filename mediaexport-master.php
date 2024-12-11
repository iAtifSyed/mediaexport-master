<?php
/**
 * Plugin Name: MediaExport Master
 * Plugin URI: https://envisionlab.github.io/mediaexport-master
 * Description: Export media library metadata with customizable options.
 * Version: 1.0
 * Author: Atif Syed
 * Author URI: https://github.com/iAtifSyed/
 * License: GPL2
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
