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
class techvertuNews extends Widget_Base
{

	public function get_name()
	{
		return 'techvertuNews';
	}
	public function get_style_depends()
	{
		return array('TechvertuWidget');
	}
	public function get_title()
	{
		return __('Techvertu News', 'elementor');
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
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			if(isset($_POST['submitFilter'])) {
				$archiveDate = sanitize_text_field($_REQUEST['archiveDate']);
				$category = sanitize_text_field($_REQUEST['category']);
				$archvieDateSeperate = explode('-', $archiveDate);
				$archiveDateYear = $archvieDateSeperate[0];
				$archiveDateMonth = $archvieDateSeperate[1];
				$sort = sanitize_text_field($_REQUEST['sort']);
				$sortSeperate = explode('-', $sort);
				$sortType = $sortSeperate[0];
				$sortDate = $sortSeperate[1];
				
				if ($category && $archiveDate == '-'){
					$queryArgs = array(
						'cat' => $category,
						'post_type' => array( 'post' ),
						'orderby' => $sortType,
       					'order' => $sortDate,
						'paged' => $paged,
					);
					
				}
				else if($category == '-' && $archiveDate){
					$queryArgs = array(
						'post_type' => array( 'post' ),
						'orderby' => $sortType,
       					'order' => $sortDate,
						   'date_query' => array(
							array('year' => $archiveDateYear),
							array('month' => $archiveDateMonth),
						),
						'paged' => $paged,
					);
					
				}
				else{
					$queryArgs = array(
						'cat' => $category,
						'post_type' => array( 'post' ),
						'orderby' => $sortType,
       					'order' => $sortDate,
						   'date_query' => array(
							array('year' => $archiveDateYear),
							array('month' => $archiveDateMonth),
						),
						'paged' => $paged,
					);
					
				}
			}
			else{
				$queryArgs = array(
					'post_type' => array( 'post' ),
					'paged' => $paged,
					'orderby' => 'menu_order', 
    				'order' => 'DESC', 
				);
			}?>
			<div class="techvertu-news-wrapper clearfix">
				<div class="centerize clearfix">
					<div class="techvertu-news-header clearfix">
						<form method="POST" id="post-filter">
							<ul>
								<li>
									<label><?php _e('Archive', 'morris');?></label>
									<select name='archiveDate'>
										<option value="-">ALL</option>
										<?php 
										for($year= 2023; $year<=date('Y'); $year++){
											for ( $month = 1; $month <= 12; $month ++ ) { 
												$selectDate = $year .'-'. $month;
												if($selectDate == $archiveDate){
													$selectedAttr = 'selected';
												}
												else{
													$selectedAttr = '';
												}
												print '<option '.$selectedAttr.' value="'.$year .'-'. $month . '">'.$year.' ' . date( 'F', strtotime( "$month/12/10" ) ) . '</option>'; 
											}
										}
										?>
									</select>
								</li>
								<li>
									<label><?php _e('Category', 'morris');?></label>
									<select name='category'>
										<option value="-">ALL</option>
										<?php 
										$args = array(
											'hide_empty'      => false,
										);
										$allCats = get_categories($args);
										foreach($allCats as $cat) {
											if($category == $cat->cat_ID) {
												$selected = 'selected';
											} else {
												$selected = '';
											}?>
											<option <?php echo($selected);?> value="<?php echo($cat->cat_ID);?>"><?php echo($cat->cat_name)?></option>
										<?php }?>
									</select>
								</li>
								<li>
									<label><?php _e('Sort by', 'morris');?></label>
									<select name='sort'>
										<?php 
										echo($sort);
										if($sort == 'date-ASC') {
											$selectedASC = 'selected';
											$selectedDESC = '';
										} else {
											$selectedASC = '';
											$selectedDESC = 'selected';
										}
										?>
										<option <?php echo($selectedASC);?> value="date-ASC">Date - accending</option>
										<option <?php echo($selectedDESC);?> value="date-DESC">Date - decending</option>
									</select>
								</li>
								<li>
									<button type="submit" name="submitFilter"><?php _e('Filter', 'morris');?></button>
								</li>
								<li>
									<time class="datetime" datetime=""><?php echo date ('l, F d, Y'); ?></time>
								</li>
								
							</ul>
						</form>
					</div>
					<div class="techvertu-news-container clearfix swiper-container">
						<section class="techvertu-post-wrapper clearfix">
							<?php 
							$the_query = new \WP_Query( $queryArgs );
							if ( $the_query->have_posts() ) : 
								while ( $the_query->have_posts() )  : $the_query->the_post();
								$cats = get_the_category();?>
									<article class="techvertu-item-news grid_4 clearfix">
										<a href="<?php the_permalink();?>">
											<figure class="image-wrapper claerfix">
												<?php if(has_post_thumbnail()) {
													the_post_thumbnail('news-size-thumbnail');
												}
												else{
													?>
													<img src="<?php echo(TECHVERTU_ELEMENTOR_URL.'/assets/images/default-news.jpg');?>" />
													<?php 
												}?>
												<figcaption class="overlay-content clearfix">
													<div class="post-meta-data clearfix">
														
														<span class="category">
															<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
																<g clip-path="url(#clip0_616_5413)">
																	<path d="M4.1791 0.686554H2.38806C1.75471 0.686554 1.14729 0.938152 0.699447 1.386C0.251598 1.83385 0 2.44126 0 3.07461L0 4.86566C0 5.49901 0.251598 6.10642 0.699447 6.55427C1.14729 7.00212 1.75471 7.25372 2.38806 7.25372H4.1791C4.81246 7.25372 5.41987 7.00212 5.86772 6.55427C6.31557 6.10642 6.56716 5.49901 6.56716 4.86566V3.07461C6.56716 2.44126 6.31557 1.83385 5.86772 1.386C5.41987 0.938152 4.81246 0.686554 4.1791 0.686554V0.686554ZM5.37313 4.86566C5.37313 5.18233 5.24734 5.48604 5.02341 5.70997C4.79949 5.93389 4.49578 6.05969 4.1791 6.05969H2.38806C2.07138 6.05969 1.76768 5.93389 1.54375 5.70997C1.31983 5.48604 1.19403 5.18233 1.19403 4.86566V3.07461C1.19403 2.75794 1.31983 2.45423 1.54375 2.23031C1.76768 2.00638 2.07138 1.88058 2.38806 1.88058H4.1791C4.49578 1.88058 4.79949 2.00638 5.02341 2.23031C5.24734 2.45423 5.37313 2.75794 5.37313 3.07461V4.86566Z" fill="#008EAA"/>
																	<path d="M11.9402 0.686554H10.1492C9.51581 0.686554 8.9084 0.938153 8.46055 1.386C8.01271 1.83385 7.76111 2.44126 7.76111 3.07462V4.86566C7.76111 5.49901 8.01271 6.10643 8.46055 6.55428C8.9084 7.00212 9.51581 7.25372 10.1492 7.25372H11.9402C12.5736 7.25372 13.181 7.00212 13.6288 6.55428C14.0767 6.10643 14.3283 5.49901 14.3283 4.86566V3.07462C14.3283 2.44126 14.0767 1.83385 13.6288 1.386C13.181 0.938153 12.5736 0.686554 11.9402 0.686554V0.686554ZM13.1342 4.86566C13.1342 5.18234 13.0084 5.48604 12.7845 5.70997C12.5606 5.93389 12.2569 6.05969 11.9402 6.05969H10.1492C9.83249 6.05969 9.52878 5.93389 9.30486 5.70997C9.08094 5.48604 8.95514 5.18234 8.95514 4.86566V3.07462C8.95514 2.75794 9.08094 2.45423 9.30486 2.23031C9.52878 2.00638 9.83249 1.88058 10.1492 1.88058H11.9402C12.2569 1.88058 12.5606 2.00638 12.7845 2.23031C13.0084 2.45423 13.1342 2.75794 13.1342 3.07462V4.86566Z" fill="#008EAA"/>
																	<path d="M4.1791 8.44775H2.38806C1.75471 8.44775 1.14729 8.69935 0.699447 9.1472C0.251598 9.59505 0 10.2025 0 10.8358L0 12.6269C0 13.2602 0.251598 13.8676 0.699447 14.3155C1.14729 14.7633 1.75471 15.0149 2.38806 15.0149H4.1791C4.81246 15.0149 5.41987 14.7633 5.86772 14.3155C6.31557 13.8676 6.56716 13.2602 6.56716 12.6269V10.8358C6.56716 10.2025 6.31557 9.59505 5.86772 9.1472C5.41987 8.69935 4.81246 8.44775 4.1791 8.44775ZM5.37313 12.6269C5.37313 12.9435 5.24734 13.2472 5.02341 13.4712C4.79949 13.6951 4.49578 13.8209 4.1791 13.8209H2.38806C2.07138 13.8209 1.76768 13.6951 1.54375 13.4712C1.31983 13.2472 1.19403 12.9435 1.19403 12.6269V10.8358C1.19403 10.5191 1.31983 10.2154 1.54375 9.99151C1.76768 9.76759 2.07138 9.64179 2.38806 9.64179H4.1791C4.49578 9.64179 4.79949 9.76759 5.02341 9.99151C5.24734 10.2154 5.37313 10.5191 5.37313 10.8358V12.6269Z" fill="#008EAA"/>
																	<path d="M11.9402 8.44775H10.1492C9.51581 8.44775 8.9084 8.69935 8.46055 9.1472C8.01271 9.59505 7.76111 10.2025 7.76111 10.8358V12.6269C7.76111 13.2602 8.01271 13.8676 8.46055 14.3155C8.9084 14.7633 9.51581 15.0149 10.1492 15.0149H11.9402C12.5736 15.0149 13.181 14.7633 13.6288 14.3155C14.0767 13.8676 14.3283 13.2602 14.3283 12.6269V10.8358C14.3283 10.2025 14.0767 9.59505 13.6288 9.1472C13.181 8.69935 12.5736 8.44775 11.9402 8.44775ZM13.1342 12.6269C13.1342 12.9435 13.0084 13.2472 12.7845 13.4712C12.5606 13.6951 12.2569 13.8209 11.9402 13.8209H10.1492C9.83249 13.8209 9.52878 13.6951 9.30486 13.4712C9.08094 13.2472 8.95514 12.9435 8.95514 12.6269V10.8358C8.95514 10.5191 9.08094 10.2154 9.30486 9.99151C9.52878 9.76759 9.83249 9.64179 10.1492 9.64179H11.9402C12.2569 9.64179 12.5606 9.76759 12.7845 9.99151C13.0084 10.2154 13.1342 10.5191 13.1342 10.8358V12.6269Z" fill="#008EAA"/>
																	</g>
																	<defs>
																	<clipPath id="clip0_616_5413">
																	<rect width="14.3284" height="14.3284" fill="white" transform="translate(0 0.686554)"/>
																	</clipPath>
																	</defs>
																</svg>

															<?php echo($cats[0]->cat_name);?>
														</span>
													</div>	
												</figcaption>
											</figure>
											<div class="techvertu-news-content clearfix">
												<h3><?php the_title();?></h3>
												<div class="cpt-text"><?php the_excerpt();?></div>
											</div>
										</a>
										<a href="" class="read-more"><?php _e('Read More', 'morris');?>
											<i class="fi fi-rr-arrow-small-right"></i>
										</a>
									</article>
									
							<?php
							endwhile;
							?>
							</section>
							<div class="pagination clearfix">
								<?php 
								$paginateArgs = array(
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
								);
								echo paginate_links( $paginateArgs );
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
