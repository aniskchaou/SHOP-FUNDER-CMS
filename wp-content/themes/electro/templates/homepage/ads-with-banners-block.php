<?php
/**
 * Ads With Banners
 *
 * @package Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'das-with-banners' : 'das-with-banners ' . $section_class;

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}?>

<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
    <?php foreach( $ads_banners  as $key => $ads_banner ) : ?>
        <?php
            extract( $ads_banner);
            $class = 'da-with-banner ';

            if( isset( $is_align_end ) && $is_align_end ) {
                $class .= ' align-end';
            }
        ?>
        <div class="<?php echo esc_attr( $class ); ?>">
            <div class="da">
                <div class="da-inner">
                    <a href="<?php echo esc_attr( $action_link ); ?>" class="action-link">
                        <div class="da-caption">
                            <div class="da-text">
                                <?php if( ! empty( $title ) ) : ?>
                                    <h2 class="title"><?php echo wp_kses_post( $title ); ?></h2>
                                <?php endif; ?>
                                <?php if( ! empty( $description ) ) : ?>
                                    <span class="description"><?php echo wp_kses_post( $description ); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if( ! empty( $price ) ) : ?>
                                <span class="price"><?php echo wp_kses_post( $price ); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="da-image">
                            <?php if( ! empty( $image[0] ) ) : ?>
                                <img src="<?php echo esc_url( $image[0] ); ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
            <div class="banner">
                <a href="<?php echo esc_attr( $banner_action_link ); ?>" class="action-link">
                    <?php if( ! empty( $banner_image[0] ) ) : ?>
                        <img src="<?php echo esc_url( $banner_image[0] ); ?>" alt="">
                    <?php endif; ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</section>