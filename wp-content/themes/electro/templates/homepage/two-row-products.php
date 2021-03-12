<?php
/**
 * Two Row Products
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'two-row-products' : 'two-row-products ' . $section_class;
if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$show_nav = ! empty( $categories ) && ! is_wp_error( $categories );
?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <?php if ( ! empty( $section_title ) ) : ?>

        <header>

            <h2 class="h1"><?php echo wp_kses_post( $section_title ); ?></h2>

            <?php if ( ! empty( $button_text ) ) : ?>
                <a class="action-text" href="<?php echo esc_attr( $button_link ); ?>"><?php echo wp_kses_post( $button_text ); ?></a>
            <?php endif; ?>

        </header>

    <?php endif; ?>

    
    <div class="products-block">
        <?php

        if ( electro_is_wide_enabled() ) {
            $default_atts['columns_wide']   = intval( $args['columns_wide'] );
            $shortcode_atts                 = wp_parse_args( $shortcode_atts, $default_atts );
        }
        
        echo electro_do_shortcode( 'products',  $shortcode_atts ); ?>
    </div>
    
</section>
