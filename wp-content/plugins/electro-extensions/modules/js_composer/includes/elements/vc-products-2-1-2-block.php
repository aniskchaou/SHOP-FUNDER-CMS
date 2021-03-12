<?php
if ( ! function_exists( 'electro_vc_products_2_1_2_block' ) ) :

function electro_vc_products_2_1_2_block( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'title'					=> '',
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
		'cat_limit' 			=> '',
		'cat_has_no_products' 	=> '',
		'cat_orderby' 			=> '',
		'cat_order' 			=> '',
		'cat_include'			=> '',
		'cat_slugs'				=> '',
	), $atts ) );

	$args = array(
		'section_title' 	=> $title,
		'category_args'		=> array(
			'number'		=> $cat_limit,
			'hide_empty'	=> $cat_has_no_products,
			'orderby' 		=> $cat_orderby,
			'order' 		=> $cat_order,
		)
	);

	if( ! empty( $cat_include ) ) {
		$cat_include = explode( ",", $cat_include );
		$args['category_args']['include'] = $cat_include;
		$args['category_args']['orderby'] = 'include';
	}

	if( ! empty( $cat_slugs ) ) {
		$cat_slugs = explode( ",", $cat_slugs );
		$args['category_args']['slug'] = $cat_slugs;

		$cat_include = array();

		foreach ( $cat_slugs as $cat_slug ) {
			$cat_include[] = "'" . $cat_slug ."'";
		}

		if ( ! empty($cat_include ) ) {
			$args['category_args']['include'] = $cat_include;
			$args['category_args']['orderby'] = 'include';
		}
	}

	if ( electro_is_wide_enabled() ) {
        $per_page	= 9;
    } else {
    	$per_page	= 5;
    }

	$shortcode_atts = function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'cat_operator' => $cat_operator, 'products_choice' => $products_choice, 'products_ids_skus' => $product_id, 'attribute' => $attribute, 'terms' => $terms, 'terms_operator' => $terms_operator ) ) : array();
	$shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'per_page' => $per_page ) );

	if( class_exists( 'Electro_Products' ) ) {
		$args['products'] = Electro_Products::$shortcode_tag( $shortcode_atts );
	}

	$html = '';
	if( function_exists( 'electro_products_2_1_2_block' ) ) {
		ob_start();
		electro_products_2_1_2_block( $args );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'electro_products_2_1_2' , 'electro_vc_products_2_1_2_block' );

endif;