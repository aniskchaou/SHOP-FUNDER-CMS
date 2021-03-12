<?php
/**
 * Options available for Header sub menu of Theme Options
 *
 */
$nav_menus    = get_terms( 'nav_menu' );
$menu_options = array(
    '0' => esc_html__( 'Default WooCommerce account menu', 'electro' )
);

foreach( $nav_menus as $nav_menu ) {
    $menu_options[ $nav_menu->term_id ] = $nav_menu->name;
}

$header_options     = apply_filters( 'electro_header_options_args', array(
    'title'     => esc_html__( 'Header', 'electro' ),
    'icon'      => 'far fa-arrow-alt-circle-up',
    'desc'      => esc_html__( 'Options related to the header section. The header has 7 different styles including top bar, masthead, etc.', 'electro' ),
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Top Bar', 'electro' ),
            'id'        => 'top_bar_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array( 'header_style', 'equals' , array( 'v1', 'v2', 'v3', 'v4', 'v6', 'v7', 'v8', 'v9' ) ),
        ),

        array(
            'id'        => 'header_top_bar_show',
            'title'     => esc_html__( 'Show Top Bar', 'electro' ),
            'type'      => 'switch',
            'default'   => 1,
        ),

        array(
            'id'        => 'header_top_bar_show_mobile',
            'title'     => esc_html__( 'Show Top Bar in Mobile', 'electro' ),
            'type'      => 'switch',
            'default'   => 0,
        ),

        array(
            'id'        => 'header_enable_topbar_additional_links',
            'title'     => esc_html__( 'Show Top Bar Additional Links', 'electro' ),
            'type'      => 'switch',
            'default'   => 1,
            'required'  => array( 'header_style', 'equals', 'v9' )
        ),

        array(
            'id'        => 'header_topbar_additional_links_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Additional Links Title', 'electro' ),
            'default'   =>  __( 'Two Shops<br>One Shipment', 'electro' ),
            'required'  => array( 
                array( 'header_style', 'equals', 'v9' ),
                array( 'header_enable_topbar_additional_links', 'equals', true ),
            ),
        ),

        array(
            'id'        => 'header_topbar_additional_link_1_text',
            'type'      => 'text',
            'title'     => esc_html__( 'Additional Link #1 Title', 'electro' ),
            'default'   => esc_html__( 'Electronics', 'electro' ),
            'required'  => array( 
                array( 'header_style', 'equals', 'v9' ),
                array( 'header_enable_topbar_additional_links', 'equals', true ),
            ),
        ),

        array(
            'id'        => 'header_topbar_additional_link_1_url',
            'type'      => 'text',
            'title'     => esc_html__( 'Additional Link #1 URL', 'electro' ),
            'default'   => '#',
            'required'  => array( 
                array( 'header_style', 'equals', 'v9' ),
                array( 'header_enable_topbar_additional_links', 'equals', true ),
            ),
        ),

        array(
            'id'        => 'header_topbar_additional_link_1_image',
            'title'     => esc_html__( 'Additional Link #1 Image', 'electro' ),
            'subtitle'  => esc_html__( 'Upload your additional link #1 image.', 'electro' ),
            'type'      => 'media',
            'required'  => array( 
                array( 'header_style', 'equals', 'v9' ),
                array( 'header_enable_topbar_additional_links', 'equals', true ),
            ),
        ),

        array(
            'id'        => 'header_topbar_additional_link_2_text',
            'type'      => 'text',
            'title'     => esc_html__( 'Additional Links Title', 'electro' ),
            'default'   => esc_html__( 'Power Tools', 'electro' ),
            'required'  => array( 
                array( 'header_style', 'equals', 'v9' ),
                array( 'header_enable_topbar_additional_links', 'equals', true ),
            ),
        ),

        array(
            'id'        => 'header_topbar_additional_link_2_url',
            'type'      => 'text',
            'title'     => esc_html__( 'Additional Link #2 URL', 'electro' ),
            'default'   => '#',
            'required'  => array( 
                array( 'header_style', 'equals', 'v9' ),
                array( 'header_enable_topbar_additional_links', 'equals', true ),
            ),
        ),

        array(
            'id'        => 'header_topbar_additional_link_2_image',
            'title'     => esc_html__( 'Additional Link #2 Image', 'electro' ),
            'subtitle'  => esc_html__( 'Upload your additional link #2 image.', 'electro' ),
            'type'      => 'media',
            'required'  => array( 
                array( 'header_style', 'equals', 'v9' ),
                array( 'header_enable_topbar_additional_links', 'equals', true ),
            ),
        ),

        array(
            'id'        => 'top_bar_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Masthead', 'electro' ),
            'id'        => 'masthead_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'id'        => 'header_show_tooltip',
            'title'     => esc_html__( 'Show Tooltip for Header Icons', 'electro' ),
            'type'      => 'switch',
            'default'   => 1,
        ),

        array(
            'title'     => esc_html__( 'Header Icon Tooltip Position', 'electro' ),
            'subtitle'  => esc_html__( 'Choose the position of header icon tooltip.', 'electro' ),
            'id'        => 'header_icon_tooltip_position',
            'type'      => 'select',
            'options'   => array(
                'top'       => esc_html__( 'Top', 'electro' ),
                'right'     => esc_html__( 'Right', 'electro' ),
                'left'      => esc_html__( 'Left', 'electro' ),
                'bottom'    => esc_html__( 'Bottom', 'electro' )
            ),
            'default'   => 'bottom',
            'required'  => array( 'header_show_tooltip', 'equals', true ),
        ),

        array(
            'title'     => esc_html__('Header Style', 'electro'),
            'subtitle'  => esc_html__('Select the header style.', 'electro'),
            'id'        => 'header_style',
            'type'      => 'select',
            'options'   => array(
                'v1'        => esc_html__( 'Header v1', 'electro' ),
                'v2'        => esc_html__( 'Header v2', 'electro' ),
                'v3'        => esc_html__( 'Header v3', 'electro' ),
                'v4'        => esc_html__( 'Header v4', 'electro' ),
                'v5'        => esc_html__( 'Header v5', 'electro' ),
                'v6'        => esc_html__( 'Header v6', 'electro' ),
                'v7'        => esc_html__( 'Header v7', 'electro' ),
                'v8'        => esc_html__( 'Header v8', 'electro' ),
                'v9'        => esc_html__( 'Header v9', 'electro' ),
            ),
            'default'   => 'v2',
        ),

        array(
            'title'     => esc_html__( 'Sticky Header', 'electro' ),
            'id'        => 'sticky_header',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'electro'),
            'off'       => esc_html__('Disabled', 'electro'),
            'default'   => 0,
        ),

        array(
            'title'     => esc_html__( 'Your Logo', 'electro' ),
            'subtitle'  => esc_html__( 'Upload your header logo image.', 'electro' ),
            'id'        => 'site_header_logo',
            'type'      => 'media',
        ),

        array(
            'id'        => 'off_canvas_nav_in_desktop',
            'title'     => esc_html__( 'Off Canvas Menu in Desktop ?', 'electro' ),
            'subtitle'  => esc_html__( 'Enable this to display Off Canvas Menu in Desktop.', 'electro' ),
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'electro'),
            'off'       => esc_html__('Disabled', 'electro'),
            'default'   => 1,
        ),

        array(
            'id'        => 'masthead_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Navbar', 'electro' ),
            'id'        => 'header_navbar_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'id'        => 'header_vertical_menu_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Vertical Menu Title', 'electro' ),
            'default'   => esc_html__( 'All Departments', 'electro' ),
        ),

        array(
            'id'        => 'header_vertical_menu_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'Vertical Menu Icon', 'electro' ),
            'default'   => 'fa fa-list-ul',
        ),

        array(
            'id'        => 'header_departments_menu_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Header v2 "All Departments" menu title', 'electro' ),
            'default'   => esc_html__( 'Shop By Department', 'electro' ),
        ),

        array(
            'id'        => 'header_v5_departments_menu_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Header v5 "All Departments" menu title', 'electro' ),
            'default'   => esc_html__( 'All Departments', 'electro' ),
        ),

        array(
            'id'        => 'header_v6_departments_menu_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Header v6 "Categories" menu title', 'electro' ),
            'default'   => esc_html__( 'Categories', 'electro' ),
        ),

        array(
            'id'        => 'header_navbar_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Header Search', 'electro' ),
            'id'        => 'header_search_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'id'        => 'header_navbar_search_placeholder',
            'type'      => 'text',
            'title'     => esc_html__( 'Navbar Search Placeholder', 'electro' ),
            'default'   => esc_html__( 'Search for Products', 'electro' ),
        ),

        array(
            'id'        => 'enable_header_navbar_search_dropdown',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Search Categories dropdown', 'electro' ),
            'default'   => 1,
        ),

        array(
            'id'        => 'header_navbar_search_dropdown_categories',
            'type'      => 'select',
            'title'     => esc_html__( 'Search Category Dropdown', 'electro' ),
            'options'   => array(
                'show_only_top_level' => esc_html__( 'Include only top level categories', 'electro' ),
                'show_all'            => esc_html__( 'Include all categories', 'electro' ),
            ),
            'default'   => 'show_only_top_level',
            'required'  => array( 'enable_header_navbar_search_dropdown', 'equals', 1 ),
        ),

        array(
            'id'        => 'header_navbar_search_dropdown_text',
            'type'      => 'text',
            'title'     => esc_html__( 'Navbar Search default dropdown text', 'electro' ),
            'default'   => esc_html__( 'All Categories', 'electro' ),
            'required'  => array( 'enable_header_navbar_search_dropdown', 'equals', 1 ),
        ),

        array(
            'id'        => 'header_live_search',
            'title'     => esc_html__( 'Enable Live search ?', 'electro' ),
            'type'      => 'switch',
            'default'   => 1,
        ),

        array(
            'id'        => 'header_search_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Header Support', 'electro' ),
            'id'        => 'header_support_start',
            'type'      => 'section',
            'indent'    => true,
            'required'  => array( 'header_style', 'equals' , array( 'v2' ) ),
        ),

        array(
            'id'        => 'header_support_block_show',
            'title'     => esc_html__( 'Show Header Support Block', 'electro' ),
            'type'      => 'switch',
            'default'   => 1,
        ),

        array(
            'id'        => 'header_support_number',
            'type'      => 'text',
            'title'     => esc_html__( 'Header Support Number', 'electro' ),
            'default'   => '<strong>Support</strong> (+800) 856 800 604',
            'required'  => array( 'header_support_block_show', 'equals' , 1 ),
        ),

        array(
            'id'        => 'header_support_email',
            'type'      => 'text',
            'title'     => esc_html__( 'Header Support Email', 'electro' ),
            'default'   => 'Email: info@electro.com',
            'required'  => array( 'header_support_block_show', 'equals' , 1 ),
        ),

        array(
            'id'        => 'header_support_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Header Cart', 'electro' ),
            'id'        => 'header_cart_start',
            'subtitle'  => esc_html__(' The settings below are applicable only if WooCommerce plugin is activated', 'electro' ),
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'id'        => 'header_cart_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'Cart Icon', 'electro' ),
            'default'   => 'ec ec-shopping-bag',
        ),

        array(
            'id'        => 'header_cart_dropdown_disable',
            'title'     => esc_html__( 'Disable dropdown menu in header cart ?', 'electro' ),
            'subtitle'  => esc_html__( 'If you are using a sticky header, you might want to disable dropdown menu', 'electro' ),
            'type'      => 'switch',
            'default'   => 0,
            'on'        => esc_html__( 'Enabled', 'electro' ),
            'off'       => esc_html__( 'Disabled', 'electro' ),
        ),

        array(
            'id'        => 'off_canvas_cart',
            'title'     => esc_html__( 'Off Canvas Cart ?', 'electro' ),
            'subtitle'  => esc_html__( 'Enable this to display Off Canvas Cart.', 'electro' ),
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'electro'),
            'off'       => esc_html__('Disabled', 'electro'),
            'default'   => 0,
        ),

        array(
            'id'        => 'header_cart_end',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Header User Account', 'electro' ),
            'id'        => 'header_user_account_start',
            'subtitle'  => esc_html__(' The settings below are applicable only if WooCommerce plugin is activated', 'electro' ),
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'id'        => 'header_user_account_enable',
            'title'     => esc_html__( 'Enable user account icon in header ?', 'electro' ),
            'type'      => 'switch',
            'default'   => 0,
            'on'        => esc_html__('Enabled', 'electro'),
            'off'       => esc_html__('Disabled', 'electro'),
        ),

        array(
            'id'        => 'header_user_account_icon',
            'type'      => 'text',
            'title'     => esc_html__( 'User Account Icon', 'electro' ),
            'default'   => 'ec ec-user',
            'required'  => array( 'header_user_account_enable', 'equals', 1 )
        ),

        array(
            'title'     => esc_html__( 'Logged in dropdown menu', 'electro'),
            'subtitle'  => esc_html__('Select the menu you want to show in dropdown when the user is logged in.', 'electro'),
            'id'        => 'header_user_account_logged_in_menu',
            'type'      => 'select',
            'options'   => $menu_options,
            'default'   => '0',
            'required'  => array( 'header_user_account_enable', 'equals', 1 )
        ),

        array(
            'id'        => 'header_user_account_end',
            'type'      => 'section',
            'indent'    => true
        ),
    )
) );
