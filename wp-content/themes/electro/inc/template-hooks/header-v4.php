<?php
/**
 * Template hooks for header v4
 */

add_action( 'electro_header_v4', 'electro_masthead', 10 );
add_action( 'electro_header_v4', 'electro_navbar_primary_menu', 20 );