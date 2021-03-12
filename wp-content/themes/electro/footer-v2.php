<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package electro
 */
?>
			<?php
			/**
			 *
			 */
			do_action( 'electro_content_bottom' ); ?>
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'electro_before_footer_v2' ); ?>

	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>

	<footer id="colophon" class="site-footer footer-v2">

		<?php
		/**
		 * @hooked electro_footer_v2_desktop_wrap_open  -  5
		 * @hooked electro_footer_widgets_v2            - 10
		 * @hooked electro_footer_divider_v2            - 20
		 * @hooked electro_footer_bottom_widgets_v2     - 30
		 * @hooked electro_copyright_bar_v2             - 40
		 * @hooked electro_footer_v2_wrap_close         - 45
		 * @hooked electro_footer_v2_handheld_wrap_open - 50
		 * @hooked electro_footer_v2_handheld           - 60
		 * @hooked electro_footer_v2_wrap_close         - 99
		 */
		do_action( 'electro_footer_v2' ); ?>

	</footer><!-- #colophon -->

	<?php endif; ?>

	<?php do_action( 'electro_after_footer_v2' ); ?>

</div><!-- #page -->
</div>

<?php do_action( 'electro_after_page' ); ?>

<?php wp_footer(); ?>

</body>
</html>