<?php
/**
 * Template hooks used in header v8
 */

add_action( 'electro_header_v8', 'electro_masthead_v4', 10 );


add_action( 'electro_masthead_v4', 'electro_header_logo_area',      10 );
add_action( 'electro_masthead_v4', 'electro_navbar_search',         20 );
add_action( 'electro_masthead_v4', 'electro_secondary_nav_menu',    30 );
add_action( 'electro_masthead_v4', 'electro_header_icons',          40 );