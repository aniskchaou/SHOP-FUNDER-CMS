<?php
/**
 * Home v3 Metabox
 *
 * Displays the home v3 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_v3 Class.
 */
class Electro_Meta_Box_Home_v3 {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		global $post, $thepostid;

		wp_nonce_field( 'electro_save_data', 'electro_meta_nonce' );

		$thepostid 		= $post->ID;
		$template_file 	= get_post_meta( $thepostid, '_wp_page_template', true );

		if ( $template_file !== 'template-homepage-v3.php' ) {
			return;
		}

		self::output_home_v3( $post );
	}

	private static function output_home_v3( $post ) {

		$home_v3 = electro_get_home_v3_meta();

		?>
		<div class="panel-wrap meta-box-home">
			<ul class="home_data_tabs ec-tabs">
			<?php
				$product_data_tabs = apply_filters( 'electro_home_v3_data_tabs', array(
					'general' => array(
						'label'  => __( 'General', 'electro' ),
						'target' => 'general_block',
						'class'  => array(),
					),
					'slider' => array(
						'label'  => __( 'Slider', 'electro' ),
						'target' => 'slider_block',
						'class'  => array(),
					),
					'features_list' => array(
						'label'  => __( 'Features List', 'electro' ),
						'target' => 'features_list',
						'class'  => array(),
					),
					'ads_block' => array(
						'label'  => __( 'Ads Block', 'electro' ),
						'target' => 'ads_block',
						'class'  => array(),
					),
					'tabs_carousel' => array(
						'label'  => __( 'Tabs Carousel', 'electro' ),
						'target' => 'tabs_carousel',
						'class'  => array(),
					),
					'products_carousel_with_image' => array(
						'label'  => __( 'Products Carousel with Image', 'electro' ),
						'target' => 'products_carousel_with_image',
						'class'  => array(),
					),
					'cards_carousel' => array(
						'label'  => __( 'Product Cards Carousel - 1', 'electro' ),
						'target' => 'products_cards_carousel',
						'class'  => array(),
					),
					'cards_carousel_2' => array(
						'label'  => __( 'Product Cards Carousel - 2', 'electro' ),
						'target' => 'products_cards_carousel_2',
						'class'  => array(),
					),
					'so_block' => array(
						'label'  => electro_is_wide_enabled() ? esc_html__( '9-1 Products Block', 'electro' ) :esc_html__( '6-1 Products Block', 'electro' ),
						'target' => 'so_block',
						'class'  => array(),
					),
					'hlc_block' => array(
						'label'  => __( 'Categories List Block', 'electro' ),
						'target' => 'hlc_block',
						'class'  => array(),
					),
					'products_carousel' => array(
						'label'  => __( 'Products Carousel', 'electro' ),
						'target' => 'products_carousel',
						'class'  => array(),
					),
					'two_banners'   => array(
                        'label'     => __( 'Two Banners', 'electro' ),
                        'target'    => 'two_banners',
                        'class'     => array(),
                        'is_wide_only' => true,
                    ),
                    'recently_viewed_carousel' => array(
                        'label'  => __( 'Recently Viewed Carousel', 'electro' ),
                        'target' => 'recently_viewed_carousel',
                        'class'  => array(),
                        'is_wide_only' => true,
                    )
				) );
				foreach ( $product_data_tabs as $key => $tab ) {
					if ( isset( $tab['is_wide_only'] ) && $tab['is_wide_only'] && ! electro_is_wide_enabled() ) {
						continue;
					}

					?><li class="<?php echo esc_attr( $key ); ?>_options <?php echo esc_attr( $key ); ?>_tab <?php echo implode( ' ' , $tab['class'] ); ?>">
						<a href="#<?php echo esc_attr( $tab['target'] ); ?>"><?php echo esc_html( $tab['label'] ); ?></a>
					</li><?php
				}
				do_action( 'electro_home_write_panel_tabs' );
			?>
			</ul>
			<div id="general_block" class="panel electro_options_panel">
				<div class="options_group">
				<?php 
					electro_wp_select( array(
						'id'		=> '_home_v3_header_style',
						'label'		=> esc_html__( 'Header Style', 'electro' ),
						'name'		=> '_home_v3[header_style]',
						'options'		=> array(
							'v1'	=> esc_html__( 'Header v1', 'electro' ),
							'v2'	=> esc_html__( 'Header v2', 'electro' ),
							'v3'	=> esc_html__( 'Header v3', 'electro' ),
							'v4'	=> esc_html__( 'Header v4', 'electro' ),
							'v5'    => esc_html__( 'Header v5', 'electro' ),
                            'v6'    => esc_html__( 'Header v6', 'electro' ),
                            'v7'    => esc_html__( 'Header v7', 'electro' ),
                            'v8'    => esc_html__( 'Header v8', 'electro' ),
                            'v9'    => esc_html__( 'Header v9', 'electro' ),
						),
						'value'		=> isset( $home_v3['header_style'] ) ? $home_v3['header_style'] : 'v3',
					) );
				?>
				</div>
				<div class="options_group">
					<?php 
						$home_v3_blocks = array(
							'hpc'   => esc_html__( 'Page content', 'electro' ),
							'sdr'	=> esc_html__( 'Slider', 'electro' ),
							'fl'	=> esc_html__( 'Features List', 'electro' ),
							'ad'	=> esc_html__( 'Ads Block', 'electro' ),
							'pct'	=> esc_html__( 'Tabs Carousel', 'electro' ),
							'pci'	=> esc_html__( 'Products Carousel with Image', 'electro' ),
							'pcc'	=> esc_html__( 'Product Cards Carousel - 1', 'electro' ),
							'pcc2'	=> esc_html__( 'Product Cards Carousel - 2', 'electro' ),
							'so'	=> electro_is_wide_enabled() ? esc_html__( '9-1 Products Block', 'electro' ) :esc_html__( '6-1 Products Block', 'electro' ),
							'hlc'	=> esc_html__( 'Categories List Block', 'electro' ),
							'pc'	=> esc_html__( 'Products Carousel', 'electro' ),
							'tbrs'  => esc_html__( 'Two Banners', 'electro' ),
							'rvp'   => esc_html__( 'Recently Viewed Carousel', 'electro' ),
						);
					?>
					<table class="general-blocks-table widefat striped">
						<thead>
							<tr>
								<th><?php echo esc_html__( 'Block', 'electro' ); ?></th>
								<th><?php echo esc_html__( 'Animation', 'electro' ); ?></th>
								<th><?php echo esc_html__( 'Priority', 'electro' ); ?></th>
								<th><?php echo esc_html__( 'Enabled ?', 'electro' ); ?></th>
							</tr>	
						</thead>
						<tbody>
							<?php foreach( $home_v3_blocks as $key => $home_v3_block ) : ?>

							<?php 
								if ( ! electro_is_wide_enabled() && ( $key == 'tbrs' || $key == 'rvp' ) ) {
									continue;
								}
							?>
							<tr>
								<td><?php echo esc_html( $home_v3_block ); ?></td>
								<td><?php electro_wp_animation_dropdown( array(  'id' => '_home_v3_' . $key . '_animation', 'label'=> '', 'name' => '_home_v3[' . $key . '][animation]', 'value' => isset( $home_v3['' . $key . '']['animation'] ) ? $home_v3['' . $key . '']['animation'] : '', )); ?></td>
								<td><?php electro_wp_text_input( array(  'id' => '_home_v3_' . $key . '_priority', 'label'=> '', 'name' => '_home_v3[' . $key . '][priority]', 'value' => isset( $home_v3['' . $key . '']['priority'] ) ? $home_v3['' . $key . '']['priority'] : 10, ) ); ?></td>
								<td><?php electro_wp_checkbox( array( 'id' => '_home_v3_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v3[' . $key . '][is_enabled]', 'value'=> isset( $home_v3['' . $key . '']['is_enabled'] ) ? $home_v3['' . $key . '']['is_enabled'] : '', ) ); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div><!-- /#general_block -->
			
			<div id="slider_block" class="panel electro_options_panel">
				<div class="options_group">
				<?php 
					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_sdr_shortcode', 
						'label' 		=> esc_html__( 'Shortcode', 'electro' ), 
						'placeholder' 	=> __( 'Enter the shorcode for your slider here', 'electro' ),
						'name'			=> '_home_v3[sdr][shortcode]',
						'value'			=> isset( $home_v3['sdr']['shortcode'] ) ? $home_v3['sdr']['shortcode'] : '',
					) );
				?>
				</div>
			</div><!-- /#slider_block -->

			<div id="features_list" class="panel electro_options_panel">

				<?php electro_wp_legend( esc_html__( 'Feature 1', 'electro' ) ); ?>
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_1_icon',
						'label' 		=> esc_html__( 'Icon', 'electro' ), 
						'placeholder' 	=> __( 'Enter the icon for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][0][icon]',
						'value'			=> isset( $home_v3['fl'][0]['icon'] ) ? $home_v3['fl'][0]['icon'] : 'ec ec-transport',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_1_text',
						'label' 		=> esc_html__( 'Text', 'electro' ), 
						'placeholder' 	=> __( 'Enter the text for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][0][text]',
						'value'			=> isset( $home_v3['fl'][0]['text'] ) ? $home_v3['fl'][0]['text'] : wp_kses_post( __( '<strong>Free Delivery</strong> from $50', 'electro' ) ),
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Feature 2', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_2_icon',
						'label' 		=> esc_html__( 'Icon', 'electro' ), 
						'placeholder' 	=> __( 'Enter the icon for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][1][icon]',
						'value'			=> isset( $home_v3['fl'][1]['icon'] ) ? $home_v3['fl'][1]['icon'] : 'ec ec-customers',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_2_text',
						'label' 		=> esc_html__( 'Text', 'electro' ), 
						'placeholder' 	=> __( 'Enter the text for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][1][text]',
						'value'			=> isset( $home_v3['fl'][1]['text'] ) ? $home_v3['fl'][1]['text'] : wp_kses_post( __( '<strong>99% Positive</strong> Feedbacks', 'electro' ) ),
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Feature 3', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_3_icon',
						'label' 		=> esc_html__( 'Icon', 'electro' ), 
						'placeholder' 	=> __( 'Enter the icon for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][2][icon]',
						'value'			=> isset( $home_v3['fl'][2]['icon'] ) ? $home_v3['fl'][2]['icon'] : 'ec ec-returning',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_3_text',
						'label' 		=> esc_html__( 'Text', 'electro' ), 
						'placeholder' 	=> __( 'Enter the text for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][2][text]',
						'value'			=> isset( $home_v3['fl'][2]['text'] ) ? $home_v3['fl'][2]['text'] : wp_kses_post( __( '<strong>365 days</strong> for free return', 'electro' ) ),
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Feature 4', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_4_icon',
						'label' 		=> esc_html__( 'Icon', 'electro' ), 
						'placeholder' 	=> __( 'Enter the icon for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][3][icon]',
						'value'			=> isset( $home_v3['fl'][3]['icon'] ) ? $home_v3['fl'][3]['icon'] : 'ec ec-payment',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_4_text',
						'label' 		=> esc_html__( 'Text', 'electro' ), 
						'placeholder' 	=> __( 'Enter the text for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][3][text]',
						'value'			=> isset( $home_v3['fl'][3]['text'] ) ? $home_v3['fl'][3]['text'] : wp_kses_post( __( '<strong>Payment</strong> Secure System', 'electro' ) ),
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Feature 5', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_5_icon',
						'label' 		=> esc_html__( 'Icon', 'electro' ), 
						'placeholder' 	=> __( 'Enter the icon for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][4][icon]',
						'value'			=> isset( $home_v3['fl'][4]['icon'] ) ? $home_v3['fl'][4]['icon'] : 'ec ec-tag',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_fl_5_text',
						'label' 		=> esc_html__( 'Text', 'electro' ), 
						'placeholder' 	=> __( 'Enter the text for your features here', 'electro' ),
						'name'			=> '_home_v3[fl][4][text]',
						'value'			=> isset( $home_v3['fl'][4]['text'] ) ? $home_v3['fl'][4]['text'] : wp_kses_post( __( '<strong>Only Best</strong> Brands', 'electro' ) ),
					) );
				?>
				</div>
				
			</div><!-- /#features_list -->
			
			<div id="ads_block" class="panel electro_options_panel">

				<?php electro_wp_legend( esc_html__( 'Ads Block', 'electro' ) ); ?>

				<div class="options_group">
				<?php

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_1_ad_text', 
						'label' 		=> esc_html__( 'Ad Text', 'electro' ), 
						'name'			=> '_home_v3[ad][0][ad_text]',
						'value'			=> isset( $home_v3['ad'][0]['ad_text'] ) ? $home_v3['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <strong>Deals</strong> on the Cameras', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_1_action_text', 
						'label' 		=> esc_html__( 'Action Text', 'electro' ), 
						'name'			=> '_home_v3[ad][0][action_text]',
						'value'			=> isset( $home_v3['ad'][0]['action_text'] ) ? $home_v3['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_1_action_link', 
						'label' 		=> esc_html__( 'Action Link', 'electro' ), 
						'name'			=> '_home_v3[ad][0][action_link]',
						'value'			=> isset( $home_v3['ad'][0]['action_link'] ) ? $home_v3['ad'][0]['action_link'] : '#',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v3_ad_1_ad_image',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v3[ad][0][ad_image]',
						'value'			=> isset( $home_v3['ad'][0]['ad_image'] ) ? $home_v3['ad'][0]['ad_image'] : '',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_1_el_class', 
						'label' 		=> esc_html__( 'Extra Class', 'electro' ), 
						'name'			=> '_home_v3[ad][0][el_class]',
						'value'			=> isset( $home_v3['ad'][0]['el_class'] ) ? $home_v3['ad'][0]['el_class'] : 'col-xs-12 col-sm-4',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

				<div class="options_group">
				<?php

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_2_ad_text', 
						'label' 		=> esc_html__( 'Ad Text', 'electro' ), 
						'name'			=> '_home_v3[ad][1][ad_text]',
						'value'			=> isset( $home_v3['ad'][1]['ad_text'] ) ? $home_v3['ad'][1]['ad_text'] : wp_kses_post( __( 'Shop the <strong>Hottest</strong> Products', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_2_action_text', 
						'label' 		=> esc_html__( 'Action Text', 'electro' ), 
						'name'			=> '_home_v3[ad][1][action_text]',
						'value'			=> isset( $home_v3['ad'][1]['action_text'] ) ? $home_v3['ad'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_2_action_link', 
						'label' 		=> esc_html__( 'Action Link', 'electro' ), 
						'name'			=> '_home_v3[ad][1][action_link]',
						'value'			=> isset( $home_v3['ad'][1]['action_link'] ) ? $home_v3['ad'][1]['action_link'] : '#',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v3_ad_2_ad_image',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v3[ad][1][ad_image]',
						'value'			=> isset( $home_v3['ad'][1]['ad_image'] ) ? $home_v3['ad'][1]['ad_image'] : '',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_2_el_class', 
						'label' 		=> esc_html__( 'Extra Class', 'electro' ), 
						'name'			=> '_home_v3[ad][1][el_class]',
						'value'			=> isset( $home_v3['ad'][1]['el_class'] ) ? $home_v3['ad'][1]['el_class'] : 'col-xs-12 col-sm-4',
					) );
				?>
				</div>

				<?php if ( electro_is_wide_enabled() ) : ?>

				<?php electro_wp_legend( esc_html__( 'Ads Block 3', 'electro' ) ); ?>

				<div class="options_group">
				<?php

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_3_ad_text', 
						'label' 		=> esc_html__( 'Ad Text', 'electro' ), 
						'name'			=> '_home_v3[ad][2][ad_text]',
						'value'			=> isset( $home_v3['ad'][2]['ad_text'] ) ? $home_v3['ad'][2]['ad_text'] : wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_3_action_text', 
						'label' 		=> esc_html__( 'Action Text', 'electro' ), 
						'name'			=> '_home_v3[ad][2][action_text]',
						'value'			=> isset( $home_v3['ad'][2]['action_text'] ) ? $home_v3['ad'][2]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_3_action_link', 
						'label' 		=> esc_html__( 'Action Link', 'electro' ), 
						'name'			=> '_home_v3[ad][2][action_link]',
						'value'			=> isset( $home_v3['ad'][2]['action_link'] ) ? $home_v3['ad'][2]['action_link'] : '#',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v3_ad_3_ad_image',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v3[ad][2][ad_image]',
						'value'			=> isset( $home_v3['ad'][2]['ad_image'] ) ? $home_v3['ad'][2]['ad_image'] : '',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_3_el_class', 
						'label' 		=> esc_html__( 'Extra Class', 'electro' ), 
						'name'			=> '_home_v3[ad][2][el_class]',
						'value'			=> isset( $home_v3['ad'][2]['el_class'] ) ? $home_v3['ad'][2]['el_class'] : 'col-xs-12 col-sm-4',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Ads Block 4', 'electro' ) ); ?>

				<div class="options_group">
				<?php
				
					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_4_ad_text', 
						'label' 		=> esc_html__( 'Ad Text', 'electro' ), 
						'name'			=> '_home_v3[ad][3][ad_text]',
						'value'			=> isset( $home_v3['ad'][3]['ad_text'] ) ? $home_v3['ad'][3]['ad_text'] : wp_kses_post( __( 'the new <strong>360 cameras</strong>', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_4_action_text', 
						'label' 		=> esc_html__( 'Action Text', 'electro' ), 
						'name'			=> '_home_v3[ad][3][action_text]',
						'value'			=> isset( $home_v3['ad'][3]['action_text'] ) ? $home_v3['ad'][3]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_4_action_link', 
						'label' 		=> esc_html__( 'Action Link', 'electro' ), 
						'name'			=> '_home_v3[ad][3][action_link]',
						'value'			=> isset( $home_v3['ad'][3]['action_link'] ) ? $home_v3['ad'][3]['action_link'] : '#',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v3_ad_4_ad_image',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v3[ad][3][ad_image]',
						'value'			=> isset( $home_v3['ad'][3]['ad_image'] ) ? $home_v3['ad'][3]['ad_image'] : '',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v3_ad_4_el_class', 
						'label' 		=> esc_html__( 'Extra Class', 'electro' ), 
						'name'			=> '_home_v3[ad][3][el_class]',
						'value'			=> isset( $home_v3['ad'][3]['el_class'] ) ? $home_v3['ad'][3]['el_class'] : 'col-xs-12 col-sm-4',
					) );
				?>
				</div>
			<?php endif; ?>

			</div><!-- /#ads_block -->

			<div id="tabs_carousel" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php 
					electro_wp_text_input( array( 
						'id'			=> '_home_v3_pct_product_limit', 
						'label' 		=>  esc_html__( 'Products Limit', 'electro' ),
						'placeholder' 	=> esc_html__( 'Enter the number of products to show', 'electro' ),
						'name'			=> '_home_v3[pct][product_limit]',
						'class'			=> 'product_limit',
						'size'			=> 2,
						'value'			=> isset( $home_v3['pct']['product_limit'] ) ? $home_v3['pct']['product_limit'] : 6,
					) );

					electro_wp_select( array( 
						'id'			=> '_home_v3_pct_product_columns', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
							'5'	=> '5',
							'6'	=> '6',
						),
						'class'			=> 'columns_select',
						'default'		=> '3',
						'name'			=> '_home_v3[pct][product_columns]',
						'value'			=> isset( $home_v3['pct']['product_columns'] ) ? $home_v3['pct']['product_columns'] : 3,
					) );
				?>
				</div>

				<?php if ( electro_is_wide_enabled() ) : ?>
				<div class="options_group">
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
				<?php
					electro_wp_select( array( 
						'id'			=> '_home_v3_pct_product_columns_wide', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
							'5' => '5',
							'6' => '6',
						),
						'class'			=> 'columns_select',
						'default'		=> '6',
						'name'			=> '_home_v3[pct][product_columns_wide]',
						'value'			=> isset( $home_v3['pct']['product_columns_wide'] ) ? $home_v3['pct']['product_columns_wide'] : 6,
					) );
				?>
				</div>
				<?php endif; ?>

				<div class="options_group">
				<?php	
					electro_wp_text_input( array( 
						'id'			=> '_home_v3_pct_tabs_1_title', 
						'label' 		=> esc_html__( 'Tab #1 Title', 'electro' ),
						'placeholder' 	=> esc_html__( 'Featured', 'electro' ),
						'name'			=> '_home_v3[pct][tabs][0][title]',
						'value'			=> isset( $home_v3['pct']['tabs'][0]['title'] ) ? $home_v3['pct']['tabs'][0]['title'] : esc_html__( 'Featured', 'electro' ),
					) );

					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v3_pct_tabs_1_content',
						'label'			=> esc_html__( 'Tab #1 Content', 'electro' ),
						'default'		=> 'featured_products',
						'name'			=> '_home_v3[pct][tabs][0][content]',
						'value'			=> isset( $home_v3['pct']['tabs'][0]['content'] ) ? $home_v3['pct']['tabs'][0]['content'] : '',
					) );
				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id'			=> '_home_v3_pct_tabs_2_title', 
						'label' 		=> esc_html__( 'Tab #2 Title', 'electro' ),
						'placeholder' 	=> esc_html__( 'On Sale', 'electro' ),
						'name'			=> '_home_v3[pct][tabs][1][title]',
						'value'			=> isset( $home_v3['pct']['tabs'][1]['title'] ) ? $home_v3['pct']['tabs'][1]['title'] : esc_html__( 'On Sale', 'electro' ),
					) );

					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v3_pct_tabs_2_content',
						'label'			=> esc_html__( 'Tab #2 Content', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v3[pct][tabs][1][content]',
						'value'			=> isset( $home_v3['pct']['tabs'][1]['content'] ) ? $home_v3['pct']['tabs'][1]['content'] : '',
					) );
				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id'			=> '_home_v3_pct_tabs_3_title', 
						'label' 		=> esc_html__( 'Tab #3 Title', 'electro' ),
						'placeholder' 	=> esc_html__( 'Top Rated', 'electro' ),
						'name'			=> '_home_v3[pct][tabs][2][title]',
						'value'			=> isset( $home_v3['pct']['tabs'][2]['title'] ) ? $home_v3['pct']['tabs'][2]['title'] : esc_html__( 'Top Rated', 'electro' ),
					) );
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v3_pct_tabs_3_content',
						'label'			=> esc_html__( 'Tab #3 Content', 'electro' ),
						'default'		=> 'top_rated_products',
						'name'			=> '_home_v3[pct][tabs][2][content]',
						'value'			=> isset( $home_v3['pct']['tabs'][2]['content'] ) ? $home_v3['pct']['tabs'][2]['content'] : '',
					) );
				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_owl_carousel_options( array( 
						'id' 			=> '_home_v3_pct_carousel_args',
						'label'			=> esc_html__( 'Carousel Args', 'electro' ),
						'name'			=> '_home_v3[pct][carousel_args]',
						'value'			=> isset( $home_v3['pct']['carousel_args'] ) ? $home_v3['pct']['carousel_args'] : '',
					) );
				?>
				</div>
			</div>

			<div id="products_carousel_with_image" class="panel electro_options_panel">
				
				<?php electro_wp_legend( esc_html__( 'Image Block', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_upload_image( array(
						'id'			=> '_home_v3_pci_image_bg_img',
						'label'			=> esc_html__( 'Background Image', 'electro' ),
						'name'			=> '_home_v3[pci][image][bg_img]',
						'value'			=> isset( $home_v3['pci']['image']['bg_img'] ) ? $home_v3['pci']['image']['bg_img'] : '',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v3_pci_image_ad_img',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v3[pci][image][ad_img]',
						'value'			=> isset( $home_v3['pci']['image']['ad_img'] ) ? $home_v3['pci']['image']['ad_img'] : '',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Products Carousel Block', 'electro' ) );

				if ( electro_is_wide_enabled() ) { ?>
					<div class="options_group">
						<?php
							electro_wp_text_input( array(
								'id'			=> '_home_v3_pci_section_title',
								'label'			=> esc_html__( 'Section Title', 'electro' ),
								'name'			=> '_home_v3[pcc][section_title]',
								'name'			=> '_home_v3[pci][section_title]',
								'value'			=> isset( $home_v3['pci']['section_title'] ) ? $home_v3['pci']['section_title'] : esc_html__( 'Television Entertainment', 'electro' ),
							) );
							electro_wp_text_input( array(
								'id'			=> '_home_v3_pci_product_limit',
								'label'			=> esc_html__( 'Product Limit', 'electro' ),
								'name'			=> '_home_v3[pci][product_limit]',
								'value'			=> isset( $home_v3['pci']['product_limit'] ) ? $home_v3['pci']['product_limit'] : 15,
								'placeholder'	=> esc_html__( 'Enter number of products to show', 'electro' ),
							) );
							electro_wp_text_input( array(
								'id'			=> '_home_v3_pci_product_rows',
								'label'			=> esc_html__( 'Rows', 'electro' ),
								'name'			=> '_home_v3[pci][product_rows]',
								'value'			=> isset( $home_v3['pci']['product_rows'] ) ? $home_v3['pci']['product_rows'] : 2,
								'placeholder'	=> esc_html__( 'Enter number of rows to display', 'electro' ),
							) );
							electro_wp_text_input( array(
								'id'			=> '_home_v3_pci_product_columns',
								'label'			=> esc_html__( 'Columns', 'electro' ),
								'name'			=> '_home_v3[pci][product_columns_wide]',
								'value'			=> isset( $home_v3['pci']['product_columns_wide'] ) ? $home_v3['pci']['product_columns_wide'] : 2,
								'placeholder'	=> esc_html__( 'Enter number of products to show', 'electro' ),
							) );
							electro_wp_wc_shortcode( array( 
								'id' 			=> '_home_v3_pci_content',
								'label'			=> esc_html__( 'Products', 'electro' ),
								'default'		=> 'best_selling_products',
								'name'			=> '_home_v3[pci][content]',
								'value'			=> isset( $home_v3['pci']['content'] ) ? $home_v3['pci']['content'] : ''
							) );
							electro_wp_owl_carousel_options( array( 
								'id' 			=> '_home_v3_pci_carousel_args',
								'label'			=> esc_html__( 'Carousel Args', 'electro' ),
								'name'			=> '_home_v3[pci][carousel_args]',
								'value'			=> isset( $home_v3['pci']['carousel_args'] ) ? $home_v3['pci']['carousel_args'] : '',
								'fields'		=> array( 'autoplay' )
							) );
						?>
					</div>
				
				<?php } else { ?>
					<div class="options_group">
						<?php
							electro_wp_text_input( array(
								'id'			=> '_home_v3_pci_carousel_section_title',
								'label'			=> esc_html__( 'Section Title', 'electro' ),
								'name'			=> '_home_v3[pci][carousel][section_title]',
								'value'			=> isset( $home_v3['pci']['carousel']['section_title'] ) ? $home_v3['pci']['carousel']['section_title'] : esc_html__( 'Television Entertainment', 'electro' ),
							) );

							electro_wp_text_input( array(
								'id'			=> '_home_v3_pci_carousel_product_limit',
								'label'			=> esc_html__( 'Limit', 'electro' ),
								'name'			=> '_home_v3[pci][carousel][product_limit]',
								'value'			=> isset( $home_v3['pci']['carousel']['product_limit'] ) ? $home_v3['pci']['carousel']['product_limit'] : 8,
							) );
							electro_wp_text_input( array(
								'id'			=> '_home_v3_pci_carousel_product_columns',
								'label'			=> esc_html__( 'Columns', 'electro' ),
								'name'			=> '_home_v3[pci][carousel][product_columns]',
								'value'			=> isset( $home_v3['pci']['carousel']['product_columns'] ) ? $home_v3['pci']['carousel']['product_columns'] : 2,
							) );

							electro_wp_wc_shortcode( array( 
								'id' 			=> '_home_v3_pci_carousel_content',
								'label'			=> esc_html__( 'Products', 'electro' ),
								'default'		=> 'product_category',
								'name'			=> '_home_v3[pci][carousel][content]',
								'value'			=> isset( $home_v3['pci']['carousel']['content'] ) ? $home_v3['pci']['carousel']['content'] : '',
							) );

							electro_wp_owl_carousel_options( array( 
								'id' 			=> '_home_v3_pci_carousel_carousel_args',
								'label'			=> esc_html__( 'Carousel Args', 'electro' ),
								'name'			=> '_home_v3[pci][carousel][carousel_args]',
								'value'			=> isset( $home_v3['pci']['carousel']['carousel_args'] ) ? $home_v3['pci']['carousel']['carousel_args'] : '',
							) );
						?>
					</div>
				<?php } ?>
			</div>
			
			<div id="products_cards_carousel" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v3[pcc][section_title]',
						'default'		=> esc_html__( 'Best Sellers', 'electro' ),
						'value'			=> isset( $home_v3['pcc']['section_title'] ) ? $home_v3['pcc']['section_title'] : esc_html__( 'Best Sellers', 'electro' ),
						'placeholder'	=> esc_html__( 'Best Sellers', 'electro' )
					) );
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc_product_limit',
						'label'			=> esc_html__( 'Product Limit', 'electro' ),
						'name'			=> '_home_v3[pcc][product_limit]',
						'value'			=> isset( $home_v3['pcc']['product_limit'] ) ? $home_v3['pcc']['product_limit'] : 20,
						'placeholder'	=> esc_html__( 'Enter number of products to show', 'electro' ),
					) );
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc_product_rows',
						'label'			=> esc_html__( 'Rows', 'electro' ),
						'name'			=> '_home_v3[pcc][product_rows]',
						'value'			=> isset( $home_v3['pcc']['product_rows'] ) ? $home_v3['pcc']['product_rows'] : 2,
						'placeholder'	=> esc_html__( 'Enter number of rows to display', 'electro' ),
					) );
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc_product_columns',
						'label'			=> esc_html__( 'Columns', 'electro' ),
						'name'			=> '_home_v3[pcc][product_columns]',
						'value'			=> isset( $home_v3['pcc']['product_columns'] ) ? $home_v3['pcc']['product_columns'] : 3,
						'placeholder'	=> esc_html__( 'Enter number of products to show', 'electro' ),
					) );
				?>
				</div>
				<?php if ( electro_is_wide_enabled() ) : ?>
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
					<div class="options_group">
					<?php
						electro_wp_text_input( array(
							'id'			=> '_home_v3_pcc_product_columns_wide',
							'label'			=> esc_html__( 'Columns', 'electro' ),
							'name'			=> '_home_v3[pcc][product_columns_wide]',
							'value'			=> isset( $home_v3['pcc']['product_columns_wide'] ) ? $home_v3['pcc']['product_columns_wide'] : 3,
						) ); 
					?>
					</div>
				<?php endif; ?>
				<div class="options_group"><?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v3_pcc_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'best_selling_products',
						'name'			=> '_home_v3[pcc][content]',
						'value'			=> isset( $home_v3['pcc']['content'] ) ? $home_v3['pcc']['content'] : ''
					) );
					electro_wp_owl_carousel_options( array( 
						'id' 			=> '_home_v3_pcc_carousel_args',
						'label'			=> esc_html__( 'Carousel Args', 'electro' ),
						'name'			=> '_home_v3[pcc][carousel_args]',
						'value'			=> isset( $home_v3['pcc']['carousel_args'] ) ? $home_v3['pcc']['carousel_args'] : '',
						'fields'		=> array( 'autoplay' )
					) );
				?>
				</div>
			</div><!-- /#products_cards_carousel -->

			<div id="products_cards_carousel_2" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc2_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v3[pcc2][section_title]',
						'default'		=> esc_html__( 'Trending Products', 'electro' ),
						'value'			=> isset( $home_v3['pcc2']['section_title'] ) ? $home_v3['pcc2']['section_title'] : esc_html__( 'Trending Products', 'electro' ),
						'placeholder'	=> esc_html__( 'Best Sellers', 'electro' )
					) );
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc2_product_limit',
						'label'			=> esc_html__( 'Product Limit', 'electro' ),
						'name'			=> '_home_v3[pcc2][product_limit]',
						'value'			=> isset( $home_v3['pcc2']['product_limit'] ) ? $home_v3['pcc2']['product_limit'] : 20,
						'placeholder'	=> esc_html__( 'Enter number of products to show', 'electro' ),
					) );
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc2_product_rows',
						'label'			=> esc_html__( 'Rows', 'electro' ),
						'name'			=> '_home_v3[pcc2][product_rows]',
						'value'			=> isset( $home_v3['pcc2']['product_rows'] ) ? $home_v3['pcc2']['product_rows'] : 1,
						'placeholder'	=> esc_html__( 'Enter number of rows to display', 'electro' ),
					) );
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pcc2_product_columns',
						'label'			=> esc_html__( 'Columns', 'electro' ),
						'name'			=> '_home_v3[pcc2][product_columns]',
						'value'			=> isset( $home_v3['pcc2']['product_columns'] ) ? $home_v3['pcc2']['product_columns'] : 3,
						'placeholder'	=> esc_html__( 'Enter number of products to show', 'electro' ),
					) );
				?>
				</div>
				<?php if ( electro_is_wide_enabled() ) : ?>
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
					<div class="options_group">
					<?php
						electro_wp_text_input( array(
							'id'			=> '_home_v3_pcc2_product_columns_wide',
							'label'			=> esc_html__( 'Columns', 'electro' ),
							'name'			=> '_home_v3[pcc2][product_columns_wide]',
							'value'			=> isset( $home_v3['pcc2']['product_columns_wide'] ) ? $home_v3['pcc2']['product_columns_wide'] : 4,
						) ); 
					?>
					</div>
				<?php endif; ?>
				<div class="options_group"><?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v3_pcc2_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'best_selling_products',
						'name'			=> '_home_v3[pcc2][content]',
						'value'			=> isset( $home_v3['pcc2']['content'] ) ? $home_v3['pcc2']['content'] : ''
					) );
					electro_wp_owl_carousel_options( array( 
						'id' 			=> '_home_v3_pcc2_carousel_args',
						'label'			=> esc_html__( 'Carousel Args', 'electro' ),
						'name'			=> '_home_v3[pcc2][carousel_args]',
						'value'			=> isset( $home_v3['pcc2']['carousel_args'] ) ? $home_v3['pcc2']['carousel_args'] : '',
						'fields'		=> array( 'autoplay' )
					) );
				?>
				</div>
			</div><!-- /#products_cards_carousel_2 -->

			<div id="so_block" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v3_so_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v3[so][section_title]',
						'value'			=> isset( $home_v3['so']['section_title'] ) ? $home_v3['so']['section_title'] : esc_html__( 'Best Deals', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v3_so_cat_limit',
						'label'			=> esc_html__( 'Categories Limit', 'electro' ),
						'name'			=> '_home_v3[so][cat_limit]',
						'default'		=> 7,
						'value'			=> isset( $home_v3['so']['cat_limit'] ) ? $home_v3['so']['cat_limit'] : 7,
						'placeholder'	=> 7
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v3_so_cat_slugs',
						'label'			=> esc_html__( 'Category Slug', 'electro' ),
						'name'			=> '_home_v3[so][cat_slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v3['so']['cat_slugs'] ) ? $home_v3['so']['cat_slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v3_so_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v3[so][content]',
						'value'			=> isset( $home_v3['so']['content'] ) ? $home_v3['so']['content'] : ''
					) );
				?>
				</div>
			</div>

			<div id="hlc_block" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v3_hlc_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v3[hlc][section_title]',
						'value'			=> isset( $home_v3['hlc']['section_title'] ) ? $home_v3['hlc']['section_title'] : esc_html__( 'Top Categories this Month', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v3_hlc_cat_slugs',
						'label'			=> esc_html__( 'Category Slug', 'electro' ),
						'name'			=> '_home_v3[hlc][cat_slugs]',
						'value'			=> isset( $home_v3['hlc']['cat_slugs'] ) ? $home_v3['hlc']['cat_slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' ),
					) );
				?>
				</div>
			</div>

			<div id="products_carousel" class="panel electro_options_panel">
				<div class="options_group">
					<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pc_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v3[pc][section_title]',
						'value'			=> isset( $home_v3['pc']['section_title'] ) ? $home_v3['pc']['section_title'] : esc_html__( 'Recently Viewed', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v3_pc_product_limit',
						'label'			=> esc_html__( 'Limit', 'electro' ),
						'name'			=> '_home_v3[pc][product_limit]',
						'value'			=> isset( $home_v3['pc']['product_limit'] ) ? $home_v3['pc']['product_limit'] : 20,
					) );
					electro_wp_text_input( array(
						'id'			=> '_home_v3_pc_product_columns',
						'label'			=> esc_html__( 'Columns', 'electro' ),
						'name'			=> '_home_v3[pc][product_columns]',
						'value'			=> isset( $home_v3['pc']['product_columns'] ) ? $home_v3['pc']['product_columns'] : 5,
					) );

					if ( electro_is_wide_enabled() ) : ?>
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
					<?php
						electro_wp_text_input( array(
							'id'			=> '_home_v3_pc_product_columns_wide',
							'label'			=> esc_html__( 'Columns', 'electro' ),
							'name'			=> '_home_v3[pc][product_columns_wide]',
							'value'			=> isset( $home_v3['pc']['product_columns_wide'] ) ? $home_v3['pc']['product_columns_wide'] : 7,
						) ); 
					
					endif; ?>
				</div>
					
				<div class="options_group"><?php

					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v3_pc_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'recent_products',
						'name'			=> '_home_v3[pc][content]',
						'value'			=> isset( $home_v3['pc']['content'] ) ? $home_v3['pc']['content'] : '',
					) );

					electro_wp_owl_carousel_options( array( 
						'id' 			=> '_home_v3_pc_carousel_args',
						'label'			=> esc_html__( 'Carousel Args', 'electro' ),
						'name'			=> '_home_v3[pc][carousel_args]',
						'value'			=> isset( $home_v3['pc']['carousel_args'] ) ? $home_v3['pc']['carousel_args'] : '',
					) );
				?>
				</div>
			</div>

			<?php if ( electro_is_wide_enabled() ) : ?>

			<div id="two_banners" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Banner 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v3_tbrs_1_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v3[tbrs][0][image]',
                        'value'         => isset( $home_v3['tbrs'][0]['image'] ) ? $home_v3['tbrs'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v3_tbrs_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v3[tbrs][0][action_link]',
                        'value'         => isset( $home_v3['tbrs'][0]['action_link'] ) ? $home_v3['tbrs'][0]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v3_tbrs_2_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v3[tbrs][1][image]',
                        'value'         => isset( $home_v3['tbrs'][1]['image'] ) ? $home_v3['tbrs'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v3_tbrs_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v3[tbrs][1][action_link]',
                        'value'         => isset( $home_v3['tbrs'][1]['action_link'] ) ? $home_v3['tbrs'][1]['action_link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#two_banners -->

            <div id="recently_viewed_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v3_rvp_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v3[rvp][section_title]',
                        'value'         => isset( $home_v3['rvp']['section_title'] ) ? $home_v3['rvp']['section_title'] : esc_html__( 'Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v3_rvp_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v3[rvp][shortcode_atts][per_page]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v3['rvp']['shortcode_atts']['per_page'] ) ? $home_v3['rvp']['shortcode_atts']['per_page'] : '20',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v3_rvp_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the columns', 'electro' ),
                        'name'          => '_home_v3[rvp][product_columns]',
                        'value'         => isset( $home_v3['rvp']['product_columns'] ) ? $home_v3['rvp']['product_columns'] : 10,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php

                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v3_rvp_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v3[rvp][carousel_args]',
                        'value'         => isset( $home_v3['rvp']['carousel_args'] ) ? $home_v3['rvp']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#recently_viewed_carousel -->

            <?php endif; ?>

		</div>
		<?php
	}

	public static function save( $post_id, $post ) {
		if ( isset( $_POST['_home_v3'] ) ) {
			$clean_home_v3_options = electro_clean_kses_post( $_POST['_home_v3'] );
			update_post_meta( $post_id, '_home_v3_options',  serialize( $clean_home_v3_options ) );
		}	
	}
}