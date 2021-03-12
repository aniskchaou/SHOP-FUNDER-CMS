<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Features Section Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Vertical_Nav_Menu_Element extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Vertical Vertical Nav-menu widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_vertical_nav_menu_element';
    }

    /**
     * Get widget title.
     *
     * Retrieve Vertical Nav-menu widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Vertical Nav menu', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Vertical Nav-menu widget icon.
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
     * Retrieve the list of categories the Vertical Nav-menu widget belongs to.
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
     * Register Vertical Nav-menu widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $nav_menus = wp_get_nav_menus();

        $nav_menus_option = array(
            esc_html__( 'Select a menu', 'electro-extensions' )       => '',
        );

        foreach ( $nav_menus as $key => $nav_menu ) {
            $nav_menus_option[$nav_menu->name] = $nav_menu->name;
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'electro-extensions' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'electro-extensions' ),
                'description'   => esc_html__( 'Enter the title of menu.', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'Electro Best Selling:',
            ]
        );

        $this->add_control(
            'action_text',
            [
                'label'         => esc_html__( 'Action Text', 'electro-extensions' ),
                'description'   => esc_html__( 'Enter the action text.', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => 'View All',
            ]
        );

        $this->add_control(
            'action_link',
            [
                'label'         => esc_html__( 'Action Link', 'electro-extensions' ),
                'description'   => esc_html__( 'Enter the action link.', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '#',
            ]
        );

        $this->add_control(
            'menu',
            [

                'label'     => esc_html__( 'Menu', 'electro-extensions' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'vertical-menu',
                'options'   => $nav_menus_option,
            ]
        );
         

        $this->end_controls_section();

    }

    /**
     * Render Vertical Nav-menu widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'menu_title'        => $title,
            'menu_action_text'  => $action_text,
            'menu_action_link'  => $action_link,
            'menu'              => $menu,
        );

        if( function_exists( 'electro_home_vertical_nav' ) ) {
            electro_home_vertical_nav( $args);
        }
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Vertical_Nav_Menu_Element);