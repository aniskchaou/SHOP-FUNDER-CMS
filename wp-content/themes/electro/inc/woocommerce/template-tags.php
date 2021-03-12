<?php
/**
 * Template functions available for WooCommerce
 */

if ( ! function_exists( 'electro_before_wc_content' ) ) {
	/**
	 * Before Content
	 * Wraps all WooCommerce content in wrappers which match the theme markup
	 *
	 * @return  void
	 */
	function electro_before_wc_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
			<?php
	}
}

if ( ! function_exists( 'electro_product_subcategories' ) ) {
	/**
	 * Wrapper woocommerce_product_subcategories
	 *
	 */
	function electro_product_subcategories() {

		$columns 	= electro_set_loop_shop_subcategories_columns();
		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
			global $woocommerce_loop;
			$woocommerce_loop[ 'columns' ] = $columns;
		} else {
			$display_type = woocommerce_get_loop_display_mode();
			if( ! in_array( $display_type, array( 'subcategories', 'both' ) ) ) {
				return;
			}
			if( wc_get_loop_prop( 'is_shortcode' ) ) {
				return;
			}

			wc_set_loop_prop( 'columns', $columns );
			if ( ! woocommerce_products_will_display() ) {
				remove_action( 'woocommerce_before_shop_loop', 'electro_product_subcategories', 0 );
			}
		}

		$class 		= 'woocommerce columns-' . $columns;
		$parent_id	= is_product_category() ? get_queried_object_id() : 0;
		$before 	= '<div class="' .esc_attr( $class ) . '"><ul class="product-loop-categories columns-'. esc_attr( $columns ) . '">';
		$after 		= '</ul></div>';

		if ( ! woocommerce_products_will_display() ) {

			$layout = electro_get_shop_layout();

			if ( 'full-width' == $layout ) {

				add_action( 'electro_after_product_subcategories', 'electro_best_sellers_carousel_in_category' );

			} else {

				add_action( 'electro_after_product_subcategories', 'electro_best_sellers_in_category' );
				add_action( 'electro_after_product_subcategories', 'electro_top_rated_in_category' );

			}
		}

		do_action( 'electro_before_product_subcategories' );

		ob_start();
		if ( ! function_exists( 'woocommerce_output_product_categories' ) ) {
			woocommerce_product_subcategories( array( 'parent_id' => $parent_id, 'before' => $before, 'after' => $after ) );
		} else {
			woocommerce_output_product_categories( array( 'parent_id' => $parent_id, 'before' => $before, 'after' => $after ) );
		}
		$sub_categories_html = ob_get_clean();

		if ( ! empty( $sub_categories_html ) ):

			$woocommerce_page_title = woocommerce_page_title( false );
			$section_product_categories_title = sprintf( esc_html__( '%s Categories', 'electro' ),  $woocommerce_page_title );
			$section_product_categories_title = apply_filters( 'electro_section_product_categories_title', $section_product_categories_title, $woocommerce_page_title );

			?><section class="section-product-categories">
				<header>
					<h2 class="h1"><?php echo esc_html( $section_product_categories_title ); ?></h2>
				</header><?php

				echo wp_kses_post( $sub_categories_html );

			?></section><?php

		endif;

		do_action( 'electro_after_product_subcategories' );

		$columns 	= electro_set_loop_shop_columns();
		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
			$woocommerce_loop[ 'columns' ] = $columns;
		} else {
			wc_set_loop_prop( 'columns', $columns );
			if ( 'subcategories' === $display_type ) {
				wc_set_loop_prop( 'total', 0 );
			}
			if ( ! woocommerce_products_will_display() ) {
				add_action( 'woocommerce_before_shop_loop', 'electro_product_subcategories', 0 );
			}
		}
	}
}

if ( ! function_exists( 'electro_best_sellers_carousel_in_category' ) ) {
	function electro_best_sellers_carousel_in_category() {

		$term = get_queried_object();

		if ( ! ( $term instanceof WP_Term ) ) {
			return;
		}

		$args = apply_filters( 'electro_best_sellers_carousel_in_category', array(
			'limit'			=> 24,
			'columns'		=> 6,
			'section_args' 	=> array(
				'section_title'		=> esc_html__( 'People buying in this category', 'electro' ),
				'section_class'		=> 'section-products-carousel',
			),
			'carousel_args'	=> array(
				'items'				=> 6,
				'responsive'		=> array(
					'0'		=> array( 'items'	=> 2 ),
					'480'	=> array( 'items'	=> 2 ),
					'768'	=> array( 'items'	=> 2 ),
					'992'	=> array( 'items'	=> 3 ),
					'1200'	=> array( 'items' => 6 ),
				)
			)
		) );

		$best_selling_products = electro_do_shortcode( 'best_selling_products', array(
			'per_page' 	=> intval( $args[ 'limit' ] ),
			'columns' 	=> intval( $args[ 'columns' ] ),
			'category'	=> $term->slug
		) );

		$args['section_args']['products_html'] = $best_selling_products;

		electro_products_carousel( $args['section_args'], $args['carousel_args'] );
	}
}

if ( ! function_exists( 'electro_best_sellers_in_category' ) ) {
	function electro_best_sellers_in_category() {

		global $wp_query;

		$term = get_queried_object();

		if ( ! ( $term instanceof WP_Term ) ) {
			return;
		}

		$args = apply_filters( 'electro_best_sellers_in_category', array(
			'query_args'	=> array(
				'limit'		=> 8,
				'category'	=> $term->slug
			),
			'section_args' 	=> array(
				'section_title'	=> esc_html__( 'Best Sellers', 'electro' ),
				'rows'			=> 1,
				'columns'		=> 2,
				'total'			=> 8,
				'show_nav'		=> false
			),
			'carousel_args'	=> array()
		) );

		$products_in_category = Electro_Products::best_selling_products( array(
			'limit' 	=> intval( $args['query_args']['limit'] ),
			'category'	=> sanitize_title( $args['query_args']['category'] )
		) );

		if ( $products_in_category->have_posts() ){

			$args['section_args']['products'] = apply_filters( 'electro_best_sellers_in_category_products_html', $products_in_category );

			electro_product_cards_carousel( $args['section_args'], $args['carousel_args'] );
		}
	}
}

