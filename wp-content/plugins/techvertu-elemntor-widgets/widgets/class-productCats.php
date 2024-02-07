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
class productCats extends Widget_Base
{

	public function get_name()
	{
		return 'productCats';
	}
    
	public function get_style_depends()
	{
		return array('TechvertuWidget');
	}
	public function get_title()
	{
		return __('Techvertu product cats', 'elementor');
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
        
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__('Title', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('List Title', 'plugin-name'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_description',
			[
				'label' => esc_html__('Description', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Default description', 'plugin-name'),
				'placeholder' => esc_html__('Type your description here', 'plugin-name'),
			]
		);

		$repeater->add_control(
			'website_link',
			[
				'label' => esc_html__('Link', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'plugin-name'),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
			]
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __('Choose Image', 'elementor-customwidget'),
				'type'    => Controls_Manager::MEDIA,
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			)
		);
		$this->add_control(
			'list',
			[
				'label' => esc_html__('Repeater List', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__('Title #1', 'plugin-name'),
						'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'plugin-name'),
					],
					[
						'list_title' => esc_html__('Title #2', 'plugin-name'),
						'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'plugin-name'),
					],
					[
						'list_title' => esc_html__('Title #3', 'plugin-name'),
						'list_content' => esc_html__('Item content. Click the edit button to change this text.', 'plugin-name'),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);
        
		



		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		?>
            <div class="techvertu-product-cats">
                <div class="swiper techvertu-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['list'] as $item) { ?>
                            <div class="swiper-slide">
                                <article class="product-cat-item clearfix">
                                    <figure class="image-wrapper">
                                        <a href="<?php echo($item['website_link']['url']);?>">
                                            <img src="<?php echo($item['image']['url']);?>" />
                                        </a>
                                    </figure>
                                    <div class="product-cat-item-content clearfix">
                                        <h3><a href="<?php echo($item['website_link']['url']);?>"><?php echo($item['list_title']);?></a></h3>
                                        <p><?php echo($item['item_description']);?></p>
                                    </div>
                                </article>
                            </div>
                        <?php }?>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
		<?php 
	}

	protected function _content_template()
	{
		?>
            <div class="techvertu-product-cats">
				<div class="swiper techvertu-swiper">
                    <div class="swiper-wrapper">
                 <# _.each( settings.list, function( item ) { #>
					<div class="swiper-slide">
                    <article class="product-cat-item clearfix">
                        <figure class="image-wrapper">
							<a href="{{item.website_link.url}}">
                            	<img src="{{item.image.url}}" />
				 			</a>
                        </figure>
                        <div class="product-cat-item-content clearfix">
                            <h3><a href="{{item.website_link.url}}">{{item.list_title}}</a></h3>
                            <p>{{item.item_description}}</p>
                        </div>
                    </article>
					</div>
                 <# }); #>
				 </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
		<?php 
	}
}
