<?php
/**
 * Compatibility Code for smaller plugins
 */

/**
 * Menu Image Compatibility
 */

if ( class_exists( 'Menu_Image_Plugin' ) ) {
	add_filter( 'walker_nav_menu_start_el', 'ec_child_enable_static_block_with_menu_image', 20, 4 );

	function ec_child_enable_static_block_with_menu_image( $item_output, $item, $depth, $args ) {
		
		if ( 'static_block' == $item->object || 'mas_static_content' == $item->object ) {			
			if ( is_elementor_activated() ) {
				$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $item->object_id );
			}

			if( empty( $content ) ) {
				$megamenu_item = get_post( $item->object_id );
				$content = do_shortcode( $megamenu_item->post_content );
			}
			
			$item_output = '<div class="yamm-content">' . $content . '</div>';
		}

		return $item_output;
	}
}

if ( function_exists( 'vc_set_default_editor_post_types' ) ){
	add_action( 'init', 'ec_set_vc_default_editor_post_types', 20 );
	function ec_set_vc_default_editor_post_types() {
		vc_set_default_editor_post_types( array( 'page', 'static_block', 'mas_static_content' ) );
	}
}