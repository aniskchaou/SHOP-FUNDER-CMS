<?php
/**
 * Filter functions for Header Section of Theme Options
 */

if ( ! function_exists ( 'redux_toggle_top_bar' ) ) {
	function redux_toggle_top_bar( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_top_bar_show'] ) ) {
			$electro_options['header_top_bar_show'] = true;
		}

		if ( $electro_options['header_top_bar_show'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists ( 'redux_toggle_off_canvas_cart' ) ) {
    function redux_toggle_off_canvas_cart( $enable ) {
        global $electro_options;

        if ( ! isset( $electro_options['off_canvas_cart'] ) ) {
            $electro_options['off_canvas_cart'] = true;
        }

        if ( $electro_options['off_canvas_cart'] ) {
            $enable = false;
        } else {
            $enable = true;
        }

        return ! $enable;
    }
}

if ( ! function_exists ( 'redux_toggle_top_bar_mobile' ) ) {
	function redux_toggle_top_bar_mobile( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_top_bar_show_mobile'] ) ) {
			$electro_options['header_top_bar_show_mobile'] = false;
		}

		if ( $electro_options['header_top_bar_show_mobile'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return ! $enable;
	}
}

if ( ! function_exists ( 'redux_toggle_flex_header' ) ) {
	function redux_toggle_flex_header( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_flex'] ) ) {
			$electro_options['header_flex'] = false;
		}

		if ( $electro_options['header_flex'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return ! $enable;
	}
}

if ( ! function_exists ( 'redux_toggle_live_search' ) ) {
	function redux_toggle_live_search( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_live_search'] ) ) {
			$electro_options['header_live_search'] = true;
		}

		if ( $electro_options['header_live_search'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_header_logo' ) ) {
	function redux_apply_header_logo( $logo ) {
		global $electro_options;

		if ( ! empty( $electro_options['site_header_logo']['url'] ) ) {

			$logo_image_src = $electro_options['site_header_logo']['url'];
			if ( is_ssl() ) {
				$logo_image_src = str_replace( 'http:', 'https:', $logo_image_src );
			}

			ob_start();
			?>
			<div class="header-site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-link">
					<img src="<?php echo esc_url( $logo_image_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="img-header-logo" width="<?php echo esc_attr( $electro_options['site_header_logo']['width'] ); ?>" height="<?php echo esc_attr( $electro_options['site_header_logo']['height'] ); ?>" />
				</a>
			</div>
			<?php
			$logo = ob_get_clean();
		}

		return $logo;
	}
}

if ( ! function_exists( 'redux_apply_logo_image_src' ) ) {
	function redux_apply_logo_image_src( $logo_image_src ) {

		global $electro_options;

		if ( ! empty( $electro_options['site_header_logo']['url'] ) ) {
			$logo_image_src[0] = $electro_options['site_header_logo']['url'];
			if ( is_ssl() ) {
				$logo_image_src[0] = str_replace( 'http:', 'https:', $electro_options['site_header_logo']['url'] );
			}
			$logo_image_src[1] = $electro_options['site_header_logo']['width'];
			$logo_image_src[2] = $electro_options['site_header_logo']['height'];
			$logo_image_src[3] = 'full';
		}

		return $logo_image_src;
	}
}

if ( ! function_exists ( 'redux_toggle_off_canvas_nav_in_desktop' ) ) {
	function redux_toggle_off_canvas_nav_in_desktop( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['off_canvas_nav_in_desktop'] ) ) {
			$electro_options['off_canvas_nav_in_desktop'] = true;
		}

		if ( $electro_options['off_canvas_nav_in_desktop'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return ! $enable;
	}
}

if ( ! function_exists( 'redux_toggle_header_show_tooltip' ) ) {
	function redux_toggle_header_show_tooltip( $show_tooltip ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_show_tooltip'] ) ) {
			$show_tooltip = true;
		} else {
			$show_tooltip = $electro_options['header_show_tooltip'];
		}

		return $show_tooltip;
	}
}

if ( ! function_exists( 'redux_apply_header_tooltip_position' ) ) {
	function redux_apply_header_icon_tooltip_position( $tooltip_position ) {
		global $electro_options;

		if ( isset( $electro_options['header_show_tooltip'] ) ) {
			if ( $electro_options['header_show_tooltip'] == false ) {
				$tooltip_position = false;
			} else {
				if ( isset( $electro_options['header_icon_tooltip_position'] ) ) {
					$tooltip_position = $electro_options['header_icon_tooltip_position'];
				} else {
					$tooltip_position = 'bottom';
				}
			}
		} else {
			$tooltip_position = 'bottom';
		}

		return $tooltip_position;
	}
}

if ( ! function_exists( 'redux_apply_header_style' ) ) {
	function redux_apply_header_style( $header_style ) {
		global $electro_options;

		if ( isset( $electro_options['header_style'] ) ) {
			$header_style = $electro_options['header_style'];
		}

		return $header_style;
	}
}

if ( ! function_exists( 'redux_apply_header_vertical_menu_title' ) ) {
	function redux_apply_header_vertical_menu_title( $title ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_vertical_menu_title'] ) ) {
			$electro_options['header_vertical_menu_title'] = esc_html__( 'All Departments', 'electro' );
		}

		return $electro_options['header_vertical_menu_title'];
	}
}

if ( ! function_exists( 'redux_apply_header_vertical_menu_icon' ) ) {
	function redux_apply_header_vertical_menu_icon( $icon ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_vertical_menu_icon'] ) ) {
			$electro_options['header_vertical_menu_icon'] = 'fa fa-list-ul';
		}

		return $electro_options['header_vertical_menu_icon'];
	}
}

if ( ! function_exists( 'redux_apply_departments_menu_title' ) ) {
	function redux_apply_departments_menu_title( $title ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_departments_menu_title'] ) ) {
			$electro_options['header_departments_menu_title'] = esc_html__( 'Shop by Department', 'electro' );
		}

		return $electro_options['header_departments_menu_title'];
	}
}

if ( ! function_exists( 'redux_apply_header_v5_menu_title' ) ) {
	function redux_apply_header_v5_menu_title( $title ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_v5_departments_menu_title'] ) ) {
			$electro_options['header_v5_departments_menu_title'] = esc_html__( 'All Departments', 'electro' );
		}

		return $electro_options['header_v5_departments_menu_title'];
	}
}

if ( ! function_exists( 'redux_apply_header_v6_menu_title' ) ) {
	function redux_apply_header_v6_menu_title( $title ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_v6_departments_menu_title'] ) ) {
			$electro_options['header_v6_departments_menu_title'] = esc_html__( 'Categories', 'electro' );
		}

		return $electro_options['header_v6_departments_menu_title'];
	}
}

