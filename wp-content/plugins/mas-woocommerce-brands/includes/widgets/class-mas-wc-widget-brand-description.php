<?php
/**
 * Brand Description Widget
 *
 * When viewing a brand archive, show the current brands description + image
 *
 * @category	Widgets
 * @version		1.0.0
 * @author      Madras Themes
 */

if ( ! class_exists( 'Mas_WC_Widget_Brand_Description' ) ) {
	class Mas_WC_Widget_Brand_Description extends WP_Widget {

		/** Variables to setup the widget. */
		var $woo_widget_cssclass;
		var $woo_widget_description;
		var $woo_widget_idbase;
		var $woo_widget_name;

		/** constructor */
		public function __construct() {

			/* Widget variable settings. */
			$this->woo_widget_name        = esc_html__( 'MAS WC Brand Description', 'mas-wc-brands' );
			$this->woo_widget_description = esc_html__( 'When viewing a brand archive, show the current brands description.', 'mas-wc-brands' );
			$this->woo_widget_idbase      = 'mas_wc_brands_brand_description';
			$this->woo_widget_cssclass    = 'widget_brand_description';

			/* Widget settings. */
			$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

			/* Create the widget. */
			parent::__construct( $this->woo_widget_idbase, $this->woo_widget_name, $widget_ops );
		}

		/** @see WP_Widget */
		public function widget( $args, $instance ) {
			$brand_taxonomy = Mas_WC_Brands()->get_brand_taxonomy();

			if( empty( $brand_taxonomy ) ) {
				return;
			}
			
			extract( $args );

			if ( ! is_tax( $brand_taxonomy ) )
				return;

			if ( ! get_query_var( 'term' ) )
				return;

			$thumbnail = '';
			$term      = get_term_by( 'slug', get_query_var( 'term' ), $brand_taxonomy );

			$thumbnail = mas_wcbr_get_brand_thumbnail_url( $term->term_id, 'large' );

			echo $before_widget . $before_title . $term->name . $after_title;

			wc_get_template( 'widgets/brand-description.php', array(
				'thumbnail' => $thumbnail,
				'brand' => $term
			), 'mas-woocommerce-brands', untrailingslashit( MAS_WCBR_ABSPATH ) . '/templates/' );

			echo $after_widget;
		}

		/** @see WP_Widget->update */
		public function update( $new_instance, $old_instance ) {
			$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
			return $instance;
		}

		/** @see WP_Widget->form */
		public function form( $instance ) {
			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'mas-wc-brands') ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if ( isset ( $instance['title'] ) ) echo esc_attr( $instance['title'] ); ?>" />
				</p>
			<?php
		}

	}
}