<?php
/**
 * Template tags used in header v3
 */

if ( ! function_exists( 'electro_navbar_primary_menu' ) ) {
    function electro_navbar_primary_menu() {
        ?><div class="electro-navbar-primary electro-animate-dropdown"><?php
        wp_nav_menu( array(
            'theme_location'    => 'navbar-primary',
            'container_class'   => 'container',
            'menu_class'        => 'nav navbar-nav yamm',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker()
        ) ); ?></div><?php
    }
}