<?php
/**
 * Template hooks used in shop loops
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating',  5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close',  5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'electro_product_item_hover_area', 'electro_loop_action_buttons', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'electro_wrap_product_outer',  0 );
add_action( 'woocommerce_before_shop_loop_item', 'electro_wrap_product_inner', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'electro_template_loop_header_open', 15 );
add_action( 'woocommerce_before_shop_loop_item_title', 'electro_template_loop_categories', 20 );

add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 30 );
add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 45 );
add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_header_close', 46 );

add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_body_open', 47 );
add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_categories', 50 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 55 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 60 );

add_action( 'woocommerce_after_shop_loop_item_title', 'electro_template_loop_rating', 70 );
add_action( 'woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_excerpt', 80 );
add_action( 'woocommerce_after_shop_loop_item_title', 'electro_template_loop_product_sku', 90 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 95 );
add_action( 'woocommerce_after_shop_loop_item_title', 'electro_template_loop_body_close', 96 );

add_action( 'woocommerce_after_shop_loop_item_title', 'electro_template_loop_footer_open', 98 );
add_action( 'woocommerce_after_shop_loop_item_title', 'electro_wc_template_loop_sale', 99 );
add_action( 'woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart', 100 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 110 );  
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 120 );
add_action( 'woocommerce_after_shop_loop_item_title', 'electro_wrap_price_and_add_to_cart_close', 130 );

add_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover',          140 );
add_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_footer_close',   145 );
add_action( 'woocommerce_after_shop_loop_item', 'electro_wrap_product_inner_close',     150 );
add_action( 'woocommerce_after_shop_loop_item', 'electro_wrap_product_outer_close',     160 );
