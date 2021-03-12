<?php
/**
 * Template functions used in header v7
 */
if ( ! function_exists( 'electro_navigation_v7' ) ) {
    function electro_navigation_v7() {
        ?><div class="electro-navigation-v7">
            <div class="container">
                <div class="electro-navigation">
                    <?php
                        /**
                        * @hooked electro_primary_nav_menu  - 10
                        */
                    do_action( 'electro_navigation_v7' ); ?>  
                </div>
            </div>
        </div><?php
    }
}

if ( ! function_exists( 'electro_masthead_v3' ) ) {
    /**
     * @since 2.0
     */
    function electro_masthead_v3() {
        ?><div class="masthead"><?php
        /**
        * @hooked electro_header_support_menu   - 10
        * @hooked electro_header_logo           - 20
        * @hooked electro_navbar_search         - 30
        * @hooked electro_header_icons          - 40
        */
        do_action( 'electro_masthead_v3' ); ?></div><?php
    }
}

if ( ! function_exists( 'electro_header_support_menu' ) ) {
    /** 
     * Displays Support menu
     */
    function electro_header_support_menu() {
        ?>

        <div class="header-support">
            <?php
                wp_nav_menu( array(
                    'theme_location'    => 'header-support',
                    'container'         => false,
                    'depth'             => 2,
                    'menu_class'        => 'nav nav-inline',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker()
                ) );
            ?>
        </div><!-- /.header-support -->

        <?php
    }
}