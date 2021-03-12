<?php
/**
 * Product Categories List with Header
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'product-categories-list-with-header' : 'product-categories-list-with-header ' . $section_class;

if( ! empty( $type ) ) {
    $section_class .= ' ' . $type;
}

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$categories = get_terms( 'product_cat', $category_args );

if( ! empty( $bg_image ) && ! is_array( $bg_image ) ) {
    $bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
}

$style_attr = '';
if ( ! empty( $bg_image[0] ) ) {
    $style_attr = 'background-image: url( ' . esc_url( $bg_image[0] ) . ' );';
}

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
    <?php if( isset( $enable_header  ) && $enable_header ) : ?>
        <header <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
            <div class="caption">
                <?php if ( ! empty( $section_title ) ) : ?>
                    <h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $sub_title ) ) : ?>
                    <span class="sub-title"><?php echo esc_html( $sub_title ); ?></span>
                <?php endif; ?>
            </div>
        </header>
    <?php endif; ?>
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