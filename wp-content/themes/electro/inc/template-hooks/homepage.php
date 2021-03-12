<?php
/**
 * Homepage
 */
add_action( 'homepage_v1', 'electro_page_template_content',                                    5 );
add_action( 'homepage_v1', 'electro_home_v1_slider',                                          10 );
add_action( 'homepage_v1', 'electro_home_v1_ads_block',                                       20 );
add_action( 'homepage_v1', 'electro_home_v1_deal_and_tabs_block',                             30 );
add_action( 'homepage_v1', 'electro_home_v1_2_1_2_block',                                     40 );
add_action( 'homepage_v1', 'electro_home_v1_product_cards_carousel',                          50 );
add_action( 'homepage_v1', 'electro_home_v1_ad_banner',                                       60 );
add_action( 'homepage_v1', 'electro_home_v1_products_carousel',                               70 );

add_action( 'homepage_v2', 'electro_home_v2_ads_block',                                       20 );
add_action( 'homepage_v2', 'electro_home_v2_products_carousel_tabs',                          30 );
add_action( 'homepage_v2', 'electro_home_v2_onsale_product',                                  40 );
add_action( 'homepage_v2', 'electro_home_v2_product_cards_carousel',                          50 );
add_action( 'homepage_v2', 'electro_home_v2_ad_banner',                                       60 );
add_action( 'homepage_v2', 'electro_home_v2_products_carousel',                               70 );
add_action( 'homepage_v2', 'electro_home_v2_products_carousel_2',                             80 );
add_action( 'homepage_v2', 'electro_home_v2_products_carousel_3',                             90 );

add_action( 'homepage_v3', 'electro_page_template_content',                                    5 );
add_action( 'homepage_v3', 'electro_home_v3_slider',                                          10 );
add_action( 'homepage_v3', 'electro_home_v3_features_list',                                   20 );
add_action( 'homepage_v3', 'electro_home_v3_ads_block',                                       30 );
add_action( 'homepage_v3', 'electro_home_v3_products_carousel_tabs',                          40 );
add_action( 'homepage_v3', 'electro_products_carousel_with_image',                            50 );
add_action( 'homepage_v3', 'electro_home_v3_product_cards_carousel',                          60 );
add_action( 'homepage_v3', 'electro_home_v3_product_cards_carousel_2',                        70 );
add_action( 'homepage_v3', 'electro_home_v3_6_1_block',                                       80 );
add_action( 'homepage_v3', 'electro_home_v3_list_categories',                                 90 );
add_action( 'homepage_v3', 'electro_home_v3_products_carousel',                              100 );

add_action( 'homepage_v4', 'electro_home_v4_slider_with_ads_block',                           10 );
add_action( 'homepage_v4', 'electro_home_v4_products_carousel_tabs',                          20 );
add_action( 'homepage_v4', 'electro_home_v4_ad_banner',                                       30 );
add_action( 'homepage_v4', 'electro_products_carousel_with_deal_v4',                          40 );
add_action( 'homepage_v4', 'electro_products_with_category_image_v4_1',                       50 );
add_action( 'homepage_v4', 'electro_products_with_category_image_v4_2',                       60 );
add_action( 'homepage_v4', 'electro_home_v4_categories_block',                                70 );
add_action( 'homepage_v4', 'electro_products_6_1_with_categories_v4_1',                       80 );
add_action( 'homepage_v4', 'electro_products_6_1_with_categories_v4_2',                       90 );

add_action( 'homepage_v5', 'electro_home_v5_onsale_product_carousel',                         10 );
add_action( 'homepage_v5', 'electro_home_v5_product_tabs_carousel',                           20 );
add_action( 'homepage_v5', 'electro_home_v5_ads_block',                                       30 );
add_action( 'homepage_v5', 'electro_home_v5_products_carousel',                               40 );
add_action( 'homepage_v5', 'electro_home_v5_product_carousel_v5_1',                           50 );
add_action( 'homepage_v5', 'electro_home_v5_ad_banner',                                       60 );
add_action( 'homepage_v5', 'electro_home_v5_product_carousel_v5_2',                           70 );
add_action( 'homepage_v5', 'electro_home_v5_product_cards_carousel',                          80 );
add_action( 'homepage_v5', 'electro_home_v5_categories_block',                                90 );
add_action( 'homepage_v5', 'electro_home_v5_ads_with_banners',                               100 );

add_action( 'homepage_v6', 'electro_home_v6_products_carousel_banner_vertical_tabs',          10 );
add_action( 'homepage_v6', 'electro_home_v6_two_banners',                                     20 );
add_action( 'homepage_v6', 'electro_home_v6_category_icons_carousel',                         30 );
add_action( 'homepage_v6', 'electro_home_v6_product_tabs_carousel_with_deal',                 40 );
add_action( 'homepage_v6', 'electro_home_v6_products_carousel',                               50 );
add_action( 'homepage_v6', 'electro_home_v6_ad_banner',                                       60 );
add_action( 'homepage_v6', 'electro_home_v6_products_carousel_width_image_1',                 70 );
add_action( 'homepage_v6', 'electro_home_v6_products_carousel_width_image_2',                 80 );
add_action( 'homepage_v6', 'electro_home_v6_ads_block',                                       90 );
add_action( 'homepage_v6', 'electro_home_v6_recent_viewed_products',                         100 );

