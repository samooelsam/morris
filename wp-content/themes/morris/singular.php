<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * This is a new template file that WordPress introduced in
 * version 4.3.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>
<div class="single-page-wrapper clearfix">
	<div class="centerize grid_12 clearfix">
		<?php
			// Elementor `single` location.
			if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

				// Start loop.
				while ( have_posts() ) :
					?>
					<figure class="image-wrapper clearfix">
						<?php if(has_post_thumbnail()) {
							the_post_thumbnail('news-big-thumbnail');
						}?>
					</figure>
					<h3><?php the_title();?></h3>
					<?php 
					the_post();

					the_content();

				endwhile;

			}
			?>
	</div>
</div>

<?php get_footer(); ?>
