<?php
/**
 * Additional functions used by the theme
 */

/**
 * Call a shortcode function by tag name.
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function electro_do_shortcode( $tag, array $atts = array(), $content = null ) {
	global $shortcode_tags;
	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}

	if ( $tag == 'products' && ! isset( $atts['orderby'] ) ) {
		$atts['orderby'] = 'post__in';
	}

	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

if ( ! function_exists( 'is_electro_customizer_enabled' ) ) {
	/**
	 * Check whether the Electro Customizer settings are enabled
	 * @return boolean
	 */
	function is_electro_customizer_enabled() {
		return apply_filters( 'electro_customizer_enabled', true );
	}
}

if ( ! function_exists( 'electro_page_menu_args' ) ) {
	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 *
	 * @param array $args Configuration arguments.
	 * @return array
	 */
	function electro_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
}

/**
 * Enables template debug mode
 */
function electro_template_debug_mode() {
	if ( ! defined( 'ELECTRO_TEMPLATE_DEBUG_MODE' ) ) {
		$status_options = get_option( 'woocommerce_status_options', array() );
		if ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) {
			define( 'ELECTRO_TEMPLATE_DEBUG_MODE', true );
		} else {
			define( 'ELECTRO_TEMPLATE_DEBUG_MODE', false );
		}
	}
}

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */

function electro_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}

	$located = electro_locate_template( $template_name, $template_path, $default_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
		return;
	}

	// Allow 3rd party plugin filter template file from their plugin
	$located = apply_filters( 'electro_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'electro_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'electro_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function electro_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = 'templates/';
	}

	if ( ! $default_path ) {
		$default_path = 'templates/';
	}

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template || ELECTRO_TEMPLATE_DEBUG_MODE ) {
		$template = $default_path . $template_name;
	}

	// Return what we found
	return apply_filters( 'electro_locate_template', $template, $template_name, $template_path );
}

if ( ! function_exists( 'electro_get_social_networks' ) ) {
	/**
	 * List of all available social networks
	 *
	 * @return array array of all social networks and its details
	 */
	function electro_get_social_networks() {
		return apply_filters( 'electro_get_social_networks', array(
			'facebook' 		=> array(
				'label'	=> esc_html__( 'Facebook', 'electro' ),
				'icon'	=> 'fab fa-facebook',
				'id'	=> 'facebook_link',
				'link'	=> '#',
			),
			'twitter' 		=> array(
				'label'	=> esc_html__( 'Twitter', 'electro' ),
				'icon'	=> 'fab fa-twitter',
				'id'	=> 'twitter_link',
				'link'	=> '#',
			),
			'whatsapp-mobile' 	=> array(
				'label'	=> esc_html__( 'Whatsapp Mobile', 'electro' ),
				'icon'	=> 'fab fa-whatsapp mobile',
				'id'	=> 'whatsapp_mobile_link',
			),
			'whatsapp-desktop' 	=> array(
				'label'	=> esc_html__( 'Whatsapp Desktop', 'electro' ),
				'icon'	=> 'fab fa-whatsapp desktop',
				'id'	=> 'whatsapp_desktop_link',
			),
			'pinterest' 	=> array(
				'label'	=> esc_html__( 'Pinterest', 'electro' ),
				'icon'	=> 'fab fa-pinterest',
				'id'	=> 'pinterest_link',
				'link'	=> '#',
			),
			'linkedin' 		=> array(
				'label'	=> esc_html__( 'LinkedIn', 'electro' ),
				'icon'	=> 'fab fa-linkedin',
				'id'	=> 'linkedin_link',
				'link'	=> '#',
			),
			'googleplus' 	=> array(
				'label'	=> esc_html__( 'Google+', 'electro' ),
				'icon'	=> 'fab fa-google-plus',
				'id'	=> 'googleplus_link',
				'link'	=> '#',
			),
			'tumblr' 	=> array(
				'label'	=> esc_html__( 'Tumblr', 'electro' ),
				'icon'	=> 'fab fa-tumblr',
				'id'	=> 'tumblr_link'
			),
			'instagram' 	=> array(
				'label'	=> esc_html__( 'Instagram', 'electro' ),
				'icon'	=> 'fab fa-instagram',
				'id'	=> 'instagram_link'
			),
			'youtube' 		=> array(
				'label'	=> esc_html__( 'Youtube', 'electro' ),
				'icon'	=> 'fab fa-youtube',
				'id'	=> 'youtube_link'
			),
			'vimeo' 		=> array(
				'label'	=> esc_html__( 'Vimeo', 'electro' ),
				'icon'	=> 'fab fa-vimeo-square',
				'id'	=> 'vimeo_link'
			),
			'dribbble' 		=> array(
				'label'	=> esc_html__( 'Dribbble', 'electro' ),
				'icon'	=> 'fab fa-dribbble',
				'id'	=> 'dribbble_link',
				'link'	=> '#',
			),
			'stumbleupon' 	=> array(
				'label'	=> esc_html__( 'StumbleUpon', 'electro' ),
				'icon'	=> 'fab fa-stumbleupon',
				'id'	=> 'stumble_upon_link'
			),
			'soundcloud'    => array(
				'label' => esc_html__('Sound Cloud', 'electro'),
				'id'    => 'soundcloud_link',
				'icon'  => 'fab fa-soundcloud',
			),

			'vine'           => array(
				'label' => esc_html__('Vine', 'electro'),
				'id'    => 'vine_link',
				'icon'  => 'fab fa-vine',
			),

			'vk'              => array(
				'label' => esc_html__('VKontakte', 'electro'),
				'id'    => 'vk_link',
				'icon'  => 'fab fa-vk',
			),

			'telegram'        => array(
				'label' => esc_html__('Telegram', 'electro'),
				'id'    => 'telegram_link',
				'icon'  => 'fab fa-telegram',
			),

			'rss'			=> array(
				'label'	=> esc_html__( 'RSS', 'electro' ),
				'icon'	=> 'fas fa-rss',
				'id'	=> 'rss_link',
				'link'	=> get_bloginfo( 'rss2_url' ),
			)
		) );
	}
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'electro_is_woocommerce_activated' ) ) {
	function electro_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;	
	}
}

