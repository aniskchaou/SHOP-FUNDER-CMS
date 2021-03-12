<?php
/**
 * Functions used in Home v6 
 */

function electro_get_default_home_v6_options() {
    $home_v6 = array(
        'pcbvt'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 10,
            'animation'         => '',
            'bg_img'            => '',
            'tabs'         => array(
                array(
                    'title'             => esc_html__( 'Gaming Monitors 65', 'electro' ),
                    'tab_title'         => wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                    'tab_sub_title'     => wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                    'action_text'       => esc_html__( 'Start Buying', 'electro' ),
                    'action_link'       => '#'
                ),
                array(
                    'title'             => esc_html__( 'Smartphones Sale', 'electro' ),
                    'tab_title'         => wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                    'tab_sub_title'     => wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                    'action_text'       => esc_html__( 'Start Buying', 'electro' ),
                    'action_link'       => '#'
                ),
                array(
                    'title'             => esc_html__( 'End Season Sale', 'electro' ),
                    'tab_title'         => wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                    'tab_sub_title'     => wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                    'action_text'       => esc_html__( 'Start Buying', 'electro' ),
                    'action_link'       => '#'
                ),
                array(
                    'title'             => esc_html__( 'Laptops Arrivals', 'electro' ),
                    'tab_title'         => wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                    'tab_sub_title'     => wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                    'action_text'       => esc_html__( 'Start Buying', 'electro' ),
                    'action_link'       => '#'
                ),
                array(
                    'title'             => esc_html__( 'Earphones - 25%', 'electro' ),
                    'tab_title'         => wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                    'tab_sub_title'     => wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                    'action_text'       => esc_html__( 'Start Buying', 'electro' ),
                    'action_link'       => '#'
                ),
                array(
                    'title'             => esc_html__( 'Tablets 10 inch Sale', 'electro' ),
                    'tab_title'         => wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                    'tab_sub_title'     => wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                    'action_text'       => esc_html__( 'Start Buying', 'electro' ),
                    'action_link'       => '#'
                )
            ),
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
        'tbrs'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
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
        'cic'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
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
        'ptcwd'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Catch Daily Deals!', 'electro' ),
            'button_text'       => wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
            'button_link'       => '#',
            'product_limit'     => 20,
            'product_columns'   => 5,
            'deal'          => array(
                'is_enabled'        => 'yes',
                'section_title'     => esc_html__( 'Special Offer', 'electro' ),
                'product_choice'    => 'random',
                'product_id'        => '',
                'savings_in'        => 'amount',
            ),
            'tabs'              => array(
                array(
                    'title'     => esc_html__( '-80% off', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'recent_products',
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
                        'shortcode'             => 'featured_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                )
            ),
            'carousel_args' => array(
                'items'         => 1,
                'dots'          => true,
                'nav'           => false,
                'autoplay'      => 'no',
            )
        ),
        'pc'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Trending products', 'electro' ),
            'button_text'       => wp_kses_post( __( 'See All Trending products', 'electro' ) ),
            'button_link'       => '#',
            'product_limit'     => 20,
            'product_columns'   => 6,
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args' => array(
                'items'         => 6,
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
        'bd'    => array(
            'is_enabled'    => 'yes',
            'priority'      => 60,
            'animation'     => '',
            'image'         => 0,
            'link'          => '#',
        ),
        'pcwi1' => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Laptops & Computers', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 6,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'img_action_link'   => '#',
            'description'       => 'no',
            'product_limit'     => 20,
            'product_columns'   => 5,
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'     => array(
                'autoplay'              => 'no',
                'nav'                   => false,
                'dots'                  => true,
                'responsive'            => array(
                    '0'         => array( 'items' => 2 ),
                    '480'       => array( 'items' => 2 ),
                    '768'       => array( 'items' => 2 ),
                    '992'       => array( 'items' => 3 ),
                    '1024'      => array( 'items' => 4 ),
                    '1200'      => array( 'items' => 5 ),
                )
            )
        ),
        'pcwi2' => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones & Tablets', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 6,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'img_action_link'   => '#',
            'description'       => 'no',
            'product_limit'     => 20,
            'product_columns'   => 5,
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'     => array(
                'autoplay'              => 'no',
                'nav'                   => false,
                'dots'                  => true,
                'responsive'            => array(
                    '0'         => array( 'items' => 2 ),
                    '480'       => array( 'items' => 2 ),
                    '768'       => array( 'items' => 2 ),
                    '992'       => array( 'items' => 3 ),
                    '1024'      => array( 'items' => 4 ),
                    '1200'      => array( 'items' => 5 ),
                )
            )
        ),
        'ad'    => array(
            'is_enabled'    => 'yes',
            'priority'      => 90,
            'animation'     => '',
            array(
                'ad_text'       => wp_kses_post( __( 'Catch Big <br><strong>Deals</strong> on the Cameras', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Shop the <strong>Hottest</strong> Products', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix"></span></span>', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'The New Standard <br><strong>360 Cameras</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix"></span></span>', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
        ),
        'rvp'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 100,
            'animation'         => '',
            'section_title'     => esc_html__( 'Your Recently Viewed Products', 'electro' ),
            'shortcode_atts'    => array( 
                'columns'           => '8',
                'per_page'          => '20'
            ),
            'carousel_args' => array(
                'items'         => 8,
                'dots'          => true,
                'autoplay'      => 'no',
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 8 )
                )
            )
        ),
    );

    return apply_filters( 'electro_home_v6_default_options', $home_v6 );
}

