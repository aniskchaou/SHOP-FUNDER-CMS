<?php
/**
 * Redux Framworks hooks
 *
 * @package Electro/ReduxFramework
 */
add_action( 'init',                                            'redux_remove_demo_mode' );
add_action( 'redux/page/electro_options/enqueue',              'redux_queue_font_awesome' );

//General Filters
add_filter( 'electro_enable_scrollup',                         'redux_toggle_scrollup',                        10 );
add_filter( 'electro_register_image_sizes',                    'redux_toggle_register_image_size',             10 );
add_filter( 'electro_load_child_theme',                        'redux_toggle_electro_child_style',             10 );
add_filter( 'electro_home_sidebar_margin_top',                 'redux_apply_home_sidebar_margin_top',          10 );
add_filter( 'electro_is_wide_enabled',                         'redux_wide_enabled',                           10 );

// Shop Filters
add_filter( 'electro_shop_catalog_mode',                       'redux_toggle_shop_catalog_mode',                10 );
add_filter( 'woocommerce_loop_add_to_cart_link',               'redux_apply_catalog_mode_for_product_loop',  85, 2 );
add_filter( 'electro_shop_views_args',                         'redux_set_shop_view_args',                      10 );
add_filter( 'electro_shop_layout',                             'redux_apply_shop_layout',                       10 );
add_filter( 'electro_shop_loop_subcategories_columns',         'redux_apply_shop_loop_subcategories_columns',   10 );
add_filter( 'electro_shop_loop_products_columns',              'redux_apply_shop_loop_products_columns',        10 );
add_filter( 'electro_shop_loop_products_columns_wide',         'redux_apply_shop_loop_products_columns_wide',   10 );
add_filter( 'electro_loop_shop_per_page',                      'redux_apply_shop_loop_per_page',                10 );
add_filter( 'electro_single_product_layout',                   'redux_apply_single_product_layout',             10 );
add_filter( 'electro_single_product_layout_style',             'redux_apply_single_product_layout_style',       10 );
add_filter( 'electro_enable_single_product_sidebar',           'redux_toggle_single_product_sidebar',           10 );
add_filter( 'electro_enable_related_products',                 'redux_toggle_related_products_output',          10 );
add_filter( 'electro_wc_show_product_thumbnails_carousel',     'redux_toggle_wc_product_thumbnails_carousel',   10 );
add_filter( 'body_class',                                      'redux_apply_sticky_add_to_cart_mobile',         10 );
add_filter( 'electro_product_brand_taxonomy',                  'redux_apply_product_brand_taxonomy',            10 );
add_filter( 'electro_product_comparison_page_id',              'redux_apply_product_comparison_page_id',        10 );
add_filter( 'electro_shop_jumbotron_id',                       'redux_apply_shop_jumbotron_id',                 10 );
add_filter( 'electro_shop_bottom_jumbotron_id',                'redux_apply_shop_bottom_jumbotron_id',          10 );
add_filter( 'electro_before_login_text',                       'redux_apply_myaccount_before_login_text',       10 );
add_filter( 'electro_before_register_text',                    'redux_apply_myaccount_before_register_text',    10 );
add_filter( 'electro_register_benefits',                       'redux_apply_myaccount_register_benefits',       10 );
add_filter( 'electro_register_benefits_title',                 'redux_apply_myaccount_register_benefits_title', 10 );
add_filter( 'electro_enable_single_product_timer',             'redux_toggle_single_product_timer',             10 );

add_filter( 'electro_is_dokan_electro_store_list_version',     'redux_apply_dokan_electro_store_list_version',  10 );
add_filter( 'electro_is_dokan_store_list_sidebar_enable',      'redux_toggle_dokan_store_list_sidebar',         10 );
add_filter( 'electro_is_dokan_electro_store_style',            'redux_toggle_dokan_electro_store_style',        10 );
add_filter( 'electro_dokan_store_version',                     'redux_apply_dokan_store_version',               10 );
add_filter( 'electro_is_dokan_store_sidebar_enable',           'redux_toggle_dokan_store_sidebar',              10 );
add_filter( 'electro_is_dokan_store_owner_info_enable',        'redux_toggle_dokan_store_owner_info',           10 );
add_filter( 'electro_dokan_store_top_jumbotron_id',            'redux_apply_dokan_store_top_jumbotron_id',      10 );

