<div class="mencart-wrapper clearfix">
    <?php $cartItemNumber = WC()->cart->get_cart_contents_count();
    if($cartItemNumber > 0) {?>
        <div class="cart-item-holder clearfix">
            <?php 
            // Loop over $cart items
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $product = $cart_item['data'];
                    $product_id = $cart_item['product_id'];
                    $variation_id = $cart_item['variation_id'];
                    $quantity = $cart_item['quantity'];
                    $price = WC()->cart->get_product_price( $product );
                    $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
                    $link = $product->get_permalink( $cart_item );
                    $meta = wc_get_formatted_cart_item_data( $cart_item );
                    // echo($product);
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );
                    $getCartTotal = WC()->cart->get_cart_total();
                    $getCartTotalItems = WC()->cart->get_cart_contents_count();
                    ?>
                    <article class="cart-item clearfix">
                        <a href="<?php echo($link);?>">
                            <figure class="image-wrapper clearfix">
                                <img src="<?php  echo $image[0]; ?>">
                            </figure>
                            <div class="cart-item-content clearfix">
                                <h3><?php echo($product->get_name());?></h3>
                                <span class="cart-item-price"><?php echo($price);?></span>
                                <span class="cart-item-quantity clearfix">
                                    <?php echo($quantity);?>
                                </span>
                            </div>
                        </a>
                    </article>
                    <?php 
                }
            ?>
        </div>
        <div class="cart-sub clearfix">
            <span class="total-price"><?php _e('Cart', 'morris');?> : <?php echo($getCartTotal);?></span>
            <span class="total-items"><?php echo($getCartTotalItems);?> <?php _e('Items', 'morris');?></span>
        </div>
        <div class="cart-buttons-wrapper clearfix">
            <a class="button-colored-btn" href="<?php echo(home_url('/checkout'));?>">
                <?php _e('Complete Order', 'morris');?>
            </a>
            <a class="button-borderd-btn" href="<?php echo(home_url('/cart'));?>">
                <?php _e('Shopping Basket', 'morris'); ?>
            </a>
        </div>
    <?php }
    else {?>
        <p><?php _e('Your card is empty', 'morris');?></p>
    <?php }?>
    
</div>  
