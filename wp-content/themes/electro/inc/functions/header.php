<?php
/**
 * Functions used in header
 *
 * @since 2.0
 */
if ( ! function_exists( 'electro_remove_new_header_v1_functions' ) ) {
    function electro_remove_new_header_v1_functions() {
        remove_action( 'electro_header_v1', 'electro_masthead',         10  );
        remove_action( 'electro_header_v1', 'electro_navigation',       20 );
    }
}

if ( ! function_exists( 'electro_hook_old_header_v1_functions' ) ) {
    function electro_hook_old_header_v1_functions() {
        add_action( 'electro_header_v1', 'electro_row_wrap_start',    0 );
        add_action( 'electro_header_v1', 'electro_header_logo',      10 );
        add_action( 'electro_header_v1', 'electro_navbar_search',    20 );
        add_action( 'electro_header_v1', 'electro_navbar_wishlist',  40 );
        add_action( 'electro_header_v1', 'electro_navbar_compare',   50 );
        add_action( 'electro_header_v1', 'electro_row_wrap_end',     70 );
        add_action( 'electro_header_v1', 'electro_row_wrap_start',   80 );
        add_action( 'electro_header_v1', 'electro_vertical_menu',    90 );
        add_action( 'electro_header_v1', 'electro_secondary_nav',    95 );
        add_action( 'electro_header_v1', 'electro_row_wrap_end',     99 );
        remove_action( 'electro_before_content', 'electro_navbar', 10 );
        
        if ( is_woocommerce_activated() ) {
            add_action( 'electro_header_v1', 'electro_navbar_mini_cart', 30 );
        }
    }
}

if ( ! function_exists( 'electro_remove_new_header_v2_functions' ) ) {
    function electro_remove_new_header_v2_functions() {
        remove_action( 'electro_header_v2',   'electro_masthead_v2',      10 );
        remove_action( 'electro_header_v2',   'electro_navbar_v2',        20 );
    }
}

if ( ! function_exists( 'electro_hook_old_header_v2_functions' ) ) {
    function electro_hook_old_header_v2_functions() {
        add_action( 'electro_header_v2',         'electro_row_wrap_start',           0  );
        add_action( 'electro_header_v2',         'electro_header_logo',              10 );
        add_action( 'electro_header_v2',         'electro_primary_nav',              20 );
        add_action( 'electro_header_v2',         'electro_header_support_info',      30 );
        add_action( 'electro_header_v2',         'electro_row_wrap_end',             40 );
        add_action( 'electro_before_content',    'electro_navbar',                   10 );

        add_action( 'electro_navbar',           'electro_departments_menu',         10 );
        add_action( 'electro_navbar',           'electro_navbar_search',            20 );
        add_action( 'electro_navbar',           'electro_navbar_compare',           50 );
        add_action( 'electro_navbar',           'electro_navbar_wishlist',          40 );
        
        if ( is_woocommerce_activated() ) {
            add_action( 'electro_navbar', 'electro_navbar_mini_cart', 30 );
        }
    }
}

if ( ! function_exists( 'electro_hook_old_header_v2_functions') ) {
    function electro_hook_old_header_v2_functions() {
        add_action( 'electro_header_v3',        'electro_row_wrap_start',    0 );
        add_action( 'electro_header_v3',        'electro_header_logo',      10 );
        add_action( 'electro_header_v3',        'electro_navbar_search',    20 );
        add_action( 'electro_header_v3',        'electro_navbar_wishlist',  40 );
        add_action( 'electro_header_v3',        'electro_navbar_compare',   50 );
        add_action( 'electro_header_v3',        'electro_row_wrap_end',     70 );
        add_action( 'electro_before_content',   'electro_primary_navbar',   10 );
        
        if ( is_woocommerce_activated() ) {
            add_action( 'electro_header_v3', 'electro_navbar_mini_cart', 30 );
        }
    }
}