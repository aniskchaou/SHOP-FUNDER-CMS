<?php
/**
 * Filter functions for Shop Section of Theme Options
 */

if( ! function_exists( 'redux_toggle_shop_catalog_mode' ) ) {
	function redux_toggle_shop_catalog_mode() {
		global $electro_options;

		if( isset( $electro_options['catalog_mode'] ) && $electro_options['catalog_mode'] == '1' ) {
			$catalog_mode = true;
		} else {
			$catalog_mode = false;
		}

		return $catalog_mode;
	}
}

if ( ! function_exists ( 'redux_toggle_wc_template_loop_sale' ) ) {
    function redux_toggle_wc_template_loop_sale( $enable ) {
        global $electro_options;

        if ( ! isset( $electro_options['wc_template_loop_sale'] ) ) {
            $electro_options['wc_template_loop_sale'] = true;
        }

        if ( $electro_options['wc_template_loop_sale'] ) {
            $enable = false;
        } else {
            $enable = true;
        }

        return ! $enable;
    }
}

function redux_apply_catalog_mode_for_product_loop( $product_link, $product ) {
	global $electro_options;

	$product_id = electro_wc_get_product_id( $product );
	$product_type = electro_wc_get_product_type( $product );

	if( isset( $electro_options['catalog_mode'] ) && $electro_options['catalog_mode'] == '1' ) {
		$product_link = sprintf( '<a href="%s" class="button product_type_%s">%s</a>',
			get_permalink( $product_id ),
			esc_attr( $product_type ),
			apply_filters( 'electro_catalog_mode_button_text', esc_html__( 'View Product', 'electro' ) )
		);
	}

	return $product_link;
}

if( ! function_exists( 'redux_apply_product_brand_taxonomy' ) ) {
	function redux_apply_product_brand_taxonomy( $brand_taxonomy ) {
		global $electro_options;

		if( isset( $electro_options['product_brand_taxonomy'] ) ) {
			$brand_taxonomy = $electro_options['product_brand_taxonomy'];
		}

		return $brand_taxonomy;
	}
}

if( ! function_exists( 'redux_apply_product_comparison_page_id' ) ) {
	function redux_apply_product_comparison_page_id( $compare_page_id ) {
		global $electro_options;

		if( isset( $electro_options['compare_page_id'] ) ) {
			$compare_page_id = $electro_options['compare_page_id'];
		}

		return $compare_page_id;
	}
}

if( ! function_exists( 'redux_apply_shop_jumbotron_id' ) ) {
	function redux_apply_shop_jumbotron_id( $static_block_id ) {
		global $electro_options;

		if( isset( $electro_options['shop_jumbotron_id'] ) ) {
			$static_block_id = $electro_options['shop_jumbotron_id'];
		}

		return $static_block_id;
	}
}

if( ! function_exists( 'redux_apply_shop_bottom_jumbotron_id' ) ) {
	function redux_apply_shop_bottom_jumbotron_id( $static_block_id ) {
		global $electro_options;

		if( isset( $electro_options['shop_jumbotron_bottom_id'] ) ) {
			$static_block_id = $electro_options['shop_jumbotron_bottom_id'];
		}

		return $static_block_id;
	}
}

if ( ! function_exists( 'redux_apply_shop_loop_subcategories_columns' ) ) {
	function redux_apply_shop_loop_subcategories_columns( $columns ) {
		global $electro_options;

		if( isset( $electro_options['subcategory_columns'] ) ) {
			$columns = $electro_options['subcategory_columns'];
		}

		return $columns;
	}
}

if ( ! function_exists( 'redux_apply_shop_loop_products_columns' ) ) {
	function redux_apply_shop_loop_products_columns( $columns ) {
		global $electro_options;

		if( isset( $electro_options['product_columns'] ) ) {
			$columns = $electro_options['product_columns'];
		}

		return $columns;
	}
}

if ( ! function_exists( 'redux_apply_shop_loop_products_columns_wide' ) ) {
	function redux_apply_shop_loop_products_columns_wide( $columns_wide ) {
		global $electro_options;

		if( isset( $electro_options['product_columns_wide'] ) ) {
			$columns_wide = $electro_options['product_columns_wide'];
		}

		return $columns_wide;
	}
}

