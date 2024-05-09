<?php 
/** Tell WordPress to run morris_setup() when the 'after_setup_theme' hook is run. */
add_action('after_setup_theme', 'morris_setup');



if (!function_exists('morris_setup')) :


    function morris_setup()
    {

        add_editor_style();

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(80, 80); // Normal post thumbnails
        add_image_size('persons-post-thumbnail', 100, 50, true); // medium thumbnail size 
        add_image_size('product-size-thumbnail', 260, 260, true); // product-size-thumbnail 
        add_image_size('about-footer-size', 186, 218, true);
        add_image_size('size-woocommerce', 260, 260, true);
        add_image_size('news-size-thumbnail', 403, 256, true);
        add_image_size('news-big-thumbnail', 1200, 500, true);//
        add_theme_support( 'widgets' );

        load_theme_textdomain('morris', TEMPLATEPATH . '/languages');

        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if (is_readable($locale_file))
            require_once($locale_file);

        register_nav_menus(array(
            'topspot' => __('topspot', 'morris'),
            'topnav' => __('topnav', 'morris'),
            'botnav' => __('botnav', 'morris'),
        ));
        define('HEADER_TEXTCOLOR', '');
        define('HEADER_IMAGE', '%s/images/headers/path.jpg');

        define('HEADER_IMAGE_WIDTH', apply_filters('morris_header_image_width', 940));
        define('HEADER_IMAGE_HEIGHT', apply_filters('morris_header_image_height', 198));


        set_post_thumbnail_size(HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true);
        define('NO_HEADER_TEXT', true);
        register_default_headers(array(
            'berries' => array(
                'url' => '%s/images/headers/berries.jpg',
                'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Berries', 'morris')
            ),
            'cherryblossom' => array(
                'url' => '%s/images/headers/cherryblossoms.jpg',
                'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Cherry Blossoms', 'morris')
            ),
            'concave' => array(
                'url' => '%s/images/headers/concave.jpg',
                'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Concave', 'morris')
            ),
            'fern' => array(
                'url' => '%s/images/headers/fern.jpg',
                'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Fern', 'morris')
            ),
            'forestfloor' => array(
                'url' => '%s/images/headers/forestfloor.jpg',
                'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Forest Floor', 'morris')
            ),
            'inkwell' => array(
                'url' => '%s/images/headers/inkwell.jpg',
                'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Inkwell', 'morris')
            ),
            'path' => array(
                'url' => '%s/images/headers/path.jpg',
                'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Path', 'morris')
            ),
            'sunset' => array(
                'url' => '%s/images/headers/sunset.jpg',
                'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
                /* translators: header image description */
                'description' => __('Sunset', 'morris')
            )
        ));
    }

endif;

define( 'MORRIS_THEME_VERSION', '1.1.5' );

function morris_landing_scripts()
{
    wp_enqueue_style('morris-landing-styles', get_template_directory_uri() . '/css/style.css', array(), MORRIS_THEME_VERSION, 'all');
    wp_enqueue_script( 'swiperesmb', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), MORRIS_THEME_VERSION, 'all');
    wp_enqueue_script('morris-landing-scripts', get_template_directory_uri() . '/js/scripts.js',array(), MORRIS_THEME_VERSION, 'all');
    wp_localize_script( 'morris-landing-scripts', 'frontendajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

}
add_action('wp_enqueue_scripts', 'morris_landing_scripts');

get_template_part('includes/adminPanelPage', 'adminPanelPage');
get_template_part('includes/config', 'config');
get_template_part('includes/adminPanelPostPage', 'adminPanelPostPage');

function techvertu_wc_count_brands(){
    $attribute_taxonomies = wc_get_attribute_taxonomies();
    $taxonomy_terms = array();

    if ($attribute_taxonomies) :
        foreach ($attribute_taxonomies as $tax) :
            if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) :
                $taxonomy_terms[$tax->attribute_name] = get_terms(wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name&hide_empty=0');
            endif;
        endforeach;
    endif;
    return count($taxonomy_terms['brands']);
}
function techvertu_description_template($description){
    ?>
    <div class="techvertu-term-description clearfix">
        <p><?php echo($description);?></p>
    </div>
    <?php
}

add_filter('woocommerce_show_page_title', 'techvertu_hide_shop_page_title');

function techvertu_hide_shop_page_title($title)
{
	if (is_shop()) $title = false;
	return $title;
}


add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );



