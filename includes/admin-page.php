<?php

// Render the admin page
function mediaexport_master_render_admin_page() {
    ?>
    <div class="wrap">
        <h1 class="text-2xl font-bold mb-4">MediaExport Master</h1>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
            <input type="hidden" name="action" value="mediaexport_master_export">

            <!-- Additional Data Options -->
            <fieldset class="mb-4">
                <legend class="text-lg font-semibold">Additional Data:</legend>
                <div class="grid grid-cols-2 gap-2">
                    <?php
                    $fields = ['ID', 'Title', 'File Name', 'Caption', 'Alt Text', 'Description', 'URL', 'Date Uploaded', 'Type'];
                    foreach ( $fields as $field ) : ?>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="fields[]" value="<?php echo esc_attr( strtolower( str_replace( ' ', '_', $field ) ) ); ?>" class="form-checkbox">
                            <span><?php echo esc_html( $field ); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <!-- Filter By Author -->
            <fieldset class="mb-4">
                <legend class="text-lg font-semibold">By Author:</legend>
                <select name="author" class="form-select w-full border-gray-300 rounded">
                    <option value="all">All</option>
                    <?php
                    $authors = get_users( [ 'who' => 'authors' ] );
                    foreach ( $authors as $author ) : ?>
                        <option value="<?php echo esc_attr( $author->ID ); ?>"><?php echo esc_html( $author->display_name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>

            <!-- Export Type -->
            <fieldset class="mb-4">
                <legend class="text-lg font-semibold">Export Type:</legend>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="export_type" value="csv" class="form-radio" checked>
                        <span>CSV File</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="export_type" value="screen" class="form-radio">
                        <span>Output Here</span>
                    </label>
                </div>
            </fieldset>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Export Now</button>
        </form>
    </div>
    <?php
}
