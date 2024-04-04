<?php 
global $wp_query;
$tax = get_queried_object();

    ?>
<figure class="image-wrapper woocommerce-banner clearfix">
    <?php get_template_part('includes/productsCategoryBanner', 'widget');?>
    <figcaption class="image-wrapper clearfix">
        <div class="centerize grid_12 clearfix">
            <h1><?php 
            if( is_product_category() ) {
                $thisPage = $wp_query->get_queried_object()->name;
                
                echo($thisPage);
            }
            else if($tax){
                echo($tax->name);
            }
            else{
                $thisPage = get_post(wc_get_page_id( 'shop' ));
                
                echo($thisPage->post_name);
            }?></h1>
            <?php 
            get_template_part('includes/taxDescription', 'widget');
            if (class_exists('WooCommerce') && is_woocommerce()) :

                woocommerce_breadcrumb(); 
        
            endif;
            ?>
            
        </div>
        
    </figcaption>
</figure>