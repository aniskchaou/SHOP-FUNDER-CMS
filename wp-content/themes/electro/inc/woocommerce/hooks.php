<?php
/**
 * Electro WooCommerce Hooks
 *
 * @package  Electro/WooCommerce
 */

/**
 * Setup WooCommerce
 */
add_action( 'after_setup_theme', 							'electro_product_category_taxonomy_fields',		10 );
add_action( 'after_setup_theme', 							'electro_setup_brands_taxonomy',				10 );

/**
 * Layout
 */
remove_action( 'woocommerce_before_main_content', 			'woocommerce_breadcrumb', 						20, 0 );
remove_action( 'woocommerce_before_main_content', 			'woocommerce_output_content_wrapper', 			10 );
remove_action( 'woocommerce_after_main_content', 			'woocommerce_output_content_wrapper_end', 		10 );
remove_action( 'woocommerce_sidebar', 						'woocommerce_get_sidebar', 						10 );
add_action( 'woocommerce_before_main_content', 				'electro_before_wc_content', 					10 );
add_action( 'woocommerce_before_main_content', 				'electro_before_product_archive_content', 		20 );
add_action( 'woocommerce_before_main_content',				'electro_shop_archive_jumbotron',				50 );
add_action( 'woocommerce_after_main_content', 				'electro_after_wc_content', 					10 );

require_once get_template_directory() . '/inc/woocommerce/template-hooks/header.php';

/**
 * After Page
 */
add_action( 'electro_after_page',   'electro_shopping_cart_summary',        10 );
add_action( 'electro_after_page',   'electro_offcanvas_overlay',            20 );

/**
 * Product Archive
 */
remove_action( 'woocommerce_before_shop_loop', 				'woocommerce_result_count', 					20 );
remove_action( 'woocommerce_before_shop_loop', 				'woocommerce_catalog_ordering', 				30 );
remove_action( 'woocommerce_after_shop_loop',				'woocommerce_pagination',						10 );
add_action( 'woocommerce_before_shop_loop', 				'electro_product_subcategories', 				0  );
add_action( 'woocommerce_before_shop_loop',					'electro_wc_loop_title',						10 );
add_action( 'woocommerce_before_shop_loop',					'electro_shop_control_bar',						11 );
add_action( 'woocommerce_before_shop_loop',					'electro_reset_woocommerce_loop', 				90 );
add_action( 'electro_shop_control_bar',						'electro_wc_handheld_sidebar',					8 );
add_action( 'electro_shop_control_bar',						'electro_shop_view_switcher',					10 );
add_action( 'electro_shop_control_bar',						'woocommerce_catalog_ordering',					20 );
add_action( 'electro_shop_control_bar',						'electro_wc_products_per_page',					30 );
add_action( 'electro_shop_control_bar',						'electro_advanced_pagination',					40 );
add_action( 'woocommerce_after_shop_loop',					'electro_shop_control_bar_bottom',				90 );
add_action( 'electro_shop_control_bar_bottom',				'woocommerce_result_count',						20 );
add_action( 'electro_shop_control_bar_bottom',				'woocommerce_pagination',						30 );
add_action( 'woocommerce_after_shop_loop',                  'electro_shop_bottom_archive_jumbotron',        95 );

/**
 * Product Item
 */
require_once get_template_directory() . '/inc/woocommerce/template-hooks/loop.php';

add_action( 'woocommerce_shop_loop',						'electro_shop_loop',							10 );

/**
 * Product Card View
 */
add_action( 'electro_before_card_view',						'electro_wrap_product_outer', 					10 );
add_action( 'electro_before_product_card_view_body',		'electro_product_media_object', 				10 );
add_action( 'electro_product_card_view_body',				'electro_template_loop_categories',				10 );
add_action( 'electro_product_card_view_body',				'woocommerce_template_loop_product_link_open',	20 );
add_action( 'electro_product_card_view_body',				'woocommerce_template_loop_product_title',		30 );
add_action( 'electro_product_card_view_body',				'woocommerce_template_loop_product_link_close',	40 );
add_action( 'electro_product_card_view_body',				'electro_wrap_price_and_add_to_cart',			50 );
add_action( 'electro_product_card_view_body',				'woocommerce_template_loop_price',				60 );
add_action( 'electro_product_card_view_body',				'woocommerce_template_loop_add_to_cart',		70 );
add_action( 'electro_product_card_view_body',				'electro_wrap_price_and_add_to_cart_close',		80 );
//add_action( 'electro_product_card_view_body',				'electro_template_loop_hover',					90 );
add_action( 'electro_after_card_view',						'electro_wrap_product_outer_close', 			10 );

/**
 * Product On Sale
 */
