<?php

if ( ! function_exists( 'electro_nav_menu_element' ) ) :

    function electro_nav_menu_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'title'        => '',
            'menu'         => '',
        ), $atts));

        $args = array(
            'title'        => $title,
            'menu'         => $menu,
        );

        $html = '';
        if( function_exists( 'electro_secondary_nav_v6' ) ) {
            ob_start();
            electro_secondary_nav_v6( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

    add_shortcode( 'electro_nav_menu' , 'electro_nav_menu_element' );

endif;