<?php
if ( ! function_exists( 'electro_vc_deal_and_product_tabs' ) ) :

function electro_vc_deal_and_product_tabs( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'deal_title'			=> '',
		'deal_show_savings'		=> false,
		'deal_savings_in'		=> 'amount',
		'deal_savings_text'		=> '',
		'deal_product_choice'	=> 'recent',
		'deal_product_id'		=> '',
		'tabs'					=> array(),
		'product_columns_wide'	=> 4,
		'el_class'				=> ''
	), $atts ) );

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
				'product_limit'        	=> 6,
                'product_limit_wide'   	=> 8,
				'columns'				=> 3,
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

			if ( electro_is_wide_enabled() ) {
                $per_page   = $product_limit_wide;
            } else {
                $per_page   = $product_limit;
            }
			
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
		'deal_products_args' 	=> $deal_args,
		'product_tabs_args'		=> array(
			'tabs' => $tabs_args,
			'columns_wide'	=> $product_columns_wide,
		),

	);

	$html = '';
	if( function_exists( 'electro_deal_and_tabs_block' ) ) {
		ob_start();
		electro_deal_and_tabs_block( $args );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'electro_vc_deal_and_product_tab' , 'electro_vc_deal_and_product_tabs' );

endif;