<?php
/**
 * Electro Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Electro_Admin class.
 */
class Electro_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
	}

	/**
	 * Include any classes we need within admin
	 */
	public function includes() {
		include_once( 'electro-admin-functions.php' );
		include_once( 'electro-meta-box-functions.php' );
		include_once( 'class-electro-admin-meta-boxes.php' );
		include_once( 'class-electro-admin-assets.php' );

		// Help Tabs
		if ( apply_filters( 'electro_enable_admin_help_tab', true ) ) {
			//include_once( 'class-wc-admin-help.php' );
		}

		$this->load_meta_boxes();
	}

	public function load_meta_boxes() {
		include_once( 'meta-boxes/class-electro-meta-box-home-v1.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v2.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v3.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v4.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v5.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v6.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v7.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v8.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v9.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v10.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-mobile-v1.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-mobile-v2.php' );
		include_once( 'meta-boxes/class-electro-meta-box-page.php' );
	}
}

return new Electro_Admin();
