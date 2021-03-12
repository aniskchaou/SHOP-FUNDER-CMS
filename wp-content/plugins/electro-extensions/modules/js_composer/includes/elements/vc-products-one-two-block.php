<?php

if ( ! function_exists( 'electro_products_1_2_block_element' ) ) :

	function electro_products_1_2_block_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'title'					=> '',
            'shortcode_tag'         => 'sale_productss',
            'products_choice'       => 'ids',
            'product_id'            => '',
            'category'              => '',
            'cat_operator'          => 'IN',
            'attribute'             => '',
            'terms'                 => '',
            'terms_operator'        => 'IN',
			'orderby'               => 'date',
            'order'                 => 'DESC',
			'action_text'			=> '',
			'action_link'			=> '',
			'el_class'				=> ''
		), $atts));

		$shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
		$shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby ) );

		$args = array(
			'section_title'			=> $title,
			'shortcode_tag'			=> $shortcode_tag,
			'shortcode_atts'		=> $shortcode_atts,
			'action_text'			=> $action_text,
			'action_link'			=> $action_link,
			'section_class'			=> $el_class,
		);

		$html = '';
		if( function_exists( 'electro_products_1_2_block' ) ) {
			ob_start();
			electro_products_1_2_block( $args );
			$html = ob_get_clean();
		}

	    return $html;
	}

	add_shortcode( 'electro_products_1_2_block' , 'electro_products_1_2_block_element' );

endif;