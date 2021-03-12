<?php
/**
 * Home Product Category Tags
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'product-categories-tags' : 'product-categories-tags ' . $section_class;
$categories = get_terms( 'product_cat', $category_args );

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}
?>

<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
    <header>
        <h2 class="h1"><?php echo esc_html( $section_title ); ?></h2>
    </header>
    <div class="categories">
        <?php foreach( $categories as $category ) : ?>
            <div class="category">
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                    <span class="category-title"><?php echo esc_html( $category->name ); ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
