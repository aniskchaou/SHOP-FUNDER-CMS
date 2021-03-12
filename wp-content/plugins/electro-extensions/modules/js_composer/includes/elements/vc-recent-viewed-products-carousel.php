<?php
if ( ! function_exists( 'electro_vc_recent_viewed_products_carousel_block' ) ) :

function electro_vc_recent_viewed_products_carousel_block( $atts, $content = null ) {
    if ( is_woocommerce_activated() ) {

        extract( shortcode_atts( array(
            'title'                 => '',
            'limit'                 => 10,
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
            'el_class'              => 'recently-viewed-products-carousel',
        ), $atts ) );

        global $electro_version;

        $viewed_products = electro_get_viewed_products();

        if ( empty( $viewed_products ) ) {
            return;
        }

        $args = apply_filters( 'electro_products_carousel_widget_args', array(
            'section_args'  => array(
                'section_title'     => $title,
                'section_class'     => $el_class,
            ),
            'shortcode_atts'    => array(
                'columns'       => $items,
                'per_page'      => 20,
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

        $shortcode_atts = wp_parse_args( array( 'ids' => implode(',', $viewed_products ) ), $args['shortcode_atts'] );

        $products       = electro_do_shortcode( 'products',  $shortcode_atts );

        $args['section_args']['products_html'] = $products;

        $html = '';
        if( function_exists( 'electro_recent_viewed_products_carousel' ) ) {
            ob_start();
            electro_recent_viewed_products_carousel( $args['section_args'], $args['carousel_args'] );
            $html = ob_get_clean();
        }

        return $html;
    }
}

add_shortcode( 'electro_vc_recent_viewed_products_carousel' , 'electro_vc_recent_viewed_products_carousel_block' );

endif;
