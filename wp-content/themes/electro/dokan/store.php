<?php
/**
 * The Template for displaying all single posts.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_electro_style = electro_is_dokan_electro_store_style();
$store_version = electro_get_dokan_store_version();

$store_user   = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info   = $store_user->get_shop_info();
$map_location = $store_user->get_location();
?>

<?php get_header( 'shop' ); ?>

<?php do_action( 'electro_dokan_store_before_header' ); ?>

<?php if ( $is_electro_style && in_array( $store_version, array( 'store-v1', 'store-v2', 'store-v5' ) ) ) { ?>

    <div class="electro-dokan-single-store-header-wraper">
        <div class="dokan-single-store-header">

            <?php dokan_get_template_part( 'store-header' ); ?>

        </div>
    </div>

<?php } ?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div id="dokan-primary" class="dokan-single-store">
    <div id="dokan-content" class="store-page-wrap woocommerce" role="main">

        <?php if ( ! $is_electro_style || ( $is_electro_style && $store_version === 'store-v3' ) ) {
            dokan_get_template_part( 'store-header' );
        } ?>

        <?php do_action( 'dokan_store_profile_frame_after', $store_user->data, $store_info ); ?>

        <?php if ( have_posts() ) {
            global $wp_query;
            $_wc_query = $wp_query->get( 'wc_query' );
            $wp_query->set( 'wc_query', 'products_query' );
            ?>

            <div class="seller-items">

                <?php do_action( 'dokan_store_product_loop_before', $store_user->data, $store_info ); ?>

                <?php woocommerce_product_loop_start(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action( 'dokan_store_product_loop_after', $store_user->data, $store_info ); ?>

            </div>

            <?php dokan_content_nav( 'nav-below' ); ?>

            <?php
            $wp_query->set( 'wc_query', $_wc_query );
        } else { ?>

            <p class="dokan-info"><?php _e( 'No products were found of this seller!', 'electro' ); ?></p>

        <?php } ?>

    </div>
</div><!-- .dokan-single-store -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>