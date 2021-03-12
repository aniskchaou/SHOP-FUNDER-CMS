<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Two Row Products Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_two_row_products extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Two Row Products widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_elementor_two_row_products_block';
    }

    /**
     * Get widget title.
     *
     * Retrieve Two Row Products widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Two Row Products', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Two Row Products widget icon.
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
     * Register Products Carousel widget controls.
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
            'title',
            [
                'label'         => esc_html__( 'Title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter your title here', 'electro-extensions' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'         => esc_html__( 'Action Text', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'         => esc_html__( 'Action Link', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'shortcode_tag',
            [
                'label'     => esc_html__( 'Shortcode Tags', 'electro-extensions' ),
                'type'      => Controls_Manager::SELECT,
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
            ]
        );

        $this->add_control(
            'limit',
            [   
                'label'         => esc_html__( 'Limit', 'electro-extensions' ),
                'label'         => esc_html__('Number of products to display', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '12',
            ]
        );

        $this->add_control(
            'columns',
            [   
                'label'         => esc_html__( 'columns', 'electro-extensions' ),
                'label'         => esc_html__('Enter the products columns to display', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '6',
            ]
        );

        $this->add_control(
            'columns_wide',
            [   
                'label'         => esc_html__( 'Columns Wide', 'electro-extensions' ),
                'label'         => esc_html__('Enter the products columns wide to display', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '6',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => esc_html__( 'Orderby', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => esc_html__( 'Order', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
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
                'label'         => esc_html__( 'Product id or SKUs', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter IDs/SKUs separate by comma(,).', 'electro-extensions' ),
            ]
        );

        $this->add_control( 
            'category',
            [
                'label'         => esc_html__('Category', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter slug separate by comma(,).', 'electro-extensions'),
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label'         => esc_html__('Category Operator', 'electro-extensions'),
                'type'          => Controls_Manager::TEXT,
                'description'   => esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
                'default'         => 'IN',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Two Row Products output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ): array();
        $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'per_page' => $limit ) );

        $args = array(
            'products_html'     => isset( $products_html ) ? $products_html : '',
            'section_title'     => isset( $title ) ? $title : '',
            'shortcode_tag'     => isset( $shortcode_tag ) ? $shortcode_tag : '',
            'shortcode_atts'    => isset( $shortcode_atts ) ? $shortcode_atts : '',
            'section_class'     => isset( $el_class ) ? $el_class : '',
            'button_text'       => isset( $button_text ) ? $button_text : '',
            'button_link'       => isset( $button_link ) ? $button_link : '',
            'columns_wide'      => isset( $columns_wide ) ? $columns_wide : '',
        );

        if( function_exists( 'electro_two_row_products' ) ) {
            electro_two_row_products( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Two_Row_Products );