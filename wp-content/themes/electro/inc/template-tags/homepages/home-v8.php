<?php
/**
 * Template functions hooked into the `homepage_v8` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v8_slider' ) ) {
    /**
     *
     */
    function electro_home_v8_slider() {
        $home_v8    = electro_get_home_v8_meta();
        $sdr        = $home_v8['sdr'];

        $is_enabled = isset( $sdr['is_enabled'] ) ? $sdr['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $sdr['animation'] ) ? $sdr['animation'] : '';
        $shortcode = !empty( $sdr['shortcode'] ) ? $sdr['shortcode'] : '[rev_slider alias="home-v8-slider"]';

        $section_class = 'home-v8-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_v8_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v8_category_icons_carousel' ) ) {
    /**
     *
     */
    function electro_home_v8_category_icons_carousel() {

        if ( is_woocommerce_activated() ) {
            $home_v8    = electro_get_home_v8_meta();

            $is_enabled = isset( $home_v8['cic']['is_enabled'] ) ? $home_v8['cic']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_v8['cic']['animation'] ) ? $home_v8['cic']['animation'] : '';
            $cat_args   = isset( $home_v8['cic']['cat_args'] ) ? $home_v8['cic']['cat_args'] : array( 'number' => 20 );

            if ( ! empty( $home_v8['cic']['cat_slugs'] ) ) {
                $cat_slugs = explode( ',', $home_v8['cic']['cat_slugs'] );
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

            $section_class = ' category-icons-carousel-v2';

            $args = apply_filters( 'electro_home_v8_category_icons_carousel_args', array(
                'animation'             => $animation,
                'section_class'         => $section_class,
                'category_args'         => $cat_args,
            ) );

            $carousel_args  = apply_filters( 'electro_home_category_icons_carousel_value_args', array(
                'items'             => isset( $home_v8['cic']['carousel_args']['items'] ) ? $home_v8['cic']['carousel_args']['items']  : 10,
                'dots'              => isset( $home_v8['cic']['carousel_args']['dots'] ) ? filter_var( $home_v8['cic']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                'nav'               => isset( $home_v8['cic']['carousel_args']['nav'] ) ? filter_var( $home_v8['cic']['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                'rtl'               => is_rtl() ? true : false,
                'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'autoplay'          => isset( $home_v8['cic']['carousel_args']['autoplay'] ) ? filter_var( $home_v8['cic']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                'responsive'        => array(
                    '0'     => array( 'items' => 2 ),
                    '576'   => array( 'items' => 3 ),
                    '768'   => array( 'items' => 3 ),
                    '992'   => array( 'items' => 4 ),
                    '1200'  => array( 'items' => 7 ),
                    '1430'  => array( 'items' => 10 ),
                    '1430'  => array( 'items' => isset( $home_v8['cic']['carousel_args']['items'] ) ? intval( $home_v8['cic']['carousel_args']['items'] ) : 10 )
                )
            ) );

            electro_home_category_icon_carousel( $args, $carousel_args );
        }
    }
}

if ( ! function_exists( 'electro_home_v8_ads_block' ) ) {
    /**
     * Displays Ads Block in Home v8
     */
    function electro_home_v8_ads_block() {

        $home_v8 = electro_get_home_v8_meta();

        $is_enabled = isset( $home_v8['ad']['is_enabled'] ) ? $home_v8['ad']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $home_v8['ad']['animation'] ) ? $home_v8['ad']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'v8' );

        $args = apply_filters( 'home_v8_ads_args', array(
            array(
                'ad_text'       => isset( $home_v8['ad'][0]['ad_text'] ) ? $home_v8['ad'][0]['ad_text'] : wp_kses_post( __( '<strong>#STAYHOME</strong> AND CATCH BIG <strong>DEALS</strong> ON THE GAMES &amp; CONSOLES', 'electro' ) ),
                'action_text'   => isset( $home_v8['ad'][0]['action_text'] ) ? $home_v8['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v8['ad'][0]['action_link'] ) ? $home_v8['ad'][0]['action_link'] : '#',
                'ad_image'      => isset( $home_v8['ad'][0]['ad_image'] ) ? wp_get_attachment_url( $home_v8['ad'][0]['ad_image'] ) : 'http://placehold.it/350x300',
                'el_class'      => isset( $home_v8['ad'][0]['el_class'] ) ? $home_v8['ad'][0]['el_class'] : '',
                'ad_image_attachment'  => isset( $home_v8['ad'][0]['ad_image'] ) ? wp_get_attachment_image( $home_v8['ad'][0]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v8['ad'][1]['ad_text'] ) ? $home_v8['ad'][1]['ad_text'] : wp_kses_post( __( 'SHOP THE <strong>HOTTEST</strong> PRODUCTS', 'electro' ) ),
                'action_text'   => isset( $home_v8['ad'][1]['action_text'] ) ? $home_v8['ad'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v8['ad'][1]['action_link'] ) ? $home_v8['ad'][1]['action_link'] : '#',
                'ad_image'      => isset( $home_v8['ad'][1]['ad_image'] ) ? wp_get_attachment_url( $home_v8['ad'][1]['ad_image'] ) : 'http://placehold.it/190x150',
                'el_class'      => isset( $home_v8['ad'][1]['el_class'] ) ? $home_v8['ad'][1]['el_class'] : '',
                'ad_image_attachment'  => isset( $home_v8['ad'][1]['ad_image'] ) ? wp_get_attachment_image( $home_v8['ad'][1]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v8['ad'][2]['ad_text'] ) ? $home_v8['ad'][2]['ad_text'] : wp_kses_post( __( 'TABLETS, SMARTPHONES <strong>AND MORE</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v8['ad'][2]['action_text'] ) ? $home_v8['ad'][2]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v8['ad'][2]['action_link'] ) ? $home_v8['ad'][2]['action_link'] : '#',
                'ad_image'      => isset( $home_v8['ad'][2]['ad_image'] ) ? wp_get_attachment_url( $home_v8['ad'][2]['ad_image'] ) : 'http://placehold.it/190x150',
                'el_class'      => isset( $home_v8['ad'][2]['el_class'] ) ? $home_v8['ad'][2]['el_class'] : '',
                'ad_image_attachment'  => isset( $home_v8['ad'][2]['ad_image'] ) ? wp_get_attachment_image( $home_v8['ad'][2]['ad_image'], $ad_image_attachment_size ) : '',
            ),
        ) );

        ob_start();

        electro_ads_block( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-da-block home-v8-da-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v8_products_carousel_1' ) ) {
    /**
     *
     */
    function electro_home_v8_products_carousel_1() {
        if ( is_woocommerce_activated() ) {

            $home_v8 = electro_get_home_v8_meta();
            $pc_options     = $home_v8['pc1'];

            $is_enabled = isset( $home_v8['pc1']['is_enabled'] ) ? $home_v8['pc1']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v8['pc1']['animation'] ) ? ' animated ' . $home_v8['pc1']['animation'] : '';

            $args = apply_filters( 'electro_home_v8_products_carousel_1_args', array(
                'limit'             => isset( $home_v8['pc1']['product_limit'] ) ? intval( $home_v8['pc1']['product_limit'] ) : 20,
                'columns'           => isset( $home_v8['pc1']['product_columns'] ) ? intval( $home_v8['pc1']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v8['pc1']['section_title'] ) ? $home_v8['pc1']['section_title'] : esc_html__( 'Deals of The Day', 'electro' ),
                    'button_text'       => isset( $home_v8['pc1']['button_text'] ) ? $home_v8['pc1']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v8['pc1']['button_link'] ) ? $home_v8['pc1']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
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
                'limit'     => isset( $home_v8['pc1']['product_limit'] ) ? $home_v8['pc1']['product_limit'] : 20,
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

if ( ! function_exists( 'electro_home_v8_product_category_tags' ) ) {
    /**
     *
     */
    function electro_home_v8_product_category_tags() {

        if ( is_woocommerce_activated() ) {
            $home_v8    = electro_get_home_v8_meta();

            $is_enabled = isset( $home_v8['pct']['is_enabled'] ) ? $home_v8['pct']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_v8['pct']['animation'] ) ? $home_v8['pct']['animation'] : '';
            $cat_args   = isset( $home_v8['pct']['cat_args'] ) ? $home_v8['pct']['cat_args'] : array( 'number' => 10 );

            if ( ! empty( $home_v8['pct']['cat_slugs'] ) ) {
                $cat_slugs = explode( ',', $home_v8['pct']['cat_slugs'] );
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

            $args = apply_filters( 'electro_home_v8_product_category_tags_args', array(
                'animation'             => $animation,
                'section_class'         => '',
                'section_title'         => esc_html__( 'Popular Search', 'electro' ),
                'category_args'         => $cat_args,
            ) );

            electro_home_product_category_tags( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v8_products_carousel_2' ) ) {
    /**
     *
     */
    function electro_home_v8_products_carousel_2() {
        if ( is_woocommerce_activated() ) {

            $home_v8 = electro_get_home_v8_meta();
            $pc_options     = $home_v8['pc2'];

            $is_enabled = isset( $home_v8['pc2']['is_enabled'] ) ? $home_v8['pc2']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v8['pc2']['animation'] ) ? ' animated ' . $home_v8['pc2']['animation'] : '';

            $args = apply_filters( 'electro_home_v8_products_carousel_2_args', array(
                'limit'             => isset( $home_v8['pc2']['product_limit'] ) ? intval( $home_v8['pc2']['product_limit'] ) : 20,
                'columns'           => isset( $home_v8['pc2']['product_columns'] ) ? intval( $home_v8['pc2']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v8['pc2']['section_title'] ) ? $home_v8['pc2']['section_title'] : esc_html__( 'Laptops & Computers', 'electro' ),
                    'button_text'       => isset( $home_v8['pc2']['button_text'] ) ? $home_v8['pc2']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v8['pc2']['button_link'] ) ? $home_v8['pc2']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
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
                'limit'     => isset( $home_v8['pc2']['product_limit'] ) ? $home_v8['pc2']['product_limit'] : 20,
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

if ( ! function_exists( 'electro_home_v8_products_carousel_3' ) ) {
    /**
     *
     */
    function electro_home_v8_products_carousel_3() {
        if ( is_woocommerce_activated() ) {

            $home_v8 = electro_get_home_v8_meta();
            $pc_options     = $home_v8['pc3'];

            $is_enabled = isset( $home_v8['pc3']['is_enabled'] ) ? $home_v8['pc3']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v8['pc3']['animation'] ) ? ' animated ' . $home_v8['pc3']['animation'] : '';

            $args = apply_filters( 'electro_home_v8_products_carousel_3_args', array(
                'limit'             => isset( $home_v8['pc3']['product_limit'] ) ? intval( $home_v8['pc3']['product_limit'] ) : 20,
                'columns'           => isset( $home_v8['pc3']['product_columns'] ) ? intval( $home_v8['pc3']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v8['pc3']['section_title'] ) ? $home_v8['pc3']['section_title'] : esc_html__( 'Headphones', 'electro' ),
                    'button_text'       => isset( $home_v8['pc3']['button_text'] ) ? $home_v8['pc3']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v8['pc3']['button_link'] ) ? $home_v8['pc3']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
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
                'limit'     => isset( $home_v8['pc3']['product_limit'] ) ? $home_v8['pc3']['product_limit'] : 20,
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

if ( ! function_exists( 'electro_home_v8_products_carousel_4' ) ) {
    /**
     *
     */
    function electro_home_v8_products_carousel_4() {
        if ( is_woocommerce_activated() ) {

            $home_v8 = electro_get_home_v8_meta();
            $pc_options     = $home_v8['pc4'];

            $is_enabled = isset( $home_v8['pc4']['is_enabled'] ) ? $home_v8['pc4']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v8['pc4']['animation'] ) ? ' animated ' . $home_v8['pc4']['animation'] : '';

            $args = apply_filters( 'electro_home_v8_products_carousel_4_args', array(
                'limit'             => isset( $home_v8['pc4']['product_limit'] ) ? intval( $home_v8['pc4']['product_limit'] ) : 20,
                'columns'           => isset( $home_v8['pc4']['product_columns'] ) ? intval( $home_v8['pc4']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v8['pc4']['section_title'] ) ? $home_v8['pc4']['section_title'] : esc_html__( 'TV Entertainment', 'electro' ),
                    'button_text'       => isset( $home_v8['pc4']['button_text'] ) ? $home_v8['pc4']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v8['pc4']['button_link'] ) ? $home_v8['pc4']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
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
                'limit'     => isset( $home_v8['pc4']['product_limit'] ) ? $home_v8['pc4']['product_limit'] : 20,
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

if ( ! function_exists( 'electro_home_v8_products_carousel_5' ) ) {
    /**
     *
     */
    function electro_home_v8_products_carousel_5() {
        if ( is_woocommerce_activated() ) {

            $home_v8 = electro_get_home_v8_meta();
            $pc_options     = $home_v8['pc5'];

            $is_enabled = isset( $home_v8['pc5']['is_enabled'] ) ? $home_v8['pc5']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v8['pc5']['animation'] ) ? ' animated ' . $home_v8['pc5']['animation'] : '';

            $args = apply_filters( 'electro_home_v8_products_carousel_5_args', array(
                'limit'             => isset( $home_v8['pc5']['product_limit'] ) ? intval( $home_v8['pc5']['product_limit'] ) : 20,
                'columns'           => isset( $home_v8['pc5']['product_columns'] ) ? intval( $home_v8['pc5']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v8['pc5']['section_title'] ) ? $home_v8['pc5']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                    'button_text'       => isset( $home_v8['pc5']['button_text'] ) ? $home_v8['pc5']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v8['pc5']['button_link'] ) ? $home_v8['pc5']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
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
                'limit'     => isset( $home_v8['pc5']['product_limit'] ) ? $home_v8['pc5']['product_limit'] : 20,
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

if ( ! function_exists( 'electro_home_v8_two_banners' ) ) {
    /**
     *
     */
    function electro_home_v8_two_banners() {

        $home_v8 = electro_get_home_v8_meta();

        $is_enabled = isset( $home_v8['tbrs']['is_enabled'] ) ? $home_v8['tbrs']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v8['tbrs']['animation'] ) ? ' animated ' . $home_v8['tbrs']['animation'] : '';

        $args = apply_filters( 'electro_home_v8_two_banners_args', array(
            array(
                'image'         => isset( $home_v8['tbrs'][0]['image'] ) && $home_v8['tbrs'][0]['image'] ? wp_get_attachment_url( $home_v8['tbrs'][0]['image'] ) : 'http://placehold.it/690x151',
                'action_link'   => isset( $home_v8['tbrs'][0]['action_link'] ) ? $home_v8['tbrs'][0]['action_link'] : '#',
                'el_class'      => isset( $home_v8['tbrs'][0]['el_class'] ) ? $home_v8['tbrs'][0]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v8['tbrs'][1]['image'] ) && $home_v8['tbrs'][1]['image'] ? wp_get_attachment_url( $home_v8['tbrs'][1]['image'] ) : 'http://placehold.it/690x151',
                'action_link'   => isset( $home_v8['tbrs'][1]['action_link'] ) ? $home_v8['tbrs'][1]['action_link'] : '#',
                'el_class'      => isset( $home_v8['tbrs'][1]['el_class'] ) ? $home_v8['tbrs'][1]['el_class'] : '',
            ),
        ) );

        ob_start();

        electro_two_banners( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-v8-da-block home-two-banners';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v8_products_categories_1_6' ) ) {
    /**
     *
     */
    function electro_home_v8_products_categories_1_6() {

        if ( is_woocommerce_activated() ) {
            $home_v8    = electro_get_home_v8_meta();

            $is_enabled = isset( $home_v8['pcos']['is_enabled'] ) ? $home_v8['pcos']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_v8['pcos']['animation'] ) ? $home_v8['pcos']['animation'] : '';

            $cat_args   = array(
                'number'        => 7,
                'orderby'       => isset( $home_v8['pcos']['cat_args']['orderby'] ) ? $home_v8['pcos']['cat_args']['orderby'] : 'name',
                'order'         => isset( $home_v8['pcos']['cat_args']['order'] ) ? $home_v8['pcos']['cat_args']['order'] : 'ASC',
                'hide_empty'    => isset( $home_v8['pcos']['cat_args']['hide_empty'] ) ? filter_var( $home_v8['pcos']['cat_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                'hierarchical'  => false,
            );

            if ( ! empty( $home_v8['pcos']['cat_slugs'] ) ) {
                $cat_slugs = explode( ',', $home_v8['pcos']['cat_slugs'] );
                $cat_slugs = array_map( 'trim', $cat_slugs );
                $cat_args['slug']               = $cat_slugs;

                $include = array();

                foreach ( $cat_slugs as $slug ) {
                    $include[] = "'" . $slug ."'";
                }

                if ( ! empty($include ) ) {
                    $cat_args['include']    = $include;
                    $cat_args['orderby']    = 'include';
                }
            }

            $args = apply_filters( 'electro_home_v8_products_categories_1_6_args', array(
                'animation'             => $animation,
                'section_class'         => '',
                'category_args'         => $cat_args,
            ) );

            electro_home_products_categories_1_6( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v8_products_carousel_6' ) ) {
    /**
     *
     */
    function electro_home_v8_products_carousel_6() {
        if ( is_woocommerce_activated() ) {

            $home_v8 = electro_get_home_v8_meta();
            $pc_options     = $home_v8['pc6'];

            $is_enabled = isset( $home_v8['pc6']['is_enabled'] ) ? $home_v8['pc6']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v8['pc6']['animation'] ) ? ' animated ' . $home_v8['pc6']['animation'] : '';

            $args = apply_filters( 'electro_home_v8_products_carousel_6_args', array(
                'limit'             => isset( $home_v8['pc6']['product_limit'] ) ? intval( $home_v8['pc6']['product_limit'] ) : 20,
                'columns'           => isset( $home_v8['pc6']['product_columns'] ) ? intval( $home_v8['pc6']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v8['pc6']['section_title'] ) ? $home_v8['pc6']['section_title'] : esc_html__( 'Cameras', 'electro' ),
                    'button_text'       => isset( $home_v8['pc6']['button_text'] ) ? $home_v8['pc6']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v8['pc6']['button_link'] ) ? $home_v8['pc6']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pc_options['product_columns'] ) ? intval( $pc_options['product_columns'] ) : 6,
                    'dots'              => isset( $pc_options['carousel_args']['dots'] ) ? filter_var( $pc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pc_options['carousel_args']['nav'] ) ? filter_var( $pc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
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
                'limit'     => isset( $home_v8['pc6']['product_limit'] ) ? $home_v8['pc6']['product_limit'] : 20,
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
