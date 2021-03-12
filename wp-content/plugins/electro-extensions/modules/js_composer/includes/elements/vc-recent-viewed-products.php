<?php

if ( ! function_exists( 'electro_vc_recent_viewed_products' ) ) :

    function electro_vc_recent_viewed_products( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'per_page'          => 10,
            'columns'           => '5',
            'columns_wide'      => '5'
        ), $atts));

        $shortcode_atts = array( 'per_page'  => $per_page, 'columns'    => $columns ,'columns_wide'    => $columns_wide );

        $args = array(
            'section_title'     => $section_title,
            'shortcode_atts'    => $shortcode_atts
        );
        
        $html = '';
        if( function_exists( 'electro_recent_viewed_products' ) ) {
            ob_start();
            electro_recent_viewed_products( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

    add_shortcode( 'electro_recent_viewed_products' , 'electro_vc_recent_viewed_products' );

endif;
