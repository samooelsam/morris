<?php get_header(); ?>
<div id="main" class="row">
	<?php if(!is_single()) {
		 get_template_part('includes/categoryAndWooBanner', 'widget');
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