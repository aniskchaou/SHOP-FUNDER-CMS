<?php
/**
 * Creates Static Block Post Type
 * ................................................................
 * 
 * Includes reference by function or shortcode.
 *
 * PHP:       the_static_block($id, $args);  // $id can be the database ID or WP slug, $args are same as static block, return value is echo
 * Shortcode: [static_content id="123" showtitle="true"]  (again, the id value can be $id or $slug)
 * Shortcode: [static_block id="123"]  (another name for the shortcode, identical functionality)
 *
 * 
 * Shortcode args:
 *
 * @id        (int, required) The $post-ID or $slug of the Static Block
 * @post_type (string)        Default is 'static_block'. Setting this to 'page' or 'post' would query those post types.
 * @class     (string)        Optional class name to add to the content block.
 * @title     (string)        Optional tite text to be used, overrides title given to static block.
 * @showtitle (bool)          If 'true' the title from the static block will be added.
 * @titletag  (string)        Default is 'h3'. This wil specify the title element '<h3>$title</h3>'
 *
 * 
 * ................................................................
 * Based on the code "WP Boilerplate Shortcode" by Mike Schinkel
 * http://mikeschinkel.com/wordpress-plugins/wp-boilerplate-shortcode/
 * http://mikeschinkel.com/wordpress-plugins/
 * ................................................................
 */

if( ! class_exists( 'StaticBlockContent' ) ) {
	#-----------------------------------------------------------------
	# Static Block Class
	#-----------------------------------------------------------------
	class StaticBlockContent {
		
		static function onload() {
			add_action('init', array(__CLASS__,'init_static_blocks'));
			add_action("after_switch_theme", "flush_rewrite_rules", 10 ,  2); // update permalinks for new rewrite rules
			add_shortcode('static_content', array(__CLASS__,'static_content_shortcode'));
			add_shortcode('static_block', array(__CLASS__,'static_content_shortcode'));
		}
		
		static function init_static_blocks() {
			if (function_exists('register_post_type')) {
				register_post_type('static_block',
					array(
						'labels' => array(
							'name' 					=>	esc_html_x('Static Content Blocks', 'post type general name', 'electro-extensions'),
							'singular_name' 		=>	esc_html_x('Static Block', 'post type singular name', 'electro-extensions'),
							'add_new' 				=>	esc_html_x('Add New', 'block', 'electro-extensions'),
							'add_new_item' 			=>	esc_html__('Add New Block', 'electro-extensions'),
							'edit_item' 			=>	esc_html__('Edit Block', 'electro-extensions'),
							'new_item' 				=>	esc_html__('New Block', 'electro-extensions'),
							'all_items' 			=>	esc_html__('Static Blocks', 'electro-extensions'),
							'view_item' 			=>	esc_html__('View Block', 'electro-extensions'),
							'search_items' 			=>	esc_html__('Search', 'electro-extensions'),
							'not_found' 			=>	esc_html__('No blocks found', 'electro-extensions'),
							'not_found_in_trash' 	=>	esc_html__('No blocks found in Trash', 'electro-extensions'), 
							'parent_item_colon' 	=> '',
							'menu_name' 			=> 'Static Content'
						),
						'exclude_from_search' => true,
						'publicly_queryable'  => true,
						'public'              => true,
						'show_ui'             => true,
						'show_in_rest'        => true,
						'query_var'           => 'static_block',
						'rewrite'             => array('slug' => 'static_block'),
						'supports'            => array(
							'title',
							'editor',
							'revisions',
						),
					)
				);
			}
		}

		// Retrieves content for Static Blocks (could also get pages, posts, etc.)
		static function get_static_content($args=array()) {
			
			$default = array(
				'id' 		=> false,
				'post_type' => 'static_block',
				'class'		=> '',
				'title' 	=> '',
				'showtitle' => false,
				'titletag' 	=> 'h3',
			);
			$args = (object)array_merge($default,$args);

			// Find the page data
			if (!empty($args->id)) {
				// Get content by ID or slug
				$id = $args->id;
				$id = (!is_numeric($id)) ? get_ID_by_slug($id, $args->post_type) : $id;
				// Get the page contenet
				$page_data = get_page( $id );
			} else {
				$page_data = null;
			}

			// Format and return data
			if (is_null($page_data))
				return '<!-- [No arguments where provided or the values did not match an existing static block] -->';
			else {

				// The content
				$content = $page_data->post_content;
				$content = apply_filters('static_content', $content);

				// NOTE: This entire section could be setup as a filter.
				if (get_post_meta($id, 'content_filters', true) == 'all') {
					// Apply all WP content filters, including those added by plugins. 
					// This can still have autop turned off with our internal filter.
					$GLOBALS['wpautop_post'] = $page_data; // not default $post so global variable used by wpautop_disable(), if function exists
					$content = apply_filters('the_content', $content);
				} else {
					// Only apply default WP filters. This is the safe way to add basic formatting without any plugin injected filters
					$content = wptexturize($content);
					$content = convert_smilies($content);
					$content = convert_chars($content);
					if (get_post_meta($id, 'wpautop', true) == 'on') { // (!wpautop_disable($id)) {
						$content = wpautop($content); // Add paragraph tags.
					}
					$content = shortcode_unautop($content);
					$content = prepend_attachment($content);
					$content = do_shortcode($content);
				}
				$class = (!empty($args->class)) ? trim($args->class) : '';
				$content = '<div id="static-content-' . $id . '" class="static-content '. $class .'">'. $content .'</div>';

				// The title
				if (!empty($args->title)){
					$title = $args->title;
					$showtitle = true;
				} else {
					$title = $page_data->post_title;
					$showtitle = $args->showtitle;
				}
				if ($showtitle) $content =  '<'. $args->titletag .' class="static-content-title page-title">'. $page_data->post_title .'</'. $args->titletag .'>' . $content; 

				// Return content
				return  $content;
			}
		}

		// Generate static content from shortcode
		static function static_content_shortcode($args=array()) {
			if (!isset($args['class'])) {
				$args['class'] = '';
			} 
			$args['class'] .= ' from-shortcode';
			return self::get_static_content($args);
		}	
	}
}

