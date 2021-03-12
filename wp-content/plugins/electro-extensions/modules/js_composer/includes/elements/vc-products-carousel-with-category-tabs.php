<?php
if ( ! function_exists( 'electro_vc_products_carousel_with_category_tabs_block' ) ) :

function electro_vc_products_carousel_with_category_tabs_block( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'title'                 => '',
        'shortcode_tag'         => 'recent_products',
        'orderby'               => 'date',
        'order'                 => 'DESC',
        'per_page'              => 20,
        'columns'               => 3,
        'products_choice'       => 'ids',
        'product_id'            => '',
        'category'              => '',
        'cat_operator'          => 'IN',
        'attribute'             => '',
        'terms'                 => '',
        'terms_operator'        => 'IN',
        'enable_categories'     => '',
        'categories_title'      => '',
        'cat_limit'             => '',
        'cat_has_no_products'   => '',
        'cat_orderby'           => '',
        'cat_order'             => '',
        'cat_include'           => '',
        'cat_slugs'             => '',
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
        'nav_next'              => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        'nav_prev'              => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ), $atts ) );

    $shortcode_atts          = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
    $shortcode_atts          = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'per_page' => $per_page, 'columns' => $columns ) );

    $products_html = electro_do_shortcode( $shortcode_tag, $shortcode_atts );
    
    $category_args = array(
        'number'        => $cat_limit,
        'hide_empty'    => $cat_has_no_products,
        'orderby'       => $cat_orderby,
        'order'         => $cat_order,
    );
    
    if( ! empty( $cat_include ) ) {
        $cat_include = explode( ",", $cat_include );
        $category_args['include'] = $cat_include;
        $category_args['orderby'] = 'include';
    }

    if( ! empty( $cat_slugs ) ) {
        $cat_slugs = explode( ",", $cat_slugs );
        $category_args['slug'] = $cat_slugs;

        $cat_include = array();

        foreach ( $cat_slugs as $cat_slug ) {
            $cat_include[] = "'" . $cat_slug ."'";
        }

        if ( ! empty($cat_include ) ) {
            $category_args['include'] = $cat_include;
            $category_args['orderby'] = 'include';
        }
    }

    $args = apply_filters( 'electro_products_carousel_with_cat_tabs_args', array(
        'section_class'             => '',
        'section_title'             => $title,
        'enable_categories'         => $enable_categories,
        'categories_title'          => $categories_title,
        'category_args'             => $category_args,
        'shortcode_tag'             => $shortcode_tag,
        'shortcode_atts'            => $shortcode_atts,
        'section_args'              => array(
            'products_html'             => $products_html,
        ),
        'carousel_args' => array(
            'items'             => $items,
            'nav'               => $is_nav,
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
    if( function_exists( 'electro_home_v5_product_carousel' ) ) {
        ob_start();
        electro_home_v5_product_carousel( $args );
        $html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'electro_vc_products_carousel_with_category_tabs' , 'electro_vc_products_carousel_with_category_tabs_block' );

endif;