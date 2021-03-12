<?php
/**
 * electro engine room
 *
 * @package electro
 */

/**
 * Assign the Electro version to a var
 */
$theme           = wp_get_theme( 'electro' );
$electro_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @see mc_content_width()
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170; /* pixels */
}

$electro = (object) array(
	'version'    => $electro_version,

	/**
	 * Initialize all the things.
	 */
	'main' => require get_template_directory() . '/inc/class-electro.php',
);

/**
 * Classes
 * Load classes that are used by various functions
 */
require get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/classes/class-wp-bootstrap-navwalker.php';

if ( is_admin() ){
	require get_template_directory() . '/inc/admin/class-electro-admin.php';
}

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/electro-template-hooks.php';
require get_template_directory() . '/inc/functions/setup.php';
require get_template_directory() . '/inc/functions/menu.php';
require get_template_directory() . '/inc/functions/extras.php';
require get_template_directory() . '/inc/functions/media.php';
require get_template_directory() . '/inc/electro-template-functions.php';
require get_template_directory() . '/inc/electro-functions.php';

/**
 * Redux Framework
 * Load theme options and their override filters
 */
if ( is_redux_activated() ) {
	require get_template_directory() . '/inc/redux-framework/electro-options.php';
	require get_template_directory() . '/inc/redux-framework/hooks.php';
	require get_template_directory() . '/inc/redux-framework/functions.php';
}

/**
 * Structure
 */
require get_template_directory() . '/inc/structure/hooks.php';
require get_template_directory() . '/inc/structure/post.php';
require get_template_directory() . '/inc/structure/page.php';
require get_template_directory() . '/inc/structure/comments.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/header-v1.php';
require get_template_directory() . '/inc/structure/header-v3.php';
require get_template_directory() . '/inc/structure/navbar.php';
require get_template_directory() . '/inc/structure/layout.php';
require get_template_directory() . '/inc/structure/homepage.php';
require get_template_directory() . '/inc/structure/homepage-v3.php';
require get_template_directory() . '/inc/structure/footer.php';
require get_template_directory() . '/inc/structure/footer-v2.php';
require get_template_directory() . '/inc/structure/mobile.php';

/**
 * WooCommerce.
 * Load WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/classes/class-electro-shortcode-products.php';
	require get_template_directory() . '/inc/woocommerce/classes/class-electro-products.php';
	require get_template_directory() . '/inc/woocommerce/class-electro-wc-helper.php';
	require get_template_directory() . '/inc/woocommerce/class-electro-woocommerce.php';
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
	require get_template_directory() . '/inc/woocommerce/integrations.php';
	require get_template_directory() . '/inc/woocommerce/single-product-template-tags.php';
}

/**
 * Load Dokan compatibility files.
 */
if ( is_dokan_activated() ) {
	require get_template_directory() . '/inc/dokan/functions.php';
	require get_template_directory() . '/inc/dokan/hooks.php';
}

/**
 * WPML.
 * Load WPML compatibility files.
 */
if ( apply_filters( 'electro_load_wpml', false ) && is_wpml_activated() ) {
	require get_template_directory() . '/inc/wpml/class-electro-wpml.php';
}

/**
 * One Click Demo Import
 */
if ( is_ocdi_activated() ) {
	require get_template_directory() . '/inc/ocdi/hooks.php';
	require get_template_directory() . '/inc/ocdi/functions.php';
}

require get_template_directory() . '/inc/other-plugins/compatibility.php';