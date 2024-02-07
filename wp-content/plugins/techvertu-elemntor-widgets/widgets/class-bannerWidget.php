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
class bannerWidget extends Widget_Base
{

	public function get_name()
	{
		return 'bannerWidget';
	}
	public function get_style_depends()
	{
		return array('RobolodgeOurMissionWidget');
	}
	public function get_title()
	{
		return __('Robolodge Banner Widget', 'elementor');
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
        $this->add_control(
			'image',
			array(
				'label'   => __('Choose Image', 'elementor-custombutton'),
				'type'    => Controls_Manager::MEDIA,
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			)
		);
        $this->add_control(
			'item_description',
			[
				'label' => esc_html__('Description', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Default description', 'plugin-name'),
				'placeholder' => esc_html__('Type your description here', 'plugin-name'),
			]
		);
        $this->add_control(
			'button_1_link',
			[
				'label' => esc_html__( 'Button 1', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $this->add_control(
			'button_2_link',
			[
				'label' => esc_html__( 'Button 2', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		



		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		?>
			<div class="robolodge-banner-wrapper clearfix">
                <figure class="image-wrapper clearfix">
                    <img src="<?php echo ($settings['image']['url']); ?>" />
                    <figcaption class="big-banner-caption clearfix">
                        <div class="centerize clearfix">
                            <div class="titles-container clearfix">
                                <h2><?php echo ($settings['title']); ?></h2>
                                <p><?php echo ($settings['item_description']); ?></p>
                            </div>
                            <div class="rb-banner-buttons clearfix">
                                <?php if ( ! empty( $settings['button_1_link']['url'] ) ) {
                                    $this->add_link_attributes( 'button_1_link', $settings['button_1_link'] );?>
                                    <a <?php echo $this->get_render_attribute_string( 'button_1_link' ); ?>>
                                        Explore 3D Store
                                    </a>
                                <?php } 
                                if ( ! empty( $settings['button_2_link']['url'] ) ) { 
                                    $this->add_link_attributes( 'button_2_link', $settings['button_2_link'] );?>
                                    <a <?php echo $this->get_render_attribute_string( 'button_2_link' ); ?> class="shop-btn-link">
                                        Shop Now
                                    </a>
                                <?php }?>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </div>
		<?php 
	}

	protected function _content_template()
	{
		?>
		<div class="robolodge-banner-wrapper clearfix">
                <figure class="image-wrapper clearfix">
                    <img src="{{settings.image.url}}" />
                    <figcaption class="big-banner-caption clearfix">
                        <div class="centerize clearfix">
                            <div class="titles-container clearfix">
                                <h2>{{settings.title}}</h2>
                                <p><{{settings.item_description}}</p>
                            </div>
                            <div class="rb-banner-buttons clearfix">
                            <# if( settings.button_1_link.url) { #>
                                    <a href="{{settings.button_1_link.url}}">
                                       Explore 3D Store
                                    </a>
                               <# } 
                               if( settings.button_2_link.url) {#>
                                    <a href="{{settings.button_2_link.url}}">
                                        Shop Now
                                    </a>
                               <# } #>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </div>
		<?php 
	}
}
