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
class enquiryForm extends Widget_Base
{

	public function get_name()
	{
		return 'enquiryForm';
	}
	public function get_style_depends()
	{
		return array('TechvertuFilterWidget');
	}
	public function get_title()
	{
		return __('Techvertu enquiry form', 'elementor');
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
			'website_link',
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
        
		



		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$successFlag = '';
        $productID = $_REQUEST['prID'];
		$product = wc_get_product( $productID );
		$firstName = '';
		$businessName = '';
		$lastName = '';
		$quantity = '1';
		$phonenumber = '';
		$postCode = '';
		$note = '';
		if($product){
			$productTitle = $product->get_title();
			$productSKU = $product->get_sku();
		}
		if($_REQUEST["prQuantity"]){
			$quantity = $_REQUEST["prQuantity"];
		}
		$subject = sanitize_text_field('enquire for '. $productTitle);
        $sku = sanitize_text_field( $_REQUEST['productSKU']);
        
		if($successFlag == '1'){
			$alertMessage = 'Your message has been successfully sent';
			$alertColorClass = 'green';
		} else if($successFlag == '0'){
			$alertMessage = 'Something went wrong, please try again';
			$alertColorClass = 'red';
		}
		else{
			$alertMessage = '';
			$alertColorClass = '';
		}
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $productID ), 'product-thumbnail' );
		
		
			
		?>
	
		<script src="https://www.google.com/recaptcha/api.js?render=<?php echo(SITE_KEY);?>"></script>
        <div class="techvertu-product-info-wrapper clearfix">
            <figure class="product-image-wrapper grid_6 clearfix">
                <img src="<?php echo($image[0]);?>" />
            </figure>
            <div class="techvertu-enquiry-form-wrapper grid_6 clearfix">
                <h1><?php _e('Enquire', 'morris');?> <?php echo($productTitle);?></h1>
                <p></p>
                <div class="techvertu-enquiry-form clearfix">
                    <?php	
                    if($alertMessage) {?>
                        <div class="alert <?php echo($alertColorClass);?>">
                            <p><?php echo($alertMessage);?></p>
                        </div>
                    <?php }?>
					
                    <form action="<?php echo ($_SERVER['REQUEST_URI']); ?>" method="post" id="enquire-form" >
                        <div class="form-sender clearfix">
                            <label><input type="hidden" name="productTitle" id="productTitle" value="<?php echo($productTitle);?>" ></label>
                            <label><input type="hidden" name="productSKU" id="prSKU" value="<?php echo($productSKU);?>" /><span class="sku-changer"><?php _e('SKU', 'morris');?>:<?php echo($productSKU);?></span></label>
                        </div>
						<div class="form-column grid_2 clearfix">
							<input id="prQuantity" type="number" name="prQuantity" value="" placeholder="1" >
						</div>
						<div class="grid_10 link-products form-column clearfix">
							<a href="<?php echo(get_permalink($productID));?>"><i class="fi fi-rr-link-alt"></i><?php _e('Go to product page', 'morris');?></a>
						</div>
                        <div class="form-column grid_12 clearfix">
                            <input type="email" name="senderEmail" id="senderEmail" value="<?php echo($senderEmail);?>" placeholder="Email" >
                        </div>
						<div class="form-column grid_12 clearfix">
                            <input type="text" name="businessName" id="businessName" value="<?php echo($businessName);?>" placeholder="Business Name" >
                        </div>
                        <div class="form-column grid_6 clearfix">
                            <input type="text" name="firstname" id="firstname" placeholder="First name" value="<?php echo($firstName);?>" >
                        </div>
                        <div class="form-column grid_6 clearfix">
                            <input type="text" placeholder="<?php _e('Last name', 'morris');?>" name="lastname" id="lastname" value="<?php echo($lastName);?>"/>
                            <i class="icon-Edit"></i>
                        </div>
                        <div class="form-column grid_12 clearfix">
                            <input type="text" placeholder="<?php _e('Contact number', 'morris');?>" name="phonenumber" id="phonenumber" value="<?php echo($phonenumber);?>"/>
                        </div>
						<div class="form-column grid_12 clearfix">
                            <input type="text" placeholder="<?php _e('Post code', 'morris');?>" name="postecode" id="postecode" value="<?php echo($postCode);?>"/>
                        </div>
                        <div class="form-column grid_12 clearfix">
                            <textarea name="note" id="note" placeholder="<?php _e('Message', 'morris')?>"><?php echo($note);?></textarea>
                        </div>
						<div class="form-column grid_12 clearfix">
							<p class="red-field"><?php _e('* All fields are required', 'techvertu');?></p>
						</div>
						<div class="form-column grid_12 clearfix">
							<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" />
						</div>
                        <div class="form-column grid_12 clearfix">
                            <input type="submit" class="contact-submit"  name="contact-submit" value="<?php _e('Enquire', 'morris');?>" />
							<img src="<?php echo(bloginfo('template_directory'));?>/img/spining.svg" class="spinner none" />
                        </div>
                    </form>
					<script>
						grecaptcha.ready(function(){
							grecaptcha.execute("<?php echo(SITE_KEY)?>", {action: "homepage"})
							.then(function(token){
								document.getElementById('g-recaptcha-response').value = token;

							});
						});
					</script>
                </div>
            </div>
        </div>
		
	<?php
	}

	protected function _content_template()
	{
		?>
            <div class="techvertu-enquiry-form-wrapper clearfix">
               
            </div>
		<?php 
	}
}
