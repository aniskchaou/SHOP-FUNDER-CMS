<?php
/**
 * Electro Meta Boxes
 *
 * Sets up the write panels used by products and orders (custom post types).
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Electro_Admin_Meta_Boxes.
 */
class Electro_Admin_Meta_Boxes {

	/**
	 * Is meta boxes saved once?
	 *
	 * @var boolean
	 */
	private static $saved_meta_boxes = false;

	/**
	 * Meta box error messages.
	 *
	 * @var array
	 */
	public static $meta_box_errors  = array();

	/**
	 * Constructor.
	 */
	public function __construct() {
		global $post;

		//add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 10 );
		//add_action( 'add_meta_boxes', array( $this, 'rename_meta_boxes' ), 20 );

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 30 );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );

		// Save Page Meta Boxes
		add_action( 'electro_process_page_home_v1_meta', 'Electro_Meta_Box_Home_v1::save', 10, 2 );
		add_action( 'electro_process_page_home_v2_meta', 'Electro_Meta_Box_Home_v2::save', 10, 2 );
		add_action( 'electro_process_page_home_v3_meta', 'Electro_Meta_Box_Home_v3::save', 10, 2 );
		add_action( 'electro_process_page_home_v4_meta', 'Electro_Meta_Box_Home_v4::save', 10, 2 );
		add_action( 'electro_process_page_home_v5_meta', 'Electro_Meta_Box_Home_v5::save', 10, 2 );
		add_action( 'electro_process_page_home_v6_meta', 'Electro_Meta_Box_Home_v6::save', 10, 2 );
		add_action( 'electro_process_page_home_v7_meta', 'Electro_Meta_Box_Home_v7::save', 10, 2 );
		add_action( 'electro_process_page_home_v8_meta', 'Electro_Meta_Box_Home_v8::save', 10, 2 );
		add_action( 'electro_process_page_home_v9_meta', 'Electro_Meta_Box_Home_v9::save', 10, 2 );
		add_action( 'electro_process_page_home_v10_meta', 'Electro_Meta_Box_Home_v10::save', 10, 2 );
		add_action( 'electro_process_page_home_mobile_v1_meta', 'Electro_Meta_Box_Home_Mobile_v1::save', 10, 2 );
		add_action( 'electro_process_page_home_mobile_v2_meta', 'Electro_Meta_Box_Home_Mobile_v2::save', 10, 2 );
		add_action( 'electro_process_page_meta', 'Electro_Meta_Box_Page::save', 10, 2 );

		// Error handling (for showing errors from meta boxes on next page load)
		add_action( 'admin_notices', array( $this, 'output_errors' ) );
		add_action( 'shutdown', array( $this, 'save_errors' ) );
	}

	/**
	 * Add an error message.
	 * @param string $text
	 */
	public static function add_error( $text ) {
		self::$meta_box_errors[] = $text;
	}

	/**
	 * Save errors to an option.
	 */
	public function save_errors() {
		update_option( 'electro_meta_box_errors', self::$meta_box_errors );
	}

	/**
	 * Show any stored error messages.
	 */
	public function output_errors() {
		$errors = maybe_unserialize( get_option( 'electro_meta_box_errors' ) );

		if ( ! empty( $errors ) ) {

			echo '<div id="electro_errors" class="error notice is-dismissible">';

			foreach ( $errors as $error ) {
				echo '<p>' . wp_kses_post( $error ) . '</p>';
			}

			echo '</div>';

			// Clear
			delete_option( 'electro_meta_box_errors' );
		}
	}

	/**
	 * Add Electro Meta boxes.
	 */
	public function add_meta_boxes( $post_type ) {
		global $post;

		$screen = get_current_screen();

		if ( !( $screen->base == 'post' && $screen->post_type == 'page' ) ) {
			return;
		}

		if ( $post->ID == get_option( 'page_for_posts' ) && empty( $post->post_content ) ) {
			return;
		}

		$template_file = get_post_meta( $post->ID, '_wp_page_template', true );

		switch( $template_file ) {
			case 'template-homepage-v1.php':
			case 'template-homepage-v2.php';
			case 'template-homepage-v3.php':
			case 'template-homepage-v4.php':
			case 'template-homepage-v5.php':
			case 'template-homepage-v6.php':
			case 'template-homepage-v7.php':
			case 'template-homepage-v8.php':
			case 'template-homepage-v9.php':
			case 'template-homepage-v10.php':
			case 'template-homepage-mobile-v1.php':
			case 'template-homepage-mobile-v2.php':
				$this->add_home_meta_boxes( $post_type );
			break;
			default:
				$this->add_page_meta_box( $post_type );
		}
	}

	private function add_page_meta_box() {
		add_meta_box( '_electro_page_metabox', esc_html__( 'Electro Page Options', 'electro' ), 'Electro_Meta_Box_Page::output', 'page', 'normal', 'high' );
	}

	/**
	 * Add Home Meta boxes
	 */
	private function add_home_meta_boxes() {
		global $post;

		$template_file = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( ! ( $template_file === 'template-homepage-v1.php' || $template_file === 'template-homepage-v2.php' || $template_file === 'template-homepage-v3.php' || $template_file === 'template-homepage-v4.php' || $template_file === 'template-homepage-v5.php' || $template_file === 'template-homepage-v6.php'|| $template_file === 'template-homepage-v7.php'| $template_file === 'template-homepage-v8.php'| $template_file === 'template-homepage-v9.php'| $template_file === 'template-homepage-v10.php' || $template_file === 'template-homepage-mobile-v1.php' || $template_file === 'template-homepage-mobile-v2.php' ) ) {
			return;
		}

		switch( $template_file ) {
			case 'template-homepage-v1.php':
				$meta_box_title 	= esc_html__( 'Home v1 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v1::output';
			break;
			case 'template-homepage-v2.php':
				$meta_box_title 	= esc_html__( 'Home v2 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v2::output';
			break;
			case 'template-homepage-v3.php':
				$meta_box_title 	= esc_html__( 'Home v3 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v3::output';
			break;
			case 'template-homepage-v4.php':
				$meta_box_title 	= esc_html__( 'Home v4 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v4::output';
			break;
			case 'template-homepage-v5.php':
				$meta_box_title 	= esc_html__( 'Home v5 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v5::output';
			break;
			case 'template-homepage-v6.php':
				$meta_box_title 	= esc_html__( 'Home v6 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v6::output';
			break;
			case 'template-homepage-v7.php':
				$meta_box_title 	= esc_html__( 'Home v7 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v7::output';
			break;
			case 'template-homepage-v8.php':
				$meta_box_title 	= esc_html__( 'Home v8 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v8::output';
			break;
			case 'template-homepage-v9.php':
				$meta_box_title 	= esc_html__( 'Home v9 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v9::output';
			break;
			case 'template-homepage-v10.php':
				$meta_box_title 	= esc_html__( 'Home v10 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_v10::output';
			break;
			case 'template-homepage-mobile-v1.php':
				$meta_box_title 	= esc_html__( 'Mobile Home v1 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_Mobile_v1::output';
			break;
			case 'template-homepage-mobile-v2.php':
				$meta_box_title 	= esc_html__( 'Mobile Home v2 Options', 'electro' );
				$meta_box_output 	= 'Electro_Meta_Box_Home_Mobile_v2::output';
			break;
		}

		add_meta_box( 'electro-home-page-options', $meta_box_title, $meta_box_output, 'page', 'normal', 'high' );
	}

	/**
	 * Check if we're saving, the trigger an action based on the post type.
	 *
	 * @param  int $post_id
	 * @param  object $post
	 */
	public function save_meta_boxes( $post_id, $post ) {

		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		// Dont' save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the nonce
		if ( empty( $_POST['electro_meta_nonce'] ) || ! wp_verify_nonce( $_POST['electro_meta_nonce'], 'electro_save_data' ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// We need this save event to run once to avoid potential endless loops. This would have been perfect:
		//	remove_action( current_filter(), __METHOD__ );
		// But cannot be used due to https://github.com/woothemes/woocommerce/issues/6485
		// When that is patched in core we can use the above. For now:
		self::$saved_meta_boxes = true;

		$what = $post->post_type;

		if ( $what == 'page' ) {

			$template_file = get_post_meta( $post_id, '_wp_page_template', true );

			switch( $template_file ) {
				case 'template-homepage-v1.php':
					$what .= '_home_v1';
				break;
				case 'template-homepage-v2.php':
					$what .= '_home_v2';
				break;
				case 'template-homepage-v3.php':
					$what .= '_home_v3';
				break;
				case 'template-homepage-v4.php':
					$what .= '_home_v4';
				break;
				case 'template-homepage-v5.php':
					$what .= '_home_v5';
				break;
				case 'template-homepage-v6.php':
					$what .= '_home_v6';
				break;
				case 'template-homepage-v7.php':
					$what .= '_home_v7';
				break;
				case 'template-homepage-v8.php':
					$what .= '_home_v8';
				break;
				case 'template-homepage-v9.php':
					$what .= '_home_v9';
				break;
				case 'template-homepage-v10.php':
					$what .= '_home_v10';
				break;
				case 'template-homepage-mobile-v1.php':
					$what .= '_home_mobile_v1';
				break;
				case 'template-homepage-mobile-v2.php':
					$what .= '_home_mobile_v2';
				break;
			}
		}

		do_action( 'electro_process_' . $what . '_meta', $post_id, $post );
	}
}

new Electro_Admin_Meta_Boxes();
