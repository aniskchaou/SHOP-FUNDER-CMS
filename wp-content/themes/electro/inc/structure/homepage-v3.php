<?php
/**
 * Template functions hooked into the `homepage_v3` action in the homepage template
 */

function electro_get_default_home_v3_options() {
	$home_v3 = array(
		'header_style'	=> '',
		'sdr'	=> array(
			'is_enabled'	=> 'yes',
			'priority'		=> 10,
			'animation'		=> '',
			'shortcode'		=> '',
		),
		'fl'	=> array(
			'is_enabled'	=> 'yes',
			'priority'		=> 20,
			'animation'		=> '',
			array(
				'icon'	=> 'ec ec-transport',
				'text'	=> wp_kses_post( __( '<strong>Free Delivery</strong> from $50', 'electro' ) )
			),
			array(
				'icon'	=> 'ec ec-customers',
				'text'	=> wp_kses_post( __( '<strong>99% Positive</strong> Feedbacks', 'electro' ) )
			),
			array(
				'icon'	=> 'ec ec-returning',
				'text'	=> wp_kses_post( __( '<strong>365 days</strong> for free return', 'electro' ) )
			),
			array(
				'icon'	=> 'ec ec-payment',
				'text'	=> wp_kses_post( __( '<strong>Payment</strong> Secure System', 'electro' ) )
			),
			array(
				'icon'	=> 'ec ec-tag',
				'text'	=> wp_kses_post( __( '<strong>Only Best</strong> Brands', 'electro' ) )
			)
		),
		'ad'	=> array(
			'is_enabled'	=> 'yes',
			'priority'		=> 30,
			'animation'		=> '',
			array(
				'ad_text'		=> wp_kses_post( __( 'Catch Hottest <strong>Deals</strong> in Cameras Category', 'electro' ) ),
				'action_text'	=> wp_kses_post( __( 'Shop now', 'electro' ) ),
				'action_link'	=> '#',
				'ad_image'		=> '',
				'el_class'		=> 'col-xs-12 col-sm-6',
			),
			array(
				'ad_text'		=> wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
				'action_text'	=> wp_kses_post( __( '<span class="from"><span class="prefix">From</span><span class="value"><sup>$</sup>749</span><span class="suffix">99</span></span>', 'electro' ) ),
				'action_link'	=> '#',
				'ad_image'		=> '',
				'el_class'		=> 'col-xs-12 col-sm-6',
			),
		),
		'pct'	=> array(
			'is_enabled'		=> 'yes',
			'priority'			=> 40,
			'animation'			=> '',
			'product_limit'		=> 12,
			'product_columns'	=> 4,
			'tabs'				=> array(
				array(
					'title'		=> esc_html__( 'Featured', 'electro' ),
					'content'	=> array(
						'shortcode'				=> 'featured_products',
						'product_category_slug'	=> '',
						'products_choice'		=> 'ids',
						'products_ids_skus'		=> '',
					)
				),
				array(
					'title'		=> esc_html__( 'On Sale', 'electro' ),
					'content'	=> array(
						'shortcode'				=> 'sale_products',
						'product_category_slug'	=> '',
						'products_choice'		=> 'ids',
						'products_ids_skus'		=> '',
					)
				),
				array(
					'title'		=> esc_html__( 'Top Rated', 'electro' ),
					'content'	=> array(
						'shortcode'				=> 'top_rated_products',
						'product_category_slug'	=> '',
						'products_choice'		=> 'ids',
						'products_ids_skus'		=> '',
					)
				)
			),
			'carousel_args' => array(
				'autoplay'		=> 'no',
				'responsive'	=> array(
					'0'		=> array( 'items'	=> 2 ),
					'480'	=> array( 'items'	=> 2 ),
					'768'	=> array( 'items'	=> 2 ),
					'992'	=> array( 'items'	=> 3 ),
					'1200'	=> array( 'items'	=> 5 )
				)
			)
		),
		'pci'	=> array(
			'is_enabled'	=> 'yes',
			'priority'		=> 50,
			'animation'		=> '',
			'image'			=> array(
				'bg_img'		=> '',
				'ad_img'		=> '',
			),
			'carousel'		=> array(
				'section_title'		=> esc_html__( 'Television Entertainment', 'electro' ),
				'product_limit'		=> 6,
				'product_columns'	=> 2,
				'content'			=> array(
					'shortcode'				=> 'sale_products',
					'product_category_slug'	=> '',
					'products_choice'		=> '',
					'products_ids_skus'		=> '',
				),
				'carousel_args'		=> array(
					'autoplay'				=> 'no',
					'responsive'			=> array(
						'0'			=> array( 'items' => 2 ),
						'480'		=> array( 'items' => 2 ),
						'768'		=> array( 'items' => 2 ),
						'992'		=> array( 'items' => 3 ),
						'1200'		=> array( 'items' => 2 ),
					)
				)
			)
		),
		'pcc'	=> array(
			'is_enabled'		=> 'yes',
			'priority'			=> 60,
			'animation'			=> '',
			'section_title'		=> esc_html__( 'Music', 'electro' ),
			'product_limit'		=> 16,
			'product_columns'	=> 2,
			'product_rows'		=> 2,
			'cat_limit'			=> 3,
			'cat_slugs'			=> '',
			'content'			=> array(
				'shortcode'				=> 'product_category',
				'product_category_slug'	=> 'music',
				'products_choice'		=> '',
				'products_ids_skus'		=> '',
			),
			'carousel_args'		=> array(
				'autoplay'				=> 'no',
			)
		),
		'pcc2'	=> array(
			'is_enabled'		=> 'yes',
			'priority'			=> 70,
			'animation'			=> '',
			'section_title'		=> esc_html__( 'Trending Products', 'electro' ),
			'product_limit'		=> 12,
			'product_columns'	=> 3,
			'product_rows'		=> 1,
			'content'			=> array(
				'shortcode'				=> 'recent_products',
				'product_category_slug'	=> '',
				'products_choice'		=> 'ids',
				'products_ids_skus'		=> '',
			),
			'carousel_args'		=> array(
				'autoplay'				=> 'no',
			)
		),
		'so'	=> array(
			'is_enabled'		=> 'yes',
			'priority'			=> 80,
			'animation'			=> '',
			'section_title'		=> esc_html__( 'Bestsellers', 'electro' ),
			'cat_limit'			=> 3,
			'cat_slugs'			=> '',
			'content'			=> array(
				'shortcode'				=> 'best_selling_products',
				'product_category_slug'	=> '',
				'products_choice'		=> '',
				'products_ids_skus'		=> '',
			)
		),
		'hlc'	=> array(
			'is_enabled'		=> 'yes',
			'priority'			=> 90,
			'animation'			=> '',
			'section_title'		=> esc_html__( 'Top Categories this Month', 'electro' ),
			'cat_slugs'			=> '',
			'cat_args'			=> array(
				'number'			=> 6,
				'orderby'			=> 'name',
				'order'				=> 'ASC',
				'hide_empty'		=> true
			)
		),
		'pc'	=> array(
			'is_enabled'		=> 'yes',
			'priority'			=> 100,
			'animation'			=> '',
			'section_title'		=> esc_html__( 'Recommendation for your manager', 'electro' ),
			'product_limit'		=> 20,
			'product_columns'	=> 6,
			'content'			=> array(
				'shortcode'				=> 'recent_products',
				'product_category_slug'	=> '',
				'products_choice'		=> 'ids',
				'products_ids_skus'		=> '',
			),
			'carousel_args'		=> array(
				'autoplay'		=> 'no',
				'responsive'	=> array(
					'0'			=> array( 'items' => 2 ),
					'480'		=> array( 'items' => 2 ),
					'768'		=> array( 'items' => 2 ),
					'992'		=> array( 'items' => 3 ),
					'1200'		=> array( 'items' => 6 ),
				)
			)
		),
		'tbrs'    => array(
            'is_enabled'        => 'yes',
            'priority'          => 110,
            'animation'         => '',
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            ),
            array(
                'image'         => '',
                'action_link'   => '#',
                'el_class'      => '',
            )
        ),
        'rvp'   => array(
            'is_enabled'        => 'yes',
            'priority'          => 120,
            'animation'         => '',
            'section_title'     => esc_html__( 'Your Recently Viewed Products', 'electro' ),
            'shortcode_atts'    => array( 
                'columns'           => '10',
                'per_page'          => '20'
            ),
            'carousel_args' => array(
                'items'         => 10,
                'dots'          => true,
                'autoplay'      => 'no',
                'responsive'    => array(
                    '0'     => array( 'items'   => 2 ),
                    '480'   => array( 'items'   => 2 ),
                    '768'   => array( 'items'   => 2 ),
                    '992'   => array( 'items'   => 3 ),
                    '1200'  => array( 'items'   => 8 ),
                    '1440'  => array( 'items'   => 10 ),
                )
            )
        ),
	);

	return apply_filters( 'electro_home_v3_default_options', $home_v3 );
}

