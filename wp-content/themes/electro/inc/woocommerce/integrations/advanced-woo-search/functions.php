<?php
add_action( 'init', 'electro_aws_search_form_hooks' );

if ( ! function_exists( 'electro_aws_search_form_hooks' ) ) {
    function electro_aws_search_form_hooks() {
        add_filter( 'electro_use_third_party_navbar_search', '__return_true', 10 );
        add_action( 'electro_navbar_search_third_party', 'electro_aws_search_form', 10 );
    }
}

if ( ! function_exists( 'electro_aws_search_form' ) ) {
    function electro_aws_search_form() {
        if ( is_woocommerce_activated() ) : ?>
            <div class="navbar-search"><?php
                aws_get_search_form();
            ?></div>
        <?php
        endif;
    }
}