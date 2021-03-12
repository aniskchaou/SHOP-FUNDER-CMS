<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_electro_style = electro_is_dokan_electro_store_style();
$store_version = electro_get_dokan_store_version();

$store_user   = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info   = $store_user->get_shop_info();
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
    <div id="dokan-content" class="store-toc-wrap woocommerce" role="main">

        <?php if ( ! $is_electro_style || ( $is_electro_style && $store_version === 'store-v3' ) ) {
            dokan_get_template_part( 'store-header' );
        } ?>

        <div id="store-toc-wrapper">
            <div id="store-toc">
                <?php
                if( isset( $store_info['store_tnc'] ) ):
                ?>
                    <div class="page-header">
                        <h3 class="page-title headline"><?php _e( 'Terms And Conditions', 'electro' ); ?></h3>
                    </div>
                    <div>
                        <?php
                        echo nl2br($store_info['store_tnc']);
                        ?>
                    </div>
                <?php
                endif;
                ?>
            </div><!-- #store-toc -->
        </div><!-- #store-toc-wrap -->
    </div>
</div><!-- .dokan-single-store -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>