<?php
/**
 * Template tags used in Home v4
 */

if ( ! function_exists( 'electro_home_v4_slider_with_ads_block' ) ) {
    /**
     *
     */
    function electro_home_v4_slider_with_ads_block() {

        $home_v4 = electro_get_home_v4_meta();

        $is_enabled = isset( $home_v4['swa']['is_enabled'] ) ? $home_v4['swa']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $home_v4['swa']['animation'] ) ? $home_v4['swa']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'v4' );

        $args = apply_filters( 'electro_home_v4_slider_with_ads_block_args', array(
            'section_class'     => '',
            'animation'         => $animation,
            'slider_shortcode'  => ! empty( $home_v4['swa']['slider_shortcode'] ) ? $home_v4['swa']['slider_shortcode'] : '[rev_slider alias="home-v4-slider"]',
            'ads_args'          => array(
                array(
                    'ad_text'       => isset( $home_v4['swa']['ads_args'][0]['ad_text'] ) ? $home_v4['swa']['ads_args'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <br><strong>Deals</strong> on<br>the Cameras', 'electro' ) ),
                    'action_text'   => isset( $home_v4['swa']['ads_args'][0]['action_text'] ) ? $home_v4['swa']['ads_args'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => isset( $home_v4['swa']['ads_args'][0]['action_link'] ) ? $home_v4['swa']['ads_args'][0]['action_link'] : '#',
                    'ad_image'      => isset( $home_v4['swa']['ads_args'][0]['ad_image'] ) ? wp_get_attachment_url( $home_v4['swa']['ads_args'][0]['ad_image'] ) : '',
                    'el_class'      => isset( $home_v4['swa']['ads_args'][0]['el_class'] ) ? $home_v4['swa']['ads_args'][0]['el_class'] : '',
                    'ad_image_attachment' => isset( $home_v4['swa']['ads_args'][0]['ad_image'] ) ? wp_get_attachment_image( $home_v4['swa']['ads_args'][0]['ad_image'], $ad_image_attachment_size ) : '',
                ),
                array(
                    'ad_text'       => isset( $home_v4['swa']['ads_args'][1]['ad_text'] ) ? $home_v4['swa']['ads_args'][1]['ad_text'] : wp_kses_post( __( 'Shop the<br><strong>Hottest</strong><br>Products', 'electro' ) ),
                    'action_text'   => isset( $home_v4['swa']['ads_args'][1]['action_text'] ) ? $home_v4['swa']['ads_args'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => isset( $home_v4['swa']['ads_args'][1]['action_link'] ) ? $home_v4['swa']['ads_args'][1]['action_link'] : '#',
                    'ad_image'      => isset( $home_v4['swa']['ads_args'][1]['ad_image'] ) ? wp_get_attachment_url( $home_v4['swa']['ads_args'][1]['ad_image'] ) : '',
                    'el_class'      => isset( $home_v4['swa']['ads_args'][1]['el_class'] ) ? $home_v4['swa']['ads_args'][1]['el_class'] : '',
                    'ad_image_attachment' => isset( $home_v4['swa']['ads_args'][1]['ad_image'] ) ? wp_get_attachment_image( $home_v4['swa']['ads_args'][1]['ad_image'], $ad_image_attachment_size ) : '',
                ),
                array(
                    'ad_text'       => isset( $home_v4['swa']['ads_args'][2]['ad_text'] ) ? $home_v4['swa']['ads_args'][2]['ad_text'] : wp_kses_post( __( 'Tablets,<br> Smartphones <br><strong>and more</strong>', 'electro' ) ),
                    'action_text'   => isset( $home_v4['swa']['ads_args'][2]['action_text'] ) ? $home_v4['swa']['ads_args'][2]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                    'action_link'   => isset( $home_v4['swa']['ads_args'][2]['action_link'] ) ? $home_v4['swa']['ads_args'][2]['action_link'] : '#',
                    'ad_image'      => isset( $home_v4['swa']['ads_args'][2]['ad_image'] ) ? wp_get_attachment_url( $home_v4['swa']['ads_args'][2]['ad_image'] ) : '',
                    'el_class'      => isset( $home_v4['swa']['ads_args'][2]['el_class'] ) ? $home_v4['swa']['ads_args'][2]['el_class'] : '',
                    'ad_image_attachment' => isset( $home_v4['swa']['ads_args'][2]['ad_image'] ) ? wp_get_attachment_image( $home_v4['swa']['ads_args'][2]['ad_image'], $ad_image_attachment_size ) : '',
                ),
            )
        ) );

        electro_slider_with_ads_block( $args );
    }
}

if ( ! function_exists( 'electro_slider_with_ads_block' ) ) {
    /**
     *
     */
    function electro_slider_with_ads_block( $args = array() ) {

        $default_args = apply_filters( 'electro_slider_with_ads_block_default_args', array(
            'section_class'     => '',
            'animation'         => '',
            'slider_shortcode'  => '',
            'ads_args'          => array()
        ) );

        $args = wp_parse_args( $args, $default_args );

        ?>
        <div class="slider-with-da-block">
            <div class="slider-with-da-block-inner">
                <div class="slider-wrapper">
                    <?php echo do_shortcode( $args['slider_shortcode'] ); ?>
                </div>
                <div class="da-block-wrapper">
                    <?php electro_ads_block( $args['ads_args'] ); ?>
                </div>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'electro_home_v4_products_carousel_tabs' ) ) {
    /**
     *
     */
    function electro_home_v4_products_carousel_tabs() {

        if ( is_woocommerce_activated() ) {

            $home_v4 = electro_get_home_v4_meta();

            $is_enabled = isset( $home_v4['pct']['is_enabled'] ) ? $home_v4['pct']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $home_v4['pct']['animation'] ) ? $home_v4['pct']['animation'] : '';

            $args = apply_filters( 'electro_home_v4_products_carousel_tabs_args', array(
                'animation' => $animation,
                'tabs'          => array(
                    array(
                        'id'            => 'tab-products-1',
                        'title'         => isset( $home_v4['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v4['pct']['tabs'][0]['title'] : esc_html__( 'Featured', 'electro' ),
                        'shortcode_tag' => isset( $home_v4['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v4['pct']['tabs'][0]['content']['shortcode'] : 'featured_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v4['pct']['tabs'][0]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-2',
                        'title'         => isset( $home_v4['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v4['pct']['tabs'][1]['title'] : esc_html__( 'On Sale', 'electro' ),
                        'shortcode_tag' => isset( $home_v4['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v4['pct']['tabs'][1]['content']['shortcode'] : 'sale_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v4['pct']['tabs'][1]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-3',
                        'title'         => isset( $home_v4['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v4['pct']['tabs'][2]['title'] : esc_html__( 'Top Rated', 'electro' ),
                        'shortcode_tag' => isset( $home_v4['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v4['pct']['tabs'][2]['content']['shortcode'] : 'top_rated_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v4['pct']['tabs'][2]['content'] )
                    )
                ),
                'limit'         => isset( $home_v4['pct']['product_limit'] ) ? $home_v4['pct']['product_limit'] : 18,
                'columns'       => isset( $home_v4['pct']['product_columns'] ) ? $home_v4['pct']['product_columns'] : 6,
                'columns_wide'  => isset( $home_v4['pct']['product_columns_wide'] ) ? $home_v4['pct']['product_columns_wide'] : 7,
                'carousel_args' => array(
                    'items'         => isset( $home_v4['pct']['product_columns'] ) ? intval( $home_v4['pct']['product_columns'] ) : 7,
                    'autoplay'      => isset( $home_v4['pct']['carousel_args']['autoplay'] ) ? filter_var( $home_v4['pct']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'    => array(
                        '0'     => array( 'items'   => 2 ),
                        '576'   => array( 'items'   => 3 ),
                        '768'   => array( 'items'   => 4 ),
                        '992'   => array( 'items'   => 5 ),
                        '1200'  => array( 'items'   => isset( $home_v4['pct']['product_columns'] ) ? intval( $home_v4['pct']['product_columns'] ) : 6 )
                    )
                )
            ) );

            if ( electro_is_wide_enabled() ){
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
            }

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $home_v4['pct']['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $home_v4['pct']['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $home_v4['pct']['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            if ( is_rtl() ) {
                $args['nav-align'] = 'right';
            } else {
                $args['nav-align'] = 'left';
            }

            electro_products_carousel_tabs( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v4_ad_banner' ) ) {
    /**
     * Displays a banner in home v4
     */
    function electro_home_v4_ad_banner() {

        $home_v4 = electro_get_home_v4_meta();

        $is_enabled = isset( $home_v4['bd']['is_enabled'] ) ? $home_v4['bd']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = ! empty( $home_v4['bd']['animation'] ) ? $home_v4['bd']['animation'] : '';

        $args = apply_filters( 'electro_home_v4_ad_banner_args', array(
            'img_src'   => ( isset( $home_v4['bd']['image'] ) && $home_v4['bd']['image'] != 0 ) ? wp_get_attachment_url( $home_v4['bd']['image'] ) : 'http://placehold.it/1170x128',
            'el_class'  => '',
            'link'      => isset( $home_v4['bd']['link'] ) ? $home_v4['bd']['link'] : '#',
        ) );

        ob_start();

        electro_fullbanner_ad( $args );

        $banner_html = ob_get_clean();

        $section_class = 'home-v4-banner-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $banner_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_products_carousel_with_deal_v4' ) ) {
    /**
     * Displays Deals Carousel
     */
    function electro_products_carousel_with_deal_v4( $args = array() ) {

        if ( is_woocommerce_activated() ) {
            $home_v4    = electro_get_home_v4_meta();
            $dpc_options = $home_v4['dpc'];

            $is_enabled = isset( $dpc_options['is_enabled'] ) ? $dpc_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $dpc_options['animation'] ) ? $dpc_options['animation'] : '';

            $args = apply_filters( 'electro_products_carousel_with_deal_v4_args', array(
                'section_title'     => isset( $dpc_options['section_title'] ) ? $dpc_options['section_title'] : esc_html__( 'Week Deals limited,Just now', 'electro' ),
                'header_timer'      => isset( $dpc_options['header_timer'] ) ? filter_var( $dpc_options['header_timer'], FILTER_VALIDATE_BOOLEAN ) : true,
                'timer_value'       => isset( $dpc_options['timer_value'] ) ? $dpc_options['timer_value'] : '+8',
                'timer_title'       => isset( $dpc_options['timer_title'] ) ? $dpc_options['timer_title'] : esc_html__( 'Hurry up! Offer ends in:', 'electro' ),
                'deal_percentage'   => isset( $dpc_options['deal_percentage'] ) ? $dpc_options['deal_percentage'] : '%',
                'section_class'     => '',
                'limit'             => $dpc_options['product_limit'],
                'columns'           => isset( $dpc_options['product_columns'] ) ? $dpc_options['product_columns'] : 4,
                'columns_wide'      => isset( $dpc_options['product_columns_wide'] ) ? $dpc_options['product_columns_wide'] : 5,
                'section_args'      => array(
                    'section_title'    => '',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $dpc_options['carousel_args']['items'] ) ? $dpc_options['carousel_args']['items']  : 4,
                    'dots'              => isset( $dpc_options['carousel_args']['dots'] ) ? filter_var( $dpc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $dpc_options['carousel_args']['nav'] ) ? filter_var( $dpc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'autoplay'          => isset( $dpc_options['carousel_args']['autoplay'] ) ? filter_var( $dpc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 2 ),
                        '992'   => array( 'items' => 3 ),
                        '1200'  => array( 'items'   => isset( $dpc_options['product_columns'] ) ? intval( $dpc_options['product_columns'] ) : 4 )
                    )
                )
            ) );

            if ( electro_is_wide_enabled() ){
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
            }

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $dpc_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $dpc_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $dpc_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $dpc_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $dpc_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            electro_products_carousel_with_deal( $args );
        }
    }
}

if ( ! function_exists( 'electro_products_with_category_image_v4_1' ) ) {
    /**
     *
     */
    function electro_products_with_category_image_v4_1() {

        if ( is_woocommerce_activated() ) {
            $home_v4    = electro_get_home_v4_meta();
            $pwci_options = isset( $home_v4['pwci1'] ) ? $home_v4['pwci1'] : '';

            $is_enabled = isset( $pwci_options['is_enabled'] ) ? $pwci_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pwci_options['animation'] ) ? $pwci_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pwci_options['section_title'] ) ? $pwci_options['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                'enable_categories' => isset( $pwci_options['enable_categories'] ) ? filter_var( $pwci_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $pwci_options['categories_title'] ) ? $pwci_options['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $pwci_options['category_args']['orderby'] ) ? $pwci_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $pwci_options['category_args']['order'] ) ? $pwci_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pwci_options['category_args']['hide_empty'] ) ? filter_var( $pwci_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pwci_options['category_args']['number'] ) ? $pwci_options['category_args']['number'] : 3,
                    'slugs'             => isset( $pwci_options['category_args']['slugs'] ) ? $pwci_options['category_args']['slugs'] : '',
                ),
                'vcategory_args'    => array(
                    'orderby'           => isset( $pwci_options['vcategory_args']['orderby'] ) ? $pwci_options['vcategory_args']['orderby'] : 'name',
                    'order'             => isset( $pwci_options['vcategory_args']['order'] ) ? $pwci_options['vcategory_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pwci_options['vcategory_args']['hide_empty'] ) ? filter_var( $pwci_options['vcategory_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pwci_options['vcategory_args']['number'] ) ? $pwci_options['vcategory_args']['number'] : 10,
                    'slugs'             => isset( $pwci_options['vcategory_args']['slugs'] ) ? $pwci_options['vcategory_args']['slugs'] : '',
                ),
                'columns_wide'      => isset( $pwci_options['product_columns_wide'] ) ? $pwci_options['product_columns_wide'] : 4,
                'shortcode_tag'     => isset( $pwci_options['content']['shortcode'] ) ? $pwci_options['content']['shortcode'] : 'featured_products',
                'shortcode_atts'    => isset( $pwci_options['content'] ) ? electro_get_atts_for_shortcode( $pwci_options['content'] ) : array( 'per_page' => 6, 'columns' => 3 ),
                'image'             => isset( $pwci_options['image'] ) && intval( $pwci_options['image'] ) ? wp_get_attachment_image_src( $pwci_options['image'], array( '360', '618' ) ) : array( '//placehold.it/360x618', '360', '618' ),
                'img_action_link'   => isset( $pwci_options['img_action_link'] ) ? $pwci_options['img_action_link'] : '#',
            );

            electro_products_with_category_image( $args );
        }
    }
}

if ( ! function_exists( 'electro_products_with_category_image_v4_2' ) ) {
    /**
     *
     */
    function electro_products_with_category_image_v4_2() {

        if ( is_woocommerce_activated() ) {
            $home_v4    = electro_get_home_v4_meta();
            $pwci_options = isset( $home_v4['pwci2'] ) ? $home_v4['pwci2'] : '';

            $is_enabled = isset( $pwci_options['is_enabled'] ) ? $pwci_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pwci_options['animation'] ) ? $pwci_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pwci_options['section_title'] ) ? $pwci_options['section_title'] : esc_html__( 'Music Headphones', 'electro' ),
                'enable_categories' => isset( $pwci_options['enable_categories'] ) ? filter_var( $pwci_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $pwci_options['categories_title'] ) ? $pwci_options['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $pwci_options['category_args']['orderby'] ) ? $pwci_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $pwci_options['category_args']['order'] ) ? $pwci_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pwci_options['category_args']['hide_empty'] ) ? filter_var( $pwci_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pwci_options['category_args']['number'] ) ? $pwci_options['category_args']['number'] : 3,
                    'slugs'             => isset( $pwci_options['category_args']['slugs'] ) ? $pwci_options['category_args']['slugs'] : '',
                ),
                'vcategory_args'    => array(
                    'orderby'           => isset( $pwci_options['vcategory_args']['orderby'] ) ? $pwci_options['vcategory_args']['orderby'] : 'name',
                    'order'             => isset( $pwci_options['vcategory_args']['order'] ) ? $pwci_options['vcategory_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pwci_options['vcategory_args']['hide_empty'] ) ? filter_var( $pwci_options['vcategory_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pwci_options['vcategory_args']['number'] ) ? $pwci_options['vcategory_args']['number'] : 10,
                    'slugs'             => isset( $pwci_options['vcategory_args']['slugs'] ) ? $pwci_options['vcategory_args']['slugs'] : '',
                ),
                'columns_wide'      => isset( $pwci_options['product_columns_wide'] ) ? $pwci_options['product_columns_wide'] : 4,
                'shortcode_tag'     => isset( $pwci_options['content']['shortcode'] ) ? $pwci_options['content']['shortcode'] : 'sale_products',
                'shortcode_atts'    => isset( $pwci_options['content'] ) ? electro_get_atts_for_shortcode( $pwci_options['content'] ) : array( 'per_page' => 6, 'columns' => 3 ),
                'image'             => isset( $pwci_options['image'] ) && intval( $pwci_options['image'] ) ? wp_get_attachment_image_src( $pwci_options['image'], array( '360', '618' ) ) : array( '//placehold.it/360x618', '360', '618' ),
                'img_action_link'   => isset( $pwci_options['img_action_link'] ) ? $pwci_options['img_action_link'] : '#',
            );

            electro_products_with_category_image( $args );
        }
    }
}

if ( ! function_exists( 'electro_products_with_category_image' ) ) {
    /**
     *
     */
    function electro_products_with_category_image( $args ) {

        if ( is_woocommerce_activated() ) {
            $defaults = array(
                'section_title'         => '',
                'section_class'         => '',
                'enable_categories'     => true,
                'categories_title'      => '',
                'category_args'         => array(),
                'enable_vcategories'    => true,
                'vcategory_args'        => array(),
                'shortcode_tag'         => '',
                'shortcode_atts'        => array(),
                'image'                 => '',
                'img_action_link'       => '#',
                'animation'             => '',
            );

            $args   = wp_parse_args( $args, $defaults );

            if( $args['enable_categories'] ) {
                $cat_args = electro_get_atts_for_taxonomy_slugs( $args['category_args'] );
                $categories = get_terms( 'product_cat',  $cat_args );
                $args['categories'] = $categories;
            }

            if( $args['enable_vcategories'] ) {
                $vcat_args = electro_get_atts_for_taxonomy_slugs( $args['vcategory_args'] );
                $vcategories = get_terms( 'product_cat',  $vcat_args );
                $args['vcategories'] = $vcategories;
            }

            electro_get_template( 'homepage/products-with-category-image.php', $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v4_categories_block' ) ) {
    /**
     *
     */
    function electro_home_v4_categories_block() {

        if ( is_woocommerce_activated() ) {
            $home_v4    = electro_get_home_v4_meta();

            $is_enabled = isset( $home_v4['hcb']['is_enabled'] ) ? $home_v4['hcb']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_v4['hcb']['animation'] ) ? $home_v4['hcb']['animation'] : '';
            $cat_args   = isset( $home_v4['hcb']['cat_args'] ) ? $home_v4['hcb']['cat_args'] : array( 'number' => 8 );

            if ( ! empty( $home_v4['hcb']['cat_slugs'] ) ) {
                $cat_slugs = explode( ',', $home_v4['hcb']['cat_slugs'] );
                $cat_slugs = array_map( 'trim', $cat_slugs );
                $cat_args['slug']               = $cat_slugs;
                $cat_args['hide_empty']         = false;

                $include = array();

                foreach ( $cat_slugs as $slug ) {
                    $include[] = "'" . $slug ."'";
                }

                if ( ! empty($include ) ) {
                    $cat_args['include']    = $include;
                    $cat_args['orderby']    = 'include';
                }
            }

            $args = apply_filters( 'electro_home_v4_categories_block_args', array(
                'section_title'         => isset( $home_v4['hcb']['section_title'] ) ? $home_v4['hcb']['section_title'] : esc_html__( 'Top Categories this Week', 'electro' ),
                'enable_full_width'     => isset( $home_v4['hcb']['enable_full_width'] ) ? filter_var( $home_v4['hcb']['enable_full_width'], FILTER_VALIDATE_BOOLEAN ) : true,
                'section_class'         => '',
                'animation'             => $animation,
                'columns'               => isset( $home_v4['hcb']['columns'] ) ? $home_v4['hcb']['columns'] : '4',
                'category_args'         => $cat_args,
            ) );

            electro_home_categories_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_products_6_1_with_categories_v4_1' ) ) {
    /**
     *
     */
    function electro_products_6_1_with_categories_v4_1() {

        if ( is_woocommerce_activated() ) {
            $home_v4    = electro_get_home_v4_meta();
            $sowc_options = isset( $home_v4['sowc1'] ) ? $home_v4['sowc1'] : '';

            $is_enabled = isset( $sowc_options['is_enabled'] ) ? $sowc_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $sowc_options['animation'] ) ? $sowc_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $sowc_options['section_title'] ) ? $sowc_options['section_title'] : esc_html__( 'Laptops & Computers', 'electro' ),
                'enable_categories' => isset( $sowc_options['enable_categories'] ) ? filter_var( $sowc_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $sowc_options['categories_title'] ) ? $sowc_options['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $sowc_options['category_args']['orderby'] ) ? $sowc_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $sowc_options['category_args']['order'] ) ? $sowc_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $sowc_options['category_args']['hide_empty'] ) ? filter_var( $sowc_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $sowc_options['category_args']['number'] ) ? $sowc_options['category_args']['number'] : 3,
                    'slugs'             => isset( $sowc_options['category_args']['slugs'] ) ? $sowc_options['category_args']['slugs'] : '',
                ),
                'vcategory_args'    => array(
                    'orderby'           => isset( $sowc_options['vcategory_args']['orderby'] ) ? $sowc_options['vcategory_args']['orderby'] : 'name',
                    'order'             => isset( $sowc_options['vcategory_args']['order'] ) ? $sowc_options['vcategory_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $sowc_options['vcategory_args']['hide_empty'] ) ? filter_var( $sowc_options['vcategory_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $sowc_options['vcategory_args']['number'] ) ? $sowc_options['vcategory_args']['number'] : 10,
                    'slugs'             => isset( $sowc_options['vcategory_args']['slugs'] ) ? $sowc_options['vcategory_args']['slugs'] : '',
                ),
                'shortcode_tag'             => isset( $sowc_options['content']['shortcode'] ) ? $sowc_options['content']['shortcode'] : 'featured_products',
                'shortcode_atts'            => isset( $sowc_options['content'] ) ? electro_get_atts_for_shortcode( $sowc_options['content'] ) : array( 'per_page' => 6, 'columns' => 3 ),
                'shortcode_tag_featured'    => isset( $sowc_options['content_featured']['shortcode'] ) ? $sowc_options['content_featured']['shortcode'] : 'featured_products',
                'shortcode_atts_featured'   => isset( $sowc_options['content_featured'] ) ? electro_get_atts_for_shortcode( $sowc_options['content_featured'] ) : array( 'per_page' => 1, 'columns' => 1 ),
            );

            electro_products_6_1_with_categories( $args );
        }
    }
}

if ( ! function_exists( 'electro_products_6_1_with_categories_v4_2' ) ) {
    /**
     *
     */
    function electro_products_6_1_with_categories_v4_2() {

        if ( is_woocommerce_activated() ) {
            $home_v4    = electro_get_home_v4_meta();
            $sowc_options = isset( $home_v4['sowc2'] ) ? $home_v4['sowc2'] : '';

            $is_enabled = isset( $sowc_options['is_enabled'] ) ? $sowc_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $sowc_options['animation'] ) ? $sowc_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $sowc_options['section_title'] ) ? $sowc_options['section_title'] : esc_html__( 'Home Enternteinment', 'electro' ),
                'enable_categories' => isset( $sowc_options['enable_categories'] ) ? filter_var( $sowc_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $sowc_options['categories_title'] ) ? $sowc_options['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $sowc_options['category_args']['orderby'] ) ? $sowc_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $sowc_options['category_args']['order'] ) ? $sowc_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $sowc_options['category_args']['hide_empty'] ) ? filter_var( $sowc_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $sowc_options['category_args']['number'] ) ? $sowc_options['category_args']['number'] : 3,
                    'slugs'             => isset( $sowc_options['category_args']['slugs'] ) ? $sowc_options['category_args']['slugs'] : '',
                ),
                'vcategory_args'    => array(
                    'orderby'           => isset( $sowc_options['vcategory_args']['orderby'] ) ? $sowc_options['vcategory_args']['orderby'] : 'name',
                    'order'             => isset( $sowc_options['vcategory_args']['order'] ) ? $sowc_options['vcategory_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $sowc_options['vcategory_args']['hide_empty'] ) ? filter_var( $sowc_options['vcategory_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $sowc_options['vcategory_args']['number'] ) ? $sowc_options['vcategory_args']['number'] : 10,
                    'slugs'             => isset( $sowc_options['vcategory_args']['slugs'] ) ? $sowc_options['vcategory_args']['slugs'] : '',
                ),
                'shortcode_tag'             => isset( $sowc_options['content']['shortcode'] ) ? $sowc_options['content']['shortcode'] : 'sale_products',
                'shortcode_atts'            => isset( $sowc_options['content'] ) ? electro_get_atts_for_shortcode( $sowc_options['content'] ) : array( 'per_page' => 6, 'columns' => 3 ),
                'shortcode_tag_featured'    => isset( $sowc_options['content_featured']['shortcode'] ) ? $sowc_options['content_featured']['shortcode'] : 'featured_products',
                'shortcode_atts_featured'   => isset( $sowc_options['content_featured'] ) ? electro_get_atts_for_shortcode( $sowc_options['content_featured'] ) : array( 'per_page' => 1, 'columns' => 1 ),
            );

            electro_products_6_1_with_categories( $args );
        }
    }
}

if ( ! function_exists( 'electro_products_6_1_with_categories' ) ) {
    /**
     *
     */
    function electro_products_6_1_with_categories( $args ) {

        if ( is_woocommerce_activated() ) {
            $defaults = array(
                'section_title'         => '',
                'section_class'         => '',
                'enable_categories'     => true,
                'categories_title'      => '',
                'category_args'         => array(),
                'enable_vcategories'    => true,
                'vcategory_args'        => array(),
                'shortcode_tag'         => '',
                'shortcode_atts'        => array(),
                'animation'             => '',
            );

            $args   = wp_parse_args( $args, $defaults );

            if( $args['enable_categories'] ) {
                $cat_args = electro_get_atts_for_taxonomy_slugs( $args['category_args'] );
                $categories = get_terms( 'product_cat',  $cat_args );
                $args['categories'] = $categories;
            }

            if( $args['enable_vcategories'] ) {
                $vcat_args = electro_get_atts_for_taxonomy_slugs( $args['vcategory_args'] );
                $vcategories = get_terms( 'product_cat',  $vcat_args );
                $args['vcategories'] = $vcategories;
            }

            electro_get_template( 'homepage/products-6-1-with-categories.php', $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v4_recent_viewed_products' ) ) {
    /**
    * Dispaly Recently Viewed Products in Home v4
    */
    function electro_home_v4_recent_viewed_products() {

        if ( is_woocommerce_activated() ) {

            if ( electro_is_wide_enabled() ) {

                global $electro_version;

                $viewed_products = electro_get_viewed_products();

                if ( empty( $viewed_products ) ) {
                    return;
                }

                $home_v4 = electro_get_home_v4_meta();
                $rvp_options     = $home_v4['rvp'];

                $is_enabled = isset( $home_v4['rvp']['is_enabled'] ) ? $home_v4['rvp']['is_enabled'] : 'no';

                if ( $is_enabled !== 'yes' ) {
                    return;
                }

                $animation = !empty( $home_v4['rvp']['animation'] ) ? ' animated ' . $home_v4['rvp']['animation'] : '';

                $args = apply_filters( 'electro_home_v4_recent_viewed_products_args', array(
                    'section_args'   => array(
                        'section_title'     => isset( $home_v4['rvp']['section_title'] ) ? $home_v4['rvp']['section_title'] : esc_html__( 'Your Recently Viewed Products', 'electro' ),
                        'section_class'     => 'section-products-carousel recently-viewed-products-carousel',
                        'animation'         => $animation
                    ),
                    'shortcode_atts'    => array(
                        'columns'           => isset( $rvp_options['product_columns'] ) ? intval( $rvp_options['product_columns'] ) : 10,
                        'per_page'          => isset( $rvp_options['shortcode_atts']['per_page'] ) ? intval( $rvp_options['shortcode_atts']['per_page'] ) : '20',
                    ),
                    'carousel_args' => array(
                        'items'             => isset( $rvp_options['carousel_args']['dots'] ) ? filter_var( $rvp_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : 10,
                        'items'             => isset( $rvp_options['product_columns'] ) ? intval( $rvp_options['product_columns'] ) : 10,
                        'dots'              => isset( $rvp_options['carousel_args']['dots'] ) ? filter_var( $rvp_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                        'autoplay'          => isset( $rvp_options['carousel_args']['autoplay'] ) ? filter_var( $rvp_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'responsive'        => array(
                            '0'     => array( 'items' => 2 ),
                            '576'   => array( 'items' => 3 ),
                            '768'   => array( 'items' => 4 ),
                            '992'   => array( 'items' => 5 ),
                            '1200'  => array( 'items' => 8 ),
                            '1440'  => array( 'items' => isset( $rvp_options['product_columns'] ) ? intval( $rvp_options['product_columns'] ) : 10 )
                        )
                    ),
                ) );

                if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $rvp_options['carousel_args']['responsive'] ) ) {
                    $responsive_args = array();
                    foreach ( $rvp_options['carousel_args']['responsive'] as $key => $responsive ) {
                        if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                            $responsive_args[$key]['items'] = intval( $responsive['items'] );
                        } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                            $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                        } else {
                            $responsive_args[$key]['items'] = $rvp_options['product_columns'];
                        }
                    }
                    $args['carousel_args']['responsive'] = $responsive_args;
                }

                $shortcode_atts = wp_parse_args( array( 'ids' => implode(',', $viewed_products ) ), $args['shortcode_atts'] );

                $products       = electro_do_shortcode( 'products',  $shortcode_atts );

                $args['section_args']['products_html'] = $products;

                electro_recent_viewed_products_carousel( $args['section_args'], $args['carousel_args'] );
            }
        }
    }
}
