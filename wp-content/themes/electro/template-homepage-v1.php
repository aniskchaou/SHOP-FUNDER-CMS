<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage v1
 *
 * @package electro
 */

remove_action( 'electro_content_top', 'electro_breadcrumb', 10 );

do_action( 'electro_before_homepage_v1' );

$home_v1 		= electro_get_home_v1_meta();
$header_style 	= isset( $home_v1['hpc']['header_style'] ) ? $home_v1['hpc']['header_style'] : 'v1';
electro_get_header( $header_style ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			/**
             * @hooked electro_page_template_content - 5
             * @hooked electro_home_v1_slider - 10
             * @hooked electro_home_v1_ads_block - 20
             * @hooked electro_home_v1_deal_and_tabs_block - 30
             * @hooked electro_home_v1_2_1_2_block - 40
             * @hooked electro_home_v1_product_cards_carousel - 50
             * @hooked electro_home_v1_ad_banner - 60
             * @hooked electro_home_v1_products_carousel - 70
			 */
			do_action( 'homepage_v1' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 

get_footer();