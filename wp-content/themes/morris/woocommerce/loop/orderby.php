<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="filter-wrapper clearfix">
	<form class="woocommerce-ordering" method="get">
		<nav class="view-tools clearfix">
			<ul class="sort">
				<li>
					<label><?php _e('Sort by :', 'morris');?></label>
					<select name="orderby" class="orderby">
						<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
							<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
						<?php endforeach; ?>
					</select>
					<input type="hidden" name="paged" value="1" />
					<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
				</li>
			</ul>
	        <!-- <ul class="change-view">
	            <li class="selected"><a href="" class="view"><i class="fi fi-rr-apps"></i></a></li>
	            <li>
					<a href="" class="list">
						<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="1" y="1.00012" width="19" height="7.625" rx="3" stroke="#C4BEBE" stroke-width="2"/>
							<rect x="1" y="12.3751" width="19" height="7.625" rx="3" stroke="#C4BEBE" stroke-width="2"/>
						</svg>

					</a>
				</li>
	        </ul> -->
	    </nav>
		<p><?php 
	            	global $wp_query;
					echo $wp_query->found_posts.' results found.';
	            	?></p>
	   
	</form>
</div>
