<?php

if( ! function_exists( 'is_mas_static_content_activated' ) ) {
	function is_mas_static_content_activated() {
		$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}

		return in_array( 'mas-static-content/mas-static-content.php', $active_plugins ) || array_key_exists( 'mas-static-content/mas-static-content.php', $active_plugins );
	}
}

// Register widgets.
function electro_extensions_widgets_register() {
    if ( class_exists( 'Electro' ) ) {        
        include_once get_template_directory() . '/inc/widgets/class-electro-wc-catalog-orderby.php';
        register_widget( 'Electro_WC_Catalog_Orderby' );
    }
}

add_action( 'widgets_init', 'electro_extensions_widgets_register' );