<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<article class="order-item clearfix">
   <ul>
       <li>
	       	<h3>
	       		<?php 
	       		$is_visible        = $product && $product->is_visible();
	       		$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

				echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible );?>
	       </h3>
	   </li>
	   <li class="quantity">
	   		<?php 
	   		echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item->get_quantity() ) . '</strong>', $item );?>
	   </li>
       <li>
           <?php

			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

			wc_display_item_meta( $item );

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
		?>
       </li>
       <li>
       		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
       </li>
   		<?php if ( $show_purchase_note && $purchase_note ) : ?>
			<li>
				<?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
			</li>
		<?php endif; ?>
   </ul>
</article>

