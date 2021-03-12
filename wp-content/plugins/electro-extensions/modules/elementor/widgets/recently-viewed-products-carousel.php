<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Recently Vieved Products Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Recently_Vieved_Products_Carousel extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Recently Vieved Products Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_recently_viewed_products_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve Recently Vieved Products Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Recently Vieved Products Carousel', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Recently Vieved Products Carousel widget icon.
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
     * Retrieve the list of categories the Recently Vieved Products Carousel widget belongs to.
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
     * Register Recently Vieved Products Carousel widget controls.
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
            'section_title',
            [
                'label'         => esc_html__( 'Section Title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'         => esc_html__( 'Limit', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '20',
            ]
        );

        $this->add_control(
            'items',
            [
                'label'         => esc_html__('Carousel: Items', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
                'default'       => '8',
            ]
        );

        $this->add_control(
            'items_0',
            [
                'label'         => esc_html__('Carousel: Items(0 - 479)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '2',
            ]
        );


        $this->add_control(
            'items_480',
            [
                'label'         => esc_html__('Carousel: Items(480 - 767)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '3',
            ]
        );


        $this->add_control(
            'items_768',
            [
                'label'         => esc_html__('Carousel: Items(768 - 991)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '4',
            ]
        );


        $this->add_control(
            'items_992',
            [
                'label'         => esc_html__('Carousel: Items(992 - 1199)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '5',
            ]
        );

        $this->add_control(
            'items_1200',
            [
                'label'         => esc_html__('Carousel: Items(1200 - 1429)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '6',
            ]
        );

        $this->add_control(
            'is_dots',
            [
                'label'         => esc_html__('Carousel: Show Dots', 'electro-extensions'),
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
                'label'         => esc_html__('Carousel: Enable Touch Drag', 'electro-extensions'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->add_control(
            'is_autoplay',
            [
                'label'         => esc_html__('Carousel: Autoplay', 'electro-extensions'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

         $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra Class', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__('Enter the Additional Class.', 'electro-extensions'),
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Recently Vieved Products Carousel output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract($settings);

        if ( is_woocommerce_activated() ) {

            global $electro_version;

            $viewed_products = electro_get_viewed_products();

            if ( empty( $viewed_products ) ) {
                return;
            }

            $section_args = array(
                'section_title'     => isset( $section_title ) ? $section_title : '',
                'el_class'     => isset( $el_class ) ? $el_class : '',
            );

            $items_0               = isset( $items_0) ? $items_0 : 2;
            $items_480             = isset( $items_480) ? $items_480 : 3;
            $items_768             = isset( $items_768) ? $items_768 : 4;
            $items_992             = isset( $items_992) ? $items_992 : 5;
            $items_1200            = isset( $items_1200) ? $items_1200 : 6;
            $items                 = isset( $items ) ? $items : 8;

            $carousel_args = array(
                'items'             => $items,
                'nav'               => isset( $is_nav) ? filter_var( $is_nav, FILTER_VALIDATE_BOOLEAN): '',
                'dots'              => isset( $is_dots) ? filter_var( $is_dots, FILTER_VALIDATE_BOOLEAN): '',
                'touchDrag'         => isset( $is_touchdrag) ? filter_var( $is_touchdrag, FILTER_VALIDATE_BOOLEAN): '',
                'autoplay'          => isset( $is_autoplay) ? filter_var( $is_autoplay, FILTER_VALIDATE_BOOLEAN): '',
                'responsive'        => array(
                    '0'     => array( 'items'   => $items_0 ),
                    '480'   => array( 'items'   => $items_480 ),
                    '768'   => array( 'items'   => $items_768 ),
                    '992'   => array( 'items'   => $items_992 ),
                    '1200'  => array( 'items'   => $items_1200 ),
                    '1430'  => array( 'items'   => $items ),
                )
            );

            $shortcode_atts = array(
                'columns'       =>  $items,
                'per_page'      =>  isset( $limit) ? $limit : 20,
            );

            $shortcode_atts = wp_parse_args( array( 'ids' => implode(',', $viewed_products ) ), $shortcode_atts );

            $products       = electro_do_shortcode( 'products',  $shortcode_atts );

            $section_args['products_html'] = $products;
            
            if( function_exists( 'electro_recent_viewed_products_carousel' ) ) {
                electro_recent_viewed_products_carousel( $section_args , $carousel_args );
            }

        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Recently_Vieved_Products_Carousel );