if ( ! function_exists( 'redux_apply_navbar_search_placeholder' ) ) {
	function redux_apply_navbar_search_placeholder( $placeholder ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_navbar_search_placeholder'] ) ) {
			$electro_options['header_navbar_search_placeholder'] = esc_html__( 'Search for products', 'electro' );
		}

		return $electro_options['header_navbar_search_placeholder'];
	}
}

if ( ! function_exists( 'redux_toggle_header_search_dropdown' ) ) {
	function redux_toggle_header_search_dropdown( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['enable_header_navbar_search_dropdown'] ) ) {
			$electro_options['enable_header_navbar_search_dropdown'] = true;
		}

		if ( $electro_options['enable_header_navbar_search_dropdown'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if( ! function_exists( 'redux_modify_search_dropdown_categories_args' ) ) {
	/**
	 * Implements top level or all categories option
	 */
	function redux_modify_search_dropdown_categories_args( $args ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_navbar_search_dropdown_categories'] ) ) {
			$electro_options['header_navbar_search_dropdown_categories'] = 'show_only_top_level';
		}

		if ( $electro_options['header_navbar_search_dropdown_categories'] == 'show_only_top_level' ) {
			$args[ 'hierarchical' ] = 1;
			$args[ 'depth' ] 		= 1;
		} else {
			$args[ 'hierarchical']  = 1;
		}

		return $args;
	}
}

if ( ! function_exists( 'redux_apply_navbar_search_dropdown_text' ) ) {
	function redux_apply_navbar_search_dropdown_text( $title ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_navbar_search_dropdown_text'] ) ) {
			$electro_options['header_navbar_search_dropdown_text'] = esc_html__( 'All Categories', 'electro' );
		}

		return $electro_options['header_navbar_search_dropdown_text'];
	}
}

