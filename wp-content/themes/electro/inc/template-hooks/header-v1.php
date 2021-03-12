<?php
/**
 * Hooks of Header v1
 *
 * @since 2.0
 */

add_action( 'electro_header_v1', 'electro_masthead',   10 );
add_action( 'electro_header_v1', 'electro_navigation', 20 );

/**
 * Masthead
 */
add_action( 'electro_masthead', 'electro_header_logo_area',  10 );
add_action( 'electro_masthead', 'electro_navbar_search',     20 );
add_action( 'electro_masthead', 'electro_header_icons',      30 );

/**
 * Electro Navigation
 */
add_action( 'electro_navigation', 'electro_departments_menu_v2', 10 );
add_action( 'electro_navigation', 'electro_secondary_nav_menu',   20 );

/**
 * Header Logo Area
 */
add_action( 'electro_header_logo_area',  'electro_header_logo',      10 );
add_action( 'electro_header_logo_area',  'electro_off_canvas_nav',   20 );

/**
 * Header Icons
 */
add_action( 'electro_header_icons',    'electro_compare_header_icon',   70 );
add_action( 'electro_header_icons',    'electro_wishlist_header_icon',  80 );