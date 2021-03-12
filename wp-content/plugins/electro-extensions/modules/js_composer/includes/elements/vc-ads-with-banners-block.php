<?php

if ( ! function_exists( 'electro_vc_ads_with_banners_block' ) ) :

    function electro_vc_ads_with_banners_block( $atts, $content = null ){

        extract(shortcode_atts(array(
            'ads_banners'           => '',
            'el_class'              => '',
        ), $atts));

        $ads_banners_args = array();

        if( is_object( $ads_banners ) || is_array( $ads_banners ) ) {
            $ads_banners = json_decode( json_encode( $ads_banners ), true );
        } else {
            $ads_banners = json_decode( urldecode( $ads_banners ), true );
        }

        if( is_array( $ads_banners ) ) {
            foreach ( $ads_banners as $key => $ads_banner ) {

                extract(shortcode_atts(array(
                    'title'                 => '',
                    'description'           => '',
                    'price'                 => '',
                    'image'                 => '',
                    'banner_image'          => '',
                    'is_align_end'          => false,
                    'action_link'           => '#',
                    'banner_action_link'    => '#',
                ), $ads_banner));
                
                $ads_banners_args[] = array(
                    'title'                 => $title,
                    'description'           => $description,
                    'price'                 => $price,
                    'image'                 => isset( $image ) && intval( $image ) ? wp_get_attachment_image_src( $image, 'full' ) : '',
                    'banner_image'          => isset( $banner_image ) && intval( $banner_image ) ? wp_get_attachment_image_src( $banner_image, 'full' ) : '',
                    'is_align_end'          => $is_align_end,
                    'action_link'           => $action_link,
                    'banner_action_link'    => $banner_action_link,
                );
            }
        }

        $args = array(
            'section_class'     => $el_class,
            'ads_banners'       => $ads_banners_args
        );
        
        $html = '';
        if( function_exists( 'electro_ads_with_banners' ) ) {
            ob_start();
            electro_ads_with_banners( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

    add_shortcode( 'electro_ads_with_banners_block' , 'electro_vc_ads_with_banners_block' );

endif;
