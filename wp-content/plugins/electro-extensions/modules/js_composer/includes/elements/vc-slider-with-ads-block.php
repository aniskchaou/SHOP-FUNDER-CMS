<?php

if ( ! function_exists( 'electro_vc_slider_with_ads_block' ) ) :

    function electro_vc_slider_with_ads_block( $atts, $content = null ){

        extract(shortcode_atts(array(
            'rev_slider_alias'      => '',
            'ads_banners'           => '',
            'el_class'              => '',
        ), $atts));

        $ads_args = array();

        if( is_object( $ads_banners ) || is_array( $ads_banners ) ) {
            $ads_banners = json_decode( json_encode( $ads_banners ), true );
        } else {
            $ads_banners = json_decode( urldecode( $ads_banners ), true );
        }

        if( is_array( $ads_banners ) ) {
            foreach ( $ads_banners as $key => $ads_banner ) {

                extract(shortcode_atts(array(
                    'ad_text'               => '',
                    'action_text'           => '',
                    'action_link'           => '',
                    'ad_image'              => '',
                ), $ads_banner));
                
                $ads_args[] = array(
                    'ad_text'       => $ad_text,
                    'action_text'   => $action_text,
                    'action_link'   => $action_link,
                    'ad_image'      => isset( $ad_image ) && intval( $ad_image ) ? wp_get_attachment_url( $ad_image ) : '',
                );
            }
        }

        $slider_shortcode = '';
        if( ! empty( $rev_slider_alias ) ) {
            $slider_shortcode = '[rev_slider alias="' . $rev_slider_alias . '"]';
        }

        $args = array(
            'section_class'     => $el_class,
            'slider_shortcode'  => $slider_shortcode,
            'ads_args'          => $ads_args
        );
        
        $html = '';
        if( function_exists( 'electro_slider_with_ads_block' ) ) {
            ob_start();
            electro_slider_with_ads_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

    add_shortcode( 'electro_slider_with_ads_block' , 'electro_vc_slider_with_ads_block' );

endif;
