<?php
if ( ! function_exists( 'electro_vc_deal_products_with_featured' ) ) :

function electro_vc_deal_products_with_featured( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'title'                 => '',
        'shortcode_tag'         => 'sale_products',
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
        'header_timer'          => true
    ), $atts ) );

    $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
    $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'per_page' => $limit) );

    $products_html = electro_do_shortcode( $shortcode_tag, $shortcode_atts );

    $args = apply_filters( 'electro_vc_deal_products_with_featured_args', array(
        'section_title'     => $title,
        'timer_title'       => $timer_title,
        'header_timer'      => $header_timer,
        'timer_value'       => $timer_value,
        'shortcode_tag'     => $shortcode_tag,
        'shortcode_atts'    => $shortcode_atts,
        'timer_title'       => $timer_title
    ) );

    $html = '';
    if( function_exists( 'electro_deal_products_with_featured' ) ) {
        ob_start();
        electro_deal_products_with_featured( $args );
        $html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'electro_vc_mobile_deal_products_with_featured' , 'electro_vc_deal_products_with_featured' );

endif;