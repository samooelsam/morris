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
class techvertuVacancy extends Widget_Base
{

	public function get_name()
	{
		return 'techvertuVacancy';
	}
	public function get_style_depends()
	{
		return array('TechvertuWidget');
	}
	public function get_title()
	{
		return __('Techvertu vacancies', 'elementor');
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
			'years',
			[
				'label' => esc_html__('years of experience', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('List Title', 'plugin-name'),
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'type',
			[
				'label' => esc_html__('contract type', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('full time', 'plugin-name'),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'salary',
			[
				'label' => esc_html__('salary', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('negotiable salary', 'plugin-name'),
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'contract_type',
			[
				'label' => esc_html__('contract duration', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('negotiable salary', 'plugin-name'),
				'label_block' => true,
			]
		);
        

		$repeater->add_control(
			'website_link',
			[
				'label' => esc_html__('page link', 'plugin-name'),
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
			'linkedin',
			[
				'label' => esc_html__('linkedin page', 'plugin-name'),
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
			'image',
			array(
				'label'   => __('no item', 'elementor-customwidget'),
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
            <div class="techvertu-vacancies clearfix">
                <?php 
                if($settings['list']) {
                    foreach ($settings['list'] as $item) { ?>
                        <article class="vacancy-item clearfix">
                            <figure class="image-wrapper">
                                <a href="<?php echo($item['website_link']['url']);?>">
                                    <h3><?php echo($item['list_title']);?></h3>
                                </a>
                            </figure>
                            <div class="vacancy-content clearfix">
                                <ul>
                                    <?php if($item['years']) {?>
                                    <li>
                                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="11" height="11" fill="#008EAA"/>
                                        </svg>

                                        <?php echo($item['years']);?>
                                    </li>
                                    <?php }
                                    if($item['type']) {?>
                                    <li>
                                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="11" height="11" fill="#008EAA"/>
                                        </svg>
                                        <?php echo($item['type']);?>
                                    </li>
                                    <?php }
                                    if($item['salary']) {?>
                                    <li>
                                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="11" height="11" fill="#008EAA"/>
                                        </svg>
                                        <?php echo($item['salary']);?>
                                    </li>
                                    <?php }
                                    if($item['contract_type']) {?>
                                    <li>
                                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="11" height="11" fill="#008EAA"/>
                                        </svg>
                                        <?php echo($item['contract_type']);?>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                            <div class="vacancy-footer clearfix">
                                <a class="apply-btn" href="<?php echo($item['website_link']['url']);?>"><?php _e('Apply now', 'morris');?></a>
                            </div>
                        </article>
                    <?php }
                } else { ?>
                    <figure class="image-wrapper no-item clearfix">
                        <img src="<?php echo($settings['image']['url']);?>" />
                    </figure>
                <?php }
                if($settings['linkedin']['url']) {?>
                <article class="vacancy-item linkedin clearfix">
                    <figure class="image-wrapper">
                        <a href="<?php echo($settings['linkedin']['url']);?>">
                            <svg width="61" height="61" viewBox="0 0 61 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.6629 20.2499H1.00659V61H13.6629V20.2499Z" fill="#007EBB"/>
                                <path d="M7.33662 0C11.384 0 14.6635 3.29127 14.6635 7.33892C14.6635 11.3866 11.384 14.6885 7.33662 14.6885C3.28927 14.6885 0 11.3925 0 7.33892C0 3.28531 3.27895 0 7.33662 0Z" fill="#007EBB"/>
                                <path d="M21.5919 20.2499H33.7136V25.8238H33.8793C35.5696 22.6168 39.6916 19.2409 45.846 19.2409C58.6404 19.2409 60.9997 27.675 60.9997 38.6502V61H48.3715V41.1882C48.3715 36.4587 48.2793 30.3816 41.8036 30.3816C35.3279 30.3816 34.2222 35.529 34.2222 40.8426V60.9997H21.5919V20.2499Z" fill="#007EBB"/>
                            </svg>
                        </a>
                    </figure>
                    <div class="vacancy-content clearfix">
                        <h3><?php _e('Find us on linkedin', 'morris');?></h3>
                        <p>@MorrisMachinery</p>
                    </div>
                    <div class="vacancy-footer clearfix">
                        <a href="<?php echo($settings['linkedin']['url']);?>" class="apply-btn" href=""><?php _e('Follow us', 'morris');?></a>
                    </div>
                </article>
                <?php }?>
            </div>
		<?php 
	}

	protected function _content_template()
	{
		?>
            <div class="techvertu-vacancies clearfix">
                 <# _.each( settings.list, function( item ) { #>
                    <article class="vacancy-item clearfix">
                        <figure class="image-wrapper">
							<a href="{{item.website_link.url}}">
                                <h3>{{item.list_title}}</h3>
				 			</a>
                        </figure>
                        <div class="vacancy-content clearfix">
                            <ul>
                                <li>{{item.years}}</li>
                                <li>{{item.type}}</li>
                                <li>{{item.salary}}</li>
                                <li>{{item.contract_type}}</li>
                            </ul>
                        </div>
                        <a href="{{item.website_link.url}}">Apply now'</a>
                    </article>
                 <# }); #>
                 <article class="vacancy-item linkedin clearfix">
                    <figure class="image-wrapper">
                        <a href="">
                            <svg width="61" height="61" viewBox="0 0 61 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.6629 20.2499H1.00659V61H13.6629V20.2499Z" fill="#007EBB"/>
                                <path d="M7.33662 0C11.384 0 14.6635 3.29127 14.6635 7.33892C14.6635 11.3866 11.384 14.6885 7.33662 14.6885C3.28927 14.6885 0 11.3925 0 7.33892C0 3.28531 3.27895 0 7.33662 0Z" fill="#007EBB"/>
                                <path d="M21.5919 20.2499H33.7136V25.8238H33.8793C35.5696 22.6168 39.6916 19.2409 45.846 19.2409C58.6404 19.2409 60.9997 27.675 60.9997 38.6502V61H48.3715V41.1882C48.3715 36.4587 48.2793 30.3816 41.8036 30.3816C35.3279 30.3816 34.2222 35.529 34.2222 40.8426V60.9997H21.5919V20.2499Z" fill="#007EBB"/>
                            </svg>
                        </a>
                    </figure>
                    <div class="vacancy-content clearfix">
                        <h3><?php _e('Find us on linkedin', 'morris');?></h3>
                        <p>@MorrisMachinery</p>
                    </div>
                    <div class="vacancy-footer clearfix">
                        <a class="apply-btn" href=""><?php _e('Follow us', 'morris');?></a>
                    </div>
                </article>
            </div>
		<?php 
	}
}
