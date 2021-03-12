<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$product_id = electro_wc_get_product_id( $product );
$specifications = get_post_meta( $product_id, '_specifications', true );
$specifications_display_attributes = get_post_meta( $product_id, '_specifications_display_attributes', true );

if ( $specifications_display_attributes == 'yes' && ( $product->has_attributes() || ( apply_filters( 'wc_product_enable_dimensions_display', true ) && ( $product->has_dimensions() || $product->has_weight() ) ) ) ) {
	$attributes_title = get_post_meta( $product_id, '_specifications_attributes_title', true );
	if ( $attributes_title ) {
		echo wp_kses_post( '<h2>' . $attributes_title . '</h2>' );
	}

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
		$product->list_attributes();
	} else {
		wc_display_product_attributes( $product );
	}
}

if ( is_elementor_activated() ) {
	$content = \Elementor\Plugin::$instance->frontend->remove_content_filter();
	echo apply_filters( 'the_content', wp_kses_post( $specifications ) );
	$content = \Elementor\Plugin::$instance->frontend->add_content_filter();
} else {
	echo apply_filters( 'the_content', wp_kses_post( $specifications ) );
}