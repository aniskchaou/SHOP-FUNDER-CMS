<?php
if ( ! function_exists( 'electro_vc_products_onsale_carousel_2_element' ) ) :

function electro_vc_products_onsale_carousel_2_element( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'limit'				=> '',
		'product_choice'	=> 'recent',
		'product_id'		=> '',
		'show_timer'		=> true,
		'is_nav'			=> true,
		'is_touchdrag'		=> true,
		'is_autoplay'		=> false,
	), $atts ) );

	$section_args = array(
		'limit'				=> $limit,
		'product_choice'	=> $product_choice,
		'product_ids'		=> $product_id,
		'is_nav'			=> $is_nav,
		'show_timer'		=> $show_timer,
	);

	$carousel_args = array(
		'nav'				=> $is_nav,
		'touchDrag'			=> $is_touchdrag,
		'rtl'				=> is_rtl() ? true : false,
		'navText'			=> is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
		'autoplay'			=> $is_autoplay,
	);

	$html = '';
	if( function_exists( 'electro_onsale_product_carousel_v9' ) ) {
		ob_start();
		electro_onsale_product_carousel_v9( $section_args, $carousel_args );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'electro_vc_products_onsale_carousel_2' , 'electro_vc_products_onsale_carousel_2_element' );

endif;