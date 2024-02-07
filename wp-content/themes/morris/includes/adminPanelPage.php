<?php 
    /** Step 1. */
    function morris_menu() {
        $iconurl = get_stylesheet_directory_uri() . '/images/pipe.png';
        add_menu_page('Morris', 'Morris Infos', 'manage_options', 'my-unique-identifier', 'morris_options', $iconurl, 5);
    }

    /** Step 2 (from text above). */
    add_action('admin_menu', 'morris_menu');

    /** Step 3. */
    function morris_options() {

        echo '<div class="wrap">';
        echo '<h3>Morris</h3>';
        // jQuery
        wp_enqueue_script('jquery');
        // This will enqueue the Media Uploader script
        wp_enqueue_media();
        ?>
        <div class="tooka-settings clearfix">

            <form method="post" action="options.php">
                <?php wp_nonce_field('update-options'); ?>
                <table class="form-table column-50">
                    <tr valign="top">
                        <th scope="row"><?php _e('Address', 'morris')?></th>
                        <td><input type="text" name="company_address" value="<?php echo get_option('company_address'); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Tel', 'morris');?> :</th>
                        <td><input type="text" name="company_tel" value="<?php echo get_option('company_tel'); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><? _e('Fax', 'morris');?> :</th>
                        <td><input type="text" name="fax" value="<?php echo get_option('fax'); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Email', 'morris');?></th>
                        <td><input type="text" name="company_email" value="<?php echo get_option('company_email'); ?>" /></td>
                    </tr>
                    
                </table>
                <table class="form-table column-50">
                    <tr valign="top">
                        <th scope="row"><?php _e('latitude', 'morris');?></th>
                        <td><input type="text" name="location_h" value="<?php echo get_option('location_h'); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Longitude', 'morris');?></th>
                        <td><input type="text" name="location_w" value="<?php echo get_option('location_w'); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Google Map Code', 'morris');?></th>
                        <td><input type="text" name="google_key" value="<?php echo get_option('google_key'); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e('Logo', 'morris');?></th>
                        <td>
                            <label for="image_url"><?php _e('Logo Pic', 'morris');?></label>
                            <input type="text" name="image_url" id="image_url" value="<?php echo get_option('image_url'); ?>" class="regular-text">
                            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Logo">
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="page_options" value="company_address,company_tel,company_email,location_h,location_w,google_key,slider,image_url,fax" />
                <div class="submit">
                    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                </div>
                <script type="text/javascript">
                jQuery(document).ready(function($){
                    $('#upload-btn').click(function(e) {
                        e.preventDefault();
                        var image = wp.media({ 
                            title: 'Logo upload',
                            // mutiple: true if you want to upload multiple files at once
                            multiple: false
                        }).open()
                        .on('select', function(e){
                            // This will return the selected image from the Media Uploader, the result is an object
                            var uploaded_image = image.state().get('selection').first();
                            // We convert uploaded_image to a JSON object to make accessing it easier
                            // Output to the console uploaded_image
                            console.log(uploaded_image);
                            var image_url = uploaded_image.toJSON().url;
                            // Let's assign the url value to the input field
                            $('#image_url').val(image_url);
                        });
                    });
                });
                </script>
            </form>
        </div>
        

    </div>
    <?php
    echo '</div>';
}