<?php

if ( ! function_exists( 'electro_vc_ad_block' ) ) :

	function electro_vc_ad_block( $atts, $content = null ){

		extract(shortcode_atts(array(
			'image'				=> '',
			'caption_text'		=> '',
			'action_text'		=> '',
			'action_link'		=> '#',
		), $atts));

		if( ! empty( $image ) ) {
			$image_attributes = wp_get_attachment_image_src( $image, 'full' );
		}

		$args = array(
			array(
				'ad_text'		=> $caption_text,
				'action_text'	=> $action_text,
				'action_link'	=> $action_link,
				'ad_image'		=> isset( $image_attributes ) ? $image_attributes[0] : '',
				'el_class'		=> 'col-xs-12 col-sm-12',
			)
		);

		$html = '';
		if( function_exists( 'electro_ads_block' ) ) {
			ob_start();
			electro_ads_block( $args );
			$html = ob_get_clean();
		}

	    return $html;
	}

	add_shortcode( 'electro_ad_block' , 'electro_vc_ad_block' );

endif;
