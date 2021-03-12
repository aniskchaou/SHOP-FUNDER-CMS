<?php
/**
 * Functions used in mobile home pages
 */
function electro_get_default_home_mobile_v1_options() {
    $home_mobile_v1 = array(
        'sdr'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            'shortcode'     => '',
        ),
        'ad'    => array(
            'is_enabled'    => 'yes',
            'priority'      => 20,
            'animation'     => '',
            array(
                'ad_text'       => wp_kses_post( __( 'Catch Big <strong>Deals</strong> on the Cameras', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => ' ',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix"></span></span>', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => '',
            )
        ),
        'pcl1'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 30,
            'animation'         => '',
            'columns'           => 4,
            'cat_args'          => array(
                'number'            => 8,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'slugs'             => '',
                'hide_empty'        => 'yes'
            )
        ),
        'dpb'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Deals of the Day', 'electro' ),
            'enable_categories' => 'no',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 3,
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
                    'per_page'      => 2,
                    'columns'       => 2
                )
            ),
            'action_text'       => esc_html__( 'See all Deals', 'electro' ),
            'action_link'       => '#',
        ),
        'bd1'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 50,
            'image'             => 0,
            'link'              => '#',
        ),
        'pot'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Featured Products', 'electro' ),
            'enable_categories' => 'no',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 3,
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
                    'per_page'      => 3,
                    'columns'       => 1
                )
            ),
            'action_text'       => esc_html__( 'See all products', 'electro' ),
            'action_link'       => '#',
        ),
        'pcl2'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 70,
            'animation'         => '',
            'section_title'     => esc_html__( 'Laptops & Computers', 'electro' ),
            'sub_title'         => esc_html__( 'Featured Subcategories', 'electro' ),
            'bg_image'          => '',
            'enable_header'     => 'yes',
            'columns'           => 3,
            'cat_args'          => array(
                'number'            => 9,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'slugs'             => '',
                'hide_empty'        => 'yes'
            )
        ),
        'pl1'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'section_title'     => esc_html__( 'Bestsellers', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 3,
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
                    'per_page'      => 6,
                    'columns'       => 3
                )
            ),
            'action_text'       => esc_html__( 'See all Deals', 'electro' ),
            'action_link'       => '#',
        ),
        'bd2'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 90,
            'image'             => 0,
            'link'              => '#',
        ),
        'pl2'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 100,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'All Smartphones', 'electro' ),
            'category_args'     => array(
                'number'            => 3,
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
                    'columns'       => 2
                )
            ),
            'action_text'       => esc_html__( 'See all Products', 'electro' ),
            'action_link'       => '#',
        ),
        'hcb'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 110,
            'animation'         => '',
            'section_title'     => '',
            'enable_full_width' => 'no',
            'columns'           => '4',
            'cat_slugs'         => '',
            'cat_args'          => array(
                'number'            => 6,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'hide_empty'        => 'yes'
            )
        ),
        'rvp'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 120,
            'animation'         => '',
            'section_title'     => esc_html__( 'Recently Viewed', 'electro' ),
        ),
    );

    return apply_filters( 'electro_home_mobile_v1_default_options', $home_mobile_v1 );
}

function electro_get_home_mobile_v1_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_mobile_v1_options = get_post_meta( $post->ID, '_home_mobile_v1_options', true );
        $home_mobile_v1_options = maybe_unserialize( $clean_home_mobile_v1_options );

        if( ! is_array( $home_mobile_v1_options ) ) {
            $home_mobile_v1_options = json_decode( $clean_home_mobile_v1_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_mobile_v1_options();
            $home_mobile_v1 = wp_parse_args( $home_mobile_v1_options, $default_options );
        } else {
            $home_mobile_v1 = $home_mobile_v1_options;
        }
        return apply_filters( 'electro_home_mobile_v1_meta', $home_mobile_v1, $post );
    }
}

