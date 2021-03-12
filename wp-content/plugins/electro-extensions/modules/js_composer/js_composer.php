<?php

/**
 * Module Name 			: Visual Composer Addons
 * Module Description 	: Provides additional Visual Composer Elements for the Electro theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Electro_VCExtensions' ) ) {
	class Electro_VCExtensions {

		/**
		 * List of paths.
		 *
		 * @var array
		 */
		private $paths = array();

		/**
		 * Constructor function.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'setup_constants' ),	10 );
			add_action( 'init', array( $this, 'setPaths' ),			20 );
			add_action( 'init', array( $this, 'includes' ),			30 );
			add_action( 'init', array( $this, 'map_vc_elements' ),	40 );
		}

		/**
		 * Setup plugin constants
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function setup_constants() {

			// Plugin Folder Path
			if ( ! defined( 'ELECTRO_VC_PLUGIN_EXTENSIONS_DIR' ) ) {
				define( 'ELECTRO_VC_PLUGIN_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'ELECTRO_VC_PLUGIN_EXTENSIONS_URL' ) ) {
				define( 'ELECTRO_VC_PLUGIN_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'ELECTRO_VC_PLUGIN_EXTENSIONS_FILE' ) ) {
				define( 'ELECTRO_VC_PLUGIN_EXTENSIONS_FILE', __FILE__ );
			}
		}

		/**
		 * Include required files
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function includes() {

			#-----------------------------------------------------------------
			# Shortcodes
			#-----------------------------------------------------------------
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-ad-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-brands-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-feature-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-jumbotron.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-list-categories.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-categories-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-onsale-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-onsale.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-2-1-2-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-6-1-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-6-1-with-categories.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-cards-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-tabs.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-tabs.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-with-category-image.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-1.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-team-member.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-deals-products-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-ads-with-banners-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-slider-with-ads-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-with-category-tabs.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-tabs-1.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-categories-list.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-deal-products-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-one-two-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-list-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-categories-list-with-header.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-mobile-product-deals-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-categories-menu-list.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-nav-menu.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-recent-viewed-products.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-deal-and-product-tabs.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-banner-vertical-tabs.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-categories-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-with-timer.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-category-with-image.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-recent-viewed-products-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-vertical-nav-menu.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-category-with-image.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-two-row-products.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-carousel-tabs-with-deal.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-category-tags.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-products-categories-1-6.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-banner-1-6-block.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-categories-with-banner-carousel.php';
			require_once ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/includes/elements/vc-product-onsale-carousel-2.php';
		}

		/**
		 * Map Config Dir
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function map_vc_elements() {

			// Check if Visual Composer is installed
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				// Display notice that Visual Compser is required
				return;
			}

			require_once  $this->path( 'CONFIG_DIR', 'map.php');
		}

		/**
		 * Setter for paths
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function setPaths() {
			$this->paths = Array(
				'APP_ROOT'			=> ELECTRO_VC_PLUGIN_EXTENSIONS_DIR,
				'WP_ROOT'			=> preg_replace( '/$\//', '', ABSPATH ),
				'APP_DIR'			=> plugin_basename( ELECTRO_VC_PLUGIN_EXTENSIONS_DIR ),
				'CONFIG_DIR'		=> ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/config',
				'ASSETS_DIR'		=> ELECTRO_VC_PLUGIN_EXTENSIONS_DIR . '/assets',
				'ASSETS_DIR_NAME'	=> 'assets',
			);
		}

		/**
		 * Gets absolute path for file/directory in filesystem.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param $name        - name of path dir
		 * @param string $file - file name or directory inside path
		 * @return string
		 */
		public function path( $name, $file = '' ) {
			return $this->paths[$name] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );
		}
	}
}

// Finally initialize code
new Electro_VCExtensions();