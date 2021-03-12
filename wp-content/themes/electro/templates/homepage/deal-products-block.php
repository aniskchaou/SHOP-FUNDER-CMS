<?php
/**
 * Products deal block
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'deal-products-list' : 'deal-products-list ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}
?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <header class="show-nav">
        <h2 class="h1"><?php echo esc_html( $section_title ); ?></h2>
        <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
            <ul class="nav nav-inline">
                <?php if ( ! empty( $categories_title ) ) : ?>
                    <li class="nav-item active">
                        <span class="nav-link"><?php echo esc_html( $categories_title ); ?></span>
                    </li>
                <?php endif; ?>
                <?php foreach( $categories as $category ) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </header>
    <div class="products-list-inner">
        <div class="products-block">
            <?php
                add_action( 'woocommerce_before_shop_loop_item', 'electro_deal_countdown_timer_v2', 5  );
                echo electro_do_shortcode( $shortcode_tag,  $shortcode_atts );
                remove_action( 'woocommerce_before_shop_loop_item', 'electro_deal_countdown_timer_v2', 5  );
            ?>
        </div>
    </div>
    <div class="action">
        <a class="action-link" href="<?php echo esc_attr( $action_link ); ?>"><?php echo esc_html( $action_text ); ?></a>
    </div>
</section>
