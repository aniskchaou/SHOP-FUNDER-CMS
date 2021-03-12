<?php
/**
 * Functions used in Home v5 
 */

function electro_get_default_home_v5_options() {
    $home_v5 = array(
        'nav'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 4,
            'animation'     => '',
            'title'         => esc_html__( 'Electro Best Selling:', 'electro' ),
            'menu'          => '',
        ),
        'sdr'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            'shortcode'     => '',
        ),
        'dpc'   => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 10,
            'title'             => wp_kses_post( __( 'Limited <span>Week Deal</span>', 'electro' ) ),
            'sub_title'         => esc_html__( 'Hurry up before offer will end', 'electro' ),
            'product_limit'     => 4,
            'product_choice'    => 'random',
            'product_ids'       => '',
            'carousel_args'     => array(
                'autoplay'          => 'no',
                'dots'              => 'true',
            )
        ),
        'ptc'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'section_title'     => esc_html__( 'Save Big on Warehouse Cleaning', 'electro' ),
            'button_text'       => wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
            'button_link'       => '#',
            'product_limit'     => 18,
            'product_columns'   => 6,
            'tabs'              => array(
                array(
                    'title'     => esc_html__( '-80% off', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'featured_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                ),
                array(
                    'title'     => esc_html__( '-65%', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'sale_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                ),
                array(
                    'title'     => esc_html__( '-45%', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'top_rated_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                ),
                array(
                    'title'     => esc_html__( '-25%', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'recent_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                )
            ),
            'carousel_args' => array(
                'dots'          => true,
                'nav'           => true,
                'autoplay'      => 'no',
                'navText'       => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 6 )
                )
            )
        ),
        'ad'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 30,

            array(
                'ad_text'       => wp_kses_post( __( 'Catch Hottest<br> <strong>Deals</strong> in Cameras<br> Category', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Tablets,<br> Smartphones <br><strong>and more</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( '<span class="from"><span class="prefix">From</span><span class="value"><sup>$</sup>749</span><span class="suffix">99</span></span>', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
        ),
        'pc'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Trending products', 'electro' ),
            'button_text'       => wp_kses_post( __( 'Go to Trending products', 'electro' ) ),
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
        'pc1'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Popular Products', 'electro' ),
            'enable_categories' => false,
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 6,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'content'           => array(
                'shortcode'             => 'featured_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 20,
                    'columns'       => 7
                )
            ),
            'carousel_args'     => array(
                'items'         => '7',
                'autoplay'      => 'no',
                'nav'           => true,
                'navText'       => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'dots'          => true,
                'responsive'    => array(
                    '0'         => array( 'items' => 2 ),
                    '480'       => array( 'items' => 2 ),
                    '768'       => array( 'items' => 2 ),
                    '992'       => array( 'items' => 3 ),
                    '1200'      => array( 'items' => 7 )
                )
            )
        ),
        'bd'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'image'             => 0,
            'link'              => '#',
        ),
        'pc2'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Laptops & Computers', 'electro' ),
            'enable_categories' => false,
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 6,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'content'           => array(
                'shortcode'             => 'featured_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 20,
                    'columns'       => 7
                )
            ),
            'carousel_args'     => array(
                'items'         => '7',
                'autoplay'      => 'no',
                'nav'           => true,
                'navText'       => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'dots'          => true,
                'responsive'    => array(
                    '0'         => array( 'items' => 2 ),
                    '480'       => array( 'items' => 2 ),
                    '768'       => array( 'items' => 2 ),
                    '992'       => array( 'items' => 3 ),
                    '1200'      => array( 'items' => 7 )
                )
            )
        ),
        'pcc'   => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 80,
            'section_title'     => esc_html__( 'Television Entertainment', 'electro' ),
            'product_limit'     => 20,
            'product_columns'   => 3,
            'product_rows'      => 1,
            'cat_limit'         => 5,
            'cat_slugs'         => '',
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'     => array(
                'autoplay'      => 'no',
                'nav'           => true,
                'navText'       => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
            )
        ),
        'hcb'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 90,
            'animation'         => '',
            'section_title'     => '',
            'enable_full_width' => false,
            'columns'           => '3',
            'cat_slugs'         => '',
            'cat_args'          => array(
                'number'            => 6,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => true
            )
        ),
        'awb'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 100,
            'animation'         => '',
            'ads_banners'       => array(
                array(
                    'title'                 => wp_kses_post( __( 'G9 Laptops with<br>Ultra 4K HD Display', 'electro' ) ),
                    'description'           => wp_kses_post( __( 'and the fastest Intel Core i7 processor ever', 'electro' ) ),
                    'price'                 => wp_kses_post( __( '<span class="prefix">from</span><span class="value"><sup>$</sup>399</span>', 'electro' ) ),
                    'action_link'           => '#',
                    'banner_action_link'    => '#',
                    'is_align_end'          => 'no',
                ),
                array(
                    'title'                 => wp_kses_post( __( '<strong>Fresh Honor 9</strong><br>32GB Unlocked quadcore', 'electro' ) ),
                    'description'           => wp_kses_post( __( '<span>4GB RAM</span><span>64GB ROM</span><span>20MP + 12MP Dual Camera</span>', 'electro' ) ),
                    'price'                 => wp_kses_post( __( '<span class="prefix">now at</span><span class="value"><sup>$</sup>279</span>', 'electro' ) ),
                    'action_link'           => '#',
                    'banner_action_link'    => '#',
                    'is_align_end'          => 'yes',
                )
            )
        ),
    );

    return apply_filters( 'electro_home_v5_default_options', $home_v5 );
}

