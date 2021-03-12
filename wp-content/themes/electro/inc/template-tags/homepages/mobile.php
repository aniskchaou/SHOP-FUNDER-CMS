<?php
if ( ! function_exists( 'electro_products_1_2_block' ) ) {
    /**
     *
     */
    function electro_products_1_2_block( $args ) {
        if ( is_woocommerce_activated() ) {
            $defaults = array(
                'section_title'         => '',
                'section_class'         => '',
                'enable_categories'     => false,
                'categories_title'      => '',
                'category_args'         => array(),
                'shortcode_tag'         => '',
                'shortcode_atts'        => array(),
                'animation'             => '',
                'action_text'           => '',
                'action_link'           => '#',
            );
            $args   = wp_parse_args( $args, $defaults );
            if( $args['enable_categories'] ) {
                $cat_args = electro_get_atts_for_taxonomy_slugs( $args['category_args'] );
                $categories = get_terms( 'product_cat',  $cat_args );
                $args['categories'] = $categories;
            }
            electro_get_template( 'homepage/products-1-2-block.php', $args );
        }
    }
}
if ( ! function_exists( 'electro_products_list_block' ) ) {
    /**
     *
     */
    function electro_products_list_block( $args ) {
        if ( is_woocommerce_activated() ) {
            $defaults = array(
                'type'                  => '',
                'section_title'         => '',
                'section_class'         => '',
                'enable_categories'     => true,
                'categories_title'      => '',
                'category_args'         => array(),
                'shortcode_tag'         => '',
                'shortcode_atts'        => array(),
                'animation'             => '',
                'action_text'           => '',
                'action_link'           => '#',
            );
            $args   = wp_parse_args( $args, $defaults );
            if( $args['enable_categories'] ) {
                $cat_args = electro_get_atts_for_taxonomy_slugs( $args['category_args'] );
                $categories = get_terms( 'product_cat',  $cat_args );
                $args['categories'] = $categories;
            }
            electro_get_template( 'homepage/products-list-block.php', $args );
        }
    }
}
if ( ! function_exists( 'electro_deal_products_block' ) ) {
    /**
     *
     */
    function electro_deal_products_block( $args ) {
        if ( is_woocommerce_activated() ) {
            $defaults = array(
                'section_title'         => '',
                'section_class'         => '',
                'enable_categories'     => false,
                'categories_title'      => '',
                'category_args'         => array(),
                'shortcode_tag'         => '',
                'shortcode_atts'        => array(),
                'animation'             => '',
                'action_text'           => '',
                'action_link'           => '#',
            );
            $args   = wp_parse_args( $args, $defaults );
            if( $args['enable_categories'] ) {
                $cat_args = electro_get_atts_for_taxonomy_slugs( $args['category_args'] );
                $categories = get_terms( 'product_cat',  $cat_args );
                $args['categories'] = $categories;
            }
            electro_get_template( 'homepage/deal-products-block.php', $args );
        }
    }
}