function electro_get_home_v3_meta( $merge_default = true ) {
	global $post;

	if ( isset( $post->ID ) ){

		$clean_home_v3_options = get_post_meta( $post->ID, '_home_v3_options', true );
		$home_v3_options = maybe_unserialize( $clean_home_v3_options );

		if( ! is_array( $home_v3_options ) ) {
			$home_v3_options = json_decode( $clean_home_v3_options, true );
		}

		if ( $merge_default ) {
			$default_options = electro_get_default_home_v3_options();
			$home_v3 = wp_parse_args( $home_v3_options, $default_options );
		} else {
			$home_v3 = $home_v3_options;
		}

		return apply_filters( 'electro_home_v3_meta', $home_v3, $post );
	}
}

if ( ! function_exists( 'electro_home_v3_features_list' ) ) {
	/**
	 *
	 */
	function electro_home_v3_features_list() {

		$home_v3 = electro_get_home_v3_meta();

		$is_enabled = isset( $home_v3['fl']['is_enabled'] ) ? $home_v3['fl']['is_enabled'] : 'no';

		if ( $is_enabled !== 'yes' ) {
			return;
		}

		$animation = isset( $home_v3['fl']['animation'] ) ? $home_v3['fl']['animation'] : '';

		$features = apply_filters( 'electro_home_v3_features_list_features', array(
			array(
				'icon'	=> isset( $home_v3['fl'][0]['icon'] ) ? $home_v3['fl'][0]['icon'] : 'ec ec-transport',
				'text'	=> isset( $home_v3['fl'][0]['text'] ) ? $home_v3['fl'][0]['text'] : wp_kses_post( __( '<strong>Free Delivery</strong> from $50', 'electro' ) )
			),
			array(
				'icon'	=> isset( $home_v3['fl'][1]['icon'] ) ? $home_v3['fl'][1]['icon'] : 'ec ec-customers',
				'text'	=> isset( $home_v3['fl'][1]['text'] ) ? $home_v3['fl'][1]['text'] : wp_kses_post( __( '<strong>99% Positive</strong> Feedbacks', 'electro' ) )
			),
			array(
				'icon'	=> isset( $home_v3['fl'][2]['icon'] ) ? $home_v3['fl'][2]['icon'] : 'ec ec-returning',
				'text'	=> isset( $home_v3['fl'][2]['text'] ) ? $home_v3['fl'][2]['text'] : wp_kses_post( __( '<strong>365 days</strong> for free return', 'electro' ) )
			),
			array(
				'icon'	=> isset( $home_v3['fl'][3]['icon'] ) ? $home_v3['fl'][3]['icon'] : 'ec ec-payment',
				'text'	=> isset( $home_v3['fl'][3]['text'] ) ? $home_v3['fl'][3]['text'] : wp_kses_post( __( '<strong>Payment</strong> Secure System', 'electro' ) )
			),
			array(
				'icon'	=> isset( $home_v3['fl'][4]['icon'] ) ? $home_v3['fl'][4]['icon'] : 'ec ec-tag',
				'text'	=> isset( $home_v3['fl'][4]['text'] ) ? $home_v3['fl'][4]['text'] : wp_kses_post( __( '<strong>Only Best</strong> Brands', 'electro' ) )
			)
		) );

		ob_start();

		electro_features_list( $features );

		$features_html = ob_get_clean();

		$section_class 	= 'home-v3-features-block';

		if ( ! empty( $animation ) ) {
			$section_class .= ' animate-in-view';
		}
		?><div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<?php echo wp_kses_post( $features_html ); ?>
		</div><?php
	}
}