if ( ! function_exists( 'electro_top_rated_in_category' ) ) {
	function electro_top_rated_in_category() {

		global $wp_query;

		$term = get_queried_object();

		if ( ! ( $term instanceof WP_Term ) ) {
			return;
		}

		$args = apply_filters( 'electro_top_rated_in_category', array(
			'query_args'	=> array(
				'limit'		=> 8,
				'category'	=> $term->slug
			),
			'section_args' 	=> array(
				'section_title'	=> esc_html__( 'Top rated in this category', 'electro' ),
				'rows'			=> 1,
				'columns'		=> 2,
				'total'			=> 8,
				'show_nav'		=> false
			),
			'carousel_args'	=> array()
		) );

		$products_in_category = Electro_Products::top_rated_products( array(
			'per_page' 	=> intval( $args['query_args']['limit'] ),
			'category'	=> sanitize_title( $args['query_args']['category'] )
		) );

		if ( $products_in_category->have_posts() ) {

			$args['section_args']['products'] = apply_filters( 'electro_top_rated_in_category_products_html', $products_in_category );

			electro_product_cards_carousel( $args['section_args'], $args['carousel_args'] );
		}
	}
}

if ( ! function_exists( 'electro_wc_loop_title' ) ) {
	/**
	 * Outputs WooCommerce Page title
	 */
	function electro_wc_loop_title() {

		if ( apply_filters( 'woocommerce_show_page_title', true ) && woocommerce_products_will_display() ) :

			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '>=' ) ) {
				if( wc_get_loop_prop( 'is_shortcode' ) ) {
					return;
				}
			} ?>

			<header class="page-header">
				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

				<?php 
				if ( ! electro_is_prdctfltr_activated() ) {
					woocommerce_result_count(); 
				}
				?>
			</header>

			<?php

		endif;
	}
}

if ( ! function_exists( 'electro_after_wc_content' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 *
	 * @return  void
	 */
	function electro_after_wc_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		if ( apply_filters( 'electro_show_shop_sidebar', true ) ) {
			/**
			 *
			 */
			do_action( 'electro_sidebar', 'shop' );
		}
	}
}

if ( ! function_exists( 'electro_header_products_search' ) ) {
	/**
	 * Displays Products Search bar at header
	 */
	function electro_header_products_search() {

	}
}

if ( ! function_exists( 'electro_navbar_mini_cart' ) ) {
	/**
	 * Navbar mini cart
	 */
	function electro_navbar_mini_cart() {
		electro_get_template( 'shop/electro-mini-cart.php' );
	}
}

if ( ! function_exists( 'electro_wrap_product_outer' ) ) {
	/**
	 * Wraps product with product-outer div
	 */
	function electro_wrap_product_outer() {
		?><div class="product-outer product-item__outer"><?php
	}
}

if ( ! function_exists( 'electro_wrap_product_inner' ) ) {
	/**
	 * Wraps product with product-inner div
	 */
	function electro_wrap_product_inner() {
		?><div class="product-inner product-item__inner"><?php
	}
}

if ( ! function_exists( 'electro_wrap_price_and_add_to_cart' ) ) {
	/**
	 * Wraps price and add-to-cart button
	 */
	function electro_wrap_price_and_add_to_cart() {
		?><div class="price-add-to-cart"><?php
	}
}

if ( ! function_exists( 'electro_wrap_price_and_add_to_cart_close' ) ) {
	/**
	 * Closes product-add-to-cart wrapper
	 */
	function electro_wrap_price_and_add_to_cart_close() {
		?></div><!-- /.price-add-to-cart --><?php
	}
}

if ( ! function_exists( 'electro_wrap_product_inner_close' ) ) {
	/**
	 * Closes product-inner wrapper
	 */
	function electro_wrap_product_inner_close() {
		?></div><!-- /.product-inner --><?php
	}
}

if ( ! function_exists( 'electro_wrap_product_outer_close' ) ) {
	/**
	 * Closes product-outer wrapper
	 */
	function electro_wrap_product_outer_close() {
		?></div><!-- /.product-outer --><?php
	}
}

if ( ! function_exists( 'electro_product_media_object' ) ) {
	/**
	 * Displays product thumbnail link
	 */
	function electro_product_media_object() {

		global $product;

		$product_id = electro_wc_get_product_id( $product ); ?>

		<a class="card-media-left" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo str_replace( 'class="', 'class="media-object ', woocommerce_get_product_thumbnail() ); ?>
		</a>

		<?php
	}
}



if ( ! function_exists( 'electro_featured_products_carousel' ) ) {
	/**
	 * Featured Products Carousel
	 */
	function electro_featured_products_carousel( $per_page , $columns = 4 ) {

		$per_page = empty( $per_page ) ? 12 : $per_page;

		$args = array(
			'per_page'	=> $per_page,
			'columns'	=> $columns
		);

		$featured = WC_Shortcodes::featured_products( $args );
		electro_products_carousel( $featured, esc_html__( 'Recommended Products', 'electro' ), $columns );
	}
}

if ( ! function_exists( 'electro_template_loop_categories' ) ) {
	/**
	 * Output Product Categories
	 *
	 */
	function electro_template_loop_categories() {
		global $product;

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
			$categories = $product->get_categories();
		} else {
			$product_id = electro_wc_get_product_id( $product );
			$categories = wc_get_product_category_list( $product_id );
		}
		echo apply_filters( 'electro_template_loop_categories_html', wp_kses_post( sprintf( '<span class="loop-product-categories">%s</span>', $categories ) ) );
	}
}

if ( ! function_exists( 'electro_template_loop_product_thumbnail') ) {
	/**
	 * Get the product thumbnail for the loop.
	 */
	function electro_template_loop_product_thumbnail() {
		$thumbnail = woocommerce_get_product_thumbnail();
		echo apply_filters( 'electro_template_loop_product_thumbnail', wp_kses_post( sprintf( '<div class="product-thumbnail product-item__thumbnail">%s</div>', $thumbnail ) ) );
	}
}

