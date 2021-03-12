<?php
if ( ! function_exists( 'electro_products_tabs_carousel_1_element' ) ) {

	function electro_products_tabs_carousel_1_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'section_title'		=> '',
			'button_text'		=> '',
			'button_link'       => '',
			'tabs'				=> array(),
			'items'				=> 6,
			'items_0'			=> 1,
			'items_480'			=> 1,
			'items_768'			=> 2,
			'items_992'			=> 3,
			'is_nav'			=> false,
			'is_dots'			=> false,
			'is_autoplay'		=> false,
			'nav_next'			=> '<i class="fa fa-angle-left" aria-hidden="true"></i>',
			'nav_prev'			=> '<i class="fa fa-angle-right" aria-hidden="true"></i>',
			'el_class'			=> ''
		), $atts));

		if( is_object( $tabs ) || is_array( $tabs ) ) {
			$tabs = json_decode( json_encode( $tabs ), true );
		} else {
			$tabs = json_decode( urldecode( $tabs ), true );
		}

		$tabs_args = array();

		if( is_array( $tabs ) ) {
			foreach ( $tabs as $key => $tab ) {

				extract(shortcode_atts(array(
					'title'					=> '',
					'shortcode_tag'			=> 'recent_products',
					'per_page' 				=> 6,
					'orderby' 				=> 'date',
					'order' 				=> 'desc',
					'products_choice'		=> 'ids',
					'product_id'			=> '',
					'category'				=> '',
					'cat_operator'			=> 'IN',
					'attribute'				=> '',
					'terms'					=> '',
					'terms_operator'		=> 'IN',
				), $tab));

				$shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
				$shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $items, 'per_page' => $per_page ) );

				$tabs_args[] = array(
					'title'				=> $title,
					'shortcode_tag'		=> $shortcode_tag,
					'atts'				=> $shortcode_atts,
				);
			}
		}

		$args = array(
			'section_class'		=> $el_class,
			'section_title'		=> $section_title,
			'button_text'		=> $button_text,
			'button_link'       => $button_link,
			'tabs' 				=> $tabs_args,
			'carousel_args'		=> array(
				'nav'			=> $is_nav,
				'navText'       => array( $nav_next, $nav_prev ),
				'dots'			=> $is_dots,
				'items'			=> $items,
				'autoplay'		=> $is_autoplay,
				'responsive'	=> array(
					'0'		=> array( 'items'	=> $items_0 ),
					'480'	=> array( 'items'	=> $items_480 ),
					'768'	=> array( 'items'	=> $items_768 ),
					'992'	=> array( 'items'	=> $items_992 ),
					'1200'	=> array( 'items'	=> $items ),
				)
			)
		);

		$html = '';
		if( function_exists( 'electro_products_carousel_tabs_v5' ) ) {
			ob_start();
			electro_products_carousel_tabs_v5( $args );
			$html = ob_get_clean();
		}

		return $html;
	}

}

add_shortcode( 'electro_products_tabs_carousel_1' , 'electro_products_tabs_carousel_1_element' );
