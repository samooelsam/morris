<?php
/**
 * The template for displaying 404 pages.
 *
 * @package Morris WordPress theme
 */

// Get ID.


	get_header();

?>

	<div class="techvertu-404-page clearfix">
		<div class="centerize clearfix grid_12">
			<h1><?php _e('Looks like you are lost!', 'morris');?></h1>
			<a href="<?php echo(home_url('/'));?>" class="back-to-home"><i class="fi fi-rr-arrow-small-left"></i><?php _e('BACK TO HOME', 'morris');?></a>
		</div>
	</div>
	<?php

	get_footer();


?>
