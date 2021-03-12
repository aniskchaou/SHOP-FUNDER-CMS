<?php

if( ! function_exists( 'electro_is_mas_static_content_migrated' ) ) {
	function electro_is_mas_static_content_migrated() {
		$static_blocks = wp_count_posts( 'static_block' );

		if ( isset( $static_blocks->publish ) && $static_blocks->publish == 0 ) {
			update_option( 'electro_is_mas_static_content_migrated', true );
		}

		return get_option( 'electro_is_mas_static_content_migrated', false );
	}
}

if( ! function_exists( 'electro_posts_convert_post_type' ) ) {
	function electro_posts_convert_post_type( $from = '', $to = '' ) {

		if( ! empty( $from ) && post_type_exists( $from ) && ! empty( $to ) && post_type_exists( $to ) ) {
			global $wpdb;

			$results = $wpdb->query( $wpdb->prepare( "
				UPDATE `{$wpdb->posts}`
				SET `post_type` = %s
				WHERE `post_type` = %s
			", $to, $from ) );

			if( $results > 0 ) {
				$results_menu = $wpdb->query( $wpdb->prepare( "
					UPDATE `{$wpdb->postmeta}`
					SET `meta_value` = %s
					WHERE `meta_value` = %s
				", $to, $from ) );
			}

			return true;
		}

		return false;
	}
}

if( ! function_exists( 'electro_mas_static_content_migrate' ) ) {
	function electro_mas_static_content_migrate() {
		if( ! electro_is_mas_static_content_migrated() ) {
			$is_migrated = false;

			if( isset( $_GET[ 'do_migrate_mas_static_content' ] ) && $_GET[ 'do_migrate_mas_static_content' ] == 'yes' ) {
				$is_migrated = electro_posts_convert_post_type( 'static_block', 'mas_static_content' );

				if( $is_migrated ) {
					add_option( 'electro_is_mas_static_content_migrated', true, '', 'yes' );

					// Redirect and strip query string.
					wp_redirect( esc_url_raw( add_query_arg( 'mas_static_content_migrated', 'yes', admin_url( 'index.php' ) ) ) );
				} else {
					// Redirect and strip query string.
					wp_redirect( esc_url_raw( add_query_arg( 'mas_static_content_migrated', 'no', admin_url( 'index.php' ) ) ) );
				}
			}
		}
	}
}

if( ! function_exists( 'electro_mas_static_content_migrate_notices' ) ) {
	function electro_mas_static_content_migrate_notices() {
		if( ! electro_is_mas_static_content_migrated() ) {
			?>
			<div id="message" class="updated electro-message">
				<p><strong><?php echo esc_html__( 'MAS Static Content Migrate', 'electro-extensions' ); ?></strong> &#8211; <?php echo esc_html__( 'This process will move all posts from Static Blocks to MAS Static Contents.', 'electro-extensions' ); ?></p>
				<p class="submit"><a href="<?php echo esc_url( add_query_arg( 'do_migrate_mas_static_content', 'yes', admin_url( 'admin.php' ) ) ); ?>" class="mas-static-content-migrate-now button-primary"><?php echo esc_html__( 'Run the updater', 'electro-extensions' ); ?></a></p>
			</div>
			<script type="text/javascript">
				jQuery( '.mas-static-content-migrate-now' ).click( 'click', function() {
					return window.confirm( '<?php echo esc_js( __( 'It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', 'electro-extensions' ) ); ?>' );
				});
			</script>
			<?php
		}

		if( isset( $_GET[ 'mas_static_content_migrated' ] ) && $_GET[ 'mas_static_content_migrated' ] == 'yes' ) {
			echo '<div class="updated"><p>' . esc_html__( 'MAS Static Content posts migrated.', 'electro-extensions' ) . '</p></div>';
		} elseif( isset( $_GET[ 'mas_static_content_migrated' ] ) && $_GET[ 'mas_static_content_migrated' ] == 'no' ) {
			echo '<div class="error"><p>' . esc_html__( 'MAS Static Content posts migration failed. Please try again.', 'electro-extensions' ) . '</p></div>';
		}
	}
}

add_action( 'admin_init', 'electro_mas_static_content_migrate' );
add_action( 'admin_notices', 'electro_mas_static_content_migrate_notices' );
