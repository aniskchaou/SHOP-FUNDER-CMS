<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Categories List With Header Image.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Products_Categories_List_With_Header_Image_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products Categories List With Header Image widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_product_categories_list_with_header';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products Categories List With Header Image widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Categories List With Header Image', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products Categories List With Header Image widget icon.
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
     * Retrieve the list of categories the Products Categories List With Header Image widget belongs to.
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
     * Register Product Products Categories List With Header Image widget controls.
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
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(   
            'title',
            [
                'label' => esc_html__( 'Enter Title', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(   
            'sub_title',
            [
                'label' => esc_html__( 'Sub title', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(   
            'bg_image',
            [
                'label' => esc_html__( 'Background Image', 'electro-extensions' ),
                'type'  => Controls_Manager::MEDIA,
            ]
        );


        $this->add_control(   
            'enable_header',
            [
                'label' => esc_html__( 'Enable Header', 'electro-extensions' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
                'description'   => esc_html__( 'Show header block.', 'electro-extensions' ),
            ]
        );

        $this->add_control(   
            'columns',
            [
                'label' => esc_html__( 'Enter Columns', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(  
            'limit',
            [
                'label'     => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'default'   =>'6',
            ]
        );

        $this->add_control(
            'has_no_products',
            [
                'label' => esc_html__( 'Have no products', 'electro-extensions' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
                'description'   => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order by', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     => esc_html__( 'Order', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
                'default'   => 'DESC',
            ]
        );

        $this->add_control(
            'slugs',
            [
                'label' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
            ]
        ); 

        $this->add_control(
            'include',
            [
                'label' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Header Version', 'electro-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'options' => [
                    'v1' =>  esc_html__( 'Type 1', 'electro-extensions' ),
                    'v2' =>  esc_html__( 'Type 2', 'electro-extensions' )
                ],
            ]
        );

     $this->end_controls_section();

 }

    /**
     * Render Products Categories List With Header Image widget output on the frontend.
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
            'number'            => $limit,
            'hide_empty'        => $has_no_products,
            'orderby'           => $orderby,
            'order'             => $order,
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

        $bg_image = isset( $bg_image['id'] ) ? wp_get_attachment_image_src ($bg_image['id'], 'full' ) : '';

        $args = array(
            'section_title'         => $title,
            'sub_title'             => $sub_title,
            'bg_image'              => $bg_image,
            'enable_header'         => $enable_header,
            'type'                  => $type,
            'columns'               => $columns,
            'category_args'         => $cat_args,
        );

        if( function_exists( 'electro_product_categories_list_with_header' ) ) {
            electro_product_categories_list_with_header( $args );
        }

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Products_Categories_List_With_Header_Image_Block );