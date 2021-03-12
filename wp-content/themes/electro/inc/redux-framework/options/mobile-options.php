<?php
/**
 * Options available for Mobile sub menu of Theme Options
 * 
 */

$mobile_options     = apply_filters( 'electro_mobile_options_args', array(
    'title'     => esc_html__( 'Mobile', 'electro' ),
    'icon'      => 'fas fa-mobile-alt',
    'desc'      => esc_html__( 'Options related to the mobile view.', 'electro' ),
    'fields'    => array(
        array(
            'title'     => esc_html__( 'Front Page', 'electro' ),
            'id'        => 'mobile_frontpage_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Separate home page in mobile?', 'electro' ),
            'id'        => 'enable_mobile_frontpage',
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'electro'),
            'off'       => esc_html__('Disabled', 'electro'),
            'default'   => 0,
        ),

        array(
            'id'        => 'mobile_frontpage_id',
            'title'     => esc_html__( 'Mobile Front Page', 'electro' ),
            'subtitle'  => esc_html__( 'Choose a page that will be the front page for mobile.', 'electro' ),
            'type'      => 'select',
            'data'      => 'pages',
        ),

        array(
            'id'        => 'mobile_frontpage_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Handheld Header', 'electro' ),
            'id'        => 'handheld_header_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Handheld Header Logo', 'electro' ),
            'subtitle'  => esc_html__( 'Upload your handheld header logo image.', 'electro' ),
            'id'        => 'handheld_header_logo',
            'type'      => 'media',
        ),

        array(
            'title'     => esc_html__( 'Header Style', 'electro' ),
            'subtitle'  => esc_html__( 'Select the header style for handheld.', 'electro' ),
            'id'        => 'handheld_header_style',
            'type'      => 'select',
            'options'   => array(
                'handheld-v2'   => esc_html__( 'Default Handheld Header', 'electro' ),
                'mobile-v1'     => esc_html__( 'Mobile Header v1', 'electro' ),
                'mobile-v2'     => esc_html__( 'Mobile Header v2', 'electro' )
            ),
            'default'   => 'handheld-v2',
        ),

        array(
            'title'     => esc_html__( 'Light background for Handheld Header?', 'electro' ),
            'id'        => 'handheld_header_v2_light_bg',
            'type'      => 'switch',
            'default'   => 0,
        ),

        array(
            'title'     => esc_html__( 'Sticky Header', 'electro' ),
            'id'        => 'sticky_handheld_header',
            'type'      => 'switch',
            'default'   => 0,
        ),

        array(
            'id'        => 'handheld_header_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Shop Page', 'electro' ),
            'id'        => 'mobile_shop_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Show "Add to Cart" button in mobile ?', 'electro' ),
            'id'        => 'enable_add_to_cart_mobile',
            'type'      => 'switch',
            'default'   => 0
        ),

        array(
            'id'        => 'mobile_shop_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'title'     => esc_html__( 'Handheld Footer', 'electro' ),
            'id'        => 'handheld_footer_start',
            'type'      => 'section',
            'indent'    => true
        ),

        array(
            'title'     => esc_html__( 'Handheld Footer Logo', 'electro' ),
            'subtitle'  => esc_html__( 'Upload your handheld footer logo image.', 'electro' ),
            'id'        => 'handheld_footer_logo',
            'type'      => 'media',
        ),

        array(
            'title'     => esc_html__('Footer Style', 'electro'),
            'subtitle'  => esc_html__('Select the footer style for handheld.', 'electro'),
            'id'        => 'handheld_footer_style',
            'type'      => 'select',
            'options'   => array(
                'v1'        => esc_html__( 'Footer v1', 'electro' ),
                'v2'        => esc_html__( 'Footer v2', 'electro' )
            ),
            'default'   => 'v1',
        ),

        array(
            'title'     => esc_html__( 'Light background for Handheld Footer?', 'electro' ),
            'id'        => 'handheld_footer_light_bg',
            'type'      => 'switch',
            'default'   => 0,
        ),

        array(
            'id'        => 'mobile_footer_bottom_widgets_start',
            'type'      => 'section',
            'indent'    => true,
            'title'     => esc_html__( 'Footer Bottom Widgets', 'electro' ),
            'subtitle'  => esc_html__( 'Options related to Footer Bottom Widgets. Add your widgets to Appearance > Widgets > Footer Bottom Widgets. If the widget area is empty, it loads the default widgets.', 'electro' ),
        ),

        array(
            'id'        => 'show_mobile_footer_bottom_widgets',
            'type'      => 'switch',
            'title'     => esc_html__( 'Show Footer Bottom Widgets ?', 'electro' ),
            'default'   => 1,
        ),

        array(
            'id'        => 'mobile_footer_bottom_widgets_end',
            'type'      => 'section',
            'indent'    => false
        ),

        array(
            'id'        => 'handheld_footer_end',
            'type'      => 'section',
            'indent'    => false
        )
    )
) );