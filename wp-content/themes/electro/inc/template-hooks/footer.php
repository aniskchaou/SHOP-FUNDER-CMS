<?php
/**
 * Template hooks for Electro Footer
 *
 * @since 2.0
 */
/**
 * Footer
 */
add_action( 'electro_before_footer',    'electro_footer_brands_carousel',   10 );

add_action( 'electro_footer',           'electro_footer_widgets',           10 );
add_action( 'electro_footer',           'electro_footer_divider',           20 );
add_action( 'electro_footer',           'electro_footer_bottom_widgets',    30 );
add_action( 'electro_footer',           'electro_copyright_bar',            40 );
add_action( 'electro_after_footer',     'electro_handheld_footer_bar',      999 );

add_action( 'electro_footer_contact',   'electro_footer_logo',              10 );
add_action( 'electro_footer_contact',   'electro_footer_call_us',           20 );
add_action( 'electro_footer_contact',   'electro_footer_address',           30 );
add_action( 'electro_footer_contact',   'electro_footer_social_icons',      40 );

add_action( 'electro_footer_divider',   'electro_footer_newsletter',        10 );

add_action( 'electro_default_footer_bottom_widgets', 'electro_default_fb_widgets', 20 );

add_action( 'electro_before_footer_v2',    'electro_footer_brands_carousel',    10 );

add_action( 'electro_footer_v2',           'electro_footer_v2_desktop_wrap_open',   5 );
add_action( 'electro_footer_v2',           'electro_footer_widgets_v2',             10 );
add_action( 'electro_footer_v2',           'electro_footer_divider_v2',             20 );
add_action( 'electro_footer_v2',           'electro_footer_bottom_widgets_v2',      30 );
add_action( 'electro_footer_v2',           'electro_copyright_bar_v2',              40 );
add_action( 'electro_footer_v2',           'electro_footer_v2_wrap_close',          45 );
add_action( 'electro_footer_v2',           'electro_footer_v2_handheld_wrap_open',  50 );
add_action( 'electro_footer_v2',           'electro_footer_v2_handheld',            60 );
add_action( 'electro_footer_v2',           'electro_footer_v2_wrap_close',          99 );

add_action( 'electro_footer_v2_handheld',   'electro_footer_v2_handheld_widgets_menu_open',     10 );
add_action( 'electro_footer_v2_handheld',   'electro_display_mobile_footer_bottom_widgets',     20 );
add_action( 'electro_footer_v2_handheld',   'electro_footer_v2_wrap_close',                     30 );
add_action( 'electro_footer_v2_handheld',   'electro_footer_social_icons_hh',                   40 );
add_action( 'electro_footer_v2_handheld',   'electro_footer_v2_handheld_footer_bar_open',       50 );
add_action( 'electro_footer_v2_handheld',   'electro_handheld_footer_logo',                     60 );
add_action( 'electro_footer_v2_handheld',   'electro_footer_call_us_v2',                        70 );
add_action( 'electro_footer_v2_handheld',   'electro_footer_v2_handheld_footer_bar_close',      80 );

add_action( 'electro_footer_divider_v2',   'electro_footer_newsletter_v2',               10 );

add_action( 'electro_default_footer_bottom_widgets_v2', 'electro_default_fb_widgets',    20 );

add_action( 'electro_mobile_footer_v1',     'electro_mobile_footer_v1_wrap_open',                5 );
add_action( 'electro_mobile_footer_v1',     'electro_footer_v2_handheld_widgets_menu_open',     10 );
add_action( 'electro_mobile_footer_v1',     'electro_display_mobile_footer_bottom_widgets',     20 );
add_action( 'electro_mobile_footer_v1',     'electro_footer_v2_wrap_close',                     30 );
add_action( 'electro_mobile_footer_v1',     'electro_footer_social_icons_hh',                   40 );
add_action( 'electro_mobile_footer_v1',     'electro_footer_v2_handheld_footer_bar_open',       50 );
add_action( 'electro_mobile_footer_v1',     'electro_handheld_footer_logo',                     60 );
add_action( 'electro_mobile_footer_v1',     'electro_footer_call_us_v2',                        70 );
add_action( 'electro_mobile_footer_v1',     'electro_footer_v2_handheld_footer_bar_close',      80 );
add_action( 'electro_mobile_footer_v1',     'electro_footer_v2_wrap_close',                     99 );

add_action( 'electro_mobile_footer_v2',     'electro_mobile_footer_v2_wrap_open',                5 );
add_action( 'electro_mobile_footer_v2',     'electro_footer_v2_handheld_widgets_menu_open',     10 );
add_action( 'electro_mobile_footer_v2',     'electro_display_mobile_footer_bottom_widgets',     20 );
add_action( 'electro_mobile_footer_v2',     'electro_footer_v2_wrap_close',                     30 );
add_action( 'electro_mobile_footer_v2',     'electro_footer_social_icons_hh',                   40 );
add_action( 'electro_mobile_footer_v2',     'electro_footer_v2_handheld_footer_bar_open',       50 );
add_action( 'electro_mobile_footer_v2',     'electro_handheld_footer_logo',                     60 );
add_action( 'electro_mobile_footer_v2',     'electro_footer_call_us_v2',                        70 );
add_action( 'electro_mobile_footer_v2',     'electro_footer_v2_handheld_footer_bar_close',      80 );
add_action( 'electro_mobile_footer_v2',     'electro_footer_v2_wrap_close',                     99 );
