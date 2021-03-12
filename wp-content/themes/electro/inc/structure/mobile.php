<?php

if ( ! function_exists( 'electro_detect_is_mobile' ) ) {
    function electro_detect_is_mobile() {
        require_once get_template_directory() . '/inc/classes/class-mobile-detect.php';

        $detect = new Mobile_Detect();
        $is_mobile_tablet = ( $detect->isMobile() || $detect->isTablet() );
        return $is_mobile_tablet;
    }
}

if ( ! function_exists( 'electro_mobile_option_page_on_front' ) ) {
    function electro_mobile_option_page_on_front( $page ) {

        if ( apply_filters( 'electro_enable_mobile_front_page', true ) && electro_detect_is_mobile() ) {
            $new_page = apply_filters( 'electro_mobile_front_page_id', $page );
            $new_page = ! empty( $new_page ) ? intval( $new_page ) : $page;
            return apply_filters( 'electro_mobile_front_page_id', $new_page );
        }

        return $page;
    }
}

add_filter( 'option_page_on_front', 'electro_mobile_option_page_on_front' );

if( function_exists( 'is_wpml_activated' ) && is_wpml_activated() ) {
    add_filter( 'pre_option_page_on_front', 'electro_mobile_option_page_on_front' );
}