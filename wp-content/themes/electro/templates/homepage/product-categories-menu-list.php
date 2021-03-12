<?php
/**
 * Product Categories Menu List
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'product-categories-menu-list' : 'product-categories-menu-list ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
    <header>
        <h2 class="h1"><?php echo esc_html( $section_title ); ?></h2>
    </header>
    <div class="categories-menus">
        <?php foreach( $category_list as $category_list_args ) : ?>
            <?php if ( ! empty( $category_list_args ) ) : ?>
                <div class="categories-menu-inner">
                    <?php $categories = get_terms( 'product_cat', $category_list_args['category_args'] ); ?>
                    <div class="cat-title">
                        <?php echo esc_html( $category_list_args['title'] ); ?>
                    </div>
                    <ul class="categories">
                        <?php foreach( $categories as $category ) : ?>
                        <li class="category">
                            <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                                <h4><?php echo esc_html( $category->name ); ?></h4>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="action">
        <a class="action-link" href="<?php echo esc_attr( $action_link ); ?>"><?php echo esc_html( $action_text ); ?></a>
    </div>
</section>