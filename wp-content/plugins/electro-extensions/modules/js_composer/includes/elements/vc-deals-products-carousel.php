<?php
if ( ! function_exists( 'electro_vc_deal_products_carousel_block' ) ) :

function electro_vc_deal_products_carousel_block( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'title'                 => '',
        'shortcode_tag'         => 'recent_products',
        'limit'                 => 10,
        'orderby'               => 'date',
        'order'                 => 'desc',
        'products_choice'       => 'ids',
        'product_id'            => '',
        'category'              => '',
        'cat_operator'          => 'IN',
        'attribute'             => '',
        'terms'                 => '',
        'terms_operator'        => 'IN',
        'timer_title'           => '',
        'timer_value'           => '',
        'header_timer'          => '',
        'deal_percentage'       => '',
        'show_custom_nav'       => false,
        'items'                 => 4,
        'items_0'               => 2,
        'items_480'             => 2,
        'items_768'             => 2,
        'items_992'             => 3,
        'is_nav'                => false,
        'nav_next'              => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        'nav_prev'              => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        'is_dots'               => false,
        'is_touchdrag'          => false,
        'margin'                => 0,
        'is_autoplay'           => false,
    ), $atts ) );

    $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
    $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $items, 'per_page' => $limit ) );

    $products_html = electro_do_shortcode( $shortcode_tag, $shortcode_atts );

    $args = apply_filters( 'electro_deal_products_carousel_widget_args', array(
        'section_title'     => $title,
        'timer_title'       => $timer_title,
        'header_timer'      => $header_timer,
        'deal_percentage'   => $deal_percentage,
        'timer_value'       => $timer_value,
        'section_args'  => array(
            'products_html'     => $products_html,
        ),
        'carousel_args' => array(
            'items'             => $items,
            'nav'               => $is_nav,
            'navText'           => array( $nav_next, $nav_prev ),
            'dots'              => $is_dots,
            'touchDrag'         => $is_touchdrag,
            'autoplay'          => $is_autoplay,
            'navText'           => array( $nav_next, $nav_prev ),
            'margin'            => intval( $margin ),
            'responsive'        => array(
                '0'     => array( 'items'   => $items_0 ),
                '480'   => array( 'items'   => $items_480 ),
                '768'   => array( 'items'   => $items_768 ),
                '992'   => array( 'items'   => $items_992 ),
                '1200'  => array( 'items'   => $items ),
            )
        )
    ) );

    $html = '';
    if( function_exists( 'electro_products_carousel_with_deal' ) ) {
        ob_start();
        electro_products_carousel_with_deal( $args );
        $html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'electro_vc_deal_products_carousel' , 'electro_vc_deal_products_carousel_block' );

endif;
