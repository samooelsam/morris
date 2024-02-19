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
        if(isset($_REQUEST['contact-submit'])){
			$headers = array('Content-Type: text/html; charset=UTF-8');
			// $recaptcha_response = $_REQUEST['recaptcha_response'];
			// // calling google recaptcha api.
			// print_r($_REQUEST);
			// $secret = '6Lf1CmMpAAAAAEOaAp2-X23LGBB_r_fL6FbACmwE';
			// $siteKey = '6Lf1CmMpAAAAAJJSNY4nllZucYYqA31pbKqymTO7'
			// $recaptchaContent=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptcha_response);
			// $recaptcha = json_decode($recaptchaContent);
			$senderEmail = sanitize_text_field($_REQUEST['senderEmail']);
			$to = sanitize_email($_REQUEST['senderEmail']);
			$subject = sanitize_text_field('enquire for '. $productTitle);
            $sku = sanitize_text_field( $_REQUEST['productSKU']);
			$firstName = sanitize_text_field($_REQUEST['firstname']);
			$lastName = sanitize_text_field($_REQUEST['lastname']);
			$businessName = sanitize_text_field($_REQUEST['businessName']);
			if($_REQUEST["prQuantity"]){
				$quantity = $_REQUEST["prQuantity"];
			}
			$phonenumber = preg_replace('/[^0-9]/', '', $_REQUEST['phonenumber']);
			$postCode = preg_replace('/[^0-9]/', '', $_REQUEST['postecode']);
			$note = sanitize_text_field($_REQUEST['note']);
			$body = '<img src="https://morrismachinery.co.uk/wp-content/uploads/2023/08/Logo-MORRIS.svg" />
					<p>A New contact form has been submitted.Please find the customers detail below</p>
					<strong style="width:200px;display: inline-block;">Name :</strong>'. $firstName .' ' .$lastName. 
					'<br> <strong style="width:200px;display: inline-block;">Business name : </strong>' . $businessName.'
					 <br><strong style="width:200px;display: inline-block;"> Contact number :</strong>' . $phonenumber. 
					 '<br> <strong style="width:200px;display: inline-block;">Post code :</strong>' .$postCode.
					'<br> <strong style="width:200px;display: inline-block;">Email : </strong>'.$to. '<br>
					 <strong style="width:200px;display: inline-block;">SKU:</strong>'.$sku. '<br>
					 <strong style="width:200px;display: inline-block;"> Quantity:</strong>'.$quantity.'
					 <br> <strong style="width:200px;display: inline-block;">Message :</strong> <br>' .$note;
			if($to && $subject && $body && $phonenumber && $postCode && $note && $firstName && $lastName) {
				wp_mail( 'info@morrismachinery.co.uk', $subject, $body, $headers ); 
				$successFlag = '1';
			}
			else {
				$successFlag = '0';
			}
			
        }
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
        <div class="techvertu-product-info-wrapper clearfix">
            <figure class="product-image-wrapper grid_6 clearfix">
                <img src="<?php echo($image[0]);?>" />
            </figure>
            <div class="techvertu-enquiry-form-wrapper grid_6 clearfix">
                <h3><?php echo($settings['title']);?></h3>
                <p></p>
                <div class="techvertu-enquiry-form clearfix">
                    <?php
                    if($alertMessage) {?>
                        <div class="alert <?php echo($alertColorClass);?>">
                            <p><?php echo($alertMessage);?></p>
                        </div>
                    <?php }?>
					
                    <form method="POST" action="<?php echo ($_SERVER['REQUEST_URI']); ?>">
                        <div class="form-sender clearfix">
                            <label><input type="hidden" name="productTitle" value="<?php echo($productTitle);?>" ><span class="title-changer"><?php echo($productTitle);?></span></label>
                            <label><input type="hidden" name="productSKU" value="<?php echo($productSKU);?>" /><span class="sku-changer"><?php _e('SKU', 'morris');?>:<?php echo($productSKU);?></span></label>
                        </div>
						<div class="form-column grid_2 clearfix">
							<input type="number" name="prQuantity" value="" placeholder="1" >
						</div>
						<div class="grid_10 link-products form-column clearfix">
							<a href="<?php echo(get_permalink($productID));?>"><i class="fi fi-rr-link-alt"></i><?php _e('Go to product page', 'morris');?></a>
						</div>
                        <div class="form-column grid_12 clearfix">
                            <input type="email" name="senderEmail" value="<?php echo($senderEmail);?>" placeholder="Email" >
                        </div>
						<div class="form-column grid_12 clearfix">
                            <input type="text" name="businessName" value="<?php echo($businessName);?>" placeholder="Business Name" >
                        </div>
                        <div class="form-column grid_6 clearfix">
                            <input type="text" name="firstname" placeholder="First name" value="<?php echo($firstName);?>" >
                        </div>
                        <div class="form-column grid_6 clearfix">
                            <input type="text" placeholder="<?php _e('Last name', 'morris');?>" name="lastname" value="<?php echo($lastName);?>"/>
                            <i class="icon-Edit"></i>
                        </div>
                        <div class="form-column grid_12 clearfix">
                            <input type="text" placeholder="<?php _e('Contact number', 'morris');?>" name="phonenumber" value="<?php echo($phonenumber);?>"/>
                        </div>
						<div class="form-column grid_12 clearfix">
                            <input type="text" placeholder="<?php _e('Post code', 'morris');?>" name="postecode" value="<?php echo($postCode);?>"/>
                        </div>
                        <div class="form-column grid_12 clearfix">
                            <textarea name="note" placeholder="<?php _e('Message', 'morris')?>"><?php echo($note);?></textarea>
                        </div>
						<div class="form-column grid_12 clearfix">
							<p class="red-field"><?php _e('* All fields are required', 'techvertu');?></p>
						</div>
                        <div class="form-column grid_12 clearfix">
                            <input type="submit" class="contact-submit"  name="contact-submit" value="<?php _e('Enquire', 'morris');?>" />
                        </div>
                    </form>
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
