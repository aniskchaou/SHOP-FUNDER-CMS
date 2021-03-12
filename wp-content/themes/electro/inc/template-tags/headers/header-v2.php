<?php
/**
 * Header template functions used in header v2
 *
 * @since 2.0
 */
if ( ! function_exists( 'electro_masthead_v2' ) ) {
    /**
     * @since 2.0
     */
    function electro_masthead_v2() { 
        ?><div class="masthead"><?php
        /**
         * @hooked electro_header_logo_area - 10
         * @hooked electro_primary_nav_menu - 20
         * @hooked electro_header_support   - 30
         */
        do_action( 'electro_masthead_v2' ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_primary_nav_menu' ) ) {
    /**
     * @since 2.0
     */
    function electro_primary_nav_menu() {
        wp_nav_menu( array(
            'theme_location'    => 'primary-nav',
            'container_class'   => 'primary-nav-menu electro-animate-dropdown',
            'menu_class'        => 'nav nav-inline yamm',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker()
        ) );
    }
}

if ( ! function_exists( 'electro_header_support' ) ) {
    /**
     * @since 2.0
     */
    function electro_header_support() {

        $support_number = apply_filters( 'electro_header_support_number', '<strong>Support</strong> (+800) 856 800 604' );
        $support_email  = apply_filters( 'electro_header_support_email', 'Email: info@electro.com' );
        $support_icon   = apply_filters( 'electro_header_support_icon', 'ec ec-support' );
        
        if ( apply_filters( 'electro_show_header_support_info', true ) ) : ?><div class="header-support">
            <div class="header-support-inner">
                <div class="support-icon">
                    <i class="<?php echo esc_attr( $support_icon ); ?>"></i>
                </div>
                <div class="support-info">
                    <div class="support-number"><?php echo wp_kses_post( $support_number ); ?></div>
                    <div class="support-email"><?php echo wp_kses_post( $support_email ); ?></div>
                </div>
            </div>
        </div><?php endif;
    }
}

if ( ! function_exists( 'electro_navbar_v2' ) ) {
    /**
     * @since 2.0
     */
    function electro_navbar_v2() {
        ?><div class="electro-navbar">
            <div class="container">
                <div class="electro-navbar-inner">
                <?php 
                /**
                 * 
                 */
                do_action( 'electro_navbar_v2' ); ?>
                </div>
            </div>
        </div><?php
    }
}