<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Slider With Ads Block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Slider_With_Ads_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Slider With Ads Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_slider_with_ads_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Slider With Ads Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Slider With Ads Block', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Slider With Ads Block widget icon.
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
     * Retrieve the list of categories the Slider With Ads Block widget belongs to.
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
     * Register Slider With Ads Block widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $revsliders = array(
            esc_html__( 'No sliders found', 'electro-extensions' )      => '',
        );
        
        if ( class_exists( 'RevSlider' ) ) {
            $slider = new \RevSlider();
            $arrSliders = $slider->getArrSliders();

            if ( $arrSliders ) {
                foreach ( $arrSliders as $slider ) {
                    $revsliders[ $slider->getTitle() ] = $slider->getAlias();
                }
            }
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'electro-extensions' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'rev_slider_alias',
            [
                'label'         => esc_html__( 'Title', 'electro-extensions' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => $revsliders,
                'default'       => 'home-v1-slider',
            ]
        );


        $this->add_control(
            'ads_banners',
            [
                'label'  => esc_html__( 'Products Tabs Element', 'electro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [

                    [
                        'name'  => 'ad_image',
                        'label' => esc_html__( 'Ad image', 'electro-extensions' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
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
                        'name'  => 'action_link',
                        'label' => esc_html__( 'Action Link', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                ],
                'default' => [],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Slider With Ads Block widget output on the frontend.
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

        $ads_args = array();

        if( is_object( $ads_banners ) || is_array( $ads_banners ) ) {
            $ads_banners = json_decode( json_encode( $ads_banners ), true );
        } else {
            $ads_banners = json_decode( urldecode( $ads_banners ), true );
        }

        if( is_array( $ads_banners ) ) {
            foreach ( $ads_banners as $key => $ads_banner ) {

                extract(shortcode_atts(array(
                    'ad_text'               => '',
                    'action_text'           => '',
                    'action_link'           => '',
                    'ad_image'              => '',
                ), $ads_banner));

                $image_attributes = isset( $ads_banner['ad_image']['id'] ) ? wp_get_attachment_image_src ($ads_banner['ad_image']['id'], 'full' ) : '';

                
                $ads_args[] = array(
                    'ad_text'       => $ad_text,
                    'action_text'   => $action_text,
                    'action_link'   => $action_link,
                    'ad_image'      => isset( $image_attributes[0] ) ? $image_attributes[0] : '',
                );
            }
        }

        $slider_shortcode = '';
        if( ! empty( $rev_slider_alias ) ) {
            $slider_shortcode = '[rev_slider alias="' . $rev_slider_alias . '"]';
        }

        $args = array(
            'slider_shortcode'  => $slider_shortcode,
            'ads_args'          => $ads_args
        );
        
        if( function_exists( 'electro_slider_with_ads_block' ) ) {
            electro_slider_with_ads_block( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Slider_With_Ads_Block );