<?php
/**
 * Template functions hooked into the `homepage_v9` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v9_revslider' ) ) {
    /**
     * Displays Slider in Home v9
     */
    function electro_home_v9_revslider(  ) {

        $home_v9        = electro_get_home_v9_meta();
        $swdpc_options  = $home_v9['swdpc'];

        $is_enabled = isset( $swdpc_options['is_enabled'] ) ? filter_var( $swdpc_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $swdpc_options['animation'] ) ? $swdpc_options['animation'] : '';
        $shortcode = !empty( $swdpc_options['slider_shortcode'] ) ? $swdpc_options['slider_shortcode'] : '[rev_slider alias="home-v9-slider"]';

        $section_class = 'home-v9-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_v9_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v9_onsale_product_carousel' ) ) {
    /**
     * Displays an onsale product carousel in home v9
     *
     * @return void
     */
    function electro_home_v9_onsale_product_carousel() {

        if ( is_woocommerce_activated() ) {

            $home_v9 = electro_get_home_v9_meta();
            $swdpc_options  = $home_v9['swdpc'];
            $dpc_options = $swdpc_options['dpc'];

            $is_enabled = isset( $dpc_options['is_enabled'] ) ? filter_var( $dpc_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

            if ( ! $is_enabled ) {
                return;
            }

            $animation = isset( $swdpc_options['animation'] ) ? $swdpc_options['animation'] : '';

            $section_args = apply_filters( 'electro_home_v9_onsale_product_section_args', array(
                'animation'         => $animation,
                'limit'             => isset( $dpc_options['product_limit'] ) ? $dpc_options['product_limit'] : 2,
                'product_choice'    => isset( $dpc_options['product_choice'] ) ? $dpc_options['product_choice'] : 'random',
                'product_ids'       => isset( $dpc_options['product_ids'] ) ? $dpc_options['product_ids'] :'',
            ) );

            $carousel_args  = apply_filters( 'electro_home_v9_onsale_product_carousel_args', array(
                'autoplay'          => isset( $dpc_options['carousel_args']['autoplay'] ) ? filter_var( $dpc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                'items'             => 1,
                'nav'               => true,
                'dots'              => false,
                'rtl'               => is_rtl() ? true : false,
                'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                'touchDrag'         => true
            ) );

            electro_onsale_product_carousel_v9( $section_args, $carousel_args );
        }
    }
}

if ( ! function_exists( 'electro_home_v9_slider_with_deals_product_carousel' ) ) {
    /**
     *
     */
    function electro_home_v9_slider_with_deals_product_carousel() {

        $home_v9        = electro_get_home_v9_meta();
        $swdpc_options  = $home_v9['swdpc'];

        $is_enabled = isset( $swdpc_options['is_enabled'] ) ? filter_var( $swdpc_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $dpc_is_enabled = isset( $swdpc_options['dpc'] ) && isset( $swdpc_options['dpc']['is_enabled'] ) ? filter_var( $swdpc_options['dpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        ?>
        <div class="slider-with-deal-products-carousel">
            <div class="container">
                <div class="slider-with-deal-products-carousel-inner">
                    <div class="slider-block">
                        <?php electro_home_v9_revslider(); ?>
                    </div>
                    <?php if( $dpc_is_enabled ) : ?>
                        <div class="deal-products-carousel-block">
                            <?php electro_home_v9_onsale_product_carousel(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v9_products_carousel_tabs' ) ) {
    /**
     * Displays Home v9 Products Carousel Tabs
     */
    function electro_home_v9_products_carousel_tabs() {

        if ( is_woocommerce_activated() ) {

            $home_v9 = electro_get_home_v9_meta();

            $is_enabled = isset( $home_v9['pct']['is_enabled'] ) ? $home_v9['pct']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = isset( $home_v9['pct']['animation'] ) ? $home_v9['pct']['animation'] : '';

            $section_class = 'home-v9-products-carousel-tabs tabs-nav-align-left';

            $args = apply_filters( 'electro_home_v9_products_carousel_tabs_args', array(
                'section_class' => $section_class,
                'animation'     => $animation,
                'tabs'          => array(
                    array(
                        'id'            => 'tab-products-1',
                        'title'         => isset( $home_v9['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v9['pct']['tabs'][0]['title'] : esc_html__( 'Featured', 'electro' ),
                        'shortcode_tag' => isset( $home_v9['pct']['tabs'][0]['content']['shortcode'] ) ? $home_v9['pct']['tabs'][0]['content']['shortcode'] : 'featured_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v9['pct']['tabs'][0]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-2',
                        'title'         => isset( $home_v9['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v9['pct']['tabs'][1]['title'] : esc_html__( 'On Sale', 'electro' ),
                        'shortcode_tag' => isset( $home_v9['pct']['tabs'][1]['content']['shortcode'] ) ? $home_v9['pct']['tabs'][1]['content']['shortcode'] : 'sale_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v9['pct']['tabs'][1]['content'] )
                    ),
                    array(
                        'id'            => 'tab-products-3',
                        'title'         => isset( $home_v9['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v9['pct']['tabs'][2]['title'] : esc_html__( 'Top Rated', 'electro' ),
                        'shortcode_tag' => isset( $home_v9['pct']['tabs'][2]['content']['shortcode'] ) ? $home_v9['pct']['tabs'][2]['content']['shortcode'] : 'top_rated_products',
                        'atts'          => electro_get_atts_for_shortcode( $home_v9['pct']['tabs'][2]['content'] )
                    )
                ),
                'limit'         => isset( $home_v9['pct']['product_limit'] ) ? $home_v9['pct']['product_limit'] : 8,
                'columns'       => isset( $home_v9['pct']['product_columns'] ) ? $home_v9['pct']['product_columns'] : 6,
                'columns_wide'  => isset( $home_v9['pct']['product_columns_wide'] ) ? $home_v9['pct']['product_columns_wide'] : 7,
                'carousel_args' => array(
                    'items'         => isset( $home_v9['pct']['product_columns'] ) ? intval( $home_v9['pct']['product_columns'] ) : 6,
                    'dots'          => isset( $home_v9['pct']['carousel_args']['dots'] ) ? filter_var( $home_v9['pct']['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'autoplay'      => isset( $home_v9['pct']['carousel_args']['autoplay'] ) ? filter_var( $home_v9['pct']['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'    => array(
                        '0'     => array( 'items'   => 2 ),
                        '480'   => array( 'items'   => 3 ),
                        '768'   => array( 'items'   => 3 ),
                        '992'   => array( 'items'   => 3 ),
                        '1200'  => array( 'items'   => isset( $home_v9['pct']['product_columns'] ) ? intval( $home_v9['pct']['product_columns'] ) : 6 ),
                        '1480'  => array( 'items'   => isset( $home_v9['pct']['product_columns_wide'] ) ? intval( $home_v9['pct']['product_columns_wide'] ) : 7 ),
                    )
                )
            ) );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $home_v9['pct']['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $home_v9['pct']['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $home_v9['pct']['product_columns'];
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

if ( ! function_exists( 'electro_home_v9_banner_1_6_block' ) ) {
    /**
     *
     */
    function electro_home_v9_banner_1_6_block() {

        $home_v9 = electro_get_home_v9_meta();

        $is_enabled = isset( $home_v9['bb']['is_enabled'] ) ? $home_v9['bb']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v9['bb']['animation'] ) ? ' animated ' . $home_v9['bb']['animation'] : '';

        $args = apply_filters( 'electro_home_v9_banner_1_6_block_args', array(
            array(
                'image'         => isset( $home_v9['bb'][0]['image'] ) && $home_v9['bb'][0]['image'] ? wp_get_attachment_url( $home_v9['bb'][0]['image'] ) : 'http://placehold.it/554x326',
                'action_link'   => isset( $home_v9['bb'][0]['action_link'] ) ? $home_v9['bb'][0]['action_link'] : '#',
                'el_class'      => isset( $home_v9['bb'][0]['el_class'] ) ? $home_v9['bb'][0]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v9['bb'][1]['image'] ) && $home_v9['bb'][1]['image'] ? wp_get_attachment_url( $home_v9['bb'][1]['image'] ) : 'http://placehold.it/268x155',
                'action_link'   => isset( $home_v9['bb'][1]['action_link'] ) ? $home_v9['bb'][1]['action_link'] : '#',
                'el_class'      => isset( $home_v9['bb'][1]['el_class'] ) ? $home_v9['bb'][1]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v9['bb'][2]['image'] ) && $home_v9['bb'][2]['image'] ? wp_get_attachment_url( $home_v9['bb'][2]['image'] ) : 'http://placehold.it/268x155',
                'action_link'   => isset( $home_v9['bb'][2]['action_link'] ) ? $home_v9['bb'][2]['action_link'] : '#',
                'el_class'      => isset( $home_v9['bb'][2]['el_class'] ) ? $home_v9['bb'][2]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v9['bb'][3]['image'] ) && $home_v9['bb'][3]['image'] ? wp_get_attachment_url( $home_v9['bb'][3]['image'] ) : 'http://placehold.it/268x155',
                'action_link'   => isset( $home_v9['bb'][3]['action_link'] ) ? $home_v9['bb'][3]['action_link'] : '#',
                'el_class'      => isset( $home_v9['bb'][3]['el_class'] ) ? $home_v9['bb'][3]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v9['bb'][4]['image'] ) && $home_v9['bb'][4]['image'] ? wp_get_attachment_url( $home_v9['bb'][4]['image'] ) : 'http://placehold.it/268x155',
                'action_link'   => isset( $home_v9['bb'][4]['action_link'] ) ? $home_v9['bb'][4]['action_link'] : '#',
                'el_class'      => isset( $home_v9['bb'][4]['el_class'] ) ? $home_v9['bb'][4]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v9['bb'][5]['image'] ) && $home_v9['bb'][5]['image'] ? wp_get_attachment_url( $home_v9['bb'][5]['image'] ) : 'http://placehold.it/268x155',
                'action_link'   => isset( $home_v9['bb'][5]['action_link'] ) ? $home_v9['bb'][5]['action_link'] : '#',
                'el_class'      => isset( $home_v9['bb'][5]['el_class'] ) ? $home_v9['bb'][5]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v9['bb'][6]['image'] ) && $home_v9['bb'][6]['image'] ? wp_get_attachment_url( $home_v9['bb'][6]['image'] ) : 'http://placehold.it/268x155',
                'action_link'   => isset( $home_v9['bb'][6]['action_link'] ) ? $home_v9['bb'][6]['action_link'] : '#',
                'el_class'      => isset( $home_v9['bb'][6]['el_class'] ) ? $home_v9['bb'][6]['el_class'] : '',
            ),
        ) );

        ob_start();

        electro_home_banner_1_6_block( $args );

        $banner_html = ob_get_clean();

        $section_class  = 'section-home-banner-1-6 home-v9-banner-1-6';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $banner_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v9_product_categories_with_banner_carousel_1' ) ) {
    /**
     *
     */
    function electro_home_v9_product_categories_with_banner_carousel_1() {

        if ( is_woocommerce_activated() ) {
            $home_v9    = electro_get_home_v9_meta();
            $pcwbc_options = isset( $home_v9['pcwbc1'] ) ? $home_v9['pcwbc1'] : '';

            $is_enabled = isset( $pcwbc_options['is_enabled'] ) ? $pcwbc_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pcwbc_options['animation'] ) ? $pcwbc_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pcwbc_options['section_title'] ) ? $pcwbc_options['section_title'] : esc_html__( 'Computers & Laptops', 'electro' ),
                'content'           => array(
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][0]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][0]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][0]['category_1_args'] ) ? $pcwbc_options['content'][0]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][0]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][0]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][0]['category_2_args'] ) ? $pcwbc_options['content'][0]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][0]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][0]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][0]['image'] ) && intval( $pcwbc_options['content'][0]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][0]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][0]['img_action_link'] ) ? $pcwbc_options['content'][0]['img_action_link'] : '#',
                    ),
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][1]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][1]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][1]['category_1_args'] ) ? $pcwbc_options['content'][1]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][1]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][1]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][1]['category_2_args'] ) ? $pcwbc_options['content'][1]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][1]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][1]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][1]['image'] ) && intval( $pcwbc_options['content'][1]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][1]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][1]['img_action_link'] ) ? $pcwbc_options['content'][1]['img_action_link'] : '#',
                    ),
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][2]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][2]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][2]['category_1_args'] ) ? $pcwbc_options['content'][2]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][2]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][2]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][2]['category_2_args'] ) ? $pcwbc_options['content'][2]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][2]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][2]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][2]['image'] ) && intval( $pcwbc_options['content'][2]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][2]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][2]['img_action_link'] ) ? $pcwbc_options['content'][2]['img_action_link'] : '#',
                    ),
                ),
                'carousel_args' => array(
                    'autoplay'          => isset( $pcwbc_options['carousel_args']['autoplay'] ) ? filter_var( $pcwbc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'items'             => 1,
                    'dots'              => isset( $pcwbc_options['carousel_args']['dots'] ) ? filter_var( $pcwbc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pcwbc_options['carousel_args']['nav'] ) ? filter_var( $pcwbc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'rtl'               => is_rtl() ? true : false,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                ),
            );

            electro_home_product_categories_with_banner_carousel( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v9_product_categories_with_banner_carousel_2' ) ) {
    /**
     *
     */
    function electro_home_v9_product_categories_with_banner_carousel_2() {

        if ( is_woocommerce_activated() ) {
            $home_v9    = electro_get_home_v9_meta();
            $pcwbc_options = isset( $home_v9['pcwbc2'] ) ? $home_v9['pcwbc2'] : '';

            $is_enabled = isset( $pcwbc_options['is_enabled'] ) ? $pcwbc_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pcwbc_options['animation'] ) ? $pcwbc_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pcwbc_options['section_title'] ) ? $pcwbc_options['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                'content'           => array(
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][0]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][0]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][0]['category_1_args'] ) ? $pcwbc_options['content'][0]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][0]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][0]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][0]['category_2_args'] ) ? $pcwbc_options['content'][0]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][0]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][0]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][0]['image'] ) && intval( $pcwbc_options['content'][0]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][0]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][0]['img_action_link'] ) ? $pcwbc_options['content'][0]['img_action_link'] : '#',
                    ),
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][1]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][1]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][1]['category_1_args'] ) ? $pcwbc_options['content'][1]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][1]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][1]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][1]['category_2_args'] ) ? $pcwbc_options['content'][1]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][1]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][1]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][1]['image'] ) && intval( $pcwbc_options['content'][1]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][1]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][1]['img_action_link'] ) ? $pcwbc_options['content'][1]['img_action_link'] : '#',
                    ),
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][2]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][2]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][2]['category_1_args'] ) ? $pcwbc_options['content'][2]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][2]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][2]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][2]['category_2_args'] ) ? $pcwbc_options['content'][2]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][2]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][2]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][2]['image'] ) && intval( $pcwbc_options['content'][2]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][2]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][2]['img_action_link'] ) ? $pcwbc_options['content'][2]['img_action_link'] : '#',
                    ),
                ),
                'carousel_args' => array(
                    'autoplay'          => isset( $pcwbc_options['carousel_args']['autoplay'] ) ? filter_var( $pcwbc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'items'             => 1,
                    'dots'              => isset( $pcwbc_options['carousel_args']['dots'] ) ? filter_var( $pcwbc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pcwbc_options['carousel_args']['nav'] ) ? filter_var( $pcwbc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'rtl'               => is_rtl() ? true : false,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                ),
            );

            electro_home_product_categories_with_banner_carousel( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v9_products_carousel' ) ) {
    /**
     *
     */
    function electro_home_v9_products_carousel() {
        if ( is_woocommerce_activated() ) {

            $home_v9 = electro_get_home_v9_meta();
            $pc_options     = $home_v9['pc'];

            $is_enabled = isset( $home_v9['pc']['is_enabled'] ) ? $home_v9['pc']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v9['pc']['animation'] ) ? ' animated ' . $home_v9['pc']['animation'] : '';

            $args = apply_filters( 'electro_home_v9_products_carousel_args', array(
                'limit'             => isset( $home_v9['pc']['product_limit'] ) ? intval( $home_v9['pc']['product_limit'] ) : 20,
                'columns'           => isset( $home_v9['pc']['product_columns'] ) ? intval( $home_v9['pc']['product_columns'] ) : 6,
                'section_args'   => array(
                    'section_title'     => isset( $home_v9['pc']['section_title'] ) ? $home_v9['pc']['section_title'] : esc_html__( 'Trending Products', 'electro' ),
                    'button_text'       => isset( $home_v9['pc']['button_text'] ) ? $home_v9['pc']['button_text'] : wp_kses_post( __( 'See All Trending products', 'electro' ) ),
                    'button_link'       => isset( $home_v9['pc']['button_link'] ) ? $home_v9['pc']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel trending-products-carousel',
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
                'limit'     => isset( $home_v9['pc']['product_limit'] ) ? $home_v9['pc']['product_limit'] : 20,
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

if ( ! function_exists( 'electro_home_v9_product_categories_with_banner_carousel_3' ) ) {
    /**
     *
     */
    function electro_home_v9_product_categories_with_banner_carousel_3() {

        if ( is_woocommerce_activated() ) {
            $home_v9    = electro_get_home_v9_meta();
            $pcwbc_options = isset( $home_v9['pcwbc3'] ) ? $home_v9['pcwbc3'] : '';

            $is_enabled = isset( $pcwbc_options['is_enabled'] ) ? $pcwbc_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pcwbc_options['animation'] ) ? $pcwbc_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pcwbc_options['section_title'] ) ? $pcwbc_options['section_title'] : esc_html__( 'Headphones & Virtual Reality', 'electro' ),
                'content'           => array(
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][0]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][0]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][0]['category_1_args'] ) ? $pcwbc_options['content'][0]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][0]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][0]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][0]['category_2_args'] ) ? $pcwbc_options['content'][0]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][0]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][0]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][0]['image'] ) && intval( $pcwbc_options['content'][0]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][0]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][0]['img_action_link'] ) ? $pcwbc_options['content'][0]['img_action_link'] : '#',
                    ),
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][1]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][1]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][1]['category_1_args'] ) ? $pcwbc_options['content'][1]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][1]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][1]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][1]['category_2_args'] ) ? $pcwbc_options['content'][1]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][1]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][1]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][1]['image'] ) && intval( $pcwbc_options['content'][1]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][1]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][1]['img_action_link'] ) ? $pcwbc_options['content'][1]['img_action_link'] : '#',
                    ),
                    array(
                        'enable_category_1' => isset( $pcwbc_options['content'][2]['enable_category_1'] ) ? filter_var( $pcwbc_options['content'][2]['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_1_args'   => isset( $pcwbc_options['content'][2]['category_1_args'] ) ? $pcwbc_options['content'][2]['category_1_args'] : array(  'number' => 5 ),
                        'enable_category_2' => isset( $pcwbc_options['content'][2]['enable_category_2'] ) ? filter_var( $pcwbc_options['content'][2]['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'category_2_args'   => isset( $pcwbc_options['content'][2]['category_2_args'] ) ? $pcwbc_options['content'][2]['category_2_args'] : array(  'number' => 5 ),
                        'enable_banner'     => isset( $pcwbc_options['content'][2]['enable_banner'] ) ? filter_var( $pcwbc_options['content'][2]['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false,
                        'image'             => isset( $pcwbc_options['content'][2]['image'] ) && intval( $pcwbc_options['content'][2]['image'] ) ? wp_get_attachment_image_src( $pcwbc_options['content'][2]['image'], 'full' ) : array( '//placehold.it/840x370', '840', '370' ),
                        'img_action_link'   => isset( $pcwbc_options['content'][2]['img_action_link'] ) ? $pcwbc_options['content'][2]['img_action_link'] : '#',
                    ),
                ),
                'carousel_args' => array(
                    'autoplay'          => isset( $pcwbc_options['carousel_args']['autoplay'] ) ? filter_var( $pcwbc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'items'             => 1,
                    'dots'              => isset( $pcwbc_options['carousel_args']['dots'] ) ? filter_var( $pcwbc_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'nav'               => isset( $pcwbc_options['carousel_args']['nav'] ) ? filter_var( $pcwbc_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'rtl'               => is_rtl() ? true : false,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                ),
            );

            electro_home_product_categories_with_banner_carousel( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v9_recent_viewed_products' ) ) {
    /**
    * Dispaly Recently Viewed Products in Home v9
    */
    function electro_home_v9_recent_viewed_products() {

        if ( is_woocommerce_activated() ) {

            global $electro_version;

            $viewed_products = electro_get_viewed_products();

            if ( empty( $viewed_products ) ) {
                return;
            }

            $home_v9 = electro_get_home_v9_meta();
            $rvp_options     = $home_v9['rvp'];

            $is_enabled = isset( $home_v9['rvp']['is_enabled'] ) ? $home_v9['rvp']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v9['rvp']['animation'] ) ? ' animated ' . $home_v9['rvp']['animation'] : '';

            $args = apply_filters( 'electro_home_v9_recent_viewed_products_args', array(
                'section_args'   => array(
                    'section_title'     => isset( $home_v9['rvp']['section_title'] ) ? $home_v9['rvp']['section_title'] : esc_html__( 'Your Recently Viewed Products', 'electro' ),
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
                    'dots'              => isset( $rvp_options['carousel_args']['dots'] ) ? filter_var( $rvp_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : false,
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