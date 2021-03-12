<?php

/**
 * Module Name          : Elementor Addons
 * Module Description   : Provides additional Elementor Elements for the Electro theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Electro_Elementor_Extensions' ) ) {
    final class Electro_Elementor_Extensions {

        /**
         * Electro_Extensions The single instance of Electro_Extensions.
         * @var     object
         * @access  private
         * @since   1.0.0
         */
        private static $_instance = null;

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __construct() {
            add_action( 'init', array( $this, 'setup_constants' ),  10 );
            add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
            add_action( 'init', array( $this, 'elementor_widgets' ),  20 );
        }

        /**
         * Electro_Elementor_Extensions Instance
         *
         * Ensures only one instance of Electro_Elementor_Extensions is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @return Electro_Elementor_Extensions instance
         */
        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
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
            if ( ! defined( 'ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR' ) ) {
                define( 'ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_URL' ) ) {
                define( 'ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_FILE' ) ) {
                define( 'ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_FILE', __FILE__ );
            }
        }

        /**
         * Widget Category Register
         *
         * @since  1.0.0
         * @access public
         */
        public function add_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'electro-elements',
                [
                    'title' => esc_html__( 'Electro Elements', 'electro-extensions' ),
                    'icon' => 'fa fa-plug',
                ]
            );
        }

        /**
         * Widgets
         *
         * @since  1.0.0
         * @access public
         */
        public function elementor_widgets() {
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/ad-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/ads-with-banner.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/feature-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/jumbotron.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/nav-menu.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/team-member.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-categories-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-6-1-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-cards-carousel.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/brands-carousel.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-list-categories.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-categories-list.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-one-two-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/deal-products-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-1.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-categories-list-with-header.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-2-1-2-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-tabs-element.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-categories-menu-list.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-onsale-carousel.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-onsale.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/deal-and-product-tabs.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/slider-with-ads-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-with-category-image.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-list-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/product-carousel-with-category-tabs.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-tabs.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-tabs-1.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/deals-products-carousel.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/mobile-product-deals-block.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-6-1-with-categories.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/recent-viewed-products.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/category-icons-carousel.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/recently-viewed-products-carousel.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-banner-vertical-tabs.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/two-row-products.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-with-timer.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-tabs-with-deal.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/vertical-nav-menu.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-category-with-image.php';
            require_once ELECTRO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR . '/widgets/products-carousel-category-with-image.php';
        }
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    // Finally initialize code
    Electro_Elementor_Extensions::instance();
}