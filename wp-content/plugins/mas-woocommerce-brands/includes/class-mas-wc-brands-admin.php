<?php
/**
 * Class to setup brand admin
 *
 * @package Mas_WC_Brands
 */
if ( ! class_exists( 'Mas_WC_Brands_Admin' ) ) {
	class Mas_WC_Brands_Admin {

		public function __construct() {

			// Add scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );

			$this->includes();
		}

		/**
		 * scripts function.
		 *
		 * @return void
		 */
		public function scripts() {
			$screen = get_current_screen();
			$screen_id = $screen ? $screen->id : '';

			if ( strstr( $screen_id, 'edit-pa_' ) ) {
				$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
				wp_enqueue_media();
				wp_register_script( 'mas-wc-brands-admin', plugins_url( 'assets/js/admin' . $suffix . '.js', MAS_WCBR_PLUGIN_FILE ), array( 'jquery' ), Mas_WC_Brands()->version );

				$js_options = apply_filters( 'mas_wc_brands_admin_localize_script_data', array(
					'media_title'			=> esc_html__( 'Choose an image', 'mas-wc-brands' ),
					'media_btn_text'		=> esc_html__( 'Use image', 'mas-wc-brands' ),
					'placeholder_img_src'	=> wc_placeholder_img_src()
				) );

				wp_localize_script( 'mas-wc-brands-admin', 'mas_wc_brands_admin_options', $js_options );
			}
		}

		/**
		 * Include any classes we need within admin.
		 */
		public function includes() {
			include_once( MAS_WCBR_ABSPATH . 'includes/class-mas-wc-brands-admin-settings.php' );
			include_once( MAS_WCBR_ABSPATH . 'includes/class-mas-wc-brands-admin-taxonomies.php' );
		}
	}
}