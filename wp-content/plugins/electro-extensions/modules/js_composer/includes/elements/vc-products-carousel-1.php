<?php
if ( ! function_exists( 'electro_vc_products_carousel_1_block' ) ) :

function electro_vc_products_carousel_1_block( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'title'                 => '',
        'button_text'           => '',
        'button_link'           => '',
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
        'items'                 => 4,
        'items_0'               => 2,
        'items_480'             => 2,
        'items_768'             => 2,
        'items_992'             => 3,
        'is_nav'                => false,
        'is_dots'               => false,
        'is_touchdrag'          => false,
        'margin'                => 0,
        'is_autoplay'           => false,
        'el_class'              => 'trending-products-carousel',
    ), $atts ) );

    $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
    $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $items, 'per_page' => $limit ) );

    $products_html = electro_do_shortcode( $shortcode_tag, $shortcode_atts );

    $args = apply_filters( 'electro_products_carousel_widget_args', array(
        'section_args'  => array(
            'products_html'     => $products_html, 
            'section_title'     => $title,
            'el_class'          => $el_class,
            'button_text'       => $button_text,
            'button_link'       => $button_link,
        ),
        'carousel_args' => array(
            'items'             => $items,
            'nav'               => $is_nav,
            'dots'              => $is_dots,
            'touchDrag'         => $is_touchdrag,
            'autoplay'          => $is_autoplay,
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
    if( function_exists( 'electro_products_carousel_v5' ) ) {
        ob_start();
        electro_products_carousel_v5( $args['section_args'], $args['carousel_args'] );
        $html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'electro_vc_products_carousel_1' , 'electro_vc_products_carousel_1_block' );

endif;
