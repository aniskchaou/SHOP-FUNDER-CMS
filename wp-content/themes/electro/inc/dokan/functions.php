<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'electro_dokan_scripts' ) ) {
	function electro_dokan_scripts() {
		global $electro_version;

		if ( apply_filters( 'electro_use_predefined_colors', true ) ) {
			wp_dequeue_style( 'electro-color' );
		}

		// Dequeue Fontawesome
		wp_dequeue_style( 'fontawesome' );
		// wp_dequeue_style( 'dokan-fontawesome' );
		wp_enqueue_style( 'ec-fontawesome', get_template_directory_uri() . '/assets/vendor/fontawesome/css/all.min.css', '', $electro_version );
		wp_enqueue_style( 'ec-fontawesome' );

		wp_enqueue_style( 'electro-dokan-style', get_template_directory_uri() . '/assets/css/dokan.css', '', $electro_version );
		wp_style_add_data( 'electro-dokan-style', 'rtl', 'replace' );

		if ( apply_filters( 'electro_use_predefined_colors', true ) ) {
			$color_css_file = apply_filters( 'electro_primary_color', 'yellow' );
			wp_enqueue_style( 'electro-color', get_template_directory_uri() . '/assets/css/colors/' . $color_css_file . '.min.css', '', $electro_version );
		}

		// Dequeue Bootstrap modaljs
		wp_dequeue_script( 'modaljs' );

		// Dequeue Bootstrap tooltip
		wp_dequeue_script( 'dokan-tooltip' );
	}
}

if( ! function_exists( 'electro_get_dokan_store_sidebar' ) ) {
	function electro_get_dokan_store_sidebar() {
		$store_user   = get_userdata( get_query_var( 'author' ) );
		$store_info   = dokan_get_store_info( $store_user->ID );
		$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';

		if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>
		    <div id="dokan-secondary" class="dokan-clearfix dokan-store-sidebar" role="complementary">
		    	<?php do_action( 'dokan_sidebar_store_widget_area_before', $store_user->data, $store_info ); ?>
		        <div class="dokan-widget-area widget-collapse">
		            <?php
		            if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

		                $args = array(
		                    'before_widget' => '<aside class="widget %s">',
		                    'after_widget'  => '</aside>',
		                    'before_title'  => '<h3 class="widget-title">',
		                    'after_title'   => '</h3>',
		                );

		                if ( class_exists( 'Dokan_Store_Location' ) ) {
		                    the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'electro' ) ), $args );

		                    if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on' ) {
		                        the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'electro' ) ), $args );
		                    }

		                    if ( dokan_get_option( 'store_open_close', 'dokan_general', 'on' ) == 'on' ) {
		                        the_widget( 'Dokan_Store_Open_Close', array( 'title' => __( 'Store Time', 'electro' ) ), $args );
		                    }

		                    if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
		                        the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Vendor', 'electro' ) ), $args );
		                    }
		                }
		            }
		            ?>
		            <?php do_action( 'dokan_sidebar_store_after', $store_user->data, $store_info ); ?>
		        </div>
		        <?php do_action( 'dokan_sidebar_store_widget_area_after', $store_user->data, $store_info ); ?>
		    </div><!-- #secondary .widget-area -->
		<?php
		} else {
			get_sidebar( 'store' );
		}
	}
}

if ( ! function_exists( 'electro_dokan_store_list_sidebar' ) ) {
	function electro_dokan_store_list_sidebar() {
		if( ! electro_is_dokan_store_list_sidebar_enable() ) {
			return;
		}

		?><div id="dokan-secondary" class="dokan-store-list-sidebar" role="complementary"><?php
			dynamic_sidebar( 'sidebar-store' );
		?></div><?php
	}
}