if ( ! function_exists( 'redux_toggle_header_support_block_1' ) ) {
	function redux_toggle_header_support_block( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_support_block_show'] ) ) {
			$electro_options['header_support_block_show'] = true;
		}

		if ( $electro_options['header_support_block_show'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_header_support_number' ) ) {
	function redux_apply_header_support_number( $support_number ) {
		global $electro_options;

		if( isset( $electro_options['header_support_number'] ) ) {
			$support_number = $electro_options['header_support_number'];
		}

		return $support_number;
	}
}

if ( ! function_exists( 'redux_apply_header_support_email' ) ) {
	function redux_apply_header_support_email( $support_email ) {
		global $electro_options;

		if( isset( $electro_options['header_support_email'] ) ) {
			$support_email = $electro_options['header_support_email'];
		}

		return $support_email;
	}
}

if( ! function_exists( 'redux_toggle_sticky_header' ) ) {
	function redux_toggle_sticky_header() {
		global $electro_options;

		if( isset( $electro_options['sticky_header'] ) && $electro_options['sticky_header'] == '1' ) {
			$sticky_header = true;
		} else {
			$sticky_header = false;
		}

		return $sticky_header;
	}
}

if ( ! function_exists( 'redux_apply_header_cart_icon' ) ) {
	function redux_apply_header_cart_icon( $icon ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_cart_icon'] ) ) {
			$electro_options['header_cart_icon'] = 'ec ec-shopping-bag';
		}

		return $electro_options['header_cart_icon'];
	}
}

if ( ! function_exists( 'redux_toggle_header_cart_dropdown' ) ) {
	function redux_toggle_header_cart_dropdown( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_cart_dropdown_disable'] ) ) {
			$electro_options['header_cart_dropdown_disable'] = false;
		}

		if ( $electro_options['header_cart_dropdown_disable'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_toggle_header_user_account_enable' ) ) {
	function redux_toggle_header_user_account_enable( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options[ 'header_user_account_enable'] ) ) {
			$electro_options['header_user_account_enable'] = false;
		}

		if ( $electro_options['header_user_account_enable'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_header_user_account_icon' ) ) {
	function redux_apply_header_user_account_icon( $icon ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_user_account_icon'] ) ) {
			$electro_options['header_user_account_icon'] = 'ec ec-user';
		}

		return $electro_options['header_user_account_icon'];
	}
}

if ( ! function_exists( 'redux_apply_header_user_account_menu' ) ) {
	function redux_apply_header_user_account_menu( $menu_ID ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_user_account_logged_in_menu'] ) ) {
			$electro_options['header_user_account_logged_in_menu'] = '0';
		}

		return $electro_options['header_user_account_logged_in_menu'];
	}
}

if ( ! function_exists ( 'redux_toggle_top_bar_v3_additional_links' ) ) {
	function redux_toggle_top_bar_v3_additional_links( $enable ) {
		global $electro_options;

		if ( ! isset( $electro_options['header_enable_topbar_additional_links'] ) ) {
			$electro_options['header_enable_topbar_additional_links'] = true;
		}

		if ( $electro_options['header_enable_topbar_additional_links'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_top_bar_v3_additional_links_title' ) ) {
	function redux_apply_top_bar_v3_additional_links_title( $title ) {
		global $electro_options;

		if( isset( $electro_options['header_topbar_additional_links_title'] ) ) {
			$title = $electro_options['header_topbar_additional_links_title'];
		}

		return $title;
	}
}

if ( ! function_exists( 'redux_apply_top_bar_v3_additional_link_1_text' ) ) {
	function redux_apply_top_bar_v3_additional_link_1_text( $text ) {
		global $electro_options;

		if( isset( $electro_options['header_topbar_additional_link_1_text'] ) ) {
			$text = $electro_options['header_topbar_additional_link_1_text'];
		}

		return $text;
	}
}

if ( ! function_exists( 'redux_apply_top_bar_v3_additional_link_1_url' ) ) {
	function redux_apply_top_bar_v3_additional_link_1_url( $url ) {
		global $electro_options;

		if( isset( $electro_options['header_topbar_additional_link_1_url'] ) ) {
			$url = $electro_options['header_topbar_additional_link_1_url'];
		}

		return $url;
	}
}

if ( ! function_exists( 'redux_apply_top_bar_v3_additional_link_1_image' ) ) {
	function redux_apply_top_bar_v3_additional_link_1_image( $image ) {
		global $electro_options;

		if ( isset( $electro_options['header_topbar_additional_link_1_image'] ) && isset( $electro_options['header_topbar_additional_link_1_image']['id'] ) && ! empty( $electro_options['header_topbar_additional_link_1_image']['id'] ) ) {
			$image = $electro_options['header_topbar_additional_link_1_image']['id'];
		}

		return $image;
	}
}

if ( ! function_exists( 'redux_apply_top_bar_v3_additional_link_2_text' ) ) {
	function redux_apply_top_bar_v3_additional_link_2_text( $text ) {
		global $electro_options;

		if( isset( $electro_options['header_topbar_additional_link_2_text'] ) ) {
			$text = $electro_options['header_topbar_additional_link_2_text'];
		}

		return $text;
	}
}

if ( ! function_exists( 'redux_apply_top_bar_v3_additional_link_2_url' ) ) {
	function redux_apply_top_bar_v3_additional_link_2_url( $url ) {
		global $electro_options;

		if( isset( $electro_options['header_topbar_additional_link_2_url'] ) ) {
			$url = $electro_options['header_topbar_additional_link_2_url'];
		}

		return $url;
	}
}

if ( ! function_exists( 'redux_apply_top_bar_v3_additional_link_2_image' ) ) {
	function redux_apply_top_bar_v3_additional_link_2_image( $image ) {
		global $electro_options;

		if ( isset( $electro_options['header_topbar_additional_link_2_image'] ) && isset( $electro_options['header_topbar_additional_link_2_image']['id'] ) && ! empty( $electro_options['header_topbar_additional_link_2_image']['id'] ) ) {
			$image = $electro_options['header_topbar_additional_link_2_image']['id'];
		}

		return $image;
	}
}
