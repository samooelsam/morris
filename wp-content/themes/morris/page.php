<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>

	

	<?php
	// Elementor `single` location.
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

		// Start loop.
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile;

	}
	?>

				

<?php get_footer(); ?>
