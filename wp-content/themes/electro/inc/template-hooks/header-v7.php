<?php

add_action( 'electro_header_v7', 'electro_masthead_v3',     10 );
add_action( 'electro_header_v7', 'electro_navigation_v7',   20 );

add_action( 'electro_navigation_v7', 'electro_primary_nav_menu', 10 );

/**
* Masthead
*/
add_action( 'electro_masthead_v3', 'electro_header_support_menu',  10 );
add_action( 'electro_masthead_v3', 'electro_header_logo',       20 );
add_action( 'electro_masthead_v3', 'electro_navbar_search',     30 );
add_action( 'electro_masthead_v3', 'electro_header_icons',      40 );