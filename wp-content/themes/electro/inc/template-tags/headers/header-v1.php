<?php
/**
 * Header template functions used in header v1
 *
 * @since 2.0
 */

if ( ! function_exists( 'electro_navigation' ) ) {
    /**
     * @since 2.0
     */
    function electro_navigation() {
        ?><div class="electro-navigation <?php if ( ( is_front_page() && ! is_home() ) || is_page_template( 'template-homepage-v1.php' ) || is_page_template( 'template-homepage-v10.php' ) ) : ?>yes-home<?php endif; ?>">
            <?php
            do_action( 'electro_navigation' ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'electro_departments_menu_v2' ) ) {
    /**
     * @since 2.0
     */
    function electro_departments_menu_v2() {

        $calling_action = current_filter();

        if ( 'electro_navbar_v2' === $calling_action ) {

            $theme_location = 'departments-menu';
            $menu_title     = apply_filters( 'electro_departments_menu_title', esc_html__( 'Shop by Department', 'electro' ) );
            $menu_icon      = apply_filters( 'electro_departments_menu_icon', 'ec ec-arrow-down-search' );
            $menu_title     = $menu_title . '<i class="departments-menu-v2-icon ' . esc_attr( $menu_icon ) . '"></i>';

        } elseif( 'electro_navigation_v5' === $calling_action ) {

            $theme_location = 'all-departments-menu';
            $menu_title     = apply_filters( 'electro_header_v5_menu_title', esc_html__( 'All Departments', 'electro' ) );
            $menu_icon      = apply_filters( 'electro_header_v5_menu_icon', 'ec ec-arrow-down-search' );
            $menu_title     = $menu_title . '<i class="departments-menu-v2-icon ' . esc_attr( $menu_icon ) . '"></i>';

        } elseif( 'electro_header_logo_area' === $calling_action ) {

            $theme_location = 'all-departments-menu';
            $menu_title     = apply_filters( 'electro_header_v6_menu_title', esc_html__( 'Categories', 'electro' ) );
            $menu_icon      = apply_filters( 'electro_header_v6_menu_icon', 'ec ec-arrow-down-search' );
            $menu_title     = $menu_title . '<i class="departments-menu-v2-icon ' . esc_attr( $menu_icon ) . '"></i>';

        } else {

            $theme_location = 'all-departments-menu';
            $menu_title     = apply_filters( 'electro_vertical_menu_title', wp_kses_post( 'All Departments', 'electro' ) );
            $menu_icon      = apply_filters( 'electro_vertical_menu_icon', 'fa fa-list-ul' );
            $menu_title     = '<i class="departments-menu-v2-icon ' . esc_attr( $menu_icon ) . '"></i>' . $menu_title;
        }

        $enable_dropdown = true;

        if ( is_page_template( 'template-homepage-v1.php' ) || is_page_template( 'template-homepage-v2.php' ) || is_page_template( 'template-homepage-v10.php' ) ) {
            $enable_dropdown = false;
        }

        $enable_dropdown = apply_filters( 'electro_departments_menu_v2_enable_dropdown', $enable_dropdown );

        ?><div class="departments-menu-v2">
            <div class="dropdown <?php if ( ! $enable_dropdown ):?>show-dropdown<?php endif; ?>">
                <a href="#" class="departments-menu-v2-title" <?php if ( $enable_dropdown ) : ?>data-toggle="dropdown"<?php endif; ?>>
                    <span><?php echo wp_kses_post( $menu_title ); ?></span>
                </a>
                <?php
                    wp_nav_menu( array(
                        'theme_location'    => $theme_location,
                        'container'         => false,
                        'menu_class'        => 'dropdown-menu yamm',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker(),
                    ) );
                ?>
            </div>
        </div><?php
    }
}

if ( ! function_exists( 'electro_secondary_nav_menu' ) ) {
    /**
     * @since 2.0
     */
    function electro_secondary_nav_menu() {
        ?>
        <div class="secondary-nav-menu electro-animate-dropdown">
        <?php
            wp_nav_menu( apply_filters( 'electro_secondary_menu_args', array(
                'theme_location'    => 'secondary-nav',
                'container'         => false,
                'menu_class'        => 'secondary-nav yamm',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker(),
            ) ) );
        ?>
        </div>
        <?php
    }
}
