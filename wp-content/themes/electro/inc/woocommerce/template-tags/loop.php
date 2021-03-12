<?php
/**
 * Template Tags used in product loop
 */

if ( ! function_exists( 'electro_template_loop_header_open' ) ) {
    function electro_template_loop_header_open() {
        ?><div class="product-loop-header product-item__header"><?php
    }
}

if ( ! function_exists( 'electro_template_loop_body_open' ) ) {
    function electro_template_loop_body_open() {
        ?><div class="product-loop-body product-item__body"><?php
    }
}

if ( ! function_exists( 'electro_template_loop_footer_open' ) ) {
    function electro_template_loop_footer_open() {
        ?><div class="product-loop-footer product-item__footer"><?php
    }
}

if ( ! function_exists( 'electro_template_loop_header_close' ) ) {
    function electro_template_loop_header_close() {
        ?></div><!-- /.product-loop-header --><?php
    }
}

if ( ! function_exists( 'electro_product_item_label_open' ) ) {
    function electro_product_item_label_open() {
        ?><div class="product-label"><?php
    }
}

if ( ! function_exists( 'electro_product_item_label_close' ) ) {
    function electro_product_item_label_close() {
        ?></div><!-- /.product-label --><?php
    }
}

if ( ! function_exists( 'electro_template_loop_body_close' ) ) {
    function electro_template_loop_body_close() {
        ?></div><!-- /.product-loop-body --><?php
    }
}

if ( ! function_exists( 'electro_template_loop_footer_close' ) ) {
    function electro_template_loop_footer_close() {
        ?></div><!-- /.product-loop-footer --><?php
    }
}

if ( ! function_exists( 'electro_wrap_flex_div_open' ) ) {
    function electro_wrap_flex_div_open() {
        ?><div class="flex-div"><?php
    }
}

if ( ! function_exists( 'electro_wrap_flex_div_close' ) ) {
    function electro_wrap_flex_div_close() {
        ?></div><!-- /.flex-div --><?php
    }
}

if ( ! function_exists( 'electro_wc_template_loop_sale' ) ) {
    function electro_wc_template_loop_sale() {
        if ( apply_filters( 'electro_enable_wc_template_loop_sale', true ) ) {
            woocommerce_show_product_loop_sale_flash();
        }
    }
}
