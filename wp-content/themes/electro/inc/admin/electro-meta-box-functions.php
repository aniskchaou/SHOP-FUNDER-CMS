<?php
/**
* Electro Meta Box Functions
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Output a text input box.
 *
 * @param array $field
 */
function electro_wp_text_input( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['type']          = isset( $field['type'] ) ? $field['type'] : 'text';
	$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];

	switch ( $data_type ) {
		case 'url' :
			$field['class'] .= ' electro_input_url';
			$field['value']  = esc_url( $field['value'] );
			break;

		default :
			break;
	}

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><input type="' . esc_attr( $field['type'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" ' . implode( ' ', $custom_attributes ) . ' /> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo electro_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a hidden input box.
 *
 * @param array $field
 */
function electro_wp_hidden_input( $field ) {
	global $thepostid, $post;

	$thepostid = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['value'] = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['class'] = isset( $field['class'] ) ? $field['class'] : '';

	echo '<input type="hidden" class="' . esc_attr( $field['class'] ) . '" name="' . esc_attr( $field['id'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) .  '" /> ';
}

/**
 * Output a textarea input box.
 *
 * @param array $field
 */
function electro_wp_textarea_input( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><textarea class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '"  name="' . esc_attr( $field['id'] ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="2" cols="20" ' . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $field['value'] ) . '</textarea> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo electro_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a checkbox input box.
 *
 * @param array $field
 */
function electro_wp_checkbox( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'checkbox';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['cbvalue']       = isset( $field['cbvalue'] ) ? $field['cbvalue'] : 'yes';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><input type="checkbox" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['cbvalue'] ) . '" ' . checked( $field['value'], $field['cbvalue'], false ) . '  ' . implode( ' ', $custom_attributes ) . '/> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo electro_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}

	echo '</p>';
}

/**
 * Output a select input box.
 *
 * @param array $field
 */
function electro_wp_select( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );

	if ( empty( $field['value'] ) && isset( $field['default'] ) ) {
		$field['value'] = $field['default'];
	}

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" ' . implode( ' ', $custom_attributes ) . '>';

	foreach ( $field['options'] as $key => $value ) {
		echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
	}

	echo '</select> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo electro_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a radio input box.
 *
 * @param array $field
 */
function electro_wp_radio( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];

	echo '<fieldset class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><legend>' . wp_kses_post( $field['label'] ) . '</legend><ul class="ec-radios">';

	foreach ( $field['options'] as $key => $value ) {

		echo '<li><label><input
				name="' . esc_attr( $field['name'] ) . '"
				value="' . esc_attr( $key ) . '"
				type="radio"
				class="' . esc_attr( $field['class'] ) . '"
				style="' . esc_attr( $field['style'] ) . '"
				' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '
				/> ' . esc_html( $value ) . '</label>
		</li>';
	}
	echo '</ul>';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo electro_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}

	echo '</fieldset>';
}

/**
 * Output input fields to choose a WooCommerce Shortcode
 */
