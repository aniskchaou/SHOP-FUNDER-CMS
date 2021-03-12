<?php
if ( ! function_exists( 'electro_products_tabs_carousel_with_deal_element' ) ) {

	function electro_products_tabs_carousel_with_deal_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'section_title'			=> '',
			'button_text'			=> '',
			'button_link'      		=> '',
			'deal_title'			=> '',
			'deal_show_savings'		=> false,
			'deal_savings_in'		=> 'amount',
			'deal_savings_text'		=> '',
			'deal_product_choice'	=> 'recent',
			'deal_product_id'		=> '',
			'tabs'					=> array(),
			'per_page'				=> 20,
			'rows'					=> 2,
			'columns'				=> 5,
			'is_autoplay'			=> false,
			'is_autoplay'			=> false,
			'is_dots'				=> false,
			'el_class'				=> 'products-carousel-tabs-with-deal'
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
				$shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'per_page' => $per_page ) );

				$tabs_args[] = array(
					'title'				=> $title,
					'shortcode_tag'		=> $shortcode_tag,
					'atts'				=> $shortcode_atts,
				);
			}
		}

		$deal_args = array(
			'is_enabled'		=> 'yes',
			'section_title'		=> $deal_title,
			'show_savings'		=> $deal_show_savings,
			'savings_in'		=> $deal_savings_in,
			'savings_text'		=> $deal_savings_text,
			'product_choice'	=> $deal_product_choice,
			'product_id'		=> $deal_product_id,
		);

		$args = array(
			'section_class'			=> $el_class,
			'section_title'			=> $section_title,
			'button_text'			=> $button_text,
			'button_link'      		=> $button_link,
			'deal_products_args'	=> $deal_args,
			'columns'				=> $columns,
			'rows'					=> $rows,
			'per_page'				=> $per_page,
			'tabs' 					=> $tabs_args,
			'carousel_args'	=> array(
				'items'         => 1,
				'autoplay'		=> $is_autoplay,
				'dots'			=> $is_dots,
			)
		);

		$html = '';
		if( function_exists( 'electro_products_carousel_tabs_with_deal' ) ) {
			ob_start();
			electro_products_carousel_tabs_with_deal( $args );
			$html = ob_get_clean();
		}

		return $html;
	}

}

add_shortcode( 'electro_products_tabs_carousel_with_deal' , 'electro_products_tabs_carousel_with_deal_element' );
