<?php
/**
 * Functions used in Home v7
 */

function electro_get_default_home_v7_options() {
    $home_v7 = array(
        'vscwa'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 10,
            'animation'         => '',
            'slider_shortcode'  => '',
            'nav'              => array(
                'is_enabled'        => 'yes',
                'menu_title'        => esc_html__( 'Departments', 'electro' ),
                'menu_action_text'  => esc_html__( 'View All', 'electro' ),
                'menu_action_link'  => '#',
                'menu'              => 'all-departments-menu',
            ),
            'cat'              => array(
                'is_enabled'        => 'yes',
                'number'            => 5,
                'columns'           => 5,
                'slug'              => '',
                'hide_empty'        => 'yes',
            ),
            'ads'     => array(
                'is_enabled'        => 'yes',
                array(
                    'ad_text'       => wp_kses_post( __( 'Catch Big <strong>Deals</strong> on<br>The Consoles', 'electro' ) ),
                    'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => '#',
                    'ad_image'      => '',
                    'el_class'      => '',
                ),
                array(
                    'ad_text'       => wp_kses_post( __( 'Shop the <strong>Hottest</strong><br>Products', 'electro' ) ),
                    'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => '#',
                    'ad_image'      => '',
                    'el_class'      => '',
                ),
                array(
                    'ad_text'       => wp_kses_post( __( 'Laptops Notebooks<br> <strong>and More</strong>', 'electro' ) ),
                    'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => '#',
                    'ad_image'      => '',
                    'el_class'      => '',
                ),
            )
        ),
        'pcwt'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'section_title'     => esc_html__( 'Deals of The Day', 'electro' ),
            'timer_title'       => 'Ends in:',
            'header_timer'      => 'yes',
            'timer_value'       => '+8 hours',
            'button_text'       => wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
            'button_link'       => '#',
            'product_limit'     => 20,
            'product_columns'   => 7,
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args' => array(
                'items'         => 7,
                'dots'          => true,
                'nav'           => true,
                'autoplay'      => 'no',
                'navText'       => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 7 )
                )
            )
        ),
        'bd'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
            'animation'         => '',
            'image'             => 0,
            'link'              => '#',
        ),
        'pwci' => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Popular Categories this Week', 'electro' ),
            'enable_categories' => false,
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 3,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'vcategory_args'    => array(
                'number'            => 10,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'img_action_link'       => '#',
            'product_columns_wide'  => 4,
            'content'               => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 8,
                    'columns'       => 4
                )
            )
        ),
        'tbrs'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            ),
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            )
        ),
        'pcwi1' => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Headphones', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 4,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'img_action_link'   => '#',
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 6,
                    'columns'       => 6,
                    'columns_wide'  => 6
                )
            )
        ),
        'pcwi2' => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones & Tablets', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'Featured Phones', 'electro' ),
            'category_args'     => array(
                'number'            => 5,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'img_action_link'   => '#',
            'content'           => array(
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 6,
                    'columns'       => 6,
                    'columns_wide'  => 6
                )
            )
        ),
        'awb'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'ads_banners'       => array(
                array(
                    'title'                 => wp_kses_post( __( 'G9 Laptops with<br>Ultra 4K HD Display', 'electro' ) ),
                    'description'           => wp_kses_post( __( 'and the fastest Intel Core i7 processor ever', 'electro' ) ),
                    'price'                 => wp_kses_post( __( '<span class="prefix">from</span><span class="value"><sup>$</sup>399</span>', 'electro' ) ),
                    'action_link'           => '#',
                    'banner_action_link'    => '#',
                )
            )
        ),
        'trp' => array(
            'is_enabled'        => 'yes',
            'priority'          => 90,
            'animation'         => '',
            'section_title'     => esc_html__( 'Recommendation For You', 'electro' ),
            'button_text'       => wp_kses_post( __( 'View All Recommendations', 'electro' ) ),
            'button_link'       => '#',
            'columns_wide'      => 6,
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 12,
                    'columns'       => 6
                )
            )
        ),
    );

    return apply_filters( 'electro_home_v7_default_options', $home_v7 );
}

function electro_get_home_v7_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v7_options = get_post_meta( $post->ID, '_home_v7_options', true );
        $home_v7_options = maybe_unserialize( $clean_home_v7_options );

        if( ! is_array( $home_v7_options ) ) {
            $home_v7_options = json_decode( $clean_home_v7_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v7_options();
            $home_v7 = wp_parse_args( $home_v7_options, $default_options );
        } else {
            $home_v7 = $home_v7_options;
        }

        return apply_filters( 'electro_home_v7_meta', $home_v7, $post );
    }
}

if( ! function_exists( 'electro_home_v7_hook_control' ) ) {
    function electro_home_v7_hook_control() {
        if( is_page_template( array( 'template-homepage-v7.php' ) ) ) {
            remove_all_actions( 'homepage_v7' );

            $home_v7 = electro_get_home_v7_meta();

            $is_enabled = isset( $home_v7['hpc']['is_enabled'] ) ? $home_v7['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v7',  'electro_page_template_content',            isset( $home_v7['hpc']['priority'] ) ? intval( $home_v7['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v7',  'electro_home_v7_slider_with_vertical_menu_categories_banners',     isset( $home_v7['vscwa']['priority'] ) ? intval( $home_v7['vscwa']['priority'] ) : 10 );
            add_action( 'homepage_v7',  'electro_home_v7_products_carousel_with_timer',                     isset( $home_v7['pcwt']['priority'] ) ? intval( $home_v7['pcwt']['priority'] ) : 20 );
            add_action( 'homepage_v7',  'electro_home_v7_ad_banner',                                        isset( $home_v7['bd']['priority'] ) ? intval( $home_v7['bd']['priority'] ) : 30 );
            add_action( 'homepage_v7',  'electro_home_v7_products_with_category_image',                     isset( $home_v7['pwci']['priority'] ) ? intval( $home_v7['pwci']['priority'] ) : 40 );
            add_action( 'homepage_v7',  'electro_home_v7_two_banners',                                      isset( $home_v7['tbrs']['priority'] ) ? intval( $home_v7['tbrs']['priority'] ) : 50 );
            add_action( 'homepage_v7',  'electro_home_v7_products_category_width_image_1',                  isset( $home_v7['pcwi1']['priority'] ) ? intval( $home_v7['pcwi1']['priority'] ) : 60 );
            add_action( 'homepage_v7',  'electro_home_v7_products_category_width_image_2',                  isset( $home_v7['pcwi2']['priority'] ) ? intval( $home_v7['pcwi2']['priority'] ) : 70 );
            add_action( 'homepage_v7',  'electro_home_v7_ads_with_banners',                                 isset( $home_v7['awb']['priority'] ) ? intval( $home_v7['awb']['priority'] ) : 80 );
            add_action( 'homepage_v7',  'electro_home_v7_two_row_products',                                 isset( $home_v7['trp']['priority'] ) ? intval( $home_v7['trp']['priority'] ) : 90 );
        }
    }
}
