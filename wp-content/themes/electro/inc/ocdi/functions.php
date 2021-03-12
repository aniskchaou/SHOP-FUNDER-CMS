<?php

function electro_ocdi_import_files() {
    if( apply_filters( 'electro_visual_composer_2_dummy_data', true ) ) {
        $dd_path_vc = trailingslashit( get_template_directory() ) . 'assets/dummy-data/visualcomposer-2/';
    } else {
        $dd_path_vc = trailingslashit( get_template_directory() ) . 'assets/dummy-data/visualcomposer/';
    }

    $dd_path_el = trailingslashit( get_template_directory() ) . 'assets/dummy-data/elementor/';

    $import_files = array(
        array(
            'import_file_name'             => 'Electro - WP Bakery Page Builder',
            'local_import_file'            => $dd_path_vc . 'dummy-data.xml',
            'local_import_widget_file'     => $dd_path_vc . 'widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => $dd_path_vc . 'redux-options.json',
                    'option_name' => 'electro_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/electro-preview.jpg',
            'import_notice'                => esc_html__( 'Import process may take 10-15 minutes. If you facing any issues please contact our support.', 'electro' ),
            'preview_url'                  => 'https://demo2.madrasthemes.com/electro/',
        )
    );

    if ( is_elementor_activated() ) {
        $import_files[] = array(
            'import_file_name'             => 'Electro - Elementor',
            'local_import_file'            => $dd_path_el . 'dummy-data.xml',
            'local_import_widget_file'     => $dd_path_el . 'widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => $dd_path_el . 'redux-options.json',
                    'option_name' => 'electro_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/electro-preview.jpg',
            'import_notice'                => esc_html__( 'Import process may take 10-15 minutes. Make sure that the Elementor plugin activated. If you facing any issues please contact our support.', 'electro' ),
            'preview_url'                  => 'https://demo2.madrasthemes.com/electro/',
        );
    }

    return apply_filters( 'electro_ocdi_files_args', $import_files );
}

