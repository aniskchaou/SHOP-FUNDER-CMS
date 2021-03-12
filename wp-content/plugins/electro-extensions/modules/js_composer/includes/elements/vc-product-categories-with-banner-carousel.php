<?php

if ( ! function_exists( 'electro_product_categories_with_banner_carousel_element' ) ) :

	function electro_product_categories_with_banner_carousel_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'title'				=> '',
			'elements'			=> array(),
			'is_nav'			=> '',
			'is_touchdrag'		=> '',
			'is_autoplay'		=> '',
			'el_class'			=> '',
		), $atts));

		if( is_object( $elements ) || is_array( $elements ) ) {
            $elements = json_decode( json_encode( $elements ), true );
        } else {
            $elements = json_decode( urldecode( $elements ), true );
        }

		$content_args = array();

		if( is_array( $elements ) ) {
			foreach ( $elements as $key => $element ) {
				$category_1_args = array(
					'number'			=> isset( $element['cat_1_limit'] ) ? $element['cat_1_limit'] : 5,
					'child_number'		=> isset( $element['cat_1_child_limit'] ) ? $element['cat_1_child_limit'] : 5,
					'hide_empty'		=> isset( $element['cat_1_has_no_products'] ) ? $element['cat_1_has_no_products'] : false,
					'orderby' 			=> isset( $element['cat_1_orderby'] ) ? $element['cat_1_orderby'] : 'name',
					'order' 			=> isset( $element['cat_1_order'] ) ? $element['cat_1_order'] : 'ASC',
					'slugs' 			=> isset( $element['cat_1_slugs'] ) ? $element['cat_1_slugs'] : '',
					'includes' 			=> isset( $element['cat_1_include'] ) ? $element['cat_1_include'] : '',
				);

				$category_2_args = array(
					'number'			=> isset( $element['cat_2_limit'] ) ? $element['cat_2_limit'] : 7,
					'hide_empty'		=> isset( $element['cat_2_has_no_products'] ) ? $element['cat_2_has_no_products'] : true,
					'orderby' 			=> isset( $element['cat_2_orderby'] ) ? $element['cat_2_orderby'] : 'name',
					'order' 			=> isset( $element['cat_2_order'] ) ? $element['cat_2_order'] : 'ASC',
					'slugs' 			=> isset( $element['cat_2_slugs'] ) ? $element['cat_2_slugs'] : '',
					'includes' 			=> isset( $element['cat_2_include'] ) ? $element['cat_2_include'] : '',
				);

				$content_args[] = array(
					'enable_category_1'	=> isset( $element['enable_category_1'] ) ? $element['enable_category_1'] : '',
					'category_1_args'	=> $category_1_args,
					'enable_category_2'	=> isset( $element['enable_category_2'] ) ? $element['enable_category_2'] : '',
					'category_2_args'	=> $category_2_args,
					'enable_banner'		=> isset( $element['enable_banner'] ) ? $element['enable_banner'] : '',
					'image'				=> isset( $element['image'] ) && ! empty( $element['image'] ) ? wp_get_attachment_image_src( $element['image'], 'full' ) : '',
					'img_action_link'	=> isset( $element['img_action_link'] ) ? $element['img_action_link'] : '',
				);
			}
		}

		$carousel_args = array(
			'items'				=> 1,
			'dots'				=> false,
			'nav'				=> $is_nav,
			'touchDrag'			=> $is_touchdrag,
			'autoplay'			=> $is_autoplay,
			'rtl'				=> is_rtl() ? true : false,
			'navText'			=> is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
		);

		$args = array(
			'section_title'		=> $title,
			'content'			=> $content_args,
			'carousel_args'		=> $carousel_args,
			'section_class'		=> $el_class,
		);

		$html = '';
		if( function_exists( 'electro_home_product_categories_with_banner_carousel' ) ) {
			ob_start();
			electro_home_product_categories_with_banner_carousel( $args );
			$html = ob_get_clean();
		}

		return $html;
	}

	add_shortcode( 'electro_product_categories_with_banner_carousel' , 'electro_product_categories_with_banner_carousel_element' );

endif;