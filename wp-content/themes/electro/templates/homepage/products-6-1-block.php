<?php
/**
 * Products 6-1 Block
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class  = empty( $section_class ) ? 'products-6-1' : 'products-6-1 ' . $section_class;
$section_class .= '  stretch-full-width';
if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <div class="container">
        <header class="show-nav">
            <h2 class="h1"><?php echo esc_html( $section_title ); ?></h2>
            <ul class="nav nav-inline">
                <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
                    foreach( $categories as $category ) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
                    </li>
                    <?php endforeach;
                endif; ?>
            </ul>
        </header>
        <div class="columns-6-1">
            <div class="products-6"><ul class="products exclude-auto-height columns-3">
            <?php
                $products_count = 0;

                if ( $products->have_posts() ) {

                    if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
                        global $woocommerce_loop;
                        $woocommerce_loop['columns'] = 3;
                    } else {
                        wc_set_loop_prop( 'columns', 3 );
                    }

                    while ( $products->have_posts() ) : $products->the_post();

                        if ( $products_count == 6 ) {
                            echo '</ul></div>';
                            echo '<div class="product-main-6-1"><ul class="products exclude-auto-height columns-1">';
                            electro_add_6_1_main_product_hooks();
                        }

                        wc_get_template_part( 'content', 'product' );

                        if ( $products_count == 6 ) {
                            electro_remove_6_1_main_product_hooks();
                        }

                        $products_count++;

                    endwhile;
                }

                woocommerce_reset_loop();
                wp_reset_postdata();
            ?>
            </ul></div>
        </div>
    </div>
</section>
