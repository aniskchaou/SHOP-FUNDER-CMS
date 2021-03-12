<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage v5
 *
 * @package electro
 */

remove_action( 'electro_content_top', 'electro_breadcrumb', 10 );

do_action( 'electro_before_homepage_v5' );

$home_v5        = electro_get_home_v5_meta();
$header_style   = isset( $home_v5['header_style'] ) ? $home_v5['header_style'] : 'v6';
electro_get_header( $header_style ); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             */
            do_action( 'homepage_v5' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php 

get_footer();