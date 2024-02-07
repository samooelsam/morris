<?php 
$defualtImageAddress = get_template_directory_uri() .'/img/SHOP_HEADER.jpg';
if (function_exists('z_taxonomy_image_url')) {
    $brandBanner = z_taxonomy_image_url();
}
if( is_product_category() ) {
    $tax = get_queried_object();
    $taxImageID  = (int) get_woocommerce_term_meta( $tax->term_id, 'thumbnail_id', true );
    
    if( $taxImageID > 0 ) {
        $taxImageSrc  = wp_get_attachment_url( $taxImageID );
    }
    else{
        $taxImageSrc = $defualtImageAddress;
        
    }
}
else{
    if ($brandBanner) {
        $taxImageSrc = $brandBanner;
    }
    else{
        $taxImageSrc = $defualtImageAddress;
    }
}

?>

<img src="<?php echo($taxImageSrc);?>" />