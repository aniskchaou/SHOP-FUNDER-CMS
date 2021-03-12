<?php
if ( ! function_exists( 'electro_vc_products_cards_carousel_block' ) ) :

function electro_vc_products_cards_carousel_block( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'title'					=> '',
		'rows'					=> 2,
		'columns'				=> 2,
		'product_columns_wide'	=> 4,
		'show_nav'				=> false,
		'show_carousel_nav'		=> false,
		'show_top_text'			=> false,
		'show_categories'		=> false,
		'limit'					=> 16,
		'shortcode_tag'			=> 'recent_products',
		'orderby' 				=> 'date',
		'order' 				=> 'DESC',
		'products_choice'		=> 'ids',
		'product_id'			=> '',
		'category'				=> '',
		'cat_operator'			=> 'IN',
		'attribute'				=> '',
		'terms'					=> '',
		'terms_operator'		=> 'IN',
		'is_autoplay'			=> false,
		'cat_limit' 			=> '',
		'cat_has_no_products' 	=> false,
		'cat_orderby' 			=> '',
		'cat_order' 			=> '',
		'cat_include'			=> '',
		'cat_slugs'				=> '',
	), $atts ) );

	$shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
	$shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'per_page' => $limit ) );

	$categories_args = array(
		'number'		=> $cat_limit,
		'hide_empty'	=> $cat_has_no_products,
		'orderby' 		=> $cat_orderby,
		'order' 		=> $cat_order,
	);

	if( ! empty( $cat_include ) ) {
		$cat_include = explode( ",", $cat_include );
		$categories_args['orderby'] = 'include';
	}

	if( ! empty( $cat_slugs ) ) {
		$cat_slugs = explode( ",", $cat_slugs );
		$categories_args['slug'] = $cat_slugs;

		$cat_include = array();

		foreach ( $cat_slugs as $cat_slug ) {
			$cat_include[] = "'" . $cat_slug ."'";
		}

		if ( ! empty($cat_include ) ) {
			$categories_args['include'] = $cat_include;
			$categories_args['orderby'] = 'include';
		}
	}

	$args = array(
		'section_args' 	=> array(
			'section_title'		=> $title,
			'show_nav'			=> false,
			'show_carousel_nav'	=> $show_carousel_nav,
			'show_top_text'		=> $show_top_text,
			'show_categories'	=> $show_categories,
			'categories_args'	=> $categories_args,
			'columns'			=> $columns,
			'rows'				=> $rows,
			'columns_wide'      => $product_columns_wide,
			'total'				=> $limit,
		),
		'carousel_args'	=> array(
			'autoplay'	=> $is_autoplay,
		)
	);

	if( class_exists( 'Electro_Products' ) ) {
		$args['section_args']['products'] = Electro_Products::$shortcode_tag( $shortcode_atts );
	}

	if( $show_top_text || $show_categories ) {
		$args['section_args']['show_nav'] = true;
	}

	$html = '';
	if( function_exists( 'electro_product_cards_carousel' ) ) {
		ob_start();
		electro_product_cards_carousel( $args['section_args'], $args['carousel_args'] );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'electro_vc_products_cards_carousel' , 'electro_vc_products_cards_carousel_block' );

endif;