// Initialize
//................................................................
if( method_exists( 'StaticBlockContent', 'onload') ) {
	StaticBlockContent::onload();
}

if ( ! function_exists( 'the_static_block' ) ) {
	// Easy access to static block output
	//................................................................
	function the_static_block( $id = false, $args = array() ) {
		if ($id) {
			$args["id"] = $id;
			echo StaticBlockContent::get_static_content($args);
		}
	}
}

// HELPER: Get content ID by slug 
//................................................................
if ( ! function_exists( 'get_ID_by_slug' ) ) :

	function get_ID_by_slug($slug, $post_type = 'page') {

		// Find the page object (works for any post type)
		$page = get_page_by_path( $slug, 'OBJECT', $post_type );
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	}
endif;

#-----------------------------------------------------------------
# Custom Meta Fields for Static Blocks
#-----------------------------------------------------------------

global $meta_box_static_blocks;

// Define Meta Fields
//................................................................
$meta_box_static_blocks = array(
	'id' 		=> 'theme-meta-box-static-block-filters',
	'title' 	=>  esc_html__('Content Options', 'electro-extensions'),
	'page' 		=> 'static_block',
	'context' 	=> 'side',
	'priority' 	=> 'default',
	'fields' 	=> array(
    	array(
    	   'name' 		=> esc_html__('Content Filters', 'electro-extensions'),
    	   'desc' 		=> esc_html__('Apply all WP content filters? This will include plugin added filters.', 'electro-extensions'),
    	   'id' 		=> 'content_filters',
    	   'type' 		=> 'radio',
    	   'std' 		=> '',
    	   'options'	=> array(
    	   		'default'	=> esc_html__('Defaults (recommended)', 'electro-extensions'),
    	   		'all' 		=> esc_html__('All Content Filters', 'electro-extensions')
    	   	)
    	),
    	array(
    	   'name' 		=> esc_html__('Auto Paragraphs', 'electro-extensions'),
    	   'desc' 		=> esc_html__('Add &lt;p&gt; and &lt;br&gt; tags automatically. (disabling may fix layout issues)', 'electro-extensions'),
    	   'id' 		=> 'wpautop',
    	   'type' 		=> 'radio',
    	   'std' 		=> '',
    	   'options' 	=> array(
    	   		'on' 	=> esc_html__('On', 'electro-extensions'),
    	   		'off' 	=> esc_html__('Off', 'electro-extensions')
    	   	)
    	)
   	)
);

/*-----------------------------------------------------------------------------------*/
/*	Add metabox to Static Block edit screen
/*-----------------------------------------------------------------------------------*/
 
function electro_add_box_static_blocks() {
	global $meta_box_static_blocks;
	
	add_meta_box(
		$meta_box_static_blocks['id'], 
		$meta_box_static_blocks['title'], 
		'electro_show_box_static_blocks', 
		$meta_box_static_blocks['page'], 
		$meta_box_static_blocks['context'], 
		$meta_box_static_blocks['priority']
	);

}

add_action('admin_menu', 'electro_add_box_static_blocks');


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function electro_show_box_static_blocks() {
	global $meta_box_static_blocks, $post;
 	
	// Use nonce for verification
	echo '<input type="hidden" name="electro_meta_box_nonce" value="', wp_create_nonce( plugin_basename(__FILE__) ), '" />';
  
  	$increment = 0;
	foreach ($meta_box_static_blocks['fields'] as $field) {
		// some styling
		$style = ($increment) ? 'border-top: 1px solid #dfdfdf;' : '';
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		switch ($field['type']) {

			//If radio array		
			case 'radio':

				echo '<div class="metaField_field_wrapper metaField_field_'.$field['id'].'" style="'.$style.'">',
				     '<p><label for="'.$field['id'].'"><strong>'.$field['name'].'</strong></label></p>';

				$count = 0;
				foreach ($field['options'] as $key => $label) {
					$checked = ($meta == $key || (!$meta && !$count)) ? 'checked="checked"' : '';
					echo '<label class="metaField_radio" style="display: block; padding: 2px 0;"><input class="metaField_radio" type="radio" name="'.$field['id'].'" value="'.$key.'" '.$checked.'> '.$label.'</label>';
					$count++;
				}
				
				echo '<p class="metaField_caption" style="color:#999">'.$field['desc'].'</p>',
				     '</div>';
			
			break;           
			
		}

		$increment++;
	}
 
}


add_action('save_post', 'electro_save_data_static_blocks');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function electro_save_data_static_blocks($post_id) {
	global $meta_box_static_blocks;
 
	// verify nonce
	if ( !isset($_POST['electro_meta_box_nonce']) || !wp_verify_nonce($_POST['electro_meta_box_nonce'], plugin_basename(__FILE__))) {
		return $post_id;
	}
 
	// check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box_static_blocks['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}