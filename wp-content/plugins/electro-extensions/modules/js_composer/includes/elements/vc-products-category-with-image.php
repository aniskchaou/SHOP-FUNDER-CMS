<?php
if ( ! function_exists( 'electro_vc_products_category_with_image_block' ) ) :

function electro_vc_products_category_with_image_block( $atts, $content = null ) {

    extract( shortcode_atts( array(
        'title'                 => '',
        'shortcode_tag'         => 'recent_products',
        'limit'                 => 10,
        'description'           => false,
        'orderby'               => 'date',
        'order'                 => 'desc',
        'per_page'              => 6,
        'columns'               => 6,
        'columns_wide'          => 6,
        'products_choice'       => 'ids',
        'product_id'            => '',
        'category'              => '',
        'cat_operator'          => 'IN',
        'attribute'             => '',
        'categories_title'      => '',
        'enable_categories'     => '',
        'cat_limit'             => '',
        'cat_has_no_products'   => '',
        'cat_orderby'           => '',
        'cat_order'             => '',
        'cat_include'           => '',
        'cat_slugs'             => '',
        'terms'                 => '',
        'terms_operator'        => 'IN',
        'image'                 => '',
        'img_action_link'       => '#',
        'el_class'              => '',
    ), $atts ) );

    $shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
    $shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'per_page' => $per_page, 'columns' => $columns ) );

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

    $args = apply_filters( 'electro_products_category_with_image_args', array(
        'shortcode_tag'     => $shortcode_tag,
        'shortcode_atts'    => $shortcode_atts,
        'section_title'     => $title,
        'description'       => $description,
        'enable_categories' => $enable_categories,
        'categories_title'  => $categories_title,
        'category_args'     => $category_args,
        'columns_wide'      => $columns_wide,
        'image'             => isset( $image ) && intval( $image ) ? wp_get_attachment_image_src( $image, 'full' ) : '',
        'img_action_link'   => $img_action_link,
        'section_class'     => $el_class,
    ) );

    $html = '';
    if( function_exists( 'electro_products_category_with_image' ) ) {
        ob_start();
        electro_products_category_with_image( $args );
        $html = ob_get_clean();
    }

    return $html;
}

add_shortcode( 'electro_vc_products_category_with_image' , 'electro_vc_products_category_with_image_block' );

endif;
