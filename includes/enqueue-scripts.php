<?php
// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function mediaexport_enqueue_scripts( $hook ) {
    if ( 'media_page_mediaexport-master' !== $hook ) {
        return;
    }
    wp_enqueue_style( 'mediaexport-tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css', [], MEDIAEXPORT_MASTER_VERSION );
    wp_enqueue_script( 'mediaexport-script', MEDIAEXPORT_MASTER_URL . 'assets/js/mediaexport.js', [ 'jquery' ], MEDIAEXPORT_MASTER_VERSION, true );

    // Add nonce for security.
    wp_localize_script( 'mediaexport-script', 'mediaexport_vars', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'mediaexport_nonce' ),
    ] );
}