if ( ! function_exists( 'redux_apply_shop_loop_per_page' ) ) {
	function redux_apply_shop_loop_per_page( $per_page ) {
		global $electro_options;

		if( isset( $electro_options['products_per_page'] ) ) {
			$per_page = $electro_options['products_per_page'];
		}

		return $per_page;
	}
}

if ( ! function_exists( 'redux_set_shop_view_args' ) ) {
	function redux_set_shop_view_args( $shop_view_args ) {
		global $electro_options;

		if ( isset( $electro_options['product_archive_enabled_views'] ) ) {
			$shop_views = $electro_options['product_archive_enabled_views']['enabled'];

			if ( $shop_views ) {
				$new_shop_view_args = array();
				$count = 0;

				foreach( $shop_views as $key => $shop_view ) {

					if ( isset( $shop_view_args[ $key ] ) ) {
						$new_shop_view_args[ $key ] = $shop_view_args[ $key ];

						if ( 0 == $count ) {
							$new_shop_view_args[ $key ]['active'] = true;
						} else {
							$new_shop_view_args[ $key ]['active'] = false;
						}

						$count++;
					}
				}

				return $new_shop_view_args;
			}
		}

		return $shop_view_args;
	}
}

if ( ! function_exists( 'redux_apply_shop_layout' ) ) {
	function redux_apply_shop_layout( $shop_layout ) {
		global $electro_options;

		if( isset( $electro_options['shop_layout'] ) ) {
			$shop_layout = $electro_options['shop_layout'];
		}

		return $shop_layout;
	}
}

if ( ! function_exists( 'redux_apply_single_product_layout' ) ) {
	function redux_apply_single_product_layout( $single_product_layout ) {
		global $electro_options;

		if( isset( $electro_options['single_product_layout'] ) ) {
			$single_product_layout = $electro_options['single_product_layout'];
		}

		return $single_product_layout;
	}
}

