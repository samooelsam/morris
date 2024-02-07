<?php 

/**
 * The Class.
 */

 function call_techvertuMetaPages()
 {
	 new call_techvertuMetaPages();
 }
 
 if (is_admin()) {
	 add_action('load-post.php', 'call_techvertuMetaPages');
	 add_action('load-post-new.php', 'call_techvertuMetaPages');
 }
 
 class call_techvertuMetaPages
 {
 
	 /**
	  * Hook into the appropriate actions when the class is constructed.
	  */
	 public function __construct()
	 {
		 add_action('add_meta_boxes', array($this, 'add_meta_box'));
		 add_action('save_post', array($this, 'save'));
	 }
 
	 /**
	  * Adds the meta box container.
	  */
	 public function add_meta_box($post_type)
	 {
		 $post_type_page = array('product');
		 
		 if (in_array($post_type, $post_type_page)) {
			 add_meta_box(
				 'some_meta_box_name',
				 __('Product items', 'morris'),
				 array($this, 'page_box_content'),
				 $post_type_page,
				 'normal',
				 'high'
			 );
		 }
 
	 }
 
	 /**
	  * Save the meta when the post is saved.
	  *
	  * @param int $post_id The ID of the post being saved.
	  */
	 public function save($post_id)
	 {
 
		 /*
		  * We need to verify this came from the our screen and with proper authorization,
		  * because save_post can be triggered at other times.
		  */
 
		 // Check if our nonce is set.
		 if (!isset($_POST['myplugin_inner_custom_box_nonce'])) {
			 return $post_id;
		 }
 
		 $nonce = $_POST['myplugin_inner_custom_box_nonce'];
 
		 // Verify that the nonce is valid.
		 if (!wp_verify_nonce($nonce, 'myplugin_inner_custom_box')) {
			 return $post_id;
		 }
 
		 /*
		  * If this is an autosave, our form has not been submitted,
		  * so we don't want to do anything.
		  */
		 if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			 return $post_id;
		 }
 
		 // Check the user's permissions.
		 if ('page' == $_POST['post_type']) {
			 if (!current_user_can('edit_page', $post_id)) {
				 return $post_id;
			 }
		 } else {
			 if (!current_user_can('edit_post', $post_id)) {
				 return $post_id;
			 }
		 }
 
		 /* OK, it's safe for us to save the data now. */
 
		 // Sanitize the user input.
		
 
		 $tech_sheet = sanitize_text_field($_POST['tech_sheet']);
		 // Update the meta field.
		 update_post_meta($post_id, 'tech_sheet', $tech_sheet);

		 $tech_sheet_banner = sanitize_text_field($_POST['tech_sheet_banner']);
		 // Update the meta field.
		 update_post_meta($post_id, 'tech_sheet_banner', $tech_sheet_banner);

         $sparePart = sanitize_text_field($_POST['sparePart']);
		 // Update the meta field.
		 update_post_meta($post_id, 'sparePart', $sparePart);

		 $smallDescription = $_POST['small-description'];
		 // Update the meta field.
		 update_post_meta($post_id, 'small-description', $smallDescription);
 
         //small-description
 
		 // Update the meta field.
	 }
 
	 /**
	  * Render Meta Box content.
	  *
	  * @param WP_Post $post The post object.
	  */
 
	
 
 
 
	 public function page_box_content($post)
	 {
		 wp_nonce_field('myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce');
		 $sparePart = get_post_meta($post->ID, 'sparePart', true);
         $aboutImageURL = get_post_meta($post->ID, 'tech_sheet', true);
		 $techSheetBanner = get_post_meta($post->ID, 'tech_sheet_banner', true);
		 $smallDescription = get_post_meta($post->ID, 'small-description', true);
	 ?>
		 <ul>
            <li>
                <label for="sparePart"><?php _e('Enter Spare Part link', 'morris'); ?></label>
                <input type="text" name="sparePart" id="sparePart" value="<?php echo $sparePart; ?>" class="regular-text">
            </li>
            <li>
                    <label for="image_url"><?php _e('Download tech sheets', 'morris'); ?></label>
                    <input type="text" name="tech_sheet" id="tech_sheet" value="<?php echo $aboutImageURL; ?>" class="regular-text">
                    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="<?php _e('Select techsheet', 'morris'); ?>">
                    <br>
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $('#upload-btn').each(function() {
                                $('#upload-btn').click(function(e) {
                                    e.preventDefault();
                                    var image = wp.media({
                                            title: '<?php _e('Upload Picture', 'morris'); ?>',
                                            // mutiple: true if you want to upload multiple files at once
                                            multiple: false
                                        }).open()
                                        .on('select', function(e) {
                                            // This will return the selected image from the Media Uploader, the result is an object
                                            var uploaded_image = image.state().get('selection').first();
                                            // We convert uploaded_image to a JSON object to make accessing it easier
                                            // Output to the console uploaded_image
                                            console.log(uploaded_image);
                                            var image_url = uploaded_image.toJSON().url;
                                            // Let's assign the url value to the input field
                                            $('#tech_sheet').val(image_url);
                                        });
                                });
                            });

                        });
                    </script>
                </li>
				<li>
                    <label for="image_url"><?php _e('Download tech sheet banner', 'morris'); ?></label>
                    <input type="text" name="tech_sheet_banner" id="tech_sheet_banner" value="<?php echo $techSheetBanner; ?>" class="regular-text">
                    <input type="button" name="upload-btn-2" id="upload-btn-2" class="button-secondary" value="<?php _e('Select Picture', 'morris'); ?>">
                    <br>
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            $('#upload-btn-2').each(function() {
                                $('#upload-btn-2').click(function(e) {
                                    e.preventDefault();
                                    var image = wp.media({
                                            title: '<?php _e('Upload Picture', 'morris'); ?>',
                                            // mutiple: true if you want to upload multiple files at once
                                            multiple: false
                                        }).open()
                                        .on('select', function(e) {
                                            // This will return the selected image from the Media Uploader, the result is an object
                                            var uploaded_image = image.state().get('selection').first();
                                            // We convert uploaded_image to a JSON object to make accessing it easier
                                            // Output to the console uploaded_image
                                            console.log(uploaded_image);
                                            var image_url = uploaded_image.toJSON().url;
                                            // Let's assign the url value to the input field
                                            $('#tech_sheet_banner').val(image_url);
                                        });
                                });
                            });

                        });
                    </script>
                </li>
				<li>
					<label for="sparePart"><?php _e('Small description', 'morris'); ?></label>
					<?php 
					$editor_id = 'small-description';
					$settings = array( 'media_buttons' => false );
					
					wp_editor( $smallDescription , $editor_id, $settings );
					
					?>
				</li>
			 
		 </ul>
	 <?php
	 }
	
 }