if ( ! function_exists( 'electro_home_v3_6_1_block' ) ) {
	/**
	 * Displays a 6-1 Block in Home v3
	 */
	function electro_home_v3_6_1_block() {

		if ( is_woocommerce_activated() ) {

			$home_v3 		= electro_get_home_v3_meta();
			$so 			= $home_v3['so'];

			$is_enabled = isset( $so['is_enabled'] ) ? $so['is_enabled'] : 'no';

			if ( $is_enabled !== 'yes' ) {
				return;
			}

			$animation 		= isset( $so['animation'] ) ? $so['animation'] : '';
			$shortcode 		= isset( $so['content']['shortcode'] ) ? $so['content']['shortcode'] : 'sale_products';
			$default_atts 	= array( 'per_page' => 7 );

			if ( electro_is_wide_enabled() ) {
				$default_atts[ 'per_page' ] = 9;
			}

			$atts 			= electro_get_atts_for_shortcode( $so['content'] );
			$atts 			= wp_parse_args( $atts, $default_atts );
			$products 		= Electro_Products::$shortcode( $atts );

			$args = apply_filters( 'electro_home_v3_6_1_args', array(
				'section_title'		=> $so['section_title'],
				'categories_count'	=> $so['cat_limit'],
				'categories_slugs'	=> $so['cat_slugs'],
				'products'			=> $products,
				'category_args'		=> '',
				'animation'			=> $animation
			) );

			electro_products_6_1_block( $args );
		}
	}
}

