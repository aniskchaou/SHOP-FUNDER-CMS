<?php
/**
 * Template functions related to Header v6
 */

if ( ! function_exists( 'electro_set_header_v6_hooks' ) ) {
    /**
     * @since 2.0
     */
    function electro_set_header_v6_hooks() {
        remove_action( 'electro_header_logo_area', 'electro_off_canvas_nav', 20 );
        add_action( 'electro_header_logo_area', 'electro_departments_menu_v2', 20 );
    }
}

if ( ! function_exists( 'electro_secondary_nav_v6' ) ) {
    /**
     * @since 2.0
     */
    function electro_secondary_nav_v6( $args = array() ) {
        $defaults = apply_filters( 'electro_secondary_nav_v6_default_args', array(
            'title' => esc_html__( 'Electro Best Selling:', 'electro' ),
            'menu'  => ''
        ) );

        $args = wp_parse_args( $args, $defaults );

        $section_class = empty( $args['section_class'] ) ? 'secondary-nav-v6' : 'secondary-nav-v6 ' . $section_class;
        if ( ! empty( $args['animation'] ) ) {
            $section_class .= ' animate-in-view';
        }

        $menu_title_v6 = apply_filters( 'electro_menu_title_v6', esc_html__( 'Electro Best Selling:', 'electro' ) );
        ?>
        <div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $args['animation'] ) ) : ?>data-animation="<?php echo esc_attr( $args['animation'] );?>"<?php endif; ?>>
            <div class="secondary-nav-v6-inner electro-animate-dropdown">
                <span class="title"><?php echo wp_kses_post( $args['title'] ); ?></span>
                <?php
                    wp_nav_menu( array(
                        'menu'              => $args['menu'],
                        'theme_location'    => 'secondary-nav',
                        'container'         => false,
                        'menu_class'        => 'secondary-nav yamm',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker(),
                    ) );
                ?>
            </div>
        </div>
        <?php
    }
}
