<?php
/**
 * Template hooks used in header v9
 */

add_action( 'electro_header_v9', 'electro_masthead_v5', 10 );
add_action( 'electro_header_v9', 'electro_header_v9_navbar', 10 );

add_action( 'electro_masthead_v5', 'electro_header_logo_area',      10 );
add_action( 'electro_masthead_v5', 'electro_navbar_search',         20 );
add_action( 'electro_masthead_v5', 'electro_secondary_nav_menu',    30 );
add_action( 'electro_masthead_v5', 'electro_header_icons',          40 );