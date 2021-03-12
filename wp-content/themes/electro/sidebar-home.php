<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Electro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$style_attr = '';

if ( is_page_template( 'template-homepage-v2.php' ) ) {
    $sidebar_margin_top = apply_filters( 'electro_home_sidebar_margin_top', '268' );
    $style_attr = 'margin-top: ' . abs( $sidebar_margin_top ) . 'px;';
}
?>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'sidebar-home' ) ) : ?>

<div id="sidebar" class="sidebar" role="complementary" <?php if ( !empty( $style_attr ) ) : ?>style="<?php echo esc_attr( $style_attr );?>"<?php endif; ?>>
<?php
	if ( is_active_sidebar( 'home-sidebar-widgets' ) ) {

		dynamic_sidebar( 'home-sidebar-widgets' );

	} else {

		do_action( 'electro_default_home_sidebar_widgets' );
	}
?>
</div><!-- /.sidebar-home -->

<?php endif; ?>