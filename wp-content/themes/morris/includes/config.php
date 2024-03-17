<?php
if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'footer navigation',
            'id' => 'footer-nav',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        ));
        register_sidebar(array(
            'name' => __('Shop Sidebar', 'morris'),
            'id' => 'shop-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        ));
        register_sidebar(array(
            'name' => __('footer products', 'morris'),
            'id' => 'footer-products',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        ));
}
function techvertu_add_woocommerce_support()
 {
        add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'techvertu_add_woocommerce_support' );


function techvertu_woocommerce_call_to_order_button(){
	global $product; //get the product object
	if ( $product && ('' === $product->get_price() || 0 == $product->get_price())) { // if there's a product proceed
		$url = esc_url( $product->get_permalink() ); //get the permalink to the product
		echo '<a href="' . $url . '" class="button add-to-cart send-inquiry"><i class="fi fi-rr-phone-call"></i>Call to order!</a>'; //display a button that goes to the product page
	}
}
add_action('woocommerce_after_shop_loop_item','techvertu_woocommerce_call_to_order_button', 10);



add_filter( 'woocommerce_product_tabs', 'techvertu_remove_description_tab' );

function techvertu_remove_description_tab( $tabs ) {
    unset( $tabs[ 'description' ] );
	unset( $tabs[ 'additional_information' ] );
	return $tabs;
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );



//add hook to redirect the user back to the elementor login page if the login failed
add_action( 'wp_login_failed', 'techvertu_elementor_form_login_fail' );
function techvertu_elementor_form_login_fail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
        wp_redirect(preg_replace('/\?.*/', '', $referrer) . '/?login=failed' );
        exit;
    }
}

/**
 * Exclude products from a particular category on the shop page
 */
function techvertu_pre_get_posts_query( $q ) {
    if(is_shop()){
        $terms = array( '51', '21', '55', '57', '53', '78' );
        $field = 'id';
    }
    else{
        $parent_id = get_queried_object_id();
        $subcats = woocommerce_get_product_subcategories( $parent_id );
        if ( empty( $subcats ) ) return;
        foreach($subcats as $cat){
            // if(str_contains($cat->slug, 'used-and-refurbished' )){
            //     $subcatRemoved[] = $cat; 
            // }
            // else{
            //     $subcatRemoved[] = ''; 
            // }
            $subcatRemoved[] = ''; 
        }
        $terms = array_column( $subcatRemoved, 'slug' );
        $field = 'slug';
    }
    $tax_query[] = array(
        'taxonomy' => 'product_cat',
        'field' => $field,
        'terms' => $terms,
        'operator' => 'NOT IN'
    );
        
    $q->set( 'tax_query', $tax_query, true );

}
add_action( 'woocommerce_product_query', 'techvertu_pre_get_posts_query' ); 


add_filter( 'woocommerce_breadcrumb_defaults', 'wps_breadcrumb_delimiter' );
function wps_breadcrumb_delimiter( $defaults ) {
  $defaults['delimiter'] = ' / ';
  return $defaults;
}



/**
 * Add page attributes to post
 */
function techvertu_add_post_attributes()
{
    add_post_type_support('post', 'page-attributes');
}
add_action('init', 'techvertu_add_post_attributes', 500);

/**
 * Add the menu_order property to the post object being saved
 *
 * @param \WP_Post|\stdClass $post
 * @param WP_REST_Request $request
 *
 * @return \WP_Post
 */
function techvertu_pre_insert_post($post, \WP_REST_Request $request)
{
    $body = $request->get_body();
    if ($body) {
        $body = json_decode($body);
        if (isset($body->menu_order)) {
            $post->menu_order = $body->menu_order;
        }
    }

    return $post;
}
add_filter('rest_pre_insert_post', 'techvertu_pre_insert_post', 12, 2);


/**
 * Load the menu_order property for frontend display in the admin
 *
 * @param \WP_REST_Response $response
 * @param \WP_Post $post
 * @param \WP_REST_Request $request
 *
 * @return \WP_REST_Response
 */
function techvertu_prepare_post(\WP_REST_Response $response, $post, $request)
{
    $response->data['menu_order'] = $post->menu_order;

    return $response;
}
add_filter('rest_prepare_post', 'techvertu_prepare_post', 12, 3);