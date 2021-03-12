<?php
/**
 * Home v5 Metabox
 *
 * Displays the home v5 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_v5 Class
 */
class Electro_Meta_Box_Home_v5 {

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

        if ( $template_file !== 'template-homepage-v5.php' ) {
            return;
        }

        self::output_home_v5( $post );
    }

    private static function output_home_v5( $post ) {

        $home_v5 = electro_get_home_v5_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs ec-tabs">
            <?php
                $product_data_tabs = apply_filters( 'electro_home_v5_data_tabs', array(
                    'general' => array(
                        'label'  => __( 'General', 'electro' ),
                        'target' => 'general_block',
                        'class'  => array(),
                    ),
                    'nav_menu' => array(
                        'label'  => __( 'Nav Menu', 'electro' ),
                        'target' => 'nav_menu_block',
                        'class'  => array(),
                    ),
                    'slider' => array(
                        'label'  => __( 'Slider', 'electro' ),
                        'target' => 'slider_block',
                        'class'  => array(),
                    ),
                    'products_carousel_tabs' => array(
                        'label'  => __( 'Products Carousel Tabs', 'electro' ),
                        'target' => 'products_carousel_tabs',
                        'class'  => array(),
                    ),
                    'ads_block' => array(
                        'label'  => __( 'Ads Block', 'electro' ),
                        'target' => 'ads_block',
                        'class'  => array(),
                    ),
                    'products_carousel' => array(
                        'label'  => __( 'Products Carousel', 'electro' ),
                        'target' => 'products_carousel',
                        'class'  => array(),
                    ),
                    'products_carousel_with_categories_1' => array(
                        'label'  => __( 'Products Carousel with Categories - 1', 'electro' ),
                        'target' => 'products_carousel_with_categories_1',
                        'class'  => array(),
                    ),
                    'banner' => array(
                        'label'  => __( 'Banner', 'electro' ),
                        'target' => 'banner_data',
                        'class'  => array(),
                    ),
                    'products_carousel_with_categories_2' => array(
                        'label'  => __( 'Products Carousel with Categories - 2', 'electro' ),
                        'target' => 'products_carousel_with_categories_2',
                        'class'  => array(),
                    ),
                    'product_cards_carousel' => array(
                        'label'  => __( 'Product Cards Carousel', 'electro' ),
                        'target' => 'product_cards_carousel',
                        'class'  => array(),
                    ),
                    'hcb_block' => array(
                        'label'  => __( 'Categories Block', 'electro' ),
                        'target' => 'hcb_block',
                        'class'  => array(),
                    ),
                    'electro_ads_with_banners' => array(
                        'label'  => __( 'Ads with Banners', 'electro' ),
                        'target' => 'electro_ads_with_banners',
                        'class'  => array(),
                    ),
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
                        'id'        => '_home_v5_header_style',
                        'label'     => esc_html__( 'Header Style', 'electro' ),
                        'name'      => '_home_v5[header_style]',
                        'options'       => array(
                            'v1'    => esc_html__( 'Header v1', 'electro' ),
                            'v2'    => esc_html__( 'Header v2', 'electro' ),
                            'v3'    => esc_html__( 'Header v3', 'electro' ),
                            'v4'    => esc_html__( 'Header v4', 'electro' ),
                            'v5'    => esc_html__( 'Header v5', 'electro' ),
                            'v6'    => esc_html__( 'Header v6', 'electro' ),
                            'v7'    => esc_html__( 'Header v7', 'electro' ),
                            'v8'    => esc_html__( 'Header v8', 'electro' ),
                            'v9'    => esc_html__( 'Header v9', 'electro' ),
                        ),
                        'value'     => isset( $home_v5['header_style'] ) ? $home_v5['header_style'] : 'v6',
                    ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_v5_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'electro' ),
                            'nav'   => esc_html__( 'Nav Menu', 'electro' ),
                            'sdr'   => esc_html__( 'Slider', 'electro' ),
                            'ptc'   => esc_html__( 'Products Carousel Tabs', 'electro' ),
                            'ad'    => esc_html__( 'Ads Block', 'electro' ),
                            'pc'    => esc_html__( 'Products Carousel', 'electro' ),
                            'pc1'   => esc_html__( 'Products Carousel with Categories - 1', 'electro' ),
                            'bd'    => esc_html__( 'Banner', 'electro' ),
                            'pc2'   => esc_html__( 'Products Carousel with Categories - 2', 'electro' ),
                            'pcc'   => esc_html__( 'Product Cards Carousel', 'electro' ),
                            'hcb'   => esc_html__( 'Categories Block', 'electro' ),
                            'awb'   => esc_html__( 'Ads with Banners', 'electro' ),
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
                            <?php foreach( $home_v5_blocks as $key => $home_v5_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v5_block ); ?></td>
                                <td><?php electro_wp_animation_dropdown( array(  'id' => '_home_v5_' . $key . '_animation', 'label'=> '', 'name' => '_home_v5[' . $key . '][animation]', 'value' => isset( $home_v5['' . $key . '']['animation'] ) ? $home_v5['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php electro_wp_text_input( array(  'id' => '_home_v5_' . $key . '_priority', 'label'=> '', 'name' => '_home_v5[' . $key . '][priority]', 'value' => isset( $home_v5['' . $key . '']['priority'] ) ? $home_v5['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php electro_wp_checkbox( array( 'id' => '_home_v5_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v5[' . $key . '][is_enabled]', 'value'=> isset( $home_v5['' . $key . '']['is_enabled'] ) ? $home_v5['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /#general_block -->

            <div id="nav_menu_block" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_nav_title',
                        'label'         => esc_html__( 'Title', 'electro' ),
                        'placeholder'   => __( 'Enter the title for your menu here', 'electro' ),
                        'name'          => '_home_v5[nav][title]',
                        'value'         => isset( $home_v5['nav']['title'] ) ? $home_v5['nav']['title'] : '',
                    ) );

                    electro_wp_nav_menus_dropdown( array(
                        'id'            => '_home_v5_nav_menu',
                        'label'         => esc_html__( 'Menu', 'electro' ),
                        'name'          => '_home_v5[nav][menu]',
                        'value'         => isset( $home_v5['nav']['menu'] ) ? $home_v5['nav']['menu'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#nav_menu_block -->

            <div id="slider_block" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_sdr_shortcode',
                        'label'         => esc_html__( 'Shortcode', 'electro' ),
                        'placeholder'   => __( 'Enter the shorcode for your slider here', 'electro' ),
                        'name'          => '_home_v5[sdr][shortcode]',
                        'value'         => isset( $home_v5['sdr']['shortcode'] ) ? $home_v5['sdr']['shortcode'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#slider_block -->

            <div id="products_carousel_tabs" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v5[ptc][section_title]',
                        'value'         => isset( $home_v5['ptc']['section_title'] ) ? $home_v5['ptc']['section_title'] : esc_html__( 'Save Big on Warehouse Cleaning', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v5[ptc][button_text]',
                        'value'         => isset( $home_v5['ptc']['button_text'] ) ? $home_v5['ptc']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v5[ptc][button_link]',
                        'value'         => isset( $home_v5['ptc']['button_link'] ) ? $home_v5['ptc']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v5[ptc][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 18,
                        'value'         => isset( $home_v5['ptc']['product_limit'] ) ? $home_v5['ptc']['product_limit'] : 18,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v5_ptc_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '6',
                        'name'          => '_home_v5[ptc][product_columns]',
                        'value'         => isset( $home_v5['ptc']['product_columns'] ) ? $home_v5['ptc']['product_columns'] : 6,
                    ) );

                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_tabs_1_title',
                        'label'         => esc_html__( 'Tab #1 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-80% off', 'electro' ),
                        'name'          => '_home_v5[ptc][tabs][0][title]',
                        'value'         => isset( $home_v5['ptc']['tabs'][0]['title'] ) ? $home_v5['ptc']['tabs'][0]['title'] : esc_html__( '-80% off', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_ptc_tabs_1_content',
                        'label'         => esc_html__( 'Tab #1 Content', 'electro' ),
                        'default'       => 'featured_products',
                        'name'          => '_home_v5[ptc][tabs][0][content]',
                        'value'         => isset( $home_v5['ptc']['tabs'][0]['content'] ) ? $home_v5['ptc']['tabs'][0]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_tabs_2_title',
                        'label'         => esc_html__( 'Tab #2 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-80% off', 'electro' ),
                        'name'          => '_home_v5[ptc][tabs][1][title]',
                        'value'         => isset( $home_v5['ptc']['tabs'][1]['title'] ) ? $home_v5['ptc']['tabs'][1]['title'] : esc_html__( '-65%f', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_ptc_tabs_2_content',
                        'label'         => esc_html__( 'Tab #2 Content', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_v5[ptc][tabs][1][content]',
                        'value'         => isset( $home_v5['ptc']['tabs'][1]['content'] ) ? $home_v5['ptc']['tabs'][1]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_tabs_3_title',
                        'label'         => esc_html__( 'Tab #3 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-80% off', 'electro' ),
                        'name'          => '_home_v5[ptc][tabs][2][title]',
                        'value'         => isset( $home_v5['ptc']['tabs'][2]['title'] ) ? $home_v5['ptc']['tabs'][2]['title'] : esc_html__( '-45%', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_ptc_tabs_3_content',
                        'label'         => esc_html__( 'Tab #3 Content', 'electro' ),
                        'default'       => 'top_rated_products',
                        'name'          => '_home_v5[ptc][tabs][2][content]',
                        'value'         => isset( $home_v5['ptc']['tabs'][2]['content'] ) ? $home_v5['ptc']['tabs'][2]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ptc_tabs_4_title',
                        'label'         => esc_html__( 'Tab #4 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-80% off', 'electro' ),
                        'name'          => '_home_v5[ptc][tabs][3][title]',
                        'value'         => isset( $home_v5['ptc']['tabs'][3]['title'] ) ? $home_v5['ptc']['tabs'][3]['title'] : esc_html__( '-25%', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_ptc_tabs_4_content',
                        'label'         => esc_html__( 'Tab #4 Content', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v5[ptc][tabs][3][content]',
                        'value'         => isset( $home_v5['ptc']['tabs'][3]['content'] ) ? $home_v5['ptc']['tabs'][3]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v5_ptc_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v5[ptc][carousel_args]',
                        'value'         => isset( $home_v5['ptc']['carousel_args'] ) ? $home_v5['ptc']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_tabs -->

            <div id="ads_block" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Ads Block 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_1_ad_text',
                        'label'         => esc_html__( 'Ad Text', 'electro' ),
                        'name'          => '_home_v5[ad][0][ad_text]',
                        'value'         => isset( $home_v5['ad'][0]['ad_text'] ) ? $home_v5['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Hottest<br> <strong>Deals</strong> in Cameras<br> Category', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_1_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v5[ad][0][action_text]',
                        'value'         => isset( $home_v5['ad'][0]['action_text'] ) ? $home_v5['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v5[ad][0][action_link]',
                        'value'         => isset( $home_v5['ad'][0]['action_link'] ) ? $home_v5['ad'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v5_ad_1_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v5[ad][0][ad_image]',
                        'value'         => isset( $home_v5['ad'][0]['ad_image'] ) ? $home_v5['ad'][0]['ad_image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_1_el_class',
                        'label'         => esc_html__( 'Extra Class', 'electro' ),
                        'name'          => '_home_v5[ad][0][el_class]',
                        'value'         => isset( $home_v5['ad'][0]['el_class'] ) ? $home_v5['ad'][0]['el_class'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_2_ad_text',
                        'label'         => esc_html__( 'Ad Text', 'electro' ),
                        'name'          => '_home_v5[ad][1][ad_text]',
                        'value'         => isset( $home_v5['ad'][1]['ad_text'] ) ? $home_v5['ad'][1]['ad_text'] : wp_kses_post( __( 'Tablets,<br> Smartphones <br><strong>and more</strong>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_2_action_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v5[ad][1][action_text]',
                        'value'         => isset( $home_v5['ad'][1]['action_text'] ) ? $home_v5['ad'][1]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v5[ad][1][action_link]',
                        'value'         => isset( $home_v5['ad'][1]['action_link'] ) ? $home_v5['ad'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v5_ad_2_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v5[ad][1][ad_image]',
                        'value'         => isset( $home_v5['ad'][1]['ad_image'] ) ? $home_v5['ad'][1]['ad_image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_ad_2_el_class',
                        'label'         => esc_html__( 'Extra Class', 'electro' ),
                        'name'          => '_home_v5[ad][1][el_class]',
                        'value'         => isset( $home_v5['ad'][1]['el_class'] ) ? $home_v5['ad'][1]['el_class'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#ads_block -->

            <div id="products_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v5[pc][section_title]',
                        'value'         => isset( $home_v5['pc']['section_title'] ) ? $home_v5['pc']['section_title'] : esc_html__( 'Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v5[pc][button_text]',
                        'value'         => isset( $home_v5['pc']['button_text'] ) ? $home_v5['pc']['button_text'] : esc_html__( 'Go to Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v5[pc][button_link]',
                        'value'         => isset( $home_v5['pc']['button_link'] ) ? $home_v5['pc']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v5[pc][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v5['pc']['product_limit'] ) ? $home_v5['pc']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v5_pc_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '7',
                        'name'          => '_home_v5[pc][product_columns]',
                        'value'         => isset( $home_v5['pc']['product_columns'] ) ? $home_v5['pc']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_pc_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v5[pc][content]',
                        'value'         => isset( $home_v5['pc']['content'] ) ? $home_v5['pc']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v5_pc_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v5[pc][carousel_args]',
                        'value'         => isset( $home_v5['pc']['carousel_args'] ) ? $home_v5['pc']['carousel_args'] : '',
                    ) );
                ?>
                </div>

            </div><!-- /#products_carousel -->

            <div id="products_carousel_with_categories_1" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc1_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v5[pc1][section_title]',
                        'value'         => isset( $home_v5['pc1']['section_title'] ) ? $home_v5['pc1']['section_title'] : esc_html__( 'Popular Products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc1_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_v5[pc1][categories_title]',
                        'value'         => isset( $home_v5['pc1']['categories_title'] ) ? $home_v5['pc1']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc1_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v5[pc1][category_args][number]',
                        'default'       => 6,
                        'value'         => isset( $home_v5['pc1']['category_args']['number'] ) ? $home_v5['pc1']['category_args']['number'] : 6,
                        'placeholder'   => 6
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc1_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v5[pc1][category_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v5['pc1']['category_args']['slugs'] ) ? $home_v5['pc1']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v5_pc1_hide_empty_categories',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_v5[pc1][category_args][hide_empty]',
                        'value'         => isset( $home_v5['pc1']['category_args']['hide_empty'] ) ? $home_v5['pc1']['category_args']['hide_empty'] : '',
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_pc1_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_v5[pc1][content]',
                        'value'         => isset( $home_v5['pc1']['content'] ) ? $home_v5['pc1']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page' )
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v5_pc1_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '7',
                        'name'          => '_home_v5[pc1][product_columns]',
                        'value'         => isset( $home_v5['pc1']['product_columns'] ) ? $home_v5['pc1']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v5_pc1_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v5[pc1][carousel_args]',
                        'value'         => isset( $home_v5['pc1']['carousel_args'] ) ? $home_v5['pc1']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_with_categories_1 -->

            <div id="banner_data" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v5_bd_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v5[bd][image]',
                        'value'         => isset( $home_v5['bd']['image'] ) ? $home_v5['bd']['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_bd_link',
                        'label'         => esc_html__( 'Link', 'electro' ),
                        'name'          => '_home_v5[bd][link]',
                        'value'         => isset( $home_v5['bd']['link'] ) ? $home_v5['bd']['link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#banner_data -->

            <div id="products_carousel_with_categories_2" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v5[pc2][section_title]',
                        'value'         => isset( $home_v5['pc2']['section_title'] ) ? $home_v5['pc2']['section_title'] : esc_html__( 'Laptops & Computers', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc2_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_v5[pc2][categories_title]',
                        'value'         => isset( $home_v5['pc2']['categories_title'] ) ? $home_v5['pc2']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc2_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v5[pc2][category_args][number]',
                        'default'       => 6,
                        'value'         => isset( $home_v5['pc2']['category_args']['number'] ) ? $home_v5['pc2']['category_args']['number'] : 6,
                        'placeholder'   => 6
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pc2_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v5[pc2][category_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v5['pc2']['category_args']['slugs'] ) ? $home_v5['pc2']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v5_pc2_hide_empty_categories',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ),
                        'name'          => '_home_v5[pc2][category_args][hide_empty]',
                        'value'         => isset( $home_v5['pc2']['category_args']['hide_empty'] ) ? $home_v5['pc2']['category_args']['hide_empty'] : '',
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_pc2_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_v5[pc2][content]',
                        'value'         => isset( $home_v5['pc2']['content'] ) ? $home_v5['pc2']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page' )
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v5_pc2_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '7',
                        'name'          => '_home_v5[pc2][product_columns]',
                        'value'         => isset( $home_v5['pc2']['product_columns'] ) ? $home_v5['pc2']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v5_pc2_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v5[pc2][carousel_args]',
                        'value'         => isset( $home_v5['pc2']['carousel_args'] ) ? $home_v5['pc2']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_with_categories_2 -->

            <div id="product_cards_carousel" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pcc_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v5[pcc][section_title]',
                        'value'         => isset( $home_v5['pcc']['section_title'] ) ? $home_v5['pcc']['section_title'] : esc_html__( 'Laptops & Computers', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v5_pcc_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v5[pcc][content]',
                        'value'         => isset( $home_v5['pcc']['content'] ) ? $home_v5['pcc']['content'] : '',
                        'fields'        => array( 'order', 'orderby' )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pcc_product_limit',
                        'label'         => esc_html__( 'Product Limit', 'electro' ),
                        'name'          => '_home_v5[pcc][product_limit]',
                        'value'         => isset( $home_v5['pcc']['product_limit'] ) ? $home_v5['pcc']['product_limit'] : 20,
                        'placeholder'   => esc_html__( 'Enter number of products to show', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pcc_product_rows',
                        'label'         => esc_html__( 'Rows', 'electro' ),
                        'name'          => '_home_v5[pcc][product_rows]',
                        'value'         => isset( $home_v5['pcc']['product_rows'] ) ? $home_v5['pcc']['product_rows'] : 1,
                        'placeholder'   => esc_html__( 'Enter number of rows to display', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pcc_product_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'name'          => '_home_v5[pcc][product_columns]',
                        'value'         => isset( $home_v5['pcc']['product_columns'] ) ? $home_v5['pcc']['product_columns'] : 4,
                        'placeholder'   => esc_html__( 'Enter number of products to show', 'electro' ),
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v5_pcc_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v5[pcc][carousel_args]',
                        'value'         => isset( $home_v5['pcc']['carousel_args'] ) ? $home_v5['pcc']['carousel_args'] : '',
                        'fields'        => array( 'autoplay' )
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pcc_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v5[pcc][cat_limit]',
                        'default'       => 5,
                        'value'         => isset( $home_v5['pcc']['cat_limit'] ) ? $home_v5['pcc']['cat_limit'] : 5,
                        'placeholder'   => 5
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_pcc_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v5[pcc][cat_slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v5['pcc']['cat_slugs'] ) ? $home_v5['pcc']['cat_slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );
                ?>
                </div>

            </div><!-- /#product_cards_carousel -->

            <div id="hcb_block" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_hcb_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v5[hcb][section_title]',
                        'value'         => isset( $home_v5['hcb']['section_title'] ) ? $home_v5['hcb']['section_title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_hcb_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v5[hcb][cat_slugs]',
                        'value'         => isset( $home_v5['hcb']['cat_slugs'] ) ? $home_v5['hcb']['cat_slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_hcb_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v5[hcb][cat_args][orderby]',
                        'value'         => isset( $home_v5['hcb']['cat_args']['orderby'] ) ? $home_v5['hcb']['cat_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_hcb_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v5[hcb][cat_args][order]',
                        'value'         => isset( $home_v5['hcb']['cat_args']['order'] ) ? $home_v5['hcb']['cat_args']['order'] : 'ASC',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_hcb_order',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_v5[hcb][cat_args][number]',
                        'value'         => isset( $home_v5['hcb']['cat_args']['number'] ) ? $home_v5['hcb']['cat_args']['number'] : '6',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_hcb_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'name'          => '_home_v5[hcb][columns]',
                        'value'         => isset( $home_v5['hcb']['columns'] ) ? $home_v5['hcb']['columns'] : '3',
                    ) );

                    electro_wp_select( array(
                        'id'            => '_home_v5_hcb_enable_full_width',
                        'label'         =>  esc_html__( 'Enable Fullwidth', 'electro' ),
                        'options'       => array(
                            'yes'   => 'yes',
                            'no'    => 'no',
                        ),
                        'class'         => 'full_width_select',
                        'default'       => 'no',
                        'name'          => '_home_v5[hcb][enable_full_width]',
                        'value'         => isset( $home_v5['hcb']['enable_full_width'] ) ? $home_v5['hcb']['enable_full_width'] : 'no',
                    ) );
                ?>
                </div>
            </div><!-- /#hcb_block -->

            <div id="electro_ads_with_banners" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Ads Block 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_1_title',
                        'label'         => esc_html__( 'Title', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][title]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['title'] ) ? $home_v5['awb']['ads_banners'][0]['title'] : wp_kses_post( __( 'G9 Laptops with<br>Ultra 4K HD Display', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_1_description',
                        'label'         => esc_html__( 'Description', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][description]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['description'] ) ? $home_v5['awb']['ads_banners'][0]['description'] : wp_kses_post( __( 'and the fastest Intel Core i7 processor ever', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_1_price',
                        'label'         => esc_html__( 'Price', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][price]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['price'] ) ? $home_v5['awb']['ads_banners'][0]['price'] : wp_kses_post( __( '<span class="prefix">from</span><span class="value"><sup>$</sup>399</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][action_link]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['action_link'] ) ? $home_v5['awb']['ads_banners'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v5_awb_1_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][image]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['image'] ) ? $home_v5['awb']['ads_banners'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_1_banner_action_link',
                        'label'         => esc_html__( 'Banner Action Link', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][banner_action_link]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['banner_action_link'] ) ? $home_v5['awb']['ads_banners'][0]['banner_action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v5_awb_1_banner_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][banner_image]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['banner_image'] ) ? $home_v5['awb']['ads_banners'][0]['banner_image'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v5_awb_1_is_align_end',
                        'label'         => esc_html__( 'Is Banner Alignment End?', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][0][is_align_end]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][0]['is_align_end'] ) ? $home_v5['awb']['ads_banners'][0]['is_align_end'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_2_title',
                        'label'         => esc_html__( 'Title', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][title]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['title'] ) ? $home_v5['awb']['ads_banners'][1]['title'] : wp_kses_post( __( '<strong>Fresh Honor 9</strong><br>32GB Unlocked quadcore', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_2_description',
                        'label'         => esc_html__( 'Description', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][description]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['description'] ) ? $home_v5['awb']['ads_banners'][1]['description'] : wp_kses_post( __( '<span>4GB RAM</span><span>64GB ROM</span><span>20MP + 12MP Dual Camera</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_2_price',
                        'label'         => esc_html__( 'Price', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][price]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['price'] ) ? $home_v5['awb']['ads_banners'][1]['price'] : wp_kses_post( __( '<span class="prefix">now at</span><span class="value"><sup>$</sup>279</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][action_link]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['action_link'] ) ? $home_v5['awb']['ads_banners'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v5_awb_2_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][image]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['image'] ) ? $home_v5['awb']['ads_banners'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v5_awb_2_banner_action_link',
                        'label'         => esc_html__( 'Banner Action Link', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][banner_action_link]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['banner_action_link'] ) ? $home_v5['awb']['ads_banners'][1]['banner_action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v5_awb_2_banner_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][banner_image]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['banner_image'] ) ? $home_v5['awb']['ads_banners'][1]['banner_image'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v5_awb_2_is_align_end',
                        'label'         => esc_html__( 'Is Banner Alignment End?', 'electro' ),
                        'name'          => '_home_v5[awb][ads_banners][1][is_align_end]',
                        'value'         => isset( $home_v5['awb']['ads_banners'][1]['is_align_end'] ) ? $home_v5['awb']['ads_banners'][1]['is_align_end'] : true,
                    ) );
                ?>
                </div>

            </div><!-- /#electro_ads_with_banners -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v5'] ) ) {
            $clean_home_v5_options = electro_clean_kses_post( $_POST['_home_v5'] );
            update_post_meta( $post_id, '_home_v5_options',  serialize( $clean_home_v5_options ) );
        }
    }
}
