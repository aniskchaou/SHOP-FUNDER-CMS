<?php
/**
 * Electro Class
 *
 * @author   Transvelo
 * @package  electro
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Electro' ) ) :

    /**
     * The main Electro class
     */
    class Electro {

        private static $structured_data;

        /**
         * Setup Class
         */
        public function __construct() {
            add_filter( 'body_class', array( $this, 'body_classes' ) );
            add_action( 'admin_menu', array( $this, 'add_custom_css_page' ) );
            add_action( 'wp_footer',  array( $this, 'get_structured_data' ) );
            add_action( 'vc_before_init', array( $this, 'set_vc_as_theme' ) );
            add_action( 'elementor/theme/register_locations', [ $this, 'register_elementor_locations' ] );
        }

        /**
         * Register Elementor Locations.
         *
         * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
         *
         * @return void
         */
        function register_elementor_locations( $elementor_theme_manager ) {

            $elementor_theme_manager->register_all_core_location();

            $elementor_theme_manager->register_location( 'sidebar', [
                'label' => esc_html__( 'Sidebar Blog', 'electro' ),
            ] );

            $elementor_theme_manager->register_location( 'sidebar-home', [
                'label' => esc_html__( 'Sidebar Home', 'electro' ),
            ] );
            $elementor_theme_manager->register_location( 'sidebar-shop', [
                'label' => esc_html__( 'Sidebar Shop', 'electro' ),
            ] );
            $elementor_theme_manager->register_location( 'sidebar-store', [
                'label' => esc_html__( 'Sidebar Store', 'electro' ),
            ] );
        }

        public function set_vc_as_theme() {
            vc_set_as_theme();
        }

        public function add_custom_css_page() {
            if ( apply_filters( 'electro_should_add_custom_css_page', false ) ) {
                add_submenu_page( 'themes.php', 'Custom Color CSS', 'Custom Color CSS', 'manage_options', 'custom-primary-color-css-page', 'electro_custom_primary_color_page' );
            }
        }

        /**
         * Adds custom classes to the array of body classes.
         *
         * @param array $classes Classes for the body element.
         * @return array
         */
        public function body_classes( $classes ) {
            // Adds a class of group-blog to blogs with more than 1 published author.
            if ( is_multi_author() ) {
                $classes[] = 'group-blog';
            }

            $show_breadcrumb = apply_filters( 'electro_show_breadcrumb', true );

            if ( ! $show_breadcrumb || ( ! function_exists( 'woocommerce_breadcrumb' ) && ! function_exists( 'electro_breadcrumb' ) ) ) {
                $classes[]  = 'no-breadcrumb';
            }

            $layout_args = $this->get_layout_args();

            if( isset( $layout_args['layout_name'] ) ) {
                $classes[] = $layout_args['layout_name'];
            }

            if( isset( $layout_args['body_classes'] ) ) {
                $classes[] = $layout_args['body_classes'];
            }

            $classes[] = 'electro-compact'; //TODO: deprecate at 2.4

            if ( electro_is_wide_enabled() ) {
                $classes[] = 'electro-wide';
            }

            if ( is_page_template( 'template-homepage-v10.php' ) ) {
                $classes[] = 'electro-dark';
            }

            return $classes;
        }

        public function get_layout_args() {

            $args = array();

            if ( is_woocommerce_activated() && is_woocommerce() ) {

                if( is_product() ) {
                    $args['layout_name']    = electro_get_single_product_layout();
                    $args['body_classes']   = electro_get_single_product_style();
                } else if( is_shop() || is_product_category() || is_tax( 'product_label' ) || is_tax( get_object_taxonomies( 'product' ) ) ) {
                    $args['layout_name']    = electro_get_shop_layout();
                }

            } elseif ( is_front_page() && is_home() ) {

                // Default homepage

            } elseif ( is_front_page() ) {

                // Static homepage

            } elseif ( is_home() ) {

                $args['layout_name']    = electro_get_blog_layout();
                $args['body_classes']   = electro_get_blog_style();

            } elseif( is_page() ) {

            } else {

                $args['layout_name']    = electro_get_blog_layout();
                $args['body_classes']   = electro_get_blog_style();

            }
            return $args;
        }

        /**
         * Check if the passed $json variable is an array and store it into the property...
         */
        public static function set_structured_data( $json ) {
            if ( ! is_array( $json ) ) {
                return;
            }
            self::$structured_data[] = $json;
        }

        /**
         * If self::$structured_data is set, wrap and echo it...
         * Hooked into the `wp_footer` action.
         */
        public function get_structured_data() {

            if ( ! self::$structured_data ) {
                return;
            }

            $structured_data['@context'] = 'http://schema.org/';

            if ( count( self::$structured_data ) > 1 ) {
                $structured_data['@graph'] = self::$structured_data;
            } else {
                $structured_data = $structured_data + self::$structured_data[0];
            }

            array_walk_recursive( $structured_data, function ( &$value ) {
                $value = sanitize_text_field( $value );
            } );

            echo '<script type="application/ld+json">' . wp_json_encode( $structured_data ) . '</script>';
        }
    }

endif;

return new Electro();
