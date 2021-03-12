<?php
/**
 * Options available for Shop sub menu of Theme Options
 *
 */

$shop_options 	= apply_filters( 'electro_shop_options_args', array(
	'title'		=> esc_html__( 'Shop', 'electro' ),
	'icon'      => 'fas fa-shopping-cart',
	'fields'	=> array(
		array(
			'title'		=> esc_html__( 'General', 'electro' ),
			'id'		=> 'shop_general_info_start',
			'type'		=> 'section',
			'indent'	=> true
		),
		array(
			'title'		=> esc_html__( 'Catalog Mode', 'electro' ),
			'subtitle'	=> esc_html__( 'Enable / Disable the Catalog Mode.', 'electro' ),
			'id'		=> 'catalog_mode',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 0,
		),
		array(
			'title' 	=> esc_html__( 'Brand Attribute', 'electro' ),
			'subtitle' 	=> esc_html__( 'Choose a product attribute that will be used as brands', 'electro' ),
			'desc'  	=> esc_html__( 'Once you choose a brand attribute, you will be able to add brand images to the attributes', 'electro' ),
			'id' 		=> 'product_brand_taxonomy',
			'type' 		=> 'select',
			'options' 	=> redux_get_product_attr_taxonomies()
		),
		array(
			'id'		=> 'compare_page_id',
			'title'		=> __( 'Shop Comparison Page', 'electro' ),
			'subtitle'	=> __( 'Choose a page that will be the product compare page for shop.', 'electro' ),
			'type'		=> 'select',
			'data'		=> 'pages',
		),
		array(
			'id'		=> 'shop_jumbotron_id',
			'title'		=> __( 'Shop Page Jumbotron', 'electro' ),
			'subtitle'	=> __( 'Choose a static block that will be the jumbotron element for shop page', 'electro' ),
			'type'		=> 'select',
			'data'		=> 'posts',
			'args'		=> array(
				'post_type'			=> 'mas_static_content',
				'posts_per_page'	=> -1,
			)
		),
		array(
			'id'		=> 'shop_jumbotron_bottom_id',
			'title'		=> __( 'Shop Page Bottom Jumbotron', 'electro' ),
			'subtitle'	=> __( 'Choose a static block that will be the jumbotron element for shop page bottom', 'electro' ),
			'type'		=> 'select',
			'data'		=> 'posts',
			'args'		=> array(
				'post_type'			=> 'mas_static_content',
				'posts_per_page'	=> -1,
			)
		),
		array(
			'id'		=> 'shop_general_info_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'title'		=> esc_html__( 'Shop/Catalog Pages', 'electro' ),
			'id'		=> 'product_archive_page_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'        => 'product_archive_enabled_views',
			'type'      => 'sorter',
			'title'     => esc_html__( 'Product archive views', 'electro' ),
			'subtitle'  => esc_html__( 'Please drag and arrange the views. Top most view will be the default view', 'electro' ),
			'options'   => array(
				'enabled' => array(
					'grid'            => esc_html__( 'Grid', 'electro' ),
					'grid-extended'   => esc_html__( 'Grid Extended', 'electro' ),
					'list-view'       => esc_html__( 'List', 'electro' ),
					'list-view-small' => esc_html__( 'List View Small', 'electro' )
				),
				'disabled' => array()
			)
		),

		array(
			'title'     => esc_html__('Shop Page Layout', 'electro'),
			'subtitle'  => esc_html__('Select the layout for the Shop Listing.', 'electro'),
			'id'        => 'shop_layout',
			'type'      => 'select',
			'options'   => array(
				'full-width'  	      => esc_html__( 'Full Width', 'electro' ),
				'left-sidebar'        => esc_html__( 'Left Sidebar', 'electro' ),
				'right-sidebar'       => esc_html__( 'Right Sidebar', 'electro' ),
			),
			'default'   => 'left-sidebar',
		),
		array(
			'title'		=> esc_html__('Number of Product Sub-categories Columns', 'electro'),
			'subtitle'	=> esc_html__('Drag the slider to set the number of columns for displaying product sub-categories in shop and catalog pages.', 'electro' ),
			'id'		=> 'subcategory_columns',
			'min'		=> '2',
			'step'		=> '1',
			'max'		=> '6',
			'type'		=> 'slider',
			'default'	=> '3',
		),
		array(
			'title'		=> esc_html__('Number of Products Columns', 'electro'),
			'subtitle'	=> esc_html__('Drag the slider to set the number of columns for displaying products in shop and catalog pages.', 'electro' ),
			'id'		=> 'product_columns',
			'min'		=> '2',
			'step'		=> '1',
			'max'		=> '6',
			'type'		=> 'slider',
			'default'	=> '3',
		),
		array(
			'title'		=> esc_html__( 'Number of Products Columns in wide mode', 'electro' ),
			'subtitle'	=> esc_html__( 'Drag the slider to set the number of columns for displaying products in shop and catalog pages in wide mode.', 'electro' ),
			'id'		=> 'product_columns_wide',
			'min'		=> '2',
			'step'		=> '1',
			'max'		=> '8',
			'type'		=> 'slider',
			'default'	=> '5',
			'required'  => array( 'wide_enabled', 'equals', 1 ),
		),
		array(
			'title'		=> esc_html__('Number of Products Per Page', 'electro'),
			'subtitle'	=> esc_html__('Drag the slider to set the number of products per page to be listed on the shop page and catalog pages.', 'electro' ),
			'id'		=> 'products_per_page',
			'min'		=> '3',
			'step'		=> '1',
			'max'		=> '48',
			'type'		=> 'slider',
			'default'	=> '15',
		),
		array(
            'id'        => 'wc_template_loop_sale',
            'title'     => esc_html__( 'Sale Badge ?', 'electro' ),
            'subtitle'  => esc_html__( 'Enable this to display Sale Badge.', 'electro' ),
            'type'      => 'switch',
            'on'        => esc_html__('Enabled', 'electro'),
            'off'       => esc_html__('Disabled', 'electro'),
            'default'   => 0,
        ),
		array(
			'id'		=> 'product_archive_page_end',
			'type'		=> 'section',
			'indent'	=> false
		),
		array(
			'title'		=> esc_html__( 'Single Product Page', 'electro' ),
			'id'		=> 'product_single_page_start',
			'type'		=> 'section',
			'indent'	=> true
		),
		array(
			'title'     => esc_html__('Single Product Layout', 'electro'),
			'subtitle'  => esc_html__('Select the layout for the Single Product.', 'electro'),
			'id'        => 'single_product_layout',
			'type'      => 'select',
			'options'   => array(
				'full-width'  	      => esc_html__( 'Full Width', 'electro' ),
				'left-sidebar'        => esc_html__( 'Left Sidebar', 'electro' ),
				'right-sidebar'       => esc_html__( 'Right Sidebar', 'electro' ),
			),
			'default'   => 'left-sidebar',
		),
		array(
			'title'     => esc_html__('Single Product Style', 'electro'),
			'subtitle'  => esc_html__('Select the style for Full Width layout.', 'electro'),
			'id'        => 'single_product_style',
			'type'      => 'select',
			'options'   => array(
				'normal'  	      => esc_html__( 'Normal', 'electro' ),
				'extended'        => esc_html__( 'Extended', 'electro' ),
			),
			'default'   => 'normal',
			'required'	=> array( 'single_product_layout', 'equals', 'full-width' )
		),

		array(
			'id'        => 'enable_single_product_sidebar',
			'title'     => esc_html__( 'Enable Single Product Sidebar ?', 'electro' ),
			'desc'      => esc_html__( 'By default Single Product Page uses shop sidebar, turn this on to have a separate sidebar for Single Product Page', 'electro' ),
			'type'      => 'switch',
			'default'   => 0,
		),

		array(
			'id'        => 'enable_related_products',
			'title'     => esc_html__( 'Enable Related Products', 'electro' ),
			'type'      => 'switch',
			'default'   => 1,
		),

		array(
			'id'        => 'single_product_timer',
			'title'     => esc_html__( 'Enable Single Product Sale Timer', 'electro' ),
			'type'      => 'switch',
			'default'   => 0,
		),

		array(
			'title'		=> esc_html__( 'Product Gallery Carousel', 'electro' ),
			'id'		=> 'product_gallery_carousel',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 0,
		),

		array(
			'title'		=> esc_html__( 'Sticky Add to Cart in Mobile ?', 'electro' ),
			'id'		=> 'sticky_add_to_cart_mobile',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 0,
		),

		array(
			'id'		=> 'product_single_page_end',
			'type'		=> 'section',
			'indent'	=> false
		),
		array(
			'title'		=> esc_html__( 'My Account Page', 'electro' ),
			'id'		=> 'myaccount_page_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'title'		=> esc_html__( 'Before login text', 'electro' ),
			'id'		=> 'myaccount_before_login_text',
			'type'		=> 'textarea',
			'default'	=> esc_html__( 'Welcome back! Sign in to your account.', 'electro' ),
		),

		array(
			'title'		=> esc_html__( 'Before Register text', 'electro' ),
			'id'		=> 'myaccount_before_register_text',
			'type'		=> 'textarea',
			'default'	=> esc_html__( 'Create new account today to reap the benefits of a personalized shopping experience.', 'electro' ),
		),

		array(
			'id'        => 'myaccount_register_benefits_title',
			'title'     => esc_html__( 'Register Benefits Title', 'electro' ),
			'type'      => 'text',
			'default'   => esc_html__( 'Sign up today and you will be able to :', 'electro' )
		),

		array(
			'id'        => 'myaccount_register_benefits',
			'title'     => esc_html__( 'Register Benefits', 'electro' ),
			'type'      => 'multi_text',
			'default'   => array(
				esc_html__( 'Speed your way through checkout', 'electro' ),
				esc_html__( 'Track your orders easily', 'electro' ),
				esc_html__( 'Keep a record of all your purchases', 'electro' ),
			),
		),

		array(
			'id'        => 'myaccount_page_end',
			'type'      => 'section',
			'indent'    => false
		),

		array(
			'title'		=> esc_html__( 'Doken Store', 'electro' ),
			'id'		=> 'dokan_store_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'title'     => esc_html__('Electro Store List Version', 'electro'),
			'subtitle'  => esc_html__('Select the view for the dokan store list version.', 'electro'),
			'id'        => 'dokan_store_list_version',
			'type'      => 'select',
			'options'   => array(
				''				=> esc_html__( 'Default', 'electro' ),
				'style-v1'		=> esc_html__( 'Style v1', 'electro' ),
				'style-v2'		=> esc_html__( 'Style v2', 'electro' ),
				'style-v3'		=> esc_html__( 'Style v3', 'electro' ),
				'style-v4'		=> esc_html__( 'Style v4', 'electro' ),
				'style-v5'		=> esc_html__( 'Style v5', 'electro' ),
			),
			'default'   => '',
		),

		array(
			'title'		=> esc_html__( 'Dokan Store List Sidebar', 'electro' ),
			'id'		=> 'dokan_store_list_sidebar',
			'type'		=> 'switch',
			'on'		=> esc_html__( 'Enabled', 'electro' ),
			'off'		=> esc_html__( 'Disabled', 'electro' ),
			'default'	=> 1,
			'required'	=> array(
				array( 'dokan_store_list_version', 'equals', 'style-v5' )
			)
		),

		array(
			'title'		=> esc_html__( 'Electro Dokan Store Style', 'electro' ),
			'id'		=> 'dokan_electro_store_style',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 0,
		),

		array(
			'title'     => esc_html__('Electro Store Version', 'electro'),
			'subtitle'  => esc_html__('Select the view for the dokan store version.', 'electro'),
			'id'        => 'dokan_store_version',
			'type'      => 'select',
			'options'   => array(
				'store-v1'		=> esc_html__( 'Store v1', 'electro' ),
				'store-v2'		=> esc_html__( 'Store v2', 'electro' ),
				'store-v3'		=> esc_html__( 'Store v3', 'electro' ),
				'store-v4'		=> esc_html__( 'Store v4', 'electro' ),
				'store-v5'		=> esc_html__( 'Store v5', 'electro' ),
			),
			'default'   => 'store-v1',
			'required'	=> array( 'dokan_electro_store_style', 'equals', 1 ),
		),

		array(
			'title'		=> esc_html__( 'Dokan Store Sidebar', 'electro' ),
			'id'		=> 'dokan_store_sidebar',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 0,
			'required'	=> array(
				array( 'dokan_electro_store_style', 'equals', 1 ),
				array( 'dokan_store_version', 'equals', 'store-v1' )
			)
		),

		array(
			'title'		=> esc_html__( 'Dokan Store Owner Info', 'electro' ),
			'id'		=> 'dokan_store_owner_info',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 1,
		),

		array(
			'id'		=> 'dokan_store_top_jumbotron_id',
			'title'		=> __( 'Dokan Store  Page Jumbotron', 'electro' ),
			'subtitle'	=> __( 'Choose a static block that will be the jumbotron element for dokan store page', 'electro' ),
			'type'		=> 'select',
			'data'		=> 'posts',
			'args'		=> array(
				'post_type'			=> 'mas_static_content',
				'posts_per_page'	=> -1,
			),
			'required'	=> array( 'dokan_electro_store_style', 'equals', 1 ),
		),

		array(
			'id'        => 'dokan_store_end',
			'type'      => 'section',
			'indent'    => false
		)
	)
) );
