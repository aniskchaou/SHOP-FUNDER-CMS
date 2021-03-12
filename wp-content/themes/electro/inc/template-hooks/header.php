<?php
/**
 * Template Hooks used in header
 */
add_action( 'wp_enqueue_scripts',       'electro_scripts',      10 );

add_action( 'electro_before_header',    'electro_skip_links',   0  );
add_action( 'electro_before_header',    'electro_top_bar',      10 );

add_action( 'electro_before_header_v5', 'electro_skip_links',                0 );

add_action( 'electro_before_header_v7',    'electro_top_bar_center',      10 );

add_action( 'electro_before_header_v8',    'electro_top_bar_v2',         10 );

add_action( 'electro_before_header_v9',    'electro_top_bar_v3',         10 );

add_action( 'electro_content_top',      'electro_breadcrumb',               10 );
add_action( 'electro_content_top',      'electro_site_content_inner_open',  20 );
add_action( 'electro_content_bottom',   'electro_site_content_inner_close', 10 );

require_once get_template_directory() . '/inc/template-hooks/header-v1.php';
require_once get_template_directory() . '/inc/template-hooks/header-v2.php';

require_once get_template_directory() . '/inc/template-hooks/header-v3.php';
require_once get_template_directory() . '/inc/template-hooks/header-v4.php';
require_once get_template_directory() . '/inc/template-hooks/header-v5.php';
require_once get_template_directory() . '/inc/template-hooks/header-v6.php';
require_once get_template_directory() . '/inc/template-hooks/header-v7.php';
require_once get_template_directory() . '/inc/template-hooks/header-v8.php';
require_once get_template_directory() . '/inc/template-hooks/header-v9.php';

add_action( 'electro_after_header',         'electro_handheld_header',      10 );

add_action( 'electro_header_handheld',      'electro_handheld_header_logo', 10 );
add_action( 'electro_header_handheld',      'electro_off_canvas_nav',       20 );
add_action( 'electro_header_handheld',      'electro_handheld_nav',         20 );

add_action( 'electro_handheld_header_v2',    'electro_off_canvas_nav',              10 );
add_action( 'electro_handheld_header_v2',    'electro_handheld_header_logo',        20 );
add_action( 'electro_handheld_header_v2',    'electro_handheld_header_links',       30 );

add_action( 'electro_mobile_header_v1',      'electro_off_canvas_nav',              10 );
add_action( 'electro_mobile_header_v1',      'electro_handheld_header_logo',        20 );
add_action( 'electro_mobile_header_v1',      'electro_handheld_header_links',       30 );
add_action( 'electro_mobile_header_v1',      'electro_handheld_header_search',      40 );

add_action( 'electro_mobile_header_v2',      'electro_off_canvas_nav',              10 );
add_action( 'electro_mobile_header_v2',      'electro_handheld_header_logo',        20 );
add_action( 'electro_mobile_header_v2',      'electro_handheld_header_links',       30 );
add_action( 'electro_mobile_header_v2',      'electro_handheld_header_search',      40 );
add_action( 'electro_mobile_header_v2',      'electro_mobile_handheld_department',  50 );
