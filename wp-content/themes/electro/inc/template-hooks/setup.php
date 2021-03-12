<?php
/**
 * Theme setup hooks
 * 
 * @since 2.0
 */
/**
 * Setup
 */
add_action( 'after_setup_theme',    'electro_setup',                            10 );
add_action( 'after_setup_theme',    'electro_register_image_sizes',             10 );
add_action( 'after_setup_theme',    'electro_template_debug_mode',              20 );
add_action( 'tgmpa_register',       'electro_register_required_plugins',        10 );
add_action( 'widgets_init',         'electro_setup_sidebars',                   10 );
add_action( 'widgets_init',         'electro_register_widgets',                 20 );
add_action( 'init',                 'electro_remove_locale_stylesheet',         10 );