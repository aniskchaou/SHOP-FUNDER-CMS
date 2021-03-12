<?php
/**
 * Home Category Icons Carousel
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section_class = empty( $section_class ) ? 'category-icons-carousel' : 'category-icons-carousel ' . $section_class;
$categories = get_terms( 'product_cat', $category_args );
$carousel_id = 'categories-carousel-' . uniqid();

if ( ! empty( $animation ) ) {
	$section_class .= ' animate-in-view';
} 
?>

<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
		<div id="<?php echo esc_attr( $carousel_id );?>" data-ride="owl-carousel" data-replace-active-class="true" data-carousel-selector=".categories-carousel" data-carousel-options="<?php echo esc_attr( json_encode( $args['carousel_args'] ) ); ?>">
			<div class="categories-carousel owl-carousel">
				<?php foreach( $categories as $category ) : ?>
				
				<?php $icon = get_term_meta( $category->term_id, 'icon', true ); ?>

				<div class="category">
					<a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
						<?php
                        if ( ! empty( $icon ) ) {
                            ?>
                            <div class="category-icon">
                                <i class="<?php echo esc_attr( $icon ); ?>"></i>
                            </div>
                            <?php
                        }
                        ?>
						<div class="category-title">
							<h4 class="title"><?php echo esc_html( $category->name ); ?></h4>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
</section>