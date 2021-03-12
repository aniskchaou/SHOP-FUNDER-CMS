<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage Mobile v1
 *
 * @package electro
 */

remove_action( 'electro_content_top', 'electro_breadcrumb', 10 );

do_action( 'electro_before_homepage_mobile_v1' );

$home_mobile_v1     = electro_get_home_mobile_v1_meta();
$header_style       = isset( $home_mobile_v1['hpc']['header_style'] ) ? 'mobile-' . $home_mobile_v1['hpc']['header_style'] : 'mobile-v1';
$footer_style       = isset( $home_mobile_v1['hpc']['footer_style'] ) ? 'mobile-' . $home_mobile_v1['hpc']['footer_style'] : 'mobile-v1';
electro_get_header( $header_style ); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             * @hooked electro_page_template_content                     - 5
             * @hooked electro_home_mobile_v1_slider                     - 10
             * @hooked electro_home_mobile_v1_ads_block                  - 20
             * @hooked electro_home_mobile_v1_product_categories_list_1  - 30
             * @hooked electro_home_mobile_v1_deal_products_block        - 40
             * @hooked electro_home_mobile_v1_ad_banner_v1               - 50
             * @hooked electro_home_mobile_v1_products_1_2_block         - 60
             * @hooked electro_home_mobile_v1_product_categories_list_2  - 70
             * @hooked electro_home_mobile_v1_products_list_block_1      - 80
             * @hooked electro_home_mobile_v1_ad_banner_v2               - 90
             * @hooked electro_home_mobile_v1_products_list_block_2      - 100
             * @hooked electro_home_mobile_v1_categories_block           - 110
             * @hooked electro_home_mobile_v1_recent_viewed_products     - 120  
             */
            do_action( 'homepage_mobile_v1' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
get_footer( $footer_style ); ?>