add_action( 'electro_onsale_product_content',				'woocommerce_template_loop_product_link_open',	10 );
add_action( 'electro_onsale_product_content',				'electro_template_loop_product_thumbnail',		20 );
add_action( 'electro_onsale_product_content',				'woocommerce_template_loop_product_title',		30 );
add_action( 'electro_onsale_product_content',				'woocommerce_template_loop_product_link_close',	40 );
add_action( 'electro_onsale_product_content',				'woocommerce_template_loop_price',				50 );
add_action( 'electro_onsale_product_content',				'electro_deal_progress_bar',					60 );
add_action( 'electro_onsale_product_content',				'electro_deal_countdown_timer',					70 );


/**
 * Product On Sale Carousel
 */

add_action( 'electro_onsale_product_carousel_content',		'woocommerce_template_loop_product_link_open',	10 );
add_action( 'electro_onsale_product_carousel_content',		'woocommerce_template_loop_product_title',		20 );
add_action( 'electro_onsale_product_carousel_content',		'woocommerce_template_loop_product_link_close',	30 );
add_action( 'electro_onsale_product_carousel_content',		'woocommerce_template_loop_price',				40 );
add_action( 'electro_onsale_product_carousel_content',		'electro_deal_progress_bar',					50 );
add_action( 'electro_onsale_product_carousel_content',		'electro_deal_countdown_timer',					60 );
add_action( 'electro_onsale_product_carousel_content',		'electro_deal_cart_button',						70 );


/**
 * Product On Sale Carousel v2
 */

//
//add_action( 'electro_onsale_product_carousel_content_v2',      'electro_template_loop_product_thumbnail',      10 );
add_action( 'electro_onsale_product_carousel_content_v2',      'electro_onsale_product_content_wrapper_start', 20 );
add_action( 'electro_onsale_product_carousel_content_v2',      'woocommerce_template_loop_product_link_open',  30 );
add_action( 'electro_onsale_product_carousel_content_v2',      'woocommerce_template_loop_product_title',      40 );
add_action( 'electro_onsale_product_carousel_content_v2',      'woocommerce_template_loop_product_link_close', 50 );
add_action( 'electro_onsale_product_carousel_content_v2',      'woocommerce_template_loop_price',              60 );
add_action( 'electro_onsale_product_carousel_content_v2',      'electro_deal_countdown_timer',                 70 );
add_action( 'electro_onsale_product_carousel_content_v2',      'electro_deal_progress_bar',                    80 );
add_action( 'electro_onsale_product_carousel_content_v2',      'electro_onsale_product_content_wrapper_end',   100 );

/**
 * Product On Sale Carousel v3
 */

add_action( 'electro_onsale_product_carousel_content_v3',      'electro_onsale_product_content_wrapper_start', 10 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_header_open',            20 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_template_loop_product_link_open',  30 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_template_loop_product_title',      40 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_template_loop_product_link_close', 50 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_header_close',           60 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_body_open',              70 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_template_loop_product_link_open',  80 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_product_thumbnail',      90 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_template_loop_product_link_close', 100 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_body_close',             110 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_footer_open',            120 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_show_product_sale_flash',          130 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_wrap_price_and_add_to_cart',           140 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_template_loop_price',              150 );
add_action( 'electro_onsale_product_carousel_content_v3',      'woocommerce_template_loop_add_to_cart',        160 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_wrap_price_and_add_to_cart_close',     170 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_availability',           180 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_template_loop_footer_close',           190 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_onsale_product_content_wrapper_end',   200 );
add_action( 'electro_onsale_product_carousel_content_v3',      'electro_deal_countdown_timer_v2',              210 );

/**
 * Product On Sale Carousel v2
 */
add_action( 'electro_deal_products_with_featured_content',      'woocommerce_template_loop_product_link_open',  10 );
add_action( 'electro_deal_products_with_featured_content',      'electro_deal_save_label',                      20 );
add_action( 'electro_deal_products_with_featured_content',      'electro_template_loop_product_thumbnail',      30 );
add_action( 'electro_deal_products_with_featured_content',      'woocommerce_template_loop_product_link_close', 40 );
add_action( 'electro_deal_products_with_featured_content',      'electro_onsale_product_content_wrapper_start', 50 );
add_action( 'electro_deal_products_with_featured_content',      'woocommerce_template_loop_product_link_open',  60 );
add_action( 'electro_deal_products_with_featured_content',      'woocommerce_template_loop_product_title',      70 );
add_action( 'electro_deal_products_with_featured_content',      'woocommerce_template_loop_product_link_close', 80 );
add_action( 'electro_deal_products_with_featured_content',      'woocommerce_template_loop_price',              90 );
add_action( 'electro_deal_products_with_featured_content',      'electro_onsale_product_content_wrapper_end',   100 );

