<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Product Categories List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Product_Categories_List_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Product Categories List widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_product_categories_list_element';
    }

    /**
     * Get widget title.
     *
     * Retrieve Product Categories List widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Categories List', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Categories List widget icon.
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
     * Register Product Categories List widget controls.
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
            'columns',
            [
                'label' => esc_html__( 'Enter Columns', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the number of columns to display.', 'electro-extensions'),
            ]
        );

        $this->add_control(  
            'limit',
            [
                'label' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'description'   => esc_html__('Enter the number of products to display.', 'electro-extensions'),
                'default'=>'5',
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
                'label' => esc_html__( 'Order', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
                'default' => 'DESC',
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

     $this->end_controls_section();

 }

    /**
     * Render Product Categories List widget output on the frontend.
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
            'columns'               => $columns,
            'category_args'         => $cat_args,
        );

        if( function_exists( 'electro_product_categories_list' ) ) {
            electro_product_categories_list( $args );
        }

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Product_Categories_List_Block );