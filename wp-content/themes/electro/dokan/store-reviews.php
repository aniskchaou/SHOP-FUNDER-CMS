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

$store_user = get_userdata( get_query_var( 'author' ) );
$store_info = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';
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
    <div id="dokan-content" class="store-review-wrap woocommerce" role="main">

        <?php if ( ! $is_electro_style || ( $is_electro_style && $store_version === 'store-v3' ) ) {
            dokan_get_template_part( 'store-header' );
        } ?>

        <?php
        $dokan_template_reviews = version_compare( dokan_pro()->version, '3.0.0' , '<' ) ? Dokan_Pro_Reviews::init() : dokan_pro()->review;
        $id                     = $store_user->ID;
        $post_type              = 'product';
        $limit                  = 20;
        $status                 = '1';
        $comments               = $dokan_template_reviews->comment_query( $id, $post_type, $limit, $status );
        ?>

        <div id="reviews">
            <div id="comments">

              <?php do_action( 'dokan_review_tab_before_comments' ); ?>

                <h2 class="headline"><?php _e( 'Vendor Review', 'electro' ); ?></h2>

                <ol class="commentlist">
                    <?php echo $dokan_template_reviews->render_store_tab_comment_list( $comments , $store_user->ID); ?>
                </ol>

            </div>
        </div>

        <?php echo $dokan_template_reviews->review_pagination( $id, $post_type, $limit, $status ); ?>

    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>