<?php
/**
 * Template Hooks used in Single Product Page
 */

/**
 * Single Product
 */
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_price',            10 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_add_to_cart',      30 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_meta',             40 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_sharing',          50 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images',              20 );
remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_output_related_products',          20 );

add_action( 'woocommerce_before_single_product',            'electro_toggle_single_product_hooks',          10 );

add_filter( 'electro_show_shop_sidebar',                    'electro_toggle_shop_sidebar',                  10 );
add_filter( 'woocommerce_product_thumbnails_columns',       'electro_product_thumbnails_columns',           10 );

add_action( 'woocommerce_before_single_product_summary',    'electro_wrap_single_product',                  0  );
add_action( 'woocommerce_before_single_product_summary',    'electro_wrap_product_images',                  5  );
add_action( 'woocommerce_before_single_product_summary',    'electro_show_product_images',                  20 );
add_action( 'woocommerce_before_single_product_summary',    'electro_single_product_deal_countdown_timer',  29 );
add_action( 'woocommerce_before_single_product_summary',    'electro_wrap_product_images_close',            30 );

add_action( 'woocommerce_single_product_summary',           'electro_template_loop_categories',             1  );
add_action( 'woocommerce_single_product_summary',           'electro_template_single_brand',                10 );
add_action( 'woocommerce_single_product_summary',           'electro_template_loop_availability',           10 );
add_action( 'woocommerce_single_product_summary',           'electro_template_single_divider',              11 );
add_action( 'woocommerce_single_product_summary',           'electro_loop_action_buttons',                  15 );
add_action( 'woocommerce_single_product_summary',           'woocommerce_template_single_sharing',          15 );
add_action( 'woocommerce_single_product_summary',           'woocommerce_template_single_price',            25 );
add_action( 'woocommerce_single_product_summary',           'electro_template_single_add_to_cart',          30 );

add_action( 'woocommerce_after_single_product_summary',     'electro_wrap_single_product_close',            1  );
add_action( 'woocommerce_after_single_product_summary',     'electro_output_related_products',              20 );
add_action( 'woocommerce_review_after_comment_text',        'electro_wc_review_meta',                       10 );