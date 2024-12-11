<?php

// Render the admin page
function mediaexport_master_render_admin_page() {
    ?>
    <div class="wrap">
        <div class="grid grid-cols-3 gap-4">
            <!-- Main Content -->
            <div class="col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold mb-4">MediaExport Master</h1>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
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

            <!-- Sidebar -->
            <aside class="col-span-1 bg-gray-50 p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-3">Want to Support?</h2>
                <ul class="list-disc ml-4 space-y-2">
                    <li><a href="https://iatifsyed.github.io/" class="text-blue-500 hover:underline">Hire me on a project</a></li>
                    <li>
                        <form action="https://www.paypal.com/donate" method="post" target="_blank">
                            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Buy me a Coffee</button>
                        </form>
                    </li>
                </ul>

                <h2 class="text-lg font-semibold mt-6 mb-3">Wanna Say Thanks?</h2>
                <ul class="list-disc ml-4 space-y-2">
                    <li><a href="#" class="text-blue-500 hover:underline">Leave a ★★★★★ rating</a></li>
                    <li><a href="#" class="text-blue-500 hover:underline">Tweet me: @AtifSyed</a></li>
                </ul>

                <h2 class="text-lg font-semibold mt-6 mb-3">Got a Problem?</h2>
                <ul class="list-disc ml-4 space-y-2">
                    <li><a href="#" class="text-blue-500 hover:underline">Create Support Ticket</a></li>
                    <li><a href="mailto:atifsyedlive@gmail.com" class="text-blue-500 hover:underline">Write me an Email</a></li>
                </ul>

                <p class="text-sm text-gray-600 mt-6">Developed by: <a href="https://github.com/iAtifSyed" class="text-blue-500 hover:underline">Atif Syed</a></p>
            </aside>
        </div>
    </div>
    <?php
}
