<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage Mobile v2
 *
 * @package electro
 */

remove_action( 'electro_content_top', 'electro_breadcrumb', 10 );

do_action( 'electro_before_homepage_mobile_v2' );

$home_mobile_v2     = electro_get_home_mobile_v2_meta();
$header_style       = isset( $home_mobile_v2['hpc']['header_style'] ) ? 'mobile-' . $home_mobile_v2['hpc']['header_style'] : 'mobile-v2';
$footer_style       = isset( $home_mobile_v2['hpc']['footer_style'] ) ? 'mobile-' . $home_mobile_v2['hpc']['footer_style'] : 'mobile-v2';
electro_get_header( $header_style ); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
             /**
             * @hooked electro_page_template_content                        - 5
             * @hooked electro_home_mobile_v2_slider                        - 10
             * @hooked electro_home_mobile_v2_ads_block                     - 20
             * @hooked electro_home_mobile_v2_deal_products_with_featured   - 30
             * @hooked electro_home_mobile_v2_products_list_block_1         - 40
             * @hooked electro_home_mobile_v2_product_categories_list       - 50
             * @hooked electro_home_mobile_v2_products_list_block_2         - 60
             * @hooked electro_home_mobile_v2_ad_banner                     - 70
             */
            do_action( 'homepage_mobile_v2' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
get_footer( $footer_style ); ?>