/**
 * Product Carousel Alt
 */

add_action( 'electro_product_carousel_alt_content',			'woocommerce_template_loop_product_link_open',	10 );
add_action( 'electro_product_carousel_alt_content',			'electro_template_loop_product_thumbnail',		20 );
add_action( 'electro_product_carousel_alt_content',			'woocommerce_template_loop_product_link_close',	25 );
add_action( 'electro_product_carousel_alt_content',			'electro_template_loop_categories',				30 );
add_action( 'electro_product_carousel_alt_content',			'woocommerce_template_loop_product_link_open',	35 );
add_action( 'electro_product_carousel_alt_content',			'woocommerce_template_loop_product_title',		40 );
add_action( 'electro_product_carousel_alt_content',			'woocommerce_template_loop_product_link_close',	50 );
add_action( 'electro_product_carousel_alt_content',			'woocommerce_template_loop_price',				60 );

require_once get_template_directory() . '/inc/woocommerce/template-hooks/single-product.php';

/**
 * Cart Page
 */
add_action( 'woocommerce_cart_actions',						'electro_proceed_to_checkout' );

/**
 * Checkout Page
 */
add_action( 'woocommerce_checkout_shipping',				'electro_shipping_details_header',				0 );
add_action( 'woocommerce_checkout_before_order_review',     'electro_wrap_order_review',                    0 );
add_action( 'woocommerce_checkout_after_order_review',      'electro_wrap_order_review_close',              0 );

/**
 * My Account Page
 */
add_action( 'woocommerce_before_customer_login_form',		'electro_wrap_customer_login_form',				0  );
add_action( 'woocommerce_after_customer_login_form',		'electro_wrap_customer_login_form_close',		0  );
add_action( 'woocommerce_login_form_start',					'electro_before_login_text',					10 );
add_action( 'woocommerce_register_form_start',				'electro_before_register_text',					10 );
add_action( 'woocommerce_register_form_end',				'electro_register_benefits',					10 );

/**
 * Order Tracking
 */
add_action( 'woocommerce_track_order',						'electro_wrap_track_order',						0  );
add_action( 'woocommerce_view_order',						'electro_wrap_track_order_close',				PHP_INT_MAX );

/**
 * Products Live Search
 */
add_action( 'wp_ajax_nopriv_products_live_search',			'electro_products_live_search' );
add_action( 'wp_ajax_products_live_search',					'electro_products_live_search' );

/**
 * Footer
 */
add_action( 'electro_default_footer_widgets', 				'electro_default_wc_footer_widgets', 			10 );
add_action( 'electro_default_footer_bottom_widgets', 		'electro_default_wc_fb_widgets', 				10 );

/**
 * Filters
 */
add_filter( 'woocommerce_enqueue_styles', 					'__return_empty_array' );
add_filter( 'woocommerce_breadcrumb_defaults', 				'electro_change_breadcrumb_delimiter' );
add_filter( 'loop_shop_columns',							'electro_set_loop_shop_columns', 				10 );
add_filter( 'loop_shop_columns_wide',                       'electro_set_loop_shop_columns_wide',           10 );
add_filter( 'loop_shop_per_page', 							'electro_set_loop_shop_per_page', 				20 );
add_filter( 'woocommerce_pagination_args',					'electro_set_pagination_args',					10 );
add_filter( 'woocommerce_get_price_html',					'electro_wrap_price_html',						90 );
add_filter( 'woocommerce_add_to_cart_fragments',			'electro_mini_cart_fragment' );
add_filter( 'woocommerce_single_product_carousel_options',  'electro_wc_single_product_carousel_options',   10 );
add_filter( 'woocommerce_single_product_image_gallery_classes',	'electro_single_product_image_gallery_classes' );
add_filter( 'woocommerce_loop_add_to_cart_link',            'electro_wrap_add_to_cart_link',                90, 2 );
add_filter( 'woocommerce_sale_flash',                       'electro_get_sale_flash',                       20, 3 );
add_filter( 'woocommerce_structured_data_product',          'electro_structured_data_product',              10, 2 );

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
	add_filter( 'woocommerce_get_price_html_from_to',			'electro_get_price_html_from_to',				10, 4 );
} else {
	add_filter( 'woocommerce_format_sale_price',			'electro_wc_format_sale_price',				10, 3 );
}

/**
 * Recently Viewed Products
 */
add_action( 'template_redirect',    'electro_wc_track_product_view', 10 );

/**
 * Structured Data
 *
 * @see electro_woocommerce_init_structured_data()
 */
add_action( 'woocommerce_before_shop_loop_item', 			'electro_woocommerce_init_structured_data' );
