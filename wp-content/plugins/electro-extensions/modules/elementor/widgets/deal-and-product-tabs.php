<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Deals and Products Tabs Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Deals_And_Products_Tabs_Element extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Deals and Products Tabs Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_deal_and_product_tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve Deals and Products Tabs Element Widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Deals and Products Tabs', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Deals and Products Tabs Element Widget icon.
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
     * Retrieve the list of categories the Deals and Products Tabs widget belongs to.
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
     * Register Deals and Products Tabs widget controls.
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
            'deal_title',
            [
                'label'         => esc_html__( 'Title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter title', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'deal_show_savings',
            [
                'label'         => esc_html__( 'Show Savings Details', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'false',
                'description'   => esc_html__( 'Deals savings text', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'deal_savings_in',
            [
                'label'         => esc_html__( 'Savings in', 'electro-extensions' ),
                'type'          => Controls_Manager::SELECT,
                'options' => [

                    'amount'        => esc_html__( 'Amount', 'electro-extensions' ),
                    'percentage'    => esc_html__( 'Percentage', 'electro-extensions' ),
                ],
                'default'=> 'amount',
            ]
        );

        $this->add_control(
            'deal_savings_text',
            [
                'label'         => esc_html__('Savings Text', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'deal_product_choice',
            [
                'label'         => esc_html__( 'Product Choice', 'electro-extensions' ),
                'type'          => Controls_Manager::SELECT,
                'options' => [

                    'recent'    =>esc_html__( 'Recent', 'electro-extensions' ),
                    'random'    =>esc_html__( 'Random', 'electro-extensions' ),
                    'specific'  =>esc_html__( 'Specific', 'electro-extensions' ),
                ],
                'default'=> 'recent',
            ]
        );


        $this->add_control(
            'deal_product_id',
            [
                'label'         => esc_html__('Product ID', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
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
                        'label' => esc_html__( 'Title', 'electro-extensions' ),
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
                        'name'  => 'product_limit',
                        'label' => esc_html__( 'Limit', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description' => esc_html__( 'Enter the number of products to display.', 'electro-extensions' ),
                        'default'=> '6',
                    ],
                    [
                        'name'  => 'columns',
                        'label' => esc_html__( 'Columns', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the number of columns to display.', 'electro-extensions'),
                        'default'=> '3',
                    ],
                    [
                        'name'  => 'product_limit_wide',
                        'label' => esc_html__( 'Wide Layout Limit', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description' => esc_html__( 'Enter the number of wide products to display.', 'electro-extensions' ),
                        'default'=> '8',
                    ],
                    [
                        'name'  => 'product_columns_wide',
                        'label' => esc_html__( 'Tab Products Wide Layout Columns', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description' => esc_html__( 'Enter the number of tap products wide layout columns to display.', 'electro-extensions' ),
                        'default'=> '4',
                    ],
                    [
                        'name'  => 'orderby',
                        'label' => esc_html__( 'Order by', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter orderby.', 'electro-extensions'),
                        'default' => 'date',
                    ],

                    [
                        'name'  => 'order',
                        'label' => esc_html__( 'Order', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description' =>esc_html__('Enter order', 'electro-extensions' ),
                        'default' => 'DESC',
                    ],
                    [
                        'name'  => 'products_choice',
                        'label' => esc_html__( 'Product Choice', 'electro-extensions' ),
                        'type'  => Controls_Manager::SELECT,
                        'options'       => [
                            'ids'       =>esc_html__( 'IDs', 'electro-extensions' ),
                            'skus'      =>esc_html__( 'SKUs', 'electro-extensions' ),       
                        ],
                        'default'       =>'ids',
                    ],
                    [
                        'name'  => 'product_id',
                        'label' => esc_html__( 'Product IDs or SKUs', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description' =>esc_html__('Enter IDs/SKUs separate by comma(,).', 'electro-extensions' ),
                    ],
                    [
                        'name'  => 'category',
                        'label' => esc_html__( 'Category', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter slug separate by comma(,).', 'electro-extensions'),
                    ],
                    [
                        'name'  => 'cat_operator',
                        'label' => esc_html__( 'Category Operator', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
                        'default'         => 'IN',
                    ],
                ],
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Deals and Products Tabs Block output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if( is_object( $tabs ) || is_array( $tabs ) ) {
            $tabs = json_decode( json_encode( $tabs ), true );
        } else {
            $tabs = json_decode( urldecode( $tabs ), true );
        }

        $tabs_args = array();

        if( is_array( $tabs ) ) {
            foreach ( $tabs as $key => $tab ) {

                extract( $tab );

                if ( electro_is_wide_enabled() ) {
                    $per_page   = $product_limit_wide;
                } else {
                    $per_page   = $product_limit;
                }
                
                $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id ) ) : array();
                $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby,'per_page' => $per_page, 'columns' => $columns ) );

                $tabs_args[] = array(
                    'title'             => $title,
                    'shortcode_tag'     => $shortcode_tag,
                    'atts'              => $shortcode_atts,
                );
            }
        }

        $deal_args = array(
            'is_enabled'        => 'yes',
            'section_title'     => $deal_title,
            'show_savings'      => $deal_show_savings,
            'savings_in'        => $deal_savings_in,
            'savings_text'      => $deal_savings_text,
            'product_choice'    => $deal_product_choice,
            'product_id'        => $deal_product_id,
        );

        $args = array(
            'deal_products_args'    => $deal_args,
            'product_tabs_args'     => array(
                'tabs'                  => $tabs_args,
                'columns_wide'          => $product_columns_wide,
            ),
        );

        if( function_exists( 'electro_deal_and_tabs_block' ) ) {
            electro_deal_and_tabs_block( $args );
        }

    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Deals_And_Products_Tabs_Element );