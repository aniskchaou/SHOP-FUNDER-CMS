<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Team Member Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Team_Member extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Team Member widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_team_member';
    }

    /**
     * Get widget title.
     *
     * Retrieve Team Member widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Team Member', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Team Member widget icon.
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
     * Retrieve the list of categories the Team Member widget belongs to.
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
     * Register Team Member widget controls.
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
                'label' => esc_html__( 'Content', 'electro-extensions' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'name',
            [
                'label'     => esc_html__( 'Full Name', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'description'   => esc_html__( 'Enter team member full name', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'designation',
            [
                'label'     => esc_html__( 'Designation', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'description'   => esc_html__( 'Enter designation of team member', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'profile_pic',
            [
                'label'     => esc_html__( 'Profile Pic', 'electro-extensions' ),
                'type'      => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'display_style',
            [
                'label'     => esc_html__( 'Display Style', 'electro-extensions' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'square'     => esc_html__( 'Square', 'electro-extensions' ),
                    'circle'     => esc_html__( 'Circle', 'electro-extensions' ),
                ],
                'default'   => 'circle',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => esc_html__( 'Link', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'description'   => esc_html__( 'Add link to the team member. Leave blank if there aren\'t any', 'electro-extensions' )
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'electro-extensions' ),
            ]
        );
        
        $this->end_controls_section();

    }

    /**
     * Render Banners widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );
       
        if( function_exists( 'electro_get_template' ) ) {

            $profile_pic = isset($profile_pic['id'] ) ? $profile_pic['id'] : '';

            electro_get_template( 'sections/team-member.php', array( 'profile_pic' => $profile_pic, 'title' => $name, 'designation' => $designation, 'display_style' => $display_style, 'link' => $link ) );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Team_Member );