function electro_get_home_v5_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v5_options = get_post_meta( $post->ID, '_home_v5_options', true );
        $home_v5_options = maybe_unserialize( $clean_home_v5_options );

        if( ! is_array( $home_v5_options ) ) {
            $home_v5_options = json_decode( $clean_home_v5_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v5_options();
            $home_v5 = wp_parse_args( $home_v5_options, $default_options );
        } else {
            $home_v5 = $home_v5_options;
        }

        return apply_filters( 'electro_home_v5_meta', $home_v5, $post );
    }
}

if( ! function_exists( 'electro_home_v5_hook_control' ) ) {
    function electro_home_v5_hook_control() {
        if( is_page_template( array( 'template-homepage-v5.php' ) ) ) {
            remove_all_actions( 'homepage_v5' );

            $home_v5 = electro_get_home_v5_meta();

            $is_enabled = isset( $home_v5['hpc']['is_enabled'] ) ? $home_v5['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v5',  'electro_page_template_content',            isset( $home_v5['hpc']['priority'] ) ? intval( $home_v5['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v5',  'electro_home_v5_nav_menu',                 isset( $home_v5['nav']['priority'] ) ? intval( $home_v5['nav']['priority'] ) : 4 );
            add_action( 'homepage_v5',  'electro_home_v5_slider',                   isset( $home_v5['sdr']['priority'] ) ? intval( $home_v5['sdr']['priority'] ) : 10 );
            add_action( 'homepage_v5',  'electro_home_v5_product_tabs_carousel',    isset( $home_v5['ptc']['priority'] ) ? intval( $home_v5['ptc']['priority'] ) : 20 );
            add_action( 'homepage_v5',  'electro_home_v5_ads_block',                isset( $home_v5['ad']['priority'] ) ? intval( $home_v5['ad']['priority'] ) : 30 );
            add_action( 'homepage_v5',  'electro_home_v5_products_carousel',        isset( $home_v5['pc']['priority'] ) ? intval( $home_v5['pc']['priority'] ) : 40 );
            add_action( 'homepage_v5',  'electro_home_v5_product_carousel_v5_1',    isset( $home_v5['pc1']['priority'] ) ? intval( $home_v5['pc1']['priority'] ) : 50 );
            add_action( 'homepage_v5',  'electro_home_v5_ad_banner',                isset( $home_v5['bd']['priority'] ) ? intval( $home_v5['bd']['priority'] ) : 60 );
            add_action( 'homepage_v5',  'electro_home_v5_product_carousel_v5_2',    isset( $home_v5['pc2']['priority'] ) ? intval( $home_v5['pc2']['priority'] ) : 70 );
            add_action( 'homepage_v5',  'electro_home_v5_product_cards_carousel',   isset( $home_v5['pcc']['priority'] ) ? intval( $home_v5['pcc']['priority'] ) : 80 );
            add_action( 'homepage_v5',  'electro_home_v5_categories_block',         isset( $home_v5['hcb']['priority'] ) ? intval( $home_v5['hcb']['priority'] ) : 90 );
            add_action( 'homepage_v5',  'electro_home_v5_ads_with_banners',         isset( $home_v5['awb']['priority'] ) ? intval( $home_v5['awb']['priority'] ) : 100 );
        }
    }
}