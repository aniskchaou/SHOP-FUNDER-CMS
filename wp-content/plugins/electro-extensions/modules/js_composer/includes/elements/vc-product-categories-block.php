<?php

if ( ! function_exists( 'electro_product_categories_block_element' ) ) :

	function electro_product_categories_block_element( $atts, $content = null ){

		extract(shortcode_atts(array(
			'title'				=> '',
			'columns'			=> '',
			'limit'				=> '',
			'enable_full_width'	=> '',
			'has_no_products'	=> false,
			'orderby' 			=> 'name',
			'order' 			=> 'ASC',
			'include'			=> '',
			'slugs'				=> '',
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
			'section_title'			=> $title,
			'columns'				=> $columns,
			'enable_full_width'		=> $enable_full_width,
			'category_args'			=> $cat_args,
			'section_class'			=> $el_class,
		);

		$html = '';
		if( function_exists( 'electro_home_categories_block' ) ) {
			ob_start();
			electro_home_categories_block( $args );
			$html = ob_get_clean();
		}

	    return $html;
	}

	add_shortcode( 'electro_product_categories_block' , 'electro_product_categories_block_element' );

endif;