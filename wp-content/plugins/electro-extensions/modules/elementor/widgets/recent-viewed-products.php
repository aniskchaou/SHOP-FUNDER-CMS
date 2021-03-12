<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Recent Vieved Products Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Recent_Vieved_Products extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Recent Vieved Products widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_recent_viewed_products';
    }

    /**
     * Get widget title.
     *
     * Retrieve Recent Vieved Products widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Recent Vieved Products', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Recent Vieved Products widget icon.
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
     * Retrieve the list of categories the Recent Vieved Products widget belongs to.
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
     * Register Recent Vieved Products widget controls.
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
            'per_page',
            [
                'label' => esc_html__( 'Limit', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the number of products to display.', 'electro-extensions'),
                'default'         => '10',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the number of columns to display.', 'electro-extensions'),
                'default'         => '5',
            ]
        );


        $this->end_controls_section();

    }

    /**
     * Render Recent Vieved Products output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract($settings);

        $shortcode_atts = array( 'per_page' => $per_page, 'columns' => $columns );

        $args = array(
            'section_title'     => $section_title,
            'shortcode_atts'    => $shortcode_atts,
        );
        
        if( function_exists( 'electro_recent_viewed_products' ) ) {
            electro_recent_viewed_products( $args );
        }


    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Recent_Vieved_Products );