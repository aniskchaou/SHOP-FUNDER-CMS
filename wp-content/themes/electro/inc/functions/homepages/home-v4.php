<?php
/**
 * Functions used in Home v4
 */

function electro_get_default_home_v4_options() {
    $home_v4 = array(
        'swa'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 10,
            'animation'         => '',
            'slider_shortcode'  => '',
            'ads_args'          => array(
                array(
                    'ad_text'       => wp_kses_post( __( 'Catch Big <br><strong>Deals</strong> on<br>the Cameras', 'electro' ) ),
                    'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => '#',
                    'ad_image'      => '',
                    'el_class'      => '',
                ),
                array(
                    'ad_text'       => wp_kses_post( __( 'Shop the<br><strong>Hottest</strong><br>Products', 'electro' ) ),
                    'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => '#',
                    'ad_image'      => '',
                    'el_class'      => '',
                ),
                array(
                    'ad_text'       => wp_kses_post( __( 'Tablets,<br> Smartphones <br><strong>and more</strong>', 'electro' ) ),
                    'action_text'   => wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                    'action_link'   => '#',
                    'ad_image'      => '',
                    'el_class'      => '',
                ),
            )
        ),
        'pct'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'product_limit'     => 18,
            'product_columns'   => 6,
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
                    '1200'  => array( 'items'   => 6 )
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
        'dpc'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Week Deals limited, Just now', 'electro' ),
            'timer_title'       => esc_html__( 'Hurry up! Offer ends in:', 'electro' ),
            'header_timer'      => 'yes',
            'timer_value'       => '+8 hours',
            'deal_percentage'   => '%',
            'product_limit'     => 12,
            'product_columns'   => 4,
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
                    '1024'      => array( 'items' => 3 ),
                    '1200'      => array( 'items' => 4 ),
                )
            )
        ),
        'pwci1' => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones & Tablets', 'electro' ),
            'enable_categories' => true,
            'categories_title'  => esc_html__( 'Bestsellers', 'electro' ),
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
                'shortcode'             => 'featured_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 6,
                    'columns'       => 3,
                )
            )
        ),
        'pwci2' => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Music Headphones', 'electro' ),
            'enable_categories' => false,
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
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 6,
                    'columns'       => 3
                )
            )
        ),
        'hcb'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Top Categories this Week', 'electro' ),
            'enable_full_width' => true,
            'columns'           => '4',
            'cat_slugs'         => '',
            'cat_args'          => array(
                'number'            => 8,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => true
            )
        ),
        'sowc1' => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'section_title'     => esc_html__( 'Laptops & Computers', 'electro' ),
            'enable_categories' => true,
            'categories_title'  => esc_html__( 'Bestsellers', 'electro' ),
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
            'content'               => array(
                'shortcode'             => 'featured_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 6,
                    'columns'       => 3
                )
            ),
            'content_featured'  => array(
                'shortcode'             => 'featured_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 1,
                    'columns'       => 1
                )
            )
        ),
        'sowc2' => array(
            'is_enabled'        => 'yes',
            'priority'          => 90,
            'animation'         => '',
            'section_title'     => esc_html__( 'Home Enternteinment', 'electro' ),
            'enable_categories' => false,
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
            'content'           => array(
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 6,
                    'columns'       => 3
                )
            ),
            'content_featured'  => array(
                'shortcode'             => 'featured_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 1,
                    'columns'       => 1
                )
            )
        ),
        'rvp'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 100,
            'animation'         => '',
            'section_title'     => esc_html__( 'Your Recently Viewed Products', 'electro' ),
            'shortcode_atts'    => array( 
                'columns'           => '10',
                'per_page'          => '20'
            ),
            'carousel_args' => array(
                'items'         => 10,
                'dots'          => true,
                'autoplay'      => 'no',
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 8 ),
                    '1440'  => array( 'items'   => 10 ),
                )
            )
        ),
    );

    return apply_filters( 'electro_home_v4_default_options', $home_v4 );
}

function electro_get_home_v4_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v4_options = get_post_meta( $post->ID, '_home_v4_options', true );
        $home_v4_options = maybe_unserialize( $clean_home_v4_options );

        if( ! is_array( $home_v4_options ) ) {
            $home_v4_options = json_decode( $clean_home_v4_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v4_options();
            $home_v4 = wp_parse_args( $home_v4_options, $default_options );
        } else {
            $home_v4 = $home_v4_options;
        }

        return apply_filters( 'electro_home_v4_meta', $home_v4, $post );
    }
}

if( ! function_exists( 'electro_home_v4_hook_control' ) ) {
    function electro_home_v4_hook_control() {
        if( is_page_template( array( 'template-homepage-v4.php' ) ) ) {
            remove_all_actions( 'homepage_v4' );

            $home_v4 = electro_get_home_v4_meta();

            $is_enabled = isset( $home_v4['hpc']['is_enabled'] ) ? $home_v4['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v4',  'electro_page_template_content',            isset( $home_v4['hpc']['priority'] ) ? intval( $home_v4['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v4',  'electro_home_v4_slider_with_ads_block',        isset( $home_v4['swa']['priority'] ) ? intval( $home_v4['swa']['priority'] ) : 10 );
            add_action( 'homepage_v4',  'electro_home_v4_products_carousel_tabs',       isset( $home_v4['pct']['priority'] ) ? intval( $home_v4['pct']['priority'] ) : 20 );
            add_action( 'homepage_v4',  'electro_home_v4_ad_banner',                    isset( $home_v4['bd']['priority'] ) ? intval( $home_v4['bd']['priority'] ) : 30 );
            add_action( 'homepage_v4',  'electro_products_carousel_with_deal_v4',       isset( $home_v4['dpc']['priority'] ) ? intval( $home_v4['dpc']['priority'] ) : 40 );
            add_action( 'homepage_v4',  'electro_products_with_category_image_v4_1',    isset( $home_v4['pwci1']['priority'] ) ? intval( $home_v4['pwci1']['priority'] ) : 50 );
            add_action( 'homepage_v4',  'electro_products_with_category_image_v4_2',    isset( $home_v4['pwci2']['priority'] ) ? intval( $home_v4['pwci2']['priority'] ) : 60 );
            add_action( 'homepage_v4',  'electro_home_v4_categories_block',             isset( $home_v4['hcb']['priority'] ) ? intval( $home_v4['hcb']['priority'] ) : 70 );
            add_action( 'homepage_v4',  'electro_products_6_1_with_categories_v4_1',    isset( $home_v4['sowc1']['priority'] ) ? intval( $home_v4['sowc1']['priority'] ) : 80 );
            add_action( 'homepage_v4',  'electro_products_6_1_with_categories_v4_2',    isset( $home_v4['sowc2']['priority'] ) ? intval( $home_v4['sowc2']['priority'] ) : 90 );
            add_action( 'homepage_v4',  'electro_home_v4_recent_viewed_products',       isset( $home_v4['rvp']['priority'] ) ? intval( $home_v4['rvp']['priority'] ) : 100 );
        }
    }
}