// Header Filters
add_filter( 'electro_off_canvas_cart',                         'redux_toggle_off_canvas_cart',                  10 );
add_filter( 'electro_enable_wc_template_loop_sale',            'redux_toggle_wc_template_loop_sale',            10 );
add_filter( 'electro_enable_top_bar',                          'redux_toggle_top_bar',                          10 );
add_filter( 'electro_hide_top_bar_in_mobile',                  'redux_toggle_top_bar_mobile',                   10 );
add_filter( 'electro_enable_flex_header',                      'redux_toggle_flex_header',                      10 );
add_filter( 'electro_header_logo_html',                        'redux_apply_header_logo',                       10 );
add_filter( 'electro_logo_image_src',                          'redux_apply_logo_image_src',                    10 );
add_filter( 'electro_off_canvas_nav_hide_in_desktop',          'redux_toggle_off_canvas_nav_in_desktop',        10 );
add_filter( 'electro_header_tooltip_placement',                'redux_apply_header_icon_tooltip_position',      20 );
add_filter( 'electro_header_tooltip_placement',                'redux_toggle_header_show_tooltip',              10 );
add_filter( 'electro_header_style',                            'redux_apply_header_style',                      10 );
add_filter( 'electro_vertical_menu_title',                     'redux_apply_header_vertical_menu_title',        10 );
add_filter( 'electro_vertical_menu_icon',                      'redux_apply_header_vertical_menu_icon',         10 );
add_filter( 'electro_departments_menu_title',                  'redux_apply_departments_menu_title',            10 );
add_filter( 'electro_header_v5_menu_title',                    'redux_apply_header_v5_menu_title',              10 );
add_filter( 'electro_header_v6_menu_title',                    'redux_apply_header_v6_menu_title',              10 );
add_filter( 'electro_navbar_search_placeholder',               'redux_apply_navbar_search_placeholder',         10 );
add_filter( 'electro_enable_search_categories_filter',         'redux_toggle_header_search_dropdown',           10 );
add_filter( 'electro_search_categories_filter_args',           'redux_modify_search_dropdown_categories_args',  10 );
add_filter( 'electro_navbar_search_dropdown_text',             'redux_apply_navbar_search_dropdown_text',       10 );
add_filter( 'electro_show_header_support_info',                'redux_toggle_header_support_block',             10 );
add_filter( 'electro_header_support_number',                   'redux_apply_header_support_number',             10 );
add_filter( 'electro_header_support_email',                    'redux_apply_header_support_email',              10 );
add_filter( 'electro_enable_sticky_header',                    'redux_toggle_sticky_header',                    10 );
add_filter( 'electro_enable_live_search',                      'redux_toggle_live_search',                      10 );
add_filter( 'electro_header_cart_icon',                        'redux_apply_header_cart_icon',                  10 );
add_filter( 'electro_header_cart_dropdown_disable',            'redux_toggle_header_cart_dropdown',             10 );
add_filter( 'electro_enable_header_user_account',              'redux_toggle_header_user_account_enable',       10 );
add_filter( 'electro_header_user_account_icon',                'redux_apply_header_user_account_icon',          10 );
add_filter( 'electro_user_account_nav_menu_ID',                'redux_apply_header_user_account_menu',          10 );

add_filter( 'electro_enable_top_bar_v3_additional_links',      'redux_toggle_top_bar_v3_additional_links',      10 );
add_filter( 'electro_top_bar_v3_additional_links_title',       'redux_apply_top_bar_v3_additional_links_title', 10 );
add_filter( 'electro_top_bar_v3_additional_link_1_text',       'redux_apply_top_bar_v3_additional_link_1_text', 10 );
add_filter( 'electro_top_bar_v3_additional_link_1_url',        'redux_apply_top_bar_v3_additional_link_1_url',  10 );
add_filter( 'electro_top_bar_v3_additional_link_1_image',      'redux_apply_top_bar_v3_additional_link_1_image',10 );
add_filter( 'electro_top_bar_v3_additional_link_2_text',       'redux_apply_top_bar_v3_additional_link_2_text', 10 );
add_filter( 'electro_top_bar_v3_additional_link_2_url',        'redux_apply_top_bar_v3_additional_link_2_url',  10 );
add_filter( 'electro_top_bar_v3_additional_link_2_image',      'redux_apply_top_bar_v3_additional_link_2_image',10 );

