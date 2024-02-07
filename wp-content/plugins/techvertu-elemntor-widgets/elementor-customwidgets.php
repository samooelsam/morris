<?php
/**
 * Techvertu Custom elementor widgets
 *
 * @package techvertuelementorWidget
 *
 * Plugin Name: Techvertu elementor widgets
 * Description: Add custom widgets to elementor 
 * Plugin URI:  https://www.uikar.com/plugins/
 * Version:     1.0.0
 * Author:      Saman Tohidian
 * Author URI:  https://www.uikar.com
 * Text Domain: elementor-customwidget
 */
define('TECHVERTU_ELEMENTOR_DIR', plugin_dir_path(__FILE__));
define('TECHVERTU_ELEMENTOR_URL', plugin_dir_url(__FILE__));
define( 'TECHVERTU_ELEMENTOR_WIDGETS', __FILE__ );//ELEMENTOR_CUSTOM_BUTTON

/**
 * Include the Elementor_custombutton class.
 */
require plugin_dir_path( TECHVERTU_ELEMENTOR_WIDGETS ) . 'class-elementor-widgets.php';
