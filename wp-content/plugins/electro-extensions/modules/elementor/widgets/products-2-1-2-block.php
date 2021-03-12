<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Electro Elementor Products 2-1-2 Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Products_2_1_2_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Electro Elementor Products 2-1-2 Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_products_2_1_2_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Electro Elementor Products 2-1-2 Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Electro Products 2-1-2 Block', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Electro Elementor Products 2-1-2 Block widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-plug';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Electro Elementor Products 2-1-2 Block widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'electro-elements' ];
    }

    /**
     * Register Electro Elementor Products 2-1-2 Block widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label'     => esc_html__( 'Content', 'electro-extensions' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Enter title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter the Tilte', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'shortcode_tag',
            [
                'label' => esc_html__( 'Shortcode Tag', 'electro-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    'featured_products'     => esc_html__( 'Featured Products','electro-extensions'),
                    'sale_products'         => esc_html__( 'On Sale Products','electro-extensions'),
                    'top_rated_products'    => esc_html__( 'Top Rated Products','electro-extensions'),
                    'recent_products'       => esc_html__( 'Recent Products','electro-extensions'),
                    'best_selling_products' => esc_html__( 'Best Selling Products','electro-extensions'),
                    'product_category'      => esc_html__( 'Product Category','electro-extensions'),
                    'products'              => esc_html__( 'Products','electro-extensions'),
                ],
                'default' => 'recent_products',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'     => esc_html__( 'Order by', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'placeholder' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
                'default'   => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     => esc_html__( 'Order', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
                'default'   => 'DESC',
            ]
        );

        $this->add_control(
            'products_choice',
            [
                'label'     => esc_html__( 'Product Choice', 'electro-extensions' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'ids'       =>esc_html__( 'IDs', 'electro-extensions' ),
                    'skus'      =>esc_html__( 'SKUs', 'electro-extensions' ),
                   
                ],
                'default'   => 'ids',

            ]
        );

        $this->add_control(  
            'product_id',
            [
                'label' => esc_html__( 'Product IDs or SKUs', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter IDs/SKUs separate by comma(,).', 'electro-extensions'),
            ]
        );

        
        $this->add_control(
            'category',
            [
                'label' => esc_html__( 'Category', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter category separate by comma(,).', 'electro-extensions'),
            ]
        ); 

        $this->add_control(
            'cat_operator',
            [
                'label' => esc_html__( 'Category Operator', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the categgory operator seperate by comma(,).', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'cat_limit',
            [
                'label' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the category limit.', 'electro-extensions'),
            ]
        ); 

        $this->add_control(
            'cat_has_no_products',
            [
                'label' => esc_html__( 'Have no products', 'electro-extensions' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
                'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
            ]
        ); 

        $this->add_control(
            'cat_orderby',
            [
                'label' => esc_html__( 'Order by', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
                'value' => 'DESC',
            ]
        );

        $this->add_control(
            'cat_order',
            [
                'label' => esc_html__( 'Order', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter category order.', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'cat_include',
            [
                'label' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter the id separate by comma(,).', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'cat_slugs',
            [
                'label' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the slug separate by comma(,).', 'electro-extensions'),
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Electro Elementor Products 2-1-2 Block output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( electro_is_wide_enabled() ) {
            $per_page   = 9;
        } else {
            $per_page   = 5;
        }

        $shortcode_atts          = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id ) ) : array();
        $shortcode_atts          = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'per_page' => $per_page ) );

        
        $category_args = array(
            'number'        => $cat_limit,
            'hide_empty'    => $cat_has_no_products,
            'orderby'       => $cat_orderby,
            'order'         => $cat_order,
        );

        if( ! empty( $cat_include ) ) {
            $cat_include = explode( ",", $cat_include );
            $category_args['include'] = $cat_include;
            $category_args['orderby'] = 'include';
        }

        if( ! empty( $cat_slugs ) ) {
            $cat_slugs = explode( ",", $cat_slugs );
            $category_args['slug'] = $cat_slugs;

            $cat_include = array();

            foreach ( $cat_slugs as $cat_slug ) {
                $cat_include[] = "'" . $cat_slug ."'";
            }

            if ( ! empty($cat_include ) ) {
                $category_args['include'] = $cat_include;
                $category_args['orderby'] = 'include';
            }
        }

        $args = array(
            'section_class'             => '',
            'section_title'             => $title,
            'category_args'             => $category_args,
        );

        if( class_exists( '\Electro_Products' ) ) {
            $args['products'] = \Electro_Products::$shortcode_tag( $shortcode_atts );
        }

        if( function_exists( 'electro_products_2_1_2_block' ) ) {
            electro_products_2_1_2_block( $args );
        }
        
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Products_2_1_2_Block );