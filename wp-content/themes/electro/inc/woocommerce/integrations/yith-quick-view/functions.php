<?php
/**
 * Functions, template tags and hooks related to YITH Quick View Compatibility
 */

if ( ! function_exists( 'ec_is_yith_wc_quick_view_enabled' ) ) {
    function ec_is_yith_wc_quick_view_enabled() {
        return function_exists( 'YITH_WCQV_Frontend' );
    }
}

if ( ec_is_yith_wc_quick_view_enabled() ) :

remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
add_action( 'woocommerce_shop_loop_item_title', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 45 );
add_action( 'electro_product_card_view_body', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 90 );

endif;