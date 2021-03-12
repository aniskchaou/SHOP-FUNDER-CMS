<?php
/**
 * Functions used in Home v2
 */

if( ! function_exists( 'electro_home_v2_hook_control' ) ) {
    function electro_home_v2_hook_control() {
        if( is_page_template( array( 'template-homepage-v2.php' ) ) ) {
            remove_all_actions( 'homepage_v2' );

            $home_v2 = electro_get_home_v2_meta();

            $is_enabled = isset( $home_v2['hpc']['is_enabled'] ) ? $home_v2['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v2',  'electro_page_template_content',            isset( $home_v2['hpc']['priority'] ) ? intval( $home_v2['hpc']['priority'] ) : 5 );
            }

            add_action( 'electro_content_top',  'electro_home_v2_slider',                       isset( $home_v2['sdr']['priority'] ) ? intval( $home_v2['sdr']['priority'] ) : 10 );
            add_action( 'homepage_v2',  'electro_home_v2_ads_block',                            isset( $home_v2['ad']['priority'] ) ? intval( $home_v2['ad']['priority'] ) : 20 );
            add_action( 'homepage_v2',  'electro_home_v2_products_carousel_tabs',               isset( $home_v2['pct']['priority'] ) ? intval( $home_v2['pct']['priority'] ) : 30 );
            add_action( 'homepage_v2',  'electro_home_v2_onsale_product',                       isset( $home_v2['dow']['priority'] ) ? intval( $home_v2['dow']['priority'] ) : 40 );
            add_action( 'homepage_v2',  'electro_home_v2_product_cards_carousel',               isset( $home_v2['pcc']['priority'] ) ? intval( $home_v2['pcc']['priority'] ) : 50 );
            add_action( 'homepage_v2',  'electro_home_v2_ad_banner',                            isset( $home_v2['bd']['priority'] ) ? intval( $home_v2['bd']['priority'] ) : 60 );
            add_action( 'homepage_v2',  'electro_home_v2_products_category_width_image_1',      isset( $home_v2['pcwi1']['priority'] ) ? intval( $home_v2['pcwi1']['priority'] ) : 70 );
            add_action( 'homepage_v2',  'electro_home_v2_products_category_width_image_2',      isset( $home_v2['pcwi2']['priority'] ) ? intval( $home_v2['pcwi2']['priority'] ) : 80 );
            add_action( 'homepage_v2',  'electro_home_v2_two_banners',                          isset( $home_v2['tbrs']['priority'] ) ? intval( $home_v2['tbrs']['priority'] ) : 90 );
            add_action( 'homepage_v2',  'electro_home_v2_products_carousel',                    isset( $home_v2['pc']['priority'] ) ? intval( $home_v2['pc']['priority'] ) : 100 );
            add_action( 'homepage_v2',  'electro_home_v2_products_carousel_2',                  isset( $home_v2['pc2']['priority'] ) ? intval( $home_v2['pc2']['priority'] ) : 110 );
            add_action( 'homepage_v2',  'electro_home_v2_products_carousel_3',                  isset( $home_v2['pc3']['priority'] ) ? intval( $home_v2['pc3']['priority'] ) : 120 );
        }
    }
}

