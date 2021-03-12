<?php
/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package electro
 *
 */

if ( function_exists( 'vc_map' ) ) :

	$nav_menus = wp_get_nav_menus();

	$nav_menus_option = array(
		esc_html__( 'Select a menu', 'electro-extensions' )		=> '',
	);
	
	foreach ( $nav_menus as $key => $nav_menu ) {
		$nav_menus_option[$nav_menu->name] = $nav_menu->term_id;
	}

	$revsliders = array(
		esc_html__( 'No sliders found', 'electro-extensions' )		=> '',
	);
	
	if ( class_exists( 'RevSlider' ) ) {
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();

		if ( $arrSliders ) {
			foreach ( $arrSliders as $slider ) {
				$revsliders[ $slider->getTitle() ] = $slider->getAlias();
			}
		}
	}

	$banners_1_6_params = array();

	for( $i = 0; $i < 7; $i++ ) {
		$index = $i + 1;
		$banners_1_6_params[] = array(
			'type' 			=> 'attach_image',
			'heading' 		=> esc_html__( 'Image', 'electro-extensions' ) . ' ' . $index,
			'param_name' 	=> "image_${i}",
		);

		$banners_1_6_params[] = array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Action Link', 'electro-extensions' ) . ' ' . $index,
			'param_name'	=> "action_link_${i}",
		);
		$banners_1_6_params[] = array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Extra Class for Banner', 'electro-extensions' ) . ' ' . $index,
			'param_name'	=> "el_class_${i}",
		);
	}

	$banners_1_6_params[] = array(
		'type' 			=> 'textfield',
		'class' 		=> '',
		'heading' 		=> esc_html__( 'Extra Class', 'electro-extensions' ),
		'param_name' 	=> 'el_class',
		'description' 	=> esc_html__( 'Add your extra classes here.', 'electro-extensions' )
	);

	#-----------------------------------------------------------------
	# Electro Ad Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Ad Block', 'electro-extensions' ),
			'base'  		=> 'electro_ad_block',
			'description'	=> esc_html__( 'Add Ad Block to your page.', 'electro-extensions' ),
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon' 			=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Image', 'electro-extensions' ),
					'param_name' 	=> 'image',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Caption Text', 'electro-extensions' ),
					'param_name'	=> 'caption_text',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Action Text', 'electro-extensions' ),
					'param_name'	=> 'action_text',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
					'param_name'	=> 'action_link',
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Slider with Ads Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'Slider with Ads Block', 'electro-extensions' ),
			'base'				=> 'electro_slider_with_ads_block',
			'description'		=> esc_html__( 'Add Slider with Ads Block to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon'				=> 'vc-el-element-icon',
			'params' 			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Slider', 'electro-extensions' ),
					'param_name'	=> 'rev_slider_alias',
					'value'			=> $revsliders,
				),
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Ads', 'electro-extensions' ),
					'param_name' => 'ads_banners',
					'params' 	 => array(
						array(
							'type' 			=> 'attach_image',
							'heading' 		=> esc_html__( 'Image', 'electro-extensions' ),
							'param_name' 	=> 'ad_image',
						),
						array(
							'type'			=> 'textarea',
							'heading'		=> esc_html__('Caption Text', 'electro-extensions' ),
							'param_name'	=> 'ad_text',
						),
						array(
							'type'			=> 'textarea',
							'heading'		=> esc_html__('Action Text', 'electro-extensions' ),
							'param_name'	=> 'action_text',
						),
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
							'param_name'	=> 'action_link',
						),
					)
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				)
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Products carousel Banner Vertical Tabs
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Products carousel Banner Vertical Tabs', 'electro-extensions' ),
			'base' => 'electro_vc_products_carousel_banner_vertical_tabs',
			'description' => esc_html__( 'Add Products carousel with Banner Vertical Tabs to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(

				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Tabs', 'electro-extensions' ),
					'param_name' => 'tabs',
					'params' 	 => array(
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Tab Title', 'electro-extensions' ),
							'param_name'	=> 'title',
							'description'	=> esc_html__('Enter tab title.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textarea',
							'heading'		=> esc_html__('Tab Title', 'electro-extensions' ),
							'param_name'	=> 'tab_title',
							'description'	=> esc_html__('Enter your banner title here.', 'electro-extensions'),
						),

						array(
							'type'			=> 'textarea',
							'heading'		=> esc_html__('Tab Sub Title', 'electro-extensions' ),
							'param_name'	=> 'tab_sub_title',
							'description'	=> esc_html__('Enter your banner subtitle here.', 'electro-extensions'),
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Banner Action Text', 'electro-extensions' ),
							'param_name'	=> 'action_text',
							'description'	=> esc_html__('Enter your banner action text here.', 'electro-extensions'),
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Banner Action Link', 'electro-extensions' ),
							'param_name'	=> 'action_link',
							'description'	=> esc_html__('Enter your banner action link here.', 'electro-extensions'),
						),

						array(
							'type' 			=> 'attach_image',
							'heading' 		=> esc_html__( 'Banner Image', 'electro-extensions' ),
							'param_name' 	=> 'banner_image',
						),
					)
				),

				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Background Image', 'electro-extensions' ),
					'param_name' 	=> 'bg_img',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'value' => '20',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(0 - 479)', 'electro-extensions' ),
					'param_name' => 'items_0',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(480 - 767)', 'electro-extensions' ),
					'param_name' => 'items_480',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(768 - 991)', 'electro-extensions' ),
					'param_name' => 'items_768',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(992 - 1199)', 'electro-extensions' ),
					'param_name' => 'items_992',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(992 - 1199)', 'electro-extensions' ),
					'param_name' => 'items_1200',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				)
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Ads with Banner Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'Ads with Banners Block', 'electro-extensions' ),
			'base'				=> 'electro_ads_with_banners_block',
			'description'		=> esc_html__( 'Add Ads with Banner Block to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon'				=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Ads with Banner', 'electro-extensions' ),
					'param_name' => 'ads_banners',
					'params' 	 => array(
						array(
							'type'			=> 'textarea',
							'heading'		=> esc_html__('Title', 'electro-extensions' ),
							'param_name'	=> 'title',
						),
						array(
							'type'			=> 'textarea',
							'heading'		=> esc_html__('Description', 'electro-extensions' ),
							'param_name'	=> 'description',
						),
						array(
							'type'			=> 'textarea',
							'heading'		=> esc_html__('Price', 'electro-extensions' ),
							'param_name'	=> 'price',
						),
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
							'param_name'	=> 'action_link',
						),
						array(
							'type' 			=> 'attach_image',
							'heading' 		=> esc_html__( 'Image', 'electro-extensions' ),
							'param_name' 	=> 'image',
						),
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Banner Action Link', 'electro-extensions' ),
							'param_name'	=> 'banner_action_link',
						),
						array(
							'type' 			=> 'attach_image',
							'heading' 		=> esc_html__( 'Banner Image', 'electro-extensions' ),
							'param_name' 	=> 'banner_image',
						),
						array(
							'type' 			=> 'checkbox',
							'param_name' 	=> 'is_align_end',
							'heading' 		=> esc_html__( 'Banner Alignment', 'electro-extensions' ),
							'value' 		=> array( esc_html__( 'Is End', 'electro-extensions' ) => 'true'
							)
						),
					)
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				)
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Feature Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Feature Block', 'electro-extensions' ),
			'base'  		=> 'electro_feature_block',
			'description'	=> esc_html__( 'Add Feature Block to your page.', 'electro-extensions' ),
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon' 			=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Icon 1', 'electro-extensions' ),
					'param_name'	=> 'icon_1',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Text 1', 'electro-extensions' ),
					'param_name'	=> 'text_1',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Icon 2', 'electro-extensions' ),
					'param_name'	=> 'icon_2',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Text 2', 'electro-extensions' ),
					'param_name'	=> 'text_2',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Icon 3', 'electro-extensions' ),
					'param_name'	=> 'icon_3',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Text 3', 'electro-extensions' ),
					'param_name'	=> 'text_3',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Icon 4', 'electro-extensions' ),
					'param_name'	=> 'icon_4',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Text 4', 'electro-extensions' ),
					'param_name'	=> 'text_4',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Icon 5', 'electro-extensions' ),
					'param_name'	=> 'icon_5',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Text 5', 'electro-extensions' ),
					'param_name'	=> 'text_5',
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Jumbotron Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Jumbotron', 'electro-extensions' ),
			'base'  		=> 'electro_jumbotron',
			'description'	=> esc_html__( 'Add Jumbotron to your page.', 'electro-extensions' ),
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon' 			=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Title', 'electro-extensions' ),
					'param_name'	=> 'title',
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Sub Title', 'electro-extensions' ),
					'param_name'	=> 'sub_title',
				),
				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Image', 'electro-extensions' ),
					'param_name' 	=> 'image',
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Tabs Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Tabs', 'electro-extensions' ),
			'base'  		=> 'electro_product_tabs',
			'description'	=> esc_html__( 'Add Product Tabs to your page.', 'electro-extensions' ),
			'category'		=> esc_html__( 'Electro Deprecated Elements', 'electro-extensions' ),
			'icon' 			=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Tab #1 title', 'electro-extensions' ),
					'param_name'	=> 'tab_title_1',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Tab #1 Content, Show :', 'electro-extensions' ),
					'param_name'	=> 'tab_content_1',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product IDs', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Products Shortcode', 'electro-extensions' ),
					'param_name' => 'product_id_1',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Category Slug', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Product Category Shortcode', 'electro-extensions' ),
					'param_name' => 'category_1',
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Tab #2 title', 'electro-extensions' ),
					'param_name'	=> 'tab_title_2',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Tab #2 Content, Show :', 'electro-extensions' ),
					'param_name'	=> 'tab_content_2',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' ) 				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product IDs', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Products Shortcode', 'electro-extensions' ),
					'param_name' => 'product_id_2',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Category Slug', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Product Category Shortcode', 'electro-extensions' ),
					'param_name' => 'category_2',
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Tab #3 title', 'electro-extensions' ),
					'param_name'	=> 'tab_title_3',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Tab #3 Content, Show :', 'electro-extensions' ),
					'param_name'	=> 'tab_content_3',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' ) 				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product IDs', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Products Shortcode', 'electro-extensions' ),
					'param_name' => 'product_id_3',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Category Slug', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Product Category Shortcode', 'electro-extensions' ),
					'param_name' => 'category_3',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product Items', 'electro-extensions' ),
					'param_name' => 'product_items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product Columns', 'electro-extensions' ),
					'param_name' => 'product_columns',
					'holder' => 'div'
				),
			),
		)
	);

	vc_map(
		array(
			'name'				=> esc_html__( 'Product Tabs', 'electro-extensions' ),
			'base'  			=> 'electro_products_tabs',
			'description'		=> esc_html__( 'Add Product Tabs to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon' 				=> 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'params' 			=> array(
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Tabs', 'electro-extensions' ),
					'param_name' => 'tabs',
					'params' 	 => array(
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Title', 'electro-extensions' ),
							'param_name'	=> 'title',
							'description'	=> esc_html__('Enter title.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
							'param_name'	=> 'shortcode_tag',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )				=> '',
								esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
								esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
								esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
								esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
								esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
								esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
								esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
								esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
							'param_name'	=> 'per_page',
							'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Columns', 'electro-extensions' ),
							'param_name'	=> 'columns',
							'description'	=> esc_html__('Enter the number of columns to display.', 'electro-extensions'),
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Columns Wide', 'electro-extensions' ),
							'param_name'	=> 'columns_wide',
							'description'	=> esc_html__('Enter the number of columns wide to display.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order By', 'electro-extensions' ),
							'param_name'	=> 'orderby',
							'description'	=> esc_html__('Enter orderby.', 'electro-extensions'),
							'value'			=> 'date'
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
							'param_name'	=> 'order',
							'description'	=> esc_html__('Enter order.', 'electro-extensions'),
							'value'			=> 'desc'
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
							'param_name'	=> 'products_choice',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )		=> '',
								esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
								esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
							'param_name'	=> 'product_id',
							'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
							'param_name'	=> 'category',
							'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
							'param_name'	=> 'cat_operator',
							'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
							'param_name'	=> 'attribute',
							'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
							'param_name'	=> 'terms',
							'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
							'param_name'	=> 'terms_operator',
							'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
					)
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Carousel Tabs Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Carousel Tabs', 'electro-extensions' ),
			'base'  		=> 'electro_products_carousel_tabs',
			'description'	=> esc_html__( 'Add Product Carousel Tabs to your page.', 'electro-extensions' ),
			'category'		=> esc_html__( 'Electro Deprecated Elements', 'electro-extensions' ),
			'icon'			=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Tab #1 title', 'electro-extensions' ),
					'param_name'	=> 'tab_title_1',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Tab #1 Content, Show :', 'electro-extensions' ),
					'param_name'	=> 'tab_content_1',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product IDs', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Products Shortcode', 'electro-extensions' ),
					'param_name' => 'product_id_1',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Category Slug', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Product Category Shortcode', 'electro-extensions' ),
					'param_name' => 'category_1',
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Tab #2 title', 'electro-extensions' ),
					'param_name'	=> 'tab_title_2',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Tab #2 Content, Show :', 'electro-extensions' ),
					'param_name'	=> 'tab_content_2',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' ) 				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product IDs', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Products Shortcode', 'electro-extensions' ),
					'param_name' => 'product_id_2',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Category Slug', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Product Category Shortcode', 'electro-extensions' ),
					'param_name' => 'category_2',
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Tab #3 title', 'electro-extensions' ),
					'param_name'	=> 'tab_title_3',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Tab #3 Content, Show :', 'electro-extensions' ),
					'param_name'	=> 'tab_content_3',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' ) 				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product IDs', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Products Shortcode', 'electro-extensions' ),
					'param_name' => 'product_id_3',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Category Slug', 'electro-extensions' ),
					'description' => esc_html__( 'This will only for Product Category Shortcode', 'electro-extensions' ),
					'param_name' => 'category_3',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product Items', 'electro-extensions' ),
					'param_name' => 'product_items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Product Columns', 'electro-extensions' ),
					'param_name' => 'product_columns',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Header Align', 'electro-extensions' ),
					'param_name'	=> 'nav_align',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' ) 	=> '',
						esc_html__( 'Center', 'electro-extensions' )	=> 'center',
						esc_html__( 'Left', 'electro-extensions' )		=> 'left',
						esc_html__( 'Right', 'electro-extensions' )		=> 'right',
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(0 - 479)', 'electro-extensions' ),
					'param_name' => 'items_0',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(480 - 767)', 'electro-extensions' ),
					'param_name' => 'items_480',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(768 - 991)', 'electro-extensions' ),
					'param_name' => 'items_768',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(992 - 1199)', 'electro-extensions' ),
					'param_name' => 'items_992',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(1200 - 1440)', 'electro-extensions' ),
					'param_name' => 'items_1200',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			),
		)
	);

	vc_map(
		array(
			'name'				=> esc_html__( 'Product Carousel Tabs', 'electro-extensions' ),
			'base'  			=> 'electro_products_tabs_carousel',
			'description'		=> esc_html__( 'Add Product Carousel Tabs to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon'				=> 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'params' 			=> array(
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Header Align', 'electro-extensions' ),
					'param_name'	=> 'nav_align',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' ) 	=> '',
						esc_html__( 'Center', 'electro-extensions' )	=> 'center',
						esc_html__( 'Left', 'electro-extensions' )		=> 'left',
						esc_html__( 'Right', 'electro-extensions' )		=> 'right',
					),
				),
				
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Tabs', 'electro-extensions' ),
					'param_name' => 'tabs',
					'params' 	 => array(
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Title', 'electro-extensions' ),
							'param_name'	=> 'title',
							'description'	=> esc_html__('Enter title.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
							'param_name'	=> 'shortcode_tag',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )				=> '',
								esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
								esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
								esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
								esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
								esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
								esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
								esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
								esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
							'param_name'	=> 'per_page',
							'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order By', 'electro-extensions' ),
							'param_name'	=> 'orderby',
							'description'	=> esc_html__('Enter orderby.', 'electro-extensions'),
							'value'			=> 'date'
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
							'param_name'	=> 'order',
							'description'	=> esc_html__('Enter order.', 'electro-extensions'),
							'value'			=> 'desc'
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
							'param_name'	=> 'products_choice',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )		=> '',
								esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
								esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
							'param_name'	=> 'product_id',
							'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
							'param_name'	=> 'category',
							'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
							'param_name'	=> 'cat_operator',
							'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
							'param_name'	=> 'attribute',
							'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
							'param_name'	=> 'terms',
							'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
							'param_name'	=> 'terms_operator',
							'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Products Cards Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Products Cards Carousel', 'electro-extensions' ),
			'base' => 'electro_vc_products_cards_carousel',
			'description' => esc_html__( 'Add products cards carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'	  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Rows', 'electro-extensions' ),
					'param_name' => 'rows',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Columns', 'electro-extensions' ),
					'param_name' => 'columns',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Products Wide Layout Columns', 'electro-extensions' ),
					'param_name' => 'product_columns_wide',
					'holder' => 'div',
					'description' => esc_html__( 'Option only works if Wide Electro Layout enabled.', 'electro-extensions' ),
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_carousel_nav',
					'heading' => esc_html__( 'Show Carousel Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_top_text',
					'heading' => esc_html__( 'Show Top Text', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_categories',
					'heading' => esc_html__( 'Show Categories', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Limit', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'holder' => 'div'
				),

			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Products Carousel', 'electro-extensions' ),
			'base' => 'electro_vc_products_carousel',
			'description' => esc_html__( 'Add products carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_custom_nav',
					'heading' => esc_html__( 'Show Custom Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Products Wide Layout Columns', 'electro-extensions' ),
					'param_name'	=> 'product_columns_wide',
					'description'	=> esc_html__('Option only works if Wide Electro Layout enabled.', 'electro-extensions'),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(0 - 479)', 'electro-extensions' ),
					'param_name' => 'items_0',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(480 - 767)', 'electro-extensions' ),
					'param_name' => 'items_480',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(768 - 991)', 'electro-extensions' ),
					'param_name' => 'items_768',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(992 - 1199)', 'electro-extensions' ),
					'param_name' => 'items_992',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(1200 - 1429)', 'electro-extensions' ),
					'param_name' => 'items_1200',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Nav Next Text', 'electro-extensions' ),
					'param_name' => 'nav_next',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Nav Prev Text', 'electro-extensions' ),
					'param_name' => 'nav_prev',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Margin', 'electro-extensions' ),
					'param_name' => 'margin',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products Carousel 1
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Products Carousel 1', 'electro-extensions' ),
			'base' => 'electro_vc_products_carousel_1',
			'description' => esc_html__( 'Add products carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Text', 'electro-extensions' ),
					'param_name' => 'button_text',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Link', 'electro-extensions' ),
					'param_name' => 'button_link',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Margin', 'electro-extensions' ),
					'param_name' => 'margin',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div',
					'value'			=>  'trending-products-carousel'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products Carousel With Timer
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Products Carousel With Timer', 'electro-extensions' ),
			'base' => 'electro_vc_products_carousel_with_timer',
			'description' => esc_html__( 'Add products carousel with timer to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'header_timer',
					'heading' => esc_html__( 'Show Header Timer', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'param_name'	=> 'timer_title',
					'heading'		=> esc_html__('Timer Title', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'param_name'	=> 'timer_value',
					'heading'		=> esc_html__('Timer Value', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Text', 'electro-extensions' ),
					'param_name' => 'button_text',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Link', 'electro-extensions' ),
					'param_name' => 'button_link',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Margin', 'electro-extensions' ),
					'param_name' => 'margin',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div',
					'value'			=>  'products-carousel-with-timer'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Brands Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Brands Carousel', 'electro-extensions' ),
			'base' => 'electro_brands_carousel',
			'description' => esc_html__( 'Add brands carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Brands to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Brands does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'include',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_loop',
					'heading' => esc_html__( 'Carousel: Loop', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product List Categories
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Product List Categories', 'electro-extensions' ),
			'base' => 'electro_product_list_categories',
			'description' => esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'slugs',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'include',
					'holder' => 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Categories Block
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Categories Block', 'electro-extensions' ),
			'base'			=> 'electro_product_categories_block',
			'description'	=> esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name'	=> 'title',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name'	=> 'limit',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'checkbox',
					'param_name'	=> 'has_no_products',
					'heading'		=> esc_html__( 'Have no products', 'electro-extensions' ),
					'description'	=> esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value'			=> array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order by', 'electro-extensions' ),
					'param_name'	=> 'orderby',
					'description'	=> esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
					'value'			=> 'date',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
					'param_name'	=> 'order',
					'description'	=> esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
					'value'			=> 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name'	=> 'slugs',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name'	=> 'include',
					'holder'		=> 'div'
				),
				array(
					'type' 			=> 'checkbox',
					'param_name' 	=> 'enable_full_width',
					'heading' 		=> esc_html__( 'Enable Fullwidth', 'electro-extensions' ),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Category Icons Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Category Icons Carousel Block', 'electro-extensions' ),
			'base'			=> 'electro_home_category_icon_carousel',
			'description'	=> esc_html__( 'Add product category icons carousel to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Style', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Style v1', 'electro-extensions' ) => 'v1',
						esc_html__( 'Style v2', 'electro-extensions' ) => 'v2',
					),
					'param_name'	=> 'style',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name'	=> 'limit',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'checkbox',
					'param_name'	=> 'has_no_products',
					'heading'		=> esc_html__( 'Have no products', 'electro-extensions' ),
					'description'	=> esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value'			=> array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order by', 'electro-extensions' ),
					'param_name'	=> 'orderby',
					'description'	=> esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
					'value'			=> 'date',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
					'param_name'	=> 'order',
					'description'	=> esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
					'value'			=> 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name'	=> 'slugs',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name'	=> 'include',
					'holder'		=> 'div'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(0 - 479)', 'electro-extensions' ),
					'param_name' => 'items_0',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(480 - 767)', 'electro-extensions' ),
					'param_name' => 'items_480',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(768 - 991)', 'electro-extensions' ),
					'param_name' => 'items_768',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(992 - 1199)', 'electro-extensions' ),
					'param_name' => 'items_992',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Carousel Tabs with Deal
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'Product Carousel Tabs with Deal', 'electro-extensions' ),
			'base'  			=> 'electro_products_tabs_carousel_with_deal',
			'description'		=> esc_html__( 'Add Product Carousel Tabs with deal to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon'				=> 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'params' 			=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Title', 'electro-extensions' ),
					'param_name' => 'section_title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Text', 'electro-extensions' ),
					'param_name' => 'button_text',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Link', 'electro-extensions' ),
					'param_name' => 'button_link',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Deal title', 'electro-extensions' ),
					'param_name' => 'deal_title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'deal_show_savings',
					'heading' => esc_html__( 'Show Savings Details', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Show Savings', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Savings in', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Amount', 'electro-extensions' ) => 'amount',
						esc_html__( 'Percentage', 'electro-extensions' ) => 'percentage'
					),
					'param_name'	=> 'deal_savings_in',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Savings Text', 'electro-extensions' ),
					'param_name' => 'deal_savings_text',
					'holder' => 'div'
				),

				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Recent', 'electro-extensions' ) => 'recent',
						esc_html__( 'Random', 'electro-extensions' ) => 'random',
						esc_html__( 'Specific', 'electro-extensions' ) => 'specific'
					),
					'param_name'	=> 'deal_product_choice',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Product ID', 'electro-extensions' ),
					'param_name' => 'deal_product_id',
					'holder' => 'div'
				),
				
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Tabs', 'electro-extensions' ),
					'param_name' => 'tabs',
					'params' 	 => array(
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Title', 'electro-extensions' ),
							'param_name'	=> 'title',
							'description'	=> esc_html__('Enter title.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
							'param_name'	=> 'shortcode_tag',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )				=> '',
								esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
								esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
								esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
								esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
								esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
								esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
								esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
								esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order By', 'electro-extensions' ),
							'param_name'	=> 'orderby',
							'description'	=> esc_html__('Enter orderby.', 'electro-extensions'),
							'value'			=> 'date'
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
							'param_name'	=> 'order',
							'description'	=> esc_html__('Enter order.', 'electro-extensions'),
							'value'			=> 'desc'
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
							'param_name'	=> 'products_choice',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )		=> '',
								esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
								esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
							'param_name'	=> 'product_id',
							'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
							'param_name'	=> 'category',
							'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
							'param_name'	=> 'cat_operator',
							'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
							'param_name'	=> 'attribute',
							'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
							'param_name'	=> 'terms',
							'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
							'param_name'	=> 'terms_operator',
							'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
					'value' => 20,
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Rows', 'electro-extensions' ),
					'param_name' => 'rows',
					'holder' => 'div',
					'value' => 2,
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Columns', 'electro-extensions' ),
					'param_name' => 'columns',
					'holder' => 'div',
					'value' => 5,
				),
				
				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Categories List
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Categories List', 'electro-extensions' ),
			'base'			=> 'electro_product_categories_list',
			'description'	=> esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name'	=> 'limit',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'checkbox',
					'param_name'	=> 'has_no_products',
					'heading'		=> esc_html__( 'Have no products', 'electro-extensions' ),
					'description'	=> esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value'			=> array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order by', 'electro-extensions' ),
					'param_name'	=> 'orderby',
					'description'	=> esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
					'value'			=> 'date',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
					'param_name'	=> 'order',
					'description'	=> esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
					'value'			=> 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name'	=> 'slugs',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name'	=> 'include',
					'holder'		=> 'div'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Deals Products Block
	#-----------------------------------------------------------------
	
	vc_map(
		array(
			'name'			=> esc_html__( 'Deals Products Block', 'electro-extensions' ),
			'base'			=> 'electro_deal_products_block',
			'description'	=> esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
					'value'			=> '6',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'description'	=> esc_html__('Enter the number of columns to display.', 'electro-extensions'),
					'value'			=> '3',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Action Text', 'electro-extensions' ),
					'param_name'	=> 'action_text',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
					'param_name'	=> 'action_link',
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products One Two Block
	#-----------------------------------------------------------------
	
	vc_map(
		array(
			'name'			=> esc_html__( 'Products 1-2 Block', 'electro-extensions' ),
			'base'			=> 'electro_products_1_2_block',
			'description'	=> esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Action Text', 'electro-extensions' ),
					'param_name'	=> 'action_text',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
					'param_name'	=> 'action_link',
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Catgories List With Header Image 
	#-----------------------------------------------------------------
	
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Catgories List With Header Image ', 'electro-extensions' ),
			'base'			=> 'electro_product_categories_list_with_header',
			'description'	=> esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Subtitle', 'electro-extensions' ),
					'param_name' => 'sub_title',
					'holder' => 'div'
				),

				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Background Image', 'electro-extensions' ),
					'param_name' 	=> 'bg_image',
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'enable_header',
					'heading' => esc_html__( 'Enable Header', 'electro-extensions' ),
					'description' => esc_html__( 'Show header block.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name'	=> 'limit',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'checkbox',
					'param_name'	=> 'has_no_products',
					'heading'		=> esc_html__( 'Have no products', 'electro-extensions' ),
					'description'	=> esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value'			=> array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order by', 'electro-extensions' ),
					'param_name'	=> 'orderby',
					'description'	=> esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
					'value'			=> 'date',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
					'param_name'	=> 'order',
					'description'	=> esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
					'value'			=> 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name'	=> 'slugs',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name'	=> 'include',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Header Version', 'electro-extensions' ),
					'param_name'	=> 'type',
					'value'			=> array(
						esc_html__( 'Type 1', 'electro-extensions' )		=> 'v1' ,
						esc_html__( 'Type 2', 'electro-extensions' )		=> 'v2' 	,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product 2-1-2 Grid
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Product 2-1-2 Grid', 'electro-extensions' ),
			'base' => 'electro_products_2_1_2',
			'description' => esc_html__( 'Add products to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'holder' => 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product 6-1 Grid
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Product 6-1 Grid', 'electro-extensions' ),
			'base' => 'electro_vc_products_6_1',
			'description' => esc_html__( 'Add products to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'holder' => 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products 6-1 with categories
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Products 6-1 with Categories', 'electro-extensions' ),
			'base' => 'electro_vc_products_6_1_with_categories',
			'description' => esc_html__( 'Add products 6-1 with vertical categories to your page.', 'electro-extensions' ),
			'class'	=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Featured Product Shortcode', 'electro-extensions' ),
					'param_name'	=> 'featured_shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
					),
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Featured Product Choice', 'electro-extensions' ),
					'param_name'	=> 'featured_products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
					'description'	=> esc_html__('Only for Products Shortcode.', 'electro-extensions'),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Featured Product ID', 'electro-extensions'),
					'param_name'	=> 'featured_product_id',
					'description'	=> esc_html__('Enter ID/SKU. Only for Products Shortcode.', 'electro-extensions'),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter categories title', 'electro-extensions' ),
					'param_name' => 'categories_title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'enable_categories',
					'heading' => esc_html__( 'Enable Header Categories', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories list on header block.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Vertical Categories to display', 'electro-extensions' ),
					'param_name' => 'vcat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'vcat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'vcat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'vcat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'vcat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'vcat_slugs',
					'holder' => 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products with categories and image
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Products with Categories and Image', 'electro-extensions' ),
			'base' => 'electro_vc_products_with_category_image',
			'description' => esc_html__( 'Add products with vertical categories and image to your page.', 'electro-extensions' ),
			'class'	=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'description'	=> esc_html__('Enter the number of columns to display.', 'electro-extensions'),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Products Wide Layout Columns', 'electro-extensions' ),
					'param_name'	=> 'columns_wide',
					'description'	=> esc_html__('Option only works if Wide Electro Layout enabled.', 'electro-extensions'),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter categories title', 'electro-extensions' ),
					'param_name' => 'categories_title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'enable_categories',
					'heading' => esc_html__( 'Enable Header Categories', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories list on header block.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Vertical Categories to display', 'electro-extensions' ),
					'param_name' => 'vcat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'vcat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'vcat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'vcat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'vcat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'vcat_slugs',
					'holder' => 'div'
				),

				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Image', 'electro-extensions' ),
					'param_name' 	=> 'image',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image Action Link', 'electro-extensions' ),
					'param_name' => 'img_action_link',
					'holder' => 'div'
				)
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Onsale Product
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Onsale Product', 'electro-extensions' ),
			'base' => 'electro_vc_product_onsale',
			'description' => esc_html__( 'Add onsale product to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),
				array(
					'type' => 'checkbox',
					'param_name' => 'show_savings',
					'heading' => esc_html__( 'Show Savings Details', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Show Savings', 'electro-extensions' ) => 'true'
					)
				),
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Savings in', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Amount', 'electro-extensions' ) => 'amount',
						esc_html__( 'Percentage', 'electro-extensions' ) => 'percentage'
					),
					'param_name'	=> 'savings_in',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Savings Text', 'electro-extensions' ),
					'param_name' => 'savings_text',
					'holder' => 'div'
				),
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Recent', 'electro-extensions' ) => 'recent',
						esc_html__( 'Random', 'electro-extensions' ) => 'random',
						esc_html__( 'Specific', 'electro-extensions' ) => 'specific'
					),
					'param_name'	=> 'product_choice',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Product ID', 'electro-extensions' ),
					'param_name' => 'product_id',
					'holder' => 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Onsale Product Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Onsale Products Carousel', 'electro-extensions' ),
			'base' => 'electro_vc_products_onsale_carousel',
			'description' => esc_html__( 'Add onsale products carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_savings',
					'heading' => esc_html__( 'Show Savings Details', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Show Savings', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Savings in', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Amount', 'electro-extensions' ) => 'amount',
						esc_html__( 'Percentage', 'electro-extensions' ) => 'percentage'
					),
					'param_name'	=> 'savings_in',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Savings Text', 'electro-extensions' ),
					'param_name' => 'savings_text',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Recent', 'electro-extensions' ) => 'recent',
						esc_html__( 'Random', 'electro-extensions' ) => 'random',
						esc_html__( 'Specific', 'electro-extensions' ) => 'specific'
					),
					'param_name'	=> 'product_choice',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Product ID', 'electro-extensions' ),
					'param_name' => 'product_id',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_custom_nav',
					'heading' => esc_html__( 'Show Custom Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_progress',
					'heading' => esc_html__( 'Show Progress', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_timer',
					'heading' => esc_html__( 'Show Timer', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_cart_btn',
					'heading' => esc_html__( 'Show Cart Button', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Nav Next Text', 'electro-extensions' ),
					'param_name' => 'nav_next',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Nav Prev Text', 'electro-extensions' ),
					'param_name' => 'nav_prev',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Margin', 'electro-extensions' ),
					'param_name' => 'margin',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products Carousel with Category Tabs
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'Electro Products Carousel with Category Tabs', 'electro-extensions' ),
			'base'				=> 'electro_vc_products_carousel_with_category_tabs',
			'description'		=> esc_html__( 'Add products 6-1 with vertical categories to your page.', 'electro-extensions' ),
			'class'				=> '',
			'controls'			=> 'full',
			'icon'				=> 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'			=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
					'value'			=> '6',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'enable_categories',
					'heading' => esc_html__( 'Enable Header Categories', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories list on header block.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter categories title', 'electro-extensions' ),
					'param_name' => 'categories_title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'description' => esc_html__( 'Enter IDs of Categories to display', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'description' => esc_html__( 'Enter slug of Categories to display', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Margin', 'electro-extensions' ),
					'param_name' => 'margin',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products List Block
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'Electro Products List Block', 'electro-extensions' ),
			'base'				=> 'electro_vc_products_list',
			'description'		=> esc_html__( 'Add Products list to your page.', 'electro-extensions' ),
			'class'				=> '',
			'controls'			=> 'full',
			'icon'				=> 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'			=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__('Type', 'electro-extensions' ),
					'param_name'	=> 'type',
					'value'			=> array(
						esc_html__( 'v1',   'electro-extensions')	=> 'v1',
						esc_html__( 'v2', 	'electro-extensions')	=> 'v2'
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Text', 'electro-extensions' ),
					'param_name' => 'action_text',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Link', 'electro-extensions' ),
					'param_name' => 'action_link',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
					'value'			=> '6',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'enable_categories',
					'heading' => esc_html__( 'Enable Header Categories', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories list on header block.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter categories title', 'electro-extensions' ),
					'param_name' => 'categories_title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'description' => esc_html__( 'Enter IDs of Categories to display', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'description' => esc_html__( 'Enter slug of Categories to display', 'electro-extensions' ),
					'holder' => 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Carousel Tabs 1 Element
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'Product Carousel Tabs 1', 'electro-extensions' ),
			'base'  			=> 'electro_products_tabs_carousel_1',
			'description'		=> esc_html__( 'Add Product Carousel Tabs to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon'				=> 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'params' 			=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'section_title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Text', 'electro-extensions' ),
					'param_name' => 'button_text',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Action Link', 'electro-extensions' ),
					'param_name' => 'button_link',
					'holder' => 'div'
				),
				
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Tabs', 'electro-extensions' ),
					'param_name' => 'tabs',
					'params' 	 => array(
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Title', 'electro-extensions' ),
							'param_name'	=> 'title',
							'description'	=> esc_html__('Enter title.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
							'param_name'	=> 'shortcode_tag',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )				=> '',
								esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
								esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
								esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
								esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
								esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
								esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
								esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
								esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
							'param_name'	=> 'per_page',
							'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order By', 'electro-extensions' ),
							'param_name'	=> 'orderby',
							'description'	=> esc_html__('Enter orderby.', 'electro-extensions'),
							'value'			=> 'date'
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
							'param_name'	=> 'order',
							'description'	=> esc_html__('Enter order.', 'electro-extensions'),
							'value'			=> 'desc'
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
							'param_name'	=> 'products_choice',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )		=> '',
								esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
								esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
							'param_name'	=> 'product_id',
							'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
							'param_name'	=> 'category',
							'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
							'param_name'	=> 'cat_operator',
							'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
							'param_name'	=> 'attribute',
							'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
							'param_name'	=> 'terms',
							'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
							'param_name'	=> 'terms_operator',
							'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
				
				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Deal Products Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Deal Products Carousel', 'electro-extensions' ),
			'base' => 'electro_vc_deal_products_carousel',
			'description' => esc_html__( 'Add deal products carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter deal header title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'header_timer',
					'heading' => esc_html__( 'Show Header Timer', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'param_name'	=> 'timer_value',
					'heading'		=> esc_html__('Timer Value', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'param_name'	=> 'timer_title',
					'heading'		=> esc_html__('Timer Title', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'param_name'	=> 'deal_percentage',
					'heading'		=> esc_html__('Deal Percentage value', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Nav Next Text', 'electro-extensions' ),
					'param_name' => 'nav_next',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Nav Prev Text', 'electro-extensions' ),
					'param_name' => 'nav_prev',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Margin', 'electro-extensions' ),
					'param_name' => 'margin',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Deals and Products Tabs
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Deal and Products Tabs', 'electro-extensions' ),
			'base' => 'electro_vc_deal_and_product_tab',
			'description' => esc_html__( 'Add deal and products tabs to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'deal_title',
					'holder' => 'div'
				),
				array(
					'type' => 'checkbox',
					'param_name' => 'deal_show_savings',
					'heading' => esc_html__( 'Show Savings Details', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Show Savings', 'electro-extensions' ) => 'true'
					)
				),
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Savings in', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Amount', 'electro-extensions' ) => 'amount',
						esc_html__( 'Percentage', 'electro-extensions' ) => 'percentage'
					),
					'param_name'	=> 'deal_savings_in',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Savings Text', 'electro-extensions' ),
					'param_name' => 'deal_savings_text',
					'holder' => 'div'
				),
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Recent', 'electro-extensions' ) => 'recent',
						esc_html__( 'Random', 'electro-extensions' ) => 'random',
						esc_html__( 'Specific', 'electro-extensions' ) => 'specific'
					),
					'param_name'	=> 'deal_product_choice',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Product ID', 'electro-extensions' ),
					'param_name' => 'deal_product_id',
					'holder' => 'div'
				),
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Tabs', 'electro-extensions' ),
					'param_name' => 'tabs',
					'params' 	 => array(
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Title', 'electro-extensions' ),
							'param_name'	=> 'title',
							'description'	=> esc_html__('Enter title.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
							'param_name'	=> 'shortcode_tag',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )				=> '',
								esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
								esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
								esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
								esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
								esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
								esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
								esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
								esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
							'param_name'	=> 'product_limit',
							'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Columns', 'electro-extensions' ),
							'param_name'	=> 'columns',
							'description'	=> esc_html__('Enter the number of columns to display.', 'electro-extensions'),
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Wide Layout Limit', 'electro-extensions' ),
							'param_name'	=> 'product_limit_wide',
							'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
						),
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order By', 'electro-extensions' ),
							'param_name'	=> 'orderby',
							'description'	=> esc_html__('Enter orderby.', 'electro-extensions'),
							'value'			=> 'date'
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
							'param_name'	=> 'order',
							'description'	=> esc_html__('Enter order.', 'electro-extensions'),
							'value'			=> 'desc'
						),
						
						array(
							'type'			=> 'dropdown',
							'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
							'param_name'	=> 'products_choice',
							'value'			=> array(
								esc_html__( 'Select', 'electro-extensions' )		=> '',
								esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
								esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
							),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
							'param_name'	=> 'product_id',
							'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
							'param_name'	=> 'category',
							'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
							'param_name'	=> 'cat_operator',
							'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
							'param_name'	=> 'attribute',
							'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
							'param_name'	=> 'terms',
							'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
						),
						
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
							'param_name'	=> 'terms_operator',
							'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
							'value'			=> 'IN',
						),
					)
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Tab Products Wide Layout Columns', 'electro-extensions' ),
					'param_name'	=> 'product_columns_wide',
					'description'	=> esc_html__('Enter the number of tap products wide layout columns to display.', 'electro-extensions'),
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro List Categories Menus
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'List Categories Menus', 'electro-extensions' ),
			'base'				=> 'electro_product_categories_menu_list',
			'description'		=> esc_html__( 'Add List Categories Menus to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon'				=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Section Title', 'electro-extensions' ),
					'param_name'	=> 'section_title',
				),
				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('List Categories Menus', 'electro-extensions' ),
					'param_name' => 'list_categories',
					'params' 	 => array(
						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Title', 'electro-extensions' ),
							'param_name'	=> 'title',
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__( 'Category Slug', 'electro-extensions' ),
							'param_name'	=> 'slugs',
							'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Order by', 'electro-extensions' ),
							'param_name' => 'orderby',
							'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
							'value' => 'date',
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Order', 'electro-extensions' ),
							'param_name' => 'order',
							'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
							'value' => 'DESC',
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Number of categories to display', 'electro-extensions' ),
							'param_name' => 'limit',
							'holder' => 'div'
						),

						array(
							'type' => 'checkbox',
							'param_name' => 'cat_has_no_products',
							'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
							'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
							'value' => array(
								esc_html__( 'Allow', 'electro-extensions' ) => 'true'
							)
						),
					)
				),

				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Action Text', 'electro-extensions' ),
					'param_name'	=> 'action_text',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
					'param_name'	=> 'action_link',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				)
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Nav Menu
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Nav Menu', 'electro-extensions' ),
			'base' => 'electro_nav_menu',
			'description' => esc_html__( 'Add a navigation menu to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' 			=> 'textfield',
					'heading' 		=> esc_html__( 'Title', 'electro-extensions' ),
					'param_name' 	=> 'title',
					'description' 	=> esc_html__( 'Enter the title of menu.', 'electro-extensions' ),
					'holder' 		=> 'div'
				),
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Menu', 'electro-extensions' ),
					'value' 		=> $nav_menus_option,
					'param_name'	=> 'menu',
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Recently Viewed Products
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'				=> esc_html__( 'Recently Viewed Products Block', 'electro-extensions' ),
			'base'				=> 'electro_recent_viewed_products',
			'description'		=> esc_html__( 'Add Recently Viewed Products Block to your page.', 'electro-extensions' ),
			'category'			=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'icon'				=> 'vc-el-element-icon',
			'params' 		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Section Title', 'electro-extensions' ),
					'param_name'	=> 'section_title',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'description'	=> esc_html__('Enter the number of columns to display.', 'electro-extensions'),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns Wide', 'electro-extensions' ),
					'param_name'	=> 'columns_wide',
					'description'	=> esc_html__('Enter the number of columns wide to display.', 'electro-extensions'),
				),
			),
		)
	);

	#-----------------------------------------------------------------
	# Electro Products Carousel Category with Image
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Products Carousel Category with Image', 'electro-extensions' ),
			'base' => 'electro_vc_products_carousel_category_with_image',
			'description' => esc_html__( 'Add products carousel category with image to your page.', 'electro-extensions' ),
			'class'	=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'enable_categories',
					'heading' => esc_html__( 'Enable Header Categories', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories list on header block.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter categories title', 'electro-extensions' ),
					'param_name' => 'categories_title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'holder' => 'div'
				),

				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Image', 'electro-extensions' ),
					'param_name' 	=> 'image',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image Action Link', 'electro-extensions' ),
					'param_name' => 'img_action_link',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'description',
					'heading' => esc_html__( 'Enable Description', 'electro-extensions' ),
					'description' => esc_html__( 'Show Description on the products.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(0 - 479)', 'electro-extensions' ),
					'param_name' => 'items_0',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(480 - 767)', 'electro-extensions' ),
					'param_name' => 'items_480',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(768 - 991)', 'electro-extensions' ),
					'param_name' => 'items_768',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items(992 - 1199)', 'electro-extensions' ),
					'param_name' => 'items_992',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				)
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Products Category with Image
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Products Category with Image', 'electro-extensions' ),
			'base' => 'electro_vc_products_category_with_image',
			'description' => esc_html__( 'Add products category with image to your page.', 'electro-extensions' ),
			'class'	=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'enable_categories',
					'heading' => esc_html__( 'Enable Header Categories', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories list on header block.', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter categories title', 'electro-extensions' ),
					'param_name' => 'categories_title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name' => 'cat_limit',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'cat_has_no_products',
					'heading' => esc_html__( 'Have no products', 'electro-extensions' ),
					'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'cat_orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'cat_order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name' => 'cat_include',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name' => 'cat_slugs',
					'holder' => 'div'
				),

				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Image', 'electro-extensions' ),
					'param_name' 	=> 'image',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image Action Link', 'electro-extensions' ),
					'param_name' => 'img_action_link',
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'description'	=> esc_html__('Enter the number of columns to display.', 'electro-extensions'),
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns Wide', 'electro-extensions' ),
					'param_name'	=> 'columns_wide',
					'description'	=> esc_html__('Option only works if Wide Electro Layout enabled.', 'electro-extensions'),
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div',
					'value'			=>  ''
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Recent Viewed Products Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Recent Viewed Products Carousel', 'electro-extensions' ),
			'base' => 'electro_vc_recent_viewed_products_carousel',
			'description' => esc_html__( 'Add recent viewed products carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Carousel: Items', 'electro-extensions' ),
					'param_name' => 'items',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_dots',
					'heading' => esc_html__( 'Carousel: Show Dots', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div',
					'value'			=>  'recently-viewed-products-carousel'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Two Row Products
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Two Row Products', 'electro-extensions' ),
			'base' => 'electro_vc_two_row_products',
			'description' => esc_html__( 'Add two row products to your page.', 'electro-extensions' ),
			'class'	=> '',
			'controls' => 'full',
			'icon' => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Action Text', 'electro-extensions' ),
					'param_name'	=> 'action_text',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
					'param_name'	=> 'action_link',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Limit', 'electro-extensions' ),
					'param_name'	=> 'per_page',
					'description'	=> esc_html__('Enter the number of products to display.', 'electro-extensions'),
					'value'			=> 12,
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns', 'electro-extensions' ),
					'param_name'	=> 'columns',
					'description'	=> esc_html__('Enter the number of columns to display.', 'electro-extensions'),
					'value'			=> 6,
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Columns Wide', 'electro-extensions' ),
					'param_name'	=> 'columns_wide',
					'description'	=> esc_html__('Option only works if Wide Electro Layout enabled.', 'electro-extensions'),
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				)
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Vertical Nav Menu
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Vertical Nav Menu', 'electro-extensions' ),
			'base' => 'electro_vertical_nav_menu',
			'description' => esc_html__( 'Add a verical navigation menu to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' 			=> 'textfield',
					'heading' 		=> esc_html__( 'Title', 'electro-extensions' ),
					'param_name' 	=> 'title',
					'description' 	=> esc_html__( 'Enter the title of menu.', 'electro-extensions' ),
					'holder' 		=> 'div'
				),
				array(
					'type'			=> 'textarea',
					'heading'		=> esc_html__('Action Text', 'electro-extensions' ),
					'param_name'	=> 'action_text',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Action Link', 'electro-extensions' ),
					'param_name'	=> 'action_link',
				),
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Menu', 'electro-extensions' ),
					'value' 		=> $nav_menus_option,
					'param_name'	=> 'menu',
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Team Member
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Team Member', 'electro-extensions' ),
			'base' => 'electro_team_member',
			'description' => esc_html__( 'Add a team member profile to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					 'type' 		=> 'textfield',
					 'heading' 		=> esc_html__( 'Full Name', 'electro-extensions' ),
					 'param_name' 	=> 'name',
					 'description' 	=> esc_html__( 'Enter team member full name', 'electro-extensions' ),
					 'holder' 		=> 'div'
				),
				array(
					 'type' 		=> 'textfield',
					 'heading' 		=> esc_html__( 'Designation', 'electro-extensions' ),
					 'param_name' 	=> 'designation',
					 'description' 	=> esc_html__( 'Enter designation of team member', 'electro-extensions'),
				),
				array(
					'type' 			=> 'attach_image',
					'heading' 		=> esc_html__( 'Profile Pic', 'electro-extensions' ),
					'param_name' 	=> 'profile_pic',
				),
				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Display Style', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Square', 'electro-extensions' ) => 'square',
						esc_html__( 'Circle', 'electro-extensions' ) => 'circle'
					),
					'param_name'	=> 'display_style',
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__( 'Link', 'electro-extensions' ),
					'param_name' 	=> 'link',
					'description' 	=> esc_html__( 'Add link to the team member. Leave blank if there aren\'t any', 'electro-extensions' )
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__( 'Extra Class', 'electro-extensions' ),
					'param_name' 	=> 'el_class',
					'description' 	=> esc_html__( 'Add your extra classes here.', 'electro-extensions' )
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Terms
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'        => esc_html__( 'Electro Terms', 'electro-extensions' ),
			'base'        => 'electro_terms',
			'description' => esc_html__( 'Adds a shortcode for get_terms. Used to get terms including categories, product categories, etc.', 'electro-extensions' ),
			'class'		  => '',
			'controls'    => 'full',
			'icon'    	  => 'vc-el-element-icon',
			'category'    => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'      => array(
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Taxonomy', 'electro-extensions' ),
					'param_name'   => 'taxonomy',
					'description'  => esc_html__( 'Taxonomy name, or comma-separated taxonomies, to which results should be limited.', 'electro-extensions' ),
					'value'        => 'category',
					'holder'       => 'div'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Order By', 'electro-extensions' ),
					'param_name'   => 'orderby',
					'description'  => esc_html__( 'Field(s) to order terms by. Accepts term fields (\'name\', \'slug\', \'term_group\', \'term_id\', \'id\', \'description\'). Defaults to \'name\'.', 'electro-extensions' ),
					'value'        => 'name'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Order', 'electro-extensions' ),
					'param_name'   => 'order',
					'description'  => esc_html__( 'Whether to order terms in ascending or descending order. Accepts \'ASC\' (ascending) or \'DESC\' (descending). Default \'ASC\'.', 'electro-extensions' ),
					'value'        => 'ASC'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Hide Empty ?', 'electro-extensions' ),
					'param_name'   => 'hide_empty',
					'description'  => esc_html__( 'Whether to hide terms not assigned to any posts. Accepts 1 or 0. Default 0.', 'electro-extensions' ),
					'value'        => '0'
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Include IDs', 'electro-extensions' ),
					'param_name'   => 'include',
					'description'  => esc_html__( 'Comma-separated string of term ids to include.', 'electro-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Exclude IDs', 'electro-extensions' ),
					'param_name'   => 'exclude',
					'description'  => esc_html__( 'Comma-separated string of term ids to exclude. If Include is non-empty, Exclude is ignored.', 'electro-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Number', 'electro-extensions' ),
					'param_name'   => 'number',
					'description'  => esc_html__( 'Maximum number of terms to return. Accepts 0 (all) or any positive number. Default 0 (all).', 'electro-extensions' ),
					'value'        => '0',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Offset', 'electro-extensions' ),
					'param_name'   => 'offset',
					'description'  => esc_html__( 'The number by which to offset the terms query.', 'electro-extensions' ),
					'value'        => '0',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Name', 'electro-extensions' ),
					'param_name'   => 'name',
					'description'  => esc_html__( 'Name or comma-separated string of names to return term(s) for.', 'electro-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Slug', 'electro-extensions' ),
					'param_name'   => 'slug',
					'description'  => esc_html__( 'Slug or comma-separated string of slugs to return term(s) for.', 'electro-extensions' ),
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Hierarchical', 'electro-extensions' ),
					'param_name'   => 'hierarchical',
					'description'  => esc_html__( 'Whether to include terms that have non-empty descendants. Accepts 1 (true) or 0 (false). Default 1 (true)', 'electro-extensions' ),
					'value'        => '1',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Child Of', 'electro-extensions' ),
					'param_name'   => 'child_of',
					'description'  => esc_html__( 'Term ID to retrieve child terms of. If multiple taxonomies are passed, child_of is ignored. Default 0.', 'electro-extensions' ),
					'value'        => '0',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Include "Child Of" term ?', 'electro-extensions' ),
					'param_name'   => 'include_parent',
					'description'  => esc_html__( 'Include "Child Of" term in the terms list. Accepts 1 (yes) or 0 (no). Default 1.', 'electro-extensions' ),
					'value'        => '1',
				),
				array(
					'type'         => 'textfield',
					'heading'      => esc_html__( 'Parent', 'electro-extensions' ),
					'param_name'   => 'parent',
					'description'  => esc_html__( 'Parent term ID to retrieve direct-child terms of.', 'electro-extensions' ),
					'value'        => '',
				)
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Mobile Deals product Block
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Mobile Deals Product', 'electro-extensions' ),
			'base' => 'electro_vc_mobile_deal_products_with_featured',
			'description' => esc_html__( 'Add deal product with featured to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'admin_enqueue_js'	=> ELECTRO_EXTENSIONS_URL . 'assets/js/vc-admin.js',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter header title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'header_timer',
					'heading' => esc_html__( 'Show Header Timer', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'param_name'	=> 'timer_value',
					'heading'		=> esc_html__('Timer Value', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type'			=> 'textfield',
					'param_name'	=> 'timer_title',
					'heading'		=> esc_html__('Timer Title', 'electro-extensions' ),
					'holder' => 'div'
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Shortcode', 'electro-extensions' ),
					'param_name'	=> 'shortcode_tag',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )				=> '',
						esc_html__( 'Featured Products', 'electro-extensions' )		=> 'featured_products' ,
						esc_html__( 'On Sale Products', 'electro-extensions' )		=> 'sale_products' 	,
						esc_html__( 'Top Rated Products', 'electro-extensions' )	=> 'top_rated_products' ,
						esc_html__( 'Recent Products', 'electro-extensions' )		=> 'recent_products' 	,
						esc_html__( 'Best Selling Products', 'electro-extensions' )	=> 'best_selling_products',
						esc_html__( 'Products', 'electro-extensions' )				=> 'products' ,
						esc_html__( 'Product Category', 'electro-extensions' )		=> 'product_category' ,
						esc_html__( 'Product Attribute', 'electro-extensions' )		=> 'product_attribute' ,
					),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order by', 'electro-extensions' ),
					'param_name' => 'orderby',
					'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
					'value' => 'date',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Order', 'electro-extensions' ),
					'param_name' => 'order',
					'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
					'value' => 'DESC',
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'param_name'	=> 'products_choice',
					'value'			=> array(
						esc_html__( 'Select', 'electro-extensions' )		=> '',
						esc_html__( 'IDs', 'electro-extensions' )		=> 'ids' ,
						esc_html__( 'SKUs', 'electro-extensions' )		=> 'skus' ,
					),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Product IDs or SKUs', 'electro-extensions'),
					'param_name'	=> 'product_id',
					'description'	=> esc_html__('Enter IDs/SKUs spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category', 'electro-extensions' ),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Enter slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Category Operator', 'electro-extensions' ),
					'param_name'	=> 'cat_operator',
					'description'	=> esc_html__('Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Attribute', 'electro-extensions' ),
					'param_name'	=> 'attribute',
					'description'	=> esc_html__('Enter single attribute slug.', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms', 'electro-extensions' ),
					'param_name'	=> 'terms',
					'description'	=> esc_html__('Enter term slug spearate by comma(,).', 'electro-extensions'),
				),
				
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Terms Operator', 'electro-extensions' ),
					'param_name'	=> 'terms_operator',
					'description'	=> esc_html__('Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro-extensions'),
					'value'			=> 'IN',
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Category Tags
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Category Tags', 'electro-extensions' ),
			'base'			=> 'electro_product_category_tags',
			'description'	=> esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter section title', 'electro-extensions' ),
					'param_name'	=> 'title',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Number of Categories to display', 'electro-extensions' ),
					'param_name'	=> 'limit',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'checkbox',
					'param_name'	=> 'has_no_products',
					'heading'		=> esc_html__( 'Have no products', 'electro-extensions' ),
					'description'	=> esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value'			=> array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order by', 'electro-extensions' ),
					'param_name'	=> 'orderby',
					'description'	=> esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
					'value'			=> 'date',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
					'param_name'	=> 'order',
					'description'	=> esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
					'value'			=> 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'param_name'	=> 'slugs',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'param_name'	=> 'include',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Categories 1-6
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Categories 1-6', 'electro-extensions' ),
			'base'			=> 'electro_products_categories_1_6',
			'description'	=> esc_html__( 'Add product categories to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type'			=> 'checkbox',
					'param_name'	=> 'has_no_products',
					'heading'		=> esc_html__( 'Have no products', 'electro-extensions' ),
					'description'	=> esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
					'value'			=> array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order by', 'electro-extensions' ),
					'param_name'	=> 'orderby',
					'description'	=> esc_html__( ' Sort retrieved posts by parameter. Defaults to \'name\'. One or more options can be passed', 'electro-extensions' ),
					'value'			=> 'date',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Order', 'electro-extensions' ),
					'param_name'	=> 'order',
					'description'	=> esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'ASC\'.', 'electro-extensions' ),
					'value'			=> 'DESC',
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include slug\'s', 'electro-extensions' ),
					'description'	=> esc_html__( 'Enter slug spearate by comma(,). Maximum of 7.', 'electro-extensions' ),
					'param_name'	=> 'slugs',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Include ID\'s', 'electro-extensions' ),
					'description'	=> esc_html__( 'Enter ids spearate by comma(,). Maximum of 7.', 'electro-extensions' ),
					'param_name'	=> 'include',
					'holder'		=> 'div'
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Onsale Product Carousel 2
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name' => esc_html__( 'Electro Onsale Products Carousel 2', 'electro-extensions' ),
			'base' => 'electro_vc_products_onsale_carousel_2',
			'description' => esc_html__( 'Add onsale products carousel to your page.', 'electro-extensions' ),
			'class'		=> '',
			'controls' => 'full',
			'icon'  => 'vc-el-element-icon',
			'category' => esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Products to display', 'electro-extensions' ),
					'param_name' => 'limit',
					'holder' => 'div'
				),

				array(
					'type' 			=> 'dropdown',
					'heading'		=> esc_html__( 'Product Choice', 'electro-extensions' ),
					'value' 		=> array(
						esc_html__( 'Recent', 'electro-extensions' ) => 'recent',
						esc_html__( 'Random', 'electro-extensions' ) => 'random',
						esc_html__( 'Specific', 'electro-extensions' ) => 'specific'
					),
					'param_name'	=> 'product_choice',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Product ID', 'electro-extensions' ),
					'param_name' => 'product_id',
					'holder' => 'div'
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'show_timer',
					'heading' => esc_html__( 'Show Timer', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),
			)
		)
	);

	#-----------------------------------------------------------------
	# Electro Banners 1-6 Block
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Banners 1-6 Block', 'electro-extensions' ),
			'base'			=> 'electro_home_banner_1_6_block',
			'description'	=> esc_html__( 'Add banners to your page.', 'electro-extensions' ),
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> $banners_1_6_params,
		)
	);

	#-----------------------------------------------------------------
	# Electro Product Categories With Banner Carousel
	#-----------------------------------------------------------------
	vc_map(
		array(
			'name'			=> esc_html__( 'Product Categories With Banner Carousel', 'electro-extensions' ),
			'base'			=> 'electro_product_categories_with_banner_carousel',
			'class'			=> '',
			'controls'		=> 'full',
			'icon'			=> 'vc-el-element-icon',
			'category'		=> esc_html__( 'Electro Elements', 'electro-extensions' ),
			'params'		=> array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Enter Section Title', 'electro-extensions' ),
					'param_name' => 'title',
					'holder' => 'div'
				),

				array(
					'type' 		 => 'param_group',
					'value' 	 => '',
					'heading'	 => esc_html__('Carousel Elements', 'electro-extensions' ),
					'param_name' => 'elements',
					'params' 	 => array(
						array(
							'type' => 'checkbox',
							'param_name' => 'enable_category_1',
							'heading' => esc_html__( 'Enable Categories 1', 'electro-extensions' ),
							'value' => array(
								esc_html__( 'Allow', 'electro-extensions' ) => 'true'
							)
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 1: limit', 'electro-extensions' ),
							'param_name' => 'cat_1_limit',
							'holder' => 'div'
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 1: Child limit', 'electro-extensions' ),
							'param_name' => 'cat_1_child_limit',
							'holder' => 'div'
						),

						array(
							'type' => 'checkbox',
							'param_name' => 'cat_1_has_no_products',
							'heading' => esc_html__( 'Categories List 1: Have no products', 'electro-extensions' ),
							'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
							'value' => array(
								esc_html__( 'Allow', 'electro-extensions' ) => 'true'
							)
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 1: Order by', 'electro-extensions' ),
							'param_name' => 'cat_1_orderby',
							'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
							'value' => 'date',
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 1: Order', 'electro-extensions' ),
							'param_name' => 'cat_1_order',
							'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
							'value' => 'DESC',
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 1: Include ID\'s', 'electro-extensions' ),
							'param_name' => 'cat_1_include',
							'holder' => 'div'
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 1: Include slug\'s', 'electro-extensions' ),
							'param_name' => 'cat_1_slugs',
							'holder' => 'div'
						),

						array(
							'type' => 'checkbox',
							'param_name' => 'enable_category_2',
							'heading' => esc_html__( 'Enable Categories 2', 'electro-extensions' ),
							'value' => array(
								esc_html__( 'Allow', 'electro-extensions' ) => 'true'
							)
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 2: limit', 'electro-extensions' ),
							'param_name' => 'cat_2_limit',
							'holder' => 'div'
						),

						array(
							'type' => 'checkbox',
							'param_name' => 'cat_2_has_no_products',
							'heading' => esc_html__( 'Categories List 2: Have no products', 'electro-extensions' ),
							'description' => esc_html__( 'Show Categories does not have products', 'electro-extensions' ),
							'value' => array(
								esc_html__( 'Allow', 'electro-extensions' ) => 'true'
							)
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 2: Order by', 'electro-extensions' ),
							'param_name' => 'cat_2_orderby',
							'description' => esc_html__( ' Sort retrieved posts by parameter. Defaults to \'date\'. One or more options can be passed', 'electro-extensions' ),
							'value' => 'date',
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 2: Order', 'electro-extensions' ),
							'param_name' => 'cat_2_order',
							'description' => esc_html__( 'Designates the ascending or descending order of the \'orderby\' parameter. Defaults to \'DESC\'.', 'electro-extensions' ),
							'value' => 'DESC',
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 2: Include ID\'s', 'electro-extensions' ),
							'param_name' => 'cat_2_include',
							'holder' => 'div'
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories List 2: Include slug\'s', 'electro-extensions' ),
							'param_name' => 'cat_2_slugs',
							'holder' => 'div'
						),

						array(
							'type' => 'checkbox',
							'param_name' => 'enable_banner',
							'heading' => esc_html__( 'Enable Banner ?', 'electro-extensions' ),
							'value' => array(
								esc_html__( 'Allow', 'electro-extensions' ) => 'true'
							)
						),

						array(
							'type' 			=> 'attach_image',
							'heading' 		=> esc_html__( 'Banner Image', 'electro-extensions' ),
							'param_name' 	=> 'image',
						),

						array(
							'type'			=> 'textfield',
							'heading'		=> esc_html__('Banner Action Link', 'electro-extensions' ),
							'param_name'	=> 'img_action_link',
						),
					),
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_nav',
					'heading' => esc_html__( 'Carousel: Show Navigation', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_touchdrag',
					'heading' => esc_html__( 'Carousel: Enable Touch Drag', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type' => 'checkbox',
					'param_name' => 'is_autoplay',
					'heading' => esc_html__( 'Carousel: Autoplay', 'electro-extensions' ),
					'value' => array(
						esc_html__( 'Allow', 'electro-extensions' ) => 'true'
					)
				),

				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__( 'Enter class name', 'electro-extensions' ),
					'param_name'	=> 'el_class',
					'holder'		=> 'div'
				),
			),
		)
	);

endif;
