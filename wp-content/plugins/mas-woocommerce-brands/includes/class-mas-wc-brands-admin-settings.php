<?php
/**
 * Class to configure brand admin settings
 *
 * @package Mas_WC_Brands
 */
if ( ! class_exists( 'Mas_WC_Brands_Admin_Settings' ) ) {
	class Mas_WC_Brands_Admin_Settings {

		var $settings_tabs;
		var $current_tab;
		var $fields = array();

		public function __construct() {

			$this->settings_tabs = array(
				'mas_wc_brands' => esc_html__( 'Brands', 'mas-wc-brands' )
			);

			// Add the settings fields to each tab.
			$this->init_form_fields();

			add_action( 'woocommerce_get_sections_products', array( $this, 'add_settings_tab' ) );
			add_action( 'woocommerce_get_settings_products', array( $this, 'add_settings_section' ), null, 2 );

			add_action( 'woocommerce_update_options_products', array( $this, 'save_admin_settings' ) );
		}

		/**
		 * init_form_fields()
		 *
		 * Prepare form fields to be used in the various tabs.
		 */
		public function init_form_fields() {
			// Define settings
			$this->settings = apply_filters( 'mas_wc_brands_settings_fields', array(

				array( 'name' => esc_html__( 'Brands Settings', 'mas-wc-brands' ), 'type' => 'title','desc' => '', 'id' => 'brands_settings' ),

				array(
					'title'    => esc_html__( 'Brand Attribute', 'mas-wc-brands' ),
					'desc'     => esc_html__( 'Choose a product attribute that will be used as brand.', 'mas-wc-brands' ),
					'id'       => 'mas_wc_brands_brand_taxonomy',
					'class'    => 'wc-enhanced-select',
					'css'      => 'min-width:300px;',
					'default'  => '',
					'type'     => 'select',
					'options'  => $this->get_product_attribute_taxonomies(),
					'desc_tip' => true,
				),

				array(
					'name'     => esc_html__( 'Enable Plugins Styles', 'mas-wc-brands' ),
					'desc'     => esc_html__( 'Choose to enable plugin styles.', 'mas-wc-brands' ),
					'tip'      => '',
					'id'       => 'mas_wc_brands_plugin_styles',
					'css'      => '',
					'default'  => 'yes',
					'std'      => 'yes',
					'type'     => 'checkbox',
				),

				array( 'type' => 'sectionend', 'id' => 'brands_settings' ),

			) ); // End brands settings
		}

		/**
		 * Add the settings for the new "Brands" subtab.
		 * @access public
		 * @return  void
		 */
		public function add_settings_section ( $settings, $current_section ) {
			if ( 'mas_wc_brands' == $current_section ) {
				$settings = $this->settings;
			}
			return $settings;
		} // End add_settings_section()

		/**
		 * Add a new "Brands" subtab to the "Products" tab.
		 * @access public
		 * @return  void
		 */
		public function add_settings_tab ( $sections ) {
			$sections = array_merge( $sections, $this->settings_tabs );
			return $sections;
		} // End add_settings_tab()

		/**
		 * save_admin_settings function.
		 *
		 * @access public
		 */
		public function save_admin_settings() {
			if ( isset( $_GET['section'] ) && 'mas_wc_brands' === $_GET['section'] ) {
				woocommerce_update_options( $this->settings );
			}
		}

		/**
		 * Get All Product Attribute Taxonomies
		 *
		 * @return array
		 */
		public function get_product_attribute_taxonomies() {
			$product_taxonomies 	= array( '' => esc_html__( 'Choose a attribute', 'mas-wc-brands' ) );
			$attribute_taxonomies 	= wc_get_attribute_taxonomies();

			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {
					$product_taxonomies[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
				}
			}

			return $product_taxonomies;
		}
	}
}

new Mas_WC_Brands_Admin_Settings();