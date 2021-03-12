<?php
/**
 * Single Brand
 *
 * @usedby [mas_product_brand]
 */

$style_attr = '';
if( ! empty( $width ) ) {
    $style_attr = 'width:' . esc_attr( $width ) . ';';
}
if( ! empty( $height ) ) {
    $style_attr = 'height:' . esc_attr( $height ) . ';';
}

?>
<a href="<?php echo get_term_link( $term,  $taxonomy ); ?>">
    <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="<?php echo esc_attr( $class ); ?>" <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?> />
</a>