if ( ! function_exists( 'electro_home_v3_list_categories' ) ) {
	/**
	 *
	 */
	function electro_home_v3_list_categories() {

		if ( is_woocommerce_activated() ) {
			$home_v3 	= electro_get_home_v3_meta();

			$is_enabled = isset( $home_v3['hlc']['is_enabled'] ) ? $home_v3['hlc']['is_enabled'] : 'no';

			if ( $is_enabled !== 'yes' ) {
				return;
			}

			$animation 	= isset( $home_v3['hlc']['animation'] ) ? $home_v3['hlc']['animation'] : '';
			if ( electro_is_wide_enabled() ) {
				$cat_args 	= isset( $home_v3['hlc']['cat_args'] ) ? $home_v3['hlc']['cat_args'] : array( 'number' => 8 );
			} else {
				$cat_args 	= isset( $home_v3['hlc']['cat_args'] ) ? $home_v3['hlc']['cat_args'] : array( 'number' => 6 );
			}

			if ( ! empty( $home_v3['hlc']['cat_slugs'] ) ) {
				$cat_slugs = explode( ',', $home_v3['hlc']['cat_slugs'] );
				$cat_slugs = array_map( 'trim', $cat_slugs );
				$cat_args['slug'] 				= $cat_slugs;
				$cat_args['hide_empty'] 		= false;

				$include = array();

				foreach ( $cat_slugs as $slug ) {
					$include[] = "'" . $slug ."'";
				}

				if ( ! empty($include ) ) {
					$cat_args['include'] 	= $include;
					$cat_args['orderby']	= 'include';
				}
			}

			$args = apply_filters( 'electro_home_v3_list_categories_args', array(
				'section_title'			=> isset( $home_v3['hlc']['section_title'] ) ? $home_v3['hlc']['section_title'] : esc_html__( 'Top Categories this Month', 'electro' ),
				'animation'				=> $animation,
				'category_args'			=> $cat_args,
				'child_category_args'	=> array(
					'echo' 					=> false,
					'title_li' 				=> '',
					'show_option_none' 		=> '',
					'number' 				=> 6,
					'depth'					=> 1,
					'hide_empty'			=> false
				)
			) );

			electro_home_list_categories( $args );
		}
	}
}

