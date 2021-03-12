<?php
/**
 * Home Mobile v1 Metabox
 *
 * Displays the home mobile v1 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_Mobile_v1 Class
 */
class Electro_Meta_Box_Home_Mobile_v1 {

    /**
     * Output the metabox.
     *
     * @param WP_Post $post
     */
    public static function output( $post ) {
        global $post, $thepostid;

        wp_nonce_field( 'electro_save_data', 'electro_meta_nonce' );

        $thepostid      = $post->ID;
        $template_file  = get_post_meta( $thepostid, '_wp_page_template', true );

        if ( $template_file !== 'template-homepage-mobile-v1.php' ) {
            return;
        }

        self::output_home_mobile_v1( $post );
    }

    private static function output_home_mobile_v1( $post ) {

        $home_mobile_v1 = electro_get_home_mobile_v1_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs ec-tabs">
            <?php
                $product_data_tabs = apply_filters( 'electro_home_mobile_v1_data_tabs', array(
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
                    'ads_block' => array(
                        'label'  => __( 'Ads Block', 'electro' ),
                        'target' => 'ads_block',
                        'class'  => array(),
                    ),
                    'product_categories_list_1' => array(
                        'label'  => __( 'Product Categories List - 1', 'electro' ),
                        'target' => 'product_categories_list_1',
                        'class'  => array(),
                    ),
                    'deals_product_block' => array(
                        'label'  => __( 'Deals Product Block', 'electro' ),
                        'target' => 'deals_product_block',
                        'class'  => array(),
                    ),
                    'banner_1' => array(
                        'label'  => __( 'Banner - 1', 'electro' ),
                        'target' => 'banner_data_1',
                        'class'  => array(),
                    ),
                    'products_1_2_block' => array(
                        'label'  => __( '1-2 Products Block', 'electro' ),
                        'target' => 'products_1_2_block',
                        'class'  => array(),
                    ),
                    'product_categories_list_2' => array(
                        'label'  => __( 'Product Categories List - 2', 'electro' ),
                        'target' => 'product_categories_list_2',
                        'class'  => array(),
                    ),
                    'products_list_block_1' => array(
                        'label'  => __( 'Product List Block - 1', 'electro' ),
                        'target' => 'products_list_block_1',
                        'class'  => array(),
                    ),
                    'banner_2' => array(
                        'label'  => __( 'Banner - 2', 'electro' ),
                        'target' => 'banner_data_2',
                        'class'  => array(),
                    ),
                    'products_list_block_2' => array(
                        'label'  => __( 'Product List Block - 2', 'electro' ),
                        'target' => 'products_list_block_2',
                        'class'  => array(),
                    ),
                    'hcb_block' => array(
                        'label'  => __( 'Categories Block', 'electro' ),
                        'target' => 'hcb_block',
                        'class'  => array(),
                    ),
                    'recently_viewed' => array(
                        'label'  => __( 'Recently Viewed', 'electro' ),
                        'target' => 'recently_viewed',
                        'class'  => array(),
                    )
                ) );
                foreach ( $product_data_tabs as $key => $tab ) {
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
                        'id'        => '_home_mobile_v1_header_style',
                        'label'     => esc_html__( 'Header Style', 'electro' ),
                        'name'      => '_home_mobile_v1[header_style]',
                        'options'       => array(
                            'v1'    => esc_html__( 'Header v1', 'electro' ),
                            'v2'    => esc_html__( 'Header v2', 'electro' ),
                        ),
                        'name'          => '_home_mobile_v1[hpc][header_style]',
                        'value'         => isset( $home_mobile_v1['hpc']['header_style'] ) ? $home_mobile_v1['hpc']['header_style'] : 'v1',
                    ) );

