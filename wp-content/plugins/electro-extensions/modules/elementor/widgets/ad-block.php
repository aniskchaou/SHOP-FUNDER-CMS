<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Ad Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Ad_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Ad Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_ads_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Ad Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Ad Block', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Ad Block widget icon.
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
     * Register Ad Block widget controls.
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
            'ads_block',
            [
                'label'  => esc_html__( 'Ad block', 'electro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'ad_text',
                        'label' => esc_html__( 'Ad text', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'action_text',
                        'label' => esc_html__( 'Action Text', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'ad_image',
                        'label' => esc_html__( 'Ad image', 'electro-extensions' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'action_link',
                        'label' => esc_html__( 'Action Link', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                ],
                'default' => [],
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

        $args = array();


        if ( $ads_block ) {
            foreach (  $settings['ads_block'] as $ad_block ) {

                $image_attributes = isset( $ad_block['ad_image']['id'] ) ? wp_get_attachment_image_src ($ad_block['ad_image']['id'], 'full' ) : '';

                $args[] = array(
                    'action_text'  => isset( $ad_block['action_text'] ) ? $ad_block['action_text'] : '',
                    'ad_text'      => isset( $ad_block['ad_text'] ) ? $ad_block['ad_text'] : '',
                    'action_link'  => isset( $ad_block['action_link'] ) ? $ad_block['action_link'] : '',
                    'ad_image'     => isset( $image_attributes ) ? $image_attributes[0] : '',
                );
            }
        }

        if( function_exists( 'electro_ads_block' ) ) {
            electro_ads_block( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Ad_Block );