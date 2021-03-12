<?php

if ( ! function_exists( 'electro_home_banner_1_6_block_element' ) ) :

	function electro_home_banner_1_6_block_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'image_0'		=> '',
			'action_link_0'	=> '',
			'el_class_0'	=> '',
			'image_1'		=> '',
			'action_link_1'	=> '',
			'el_class_1'	=> '',
			'image_2'		=> '',
			'action_link_2'	=> '',
			'el_class_2'	=> '',
			'image_3'		=> '',
			'action_link_3'	=> '',
			'el_class_3'	=> '',
			'image_4'		=> '',
			'action_link_4'	=> '',
			'el_class_4'	=> '',
			'image_5'		=> '',
			'action_link_5'	=> '',
			'el_class_5'	=> '',
			'image_6'		=> '',
			'action_link_6'	=> '',
			'el_class_6'	=> '',
			'el_class'		=> '',
		), $atts));

		$section_class = 'section-home-banner-1-6';

		if( ! empty( $el_class ) ) {
			$section_class .= ' ' . $el_class;
		}

		$args = array();

		for( $i = 0; $i < 7; $i++ ) {
			$image_attributes = '';
			if( isset( $atts["image_${i}"] ) && ! empty( $atts["image_${i}"] ) ) {
				$image_attributes = wp_get_attachment_url( $atts["image_${i}"] );
			}

			$args[] = array(
				'image'			=> $image_attributes,
				'action_link'	=> isset( $atts["action_link_${i}"] ) && ! empty( $atts["action_link_${i}"] ) ? $atts["action_link_${i}"] : '',
				'el_class'		=> isset( $atts["el_class_${i}"] ) && ! empty( $atts["el_class_${i}"] ) ? $atts["el_class_${i}"] : '',
			);
		}

		$html = '';
		if( function_exists( 'electro_home_banner_1_6_block' ) ) {
			ob_start();
			?><div class="<?php echo esc_attr( $section_class ); ?>"><?php
				electro_home_banner_1_6_block( $args );
			?></div><?php
			$html = ob_get_clean();
		}

	    return $html;
	}

	add_shortcode( 'electro_home_banner_1_6_block' , 'electro_home_banner_1_6_block_element' );

endif;