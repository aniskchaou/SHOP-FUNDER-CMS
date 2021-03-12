<?php
/**
 * Home v4 Metabox
 *
 * Displays the home v4 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_v4 Class
 */
class Electro_Meta_Box_Home_v4 {

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

		if ( $template_file !== 'template-homepage-v4.php' ) {
			return;
		}

		self::output_home_v4( $post );
	}

	private static function output_home_v4( $post ) {

		$home_v4 = electro_get_home_v4_meta();

		?>
		<div class="panel-wrap meta-box-home">
			<ul class="home_data_tabs ec-tabs">
			<?php
				$product_data_tabs = apply_filters( 'electro_home_v4_data_tabs', array(
					'general' => array(
						'label'  => __( 'General', 'electro' ),
						'target' => 'general_block',
						'class'  => array(),
					),
					'slider_with_ads_block' => array(
						'label'  => esc_html__( 'Slider with Ads Block', 'electro' ),
						'target' => 'slider_with_ads_block',
						'class'  => array(),
					),
					'tabs_carousel' => array(
						'label'  => __( 'Tabs Carousel', 'electro' ),
						'target' => 'tabs_carousel',
						'class'  => array(),
					),
					'banner' => array(
						'label'  => __( 'Banner', 'electro' ),
						'target' => 'banner_data',
						'class'  => array(),
					),
					'deal_products_carousel' => array(
						'label'  => __( 'Deal Products Carousel', 'electro' ),
						'target' => 'deal_products_carousel',
						'class'  => array(),
					),
					'products_with_category_image_1' => array(
						'label'  => __( 'Products with Category Image - 1', 'electro' ),
						'target' => 'products_with_category_image_1',
						'class'  => array(),
					),
					'products_with_category_image_2' => array(
						'label'  => __( 'Products with Category Image - 2', 'electro' ),
						'target' => 'products_with_category_image_2',
						'class'  => array(),
					),
					'hcb_block' => array(
						'label'  => __( 'Categories Block', 'electro' ),
						'target' => 'hcb_block',
						'class'  => array(),
					),
					'products_6_1_with_categories_1' => array(
						'label'  => __( '6-1 Products with Categories - 1', 'electro' ),
						'target' => 'products_6_1_with_categories_1',
						'class'  => array(),
					),
					'products_6_1_with_categories_2' => array(
						'label'  => __( '6-1 Products with Categories - 2', 'electro' ),
						'target' => 'products_6_1_with_categories_2',
						'class'  => array(),
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
						'id'		=> '_home_v4_header_style',
						'label'		=> esc_html__( 'Header Style', 'electro' ),
						'name'		=> '_home_v4[header_style]',
						'options'		=> array(
							'v1'	=> esc_html__( 'Header v1', 'electro' ),
							'v2'	=> esc_html__( 'Header v2', 'electro' ),
							'v3'	=> esc_html__( 'Header v3', 'electro' ),
							'v4'	=> esc_html__( 'Header v4', 'electro' ),
							'v5'	=> esc_html__( 'Header v5', 'electro' ),
							'v6'	=> esc_html__( 'Header v6', 'electro' ),
							'v7'    => esc_html__( 'Header v7', 'electro' ),
                            'v8'    => esc_html__( 'Header v8', 'electro' ),
                            'v9'    => esc_html__( 'Header v9', 'electro' ),
						),
						'value'		=> isset( $home_v4['header_style'] ) ? $home_v4['header_style'] : 'v5',
					) );
				?>
				</div>
				<div class="options_group">
					<?php 
						$home_v4_blocks = array(
							'hpc'   => esc_html__( 'Page content', 'electro' ),
							'swa'	=> esc_html__( 'Slider with Ads Block', 'electro' ),
							'pct'	=> esc_html__( 'Tabs Carousel', 'electro' ),
							'bd'	=> esc_html__( 'Banner', 'electro' ),
							'dpc'	=> esc_html__( 'Deal Products Carousel', 'electro' ),
							'pwci1'	=> esc_html__( 'Products with Category Image - 1', 'electro' ),
							'pwci2'	=> esc_html__( 'Products with Category Image - 2', 'electro' ),
							'hcb'	=> esc_html__( 'Categories Block', 'electro' ),
							'sowc1'	=> esc_html__( '6-1 Products with Categories - 1', 'electro' ),
							'sowc2'	=> esc_html__( '6-1 Products with Categories - 2', 'electro' ),
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
							<?php foreach( $home_v4_blocks as $key => $home_v4_block ) : ?>

							<?php 
								if ( ! electro_is_wide_enabled() && ( $key == 'rvp' ) ) {
									continue;
								}
							?>
							<tr>
								<td><?php echo esc_html( $home_v4_block ); ?></td>
								<td><?php electro_wp_animation_dropdown( array(  'id' => '_home_v4_' . $key . '_animation', 'label'=> '', 'name' => '_home_v4[' . $key . '][animation]', 'value' => isset( $home_v4['' . $key . '']['animation'] ) ? $home_v4['' . $key . '']['animation'] : '', )); ?></td>
								<td><?php electro_wp_text_input( array(  'id' => '_home_v4_' . $key . '_priority', 'label'=> '', 'name' => '_home_v4[' . $key . '][priority]', 'value' => isset( $home_v4['' . $key . '']['priority'] ) ? $home_v4['' . $key . '']['priority'] : 10, ) ); ?></td>
								<td><?php electro_wp_checkbox( array( 'id' => '_home_v4_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v4[' . $key . '][is_enabled]', 'value'=> isset( $home_v4['' . $key . '']['is_enabled'] ) ? $home_v4['' . $key . '']['is_enabled'] : '', ) ); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div><!-- /#general_block -->

			<div id="slider_with_ads_block" class="panel electro_options_panel">

				<?php electro_wp_legend( esc_html__( 'Slider', 'electro' ) ); ?>

				<div class="options_group">
				<?php 
					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_shortcode', 
						'label' 		=> esc_html__( 'Shortcode', 'electro' ), 
						'placeholder' 	=> __( 'Enter the shorcode for your slider here', 'electro' ),
						'name'			=> '_home_v4[swa][slider_shortcode]',
						'value'			=> isset( $home_v4['swa']['slider_shortcode'] ) ? $home_v4['swa']['slider_shortcode'] : '',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Ads Block 1', 'electro' ) ); ?>

				<div class="options_group">
				<?php

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_1_text', 
						'label' 		=> esc_html__( 'Ad Text', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][0][ad_text]',
						'value'			=> isset( $home_v4['swa']['ads_args'][0]['ad_text'] ) ? $home_v4['swa']['ads_args'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <br><strong>Deals</strong> on<br>the Cameras', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_1_action_text', 
						'label' 		=> esc_html__( 'Action Text', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][0][action_text]',
						'value'			=> isset( $home_v4['swa']['ads_args'][0]['action_text'] ) ? $home_v4['swa']['ads_args'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_1_action_link', 
						'label' 		=> esc_html__( 'Action Link', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][0][action_link]',
						'value'			=> isset( $home_v4['swa']['ads_args'][0]['action_link'] ) ? $home_v4['swa']['ads_args'][0]['action_link'] : '#',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v4_swa_ad_1_ad_image',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v4[swa][ads_args][0][ad_image]',
						'value'			=> isset( $home_v4['swa']['ads_args'][0]['ad_image'] ) ? $home_v4['swa']['ads_args'][0]['ad_image'] : '',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_1_el_class', 
						'label' 		=> esc_html__( 'Extra Class', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][0][el_class]',
						'value'			=> isset( $home_v4['swa']['ads_args'][0]['el_class'] ) ? $home_v4['swa']['ads_args'][0]['el_class'] : '',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

				<div class="options_group">
				<?php

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_2_text', 
						'label' 		=> esc_html__( 'Ad Text', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][1][ad_text]',
						'value'			=> isset( $home_v4['swa']['ads_args'][1]['ad_text'] ) ? $home_v4['swa']['ads_args'][1]['ad_text'] : wp_kses_post( __( 'Shop the<br><strong>Hottest</strong><br>Products', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_2_action_text', 
						'label' 		=> esc_html__( 'Action Text', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][1][action_text]',
						'value'			=> isset( $home_v4['swa']['ads_args'][1]['action_text'] ) ? $home_v4['swa']['ads_args'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_2_action_link', 
						'label' 		=> esc_html__( 'Action Link', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][1][action_link]',
						'value'			=> isset( $home_v4['swa']['ads_args'][1]['action_link'] ) ? $home_v4['swa']['ads_args'][1]['action_link'] : '#',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v4_swa_ad_2_ad_image',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v4[swa][ads_args][1][ad_image]',
						'value'			=> isset( $home_v4['swa']['ads_args'][1]['ad_image'] ) ? $home_v4['swa']['ads_args'][1]['ad_image'] : '',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_2_el_class', 
						'label' 		=> esc_html__( 'Extra Class', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][1][el_class]',
						'value'			=> isset( $home_v4['swa']['ads_args'][1]['el_class'] ) ? $home_v4['swa']['ads_args'][1]['el_class'] : '',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Ads Block 3', 'electro' ) ); ?>

				<div class="options_group">
				<?php

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_3_text', 
						'label' 		=> esc_html__( 'Ad Text', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][2][ad_text]',
						'value'			=> isset( $home_v4['swa']['ads_args'][2]['ad_text'] ) ? $home_v4['swa']['ads_args'][2]['ad_text'] : wp_kses_post( __( 'Tablets,<br> Smartphones <br><strong>and more</strong>', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_3_action_text', 
						'label' 		=> esc_html__( 'Action Text', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][2][action_text]',
						'value'			=> isset( $home_v4['swa']['ads_args'][2]['action_text'] ) ? $home_v4['swa']['ads_args'][2]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_3_action_link', 
						'label' 		=> esc_html__( 'Action Link', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][2][action_link]',
						'value'			=> isset( $home_v4['swa']['ads_args'][2]['action_link'] ) ? $home_v4['swa']['ads_args'][2]['action_link'] : '#',
					) );

					electro_wp_upload_image( array(
						'id'			=> '_home_v4_swa_ad_3_ad_image',
						'label'			=> esc_html__( 'Ad Image', 'electro' ),
						'name'			=> '_home_v4[swa][ads_args][2][ad_image]',
						'value'			=> isset( $home_v4['swa']['ads_args'][2]['ad_image'] ) ? $home_v4['swa']['ads_args'][2]['ad_image'] : '',
					) );

					electro_wp_text_input( array( 
						'id' 			=> '_home_v4_swa_ad_3_el_class', 
						'label' 		=> esc_html__( 'Extra Class', 'electro' ), 
						'name'			=> '_home_v4[swa][ads_args][2][el_class]',
						'value'			=> isset( $home_v4['swa']['ads_args'][2]['el_class'] ) ? $home_v4['swa']['ads_args'][2]['el_class'] : '',
					) );
				?>
				</div>

			</div><!-- /#slider_with_ads_block -->

			<div id="tabs_carousel" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php 
					electro_wp_text_input( array( 
						'id'			=> '_home_v4_pct_product_limit', 
						'label' 		=>  esc_html__( 'Products Limit', 'electro' ),
						'placeholder' 	=> esc_html__( 'Enter the number of products to show', 'electro' ),
						'name'			=> '_home_v4[pct][product_limit]',
						'class'			=> 'product_limit',
						'size'			=> 2,
						'value'			=> isset( $home_v4['pct']['product_limit'] ) ? $home_v4['pct']['product_limit'] : 6,
					) );

					electro_wp_select( array( 
						'id'			=> '_home_v4_pct_product_columns', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
							'5'	=> '5',
							'6'	=> '6',
						),
						'class'			=> 'columns_select',
						'default'		=> '6',
						'name'			=> '_home_v4[pct][product_columns]',
						'value'			=> isset( $home_v4['pct']['product_columns'] ) ? $home_v4['pct']['product_columns'] : 6,
					) );
				?>
				</div>

				<?php if ( electro_is_wide_enabled() ) : ?>
				<div class="options_group">
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
				<?php
					electro_wp_select( array( 
						'id'			=> '_home_v4_pct_product_columns_wide', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
							'5' => '5',
							'6' => '6',
							'7' => '7',
						),
						'class'			=> 'columns_select',
						'default'		=> '7',
						'name'			=> '_home_v4[pct][product_columns_wide]',
						'value'			=> isset( $home_v4['pct']['product_columns_wide'] ) ? $home_v4['pct']['product_columns_wide'] : 7,
					) );
				?>
				</div>
				<?php endif; ?>

				<div class="options_group">
				<?php	
					electro_wp_text_input( array( 
						'id'			=> '_home_v4_pct_tabs_1_title', 
						'label' 		=> esc_html__( 'Tab #1 Title', 'electro' ),
						'placeholder' 	=> esc_html__( 'Featured', 'electro' ),
						'name'			=> '_home_v4[pct][tabs][0][title]',
						'value'			=> isset( $home_v4['pct']['tabs'][0]['title'] ) ? $home_v4['pct']['tabs'][0]['title'] : esc_html__( 'Featured', 'electro' ),
					) );

					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_pct_tabs_1_content',
						'label'			=> esc_html__( 'Tab #1 Content', 'electro' ),
						'default'		=> 'featured_products',
						'name'			=> '_home_v4[pct][tabs][0][content]',
						'value'			=> isset( $home_v4['pct']['tabs'][0]['content'] ) ? $home_v4['pct']['tabs'][0]['content'] : '',
					) );
				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id'			=> '_home_v4_pct_tabs_2_title', 
						'label' 		=> esc_html__( 'Tab #2 Title', 'electro' ),
						'placeholder' 	=> esc_html__( 'On Sale', 'electro' ),
						'name'			=> '_home_v4[pct][tabs][1][title]',
						'value'			=> isset( $home_v4['pct']['tabs'][1]['title'] ) ? $home_v4['pct']['tabs'][1]['title'] : esc_html__( 'On Sale', 'electro' ),
					) );

					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_pct_tabs_2_content',
						'label'			=> esc_html__( 'Tab #2 Content', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v4[pct][tabs][1][content]',
						'value'			=> isset( $home_v4['pct']['tabs'][1]['content'] ) ? $home_v4['pct']['tabs'][1]['content'] : '',
					) );
				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_text_input( array( 
						'id'			=> '_home_v4_pct_tabs_3_title', 
						'label' 		=> esc_html__( 'Tab #3 Title', 'electro' ),
						'placeholder' 	=> esc_html__( 'Top Rated', 'electro' ),
						'name'			=> '_home_v4[pct][tabs][2][title]',
						'value'			=> isset( $home_v4['pct']['tabs'][2]['title'] ) ? $home_v4['pct']['tabs'][2]['title'] : esc_html__( 'Top Rated', 'electro' ),
					) );
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_pct_tabs_3_content',
						'label'			=> esc_html__( 'Tab #3 Content', 'electro' ),
						'default'		=> 'top_rated_products',
						'name'			=> '_home_v4[pct][tabs][2][content]',
						'value'			=> isset( $home_v4['pct']['tabs'][2]['content'] ) ? $home_v4['pct']['tabs'][2]['content'] : '',
					) );
				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_owl_carousel_options( array( 
						'id' 			=> '_home_v4_pct_carousel_args',
						'label'			=> esc_html__( 'Carousel Args', 'electro' ),
						'name'			=> '_home_v4[pct][carousel_args]',
						'value'			=> isset( $home_v4['pct']['carousel_args'] ) ? $home_v4['pct']['carousel_args'] : '',
					) );
				?>
				</div>
			</div><!-- /#tabs_carousel -->

			<div id="banner_data" class="panel electro_options_panel">
				<div class="options_group">
				<?php 
					electro_wp_upload_image( array(
						'id'			=> '_home_v4_bd_image',
						'label'			=> esc_html__( 'Banner Image', 'electro' ),
						'name'			=> '_home_v4[bd][image]',
						'value'			=> isset( $home_v4['bd']['image'] ) ? $home_v4['bd']['image'] : '',
					) );
					
					electro_wp_text_input( array(
						'id'			=> '_home_v4_bd_link',
						'label'			=> esc_html__( 'Link', 'electro' ),
						'name'			=> '_home_v4[bd][link]',
						'value'			=> isset( $home_v4['bd']['link'] ) ? $home_v4['bd']['link'] : '#',
					) );
				?>
				</div>
			</div><!-- /#banner_data -->

			<div id="deal_products_carousel" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_dpc_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v4[dpc][section_title]',
						'value'			=> isset( $home_v4['dpc']['section_title'] ) ? $home_v4['dpc']['section_title'] : esc_html__( 'Week Deals limited, Just now', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_dpc_timer_title',
						'label'			=> esc_html__( 'Timer Title', 'electro' ),
						'name'			=> '_home_v4[dpc][timer_title]',
						'value'			=> isset( $home_v4['dpc']['timer_title'] ) ? $home_v4['dpc']['timer_title'] : esc_html__( 'Week Deals limited, Just now', 'electro' ),
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_dpc_header_timer',
						'label'			=> esc_html__( 'Header Timer', 'electro' ), 
						'name'			=> '_home_v4[dpc][header_timer]',
						'value'			=> isset( $home_v4['dpc']['header_timer'] ) ? $home_v4['dpc']['header_timer'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_dpc_timer_value',
						'label'			=> esc_html__( 'Timer Value', 'electro' ), 
						'name'			=> '_home_v4[dpc][timer_value]',
						'value'			=> isset( $home_v4['dpc']['timer_value'] ) ? $home_v4['dpc']['timer_value'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_dpc_deal_percentage',
						'label'			=> esc_html__( 'Deal Percentage Value', 'electro' ), 
						'name'			=> '_home_v4[dpc][deal_percentage]',
						'value'			=> isset( $home_v4['dpc']['deal_percentage'] ) ? $home_v4['dpc']['deal_percentage'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_dpc_product_limit',
						'label'			=> esc_html__( 'Product Limit', 'electro' ), 
						'name'			=> '_home_v4[dpc][product_limit]',
						'value'			=> isset( $home_v4['dpc']['product_limit'] ) ? $home_v4['dpc']['product_limit'] : '',
					) );

					electro_wp_select( array( 
						'id'			=> '_home_v4_dpc_product_columns', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
						),
						'class'			=> 'columns_select',
						'default'		=> '6',
						'name'			=> '_home_v4[dpc][product_columns]',
						'value'			=> isset( $home_v4['dpc']['product_columns'] ) ? $home_v4['dpc']['product_columns'] : 4,
					) );

					?>
				</div>

				<?php if ( electro_is_wide_enabled() ) : ?>
				<div class="options_group">
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
				<?php
					electro_wp_select( array( 
						'id'			=> '_home_v4_dpc_product_columns_wide', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
							'5' => '5',
							'6' => '6',
						),
						'class'			=> 'columns_select',
						'default'		=> '7',
						'name'			=> '_home_v4[dpc][product_columns_wide]',
						'value'			=> isset( $home_v4['dpc']['product_columns_wide'] ) ? $home_v4['dpc']['product_columns_wide'] : 5,
					) );
				?>
				</div>
				<?php endif; ?>
				<div class="options_group">
				<?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_dpc_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'recent_products',
						'name'			=> '_home_v4[dpc][content]',
						'value'			=> isset( $home_v4['dpc']['content'] ) ? $home_v4['dpc']['content'] : ''
					) );

					electro_wp_owl_carousel_options( array( 
						'id' 			=> '_home_v4_dpc_carousel_args',
						'label'			=> esc_html__( 'Carousel Args', 'electro' ),
						'name'			=> '_home_v4[dpc][carousel_args]',
						'value'			=> isset( $home_v4['dpc']['carousel_args'] ) ? $home_v4['dpc']['carousel_args'] : '',
					) );

				?>
				</div>
			</div><!-- /#deal_products_carousel -->

			<div id="products_with_category_image_1" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci1_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v4[pwci1][section_title]',
						'value'			=> isset( $home_v4['pwci1']['section_title'] ) ? $home_v4['pwci1']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
					) );
				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

				<?php
					electro_wp_checkbox( array(
						'id'			=> '_home_v4_pwci1_enable_categories',
						'label'			=> esc_html__( 'Enable Categories', 'electro' ), 
						'name'			=> '_home_v4[pwci1][enable_categories]',
						'value'			=> isset( $home_v4['pwci1']['enable_categories'] ) ? $home_v4['pwci1']['enable_categories'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci1_categories_title',
						'label'			=> esc_html__( 'Categories Title', 'electro' ),
						'name'			=> '_home_v4[pwci1][categories_title]',
						'value'			=> isset( $home_v4['pwci1']['categories_title'] ) ? $home_v4['pwci1']['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci1_category_limit',
						'label'			=> esc_html__( 'Categories Limit', 'electro' ),
						'name'			=> '_home_v4[pwci1][category_args][number]',
						'default'		=> 4,
						'value'			=> isset( $home_v4['pwci1']['category_args']['number'] ) ? $home_v4['pwci1']['category_args']['number'] : 4,
						'placeholder'	=> 4
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci1_category_slugs',
						'label'			=> esc_html__( 'Category Slug', 'electro' ),
						'name'			=> '_home_v4[pwci1][category_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['pwci1']['category_args']['slugs'] ) ? $home_v4['pwci1']['category_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_pwci1_hide_empty_categories',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[pwci1][category_args][hide_empty]',
						'value'			=> isset( $home_v4['pwci1']['category_args']['hide_empty'] ) ? $home_v4['pwci1']['category_args']['hide_empty'] : '',
					) );
				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Categories Menu List', 'electro' ) ); ?>

				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci1_category_menu_limit',
						'label'			=> esc_html__( 'Categories Menu Limit', 'electro' ),
						'name'			=> '_home_v4[pwci1][vcategory_args][number]',
						'default'		=> 10,
						'value'			=> isset( $home_v4['pwci1']['vcategory_args']['number'] ) ? $home_v4['pwci1']['vcategory_args']['number'] : 10,
						'placeholder'	=> 10
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci1_category_menu_slugs',
						'label'			=> esc_html__( 'Category Menu Slug', 'electro' ),
						'name'			=> '_home_v4[pwci1][vcategory_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['pwci1']['vcategory_args']['slugs'] ) ? $home_v4['pwci1']['vcategory_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_pwci1_hide_empty_categories_menu',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[pwci1][vcategory_args][hide_empty]',
						'value'			=> isset( $home_v4['pwci1']['vcategory_args']['hide_empty'] ) ? $home_v4['pwci1']['vcategory_args']['hide_empty'] : '',
					) );
				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_upload_image( array(
						'id'			=> '_home_v4_pwci1_image',
						'label'			=> esc_html__( 'Image', 'electro' ),
						'name'			=> '_home_v4[pwci1][image]',
						'value'			=> isset( $home_v4['pwci1']['image'] ) ? $home_v4['pwci1']['image'] : '',
					) );

					electro_wp_text_input( array( 
						'id'			=> '_home_v4_pwci1_img_action_link',
						'label'			=> esc_html__( 'Image Action Link', 'electro' ),
						'name'			=> '_home_v4[pwci1][img_action_link]',
						'value'			=> isset( $home_v4['pwci1']['img_action_link'] ) ? $home_v4['pwci1']['img_action_link'] : '#',
					) );
				?>
				</div>

				<?php if ( electro_is_wide_enabled() ) : ?>
				<div class="options_group">
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
				<?php
					
					electro_wp_select( array( 
						'id'			=> '_home_v4_pwci1_product_columns', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
							'5'	=> '5',
						),
						'class'			=> 'columns_select',
						'default'		=> '4',
						'name'			=> '_home_v4[pwci1][product_columns_wide]',
						'value'			=> isset( $home_v4['pwci1']['product_columns_wide'] ) ? $home_v4['pwci1']['product_columns_wide'] : 4,
					) );
				?>
				</div>
				<?php endif; ?>

				<div class="options_group">
				<?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_pwci1_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v4[pwci1][content]',
						'value'			=> isset( $home_v4['pwci1']['content'] ) ? $home_v4['pwci1']['content'] : '',
						'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
					) );
				?>
				</div>

			</div><!-- /#products_with_category_image_1 -->

			<div id="products_with_category_image_2" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci2_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v4[pwci2][section_title]',
						'value'			=> isset( $home_v4['pwci2']['section_title'] ) ? $home_v4['pwci2']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
					) );
				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

				<?php
					electro_wp_checkbox( array(
						'id'			=> '_home_v4_pwci2_enable_categories',
						'label'			=> esc_html__( 'Enable Categories', 'electro' ), 
						'name'			=> '_home_v4[pwci2][enable_categories]',
						'value'			=> isset( $home_v4['pwci2']['enable_categories'] ) ? $home_v4['pwci2']['enable_categories'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci2_categories_title',
						'label'			=> esc_html__( 'Categories Title', 'electro' ),
						'name'			=> '_home_v4[pwci2][categories_title]',
						'value'			=> isset( $home_v4['pwci2']['categories_title'] ) ? $home_v4['pwci2']['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci2_category_limit',
						'label'			=> esc_html__( 'Categories Limit', 'electro' ),
						'name'			=> '_home_v4[pwci2][category_args][number]',
						'default'		=> 4,
						'value'			=> isset( $home_v4['pwci2']['category_args']['number'] ) ? $home_v4['pwci2']['category_args']['number'] : 4,
						'placeholder'	=> 4
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci2_category_slugs',
						'label'			=> esc_html__( 'Category Slug', 'electro' ),
						'name'			=> '_home_v4[pwci2][category_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['pwci2']['category_args']['slugs'] ) ? $home_v4['pwci2']['category_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_pwci2_hide_empty_categories',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[pwci2][category_args][hide_empty]',
						'value'			=> isset( $home_v4['pwci2']['category_args']['hide_empty'] ) ? $home_v4['pwci2']['category_args']['hide_empty'] : '',
					) );

				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Categories Menu List', 'electro' ) ); ?>

				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci2_category_limit',
						'label'			=> esc_html__( 'Categories Menu Limit', 'electro' ),
						'name'			=> '_home_v4[pwci2][vcategory_args][number]',
						'default'		=> 10,
						'value'			=> isset( $home_v4['pwci2']['vcategory_args']['number'] ) ? $home_v4['pwci2']['vcategory_args']['number'] : 10,
						'placeholder'	=> 10
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_pwci2_category_menu_slugs',
						'label'			=> esc_html__( 'Category Menu Slug', 'electro' ),
						'name'			=> '_home_v4[pwci2][vcategory_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['pwci2']['vcategory_args']['slugs'] ) ? $home_v4['pwci2']['vcategory_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_pwci2_hide_empty_categories_menu',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[pwci2][vcategory_args][hide_empty]',
						'value'			=> isset( $home_v4['pwci2']['vcategory_args']['hide_empty'] ) ? $home_v4['pwci2']['vcategory_args']['hide_empty'] : '',
					) );

				?>
				</div>

				<div class="options_group">
				<?php
					electro_wp_upload_image( array(
						'id'			=> '_home_v4_pwci2_image',
						'label'			=> esc_html__( 'Image', 'electro' ),
						'name'			=> '_home_v4[pwci2][image]',
						'value'			=> isset( $home_v4['pwci2']['image'] ) ? $home_v4['pwci2']['image'] : '',
					) );

					electro_wp_text_input( array( 
						'id'			=> '_home_v4_pwci2_img_action_link',
						'label'			=> esc_html__( 'Image Action Link', 'electro' ),
						'name'			=> '_home_v4[pwci2][img_action_link]',
						'value'			=> isset( $home_v4['pwci2']['img_action_link'] ) ? $home_v4['pwci2']['img_action_link'] : '#',
					) );
				?>
				</div>

				<?php if ( electro_is_wide_enabled() ) : ?>
				<div class="options_group">
					<h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
				<?php
					
					electro_wp_select( array( 
						'id'			=> '_home_v4_pwci2_product_columns', 
						'label' 		=>  esc_html__( 'Columns', 'electro' ),
						'options'		=> array(
							'2'	=> '2',
							'3'	=> '3',
							'4'	=> '4',
							'5'	=> '5',
						),
						'class'			=> 'columns_select',
						'default'		=> '4',
						'name'			=> '_home_v4[pwci2][product_columns_wide]',
						'value'			=> isset( $home_v4['pwci2']['product_columns_wide'] ) ? $home_v4['pwci2']['product_columns_wide'] : 4,
					) );
				?>
				</div>
				<?php endif; ?>

				<div class="options_group">
				<?php

					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_pwci2_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v4[pwci2][content]',
						'value'			=> isset( $home_v4['pwci2']['content'] ) ? $home_v4['pwci2']['content'] : '',
						'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
					) );
				?>
				</div>
			</div><!-- /#products_with_category_image_2 -->

			<div id="hcb_block" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_hcb_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v4[hcb][section_title]',
						'value'			=> isset( $home_v4['hcb']['section_title'] ) ? $home_v4['hcb']['section_title'] : esc_html__( 'Top Categories this Week', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_hcb_slugs',
						'label'			=> esc_html__( 'Category Slug', 'electro' ),
						'name'			=> '_home_v4[hcb][cat_slugs]',
						'value'			=> isset( $home_v4['hcb']['cat_slugs'] ) ? $home_v4['hcb']['cat_slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' ),
					) );

					electro_wp_text_input( array( 
						'id'			=> '_home_v4_hcb_orderby', 
						'label' 		=> esc_html__( 'Order By', 'electro' ),
						'placeholder' 	=> esc_html__( 'Enter the order by', 'electro' ),
						'name'			=> '_home_v4[hcb][orderby]',
						'value'			=> isset( $home_v4['hcb']['orderby'] ) ? $home_v4['hcb']['orderby'] : 'title',
					) );

					electro_wp_text_input( array( 
						'id'			=> '_home_v4_hcb_order', 
						'label' 		=> esc_html__( 'Order', 'electro' ),
						'placeholder' 	=> esc_html__( 'Enter the Order', 'electro' ),
						'name'			=> '_home_v4[hcb][order]',
						'value'			=> isset( $home_v4['hcb']['order'] ) ? $home_v4['hcb']['order'] : 'ASC',
					) );

					electro_wp_text_input( array( 
						'id'			=> '_home_v4_hcb_order', 
						'label' 		=> esc_html__( 'Limit', 'electro' ),
						'placeholder' 	=> esc_html__( 'Enter the limit', 'electro' ),
						'name'			=> '_home_v4[hcb][cat_args][number]',
						'value'			=> isset( $home_v4['hcb']['cat_args']['number'] ) ? $home_v4['hcb']['cat_args']['number'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_hcb_columns',
						'label'			=> esc_html__( 'Columns', 'electro' ),
						'name'			=> '_home_v4[hcb][columns]',
						'value'			=> isset( $home_v4['hcb']['columns'] ) ? $home_v4['hcb']['columns'] : '4',
					) );

					electro_wp_select( array( 
						'id'			=> '_home_v4_hcb_enable_full_width', 
						'label' 		=>  esc_html__( 'Enable Fullwidth', 'electro' ),
						'options'		=> array(
							'yes'	=> 'yes',
							'no'	=> 'no',
						),
						'class'			=> 'full_width_select',
						'default'		=> 'yes',
						'name'			=> '_home_v4[hcb][enable_full_width]',
						'value'			=> isset( $home_v4['hcb']['enable_full_width'] ) ? $home_v4['hcb']['enable_full_width'] : 'yes',
					) );
				?>
				</div>
			</div><!-- /#hcb_block -->

			<div id="products_6_1_with_categories_1" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc1_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v4[sowc1][section_title]',
						'value'			=> isset( $home_v4['sowc1']['section_title'] ) ? $home_v4['sowc1']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
					) );
				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

				<?php
					electro_wp_checkbox( array(
						'id'			=> '_home_v4_sowc1_enable_categories',
						'label'			=> esc_html__( 'Enable Categories', 'electro' ), 
						'name'			=> '_home_v4[sowc1][enable_categories]',
						'value'			=> isset( $home_v4['sowc1']['enable_categories'] ) ? $home_v4['sowc1']['enable_categories'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc1_categories_title',
						'label'			=> esc_html__( 'Categories Title', 'electro' ),
						'name'			=> '_home_v4[sowc1][categories_title]',
						'value'			=> isset( $home_v4['sowc1']['categories_title'] ) ? $home_v4['sowc1']['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc1_category_limit',
						'label'			=> esc_html__( 'Categories Limit', 'electro' ),
						'name'			=> '_home_v4[sowc1][category_args][number]',
						'default'		=> 4,
						'value'			=> isset( $home_v4['sowc1']['category_args']['number'] ) ? $home_v4['sowc1']['category_args']['number'] : 4,
						'placeholder'	=> 4
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc1_category_slugs',
						'label'			=> esc_html__( 'Category Slug', 'electro' ),
						'name'			=> '_home_v4[sowc1][category_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['sowc1']['category_args']['slugs'] ) ? $home_v4['sowc1']['category_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_sowc1_hide_empty_categories',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[sowc1][category_args][hide_empty]',
						'value'			=> isset( $home_v4['sowc1']['category_args']['hide_empty'] ) ? $home_v4['sowc1']['category_args']['hide_empty'] : '',
					) );

				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Categories Menu List', 'electro' ) ); ?>

				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc1_category_menu_limit',
						'label'			=> esc_html__( 'Categories Menu Limit', 'electro' ),
						'name'			=> '_home_v4[sowc1][vcategory_args][number]',
						'default'		=> 10,
						'value'			=> isset( $home_v4['sowc1']['vcategory_args']['number'] ) ? $home_v4['sowc1']['vcategory_args']['number'] : 10,
						'placeholder'	=> 10
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc1_category_menu_slugs',
						'label'			=> esc_html__( 'Category Menu Slug', 'electro' ),
						'name'			=> '_home_v4[sowc1][vcategory_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['sowc1']['vcategory_args']['slugs'] ) ? $home_v4['sowc1']['vcategory_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_sowc1_hide_empty_categories_menu',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[sowc1][vcategory_args][hide_empty]',
						'value'			=> isset( $home_v4['sowc1']['vcategory_args']['hide_empty'] ) ? $home_v4['sowc1']['vcategory_args']['hide_empty'] : '',
					) );

				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Feature Product', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_sowc1_content_featured',
						'label'			=> esc_html__( 'Product', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v4[sowc1][content_featured]',
						'value'			=> isset( $home_v4['sowc1']['content_featured'] ) ? $home_v4['sowc1']['content_featured'] : '',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Products', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_sowc1_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v4[sowc1][content]',
						'value'			=> isset( $home_v4['sowc1']['content'] ) ? $home_v4['sowc1']['content'] : '',
						'fields'		=> array( 'order', 'orderby' )
					) );
				?>
				</div>
			</div><!-- /#products_6_1_with_categories_1 -->

			<div id="products_6_1_with_categories_2" class="panel electro_options_panel">
				
				<div class="options_group">
				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc2_section_title',
						'label'			=> esc_html__( 'Section Title', 'electro' ),
						'name'			=> '_home_v4[sowc2][section_title]',
						'value'			=> isset( $home_v4['sowc2']['section_title'] ) ? $home_v4['sowc2']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
					) );
				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

				<?php
					electro_wp_checkbox( array(
						'id'			=> '_home_v4_sowc2_enable_categories',
						'label'			=> esc_html__( 'Enable Categories', 'electro' ), 
						'name'			=> '_home_v4[sowc2][enable_categories]',
						'value'			=> isset( $home_v4['sowc2']['enable_categories'] ) ? $home_v4['sowc2']['enable_categories'] : '',
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc2_categories_title',
						'label'			=> esc_html__( 'Categories Title', 'electro' ),
						'name'			=> '_home_v4[sowc2][categories_title]',
						'value'			=> isset( $home_v4['sowc2']['categories_title'] ) ? $home_v4['sowc2']['categories_title'] : esc_html__( 'Bestsellers', 'electro' ),
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc2_category_limit',
						'label'			=> esc_html__( 'Categories Limit', 'electro' ),
						'name'			=> '_home_v4[sowc2][category_args][number]',
						'default'		=> 4,
						'value'			=> isset( $home_v4['sowc2']['category_args']['number'] ) ? $home_v4['sowc2']['category_args']['number'] : 4,
						'placeholder'	=> 4
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc2_category_slugs',
						'label'			=> esc_html__( 'Category Slug', 'electro' ),
						'name'			=> '_home_v4[sowc2][category_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['sowc2']['category_args']['slugs'] ) ? $home_v4['sowc2']['category_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_sowc2_hide_empty_categories',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[sowc2][category_args][hide_empty]',
						'value'			=> isset( $home_v4['sowc2']['category_args']['hide_empty'] ) ? $home_v4['sowc2']['category_args']['hide_empty'] : '',
					) );

				?>
				</div>

				<div class="options_group">

				<?php electro_wp_legend( esc_html__( 'Categories Menu List', 'electro' ) ); ?>

				<?php
					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc2_category_menu_limit',
						'label'			=> esc_html__( 'Categories Menu Limit', 'electro' ),
						'name'			=> '_home_v4[sowc2][vcategory_args][number]',
						'default'		=> 10,
						'value'			=> isset( $home_v4['sowc2']['vcategory_args']['number'] ) ? $home_v4['sowc2']['vcategory_args']['number'] : 10,
						'placeholder'	=> 10
					) );

					electro_wp_text_input( array(
						'id'			=> '_home_v4_sowc2_category_menu_slugs',
						'label'			=> esc_html__( 'Category Menu Slug', 'electro' ),
						'name'			=> '_home_v4[sowc2][vcategory_args][slugs]',
						'default'		=> '',
						'value'			=> isset( $home_v4['sowc2']['vcategory_args']['slugs'] ) ? $home_v4['sowc2']['vcategory_args']['slugs'] : '',
						'placeholder'	=> esc_html__( 'Enter category slugs separated by comma', 'electro' )
					) );

					electro_wp_checkbox( array(
						'id'			=> '_home_v4_sowc2_hide_empty_categories_menu',
						'label'			=> esc_html__( 'Hide Empty?', 'electro' ), 
						'name'			=> '_home_v4[sowc2][vcategory_args][hide_empty]',
						'value'			=> isset( $home_v4['sowc2']['vcategory_args']['hide_empty'] ) ? $home_v4['sowc2']['vcategory_args']['hide_empty'] : '',
					) );

				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Feature Product', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_sowc2_content_featured',
						'label'			=> esc_html__( 'Product', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v4[sowc2][content_featured]',
						'value'			=> isset( $home_v4['sowc2']['content_featured'] ) ? $home_v4['sowc2']['content_featured'] : '',
					) );
				?>
				</div>

				<?php electro_wp_legend( esc_html__( 'Products', 'electro' ) ); ?>

				<div class="options_group">
				<?php
					electro_wp_wc_shortcode( array( 
						'id' 			=> '_home_v4_sowc2_content',
						'label'			=> esc_html__( 'Products', 'electro' ),
						'default'		=> 'sale_products',
						'name'			=> '_home_v4[sowc2][content]',
						'value'			=> isset( $home_v4['sowc2']['content'] ) ? $home_v4['sowc2']['content'] : '',
						'fields'		=> array( 'order', 'orderby' )
					) );
				?>
				</div>
			</div><!-- /#products_6_1_with_categories_2 -->

			<?php if ( electro_is_wide_enabled() ) : ?>

			<div id="recently_viewed_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v4_rvp_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v4[rvp][section_title]',
                        'value'         => isset( $home_v4['rvp']['section_title'] ) ? $home_v4['rvp']['section_title'] : esc_html__( 'Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v4_rvp_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v4[rvp][shortcode_atts][per_page]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v4['rvp']['shortcode_atts']['per_page'] ) ? $home_v4['rvp']['shortcode_atts']['per_page'] : '20',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v4_rvp_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the columns', 'electro' ),
                        'name'          => '_home_v4[rvp][product_columns]',
                        'value'         => isset( $home_v4['rvp']['product_columns'] ) ? $home_v4['rvp']['product_columns'] : 10,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php

                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v4_rvp_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v4[rvp][carousel_args]',
                        'value'         => isset( $home_v4['rvp']['carousel_args'] ) ? $home_v4['rvp']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#recently_viewed_carousel -->

            <?php endif; ?>

		</div>
		<?php
	}

	public static function save( $post_id, $post ) {
		if ( isset( $_POST['_home_v4'] ) ) {
			$clean_home_v4_options = electro_clean_kses_post( $_POST['_home_v4'] );
			update_post_meta( $post_id, '_home_v4_options',  serialize( $clean_home_v4_options ) );
		}	
	}
}