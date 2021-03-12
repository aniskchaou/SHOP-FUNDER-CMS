<?php
/**
 * Theme functions and template tags used in navbar
 */

if ( ! function_exists( 'electro_navbar' ) ) {
	/**
	 * Displays electro navbar
	 */
	function electro_navbar() {

		if ( apply_filters( 'show_electro_navbar', true ) ) : ?>
		<nav class="navbar navbar-primary navbar-full stick-this <?php echo has_electro_mobile_header() ? 'hidden-md-down' : ''; ?>">
			<div class="container">
				<?php
				/**
				 * @hooked electro_departments_menu - 10
				 * @hooked electro_navbar_products_search - 20
				 * @hooked electro_navbar_compare - 30
				 * @hooked electro_navbar_wishlist - 40
				 * @hooked electro_navbar_mini_cart - 50
				 */
				do_action( 'electro_navbar' );
				?>
			</div>
		</nav>
		<?php
		endif;
	}
}

if ( ! function_exists( 'electro_departments_menu' ) ) {
	/**
	 * Displays Departments Menu
	 */
	function electro_departments_menu() {
		?>
		<ul class="nav navbar-nav departments-menu animate-dropdown">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle">
					<?php echo apply_filters( 'electro_departments_menu_title', esc_html__( 'Shop by Department', 'electro' ) ); ?>
				</a>
				<?php
					wp_nav_menu( array(
					'theme_location'	=> 'departments-menu',
					'container'			=> false,
					'menu_class'		=> 'dropdown-menu yamm departments-menu-dropdown',
					'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					'walker'            => new wp_bootstrap_navwalker()
				) );
				?>
			</li>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'electro_navbar_search' ) ) {
	/**
	 * Displays search box in navbar
	 */
	function electro_navbar_search() {
		if ( ! apply_filters( 'electro_use_third_party_navbar_search', false ) ) {
			electro_get_template( 'sections/navbar-search.php' );	
		} else {
			do_action( 'electro_navbar_search_third_party' );
		}
	}
}

if ( ! function_exists( 'electro_navbar_compare' ) ) {
	/**
	 * Displays a link to compare page in navbar
	 */
	function electro_navbar_compare() {
		if( function_exists( 'electro_get_compare_page_url' ) ) {
			global $yith_woocompare;
			?>
			<ul class="navbar-compare nav navbar-nav pull-right flip">
				<li class="nav-item">
					<a href="<?php echo esc_attr( electro_get_compare_page_url() ); ?>" class="nav-link">
						<i class="<?php echo esc_attr( apply_filters( 'electro_compare_icon', 'ec ec-compare' ) ); ?>"></i>
						<?php if ( apply_filters( 'electro_show_compare_count', false ) ) : ?>
						<span class="navbar-compare-count count" class="value"><?php echo count( $yith_woocompare->obj->products_list ); ?></span>
						<?php endif; ?>
					</a>
				</li>
			</ul>
			<?php
		}
	}
}

if ( ! function_exists( 'electro_navbar_wishlist' ) ) {
	/**
	 * Displays a link to wishlist page in navbar
	 */
	function electro_navbar_wishlist() {
		if( function_exists( 'electro_get_wishlist_url' ) ) {
			?>
			<ul class="navbar-wishlist nav navbar-nav pull-right flip">
				<li class="nav-item">
					<a href="<?php echo esc_attr( electro_get_wishlist_url() ); ?>" class="nav-link">
						<i class="<?php echo esc_attr( apply_filters( 'electro_wishlist_icon', 'ec ec-favorites' ) ); ?>"></i>
						<?php if ( apply_filters( 'electro_show_wishlist_count', false ) ) : ?>
						<span class="navbar-wishlist-count count" class="value"><?php echo yith_wcwl_count_products(); ?></span> 
						<?php endif; ?>
					</a>
				</li>
			</ul>
			<?php
		}
	}
}
