<?php
/**
 * Product Categories List
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'product-categories-list' : 'product-categories-list ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$categories = get_terms( 'product_cat', $category_args );

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
    <div class="categories-block columns-<?php echo esc_attr( $columns ) ?>">
        <ul class="categories">
            <?php foreach( $categories as $category ) : ?>
            <li class="category">
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                    <?php woocommerce_subcategory_thumbnail( $category ); ?>
                    <h4><?php echo esc_html( $category->name ); ?></h4>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>