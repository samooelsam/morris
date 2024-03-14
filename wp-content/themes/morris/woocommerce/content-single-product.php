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
		$productCategory = get_the_terms( get_the_ID(), 'product_cat' );
		foreach($productCategory as $cat){
			if($cat->term_id == '95'){
				?>
				<div class="finance-leasing-box clearfix">
					<i>
						<svg width="38" height="54" viewBox="0 0 38 54" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M27.4556 37.8445L29.8728 33.8375L34.2349 32.3177L34.7181 27.6373L38 24.3367L36.4396 19.9064L38 15.476L34.7182 12.1753L34.235 7.49503L29.8729 5.97523L27.4557 1.96815L22.8838 2.53209L19 0L15.1162 2.5323L10.5444 1.96836L8.12722 5.97533L3.76515 7.49514L3.28188 12.1754L0 15.4761L1.56036 19.9065L0 24.3369L3.28178 27.6375L3.76504 32.3178L8.12712 33.8376L10.5443 37.8446L15.1162 37.2808L19 39.813L22.8838 37.2808L27.4556 37.8445ZM5.63781 19.9065C5.63781 12.3795 11.6321 6.25577 19 6.25577C26.3679 6.25577 32.3622 12.3795 32.3622 19.9065C32.3622 27.4335 26.3679 33.5572 19 33.5572C11.6321 33.5572 5.63781 27.4335 5.63781 19.9065Z" fill="#008EAA"/>
							<path d="M19 9.42184C13.3409 9.42184 8.73696 14.1252 8.73696 19.9065C8.73696 25.6878 13.3409 30.3911 19 30.3911C24.6591 30.3911 29.263 25.6878 29.263 19.9065C29.263 14.1252 24.6591 9.42184 19 9.42184Z" fill="#008EAA"/>
							<path d="M14.3851 40.5599L8.94643 41.2307L6.07296 36.467L5.09611 36.1267L0.882596 49.581L8.46812 49.1548L14.4028 54L17.8952 42.8486L14.3851 40.5599Z" fill="#008EAA"/>
							<path d="M31.927 36.4671L29.0535 41.2307L23.6149 40.5599L20.1048 42.8486L23.5972 54L29.5319 49.1548L37.1174 49.581L32.9039 36.1267L31.927 36.4671Z" fill="#008EAA"/>
						</svg>
					</i>
					<p>Finance/Leasing options available!</p>
				</div>
				<?php 
			}
		}
		?>
		
		

	
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
