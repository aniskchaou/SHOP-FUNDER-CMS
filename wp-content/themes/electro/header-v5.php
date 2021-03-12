<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package electro
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	wp_body_open();
	?>
<div class="off-canvas-wrapper">
<div id="page" class="hfeed site">
	<?php
	/**
	 * @hooked electro_skip_links - 0
	 * @hooked electro_top_bar - 10
	 */
	do_action( 'electro_before_header_v5' ); ?>

	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>

	<header id="masthead" class="site-header header-v5">
		<div class="stick-this">
			<div class="container <?php echo esc_attr( has_electro_mobile_header() ? electro_desktop_header_responsive_class() : '' );  ?>">
				<?php
				/**
				 */
				do_action( 'electro_header_v5' ); ?>

			</div>

			<?php
			/**
			 * @hooked electro_handheld_header - 10
			 */
			do_action( 'electro_after_header' ); ?>

		</div>
	</header><!-- #masthead -->

	<?php endif; ?>

	<?php do_action( 'electro_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="container">
		<?php
		/**
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'electro_content_top' ); ?>
