<?php 
$message = __( 'Looks like we have nothing available currently, but please keep checking or give us a call and let us know what you are looking for on', 'morris' );
?>
<div class="no-news-wrapper clearfix">
    <div class="techvertu-no-product clearfix">
        <div class="centerize clearfix">
            <figure class="image-wrapper clearfix">
                <img src="<?php echo(bloginfo('template_directory'));?>/img/no-product.svg" />
            </figure>
            <div class="techvertu-no-product-content clearfix">
                <h3>OH NO!</h3>
                <p><?php echo($message);?> <a href="tel:01902790824"><strong><u>01902 790824</u></strong></a></p>
                <a class="go-back" href="<?php echo(home_url('/all-products/new-products/'));?>"><i class="left-arrow"></i><?php _e('continue shopping', 'morris');?></a>
            </div>
        </div>
    </div>
</div>