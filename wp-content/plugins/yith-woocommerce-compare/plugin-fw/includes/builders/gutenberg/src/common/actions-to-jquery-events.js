/**
 * Actions to jQuery events
 */

/**
 * WordPress dependencies
 */
import { addAction } from '@wordpress/hooks';

const actions = [
	'yith_plugin_fw_gutenberg_before_do_shortcode',
	'yith_plugin_fw_gutenberg_success_do_shortcode',
	'yith_plugin_fw_gutenberg_after_do_shortcode'
];

for ( const action of actions ) {
	addAction(
		action,
		'yith-plugin-fw/jquery-events',
		( ...params ) => {
			if ( 'jQuery' in window ) {
				jQuery( document ).trigger( action, Object.values( params ) );
			}
		}
	);
}