if ( ! function_exists( 'electro_dokan_after_wc_content' ) ) {
	function electro_dokan_after_wc_content() {
		if( ! electro_is_dokan_store_sidebar_enable() ) {
			return;
		}

		if( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {
			electro_get_dokan_store_sidebar();
		}
	}
}

if ( ! function_exists( 'electro_dokan_toggle_shop_sidebar' ) ) {
	function electro_dokan_toggle_shop_sidebar( $has_sidebar ) {
		if( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {
			$has_sidebar = false;
		}

		return $has_sidebar;
	}
}

if ( ! function_exists( 'electro_setup_dokan_sidebars' ) ) {
	/**
	 * Setup Sidebars available in Electro
	 */
	function electro_setup_dokan_sidebars() {
		// Store Sidebar
		register_sidebar( apply_filters( 'electro_register_store_sidebar_args', array(
			'name'          => esc_html__( 'Store Sidebar', 'electro' ),
			'id'            => 'store-sidebar-widgets',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) ) );
	}
}

if( ! function_exists( 'electro_dokan_body_classes' ) ) {
	function electro_dokan_body_classes( $classes ) {
		if( ( function_exists( 'dokan_is_store_listing' ) && dokan_is_store_listing() ) || ( is_object( get_page( get_queried_object_id() ) ) && has_shortcode( get_page( get_queried_object_id() )->post_content, 'dokan-stores' ) ) ) {
			if ( ! empty( electro_is_dokan_electro_store_list_version() ) ) {
				$classes[] = 'dokan-elector-listing-style';
				$classes[] = electro_is_dokan_electro_store_list_version();
			}

			if( electro_is_dokan_store_list_sidebar_enable() ) {
				$classes[] = 'has-sidebar';
			}
		} elseif( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {
			$layout = electro_get_blog_layout();
			if( ( $key = array_search( $layout, $classes ) ) !== false ) {
				unset($classes[$key]);
			}

			if( electro_is_dokan_store_sidebar_enable() ) {
				$classes[] = apply_filters( 'electro_dokan_sidebar_layout_class', 'left-sidebar' );
			}

			if ( electro_is_dokan_electro_store_style() ) {
				$classes[] = 'dokan-elector-style-active';
				$classes[] = electro_get_dokan_store_version();
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'electro_dokan_product_edit_add_specifications' ) ) {
	function electro_dokan_product_edit_add_specifications( $post, $post_id ) {
		?>
		<div class="dokan-product-specifications dokan-edit-row">
			<div class="dokan-section-heading" data-togglehandler="dokan_product_specifications">
				<h2><i class="fa fa-cog" aria-hidden="true"></i> <?php _e( 'Specifications', 'electro' ); ?></h2>
				<p><?php _e( 'Manage specifications for this product.', 'electro' ); ?></p>
				<a href="#" class="dokan-section-toggle">
					<i class="fa fa-sort-desc fa-flip-vertical" aria-hidden="true"></i>
				</a>
				<div class="dokan-clearfix"></div>
			</div>

			<div class="dokan-section-content">

				<?php
					$display_attributes = get_post_meta( $post_id, '_specifications_display_attributes', true );
					$specifications = get_post_meta( $post_id, '_specifications', true );
				?>

				<div class="content-half-part dokan-form-group">
					<label class="" for="_specifications_display_attributes">
						<input name="_specifications_display_attributes" id="_specifications_display_attributes" value="yes" type="checkbox" <?php checked( $display_attributes, 'yes' ); ?>>
						<?php esc_html_e( 'Display Attributes', 'electro' ) ?>
					</label>
				</div>

				<div class="content-half-part dokan-form-group">
					<label for="_specifications_attributes_title" class="form-label"><?php esc_html_e( 'Attributes Title', 'electro' ); ?></label>
					<?php dokan_post_input_box( $post_id, '_specifications_attributes_title' ); ?>
				</div>

				<div class="dokan-clearfix"></div>

				<?php wp_editor( htmlspecialchars_decode( $specifications ) , '_specifications', array('editor_height' => 50, 'quicktags' => true, 'media_buttons' => false, 'teeny' => true, 'editor_class' => 'post_content') ); ?>

			</div><!-- .dokan-side-right -->
		</div><!-- .dokan-product-specifications -->
		<?php
	}
}

if ( ! function_exists( 'electro_is_dokan_electro_store_list_version' ) ) {
	function electro_is_dokan_electro_store_list_version() {
		return apply_filters( 'electro_is_dokan_electro_store_list_version', '' );
	}
}


if ( ! function_exists( 'electro_is_dokan_electro_store_style' ) ) {
	/**
	 * Option to toggle dokan-electro-store-styles
	 */
	function electro_is_dokan_electro_store_style() {
		return apply_filters( 'electro_is_dokan_electro_store_style', true );
	}
}

if ( ! function_exists( 'electro_get_dokan_store_version' ) ) {
	function electro_get_dokan_store_version() {
		return apply_filters( 'electro_dokan_store_version', 'store-v1' );
	}
}

if ( ! function_exists( 'electro_is_dokan_store_sidebar_enable' ) ) {
	function electro_is_dokan_store_sidebar_enable() {
		if( electro_is_dokan_electro_store_style() && electro_get_dokan_store_version() === 'store-v1' ) {
			return apply_filters( 'electro_is_dokan_store_sidebar_enable', false );
		} else {
			return true;
		}
	}
}

if ( ! function_exists( 'electro_is_dokan_store_list_sidebar_enable' ) ) {
	function electro_is_dokan_store_list_sidebar_enable() {

		if( ( ( function_exists( 'dokan_is_store_listing' ) && dokan_is_store_listing() ) || ( is_object( get_page( get_queried_object_id() ) ) && has_shortcode( get_page( get_queried_object_id() )->post_content, 'dokan-stores' ) ) ) && is_active_sidebar( 'sidebar-store' ) && ( electro_is_dokan_electro_store_list_version() === 'style-v5' ) ) {
			return apply_filters( 'electro_is_dokan_store_list_sidebar_enable', true );
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'electro_dokan_vendor_page_modify_hooks' ) ) {
	function electro_dokan_vendor_page_modify_hooks() {
		if( electro_is_dokan_electro_store_style() ) {
			$store_version = electro_get_dokan_store_version();
			add_action( 'woocommerce_before_main_content', 'electro_dokan_store_jumbotron', 10 );
			add_action( 'dokan_store_product_loop_before', 'electro_wc_loop_title', 10 );
			add_action( 'dokan_store_product_loop_before', 'electro_dokan_vendor_control_bar', 20 );

			if( $store_version === 'store-v1' ) {
				remove_action( 'woocommerce_after_main_content', 'electro_dokan_after_wc_content', 11 );
				add_action( 'woocommerce_after_main_content', 'electro_dokan_after_wc_content', 5 );
				add_action( 'dokan_after_store_tabs', 'electro_dokan_vendor_product_search', 100 );
				add_action( 'dokan_store_product_loop_before', 'electro_wc_loop_title', 10 );
				add_action( 'dokan_store_product_loop_before', 'electro_dokan_vendor_control_bar', 20 );
			} elseif( $store_version === 'store-v3' ) {
				remove_action( 'woocommerce_before_main_content', 'electro_dokan_store_jumbotron', 10 );
				add_action( 'dokan_store_profile_frame_after', 'electro_dokan_store_jumbotron', 10 );
			} elseif( $store_version === 'store-v4' ) {
				add_action( 'dokan_sidebar_store_widget_area_before', 'electro_dokan_sidebar_header', 10 );
			} elseif( $store_version === 'store-v5' ) {
				remove_action( 'woocommerce_before_main_content', 'electro_dokan_store_jumbotron', 10 );
				add_action( 'woocommerce_before_main_content', 'electro_dokan_store_jumbotron', 5 );
				add_action( 'dokan_after_store_tabs', 'electro_dokan_vendor_product_search', 100 );

				if( electro_dokan_store_share_exists() ) {
					if( version_compare( dokan_pro()->version, '3.0.0' , '<' ) ) {
	                    electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Pro_Store_Share', 'render_share_button' , 1 );
	                } else {
	                    electro_remove_class_action( 'dokan_after_store_tabs', 'WeDevs\DokanPro\StoreShare', 'render_share_button' , 1 );
	                }
				}
			}
		}
	}
}

if ( ! function_exists( 'electro_dokan_follow_store_button_label_follow' ) ) {
	function electro_dokan_follow_store_button_label_follow( $label ) {
		return __( 'Join to my followers', 'electro' );
	}
}

if ( ! function_exists( 'electro_dokan_follow_store_button_label_following' ) ) {
	function electro_dokan_follow_store_button_label_following( $label ) {
		return __( 'Joined', 'electro' );
	}
}

if ( ! function_exists( 'electro_dokan_follow_store_button_label_unfollow' ) ) {
	function electro_dokan_follow_store_button_label_unfollow( $label ) {
		return __( 'Disjoin', 'electro' );
	}
}

if ( ! function_exists( 'electro_dokan_vendor_product_search' ) ) {
	function electro_dokan_vendor_product_search( $store_id ) {
		if( is_rtl() ) {
			$dir_value = 'rtl';
		} else {
			$dir_value = 'ltr';
		}

		$navbar_search_text = apply_filters( 'electro_vendor_search_placeholder', esc_html__( 'Search this Store', 'electro' ) );
		?>
		<li class="dokan-vendor-products-search-wrap">
			<form class="vendor-products-search" method="get" action="<?php echo dokan_get_store_url( $store_id ); ?>" autocomplete="off">
				<label class="sr-only screen-reader-text" for="search">
					<?php echo esc_html__( 'Search for:', 'electro' );?>
				</label>
				<div class="dokan-vendor-product-search-fields">
		    		<input type="text" id="search" class="form-control search-field vendor-products-search-field product-search-field" dir="<?php echo esc_attr( $dir_value ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php echo esc_attr( $navbar_search_text ); ?>" autocomplete="off" />
		    		<input type="hidden" name="paged" value="1" />
					<button type="submit" class="vendor-products-search-submit-btn">
						<i class="ec ec-search"></i>
					</button>
				</div>
			</form>
		</li>
		<?php
	}
}

if ( ! function_exists( 'electro_dokan_vendor_control_bar' ) ) {
	function electro_dokan_vendor_control_bar( $store_user ) {
		$store_id = $store_user->ID;
		?>
		<div class="shop-control-bar">
			<?php
			electro_shop_view_switcher();
			$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
			$catalog_orderby_options = apply_filters(
				'woocommerce_catalog_orderby',
				array(
					'menu_order' => __( 'Default sorting', 'electro' ),
					'popularity' => __( 'Sort by popularity', 'electro' ),
					'rating'     => __( 'Sort by average rating', 'electro' ),
					'date'       => __( 'Sort by latest', 'electro' ),
					'price'      => __( 'Sort by price: low to high', 'electro' ),
					'price-desc' => __( 'Sort by price: high to low', 'electro' ),
				)
			);

			$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
			$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

			if ( wc_get_loop_prop( 'is_search' ) ) {
				$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'electro' ) ), $catalog_orderby_options );

				unset( $catalog_orderby_options['menu_order'] );
			}

			if ( ! $show_default_orderby ) {
				unset( $catalog_orderby_options['menu_order'] );
			}

			if ( ! wc_review_ratings_enabled() ) {
				unset( $catalog_orderby_options['rating'] );
			}

			if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
				$orderby = current( array_keys( $catalog_orderby_options ) );
			}

			?>
			<form class="woocommerce-ordering" method="get">
				<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Seller Items order', 'electro' ); ?>">
					<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
					<?php endforeach; ?>
				</select>
				<input type="hidden" name="author" value="<?php echo esc_attr( $store_id ); ?>" />
				<input type="hidden" name="post_type" value="product" />
				<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
			</form>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_dokan_sidebar_header' ) ) {
	function electro_dokan_sidebar_header() {
		dokan_get_template_part( 'store-header' );
	}
}

if ( ! function_exists( 'electro_dokan_store_jumbotron' ) ) {
	function electro_dokan_store_jumbotron() {
		if( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {
			$static_block_id = apply_filters( 'electro_dokan_store_top_jumbotron_id', '' );
		}

		if( ! empty( $static_block_id ) ) {
            if ( is_elementor_activated() ) {
                $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $static_block_id );
            }

            if( empty( $content ) ) {
                $static_block = get_post( $static_block_id );
                $content = do_shortcode( $static_block->post_content );
            }

            echo '<div class="dokan-store-top-jumbotron">' . $content . '</div>';
        }
	}
}

if ( ! function_exists( 'electro_dokan_store_owner_info' ) ) {
	function electro_dokan_store_owner_info( $store_user_data ) {
		if( apply_filters( 'electro_is_dokan_store_owner_info_enable', true ) ) {
			?>
			<div class="widget-store-owner">
				<div class="store-owner-title">
					<h3 class="widget-title"><?php echo apply_filters( 'electro_dokan_store_owner_info_title', esc_html__( 'Owner of Store', 'electro' ) ) ?></h3>
				</div>
				<div class="store-owner-info">
					<div class="store-owner-profile">
						<div class="store-owner-avatar">
							<?php echo get_avatar( $store_user_data->ID ); ?>
						</div>
						<div class="store-owner-profile-info">
							<h5 class="owner-name"><?php echo esc_html( $store_user_data->display_name ); ?></h5>
							<div class="owner-joined"><?php printf( esc_html__( 'Since %s', 'electro' ), date( "d M Y", strtotime( $store_user_data->user_registered ) ) ); ?></div>
						</div>
					</div>
					<div class="store-owner-bio">
						<?php echo get_the_author_meta( 'description', $store_user_data->ID ); ?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'electro_dokan_store_support_exists' ) ) {
	function electro_dokan_store_support_exists() {
		if( is_dokan_pro_activated() ) {
			$dokan_pro = dokan_pro();
			if( version_compare( $dokan_pro->version, '3.0.0' , '<' ) && class_exists( 'Dokan_Store_Support' ) ) {
				return true;
			} elseif( $dokan_pro->module->is_active( 'store_support' ) ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'electro_dokan_store_follow_exists' ) ) {
	function electro_dokan_store_follow_exists() {
		if( is_dokan_pro_activated() ) {
			$dokan_pro = dokan_pro();
			if( version_compare( $dokan_pro->version, '3.0.0' , '<' ) && class_exists( 'Dokan_Follow_Store_Follow_Button' ) ) {
				return true;
			} elseif( $dokan_pro->module->is_active( 'follow_store' ) ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'electro_dokan_store_share_exists' ) ) {
	function electro_dokan_store_share_exists() {
		if( is_dokan_pro_activated() ) {
			$dokan_pro = dokan_pro();
			if( ! version_compare( $dokan_pro->version, '3.0.0' , '<' ) && isset( $dokan_pro->store_share ) && ! empty( $dokan_pro->store_share ) ) {
				return true;
			} elseif( version_compare( $dokan_pro->version, '3.0.0' , '<' ) && class_exists( 'Dokan_Pro_Store_Share' ) ) {
				return true;
			}
		}
		return false;
	}
}
