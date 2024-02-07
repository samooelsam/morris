<?php

/**
 * Elementor_Awesomesauce class.
 *
 * @category   Class
 * @package    Techvertu
 * @subpackage WordPress
 * @author     Saman Tohidian <info@uikar.com>
 * @copyright  2020 Saman tohidian
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.uikar.com/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.3.9
 */

namespace TechvertuCustomWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Awesomesauce widget class.
 *
 * @since 1.0.0
 */
class techvertuTechSheets extends Widget_Base
{

	public function get_name()
	{
		return 'techvertuTechSheets';
	}
	public function get_style_depends()
	{
		return array('TechvertuWidget');
	}
	public function get_title()
	{
		return __('Techvertu tech sheets', 'elementor');
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'plugin-name'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			array(
				'label'   => __('Title', 'elementor-custombutton'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Title', 'elementor-custombutton'),
			)
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		
		if ($settings) {
			$perPage = 16;
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$queryArgs = array(
				'post_type' => array( 'product' ),
				'paged' => $paged,		
				'meta_key' => 'tech_sheet',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'tech_sheet',
						'value' => array(''),
						'compare' => 'NOT IN',
					),
				),
				'posts_per_page' => $perPage,
			);
			?>
			
			<div class="techvertu-news-wrapper techsheets clearfix">
				<div class="centerize clearfix">
					
					<div class="techvertu-news-container clearfix swiper-container">
						<section class="techvertu-post-wrapper clearfix">
							<?php 
							$the_query = new \WP_Query( $queryArgs );
							if ( $the_query->have_posts() ) : 
								while ( $the_query->have_posts() )  : $the_query->the_post();
								$techSheets = get_post_meta(get_the_ID(), 'tech_sheet', true);
								$menuOrder = get_post_field('menu_order', get_the_ID());
								$techSheetBanner = get_post_meta(get_the_ID(), 'tech_sheet_banner', true);
								?>
									<article class="techvertu-item-news grid_3 clearfix">
									<?php if($techSheetBanner) {
													$bannerImage = $techSheetBanner;
												}
												else{
													$bannerImage = TECHVERTU_ELEMENTOR_URL.'/assets/images/default-news.jpg';
												}?>
											<figure class="image-wrapper claerfix" style="background:url('<?php echo($bannerImage);?>') no-repeat center center;background-size:contain;">
											</figure>
											<div class="techvertu-news-content clearfix">
												<h3><?php the_title();?></h3>
												<a href="<?php echo($techSheets);?>" class="download-techsheet">
													<?php _e('Download', 'morris');?>
													<i class="fi fi-rr-download"></i>
												</a>
											</div>
									</article>
							<?php
							endwhile;
							?>
							</section>
							<div class="pagination clearfix">
								<?php 
								echo paginate_links( array(
									'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
									'total'        => $the_query->max_num_pages,
									'current'      => max( 1, get_query_var( 'paged' ) ),
									'format'       => '?paged=%#%',
									'show_all'     => false,
									'type'         => 'plain',
									'end_size'     => 2,
									'mid_size'     => 1,
									'prev_next'    => true,
									'prev_text'    => sprintf( '<i class="fi fi-rr-angle-small-left"></i> %1$s', __( '', 'text-domain' ) ),
									'next_text'    => sprintf( '%1$s <i class="fi fi-rr-angle-small-right"></i> ', __( '', 'text-domain' ) ),
									'add_args'     => false,
									'add_fragment' => '',
								) );
								?>
							</div>
							<?php 
							endif;
							wp_reset_postdata();?>
						
					</div>
				</div>
			</div>
		<?php
		}
	}

	protected function _content_template()
	{
		?>

<?php
	}
}
