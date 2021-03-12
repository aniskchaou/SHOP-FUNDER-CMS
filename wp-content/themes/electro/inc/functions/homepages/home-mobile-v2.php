<?php
/**
 * Template tags used in home mobile v2
 */
if ( ! function_exists( 'electro_home_mobile_v2_slider' ) ) {
    /**
     * Displays Slider in Home Mobile v2
     */
    function electro_home_mobile_v2_slider() {

        $home_mobile_v2     = electro_get_home_mobile_v2_meta();
        $sdr        = $home_mobile_v2['sdr'];

        $is_enabled = isset( $sdr['is_enabled'] ) ? $sdr['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $sdr['animation'] ) ? $sdr['animation'] : '';
        echo print_r($animation,1);
        $shortcode = !empty( $sdr['shortcode'] ) ? $sdr['shortcode'] : '[rev_slider alias="home-v2-slider"]';

        $section_class = 'home-v2-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_mobile_v2_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_ads_block' ) ) {
    /**
     * Displays Ads Block in Home Mobile v2
     */
    function electro_home_mobile_v2_ads_block() {

        $home_mobile_v2 = electro_get_home_mobile_v2_meta();

        $is_enabled = isset( $home_mobile_v2['ad']['is_enabled'] ) ? $home_mobile_v2['ad']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $home_mobile_v2['ad']['animation'] ) ? $home_mobile_v2['ad']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'mobile_v2' );

        $args = apply_filters( 'home_mobile_v2_ads_args', array(
            array(
                'ad_text'       => isset( $home_mobile_v2['ad'][0]['ad_text'] ) ? $home_mobile_v2['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <strong>Deals</strong> on the Cameras', 'electro' ) ),
                'action_text'   => isset( $home_mobile_v2['ad'][0]['action_text'] ) ? $home_mobile_v2['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_mobile_v2['ad'][0]['action_link'] ) ? $home_mobile_v2['ad'][0]['action_link'] : '#',
                'ad_image'      => isset( $home_mobile_v2['ad'][0]['ad_image'] ) ? wp_get_attachment_url( $home_mobile_v2['ad'][0]['ad_image'] ) : '',
                'el_class'      => isset( $home_mobile_v2['ad'][0]['el_class'] ) ? $home_mobile_v2['ad'][0]['el_class'] : ' ',
                'ad_image_attachment' => isset( $home_mobile_v2['ad'][0]['ad_image'] ) ? wp_get_attachment_image( $home_mobile_v2['ad'][0]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_mobile_v2['ad'][1]['ad_text'] ) ? $home_mobile_v2['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets, Mobiles <strong>and more</strong>', 'electro' ) ),
                'action_text'   => isset( $home_mobile_v2['ad'][1]['action_text'] ) ? $home_mobile_v2['ad'][1]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                'action_link'   => isset( $home_mobile_v2['ad'][1]['action_link'] ) ? $home_mobile_v2['ad'][1]['action_link'] : '#',
                'ad_image'      => isset( $home_mobile_v2['ad'][1]['ad_image'] ) ? wp_get_attachment_url( $home_mobile_v2['ad'][1]['ad_image'] ) : '',
                'el_class'      => isset( $home_mobile_v2['ad'][1]['el_class'] ) ? $home_mobile_v2['ad'][1]['el_class'] : ' ',
                'ad_image_attachment' => isset( $home_mobile_v2['ad'][1]['ad_image'] ) ? wp_get_attachment_image( $home_mobile_v2['ad'][1]['ad_image'], $ad_image_attachment_size ) : '',
            )
        ) );

        ob_start();

        electro_ads_block( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-mobile-v2-da-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_deal_products_with_featured' ) ) {
    /**
     * Dispaly Deals Products with Featured in Home Mobile v2
     */
    function electro_home_mobile_v2_deal_products_with_featured() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v2    = electro_get_home_mobile_v2_meta();

            $is_enabled = isset( $home_mobile_v2['dpwf']['is_enabled'] ) ? $home_mobile_v2['dpwf']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v2['dpwf']['animation'] ) ? $home_mobile_v2['dpwf']['animation'] : '';

            $args = array(
                'section_class'             => '',
                'animation'                 => $animation,
                'section_title'             => isset( $home_mobile_v2['dpwf']['section_title'] ) ? $home_mobile_v2['dpwf']['section_title'] : esc_html__( 'Today Deals', 'electro' ),
                'shortcode_tag'             => isset( $home_mobile_v2['dpwf']['content']['shortcode'] ) ? $home_mobile_v2['dpwf']['content']['shortcode'] : 'sale_products',
                'shortcode_atts'            => isset( $home_mobile_v2['dpwf']['content'] ) ? electro_get_atts_for_shortcode( $home_mobile_v2['dpwf']['content'] ) : array( 'per_page' => 4, 'columns' => 1 ),
                'timer_title'               => isset( $home_mobile_v2['dpwf']['timer_title'] ) ? $home_mobile_v2['dpwf']['timer_title'] : esc_html__( 'ends in:', 'electro' ),
                'header_timer'              => isset( $home_mobile_v2['dpwf']['header_timer'] ) ? filter_var( $home_mobile_v2['dpwf']['header_timer'], FILTER_VALIDATE_BOOLEAN ) : false,
                'timer_value'               => isset( $home_mobile_v2['dpwf']['timer_value'] ) ? $home_mobile_v2['dpwf']['timer_value'] : ''
            );

            electro_deal_products_with_featured( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_products_list_block_1' ) ) {
    /**
     * Dispaly Products list Block 1 in Home Mobile v2
     */
    function electro_home_mobile_v2_products_list_block_1() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v2    = electro_get_home_mobile_v2_meta();

            $is_enabled = isset( $home_mobile_v2['pl1']['is_enabled'] ) ? $home_mobile_v2['pl1']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v2['pl1']['animation'] ) ? $home_mobile_v2['pl1']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v2['pl1']['section_title'] ) ? $home_mobile_v2['pl1']['section_title'] : esc_html__( 'Bestsellers', 'electro' ),
                'enable_categories' => isset( $home_mobile_v2['pl1']['enable_categories'] ) ? filter_var( $home_mobile_v2['pl1']['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $home_mobile_v2['pl1']['categories_title'] ) ? $home_mobile_v2['pl1']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $home_mobile_v2['pl1']['category_args']['orderby'] ) ? $home_mobile_v2['pl1']['category_args']['orderby'] : 'name',
                    'order'             => isset( $home_mobile_v2['pl1']['category_args']['order'] ) ? $home_mobile_v2['pl1']['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $home_mobile_v2['pl1']['category_args']['hide_empty'] ) ? filter_var( $home_mobile_v2['pl1']['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $home_mobile_v2['pl1']['category_args']['number'] ) ? $home_mobile_v2['pl1']['category_args']['number'] : 3,
                    'slugs'             => isset( $home_mobile_v2['pl1']['category_args']['slugs'] ) ? $home_mobile_v2['pl1']['category_args']['slugs'] : '',
                ),
                'shortcode_tag'     => isset( $home_mobile_v2['pl1']['content']['shortcode'] ) ? $home_mobile_v2['pl1']['content']['shortcode'] : 'featured_products',
                'shortcode_atts'    => isset( $home_mobile_v2['pl1']['content'] ) ? electro_get_atts_for_shortcode( $home_mobile_v2['pl1']['content'] ) : array( 'per_page' => 6, 'columns' => 3 ),
                'type'              => 'v2',
                'action_text'       => isset( $home_mobile_v2['pl1']['action_text'] ) ? $home_mobile_v2['pl1']['action_text'] : esc_html__( 'See all Products', 'electro' ),
                'action_link'       => isset( $home_mobile_v2['pl1']['action_link'] ) ? $home_mobile_v2['pl1']['action_link'] : '#',
            );

            electro_products_list_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_product_categories_list' ) ) {
    /**
     * Dispaly Products Categories list in Home Mobile v2
     */
    function electro_home_mobile_v2_product_categories_list() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v2     = electro_get_home_mobile_v2_meta();

            $is_enabled = isset( $home_mobile_v2['pcl']['is_enabled'] ) ? $home_mobile_v2['pcl']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v2['pcl']['animation'] ) ? $home_mobile_v2['pcl']['animation'] : '';
            $cat_args   = isset( $home_mobile_v2['pcl']['cat_args'] ) ? $home_mobile_v2['pcl']['cat_args'] : array( 'number' => 6 );
            $cat_args['hide_empty'] = isset( $home_mobile_v2['pcl']['cat_args']['hide_empty'] ) ? filter_var( $home_mobile_v2['pcl']['cat_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false;
            $cat_args   = electro_get_atts_for_taxonomy_slugs( $cat_args );

            $args = apply_filters( 'electro_home_mobile_v2_product_categories_list_args', array(
                'section_class'         => 'v2',
                'animation'             => $animation,
                'section_title'         => isset( $home_mobile_v2['pcl']['section_title'] ) ? $home_mobile_v2['pcl']['section_title'] : '',
                'sub_title'             => isset( $home_mobile_v2['pcl']['sub_title'] ) ? $home_mobile_v2['pcl']['sub_title'] : '',
                'bg_image'              => isset( $home_mobile_v2['pcl']['bg_image'] ) && intval( $home_mobile_v2['pcl']['bg_image'] ) ? wp_get_attachment_image_src( $home_mobile_v2['pcl']['bg_image'], array( '1170', '230' ) ) : array( '//placehold.it/1170x230', '1170', '230' ),
                'enable_header'         => isset( $home_mobile_v2['pcl']['enable_header'] ) ? filter_var( $home_mobile_v2['pcl']['enable_header'], FILTER_VALIDATE_BOOLEAN ) : true,
                'columns'               => isset( $home_mobile_v2['pcl']['columns'] ) ? $home_mobile_v2['pcl']['columns'] : 3,
                'category_args'         => $cat_args
            ) );

            electro_product_categories_list_with_header( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_products_list_block_2' ) ) {
    /**
     * Dispaly Products list Block 2 in Home Mobile v2
     */
    function electro_home_mobile_v2_products_list_block_2() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v2    = electro_get_home_mobile_v2_meta();

            $is_enabled = isset( $home_mobile_v2['pl2']['is_enabled'] ) ? $home_mobile_v2['pl2']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v2['pl2']['animation'] ) ? $home_mobile_v2['pl2']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v2['pl2']['section_title'] ) ? $home_mobile_v2['pl2']['section_title'] : esc_html__( 'Smartphones', 'electro' ),
                'enable_categories' => isset( $home_mobile_v2['pl2']['enable_categories'] ) ? filter_var( $home_mobile_v2['pl2']['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $home_mobile_v2['pl2']['categories_title'] ) ? $home_mobile_v2['pl2']['categories_title'] : esc_html__( 'All Smartphones', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $home_mobile_v2['pl2']['category_args']['orderby'] ) ? $home_mobile_v2['pl2']['category_args']['orderby'] : 'name',
                    'order'             => isset( $home_mobile_v2['pl2']['category_args']['order'] ) ? $home_mobile_v2['pl2']['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $home_mobile_v2['pl2']['category_args']['hide_empty'] ) ? filter_var( $home_mobile_v2['pl2']['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $home_mobile_v2['pl2']['category_args']['number'] ) ? $home_mobile_v2['pl2']['category_args']['number'] : 3,
                    'slugs'             => isset( $home_mobile_v2['pl2']['category_args']['slugs'] ) ? $home_mobile_v2['pl2']['category_args']['slugs'] : '',
                ),
                'shortcode_tag'     => isset( $home_mobile_v2['pl2']['content']['shortcode'] ) ? $home_mobile_v2['pl2']['content']['shortcode'] : 'featured_products',
                'shortcode_atts'    => isset( $home_mobile_v2['pl2']['content'] ) ? electro_get_atts_for_shortcode( $home_mobile_v2['pl2']['content'] ) : array( 'per_page' => 6, 'columns' => 2 ),
                'type'              => '',
                'action_text'       => isset( $home_mobile_v2['pl2']['action_text'] ) ? $home_mobile_v2['pl2']['action_text'] : esc_html__( 'See all products', 'electro' ),
                'action_link'       => isset( $home_mobile_v2['pl2']['action_link'] ) ? $home_mobile_v2['pl2']['action_link'] : '#',
            );

            electro_products_list_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_ad_banner' ) ) {
    /**
     * Displays a Banner in home mobile v2
     */
    function electro_home_mobile_v2_ad_banner() {

        $home_mobile_v2 = electro_get_home_mobile_v2_meta();

        $is_enabled = isset( $home_mobile_v2['bd']['is_enabled'] ) ? $home_mobile_v2['bd']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_mobile_v2['bd']['animation'] ) ? ' animated ' . $home_mobile_v2['bd']['animation'] : '';

        $args = apply_filters( 'electro_home_mobile_v2_ad_banner_args', array(
            'img_src'   => ( isset( $home_mobile_v2['bd']['image'] ) && $home_mobile_v2['bd']['image'] != 0 ) ? wp_get_attachment_url( $home_mobile_v2['bd']['image'] ) : 'http://placehold.it/1170x170',
            'el_class'  => 'home-v2-fullbanner-ad',
            'link'      => isset( $home_mobile_v2['bd']['link'] ) ? $home_mobile_v2['bd']['link'] : '#',
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

if ( ! function_exists( 'electro_home_mobile_v2_recent_viewed_products' ) ) {
    /**
     *Dispaly Recently Viewed Products in Home Mobile v2
     */
    function electro_home_mobile_v2_recent_viewed_products() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v2    = electro_get_home_mobile_v2_meta();

            $is_enabled = isset( $home_mobile_v2['rvp']['is_enabled'] ) ? $home_mobile_v2['rvp']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v2['rvp']['animation'] ) ? $home_mobile_v2['rvp']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v2['rvp']['section_title'] ) ? $home_mobile_v2['rvp']['section_title'] : esc_html__( 'Recently Viewed', 'electro' ),
            );

            electro_recent_viewed_products( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_features_list' ) ) {
    /**
     *
     */
    function electro_home_mobile_v2_features_list() {

        $home_mobile_v2 = electro_get_home_mobile_v2_meta();

        $is_enabled = isset( $home_mobile_v2['fl']['is_enabled'] ) ? $home_mobile_v2['fl']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $home_mobile_v2['fl']['animation'] ) ? $home_mobile_v2['fl']['animation'] : '';

        $features = apply_filters( 'electro_home_mobile_v2_features_list_features', array(
            array(
                'icon'  => isset( $home_mobile_v2['fl'][0]['icon'] ) ? $home_mobile_v2['fl'][0]['icon'] : 'ec ec-transport',
                'text'  => isset( $home_mobile_v2['fl'][0]['text'] ) ? $home_mobile_v2['fl'][0]['text'] : wp_kses_post( __( '<strong>Free Delivery</strong> from $50', 'electro' ) )
            ),
            array(
                'icon'  => isset( $home_mobile_v2['fl'][1]['icon'] ) ? $home_mobile_v2['fl'][1]['icon'] : 'ec ec-customers',
                'text'  => isset( $home_mobile_v2['fl'][1]['text'] ) ? $home_mobile_v2['fl'][1]['text'] : wp_kses_post( __( '<strong>99% Positive</strong> Feedbacks', 'electro' ) )
            ),
            array(
                'icon'  => isset( $home_mobile_v2['fl'][2]['icon'] ) ? $home_mobile_v2['fl'][2]['icon'] : 'ec ec-returning',
                'text'  => isset( $home_mobile_v2['fl'][2]['text'] ) ? $home_mobile_v2['fl'][2]['text'] : wp_kses_post( __( '<strong>365 days</strong> for free return', 'electro' ) )
            ),
            array(
                'icon'  => isset( $home_mobile_v2['fl'][3]['icon'] ) ? $home_mobile_v2['fl'][3]['icon'] : 'ec ec-payment',
                'text'  => isset( $home_mobile_v2['fl'][3]['text'] ) ? $home_mobile_v2['fl'][3]['text'] : wp_kses_post( __( '<strong>Payment</strong> Secure System', 'electro' ) )
            ),
            array(
                'icon'  => isset( $home_mobile_v2['fl'][4]['icon'] ) ? $home_mobile_v2['fl'][4]['icon'] : 'ec ec-tag',
                'text'  => isset( $home_mobile_v2['fl'][4]['text'] ) ? $home_mobile_v2['fl'][4]['text'] : wp_kses_post( __( '<strong>Only Best</strong> Brands', 'electro' ) )
            )
        ) );

        $section_class  = 'home-mobile-v2-features-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo electro_features_list( $features ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_mobile_v2_list_categories' ) ) {
    /**
     * Dispaly Products Categories list 2 in Home Mobile v2
     */
    function electro_home_mobile_v2_list_categories() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v2     = electro_get_home_mobile_v2_meta();

            $is_enabled = isset( $home_mobile_v2['hlc']['is_enabled'] ) ? $home_mobile_v2['hlc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v2['hlc']['animation'] ) ? $home_mobile_v2['hlc']['animation'] : '';

            $cat_args_0 = isset( $home_mobile_v2['hlc']['category_list'][0]['category_args'] ) ? $home_mobile_v2['hlc']['category_list'][0]['category_args'] : array( 'number' => 5 );
            $cat_args_0 = electro_get_atts_for_taxonomy_slugs( $cat_args_0 );

            $cat_args_1 = isset( $home_mobile_v2['hlc']['category_list'][1]['category_args'] ) ? $home_mobile_v2['hlc']['category_list'][1]['category_args'] : array( 'number' => 5 );
            $cat_args_1 = electro_get_atts_for_taxonomy_slugs( $cat_args_1 );

            $args = apply_filters( 'electro_home_mobile_v2_list_categories_args', array(
                'animation'             => $animation,
                'section_title'         => isset( $home_mobile_v2['hlc']['section_title'] ) ? $home_mobile_v2['hlc']['section_title'] : '',
                'category_list'         => array(
                    array(
                        'title'         => isset( $home_mobile_v2['hlc']['category_list'][0]['title'] ) ? $home_mobile_v2['hlc']['category_list'][0]['title'] : esc_html__( 'Mobiles', 'electro' ),
                        'category_args' => $cat_args_0
                    ),
                    array(
                        'title'         => isset( $home_mobile_v2['hlc']['category_list'][1]['title'] ) ? $home_mobile_v2['hlc']['category_list'][1]['title'] : esc_html__( 'Games', 'electro' ),
                        'category_args' => $cat_args_1
                    )
                ),
                'action_text'           => isset( $home_mobile_v2['hlc']['action_text'] ) ? $home_mobile_v2['hlc']['action_text'] : esc_html__( 'Show more', 'electro' ),
                'action_link'           => isset( $home_mobile_v2['hlc']['action_link'] ) ? $home_mobile_v2['hlc']['action_link'] : '#',
            ) );

            electro_product_categories_menu_list( $args );
        }
    }
}
