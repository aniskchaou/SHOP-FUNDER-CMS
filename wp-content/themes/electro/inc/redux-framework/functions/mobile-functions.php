<?php
/**
 * Filter functions for Mobile Section of Theme Options
 */

if ( ! function_exists ( 'redux_toggle_mobile_frontpage' ) ) {
    function redux_toggle_mobile_frontpage( $enable ) {
        global $electro_options;

        if ( ! isset( $electro_options['enable_mobile_frontpage'] ) ) {
            $electro_options['enable_mobile_frontpage'] = false;
        }

        if ( $electro_options['enable_mobile_frontpage'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_apply_mobile_frontpage_id' ) ) {
    function redux_apply_mobile_frontpage_id( $id ) {
        global $electro_options;

        if( ! empty( $electro_options['mobile_frontpage_id'] ) ) {
            $id = $electro_options['mobile_frontpage_id'];
        }

        return $id;
    }
}

if ( ! function_exists( 'redux_apply_handheld_header_logo' ) ) {
    function redux_apply_handheld_header_logo( $logo ) {
        global $electro_options;

        $logo_image_src = '';
        if ( ! empty( $electro_options['handheld_header_logo']['url'] ) ) {
            $logo_image_attr = $electro_options['handheld_header_logo'];
            $logo_image_src = $electro_options['handheld_header_logo']['url'];
        } elseif ( ! empty( $electro_options['site_header_logo']['url'] ) ) {
            $logo_image_attr = $electro_options['site_header_logo'];
            $logo_image_src = $electro_options['site_header_logo']['url'];
        }
        
        if ( ! empty( $logo_image_src ) ) {

            if ( is_ssl() ) {
                $logo_image_src = str_replace( 'http:', 'https:', $logo_image_src );
            }

            ob_start();
            ?>
            <div class="header-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-link">
                    <img src="<?php echo esc_url( $logo_image_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="img-header-logo" width="<?php echo esc_attr( $logo_image_attr['width'] ); ?>" height="<?php echo esc_attr( $logo_image_attr['height'] ); ?>" />
                </a>
            </div>
            <?php
            $logo = ob_get_clean();
        }

        return $logo;
    }
}

if ( ! function_exists( 'redux_apply_handheld_header_style' ) ) {
    function redux_apply_handheld_header_style( $handheld_header_style ) {
        global $electro_options;

        if( isset( $electro_options['handheld_header_style'] ) ) {
            $handheld_header_style = $electro_options['handheld_header_style'];
        }

        return $handheld_header_style;
    }
}

if ( ! function_exists ( 'redux_toggle_handheld_header_v2_light_bg' ) ) {
    function redux_toggle_handheld_header_v2_light_bg( $enable ) {
        global $electro_options;

        if ( ! isset( $electro_options['handheld_header_v2_light_bg'] ) ) {
            $electro_options['handheld_header_v2_light_bg'] = false;
        }

        if ( $electro_options['handheld_header_v2_light_bg'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if( ! function_exists( 'redux_toggle_handheld_header_sticky' ) ) {
    function redux_toggle_handheld_header_sticky() {
        global $electro_options;

        if( isset( $electro_options['sticky_handheld_header'] ) && $electro_options['sticky_handheld_header'] == '1' ) {
            $sticky_header = true;
        } else {
            $sticky_header = false;
        }

        return $sticky_header;
    }
}

if( ! function_exists( 'redux_toggle_add_to_cart_mobile' ) ) {
    function redux_toggle_add_to_cart_mobile() {
        global $electro_options;

        if( isset( $electro_options['enable_add_to_cart_mobile'] ) && $electro_options['enable_add_to_cart_mobile'] == '1' ) {
            $enable_add_to_cart_mobile = true;
        } else {
            $enable_add_to_cart_mobile = false;
        }

        return $enable_add_to_cart_mobile;
    }
}


if ( ! function_exists( 'redux_apply_handheld_footer_logo' ) ) {
    function redux_apply_handheld_footer_logo( $logo ) {
        global $electro_options;

        if ( ! empty( $electro_options['handheld_footer_logo']['url'] ) ) {

            $logo_image_src = $electro_options['handheld_footer_logo']['url'];
            if ( is_ssl() ) {
                $logo_image_src = str_replace( 'http:', 'https:', $logo_image_src );
            }

            ob_start();
            ?>
            <div class="footer-logo">
                <img src="<?php echo esc_url( $logo_image_src ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $electro_options['handheld_footer_logo']['width'] ); ?>" height="<?php echo esc_attr( $electro_options['handheld_footer_logo']['height'] ); ?>" />
            </div>
            <?php
            $logo = ob_get_clean();
        }

        return $logo;
    }
}

if ( ! function_exists( 'redux_apply_handheld_footer_style' ) ) {
    function redux_apply_handheld_footer_style( $handheld_footer_style ) {
        global $electro_options;

        if( isset( $electro_options['handheld_footer_style'] ) ) {
            $handheld_footer_style = $electro_options['handheld_footer_style'];
        }

        return $handheld_footer_style;
    }
}

if ( ! function_exists ( 'redux_toggle_handheld_footer_light_bg' ) ) {
    function redux_toggle_handheld_footer_light_bg( $enable ) {
        global $electro_options;

        if ( ! isset( $electro_options['handheld_footer_light_bg'] ) ) {
            $electro_options['handheld_footer_light_bg'] = false;
        }

        if ( $electro_options['handheld_footer_light_bg'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_toggle_mobile_footer_bottom_widgets' ) ) {
    function redux_toggle_mobile_footer_bottom_widgets( $enable ) {
        global $electro_options;

        $electro_options['show_mobile_footer_bottom_widgets'] = isset( $electro_options['show_mobile_footer_bottom_widgets'] ) ? $electro_options['show_mobile_footer_bottom_widgets'] : true;

        if( $electro_options['show_mobile_footer_bottom_widgets'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}