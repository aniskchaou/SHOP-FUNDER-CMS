<?php
/**
 * Template functions related to Header v9
 */

if ( ! function_exists( 'electro_masthead_v5' ) ) {

    function electro_masthead_v5() {
        ?><div class="masthead"><?php
        /**
         * @hooked electro_header_logo_area     - 10
         * @hooked electro_navbar_search        - 20
         * @hooked electro_secondary_nav_menu   - 30
         * @hooked electro_header_icons         - 40
         */
        do_action( 'electro_masthead_v5' ); ?></div><?php
    }
}

if ( ! function_exists( 'electro_header_v9_navbar' ) ) {
    function electro_header_v9_navbar() {
        ?><div class="electro-nav electro-header-v9-navbar electro-animate-dropdown"><?php
            wp_nav_menu( array(
                'theme_location'    => 'header-v9-navbar',
                'container'         => false,
                'menu_class'        => 'nav navbar-nav yamm',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker()
            ) );
        ?></div><?php
    }
}