if ( ! function_exists( 'is_dokan_activated' ) ) {
	function is_dokan_activated() {
		return class_exists( 'WeDevs_Dokan' ) ? true : false;
	}
}

if ( ! function_exists( 'is_dokan_pro_activated' ) ) {
	function is_dokan_pro_activated() {
		return class_exists( 'Dokan_Pro' ) ? true : false;
	}
}

/**
 * Check if Visual Composer is activated
 */
if( ! function_exists( 'is_vc_activated' ) ) {
	function is_vc_activated() {
		return class_exists( 'WPBakeryVisualComposerAbstract' ) ? true : false;
	}
}

/**
 * Check if Elementor is activated
 */
if( ! function_exists( 'is_elementor_activated' ) ) {
	function is_elementor_activated() {
		return did_action( 'elementor/loaded' ) ? true : false;
	}
}

/**
 * Check if Redux Framework is activated
 */
if( ! function_exists( 'is_redux_activated' ) ) {
	function is_redux_activated() {
		return class_exists( 'ReduxFrameworkPlugin' ) ? true : false;
	}
}

/**
 * Query WooCommerce Extension Activation.
 * @var  $extension main extension class name
 * @return boolean
 */
function is_woocommerce_extension_activated( $extension ) {

	if( is_woocommerce_activated() ) {
		$is_activated = class_exists( $extension ) ? true : false;
	} else {
		$is_activated = false;
	}

	return $is_activated;
}

/**
 * Checks if YITH Wishlist is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_yith_wcwl_activated' ) ) {
	function is_yith_wcwl_activated() {
		return is_woocommerce_extension_activated( 'YITH_WCWL' );
	}
}

/**
 * Checks if YITH WooCompare is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_yith_woocompare_activated' ) ) {
	function is_yith_woocompare_activated() {
		return is_woocommerce_extension_activated( 'YITH_Woocompare' );
	}
}

/**
 * Checks if YITH WooCommerce Zoom Magnifier is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_yith_zoom_magnifier_activated' ) ) {
	function is_yith_zoom_magnifier_activated() {
		return is_woocommerce_extension_activated( 'YITH_WooCommerce_Zoom_Magnifier' );
	}
}

/**
 * Checks if WooCommerce PayPal Checkout Gateway is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_wc_gateway_ppec' ) ) {
    function is_wc_gateway_ppec() {
        return is_woocommerce_extension_activated( 'WC_GATEWAY_PPEC' );
    }
}

/**
 * Checks if WooCommerce simple auction is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_wc_simple_auction_activated' ) ) {
	function is_wc_simple_auction_activated() {
		return is_woocommerce_extension_activated( 'WooCommerce_simple_auction' );
	}
}

/**
 * Checks if WPML is activated
 *
 * @return  boolean
 */
if( ! function_exists( 'is_wpml_activated' ) ) {
	function is_wpml_activated() {
		return function_exists( 'icl_object_id' ) && class_exists('SitePress');
	}
}