function electro_wp_wc_shortcode( $field ) {
	global $thepostid, $post;

	$thepostid			= empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']		= isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'orderby' , 'order' );

	echo '<div class="electro-wc-shortcode">';

	electro_wp_select( array(
		'id'		=> $field['name'],
		'label'		=> $field['label'],
		'default'	=> $field['default'],
		'options'	=> array(
			'recent_products'		=> esc_html__( 'Recent Products', 'electro' ),
			'featured_products'		=> esc_html__( 'Featured Products', 'electro' ),
			'sale_products'			=> esc_html__( 'Sale Products', 'electro' ),
			'best_selling_products'	=> esc_html__( 'Best Selling Products', 'electro' ),
			'top_rated_products'	=> esc_html__( 'Top Rated Products', 'electro' ),
			'product_category'		=> esc_html__( 'Product Category', 'electro' ),
			'products'				=> esc_html__( 'Products', 'electro' ),
			'product_attribute'		=> esc_html__( 'Product Attribute', 'electro' ),
		),
		'class'		=> 'wc_shortcode_select show_hide_select',
		'name'		=> $field['name'] . '[shortcode]',
		'value'		=> isset( $field['value']['shortcode'] ) ? $field['value']['shortcode'] : $field['default'],
	) );
	
	electro_wp_text_input( array(
		'id'			=> $field['name'] . '_product_category_slug',
		'label'			=> esc_html__( 'Product Category Slug', 'electro' ),
		'class'			=>'wc_shortcode_product_category_slug',
		'placeholder'	=> esc_html__( 'Enter slug spearate by comma(,).', 'electro' ),
		'wrapper_class'	=> 'show_if_product_category hide',
		'name'			=> $field['name'] . '[product_category_slug]',
		'value'			=> isset( $field['value']['product_category_slug'] ) ? $field['value']['product_category_slug'] : '',
	) );

	electro_wp_text_input( array(
		'id'			=> $field['name'] . '_cat_operator',
		'label'			=> esc_html__( 'Product Category Operator', 'electro' ),
		'class'			=>'wc_shortcode_cat_operator',
		'placeholder'	=> esc_html__( 'Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro' ),
		'wrapper_class'	=> 'show_if_product_category hide',
		'name'			=> $field['name'] . '[cat_operator]',
		'value'			=> isset( $field['value']['cat_operator'] ) ? $field['value']['cat_operator'] : 'IN',
	) );

	electro_wp_select( array(
		'id'	=> $field['name'] . '_products_choice',
		'label'	=> esc_html__( 'Show Products by:', 'electro' ),
		'options'	=> array(  
			'ids'	=> esc_html__( 'IDs', 'electro' ),
			'skus'	=> esc_html__( 'SKUs', 'electro' )
		),
		'wrapper_class'	=> 'show_if_products hide',
		'class'			=> 'skus_or_ids',
		'name'			=> $field['name'] . '[products_choice]',
		'value'			=> isset( $field['value']['products_choice'] ) ? $field['value']['products_choice'] : 'ids',
	) );

	electro_wp_text_input( array(
		'id'			=> $field['name'] . '_products_ids_skus',
		'label'			=> esc_html__( 'Product IDs or SKUs', 'electro' ),
		'placeholder'	=> esc_html__( 'Enter IDs or SKUs separated by comma', 'electro' ),
		'wrapper_class'	=> 'show_if_products hide',
		'name'			=> $field['name'] . '[products_ids_skus]',
		'value'			=> isset( $field['value']['products_ids_skus'] ) ? $field['value']['products_ids_skus'] : '',
	) );

	electro_wp_text_input( array(
		'id'			=> $field['name'] . '_attribute',
		'label'			=> esc_html__( 'Attribute', 'electro' ),
		'class'			=>'wc_shortcode_attribute',
		'placeholder'	=> esc_html__( 'Enter single attribute slug.', 'electro' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[attribute]',
		'value'			=> isset( $field['value']['attribute'] ) ? $field['value']['attribute'] : '',
	) );

	electro_wp_text_input( array(
		'id'			=> $field['name'] . '_terms',
		'label'			=> esc_html__( 'Terms', 'electro' ),
		'class'			=>'wc_shortcode_terms',
		'placeholder'	=> esc_html__( 'Enter term slug spearate by comma(,).', 'electro' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[terms]',
		'value'			=> isset( $field['value']['terms'] ) ? $field['value']['terms'] : '',
	) );

	electro_wp_text_input( array(
		'id'			=> $field['name'] . '_terms_operator',
		'label'			=> esc_html__( 'Terms Operator', 'electro' ),
		'class'			=>'wc_shortcode_terms_operator',
		'placeholder'	=> esc_html__( 'Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'electro' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[terms_operator]',
		'value'			=> isset( $field['value']['terms_operator'] ) ? $field['value']['terms_operator'] : 'IN',
	) );

	echo '</div>';

	electro_wp_wc_shortcode_atts( array( 
		'id'			=> $field['name'] . '_shortcode_atts',
		'label'			=> esc_html__( 'Shortcode Atts', 'electro' ),
		'name'			=> $field['name'] . '[shortcode_atts]',
		'value'			=> isset( $field['value']['shortcode_atts'] ) ? $field['value']['shortcode_atts'] : '',
		'fields'		=> $field['fields']
	) );
}

/**
 * Output input fields to choose a WooCommerce Shortcode Atts
 */
function electro_wp_wc_shortcode_atts( $field ) {
	global $thepostid, $post;

	$thepostid			= empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']		= isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'orderby' , 'order' );

	echo '<div class="electro-wc-shortcode-atts">';

	if( isset( $field['fields'] ) && in_array( 'per_page', $field['fields'] )  ) {
		electro_wp_text_input( array(
			'id'			=> $field['id'] . '_per_page',
			'label'			=> esc_html__( 'Limit', 'electro' ),
			'name'			=> $field['name'] . '[per_page]',
			'value'			=> isset( $field['value']['per_page'] ) ? $field['value']['per_page'] : 12,
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'columns', $field['fields'] )  ) {
		electro_wp_select( array(
			'id'			=> $field['id'] . '_columns',
			'label'			=> esc_html__( 'Columns', 'electro' ),
			'name'			=> $field['name'] . '[columns]',
			'options'		=> array(
				'1'				=> esc_html__( '1', 'electro' ),
				'2'				=> esc_html__( '2', 'electro' ),
				'3'				=> esc_html__( '3', 'electro' ),
				'4'				=> esc_html__( '4', 'electro' ),
				'5'				=> esc_html__( '5', 'electro' ),
				'6'				=> esc_html__( '6', 'electro' ),
			),
			'value'			=> isset( $field['value']['columns'] ) ? $field['value']['columns'] : 4,
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'orderby', $field['fields'] )  ) {
		electro_wp_select( array(
			'id'			=> $field['id'] . '_orderby',
			'label'			=> esc_html__( 'Orderby', 'electro' ),
			'name'			=> $field['name'] . '[orderby]',
			'options'		=> array(
				'date'			=> esc_html__( 'Date', 'electro' ),
				'id'			=> esc_html__( 'Id', 'electro' ),
				'menu_order'	=> esc_html__( 'Menu Order', 'electro' ),
				'popularity'	=> esc_html__( 'Popularity', 'electro' ),
				'rand'			=> esc_html__( 'Rand', 'electro' ),
				'rating'		=> esc_html__( 'Rating', 'electro' ),
				'title'			=> esc_html__( 'Title', 'electro' ),
			),
			'value'			=> isset( $field['value']['orderby'] ) ? $field['value']['orderby'] : 'name',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'order', $field['fields'] )  ) {
		electro_wp_select( array(
			'id'			=> $field['id'] . '_order',
			'label'			=> esc_html__( 'Order', 'electro' ),
			'name'			=> $field['name'] . '[order]',
			'options'		=> array(
				'ASC'			=> esc_html__( 'ASC', 'electro' ),
				'DESC'			=> esc_html__( 'DESC', 'electro' ),
			),
			'value'			=> isset( $field['value']['order'] ) ? $field['value']['order'] : 'ASC',
		) );
	}

	echo '</div>';
}

/**
 * Outputs Legend for Fieldsets
 */
function electro_wp_legend( $title ) {
	?>
	<h4 class="ec-legend"><?php echo wp_kses_post( $title ); ?></h4>
	<?php
}

/**
 * Outputs Legend for Fieldsets
 */
function electro_wp_legend_sub( $title ) {
	?>
	<h6 class="ec-legend-sub"><?php echo wp_kses_post( $title ); ?></h6>
	<?php
}

function electro_wp_upload_image( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      	= isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['placeholder']	= isset( $field['placeholder'] ) ? $field['placeholder'] : false;

	if ( absint( $field['value'] ) ) {
		$image = wp_get_attachment_thumb_url( $field['value'] );
	} elseif ( $field['placeholder'] ) {
		$image = wc_placeholder_img_src();
	} else {
		$image = '';
	}

	echo '<p id="' . esc_attr( $field['id'] ) . '_field" class="form-field media-option ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	?>
		<?php if ( isset ( $image ) ) : ?>
		<img src="<?php echo esc_attr( $image ); ?>" class="upload_image_preview" data-placeholder-src="<?php echo esc_attr( wc_placeholder_img_src() ); ?>" alt="" />
		<?php endif; ?>
		<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>" class="upload_image_id" value="<?php echo esc_attr( $field['value'] ); ?>" />
		<a href="#" class="button ec_upload_image_button tips"><?php echo esc_html__( 'Upload/Add image', 'electro' ); ?></a>
		<a href="#" class="button ec_remove_image_button tips"><?php echo esc_html__( 'Remove this image', 'electro' ); ?></a>
	</p>
	<?php
}

function electro_wp_animation_dropdown( $field ) {
	
	electro_wp_select( array(
		'id'		=> $field['name'] . '_products_choice',
		'label'		=> '',
		'class'		=> 'animation_dropdown',
		'name'		=> isset( $field['name'] ) ? $field['name'] : $field['id'],
		'value'		=> isset( $field['value'] ) ? $field['value'] : '',
		'options'	=> array(
			'' => esc_html__( 'No Animation', 'electro' ),
			'bounce' => 'bounce',
			'flash' => 'flash',
			'pulse' => 'pulse',
			'rubberBand' => 'rubberBand',
			'shake' => 'shake',
			'swing' => 'swing',
			'tada' => 'tada',
			'wobble' => 'wobble',
			'jello' => 'jello',
			'bounceIn' => 'bounceIn',
			'bounceInDown' => 'bounceInDown',
			'bounceInLeft' => 'bounceInLeft',
			'bounceInRight' => 'bounceInRight',
			'bounceInUp' => 'bounceInUp',
			'bounceOut' => 'bounceOut',
			'bounceOutDown' => 'bounceOutDown',
			'bounceOutLeft' => 'bounceOutLeft',
			'bounceOutRight' => 'bounceOutRight',
			'bounceOutUp' => 'bounceOutUp',
			'fadeIn' => 'fadeIn',
			'fadeInDown' => 'fadeInDown',
			'fadeInDownBig' => 'fadeInDownBig',
			'fadeInLeft' => 'fadeInLeft',
			'fadeInLeftBig' => 'fadeInLeftBig',
			'fadeInRight' => 'fadeInRight',
			'fadeInRightBig' => 'fadeInRightBig',
			'fadeInUp' => 'fadeInUp',
			'fadeInUpBig' => 'fadeInUpBig',
			'fadeOut' => 'fadeOut',
			'fadeOutDown' => 'fadeOutDown',
			'fadeOutDownBig' => 'fadeOutDownBig',
			'fadeOutLeft' => 'fadeOutLeft',
			'fadeOutLeftBig' => 'fadeOutLeftBig',
			'fadeOutRight' => 'fadeOutRight',
			'fadeOutRightBig' => 'fadeOutRightBig',
			'fadeOutUp' => 'fadeOutUp',
			'fadeOutUpBig' => 'fadeOutUpBig',
			'flip' => 'flip',
			'flipInX' => 'flipInX',
			'flipInY' => 'flipInY',
			'flipOutX' => 'flipOutX',
			'flipOutY' => 'flipOutY',
			'lightSpeedIn' => 'lightSpeedIn',
			'lightSpeedOut' => 'lightSpeedOut',
			'rotateIn' => 'rotateIn',
			'rotateInDownLeft' => 'rotateInDownLeft',
			'rotateInDownRight' => 'rotateInDownRight',
			'rotateInUpLeft' => 'rotateInUpLeft',
			'rotateInUpRight' => 'rotateInUpRight',
			'rotateOut' => 'rotateOut',
			'rotateOutDownLeft' => 'rotateOutDownLeft',
			'rotateOutDownRight' => 'rotateOutDownRight',
			'rotateOutUpLeft' => 'rotateOutUpLeft',
			'rotateOutUpRight' => 'rotateOutUpRight',
			'slideInUp' => 'slideInUp',
			'slideInDown' => 'slideInDown',
			'slideInLeft' => 'slideInLeft',
			'slideInRight' => 'slideInRight',
			'slideOutUp' => 'slideOutUp',
			'slideOutDown' => 'slideOutDown',
			'slideOutLeft' => 'slideOutLeft',
			'slideOutRight' => 'slideOutRight',
			'zoomIn' => 'zoomIn',
			'zoomInDown' => 'zoomInDown',
			'zoomInLeft' => 'zoomInLeft',
			'zoomInRight' => 'zoomInRight',
			'zoomInUp' => 'zoomInUp',
			'zoomOut' => 'zoomOut',
			'zoomOutDown' => 'zoomOutDown',
			'zoomOutLeft' => 'zoomOutLeft',
			'zoomOutRight' => 'zoomOutRight',
			'zoomOutUp' => 'zoomOutUp',
			'hinge' => 'hinge',
			'rollIn' => 'rollIn',
			'rollOut' => 'rollOut',
		),
	) );
}

/**
 * Output input fields to choose a Owl Carousel Options
 */
function electro_wp_owl_carousel_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'autoplay', 'responsive' );
	$field['screens']	= isset( $field['screens'] ) ? $field['screens'] : array( '0' => array( 'items' ), '480' => array( 'items' ), '768' => array( 'items' ), '992' => array( 'items' ), '1200' => array( 'items' ) );

	echo '<div class="electro-owl-carousel-options">';

	if( isset( $field['label'] ) ) {
		electro_wp_legend_sub( $field['label'] );
	}

	if( isset( $field['fields'] ) && in_array( 'autoplay', $field['fields'] )  ) {
		electro_wp_checkbox( array(
			'id'			=> $field['id'] . '_autoplay',
			'label'			=> esc_html__( 'Autoplay', 'electro' ),
			'name'			=> $field['name'] . '[autoplay]',
			'value'			=> isset( $field['value']['autoplay'] ) ? $field['value']['autoplay'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'dots', $field['fields'] )  ) {
		electro_wp_checkbox( array(
			'id'			=> $field['id'] . '_dots',
			'label'			=> esc_html__( 'Dots', 'electro' ),
			'name'			=> $field['name'] . '[dots]',
			'value'			=> isset( $field['value']['dots'] ) ? $field['value']['dots'] : 'no',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'nav', $field['fields'] )  ) {
		electro_wp_checkbox( array(
			'id'			=> $field['id'] . '_nav',
			'label'			=> esc_html__( 'Navigation', 'electro' ),
			'name'			=> $field['name'] . '[nav]',
			'value'			=> isset( $field['value']['nav'] ) ? $field['value']['nav'] : 'no',
		) );
	}

	if( apply_filters( 'electro_enable_home_carousel_args_responsive', false ) && isset( $field['fields'] ) && in_array( 'responsive', $field['fields'] )  ) {
		electro_wp_owl_carousel_responsive_options( array(
			'id'			=> $field['id'] . '_responsive',
			'label'			=> esc_html__( 'Responsive', 'electro' ),
			'name'			=> $field['name'] . '[responsive]',
			'value'			=> isset( $field['value']['responsive'] ) ? $field['value']['responsive'] : '',
			'screens'		=> $field['screens']
		) );
	}

	echo '</div>';
}

/**
 * Output input fields to choose a Owl Carousel Responsive Options
 */
function electro_wp_owl_carousel_responsive_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['screens']	= isset( $field['screens'] ) ? $field['screens'] : array( '0' => array( 'items' ), '480' => array( 'items' ), '768' => array( 'items' ), '992' => array( 'items' ), '1200' => array( 'items' ) );

	echo '<div class="electro-owl-carousel-responsive-options">';

	if( isset( $field['label'] ) ) {
		electro_wp_legend_sub( $field['label'] );
	}

	if( isset( $field['screens'] ) && is_array( $field['screens'] ) ) {
		foreach ( $field['screens'] as $screen_width => $screen_fields ) {
			if( in_array( 'items', $screen_fields ) ) {
				electro_wp_legend_sub( esc_html__( 'For screen above ', 'electro' ) . $screen_width );
				
				electro_wp_text_input( array(
					'id'			=> $field['id'] . '_' . $screen_width . '_items',
					'label'			=> esc_html__( 'Items', 'electro' ),
					'name'			=> $field['name'] . '[' . $screen_width . '][items]',
					'value'			=> isset( $field['value'][$screen_width]['items'] ) ? $field['value'][$screen_width]['items'] : '',
				) );
			}
		}
	}

	echo '</div>';
}

function electro_wp_nav_menus_dropdown( $field ) {

	$nav_menus = wp_get_nav_menus();

	$nav_menus_option = array(
		'' => esc_html__( 'Select a menu', 'electro' )
	);
	
	foreach ( $nav_menus as $key => $nav_menu ) {
		$nav_menus_option[$nav_menu->slug] = $nav_menu->name;
	}
	
	electro_wp_select( array(
		'id'		=> $field['name'] . '_products_choice',
		'label'		=> esc_html__( 'Menu', 'electro' ),
		'class'		=> 'animation_dropdown',
		'name'		=> isset( $field['name'] ) ? $field['name'] : $field['id'],
		'value'		=> isset( $field['value'] ) ? $field['value'] : '',
		'options'	=> $nav_menus_option
	) );
}