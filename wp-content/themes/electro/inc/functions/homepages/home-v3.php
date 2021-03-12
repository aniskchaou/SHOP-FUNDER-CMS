<?php
/**
 * Functions used in Home v3
 */

if ( ! function_exists( 'electro_add_6_1_main_product_hooks' ) ) {
    function electro_add_6_1_main_product_hooks() {
        remove_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40  );
        remove_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140 );
        
        add_action( 'woocommerce_before_shop_loop_item', 'electro_wrap_flex_div_open', 11 );
        add_action( 'woocommerce_after_shop_loop_item', 'electro_wrap_flex_div_close', 149 );
        add_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 149 );
        add_action( 'woocommerce_shop_loop_item_title', 'electro_show_wc_product_images', 46 );
    }
}

if ( ! function_exists( 'electro_remove_6_1_main_product_hooks' ) ) {
    function electro_remove_6_1_main_product_hooks() {
        remove_action( 'woocommerce_before_shop_loop_item', 'electro_wrap_flex_div_open', 11 );
        remove_action( 'woocommerce_after_shop_loop_item', 'electro_wrap_flex_div_close', 149 );
        remove_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 149 );
        remove_action( 'woocommerce_shop_loop_item_title', 'electro_show_wc_product_images', 46 );

        add_action( 'woocommerce_shop_loop_item_title', 'electro_template_loop_product_thumbnail', 40  );
        add_action( 'woocommerce_after_shop_loop_item', 'electro_template_loop_hover', 140 );
    }
}

if( ! function_exists( 'electro_home_v3_hook_control' ) ) {
    function electro_home_v3_hook_control() {
        if( is_page_template( array( 'template-homepage-v3.php' ) ) ) {
            remove_all_actions( 'homepage_v3' );

            $home_v3 = electro_get_home_v3_meta();

            $is_enabled = isset( $home_v3['hpc']['is_enabled'] ) ? $home_v3['hpc']['is_enabled'] : 'no';
            if ( $is_enabled !== 'no' ) {
                add_action( 'homepage_v3',  'electro_page_template_content',            isset( $home_v3['hpc']['priority'] ) ? intval( $home_v3['hpc']['priority'] ) : 5 );
            }

            add_action( 'homepage_v3',  'electro_home_v3_slider',                   isset( $home_v3['sdr']['priority'] ) ? intval( $home_v3['sdr']['priority'] ) : 10 );
            add_action( 'homepage_v3',  'electro_home_v3_features_list',            isset( $home_v3['fl']['priority'] ) ? intval( $home_v3['fl']['priority'] ) : 20 );
            add_action( 'homepage_v3',  'electro_home_v3_ads_block',                isset( $home_v3['ad']['priority'] ) ? intval( $home_v3['ad']['priority'] ) : 30 );
            add_action( 'homepage_v3',  'electro_home_v3_products_carousel_tabs',   isset( $home_v3['pct']['priority'] ) ? intval( $home_v3['pct']['priority'] ) : 40 );
            add_action( 'homepage_v3',  'electro_products_carousel_with_image',     isset( $home_v3['pci']['priority'] ) ? intval( $home_v3['pci']['priority'] ) : 50 );
            add_action( 'homepage_v3',  'electro_home_v3_product_cards_carousel',   isset( $home_v3['pcc']['priority'] ) ? intval( $home_v3['pcc']['priority'] ) : 60 );
            add_action( 'homepage_v3',  'electro_home_v3_product_cards_carousel_2', isset( $home_v3['pcc2']['priority'] ) ? intval( $home_v3['pcc2']['priority'] ) : 70 );
            add_action( 'homepage_v3',  'electro_home_v3_6_1_block',                isset( $home_v3['so']['priority'] ) ? intval( $home_v3['so']['priority'] ) : 80 );
            add_action( 'homepage_v3',  'electro_home_v3_list_categories',          isset( $home_v3['hlc']['priority'] ) ? intval( $home_v3['hlc']['priority'] ) : 90 );
            add_action( 'homepage_v3',  'electro_home_v3_products_carousel',        isset( $home_v3['pc']['priority'] ) ? intval( $home_v3['pc']['priority'] ) : 100 );
            add_action( 'homepage_v3',  'electro_home_v3_two_banners',              isset( $home_v3['tbrs']['priority'] ) ? intval( $home_v3['tbrs']['priority'] ) : 110 );
            add_action( 'homepage_v3',  'electro_home_v3_recent_viewed_products',   isset( $home_v3['rvp']['priority'] ) ? intval( $home_v3['rvp']['priority'] ) : 120 );
        }
    }
}