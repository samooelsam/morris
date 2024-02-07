<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details order-box cart-box clearfix">
<div class="order-item-wrapper clearfix">
	<?php if ( $show_shipping ) : ?>
		<header class="your-address-header clearfix">
            <h3><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h3>
        </header>
		<section class="order-item-holder clearfix">
			<?php endif; ?>
			<article class="address-item clearfix">
	            <div class="address-top clearfix">
	                <div class="address-content clearfix">
	                    <h3><label for="address-2">My Address</label></h3>
	                    <ul>
	                        <li>
	                        	<?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>
								<?php if ( $order->get_billing_phone() ) : ?>
									<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
								<?php endif; ?>
								<?php if ( $order->get_billing_email() ) : ?>
									<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
								<?php endif; ?>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </article>
	        <?php if ( $show_shipping ) : ?>
			<article class="address-item clearfix">
	            <div class="address-top clearfix">
	                <div class="address-content clearfix">
	                    <h3><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h3>
	                    <ul>
	                        <li>
	                        	<?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </article>

		<?php endif; ?>

		</section><!-- /.col2-set -->
	

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</div>

</section>
