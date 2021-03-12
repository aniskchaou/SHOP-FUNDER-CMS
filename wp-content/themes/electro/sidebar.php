<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Electro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'sidebar' ) ) : ?>

<div id="sidebar" class="sidebar-blog" role="complementary">
<?php
	if ( is_active_sidebar( 'blog-sidebar-widgets' ) ) {

		dynamic_sidebar( 'blog-sidebar-widgets' );

	} else {

		do_action( 'electro_default_blog_sidebar_widgets' );
	}
?>
</div><!-- /.sidebar-blog -->

<?php endif; ?>