                    electro_wp_select( array(
                        'id'        => '_home_mobile_v1_footer_style',
                        'label'     => esc_html__( 'Footer Style', 'electro' ),
                        'name'      => '_home_mobile_v1[footer_style]',
                        'options'       => array(
                            'v1'    => esc_html__( 'Footer v1', 'electro' ),
                            'v2'    => esc_html__( 'Footer v2', 'electro' ),
                        ),
                        'name'          => '_home_mobile_v1[hpc][footer_style]',
                        'value'         => isset( $home_mobile_v1['hpc']['footer_style'] ) ? $home_mobile_v1['hpc']['footer_style'] : 'v1',
                    ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_mobile_v1_blocks = array(
                            'hpc'       => esc_html__( 'Page content', 'electro' ),
                            'sdr'       => esc_html__( 'Slider', 'electro' ),
                            'ad'        => esc_html__( 'Ads Block', 'electro' ),
                            'pcl1'      => esc_html__( 'Product Categories List - 1', 'electro' ),
                            'dpb'       => esc_html__( 'Deals Product Block', 'electro' ),
                            'bd1'       => esc_html__( 'Banner - 1', 'electro' ),
                            'pot'       => esc_html__( 'Featured Products Block', 'electro' ),
                            'pcl2'      => esc_html__( 'Product Categories List - 2', 'electro' ),
                            'pl1'       => esc_html__( 'Product List Block - 1', 'electro' ),
                            'bd2'       => esc_html__( 'Banner - 2', 'electro' ),
                            'pl2'       => esc_html__( 'Product List Block - 2', 'electro' ),
                            'hcb'       => esc_html__( 'Categories Block', 'electro' ),
                            'rvp'       => esc_html__( 'Recently Viewed', 'electro' ),
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
                            <?php foreach( $home_mobile_v1_blocks as $key => $home_mobile_v1_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_mobile_v1_block ); ?></td>
                                <td><?php electro_wp_animation_dropdown( array(  'id' => '_home_mobile_v1_' . $key . '_animation', 'label'=> '', 'name' => '_home_mobile_v1[' . $key . '][animation]', 'value' => isset( $home_mobile_v1['' . $key . '']['animation'] ) ? $home_mobile_v1['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php electro_wp_text_input( array(  'id' => '_home_mobile_v1_' . $key . '_priority', 'label'=> '', 'name' => '_home_mobile_v1[' . $key . '][priority]', 'value' => isset( $home_mobile_v1['' . $key . '']['priority'] ) ? $home_mobile_v1['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php electro_wp_checkbox( array( 'id' => '_home_mobile_v1_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_mobile_v1[' . $key . '][is_enabled]', 'value'=> isset( $home_mobile_v1['' . $key . '']['is_enabled'] ) ? $home_mobile_v1['' . $key . '']['is_enabled'] : '', ) ); ?></td>
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
                        'id'            => '_home_mobile_v1_sdr_shortcode',
                        'label'         => esc_html__( 'Shortcode', 'electro' ),
                        'placeholder'   => __( 'Enter the shorcode for your slider here', 'electro' ),
                        'name'          => '_home_mobile_v1[sdr][shortcode]',
                        'value'         => isset( $home_mobile_v1['sdr']['shortcode'] ) ? $home_mobile_v1['sdr']['shortcode'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#slider_block -->

            <div id="ads_block" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Ads Block 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_1_ad_text',
                        'label'         => esc_html__( 'Ad Text', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][0][ad_text]',
                        'value'         => isset( $home_mobile_v1['ad'][0]['ad_text'] ) ? $home_mobile_v1['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Hottest<br> <strong>Deals</strong> in Cameras<br> Category', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_1_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][0][action_text]',
                        'value'         => isset( $home_mobile_v1['ad'][0]['action_text'] ) ? $home_mobile_v1['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][0][action_link]',
                        'value'         => isset( $home_mobile_v1['ad'][0]['action_link'] ) ? $home_mobile_v1['ad'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v1_ad_1_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][0][ad_image]',
                        'value'         => isset( $home_mobile_v1['ad'][0]['ad_image'] ) ? $home_mobile_v1['ad'][0]['ad_image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_1_el_class',
                        'label'         => esc_html__( 'Extra Class', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][0][el_class]',
                        'value'         => isset( $home_mobile_v1['ad'][0]['el_class'] ) ? $home_mobile_v1['ad'][0]['el_class'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_2_ad_text',
                        'label'         => esc_html__( 'Ad Text', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][1][ad_text]',
                        'value'         => isset( $home_mobile_v1['ad'][1]['ad_text'] ) ? $home_mobile_v1['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets,<br> Smartphones <br><strong>and more</strong>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_2_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][1][action_text]',
                        'value'         => isset( $home_mobile_v1['ad'][1]['action_text'] ) ? $home_mobile_v1['ad'][1]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][1][action_link]',
                        'value'         => isset( $home_mobile_v1['ad'][1]['action_link'] ) ? $home_mobile_v1['ad'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v1_ad_2_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][1][ad_image]',
                        'value'         => isset( $home_mobile_v1['ad'][1]['ad_image'] ) ? $home_mobile_v1['ad'][1]['ad_image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_ad_2_el_class',
                        'label'         => esc_html__( 'Extra Class', 'electro' ),
                        'name'          => '_home_mobile_v1[ad][1][el_class]',
                        'value'         => isset( $home_mobile_v1['ad'][1]['el_class'] ) ? $home_mobile_v1['ad'][1]['el_class'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#ads_block -->

            <div id="product_categories_list_1" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl1_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl1][cat_args][slugs]',
                        'value'         => isset( $home_mobile_v1['pcl1']['cat_args']['slugs'] ) ? $home_mobile_v1['pcl1']['cat_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                     electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_pcl1_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl1][cat_args][hide_empty]',
                        'value'         => isset( $home_mobile_v1['pcl1']['cat_args']['hide_empty'] ) ? $home_mobile_v1['pcl1']['cat_args']['hide_empty'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl1_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl1][cat_args][orderby]',
                        'value'         => isset( $home_mobile_v1['pcl1']['cat_args']['orderby'] ) ? $home_mobile_v1['pcl1']['cat_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl1_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl1][cat_args][order]',
                        'value'         => isset( $home_mobile_v1['pcl1']['cat_args']['order'] ) ? $home_mobile_v1['pcl1']['cat_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl1_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl1][cat_args][number]',
                        'value'         => isset( $home_mobile_v1['pcl1']['cat_args']['number'] ) ? $home_mobile_v1['pcl1']['cat_args']['number'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl1_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl1][columns]',
                        'value'         => isset( $home_mobile_v1['pcl1']['columns'] ) ? $home_mobile_v1['pcl1']['columns'] : '3',
                    ) );
                ?>
                </div>
            </div><!-- /#product_categories_list_1 -->

            <div id="deals_product_block" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_dpb_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v1[dpb][section_title]',
                        'value'         => isset( $home_mobile_v1['dpb']['section_title'] ) ? $home_mobile_v1['dpb']['section_title'] : '',
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_mobile_v1_dpb_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_mobile_v1[dpb][content]',
                        'value'         => isset( $home_mobile_v1['dpb']['content'] ) ? $home_mobile_v1['dpb']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_dpb_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v1[dpb][action_text]',
                        'value'         => isset( $home_mobile_v1['dpb']['action_text'] ) ? $home_mobile_v1['dpb']['action_text'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_dpb_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v1[dpb][action_link]',
                        'value'         => isset( $home_mobile_v1['dpb']['action_link'] ) ? $home_mobile_v1['dpb']['action_link'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#deals_product_block -->

            <div id="banner_data_1" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v1_bd1_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_mobile_v1[bd1][image]',
                        'value'         => isset( $home_mobile_v1['bd1']['image'] ) ? $home_mobile_v1['bd1']['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_bd1_link',
                        'label'         => esc_html__( 'Link', 'electro' ),
                        'name'          => '_home_mobile_v1[bd1][link]',
                        'value'         => isset( $home_mobile_v1['bd1']['link'] ) ? $home_mobile_v1['bd1']['link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#banner_data_1 -->

            <div id="products_1_2_block" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pot_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v1[pot][section_title]',
                        'value'         => isset( $home_mobile_v1['pot']['section_title'] ) ? $home_mobile_v1['pot']['section_title'] : '',
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_mobile_v1_pot_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_mobile_v1[pot][content]',
                        'value'         => isset( $home_mobile_v1['pot']['content'] ) ? $home_mobile_v1['pot']['content'] : '',
                        'fields'        => array( 'order', 'orderby' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pot_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v1[pot][action_text]',
                        'value'         => isset( $home_mobile_v1['pot']['action_text'] ) ? $home_mobile_v1['pot']['action_text'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pot_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v1[pot][action_link]',
                        'value'         => isset( $home_mobile_v1['pot']['action_link'] ) ? $home_mobile_v1['pot']['action_link'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#Featured Product Block -->

            <div id="product_categories_list_2" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][section_title]',
                        'value'         => isset( $home_mobile_v1['pcl2']['section_title'] ) ? $home_mobile_v1['pcl2']['section_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl2_sub_title',
                        'label'         => esc_html__( 'Subtitle', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][sub_title]',
                        'value'         => isset( $home_mobile_v1['pcl2']['sub_title'] ) ? $home_mobile_v1['pcl2']['sub_title'] : '',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v1_pcl2_bg_image',
                        'label'         => esc_html__( 'Background Image', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][bg_image]',
                        'value'         => isset( $home_mobile_v1['pcl2']['bg_image'] ) ? $home_mobile_v1['pcl2']['bg_image'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_pcl2_enable_header',
                        'label'         => esc_html__( 'Enable Header?', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][enable_header]',
                        'value'         => isset( $home_mobile_v1['pcl2']['enable_header'] ) ? $home_mobile_v1['pcl2']['enable_header'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl2_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][cat_args][slugs]',
                        'value'         => isset( $home_mobile_v1['pcl2']['cat_args']['slugs'] ) ? $home_mobile_v1['pcl2']['cat_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                     electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_pcl2_hide_empty', 
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][cat_args][hide_empty]',
                        'value'         => isset( $home_mobile_v1['pcl2']['cat_args']['hide_empty'] ) ? $home_mobile_v1['pcl2']['cat_args']['hide_empty'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl2_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][cat_args][orderby]',
                        'value'         => isset( $home_mobile_v1['pcl2']['cat_args']['orderby'] ) ? $home_mobile_v1['pcl2']['cat_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl2_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][cat_args][order]',
                        'value'         => isset( $home_mobile_v1['pcl2']['cat_args']['order'] ) ? $home_mobile_v1['pcl2']['cat_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl2_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][cat_args][number]',
                        'value'         => isset( $home_mobile_v1['pcl2']['cat_args']['number'] ) ? $home_mobile_v1['pcl2']['cat_args']['number'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pcl2_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'name'          => '_home_mobile_v1[pcl2][columns]',
                        'value'         => isset( $home_mobile_v1['pcl2']['columns'] ) ? $home_mobile_v1['pcl2']['columns'] : '3',
                    ) );
                ?>
                </div>
            </div><!-- /#product_categories_list_2 -->

            <div id="products_list_block_1" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][section_title]',
                        'value'         => isset( $home_mobile_v1['pl1']['section_title'] ) ? $home_mobile_v1['pl1']['section_title'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_pl1_enable_categories',
                        'label'         => esc_html__( 'Enable Categories?', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][enable_categories]',
                        'value'         => isset( $home_mobile_v1['pl1']['enable_categories'] ) ? $home_mobile_v1['pl1']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][categories_title]',
                        'value'         => isset( $home_mobile_v1['pl1']['categories_title'] ) ? $home_mobile_v1['pl1']['categories_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][category_args][slugs]',
                        'value'         => isset( $home_mobile_v1['pl1']['category_args']['slugs'] ) ? $home_mobile_v1['pl1']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][category_args][orderby]',
                        'value'         => isset( $home_mobile_v1['pl1']['category_args']['orderby'] ) ? $home_mobile_v1['pl1']['category_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][category_args][order]',
                        'value'         => isset( $home_mobile_v1['pl1']['category_args']['order'] ) ? $home_mobile_v1['pl1']['category_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][category_args][number]',
                        'value'         => isset( $home_mobile_v1['pl1']['category_args']['number'] ) ? $home_mobile_v1['pl1']['category_args']['number'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_pl1_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][category_args][hide_empty]',
                        'value'         => isset( $home_mobile_v1['pl1']['category_args']['hide_empty'] ) ? $home_mobile_v1['pl1']['category_args']['hide_empty'] : '',
                    ) );

                     electro_wp_wc_shortcode( array(
                        'id'            => '_home_mobile_v1_pl1_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'featured_products',
                        'name'          => '_home_mobile_v1[pl1][content]',
                        'value'         => isset( $home_mobile_v1['pl1']['content'] ) ? $home_mobile_v1['pl1']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][action_text]',
                        'value'         => isset( $home_mobile_v1['pl1']['action_text'] ) ? $home_mobile_v1['pl1']['action_text'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v1[pl1][action_link]',
                        'value'         => isset( $home_mobile_v1['pl1']['action_link'] ) ? $home_mobile_v1['pl1']['action_link'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_list_Block_1 -->

            <div id="banner_data_2" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v1_bd2_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_mobile_v1[bd2][image]',
                        'value'         => isset( $home_mobile_v1['bd2']['image'] ) ? $home_mobile_v1['bd2']['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_bd2_link',
                        'label'         => esc_html__( 'Link', 'electro' ),
                        'name'          => '_home_mobile_v1[bd2][link]',
                        'value'         => isset( $home_mobile_v1['bd2']['link'] ) ? $home_mobile_v1['bd2']['link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#banner_data_2 -->

            <div id="products_list_block_2" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][section_title]',
                        'value'         => isset( $home_mobile_v1['pl2']['section_title'] ) ? $home_mobile_v1['pl2']['section_title'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_pl2_enable_categories',
                        'label'         => esc_html__( 'Enable Categories?', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][enable_categories]',
                        'value'         => isset( $home_mobile_v1['pl2']['enable_categories'] ) ? $home_mobile_v1['pl2']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][categories_title]',
                        'value'         => isset( $home_mobile_v1['pl2']['categories_title'] ) ? $home_mobile_v1['pl2']['categories_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][category_args][slugs]',
                        'value'         => isset( $home_mobile_v1['pl2']['category_args']['slugs'] ) ? $home_mobile_v1['pl2']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][category_args][orderby]',
                        'value'         => isset( $home_mobile_v1['pl2']['category_args']['orderby'] ) ? $home_mobile_v1['pl2']['category_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][category_args][order]',
                        'value'         => isset( $home_mobile_v1['pl2']['category_args']['order'] ) ? $home_mobile_v1['pl2']['category_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][category_args][number]',
                        'value'         => isset( $home_mobile_v1['pl2']['category_args']['number'] ) ? $home_mobile_v1['pl2']['category_args']['number'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_pl2_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][category_args][hide_empty]',
                        'value'         => isset( $home_mobile_v1['pl2']['category_args']['hide_empty'] ) ? $home_mobile_v1['pl2']['category_args']['hide_empty'] : '',
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_mobile_v1_pl2_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_mobile_v1[pl2][content]',
                        'value'         => isset( $home_mobile_v1['pl2']['content'] ) ? $home_mobile_v1['pl2']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][action_text]',
                        'value'         => isset( $home_mobile_v1['pl2']['action_text'] ) ? $home_mobile_v1['pl2']['action_text'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_pl2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v1[pl2][action_link]',
                        'value'         => isset( $home_mobile_v1['pl2']['action_link'] ) ? $home_mobile_v1['pl2']['action_link'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_list_Block_2 -->

            <div id="hcb_block" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_hcb_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v1[hcb][section_title]',
                        'value'         => isset( $home_mobile_v1['hcb']['section_title'] ) ? $home_mobile_v1['hcb']['section_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_hcb_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v1[hcb][cat_slugs]',
                        'value'         => isset( $home_mobile_v1['hcb']['cat_slugs'] ) ? $home_mobile_v1['hcb']['cat_slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_hcb_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v1[hcb][cat_args][orderby]',
                        'value'         => isset( $home_mobile_v1['hcb']['cat_args']['orderby'] ) ? $home_mobile_v1['hcb']['cat_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_hcb_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v1[hcb][cat_args][order]',
                        'value'         => isset( $home_mobile_v1['hcb']['cat_args']['order'] ) ? $home_mobile_v1['hcb']['cat_args']['order'] : 'ASC',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_hcb_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v1[hcb][cat_args][number]',
                        'value'         => isset( $home_mobile_v1['hcb']['cat_args']['number'] ) ? $home_mobile_v1['hcb']['cat_args']['number'] : '6',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v1_hcb_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v1[hcb][cat_args][hide_empty]',
                        'value'         => isset( $home_mobile_v1['hcb']['cat_args']['hide_empty'] ) ? $home_mobile_v1['hcb']['cat_args']['hide_empty'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_hcb_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'name'          => '_home_mobile_v1[hcb][columns]',
                        'value'         => isset( $home_mobile_v1['hcb']['columns'] ) ? $home_mobile_v1['hcb']['columns'] : '3',
                    ) );

                    electro_wp_select( array(
                        'id'            => '_home_mobile_v1_hcb_enable_full_width',
                        'label'         =>  esc_html__( 'Enable Fullwidth', 'electro' ),
                        'options'       => array(
                            'yes'   => 'yes',
                            'no'    => 'no',
                        ),
                        'class'         => 'full_width_select',
                        'default'       => 'no',
                        'name'          => '_home_mobile_v1[hcb][enable_full_width]',
                        'value'         => isset( $home_mobile_v1['hcb']['enable_full_width'] ) ? $home_mobile_v1['hcb']['enable_full_width'] : 'no',
                    ) );
                ?>
                </div>
            </div><!-- /#hcb_block -->

            <div id="recently_viewed" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v1_rvp_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v1[rvp][section_title]',
                        'value'         => isset( $home_mobile_v1['rvp']['section_title'] ) ? $home_mobile_v1['rvp']['section_title'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#recently_viewed -->
        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_mobile_v1'] ) ) {
            $clean_home_mobile_v1_options = electro_clean_kses_post( $_POST['_home_mobile_v1'] );
            update_post_meta( $post_id, '_home_mobile_v1_options',  serialize( $clean_home_mobile_v1_options ) );
        }
    }
}
