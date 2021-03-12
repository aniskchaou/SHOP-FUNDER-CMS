<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Carousel Tabs With Deal Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Products_Carousel_Tabs_With_Deal extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products Carousel Tabs With Deal name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_products_carousel_tabs_with_deal';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products Carousel Tabs With Deal title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Carousel Tabs With Deal', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products Carousel Tabs With Deal icon.
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
     * Retrieve the list of categories the Products Carousel Tabs With Deal belongs to.
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
     * Register Products Carousel Tabs With Deal Product controls.
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
            'section_title',
            [
                'label'         => esc_html__( 'Section Title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Action Text', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Action Link', 'electro-extensions' ),
                'type'  => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your link text here', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'deal_title',
            [
                'label'         => esc_html__( 'Deals Title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
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
                'default'       => 'true',
            ]
        );

        $this->add_control(
            'deal_savings_in',
            [
                'label'     => esc_html__( 'Savings in', 'electro-extensions' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'amount'        => esc_html__( 'Amount','electro-extensions'),
                    'percentage'    => esc_html__( 'Percentage','electro-extensions'),
                ],
                'default' => 'percentage',
            ]
        );

        $this->add_control(
            'deal_savings_text',
            [
                'label'         => esc_html__( 'Savings Text', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'deal_product_choice',
            [
                'label'     => esc_html__( 'Product Choice', 'electro-extensions' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'recent'    => esc_html__( 'Recent','electro-extensions'),
                    'random'    => esc_html__( 'Random','electro-extensions'),
                    'specific'  => esc_html__( 'Specific','electro-extensions'),
                ],
                'default'   => 'recent',
            ]
        );

        $this->add_control(
            'deal_product_id',
            [
                'label'         => esc_html__( 'Product id or SKUs', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter IDs/SKUs separate by comma(,).', 'electro-extensions' ),
                'condition'     => [
                    'deal_product_choice' => 'specific',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__( 'Tabs', 'electro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'          => 'title',
                        'label'         => esc_html__( 'Title', 'electro-extensions' ),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__( 'Enter your title here', 'electro-extensions' ),
                    ],
                    [
                        'name'      => 'shortcode_tag',
                        'label'     => esc_html__( 'Shortcode Tags', 'electro-extensions' ),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => [
                            'featured_products'     => esc_html__( 'Featured Products','electro-extensions'),
                            'sale_products'         => esc_html__( 'On Sale Products','electro-extensions'),
                            'top_rated_products'    => esc_html__( 'Top Rated Products','electro-extensions'),
                            'recent_products'       => esc_html__( 'Recent Products','electro-extensions'),
                            'best_selling_products' => esc_html__( 'Best Selling Products','electro-extensions'),
                            'product_category'      => esc_html__( 'Product Category','electro-extensions'),
                            'product_attribute'     => esc_html__( 'Product Attribute','electro-extensions'),
                            'products'              => esc_html__( 'Products','electro-extensions')
                        ],
                        'default' => 'recent_products',
                    ],
                    [
                        'name'          => 'orderby',
                        'label'         => esc_html__( 'Orderby', 'electro-extensions' ),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__( 'Enter Orderby', 'electro-extensions' ),
                        'default'       => 'date',
                    ],
                    [
                        'name'          => 'order',
                        'label'         => esc_html__( 'Order', 'electro-extensions' ),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__( 'Enter Order', 'electro-extensions' ),
                        'default'       => 'DESC',
                    ],
                    [
                        'name'          => 'products_choice',
                        'label'         => esc_html__('Product Choice', 'electro-extensions'),
                        'type'          => Controls_Manager::SELECT,
                        'options'       => [
                            'ids'           => esc_html__( 'IDs','electro-extensions'),
                            'skus'          => esc_html__( 'SKUs','electro-extensions'),
                        ],
                        'condition'     => [
                            'shortcode_tag' => 'products',
                        ],
                    ],
                    [
                        'name'          => 'product_id',
                        'label'         => esc_html__( 'Product id or SKUs', 'electro-extensions' ),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__( 'Enter IDs/SKUs separate by comma(,).', 'electro-extensions' ),
                        'condition'     => [
                            'shortcode_tag' => 'products',
                        ],
                    ],
                    [
                        'name'          => 'category',
                        'label'         => esc_html__('Category', 'electro-extensions'),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__('Enter slug separate by comma(,).', 'electro-extensions'),
                        'condition'     => [
                            'shortcode_tag' => 'product_category',
                        ],
                    ],
                    [
                        'name'          => 'cat_operator',
                        'label'         => esc_html__('Category Operator', 'electro-extensions'),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
                        'default'       => 'IN',
                        'condition'     => [
                            'shortcode_tag' => 'product_category',
                        ],
                    ],
                    [
                        'name'          => 'attribute',
                        'label'         => esc_html__('Attribute', 'electro-extensions'),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__('Enter single attribute slug.', 'electro-extensions'),
                        'condition'     => [
                            'shortcode_tag' => 'product_attribute',
                        ],
                    ],
                    [
                        'name'          => 'terms',
                        'label'         => esc_html__('Terms', 'electro-extensions'),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__('Enter single attribute slug.', 'electro-extensions'),
                        'condition'     => [
                            'shortcode_tag' => 'product_attribute',
                        ],
                    ],
                    [
                        'name'          => 'terms_operator',
                        'label'         => esc_html__('Terms Operator', 'electro-extensions'),
                        'type'          => Controls_Manager::TEXT,
                        'placeholder'   => esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
                        'default'       => 'IN',
                        'condition'     => [
                            'shortcode_tag' => 'product_attribute',
                        ],
                    ],
                ],
                'default' => [],
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => esc_html__( 'Limit', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '20',
            ]
        );

        $this->add_control(
            'rows',
            [
                'label'         => esc_html__( 'Rows', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '2',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label'         => esc_html__( 'Columns', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '5',
            ]
        );

        $this->add_control(
            'is_dots',
            [
                'label'         => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->add_control(
            'is_autoplay',
            [
                'label'         => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                'return_value'  => 'true',
                'default'       => 'true',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Products Carousel Tabs With Deal output on the frontend.
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

                $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
                $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'per_page' => $per_page ) );

                $tabs_args[] = array(
                    'title'             => $title,
                    'shortcode_tag'     => $shortcode_tag,
                    'atts'              => $shortcode_atts,
                );
            }
        }

        $deal_args = array(
            'is_enabled'        => 'yes',
            'section_title'     => isset( $deal_title ) ? $deal_title : '',
            'show_savings'      => isset( $deal_show_savings ) ? $deal_show_savings : '',
            'savings_in'        => isset( $deal_savings_in ) ? $deal_savings_in : '',
            'savings_text'      => isset( $deal_savings_text ) ? $deal_savings_text : '',
            'product_choice'    => isset( $deal_product_choice ) ? $deal_product_choice : '',
            'product_id'        => isset( $deal_product_id ) ? $deal_product_id : '',
        );

        $args = array(
            'section_title'         => isset( $section_title ) ? $section_title : '',
            'button_text'           => isset( $button_text ) ? $button_text : '',
            'button_link'           => isset( $button_link ) ? $button_link : '',
            'deal_products_args'    => $deal_args,
            'columns'               => isset( $columns ) ? $columns : '',
            'rows'                  => isset( $rows ) ? $rows : '',
            'per_page'              => isset( $per_page ) ? $per_page : '',
            'tabs'                  => $tabs_args,
            'el_class'              => isset( $el_class ) ? $el_class : '',
            'carousel_args' => array(
                'items'         => 1,
                'autoplay'      => isset( $is_autoplay ) ? $is_autoplay : '',
                'dots'          => isset( $is_dots ) ? $is_dots : '',
            )
        );

        if( function_exists( 'electro_products_carousel_tabs_with_deal' ) ) {
            electro_products_carousel_tabs_with_deal( $args );
        }

    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Products_Carousel_Tabs_With_Deal );