<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_products_carousel extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_products_carousel_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Carousel', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products Carousel widget icon.
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
     * Retrieve the list of categories the Ad Block widget belongs to.
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
     * Register Products Carousel widget controls.
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
                'label'         => esc_html__( 'Title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter your title here', 'electro-extensions' ),
            ]
        );


        $this->add_control(
            'shortcode_tag',
            [
                'label'     => esc_html__( 'Shortcode Tags', 'electro-extensions' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'featured_products'     => esc_html__( 'Featured Products','electro-extensions'),
                    'sale_products'         => esc_html__( 'On Sale Products','electro-extensions'),
                    'top_rated_products'    => esc_html__( 'Top Rated Products','electro-extensions'),
                    'recent_products'       => esc_html__( 'Recent Products','electro-extensions'),
                    'best_selling_products' => esc_html__( 'Best Selling Products','electro-extensions'),
                    'product_category'      => esc_html__( 'Product Category','electro-extensions'),
                    'products'              => esc_html__( 'Products','electro-extensions')
                ],
                'default' => 'recent_products',
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'         => esc_html__('Limit', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter id separate by comma(,) Note: Only works with Products Shortcode.', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => esc_html__( 'Orderby', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter Orderby', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => esc_html__( 'Order', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter Order', 'electro-extensions' ),
            ]
        );


        $this->add_control(
            'products_choice',
            [
                'label'         => esc_html__('Product Choice', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter product choice.', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'product_id',
            [
                'label'         => esc_html__( 'Product id or SKUs', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter IDs/SKUs separate by comma(,).', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'category',
            [
                'label'         => esc_html__('Category', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter slug separate by comma(,).', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'show_custom_nav',
            [
                'label'         => esc_html__('Show Custom Navigation', 'electro-extensions'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
                'description'   => esc_html__( 'Custom navigation', 'electro-extensions' ),
            ]
        );

        if ( electro_is_wide_enabled() ) {
            $this->add_control(
                'product_columns_wide',
                [
                    'label'         => esc_html__('Products Wide Layout Columns', 'electro-extensions'),
                    'type'          => Controls_Manager::TEXT,
                    'default'       => '7',
                    'description'   => esc_html__( 'Option only works if Wide Electro Layout enabled.', 'electro-extensions' ),
                ]
            );
        }

        $this->add_control(
            'items',
            [
                'label'         => esc_html__('Carousel: Items', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
                'default'       => '6',
            ]
        );

        $this->add_control(
            'items_0',
            [
                'label'         => esc_html__('Carousel: Items(0 - 479)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
                'default'       => '2',
            ]
        );


        $this->add_control(
            'items_480',
            [
                'label'         => esc_html__('Carousel: Items(480 - 767)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
                'default'       => '2',
            ]
        );


        $this->add_control(
            'items_768',
            [
                'label'         => esc_html__('Carousel: Items(768 - 991)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
                'default'       => '2',
            ]
        );


        $this->add_control(
            'items_992',
            [
                'label'         => esc_html__('Carousel: Items(992 - 1199)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
                'default'       => '3',
            ]
        );

        $this->add_control(
            'items_1200',
            [
                'label'         => esc_html__('Carousel: Items(1200 - 1429)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
                'default'       => '4',
            ]
        );

        $this->add_control(
            'is_dots',
            [
                'label'         => esc_html__( 'Show Dots', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );    

        $this->add_control(
            'is_touchdrag',
            [
                'label'         => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );


        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );

        $this->add_control(
            'margin',
            [
                'label'         => esc_html__('Carousel: Margin', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Products Carousel output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ): array();
        $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $items, 'per_page' => $limit ) );
        $items_0               = isset( $items_0) ? $items_0 : '';
        $items_480             = isset( $items_480) ? $items_480 : '';
        $items_768             = isset( $items_768) ? $items_768 : '';
        $items_992             = isset( $items_992) ? $items_992 : '';
        $items_1200            = isset( $items_1200) ? $items_1200 : '';

        $carousel_args = array(
            
            'items'     => isset( $items ) ? $items : '',

            'items'             => isset( $items ) ? $items : '',
            'nav'               => isset( $is_nav) ? filter_var( $is_nav, FILTER_VALIDATE_BOOLEAN): '',
            'dots'              => isset( $is_dots) ? filter_var( $is_dots, FILTER_VALIDATE_BOOLEAN): '',
            'touchDrag'         => isset( $is_touchdrag) ? filter_var( $is_touchdrag, FILTER_VALIDATE_BOOLEAN): '',
            'autoplay'          => isset( $is_autoplay) ? filter_var( $is_autoplay, FILTER_VALIDATE_BOOLEAN): '',
            'margin'            => intval( $margin ),
            'responsive'        => array(
                '0'     => array( 'items'   => $items_0 ,   'margin' => 10 ),
                '480'   => array( 'items'   => $items_480,  'margin' => 10 ),
                '768'   => array( 'items'   => $items_768,  'margin' => 10 ),
                '992'   => array( 'items'   => $items_992,  'margin' => 15 ),
                '1200'  => array( 'items'  => $items_1200,  'margin' => 15 ),
                '1430'  => array( 'items'   => $items ),
            )
        );

        if ( electro_is_wide_enabled() ) {
            $carousel_args['responsive']['1480'] = array( 'items' => $product_columns_wide );
        }

        $products_html = electro_do_shortcode( $shortcode_tag, $shortcode_atts );

        $args = array(
            'products_html'     => isset( $products_html ) ? $products_html : '',
            'section_title'     => isset( $title ) ? $title : '',
            'shortcode_tag'     => isset( $shortcode_tag ) ? $shortcode_tag : '',
            'show_custom_nav'   => isset( $show_custom_nav ) ? $show_custom_nav : '',
            'section_class'     => isset( $el_class ) ? $el_class : 'section-products-carousel',
        );

        if( function_exists( 'electro_products_carousel' ) ) {
            electro_products_carousel( $args, $carousel_args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_products_carousel );