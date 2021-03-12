<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Product List Categories .
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Product_List_Categories_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Product List Categories  widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_home_list_categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve Product List Categories  widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product List Categories ', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product List Categories  widget icon.
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
     * Register Product List Categories  widget controls.
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
                'placeholder'   => esc_html__('Enter title.', 'electro-extensions'),
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
                'label'     => esc_html__( 'Order by', 'electro-extensions' ),
                'type'      => Controls_Manager::TEXT,
                'description'   => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
                'default'   => 'date',
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
                'description'   => esc_html__('Enter the slugs seperate by comma(,).', 'electro-extensions'),
            ]
        ); 

        $this->add_control(
            'include',
            [
                'label' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the id seperate by comma(,).', 'electro-extensions'),
            ]
        );

     $this->end_controls_section();

 }

    /**
     * Render Product List Categories  widget output on the frontend.
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

        $args = array(
            'section_title'         => $title,
            'category_args'         => $cat_args,
        );

        if( function_exists( 'electro_home_list_categories' ) ) {
            electro_home_list_categories( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Product_List_Categories_Block );