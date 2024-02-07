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
class navigateToSection extends Widget_Base
{

	public function get_name()
	{
		return 'navigateToSection';
	}
	public function get_style_depends()
	{
		return array('TechvertuWidget');
	}
	public function get_title()
	{
		return __('Techvertu navigate to section', 'elementor');
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
            <div class="techvertu-navigate-to-section clearfix">
                <ul>
                <?php foreach ($settings['list'] as $item) { ?>
                    <li>
                        <a href="<?php echo($item['website_link']['url']);?>"><?php echo($item['list_title']);?></a>
                    </li>    
                <?php }?>
                </ul>
            </div>
		<?php 
	}

	protected function _content_template()
	{
		?>
            <div class="techvertu-navigate-to-section clearfix">
                <ul>
                <# _.each( settings.list, function( item ) { #>
                    <li>
                        <a href="{{item.website_link.url}}">{{item.list_title}}</a>
                    </li>    
                <# }); #>
                </ul>
            </div>
		<?php 
	}
}
