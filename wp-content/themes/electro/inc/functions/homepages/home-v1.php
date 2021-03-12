<?php
/**
 * Functions used in Home v1
 */

if ( ! function_exists( 'electro_add_2_1_2_main_product_hooks' ) ) {
    function electro_add_2_1_2_main_product_hooks() {
        remove_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40  );
        remove_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140 );
        
        add_action( 'woocommerce_before_shop_loop_item', 'electro_wrap_flex_div_open', 11 );
        add_action( 'woocommerce_after_shop_loop_item', 'electro_wrap_flex_div_close', 149 );
        add_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 149 );
        //add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_single_image', 46 );
        add_action( 'woocommerce_shop_loop_item_title', 'electro_show_wc_product_images', 46 );
    }
}

if ( ! function_exists( 'electro_remove_2_1_2_main_product_hooks' ) ) {
    function electro_remove_2_1_2_main_product_hooks() {
        remove_action( 'woocommerce_before_shop_loop_item', 'electro_wrap_flex_div_open', 11 );
        remove_action( 'woocommerce_after_shop_loop_item', 'electro_wrap_flex_div_close', 149 );
        remove_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 149 );
        //remove_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_single_image', 46 );
        remove_action( 'woocommerce_shop_loop_item_title', 'electro_show_wc_product_images', 46 );

        add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40  );
        add_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140 );
    }
}

if( ! function_exists( 'electro_home_v1_hook_control' ) ) {
    function electro_home_v1_hook_control() {
        if( is_page_template( array( 'template-homepage-v1.php' ) ) ) {
            
            remove_all_actions( 'homepage_v1' );

            $home_v1 = electro_get_home_v1_meta();

            $is_enabled = isset( $home_v1['hpc']['is_enabled'] ) ? $home_v1['hpc']['is_enabled'] : 'no';
            
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v1',  'electro_page_template_content', isset( $home_v1['hpc']['priority'] ) ? intval( $home_v1['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v1',  'electro_home_v1_slider',                   isset( $home_v1['sdr']['priority'] ) ? intval( $home_v1['sdr']['priority'] ) : 10 );
            add_action( 'homepage_v1',  'electro_home_v1_ads_block',                isset( $home_v1['ad']['priority'] ) ? intval( $home_v1['ad']['priority'] ) : 20 );
            add_action( 'homepage_v1',  'electro_home_v1_deal_and_tabs_block',      isset( $home_v1['dtd']['priority'] ) ? intval( $home_v1['dtd']['priority'] ) : 30 );
            add_action( 'homepage_v1',  'electro_home_v1_2_1_2_block',              isset( $home_v1['tot']['priority'] ) ? intval( $home_v1['tot']['priority'] ) : 40 );
            add_action( 'homepage_v1',  'electro_home_v1_product_cards_carousel',   isset( $home_v1['pcc']['priority'] ) ? intval( $home_v1['pcc']['priority'] ) : 50 );
            add_action( 'homepage_v1',  'electro_home_v1_ad_banner',                isset( $home_v1['bd']['priority'] ) ? intval( $home_v1['bd']['priority'] ) : 60 );
            add_action( 'homepage_v1',  'electro_home_v1_products_carousel',        isset( $home_v1['pc']['priority'] ) ? intval( $home_v1['pc']['priority'] ) : 70 );
        }
    }
}

function electro_get_default_home_v1_options() {

    $home_v1 = array(
        'sdr'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            'shortcode'     => '',
        ),
        'ad'    => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            array(
                'ad_text'       => wp_kses_post( __( 'Catch Big <br><strong>Deals</strong> on the <br>Cameras', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Shop the <br><strong>Hottest</strong><br> Products', 'electro' ) ),
                'action_text'   => wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix"></span></span>', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Tablets, <br>Smartphones <br><strong>and more</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => 'col-xs-12 col-sm-4',
            ),
        ),
        'dtd'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            'deal'          => array(
                'is_enabled'        => 'yes',
                'section_title'     => esc_html__( 'Special Offer', 'electro' ),
                'product_choice'    => 'random',
                'product_id'        => '',
                'savings_in'        => 'amount',
            ),
            'tab'           => array(
                'product_limit'        => 6,
                'product_columns'      => 3,
                'product_limit_wide'   => 8,
                'product_columns_wide' => 4,
                'tabs'                 => array(
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
                )
            ),
        ),
        'tot'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 10,
            'animation'         => '',
            'section_title'     => esc_html__( 'Best Deals', 'electro' ),
            'cat_limit'         => 9,
            'cat_slugs'         => '',
            'content'           => array(
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            )
        ),
        'pcc'   => array(
            'is_enabled'           => 'yes',
            'priority'             => 10,
            'animation'            => '',
            'product_limit'        => 20,
            'product_columns'      => 3,
            'product_columns_wide' => 4,
            'product_rows'         => 2,
            'cat_limit'            => 3,
            'cat_slugs'            => '',
            'content'              => array(
                'shortcode'             => 'best_selling_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
            ),
            'carousel_args'        => array(
                'autoplay'              => 'no',
            )
        ),
        'bd'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 10,
            'animation'         => '',
            'image'             => 0,
            'link'              => '#',
        ),
        'pc'    => array(
            'is_enabled'           => 'yes',
            'priority'             => 10,
            'animation'            => '',
            'section_title'        => esc_html__( 'Added', 'electro' ),
            'product_limit'        => 20,
            'product_columns'      => 6,
            'product_columns_wide' => 7,
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
                    '1200'      => array( 'items' => 6 ),
                )
            )
        )
    );

    return apply_filters( 'electro_home_v1_default_options', $home_v1 );
}

function electro_get_home_v1_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v1_options = get_post_meta( $post->ID, '_home_v1_options', true );
        $home_v1_options = maybe_unserialize( $clean_home_v1_options );

        if( ! is_array( $home_v1_options ) ) {
            $home_v1_options = json_decode( $clean_home_v1_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v1_options();
            $home_v1 = wp_parse_args( $home_v1_options, $default_options );
        } else {
            $home_v1 = $home_v1_options;
        }

        return apply_filters( 'electro_home_v1_meta', $home_v1, $post );
    }
}