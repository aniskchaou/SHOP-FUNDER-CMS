<?php
/**
 * Compatibility functions for Prdctfltr plugin
 */
add_filter( 'prdctfltr_localize_javascript', 'ec_prdctfltr_set_wrapper', 10 );

function ec_prdctfltr_set_wrapper( $args ) {
    $args['ajax_class'] = 'ul.products';
    return $args;
}

remove_action( 'electro_shop_control_bar', 'woocommerce_catalog_ordering', 20 );
remove_action( 'electro_shop_control_bar', 'electro_wc_products_per_page', 30 );
remove_action( 'electro_shop_control_bar', 'electro_advanced_pagination',  40 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 12 );