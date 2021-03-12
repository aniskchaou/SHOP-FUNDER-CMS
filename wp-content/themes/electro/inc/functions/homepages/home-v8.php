<?php
/**
 * Functions used in Home v8
 */

function electro_get_default_home_v8_options() {
    $home_v8 = array(
        'sdr'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            'shortcode'     => '',
        ),
        'cic'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'cat_slugs'         => '',
            'cat_args'          => array(
                'number'            => 20,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => true
            ),
            'carousel_args' => array(
                'items'         => 10,
                'dots'          => false,
                'nav'           => true,
                'autoplay'      => 'no',
                'navText'       => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 7 ),
                    '1430'  => array( 'items'   => 10 ),
                )
            )
        ),
        'ad'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 30,
            array(
                'ad_text'       => wp_kses_post( __( '<strong>#STAYHOME</strong> AND CATCH BIG <strong>DEALS</strong> ON THE GAMES &amp; CONSOLES', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => 'col-md-12 col-xl-6',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'SHOP THE <strong>HOTTEST</strong> PRODUCTS', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => 'col-md-6 col-xl-3',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'TABLETS, SMARTPHONES <strong>AND MORE</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => 'col-md-6 col-xl-3',
            ),
        ),
        'pc1'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Deals of The Day', 'electro' ),
            'button_text'       => wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
            'button_link'       => '#',
            'product_limit'     => 20,
            'product_columns'   => 7,
            'content'           => array(
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args' => array(
                'items'         => 7,
                'dots'          => true,
                'nav'           => false,
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
        'pct'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Popular Search', 'electro' ),
            'cat_slugs'         => '',
            'cat_args'          => array(
                'number'            => 10,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => true
            ),
        ),
        'pc2'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Laptops & Computers', 'electro' ),
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
                'nav'           => false,
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
        'pc3'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Headphones', 'electro' ),
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
                'nav'           => false,
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
        'pcos'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'cat_slugs'         => '',
            'cat_args'          => array(
                'number'            => 7,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => true
            ),
        ),
        'pc4'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 90,
            'animation'         => '',
            'section_title'     => esc_html__( 'TV Entertainment', 'electro' ),
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
                'nav'           => false,
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
        'pc5'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 100,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones & Tablets', 'electro' ),
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
                'nav'           => false,
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
        'tbrs'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 110,
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
        'pc6'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 120,
            'animation'         => '',
            'section_title'     => esc_html__( 'Cameras', 'electro' ),
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
                'nav'           => false,
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
    );

    return apply_filters( 'electro_home_v8_default_options', $home_v8 );
}

function electro_get_home_v8_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v8_options = get_post_meta( $post->ID, '_home_v8_options', true );
        $home_v8_options = maybe_unserialize( $clean_home_v8_options );

        if( ! is_array( $home_v8_options ) ) {
            $home_v8_options = json_decode( $clean_home_v8_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v8_options();
            $home_v8 = wp_parse_args( $home_v8_options, $default_options );
        } else {
            $home_v8 = $home_v8_options;
        }

        return apply_filters( 'electro_home_v8_meta', $home_v8, $post );
    }
}

if( ! function_exists( 'electro_home_v8_hook_control' ) ) {
    function electro_home_v8_hook_control() {
        if( is_page_template( array( 'template-homepage-v8.php' ) ) ) {
            remove_all_actions( 'homepage_v8' );

            $home_v8 = electro_get_home_v8_meta();

            $is_enabled = isset( $home_v8['hpc']['is_enabled'] ) ? $home_v8['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v8',  'electro_page_template_content',            isset( $home_v8['hpc']['priority'] ) ? intval( $home_v8['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v8', 'electro_home_v8_slider', isset( $home_v8['sdr']['priority'] ) ? intval( $home_v8['sdr']['priority'] ) : 10 );
            add_action( 'homepage_v8', 'electro_home_v8_category_icons_carousel', isset( $home_v8['cic']['priority'] ) ? intval( $home_v8['cic']['priority'] ) : 20 );
            add_action( 'homepage_v8', 'electro_home_v8_ads_block', isset( $home_v8['ad']['priority'] ) ? intval( $home_v8['ad']['priority'] ) : 30 );
            add_action( 'homepage_v8', 'electro_home_v8_products_carousel_1', isset( $home_v8['pc1']['priority'] ) ? intval( $home_v8['pc1']['priority'] ) : 40 );
            add_action( 'homepage_v8', 'electro_home_v8_product_category_tags', isset( $home_v8['pct']['priority'] ) ? intval( $home_v8['pct']['priority'] ) : 50 );
            add_action( 'homepage_v8', 'electro_home_v8_products_carousel_2', isset( $home_v8['pc2']['priority'] ) ? intval( $home_v8['pc2']['priority'] ) : 60 );
            add_action( 'homepage_v8', 'electro_home_v8_products_carousel_3', isset( $home_v8['pc3']['priority'] ) ? intval( $home_v8['pc3']['priority'] ) : 70 );
            add_action( 'homepage_v8', 'electro_home_v8_products_categories_1_6', isset( $home_v8['pcos']['priority'] ) ? intval( $home_v8['pcos']['priority'] ) : 80 );
            add_action( 'homepage_v8', 'electro_home_v8_products_carousel_4', isset( $home_v8['pc4']['priority'] ) ? intval( $home_v8['pc4']['priority'] ) : 90 );
            add_action( 'homepage_v8', 'electro_home_v8_products_carousel_5', isset( $home_v8['pc5']['priority'] ) ? intval( $home_v8['pc5']['priority'] ) : 100 );
            add_action( 'homepage_v8', 'electro_home_v8_two_banners', isset( $home_v8['tbrs']['priority'] ) ? intval( $home_v8['tbrs']['priority'] ) : 110 );
            add_action( 'homepage_v8', 'electro_home_v8_products_carousel_6', isset( $home_v8['pc6']['priority'] ) ? intval( $home_v8['pc6']['priority'] ) : 120 );
        }
    }
}