<?php

if ( ! function_exists( 'electro_home_category_icon_carousel_element' ) ) :

	function electro_home_category_icon_carousel_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'style'				=> 'v1',
			'limit'				=> '',
			'has_no_products'	=> false,
			'orderby' 			=> 'name',
			'order' 			=> 'ASC',
			'include'			=> '',
			'slugs'				=> '',
			'items'				=> 20,
			'items_0'			=> 2,
			'items_480'			=> 2,
			'items_768'			=> 2,
			'items_992'			=> 3,
			'is_nav'			=> false,
			'is_dots'			=> false,
			'is_touchdrag'		=> false,
			'is_autoplay'		=> false,
			'el_class'			=> ''
		), $atts));

		$cat_args = array(
			'number'			=> $limit,
			'hide_empty'		=> $has_no_products,
			'orderby' 			=> $orderby,
			'order' 			=> $order,
		);

		if( ! empty( $slugs ) ) {
			$slugs = explode( ",", $slugs );
			$slugs = array_map( 'trim', $slugs );
			
			$slug_include = array();

			foreach ( $slugs as $slug ) {
				$slug_include[] = "'" . $slug ."'";
			}

			if ( ! empty($slug_include ) ) {
				$cat_args['slug'] 		= $slugs;
				$cat_args['include'] 	= $slug_include;
				$cat_args['orderby']	= 'include';
			}

		} elseif( ! empty( $include ) ) {
			$include = explode( ",", $include );
			$include = array_map( 'trim', $include );
			$cat_args['include'] = $include;
		}

		$args = array(
			'number'			=> $limit,
			'category_args'		=> $cat_args,
			'section_class'		=> $el_class,
		);

		if ( isset( $style ) && $style === 'v2' ) {
			$args['section_class'] = ' category-icons-carousel-v2';
			$is_nav = true;
		}

		$carousel_args = array(
			'items'             => $items,
			'nav'               => $is_nav,
			'dots'              => $is_dots,
			'touchDrag'         => $is_touchdrag,
			'autoplay'          => $is_autoplay,
			'responsive'        => array(
				'0'     => array( 'items'   => $items_0 ),
				'480'   => array( 'items'   => $items_480 ),
				'768'   => array( 'items'   => $items_768 ),
				'992'   => array( 'items'   => $items_992 ),
				'1200'  => array( 'items'   => $items ),
			)
		);

		$html = '';
		if( function_exists( 'electro_home_category_icon_carousel' ) ) {
			ob_start();
			electro_home_category_icon_carousel( $args, $carousel_args);
			$html = ob_get_clean();
		}

		return $html;
	}

	add_shortcode( 'electro_home_category_icon_carousel' , 'electro_home_category_icon_carousel_element' );

endif;