<?php get_header(); ?>
<div id="main" class="row">
	<?php if(!is_single()) {
		global $wp_query;
		$tax = get_queried_object();
		
			?>
		<figure class="image-wrapper woocommerce-banner clearfix">
			<?php get_template_part('includes/productsCategoryBanner', 'widget');?>
			<figcaption class="image-wrapper clearfix">
				<div class="centerize grid_12 clearfix">
					<h3><?php 
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
					}?></h3>
					<?php 
					get_template_part('includes/taxDescription', 'widget');
					if (class_exists('WooCommerce') && is_woocommerce()) :
		
						woocommerce_breadcrumb(); 
				
					endif;
					?>
					
				</div>
				
			</figcaption>
		</figure>
	<?php 
	}
	if($tax->taxonomy == 'pa_brands'){
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#woocommerce_layered_nav-4').addClass('none');
			});
		</script>
	<?php }?>
	<div id="content" class="woocommerce-wrapper clearfix grid_12 clearfix centerize">
	    <?php 
			woocommerce_content(); 
		?>
	</div>
</div>
<?php get_footer(); ?>