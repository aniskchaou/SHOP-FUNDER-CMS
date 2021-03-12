<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Category Icon Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Category_Icon_Carousel extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Category Icon Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_category_icon_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve Category Icon Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Category Icon Carousel', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Category Icon Carousel widget icon.
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
     * Register Category Icon Carousel widget controls.
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
            'limit',
            [
                'label'         => esc_html__( 'Limit', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter Number of Categories to display', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'has_no_products',
            [
                'label'         => esc_html__( 'Have no products', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => esc_html__( 'Order By', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => esc_html__( 'Order', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'DESC',
            ]
        );

        $this->add_control(
            'slugs',
            [
                'label'         => esc_html__( 'Include Slugs', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter the slug seperate by comma(,)', 'electro-extensions' ),
                'default'       => '',
            ]
        );

        $this->add_control(
            'include',
            [
                'label'         => esc_html__( 'Include ID\'s', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter the ID \'s seperate by comma(,)', 'electro-extensions' ),
                'default'       => '',
            ]
        );

       $this->add_control(
            'items',
            [
                'label'         => esc_html__('Carousel: Items', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '4',
            ]
        );

        $this->add_control(
            'items_0',
            [
                'label'         => esc_html__('Carousel: Items(0 - 479)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
            ]
        );


        $this->add_control(
            'items_480',
            [
                'label'         => esc_html__('Carousel: Items(480 - 767)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
            ]
        );


        $this->add_control(
            'items_768',
            [
                'label'         => esc_html__('Carousel: Items(768 - 991)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
            ]
        );


        $this->add_control(
            'items_992',
            [
                'label'         => esc_html__('Carousel: Items(992 - 1199)', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'electro-extensions'),
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
                'default'       => 'false',
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
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Category Icon Carousel output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $cat_args = array(
            'number'            => isset( $limit ) ? $limit : '',
            'hide_empty'        => isset( $has_no_products ) ? $has_no_products : '',
            'orderby'           => isset( $orderby ) ? $orderby : '',
            'order'             => isset( $order ) ? $order : '',
        );

        if( ! empty( $slugs ) ) {
            $slugs = explode( ",", $slugs );
            $slugs = array_map( 'trim', $slugs );
            
            $slug_include = array();

            foreach ( $slugs as $slug ) {
                $slug_include[] = "'" . $slug ."'";
            }

            if ( ! empty($slug_include ) ) {
                $cat_args['slug']       = $slugs;
                $cat_args['include']    = $slug_include;
                $cat_args['orderby']    = 'include';
            }

        } elseif( ! empty( $include ) ) {
            $include = explode( ",", $include );
            $include = array_map( 'trim', $include );
            $cat_args['include'] = $include;
        }

        $items_0               = isset( $items_0) ? $items_0 : '';
        $items_480             = isset( $items_480) ? $items_480 : '';
        $items_768             = isset( $items_768) ? $items_768 : '';
        $items_992             = isset( $items_992) ? $items_992 : '';

        $carousel_args = array(
            'items'             => isset( $items ) ? $items : '',
            'nav'               => isset( $is_nav) ? filter_var( $is_nav, FILTER_VALIDATE_BOOLEAN): '',
            'dots'              => isset( $is_dots) ? filter_var( $is_dots, FILTER_VALIDATE_BOOLEAN): '',
            'touchDrag'         => isset( $is_touchdrag) ? filter_var( $is_touchdrag, FILTER_VALIDATE_BOOLEAN): '',
            'autoplay'          => isset( $is_autoplay) ? filter_var( $is_autoplay, FILTER_VALIDATE_BOOLEAN): '',
            'responsive'        => array(
                '0'     => array( 'items'   => $items_0 ),
                '480'   => array( 'items'   => $items_480 ),
                '768'   => array( 'items'   => $items_768 ),
                '992'   => array( 'items'   => $items_992 ),
                '1200'  => array( 'items'   => $items ),
            )
        );

        $args = array(
            'category_args'     => isset( $cat_args ) ? $cat_args : '',
            'section_class'     => isset( $el_class ) ? $el_class : '',
        );


        if( function_exists( 'electro_home_category_icon_carousel' ) ) {
            electro_home_category_icon_carousel( $args, $carousel_args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Category_Icon_Carousel );