function electro_get_home_v6_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v6_options = get_post_meta( $post->ID, '_home_v6_options', true );
        $home_v6_options = maybe_unserialize( $clean_home_v6_options );

        if( ! is_array( $home_v6_options ) ) {
            $home_v6_options = json_decode( $clean_home_v6_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v6_options();
            $home_v6 = wp_parse_args( $home_v6_options, $default_options );
        } else {
            $home_v6 = $home_v6_options;
        }

        return apply_filters( 'electro_home_v6_meta', $home_v6, $post );
    }
}

if( ! function_exists( 'electro_home_v6_hook_control' ) ) {
    function electro_home_v6_hook_control() {
        if( is_page_template( array( 'template-homepage-v6.php' ) ) ) {
            remove_all_actions( 'homepage_v6' );

            $home_v6 = electro_get_home_v6_meta();

            $is_enabled = isset( $home_v6['hpc']['is_enabled'] ) ? $home_v6['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v6',  'electro_page_template_content',            isset( $home_v6['hpc']['priority'] ) ? intval( $home_v6['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v6',  'electro_home_v6_products_carousel_banner_vertical_tabs',   isset( $home_v6['pcbvt']['priority'] ) ? intval( $home_v6['pcbvt']['priority'] ) : 10 );
            add_action( 'homepage_v6',  'electro_home_v6_two_banners',                              isset( $home_v6['tbrs']['priority'] ) ? intval( $home_v6['tbrs']['priority'] ) : 20 );
            add_action( 'homepage_v6',  'electro_home_v6_category_icons_carousel',                  isset( $home_v6['cic']['priority'] ) ? intval( $home_v6['cic']['priority'] ) : 30 );
            add_action( 'homepage_v6',  'electro_home_v6_product_tabs_carousel_with_deal',          isset( $home_v6['ptc']['priority'] ) ? intval( $home_v6['ptc']['priority'] ) : 40 );
            add_action( 'homepage_v6',  'electro_home_v6_products_carousel',                        isset( $home_v6['pc']['priority'] ) ? intval( $home_v6['pc']['priority'] ) : 50 );
            add_action( 'homepage_v6',  'electro_home_v6_ad_banner',                                isset( $home_v6['bd']['priority'] ) ? intval( $home_v6['bd']['priority'] ) : 60 );
            add_action( 'homepage_v6',  'electro_home_v6_products_carousel_width_image_1',          isset( $home_v6['pcwi1']['priority'] ) ? intval( $home_v6['pcwi1']['priority'] ) : 70 );
            add_action( 'homepage_v6',  'electro_home_v6_products_carousel_width_image_2',          isset( $home_v6['pcwi2']['priority'] ) ? intval( $home_v6['pcwi2']['priority'] ) : 80 );
            add_action( 'homepage_v6',  'electro_home_v6_ads_block',                                isset( $home_v6['ad']['priority'] ) ? intval( $home_v6['ad']['priority'] ) : 90 );
            add_action( 'homepage_v6',  'electro_home_v6_recent_viewed_products',                   isset( $home_v6['rvp']['priority'] ) ? intval( $home_v6['rvp']['priority'] ) : 100 );
        }
    }
}