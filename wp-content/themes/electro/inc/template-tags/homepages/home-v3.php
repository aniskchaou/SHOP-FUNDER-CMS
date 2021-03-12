<?php
/**
 * Template Tags used in Home v3
 */
if ( ! function_exists( 'electro_home_v3_slider' ) ) {
    /**
     * Displays Slider in Home v3
     */
    function electro_home_v3_slider() {

        $home_v3    = electro_get_home_v3_meta();
        $sdr        = $home_v3['sdr'];

        $is_enabled = isset( $sdr['is_enabled'] ) ? $sdr['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $sdr['animation'] ) ? $sdr['animation'] : '';
        $shortcode = !empty( $sdr['shortcode'] ) ? $sdr['shortcode'] : '[rev_slider alias="home-v3-slider"]';

        $section_class = 'home-v3-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_v3_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v3_ads_block' ) ) {
    /**
     * Displays Ads Block in Home v3
     */
    function electro_home_v3_ads_block() {

        $home_v3 = electro_get_home_v3_meta();

        $is_enabled = isset( $home_v3['ad']['is_enabled'] ) ? $home_v3['ad']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v3['ad']['animation'] ) ? ' animated ' . $home_v3['ad']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'v3' );

        $args = apply_filters( 'home_v3_ads_args', array(
            array(
                'ad_text'       => isset( $home_v3['ad'][0]['ad_text'] ) ? $home_v3['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <strong>Deals</strong> on the Cameras', 'electro' ) ),
                'action_text'   => isset( $home_v3['ad'][0]['action_text'] ) ? $home_v3['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v3['ad'][0]['action_link'] ) ? $home_v3['ad'][0]['action_link'] : '#',
                'ad_image'      => isset( $home_v3['ad'][0]['ad_image'] ) ? wp_get_attachment_url( $home_v3['ad'][0]['ad_image'] ) : '',
                'el_class'      => isset( $home_v3['ad'][0]['el_class'] ) ? $home_v3['ad'][0]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v3['ad'][0]['ad_image'] ) ? wp_get_attachment_image( $home_v3['ad'][0]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_v3['ad'][1]['ad_text'] ) ? $home_v3['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v3['ad'][1]['action_text'] ) ? $home_v3['ad'][1]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                'action_link'   => isset( $home_v3['ad'][1]['action_link'] ) ? $home_v3['ad'][1]['action_link'] : '#',
                'ad_image'      => isset( $home_v3['ad'][1]['ad_image'] ) ? wp_get_attachment_url( $home_v3['ad'][1]['ad_image'] ) : '',
                'el_class'      => isset( $home_v3['ad'][1]['el_class'] ) ? $home_v3['ad'][1]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v3['ad'][1]['ad_image'] ) ? wp_get_attachment_image( $home_v3['ad'][1]['ad_image'], $ad_image_attachment_size ) : '',
            ),
        ) );

        if ( electro_is_wide_enabled() ) {
            $args[] = array(
                'ad_text'       => isset( $home_v3['ad'][2]['ad_text'] ) ? $home_v3['ad'][2]['ad_text'] : wp_kses_post( __( 'Shop the,<br><strong>Hottest</strong><br>Products', 'electro' ) ),
                'action_text'   => isset( $home_v3['ad'][2]['action_text'] ) ? $home_v3['ad'][2]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_v3['ad'][2]['action_link'] ) ? $home_v3['ad'][2]['action_link'] : '#',
                'ad_image'      => isset( $home_v3['ad'][2]['ad_image'] ) ? wp_get_attachment_url( $home_v3['ad'][2]['ad_image'] ) : 'https://placehold.it/270x186',
                'el_class'      => isset( $home_v3['ad'][2]['el_class'] ) ? $home_v3['ad'][2]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v3['ad'][2]['ad_image'] ) ? wp_get_attachment_image( $home_v3['ad'][2]['ad_image'], $ad_image_attachment_size ) : '',
            );

            $args[] = array(
                'ad_text'       => isset( $home_v3['ad'][3]['ad_text'] ) ? $home_v3['ad'][3]['ad_text'] : wp_kses_post( __( 'The New,<br>Standard<br><strong>360 Cameras</strong>', 'electro' ) ),
                'action_text'   => isset( $home_v3['ad'][3]['action_text'] ) ? $home_v3['ad'][3]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                'action_link'   => isset( $home_v3['ad'][3]['action_link'] ) ? $home_v3['ad'][3]['action_link'] : '#',
                'ad_image'      => isset( $home_v3['ad'][3]['ad_image'] ) ? wp_get_attachment_url( $home_v3['ad'][3]['ad_image'] ) : 'https://placehold.it/270x186',
                'el_class'      => isset( $home_v3['ad'][3]['el_class'] ) ? $home_v3['ad'][3]['el_class'] : '',
                'ad_image_attachment' => isset( $home_v3['ad'][3]['ad_image'] ) ? wp_get_attachment_image( $home_v3['ad'][3]['ad_image'], $ad_image_attachment_size ) : '',
            );
        }

        ob_start();

        electro_ads_block( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-v3-da-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v3_products_carousel_tabs' ) ) {
    /**
     * Displays Home v3 Products Carousel Tabs
     */
    function electro_home_v3_products_carousel_tabs() {

        if ( is_woocommerce_activated() ) {

            $home_v3 = electro_get_home_v3_meta();

            $is_enabled = isset( $home_v3['pct']['is_enabled'] ) ? $home_v3['pct']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $home_v3['pct']['animation'] ) ? $home_v3['pct']['animation'] : '';

            $args = apply_filters( 'electro_home_v3_products_carousel_tabs_args', array(
                'animation' => $animation,
                'tabs'          => array(
                    array(
                        'id'            => 'tab-products-1',
                        'title'         => isset( $home_v3['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v3['pct']['tabs'][0]['title'] : esc_html__( 'Featured', 'electro' ),
                        'shortcode_tag' => isset( $home_v3['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v3['pct']['tabs'][0]['content']['shortcode'] : 'featured_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v3['pct']['tabs'][0]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-2',
                        'title'         => isset( $home_v3['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v3['pct']['tabs'][1]['title'] : esc_html__( 'On Sale', 'electro' ),
                        'shortcode_tag' => isset( $home_v3['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v3['pct']['tabs'][1]['content']['shortcode'] : 'sale_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v3['pct']['tabs'][1]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-3',
                        'title'         => isset( $home_v3['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v3['pct']['tabs'][2]['title'] : esc_html__( 'Top Rated', 'electro' ),
                        'shortcode_tag' => isset( $home_v3['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v3['pct']['tabs'][2]['content']['shortcode'] : 'top_rated_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v3['pct']['tabs'][2]['content'] )
                    )
                ),
                'limit'         => isset( $home_v3['pct']['product_limit'] ) ? $home_v3['pct']['product_limit'] : 8,
                'columns'       => isset( $home_v3['pct']['product_columns'] ) ? $home_v3['pct']['product_columns'] : 4,
                'columns_wide'  => isset( $home_v3['pct']['product_columns_wide'] ) ? $home_v3['pct']['product_columns_wide'] : 6,
                'carousel_args' => array(
                    'items'         => isset( $home_v3['pct']['product_columns'] ) ? intval( $home_v3['pct']['product_columns'] ) : 4,
                    'autoplay'      => isset( $home_v3['pct']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['pct']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'    => array(
                        '0'     => array( 'items'   => 2 ),
                        '480'   => array( 'items'   => 3 ),
                        '768'   => array( 'items'   => 3 ),
                        '992'   => array( 'items'   => 4 ),
                        '1200'  => array( 'items'   => isset( $home_v3['pct']['product_columns'] ) ? intval( $home_v3['pct']['product_columns'] ) : 4 )
                    )
                )
            ) );

            if ( electro_is_wide_enabled() ){
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
                $args['carousel_args']['responsive']['768'] = array( 'items' => 4 );
                $args['carousel_args']['responsive']['992'] = array( 'items' => 4 );
            }

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $home_v3['pct']['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $home_v3['pct']['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $home_v3['pct']['product_columns'];
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

if ( ! function_exists( 'electro_products_carousel_with_image' ) ) {
    /**
     * Displays Products Carousel with Image
     */
    function electro_products_carousel_with_image() {

        if ( is_woocommerce_activated() ) {
            $home_v3    = electro_get_home_v3_meta();

            $is_enabled = isset( $home_v3['pci']['is_enabled'] ) ? $home_v3['pci']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_v3['pci']['animation'] ) ? $home_v3['pci']['animation'] : '';
            $bg_img     = isset( $home_v3['pci']['image']['bg_img'] ) ? wp_get_attachment_url( $home_v3['pci']['image']['bg_img'] ) : '';
            $ad_img     = isset( $home_v3['pci']['image']['ad_img'] ) ? wp_get_attachment_url( $home_v3['pci']['image']['ad_img'] ) : '';

            $section_class = 'products-carousel-with-image';

            if ( ! empty( $animation ) ) {
                $section_class .= ' animate-in-view';
            }

            ?>
            <section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $bg_img ) ) : ?>style="background-size: cover; background-position: center center; background-image: url( <?php echo esc_url( $bg_img ); ?> );"<?php endif; ?> <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
                <h2 class="sr-only"><?php echo esc_html__( 'Products Carousel', 'electro' ); ?></h2>
                <div class="container">
                    <div class="products-carousel-with-image-inner">
                        <div class="image-block">
                            <?php
                                if ( ! empty( $ad_img ) ) {
                                    ?><img src="<?php echo esc_url( $ad_img ); ?>" class="img-responsive" alt="" /><?php
                                }
                            ?>
                        </div>
                        <div class="products-carousel-block">
                            <?php
                                if ( electro_is_wide_enabled() ) {
                                    $limit          = isset( $home_v3['pci']['product_limit'] ) ? intval( $home_v3['pci']['product_limit'] ) : 16;
                                    $rows           = isset( $home_v3['pci']['product_rows'] ) ? intval( $home_v3['pci']['product_rows'] ) : 2;
                                    $columns        = isset( $home_v3['pci']['product_columns'] ) ? intval( $home_v3['pci']['product_columns'] ) : 2;
                                    $columns_wide   = isset( $home_v3['pci']['product_columns_wide'] ) ? intval( $home_v3['pci']['product_columns_wide'] ) : 2;

                                    $shortcode      = isset( $home_v3['pci']['content']['shortcode'] ) ? $home_v3['pci']['content']['shortcode'] : 'sale_products';

                                    $content        = isset( $home_v3['pci']['content'] ) ? $home_v3['pci']['content'] : array();

                                    $default_atts   = array( 'per_page' => intval( $limit ) );
                                    $atts           = electro_get_atts_for_shortcode( $content );
                                    $atts           = wp_parse_args( $atts, $default_atts );
                                    $products       = Electro_Products::$shortcode( $atts );

                                    $args = apply_filters( 'electro_home_v3_product_cards_carousel_args', array(
                                        'section_args'  => array(
                                            'section_title'     => isset( $home_v3['pci']['section_title'] ) ? $home_v3['pci']['section_title'] : esc_html__( 'Television Entertainment', 'electro' ),
                                            'products'          => $products,
                                            'columns'           => $columns,
                                            'columns_wide'      => $columns_wide,
                                            'rows'              => $rows,
                                            'total'             => $limit,
                                            'show_nav'          => false,
                                            'show_carousel_nav' => true,
                                            'animation'         => $animation,
                                        ),
                                        'carousel_args' => array(
                                            'autoplay'          => isset( $home_v3['pci']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['pci']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                                        )
                                    ) );

                                    electro_product_cards_carousel( $args['section_args'], $args['carousel_args'] );

                                } else {
                                    $limit          = isset( $home_v3['pci']['carousel']['product_limit'] ) ? $home_v3['pci']['carousel']['product_limit'] : 6;
                                    $columns        = isset( $home_v3['pci']['carousel']['product_columns'] ) ? $home_v3['pci']['carousel']['product_columns'] : 2;

                                    $args = apply_filters( 'electro_products_carousel_with_image_args', array(
                                        'section_args'  => array(
                                            'section_title'     => isset( $home_v3['pci']['carousel']['section_title'] ) ? $home_v3['pci']['carousel']['section_title'] : esc_html__( 'Home Entertainment', 'electro' ),
                                            'section_class'     => 'home-v2-categories-products-carousel section-products-carousel',
                                        ),
                                        'carousel_args' => array(
                                            'margin'        => 30,
                                            'items'         => $columns,
                                            'autoplay'      => isset( $home_v3['pci']['carousel']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['pci']['carousel']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                                            'responsive'    => array(
                                                '0'     => array( 'items'   => 2, 'margin' => 10 ),
                                                '576'   => array( 'items'   => 3, 'margin' => 10 ),
                                                '768'   => array( 'items'   => 2, 'margin' => 10 ),
                                                '992'   => array( 'items'   => 2, 'margin' => 15 ),
                                                '1200'  => array( 'items'   => $columns )
                                            )
                                        ),
                                    ) );

                                    if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $home_v3['pci']['carousel']['carousel_args']['responsive'] ) ) {
                                        $responsive_args = array();
                                        foreach ( $home_v3['pci']['carousel']['carousel_args']['responsive'] as $key => $responsive ) {
                                            if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                                                $responsive_args[$key]['items'] = intval( $responsive['items'] );
                                            } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                                                $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                                            } else {
                                                $responsive_args[$key]['items'] = $columns;
                                            }
                                        }
                                        $args['carousel_args']['responsive'] = $responsive_args;
                                    }

                                    $shortcode      = isset( $home_v3['pci']['carousel']['content']['shortcode'] ) ? $home_v3['pci']['carousel']['content']['shortcode'] : 'sale_products';

                                    $content        = isset( $home_v3['pci']['carousel']['content'] ) ? $home_v3['pci']['carousel']['content'] : array();

                                    $default_atts   = array( 'per_page' => intval( $limit ) );
                                    $atts           = electro_get_atts_for_shortcode( $content );
                                    $atts           = wp_parse_args( $atts, $default_atts );

                                    $products_in_category = electro_do_shortcode( $shortcode, $atts );

                                    $args['section_args']['products_html'] = apply_filters( 'electro_home_v3_products_carousel_with_image_product_html', $products_in_category );

                                    electro_products_carousel( $args['section_args'], $args['carousel_args'] );
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section><?php
        }
    }
}

if ( ! function_exists( 'electro_home_v3_product_cards_carousel' ) ) {
    /**
     * Product Cards Carousel
     */
    function electro_home_v3_product_cards_carousel() {

        if ( is_woocommerce_activated() ) {
            $home_v3        = electro_get_home_v3_meta();

            $is_enabled = isset( $home_v3['pcc']['is_enabled'] ) ? $home_v3['pcc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation      = isset( $home_v3['pcc']['animation'] ) ? $home_v3['pcc']['animation'] : '';
            $limit          = isset( $home_v3['pcc']['product_limit'] ) ? intval( $home_v3['pcc']['product_limit'] ) : 16;
            $rows           = isset( $home_v3['pcc']['product_rows'] ) ? intval( $home_v3['pcc']['product_rows'] ) : 2;
            $columns        = isset( $home_v3['pcc']['product_columns'] ) ? intval( $home_v3['pcc']['product_columns'] ) : 2;
            $columns_wide   = isset( $home_v3['pcc']['product_columns_wide'] ) ? intval( $home_v3['pcc']['product_columns_wide'] ) : 3;
            $shortcode      = isset( $home_v3['pcc']['content']['shortcode'] ) ? $home_v3['pcc']['content']['shortcode'] : 'product_category';

            $default_atts   = array( 'per_page' => intval( $limit ) );
            $atts           = electro_get_atts_for_shortcode( $home_v3['pcc']['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = Electro_Products::$shortcode( $atts );

            $args = apply_filters( 'electro_home_v3_product_cards_carousel_args', array(
                'section_args'  => array(
                    'section_title'     => isset( $home_v3['pcc']['section_title'] ) ? $home_v3['pcc']['section_title'] : esc_html__( 'Music', 'electro' ),
                    'products'          => $products,
                    'columns'           => $columns,
                    'rows'              => $rows,
                    'total'             => $limit,
                    'show_nav'          => false,
                    'show_carousel_nav' => true,
                    'animation'         => $animation,
                ),
                'carousel_args' => array(
                    'autoplay'          => isset( $home_v3['pcc']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['pcc']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
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

if ( ! function_exists( 'electro_home_v3_product_cards_carousel_2' ) ) {
    /**
     * Displays Product Cards Carousel 2
     */
    function electro_home_v3_product_cards_carousel_2() {

        if ( is_woocommerce_activated() ) {
            $home_v3        = electro_get_home_v3_meta();

            $is_enabled = isset( $home_v3['pcc2']['is_enabled'] ) ? $home_v3['pcc2']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation      = isset( $home_v3['pcc2']['animation'] ) ? $home_v3['pcc2']['animation'] : '';
            $limit          = isset( $home_v3['pcc2']['product_limit'] ) ? intval( $home_v3['pcc2']['product_limit'] ) : 12;
            $rows           = isset( $home_v3['pcc2']['product_rows'] ) ? intval( $home_v3['pcc2']['product_rows'] ) : 1;
            $columns        = isset( $home_v3['pcc2']['product_columns'] ) ? intval( $home_v3['pcc2']['product_columns'] ) : 3;
            $columns_wide   = isset( $home_v3['pcc2']['product_columns_wide'] ) ? intval( $home_v3['pcc2']['product_columns_wide'] ) : 4;
            $shortcode      = isset( $home_v3['pcc2']['content']['shortcode'] ) ? $home_v3['pcc2']['content']['shortcode'] : 'recent_products';
            $default_atts   = array( 'per_page' => intval( $limit ) );
            $atts           = electro_get_atts_for_shortcode( $home_v3['pcc2']['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = Electro_Products::$shortcode( $atts );

            $args = apply_filters( 'electro_home_v3_product_cards_carousel_2_args', array(
                'section_args'  => array(
                    'section_title'     => isset( $home_v3['pcc2']['section_title'] ) ? $home_v3['pcc2']['section_title'] : esc_html__( 'Trending Products', 'electro' ),
                    'products'          => $products,
                    'columns'           => $columns,
                    'rows'              => $rows,
                    'total'             => $limit,
                    'show_nav'          => false,
                    'show_carousel_nav' => true,
                    'animation'         => $animation,
                ),
                'carousel_args' => array(
                    'autoplay'          => isset( $home_v3['pcc2']['carousel_args']['autoplay'] ) ? filter_var( $home_v3['pcc2']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
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

if ( ! function_exists( 'electro_home_v3_two_banners' ) ) {
    /**
     *
     */
    function electro_home_v3_two_banners() {

        if ( electro_is_wide_enabled() ) {

            $home_v3 = electro_get_home_v3_meta();

            $is_enabled = isset( $home_v3['tbrs']['is_enabled'] ) ? $home_v3['tbrs']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v3['tbrs']['animation'] ) ? ' animated ' . $home_v3['tbrs']['animation'] : '';

            $args = apply_filters( 'electro_home_v3_two_banners_args', array(
                array(
                    'image'         => isset( $home_v3['tbrs'][0]['image'] ) && $home_v3['tbrs'][0]['image'] ? wp_get_attachment_url( $home_v3['tbrs'][0]['image'] ) : 'http://placehold.it/690x151',
                    'action_link'   => isset( $home_v3['tbrs'][0]['action_link'] ) ? $home_v3['tbrs'][0]['action_link'] : '#',
                    'el_class'      => isset( $home_v3['tbrs'][0]['el_class'] ) ? $home_v3['tbrs'][0]['el_class'] : '',
                ),
                array(
                    'image'         => isset( $home_v3['tbrs'][1]['image'] ) && $home_v3['tbrs'][1]['image'] ? wp_get_attachment_url( $home_v3['tbrs'][1]['image'] ) : 'http://placehold.it/690x151',
                    'action_link'   => isset( $home_v3['tbrs'][1]['action_link'] ) ? $home_v3['tbrs'][1]['action_link'] : '#',
                    'el_class'      => isset( $home_v3['tbrs'][1]['el_class'] ) ? $home_v3['tbrs'][1]['el_class'] : '',
                ),
            ) );

            ob_start();

            electro_two_banners( $args );

            $ads_html = ob_get_clean();

            $section_class  = 'home-v3-da-block home-two-banners';

            if ( ! empty( $animation ) ) {
                $section_class .= ' animate-in-view';
            }
            ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
                <?php echo wp_kses_post( $ads_html ); ?>
            </div><?php
        }
    }
}

if ( ! function_exists( 'electro_home_v3_recent_viewed_products' ) ) {
    /**
    * Dispaly Recently Viewed Products in Home v3
    */
    function electro_home_v3_recent_viewed_products() {

        if ( is_woocommerce_activated() ) {

            if ( electro_is_wide_enabled() ) {

                global $electro_version;

                $viewed_products = electro_get_viewed_products();

                if ( empty( $viewed_products ) ) {
                    return;
                }

                $home_v3 = electro_get_home_v3_meta();
                $rvp_options     = $home_v3['rvp'];

                $is_enabled = isset( $home_v3['rvp']['is_enabled'] ) ? $home_v3['rvp']['is_enabled'] : 'no';

                if ( $is_enabled !== 'yes' ) {
                    return;
                }

                $animation = !empty( $home_v3['rvp']['animation'] ) ? ' animated ' . $home_v3['rvp']['animation'] : '';

                $args = apply_filters( 'electro_home_v3_recent_viewed_products_args', array(
                    'section_args'   => array(
                        'section_title'     => isset( $home_v3['rvp']['section_title'] ) ? $home_v3['rvp']['section_title'] : esc_html__( 'Your Recently Viewed Products', 'electro' ),
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
