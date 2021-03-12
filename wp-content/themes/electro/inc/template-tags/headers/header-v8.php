<?php
/**
 * Template functions related to Header v8
 */

if ( ! function_exists( 'electro_masthead_v4' ) ) {

    function electro_masthead_v4() {
        ?><div class="masthead"><?php
        /**
         * @hooked electro_header_logo_area     - 10
         * @hooked electro_navbar_search        - 20
         * @hooked electro_secondary_nav_menu   - 30
         * @hooked electro_header_icons         - 40
         */
        do_action( 'electro_masthead_v4' ); ?></div><?php
    }
}