if ( ! function_exists( 'electro_template_loop_product_single_image') ) {
	/**
	 * Get the product thumbnail for the loop.
	 */
	function electro_template_loop_product_single_image() {
		$thumbnail = woocommerce_get_product_thumbnail( 'shop_single' );
		echo apply_filters( 'electro_template_loop_product_thumbnail', wp_kses_post( sprintf( '<div class="product-thumbnail product-item__thumbnail">%s</div>', $thumbnail ) ) );
	}
}

if ( ! function_exists( 'electro_shop_control_bar' ) ) {
	/**
	 * Outputs shop control bar
	 */
	function electro_shop_control_bar() {

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '>=' ) ) {
			if ( wc_get_loop_prop( 'is_shortcode' ) || ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
				return;
			}
		} else {
			global $wp_query;

			if ( 1 === $wp_query->found_posts || ! woocommerce_products_will_display() ) {
				return;
			}
		}

		?><div class="shop-control-bar">
			<?php
			/**
			 * @hooked electro_shop_view_switcher - 10
			 * @hooked woocommerce_sorting - 20
			 */
			do_action( 'electro_shop_control_bar' );
			?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_wc_handheld_sidebar' ) ) {
	/**
	 * Outputs WooCommerce Handheld Sidebar Toggle
	 */
	function electro_wc_handheld_sidebar() {
		if( apply_filters( 'electro_has_handheld_sidebar', true ) ) {
			$handheld_sidebar_title = apply_filters( 'electro_handheld_sidebar_title', esc_html__( 'Filters', 'electro' ) );
			$handheld_sidebar_icon  = apply_filters( 'electro_handheld_sidebar_icon', 'fas fa-sliders-h' );
			?><div class="handheld-sidebar-toggle"><button class="btn sidebar-toggler" type="button"><i class="<?php echo esc_attr( $handheld_sidebar_icon ); ?>"></i><span><?php echo esc_html( $handheld_sidebar_title ); ?></span></button></div><?php
		}
	}
}

if ( ! function_exists( 'electro_shop_view_switcher' ) ) {
	/**
	 * Outputs view switcher
	 */
	function electro_shop_view_switcher() {

		global $wp_query;

		if ( 1 === $wp_query->found_posts || ! woocommerce_products_will_display() ) {
			return;
		}

		$shop_views = electro_get_shop_views();
		?>
		<ul class="shop-view-switcher nav nav-tabs" role="tablist">
		<?php foreach( $shop_views as $view_id => $shop_view ) : ?>
			<li class="nav-item"><a class="nav-link <?php $active_class = $shop_view[ 'active' ] ? 'active': ''; echo esc_attr( $active_class ); ?>" data-toggle="tab" data-archive-class="<?php echo esc_attr( $view_id );?>" title="<?php echo esc_attr( $shop_view[ 'label' ] ); ?>" href="#<?php echo esc_attr( $view_id );?>"><i class="<?php echo esc_attr( $shop_view[ 'icon' ] ); ?>"></i></a></li>
		<?php endforeach; ?>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'electro_shop_loop' ) ) {
	/**
	 *
	 */
	function electro_shop_loop() {
		if ( ! woocommerce_products_will_display() ) {
			return;
		}

		/**
		 * Compatibility for Product Filter
		 */
		if ( is_ajax() ) {
		
			global $wp_query;
	
			if( isset( $wp_query->query ) && $wp_query->query['prdctfltr_active'] == '1' ) {
				return;
			}
		}

		?>
		<?php woocommerce_product_loop_start(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>
		<?php
	}
}

if ( ! function_exists( 'electro_shop_control_bar_bottom' ) ) {
	/**
	 * Outputs shop control bar bottom
	 */
	function electro_shop_control_bar_bottom() {

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '>=' ) ) {
			if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
				return;
			}
		} else {
			global $wp_query;

			if ( 1 === $wp_query->found_posts || ! woocommerce_products_will_display() ) {
				return;
			}
		}

		?>
		<div class="shop-control-bar-bottom">
			<?php
			/**
			 * @hooked woocommerce_pagination - 20
			 */
			do_action( 'electro_shop_control_bar_bottom' );
			?>
		</div>
		<?php
	}
}



if ( ! function_exists( 'electro_brands_carousel' ) ) {
	/**
	 * Display brands carousel
	 *
	 */
	function electro_brands_carousel( $section_args = array(), $taxonomy_args = array(), $carousel_args = array() ) {

		global $electro_version;

		if( is_woocommerce_activated() ) {

			$default_section_args = array(
				'section_title'	=> ''
			);

			$default_taxonomy_args = array(
				'orderby'		=> 'title',
				'order'			=> 'ASC',
				'number'		=> 12,
				'hide_empty'	=> false
			);

			$default_carousel_args 	= array(
				'items'				=> 5,
				'navRewind'			=> true,
				'autoplayHoverPause'=> true,
				'nav'				=> true,
				'stagePadding'		=> 1,
				'dots'				=> false,
				'rtl'				=> is_rtl() ? true : false,
				'navText'			=> is_rtl() ? array( '<i class="fa fa-chevron-right"></i>', '<i class="fa fa-chevron-left"></i>' ) : array( '<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>' ),
				'touchDrag'			=> false,
				'responsive'		=> array(
					'0'		=> array( 'items'	=> 1 ),
					'480'	=> array( 'items'	=> 2 ),
					'768'	=> array( 'items'	=> 2 ),
					'992'	=> array( 'items'	=> 3 ),
					'1200'	=> array( 'items' => 5 ),
				)
			);

			$section_args 		= wp_parse_args( $section_args, $default_section_args );
			$taxonomy_args 		= wp_parse_args( $taxonomy_args, $default_taxonomy_args );
			$carousel_args 		= wp_parse_args( $carousel_args, $default_carousel_args );

			$brand_taxonomy = electro_get_brands_taxonomy();
			$brand = get_taxonomy( $brand_taxonomy );

			if( ! empty( $brand_taxonomy ) ) {

				$terms = get_terms( $brand_taxonomy, $taxonomy_args );

				if( ! is_wp_error( $terms ) && !empty( $terms ) ) {
					wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), $electro_version, true );
					electro_get_template( 'sections/brands-carousel.php', array( 'terms' => $terms, 'section_args' => $section_args, 'carousel_args' => $carousel_args, 'brand' => $brand ) );
				}
			}
		}
	}
}

