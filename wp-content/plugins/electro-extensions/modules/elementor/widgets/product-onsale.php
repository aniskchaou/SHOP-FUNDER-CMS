<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Electro Onsale Product Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Onsale_Product_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Electro Onsale Product name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_product_onsale_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Electro Onsale Product title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Onsale Product', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Electro Onsale Product icon.
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
     * Retrieve the list of categories the Onsale Product belongs to.
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
     * Register Electro Onsale Product controls.
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
                'placeholder'   => esc_html__( 'Enter title', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'show_savings',
            [
                'label'         => esc_html__( 'Show Savings Details', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );

        $this->add_control(
            'savings_in',
            [
                'label'         => esc_html__( 'Savings in', 'electro-extensions' ),
                'type'          => Controls_Manager::SELECT,
                'options' => [

                    'amount'        => esc_html__( 'Amount', 'electro-extensions' ),
                    'percentage'    => esc_html__( 'Percentage', 'electro-extensions' ),
                ],
                'default'=> 'amount',
            ]
        );

        $this->add_control(
            'savings_text',
            [
                'label'         => esc_html__('Savings Text', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'         => esc_html__( 'Number of Products to display', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the number of products to display', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'product_choice',
            [
                'label'         => esc_html__( 'Product Choice', 'electro-extensions' ),
                'type'          => Controls_Manager::SELECT,
                'options' => [

                    'recent'    =>esc_html__( 'Recent', 'electro-extensions' ),
                    'random'    =>esc_html__( 'Random', 'electro-extensions' ),
                    'specific'  =>esc_html__( 'Specific', 'electro-extensions' ),
                ],
                'default'=> 'recent',
            ]
        );


        $this->add_control(
            'product_id',
            [
                'label'         => esc_html__('Product ID', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the product id seperate by comma(,).', 'electro-extensions'),
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Electro Onsale Product output on the frontend.
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
            'show_savings'      => $show_savings,
            'savings_in'        => $savings_in,
            'savings_text'      => $savings_text,
            'limit'             => $limit,
            'product_choice'    => $product_choice,
            'product_id'        => $product_id,
        );

        if( function_exists( 'electro_onsale_product' ) ) {
            electro_onsale_product( $section_args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Onsale_Product_Block );