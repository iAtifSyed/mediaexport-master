<?php

// Enqueue Tailwind CSS for plugin-specific pages
add_action( 'admin_enqueue_scripts', 'mediaexport_master_enqueue_scripts' );
function mediaexport_master_enqueue_scripts( $hook ) {
    if ( $hook === 'toplevel_page_mediaexport-master' ) {
        wp_enqueue_style( 'tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css', array(), '2.2.19' );
    }
}