if ( ! function_exists( 'electro_deal_save_label' ) ) {
	/**
	 *
	 */
	function electro_deal_save_label() {
		global $product;

		$args = apply_filters( 'electro_deal_save_label_args', array(
			'savings_text'		=> esc_html__( 'Save', 'electro' ),
			'savings_in'		=> 'amount'
		) );

		if ( apply_filters( 'electro_deal_save_label_show_savings', true ) && $product->is_on_sale() ) {
			?>
			<div class="savings">
				<span class="savings-text"><?php echo sprintf( '%s %s', $args['savings_text'], Electro_WC_Helper::get_savings_on_sale( $product, $args['savings_in'] ) ); ?></span>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'electro_deal_progress_bar' ) ) {
	/**
	 *
	 */
	function electro_deal_progress_bar() {
		$total_stock_quantity = get_post_meta( get_the_ID(), '_total_stock_quantity', true );
		if( ! empty( $total_stock_quantity ) ) {
			$stock_quantity		= round( $total_stock_quantity );
			$stock_available 	= ( $stock = get_post_meta( get_the_ID(), '_stock', true ) ) ? round( $stock ) : 0;
			$stock_sold 	 	= ( $stock_quantity > $stock_available ? $stock_quantity - $stock_available : 0 );
			$percentage 		= ( $stock_sold > 0 ? round( $stock_sold/$stock_quantity * 100 ) : 0 );
		} else {
			$stock_available 	= ( $stock = get_post_meta( get_the_ID(), '_stock', true ) ) ? round( $stock ) : 0;
			$stock_sold 	 	= ( $total_sales = get_post_meta( get_the_ID(), 'total_sales', true ) ) ? round( $total_sales ) : 0;
			$stock_quantity		= $stock_sold + $stock_available;
			$percentage 		= ( ( $stock_available > 0 && $stock_quantity > 0 ) ? round( $stock_sold/$stock_quantity * 100 ) : 0 );
		}

		if( $stock_available > 0 ) :
		?>
		<div class="deal-progress">
			<div class="deal-stock">
				<span class="stock-sold"><?php echo esc_html__( 'Already Sold:', 'electro' );?> <strong><?php echo esc_html( $stock_sold ); ?></strong></span>
				<span class="stock-available"><?php echo esc_html__( 'Available:', 'electro' );?> <strong><?php echo esc_html( $stock_available ); ?></strong></span>
			</div>
			<div class="progress">
				<span class="progress-bar" style="<?php echo esc_attr( 'width:' . $percentage . '%' ); ?>"><?php echo esc_html( $percentage ); ?></span>
			</div>
		</div>
		<?php
		endif;
	}
}

if ( ! function_exists( 'electro_deal_countdown_timer' ) ) {
	/**
	 *
	 */
	function electro_deal_countdown_timer( $product ) {
		$product_id = electro_wc_get_product_id( $product );
		$product_type = electro_wc_get_product_type( $product );
		$sale_price_dates_from = $sale_price_dates_to = '';
		if( $product_type == 'variable' ) {
			$var_sale_price_dates_from = array();
			$var_sale_price_dates_to = array();
			$available_variations = $product->get_available_variations();
			foreach ( $available_variations as $key => $available_variation ) {
				$variation_id = $available_variation['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.
				if( $date_from = get_post_meta( $variation_id, '_sale_price_dates_from', true ) ) {
					$var_sale_price_dates_from[] = date_i18n( 'Y-m-d H:i:s', $date_from, true );
				}
				if( $date_to =get_post_meta( $variation_id, '_sale_price_dates_to', true ) ) {
					$var_sale_price_dates_to[] = date_i18n( 'Y-m-d H:i:s', $date_to, true );
				}
			}

			if( ! empty( $var_sale_price_dates_from ) )
				$sale_price_dates_from = min( $var_sale_price_dates_from );
			if( ! empty( $var_sale_price_dates_to ) )
				$sale_price_dates_to = max( $var_sale_price_dates_to );
		} else {
			if( $date_from = get_post_meta( $product_id, '_sale_price_dates_from', true ) ) {
				$sale_price_dates_from = date_i18n( 'Y-m-d H:i:s', $date_from, true );
			}
			if( $date_to = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) {
				$sale_price_dates_to = date_i18n( 'Y-m-d H:i:s', $date_to, true );
			}
		}

		$deal_end_date = $sale_price_dates_to;
		$deal_end_time = strtotime( $deal_end_date );
		$current_date = current_time( 'Y-m-d H:i:s', true );
		$current_time = strtotime( $current_date );
		$time_diff = ( $deal_end_time - $current_time );

		if( $time_diff > 0 ) :
		?>
		<div class="deal-countdown-timer">
			<div class="marketing-text text-xs-center">
				<?php echo apply_filters( 'electro_deal_countdown_timer_info_text', esc_html__( 'Hurry Up! Offer ends in:', 'electro' ) ); ?>
			</div>
			<span class="deal-time-diff" style="display:none;"><?php echo apply_filters( 'electro_deal_countdown_timer_diff_time', $time_diff ); ?></span>
			<div class="deal-countdown countdown"></div>
		</div>
		<?php
		endif;
	}
}

if ( ! function_exists( 'electro_deal_countdown_timer_v2' ) ) {
	/**
	 *
	 */
	function electro_deal_countdown_timer_v2( $product = '' ) {
		if( empty( $product ) ) {
			global $product;
		}
		$product_id = electro_wc_get_product_id( $product );
		$product_type = electro_wc_get_product_type( $product );
		$sale_price_dates_from = $sale_price_dates_to = '';
		if( $product_type == 'variable' ) {
			$var_sale_price_dates_from = array();
			$var_sale_price_dates_to = array();
			$available_variations = $product->get_available_variations();
			foreach ( $available_variations as $key => $available_variation ) {
				$variation_id = $available_variation['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.
				if( $date_from = get_post_meta( $variation_id, '_sale_price_dates_from', true ) ) {
					$var_sale_price_dates_from[] = date_i18n( 'Y-m-d H:i:s', $date_from, true );
				}
				if( $date_to =get_post_meta( $variation_id, '_sale_price_dates_to', true ) ) {
					$var_sale_price_dates_to[] = date_i18n( 'Y-m-d H:i:s', $date_to, true );
				}
			}

			if( ! empty( $var_sale_price_dates_from ) )
				$sale_price_dates_from = min( $var_sale_price_dates_from );
			if( ! empty( $var_sale_price_dates_to ) )
				$sale_price_dates_to = max( $var_sale_price_dates_to );
		} else {
			if( $date_from = get_post_meta( $product_id, '_sale_price_dates_from', true ) ) {
				$sale_price_dates_from = date_i18n( 'Y-m-d H:i:s', $date_from, true );
			}
			if( $date_to = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) {
				$sale_price_dates_to = date_i18n( 'Y-m-d H:i:s', $date_to, true );
			}
		}

		$deal_start_date = $sale_price_dates_from;
		$deal_start_time = strtotime( $deal_start_date );

		$deal_end_date = $sale_price_dates_to;
		$deal_end_time = strtotime( $deal_end_date );

		$current_date = current_time( 'Y-m-d H:i:s', true );
		$current_time = strtotime( $current_date );

		if( $current_time < $deal_start_time ) {
			$time_diff = ( $deal_start_time - $current_time );
			$info_text = apply_filters( 'electro_deal_countdown_timer_v2_start_info_text', esc_html__( 'Starts in:', 'electro' ) );
		} else {
			$time_diff = ( $deal_end_time - $current_time );
			$info_text = apply_filters( 'electro_deal_countdown_timer_v2_end_info_text', esc_html__( 'Ends in:', 'electro' ) );
		}

		if( $time_diff > 0 ) :
		?>
		<div class="deal-countdown-timer">
			<div class="marketing-text text-xs-center">
				<?php echo apply_filters( 'electro_deal_countdown_timer_v2_info_text', $info_text ); ?>
			</div>
			<span class="deal-time-diff" style="display:none;"><?php echo apply_filters( 'electro_deal_countdown_timer_v2_diff_time', $time_diff ); ?></span>
			<div class="deal-countdown countdown"></div>
		</div>
		<?php
		endif;
	}
}

if ( ! function_exists( 'electro_onsale_product_content_wrapper_start' ) ) {
	/**
	 *
	 */
	function electro_onsale_product_content_wrapper_start() {
		?>
		<div class="onsale-product-content">
		<?php
	}
}

if ( ! function_exists( 'electro_onsale_product_content_wrapper_end' ) ) {
	/**
	 *
	 */
	function electro_onsale_product_content_wrapper_end() {
		?>
		</div>
		<?php
	}
}



if ( ! function_exists( 'electro_deal_cart_button' ) ) {
	/**
	 *
	 */
	function electro_deal_cart_button() {
		?>
		<div class="deal-cart-button">
			<?php woocommerce_template_loop_add_to_cart(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_proceed_to_checkout' ) ) {
	/**
	 * Displays Proceed to Checkout Action
	 *
	 * @return void
	 */
	function electro_proceed_to_checkout() {
		?>
		<div class="wc-proceed-to-checkout">
			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_shipping_details_header' ) ) {
	/**
	 *
	 */
	function electro_shipping_details_header() {
		if ( true === WC()->cart->needs_shipping_address() ) : ?>
		<h3><?php echo esc_html__( 'Shipping Details', 'electro' ); ?></h3>
		<?php endif;
	}
}

if ( ! function_exists( 'electro_before_login_text' ) ) {
	/**
	 *
	 */
	function electro_before_login_text() {
		$before_login_text = apply_filters( 'electro_before_login_text', esc_html__( 'Vestibulum lacus magna, faucibus vitae dui eget, aliquam fringilla.
In et commodo elit. Class aptent taciti sociosqu ad litora.', 'electro' ) );
		if ( ! empty( $before_login_text ) ) : ?>
		<p class="before-login-text">
			<?php echo esc_html( $before_login_text ); ?>
		</p><?php endif;
	}
}

if ( ! function_exists( 'electro_before_register_text' ) ) {
	/**
	 *
	 */
	function electro_before_register_text() {
		$before_register_text = apply_filters( 'electro_before_register_text', esc_html__( 'Create new account today to reap the benefits of a personalized shopping experience. Praesent placerat, est sed aliquet finibus.', 'electro' ) );
		if ( ! empty( $before_register_text ) ) : ?><p class="before-register-text">
			<?php echo esc_html( $before_register_text ); ?>
		</p><?php endif;
	}
}

if ( ! function_exists( 'electro_register_benefits' ) ) {
	/**
	 *
	 */
	function electro_register_benefits() {
		$benefits = apply_filters( 'electro_register_benefits', array(
			esc_html__( 'Speed your way through checkout', 'electro' ),
			esc_html__( 'Track your orders easily', 'electro' ),
			esc_html__( 'Keep a record of all your purchases', 'electro' )
		) );

		$register_benefits_title = apply_filters( 'electro_register_benefits_title', esc_html__( 'Sign sdf today and you will be able to :' , 'electro' ) );

		if ( ! empty( $benefits ) ) : ?><div class="register-benefits">
			<?php if ( ! empty( $register_benefits_title ) ): ?><h3><?php echo esc_html( $register_benefits_title ); ?></h3><?php endif; ?>
			<ul>
				<?php foreach ( $benefits as $benefit ) : ?>
				<li><?php echo esc_html( $benefit ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div><?php endif;
	}
}

if ( ! function_exists( 'electro_wrap_customer_login_form' ) ) {
	/**
	 *
	 */
	function electro_wrap_customer_login_form() {

		$classes = 'customer-login-form';
		$or_text = '<span class="or-text">' . apply_filters( 'electro_or_text', esc_html__( 'or', 'electro' ) ) . '</span>';

		if ( get_option( 'woocommerce_enable_myaccount_registration' ) !== 'yes' ) {
			$classes .= ' no-registration-form';
			$or_text = '';
		}

		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
		<?php
			echo wp_kses_post( $or_text );
	}
}

if ( ! function_exists( 'electro_wrap_customer_login_form_close' ) ) {
	/**
	 *
	 */
	function electro_wrap_customer_login_form_close() {
		?>
		</div><!-- /.customer-login-form -->
		<?php
	}
}

if ( ! function_exists( 'electro_wrap_track_order' ) ) {
	/**
	 *
	 *
	 */
	function electro_wrap_track_order() {
		?>
		<div class="track-order">
		<?php
	}
}

if ( ! function_exists( 'electro_wrap_track_order_close' ) ) {
	/**
	 *
	 *
	 */
	function electro_wrap_track_order_close() {
		?>
		</div><!-- /.track-order -->
		<?php
	}
}

if ( ! function_exists( 'electro_template_loop_availability' ) ) {
	/**
	 *
	 */
	function electro_template_loop_availability() {

		$availability = apply_filters( 'electro_get_availability', electro_get_availability() );

		if ( ! empty( $availability[ 'availability'] ) ) : ?>

			<div class="availability">
				<?php echo esc_html__( 'Availability:', 'electro' );?> <span class="electro-stock-availability"><p class="stock <?php echo esc_attr( $availability['class'] ); ?>"><?php echo esc_html( $availability['availability'] ); ?></p></span>
			</div>

		<?php endif;
	}
}

if ( ! function_exists( 'electro_get_availability' ) ):
	function electro_get_availability() {
		
		global $product;

		if ( $product->is_type( 'variable' ) ) {

			// Find all stock available variation ids
			$available_variation_ids = array();
			$available_variations = $product->get_available_variations();
			foreach ( $available_variations as $key => $available_variation ) {
				if( $available_variation['is_in_stock'] ) {
					$available_variation_ids[] = $available_variation['variation_id'];
				}
			}

			if( ! empty( $available_variation_ids ) ) {

				// Find default selected variation id
				if( method_exists( $product, 'get_default_attributes' ) ) {
					$default_attributes = $product->get_default_attributes();
				} else {
					$default_attributes = $product->get_variation_default_attributes();
				}

				foreach( $default_attributes as $key => $value ) {
					if( strpos( $key, 'attribute_' ) === 0 ) {
						continue;
					}

					unset( $default_attributes[ $key ] );
					$default_attributes[ sprintf( 'attribute_%s', $key ) ] = $value;
				}

				if( class_exists('WC_Data_Store') ) {
					$data_store = WC_Data_Store::load( 'product' );
					$variation_id = $data_store->find_matching_product_variation( $product, $default_attributes );
				} else {
					$variation_id = $product->get_matching_variation( $default_attributes );
				}

				// Check default selected variation id with availability in loop page
				if( ! is_product() && ! in_array( $variation_id, $available_variation_ids ) ) {
					$variation_id = min( $available_variation_ids );
				} elseif( is_product() && empty( $variation_id ) ) {
					$variation_id = min( $available_variation_ids );
				}

			}
		}

		if( ! empty( $variation_id ) ) {
			$variation    = new WC_Product_Variation( $variation_id );
			$availability = $variation->get_availability();
		} else {
			$availability = $product->get_availability();
		}

		return $availability;
	}
endif;

if ( ! function_exists( 'electro_wc_review_meta' ) ) {
	/**
	 *
	 */
	function electro_wc_review_meta( $comment ) {

		if ( $comment->comment_approved == '0' ) : ?>

			<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'electro' ); ?></em></p>

		<?php else : ?>

			<p class="meta">
				<strong><?php comment_author(); ?></strong> <?php
					if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
						if ( isset( $verified ) && $verified )
							echo '<em class="verified">(' . __( 'verified owner', 'electro' ) . ')</em> ';
				?>&ndash; <time datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
			</p>

		<?php endif;
	}
}

if ( ! function_exists( 'electro_template_loop_rating') ) {
	function electro_template_loop_rating() {
		global $product;

		if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ){
			return;
		}

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
			$rating_html = $product->get_rating_html();
		} else {
			$rating_html = wc_get_rating_html( $product->get_average_rating() );
		}

		if ( $rating_html ) :
		else :
			$rating_html  = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'electro' ), 0 ) . '">';
            $rating_html .= '<span style="width:' . ( ( 0 / 5 ) * 100 ) . '%"><strong class="rating">' . 0 . '</strong> ' . __( 'out of 5', 'electro' ) . '</span>';
            $rating_html .= '</div>';
        endif;
        $review_count = $product->get_review_count();
		?>
		<div class="product-rating">
			<?php echo wp_kses_post( $rating_html ); ?> (<?php echo esc_html( $review_count ); ?>)
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_template_loop_product_excerpt' ) ) {
	/**
	 *
	 */
	function electro_template_loop_product_excerpt() {
		global $post;

		if ( ! is_object( $post ) || ! $post->post_excerpt ) {
			return;
		}

		?>
		<div class="product-short-description">
			<?php
				$product_excerpt = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

				if ( apply_filters( 'electro_esc_excerpt', false ) ) {
					$product_excerpt = esc_html( $product_excerpt );
				}

				echo wp_kses_post( $product_excerpt );
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_template_loop_product_sku' ) ) {
	/**
	 *
	 *
	 */
	function electro_template_loop_product_sku() {
		global $product;

		$sku = $product->get_sku();

		if ( empty( $sku ) ) {
			$sku = 'n/a';
		}

		?>
		<div class="product-sku"><?php echo sprintf( esc_html__( 'SKU: %s', 'electro' ), $sku ); ?></div><?php
	}
}

if ( ! function_exists( 'electro_show_wc_product_images' ) ) {
	function electro_show_wc_product_images() {

		global $post, $product, $woocommerce;

		$post_id = 0;
		if( isset( $post->ID ) ) {
			$post_id = $post->ID;
		} elseif( is_numeric( $post ) ) {
			$post_id = $post;
		}

		echo '<div class="images">';

		if ( has_post_thumbnail() ) {
			$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
			$image         = get_the_post_thumbnail( $post_id, apply_filters( 'electro_single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> get_the_title( get_post_thumbnail_id() )
			) );

			echo apply_filters( 'electro_single_product_image_html', sprintf( '<a href="%s" class="woocommerce-main-image" title="%s">%s</a>', get_the_permalink(), $image_caption, $image ), $post_id );

		} else {

			echo apply_filters( 'electro_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'electro' ) ), $post_id );

		}

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
			$attachment_ids = $product->get_gallery_attachment_ids();
		} else {
			$attachment_ids = $product->get_gallery_image_ids();
		}

		if ( $attachment_ids ) {
			$loop 		= 0;
			$columns 	= apply_filters( 'electro_product_thumbnails_columns', 3 );
			?>
			<div class="thumbnails <?php echo 'columns-' . $columns; ?>"><?php

				foreach ( $attachment_ids as $attachment_id ) {

					if( $loop > 3 ) {
						break;
					}

					$classes = array();

					if ( $loop === 0 || $loop % $columns === 0 )
						$classes[] = 'first';

					if ( ( $loop + 1 ) % $columns === 0 )
						$classes[] = 'last';

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link )
						continue;

					$image_title 	= esc_attr( get_the_title( $attachment_id ) );
					$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'electro_single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
						'title'	=> $image_title,
						'alt'	=> $image_title
						) );

					$image_class = esc_attr( implode( ' ', $classes ) );

					echo apply_filters( 'electro_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', get_the_permalink(), $image_class, $image_caption, $image ), $attachment_id, $post_id, $image_class );

					$loop++;
				}

			?></div>
			<?php
		}

		echo '</div>';
	}
}

if( ! function_exists( 'electro_wc_show_product_thumbnails' ) ) {
	/**
	 *
	 */
	function electro_wc_show_product_thumbnails() {
		global $post, $product;

		$post_id = 0;
		if( isset( $post->ID ) ) {
			$post_id = $post->ID;
		} elseif( is_numeric( $post ) ) {
			$post_id = $post;
		}

		$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
		$post_thumbnail_id = get_post_thumbnail_id( $post_id );
		$attachment_ids    = $product->get_gallery_image_ids();

		if ( count( $attachment_ids ) < 1 ) {
			return;
		}

		$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		$thumbnail_post    = get_post( $post_thumbnail_id );
		$image_title       = $thumbnail_post->post_content;
		$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
		$wrapper_id        = 'electro-wc-product-gallery-' . uniqid();
		$wrapper_classes   = apply_filters( 'electro_wc_single_product_image_gallery_classes', array(
			'electro-wc-product-gallery',
			'electro-wc-product-gallery--' . $placeholder,
			'electro-wc-product-gallery--columns-' . absint( $columns ),
			'images'
		) );
		$carousel_args     = apply_filters( 'electro_wc_product_thumbnails_carousel_args', array(
			'selector'		=> '.electro-wc-product-gallery__wrapper > .electro-wc-product-gallery__image',
			'animation'		=> 'slide',
			'controlNav'	=> true,
			'directionNav'  => false,
			'animationLoop'	=> false,
			'slideshow'		=> false,
			'asNavFor'		=> '.woocommerce-product-gallery',
			'itemMargin'    => 6,
			'itemWidth'     => 90,
		) );
		?>
		<div id="<?php echo esc_attr( $wrapper_id ); ?>" class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
			<figure class="electro-wc-product-gallery__wrapper">
				<?php
				$attributes = array(
					'title'                   => $image_title,
					'data-large-image'        => $full_size_image[0],
					'data-large-image-width'  => $full_size_image[1],
					'data-large-image-height' => $full_size_image[2],
				);

				if ( has_post_thumbnail() ) {
					$html  = '<figure data-thumb="' . get_the_post_thumbnail_url( $post_id, 'shop_thumbnail' ) . '" class="electro-wc-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
					$html .= get_the_post_thumbnail( $post_id, 'shop_thumbnail', $attributes );
					$html .= '</a></figure>';
				} else {
					$html  = '<figure class="electro-wc-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'electro' ) );
					$html .= '</figure>';
				}

				echo apply_filters( 'electro_wc_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post_id ) );

				if ( $attachment_ids ) {
					foreach ( $attachment_ids as $attachment_id ) {
						$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
						$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
						$thumbnail_post   = get_post( $attachment_id );
						$image_title      = $thumbnail_post->post_content;

						$attributes = array(
							'title'                   => $image_title,
							'data-large-image'        => $full_size_image[0],
							'data-large-image-width'  => $full_size_image[1],
							'data-large-image-height' => $full_size_image[2],
						);

						$html  = '<figure data-thumb="' . esc_url( $thumbnail[0] ) . '" class="electro-wc-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
						$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
				 		$html .= '</a></figure>';

						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
					}
				}
				?>
			</figure>
		</div>
		<?php
		$custom_script = "
			jQuery(document).ready( function($){
				var flex = $( '#" . esc_attr( $wrapper_id ) . "' );
				var flex_args = " . json_encode( $carousel_args ) . ";
				flex_args.asNavFor = flex.siblings( flex_args.asNavFor );
				flex.flexslider( flex_args );
			} );
		";
		wp_add_inline_script( 'electro-js', $custom_script );
	}
}

if ( ! function_exists( 'electro_show_product_images' ) ) {
	function electro_show_product_images() {

		if( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) && ! is_yith_zoom_magnifier_activated() ) {
			global $post, $product, $woocommerce;

			$post_id = 0;
			if( isset( $post->ID ) ) {
				$post_id = $post->ID;
			} elseif( is_numeric( $post ) ) {
				$post_id = $post;
			}

			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.7', '<' ) ) {
				$attachment_ids = $product->get_gallery_attachment_ids();
			} else {
				$attachment_ids = $product->get_gallery_image_ids();
			}

			echo '<div class="images electro-gallery">';

			if( count( $attachment_ids ) > 0 ) {
				$gallery = '[product-gallery]';
				if ( has_post_thumbnail() ) {
					$featured_image_id = get_post_thumbnail_id();
					array_unshift( $attachment_ids, $featured_image_id );
				}

				if ( $attachment_ids ) {
					$loop 		= 0;
					?>
					<div class="thumbnails-single owl-carousel"><?php

						foreach ( $attachment_ids as $attachment_id ) {

							$image_link = wp_get_attachment_url( $attachment_id );

							if ( ! $image_link )
								continue;

							$image_title 	= esc_attr( get_the_title( $attachment_id ) );
							$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $attr = array(
								'title'	=> $image_title,
								'alt'	=> $image_title
							) );

							$image_class = 'zoom';

							echo apply_filters( 'electro_single_product_thumbnails_single_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post_id, $image_class );

							$loop++;
						}

					?></div>
					<?php
				}

			} elseif ( has_post_thumbnail() ) {
				$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
				$image         = get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	=> get_the_title( get_post_thumbnail_id() )
				) );

				$gallery = '';

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post_id );

			} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'electro' ) ), $post_id );

			}

			if ( $attachment_ids ) {
				$loop 		= 0;
				$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
					?>
					<div class="thumbnails-all <?php echo 'columns-' . $columns; ?> owl-carousel"><?php

						foreach ( $attachment_ids as $attachment_id ) {

							$classes = array();

							if ( $loop === 0 || $loop % $columns === 0 )
								$classes[] = 'first';

							if ( ( $loop + 1 ) % $columns === 0 )
								$classes[] = 'last';

							$image_link = wp_get_attachment_url( $attachment_id );

							if ( ! $image_link )
								continue;

							$image_title 	= esc_attr( get_the_title( $attachment_id ) );
							$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
								'title'	=> $image_title,
								'alt'	=> $image_title
							) );

							$image_class = esc_attr( implode( ' ', $classes ) );

							echo apply_filters( 'electro_single_product_thumbnails_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post_id, $image_class );

							$loop++;
						}

					?></div>
					<?php
			}

			echo '</div>';
		} else {
			woocommerce_show_product_images();
			if( apply_filters( 'electro_wc_show_product_thumbnails_carousel', false ) ) {
				electro_wc_show_product_thumbnails();
			}
		}
	}
}

