<?php
/**
 * Template functions used in Home v2
 */
if ( ! function_exists( 'electro_home_v2_slider' ) ) {
    /**
     *
     */
    function electro_home_v2_slider() {
        $home_v2    = electro_get_home_v2_meta();
        $sdr        = $home_v2['sdr'];

        $is_enabled = isset( $sdr['is_enabled'] ) ? $sdr['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $sdr['animation'] ) ? $sdr['animation'] : '';
        $shortcode = !empty( $sdr['shortcode'] ) ? $sdr['shortcode'] : '[rev_slider alias="home-v2-slider"]';

        $section_class = 'home-v2-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_v2_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v2_ads_block' ) ) {
    /**
     *
     */
    function electro_home_v2_ads_block() {

        $home_v2 = electro_get_home_v2_meta();

        $is_enabled = isset( $home_v2['ad']['is_enabled'] ) ? $home_v2['ad']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v2['ad']['animation'] ) ? ' animated ' . $home_v2['ad']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'v2' );

        $args = apply_filters( 'electro_home_v2_ads_args', array(
            array(
                'ad_text'       => isset( $home_v2['ad'][0]['ad_text'] ) ? $home_v2['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Hottest <strong>Deals</strong> in Cameras', 'electro' ) ),
                'action_text'   => isset( $home_v2['ad'][0]['action_text'] ) ? $home_v2['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v2['ad'][0]['action_link'] ) ? $home_v2['ad'][0]['action_link'] : '#',
                'ad_image'      => isset( $home_v2['ad'][0]['ad_image'] ) ? wp_get_attachment_url( $home_v2['ad'][0]['ad_image'] ) : '',
                'el_class'      => isset( $home_v2['ad'][0]['el_class'] ) ? $home_v2['ad'][0]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v2['ad'][0]['ad_image'] ) ? wp_get_attachment_image( $home_v2['ad'][0]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v2['ad'][1]['ad_text'] ) ? $home_v2['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v2['ad'][1]['action_text'] ) ? $home_v2['ad'][1]['action_text'] : wp_kses_post( __( '<span class="from"><span class="prefix">From</span><span class="value"><sup>$</sup>74</span><span class="suffix">99</span>', 'electro' ) ),
                'action_link'   => isset( $home_v2['ad'][1]['action_link'] ) ? $home_v2['ad'][1]['action_link'] : '#',
                'ad_image'      => isset( $home_v2['ad'][1]['ad_image'] ) ? wp_get_attachment_url( $home_v2['ad'][1]['ad_image'] ) : '',
                'el_class'      => isset( $home_v2['ad'][1]['el_class'] ) ? $home_v2['ad'][1]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v2['ad'][1]['ad_image'] ) ? wp_get_attachment_image( $home_v2['ad'][1]['ad_image'], $ad_image_attachment_size ) : '',
            ),
        ) );

        if ( electro_is_wide_enabled() ) {
            $args[] = array(
                'ad_text'       => isset( $home_v2['ad'][2]['ad_text'] ) ? $home_v2['ad'][2]['ad_text'] : wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v2['ad'][2]['action_text'] ) ? $home_v2['ad'][2]['action_text'] : wp_kses_post( __( '<span class="from"><span class="prefix">From</span><span class="value"><sup>$</sup>74</span><span class="suffix">99</span>', 'electro' ) ),
                'action_link'   => isset( $home_v2['ad'][2]['action_link'] ) ? $home_v2['ad'][2]['action_link'] : '#',
                'ad_image'      => isset( $home_v2['ad'][2]['ad_image'] ) ? wp_get_attachment_url( $home_v2['ad'][2]['ad_image'] ) : '',
                'el_class'      => isset( $home_v2['ad'][2]['el_class'] ) ? $home_v2['ad'][2]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v2['ad'][2]['ad_image'] ) ? wp_get_attachment_image( $home_v2['ad'][2]['ad_image'], $ad_image_attachment_size ) : '',
            );
        }

        ob_start();

        electro_ads_block( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-v2-da-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v2_products_carousel_tabs' ) ) {
    /**
     *
     */
    function electro_home_v2_products_carousel_tabs() {

        if ( is_woocommerce_activated() ) {

            $home_v2 = electro_get_home_v2_meta();

            $is_enabled = isset( $home_v2['pct']['is_enabled'] ) ? $home_v2['pct']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $home_v2['pct']['animation'] ) ? $home_v2['pct']['animation'] : '';

            $args = apply_filters( 'electro_home_v2_products_carousel_tabs_args', array(
                'animation'     => $animation,
                'tabs'          => array(
                    array(
                        'id'            => 'featured-products',
                        'title'         => isset( $home_v2['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v2['pct']['tabs'][0]['title'] : esc_html__( 'Featured', 'electro' ),
                        'shortcode_tag' => isset( $home_v2['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v2['pct']['tabs'][0]['content']['shortcode'] : 'featured_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v2['pct']['tabs'][0]['content'] )
                    ),
                    array(
                        'id'            => 'sale-products',
                        'title'         => isset( $home_v2['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v2['pct']['tabs'][1]['title'] : esc_html__( 'On Sale', 'electro' ),
                        'shortcode_tag' => isset( $home_v2['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v2['pct']['tabs'][1]['content']['shortcode'] : 'sale_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v2['pct']['tabs'][1]['content'] )
                    ),
                    array(
                        'id'            => 'top-rated-products',
                        'title'         => isset( $home_v2['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v2['pct']['tabs'][2]['title'] : esc_html__( 'Top Rated', 'electro' ),
                        'shortcode_tag' => isset( $home_v2['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v2['pct']['tabs'][2]['content']['shortcode'] : 'top_rated_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v2['pct']['tabs'][2]['content'] )
                    )
                ),
                'limit'         => isset( $home_v2['pct']['product_limit'] ) ? $home_v2['pct']['product_limit'] : 6,
                'columns'       => isset( $home_v2['pct']['product_columns'] ) ? $home_v2['pct']['product_columns'] : 4,
                'columns_wide'  => isset( $home_v2['pct']['product_columns_wide'] ) ? $home_v2['pct']['product_columns_wide'] : 5,
                'nav-align'     => 'center',
                'carousel_args' => array(
                    'items'         => isset( $home_v2['pct']['product_columns'] ) ? intval( $home_v2['pct']['product_columns'] ) : 3,
                    'autoplay'      => isset( $home_v2['pct']['carousel_args']['autoplay'] ) ? filter_var( $home_v2['pct']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'    => array(
                        '0'     => array( 'items'   => 2 ),
                        '480'   => array( 'items'   => 3 ),
                        '768'   => array( 'items'   => 3 ),
                        '992'   => array( 'items'   => 3 ),
                        '1200'  => array( 'items'   => isset( $home_v2['pct']['product_columns'] ) ? intval( $home_v2['pct']['product_columns'] ) : 4 )
                    )
                )
            ) );

            if ( electro_is_wide_enabled() ){
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
                $args['carousel_args']['responsive']['768'] = array( 'items' => 4 );
                $args['carousel_args']['responsive']['992'] = array( 'items' => 4 );
            }

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $home_v2['pct']['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $home_v2['pct']['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $home_v2['pct']['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            electro_products_carousel_tabs( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v2_onsale_product' ) ) {
    /**
     * Displays an onsale product in home
     *
     * @return void
     */
    function electro_home_v2_onsale_product() {

        if ( is_woocommerce_activated() ) {

            $home_v2 = electro_get_home_v2_meta();

            $is_enabled = isset( $home_v2['dow']['is_enabled'] ) ? $home_v2['dow']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $home_v2['dow']['animation'] ) ? $home_v2['dow']['animation'] : '';

            $section_args = apply_filters( 'electro_home_v2_onsale_product_section_args', array(
                'section_title'     => isset( $home_v2['dow']['title'] ) ? $home_v2['dow']['title'] : esc_html__( 'Deals of the week', 'electro' ),
                'show_savings'      => true,
                'savings_in'        => 'amount',
                'savings_text'      => esc_html__( 'Save', 'electro' ),
                'limit'             => isset( $home_v2['dow']['product_limit'] ) ? $home_v2['dow']['product_limit'] : 4,
                'show_custom_nav'   => true,
                'product_choice'    => isset( $home_v2['dow']['product_choice'] ) ? $home_v2['dow']['product_choice'] : 'random',
                'product_ids'       => isset( $home_v2['dow']['product_ids'] ) ? $home_v2['dow']['product_ids'] :'',
                'animation'         => $animation
            ) );

            $carousel_args  = apply_filters( 'electro_home_v2_onsale_product_carousel_args', array(
                'autoplay'          => isset( $home_v2['dow']['carousel_args']['autoplay'] ) ? filter_var( $home_v2['dow']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                'items'             => 1,
                'nav'               => false,
                'slideSpeed'        => 300,
                'dots'              => false,
                'rtl'               => is_rtl() ? true : false,
                'paginationSpeed'   => 400,
                'navText'           => array( esc_html__( 'Previous Deal', 'electro' ), esc_html__( 'Next Deal', 'electro' ) ),
                'margin'            => 0,
                'touchDrag'         => true
            ) );

            if ( electro_is_wide_enabled() ) {
                $carousel_args['items'] = 1;
                $carousel_args['responsive'] = array(
                    '1480'       => array( 'items' => 2 ),
                );
            }

            electro_onsale_product_carousel( $section_args, $carousel_args );
        }
    }
}

if ( ! function_exists( 'electro_home_v2_product_cards_carousel' ) ) {
    /**
     *
     */
    function electro_home_v2_product_cards_carousel() {

        if ( is_woocommerce_activated() ) {

            $home_v2        = electro_get_home_v2_meta();

            $is_enabled = isset( $home_v2['pcc']['is_enabled'] ) ? $home_v2['pcc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation      = isset( $home_v2['pcc']['animation'] ) ? $home_v2['pcc']['animation'] : '';
            $limit          = isset( $home_v2['pcc']['product_limit'] ) ? intval( $home_v2['pcc']['product_limit'] ) : 20;
            $rows           = isset( $home_v2['pcc']['product_rows'] ) ? intval( $home_v2['pcc']['product_rows'] ) : 2;
            $columns        = isset( $home_v2['pcc']['product_columns'] ) ? intval( $home_v2['pcc']['product_columns'] ) : 3;

            $shortcode      = isset( $home_v2['pcc']['content']['shortcode'] ) ? $home_v2['pcc']['content']['shortcode'] : 'best_selling_products';
            $default_atts   = array( 'per_page' => intval( $limit ) );
            $atts           = electro_get_atts_for_shortcode( $home_v2['pcc']['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = Electro_Products::$shortcode( $atts );

            $args = apply_filters( 'electro_home_v2_product_cards_carousel_args', array(
                'section_args'  => array(
                    'section_title'     => isset( $home_v2['pcc']['section_title'] ) ? $home_v2['pcc']['section_title'] : esc_html__( 'Best Sellers', 'electro' ),
                    'section_class'     => 'home-v2-product-cards-carousel',
                    'animation'         => $animation,
                    'products'          => $products,
                    'columns'           => $columns,
                    'rows'              => $rows,
                    'total'             => $limit,
                    'cat_slugs'         => isset( $home_v2['pcc']['cat_slugs'] ) ? $home_v2['pcc']['cat_slugs'] : '',
                    'cat_limit'         => isset( $home_v2['pcc']['cat_limit'] ) ? $home_v2['pcc']['cat_limit'] : 3,
                ),
                'carousel_args' => array(
                    'autoplay'          => isset( $home_v2['pcc']['carousel_args']['autoplay'] ) ? filter_var( $home_v2['pcc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                )
            ) );

            electro_product_cards_carousel( $args['section_args'], $args['carousel_args'] );
        }
    }
}

if ( ! function_exists( 'electro_home_v2_ad_banner' ) ) {
    /**
     * Displays a banner in home v2
     */
    function electro_home_v2_ad_banner() {

        $home_v2 = electro_get_home_v2_meta();

        $is_enabled = isset( $home_v2['bd']['is_enabled'] ) ? $home_v2['bd']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v2['bd']['animation'] ) ? ' animated ' . $home_v2['bd']['animation'] : '';

        $args = apply_filters( 'electro_home_v2_ad_banner_args', array(
            'img_src'   => ( isset( $home_v2['bd']['image'] ) && $home_v2['bd']['image'] != 0 ) ? wp_get_attachment_url( $home_v2['bd']['image'] ) : 'http://placehold.it/1170x170',
            'el_class'  => 'home-v2-fullbanner-ad',
            'link'      => isset( $home_v2['bd']['link'] ) ? $home_v2['bd']['link'] : '#',
        ) );

        ob_start();

        electro_fullbanner_ad( $args );

        $banner_html = ob_get_clean();

        $section_class = 'home-v2-banner-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $banner_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v2_products_category_width_image_1' ) ) {
    /**
     *
     */
    function electro_home_v2_products_category_width_image_1() {

        if ( is_woocommerce_activated() ) {
            if ( electro_is_wide_enabled() ) {
                $home_v2    = electro_get_home_v2_meta();
                $pcwi_options = isset( $home_v2['pcwi1'] ) ? $home_v2['pcwi1'] : '';

                $is_enabled = isset( $pcwi_options['is_enabled'] ) ? $pcwi_options['is_enabled'] : 'no';

                if ( $is_enabled !== 'yes' ) {
                    return;
                }

                $animation  = isset( $pcwi_options['animation'] ) ? $pcwi_options['animation'] : '';

                $args = array(
                    'section_class'     => 'version-2',
                    'animation'         => $animation,
                    'section_title'     => isset( $pcwi_options['section_title'] ) ? $pcwi_options['section_title'] : esc_html__( 'Smartphones', 'electro' ),
                    'enable_categories' => isset( $pcwi_options['enable_categories'] ) ? filter_var( $pcwi_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'categories_title'  => isset( $pcwi_options['categories_title'] ) ? $pcwi_options['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                    'category_args'     => array(
                        'orderby'           => isset( $pcwi_options['category_args']['orderby'] ) ? $pcwi_options['category_args']['orderby'] : 'name',
                        'order'             => isset( $pcwi_options['category_args']['order'] ) ? $pcwi_options['category_args']['order'] : 'ASC',
                        'hide_empty'        => isset( $pcwi_options['category_args']['hide_empty'] ) ? filter_var( $pcwi_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'number'            => isset( $pcwi_options['category_args']['number'] ) ? $pcwi_options['category_args']['number'] : 4,
                        'slugs'             => isset( $pcwi_options['category_args']['slugs'] ) ? $pcwi_options['category_args']['slugs'] : '',
                    ),
                    'image'             => isset( $pcwi_options['image'] ) && intval( $pcwi_options['image'] ) ? wp_get_attachment_image_src( $pcwi_options['image'], array( '213', '305' ) ) : array( '//placehold.it/213x305', '213', '305' ),
                    'img_action_link'   => isset( $pcwi_options['img_action_link'] ) ? $pcwi_options['img_action_link'] : '#',
                    'columns_wide'      => isset( $pcwi_options['product_columns_wide'] ) ? $pcwi_options['product_columns_wide'] : 4,
                    'shortcode_tag'     => isset( $pcwi_options['content']['shortcode'] ) ? $pcwi_options['content']['shortcode'] : 'recent_products',
                    'shortcode_atts'    => isset( $pcwi_options['content'] ) ? electro_get_atts_for_shortcode( $pcwi_options['content'] ) : array( 'per_page' => 4, 'columns' => 4 ),
                );

                electro_products_category_with_image( $args );
            }
        }
    }
}

if ( ! function_exists( 'electro_home_v2_products_category_width_image_2' ) ) {
    /**
     *
     */
    function electro_home_v2_products_category_width_image_2() {

        if ( is_woocommerce_activated() ) {
            if ( electro_is_wide_enabled() ) {
                $home_v2    = electro_get_home_v2_meta();
                $pcwi_options = isset( $home_v2['pcwi2'] ) ? $home_v2['pcwi2'] : '';

                $is_enabled = isset( $pcwi_options['is_enabled'] ) ? $pcwi_options['is_enabled'] : 'no';

                if ( $is_enabled !== 'yes' ) {
                    return;
                }

                $animation  = isset( $pcwi_options['animation'] ) ? $pcwi_options['animation'] : '';

                $args = array(
                    'section_class'     => 'version-2',
                    'animation'         => $animation,
                    'section_title'     => isset( $pcwi_options['section_title'] ) ? $pcwi_options['section_title'] : esc_html__( 'Laptops & Computers', 'electro' ),
                    'enable_categories' => isset( $pcwi_options['enable_categories'] ) ? filter_var( $pcwi_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'categories_title'  => isset( $pcwi_options['categories_title'] ) ? $pcwi_options['categories_title'] : esc_html__( 'Featured Phones', 'electro' ),
                    'category_args'     => array(
                        'orderby'           => isset( $pcwi_options['category_args']['orderby'] ) ? $pcwi_options['category_args']['orderby'] : 'name',
                        'order'             => isset( $pcwi_options['category_args']['order'] ) ? $pcwi_options['category_args']['order'] : 'ASC',
                        'hide_empty'        => isset( $pcwi_options['category_args']['hide_empty'] ) ? filter_var( $pcwi_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'number'            => isset( $pcwi_options['category_args']['number'] ) ? $pcwi_options['category_args']['number'] : 4,
                        'slugs'             => isset( $pcwi_options['category_args']['slugs'] ) ? $pcwi_options['category_args']['slugs'] : '',
                    ),
                    'image'             => isset( $pcwi_options['image'] ) && intval( $pcwi_options['image'] ) ? wp_get_attachment_image_src( $pcwi_options['image'], array( '213', '305' ) ) : array( '//placehold.it/213x305', '213', '305' ),
                    'img_action_link'   => isset( $pcwi_options['img_action_link'] ) ? $pcwi_options['img_action_link'] : '#',
                    'columns_wide'      => isset( $pcwi_options['product_columns_wide'] ) ? $pcwi_options['product_columns_wide'] : 4,
                    'shortcode_tag'     => isset( $pcwi_options['content']['shortcode'] ) ? $pcwi_options['content']['shortcode'] : 'recent_products',
                    'shortcode_atts'    => isset( $pcwi_options['content'] ) ? electro_get_atts_for_shortcode( $pcwi_options['content'] ) : array( 'per_page' => 4, 'columns' => 4 ),
                );

                electro_products_category_with_image( $args );
            }
        }
    }
}

if ( ! function_exists( 'electro_home_v2_two_banners' ) ) {
    /**
     *
     */
    function electro_home_v2_two_banners() {

        if ( electro_is_wide_enabled() ) {

            $home_v2 = electro_get_home_v2_meta();

            $is_enabled = isset( $home_v2['tbrs']['is_enabled'] ) ? $home_v2['tbrs']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v2['tbrs']['animation'] ) ? ' animated ' . $home_v2['tbrs']['animation'] : '';

            $args = apply_filters( 'electro_home_v2_two_banners_args', array(
                array(
                    'image'         => isset( $home_v2['tbrs'][0]['image'] ) && $home_v2['tbrs'][0]['image'] ? wp_get_attachment_url( $home_v2['tbrs'][0]['image'] ) : 'http://placehold.it/536x151',
                    'action_link'   => isset( $home_v2['tbrs'][0]['action_link'] ) ? $home_v2['tbrs'][0]['action_link'] : '#',
                    'el_class'      => isset( $home_v2['tbrs'][0]['el_class'] ) ? $home_v2['tbrs'][0]['el_class'] : '',
                ),
                array(
                    'image'         => isset( $home_v2['tbrs'][1]['image'] ) && $home_v2['tbrs'][1]['image'] ? wp_get_attachment_url( $home_v2['tbrs'][1]['image'] ) : 'http://placehold.it/536x151',
                    'action_link'   => isset( $home_v2['tbrs'][1]['action_link'] ) ? $home_v2['tbrs'][1]['action_link'] : '#',
                    'el_class'      => isset( $home_v2['tbrs'][1]['el_class'] ) ? $home_v2['tbrs'][1]['el_class'] : '',
                ),
            ) );

            ob_start();

            electro_two_banners( $args );

            $ads_html = ob_get_clean();

            $section_class  = 'home-v2-da-block home-two-banners';

            if ( ! empty( $animation ) ) {
                $section_class .= ' animate-in-view';
            }
            ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
                <?php echo wp_kses_post( $ads_html ); ?>
            </div><?php
        }
    }
}

if ( ! function_exists( 'electro_home_v2_products_carousel' ) ) {
    /**
     *
     */
    function electro_home_v2_products_carousel() {

        if ( is_woocommerce_activated() ) {

            $home_v2    = electro_get_home_v2_meta();
            $pc_options = $home_v2['pc'];

            $is_enabled = isset( $pc_options['is_enabled'] ) ? $pc_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $pc_options['animation'] ) ? $pc_options['animation'] : '';

            $args = apply_filters( 'electro_home_v2_products_carousel', array(
                'limit'         => $pc_options['product_limit'],
                'columns'       => $pc_options['product_columns'],
                'columns_wide'  => isset( $pc_options['product_columns_wide'] ) ? $pc_options['product_columns_wide'] : 5,
                'section_args'  => array(
                    'section_title'     => $pc_options['section_title'],
                    'section_class'     => 'home-v2-categories-products-carousel section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => $pc_options['product_columns'],
                    'autoplay'          => isset( $pc_options['carousel_args']['autoplay'] ) ? filter_var( $pc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '480'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 3 ),
                        '992'   => array( 'items' => 3 ),
                        '1200'  => array( 'items' => $pc_options['product_columns'] ),
                    )
                )
            ) );

            if ( electro_is_wide_enabled() ) {
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
                $args['carousel_args']['responsive']['768'] = array( 'items' => 4 );
                $args['carousel_args']['responsive']['992'] = array( 'items' => 4 );
            }

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pc_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pc_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pc_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );

            $atts           = electro_get_atts_for_shortcode( $pc_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pc_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            electro_products_carousel( $args['section_args'], $args['carousel_args'] );
        }
    }
}

if ( ! function_exists( 'electro_home_v2_products_carousel_2' ) ) {
    /**
     *
     */
    function electro_home_v2_products_carousel_2() {

        if ( is_woocommerce_activated() ) {

            $home_v2    = electro_get_home_v2_meta();
            $pc2_options = $home_v2['pc2'];

            $is_enabled = isset( $pc2_options['is_enabled'] ) ? $pc2_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $pc2_options['animation'] ) ? $pc2_options['animation'] : '';

            $args = apply_filters( 'electro_home_v2_products_carousel_2_args', array(
                'limit'         => $pc2_options['product_limit'],
                'columns'       => $pc2_options['product_columns'],
                'columns_wide'  => isset( $pc2_options['product_columns_wide'] ) ? $pc2_options['product_columns_wide'] : 5,
                'section_args'  => array(
                    'section_title'     => $pc2_options['section_title'],
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => $pc2_options['product_columns'],
                    'autoplay'          => isset( $pc2_options['carousel_args']['autoplay'] ) ? filter_var( $pc2_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '480'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 3 ),
                        '992'   => array( 'items' => 3 ),
                        '1200'  => array( 'items' => $pc2_options['product_columns'] ),
                    )
                )
            ) );

            if ( electro_is_wide_enabled() ) {
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
                $args['carousel_args']['responsive']['768'] = array( 'items' => 4 );
                $args['carousel_args']['responsive']['992'] = array( 'items' => 4 );
            }

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pc2_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pc2_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pc2_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $pc2_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pc2_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            electro_products_carousel( $args['section_args'], $args['carousel_args'] );
        }
    }
}

if ( ! function_exists( 'electro_home_v2_products_carousel_3' ) ) {
    /**
     *
     */
    function electro_home_v2_products_carousel_3() {

        if ( is_woocommerce_activated() ) {

            $home_v2    = electro_get_home_v2_meta();
            $pc3_options = $home_v2['pc3'];

            $is_enabled = isset( $pc3_options['is_enabled'] ) ? $pc3_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $pc3_options['animation'] ) ? $pc3_options['animation'] : '';

            $args = apply_filters( 'electro_home_v2_products_carousel_3_args', array(
                'limit'         => $pc3_options['product_limit'],
                'columns'       => $pc3_options['product_columns'],
                'columns_wide'  => isset( $pc3_options['product_columns_wide'] ) ? $pc3_options['product_columns_wide'] : 5,
                'section_args'  => array(
                    'section_title'     => $pc3_options['section_title'],
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => $pc3_options['product_columns'],
                    'autoplay'          => isset( $pc3_options['carousel_args']['autoplay'] ) ? filter_var( $pc3_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '480'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 3 ),
                        '992'   => array( 'items' => 3 ),
                        '1200'  => array( 'items' => $pc3_options['product_columns'] ),
                    )
                )
            ) );

            if ( electro_is_wide_enabled() ) {
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
                $args['carousel_args']['responsive']['768'] = array( 'items' => 4 );
                $args['carousel_args']['responsive']['992'] = array( 'items' => 4 );
            }

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pc3_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pc3_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pc3_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $pc3_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pc3_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            electro_products_carousel( $args['section_args'], $args['carousel_args'] );
        }
    }
}
