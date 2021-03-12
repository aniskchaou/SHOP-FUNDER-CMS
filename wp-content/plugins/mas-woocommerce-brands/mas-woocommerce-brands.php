<?php
/**
 * Plugin Name: MAS Brands for WooCommerce
 * Plugin URI: https://github.com/madrasthemes/mas-woocommerce-brands
 * Description: Add brands to your products, as well as widgets and shortcodes for displaying your brands.
 * Version: 1.0.4
 * Author: MadrasThemes
 * Author URI: https://madrasthemes.com/
 * Text Domain: mas-wc-brands
 * Domain Path: /languages/
 * WC tested up to: 4.8
 *
 * @package Mas_WC_Brands
 * @category Core
 * @author Madras Themes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define MAS_WCBR_PLUGIN_FILE.
if ( ! defined( 'MAS_WCBR_PLUGIN_FILE' ) ) {
	define( 'MAS_WCBR_PLUGIN_FILE', __FILE__ );
}

/**
 * Required functions
 */
if ( ! function_exists( 'mas_wcbr_is_woocommerce_active' ) ) {
	function mas_wcbr_is_woocommerce_active() {

		$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}

		return in_array( 'woocommerce/woocommerce.php', $active_plugins ) || array_key_exists( 'woocommerce/woocommerce.php', $active_plugins );
	}
}

if ( mas_wcbr_is_woocommerce_active() ) {
	// Include the main Mas_WC_Brands class.
	if ( ! class_exists( 'Mas_WC_Brands' ) ) {
		include_once dirname( MAS_WCBR_PLUGIN_FILE ) . '/includes/class-mas-wc-brands.php';
	}

	/**
	 * Unique access instance for Mas_WC_Brands class
	 */
	function Mas_WC_Brands() {
		return Mas_WC_Brands::instance();
	}

	// Global for backwards compatibility.
	$GLOBALS['mas_wc_brands'] = Mas_WC_Brands();
}