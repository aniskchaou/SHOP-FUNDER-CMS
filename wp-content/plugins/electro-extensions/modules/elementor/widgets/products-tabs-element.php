<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Product Tabs Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Product_Tabs_Elements extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Product Tabs name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_product_tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve Product Tabs title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Tabs', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Tabs icon.
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
     * Retrieve the list of categories the Product Tabs belongs to.
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
     * Register Product Tabs controls.
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
            'tabs',
            [
                'label'  => esc_html__( 'Products Tabs Element', 'electro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'title',
                        'label' => esc_html__( 'title', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter title.', 'electro-extensions'),
                    ],
                    [
                        'name'  => 'shortcode_tag',
                        'label' => esc_html__( 'Shortcode', 'electro-extensions' ),
                        'type'  => Controls_Manager::SELECT,
                        'options'   => [
                            'featured_products'     => esc_html__( 'Featured Products','electro-extensions'),
                            'sale_products'         => esc_html__( 'On Sale Products','electro-extensions'),
                            'top_rated_products'    => esc_html__( 'Top Rated Products','electro-extensions'),
                            'recent_products'       => esc_html__( 'Recent Products','electro-extensions'),
                            'best_selling_products' => esc_html__( 'Best Selling Products','electro-extensions'),
                            'product_category'      => esc_html__( 'Product Category','electro-extensions'),
                            'products'              => esc_html__( 'Products','electro-extensions')
                        ],
                        'default' => 'recent_products',
                    ],
                    [
                        'name'  => 'per_page',
                        'label' => esc_html__( 'Limit', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the number of products to display.', 'electro-extensions'),
                        'default'=>'6',
                    ],
                    [
                        'name'  => 'columns',
                        'label' => esc_html__( 'Columns', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the number of columns to display.', 'electro-extensions'),
                        'default'=>'5',
                    ],

                    [
                        'name'  => 'columns_wide',
                        'label' => esc_html__( 'Columns Wide', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the number of columns wide to display.', 'electro-extensions'),
                        'default'=>'3',
                    ],
                    [
                        'name'  => 'category',
                        'label' => esc_html__( 'Category', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter slug separate by comma(,).', 'electro-extensions'),
                    ],
                    [
                        'name'  => 'orderby',
                        'label' => esc_html__( 'Order By', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter orderby.', 'electro-extensions'),
                        'default'   => 'date'
                    ],
                    [
                        'name'  => 'order',
                        'label' => esc_html__( 'Order', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter order.', 'electro-extensions'),
                        'default'   => 'desc'
                    ],
                                 
                ],
                'default' => [],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Electro Onsale Product output on the frontend.
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

        if( is_object( $tabs ) || is_array( $tabs ) ) {
            $tabs = json_decode( json_encode( $tabs ), true );
        } else {
            $tabs = json_decode( urldecode( $tabs ), true );
        }

        $tabs_args = array();
        
        if( is_array( $tabs ) ) {
            foreach ( $tabs as $key => $tab ) {

                extract(shortcode_atts(array(
                    'title'                 => '',
                    'shortcode_tag'         => 'recent_products',
                    'per_page'              => 3,
                    'columns'               => 3,
                    'orderby'               => 'date',
                    'order'                 => 'desc',
                    'products_choice'       => 'ids',
                    'product_id'            => '',
                    'columns_wide'          => 5,
                    'category'              => '',
                    'cat_operator'          => 'IN',
                ), $tab));
                
                $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id ) ) : array();
                $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'columns_wide' => $columns_wide, 'per_page' => $per_page ) );

                $tabs_args[] = array(
                    'title'             => $title,
                    'shortcode_tag'     => $shortcode_tag,
                    'atts'              => $shortcode_atts,
                );
            }
        }

        $args = array(
            'tabs'              => $tabs_args,
        );

        if( function_exists( 'electro_products_tabs' ) ) {
            electro_products_tabs( $args );
        }

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Product_Tabs_Elements );