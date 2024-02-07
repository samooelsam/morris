<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$message = __( 'Looks like we have nothing available currently, but please keep checking or give us a call and let us know what you are looking for on', 'woocommerce' );
?>
<div class="techvertu-no-product clearfix">
	<figure class="image-wrapper clearfix">
		<img src="<?php echo(bloginfo('template_directory'));?>/img/no-product.svg" />
	</figure>
	<div class="techvertu-no-product-content clearfix">
		<h3>OH NO!</h3>
		<p><?php echo($message);?> <a href="tel:01902790824">01902 790824</a></p>
		<a class="go-back" href="<?php echo(home_url('/all-products/new-products/'));?>"><i class="left-arrow"></i><?php _e('continue shopping', 'morris');?></a>
	</div>
</div>
