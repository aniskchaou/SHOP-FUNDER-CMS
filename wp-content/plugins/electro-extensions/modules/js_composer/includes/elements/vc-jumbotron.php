<?php

if ( ! function_exists( 'electro_jumbotron_element' ) ) :

	function electro_jumbotron_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'title'				=> '',
			'sub_title'			=> '',
			'image'				=> '',
		), $atts));

		$args = array(
			'title'			=> $title,
			'sub_title'		=> $sub_title,
			'image'			=> $image,
		);

		$html = '';
		if( function_exists( 'electro_jumbotron' ) ) {
			ob_start();
			electro_jumbotron( $args );
			$html = ob_get_clean();
		}

		return $html;
	}

	add_shortcode( 'electro_jumbotron' , 'electro_jumbotron_element' );

endif;