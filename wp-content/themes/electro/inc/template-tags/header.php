<?php
/**
 * Template tags used in header
 */

if ( ! function_exists( 'electro_site_content_inner_open' ) ) {
    /**
     * @since 2.0
     */
    function electro_site_content_inner_open() {
        ?><div class="site-content-inner"><?php
    }
}

if ( ! function_exists( 'electro_site_content_inner_close' ) ) {
    /**
     * @since 2.0
     */
    function electro_site_content_inner_close() {
        ?></div><?php
    }
}

if ( ! function_exists( 'electro_masthead' ) ) {
    /**
     * @since 2.0
     */
    function electro_masthead() {
        ?><div class="masthead"><?php
        /**
         * @hooked electro_header_logo_area - 10
         * @hooked electro_navbar_search    - 20
         * @hooked electro_header_icons     - 30
         */
        do_action( 'electro_masthead' ); ?></div><?php
    }
}

if ( ! function_exists( 'electro_header_icons' ) ) {
    /**
     * @since 2.0
     */
    function electro_header_icons() {
        ?><div class="header-icons"><?php
        /**
         *
         */
        do_action( 'electro_header_icons' ); ?></div><!-- /.header-icons --><?php
    }
}

if ( ! function_exists( 'electro_header_logo_area' ) ) {
    /**
     * @since 2.0
     */
    function electro_header_logo_area() {
        ?><div class="header-logo-area"><?php
        /**
         *
         */
        do_action( 'electro_header_logo_area' ); ?></div><?php
    }
}

if ( ! function_exists( 'electro_compare_header_icon' ) ) {
    /**
     * @since 2.0
     */
    function electro_compare_header_icon() {
        if( function_exists( 'electro_get_compare_page_url' ) ) :
            global $yith_woocompare;
            $header_tooltip_placement = apply_filters( 'electro_header_tooltip_placement', 'bottom' );
        ?><div class="header-icon" <?php if ( $header_tooltip_placement ) : ?>data-toggle="tooltip" data-placement="<?php echo esc_attr( $header_tooltip_placement ); ?>" data-title="<?php echo esc_attr( esc_html__( 'Compare', 'electro' ) ); ?>"<?php endif; ?>>
            <a href="<?php echo esc_attr( electro_get_compare_page_url() ); ?>">
                <i class="<?php echo esc_attr( apply_filters( 'electro_compare_icon', 'ec ec-compare' ) ); ?>"></i>
                <?php if ( apply_filters( 'electro_show_compare_count', false ) ) : ?>
                <span class="navbar-compare-count count header-icon-counter" class="value"><?php echo count( $yith_woocompare->obj->products_list ); ?></span>
                <?php endif; ?>
            </a>
        </div><?php
        endif;
    }
}

if ( ! function_exists( 'electro_wishlist_header_icon' ) ) {
    /**
     * @since 2.0
     */
    function electro_wishlist_header_icon() {
        if ( function_exists( 'electro_get_wishlist_url' ) ) :
            $header_tooltip_placement = apply_filters( 'electro_header_tooltip_placement', 'bottom' );
    ?><div class="header-icon" <?php if ( $header_tooltip_placement ): ?>data-toggle="tooltip" data-placement="<?php echo esc_attr( $header_tooltip_placement ); ?>" data-title="<?php echo esc_attr( esc_html__( 'Wishlist', 'electro' ) ); ?>"<?php endif; ?>>
        <a href="<?php echo esc_attr( electro_get_wishlist_url() ); ?>">
            <i class="<?php echo esc_attr( apply_filters( 'electro_wishlist_icon', 'ec ec-favorites' ) ); ?>"></i>
            <?php if ( apply_filters( 'electro_show_wishlist_count', false ) ) : ?>
            <span class="navbar-wishlist-count count header-icon-counter" class="value"><?php echo yith_wcwl_count_products(); ?></span>
            <?php endif; ?>
        </a>
    </div><?php
        endif;
    }
}

require_once get_template_directory() . '/inc/template-tags/headers/header-v1.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v2.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v3.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v4.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v5.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v6.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v7.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v8.php';
require_once get_template_directory() . '/inc/template-tags/headers/header-v9.php';
