<?php
add_action( 'electro_header_v5', 'electro_masthead',      10 );
add_action( 'electro_header_v5', 'electro_navigation_v5', 20 );

add_action( 'electro_navigation_v5', 'electro_departments_menu_v2', 10 );
add_action( 'electro_navigation_v5', 'electro_secondary_nav_menu',   20 );