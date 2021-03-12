<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Product List Categories.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Electro_Elementor_Products_List_Categories_Menu extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Product List Categories widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'electro_product_categories_menu_list_elements';
    }

    /**
     * Get widget title.
     *
     * Retrieve Product List Categories Block title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product List Categories Menu', 'electro-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product List Categories Block icon.
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
     * Retrieve the list of categories the Product List Categories widget belongs to.
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
     * Register Product List Categories widget controls.
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
            'section_title',
            [
                'label'         => esc_html__( 'Section Title', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'placeholder'   => esc_html__( 'Enter your title here', 'electro-extensions' ),
            ]
        );
        
        $this->add_control(
            'product_list_categories_menu',
            [
                'label'  => esc_html__( 'Product List Categories Menu', 'electro-extensions' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => [

                    [
                        'name'  => 'title',
                        'label' => esc_html__( 'Title', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter title.', 'electro-extensions'),
                    ],
                    [
                        'name'  => 'limit',
                        'label' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'default'=>'5',
                    ],
                    [
                        'name'  => 'has_no_products',
                        'label' => esc_html__( 'Have no products', 'electro-extensions' ),
                        'type'  => Controls_Manager::SWITCHER,
                        'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
                        'label_on'      => esc_html__( 'Enable', 'electro-extensions' ),
                        'label_off'     => esc_html__( 'Disable', 'electro-extensions' ),
                        'return_value'  => 'true',
                        'default'       => 'false',


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
                        'name'  => 'slugs',
                        'label' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the slugs seperate by comma(,).', 'electro-extensions'),
                    ],
                    [
                        'name'  => 'include',
                        'label' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
                        'type'  => Controls_Manager::TEXT,
                        'description'   => esc_html__('Enter the id seperate by comma(,).', 'electro-extensions'),
                    ],
                ],
                'default' => [],
            ]
        );

        $this->add_control(
            'action_text',
            [
                'label'         => esc_html__( 'Action Text', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'action_link',
            [
                'label'         => esc_html__( 'Action Link', 'electro-extensions' ),
                'type'          => Controls_Manager::TEXT,
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Render Products Tabs Element Block output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );


        $list_categories_args = array();


        if( is_object( $product_list_categories_menu ) || is_array( $product_list_categories_menu ) ) {
            $product_list_categories_menu = json_decode( json_encode( $product_list_categories_menu ), true );
        } else {
            $product_list_categories_menu = json_decode( urldecode( $product_list_categories_menu ), true );
        }

        if( is_array( $product_list_categories_menu ) ) {
            foreach ( $product_list_categories_menu as $key => $list_category ) {  

                $cat_args = array(
                    'number'            => $list_category['limit'],
                    'hide_empty'        => $list_category['has_no_products'],
                    'orderby'           => $list_category['orderby'],
                    'order'             => $list_category['order'],
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

                $list_categories_args[] = array(
                    'title'                 => $list_category['title'],
                    'category_args'         => $cat_args,
                );
            }
        }

        $args = array(
            'section_title'         => $section_title,
            'category_list'         => $list_categories_args,
            'action_text'           => $action_text,
            'action_link'           => $action_link,
        );
        
        if( function_exists( 'electro_product_categories_menu_list' ) ) {
            electro_product_categories_menu_list( $args );
        }
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Electro_Elementor_Products_List_Categories_Menu );