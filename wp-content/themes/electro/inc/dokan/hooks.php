<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts',					'electro_dokan_scripts', 				11 );

add_action( 'woocommerce_after_main_content', 		'electro_dokan_after_wc_content', 		11 );

add_filter( 'electro_show_shop_sidebar', 			'electro_dokan_toggle_shop_sidebar', 	100 );

add_action( 'widgets_init',							'electro_setup_dokan_sidebars',			10 );

add_filter( 'body_class',							'electro_dokan_body_classes',			100 );

add_action( 'dokan_product_edit_after_inventory_variants', 'electro_dokan_product_edit_add_specifications', 10, 2 );

add_action( 'dokan_sidebar_store_after', 'electro_dokan_store_owner_info', 20 );

add_action( 'electro_dokan_store_before_header', 'electro_dokan_vendor_page_modify_hooks', 10 );

add_filter( 'dokan_follow_store_button_label_follow', 'electro_dokan_follow_store_button_label_follow' );
add_filter( 'dokan_follow_store_button_label_following', 'electro_dokan_follow_store_button_label_following' );
add_filter( 'dokan_follow_store_button_label_unfollow', 'electro_dokan_follow_store_button_label_unfollow' );

add_action( 'dokan_electro_store_list_after', 'electro_dokan_store_list_sidebar', 10 );