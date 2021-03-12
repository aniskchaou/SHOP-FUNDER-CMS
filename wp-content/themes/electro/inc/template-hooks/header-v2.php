<?php
/**
 * Hooks of Header v2
 *
 * @since 2.0
 */

add_action( 'electro_header_v2',   'electro_masthead_v2',      10 );
add_action( 'electro_header_v2',   'electro_navbar_v2',        20 );

add_action( 'electro_masthead_v2', 'electro_header_logo_area', 10 );
add_action( 'electro_masthead_v2', 'electro_primary_nav_menu', 20 );
add_action( 'electro_masthead_v2', 'electro_header_support',   30 );

add_action( 'electro_navbar_v2',   'electro_departments_menu_v2', 10 );
add_action( 'electro_navbar_v2',   'electro_navbar_search',    20 );
add_action( 'electro_navbar_v2',   'electro_header_icons',     30 );