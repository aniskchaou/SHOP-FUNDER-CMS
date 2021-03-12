<?php
/**
 * Home Categories Block
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section_class = empty( $section_class ) ? 'home-categories-block' : 'home-categories-block ' . $section_class;
$categories = get_terms( 'product_cat', $category_args );

if ( ! empty( $animation ) ) {
	$section_class .= ' animate-in-view';
} 

if( isset( $enable_full_width ) && $enable_full_width ) {
    $section_class .= ' full-width';
}?>

<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
	<?php if( isset( $enable_full_width ) && $enable_full_width ) : ?>
		<div class="container">
	<?php endif; ?>
		<?php if( ! empty( $section_title ) ) : ?>
		<header>
			<h2 class="h1"><?php echo esc_html( $section_title ); ?></h2>
		</header>
		<?php endif; ?>
		<div class="categories-block columns-<?php echo esc_attr( $columns ) ?>">
			<ul class="categories">
				<?php foreach( $categories as $category ) : ?>
				<li class="category">
					<div class="category-inner">
						<a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
							<div class="media-img"><?php woocommerce_subcategory_thumbnail( $category ); ?></div>
							<div class="category-title">
								<h4 class="title"><?php echo esc_html( $category->name ); ?></h4>
							</div>
						</a>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php if( isset( $enable_full_width ) && $enable_full_width ) : ?>
		</div>
	<?php endif; ?>
</section>