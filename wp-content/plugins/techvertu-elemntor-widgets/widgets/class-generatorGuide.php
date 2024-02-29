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
class generatorGuide extends Widget_Base
{

	public function get_name()
	{
		return 'generatorGuide';
	}
	public function get_style_depends()
	{
		return array('TechvertuWidget');
	}
	public function get_title()
	{
		return __('Techvertu styled text boxes', 'elementor');
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
			'contact_link',
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
			'contact_title',
			array(
				'label'   => __('Contact Title', 'elementor-custombutton'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Contact Title', 'elementor-custombutton'),
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
            <div class="techvertu-styled-text-box-wrapper clearfix">
                <?php foreach ($settings['list'] as $item) { ?>
                    <article class="styled-text-box-item clearfix">
                        <a href="<?php echo($item['website_link']['url']);?>">
                            <div class="styled-text-box-content clearfix">
                                <h3><?php echo($item['list_title']);?></h3>
                            </div>
                        </a>
                    </article>
                <?php }?>
            </div>
            
			<div class="techvertu-caller-box-info clearfix">
				<div class="column small-col clearfix">
					<div class="cannot-find clearfix">
						<h3>Can't find<br>the answer you need?</h3>
						<footer class="cannot-find-footer clearfix">
							<span>Call our team on</span>
							<a href="tel:<?php echo (str_replace(' ', '', $settings['contact_link']['url']));?>" class="cant-find-call-action clearfix">
								<i class="fi fi-rr-phone-call"></i>
								<?php echo (str_replace(' ', '', $settings['contact_link']['url']));?>
							</a>
						</footer>
					</div>
				</div>
				<div class="column wide-col clearfix">
					<div class="techvertu-video-player clearfix">
						<iframe width="560" height="460" src="https://www.youtube.com/embed/wLAnr6UQVAs?si=Bu495d87Kz9a74th" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		<?php 
	}

	protected function _content_template()
	{
		?>
            <div class="techvertu-styled-text-box-wrapper clearfix">
                 <# _.each( settings.list, function( item ) { #>
                    <article class="styled-text-box-item clearfix">
                        <a href="{{item.website_link.url}}">
                            <div class="styled-text-box-content clearfix">
                                <h3>{{item.list_title}}</h3>
                            </div>
                        </a>
                    </article>
                 <# }); #>
            </div>
			<div class="techvertu-caller-box-info clearfix">
				<div class="column small-col clearfix">
					<div class="cannot-find clearfix">
						<h3>Can't find<br>the answer you need?</h3>
						<footer class="cannot-find-footer clearfix">
							<span>Call our team on</span>
							<a href="tel:{{settings.contact_link.url}}" class="cant-find-call-action clearfix">
								<i class="fi fi-rr-phone-call"></i>
								{{settings.contact_link.url}}
							</a>
						</footer>
					</div>
				</div>
				<div class="column wide-col clearfix">
					<div class="techvertu-video-player clearfix">
					<iframe width="560" height="460" src="https://www.youtube.com/embed/wLAnr6UQVAs?si=Bu495d87Kz9a74th" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		<?php 
	}
}
