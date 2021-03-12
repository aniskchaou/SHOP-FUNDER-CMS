<?php
/**
 * Functions used in Home v9
 */

function electro_get_default_home_v9_options() {
    $home_v9 = array(
        'swdpc' => array(
            'is_enabled'        => 'yes',
            'priority'          => 10,
            'animation'         => '',
            'slider_shortcode'  => '',
            'dpc'               => array(
                'is_enabled'        => 'yes',
                'title'             => wp_kses_post( __( 'Limited <span>Week Deal</span>', 'electro' ) ),
                'sub_title'         => esc_html__( 'Hurry up before offer will end', 'electro' ),
                'product_limit'     => 2,
                'product_choice'    => 'random',
                'product_ids'       => '',
                'carousel_args'     => array(
                    'autoplay'      => 'no',
                    'dots'          => false,
                    'nav'           => true,
                )
            ),
        ),
        'pct'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 20,
            'animation'         => '',
            'product_limit'     => 14,
            'product_columns'   => 6,
            'columns_wide'      => 7,
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
                'dots'          => true,
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 3 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 6 ),
                    '1480'  => array( 'items'   => 7 ),
                )
            ),
        ),
        'bb'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
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
            ),
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            ),
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            ),
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            ),
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            ),
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            ),
        ),
        'pcwbc1' => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Computers & Laptops', 'electro' ),
            'content'           => array(
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
            ),
            'carousel_args' => array(
                'autoplay'          => false,
                'items'             => 1,
                'nav'               => true,
                'dots'              => false,
                'rtl'               => is_rtl() ? true : false,
                'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
            ),
        ),
        'pcwbc2' => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones & Tablets', 'electro' ),
            'content'           => array(
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
            ),
            'carousel_args' => array(
                'autoplay'          => false,
                'items'             => 1,
                'nav'               => true,
                'dots'              => false,
                'rtl'               => is_rtl() ? true : false,
                'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
            ),
        ),
        'pc'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
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
                'nav'           => false,
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
        'pcwbc3' => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Headphones & Virtual Reality', 'electro' ),
            'content'           => array(
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
                array(
                    'enable_category_1' => true,
                    'category_1_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 3,
                        'child_number'      => 5,
                        'slugs'             => '',
                    ),
                    'enable_category_2' => true,
                    'category_2_args'   => array(
                        'orderby'           => 'name',
                        'order'             => 'ASC',
                        'hide_empty'        => false,
                        'number'            => 7,
                        'slugs'             => '',
                    ),
                    'enable_banner'     => true,
                    'image'             => '',
                    'img_action_link'   => '#',
                ),
            ),
            'carousel_args' => array(
                'autoplay'          => false,
                'items'             => 1,
                'nav'               => true,
                'dots'              => false,
                'rtl'               => is_rtl() ? true : false,
                'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
            ),
        ),
        'rvp'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
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

    return apply_filters( 'electro_home_v9_default_options', $home_v9 );
}

function electro_get_home_v9_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_v9_options = get_post_meta( $post->ID, '_home_v9_options', true );
        $home_v9_options = maybe_unserialize( $clean_home_v9_options );

        if( ! is_array( $home_v9_options ) ) {
            $home_v9_options = json_decode( $clean_home_v9_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_v9_options();
            $home_v9 = wp_parse_args( $home_v9_options, $default_options );
        } else {
            $home_v9 = $home_v9_options;
        }

        return apply_filters( 'electro_home_v9_meta', $home_v9, $post );
    }
}

if( ! function_exists( 'electro_home_v9_hook_control' ) ) {
    function electro_home_v9_hook_control() {
        if( is_page_template( array( 'template-homepage-v9.php' ) ) ) {
            remove_all_actions( 'homepage_v9' );

            $home_v9 = electro_get_home_v9_meta();

            $is_enabled = isset( $home_v9['hpc']['is_enabled'] ) ? $home_v9['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v9', 'electro_page_template_content', isset( $home_v9['hpc']['priority'] ) ? intval( $home_v9['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v9', 'electro_home_v9_slider_with_deals_product_carousel', isset( $home_v9['swdpc']['priority'] ) ? intval( $home_v9['swdpc']['priority'] ) : 10 );
            add_action( 'homepage_v9', 'electro_home_v9_products_carousel_tabs', isset( $home_v9['pct']['priority'] ) ? intval( $home_v9['pct']['priority'] ) : 20 );
            add_action( 'homepage_v9', 'electro_home_v9_banner_1_6_block', isset( $home_v9['bb']['priority'] ) ? intval( $home_v9['bb']['priority'] ) : 30 );
            add_action( 'homepage_v9', 'electro_home_v9_product_categories_with_banner_carousel_1', isset( $home_v9['pcwbc1']['priority'] ) ? intval( $home_v9['pcwbc1']['priority'] ) : 40 );
            add_action( 'homepage_v9', 'electro_home_v9_product_categories_with_banner_carousel_2', isset( $home_v9['pcwbc2']['priority'] ) ? intval( $home_v9['pcwbc2']['priority'] ) : 50 );
            add_action( 'homepage_v9', 'electro_home_v9_products_carousel', isset( $home_v9['pc']['priority'] ) ? intval( $home_v9['pc']['priority'] ) : 60 );
            add_action( 'homepage_v9', 'electro_home_v9_product_categories_with_banner_carousel_3', isset( $home_v9['pcwbc3']['priority'] ) ? intval( $home_v9['pcwbc3']['priority'] ) : 70 );
            add_action( 'homepage_v9', 'electro_home_v9_recent_viewed_products', isset( $home_v9['rvp']['priority'] ) ? intval( $home_v9['rvp']['priority'] ) : 80 );
        }
    }
}