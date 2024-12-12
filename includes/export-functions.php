<?php
// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Handle the export request
add_action( 'admin_post_mediaexport_master_export', 'mediaexport_master_handle_export' );
function mediaexport_master_handle_export() {
    // Verify nonce if added (security check).
    check_ajax_referer( 'mediaexport_nonce', 'security' );
    // Sanitize and retrieve form inputs.
   $fields = isset( $_POST['fields'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['fields'] ) ) : [];
    $author = isset( $_POST['author'] ) ? sanitize_text_field( wp_unslash( $_POST['author'] ) ) : '';
    $export_type     = isset( $_POST['export_type'] ) ? sanitize_text_field( $_POST['export_type'] ) : 'csv';
	
    // Fetch media library data based on selected fields and author filter.
    $query_args = [
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => -1,
    ];

    if ( $author !== 'all' ) {
        $query_args['author'] = $author;
    }

    $media_query = new WP_Query( $query_args );
    $media_data  = [];

    if ( $media_query->have_posts() ) {
        while ( $media_query->have_posts() ) {
            $media_query->the_post();

            $item = [];
            foreach ( $selected_fields as $field ) {
                switch ( $field ) {
                    case 'id':
                        $item['ID'] = get_the_ID();
                        break;
                    case 'title':
                        $item['Title'] = get_the_title();
                        break;
                    case 'file_name':
                        $item['File Name'] = basename( get_attached_file( get_the_ID() ) );
                        break;
                    case 'caption':
                        $item['Caption'] = wp_get_attachment_caption( get_the_ID() );
                        break;
                    case 'alt_text':
                        $item['Alt Text'] = get_post_meta( get_the_ID(), '_wp_attachment_image_alt', true );
                        break;
                    case 'description':
                        $item['Description'] = get_the_content();
                        break;
                    case 'url':
                        $item['URL'] = wp_get_attachment_url( get_the_ID() );
                        break;
                    case 'date_uploaded':
                        $item['Date Uploaded'] = get_the_date();
                        break;
                    case 'type':
                        $item['Type'] = get_post_mime_type( get_the_ID() );
                        break;
                }
            }
            $media_data[] = $item;
        }
        wp_reset_postdata();
    }

    // Handle output based on export type.
    if ( $export_type === 'csv' ) {
        mediaexport_master_generate_csv( $media_data );
    } elseif ( $export_type === 'screen' ) {
        mediaexport_master_display_on_screen( $media_data );
    }

    exit; // Stop further processing.
}

// Generate CSV file and trigger download
function mediaexport_master_generate_csv( $data ) {
    if ( empty( $data ) ) {
        wp_die( 'No data found for the selected options.' );
    }

    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment; filename="media-export.csv"' );

    $output = fopen( 'php://output', 'w' );

    // Write column headers
    fputcsv( $output, array_keys( $data[0] ) );

    // Write rows
    foreach ( $data as $row ) {
        fputcsv( $output, $row );
    }

	global $wp_filesystem;
	$wp_filesystem->close($file);
    exit;
}

// Display data on-screen in an HTML table
function mediaexport_master_display_on_screen( $data ) {
    if ( empty( $data ) ) {
        wp_die( 'No data found for the selected options.' );
    }

    echo '<div class="wrap">';
    echo '<h1 class="text-2xl font-bold mb-4">Exported Data</h1>';
    echo '<table class="table-auto border-collapse border border-gray-400 w-full">';
    echo '<thead>';
    echo '<tr>';
    foreach ( array_keys( $data[0] ) as $header ) {
        echo '<th class="border border-gray-300 px-4 py-2">' . esc_html( $header ) . '</th>';
    }
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ( $data as $row ) {
        echo '<tr>';
        foreach ( $row as $value ) {
            echo '<td class="border border-gray-300 px-4 py-2">' . esc_html( $value ) . '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
