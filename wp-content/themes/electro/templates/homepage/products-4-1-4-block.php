<?php
/**
 * Products 4-1-4 Block
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'products-4-1-4 stretch-full-width' : $section_class . ' products-4-1-4 stretch-full-width'; 

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$products_additional_class = 'exclude-auto-height';

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <h2 class="sr-only"><?php echo esc_html__( 'Products Grid', 'electro' ); ?></h2>
    <div class="container">
        <?php if ( ! empty( $section_title ) && ! empty( $categories ) ) : ?>

        <ul class="nav nav-inline products-4-1-4__nav">
            
            <?php if ( ! empty( $section_title ) ) : ?>
            <li class="nav-item"><a href="#" class="active nav-link"><?php echo esc_html( $section_title ); ?></a></li>
            <?php endif; ?>
            
            <?php 
            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
                foreach( $categories as $category ) : ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
                <?php endforeach;
            endif; ?>
        
        </ul>

        <?php endif; ?>

        <?php if ( !empty( $products ) ) : ?>
        
        <div class="columns-4-1-4 row">
            <div class="products-4 products-4-left column"><ul class="products <?php echo esc_attr( $products_additional_class ); ?>">
            <?php 
                $products_count = 0;

                if ( $products->have_posts() ) {

                    while ( $products->have_posts() ) : $products->the_post();

                        if ( $products_count == 4 || $products_count == 5 ) {
                            
                            echo '</ul>';

                            if ( $products_count == 4 ) {
                                
                                electro_add_2_1_2_main_product_hooks();

                                echo '</div><div class="products-1 column"><ul class="products product-main-2-1-2 show-btn">';
                            }
                            
                            if ( $products_count == 5 ) {
                                echo '</div><div class="products-4 products-4-right column"><ul class="products ' . esc_attr( $products_additional_class ) . '">';
                            }
                        }
                        
                        wc_get_template_part( 'content', 'product' );

                        if ( $products_count == 4 ) {
                            electro_remove_2_1_2_main_product_hooks();
                        }

                        $products_count++;

                    endwhile;
                }

                woocommerce_reset_loop();
                wp_reset_postdata();
            ?>
            </ul></div>
        </div>

        <?php endif; ?>
    </div>
</section>