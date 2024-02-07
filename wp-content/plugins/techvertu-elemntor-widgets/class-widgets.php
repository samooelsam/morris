<?php
/**
 * Techvertu Custom widget class.
 *
 * @category   Class
 * @package    techVertuElementorWidget
 * @subpackage WordPress
 * @author     Saman Tohidian <info@uikar.com>
 * @copyright  2023 Saman tohidian
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.uikar.com/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.3.9 
 */

namespace TechvertuCustomWidgets;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.0.0
 */
class Widgets {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once 'widgets/class-techvertuFilters.php';
		require_once 'widgets/class-industryWidget.php';
		require_once 'widgets/class-buyButton.php';
		require_once 'widgets/class-FeatureList.php';
		require_once 'widgets/class-enquiryForm.php';
		require_once 'widgets/class-ourPromise.php';
		require_once 'widgets/class-techvertuNews.php';
		require_once 'widgets/class-generatorGuide.php';
		require_once 'widgets/class-techvertuTechSheets.php';
		require_once 'widgets/class-navigateToSection.php';
		require_once 'widgets/class-techvertuVacancy.php';
		require_once 'widgets/class-productCats.php';
		require_once 'widgets/class-techvertuTeams.php';
		
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets() {
		// It's now safe to include Widgets files.
		$this->include_widgets_files();

		// Register the plugin widget classes.
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\TechvertuFilterWidget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\industryTabs() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\buyButton() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\TechvertuProductFeatureList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\enquiryForm() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ourPromise() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\techvertuNews() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\generatorGuide() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\techvertuTechSheets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\navigateToSection() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\techvertuVacancy() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\productCats() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\techvertuTeams() );
		
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Register the widgets.
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
	}
}

// Instantiate the Widgets class.
Widgets::instance();