<?php
/**
 * Class to setup Brands attribute
 *
 * @package Electro/WooCommerce
 */

class Electro_Product_Categories {

	public function __construct() {

		// Add scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'load_wp_media_files' ), 0 );

		// Add form
		add_action( "product_cat_add_form_fields",				array( $this, 'add_category_fields' ), 10 );
		add_action( "product_cat_edit_form_fields",				array( $this, 'edit_category_fields' ), 10, 2 );
		add_action( 'create_term',								array( $this, 'save_category_fields' ), 10, 3 );
		add_action( 'edit_term',								array( $this, 'save_category_fields' ), 10, 3 );

		// Add columns
		if( 0 ) {
			add_filter( "manage_edit-product_cat_columns",			array( $this, 'product_category_columns') );
			add_filter( "manage_product_cat_custom_column",			array( $this, 'product_category_column' ), 10, 3 );
		}
	}

	/**
	 * Loads WP Media Files
	 *
	 * @return void
	 */
	public function load_wp_media_files() {
		wp_enqueue_media();
	}

	/**
	 * Product Category static block fields.
	 *
	 * @return void
	 */
	public function add_category_fields() {
		?>
		<div class="form-field">
			<?php 
				if( post_type_exists( 'mas_static_content' ) ) :

					$args = array(
						'posts_per_page'	=> -1,
						'orderby'			=> 'title',
						'post_type'			=> 'mas_static_content',
					);
					$static_blocks = get_posts( $args );
				endif;
			?>
			<div class="form-group">
				<label><?php _e( 'Jumbotron', 'electro' ); ?></label>
				<select id="procuct_cat_static_block_id" class="form-control" name="procuct_cat_static_block_id">
					<option><?php echo __( 'Select a Static Block', 'electro' ); ?></option>
				<?php if( !empty( $static_blocks ) ) : ?>
				<?php foreach( $static_blocks as $static_block ) : ?>
					<option value="<?php echo esc_attr( $static_block->ID ); ?>"><?php echo get_the_title( $static_block->ID ); ?></option>
				<?php endforeach; ?>
				<?php endif; ?>
				</select>
			</div>

			<div class="form-group">
				<label><?php _e( 'Bottom Jumbotron', 'electro' ); ?></label>
				<select id="procuct_cat_static_block_bottom_id" class="form-control" name="procuct_cat_static_block_bottom_id">
					<option><?php echo __( 'Select a Static Block', 'electro' ); ?></option>
				<?php if( !empty( $static_blocks ) ) : ?>
				<?php foreach( $static_blocks as $static_block ) : ?>
					<option value="<?php echo esc_attr( $static_block->ID ); ?>"><?php echo get_the_title( $static_block->ID ); ?></option>
				<?php endforeach; ?>
				<?php endif; ?>
				</select>
			</div>
			<div class="clear"></div>
			<div class="form-field">
                <label for="category_icon"><?php esc_html_e( 'Icon for category', 'electro' ); ?></label>
                <input type="text" name="category_icon" id="category_icon" value autocomplete="off">
                <p class="description"><?php esc_html_e( 'This is alternative for font based icons','electro' ); ?></p>
            </div>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Edit Category static block fields.
	 *
	 * @param mixed $term Term (product_cat) being edited
	 * @param mixed $taxonomy Taxonomy of the term being edited
	 */
	public function edit_category_fields( $term, $taxonomy ) {

		$static_block_id 		= '';
		$static_block_bottom_id = '';
		$static_block_id 		= defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.6', '<' ) ? absint( get_woocommerce_term_meta( $term->term_id, 'static_block_id', true ) ) : absint( get_term_meta( $term->term_id, 'static_block_id', true ) );
		$static_block_bottom_id = defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.6', '<' ) ? absint( get_woocommerce_term_meta( $term->term_id, 'static_block_bottom_id', true ) ) : absint( get_term_meta( $term->term_id, 'static_block_bottom_id', true ) );
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Top Jumbotron', 'electro' ); ?></label></th>
			<td>
				<?php 
					if( post_type_exists( 'mas_static_content' ) ) :

						$args = array(
							'posts_per_page'	=> -1,
							'orderby'			=> 'title',
							'post_type'			=> 'mas_static_content',
						);
						$static_blocks = get_posts( $args );
					endif;
				?>
				<div class="form-group">
					<select id="procuct_cat_static_block_id" class="form-control" name="procuct_cat_static_block_id">
						<option><?php echo __( 'Select a Static Block', 'electro' ); ?></option>
					<?php if( !empty( $static_blocks ) ) : ?>
					<?php foreach( $static_blocks as $static_block ) : ?>
						<option value="<?php echo esc_attr( $static_block->ID ); ?>" <?php echo ( $static_block_id == $static_block->ID  ? 'selected' : '' ); ?>><?php echo get_the_title( $static_block->ID ); ?></option>
					<?php endforeach; ?>
					<?php endif; ?>
					</select>
				</div>
				<div class="clear"></div>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Bottom Jumbotron', 'electro' ); ?></label></th>
			<td>
				<?php 
					if( post_type_exists( 'mas_static_content' ) ) :

						$args = array(
							'posts_per_page'	=> -1,
							'orderby'			=> 'title',
							'post_type'			=> 'mas_static_content',
						);
						$static_blocks = get_posts( $args );
					endif;
				?>

				<div class="form-group">
					<select id="procuct_cat_static_block_bottom_id" class="form-control" name="procuct_cat_static_block_bottom_id">
						<option><?php echo __( 'Select a Static Block', 'electro' ); ?></option>
					<?php if( !empty( $static_blocks ) ) : ?>
					<?php foreach( $static_blocks as $static_block ) : ?>
						<option value="<?php echo esc_attr( $static_block->ID ); ?>" <?php echo esc_attr( $static_block_bottom_id == $static_block->ID  ? 'selected' : '' ); ?>><?php echo get_the_title( $static_block->ID ); ?></option>
					<?php endforeach; ?>
					<?php endif; ?>
					</select>
				</div>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
		$icon = get_term_meta( $term->term_id, 'icon', true );
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="category_icon"><?php esc_html_e( 'Icon for category', 'electro' ); ?></label></th>
            <td>
                <input type="text" name="category_icon" id="category_icon" value="<?php echo esc_attr( $icon ); ?>">
                <p class="description"><?php esc_html_e( 'This is alternative for font based icons','electro' ); ?></p>
            </td>
        </tr>
        <?php
	}

	/**
	 * Save Category static block fields.
	 *
	 * @param mixed $term_id Term ID being saved
	 * @param mixed $tt_id
	 * @param mixed $taxonomy Taxonomy of the term being saved
	 * @return void
	 */
	public function save_category_fields( $term_id, $tt_id, $taxonomy ) {

		if ( isset( $_POST['procuct_cat_static_block_id'] ) )
			update_woocommerce_term_meta( $term_id, 'static_block_id', absint( $_POST['procuct_cat_static_block_id'] ) );

		if ( isset( $_POST['procuct_cat_static_block_bottom_id'] ) )
			update_woocommerce_term_meta( $term_id, 'static_block_bottom_id', absint( $_POST['procuct_cat_static_block_bottom_id'] ) );

		if ( isset( $_POST['category_icon'] ) ) {
            update_term_meta( $term_id, 'icon', $_POST['category_icon'] );
        }

		delete_transient( 'wc_term_counts' );
	}

	/**
	 * Category column added to jumbotron admin.
	 *
	 * @param mixed $columns
	 * @return array
	 */
	public function product_category_columns( $columns ) {
		$new_columns          = array();
		$new_columns['cb']    = $columns['cb'];
		$new_columns['jumbotron'] = __( 'Jumbotron', 'electro' );
		$new_columns['bottom_jumbotron'] = esc_html__( 'Bottom Jumbotron', 'electro' );

		return array_merge( $new_columns, $columns );
	}

	/**
	 * Category column value added to jumbotron admin.
	 *
	 * @param mixed $columns
	 * @param mixed $column
	 * @param mixed $id
	 * @return array
	 */
	public function product_category_column( $columns, $column, $id ) {

		if ( $column == 'jumbotron' ) {
			$static_block_id 	= '';
			$static_block_title = '';
			$static_block_id 	= defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.6', '<' ) ? absint( get_woocommerce_term_meta( $id, 'static_block_id', true ) ) : absint( get_term_meta( $id, 'static_block_id', true ) );
			if ( $static_block_id ) {
				$static_block_title = get_the_title( $static_block_id );
			}

			$columns .= $static_block_title;
		}

		if ( $column == 'bottom_jumbotron' ) {
			$static_block_bottom_id 	= '';
			$static_block_bottom_title = '';
			$static_block_bottom_id 	= defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.6', '<' ) ? absint( get_woocommerce_term_meta( $id, 'static_block_bottom_id', true ) ) : absint( get_term_meta( $id, 'static_block_bottom_id', true ) );
			if ( $static_block_bottom_id ) {
				$static_block_bottom_title = get_the_title( $static_block_bottom_id );
			}

			$columns .= $static_block_bottom_title;
		}

		return $columns;
	}
}

new Electro_Product_Categories;