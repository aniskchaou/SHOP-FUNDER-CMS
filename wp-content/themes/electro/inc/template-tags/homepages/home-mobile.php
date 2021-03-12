<?php
/**
 * Template tags used in mobile home pages
 */
if ( ! function_exists( 'electro_home_mobile_v1_slider' ) ) {
    /**
     * Displays Slider in Home  Mobile v1
     */
    function electro_home_mobile_v1_slider() {

        $home_mobile_v1     = electro_get_home_mobile_v1_meta();
        $sdr        = $home_mobile_v1['sdr'];

        $is_enabled = isset( $sdr['is_enabled'] ) ? $sdr['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $sdr['animation'] ) ? $sdr['animation'] : '';
        echo print_r($animation,1);
        $shortcode = !empty( $sdr['shortcode'] ) ? $sdr['shortcode'] : '[rev_slider alias="home-v1-slider"]';

        $section_class = 'home-v1-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_mobile_v1_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_ads_block' ) ) {
    /**
     * Displays Ads Block in Home Mobile v1
     */
    function electro_home_mobile_v1_ads_block() {

        $home_mobile_v1 = electro_get_home_mobile_v1_meta();

        $is_enabled = isset( $home_mobile_v1['ad']['is_enabled'] ) ? $home_mobile_v1['ad']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $home_mobile_v1['ad']['animation'] ) ? $home_mobile_v1['ad']['animation'] : '';
        $ad_image_attachment_size = apply_filters( 'electro_ad_image_attachment_size', 'full', 'mobile_v1' );

        $args = apply_filters( 'home_mobile_v1_ads_args', array(
            array(
                'ad_text'       => isset( $home_mobile_v1['ad'][0]['ad_text'] ) ? $home_mobile_v1['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <strong>Deals</strong> on the Cameras', 'electro' ) ),
                'action_text'   => isset( $home_mobile_v1['ad'][0]['action_text'] ) ? $home_mobile_v1['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                'action_link'   => isset( $home_mobile_v1['ad'][0]['action_link'] ) ? $home_mobile_v1['ad'][0]['action_link'] : '#',
                'ad_image'      => isset( $home_mobile_v1['ad'][0]['ad_image'] ) ? wp_get_attachment_url( $home_mobile_v1['ad'][0]['ad_image'] ) : '',
                'el_class'      => isset( $home_mobile_v1['ad'][0]['el_class'] ) ? $home_mobile_v1['ad'][0]['el_class'] : ' ',
                'ad_image_attachment' => isset( $home_mobile_v1['ad'][0]['ad_image'] ) ? wp_get_attachment_image( $home_mobile_v1['ad'][0]['ad_image'], $ad_image_attachment_size ) : '',
            ),
            array(
                'ad_text'       => isset( $home_mobile_v1['ad'][1]['ad_text'] ) ? $home_mobile_v1['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                'action_text'   => isset( $home_mobile_v1['ad'][1]['action_text'] ) ? $home_mobile_v1['ad'][1]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                'action_link'   => isset( $home_mobile_v1['ad'][1]['action_link'] ) ? $home_mobile_v1['ad'][1]['action_link'] : '#',
                'ad_image'      => isset( $home_mobile_v1['ad'][1]['ad_image'] ) ? wp_get_attachment_url( $home_mobile_v1['ad'][1]['ad_image'] ) : '',
                'el_class'      => isset( $home_mobile_v1['ad'][1]['el_class'] ) ? $home_mobile_v1['ad'][1]['el_class'] : ' ',
                'ad_image_attachment' => isset( $home_mobile_v1['ad'][1]['ad_image'] ) ? wp_get_attachment_image( $home_mobile_v1['ad'][1]['ad_image'], $ad_image_attachment_size ) : '',
            )
        ) );

        ob_start();

        electro_ads_block( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-mobile-v1-da-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_product_categories_list_1' ) ) {
    /**
     * Dispaly Products Categories list 1 in Home Mobile v1
     */
    function electro_home_mobile_v1_product_categories_list_1() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1     = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['pcl1']['is_enabled'] ) ? $home_mobile_v1['pcl1']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['pcl1']['animation'] ) ? $home_mobile_v1['pcl1']['animation'] : '';
            $cat_args   = isset( $home_mobile_v1['pcl1']['cat_args'] ) ? $home_mobile_v1['pcl1']['cat_args'] : array( 'number' => 8 );
            $cat_args['hide_empty'] = isset( $home_mobile_v1['pcl1']['cat_args']['hide_empty'] ) ? filter_var( $home_mobile_v1['pcl1']['cat_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false;
            $cat_args   = electro_get_atts_for_taxonomy_slugs( $cat_args );

            $args = apply_filters( 'electro_home_mobile_v1_product_categories_list_1_args', array(
                'animation'             => $animation,
                'columns'               => isset( $home_mobile_v1['pcl1']['columns'] ) ? $home_mobile_v1['pcl1']['columns'] : 4,
                'category_args'         => $cat_args
            ) );

            electro_product_categories_list( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_deal_products_block' ) ) {
    /**
     * Dispaly Deals Products Block in Home Mobile v1
     */
    function electro_home_mobile_v1_deal_products_block() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1    = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['dpb']['is_enabled'] ) ? $home_mobile_v1['dpb']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['dpb']['animation'] ) ? $home_mobile_v1['dpb']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v1['dpb']['section_title'] ) ? $home_mobile_v1['dpb']['section_title'] : esc_html__( 'Deals of the Day', 'electro' ),
                'enable_categories' => isset( $home_mobile_v1['dpb']['enable_categories'] ) ? filter_var( $home_mobile_v1['dpb']['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $home_mobile_v1['dpb']['categories_title'] ) ? $home_mobile_v1['dpb']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $home_mobile_v1['dpb']['category_args']['orderby'] ) ? $home_mobile_v1['dpb']['category_args']['orderby'] : 'name',
                    'order'             => isset( $home_mobile_v1['dpb']['category_args']['order'] ) ? $home_mobile_v1['dpb']['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $home_mobile_v1['dpb']['category_args']['hide_empty'] ) ? filter_var( $home_mobile_v1['dpb']['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $home_mobile_v1['dpb']['category_args']['number'] ) ? $home_mobile_v1['dpb']['category_args']['number'] : 3,
                    'slugs'             => isset( $home_mobile_v1['dpb']['category_args']['slugs'] ) ? $home_mobile_v1['dpb']['category_args']['slugs'] : '',
                ),
                'shortcode_tag'     => isset( $home_mobile_v1['dpb']['content']['shortcode'] ) ? $home_mobile_v1['dpb']['content']['shortcode'] : 'sale_products',
                'shortcode_atts'    => isset( $home_mobile_v1['dpb']['content'] ) ? electro_get_atts_for_shortcode( $home_mobile_v1['dpb']['content'] ) : array( 'per_page' => 2, 'columns' => 2 ),
                'action_text'       => isset( $home_mobile_v1['dpb']['action_text'] ) ? $home_mobile_v1['dpb']['action_text'] : esc_html__( 'See all deals', 'electro' ),
                'action_link'       => isset( $home_mobile_v1['dpb']['action_link'] ) ? $home_mobile_v1['dpb']['action_link'] : '#',
            );

            electro_deal_products_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_ad_banner_v1' ) ) {
    /**
     * Displays a Banner 1 in Home Mobile v1
     */
    function electro_home_mobile_v1_ad_banner_v1() {

        $home_mobile_v1 = electro_get_home_mobile_v1_meta();

        $is_enabled = isset( $home_mobile_v1['bd1']['is_enabled'] ) ? $home_mobile_v1['bd1']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_mobile_v1['bd1']['animation'] ) ? ' animated ' . $home_mobile_v1['bd1']['animation'] : '';

        $args = apply_filters( 'electro_home_mobile_v1_ad_banner_v1_args', array(
            'img_src'   => ( isset( $home_mobile_v1['bd1']['image'] ) && $home_mobile_v1['bd1']['image'] != 0 ) ? wp_get_attachment_url( $home_mobile_v1['bd1']['image'] ) : 'http://placehold.it/1170x170',
            'el_class'  => 'home-v2-fullbanner-ad',
            'link'      => isset( $home_mobile_v1['bd1']['link'] ) ? $home_mobile_v1['bd1']['link'] : '#',
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

if ( ! function_exists( 'electro_home_mobile_v1_products_1_2_block' ) ) {
    /**
     * Dispaly Products list Block 2 in Home Mobile v1
     */
    function electro_home_mobile_v1_products_1_2_block() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1    = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['pot']['is_enabled'] ) ? $home_mobile_v1['pot']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['pot']['animation'] ) ? $home_mobile_v1['pot']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v1['pot']['section_title'] ) ? $home_mobile_v1['pot']['section_title'] : esc_html__( 'Featured Products', 'electro' ),
                'enable_categories' => isset( $home_mobile_v1['pot']['enable_categories'] ) ? filter_var( $home_mobile_v1['pot']['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $home_mobile_v1['pot']['categories_title'] ) ? $home_mobile_v1['pot']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $home_mobile_v1['pot']['category_args']['orderby'] ) ? $home_mobile_v1['pot']['category_args']['orderby'] : 'name',
                    'order'             => isset( $home_mobile_v1['pot']['category_args']['order'] ) ? $home_mobile_v1['pot']['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $home_mobile_v1['pot']['category_args']['hide_empty'] ) ? filter_var( $home_mobile_v1['pot']['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $home_mobile_v1['pot']['category_args']['number'] ) ? $home_mobile_v1['pot']['category_args']['number'] : 3,
                    'slugs'             => isset( $home_mobile_v1['pot']['category_args']['slugs'] ) ? $home_mobile_v1['pot']['category_args']['slugs'] : '',
                ),
                'shortcode_tag'     => isset( $home_mobile_v1['pot']['content']['shortcode'] ) ? $home_mobile_v1['pot']['content']['shortcode'] : 'featured_products',
                'shortcode_atts'    => isset( $home_mobile_v1['pot']['content'] ) ? electro_get_atts_for_shortcode( $home_mobile_v1['pot']['content'] ) : array( 'per_page' => 3, 'columns' => 1 ),
                'action_text'       => isset( $home_mobile_v1['pot']['action_text'] ) ? $home_mobile_v1['pot']['action_text'] : esc_html__( 'See all products', 'electro' ),
                'action_link'       => isset( $home_mobile_v1['pot']['action_link'] ) ? $home_mobile_v1['pot']['action_link'] : '#',
            );

            electro_products_1_2_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_product_categories_list_2' ) ) {
    /**
     * Dispaly Products Categories list 2 in Home Mobile v1
     */
    function electro_home_mobile_v1_product_categories_list_2() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1     = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['pcl2']['is_enabled'] ) ? $home_mobile_v1['pcl2']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['pcl2']['animation'] ) ? $home_mobile_v1['pcl2']['animation'] : '';
            $cat_args   = isset( $home_mobile_v1['pcl2']['cat_args'] ) ? $home_mobile_v1['pcl2']['cat_args'] : array( 'number' => 9 );
            $cat_args['hide_empty'] = isset( $home_mobile_v1['pcl2']['cat_args']['hide_empty'] ) ? filter_var( $home_mobile_v1['pcl2']['cat_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false;
            $cat_args   = electro_get_atts_for_taxonomy_slugs( $cat_args );

            $args = apply_filters( 'electro_home_mobile_v1_product_categories_list_2_args', array(
                'animation'             => $animation,
                'section_title'         => isset( $home_mobile_v1['pcl2']['section_title'] ) ? $home_mobile_v1['pcl2']['section_title'] : '',
                'sub_title'             => isset( $home_mobile_v1['pcl2']['sub_title'] ) ? $home_mobile_v1['pcl2']['sub_title'] : '',
                'bg_image'              => isset( $home_mobile_v1['pcl2']['bg_image'] ) && intval( $home_mobile_v1['pcl2']['bg_image'] ) ? wp_get_attachment_image_src( $home_mobile_v1['pcl2']['bg_image'], array( '1170', '230' ) ) : array( '//placehold.it/1170x230', '1170', '230' ),
                'enable_header'         => isset( $home_mobile_v1['pcl2']['enable_header'] ) ? filter_var( $home_mobile_v1['pcl2']['enable_header'], FILTER_VALIDATE_BOOLEAN ) : true,
                'columns'               => isset( $home_mobile_v1['pcl2']['columns'] ) ? $home_mobile_v1['pcl2']['columns'] : 3,
                'category_args'         => $cat_args
            ) );

            electro_product_categories_list_with_header( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_products_list_block_1' ) ) {
    /**
     * Dispaly Products list Block 1 in Home Mobile v1
     */
    function electro_home_mobile_v1_products_list_block_1() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1    = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['pl1']['is_enabled'] ) ? $home_mobile_v1['pl1']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['pl1']['animation'] ) ? $home_mobile_v1['pl1']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v1['pl1']['section_title'] ) ? $home_mobile_v1['pl1']['section_title'] : esc_html__( 'Bestsellers', 'electro' ),
                'enable_categories' => isset( $home_mobile_v1['pl1']['enable_categories'] ) ? filter_var( $home_mobile_v1['pl1']['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $home_mobile_v1['pl1']['categories_title'] ) ? $home_mobile_v1['pl1']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $home_mobile_v1['pl1']['category_args']['orderby'] ) ? $home_mobile_v1['pl1']['category_args']['orderby'] : 'name',
                    'order'             => isset( $home_mobile_v1['pl1']['category_args']['order'] ) ? $home_mobile_v1['pl1']['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $home_mobile_v1['pl1']['category_args']['hide_empty'] ) ? filter_var( $home_mobile_v1['pl1']['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $home_mobile_v1['pl1']['category_args']['number'] ) ? $home_mobile_v1['pl1']['category_args']['number'] : 3,
                    'slugs'             => isset( $home_mobile_v1['pl1']['category_args']['slugs'] ) ? $home_mobile_v1['pl1']['category_args']['slugs'] : '',
                ),
                'shortcode_tag'     => isset( $home_mobile_v1['pl1']['content']['shortcode'] ) ? $home_mobile_v1['pl1']['content']['shortcode'] : 'featured_products',
                'shortcode_atts'    => isset( $home_mobile_v1['pl1']['content'] ) ? electro_get_atts_for_shortcode( $home_mobile_v1['pl1']['content'] ) : array( 'per_page' => 6, 'columns' => 3 ),
                'type'              => 'v2',
                'action_text'       => isset( $home_mobile_v1['pl1']['action_text'] ) ? $home_mobile_v1['pl1']['action_text'] : esc_html__( 'See all Deals', 'electro' ),
                'action_link'       => isset( $home_mobile_v1['pl1']['action_link'] ) ? $home_mobile_v1['pl1']['action_link'] : '#',
            );

            electro_products_list_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_ad_banner_v2' ) ) {
    /**
     * Displays a Banner 2 in Home Mobile v1
     */
    function electro_home_mobile_v1_ad_banner_v2() {

        $home_mobile_v1 = electro_get_home_mobile_v1_meta();

        $is_enabled = isset( $home_mobile_v1['bd2']['is_enabled'] ) ? $home_mobile_v1['bd2']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_mobile_v1['bd2']['animation'] ) ? ' animated ' . $home_mobile_v1['bd2']['animation'] : '';

        $args = apply_filters( 'electro_home_mobile_v1_ad_banner_v2_args', array(
            'img_src'   => ( isset( $home_mobile_v1['bd2']['image'] ) && $home_mobile_v1['bd2']['image'] != 0 ) ? wp_get_attachment_url( $home_mobile_v1['bd2']['image'] ) : 'http://placehold.it/1170x170',
            'el_class'  => 'home-v2-fullbanner-ad',
            'link'      => isset( $home_mobile_v1['bd2']['link'] ) ? $home_mobile_v1['bd2']['link'] : '#',
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

if ( ! function_exists( 'electro_home_mobile_v1_products_list_block_2' ) ) {
    /**
     * Dispaly Products list Block 2 in Home Mobile v1
     */
    function electro_home_mobile_v1_products_list_block_2() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1    = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['pl2']['is_enabled'] ) ? $home_mobile_v1['pl2']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['pl2']['animation'] ) ? $home_mobile_v1['pl2']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v1['pl2']['section_title'] ) ? $home_mobile_v1['pl2']['section_title'] : esc_html__( 'Smartphones', 'electro' ),
                'enable_categories' => isset( $home_mobile_v1['pl2']['enable_categories'] ) ? filter_var( $home_mobile_v1['pl2']['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $home_mobile_v1['pl2']['categories_title'] ) ? $home_mobile_v1['pl2']['categories_title'] : esc_html__( 'All Smartphones', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $home_mobile_v1['pl2']['category_args']['orderby'] ) ? $home_mobile_v1['pl2']['category_args']['orderby'] : 'name',
                    'order'             => isset( $home_mobile_v1['pl2']['category_args']['order'] ) ? $home_mobile_v1['pl2']['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $home_mobile_v1['pl2']['category_args']['hide_empty'] ) ? filter_var( $home_mobile_v1['pl2']['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $home_mobile_v1['pl2']['category_args']['number'] ) ? $home_mobile_v1['pl2']['category_args']['number'] : 3,
                    'slugs'             => isset( $home_mobile_v1['pl2']['category_args']['slugs'] ) ? $home_mobile_v1['pl2']['category_args']['slugs'] : '',
                ),
                'shortcode_tag'     => isset( $home_mobile_v1['pl2']['content']['shortcode'] ) ? $home_mobile_v1['pl2']['content']['shortcode'] : 'featured_products',
                'shortcode_atts'    => isset( $home_mobile_v1['pl2']['content'] ) ? electro_get_atts_for_shortcode( $home_mobile_v1['pl2']['content'] ) : array( 'per_page' => 6, 'columns' => 2 ),
                'type'              => '',
                'action_text'       => isset( $home_mobile_v1['pl2']['action_text'] ) ? $home_mobile_v1['pl2']['action_text'] : esc_html__( 'See all Products', 'electro' ),
                'action_link'       => isset( $home_mobile_v1['pl2']['action_link'] ) ? $home_mobile_v1['pl2']['action_link'] : '#',
            );

            electro_products_list_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_categories_block' ) ) {
    /**
     * Dispaly Categories Block in Home Mobile v1
     */
    function electro_home_mobile_v1_categories_block() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1     = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['hcb']['is_enabled'] ) ? $home_mobile_v1['hcb']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['hcb']['animation'] ) ? $home_mobile_v1['hcb']['animation'] : '';
            $cat_args   = isset( $home_mobile_v1['hcb']['cat_args'] ) ? $home_mobile_v1['hcb']['cat_args'] : array( 'number' => 4 );

            if ( ! empty( $home_mobile_v1['hcb']['cat_slugs'] ) ) {
                $cat_slugs = explode( ',', $home_mobile_v1['hcb']['cat_slugs'] );
                $cat_slugs = array_map( 'trim', $cat_slugs );
                $cat_args['slug']               = $cat_slugs;
                $cat_args['hide_empty'] = isset( $home_mobile_v1['hcb']['cat_args']['hide_empty'] ) ? filter_var( $home_mobile_v1['hcb']['cat_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false;

                $include = array();

                foreach ( $cat_slugs as $slug ) {
                    $include[] = "'" . $slug ."'";
                }

                if ( ! empty($include ) ) {
                    $cat_args['include']    = $include;
                    $cat_args['orderby']    = 'include';
                }
            }

            $args = apply_filters( 'electro_home_mobile_v1_categories_block_args', array(
                'section_title'         => isset( $home_mobile_v1['hcb']['section_title'] ) ? $home_mobile_v1['hcb']['section_title'] : '',
                'enable_full_width'     => isset( $home_mobile_v1['hcb']['enable_full_width'] ) ? filter_var( $home_mobile_v1['hcb']['enable_full_width'], FILTER_VALIDATE_BOOLEAN ) : false,
                'section_class'         => 'mobile-home-categories-block',
                'animation'             => $animation,
                'columns'               => isset( $home_mobile_v1['hcb']['columns'] ) ? $home_mobile_v1['hcb']['columns'] : '4',
                'category_args'         => $cat_args,
            ) );

            electro_home_categories_block( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_mobile_v1_recent_viewed_products' ) ) {
    /**
     * Dispaly Recently Viewed Products in Home Mobile v1
     */
    function electro_home_mobile_v1_recent_viewed_products() {

        if ( is_woocommerce_activated() ) {
            $home_mobile_v1    = electro_get_home_mobile_v1_meta();

            $is_enabled = isset( $home_mobile_v1['rvp']['is_enabled'] ) ? $home_mobile_v1['rvp']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $home_mobile_v1['rvp']['animation'] ) ? $home_mobile_v1['rvp']['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $home_mobile_v1['rvp']['section_title'] ) ? $home_mobile_v1['rvp']['section_title'] : esc_html__( 'Recently Viewed', 'electro' ),
            );

            electro_recent_viewed_products( $args );
        }
    }
}
