<?php
if ( ! function_exists( 'electro_vc_products_list_block' ) ) :

function electro_vc_products_list_block( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'title'                 => '',
        'type'                  => '',
        'action_text'           => '',
        'action_link'           => '',
        'shortcode_tag'         => 'recent_products',
        'orderby'               => 'date',
        'order'                 => 'DESC',
        'per_page'              => '',
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

    $args = apply_filters( 'electro_vc_products_list_block_args', array(
        'section_class'             => '',
        'section_title'             => $title,
        'type'                      => $type,
        'action_text'               => $action_text,
        'action_link'               => $action_link,
        'enable_categories'         => $enable_categories,
        'categories_title'          => $categories_title,
        'category_args'             => $category_args,
        'shortcode_tag'             => $shortcode_tag,
        'shortcode_atts'            => $shortcode_atts,
    ) );

    $html = '';
    if( function_exists( 'electro_products_list_block' ) ) {
        ob_start();
        electro_products_list_block( $args );
        $html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'electro_vc_products_list' , 'electro_vc_products_list_block' );

endif;