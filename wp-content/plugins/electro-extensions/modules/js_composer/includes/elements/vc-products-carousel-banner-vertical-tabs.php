<?php
if ( ! function_exists( 'electro_vc_products_carousel_banner_vertical_tabs_block' ) ) :

function electro_vc_products_carousel_banner_vertical_tabs_block( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'bg_img'                => '',
        'tabs'                  => array(),
        'shortcode_tag'         => 'recent_products',
        'limit'                 => 20,
        'orderby'               => 'date',
        'order'                 => 'desc',
        'products_choice'       => 'ids',
        'product_id'            => '',
        'category'              => '',
        'cat_operator'          => 'IN',
        'attribute'             => '',
        'terms'                 => '',
        'terms_operator'        => 'IN',
        'items'                 => 7,
        'items_0'               => 2,
        'items_480'             => 3,
        'items_768'             => 3,
        'items_992'             => 4,
        'items_1200'            => 5,
        'is_nav'                => false,
        'is_dots'               => false,
        'is_touchdrag'          => false,
        'is_autoplay'           => false,
    ), $atts ) );


    $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ): array();
    $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $items, 'per_page' => $limit ) );

    $products_html = electro_do_shortcode( $shortcode_tag, $shortcode_atts );

    $bg_img_att = isset( $bg_img ) && intval( $bg_img ) ? wp_get_attachment_image_src( $bg_img, 'full' ) : '';

    $section_args = array(
        'section_class'     => 'section-products-carousel',
        'carousel_id'       => 'products-carousel-' . uniqid(),
        'products_html'     => $products_html,
        'bg_img'            => isset( $bg_img_att[0] ) ? $bg_img_att[0] : '',
        'el_class'          => isset( $el_class ) ? $el_class : '',
    );

    if( is_object( $tabs ) || is_array( $tabs ) ) {
        $tabs = json_decode( json_encode( $tabs ), true );
    } else {
        $tabs = json_decode( urldecode( $tabs ), true );
    }

    $tabs_args = array();

    if( is_array( $tabs ) ) {
        foreach ( $tabs as $key => $tab ) {
            extract( $tab );

            $image_att = isset( $banner_image ) && intval( $banner_image ) ? wp_get_attachment_image_src( $banner_image, 'full' ) : '';

            $tabs_args[] = array(
                'title'              => isset( $title ) ? $title : '',
                'tab_title'          => isset( $tab_title ) ? $tab_title : '',
                'tab_sub_title'      => isset( $tab_sub_title ) ? $tab_sub_title : '',
                'image'              => isset( $image_att[0] ) ? $image_att[0] : '',
                'action_text'        => isset( $action_text ) ? $action_text : '',
                'action_link'        => isset( $action_link ) ? $action_link : '',
            );
        }
    }

    $args = array(
        'section_args'      => $section_args,
        'tabs_args'         => $tabs_args,
        'carousel_args'     => array(
            'items'             => $items,
            'nav'               => $is_nav,
            'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
            'dots'              => isset( $is_dots) ? filter_var( $is_dots, FILTER_VALIDATE_BOOLEAN): '',
            'touchDrag'         => isset( $is_touchdrag) ? filter_var( $is_touchdrag, FILTER_VALIDATE_BOOLEAN): '',
            'autoplay'          => isset( $is_autoplay) ? filter_var( $is_autoplay, FILTER_VALIDATE_BOOLEAN): '',
            'responsive'        => array(
                '0'     => array( 'items'   => $items_0 ),
                '480'   => array( 'items'   => $items_480 ),
                '768'   => array( 'items'   => $items_768 ),
                '992'   => array( 'items'   => $items_992 ),
                '1200'  => array( 'items'   => $items_1200 ),
                '1430'  => array( 'items'   => $items ),
            )
        )
    );

    $html = '';
    if( function_exists( 'products_carousel_banner_vertical_tabs' ) ) {
        ob_start();
        products_carousel_banner_vertical_tabs( $args );
        $html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'electro_vc_products_carousel_banner_vertical_tabs' , 'electro_vc_products_carousel_banner_vertical_tabs_block' );

endif;
