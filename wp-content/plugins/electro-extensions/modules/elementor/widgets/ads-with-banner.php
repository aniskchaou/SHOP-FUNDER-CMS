<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Ads with banners block Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Ads_with_banners_block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Ads with banners block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_ads_with_banners_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Ads with banners block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Ads with banners block', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Ads with banners block widget icon.
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
     * Retrieve the list of categories the Ads with banners block widget belongs to.
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
     * Register Ads with banners block widget controls.
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
            'ads_banners',
            [
                'label'  => esc_html__( 'Ads with banners block', 'electro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'title',
                        'label' => esc_html__( 'Title', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'description',
                        'label' => esc_html__( 'Description', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXTAREA,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'price',
                        'label' => esc_html__( 'Price', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'image',
                        'label' => esc_html__( 'Image', 'electro-extensions' ),
                        'type'  => Controls_Manager::MEDIA,
                    ],
                    [
                        'name'  => 'action_link',
                        'label' => esc_html__( 'Action link', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'banner_action_link',
                        'label' => esc_html__( 'Banner Action Link', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'banner_image',
                        'label' => esc_html__( 'Banner Image', 'electro-extensions' ),
                        'type'  => Controls_Manager::MEDIA,
                        'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
                    ],
                    [
                        'name'          => 'is_align_end',
                        'label'         => esc_html__( 'Banner Alignment', 'electro-extensions' ),
                        'type'          => Controls_Manager::SWITCHER,
                        'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                        'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                        'return_value'  => 'true',
                        'default'       => 'false',
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
     * Render Ads with banners block output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( $ads_banners ) {
            foreach (  $settings['ads_banners'] as $ad_banners ) {

                $ads_banners_args[] = array(
                    'title'   => isset( $ad_banners['title'] ) ? $ad_banners['title'] : '',
                    'description'      => isset( $ad_banners['description'] ) ? $ad_banners['description'] : '',
                    'price'  => isset( $ad_banners['price'] ) ? $ad_banners['price'] : '',
                    'image'     => isset( $ad_banners['image']['id'] ) ? wp_get_attachment_image_src ($ad_banners['image']['id'], 'full' ) : '',
                    'action_link'  => isset( $ad_banners['action_link'] ) ? $ad_banners['action_link'] : '',
                    'banner_action_link'  => isset( $ad_banners['banner_action_link'] ) ? $ad_banners['banner_action_link'] : '',
                    'banner_image'  =>  isset( $ad_banners['banner_image']['id'] ) ? wp_get_attachment_image_src ($ad_banners['banner_image']['id'], 'full' ) : '',
                    'is_align_end'  => isset( $ad_banners['is_align_end'] ) ? filter_var( $ad_banners['is_align_end'], FILTER_VALIDATE_BOOLEAN ) : ''

                );
            }
        }

        $args = array(
            'ads_banners'       => isset( $ads_banners_args ) ? $ads_banners_args : array(),
            'section_class'     => isset( $el_class ) ? $el_class : ''
        );

        if( function_exists( 'electro_ads_with_banners' ) ) {
            electro_ads_with_banners( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Ads_with_banners_block );