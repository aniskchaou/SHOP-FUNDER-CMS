<?php
/**
 * Products list block
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'deal-products-with-featured' : 'deal-products-with-featured ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$products   = Electro_Products::$shortcode_tag( $shortcode_atts );
?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <header>
        <h2><?php echo esc_html( $section_title ); ?></h2>
        <?php if( isset( $header_timer ) && $header_timer && ! empty( $timer_value ) ) :
            $deal_end_time = strtotime( $timer_value );
            $current_time = strtotime( 'now' );
            $time_diff = ( $deal_end_time - $current_time );
            
            if( $time_diff > 0 ) : ?>
            <div class="deal-countdown-timer">
                <div class="marketing-text"><?php echo wp_kses_post( $timer_title ); ?></div>
                    <span class="deal-time-diff" style="display:none;"><?php echo esc_html( $time_diff ); ?></span>
                    <div class="deal-countdown countdown"></div>
                </div>
            <?php endif;
        endif; ?>
    </header>
    <div class="products-block">
        <ul class="products">
            <?php
                $products_count = 0;
                while ( $products->have_posts() ) : $products->the_post();
                    
                    echo ( $products_count == 0 ) ? '<li class="product product-featured">' : '<li class="product">';
                        wc_get_template_part( 'templates/contents/content', 'deal-products-with-featured' );
                    echo '</li>';
                    
                    $products_count++;
                
                endwhile;
                woocommerce_reset_loop();
                wp_reset_postdata();
            ?>
        </ul>
    </div>
</section>