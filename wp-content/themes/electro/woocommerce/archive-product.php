<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

electro_get_header(); ?>

    <?php
        /**
         * woocommerce_before_main_content hook.
         *
         * @hooked electro_before_wc_content - 10 (outputs opening divs for the content)
         * @hooked electro_before_product_archive_content - 20
         */
        do_action( 'woocommerce_before_main_content' );
    ?>

        <?php
            /**
             * woocommerce_archive_description hook.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
        ?>

        <?php if ( ( function_exists( 'woocommerce_product_loop' ) && woocommerce_product_loop() ) || have_posts() ) : ?>
            
            <?php
                /**
                 * woocommerce_before_shop_loop hook.
                 *
                 * @hooked electro_product_subcategories - 0
                 * @hooked electro_wc_loop_title - 10
                 * @hooked electro_shop_control_bar - 10
                 * @hooked electro_reset_woocommerce_loop - 90
                 */
                do_action( 'woocommerce_before_shop_loop' );
            ?>
            
            <?php
                /**
                 * woocommerce_shop_loop hook
                 *
                 * @hooked electro_shop_loop
                 */
                do_action( 'woocommerce_shop_loop' );
            ?>

            <?php
                /**
                 * woocommerce_after_shop_loop hook.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            ?>

        <?php else : ?>

            <?php
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );
            ?>

        <?php endif; ?>

    <?php
        /**
         * woocommerce_after_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>

    <?php
        /**
         * woocommerce_sidebar hook.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' );
    ?>

<?php get_footer(); ?>