if ( ! function_exists( 'redux_toggle_single_product_sidebar' ) ) {
	function redux_toggle_single_product_sidebar( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['enable_single_product_sidebar'] ) ) {
			$electro_options['enable_single_product_sidebar'] = false;
		}

		if ( $electro_options['enable_single_product_sidebar'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_toggle_related_products_output' ) ) {
	function redux_toggle_related_products_output( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['enable_related_products'] ) ) {
			$electro_options['enable_related_products'] = true;
		}

		if ( $electro_options['enable_related_products'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_toggle_single_product_timer' ) ) {
	function redux_toggle_single_product_timer( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['single_product_timer'] ) ) {
			$electro_options['single_product_timer'] = true;
		}

		if ( $electro_options['single_product_timer'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_single_product_layout_style' ) ) {
	function redux_apply_single_product_layout_style( $single_product_style ) {
		global $electro_options;

		if( isset( $electro_options['single_product_style'] ) ) {
			$single_product_style = $electro_options['single_product_style'];
		}

		return $single_product_style;
	}
}

if ( ! function_exists( 'redux_toggle_wc_product_thumbnails_carousel' ) ) {
	function redux_toggle_wc_product_thumbnails_carousel() {
		global $electro_options;

		if( isset( $electro_options['product_gallery_carousel'] ) && $electro_options['product_gallery_carousel'] == '1' ) {
			$gallery_carousel = true;
		} else {
			$gallery_carousel = false;
		}

		return $gallery_carousel;
	}
}

if ( ! function_exists( 'redux_apply_sticky_add_to_cart_mobile' ) ) {
	function redux_apply_sticky_add_to_cart_mobile( $body_classes ) {
		global $electro_options;

		if ( isset( $electro_options['sticky_add_to_cart_mobile'] ) && $electro_options['sticky_add_to_cart_mobile'] == '1' ) {
			$body_classes[] = 'sticky-single-add-to-cart-mobile';
		}

		return $body_classes;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_before_login_text' ) ) {
	function redux_apply_myaccount_before_login_text( $before_login_text ) {
		global $electro_options;

		if ( isset( $electro_options['myaccount_before_login_text'] ) ) {
			$before_login_text = $electro_options['myaccount_before_login_text'];
		}

		return $before_login_text;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_before_register_text' ) ) {
	function redux_apply_myaccount_before_register_text( $before_register_text ) {
		global $electro_options;

		if ( isset( $electro_options['myaccount_before_register_text'] ) ) {
			$before_register_text = $electro_options['myaccount_before_register_text'];
		}

		return $before_register_text;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_register_benefits_title' ) ) {
	function redux_apply_myaccount_register_benefits_title( $register_benefits_title ) {
		global $electro_options;

		if ( isset( $electro_options['myaccount_register_benefits_title'] ) ) {
			$register_benefits_title = $electro_options['myaccount_register_benefits_title'];
		}

		return $register_benefits_title;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_register_benefits' ) ) {
	function redux_apply_myaccount_register_benefits( $benefits ) {
		global $electro_options;

		if ( isset( $electro_options['myaccount_register_benefits'] ) ) {
			if ( is_array( $electro_options['myaccount_register_benefits'] ) ) {
				$benefits = $electro_options['myaccount_register_benefits'];
			} else {
				$benefits = array();
			}
		}

		return $benefits;
	}
}

if ( ! function_exists( 'redux_apply_dokan_electro_store_list_version' ) ) {
	function redux_apply_dokan_electro_store_list_version( $dokan_store_list_version ) {
		global $electro_options;

		if( isset( $electro_options['dokan_store_list_version'] ) && !empty( $electro_options['dokan_store_list_version'] ) ) {
			$dokan_store_list_version = $electro_options['dokan_store_list_version'];
		}

		return $dokan_store_list_version;
	}
}

if( ! function_exists( 'redux_toggle_dokan_store_list_sidebar' ) ) {
	function redux_toggle_dokan_store_list_sidebar( $dokan_store_list_sidebar ) {
		global $electro_options;

		if( isset( $electro_options['dokan_store_list_sidebar'] ) && $electro_options['dokan_store_list_sidebar'] == '1' ) {
			$dokan_store_list_sidebar = true;
		} else {
			$dokan_store_list_sidebar = false;
		}

		return $dokan_store_list_sidebar;
	}
}

if( ! function_exists( 'redux_toggle_dokan_electro_store_style' ) ) {
	function redux_toggle_dokan_electro_store_style( $dokan_electro_store_style ) {
		global $electro_options;

		if( isset( $electro_options['dokan_electro_store_style'] ) && $electro_options['dokan_electro_store_style'] == '1' ) {
			$dokan_electro_store_style = true;
		} else {
			$dokan_electro_store_style = false;
		}

		return $dokan_electro_store_style;
	}
}

if ( ! function_exists( 'redux_apply_dokan_store_version' ) ) {
	function redux_apply_dokan_store_version( $dokan_store_version ) {
		global $electro_options;

		if( isset( $electro_options['dokan_store_version'] ) && !empty( $electro_options['dokan_store_version'] ) ) {
			$dokan_store_version = $electro_options['dokan_store_version'];
		} else {
			$dokan_store_version = 'store-v1';
		}

		return $dokan_store_version;
	}
}

if( ! function_exists( 'redux_toggle_dokan_store_sidebar' ) ) {
	function redux_toggle_dokan_store_sidebar( $dokan_store_sidebar ) {
		global $electro_options;

		if( isset( $electro_options['dokan_store_sidebar'] ) && $electro_options['dokan_store_sidebar'] == '1' ) {
			$dokan_store_sidebar = true;
		} else {
			$dokan_store_sidebar = false;
		}

		return $dokan_store_sidebar;
	}
}

if( ! function_exists( 'redux_toggle_dokan_store_owner_info' ) ) {
	function redux_toggle_dokan_store_owner_info( $dokan_store_owner_info ) {
		global $electro_options;

		if( isset( $electro_options['dokan_store_owner_info'] ) && $electro_options['dokan_store_owner_info'] == '1' ) {
			$dokan_store_owner_info = true;
		} else {
			$dokan_store_owner_info = false;
		}

		return $dokan_store_owner_info;
	}
}

if ( ! function_exists( 'redux_apply_dokan_store_top_jumbotron_id' ) ) {
	function redux_apply_dokan_store_top_jumbotron_id( $static_block_id ) {
		global $electro_options;

		if( isset( $electro_options['dokan_store_top_jumbotron_id'] ) && !empty( $electro_options['dokan_store_top_jumbotron_id'] ) ) {
			$static_block_id = $electro_options['dokan_store_top_jumbotron_id'];
		}

		return $static_block_id;
	}
}