function electro_ocdi_after_import_setup( $selected_import ) {

    // Assign menus to their locations.
    $topbar_left_menu       = get_term_by( 'name', 'Top Bar Left', 'nav_menu' );
    $topbar_right_menu      = get_term_by( 'name', 'Top Bar Right', 'nav_menu' );
    $primary_menu           = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $navbar_primary_menu    = get_term_by( 'name', 'Navbar Primary', 'nav_menu' );
    $secondary_menu         = get_term_by( 'name', 'Secondary Nav', 'nav_menu' );
    $departments_menu       = get_term_by( 'name', 'Departments Menu', 'nav_menu' );
    $all_departments_menu   = get_term_by( 'name', 'All Departments Menu', 'nav_menu' );
    $blog_menu              = get_term_by( 'name', 'Blog Menu', 'nav_menu' );
    $mobile_hh_departments  = get_term_by( 'name', 'Mobile Handheld Department', 'nav_menu' );
    $topbar_center          = get_term_by( 'name', 'Top Bar Center', 'nav_menu' );
    $header_support         = get_term_by( 'name', 'Header Support', 'nav_menu' );

    $nav_menu_locations_args = array(
        'topbar-left'                   => $topbar_left_menu->term_id,
        'topbar-right'                  => $topbar_right_menu->term_id,
        'primary-nav'                   => $primary_menu->term_id,
        'navbar-primary'                => $navbar_primary_menu->term_id,
        'secondary-nav'                 => $secondary_menu->term_id,
        'departments-menu'              => $departments_menu->term_id,
        'all-departments-menu'          => $all_departments_menu->term_id,
        'blog-menu'                     => $blog_menu->term_id,
        'hand-held-nav'                 => $all_departments_menu->term_id,
        'mobile-handheld-department'    => $mobile_hh_departments->term_id,
        'topbar-center'                 => $topbar_center->term_id,
        'header-support'                => $header_support->term_id,
    );

    if( apply_filters( 'electro_visual_composer_2_dummy_data', true ) ) {
        $navbar_v9_menu = get_term_by( 'name', 'Header v9 Navbar', 'nav_menu' );
        $nav_menu_locations_args['header-v9-navbar'] = $navbar_v9_menu->term_id;
    }

    set_theme_mod( 'nav_menu_locations', $nav_menu_locations_args );

    // Assign front page and posts page (blog page) and other WooCommerce pages
    $front_page_id      = get_page_by_title( 'Home v1' );
    $blog_page_id       = get_page_by_title( 'Blog' );
    $shop_page_id       = get_page_by_title( 'Shop' );
    $cart_page_id       = get_page_by_title( 'Cart' );
    $checkout_page_id   = get_page_by_title( 'Checkout' );
    $myaccount_page_id  = get_page_by_title( 'My Account' );
    $terms_page_id      = get_page_by_title( 'Terms and Conditions' );
    $wishlist_page      = get_page_by_title( 'Wishlist' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
    update_option( 'woocommerce_shop_page_id', $shop_page_id->ID );
    update_option( 'woocommerce_cart_page_id', $cart_page_id->ID );
    update_option( 'woocommerce_checkout_page_id', $checkout_page_id->ID );
    update_option( 'woocommerce_myaccount_page_id', $myaccount_page_id->ID );
    update_option( 'woocommerce_terms_page_id', $terms_page_id->ID );
    update_option( 'yith_wcwl_wishlist_page_id', $wishlist_page->ID );

    // Update Wishlist Position
    update_option( 'yith_wcwl_button_position', 'shortcode' );

    // Enable Registration on "My Account" page
    update_option( 'woocommerce_enable_myaccount_registration', 'yes' );

    // Set WPBPage Builder ( formerly Visual Composer ) for Static Blocks
    if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
        vc_set_default_editor_post_types( array( 'page', 'static_block', 'mas_static_content' ) );
    }

    if( class_exists( 'RevSlider' ) ) {
        $dd_path = trailingslashit( get_template_directory() ) . 'assets/dummy-data/sliders/';

        require_once( ABSPATH . 'wp-load.php' );
        require_once( ABSPATH . 'wp-includes/functions.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );

        $slider_array = array(
            $dd_path . 'home-v1-slider.zip',
            $dd_path . 'home-v2-slider.zip',
            $dd_path . 'home-v3-slider.zip',
            $dd_path . 'home-v4-slider.zip',
            $dd_path . 'home-v5-slider.zip',
            $dd_path . 'home-v7-slider.zip',
        );

        if( apply_filters( 'electro_visual_composer_2_dummy_data', true ) ) {
            $slider_array[] = $dd_path . 'home-v8-slider.zip';
            $slider_array[] = $dd_path . 'home-v9-slider.zip';
        }

        $slider = new RevSlider();

        foreach( $slider_array as $filepath ) {
            $slider->importSliderFromPost( true, true, $filepath );
        }
    }

    if ( function_exists( 'wc_delete_product_transients' ) ) {
        wc_delete_product_transients();
    }
    if ( function_exists( 'wc_delete_shop_order_transients' ) ) {
        wc_delete_shop_order_transients();
    }
    if ( function_exists( 'wc_delete_expired_transients' ) ) {
        wc_delete_expired_transients();
    }

    // Import WPForms
    electro_ocdi_import_wpforms();
}

function electro_ocdi_before_widgets_import() {

    $sidebars_widgets = get_option('sidebars_widgets');
    $all_widgets = array();

    array_walk_recursive( $sidebars_widgets, function ($item, $key) use ( &$all_widgets ) {
        if( ! isset( $all_widgets[$key] ) ) {
            $all_widgets[$key] = $item;
        } else {
            $all_widgets[] = $item;
        }
    } );

    if( isset( $all_widgets['array_version'] ) ) {
        $array_version = $all_widgets['array_version'];
        unset( $all_widgets['array_version'] );
    }

    $new_sidebars_widgets = array_fill_keys( array_keys( $sidebars_widgets ), array() );

    $new_sidebars_widgets['wp_inactive_widgets'] = $all_widgets;
    if( isset( $array_version ) ) {
        $new_sidebars_widgets['array_version'] = $array_version;
    }

    update_option( 'sidebars_widgets', $new_sidebars_widgets );
}

function electro_ocdi_import_wpforms() {
    if ( ! function_exists( 'wpforms' ) ) {
		return;
	}

    $forms = [
        [
            'file' => get_template_directory() . '/assets/dummy-data/wpforms-contact.json'
        ],
        [
            'file' => get_template_directory() . '/assets/dummy-data/wpforms-newsletter.json'
        ]
    ];

    foreach ( $forms as $form ) {
        $form_data = json_decode( file_get_contents( $form['file'] ), true );

        if ( empty( $form_data[0] ) ) {
			continue;
		}
		$form_data = $form_data[0];
		// Create initial form to get the form ID.
		$form_id   = wpforms()->form->add( $form_data['settings']['form_title'] );

        if ( empty( $form_id ) ) {
			continue;
		}

        $form_data['id'] = $form_id;
		// Save the form data to the new form.
		wpforms()->form->update( $form_id, $form_data );
    }
}