// Footer Filters
add_filter( 'electro_footer_brands_carousel',                  'redux_toggle_footer_brands_carousel',           10 );
add_filter( 'ec_footer_bc_carousel_args',                      'redux_toggle_bc_touch_drag' );
add_filter( 'electro_footer_brands_number',                    'redux_apply_footer_brands_number',              10 );
add_filter( 'electro_footer_widgets',                          'redux_toggle_footer_widgets',                   10 );
add_filter( 'electro_footer_widgets_v2',                       'redux_toggle_footer_widgets',                   10 );
add_filter( 'electro_footer_widgets_v2_columns',               'redux_apply_footer_widgets_columns',            10 );
add_filter( 'electro_footer_newsletter',                       'redux_toggle_footer_newsletter',                10 );
add_filter( 'electro_footer_newsletter_title',                 'redux_apply_footer_newsletter_title',           10 );
add_filter( 'electro_footer_newsletter_marketing_text',        'redux_apply_footer_newsletter_marketing_text',  10 );
add_filter( 'electro_footer_newsletter_form',                  'redux_apply_footer_newsletter_form',            10 );
add_filter( 'electro_footer_logo',                             'redux_toggle_footer_logo',                      10 );
add_filter( 'electro_footer_logo_html',                        'redux_apply_footer_logo',                       10 );
add_filter( 'electro_footer_call_us',                          'redux_toggle_electro_footer_call_us',           10 );
add_filter( 'electro_call_us_text',                            'redux_apply_footer_call_us_text',               10 );
add_filter( 'electro_call_us_number',                          'redux_apply_footer_call_us_number',             10 );
add_filter( 'electro_call_us_icon',                            'redux_apply_footer_call_us_icon',               10 );
add_filter( 'electro_footer_address',                          'redux_toggle_footer_address',                   10 );
add_filter( 'electro_footer_address_title',                    'redux_apply_footer_address_title',              10 );
add_filter( 'electro_footer_address_content',                  'redux_apply_footer_address_content',            10 );
add_filter( 'electro_footer_copyright_text',                   'redux_apply_footer_copyright_text',             10 );
add_filter( 'electro_footer_credit_card_icons',                'redux_apply_footer_credit_icons',               10 );
add_filter( 'electro_footer_social_icons',                     'redux_toggle_footer_social_icons',              10 );
add_filter( 'electro_get_social_networks',                     'redux_apply_social_networks',                   10 );
add_filter( 'electro_enable_footer_contact_block',             'redux_toggle_footer_contact_block',             10 );
add_filter( 'electro_show_footer_bottom_widgets',              'redux_toggle_footer_bottom_widgets',            10 );
add_filter( 'electro_footer_bottom_widgets_columns',           'redux_apply_footer_bottom_widgets_columns',     10 );
add_filter( 'electro_enable_footer_credit_block',              'redux_toggle_footer_credit_block',              10 );

// Mobile Filters
add_filter( 'electro_enable_mobile_front_page',         'redux_toggle_mobile_frontpage',                10 );
add_filter( 'electro_mobile_front_page_id',             'redux_apply_mobile_frontpage_id',              10 );
add_filter( 'electro_handheld_header_logo_html',        'redux_apply_handheld_header_logo',             10 );
add_filter( 'electro_get_handheld_header_version',      'redux_apply_handheld_header_style',            10 );
add_filter( 'electro_handheld_header_v2_light_bg',      'redux_toggle_handheld_header_v2_light_bg',     10 );
add_filter( 'electro_enable_hh_sticky_header',          'redux_toggle_handheld_header_sticky',          10 );
add_filter( 'electro_show_add_to_cart_in_mobile',       'redux_toggle_add_to_cart_mobile',              10 );
add_filter( 'electro_handheld_footer_logo_html',        'redux_apply_handheld_footer_logo',             10 );
add_filter( 'electro_get_handheld_footer_version',      'redux_apply_handheld_footer_style',            10 );
add_filter( 'electro_mobile_footer_v1_light_bg',        'redux_toggle_handheld_footer_light_bg',        10 );
add_filter( 'electro_mobile_footer_v2_light_bg',        'redux_toggle_handheld_footer_light_bg',        10 );
add_filter( 'electro_show_mobile_footer_bottom_widgets','redux_toggle_mobile_footer_bottom_widgets',    10 );

// Navigation Filters
add_filter( 'electro_primary-nav_dropdown_trigger',            'redux_apply_dropdown_trigger',                  10, 2 );
add_filter( 'electro_secondary-nav_dropdown_trigger',          'redux_apply_dropdown_trigger',                  10, 2 );
add_filter( 'electro_navbar-primary_dropdown_trigger',         'redux_apply_dropdown_trigger',                  10, 2 );
add_filter( 'electro_topbar-left_dropdown_trigger',            'redux_apply_dropdown_trigger',                  10, 2 );
add_filter( 'electro_topbar-right_dropdown_trigger',           'redux_apply_dropdown_trigger',                  10, 2 );

// Blog Filters
add_filter( 'electro_blog_style',                              'redux_apply_blog_page_view',                    10 );
add_filter( 'electro_blog_layout',                             'redux_apply_blog_page_layout',                  10 );
add_filter( 'electro_single_post_layout',                      'redux_apply_single_post_layout',                10 );
add_filter( 'electro_loop_post_placeholder_img',               'redux_toggle_post_placeholder_img',             10 );
add_filter( 'electro_show_author_info',                        'redux_toggle_author_info',                      10 );

// Style Filters
add_filter( 'electro_use_predefined_colors',                   'redux_toggle_use_predefined_colors',            10 );
add_action( 'electro_primary_color',                           'redux_apply_primary_color',                     10 );
add_action( 'wp_head',                                         'redux_apply_custom_color_css',                  100 );
add_action( 'wp_enqueue_scripts',                              'redux_load_external_custom_css',                20 );
add_filter( 'electro_should_add_custom_css_page',              'redux_toggle_custom_css_page',                  10 );

// Typography Filters
add_filter( 'electro_load_default_fonts',                      'redux_has_google_fonts',                        10 );
add_action( 'wp_head',                                         'redux_apply_custom_fonts',                      100 );

// Custom Code Filters
add_action( 'wp_head',                                         'redux_apply_custom_css',                        200 );