function electro_get_default_home_mobile_v2_options() {
    $home_mobile_v2 = array(
        'sdr'   => array(
            'is_enabled'    => 'yes',
            'priority'      => 10,
            'animation'     => '',
            'shortcode'     => '',
        ),
        'ad'    => array(
            'is_enabled'    => 'yes',
            'priority'      => 20,
            'animation'     => '',
            array(
                'ad_text'       => wp_kses_post( __( 'Catch Big <strong>Deals</strong> on the Cameras', 'electro' ) ),
                'action_text'   => wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => ' ',
            ),
            array(
                'ad_text'       => wp_kses_post( __( 'Tablets, Mobiles <strong>and more</strong>', 'electro' ) ),
                'action_text'   => wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix"></span></span>', 'electro' ) ),
                'action_link'   => '#',
                'ad_image'      => '',
                'el_class'      => ' ',
            )
        ),
        'dpwf'    => array(
            'is_enabled'            => 'yes',
            'priority'              => 30,
            'animation'             => '',
            'section_title'         => esc_html__( 'Today Deals', 'electro' ),
            'content'               => array(
                'shortcode'             => 'sale_products',
                'product_category_slug' => '',
                'products_choice'       => 'ids',
                'products_ids_skus'     => '',
                'shortcode_atts'        => array(
                    'per_page'      => 4,
                    'columns'       => 1
                )
            ),

            'timer_title'           => esc_html__( 'ends in', 'electro' ),
            'header_timer'          => true,
            'timer_value'           => '+8 hours',
            'animation'             => '',
        ),
        'pl1'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 40,
            'animation'         => '',
            'section_title'     => esc_html__( 'Bestsellers', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'Top 20', 'electro' ),
            'category_args'     => array(
                'number'            => 3,
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
                    'per_page'      => 6,
                    'columns'       => 3
                )
            ),
            'action_text'       => esc_html__( 'Show more', 'electro' ),
            'action_link'       => '#',
        ),
        'pcl'  => array(
            'is_enabled'        => 'yes',
            'priority'          => 50,
            'animation'         => '',
            'section_title'     => esc_html__( 'OFFICE WORKPLACE', 'electro' ),
            'sub_title'         => esc_html__( 'PREPARE YOUR', 'electro' ),
            'bg_image'          => '',
            'enable_header'     => 'yes',
            'columns'           => 3,
            'cat_args'          => array(
                'number'            => 6,
                'orderby'           => 'name',
                'order'             => 'ASC',
                'slugs'             => '',
                'hide_empty'        => 'yes'
            )
        ),
        'pl2'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 60,
            'animation'         => '',
            'section_title'     => esc_html__( 'Smartphones', 'electro' ),
            'enable_categories' => 'yes',
            'categories_title'  => esc_html__( 'All Smartphones', 'electro' ),
            'category_args'     => array(
                'number'            => 3,
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
                    'columns'       => 2
                )
            ),
            'action_text'       => esc_html__( 'See all products', 'electro' ),
            'action_link'       => '#',
        ),
        'bd'    => array(
            'is_enabled'        => 'yes',
            'animation'         => '',
            'priority'          => 70,
            'image'             => 0,
            'link'              => '#',
        ),
        'rvp'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 80,
            'animation'         => '',
            'section_title'     => esc_html__( 'Recently Viewed', 'electro' ),
        ),
        'fl'    => array(
            'is_enabled'    => 'yes',
            'priority'      => 90,
            'animation'     => '',
            array(
                'icon'  => 'ec ec-transport',
                'text'  => wp_kses_post( __( '<strong>Free Delivery</strong> from $50', 'electro' ) )
            ),
            array(
                'icon'  => 'ec ec-customers',
                'text'  => wp_kses_post( __( '<strong>99% Positive</strong> Feedbacks', 'electro' ) )
            ),
            array(
                'icon'  => 'ec ec-returning',
                'text'  => wp_kses_post( __( '<strong>365 days</strong> for free return', 'electro' ) )
            ),
            array(
                'icon'  => 'ec ec-payment',
                'text'  => wp_kses_post( __( '<strong>Payment</strong> Secure System', 'electro' ) )
            ),
            array(
                'icon'  => 'ec ec-tag',
                'text'  => wp_kses_post( __( '<strong>Only Best</strong> Brands', 'electro' ) )
            )
        ),
        'hlc'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 100,
            'animation'         => '',
            'section_title'     => esc_html__( 'Tranding Categories', 'electro' ),
            'category_list'     => array(
                array(
                    'title'         => esc_html__( 'Mobiles', 'electro' ),
                    'category_args' => array(
                        'number'        => 5,
                        'orderby'       => 'name',
                        'order'         => 'ASC',
                        'hide_empty'    => true
                    )
                ),
                array(
                    'title'         => esc_html__( 'Games', 'electro' ),
                    'category_args' => array(
                        'number'        => 5,
                        'orderby'       => 'name',
                        'order'         => 'ASC',
                        'hide_empty'    => true
                    )
                ),
            ),
            'action_text'       => esc_html__( 'Show more', 'electro' ),
            'action_link'       => '#',
        )
    );

    return apply_filters( 'electro_home_mobile_v2_default_options', $home_mobile_v2 );
}

function electro_get_home_mobile_v2_meta( $merge_default = true ) {
    global $post;

    if ( isset( $post->ID ) ){

        $clean_home_mobile_v2_options = get_post_meta( $post->ID, '_home_mobile_v2_options', true );
        $home_mobile_v2_options = maybe_unserialize( $clean_home_mobile_v2_options );

        if( ! is_array( $home_mobile_v2_options ) ) {
            $home_mobile_v2_options = json_decode( $clean_home_mobile_v2_options, true );
        }

        if ( $merge_default ) {
            $default_options = electro_get_default_home_mobile_v2_options();
            $home_mobile_v2 = wp_parse_args( $home_mobile_v2_options, $default_options );
        } else {
            $home_mobile_v2 = $home_mobile_v2_options;
        }
        return apply_filters( 'electro_home_mobile_v2_meta', $home_mobile_v2, $post );
    }
}

