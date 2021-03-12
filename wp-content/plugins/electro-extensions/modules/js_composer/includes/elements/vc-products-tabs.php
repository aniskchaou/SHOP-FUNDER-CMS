<?php
if ( ! function_exists( 'electro_vc_product_tabs' ) ) :

function electro_vc_product_tabs( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'tab_title_1'		=> '',
		'tab_content_1'		=> '',
		'product_id_1'		=> '',
		'category_1'		=> '',
		'tab_title_2'		=> '',
		'tab_content_2'		=> '',
		'product_id_2'		=> '',
		'category_2'		=> '',
		'tab_title_3'		=> '',
		'tab_content_3'		=> '',
		'product_id_3'		=> '',
		'category_3'		=> '',
		'product_items'		=> 3,
		'product_columns'	=> 3
	), $atts ) );

	$args = array(
		'tabs' 		=> array(
			array(
				'title'			=> $tab_title_1,
				'shortcode_tag'	=> $tab_content_1,
				'atts'			=> function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $tab_content_1, 'product_category_slug' => $category_1, 'products_choice' => 'ids', 'products_ids_skus' => $product_id_1 ) ) : array()
			),
			array(
				'title'			=> $tab_title_2,
				'shortcode_tag'	=> $tab_content_2,
				'atts'			=> function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $tab_content_2, 'product_category_slug' => $category_2, 'products_choice' => 'ids', 'products_ids_skus' => $product_id_2 ) ) : array()
			),
			array(
				'title'			=> $tab_title_3,
				'shortcode_tag'	=> $tab_content_3,
				'atts'			=> function_exists( 'electro_get_atts_for_shortcode' ) ? electro_get_atts_for_shortcode( array( 'shortcode' => $tab_content_3, 'product_category_slug' => $category_3, 'products_choice' => 'ids', 'products_ids_skus' => $product_id_3 ) ) : array()
			)
		),
		'limit'		=> $product_items,
		'columns'	=> $product_columns,
	);

	$html = '';
	if( function_exists( 'electro_products_tabs' ) ) {
		ob_start();
		electro_products_tabs( $args );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'electro_product_tabs' , 'electro_vc_product_tabs' );

endif;



if ( ! function_exists( 'electro_product_tabs_element' ) ) {

	function electro_product_tabs_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'tabs'				=> array(),
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
					'per_page' 				=> 3,
					'columns'				=> 3,
					'columns_wide'			=> 5,
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
				$shortcode_atts = wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'columns_wide' => $columns_wide , 'per_page' => $per_page ) );

				$tabs_args[] = array(
					'title'				=> $title,
					'shortcode_tag'		=> $shortcode_tag,
					'atts'				=> $shortcode_atts,
				);
			}
		}

		$args = array(
			'section_class'		=> $el_class,
			'tabs' 				=> $tabs_args,
		);

		$html = '';
		if( function_exists( 'electro_products_tabs' ) ) {
			ob_start();
			electro_products_tabs( $args );
			$html = ob_get_clean();
		}

		return $html;
	}

}

add_shortcode( 'electro_products_tabs' , 'electro_product_tabs_element' );
