<?php

if ( ! function_exists( 'electro_vc_feature_block' ) ) :

	function electro_vc_feature_block( $atts, $content = null ){

		extract(shortcode_atts(array(
			'icon_1'			=> '',
			'text_1'			=> '',
			'icon_2'			=> '',
			'text_2'			=> '',
			'icon_3'			=> '',
			'text_3'			=> '',
			'icon_4'			=> '',
			'text_4'			=> '',
			'icon_5'			=> '',
			'text_5'			=> '',
		), $atts));

		$args = array();

		if( ! empty( $icon_1 ) ) {
			$args[] = array(
				'icon'	=> $icon_1,
				'text'	=> $text_1,
			);
		}

		if( ! empty( $icon_2 ) ) {
			$args[] = array(
				'icon'	=> $icon_2,
				'text'	=> $text_2,
			);
		}

		if( ! empty( $icon_3 ) ) {
			$args[] = array(
				'icon'	=> $icon_3,
				'text'	=> $text_3,
			);
		}

		if( ! empty( $icon_4 ) ) {
			$args[] = array(
				'icon'	=> $icon_4,
				'text'	=> $text_4,
			);
		}

		if( ! empty( $icon_5 ) ) {
			$args[] = array(
				'icon'	=> $icon_5,
				'text'	=> $text_5,
			);
		}

		$html = '';
		if( function_exists( 'electro_features_list' ) ) {
			ob_start();
			electro_features_list( $args );
			$html = ob_get_clean();
		}

	    return $html;
	}

	add_shortcode( 'electro_feature_block' , 'electro_vc_feature_block' );

endif;