add_filter( 'wpseo_breadcrumb_links', function( $links ) {

    if ( is_product_category() ) {

        $breadcrumb[] = array(
            'url' => site_url( '/shop/' ),
            'text' => 'Products',
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }

    return $links;
} );

add_filter( 'woocommerce_account_menu_items', 'techvertu_remove_address_my_account', 9999 );
 
function techvertu_remove_address_my_account( $items ) {
   unset( $items['customer-logout'] );
   unset( $items['downloads'] );
   return $items;
}

add_filter( 'loop_shop_per_page', 'techvertu_woocommerce_loop_item_number' );
function techvertu_woocommerce_loop_item_number(){
    return 12;
}


add_filter( 'wpseo_breadcrumb_single_link' ,'techvertu_wpseo_remove_breadcrumb_link', 10 ,2);

function techvertu_wpseo_remove_breadcrumb_link( $link_output , $link ){
    $text_to_remove = 'shop';
    if(str_contains($link['url'], $text_to_remove)) {
      $link_output = '';
    }
 
    return $link_output;
}

add_action( 'woocommerce_email_before_order_table', 'techvertu_add_payment_method_to_admin_new_order', 15, 2 );

function techvertu_add_payment_method_to_admin_new_order( $order, $is_admin_email ) {
    echo '<div style="display:inline-block;vertical-align:top;width:48%;"><p><strong>Payment Method:<br></strong> ' . $order->payment_method_title . '</p></div>';
    echo '<div style="display:inline-block;vertical-align:top;width:48%;"><p><strong>Shipping Method:<br></strong> ' . $order->get_shipping_method . '</p></div>';
}



add_filter( 'woocommerce_get_order_item_totals', 'techvertu_renaming_shipping_order_item_totals', 20, 3 );
function techvertu_renaming_shipping_order_item_totals( $total_rows, $order, $tax_display ){
    // Only on emails notifications
    $total_rows['shipping']['label'] = __('Shipping & Handling', 'woocommerce');
    $total_rows['order_total']['label'] = __('Grand Total (Incl.Tax)', 'woocommerce');//Total
    unset($total_rows['payment_method']);
    $total_rows['grand_total'] = array(
        'label' => __( 'Grand Total (Excl.Tax)', 'woocommerce' ),
        'value' => wc_price( ( $order->get_total() - $order->get_total_tax() )  ),
    );
    return $total_rows;
}

add_filter( 'woocommerce_email_headers', 'techvertu_order_completed_email_add_cc_bcc', 9999, 3 );
 
function techvertu_order_completed_email_add_cc_bcc( $headers, $email_id, $order ) {
    if ( 'customer_processing_order' == $email_id ) {
        $headers .= "From: Sales Department <sales@morrismachinery.co.uk>"; // delete if not needed
        $headers .= "Cc:Sales Department <sales@morrismachinery.co.uk>"; // delete if not needed
    }
    return $headers;
}

add_action( 'admin_init', 'techvertu_posts_order_wpse' );

function techvertu_posts_order_wpse() 
{
    add_post_type_support( 'product', 'page-attributes' );
    add_post_type_support( 'post', 'page-attributes' );
}



function techvertu_send_enquiry() {
    
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $senderEmail = sanitize_text_field($_POST['senderEmail']);
    $to = sanitize_email($_POST['senderEmail']);
    $productTitle = sanitize_text_field($_POST['productTitle']);
    $subject = sanitize_text_field('enquire for '. $productTitle);
    $sku = sanitize_text_field( $_POST['productSKU']);   
    $firstName = sanitize_text_field($_POST['firstname']);
    $lastName = sanitize_text_field($_POST['lastname']);
    $businessName = sanitize_text_field($_POST['businessName']);
    $quantity = $_POST["quantity"];
    $sku = sanitize_text_field($_POST['sku']);
    $phonenumber = $_POST['phonenumber'];
    $postCode = $_POST['postecode'];
    $reCAPTCHA = $_POST['g-recaptcha-response'];
    $note = sanitize_text_field($_POST['note']);
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $response = wp_remote_post( $url, array(
        'body' => array(
          'secret' => SECRET_KEY,
          'response' => $reCAPTCHA
        )
      ) );
    $recaptchaDecode = json_decode($url);
    
    $body = '<img src="https://www.morrismachinery.co.uk/wp-content/uploads/2023/08/Logo-MORRIS.svg" />
            <p>A New contact form has been submitted.Please find the customers detail below</p>
            <strong style="width:200px;display: inline-block;">Name :</strong>'. $firstName .' ' .$lastName. 
            '<br> <strong style="width:200px;display: inline-block;">Business name : </strong>' . $businessName.'
                <br><strong style="width:200px;display: inline-block;"> Contact number :</strong>' . $phonenumber. 
                '<br> <strong style="width:200px;display: inline-block;">Post code :</strong>' .$postCode.
            '<br> <strong style="width:200px;display: inline-block;">Email : </strong>'.$to. '<br>
                <strong style="width:200px;display: inline-block;">SKU:</strong>'.$sku. '<br>
                <strong style="width:200px;display: inline-block;"> Quantity:</strong>'.$quantity.'
                <br> <strong style="width:200px;display: inline-block;">Message :</strong> <br>' .$note;
    if($to && $subject && $body && $phonenumber && $postCode && $note && $firstName && $lastName ) { //&& $recaptchaDecode->success == true && $recaptchaDecode->score > 0.5
        wp_mail( 'info@morrismachinery.co.uk', $subject, $body, $headers ); //info@morrismachinery.co.uk
        $successFlag = '1';
    }
    else {
        $successFlag = '0';
    }
    echo($successFlag);
    wp_die();
}
add_action( 'wp_ajax_techvertu_send_enquiry', 'techvertu_send_enquiry' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_techvertu_send_enquiry', 'techvertu_send_enquiry' ); 



add_filter( 'paginate_links', function($link){
    if(is_paged()){$link= str_replace('page/1/', '', $link);}
    return $link;
} );


// this code is for removing a tag from gallery and product images
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'techvertu_remove_product_link' );
function techvertu_remove_product_link( $html ) {
  return strip_tags( $html, '<div><img>' );
}

add_filter( 'woocommerce_loop_add_to_cart_args', 'techvertu_remove_rel', 10, 2 );
function techvertu_remove_rel( $args, $product ) {
    unset( $args['attributes']['rel'] );
    return $args;
}

add_filter('wpseo_robots', 'override_yoast_robots_directive');
 
function override_yoast_robots_directive($robots) {
    if ( (isset($_GET['add-to-cart']) && !empty($_GET['add-to-cart'])) || (isset($_GET['prID']) && !empty($_GET['prID'])) ) {
        $robots = 'noindex, nofollow';
    }
    return $robots;
}