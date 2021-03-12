<?php
if ( ! function_exists( 'electro_vc_products_onsale_carousel_block' ) ) :

function electro_vc_products_onsale_carousel_block( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'title'				=> '',
		'show_savings'		=> false,
		'savings_in'		=> 'amount',
		'savings_text'		=> '',
		'limit'				=> '',
		'product_choice'	=> 'recent',
		'product_id'		=> '',
		'show_custom_nav'	=> '',
		'show_progress'		=> false,
		'show_timer'		=> false,
		'show_cart_btn'		=> false,
		'is_dots'			=> '',
		'is_touchdrag'		=> '',
		'nav_next'			=> '',
		'nav_prev'			=> '',
		'margin'			=> '',
		'is_autoplay'		=> false,
	), $atts ) );

	$section_args = array(
		'section_title'		=> $title,
		'show_savings'		=> $show_savings,
		'savings_in'		=> $savings_in,
		'savings_text'		=> $savings_text,
		'limit'				=> $limit,
		'product_choice'	=> $product_choice,
		'product_ids'		=> $product_id,
		'show_custom_nav'	=> $show_custom_nav,
		'show_progress'		=> $show_progress,
		'show_timer'		=> $show_timer,
		'show_cart_btn'		=> $show_cart_btn
	);

	$carousel_args = array(
		'dots'				=> $is_dots,
		'touchDrag'			=> $is_touchdrag,
		'navText'			=> array( $nav_next, $nav_prev ),
		'margin'			=> intval( $margin ),
		'autoplay'			=> $is_autoplay,
	);

	if ( electro_is_wide_enabled() ) {
        $carousel_args['items'] = 1;
        $carousel_args['responsive'] = array(
            '1480'       => array( 'items' => 2 ),
        );
    }

	$html = '';
	if( function_exists( 'electro_onsale_product_carousel' ) ) {
		ob_start();
		electro_onsale_product_carousel( $section_args, $carousel_args );
		$html = ob_get_clean();
	}

	return $html;
}

add_shortcode( 'electro_vc_products_onsale_carousel' , 'electro_vc_products_onsale_carousel_block' );

endif;