add_action( 'homepage_v7', 'electro_home_v7_slider_with_vertical_menu_categories_banners',    10 );
add_action( 'homepage_v7', 'electro_home_v7_products_carousel_with_timer',                    20 );
add_action( 'homepage_v7', 'electro_home_v7_ad_banner',                                       30 );
add_action( 'homepage_v7', 'electro_home_v7_products_with_category_image',                    40 );
add_action( 'homepage_v7', 'electro_home_v7_two_banners',                                     50 );
add_action( 'homepage_v7', 'electro_home_v7_products_category_width_image_1',                 60 );
add_action( 'homepage_v7', 'electro_home_v7_products_category_width_image_2',                 70 );
add_action( 'homepage_v7', 'electro_home_v7_ads_with_banners',                                80 );
add_action( 'homepage_v7', 'electro_home_v7_two_row_products',                                90 );

add_action( 'homepage_v8', 'electro_page_template_content',                                    5 );
add_action( 'homepage_v8', 'electro_home_v8_slider',                                          10 );
add_action( 'homepage_v8', 'electro_home_v8_category_icons_carousel',                         20 );
add_action( 'homepage_v8', 'electro_home_v8_ads_block',                                       30 );
add_action( 'homepage_v8', 'electro_home_v8_products_carousel_1',                             40 );
add_action( 'homepage_v8', 'electro_home_v8_product_category_tags',                           50 );
add_action( 'homepage_v8', 'electro_home_v8_products_carousel_2',                             60 );
add_action( 'homepage_v8', 'electro_home_v8_products_carousel_3',                             70 );
add_action( 'homepage_v8', 'electro_home_v8_products_categories_1_6',                         80 );
add_action( 'homepage_v8', 'electro_home_v8_products_carousel_4',                             90 );
add_action( 'homepage_v8', 'electro_home_v8_products_carousel_5',                            100 );
add_action( 'homepage_v8', 'electro_home_v8_two_banners',                                    110 );
add_action( 'homepage_v8', 'electro_home_v8_products_carousel_6',                            120 );


add_action( 'homepage_v9', 'electro_page_template_content',                                    5 );
add_action( 'homepage_v9', 'electro_home_v9_slider_with_deals_product_carousel',              10 );
add_action( 'homepage_v9', 'electro_home_v9_products_carousel_tabs',                          20 );
add_action( 'homepage_v9', 'electro_home_v9_banner_1_6_block',                                30 );
add_action( 'homepage_v9', 'electro_home_v9_product_categories_with_banner_carousel_1',       40 );
add_action( 'homepage_v9', 'electro_home_v9_product_categories_with_banner_carousel_2',       50 );
add_action( 'homepage_v9', 'electro_home_v9_products_carousel',                               60 );
add_action( 'homepage_v9', 'electro_home_v9_product_categories_with_banner_carousel_3',       70 );
add_action( 'homepage_v9', 'electro_home_v9_recent_viewed_products',                          80 );

add_action( 'homepage_mobile_v1', 'electro_page_template_content',                             5 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_slider',                            10 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_ads_block',                         20 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_product_categories_list_1',         30 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_deal_products_block',               40 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_ad_banner_v1',                      50 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_products_1_2_block',                60 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_product_categories_list_2',         70 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_products_list_block_1',             80 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_ad_banner_v2',                      90 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_products_list_block_2',            100 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_categories_block',                 110 );
add_action( 'homepage_mobile_v1', 'electro_home_mobile_v1_recent_viewed_products',           120 );

add_action( 'homepage_mobile_v2', 'electro_page_template_content',                             5 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_slider',                            10 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_ads_block',                         20 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_deal_products_with_featured',       30 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_products_list_block_1',             40 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_product_categories_list',           50 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_products_list_block_2',             60 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_ad_banner',                         70 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_recent_viewed_products',            80 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_features_list',                     90 );
add_action( 'homepage_mobile_v2', 'electro_home_mobile_v2_list_categories',                  100 );

add_action( 'electro_before_homepage_v1', 'electro_home_v1_hook_control',                     10 );
add_action( 'electro_before_homepage_v2', 'electro_home_v2_hook_control',                     10 );
add_action( 'electro_before_homepage_v3', 'electro_home_v3_hook_control',                     10 );
add_action( 'electro_before_homepage_v4', 'electro_home_v4_hook_control',                     10 );
add_action( 'electro_before_homepage_v5', 'electro_home_v5_hook_control',                     10 );
add_action( 'electro_before_homepage_v6', 'electro_home_v6_hook_control',                     10 );
add_action( 'electro_before_homepage_v7', 'electro_home_v7_hook_control',                     10 );
add_action( 'electro_before_homepage_v8', 'electro_home_v8_hook_control',                     10 );
add_action( 'electro_before_homepage_v9', 'electro_home_v9_hook_control',                     10 );
add_action( 'electro_before_homepage_mobile_v1', 'electro_home_mobile_v1_hook_control',       10 );
add_action( 'electro_before_homepage_mobile_v2', 'electro_home_mobile_v2_hook_control',       10 );