if ( ! function_exists( 'is_yith_wcan_activated' ) ) {
	function is_yith_wcan_activated() {
		return function_exists( 'YITH_WCAN' );
	}
}

/**
 * Checks if WooCommerce Product Reviews Pro is activated
 *
 * @return boolean
 */
if( ! function_exists( 'is_wc_product_reviews_activated' ) ) {
	function is_wc_product_reviews_activated() {
		return is_woocommerce_extension_activated( 'WC_Product_Reviews_Pro' );
	}
}

/**
 * Checks if Revslider is activated
 *
 * @return  boolean
 */
if( ! function_exists( 'is_revslider_activated' ) ) {
	function is_revslider_activated() {
		return function_exists( 'putRevSlider' );
	}
}

if( ! function_exists( 'is_ocdi_activated' ) ) {
	/**
	 * Check if One Click Demo Import is activated
	 */
	function is_ocdi_activated() {
		return class_exists( 'OCDI_Plugin' ) ? true : false;
	}
}

/**
 * Clean variables using sanitize_text_field.
 * @param string|array $var
 * @return string|array
 */
function electro_clean( $var ) {
	return is_array( $var ) ? array_map( 'electro_clean', $var ) : sanitize_text_field( $var );
}

/**
 * Clean variables using wp_kses_post.
 * @param string|array $var
 * @return string|array
 */
function electro_clean_kses_post( $var ) {
	return is_array( $var ) ? array_map( 'electro_clean_kses_post', $var ) : wp_kses_post( stripslashes( $var ) );
}

if ( ! function_exists( 'electro_pr' ) ) {
	function electro_pr( $var ) {
		echo '<pre>' . print_r( $var, 1 ) . '</pre>';
	}
}

/*function electro_x_kses_allow_data_attributes() {
  global $allowedposttags;
	$tags = array( 'a' );
	$new_attributes = array(
		'data-product_sku'	=> true,
		'data-product_id'	=> true,
		'data-product-id'	=> true,
		'data-product-type'	=> true,
		'data-quantity'		=> true,
	);
	foreach ( $tags as $tag ) {
		if ( isset( $allowedposttags[ $tag ] ) && is_array( $allowedposttags[ $tag ] ) ) {
			$allowedposttags[ $tag ] = array_merge( $allowedposttags[ $tag ], $new_attributes );
		}
	}
}*/

add_filter( 'wp_kses_allowed_html', 'electro_add_data_attr', 10, 2 );

function electro_add_data_attr( $allowed, $context ) {

	if ( is_array( $context ) ) {
		return $allowed;
	}

	if ( $context === 'post' ) {
		$allowed['a']['data-product_sku']	= true;
		$allowed['a']['data-product_id']	= true;
		$allowed['a']['data-product-id']	= true;
		$allowed['a']['data-product-type']	= true;
		$allowed['a']['data-quantity']	    = true;
	}
	return $allowed;
}

if ( ! function_exists( 'electro_is_yith_multistep_checkout_activated' ) ) {
	function electro_is_yith_multistep_checkout_activated() {
		return function_exists( 'YITH_Multistep_Checkout' ) && YITH_Multistep_Checkout()->is_plugin_enabled;
	}
}

if ( ! function_exists( 'electro_is_prdctfltr_activated' ) ) {
	function electro_is_prdctfltr_activated() {
		return function_exists( 'Prdctfltr' );
	}
}

/*
 * Remove action of anonymous class object
 */
if ( ! function_exists( 'electro_remove_class_action' ) ) {
	function electro_remove_class_action( $hook_name = '', $class_name = '', $method_name = '', $priority = 10 ) {
		global $wp_filter;
		// Take only filters on right hook name and priority
		if ( ! isset( $wp_filter[ $hook_name ][ $priority ] ) || ! is_array( $wp_filter[ $hook_name ][ $priority ] ) ) {
			return false;
		}
		// Loop on filters registered
		foreach ( (array) $wp_filter[ $hook_name ][ $priority ] as $unique_id => $filter_array ) {
			// Test if filter is an array ! (always for class/method)
			if ( isset( $filter_array['function'] ) && is_array( $filter_array['function'] ) ) {
				// Test if object is a class, class and method is equal to param !
				if ( is_object( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) == $class_name && $filter_array['function'][1] == $method_name ) {
					// Test for WordPress >= 4.7 WP_Hook class (https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/)
					if ( is_a( $wp_filter[ $hook_name ], 'WP_Hook' ) ) {
						unset( $wp_filter[ $hook_name ]->callbacks[ $priority ][ $unique_id ] );
					} else {
						unset( $wp_filter[ $hook_name ][ $priority ][ $unique_id ] );
					}
				}
			}
		}
		return false;
	}
}