if ( ! function_exists( 'electro_wc_single_product_carousel_options' ) ) {
	function electro_wc_single_product_carousel_options( $options ) {
		if( apply_filters( 'electro_wc_show_product_thumbnails_carousel', false ) ) {
			$options['controlNav'] = true;
		}
		return $options;
	}
}

if ( ! function_exists( 'electro_single_product_image_gallery_classes' ) ) {
	function electro_single_product_image_gallery_classes( $args ) {
		if( apply_filters( 'electro_wc_show_product_thumbnails_carousel', false ) ) {
			$args[] = 'electro-carousel-loaded';
		}
		return $args;
	}
}

if ( ! function_exists( 'electro_promoted_products' ) ) {
	/**
	 * Featured and On-Sale Products
	 * Check for featured products then on-sale products and use the appropiate shortcode.
	 * If neither exist, it can fallback to show recently added products.
	 *
	 * @param integer $per_page total products to display.
	 * @param integer $columns columns to arrange products in to.
	 * @param boolean $recent_fallback Should the function display recent products as a fallback when there are no featured or on-sale products?.
	 * @uses  is_woocommerce_activated()
	 * @uses  wc_get_featured_product_ids()
	 * @uses  wc_get_product_ids_on_sale()
	 * @uses  electro_do_shortcode()
	 * @return void
	 */
	function electro_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
		if ( is_woocommerce_activated() ) {
			if ( wc_get_featured_product_ids() ) {
				echo '<section><header><h2 class="h1">' . esc_html__( 'Featured Products', 'electro' ) . '</h2></header>';
				echo electro_do_shortcode( 'featured_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
				echo '</section>';
			} elseif ( wc_get_product_ids_on_sale() ) {
				echo '<section><header><h2 class="h1">' . esc_html__( 'On Sale Now', 'electro' ) . '</h2></header>';
				echo electro_do_shortcode( 'sale_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
				echo '</section>';
			} elseif ( $recent_fallback ) {
				echo '<section><header><h2 class="h1">' . esc_html__( 'New In Store', 'electro' ) . '</h2></header>';
				echo electro_do_shortcode( 'recent_products', array(
											'per_page' => $per_page,
											'columns'  => $columns,
				) );
				echo '</section>';
			}
		}
	}
}

if ( ! function_exists( 'electro_wrap_order_review' ) ) {
	function electro_wrap_order_review() {
		?><div class="order-review-wrapper">
			<h3 id="order_review_heading_v2"><?php _e( 'Your order', 'electro' ); ?></h3><?php
	}
}

if ( ! function_exists( 'electro_wrap_order_review_close' ) ) {
	function electro_wrap_order_review_close() {
		?></div><!-- /.order-review-wrapper --><?php
	}
}

if ( ! function_exists( 'electro_woocommerce_init_structured_data' ) ) {
	/**
	* Generate product category structured data...
	* Hooked into the `woocommerce_before_shop_loop_item` action...
	* Apply the `electro_woocommerce_structured_data` filter hook for structured data customization...
	*/
	function electro_woocommerce_init_structured_data() {
		if ( ! is_product_category() ) {
			return;
		}
		global $product;
		$json['@type']             = 'Product';
		$json['@id']               = 'product-' . get_the_ID();
		$json['name']              = get_the_title();
		$json['image']             = wp_get_attachment_url( $product->get_image_id() );
		$json['description']       = get_the_excerpt();
		$json['url']               = get_the_permalink();
		$json['sku']               = $product->get_sku();
		$json['brand']             = array(
			'@type'                  => 'Thing',
			'name'                   => $product->get_attribute( __( 'brand', 'electro' ) )
			);

		if ( $product->get_rating_count() ) {
			$json['aggregateRating'] = array(
				'@type'                => 'AggregateRating',
				'ratingValue'          => $product->get_average_rating(),
				'ratingCount'          => $product->get_rating_count(),
				'reviewCount'          => $product->get_review_count()
				);
		}

		$json['offers']            = array(
			'@type'                  => 'Offer',
			'priceCurrency'          => get_woocommerce_currency(),
			'price'                  => $product->get_price(),
			'itemCondition'          => 'http://schema.org/NewCondition',
			'availability'           => 'http://schema.org/' . $stock = ( $product->is_in_stock() ? 'InStock' : 'OutOfStock' ),
			'seller'                 => array(
				'@type'                => 'Organization',
				'name'                 => get_bloginfo( 'name' )
				)
			);

		if ( ! isset( $json ) ) {
			return;
		}

		Electro::set_structured_data( apply_filters( 'electro_woocommerce_structured_data', $json ) );
	}
}

require_once get_template_directory() . '/inc/woocommerce/template-tags/header.php';
require_once get_template_directory() . '/inc/woocommerce/template-tags/loop.php';