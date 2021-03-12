<?php
/**
 * Template functions hooked into the `homepage_v6` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v6_products_carousel_banner_vertical_tabs' ) ) {
    /**
     * Displays Products Carousel and Banner with Vertical Tabs in Home v6
     */
    function electro_home_v6_products_carousel_banner_vertical_tabs() {
        if ( is_woocommerce_activated() ) {

            $home_v6 = electro_get_home_v6_meta();
            $pcbvt_options     = $home_v6['pcbvt'];

            $is_enabled = isset( $home_v6['pcbvt']['is_enabled'] ) ? $home_v6['pcbvt']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v6['pcbvt']['animation'] ) ? ' animated ' . $home_v6['pcbvt']['animation'] : '';

            $args = apply_filters( 'electro_home_v6_products_carousel_banner_vertical_tabs_args', array(
                'limit'             => isset( $home_v6['pcbvt']['product_limit'] ) ? intval( $home_v6['pcbvt']['product_limit'] ) : 20,
                'columns'           => isset( $home_v6['pcbvt']['product_columns'] ) ? intval( $home_v6['pcbvt']['product_columns'] ) : 7,
                'section_args'      => array(
                    'section_class'     => 'section-products-carousel',
                    'carousel_id'       => 'products-carousel-' . uniqid(),
                    'bg_img'            => isset( $home_v6['pcbvt']['bg_img'] ) ? wp_get_attachment_url( $home_v6['pcbvt']['bg_img'] ) : '',
                    'animation'         => $animation
                ),
                'tabs_args'          => array(
                    array(
                        'title'             => isset( $pcbvt_options['tabs'][0]['title'] ) ? $pcbvt_options['tabs'][0]['title'] : esc_html__( 'End Season Sale 2', 'electro' ),
                        'tab_title'         => isset( $pcbvt_options['tabs'][0]['tab_title'] ) ? $pcbvt_options['tabs'][0]['tab_title'] : wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                        'tab_sub_title'     => isset( $pcbvt_options['tabs'][0]['tab_sub_title'] ) ? $pcbvt_options['tabs'][0]['tab_sub_title'] : wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                        'action_text'       => isset( $pcbvt_options['tabs'][0]['action_text'] ) ? $pcbvt_options['tabs'][0]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                        'action_link'       => isset( $pcbvt_options['tabs'][0]['action_link'] ) ? $pcbvt_options['tabs'][0]['action_link'] : '#',
                        'image'             => isset( $pcbvt_options['tabs'][0]['image'] ) && $pcbvt_options['tabs'][0]['image'] ? wp_get_attachment_url( $pcbvt_options['tabs'][0]['image'] ) : 'http://placehold.it/723x361',
                    ),
                    array(
                        'title'             => isset( $pcbvt_options['tabs'][1]['title'] ) ? $pcbvt_options['tabs'][1]['title'] : esc_html__( 'Smartphones Sale', 'electro' ),
                        'tab_title'         => isset( $pcbvt_options['tabs'][1]['tab_title'] ) ? $pcbvt_options['tabs'][1]['tab_title'] : wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                        'tab_sub_title'     => isset( $pcbvt_options['tabs'][1]['tab_sub_title'] ) ? $pcbvt_options['tabs'][1]['tab_sub_title'] : wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                        'action_text'       => isset( $pcbvt_options['tabs'][1]['action_text'] ) ? $pcbvt_options['tabs'][1]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                        'action_link'       => isset( $pcbvt_options['tabs'][1]['action_link'] ) ? $pcbvt_options['tabs'][1]['action_link'] : '#',
                        'image'             => isset( $pcbvt_options['tabs'][1]['image'] ) && $pcbvt_options['tabs'][1]['image'] ? wp_get_attachment_url( $pcbvt_options['tabs'][1]['image'] ) : 'http://placehold.it/723x361',
                    ),
                    array(
                        'title'             => isset( $pcbvt_options['tabs'][2]['title'] ) ? $pcbvt_options['tabs'][2]['title'] : esc_html__( 'End Season Sale', 'electro' ),
                        'tab_title'         => isset( $pcbvt_options['tabs'][2]['tab_title'] ) ? $pcbvt_options['tabs'][2]['tab_title'] : wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                        'tab_sub_title'     => isset( $pcbvt_options['tabs'][2]['tab_sub_title'] ) ? $pcbvt_options['tabs'][2]['tab_sub_title'] : wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                        'action_text'       => isset( $pcbvt_options['tabs'][2]['action_text'] ) ? $pcbvt_options['tabs'][2]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                        'action_link'       => isset( $pcbvt_options['tabs'][2]['action_link'] ) ? $pcbvt_options['tabs'][2]['action_link'] : '#',
                        'image'             => isset( $pcbvt_options['tabs'][2]['image'] ) && $pcbvt_options['tabs'][2]['image'] ? wp_get_attachment_url( $pcbvt_options['tabs'][2]['image'] ) : 'http://placehold.it/723x361',
                    ),
                    array(
                        'title'             => isset( $pcbvt_options['tabs'][3]['title'] ) ? $pcbvt_options['tabs'][3]['title'] : esc_html__( 'Laptops Arrivals', 'electro' ),
                        'tab_title'         => isset( $pcbvt_options['tabs'][3]['tab_title'] ) ? $pcbvt_options['tabs'][3]['tab_title'] : wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                        'tab_sub_title'     => isset( $pcbvt_options['tabs'][3]['tab_sub_title'] ) ? $pcbvt_options['tabs'][3]['tab_sub_title'] : wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                        'action_text'       => isset( $pcbvt_options['tabs'][3]['action_text'] ) ? $pcbvt_options['tabs'][3]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                        'action_link'       => isset( $pcbvt_options['tabs'][3]['action_link'] ) ? $pcbvt_options['tabs'][3]['action_link'] : '#',
                        'image'             => isset( $pcbvt_options['tabs'][3]['image'] ) && $pcbvt_options['tabs'][3]['image'] ? wp_get_attachment_url( $pcbvt_options['tabs'][3]['image'] ) : 'http://placehold.it/723x361',
                    ),
                    array(
                        'title'             => isset( $pcbvt_options['tabs'][4]['title'] ) ? $pcbvt_options['tabs'][4]['title'] : esc_html__( 'Earphones - 25%', 'electro' ),
                        'tab_title'         => isset( $pcbvt_options['tabs'][4]['tab_title'] ) ? $pcbvt_options['tabs'][4]['tab_title'] : wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                        'tab_sub_title'     => isset( $pcbvt_options['tabs'][4]['tab_sub_title'] ) ? $pcbvt_options['tabs'][4]['tab_sub_title'] : wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                        'action_text'       => isset( $pcbvt_options['tabs'][4]['action_text'] ) ? $pcbvt_options['tabs'][4]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                        'action_link'       => isset( $pcbvt_options['tabs'][4]['action_link'] ) ? $pcbvt_options['tabs'][4]['action_link'] : '#',
                        'image'             => isset( $pcbvt_options['tabs'][4]['image'] ) && $pcbvt_options['tabs'][4]['image'] ? wp_get_attachment_url( $pcbvt_options['tabs'][4]['image'] ) : 'http://placehold.it/723x361',
                    ),
                    array(
                        'title'             => isset( $pcbvt_options['tabs'][5]['title'] ) ? $pcbvt_options['tabs'][5]['title'] : esc_html__( 'Tablets 10 inch Sale', 'electro' ),
                        'tab_title'         => isset( $pcbvt_options['tabs'][5]['tab_title'] ) ? $pcbvt_options['tabs'][5]['tab_title'] : wp_kses_post( __( 'End Season <span> Smartphones</span>', 'electro' ) ),
                        'tab_sub_title'     => isset( $pcbvt_options['tabs'][5]['tab_sub_title'] ) ? $pcbvt_options['tabs'][5]['tab_sub_title'] : wp_kses_post( __( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ) ),
                        'action_text'       => isset( $pcbvt_options['tabs'][5]['action_text'] ) ? $pcbvt_options['tabs'][5]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                        'action_link'       => isset( $pcbvt_options['tabs'][5]['action_link'] ) ? $pcbvt_options['tabs'][5]['action_link'] : '#',
                        'image'             => isset( $pcbvt_options['tabs'][5]['image'] ) && $pcbvt_options['tabs'][5]['image'] ? wp_get_attachment_url( $pcbvt_options['tabs'][5]['image'] ) : 'http://placehold.it/723x361',
                    ),
                ),
                'carousel_args' => array(
                    'items'             => isset( $pcbvt_options['product_columns'] ) ? intval( $pcbvt_options['product_columns'] ) : 7,
                    'dots'              => isset( $pcbvt_options['carousel_args']['dots'] ) ? filter_var( $pcbvt_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pcbvt_options['carousel_args']['nav'] ) ? filter_var( $pcbvt_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                    'autoplay'          => isset( $pcbvt_options['carousel_args']['autoplay'] ) ? filter_var( $pcbvt_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 3 ),
                        '992'   => array( 'items' => 4 ),
                        '1200'  => array( 'items' => isset( $pcbvt_options['product_columns'] ) ? intval( $pcbvt_options['product_columns'] ) : 7 )
                    )
                ),
                'limit'     => isset( $home_v6['pcbvt']['product_limit'] ) ? $home_v6['pcbvt']['product_limit'] : 20,
                'columns'   => isset( $home_v6['pcbvt']['product_columns'] ) ? $home_v6['pcbvt']['product_columns'] : 7,
            ) );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pcbvt_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pcbvt_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pcbvt_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $pcbvt_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pcbvt_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            products_carousel_banner_vertical_tabs( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v6_two_banners' ) ) {
    /**
     *
     */
    function electro_home_v6_two_banners() {

        $home_v6 = electro_get_home_v6_meta();

        $is_enabled = isset( $home_v6['tbrs']['is_enabled'] ) ? $home_v6['tbrs']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v6['tbrs']['animation'] ) ? ' animated ' . $home_v6['tbrs']['animation'] : '';

        $args = apply_filters( 'electro_home_v6_two_banners_args', array(
            array(
                'image'         => isset( $home_v6['tbrs'][0]['image'] ) && $home_v6['tbrs'][0]['image'] ? wp_get_attachment_url( $home_v6['tbrs'][0]['image'] ) : 'http://placehold.it/690x151',
                'action_link'   => isset( $home_v6['tbrs'][0]['action_link'] ) ? $home_v6['tbrs'][0]['action_link'] : '#',
                'el_class'      => isset( $home_v6['tbrs'][0]['el_class'] ) ? $home_v6['tbrs'][0]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v6['tbrs'][1]['image'] ) && $home_v6['tbrs'][1]['image'] ? wp_get_attachment_url( $home_v6['tbrs'][1]['image'] ) : 'http://placehold.it/690x151',
                'action_link'   => isset( $home_v6['tbrs'][1]['action_link'] ) ? $home_v6['tbrs'][1]['action_link'] : '#',
                'el_class'      => isset( $home_v6['tbrs'][1]['el_class'] ) ? $home_v6['tbrs'][1]['el_class'] : '',
            ),
        ) );

        ob_start();

        electro_two_banners( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-v6-da-block home-two-banners';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v6_category_icons_carousel' ) ) {
    /**
     *
     */
    function electro_home_v6_category_icons_carousel() {

        if ( is_woocommerce_activated() ) {
            $home_v6    = electro_get_home_v6_meta();

            $is_enabled = isset( $home_v6['cic']['is_enabled'] ) ? $home_v6['cic']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_v6['cic']['animation'] ) ? $home_v6['cic']['animation'] : '';
            $cat_args   = isset( $home_v6['cic']['cat_args'] ) ? $home_v6['cic']['cat_args'] : array( 'number' => 20 );

            if ( ! empty( $home_v6['cic']['cat_slugs'] ) ) {
                $cat_slugs = explode( ',', $home_v6['cic']['cat_slugs'] );
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

            $args = apply_filters( 'electro_home_v6_category_icons_carousel_args', array(
                'animation'             => $animation,
                'section_class'         => '',
                'category_args'         => $cat_args,
            ) );

            $carousel_args  = apply_filters( 'electro_home_category_icons_carousel_value_args', array(
                'items'             => isset( $home_v6['cic']['carousel_args']['items'] ) ? $home_v6['cic']['carousel_args']['items']  : 10,
                'dots'              => isset( $home_v6['cic']['carousel_args']['dots'] ) ? filter_var( $home_v6['cic']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                'nav'               => isset( $home_v6['cic']['carousel_args']['nav'] ) ? filter_var( $home_v6['cic']['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                'rtl'               => is_rtl() ? true : false,
                'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'autoplay'          => isset( $home_v6['cic']['carousel_args']['autoplay'] ) ? filter_var( $home_v6['cic']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                'responsive'        => array(
                    '0'     => array( 'items' => 2 ),
                    '576'   => array( 'items' => 3 ),
                    '768'   => array( 'items' => 3 ),
                    '992'   => array( 'items' => 4 ),
                    '1200'  => array( 'items' => 7 ),
                    '1430'  => array( 'items' => 10 ),
                    '1430'  => array( 'items' => isset( $home_v6['cic']['carousel_args']['items'] ) ? intval( $home_v6['cic']['carousel_args']['items'] ) : 10 )
                )
            ) );

            electro_home_category_icon_carousel( $args, $carousel_args );
        }
    }
}

if ( ! function_exists( 'electro_home_v6_product_tabs_carousel_with_deal' ) ) {
    /**
    *
    */
    function electro_home_v6_product_tabs_carousel_with_deal() {
        if ( is_woocommerce_activated() ) {

            $home_v6 = electro_get_home_v6_meta();
            $ptcwd_options = $home_v6['ptcwd'];

            $is_enabled = isset( $home_v6['ptcwd']['is_enabled'] ) ? $home_v6['ptcwd']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v6['ptcwd']['animation'] ) ? ' animated ' . $home_v6['ptcwd']['animation'] : '';

            $args = apply_filters( 'electro_home_v6_product_tabs_carousel_with_deal_args', array(
                'section_title' => isset( $home_v6['ptcwd']['section_title'] ) ? $home_v6['ptcwd']['section_title'] : esc_html__( 'Catch Daily Deals!', 'electro' ),
                'button_text'   => isset( $home_v6['ptcwd']['button_text'] ) ? $home_v6['ptcwd']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                'button_link'   => isset( $home_v6['ptcwd']['button_link'] ) ? $home_v6['ptcwd']['button_link'] : '#',
                'limit'         => isset( $home_v6['ptcwd']['product_limit'] ) ? $home_v6['ptcwd']['product_limit'] : 20,
                'columns'       => isset( $home_v6['ptcwd']['product_columns'] ) ? intval( $home_v6['ptcwd']['product_columns'] ) : 5,
                'rows'          => isset( $home_v6['ptcwd']['product_rows'] ) ? intval( $home_v6['ptcwd']['product_rows'] ) : 2,
                'deal_products_args'    => array(
                    'is_enabled'        => isset( $home_v6['ptcwd']['deal']['is_enabled'] ) ? $home_v6['ptcwd']['deal']['is_enabled'] : 'no',
                    'section_title'     => isset( $home_v6['ptcwd']['deal']['title'] ) ? $home_v6['ptcwd']['deal']['title'] : esc_html__( 'Special Offer', 'electro' ),
                    'product_choice'    => isset( $home_v6['ptcwd']['deal']['product_choice'] ) ? $home_v6['ptcwd']['deal']['product_choice'] : '',
                    'product_id'        => isset( $home_v6['ptcwd']['deal']['product_id'] ) ? $home_v6['ptcwd']['deal']['product_id'] : '',
                    'savings_in'        => isset( $home_v6['ptcwd']['deal']['savings_in'] ) ? $home_v6['ptcwd']['deal']['savings_in'] : 'amount',
                ),
                'tabs'          => array(
                    array(
                        'id'            => 'tab-products-1',
                        'title'         => isset( $home_v6['ptcwd']['tabs'][0]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][0]['title'] : esc_html__( '-80% off', 'electro' ),
                        'shortcode_tag' => isset( $home_v6['ptcwd']['tabs'][0]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][0]['content']['shortcode'] : 'recent_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v6['ptcwd']['tabs'][0]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-2',
                        'title'         => isset( $home_v6['ptcwd']['tabs'][1]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][1]['title'] : esc_html__( '-65%', 'electro' ),
                        'shortcode_tag' => isset( $home_v6['ptcwd']['tabs'][1]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][1]['content']['shortcode'] : 'sale_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v6['ptcwd']['tabs'][1]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-3',
                        'title'         => isset( $home_v6['ptcwd']['tabs'][2]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][2]['title'] : esc_html__( '-45%', 'electro' ),
                        'shortcode_tag' => isset( $home_v6['ptcwd']['tabs'][2]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][2]['content']['shortcode'] : 'top_rated_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v6['ptcwd']['tabs'][2]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-4',
                        'title'         => isset( $home_v6['ptcwd']['tabs'][3]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][3]['title'] : esc_html__( '-25%', 'electro' ),
                        'shortcode_tag' => isset( $home_v6['ptcwd']['tabs'][3]['content']['shortcode'] ) ? $home_v6['ptcwd']['tabs'][3]['content']['shortcode'] : 'featured_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v6['ptcwd']['tabs'][3]['content'] )
                    )
                ),
                'carousel_args' => array(
                    'items'         => 1,
                    'dots'          => isset( $home_v6['ptcwd']['carousel_args']['dots'] ) ? filter_var( $home_v6['ptcwd']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'           => isset( $home_v6['ptcwd']['carousel_args']['nav'] ) ? filter_var( $home_v6['ptcwd']['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'autoplay'      => isset( $home_v6['ptcwd']['carousel_args']['autoplay'] ) ? filter_var( $home_v6['ptcwd']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                )
            ) );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $ptcwd_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $ptcwd_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $ptcwd_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            electro_products_carousel_tabs_with_deal( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v6_products_carousel' ) ) {
    /**
    *
    */
    function electro_home_v6_products_carousel() {
        if ( is_woocommerce_activated() ) {

            $home_v6 = electro_get_home_v6_meta();
            $pc_options     = $home_v6['pc'];

            $is_enabled = isset( $home_v6['pc']['is_enabled'] ) ? $home_v6['pc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v6['pc']['animation'] ) ? ' animated ' . $home_v6['pc']['animation'] : '';

            $args = apply_filters( 'electro_home_v6_products_carousel_args', array(
                'limit'             => isset( $home_v6['pc']['product_limit'] ) ? intval( $home_v6['pc']['product_limit'] ) : 20,
                'columns'           => isset( $home_v6['pc']['product_columns'] ) ? intval( $home_v6['pc']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v6['pc']['section_title'] ) ? $home_v6['pc']['section_title'] : esc_html__( 'Trending Products', 'electro' ),
                    'button_text'       => isset( $home_v6['pc']['button_text'] ) ? $home_v6['pc']['button_text'] : wp_kses_post( __( 'See All Trending products', 'electro' ) ),
                    'button_link'       => isset( $home_v6['pc']['button_link'] ) ? $home_v6['pc']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel trending-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                    'autoplay'          => isset( $pc_options['carousel_args']['autoplay'] ) ? filter_var( $pc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 3 ),
                        '992'   => array( 'items' => 4 ),
                        '1200'  => array( 'items' => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6 )
                    )
                ),
                'limit'     => isset( $home_v6['pc']['product_limit'] ) ? $home_v6['pc']['product_limit'] : 20,
            ) );

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

            electro_products_carousel_v5( $args['section_args'], $args['carousel_args'] );
        }
    }
}

if ( ! function_exists( 'electro_home_v6_ad_banner' ) ) {
    /**
     * Displays a banner in home v6
     */
    function electro_home_v6_ad_banner() {

        $home_v6 = electro_get_home_v6_meta();

        $is_enabled = isset( $home_v6['bd']['is_enabled'] ) ? $home_v6['bd']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = ! empty( $home_v6['bd']['animation'] ) ? $home_v6['bd']['animation'] : '';

        $args = apply_filters( 'electro_home_v6_ad_banner_args', array(
            'img_src'   => ( isset( $home_v6['bd']['image'] ) && $home_v6['bd']['image'] != 0 ) ? wp_get_attachment_url( $home_v6['bd']['image'] ) : 'http://placehold.it/1401x124',
            'link'      => isset( $home_v6['bd']['link'] ) ? $home_v6['bd']['link'] : '#',
            'el_class'  => '',
        ) );

        ob_start();

        electro_fullbanner_ad( $args );

        $banner_html = ob_get_clean();

        $section_class = 'home-v6-banner-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $banner_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v6_products_carousel_width_image_1' ) ) {
    /**
     *
     */
    function electro_home_v6_products_carousel_width_image_1() {

        if ( is_woocommerce_activated() ) {
            $home_v6    = electro_get_home_v6_meta();
            $pwci_options = isset( $home_v6['pcwi1'] ) ? $home_v6['pcwi1'] : '';

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
                    'number'            => isset( $pwci_options['category_args']['number'] ) ? $pwci_options['category_args']['number'] : 6,
                    'slugs'             => isset( $pwci_options['category_args']['slugs'] ) ? $pwci_options['category_args']['slugs'] : '',
                ),
                'description'       => isset( $pwci_options['description'] ) ? filter_var( $pwci_options['description'], FILTER_VALIDATE_BOOLEAN ) : false,
                'limit'             => $pwci_options['product_limit'],
                'columns'           => isset( $pwci_options['product_columns'] ) ? intval( $pwci_options['product_columns'] ) : 5,
                'image'             => isset( $pwci_options['image'] ) && intval( $pwci_options['image'] ) ? wp_get_attachment_image_src( $pwci_options['image'], array( '387', '365' ) ) : array( '//placehold.it/387x365', '387', '365' ),
                'img_action_link'   => isset( $pwci_options['img_action_link'] ) ? $pwci_options['img_action_link'] : '#',
                'carousel_args' => array(
                    'items'             => isset( $pwci_options['product_columns'] ) ? intval( $pwci_options['product_columns'] ) : 5,
                    'dots'              => isset( $pwci_options['carousel_args']['dots'] ) ? filter_var( $pwci_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pwci_options['carousel_args']['nav'] ) ? filter_var( $pwci_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'autoplay'          => isset( $pwci_options['carousel_args']['autoplay'] ) ? filter_var( $pwci_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 2 ),
                        '992'   => array( 'items' => 3 ),
                        '1200'  => array( 'items' => isset( $pwci_options['product_columns'] ) ? intval( $pwci_options['product_columns'] ) : 5 )
                    )
                )
            );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pwci_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pwci_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pwci_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $pwci_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pwci_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            electro_products_carousel_category_with_image( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v6_products_carousel_width_image_2' ) ) {
    /**
     *
     */
    function electro_home_v6_products_carousel_width_image_2() {

        if ( is_woocommerce_activated() ) {
            $home_v6    = electro_get_home_v6_meta();
            $pwci_options = isset( $home_v6['pcwi2'] ) ? $home_v6['pcwi2'] : '';

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
                    'number'            => isset( $pwci_options['category_args']['number'] ) ? $pwci_options['category_args']['number'] : 6,
                    'slugs'             => isset( $pwci_options['category_args']['slugs'] ) ? $pwci_options['category_args']['slugs'] : '',
                ),
                'description'       => isset( $pwci_options['description'] ) ? filter_var( $pwci_options['description'], FILTER_VALIDATE_BOOLEAN ) : false,
                'limit'             => $pwci_options['product_limit'],
                'columns'           => isset( $pwci_options['product_columns'] ) ? intval( $pwci_options['product_columns'] ) : 5,
                'image'             => isset( $pwci_options['image'] ) && intval( $pwci_options['image'] ) ? wp_get_attachment_image_src( $pwci_options['image'], array( '387', '280' ) ) : array( '//placehold.it/387x280', '387', '280' ),
                'img_action_link'   => isset( $pwci_options['img_action_link'] ) ? $pwci_options['img_action_link'] : '#',
                'carousel_args' => array(
                    'items'             => isset( $pwci_options['product_columns'] ) ? intval( $pwci_options['product_columns'] ) : 5,
                    'dots'              => isset( $pwci_options['carousel_args']['dots'] ) ? filter_var( $pwci_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pwci_options['carousel_args']['nav'] ) ? filter_var( $pwci_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'autoplay'          => isset( $pwci_options['carousel_args']['autoplay'] ) ? filter_var( $pwci_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 2 ),
                        '992'   => array( 'items' => 3 ),
                        '1200'  => array( 'items' => isset( $pwci_options['product_columns'] ) ? intval( $pwci_options['product_columns'] ) : 5 )
                    )
                )
            );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pwci_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pwci_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pwci_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $pwci_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pwci_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            electro_products_carousel_category_with_image( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v6_ads_block' ) ) {
    /**
     * Displays Ads Block in Home v6
     */
    function electro_home_v6_ads_block() {

        $home_v6 = electro_get_home_v6_meta();

        $is_enabled = isset( $home_v6['ad']['is_enabled'] ) ? $home_v6['ad']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $home_v6['ad']['animation'] ) ? $home_v6['ad']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'v6' );

        $args = apply_filters( 'home_v6_ads_args', array(
            array(
                'ad_text'       => isset( $home_v6['ad'][0]['ad_text'] ) ? $home_v6['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <br><strong>Deals</strong> on the Cameras', 'electro' ) ),
                'action_text'   => isset( $home_v6['ad'][0]['action_text'] ) ? $home_v6['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v6['ad'][0]['action_link'] ) ? $home_v6['ad'][0]['action_link'] : '#',
                'ad_image'      => isset( $home_v6['ad'][0]['ad_image'] ) ? wp_get_attachment_url( $home_v6['ad'][0]['ad_image'] ) : '',
                'el_class'      => isset( $home_v6['ad'][0]['el_class'] ) ? $home_v6['ad'][0]['el_class'] : '',
                'ad_image_attachment'  => isset( $home_v6['ad'][0]['ad_image'] ) ? wp_get_attachment_image( $home_v6['ad'][0]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v6['ad'][1]['ad_text'] ) ? $home_v6['ad'][1]['ad_text'] : wp_kses_post( __( 'Shop the <strong>Hottest</strong> Products', 'electro' ) ),
                'action_text'   => isset( $home_v6['ad'][1]['action_text'] ) ? $home_v6['ad'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v6['ad'][1]['action_link'] ) ? $home_v6['ad'][1]['action_link'] : '#',
                'ad_image'      => isset( $home_v6['ad'][1]['ad_image'] ) ? wp_get_attachment_url( $home_v6['ad'][1]['ad_image'] ) : '',
                'el_class'      => isset( $home_v6['ad'][1]['el_class'] ) ? $home_v6['ad'][1]['el_class'] : '',
                'ad_image_attachment'  => isset( $home_v6['ad'][1]['ad_image'] ) ? wp_get_attachment_image( $home_v6['ad'][1]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v6['ad'][2]['ad_text'] ) ? $home_v6['ad'][2]['ad_text'] : wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v6['ad'][2]['action_text'] ) ? $home_v6['ad'][2]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                'action_link'   => isset( $home_v6['ad'][2]['action_link'] ) ? $home_v6['ad'][2]['action_link'] : '#',
                'ad_image'      => isset( $home_v6['ad'][2]['ad_image'] ) ? wp_get_attachment_url( $home_v6['ad'][2]['ad_image'] ) : '',
                'el_class'      => isset( $home_v6['ad'][2]['el_class'] ) ? $home_v6['ad'][2]['el_class'] : '',
                'ad_image_attachment'  => isset( $home_v6['ad'][2]['ad_image'] ) ? wp_get_attachment_image( $home_v6['ad'][2]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v6['ad'][3]['ad_text'] ) ? $home_v6['ad'][3]['ad_text'] : wp_kses_post( __( 'The New Standard <br><strong>360 Cameras</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v6['ad'][3]['action_text'] ) ? $home_v6['ad'][3]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                'action_link'   => isset( $home_v6['ad'][3]['action_link'] ) ? $home_v6['ad'][3]['action_link'] : '#',
                'ad_image'      => isset( $home_v6['ad'][3]['ad_image'] ) ? wp_get_attachment_url( $home_v6['ad'][3]['ad_image'] ) : '',
                'el_class'      => isset( $home_v6['ad'][3]['el_class'] ) ? $home_v6['ad'][3]['el_class'] : '',
                'ad_image_attachment'  => isset( $home_v6['ad'][3]['ad_image'] ) ? wp_get_attachment_image( $home_v6['ad'][3]['ad_image'], $ad_image_attachment_size ) : '',
            ),
        ) );

        ob_start();

        electro_ads_block( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-v6-da-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v6_recent_viewed_products' ) ) {
    /**
    * Dispaly Recently Viewed Products in Home v6
    */
    function electro_home_v6_recent_viewed_products() {

        if ( is_woocommerce_activated() ) {

            global $electro_version;

            $viewed_products = electro_get_viewed_products();

            if ( empty( $viewed_products ) ) {
                return;
            }

            $home_v6 = electro_get_home_v6_meta();
            $rvp_options     = $home_v6['rvp'];

            $is_enabled = isset( $home_v6['rvp']['is_enabled'] ) ? $home_v6['rvp']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v6['rvp']['animation'] ) ? ' animated ' . $home_v6['rvp']['animation'] : '';

            $args = apply_filters( 'electro_home_v6_recent_viewed_products_args', array(
                'section_args'   => array(
                    'section_title'     => isset( $home_v6['rvp']['section_title'] ) ? $home_v6['rvp']['section_title'] : esc_html__( 'Your Recently Viewed Products', 'electro' ),
                    'section_class'     => 'section-products-carousel recently-viewed-products-carousel',
                    'animation'         => $animation
                ),
                'shortcode_atts'    => array(
                    'columns'           => isset( $rvp_options['product_columns'] ) ? intval( $rvp_options['product_columns'] ) : 10,
                    'per_page'          => isset( $rvp_options['shortcode_atts']['per_page'] ) ? intval( $rvp_options['shortcode_atts']['per_page'] ) : '20',
                ),
                'carousel_args' => array(
                    'items'             => isset( $rvp_options['carousel_args']['dots'] ) ? filter_var( $rvp_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : 8,
                    'items'             => isset( $rvp_options['product_columns'] ) ? intval( $rvp_options['product_columns'] ) : 10,
                    'dots'              => isset( $rvp_options['carousel_args']['dots'] ) ? filter_var( $rvp_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'autoplay'          => isset( $rvp_options['carousel_args']['autoplay'] ) ? filter_var( $rvp_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 4 ),
                        '992'   => array( 'items' => 5 ),
                        '1200'  => array( 'items' => isset( $rvp_options['product_columns'] ) ? intval( $rvp_options['product_columns'] ) : 10 )
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
