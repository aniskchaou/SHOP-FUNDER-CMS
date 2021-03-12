<?php
/**
 * Template functions hooked into the `homepage_v7` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v7_revslider' ) ) {
    /**
     * Displays Slider in Home v7
     */
    function electro_home_v7_revslider() {

        $home_v7   = electro_get_home_v7_meta();
        $vscwa     = $home_v7['vscwa'];

        $is_enabled = isset( $vscwa['is_enabled'] ) ? filter_var( $vscwa['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

        if ( ! $is_enabled ) {
            return;
        }

        $animation = isset( $vscwa['animation'] ) ? $vscwa['animation'] : '';
        $shortcode = !empty( $vscwa['slider_shortcode'] ) ? $vscwa['slider_shortcode'] : '[rev_slider alias="home-v7-slider"]';

        $section_class = 'home-v7-slider';
        if ( ! empty( $animation ) ) {
            $section_class = ' animate-in-view';
        }
        ?>
        <div class="<?php echo esc_attr( $section_class );?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
            <?php echo apply_filters( 'electro_home_v7_slider_html', do_shortcode( $shortcode ) ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v7_slider_with_vertical_menu_categories_banners' ) ) {
    /**
     *
     */
    function electro_home_v7_slider_with_vertical_menu_categories_banners() {

        $home_v7        = electro_get_home_v7_meta();
        $vscwa_options  = $home_v7['vscwa'];
        $nav_options    = $vscwa_options['nav'];
        $cat_options    = $vscwa_options['cat'];
        $ads_options    = $vscwa_options['ads'];

        $is_enabled = isset( $vscwa_options['is_enabled'] ) ? $vscwa_options['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = isset( $vscwa_options['animation'] ) ? $vscwa_options['animation'] : '';

        $nav_args = apply_filters( 'electro_home_v7_vertical_nav_menu_args', array(
            'animation'     => $animation,
            'is_enabled'        => isset( $nav_options['is_enabled'] ) ? $nav_options['is_enabled'] : 'yes',
            'menu_title'        => isset( $nav_options['menu_title'] ) ? $nav_options['menu_title'] : esc_html__( 'Departments', 'electro' ),
            'menu_action_text'  => isset( $nav_options['menu_action_text'] ) ? $nav_options['menu_action_text'] : esc_html__( 'View All', 'electro' ),
            'menu_action_link'  => isset( $nav_options['menu_action_link'] ) ? $nav_options['menu_action_link'] : '#',
            'menu'              => isset( $nav_options['menu'] ) ? $nav_options['menu'] : 'all-departments-menu'
        ) );

        $cat_args = apply_filters( 'electro_home_v7_slider_with_category_cat_args', array(
            'animation'     => $animation,
            'is_enabled'    => isset( $cat_options['is_enabled'] ) ? $cat_options['is_enabled'] : 'yes',
            'columns'       => isset( $cat_options['columns'] ) ? $cat_options['columns'] :'5',
            'category_args'    => array(
                'number'        => isset( $cat_options['number'] ) ? $cat_options['number'] :'5',
                'slugs'         => isset( $cat_options['slug'] ) ? $cat_options['slug'] :'',
                'hide_empty'    => isset( $cat_options['hide_empty'] ) ? filter_var( $cat_options['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
            )
        ) );
        $cat_args['category_args'] = electro_get_atts_for_taxonomy_slugs( $cat_args['category_args'] );

        $ads_args = apply_filters( 'electro_home_v7_slider_with_category_ads_args', array(
            'animation'     => $animation,
            'is_enabled'    => isset( $ads_options['is_enabled'] ) ? $ads_options['is_enabled'] : 'yes',
            'ads'          => array(
                array(
                    'ad_text'       => isset( $ads_options[0]['ad_text'] ) ? $ads_options[0]['ad_text'] : wp_kses_post( __( 'Catch Big <strong>Deals</strong> on<br>The Consoles', 'electro' ) ),
                    'action_text'   => isset( $ads_options[0]['action_text'] ) ? $ads_options[0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => isset( $ads_options[0]['action_link'] ) ? $ads_options[0]['action_link'] : '#',
                    'ad_image'      => isset( $ads_options[0]['ad_image'] ) ? wp_get_attachment_url( $ads_options[0]['ad_image'] ) : '',
                    'el_class'      => isset( $ads_options[0]['el_class'] ) ? $ads_options[0]['el_class'] : '',
                    'ad_image_attachment' => isset( $ads_options[0]['ad_image'] ) ? wp_get_attachment_image( $ads_options[0]['ad_image'] ) : '',
                ),
                array(
                    'ad_text'       => isset( $ads_options[1]['ad_text'] ) ? $ads_options[1]['ad_text'] : wp_kses_post( __( 'Shop the <strong>Hottest</strong><br>Products', 'electro' ) ),
                    'action_text'   => isset( $ads_options[1]['action_text'] ) ? $ads_options[1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => isset( $ads_options[1]['action_link'] ) ? $ads_options[1]['action_link'] : '#',
                    'ad_image'      => isset( $ads_options[1]['ad_image'] ) ? wp_get_attachment_url( $ads_options[1]['ad_image'] ) : '',
                    'el_class'      => isset( $ads_options[1]['el_class'] ) ? $ads_options[1]['el_class'] : '',
                    'ad_image_attachment' => isset( $ads_options[1]['ad_image'] ) ? wp_get_attachment_image( $ads_options[1]['ad_image'] ) : '',
                ),
                array(
                    'ad_text'       => isset( $ads_options[2]['ad_text'] ) ? $ads_options[2]['ad_text'] : wp_kses_post( __( 'Laptops Notebooks<br> <strong>and More</strong>', 'electro' ) ),
                    'action_text'   => isset( $ads_options[2]['action_text'] ) ? $ads_options[2]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    'action_link'   => isset( $ads_options[2]['action_link'] ) ? $ads_options[2]['action_link'] : '#',
                    'ad_image'      => isset( $ads_options[2]['ad_image'] ) ? wp_get_attachment_url( $ads_options[2]['ad_image'] ) : '',
                    'el_class'      => isset( $ads_options[2]['el_class'] ) ? $ads_options[2]['el_class'] : '',
                    'ad_image_attachment' => isset( $ads_options[2]['ad_image'] ) ? wp_get_attachment_image( $ads_options[2]['ad_image'] ) : '',
                ),
            )
        ) );

        $nav_is_enabled              = isset ( $nav_options['is_enabled'] ) ? $nav_options['is_enabled'] : 'no';
        $slider_cat_section_class   = $nav_is_enabled !== 'yes' ? 'slider-with-catogory' : 'slider-with-catogory';
        $cat_is_enabled              = isset ( $cat_options['is_enabled'] ) ? $cat_options['is_enabled'] : 'no';
        $das_is_enabled              = isset ( $ads_options['is_enabled'] ) ? $ads_options['is_enabled'] : 'no';

        ?>
        <div class="vertical-menu-slider-category-with-das">
            <div class="container">
                <div class="vertical-menu-slider-category-with-das-inner">

                    <?php if( $nav_is_enabled === 'yes' ) :
                        electro_home_vertical_nav( $nav_args );
                    endif; ?>

                    <div class=" <?php echo esc_attr( $slider_cat_section_class ); ?>">
                        <?php electro_home_v7_revslider();

                        if( $cat_is_enabled === 'yes' ) :
                            electro_product_categories_list( $cat_args );
                        endif; ?>
                    </div>

                    <?php if( $das_is_enabled === 'yes' ) : ?>

                    <div class="slider-das-block">
                        <?php electro_ads_block( $ads_args['ads'] ); ?>
                    </div>

                    <?php endif; ?>
                </div>
            </div>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v7_products_carousel_with_timer' ) ) {
    /**
    * Displays Products Carousel with Timer
    */
    function electro_home_v7_products_carousel_with_timer() {
        if ( is_woocommerce_activated() ) {

            $home_v7 = electro_get_home_v7_meta();
            $pcwt_options     = $home_v7['pcwt'];

            $is_enabled = isset( $home_v7['pcwt']['is_enabled'] ) ? $home_v7['pcwt']['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation = !empty( $home_v7['pcwt']['animation'] ) ? ' animated ' . $home_v7['pcwt']['animation'] : '';

            $args = apply_filters( 'electro_home_5_products_carousel_args', array(
                'limit'             => isset( $home_v7['pcwt']['product_limit'] ) ? intval( $home_v7['pcwt']['product_limit'] ) : 20,
                'columns'           => isset( $home_v7['pcwt']['product_columns'] ) ? intval( $home_v7['pcwt']['product_columns'] ) : 7,
                'section_args'   => array(
                    'section_title'     => isset( $home_v7['pcwt']['section_title'] ) ? $home_v7['pcwt']['section_title'] : esc_html__( 'Deals of The Day', 'electro' ),
                    'timer_title'       => isset( $home_v7['pcwt']['timer_title'] ) ? $home_v7['pcwt']['timer_title'] : esc_html__( 'Ends in:', 'electro' ),
                    'header_timer'      => isset( $home_v7['pcwt']['header_timer'] ) ? filter_var( $home_v7['pcwt']['header_timer'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'timer_value'       => isset( $home_v7['pcwt']['timer_value'] ) ? $home_v7['pcwt']['timer_value'] : '',
                    'button_text'       => isset( $home_v7['pcwt']['button_text'] ) ? $home_v7['pcwt']['button_text'] : wp_kses_post( __( 'Go to Daily Deals Section', 'electro' ) ),
                    'button_link'       => isset( $home_v7['pcwt']['button_link'] ) ? $home_v7['pcwt']['button_link'] : '#',
                    'section_class'     => 'section-products-carousel products-carousel-with-timer',
                    'animation'         => $animation
                ),
                'carousel_args' => array(
                    'items'             => isset( $pcwt_options['product_columns'] ) ? intval( $pcwt_options['product_columns'] ) : 7,
                    'dots'              => isset( $pcwt_options['carousel_args']['dots'] ) ? filter_var( $pcwt_options['carousel_args']['dots'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'nav'               => isset( $pcwt_options['carousel_args']['nav'] ) ? filter_var( $pcwt_options['carousel_args']['nav'], FILTER_VALIDATE_BOOLEAN ) : true,
                    'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
                    'autoplay'          => isset( $pcwt_options['carousel_args']['autoplay'] ) ? filter_var( $pcwt_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'responsive'        => array(
                        '0'     => array( 'items' => 2 ),
                        '576'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 4 ),
                        '992'   => array( 'items' => 5 ),
                        '1200'  => array( 'items' => isset( $pcwt_options['product_columns'] ) ? intval( $pcwt_options['product_columns'] ) : 7 )
                    )
                ),
                'limit'     => isset( $home_v7['pcwt']['product_limit'] ) ? $home_v7['pcwt']['product_limit'] : 20,
                'columns'   => isset( $home_v7['pcwt']['product_columns'] ) ? $home_v7['pcwt']['product_columns'] : 7,
            ) );

            if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pcwt_options['carousel_args']['responsive'] ) ) {
                $responsive_args = array();
                foreach ( $pcwt_options['carousel_args']['responsive'] as $key => $responsive ) {
                    if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
                        $responsive_args[$key]['items'] = intval( $responsive['items'] );
                    } elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
                        $responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
                    } else {
                        $responsive_args[$key]['items'] = $pcwt_options['product_columns'];
                    }
                }
                $args['carousel_args']['responsive'] = $responsive_args;
            }

            $default_atts   = array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
            $atts           = electro_get_atts_for_shortcode( $pcwt_options['content'] );
            $atts           = wp_parse_args( $atts, $default_atts );
            $products       = electro_do_shortcode( $pcwt_options['content']['shortcode'], $atts );

            $args['section_args']['products_html'] = $products;

            electro_products_carousel_with_timer( $args['section_args'], $args['carousel_args'] );
        }
    }
}

if ( ! function_exists( 'electro_home_v7_ad_banner' ) ) {
    /**
     * Displays a banner in home v7
     */
    function electro_home_v7_ad_banner() {

        $home_v7 = electro_get_home_v7_meta();

        $is_enabled = isset( $home_v7['bd']['is_enabled'] ) ? $home_v7['bd']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = ! empty( $home_v7['bd']['animation'] ) ? $home_v7['bd']['animation'] : '';

        $args = apply_filters( 'electro_home_v7_ad_banner_args', array(
            'img_src'   => ( isset( $home_v7['bd']['image'] ) && $home_v7['bd']['image'] != 0 ) ? wp_get_attachment_url( $home_v7['bd']['image'] ) : 'http://placehold.it/1401x124',
            'el_class'  => '',
            'link'      => isset( $home_v7['bd']['link'] ) ? $home_v7['bd']['link'] : '#',
        ) );

        ob_start();

        electro_fullbanner_ad( $args );

        $banner_html = ob_get_clean();

        $section_class = 'home-v7-banner-block';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $banner_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v7_products_with_category_image' ) ) {
    /**
     *
     */
    function electro_home_v7_products_with_category_image() {

        if ( is_woocommerce_activated() ) {
            $home_v7    = electro_get_home_v7_meta();
            $pwci_options = isset( $home_v7['pwci'] ) ? $home_v7['pwci'] : '';

            $is_enabled = isset( $pwci_options['is_enabled'] ) ? $pwci_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pwci_options['animation'] ) ? $pwci_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pwci_options['section_title'] ) ? $pwci_options['section_title'] : esc_html__( 'Popular Categories this Week', 'electro' ),
                'enable_categories' => isset( $pwci_options['enable_categories'] ) ? filter_var( $pwci_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $pwci_options['categories_title'] ) ? $pwci_options['categories_title'] : esc_html__( 'Top 20', 'electro' ),
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
                'shortcode_tag'     => isset( $pwci_options['content']['shortcode'] ) ? $pwci_options['content']['shortcode'] : 'recent_products',
                'shortcode_atts'    => isset( $pwci_options['content'] ) ? electro_get_atts_for_shortcode( $pwci_options['content'] ) : array( 'per_page' => 8, 'columns' => 4 ),
                'image'             => isset( $pwci_options['image'] ) && intval( $pwci_options['image'] ) ? wp_get_attachment_image_src( $pwci_options['image'], array( '370', '630' ) ) : array( '//placehold.it/370x630', '370', '630' ),
                'img_action_link'   => isset( $pwci_options['img_action_link'] ) ? $pwci_options['img_action_link'] : '#',
            );

            electro_products_with_category_image( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v7_two_banners' ) ) {
    /**
     *
     */
    function electro_home_v7_two_banners() {

        $home_v7 = electro_get_home_v7_meta();

        $is_enabled = isset( $home_v7['tbrs']['is_enabled'] ) ? $home_v7['tbrs']['is_enabled'] : 'no';

        if ( $is_enabled !== 'yes' ) {
            return;
        }

        $animation = !empty( $home_v7['tbrs']['animation'] ) ? ' animated ' . $home_v7['tbrs']['animation'] : '';

        $args = apply_filters( 'electro_home_v7_two_banners_args', array(
            array(
                'image'         => isset( $home_v7['tbrs'][0]['image'] ) && $home_v7['tbrs'][0]['image'] ? wp_get_attachment_url( $home_v7['tbrs'][0]['image'] ) : 'http://placehold.it/690x151',
                'action_link'   => isset( $home_v7['tbrs'][0]['action_link'] ) ? $home_v7['tbrs'][0]['action_link'] : '#',
                'el_class'      => isset( $home_v7['tbrs'][0]['el_class'] ) ? $home_v7['tbrs'][0]['el_class'] : '',
            ),
            array(
                'image'         => isset( $home_v7['tbrs'][1]['image'] ) && $home_v7['tbrs'][1]['image'] ? wp_get_attachment_url( $home_v7['tbrs'][1]['image'] ) : 'http://placehold.it/690x151',
                'action_link'   => isset( $home_v7['tbrs'][1]['action_link'] ) ? $home_v7['tbrs'][1]['action_link'] : '#',
                'el_class'      => isset( $home_v7['tbrs'][1]['el_class'] ) ? $home_v7['tbrs'][1]['el_class'] : '',
            ),
        ) );

        ob_start();

        electro_two_banners( $args );

        $ads_html = ob_get_clean();

        $section_class  = 'home-v7-da-block home-two-banners';

        if ( ! empty( $animation ) ) {
            $section_class .= ' animate-in-view';
        }
        ?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
            <?php echo wp_kses_post( $ads_html ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_home_v7_products_category_width_image_1' ) ) {
    /**
     *
     */
    function electro_home_v7_products_category_width_image_1() {

        if ( is_woocommerce_activated() ) {
            $home_v7    = electro_get_home_v7_meta();
            $pcwi_options = isset( $home_v7['pcwi1'] ) ? $home_v7['pcwi1'] : '';

            $is_enabled = isset( $pcwi_options['is_enabled'] ) ? $pcwi_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pcwi_options['animation'] ) ? $pcwi_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pcwi_options['section_title'] ) ? $pcwi_options['section_title'] : esc_html__( 'Headphones', 'electro' ),
                'enable_categories' => isset( $pcwi_options['enable_categories'] ) ? filter_var( $pcwi_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $pcwi_options['categories_title'] ) ? $pcwi_options['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $pcwi_options['category_args']['orderby'] ) ? $pcwi_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $pcwi_options['category_args']['order'] ) ? $pcwi_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pcwi_options['category_args']['hide_empty'] ) ? filter_var( $pcwi_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pcwi_options['category_args']['number'] ) ? $pcwi_options['category_args']['number'] : 4,
                    'slugs'             => isset( $pcwi_options['category_args']['slugs'] ) ? $pcwi_options['category_args']['slugs'] : '',
                ),
                'image'             => isset( $pcwi_options['image'] ) && intval( $pcwi_options['image'] ) ? wp_get_attachment_image_src( $pcwi_options['image'], array( '201', '277' ) ) : array( '//placehold.it/201x277', '201', '277' ),
                'img_action_link'   => isset( $pcwi_options['img_action_link'] ) ? $pcwi_options['img_action_link'] : '#',
                'columns_wide'      => isset( $pcwi_options['product_columns_wide'] ) ? $pcwi_options['product_columns_wide'] : 6,
                'shortcode_tag'     => isset( $pcwi_options['content']['shortcode'] ) ? $pcwi_options['content']['shortcode'] : 'recent_products',
                'shortcode_atts'    => isset( $pcwi_options['content'] ) ? electro_get_atts_for_shortcode( $pcwi_options['content'] ) : array( 'per_page' => 6, 'columns' => 6 ),
            );

            electro_products_category_with_image( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v7_products_category_width_image_2' ) ) {
    /**
     *
     */
    function electro_home_v7_products_category_width_image_2() {

        if ( is_woocommerce_activated() ) {
            $home_v7    = electro_get_home_v7_meta();
            $pcwi_options = isset( $home_v7['pcwi2'] ) ? $home_v7['pcwi2'] : '';

            $is_enabled = isset( $pcwi_options['is_enabled'] ) ? $pcwi_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $pcwi_options['animation'] ) ? $pcwi_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $pcwi_options['section_title'] ) ? $pcwi_options['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                'enable_categories' => isset( $pcwi_options['enable_categories'] ) ? filter_var( $pcwi_options['enable_categories'], FILTER_VALIDATE_BOOLEAN ) : false,
                'categories_title'  => isset( $pcwi_options['categories_title'] ) ? $pcwi_options['categories_title'] : esc_html__( 'Featured Phones', 'electro' ),
                'category_args'     => array(
                    'orderby'           => isset( $pcwi_options['category_args']['orderby'] ) ? $pcwi_options['category_args']['orderby'] : 'name',
                    'order'             => isset( $pcwi_options['category_args']['order'] ) ? $pcwi_options['category_args']['order'] : 'ASC',
                    'hide_empty'        => isset( $pcwi_options['category_args']['hide_empty'] ) ? filter_var( $pcwi_options['category_args']['hide_empty'], FILTER_VALIDATE_BOOLEAN ) : false,
                    'number'            => isset( $pcwi_options['category_args']['number'] ) ? $pcwi_options['category_args']['number'] : 4,
                    'slugs'             => isset( $pcwi_options['category_args']['slugs'] ) ? $pcwi_options['category_args']['slugs'] : '',
                ),
                'image'             => isset( $pcwi_options['image'] ) && intval( $pcwi_options['image'] ) ? wp_get_attachment_image_src( $pcwi_options['image'], array( '201', '277' ) ) : array( '//placehold.it/201x277', '201', '277' ),
                'img_action_link'   => isset( $pcwi_options['img_action_link'] ) ? $pcwi_options['img_action_link'] : '#',
                'columns_wide'      => isset( $pcwi_options['product_columns_wide'] ) ? $pcwi_options['product_columns_wide'] : 6,
                'shortcode_tag'     => isset( $pcwi_options['content']['shortcode'] ) ? $pcwi_options['content']['shortcode'] : 'recent_products',
                'shortcode_atts'    => isset( $pcwi_options['content'] ) ? electro_get_atts_for_shortcode( $pcwi_options['content'] ) : array( 'per_page' => 6, 'columns' => 6 ),
            );

            electro_products_category_with_image( $args );
        }
    }
}

if ( ! function_exists( 'electro_home_v7_ads_with_banners' ) ) {
    /**
     * Display Ads and Banners
     */
    function electro_home_v7_ads_with_banners() {

        $home_v7    = electro_get_home_v7_meta();
        $awb_options     = $home_v7['awb'];
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
                    'title'                 => isset( $awb_options['ads_banners'][0]['title'] ) ? $awb_options['ads_banners'][0]['title'] : wp_kses_post( __( 'G9 Laptops with<br>Ultra 4K HD Display', 'electro' ) ),
                    'description'           => isset( $awb_options['ads_banners'][0]['description'] ) ? $awb_options['ads_banners'][0]['description'] : wp_kses_post( __( 'and the fastest Intel Core i7 processor ever', 'electro' ) ),
                    'price'                 => isset( $awb_options['ads_banners'][0]['price'] ) ? $awb_options['ads_banners'][0]['price'] : wp_kses_post( __( '<span class="prefix">from</span><span class="value"><sup>$</sup>399</span>', 'electro' ) ),
                    'action_link'           => isset( $awb_options['ads_banners'][0]['action_link'] ) ? $awb_options['ads_banners'][0]['action_link'] : '#',
                    'banner_action_link'    => isset( $awb_options['ads_banners'][0]['banner_action_link'] ) ? $awb_options['ads_banners'][0]['banner_action_link'] : '#',
                    'image'                 => isset( $awb_options['ads_banners'][0]['image'] ) && intval( $awb_options['ads_banners'][0]['image'] ) ? wp_get_attachment_image_src( $awb_options['ads_banners'][0]['image'], array( '380', '260' ) ) : array( '//placehold.it/380x260', '380', '260' ),
                    'banner_image'          => isset( $awb_options['ads_banners'][0]['banner_image'] ) && intval( $awb_options['ads_banners'][0]['banner_image'] ) ? wp_get_attachment_image_src( $awb_options['ads_banners'][0]['banner_image'], array( '380', '260' ) ) : array( '//placehold.it/380x260', '380', '260' ),
                    'is_align_end'          => isset( $awb_options['ads_banners'][0]['is_align_end'] ) ? filter_var( $awb_options['ads_banners'][0]['is_align_end'], FILTER_VALIDATE_BOOLEAN ) : false,
                ),
            )
        );

        $args = apply_filters( 'electro_home_v7_ads_with_banners_args', $args );
        electro_ads_with_banners( $args );
    }
}

if ( ! function_exists( 'electro_home_v7_two_row_products' ) ) {
    /**
     *
     */
    function electro_home_v7_two_row_products() {

        if ( is_woocommerce_activated() ) {
            $home_v7    = electro_get_home_v7_meta();
            $trp_options = isset( $home_v7['trp'] ) ? $home_v7['trp'] : '';

            $is_enabled = isset( $trp_options['is_enabled'] ) ? $trp_options['is_enabled'] : 'no';

            if ( $is_enabled !== 'yes' ) {
                return;
            }

            $animation  = isset( $trp_options['animation'] ) ? $trp_options['animation'] : '';

            $args = array(
                'section_class'     => '',
                'animation'         => $animation,
                'section_title'     => isset( $trp_options['section_title'] ) ? $trp_options['section_title'] : esc_html__( 'Recommendation For You', 'electro' ),
                'button_text'       => isset( $trp_options['button_text'] ) ? $trp_options['button_text'] : wp_kses_post( __( 'View All Recommendations', 'electro' ) ),
                'button_link'       => isset( $trp_options['button_link'] ) ? $trp_options['button_link'] : '#',
                'columns_wide'      => isset( $trp_options['product_columns_wide'] ) ? $trp_options['product_columns_wide'] : 6,
                'shortcode_tag'     => isset( $trp_options['content']['shortcode'] ) ? $trp_options['content']['shortcode'] : 'sale_products',
                'shortcode_atts'    => isset( $trp_options['content'] ) ? electro_get_atts_for_shortcode( $trp_options['content'] ) : array( 'per_page' => 12, 'columns' => 6 ),
            );

            electro_two_row_products( $args );
        }
    }
}
