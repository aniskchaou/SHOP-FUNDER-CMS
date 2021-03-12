<?php
/**
 * electro hooks
 *
 * @package electro
 *
 * Hooks and filters for Structure
 */
/**
 * Layout
 *
 */
add_action( 'electro_before_main_content',		'electro_content_wrapper_start',	10 );
add_action( 'electro_after_main_content',		'electro_content_wrapper_end',		20 );

/**
 * Posts
 *
 * @see  electro_blog_navigation()
 * @see  electro_post_loop_media()
 * @see  electro_post_header()
 * @see  electro_post_loop_content()
 * @see  electro_post_content()
 * @see  electro_paging_nav()
 * @see  electro_post_media_attachment()
 * @see  electro_single_post_header()
 * @see  electro_post_nav()
 * @see  electro_display_comments()
 */
add_action( 'electro_before_main_content',	'electro_blog_navigation',			9 );
add_action( 'electro_loop_post',			'electro_post_loop_media',			10 );
add_action( 'electro_loop_post',			'electro_post_body_wrap_start',		15 );
add_action( 'electro_loop_post',			'electro_post_header',				20 );
add_action( 'electro_loop_post',			'electro_post_loop_content',		30 );
add_action( 'electro_loop_post', 			'electro_init_structured_data',     31 );
add_action( 'electro_loop_post',			'electro_post_body_wrap_end',		35 );
add_action( 'electro_loop_after',			'electro_paging_nav',				10 );
add_action( 'electro_single_post',			'electro_post_media_attachment',	10 );
add_action( 'electro_single_post',			'electro_post_header',				20 );
add_action( 'electro_single_post',			'electro_post_content',				30 );
add_action( 'electro_single_post', 			'electro_init_structured_data',     40 );
add_action( 'electro_single_post_after',	'electro_author_info',				10 );
add_action( 'electro_single_post_after',	'electro_post_nav',					10 );
add_action( 'electro_single_post_after',	'electro_display_comments',			20 );

/**
 * Pages
 * @see  electro_page_header()
 * @see  electro_page_content()
 * @see  electro_display_comments()
 */
add_action( 'electro_page', 			'electro_page_header',		    10 );
add_action( 'electro_page', 			'electro_page_content',		    20 );
add_action( 'electro_page', 			'electro_init_structured_data', 30 );
add_action( 'electro_page_after', 		'electro_display_comments',	    10 );

/**
 * Extras
 */
add_filter( 'excerpt_length',					'electro_excerpt_length',			10 );
add_filter( 'excerpt_more',						'electro_excerpt_more',				10 );
add_filter( 'electro_show_page_header',			'electro_hide_page_header',			10 );
add_filter( 'electro_show_breadcrumb', 			'electro_toggle_breadcrumb', 		10 );
add_filter( 'nav_menu_link_attributes',			'electro_add_data_hover_attribute',	10, 4 );
