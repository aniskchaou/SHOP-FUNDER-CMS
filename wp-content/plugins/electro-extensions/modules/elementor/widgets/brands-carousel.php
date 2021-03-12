<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Brands Carousel Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Brands_Carousel_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Brands Carousel Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_brands_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve Brands Carousel Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Brands Carousel', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Brands Carousel Block widget icon.
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
     * Retrieve the list of categories the Brands Carousel Block widget belongs to.
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
     * Register Brands Carousel Block widget controls.
     *
     * ads different input fields to allow the user to change and customize the widget settings.
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
                'placeholder'   => esc_html__( ' Enter title', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     => esc_html__( 'Number of Brands to display', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => '5',
            ]
        );

        $this->add_control(
            'has_no_products',
            [
                'label'     => esc_html__( 'Have no products', 'electro-extensions' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Show', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
                'placeholder'   => esc_html__( 'Show Brands does not have products', 'electro-extensions' ),
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
            'include',
            [
                'label'         => esc_html__( 'Include ID\'s', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'is_touchdrag',
            [
                'label'         => esc_html__('Carousel: Enable Touch Drag', 'electro-extensions'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Show', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );

        $this->add_control(
            'is_autoplay',
            [
                'label'         => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );

        $this->add_control(
            'is_loop',
            [
                'label'         => esc_html__( 'Carousel: Loop', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );


    $this->end_controls_section();

    }

    /**
     * Render Brands Carousel output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $args = array();

        $section_args = array(
            'section_title'     => $title,
        );

        $taxonomy_args = array(
            'orderby'       => $orderby,
            'order'         => $order,
            'number'        => $limit,
            'hide_empty'    => $has_no_products
        );

        if( ! empty( $include ) ) {
            $include = explode( ",", $include );
            $taxonomy_args['include'] = $include;
        }

        $carousel_args  = array(
            'touchDrag'         => $is_touchdrag,
            'autoplay'          => $is_autoplay,
            'loop'              => $is_loop,
        );

        if( function_exists( 'electro_brands_carousel' ) ) {
            electro_brands_carousel( $section_args, $taxonomy_args, $carousel_args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Brands_Carousel_Block );