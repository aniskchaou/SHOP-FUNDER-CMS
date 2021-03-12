<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Cards Carousel Block.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Products_Cards_Carousel_Block extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products Cards Carousel Block widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_products_cards_carousel_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products Cards Carousel Block widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Cards Carousel Block', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products Cards Carousel Block widget icon.
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
     * Retrieve the list of categories the Products Cards Carousel Block belongs to.
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
     * Register Products Cards Carousel Block widget controls.
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
            'rows',
            [
                'label' => esc_html__( 'Rows', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of rows.', 'electro-extensions'),
                'default'=>'1',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of columns.', 'electro-extensions'),
                'default'=>'3',
            ]
        );

        $this->add_control(
            'product_columns_wide',
            [
                'label' => esc_html__( 'Products Wide Layout Columns', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of columns.', 'electro-extensions'),
                'default'=>'4',
            ]
        );

        $this->add_control(
            'show_top_text',
            [
                'label' => esc_html__( 'Show Top Text', 'electro-extensions' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off' => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );

        $this->add_control(
            'show_categories',
            [
                'label' => esc_html__( 'Show Categories', 'electro-extensions' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off' => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );

        $this->add_control(  
            'limit',
            [
                'label' => esc_html__( 'Limit', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );


        $this->add_control(
            'shortcode_tag',
            [
                'label' => esc_html__( 'Shortcode', 'electro-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    'featured_products'     => esc_html__( 'Featured Products','electro-extensions'),
                    'sale_products'         => esc_html__( 'On Sale Products','electro-extensions'),
                    'top_rated_products'    => esc_html__( 'Top Rated Products','electro-extensions'),
                    'recent_products'       => esc_html__( 'Recent Products','electro-extensions'),
                    'best_selling_products' => esc_html__( 'Best Selling Products','electro-extensions'),
                    'product_category'      => esc_html__( 'Product Category','electro-extensions'),
                    'products'              => esc_html__( 'Products','electro-extensions'),
                ],
                'default' =>'recent_products'
            ]
        ); 


        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order by', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'products_choice',
            [

                'label' => esc_html__( 'Product Choice', 'electro-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'options'         => [
                    'ids'           =>esc_html__( 'IDs', 'electro-extensions' ),
                    'skus'          =>esc_html__( 'SKUs', 'electro-extensions' ),

                ],
                'default'       =>'ids',
            ]
        ); 

        $this->add_control(
            'product_id',
            [
                'label' => esc_html__( 'Product ID', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter IDs/SKUs separate by comma(,).', 'electro-extensions'),
            ]
        ); 


        $this->add_control(
            'category',
            [
                'label' => esc_html__( 'Category', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'    => esc_html__('Enter slug separate by comma(,).', 'electro-extensions'),
            ]
        ); 

        $this->add_control(
            'cat_operator',
            [
                'label' => esc_html__( 'Category Operator', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
                'value'         => 'IN',
            ]
        ); 

        $this->add_control(
            'is_autoplay',
            [
                'label' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        ); 

        $this->add_control(
            'cat_limit',
            [
                'label' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'cat_has_no_products',
            [
                'label' => esc_html__( 'Have no products', 'electro-extensions' ),
                'type'  => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'placeholder'   => esc_html__('Enter term slug separate by comma(,).', 'electro-extensions'),
                'return_value'  => 'true',
                'default'       => 'false',
            ]
        );

        $this->add_control(
            'cat_orderby',
            [
                'label' => esc_html__( 'Order by', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'cat_order',
            [
                'label' => esc_html__( 'Order', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter term slug separate by comma(,).', 'electro-extensions'),
            ]
        ); 

        $this->add_control(
            'cat_include',
            [
                'label' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter term id separate by comma(,).', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'cat_slugs',
            [
                'label' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter slug separate by comma(,).', 'electro-extensions'),
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

        $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id ) ) : array();
        $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'per_page' => $limit ) );

        $categories_args = array(
            'number'        => $cat_limit,
            'hide_empty'    => $cat_has_no_products,
            'orderby'       => $cat_orderby,
            'order'         => $cat_order,
        );


        if( ! empty( $cat_include ) ) {
            $cat_include = explode( ",", $cat_include );
            $categories_args['orderby'] = 'include';
        }

        if( ! empty( $cat_slugs ) ) {
            $cat_slugs = explode( ",", $cat_slugs );
            $categories_args['slug'] = $cat_slugs;

            $cat_include = array();

            foreach ( $cat_slugs as $cat_slug ) {
                $cat_include[] = "'" . $cat_slug ."'";
            }

            if ( ! empty($cat_include ) ) {
                $categories_args['include'] = $cat_include;
                $categories_args['orderby'] = 'include';
            }
        }

        $args = array(
            'section_args'  => array(
                'section_title'     => $title,
                'show_nav'          => false,
                'show_top_text'     => $show_top_text,
                'show_categories'   => $show_categories,
                'categories_args'   => $categories_args,
                'columns'           => $columns,
                'rows'              => $rows,
                'columns_wide'      => $product_columns_wide,
                'total'             => $limit,
            ),
            'carousel_args' => array(
                'autoplay'  => $is_autoplay,
            )
        );

        if( class_exists( '\Electro_Products' ) ) {
            $args['section_args']['products'] = \Electro_Products::$shortcode_tag( $shortcode_atts );
        }

        if( $show_top_text || $show_categories ) {
            $args['section_args']['show_nav'] = true;
        }

        if( function_exists( 'electro_product_cards_carousel' ) ) {
            electro_product_cards_carousel( $args['section_args'], $args['carousel_args'] );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Products_Cards_Carousel_Block );