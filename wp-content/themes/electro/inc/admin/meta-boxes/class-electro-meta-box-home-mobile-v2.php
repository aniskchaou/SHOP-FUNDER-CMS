<?php
/**
 * Home Mobile v2 Metabox
 *
 * Displays the home mobile v2 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_Mobile_v2 Class
 */
class Electro_Meta_Box_Home_Mobile_v2 {

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

        if ( $template_file !== 'template-homepage-mobile-v2.php' ) {
            return;
        }

        self::output_home_mobile_v2( $post );
    }

    private static function output_home_mobile_v2( $post ) {

        $home_mobile_v2 = electro_get_home_mobile_v2_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs ec-tabs">
            <?php
                $product_data_tabs = apply_filters( 'electro_home_mobile_v2_data_tabs', array(
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
                    'deal_products_with_featured' => array(
                        'label'  => __( 'Deals Product Block', 'electro' ),
                        'target' => 'deal_products_with_featured',
                        'class'  => array(),
                    ),
                    'products_list_block_1' => array(
                        'label'  => __( 'Product List Block - 1', 'electro' ),
                        'target' => 'products_list_block_1',
                        'class'  => array(),
                    ),
                    'product_categories_list' => array(
                        'label'  => __( 'Product Categories List', 'electro' ),
                        'target' => 'product_categories_list',
                        'class'  => array(),
                    ),
                    'products_list_block_2' => array(
                        'label'  => __( 'Product List Block - 2', 'electro' ),
                        'target' => 'products_list_block_2',
                        'class'  => array(),
                    ),
                    'banner' => array(
                        'label'  => __( 'Banner', 'electro' ),
                        'target' => 'banner_data',
                        'class'  => array(),
                    ),
                    'recently_viewed' => array(
                        'label'  => __( 'Recently Viewed', 'electro' ),
                        'target' => 'recently_viewed',
                        'class'  => array(),
                    ),
                    'features_list' => array(
                        'label'  => __( 'Features List', 'electro' ),
                        'target' => 'features_list',
                        'class'  => array(),
                    )
                    ,
                    'list_categories' => array(
                        'label'  => __( 'List Categories', 'electro' ),
                        'target' => 'list_categories',
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
                        'id'        => '_home_mobile_v2_header_style',
                        'label'     => esc_html__( 'Header Style', 'electro' ),
                        'name'      => '_home_mobile_v2[header_style]',
                        'options'       => array(
                            'v1'    => esc_html__( 'Header v1', 'electro' ),
                            'v2'    => esc_html__( 'Header v2', 'electro' ),
                        ),
                        'name'          => '_home_mobile_v2[hpc][header_style]',
                        'value'         => isset( $home_mobile_v2['hpc']['header_style'] ) ? $home_mobile_v2['hpc']['header_style'] : 'v2',
                    ) );

                    electro_wp_select( array(
                        'id'        => '_home_mobile_v2_footer_style',
                        'label'     => esc_html__( 'Footer Style', 'electro' ),
                        'name'      => '_home_mobile_v2[footer_style]',
                        'options'       => array(
                            'v1'    => esc_html__( 'Footer v1', 'electro' ),
                            'v2'    => esc_html__( 'Footer v2', 'electro' ),
                        ),
                        'name'          => '_home_mobile_v2[hpc][footer_style]',
                        'value'         => isset( $home_mobile_v2['hpc']['footer_style'] ) ? $home_mobile_v2['hpc']['footer_style'] : 'v2',
                    ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_mobile_v2_blocks = array(
                            'hpc'       => esc_html__( 'Page content', 'electro' ),
                            'sdr'       => esc_html__( 'Slider', 'electro' ),
                            'ad'        => esc_html__( 'Ads Block', 'electro' ),
                            'dpwf'      => esc_html__( 'Deals Product With Fatured', 'electro' ),
                            'pl1'       => esc_html__( 'Product List Block - 1', 'electro' ),
                            'pcl'       => esc_html__( 'Product Categories List', 'electro' ),
                            'pl2'       => esc_html__( 'Product List Block - 2', 'electro' ),
                            'bd'        => esc_html__( 'Banner', 'electro' ),
                            'rvp'       => esc_html__( 'Recently Viewed', 'electro' ),
                            'fl'        => esc_html__( 'Features List', 'electro' ),
                            'hlc'       => esc_html__( 'List Categories', 'electro' ),
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
                            <?php foreach( $home_mobile_v2_blocks as $key => $home_mobile_v2_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_mobile_v2_block ); ?></td>
                                <td><?php electro_wp_animation_dropdown( array(  'id' => '_home_mobile_v2_' . $key . '_animation', 'label'=> '', 'name' => '_home_mobile_v2[' . $key . '][animation]', 'value' => isset( $home_mobile_v2['' . $key . '']['animation'] ) ? $home_mobile_v2['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php electro_wp_text_input( array(  'id' => '_home_mobile_v2_' . $key . '_priority', 'label'=> '', 'name' => '_home_mobile_v2[' . $key . '][priority]', 'value' => isset( $home_mobile_v2['' . $key . '']['priority'] ) ? $home_mobile_v2['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php electro_wp_checkbox( array( 'id' => '_home_mobile_v2_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_mobile_v2[' . $key . '][is_enabled]', 'value'=> isset( $home_mobile_v2['' . $key . '']['is_enabled'] ) ? $home_mobile_v2['' . $key . '']['is_enabled'] : '', ) ); ?></td>
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
                        'id'            => '_home_mobile_v2_sdr_shortcode',
                        'label'         => esc_html__( 'Shortcode', 'electro' ),
                        'placeholder'   => __( 'Enter the shorcode for your slider here', 'electro' ),
                        'name'          => '_home_mobile_v2[sdr][shortcode]',
                        'value'         => isset( $home_mobile_v2['sdr']['shortcode'] ) ? $home_mobile_v2['sdr']['shortcode'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#slider_block -->

            <div id="ads_block" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Ads Block 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_1_ad_text',
                        'label'         => esc_html__( 'Ad Text', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][0][ad_text]',
                        'value'         => isset( $home_mobile_v2['ad'][0]['ad_text'] ) ? $home_mobile_v2['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Big<br> <strong>Deals</strong> on the Cameras', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_1_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][0][action_text]',
                        'value'         => isset( $home_mobile_v2['ad'][0]['action_text'] ) ? $home_mobile_v2['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][0][action_link]',
                        'value'         => isset( $home_mobile_v2['ad'][0]['action_link'] ) ? $home_mobile_v2['ad'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v2_ad_1_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][0][ad_image]',
                        'value'         => isset( $home_mobile_v2['ad'][0]['ad_image'] ) ? $home_mobile_v2['ad'][0]['ad_image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_1_el_class',
                        'label'         => esc_html__( 'Extra Class', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][0][el_class]',
                        'value'         => isset( $home_mobile_v2['ad'][0]['el_class'] ) ? $home_mobile_v2['ad'][0]['el_class'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_2_ad_text',
                        'label'         => esc_html__( 'Ad Text', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][1][ad_text]',
                        'value'         => isset( $home_mobile_v2['ad'][1]['ad_text'] ) ? $home_mobile_v2['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets,<br> Mobiles <br><strong>and more</strong>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_2_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][1][action_text]',
                        'value'         => isset( $home_mobile_v2['ad'][1]['action_text'] ) ? $home_mobile_v2['ad'][1]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][1][action_link]',
                        'value'         => isset( $home_mobile_v2['ad'][1]['action_link'] ) ? $home_mobile_v2['ad'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v2_ad_2_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][1][ad_image]',
                        'value'         => isset( $home_mobile_v2['ad'][1]['ad_image'] ) ? $home_mobile_v2['ad'][1]['ad_image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_ad_2_el_class',
                        'label'         => esc_html__( 'Extra Class', 'electro' ),
                        'name'          => '_home_mobile_v2[ad][1][el_class]',
                        'value'         => isset( $home_mobile_v2['ad'][1]['el_class'] ) ? $home_mobile_v2['ad'][1]['el_class'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#ads_block -->

            <div id="deal_products_with_featured" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_dpwf_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v2[dpwf][section_title]',
                        'value'         => isset( $home_mobile_v2['dpwf']['section_title'] ) ? $home_mobile_v2['dpwf']['section_title'] : '',
                    ) );

                     electro_wp_wc_shortcode( array(
                        'id'            => '_home_mobile_v2_dpwf_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_mobile_v2[dpwf][content]',
                        'value'         => isset( $home_mobile_v2['dpwf']['content'] ) ? $home_mobile_v2['dpwf']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_dpwf_timer_title',
                        'label'         => esc_html__( 'Timer Title', 'electro' ),
                        'name'          => '_home_mobile_v2[dpwf][timer_title]',
                        'value'         => isset( $home_mobile_v2['dpwf']['timer_title'] ) ? $home_mobile_v2['dpwf']['timer_title'] : '',
                    ) );

                     electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_dpwf_header_timer',
                        'label'         => esc_html__( 'Header Timer?', 'electro' ),
                        'name'          => '_home_mobile_v2[dpwf][header_timer]',
                        'value'         => isset( $home_mobile_v2['dpwf']['header_timer'] ) ? $home_mobile_v2['dpwf']['header_timer'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_dpwf_timer_value',
                        'label'         => esc_html__( 'Timer Value', 'electro' ),
                        'name'          => '_home_mobile_v2[dpwf][timer_value]',
                        'value'         => isset( $home_mobile_v2['dpwf']['timer_value'] ) ? $home_mobile_v2['dpwf']['timer_value'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#deal_products_with_featured -->

            <div id="products_list_block_1" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][section_title]',
                        'value'         => isset( $home_mobile_v2['pl1']['section_title'] ) ? $home_mobile_v2['pl1']['section_title'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_pl1_enable_categories',
                        'label'         => esc_html__( 'Enable Categories?', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][enable_categories]',
                        'value'         => isset( $home_mobile_v2['pl1']['enable_categories'] ) ? $home_mobile_v2['pl1']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][categories_title]',
                        'value'         => isset( $home_mobile_v2['pl1']['categories_title'] ) ? $home_mobile_v2['pl1']['categories_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][category_args][slugs]',
                        'value'         => isset( $home_mobile_v2['pl1']['category_args']['slugs'] ) ? $home_mobile_v2['pl1']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][category_args][orderby]',
                        'value'         => isset( $home_mobile_v2['pl1']['category_args']['orderby'] ) ? $home_mobile_v2['pl1']['category_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][category_args][order]',
                        'value'         => isset( $home_mobile_v2['pl1']['category_args']['order'] ) ? $home_mobile_v2['pl1']['category_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][category_args][number]',
                        'value'         => isset( $home_mobile_v2['pl1']['category_args']['number'] ) ? $home_mobile_v2['pl1']['category_args']['number'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_pl1_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][category_args][hide_empty]',
                        'value'         => isset( $home_mobile_v2['pl1']['category_args']['hide_empty'] ) ? $home_mobile_v2['pl1']['category_args']['hide_empty'] : '',
                    ) );

                     electro_wp_wc_shortcode( array(
                        'id'            => '_home_mobile_v2_pl1_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'featured_products',
                        'name'          => '_home_mobile_v2[pl1][content]',
                        'value'         => isset( $home_mobile_v2['pl1']['content'] ) ? $home_mobile_v2['pl1']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][action_text]',
                        'value'         => isset( $home_mobile_v2['pl1']['action_text'] ) ? $home_mobile_v2['pl1']['action_text'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][action_link]',
                        'value'         => isset( $home_mobile_v2['pl1']['action_link'] ) ? $home_mobile_v2['pl1']['action_link'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_list_Block_1 -->

            <div id="product_categories_list" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pcl_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][section_title]',
                        'value'         => isset( $home_mobile_v2['pcl']['section_title'] ) ? $home_mobile_v2['pcl']['section_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pcl_sub_title',
                        'label'         => esc_html__( 'Subtitle', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][sub_title]',
                        'value'         => isset( $home_mobile_v2['pcl']['sub_title'] ) ? $home_mobile_v2['pcl']['sub_title'] : '',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v2_pcl_bg_image',
                        'label'         => esc_html__( 'Background Image', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][bg_image]',
                        'value'         => isset( $home_mobile_v2['pcl']['bg_image'] ) ? $home_mobile_v2['pcl']['bg_image'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_pcl_enable_header',
                        'label'         => esc_html__( 'Enable Header?', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][enable_header]',
                        'value'         => isset( $home_mobile_v2['pcl']['enable_header'] ) ? $home_mobile_v2['pcl']['enable_header'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pcl_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][cat_args][slugs]',
                        'value'         => isset( $home_mobile_v2['pcl']['cat_args']['slugs'] ) ? $home_mobile_v2['pcl']['cat_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_pl1_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v2[pl1][category_args][hide_empty]',
                        'value'         => isset( $home_mobile_v2['pl1']['category_args']['hide_empty'] ) ? $home_mobile_v2['pl1']['category_args']['hide_empty'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pcl_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][cat_args][orderby]',
                        'value'         => isset( $home_mobile_v2['pcl']['cat_args']['orderby'] ) ? $home_mobile_v2['pcl']['cat_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pcl_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][cat_args][order]',
                        'value'         => isset( $home_mobile_v2['pcl']['cat_args']['order'] ) ? $home_mobile_v2['pcl']['cat_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pcl_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][cat_args][number]',
                        'value'         => isset( $home_mobile_v2['pcl']['cat_args']['number'] ) ? $home_mobile_v2['pcl']['cat_args']['number'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pcl_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'name'          => '_home_mobile_v2[pcl][columns]',
                        'value'         => isset( $home_mobile_v2['pcl']['columns'] ) ? $home_mobile_v2['pcl']['columns'] : '3',
                    ) );
                ?>
                </div>
            </div><!-- /#product_categories_list -->

            <div id="products_list_block_2" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][section_title]',
                        'value'         => isset( $home_mobile_v2['pl2']['section_title'] ) ? $home_mobile_v2['pl2']['section_title'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_pl2_enable_categories',
                        'label'         => esc_html__( 'Enable Categories?', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][enable_categories]',
                        'value'         => isset( $home_mobile_v2['pl2']['enable_categories'] ) ? $home_mobile_v2['pl2']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][categories_title]',
                        'value'         => isset( $home_mobile_v2['pl2']['categories_title'] ) ? $home_mobile_v2['pl2']['categories_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][category_args][slugs]',
                        'value'         => isset( $home_mobile_v2['pl2']['category_args']['slugs'] ) ? $home_mobile_v2['pl2']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][category_args][orderby]',
                        'value'         => isset( $home_mobile_v2['pl2']['category_args']['orderby'] ) ? $home_mobile_v2['pl2']['category_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][category_args][order]',
                        'value'         => isset( $home_mobile_v2['pl2']['category_args']['order'] ) ? $home_mobile_v2['pl2']['category_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][category_args][number]',
                        'value'         => isset( $home_mobile_v2['pl2']['category_args']['number'] ) ? $home_mobile_v2['pl2']['category_args']['number'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_pl2_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][category_args][hide_empty]',
                        'value'         => isset( $home_mobile_v2['pl2']['category_args']['hide_empty'] ) ? $home_mobile_v2['pl2']['category_args']['hide_empty'] : '',
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_mobile_v2_pl2_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_mobile_v2[pl2][content]',
                        'value'         => isset( $home_mobile_v2['pl2']['content'] ) ? $home_mobile_v2['pl2']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][action_text]',
                        'value'         => isset( $home_mobile_v2['pl2']['action_text'] ) ? $home_mobile_v2['pl2']['action_text'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_pl2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v2[pl2][action_link]',
                        'value'         => isset( $home_mobile_v2['pl2']['action_link'] ) ? $home_mobile_v2['pl2']['action_link'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_list_Block_2 -->

            <div id="banner_data" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_mobile_v2_bd_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_mobile_v2[bd][image]',
                        'value'         => isset( $home_mobile_v2['bd']['image'] ) ? $home_mobile_v2['bd']['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_bd_link',
                        'label'         => esc_html__( 'Link', 'electro' ),
                        'name'          => '_home_mobile_v2[bd][link]',
                        'value'         => isset( $home_mobile_v2['bd']['link'] ) ? $home_mobile_v2['bd']['link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#banner_data -->

            <div id="recently_viewed" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_rvp_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v2[rvp][section_title]',
                        'value'         => isset( $home_mobile_v2['rvp']['section_title'] ) ? $home_mobile_v2['rvp']['section_title'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#recently_viewed -->

            <div id="features_list" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Feature 1', 'electro' ) ); ?>
                
                <div class="options_group">
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_1_icon',
                        'label'         => esc_html__( 'Icon', 'electro' ), 
                        'placeholder'   => __( 'Enter the icon for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][0][icon]',
                        'value'         => isset( $home_mobile_v2['fl'][0]['icon'] ) ? $home_mobile_v2['fl'][0]['icon'] : 'ec ec-transport',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_1_text',
                        'label'         => esc_html__( 'Text', 'electro' ), 
                        'placeholder'   => __( 'Enter the text for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][0][text]',
                        'value'         => isset( $home_mobile_v2['fl'][0]['text'] ) ? $home_mobile_v2['fl'][0]['text'] : wp_kses_post( __( '<strong>Free Delivery</strong> from $50', 'electro' ) ),
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Feature 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_2_icon',
                        'label'         => esc_html__( 'Icon', 'electro' ), 
                        'placeholder'   => __( 'Enter the icon for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][1][icon]',
                        'value'         => isset( $home_mobile_v2['fl'][1]['icon'] ) ? $home_mobile_v2['fl'][1]['icon'] : 'ec ec-customers',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_2_text',
                        'label'         => esc_html__( 'Text', 'electro' ), 
                        'placeholder'   => __( 'Enter the text for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][1][text]',
                        'value'         => isset( $home_mobile_v2['fl'][1]['text'] ) ? $home_mobile_v2['fl'][1]['text'] : wp_kses_post( __( '<strong>99% Positive</strong> Feedbacks', 'electro' ) ),
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Feature 3', 'electro' ) ); ?>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_3_icon',
                        'label'         => esc_html__( 'Icon', 'electro' ), 
                        'placeholder'   => __( 'Enter the icon for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][2][icon]',
                        'value'         => isset( $home_mobile_v2['fl'][2]['icon'] ) ? $home_mobile_v2['fl'][2]['icon'] : 'ec ec-returning',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_3_text',
                        'label'         => esc_html__( 'Text', 'electro' ), 
                        'placeholder'   => __( 'Enter the text for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][2][text]',
                        'value'         => isset( $home_mobile_v2['fl'][2]['text'] ) ? $home_mobile_v2['fl'][2]['text'] : wp_kses_post( __( '<strong>365 days</strong> for free return', 'electro' ) ),
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Feature 4', 'electro' ) ); ?>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_4_icon',
                        'label'         => esc_html__( 'Icon', 'electro' ), 
                        'placeholder'   => __( 'Enter the icon for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][3][icon]',
                        'value'         => isset( $home_mobile_v2['fl'][3]['icon'] ) ? $home_mobile_v2['fl'][3]['icon'] : 'ec ec-payment',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_4_text',
                        'label'         => esc_html__( 'Text', 'electro' ), 
                        'placeholder'   => __( 'Enter the text for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][3][text]',
                        'value'         => isset( $home_mobile_v2['fl'][3]['text'] ) ? $home_mobile_v2['fl'][3]['text'] : wp_kses_post( __( '<strong>Payment</strong> Secure System', 'electro' ) ),
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Feature 5', 'electro' ) ); ?>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_5_icon',
                        'label'         => esc_html__( 'Icon', 'electro' ), 
                        'placeholder'   => __( 'Enter the icon for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][4][icon]',
                        'value'         => isset( $home_mobile_v2['fl'][4]['icon'] ) ? $home_mobile_v2['fl'][4]['icon'] : 'ec ec-tag',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_fl_5_text',
                        'label'         => esc_html__( 'Text', 'electro' ), 
                        'placeholder'   => __( 'Enter the text for your features here', 'electro' ),
                        'name'          => '_home_mobile_v2[fl][4][text]',
                        'value'         => isset( $home_mobile_v2['fl'][4]['text'] ) ? $home_mobile_v2['fl'][4]['text'] : wp_kses_post( __( '<strong>Only Best</strong> Brands', 'electro' ) ),
                    ) );
                ?>
                </div>
                
            </div><!-- /#features_list -->

            <div id="list_categories" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][section_title]',
                        'value'         => isset( $home_mobile_v2['hlc']['section_title'] ) ? $home_mobile_v2['hlc']['section_title'] : wp_kses_post( __( 'Tranding Categories', 'electro' ) ),
                    ) );
                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][action_text]',
                        'value'         => isset( $home_mobile_v2['hlc']['action_text'] ) ? $home_mobile_v2['hlc']['action_text'] : wp_kses_post( __( 'See all Products', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][action_link]',
                        'value'         => isset( $home_mobile_v2['hlc']['action_link'] ) ? $home_mobile_v2['hlc']['action_link'] : '',
                    ) );
                ?>
                <?php electro_wp_legend( esc_html__( 'Category 1', 'electro' ) ); ?>
                
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_hlc_1_title',
                        'label'         => esc_html__( 'Title', 'electro' ), 
                        'name'          => '_home_mobile_v2[hlc][category_list][0][title]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][0]['title'] ) ? $home_mobile_v2['hlc']['category_list'][0]['title'] : wp_kses_post( __( 'Mobiles', 'electro' ) ),
                    ) );
                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_1_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][0][category_args][slugs]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][0]['category_args']['slugs'] ) ? $home_mobile_v2['hlc']['category_list'][0]['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );
                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_1_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][0][category_args][orderby]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][0]['category_args']['orderby'] ) ? $home_mobile_v2['hlc']['category_list'][0]['category_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_1_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][0][category_args][order]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][0]['category_args']['order'] ) ? $home_mobile_v2['hlc']['category_list'][0]['category_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_1_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][0][category_args][number]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][0]['category_args']['number'] ) ? $home_mobile_v2['hlc']['category_list'][0]['category_args']['number'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_hlc_1_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][0][category_args][hide_empty]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][0]['category_args']['hide_empty'] ) ? $home_mobile_v2['hlc']['category_list'][0]['category_args']['hide_empty'] : '',
                    ) );
                ?>

                <?php electro_wp_legend( esc_html__( 'Category 2', 'electro' ) ); ?>

                <?php
                   electro_wp_text_input( array( 
                        'id'            => '_home_mobile_v2_hlc_2_title',
                        'label'         => esc_html__( 'Title', 'electro' ), 
                        'name'          => '_home_mobile_v2[hlc][category_list][1][title]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][1]['title'] ) ? $home_mobile_v2['hlc']['category_list'][1]['title'] : wp_kses_post( __( 'Games', 'electro' ) ),
                    ) );
                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_2_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][1][category_args][slugs]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][1]['category_args']['slugs'] ) ? $home_mobile_v2['hlc']['category_list'][1]['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );
                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_2_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][1][category_args][orderby]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][1]['category_args']['orderby'] ) ? $home_mobile_v2['hlc']['category_list'][1]['category_args']['orderby'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_2_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][1][category_args][order]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][1]['category_args']['order'] ) ? $home_mobile_v2['hlc']['category_list'][1]['category_args']['order'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_mobile_v2_hlc_2_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][1][category_args][number]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][1]['category_args']['number'] ) ? $home_mobile_v2['hlc']['category_list'][1]['category_args']['number'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_mobile_v2_hlc_2_hide_empty',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_mobile_v2[hlc][category_list][1][category_args][hide_empty]',
                        'value'         => isset( $home_mobile_v2['hlc']['category_list'][1]['category_args']['hide_empty'] ) ? $home_mobile_v2['hlc']['category_list'][1]['category_args']['hide_empty'] : '',
                    ) );
                ?>
                </div>                
            </div><!-- /#list_categories -->
        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_mobile_v2'] ) ) {
            $clean_home_mobile_v2_options = electro_clean_kses_post( $_POST['_home_mobile_v2'] );
            update_post_meta( $post_id, '_home_mobile_v2_options',  serialize( $clean_home_mobile_v2_options ) );
        }
    }
}
