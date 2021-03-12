<?php
/**
 * Template functions hooked into the `homepage_v5` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v5_nav_menu' ) ) {
    /**
     * Displays secondary nav in Home v5
     */
    function electro_home_v5_nav_menu() {

        $home_v5    = electro_get_home_v5_meta();
        $nav        = $home_v5['nav'];

        $is_enabled = isset( $nav['is_enabled'] ) ? $nav['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $nav['animation'] ) ? $nav['animation'] : '';

        $section_class = 'home-v5-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }

        $args = apply_filters( 'electro_home_v5_nav_menu_args', array(
            'animation' => $animation,
            'title'     => isset( $nav['title'] ) ? $nav['title'] : esc_html__( 'Electro Best Selling:', 'electro' ),
            'menu'      => isset( $nav['menu'] ) ? $nav['menu'] : ''
        ) );

        electro_secondary_nav_v6( $args );
    }
}

if ( ! function_exists( 'electro_home_v5_slider' ) ) {
    /**
     * Displays Slider in Home v5
     */
    function electro_home_v5_slider() {

        $home_v5    = electro_get_home_v5_meta();
        $sdr        = $home_v5['sdr'];

        $is_enabled = isset( $sdr['is_enabled'] ) ? $sdr['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $sdr['animation'] ) ? $sdr['animation'] : '';
        $shortcode = !empty( $sdr['shortcode'] ) ? $sdr['shortcode'] : '[rev_slider alias="home-v5-slider"]';

        $section_class = 'home-v5-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_v5_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v5_onsale_product_carousel' ) ) {
    /**
     * Displays an onsale product carousel in home v5
     *
     * @return void
     */
    function electro_home_v5_onsale_product_carousel() {

        if ( is_woocommerce_activated() ) {

            $home_v5 = electro_get_home_v5_meta();

            $is_enabled = isset( $home_v5['dpc']['is_enabled'] ) ? $home_v5['dpc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $home_v5['dpc']['animation'] ) ? $home_v5['dpc']['animation'] : '';

            $section_args = apply_filters( 'electro_home_v5_onsale_product_section_args', array(
                'section_title'     => isset( $home_v5['dpc']['title'] ) ? $home_v5['dpc']['title'] : wp_kses_post( __( 'Limited <span>Week Deal</span>', 'electro' ) ),
                'sub_title'         => isset( $home_v5['dpc']['sub_title'] ) ? $home_v5['dpc']['sub_title'] : esc_html__( 'Hurry up before offer will end', 'electro' ),
                'limit'             => isset( $home_v5['dpc']['product_limit'] ) ? $home_v5['dpc']['product_limit'] : 4,
                'product_choice'    => isset( $home_v5['dpc']['product_choice'] ) ? $home_v5['dpc']['product_choice'] : 'random',
                'product_ids'       => isset( $home_v5['dpc']['product_ids'] ) ? $home_v5['dpc']['product_ids'] :'',
                'animation'         => $animation
            ) );

            $carousel_args  = apply_filters( 'electro_home_v5_onsale_product_carousel_args', array(
                'autoplay'          => isset( $home_v5['dpc']['carousel_args']['autoplay'] ) ? filter_var( $home_v5['dpc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                'items'             => 1,
                'nav'               => false,
                'slideSpeed'        => 300,
                'dots'              => true,
                'rtl'               => is_rtl() ? true : false,
                'paginationSpeed'   => 400,
                'navText'           => array( esc_html__( 'Previous Deal', 'electro' ), esc_html__( 'Next Deal', 'electro' ) ),
                'margin'            => 0,
                'touchDrag'         => true
            ) );

            electro_onsale_product_carousel_v5( $section_args, $carousel_args );
        }
    }
}

if ( ! function_exists( 'electro_home_v5_product_tabs_carousel' ) ) {
    /**
    *
    */
    function electro_home_v5_product_tabs_carousel() {
        if ( is_woocommerce_activated() ) {

            $home_v5 = electro_get_home_v5_meta();
            $ptc_options = $home_v5['ptc'];

            $is_enabled = isset( $home_v5['ptc']['is_enabled'] ) ? $home_v5['ptc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v5['ptc']['animation'] ) ? ' animated ' . $home_v5['ptc']['animation'] : '';

            $args = apply_filters( 'electro_home_v5_product_tabs_carousel_args', array(
                'section_title' => isset( $home_v5['ptc']['section_title'] ) ? $home_v5['ptc']['section_title'] : esc_html__( 'Save Big on Warehouse Cleaning', 'electro' ),
                'button_text'   => isset( $home_v5['ptc']['button_text'] ) ? $home_v5['ptc']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                'button_link'   => isset( $home_v5['ptc']['button_link'] ) ? $home_v5['ptc']['button_link'] : '#',
                'limit'         => isset( $home_v5['ptc']['product_limit'] ) ? $home_v5['ptc']['product_limit'] : 18,
                'columns'       => isset( $home_v5['ptc']['product_columns'] ) ? $home_v5['ptc']['product_columns'] : 6,
                'tabs'          => array(
                    array(
                        'id'            => 'tab-products-1',
                        'title'         => isset( $home_v5['ptc']['tabs'][0]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][0]['title'] : esc_html__( '-80% off', 'electro' ),
                        'shortcode_tag' => isset( $home_v5['ptc']['tabs'][0]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][0]['content']['shortcode'] : 'featured_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v5['ptc']['tabs'][0]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-2',
                        'title'         => isset( $home_v5['ptc']['tabs'][1]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][1]['title'] : esc_html__( '-65%', 'electro' ),
                        'shortcode_tag' => isset( $home_v5['ptc']['tabs'][1]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][1]['content']['shortcode'] : 'sale_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v5['ptc']['tabs'][1]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-3',
                        'title'         => isset( $home_v5['ptc']['tabs'][2]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][2]['title'] : esc_html__( '-45%', 'electro' ),
                        'shortcode_tag' => isset( $home_v5['ptc']['tabs'][2]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][2]['content']['shortcode'] : 'top_rated_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v5['ptc']['tabs'][2]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-4',
                        'title'         => isset( $home_v5['ptc']['tabs'][3]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][3]['title'] : esc_html__( '-25%', 'electro' ),
                        'shortcode_tag' => isset( $home_v5['ptc']['tabs'][3]['content']['shortcode'] ) ? $home_v5['ptc']['tabs'][3]['content']['shortcode'] : 'recent_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v5['ptc']['tabs'][3]['content'] )
                    )
                ),
                'carousel_args' => array(
                    'items'         => isset( $home_v5['ptc']['product_columns'] ) ? intval( $home_v5['ptc']['product_columns'] ) : 6,
                    'dots'          => isset( $home_v5['ptc']['carousel_args']['dots'] ) ? filter_var( $home_v5['ptc']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'           => isset( $home_v5['ptc']['carousel_args']['nav'] ) ? filter_var( $home_v5['ptc']['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'       => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                    'autoplay'      => isset( $home_v5['ptc']['carousel_args']['autoplay'] ) ? filter_var( $home_v5['ptc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'    => array(
                        '0'     => array( 'items'   => 2 ),
                        '576'   => array( 'items'   => 3 ),
                        '768'   => array( 'items'   => 4 ),
                        '992'   => array( 'items'   => 5 ),
                        '1200'  => array( 'items'   => isset( $home_v5['ptc']['product_columns'] ) ? intval( $home_v5['ptc']['product_columns'] ) : 6 )
                    )
                )
            ) );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $ptc_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $ptc_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $ptc_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            electro_products_carousel_tabs_v5( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v5_ads_block' ) ) {
    /**
     *
     */
    function electro_home_v5_ads_block() {

        $home_v5 = electro_get_home_v5_meta();

        $is_enabled = isset( $home_v5['ad']['is_enabled'] ) ? $home_v5['ad']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v5['ad']['animation'] ) ? ' animated ' . $home_v5['ad']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'v5' );

        $args = apply_filters( 'electro_home_v5_ads_args', array(
            array(
                'ad_text'       => isset( $home_v5['ad'][0]['ad_text'] ) ? $home_v5['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Hottest<br> <strong>Deals</strong> in Cameras<br> Category', 'electro' ) ),
                'action_text'   => isset( $home_v5['ad'][0]['action_text'] ) ? $home_v5['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v5['ad'][0]['action_link'] ) ? $home_v5['ad'][0]['action_link'] : '#',
                'ad_image'      => isset( $home_v5['ad'][0]['ad_image'] ) ? wp_get_attachment_url( $home_v5['ad'][0]['ad_image'] ) : '',
                'el_class'      => isset( $home_v5['ad'][0]['el_class'] ) ? $home_v5['ad'][0]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v5['ad'][0]['ad_image'] ) ? wp_get_attachment_image( $home_v5['ad'][0]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v5['ad'][1]['ad_text'] ) ? $home_v5['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets,<br> Smartphones <br><strong>and more</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v5['ad'][1]['action_text'] ) ? $home_v5['ad'][1]['action_text'] : wp_kses_post( __( '<span class="from"><span class="prefix">From</span><span class="value"><sup>$</sup>74</span><span class="suffix">99</span>', 'electro' ) ),
                'action_link'   => isset( $home_v5['ad'][1]['action_link'] ) ? $home_v5['ad'][1]['action_link'] : '#',
                'ad_image'      => isset( $home_v5['ad'][1]['ad_image'] ) ? wp_get_attachment_url( $home_v5['ad'][1]['ad_image'] ) : '',
                'el_class'      => isset( $home_v5['ad'][1]['el_class'] ) ? $home_v5['ad'][1]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v5['ad'][1]['ad_image'] ) ? wp_get_attachment_image( $home_v5['ad'][1]['ad_image'], $ad_image_attachment_size ) : '',
            ),
        ) );

        ob_start();

        electro_ads_block( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-v5-da-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v5_products_carousel' ) ) {
    /**
    *
    */
    function electro_home_v5_products_carousel() {
        if ( is_woocommerce_activated() ) {

            $home_v5 = electro_get_home_v5_meta();
            $pc_options     = $home_v5['pc'];

            $is_enabled = isset( $home_v5['pc']['is_enabled'] ) ? $home_v5['pc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v5['pc']['animation'] ) ? ' animated ' . $home_v5['pc']['animation'] : '';

            $args = apply_filters( 'electro_home_5_products_carousel_args', array(
                'limit'             => isset( $home_v5['pc']['product_limit'] ) ? intval( $home_v5['pc']['product_limit'] ) : 20,
                'columns'           => isset( $home_v5['pc']['product_columns'] ) ? intval( $home_v5['pc']['product_columns'] ) : 7,
                'section_args'   => array(
                    'section_title'     => isset( $home_v5['pc']['section_title'] ) ? $home_v5['pc']['section_title'] : esc_html__( 'Trending Products', 'electro' ),
                    'button_text'       => isset( $home_v5['pc']['button_text'] ) ? $home_v5['pc']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v5['pc']['button_link'] ) ? $home_v5['pc']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel trending-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 7,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                    'autoplay'          => isset( $pc_options['carousel_args']['autoplay'] ) ? filter_var( $pc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 4 ),
                        '992'   => array( 'items' => 5 ),
                        '1200'  => array( 'items' => 6 ),
                        '1430'  => array( 'items' => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 7 )
                    )
                ),
                'limit'     => isset( $home_v5['pc']['product_limit'] ) ? $home_v5['pc']['product_limit'] : 20,
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

if ( ! function_exists( 'electro_home_v5_product_carousel_v5_1' ) ) {
    /**
     * Displays a Products carousel in home v5
     */
    function electro_home_v5_product_carousel_v5_1() {

        if ( is_woocommerce_activated() ) {

            $home_v5        = electro_get_home_v5_meta();
            $pc1_options     = $home_v5['pc1'];

            $is_enabled = isset( $home_v5['pc1']['is_enabled'] ) ? $home_v5['pc1']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation      = isset( $home_v5['pc1']['animation'] ) ? $home_v5['pc1']['animation'] : '';

            $args = apply_filters( 'electro_home_v5_product_carousel_v5_1_args', array(
                'section_title'     => isset( $pc1_options['section_title'] ) ? $pc1_options['section_title'] : esc_html__( 'Popular Products', 'electro' ),
                'enable_categories' => isset( $pc1_options['enable_categories'] ) ? filter_var( $pc1_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $pc1_options['categories_title'] ) ? $pc1_options['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                'section_class'     => 'section-products-carousel ',
                'limit'             => 20,
                'columns'           => isset( $pc1_options['product_columns'] ) ? intval( $pc1_options['product_columns'] ) : 7,
                'category_args'     => array(
                    'orderby'           => isset( $pc1_options['category_args']['orderby'] ) ? $pc1_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $pc1_options['category_args']['order'] ) ? $pc1_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pc1_options['category_args']['hide_empty'] ) ? filter_var( $pc1_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pc1_options['category_args']['number'] ) ? $pc1_options['category_args']['number'] : 6,
                    'slugs'             => isset( $pc1_options['category_args']['slugs'] ) ? $pc1_options['category_args']['slugs'] : '',
                ),
                'section_args'  => array(
                    'section_title'    => '',
                    'animation'         => $animation

                ),
                'carousel_args' => array(
                    'items'             => isset( $pc1_options['product_columns'] ) ? intval( $pc1_options['product_columns'] ) : 7,
                    'dots'              => isset( $pc1_options['carousel_args']['dots'] ) ? filter_var( $pc1_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pc1_options['carousel_args']['nav'] ) ? filter_var( $pc1_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                    'autoplay'          => isset( $pc1_options['carousel_args']['autoplay'] ) ? filter_var( $pc1_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 4 ),
                        '992'   => array( 'items' => 5 ),
                        '1200'  => array( 'items' => 6 ),
                        '1430'  => array( 'items' => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 7 )
                    )
                )
            ) );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pc1_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pc1_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pc1_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $pc1_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pc1_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            $cat_args = electro_get_atts_for_taxonomy_slugs( $args['category_args'] );
            $categories = get_terms( 'product_cat',  $cat_args );
            $args['categories'] = $categories;


            electro_home_v5_product_carousel( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v5_ad_banner' ) ) {
    /**
     * Displays a banner in home v5
     */
    function electro_home_v5_ad_banner() {

        $home_v5 = electro_get_home_v5_meta();

        $is_enabled = isset( $home_v5['bd']['is_enabled'] ) ? $home_v5['bd']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = ! empty( $home_v5['bd']['animation'] ) ? $home_v5['bd']['animation'] : '';

        $args = apply_filters( 'electro_home_v5_ad_banner_args', array(
            'img_src'   => ( isset( $home_v5['bd']['image'] ) && $home_v5['bd']['image'] != 0 ) ? wp_get_attachment_url( $home_v5['bd']['image'] ) : 'http://placehold.it/1401x124',
            'el_class'  => '',
            'link'      => isset( $home_v5['bd']['link'] ) ? $home_v5['bd']['link'] : '#',
        ) );

        ob_start();

        electro_fullbanner_ad( $args );

        $banner_html = ob_get_clean();

        $section_class = 'home-v5-banner-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $banner_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v5_product_carousel_v5_2' ) ) {
    /**
     * Displays a Products carousel in home v5
     */
    function electro_home_v5_product_carousel_v5_2() {

        if ( is_woocommerce_activated() ) {

            $home_v5        = electro_get_home_v5_meta();
            $pc2_options     = $home_v5['pc2'];

            $is_enabled = isset( $home_v5['pc2']['is_enabled'] ) ? $home_v5['pc2']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation      = isset( $home_v5['pc2']['animation'] ) ? $home_v5['pc2']['animation'] : '';

            $args = apply_filters( 'electro_home_v5_product_carousel_v5_1_args', array(
                'section_title'     => isset( $pc2_options['section_title'] ) ? $pc2_options['section_title'] : esc_html__( 'Laptops & Computers', 'electro' ),
                'enable_categories' => isset( $pc2_options['enable_categories'] ) ? filter_var( $pc2_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $pc2_options['categories_title'] ) ? $pc2_options['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                'section_class'     => 'section-products-carousel ',
                'limit'             => 20,
                'columns'           => isset( $pc2_options['product_columns'] ) ? intval( $pc2_options['product_columns'] ) : 7,
                'category_args'     => array(
                    'orderby'           => isset( $pc2_options['category_args']['orderby'] ) ? $pc2_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $pc2_options['category_args']['order'] ) ? $pc2_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pc2_options['category_args']['hide_empty'] ) ? filter_var( $pc2_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pc2_options['category_args']['number'] ) ? $pc2_options['category_args']['number'] : 6,
                    'slugs'             => isset( $pc2_options['category_args']['slugs'] ) ? $pc2_options['category_args']['slugs'] : '',
                ),
                'section_args'  => array(
                    'section_title'    => '',
                    'animation'         => $animation

                ),
                'carousel_args' => array(
                    'items'             => isset( $pc2_options['product_columns'] ) ? intval( $pc2_options['product_columns'] ) : 7,
                    'dots'              => isset( $pc2_options['carousel_args']['dots'] ) ? filter_var( $pc2_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pc2_options['carousel_args']['nav'] ) ? filter_var( $pc2_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                    'autoplay'          => isset( $pc2_options['carousel_args']['autoplay'] ) ? filter_var( $pc2_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 4 ),
                        '992'   => array( 'items' => 5 ),
                        '1200'  => array( 'items' => 6 ),
                        '1430'  => array( 'items' => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 7 )
                    )
                )
            ) );

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

            $cat_args = electro_get_atts_for_taxonomy_slugs( $args['category_args'] );
            $categories = get_terms( 'product_cat',  $cat_args );
            $args['categories'] = $categories;

            electro_home_v5_product_carousel( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v5_product_cards_carousel' ) ) {
    /**
     *
     */
    function electro_home_v5_product_cards_carousel() {

        if ( is_woocommerce_activated() ) {

            $home_v5        = electro_get_home_v5_meta();

            $is_enabled = isset( $home_v5['pcc']['is_enabled'] ) ? $home_v5['pcc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation      = isset( $home_v5['pcc']['animation'] ) ? $home_v5['pcc']['animation'] : '';
            $limit          = isset( $home_v5['pcc']['product_limit'] ) ? intval( $home_v5['pcc']['product_limit'] ) : 20;
            $rows           = isset( $home_v5['pcc']['product_rows'] ) ? intval( $home_v5['pcc']['product_rows'] ) : 1;
            $columns        = isset( $home_v5['pcc']['product_columns'] ) ? intval( $home_v5['pcc']['product_columns'] ) : 4;
            $columns_wide   = isset( $home_v5['pcc']['product_columns_wide'] ) ? intval( $home_v5['pcc']['product_columns_wide'] ) : 4;

            $shortcode      = isset( $home_v5['pcc']['content']['shortcode'] ) ? $home_v5['pcc']['content']['shortcode'] : 'recent_products';
            $default_atts   = array( 'per_page' => intval( $limit ) );
            $atts           = electro_get_atts_for_shortcode( $home_v5['pcc']['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = Electro_Products::$shortcode( $atts );

            $args = apply_filters( 'electro_home_v5_product_cards_carousel_args', array(
                'section_args'  => array(
                    'section_title'     => isset( $home_v5['pcc']['section_title'] ) ? $home_v5['pcc']['section_title'] : esc_html__( 'Television Entertainment', 'electro' ),
                    'section_class'     => 'home-v5-product-cards-carousel',
                    'animation'         => $animation,
                    'products'          => $products,
                    'columns'           => $columns,
                    'rows'              => $rows,
                    'total'             => $limit,
                    'cat_slugs'         => isset( $home_v5['pcc']['cat_slugs'] ) ? $home_v5['pcc']['cat_slugs'] : '',
                    'cat_limit'         => isset( $home_v5['pcc']['cat_limit'] ) ? $home_v5['pcc']['cat_limit'] : 5,
                ),
                'carousel_args' => array(
                    'autoplay'          => isset( $home_v5['pcc']['carousel_args']['autoplay'] ) ? filter_var( $home_v5['pcc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $home_v5['carousel_args']['nav'] ) ? filter_var( $home_v5['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                )
            ) );

            if ( electro_is_wide_enabled() ) {
                $args['section_args']['columns_wide'] = $columns_wide;
                $args['section_args']['items'] = $columns_wide;
            }

            electro_product_cards_carousel( $args['section_args'], $args['carousel_args'] );
        }
    }
}

if ( ! function_exists( 'electro_home_v5_categories_block' ) ) {
    /**
     *
     */
    function electro_home_v5_categories_block() {

        if ( is_woocommerce_activated() ) {
            $home_v5    = electro_get_home_v5_meta();

            $is_enabled = isset( $home_v5['hcb']['is_enabled'] ) ? $home_v5['hcb']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_v5['hcb']['animation'] ) ? $home_v5['hcb']['animation'] : '';
            $cat_args   = isset( $home_v5['hcb']['cat_args'] ) ? $home_v5['hcb']['cat_args'] : array( 'number' => 6 );

            if ( ! empty( $home_v5['hcb']['cat_slugs'] ) ) {
                $cat_slugs = explode( ',', $home_v5['hcb']['cat_slugs'] );
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

            $args = apply_filters( 'electro_home_v5_categories_block_args', array(
                'section_title'         => isset( $home_v5['hcb']['section_title'] ) ? $home_v5['hcb']['section_title'] : '',
                'animation'             => $animation,
                'enable_full_width'     => isset( $home_v5['hcb']['enable_full_width'] ) ? filter_var( $home_v5['hcb']['enable_full_width'], FILTER_VALIDATE_BOOLEAN ) : false,
                'section_class'         => '',
                'columns'               => isset( $home_v5['hcb']['columns'] ) ? $home_v5['hcb']['columns'] : '3',
                'category_args'         => $cat_args,
            ) );

            electro_home_categories_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v5_ads_with_banners' ) ) {
    /**
     * Display Banners
     */
    function electro_home_v5_ads_with_banners() {

        $home_v5    = electro_get_home_v5_meta();
        $awb_options     = $home_v5['awb'];
        $is_enabled = isset( $awb_options['is_enabled'] ) ? filter_var( $awb_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $awb_options['animation'] ) ? $awb_options['animation'] : '';

        $args = array(
            'section_class'     => '',
            'animation'         => $animation,
            'ads_banners'       => array(
                array(
                    'title'                 => isset( $awb_options['ads_banners'][0]['title'] ) ? $awb_options['ads_banners'][0]['title'] : '',
                    'description'           => isset( $awb_options['ads_banners'][0]['description'] ) ? $awb_options['ads_banners'][0]['description'] : '',
                    'price'                 => isset( $awb_options['ads_banners'][0]['price'] ) ? $awb_options['ads_banners'][0]['price'] : '',
                    'action_link'           => isset( $awb_options['ads_banners'][0]['action_link'] ) ? $awb_options['ads_banners'][0]['action_link'] : '#',
                    'banner_action_link'    => isset( $awb_options['ads_banners'][0]['banner_action_link'] ) ? $awb_options['ads_banners'][0]['banner_action_link'] : '#',
                    'image'                 => isset( $awb_options['ads_banners'][0]['image'] ) && intval( $awb_options['ads_banners'][0]['image'] ) ? wp_get_attachment_image_src( $awb_options['ads_banners'][0]['image'], array( '380', '260' ) ) : array( '//placehold.it/380x260', '380', '260' ),
                    'banner_image'          => isset( $awb_options['ads_banners'][0]['banner_image'] ) && intval( $awb_options['ads_banners'][0]['banner_image'] ) ? wp_get_attachment_image_src( $awb_options['ads_banners'][0]['banner_image'], array( '380', '260' ) ) : array( '//placehold.it/380x260', '380', '260' ),
                    'is_align_end'          => isset( $awb_options['ads_banners'][0]['is_align_end'] ) ? filter_var( $awb_options['ads_banners'][0]['is_align_end'], FILTER_VALIDATE_BOOLEAN ) : false,
                ),
                array(
                    'title'                 => isset( $awb_options['ads_banners'][1]['title'] ) ? $awb_options['ads_banners'][1]['title'] : '',
                    'description'           => isset( $awb_options['ads_banners'][1]['description'] ) ? $awb_options['ads_banners'][1]['description'] : '',
                    'price'                 => isset( $awb_options['ads_banners'][1]['price'] ) ? $awb_options['ads_banners'][1]['price'] : '',
                    'action_link'           => isset( $awb_options['ads_banners'][1]['action_link'] ) ? $awb_options['ads_banners'][1]['action_link'] : '#',
                    'banner_action_link'    => isset( $awb_options['ads_banners'][1]['banner_action_link'] ) ? $awb_options['ads_banners'][1]['banner_action_link'] : '#',
                    'image'                 => isset( $awb_options['ads_banners'][1]['image'] ) && intval( $awb_options['ads_banners'][1]['image'] ) ? wp_get_attachment_image_src( $awb_options['ads_banners'][1]['image'], array( '380', '260' ) ) : array( '//placehold.it/380x260', '380', '260' ),
                    'banner_image'          => isset( $awb_options['ads_banners'][1]['banner_image'] ) && intval( $awb_options['ads_banners'][1]['banner_image'] ) ? wp_get_attachment_image_src( $awb_options['ads_banners'][1]['banner_image'], array( '380', '260' ) ) : array( '//placehold.it/380x260', '380', '260' ),
                    'is_align_end'          => isset( $awb_options['ads_banners'][1]['is_align_end'] ) ? filter_var( $awb_options['ads_banners'][1]['is_align_end'], FILTER_VALIDATE_BOOLEAN ) : false,
                )
            )
        );

        $args = apply_filters( 'electro_home_v5_ads_with_banners_args', $args );
        electro_ads_with_banners( $args );
    }
}
