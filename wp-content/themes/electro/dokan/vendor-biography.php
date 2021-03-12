<?php
/**
 * The Template for displaying vendor biography.
 *
 * @package dokan
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
    <div id="dokan-content" class="vendor-biography-wrap woocommerce" role="main">

        <?php if ( ! $is_electro_style || ( $is_electro_style && $store_version === 'store-v3' ) ) {
            dokan_get_template_part( 'store-header' );
        } ?>

        <div id="vendor-biography">
            <div id="comments">
            <?php do_action( 'dokan_vendor_biography_tab_before', $store_user, $store_info ); ?>

            <div class="page-header">
                <h3 class="page-title headline"><?php echo apply_filters( 'dokan_vendor_biography_title', __( 'Vendor Biography', 'electro' ) ); ?></h3>
            </div>
            <?php
                if ( ! empty( $store_info['vendor_biography'] ) ) {
                    printf( '%s', apply_filters( 'the_content', $store_info['vendor_biography'] ) );
                }
            ?>

            <?php do_action( 'dokan_vendor_biography_tab_after', $store_user, $store_info ); ?>
            </div>
        </div>
    </div>
</div><!-- .dokan-single-store -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>