function electro_get_default_home_v2_options() {
    $home_v2 = array(
        'sdr'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            'shortcode'     => '',
        ),
        'ad'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 20,
            array(
                'ad_text'       => wp_kses_post( __( 'Catch Hottest <strong>Deals</strong> in Cameras', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => 'col-xs-12 col-sm-6',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( '<span class="from"><span class="prefix">From</span><span class="value"><sup>$</sup>74</span><span class="suffix">99</span></span>', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => 'col-xs-12 col-sm-6',
            ),
        ),
        'pct'   => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 30,
            'product_limit'     => 12,
            'product_columns'   => 3,
            'tabs'              => array(
                array(
                    'title'     => esc_html__( 'Featured', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'featured_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                ),
                array(
                    'title'     => esc_html__( 'On Sale', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'sale_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                ),
                array(
                    'title'     => esc_html__( 'Top Rated', 'electro' ),
                    'content'   => array(
                        'shortcode'             => 'top_rated_products',
                        'product_category_slug' => '',
                        'products_choice'       => 'ids',
                        'products_ids_skus'     => '',
                    )
                )
            ),
            'carousel_args' => array(
                'autoplay'      => 'no',
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 3 )
                )
            )
        ),
        'dow'   => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 40,
            'title'             => esc_html__( 'Deals of the week', 'electro' ),
            'product_limit'     => 4,
            'product_choice'    => 'random',
            'product_ids'       => '',
            'carousel_args'     => array(
                'autoplay'              => 'no',
            )
        ),
        'pcc'   => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 50,
            'section_title'     => esc_html__( 'Bestsellers', 'electro' ),
            'product_limit'     => 20,
            'product_columns'   => 3,
            'product_rows'      => 2,
            'cat_limit'         => 3,
            'cat_slugs'         => '',
            'content'           => array(
                'shortcode'             => 'best_selling_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'     => array(
                'autoplay'              => 'no',
            )
        ),
        'bd'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 60,
            'image'             => 0,
            'link'              => '#',
        ),
        'pcwi1' => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 4,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'img_action_link'       => '#',
            'content'               => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 4,
                    'columns'       => 4,
                    'columns_wide'  => 4
                )
            )
        ),
        'pcwi2' => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'section_title'     => esc_html__( 'Laptops & Computers', 'electro' ),
            'enable_categories' => 'no',
            'categories_title'  => esc_html__( 'Featured Phones', 'electro' ),
            'category_args'     => array(
                'number'            => 4,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            ),
            'img_action_link'       => '#',
            'content'               => array(
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 4,
                    'columns'       => 4,
                    'columns_wide'  => 4
                )
            )
        ),
        'tbrs'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 90,
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
        'pc'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 100,
            'section_title'     => esc_html__( 'Computers', 'electro' ),
            'product_limit'     => 20,
            'product_columns'   => 4,
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'     => array(
                'autoplay'              => 'no',
                'responsive'            => array(
                    '0'         => array( 'items' => 2 ),
                    '480'       => array( 'items' => 2 ),
                    '768'       => array( 'items' => 2 ),
                    '992'       => array( 'items' => 3 ),
                    '1200'      => array( 'items' => 4 ),
                )
            )
        ),
        'pc2'   => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 110,
            'section_title'     => esc_html__( 'Smartphones', 'electro' ),
            'product_limit'     => 16,
            'product_columns'   => 4,
            'content'           => array(
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'     => array(
                'autoplay'          => 'no',
                'responsive'        => array(
                    '0'         => array( 'items' => 2 ),
                    '480'       => array( 'items' => 2 ),
                    '768'       => array( 'items' => 2 ),
                    '992'       => array( 'items' => 3 ),
                    '1200'      => array( 'items' => 4 ),
                )
            )
        ),
        'pc3'   => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 120,
            'section_title'     => esc_html__( 'Recently Viewed', 'electro' ),
            'product_limit'     => 16,
            'product_columns'   => 4,
            'content'           => array(
                'shortcode'             => 'recent_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'     => array(
                'autoplay'          => 'no',
                'responsive'        => array(
                    '0'         => array( 'items' => 2 ),
                    '480'       => array( 'items' => 2 ),
                    '768'       => array( 'items' => 2 ),
                    '992'       => array( 'items' => 3 ),
                    '1200'      => array( 'items' => 4 ),
                )
            )
        )
    );

    return apply_filters( 'electro_home_v2_default_options', $home_v2 );
}

function electro_get_home_v2_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ) {

        $clean_home_v2_options = get_post_meta( $post->ID, '_home_v2_options', true );
        $home_v2_options = maybe_unserialize( $clean_home_v2_options );

        if( ! is_array( $home_v2_options ) ) {
            $home_v2_options = json_decode( $clean_home_v2_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v2_options();
            $home_v2 = wp_parse_args( $home_v2_options, $default_options );
        } else {
            $home_v2 = $home_v2_options;
        }

        return apply_filters( 'electro_home_v2_meta', $home_v2, $post );
    }
}

