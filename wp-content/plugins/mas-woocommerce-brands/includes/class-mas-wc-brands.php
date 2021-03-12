<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Mas_WC_Brands' ) ) {
	/**
	 * Main WC Brands class
	 *
	 * @class Mas_WC_Brands
	 * @version 1.0.0
	 */
	final class Mas_WC_Brands {
		/**
		 * WC Brands version
		 *
		 * @var string
		 */
		public $version = '1.0.4';

		/**
		 * The single instance of the class.
		 *
		 * @var Mas_WC_Brands
		 */
		protected static $_instance = null;

		/**
		 * Main Mas_WC_Brands Instance.
		 *
		 * Ensures only one instance of Mas_WC_Brands is loaded or can be loaded.
		 *
		 * @static
		 * @return Mas_WC_Brands - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Cloning is forbidden.
		 */
		public function __clone() {
			wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mas-wc-brands' ), '2.1' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 */
		public function __wakeup() {
			wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mas-wc-brands' ), '2.1' );
		}

		/**
		 * Mas_WC_Brands Constructor.
		 */
		public function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();

			do_action( 'mas_wc_brands_loaded' );
		}

		/**
		 * Define constants
		 */
		private function define_constants() {
			$this->define( 'MAS_WCBR_ABSPATH', dirname( MAS_WCBR_PLUGIN_FILE ) . '/' );
			$this->define( 'MAS_WCBR_PLUGIN_BASENAME', plugin_basename( MAS_WCBR_PLUGIN_FILE ) );
		}

		/**
		 * Init Mas_WC_Brands when Wordpress Initializes
		 */
		public function includes() {
			include_once( MAS_WCBR_ABSPATH . 'includes/class-mas-wc-brands-admin.php' );
			include_once( MAS_WCBR_ABSPATH . 'includes/mas-wc-brands-functions.php' );
			include_once( MAS_WCBR_ABSPATH . 'includes/class-mas-wc-brands-shortcodes.php' );
		}

		/**
		 * Init Mas_WC_Brands when Wordpress Initializes
		 */
		public function init_hooks() {
			add_action( 'after_setup_theme', array( $this, 'setup_brands_admin' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'widgets_init', array( $this, 'init_widgets' ) );
			add_action( 'init', array( 'Mas_WC_Brands_Shortcodes', 'init' ) );
		}

		/**
		 * Setup Brands Admin
		 */
		public function setup_brands_admin() {
			new Mas_WC_Brands_Admin();
		}

		/**
		 * Enqueue scripts
		 */
		public function enqueue_scripts() {
			if ( 'yes' === get_option( 'mas_wc_brands_plugin_styles', true ) ) {
				wp_enqueue_style( 'mas-wc-brands-style', plugins_url( 'assets/css/style.css', MAS_WCBR_PLUGIN_FILE ), '', $this->version );
				wp_style_add_data( 'mas-wc-brands-style', 'rtl', 'replace' );
			}
		}

		/**
		 * init_widgets function.
		 *
		 * @access public
		 */
		public function init_widgets() {

			// Inc
			include_once( MAS_WCBR_ABSPATH . 'includes/widgets/class-mas-wc-widget-brand-description.php' );
			include_once( MAS_WCBR_ABSPATH . 'includes/widgets/class-mas-wc-widget-brand-thumbnails.php' );

			// Register
			register_widget( 'Mas_WC_Widget_Brand_Description' );
			register_widget( 'Mas_WC_Widget_Brand_Thumbnails' );
		}

		/**
		 * Products Brand Taxonomy
		 *
		 * @return string
		 */
		public function get_brand_taxonomy() {
			return get_option( 'mas_wc_brands_brand_taxonomy' );
		}

		/**
		 * Products Brand Attribute
		 *
		 * @return string
		 */
		public function get_brand_attribute() {
			return str_replace( 'pa_', '', $this->get_brand_taxonomy() );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}
	}
}