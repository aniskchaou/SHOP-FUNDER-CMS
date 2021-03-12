<?php

if ( ! function_exists( 'mas_wcbr_get_brand_thumbnail_url' ) ) {
	/**
	 * Helper function :: mas_wcbr_get_brand_thumbnail_url function.
	 *
	 * @access public
	 * @return string
	 */
	function mas_wcbr_get_brand_thumbnail_url( $brand_id, $size = 'full' ) {
		$thumbnail_id = get_term_meta( $brand_id, 'thumbnail_id', true );

		if ( $thumbnail_id )
			$thumb_src = wp_get_attachment_image_src( $thumbnail_id, $size );
			if ( ! empty( $thumb_src ) ) {
				return current( $thumb_src );
			}
	}
}

if ( ! function_exists( 'mas_wcbr_get_brand_thumbnail_image' ) ) {
	/**
	 * Helper function :: mas_wcbr_get_brand_thumbnail_image function.
	 *
	 * @since 1.5.0
	 *
	 * @access public
	 * @return string
	 */
	function mas_wcbr_get_brand_thumbnail_image( $brand, $size = '' ) {
		$thumbnail_id = get_term_meta( $brand->term_id, 'thumbnail_id', true );

		if ( $size === '' ) {
			$size = apply_filters( 'mas_wcbr_brand_thumbnail_size', 'brand-thumb' );
		}

		if ( $thumbnail_id ) {
			$image_src    = wp_get_attachment_image_src( $thumbnail_id, $size );
			$image_src    = $image_src[0];
			$dimensions   = wc_get_image_size( $size );
			$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $size ) : false;
			$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $size ) : false;
		} else {
			$image_src    = wc_placeholder_img_src();
			$dimensions   = wc_get_image_size( $size );
			$image_srcset = $image_sizes = false;
		}

		// Add responsive image markup if available
		if ( $image_srcset && $image_sizes ) {
			$image = '<img src="' . esc_url( $image_src ) . '" alt="' . esc_attr( $brand->name ) . '" class="brand-thumbnail" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
		} else {
			$image = '<img src="' . esc_url( $image_src ) . '" alt="' . esc_attr( $brand->name ) . '" class="brand-thumbnail" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}

		return $image;
	}
}

if ( ! function_exists( 'mas_wcbr_get_brands' ) ) {
	/**
	 * mas_wcbr_get_brands function.
	 *
	 * @access public
	 * @param int $post_id (default: 0)
	 * @param string $sep (default: ')
	 * @param mixed '
	 * @param string $before (default: '')
	 * @param string $after (default: '')
	 * @return void
	 */
	function mas_wcbr_get_brands( $post_id = 0, $sep = ', ', $before = '', $after = '' ) {
		global $post;

		$brand_taxonomy = Mas_WC_Brands()->get_brand_taxonomy();

		if( empty( $brand_taxonomy ) ) {
			return;
		}

		if ( ! $post_id )
			$post_id = $post->ID;

		return get_the_term_list( $post_id, $brand_taxonomy, $before, $sep, $after );
	}
}