if ( ! function_exists( 'electro_home_v3_products_carousel' ) ) {
	/**
	 *
	 */
	function electro_home_v3_products_carousel() {

		if ( is_woocommerce_activated() ) {

			$home_v3 	= electro_get_home_v3_meta();
			$pc_options = $home_v3['pc'];

			$is_enabled = isset( $pc_options['is_enabled'] ) ? $pc_options['is_enabled'] : 'no';

			if ( $is_enabled !== 'yes' ) {
				return;
			}

			$animation = !empty( $pc_options['animation'] ) ? $pc_options['animation'] : '';

			$args = apply_filters( 'electro_home_v3_products_carousel', array(
				'limit'			=> $pc_options['product_limit'],
				'columns'		=> $pc_options['product_columns'],
				'columns_wide'  => isset( $home_v3['pc']['product_columns_wide'] ) ? $home_v3['pc']['product_columns_wide'] : 7,
				'section_args' 	=> array(
					'section_title'		=> $pc_options['section_title'],
					'section_class'		=> 'section-products-carousel ',
					'animation'			=> $animation
				),
				'carousel_args'	=> array(
					'items'				=> $pc_options['product_columns'],
					'autoplay'			=> isset( $pc_options['carousel_args']['autoplay'] ) ? filter_var( $pc_options['carousel_args']['autoplay'], FILTER_VALIDATE_BOOLEAN ) : false,
					'responsive'		=> array(
						'0'     => array( 'items' => 2 ),
                        '480'   => array( 'items' => 3 ),
                        '768'   => array( 'items' => 3 ),
                        '992'   => array( 'items' => 3 ),
                        '1200'  => array( 'items' => $pc_options['product_columns'] ),
					)
				)
			) );

			if ( electro_is_wide_enabled() ) {
                $args['carousel_args']['responsive']['1480'] = array( 'items' => $args['columns_wide'] );
                $args['carousel_args']['responsive']['768'] = array( 'items' => 4 );
                $args['carousel_args']['responsive']['992'] = array( 'items' => 4 );
				$args['section_args']['section_class'] = 'section-products-carousel section-products-carousel__wide ';
            }

			if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && ! empty( $pc_options['carousel_args']['responsive'] ) ) {
				$responsive_args = array();
				foreach ( $pc_options['carousel_args']['responsive'] as $key => $responsive ) {
					if( isset( $responsive['items'] ) && intval( $responsive['items'] ) > 0 ) {
						$responsive_args[$key]['items'] = intval( $responsive['items'] );
					} elseif( isset( $args['carousel_args']['responsive'][$key]['items'] ) ) {
						$responsive_args[$key]['items'] = $args['carousel_args']['responsive'][$key]['items'];
					} else {
						$responsive_args[$key]['items'] = $pc_options['product_columns'];
					}
				}
				$args['carousel_args']['responsive'] = $responsive_args;
			}

			$default_atts 	= array( 'per_page' => intval( $args['limit'] ), 'columns' => intval( $args['columns'] ) );
			$atts 			= electro_get_atts_for_shortcode( $pc_options['content'] );
			$atts 			= wp_parse_args( $atts, $default_atts );
			$products 		= electro_do_shortcode( $pc_options['content']['shortcode'], $atts );

			$args['section_args']['products_html'] = $products;

			electro_products_carousel( $args['section_args'], $args['carousel_args'] );
		}
	}
}
