<?php

/**
 * Elementor_Awesomesauce class.
 *
 * @category   Class
 * @package    NextoneCustomItems
 * @subpackage WordPress
 * @author     Saman Tohidian <info@uikar.com>
 * @copyright  2020 Saman tohidian
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.uikar.com/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.3.9
 */

namespace RobolodgeCustomWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Awesomesauce widget class.
 *
 * @since 1.0.0
 */
class roboSingleNews extends Widget_Base
{

	public function get_name()
	{
		return 'roboSingleNews';
	}
	public function get_style_depends()
	{
		return array('RobolodgeOurMissionWidget');
	}
	public function get_title()
	{
		return __('Robolodge Single News', 'elementor');
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
        $allPosts = get_posts();
        foreach ($allPosts as $key => $value) {
            $caseOptions[$value->ID] =  $value->post_title;
        }
        $this->add_control(
            'show_elements',
            [
                'label' => esc_html__( 'Show Elements', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $caseOptions,
                'default' => [ 'title' ],
            ]
        );

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if ($settings) {?>
			
            <section class="single-news-wrapper clearfix">
                
                <?php 
                
                $args = array(
                    'post_type' => 'post',
                    'showposts' => 1,
                    'post__in' => $settings['show_elements']
                );
                $the_query = new \WP_Query( $args );
                if ( $the_query->have_posts() ) : 
                    while ( $the_query->have_posts() )  : $the_query->the_post();
                        $post_categories = wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) );
                        ?>
                        <article class="robo-single-news-item clearfix">
                            <a href="<?php the_permalink();?>">
                                <figure class="image-wrapper claerfix">
                                    <?php if(has_post_thumbnail()) {
                                        the_post_thumbnail('news-single-size-thumbnail');
                                    }?>
                                </figure>
                                <div class="single-news-content clearfix">
                                    <div class="post-meta clearfix">
                                        <span class="category-hodler">
                                            <?php 
                                            if( $post_categories ){ // Always Check before loop!
                                                foreach($post_categories as $name){
                                                    echo $name.', ';
                                                }
                                            }
                                            ?>
                                        </span>
                                        <time class="datetime"><?php echo get_the_date('l F j, Y');?></time>
                                    </div>
                                    <h3><?php the_title();?></h3>
                                    <div class="cpt-text"><?php // the_excerpt();?></div>
                                </div>
                            </a>
                        </article>
                <?php endwhile;
                endif;
                wp_reset_postdata();?>
            </section>
						
		<?php
		}
	}

	protected function _content_template()
	{
		?>

<?php
	}
}