if( ! function_exists( 'electro_home_mobile_v1_hook_control' ) ) {
    function electro_home_mobile_v1_hook_control() {
        if( is_page_template( array( 'template-homepage-mobile-v1.php' ) ) ) {
            remove_all_actions( 'homepage_mobile_v1' );

            $home_mobile_v1 = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['hpc']['is_enabled'] ) ? $home_mobile_v1['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_mobile_v1',   'electro_page_template_content',            isset( $home_mobile_v1['hpc']['priority'] ) ? intval( $home_mobile_v1['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_slider',                        isset( $home_mobile_v1['sdr']['priority'] ) ? intval( $home_mobile_v1['sdr']['priority'] ) : 10 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_ads_block',                     isset( $home_mobile_v1['ad']['priority'] ) ? intval( $home_mobile_v1['ad']['priority'] ) : 20 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_product_categories_list_1',     isset( $home_mobile_v1['pcl1']['priority'] ) ? intval( $home_mobile_v1['pcl1']['priority'] ) : 30 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_deal_products_block',           isset( $home_mobile_v1['dpb']['priority'] ) ? intval( $home_mobile_v1['dpb']['priority'] ) : 40 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_ad_banner_v1',                  isset( $home_mobile_v1['bd1']['priority'] ) ? intval( $home_mobile_v1['bd1']['priority'] ) : 50 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_products_1_2_block',            isset( $home_mobile_v1['pot']['priority'] ) ? intval( $home_mobile_v1['pot']['priority'] ) : 60 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_product_categories_list_2',     isset( $home_mobile_v1['pcl2']['priority'] ) ? intval( $home_mobile_v1['pcl2']['priority'] ) : 70 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_products_list_block_1',         isset( $home_mobile_v1['pl1']['priority'] ) ? intval( $home_mobile_v1['pl1']['priority'] ) : 80 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_ad_banner_v2',                  isset( $home_mobile_v1['bd2']['priority'] ) ? intval( $home_mobile_v1['bd2']['priority'] ) : 90 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_products_list_block_2',         isset( $home_mobile_v1['pl2']['priority'] ) ? intval( $home_mobile_v1['pl2']['priority'] ) : 100 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_categories_block',              isset( $home_mobile_v1['hcb']['priority'] ) ? intval( $home_mobile_v1['hcb']['priority'] ) : 110 );
            add_action( 'homepage_mobile_v1',   'electro_home_mobile_v1_recent_viewed_products',        isset( $home_mobile_v1['rvp']['priority'] ) ? intval( $home_mobile_v1['rvp']['priority'] ) : 120 );
        }
    }
}

if( ! function_exists( 'electro_home_mobile_v2_hook_control' ) ) {
    function electro_home_mobile_v2_hook_control() {
        if( is_page_template( array( 'template-homepage-mobile-v2.php' ) ) ) {
            remove_all_actions( 'homepage_mobile_v2' );

            $home_mobile_v2 = electro_get_home_mobile_v2_meta();

            $is_enabled = isset( $home_mobile_v2['hpc']['is_enabled'] ) ? $home_mobile_v2['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_mobile_v2',   'electro_page_template_content',            isset( $home_mobile_v2['hpc']['priority'] ) ? intval( $home_mobile_v2['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_slider',                        isset( $home_mobile_v2['sdr']['priority'] ) ? intval( $home_mobile_v2['sdr']['priority'] ) : 10 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_ads_block',                     isset( $home_mobile_v2['ad']['priority'] ) ? intval( $home_mobile_v2['ad']['priority'] ) : 20 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_deal_products_with_featured',   isset( $home_mobile_v2['dpwf']['priority'] ) ? intval( $home_mobile_v2['dpwf']['priority'] ) : 30 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_products_list_block_1',         isset( $home_mobile_v2['pl1']['priority'] ) ? intval( $home_mobile_v2['pl1']['priority'] ) : 40 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_product_categories_list',       isset( $home_mobile_v2['pcl']['priority'] ) ? intval( $home_mobile_v2['pcl']['priority'] ) : 50 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_products_list_block_2',         isset( $home_mobile_v2['pl2']['priority'] ) ? intval( $home_mobile_v2['pl2']['priority'] ) : 60 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_ad_banner',                     isset( $home_mobile_v2['bd']['priority'] ) ? intval( $home_mobile_v2['bd']['priority'] ) : 70 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_recent_viewed_products',        isset( $home_mobile_v2['rvp']['priority'] ) ? intval( $home_mobile_v2['rvp']['priority'] ) : 80 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_features_list',                 isset( $home_mobile_v2['fl']['priority'] ) ? intval( $home_mobile_v2['fl']['priority'] ) : 90 );
            add_action( 'homepage_mobile_v2',   'electro_home_mobile_v2_list_categories',               isset( $home_mobile_v2['hlc']['priority'] ) ? intval( $home_mobile_v2['hlc']['priority'] ) : 100 );
        }
    }
}