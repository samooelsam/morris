<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
global $product;
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<div class="product-wrapper clearfix">
        <div class="product-top clearfix">
		<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
			<div class="product-description clearfix">
				<div class="product-buy clearfix woocommerce">
					<?php do_action( 'woocommerce_single_product_summary' );?>
					
				</div><!-- end of product-buy -->
	        </div><!-- end of product-description -->
	        
		</div>
		<?php $tech_sheet = get_post_meta(get_the_ID(), 'tech_sheet', true);
		$sparePart = get_post_meta(get_the_ID(), 'sparePart', true);?>
		<?php if ( '' === $product->get_price() || 0 == $product->get_price() || ! $product->is_in_stock() ) { ?>
			<div class="techvertu-product-buttons clearfix">
				<a href="<?php echo(home_url('enquire-today'));?>?prID=<?php echo(get_the_ID());?>" class="inquiry-btns main"><?php _e('Enquire TODAY', 'morris');?></a>
				<?php if($tech_sheet) {?>
					<a href="<?php echo($tech_sheet);?>" class="inquiry-btns green"><?php _e('Download tech sheet', 'morris');?></a>
				<?php } 
				if($sparePart) {?>
					<a href="<?php echo($sparePart);?>" class="inquiry-btns orange"><?php _e('Buy Spare Parts', 'morris');?></a>
				<?php } ?>
			</div>
		<?php  }?>
		

	
		<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			the_content();
		?>

	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
