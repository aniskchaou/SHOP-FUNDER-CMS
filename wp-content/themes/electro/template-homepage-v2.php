<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage v2
 *
 * @package electro
 */

remove_action( 'electro_content_top', 'electro_breadcrumb', 10 );
do_action( 'electro_before_homepage_v2' );

$home_v2 		= electro_get_home_v2_meta();
$header_style 	= isset( $home_v2['hpc']['header_style'] ) ? $home_v2['hpc']['header_style'] : 'v2';
electro_get_header( $header_style ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			/**
             * @hooked electro_home_v2_slider - 10
             * @hooked electro_home_v2_ads_block - 20
             * @hooked electro_home_v2_products_carousel_tabs - 30
             * @hooked electro_home_v2_onsale_product - 40
             * @hooked electro_home_v2_product_cards_carousel - 50
             * @hooked electro_home_v2_ad_banner - 60
             * @hooked electro_home_v2_products_carousel - 70
			 */
			do_action( 'homepage_v2' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 
		
	do_action( 'electro_sidebar', 'home' );

get_footer();