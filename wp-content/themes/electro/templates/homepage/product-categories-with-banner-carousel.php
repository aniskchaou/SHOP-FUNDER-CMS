<?php
/**
 * Product Categories with Banner Image Carousel
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'product-categories-with-banner-carousel' : 'product-categories-with-banner-carousel ' . $section_class;
$carousel_id = 'product-categories-with-banner-carousel-' . uniqid();

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$class = 'product-categories-with-banner-carousel__inner';

?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <header>
        <h2 class="h1"><?php echo esc_html( $section_title ); ?></h2>
    </header>
    <div id="<?php echo esc_attr( $carousel_id );?>" data-ride="owl-carousel" data-carousel-selector=".product-categories-with-banner-carousel__inner " data-replace-active-class="true" data-carousel-options="<?php echo esc_attr( json_encode( $carousel_args ) ); ?>">
        <div class="<?php echo esc_attr( $class ); ?>">
            <?php foreach ( $content as $content_args ) {
                $enable_category_1 = isset( $content_args['enable_category_1'] ) ? filter_var( $content_args['enable_category_1'], FILTER_VALIDATE_BOOLEAN ) : false;
                $category_1_args = isset( $content_args['category_1_args'] ) ? $content_args['category_1_args'] : array();
                $enable_category_2 = isset( $content_args['enable_category_2'] ) ? filter_var( $content_args['enable_category_2'], FILTER_VALIDATE_BOOLEAN ) : false;
                $category_2_args = isset( $content_args['category_2_args'] ) ? $content_args['category_2_args'] : array();
                $enable_banner = isset( $content_args['enable_banner'] ) ? filter_var( $content_args['enable_banner'], FILTER_VALIDATE_BOOLEAN ) : false;
                $image = isset( $content_args['image'] ) ? $content_args['image'] : array( '//placehold.it/840x370', '840', '370' );
                $img_action_link = isset( $content_args['img_action_link'] ) ? $content_args['img_action_link'] : '#';

                $categories_1 = $categories_2 = array();

                if( $enable_category_1 && ! empty( $category_1_args ) ) {
                    if ( isset( $category_1_args['slugs'] ) && ! empty( $category_1_args['slugs'] ) ) {
                        $cat_slugs = explode( ',', $category_1_args['slugs'] );
                        $cat_slugs = array_map( 'trim', $cat_slugs );
                        $category_1_args['slug']        = $cat_slugs;
                        $category_1_args['hide_empty']  = false;

                        $include = array();

                        foreach ( $cat_slugs as $slug ) {
                            $include[] = "'" . $slug ."'";
                        }

                        if ( ! empty($include ) ) {
                            $category_1_args['include'] = $include;
                            $category_1_args['orderby'] = 'include';
                        }
                    } elseif( isset( $category_1_args['includes'] ) && ! empty( $category_1_args['includes'] ) ) {
                        $include = explode( ",", $category_1_args['includes'] );
                        $include = array_map( 'trim', $include );
                        $category_1_args['include'] = $include;
                    }

                    $categories_1 = get_terms( 'product_cat', $category_1_args );

                    if( is_wp_error( $categories_1 ) ) {
                        return;
                    }
                }

                if( $enable_category_2 && ! empty( $category_2_args ) ) {
                    if ( isset( $category_2_args['slugs'] ) && ! empty( $category_2_args['slugs'] ) ) {
                        $cat_slugs = explode( ',', $category_2_args['slugs'] );
                        $cat_slugs = array_map( 'trim', $cat_slugs );
                        $category_2_args['slug']        = $cat_slugs;
                        $category_2_args['hide_empty']  = false;

                        $include = array();

                        foreach ( $cat_slugs as $slug ) {
                            $include[] = "'" . $slug ."'";
                        }

                        if ( ! empty($include ) ) {
                            $category_2_args['include'] = $include;
                            $category_2_args['orderby'] = 'include';
                        }
                    } elseif( isset( $category_2_args['includes'] ) && ! empty( $category_2_args['includes'] ) ) {
                        $include = explode( ",", $category_2_args['includes'] );
                        $include = array_map( 'trim', $include );
                        $category_1_args['include'] = $include;
                    }

                    $categories_2 = get_terms( 'product_cat', $category_2_args );

                    if( is_wp_error( $categories_2 ) ) {
                        return;
                    }
                }

                if( ! empty( $categories_1 ) || ! empty( $categories_2 ) || ! empty( $image ) ) {
                    ?><div class="product-categories-banner">
                        <div class="product-categories-banner__inner">
                            <?php if( $enable_category_1 && ! empty( $categories_1 ) ) : ?>
                                <div class="product-categories-1">
                                    <?php foreach ( $categories_1 as $cat_1 ) {
                                        $child_limit = isset( $category_1_args['child_number'] ) && ! empty( $category_1_args['child_number'] ) ? $category_1_args['child_number'] : 7;
                                        $child_cats_1 = get_terms( 'product_cat', apply_filters( 'electro_home_product_categories_child_categories_args', array(
                                            'orderby'           => 'menu_order',
                                            'order'             => 'ASC',
                                            'hide_empty'        => false,
                                            'number'            => $child_limit,
                                            'child_of'          => $cat_1->term_id,
                                        ), $cat_1, $categories_1, $category_1_args ) );
                                        ?>
                                        <div class="product-category-item">
                                            <h6 class="product-category__name">
                                                <a href="<?php echo esc_url( get_term_link( $cat_1 ) ); ?>" class="product-category-link">
                                                    <?php echo esc_html( $cat_1->name ); ?>
                                                </a>
                                            </h6>
                                            <?php if( ! empty( $child_cats_1 ) && ! is_wp_error( $child_cats_1 ) ) : ?>
                                                <ul class="product-category-child-list">
                                                    <?php foreach( $child_cats_1 as $child_cat ) : ?>
                                                        <li class="product-category-child-item">
                                                            <a href="<?php echo esc_url( get_term_link( $child_cat ) ); ?>">
                                                                <?php echo esc_html( $child_cat->name ); ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            <?php endif; ?>
                            <?php if( $enable_category_2 && ! empty( $categories_2 ) ) : ?>
                                <div class="product-categories-2">
                                    <ul class="product-categories-list">
                                        <?php foreach ( $categories_2 as $cat_2 ) : ?>
                                            <li class="product-category-item">
                                                <a href="<?php echo esc_url( get_term_link( $cat_2 ) ); ?>" class="product-category-link">
                                                    <?php echo esc_html( $cat_2->name ); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php if( $enable_banner && ! empty( $image ) ) : ?>
                                <div class="banner">
                                    <a href="<?php echo esc_url( $img_action_link ); ?>" class="banner-action">
                                        <img class="banner-image" src="<?php echo esc_url( $image[0] ); ?>">
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div><?php
                }
            } ?>
        </div>
    </div>
</section>
