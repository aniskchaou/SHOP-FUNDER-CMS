<?php
/**
 * Electro Hooks
 *
 * @package  Electro/Functions
 */

/**
 * Setup
 */
add_action( 'after_setup_theme', 	'electro_setup',							10 );
add_action( 'after_setup_theme',	'electro_register_image_sizes', 			10 );
add_action( 'after_setup_theme', 	'electro_template_debug_mode',				20 );
add_action( 'tgmpa_register', 		'electro_register_required_plugins',		10 );
add_action( 'widgets_init',			'electro_setup_sidebars',					10 );
add_action( 'widgets_init',			'electro_register_widgets',					20 );
add_action( 'init',					'electro_remove_locale_stylesheet',			10 );

add_action( 'homepage_v5',              'electro_home_v5_slider',                           10 );
//add_action( 'homepage_v5',              'electro_home_v5_onsale_product_carousel',          20 );
add_action( 'homepage_v5',              'electro_home_v5_product_tabs_carousel',            30 );
add_action( 'homepage_v5',              'electro_home_v5_ads_block',                        40 );
add_action( 'homepage_v5',              'electro_home_v5_products_carousel',                50 );
add_action( 'homepage_v5',              'electro_home_v5_product_carousel_v5_1',            60 );
add_action( 'homepage_v5',              'electro_home_v5_ad_banner',                        70 );
add_action( 'homepage_v5',              'electro_home_v5_product_carousel_v5_2',            80 );
add_action( 'homepage_v5',              'electro_home_v5_product_cards_carousel',           90 );
add_action( 'homepage_v5',              'electro_home_v5_categories_block',                100 );
add_action( 'homepage_v5',              'electro_home_v5_ads_with_banners',                110 );

add_action( 'electro_before_homepage_v1',				'electro_home_v1_hook_control',						10 );
add_action( 'electro_before_homepage_v2',				'electro_home_v2_hook_control',						10 );
add_action( 'electro_before_homepage_v3',				'electro_home_v3_hook_control',						10 );
add_action( 'electro_before_homepage_v4',               'electro_home_v4_hook_control',                     10 );

/**
 * Sidebar
 */
add_action( 'electro_sidebar',			'electro_get_sidebar',			10 );

/**
 * Footer
 */
add_action( 'electro_before_footer', 	'electro_footer_brands_carousel', 	10 );

add_action( 'electro_footer', 			'electro_footer_widgets', 			10 );
add_action( 'electro_footer',			'electro_footer_divider',			20 );
add_action( 'electro_footer',			'electro_footer_bottom_widgets',	30 );
add_action( 'electro_footer',			'electro_copyright_bar',			40 );
add_action( 'electro_after_footer',     'electro_handheld_footer_bar',      999 );

add_action( 'electro_footer_contact', 	'electro_footer_logo', 				10 );
add_action( 'electro_footer_contact', 	'electro_footer_call_us', 			20 );
add_action( 'electro_footer_contact', 	'electro_footer_address', 			30 );
add_action( 'electro_footer_contact', 	'electro_footer_social_icons', 		40 );

add_action( 'electro_footer_divider',	'electro_footer_newsletter',		10 );

add_action( 'electro_default_footer_bottom_widgets', 'electro_default_fb_widgets', 20 );
