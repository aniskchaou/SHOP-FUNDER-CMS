<?php
/**
 * Brand Thumbnails Widget
 *
 * Show brand images as thumbnails
 *
 * @category	Widgets
 * @version		1.0.0
 * @author      Madras Themes
 */
if ( ! class_exists( 'Mas_WC_Widget_Brand_Thumbnails' ) ) {
	class Mas_WC_Widget_Brand_Thumbnails extends WP_Widget {

		/** Variables to setup the widget. */
		public $woo_widget_cssclass;
		public $woo_widget_description;
		public $woo_widget_idbase;
		public $woo_widget_name;

		/** constructor */
		public function __construct() {

			/* Widget variable settings. */
			$this->woo_widget_name        = esc_html__( 'MAS WC Brand Thumbnails', 'mas-wc-brands' );
			$this->woo_widget_description = esc_html__( 'Show a grid of brand thumbnails.', 'mas-wc-brands' );
			$this->woo_widget_idbase      = 'mas_wc_brands_brand_thumbnails';
			$this->woo_widget_cssclass    = 'widget_brand_thumbnails';

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

			$exclude = array_map( 'intval', explode( ',', $instance['exclude'] ) );
			$order = $instance['orderby'] == 'name' ? 'asc' : 'desc';

			$brands = get_terms( array( 'taxonomy' => $brand_taxonomy, 'hide_empty' => $instance['hide_empty'], 'orderby' => $instance['orderby'], 'exclude' => $exclude, 'number' => $instance['number'], 'order' => $order ) );

			if ( ! $brands || ! is_array( $brands ) ) {
				return;
			}

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->woo_widget_idbase );

			echo $args['before_widget'];
			if ( $title !== '' ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			wc_get_template( 'widgets/brand-thumbnails.php', array(
				'taxonomy'      => $brand_taxonomy,
				'brands'        => $brands,
				'columns'       => $instance['columns'],
				'image_size'	=> $instance['image_size'],
				'fluid_columns' => ! empty( $instance['fluid_columns'] ) ? true : false,
			), 'mas-woocommerce-brands', untrailingslashit( MAS_WCBR_ABSPATH ) . '/templates/' );

			echo $after_widget;
		}

		/** @see WP_Widget->update */
		public function update( $new_instance, $old_instance ) {
			$instance['title']         = strip_tags( stripslashes( $new_instance['title'] ) );
			$instance['columns']       = strip_tags( stripslashes( $new_instance['columns'] ) );
			$instance['image_size']    = strip_tags( stripslashes( $new_instance['image_size'] ) );
			$instance['fluid_columns'] = ! empty( $new_instance['fluid_columns'] ) ? true : false;
			$instance['orderby']       = strip_tags( stripslashes( $new_instance['orderby'] ) );
			$instance['exclude']       = strip_tags( stripslashes( $new_instance['exclude'] ) );
			$instance['hide_empty']    = strip_tags( stripslashes( $new_instance['hide_empty'] ) );
			$instance['number']        = strip_tags( stripslashes( $new_instance['number'] ) );

			if ( ! $instance['columns'] ) {
				$instance['columns'] = 1;
			}

			if ( ! $instance['image_size'] ) {
				$instance['image_size'] = '';
			}

			if ( ! $instance['orderby'] ) {
				$instance['orderby'] = 'name';
			}

			if ( ! $instance['exclude'] ) {
				$instance['exclude'] = '';
			}

			if ( ! $instance['hide_empty'] ) {
				$instance['hide_empty'] = 0;
			}

			if ( ! $instance['number'] ) {
				$instance['number'] = '';
			}

			return $instance;
		}

		/** @see WP_Widget->form */
		public function form( $instance ) {
			if ( ! isset( $instance['hide_empty'] ) ) {
				$instance['hide_empty'] = 0;
			}

			if ( ! isset( $instance['orderby'] ) ) {
				$instance['orderby'] = 'name';
			}

			if ( empty( $instance['fluid_columns'] ) ) {
				$instance['fluid_columns'] = false;
			}

			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'mas-wc-brands') ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if ( isset ( $instance['title'] ) ) echo esc_attr( $instance['title'] ); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php esc_html_e('Columns:', 'mas-wc-brands') ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" value="<?php if ( isset ( $instance['columns'] ) ) echo esc_attr( $instance['columns'] ); else echo '1'; ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php esc_html_e('Image Size:', 'mas-wc-brands') ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_size' ) ); ?>" value="<?php if ( isset ( $instance['image_size'] ) ) echo esc_attr( $instance['image_size'] ); else echo ''; ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'fluid_columns' ); ?>"><?php esc_html_e('Fluid columns:', 'mas-wc-brands') ?></label>
					<input type="checkbox" <?php checked( $instance['fluid_columns'] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'fluid_columns' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fluid_columns' ) ); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e('Number:', 'mas-wc-brands') ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php if ( isset ( $instance['number'] ) ) echo esc_attr( $instance['number'] ); ?>" placeholder="<?php esc_html_e('All', 'mas-wc-brands'); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php esc_html_e('Exclude:', 'mas-wc-brands') ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" value="<?php if ( isset ( $instance['exclude'] ) ) echo esc_attr( $instance['exclude'] ); ?>" placeholder="<?php esc_html_e('None', 'mas-wc-brands'); ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'hide_empty' ); ?>"><?php esc_html_e('Hide empty brands:', 'mas-wc-brands') ?></label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_empty' ) ); ?>">
						<option value="1" <?php selected( $instance['hide_empty'], 1 ) ?>><?php esc_html_e('Yes', 'mas-wc-brands') ?></option>
						<option value="0" <?php selected( $instance['hide_empty'], 0 ) ?>><?php esc_html_e('No', 'mas-wc-brands') ?></option>
					</select>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('Order by:', 'mas-wc-brands') ?></label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
						<option value="name" <?php selected( $instance['orderby'], 'name' ) ?>><?php esc_html_e('Name', 'mas-wc-brands') ?></option>
						<option value="count" <?php selected( $instance['orderby'], 'count' ) ?>><?php esc_html_e('Count', 'mas-wc-brands') ?></option>
					</select>
				</p>
			<?php
		}

	}
}