<?php
/**
 * Home v9 Metabox
 *
 * Displays the home v9 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_v9 Class
 */
class Electro_Meta_Box_Home_v9 {

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

        if ( $template_file !== 'template-homepage-v9.php' ) {
            return;
        }

        self::output_home_v9( $post );
    }

    private static function output_home_v9( $post ) {

        $home_v9 = electro_get_home_v9_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs ec-tabs">
            <?php
                $product_data_tabs = apply_filters( 'electro_home_v9_data_tabs', array(
                    'general' => array(
                        'label'  => __( 'General', 'electro' ),
                        'target' => 'general_block',
                        'class'  => array(),
                    ),
                    'slider_with_deals_product_carousel' => array(
                        'label'  => esc_html__( 'Slider With Deals Procuct Carousel', 'electro' ),
                        'target' => 'slider_with_deals_product_carousel',
                        'class'  => array(),
                    ),
                    'products_carousel_tabs' => array(
                        'label'  => __( 'Products Carousel Tab', 'electro' ),
                        'target' => 'products_carousel_tabs',
                        'class'  => array(),
                    ),
                    'banner_1_6_block' => array(
                        'label'  => __( 'Banner 1-6', 'electro' ),
                        'target' => 'banner_1_6_block',
                        'class'  => array(),
                    ),
                    'product_categories_with_banner_carousel_1' => array(
                        'label'  => __( 'Product Categories with Banner Carousel - 1', 'electro' ),
                        'target' => 'product_categories_with_banner_carousel_1',
                        'class'  => array(),
                    ),
                    'product_categories_with_banner_carousel_2' => array(
                        'label'  => __( 'Product Categories with Banner Carousel - 2', 'electro' ),
                        'target' => 'product_categories_with_banner_carousel_2',
                        'class'  => array(),
                    ),
                    'products_carousel' => array(
                        'label'  => __( 'Products Carousel', 'electro' ),
                        'target' => 'products_carousel',
                        'class'  => array(),
                    ),
                    'product_categories_with_banner_carousel_3' => array(
                        'label'  => __( 'Product Categories with Banner Carousel - 3', 'electro' ),
                        'target' => 'product_categories_with_banner_carousel_3',
                        'class'  => array(),
                    ),
                    'recently_viewed_carousel' => array(
                        'label'  => __( 'Recently Viewed Carousel', 'electro' ),
                        'target' => 'recently_viewed_carousel',
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
                        'id'        => '_home_v9_header_style',
                        'label'     => esc_html__( 'Header Style', 'electro' ),
                        'name'      => '_home_v9[header_style]',
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
                        'value'     => isset( $home_v9['header_style'] ) ? $home_v9['header_style'] : 'v9',
                    ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_v9_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'electro' ),
                            'swdpc' => esc_html__( 'Slider With Deals Procuct Carousel', 'electro' ),
                            'pct'   => esc_html__( 'Products Carousel Tab', 'electro' ),
                            'bb'    => esc_html__( 'Banner 1-6', 'electro' ),
                            'pcwbc1'=> esc_html__( 'Product Categories with Banner Carousel - 1', 'electro' ),
                            'pcwbc2'=> esc_html__( 'Product Categories with Banner Carousel - 2', 'electro' ),
                            'pc'    => esc_html__( 'Products Carousel', 'electro' ),
                            'pcwbc3'=> esc_html__( 'Product Categories with Banner Carousel - 3', 'electro' ),
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
                            <?php foreach( $home_v9_blocks as $key => $home_v9_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v9_block ); ?></td>
                                <td><?php electro_wp_animation_dropdown( array(  'id' => '_home_v9_' . $key . '_animation', 'label'=> '', 'name' => '_home_v9[' . $key . '][animation]', 'value' => isset( $home_v9['' . $key . '']['animation'] ) ? $home_v9['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php electro_wp_text_input( array(  'id' => '_home_v9_' . $key . '_priority', 'label'=> '', 'name' => '_home_v9[' . $key . '][priority]', 'value' => isset( $home_v9['' . $key . '']['priority'] ) ? $home_v9['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php electro_wp_checkbox( array( 'id' => '_home_v9_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v9[' . $key . '][is_enabled]', 'value'=> isset( $home_v9['' . $key . '']['is_enabled'] ) ? $home_v9['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /#general_block -->

            <div id="slider_with_deals_product_carousel" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Slider', 'electro' ) ); ?>

                <div class="options_group">
                    <?php 
                        electro_wp_text_input( array( 
                            'id'            => '_home_v9_swdpc_slider_shortcode', 
                            'label'         => esc_html__( 'Slider Shortcode', 'electro' ), 
                            'placeholder'   => esc_html__( 'Enter the shorcode for your slider here', 'electro' ),
                            'name'          => '_home_v9[swdpc][slider_shortcode]',
                            'value'         => isset( $home_v9['swdpc']['slider_shortcode'] ) ? $home_v9['swdpc']['slider_shortcode'] : '',
                        ) );
                    ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Deals Procuct Carousel', 'electro' ) ); ?>
                
                <div class="options_group">
                    <?php

                        electro_wp_checkbox( array(
                            'id'            => '_home_v9_swdpc_dpc_is_enabled',
                            'label'         => esc_html__( 'Enable ?', 'electro' ), 
                            'name'          => '_home_v9[swdpc][dpc][is_enabled]',
                            'value'         => isset( $home_v9['swdpc']['dpc']['is_enabled'] ) ? $home_v9['swdpc']['dpc']['is_enabled'] : 'yes',
                        ) );

                        electro_wp_text_input( array( 
                            'id'            => '_home_v9_swdpc_dpc_product_limit', 
                            'label'         => esc_html__( 'Products Limit', 'electro' ), 
                            'placeholder'   => 4,
                            'name'          => '_home_v9[swdpc][dpc][product_limit]',
                            'value'         => isset( $home_v9['swdpc']['dpc']['product_limit'] ) ? $home_v9['swdpc']['dpc']['product_limit'] : 4,
                        ) );

                        electro_wp_select( array(
                            'id'            => '_home_v9_swdpc_dpc_product_choice',
                            'label'         => esc_html__( 'Product Choice', 'electro' ),
                            'options'       => array(
                                'random'    => esc_html__( 'Random On Sale Products', 'electro' ),
                                'recent'    => esc_html__( 'Recent On Sale Products', 'electro' ),
                                'specific'  => esc_html__( 'Specify by IDs', 'electro' ),
                            ),
                            'class'         => 'show_hide_select',
                            'name'          => '_home_v9[swdpc][dpc][product_choice]',
                            'value'         => isset( $home_v9['swdpc']['dpc']['product_choice'] ) ? $home_v9['swdpc']['dpc']['product_choice'] : 'random',
                        ) );
                        
                        electro_wp_text_input( array( 
                            'id'            => '_home_v9_swdpc_dpc_product_ids', 
                            'label'         =>  esc_html__( 'Deal Product IDs', 'electro' ),
                            'name'          => '_home_v9[swdpc][dpc][product_ids]',
                            'wrapper_class' => 'show_if_specific hide',
                            'value'         => isset( $home_v9['swdpc']['dpc']['product_ids'] ) ? $home_v9['swdpc']['dpc']['product_ids'] : '',
                            'placeholder'   => esc_html__( 'Enter product IDs separated by comma', 'electro' ),
                        ) );

                        electro_wp_owl_carousel_options( array( 
                            'id'            => '_home_v9_swdpc_dpc_carousel_args',
                            'label'         => esc_html__( 'Carousel Args', 'electro' ),
                            'name'          => '_home_v9[swdpc][dpc][carousel_args]',
                            'value'         => isset( $home_v9['swdpc']['dpc']['carousel_args'] ) ? $home_v9['swdpc']['dpc']['carousel_args'] : '',
                            'fields'        => array( 'autoplay' )
                        ) );
                    ?>

                </div><!-- /#deals_and_tabs_data -->
            </div><!-- /#slider_with_deals_product_carousel -->

            <div id="products_carousel_tabs" class="panel electro_options_panel">
                
                <div class="options_group">
                <?php 
                    electro_wp_text_input( array( 
                        'id'            => '_home_v9_pct_product_limit', 
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v9[pct][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 2,
                        'value'         => isset( $home_v9['pct']['product_limit'] ) ? $home_v9['pct']['product_limit'] : 6,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v9_pct_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '3',
                        'name'          => '_home_v9[pct][product_columns]',
                        'value'         => isset( $home_v9['pct']['product_columns'] ) ? $home_v9['pct']['product_columns'] : 3,
                    ) );
                ?>
                </div>

                <div class="options_group">
                    <h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
                    <?php
                        electro_wp_select( array( 
                            'id'            => '_home_v9_pct_product_columns_wide', 
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
                            'name'          => '_home_v9[pct][product_columns_wide]',
                            'value'         => isset( $home_v9['pct']['product_columns_wide'] ) ? $home_v9['pct']['product_columns_wide'] : 7,
                        ) );
                    ?>
                </div>

                <div class="options_group">
                <?php   
                    electro_wp_text_input( array( 
                        'id'            => '_home_v9_pct_tabs_1_title', 
                        'label'         => esc_html__( 'Tab #1 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Featured', 'electro' ),
                        'name'          => '_home_v9[pct][tabs][0][title]',
                        'value'         => isset( $home_v9['pct']['tabs'][0]['title'] ) ? $home_v9['pct']['tabs'][0]['title'] : esc_html__( 'Featured', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v9_pct_tabs_1_content',
                        'label'         => esc_html__( 'Tab #1 Content', 'electro' ),
                        'default'       => 'featured_products',
                        'name'          => '_home_v9[pct][tabs][0][content]',
                        'value'         => isset( $home_v9['pct']['tabs'][0]['content'] ) ? $home_v9['pct']['tabs'][0]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_v9_pct_tabs_2_title', 
                        'label'         => esc_html__( 'Tab #2 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'On Sale', 'electro' ),
                        'name'          => '_home_v9[pct][tabs][1][title]',
                        'value'         => isset( $home_v9['pct']['tabs'][1]['title'] ) ? $home_v9['pct']['tabs'][1]['title'] : esc_html__( 'On Sale', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v9_pct_tabs_2_content',
                        'label'         => esc_html__( 'Tab #2 Content', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_v9[pct][tabs][1][content]',
                        'value'         => isset( $home_v9['pct']['tabs'][1]['content'] ) ? $home_v9['pct']['tabs'][1]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array( 
                        'id'            => '_home_v9_pct_tabs_3_title', 
                        'label'         => esc_html__( 'Tab #3 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Top Rated', 'electro' ),
                        'name'          => '_home_v9[pct][tabs][2][title]',
                        'value'         => isset( $home_v9['pct']['tabs'][2]['title'] ) ? $home_v9['pct']['tabs'][2]['title'] : esc_html__( 'Top Rated', 'electro' ),
                    ) );
                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v9_pct_tabs_3_content',
                        'label'         => esc_html__( 'Tab #3 Content', 'electro' ),
                        'default'       => 'top_rated_products',
                        'name'          => '_home_v9[pct][tabs][2][content]',
                        'value'         => isset( $home_v9['pct']['tabs'][2]['content'] ) ? $home_v9['pct']['tabs'][2]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array( 
                        'id'            => '_home_v9_pct_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v9[pct][carousel_args]',
                        'value'         => isset( $home_v9['pct']['carousel_args'] ) ? $home_v9['pct']['carousel_args'] : '',
                        'fields'        => array( 'dots', 'autoplay' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_tabs -->

            <div id="banner_1_6_block" class="panel electro_options_panel">
                <?php electro_wp_legend( esc_html__( 'Banner 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_bb_1_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v9[bb][0][image]',
                        'value'         => isset( $home_v9['bb'][0]['image'] ) ? $home_v9['bb'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_bb_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[bb][0][action_link]',
                        'value'         => isset( $home_v9['bb'][0]['action_link'] ) ? $home_v9['bb'][0]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_bb_2_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v9[bb][1][image]',
                        'value'         => isset( $home_v9['bb'][1]['image'] ) ? $home_v9['bb'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_bb_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[bb][1][action_link]',
                        'value'         => isset( $home_v9['bb'][1]['action_link'] ) ? $home_v9['bb'][1]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 3', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_bb_3_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v9[bb][2][image]',
                        'value'         => isset( $home_v9['bb'][2]['image'] ) ? $home_v9['bb'][2]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_bb_3_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[bb][2][action_link]',
                        'value'         => isset( $home_v9['bb'][2]['action_link'] ) ? $home_v9['bb'][2]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 4', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_bb_4_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v9[bb][3][image]',
                        'value'         => isset( $home_v9['bb'][3]['image'] ) ? $home_v9['bb'][3]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_bb_4_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[bb][3][action_link]',
                        'value'         => isset( $home_v9['bb'][3]['action_link'] ) ? $home_v9['bb'][3]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 5', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_bb_5_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v9[bb][4][image]',
                        'value'         => isset( $home_v9['bb'][4]['image'] ) ? $home_v9['bb'][4]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_bb_5_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[bb][4][action_link]',
                        'value'         => isset( $home_v9['bb'][4]['action_link'] ) ? $home_v9['bb'][4]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 6', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_bb_6_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v9[bb][5][image]',
                        'value'         => isset( $home_v9['bb'][5]['image'] ) ? $home_v9['bb'][5]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_bb_6_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[bb][5][action_link]',
                        'value'         => isset( $home_v9['bb'][5]['action_link'] ) ? $home_v9['bb'][5]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 7', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_bb_7_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v9[bb][6][image]',
                        'value'         => isset( $home_v9['bb'][6]['image'] ) ? $home_v9['bb'][6]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_bb_7_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[bb][6][action_link]',
                        'value'         => isset( $home_v9['bb'][6]['action_link'] ) ? $home_v9['bb'][6]['action_link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#banner_1_6_block -->

            <div id="product_categories_with_banner_carousel_1" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][section_title]',
                        'value'         => isset( $home_v9['pcwbc1']['section_title'] ) ? $home_v9['pcwbc1']['section_title'] : esc_html__( 'Computers & Laptops', 'electro' ),
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 1', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_1_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][0][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['enable_category_1'] ) ? $home_v9['pcwbc1']['content'][0]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_1_args']['slugs'] ) ? $home_v9['pcwbc1']['content'][0]['category_1_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_1_args']['number'] ) ? $home_v9['pcwbc1']['content'][0]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_1_args']['child_number'] ) ? $home_v9['pcwbc1']['content'][0]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_1_args']['orderby'] ) ? $home_v9['pcwbc1']['content'][0]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_1_args']['order'] ) ? $home_v9['pcwbc1']['content'][0]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_1_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][0][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['enable_category_2'] ) ? $home_v9['pcwbc1']['content'][0]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_2_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_2_args']['slugs'] ) ? $home_v9['pcwbc1']['content'][0]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_2_args']['number'] ) ? $home_v9['pcwbc1']['content'][0]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_2_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_2_args']['orderby'] ) ? $home_v9['pcwbc1']['content'][0]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_category_2_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['category_2_args']['order'] ) ? $home_v9['pcwbc1']['content'][0]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_1_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][0][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['enable_banner'] ) ? $home_v9['pcwbc1']['content'][0]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc1_content_1_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][image]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['image'] ) ? $home_v9['pcwbc1']['content'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_1_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][0][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][0]['img_action_link'] ) ? $home_v9['pcwbc1']['content'][0]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 2', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_2_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][1][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['enable_category_1'] ) ? $home_v9['pcwbc1']['content'][1]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_1_args']['slugs'] ) ? $home_v9['pcwbc1']['content'][1]['category_1_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_1_args']['number'] ) ? $home_v9['pcwbc1']['content'][1]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_1_args']['child_number'] ) ? $home_v9['pcwbc1']['content'][1]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_1_args']['orderby'] ) ? $home_v9['pcwbc1']['content'][1]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_1_args']['order'] ) ? $home_v9['pcwbc1']['content'][1]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_2_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][1][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['enable_category_2'] ) ? $home_v9['pcwbc1']['content'][1]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_2_args']['slugs'] ) ? $home_v9['pcwbc1']['content'][1]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_2_args']['number'] ) ? $home_v9['pcwbc1']['content'][1]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_2_args']['orderby'] ) ? $home_v9['pcwbc1']['content'][1]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['category_2_args']['order'] ) ? $home_v9['pcwbc1']['content'][1]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_2_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][1][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['enable_banner'] ) ? $home_v9['pcwbc1']['content'][1]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc1_content_2_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][image]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['image'] ) ? $home_v9['pcwbc1']['content'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_2_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][1][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][1]['img_action_link'] ) ? $home_v9['pcwbc1']['content'][1]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 3', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_3_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][2][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['enable_category_1'] ) ? $home_v9['pcwbc1']['content'][2]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['slugs'] ) ? $home_v9['pcwbc1']['content'][2]['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_1_args']['number'] ) ? $home_v9['pcwbc1']['content'][2]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_1_args']['child_number'] ) ? $home_v9['pcwbc1']['content'][2]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_1_args']['orderby'] ) ? $home_v9['pcwbc1']['content'][2]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_1_args']['order'] ) ? $home_v9['pcwbc1']['content'][2]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_3_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][2][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['enable_category_2'] ) ? $home_v9['pcwbc1']['content'][2]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_2_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_2_args']['slugs'] ) ? $home_v9['pcwbc1']['content'][2]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_2_args']['number'] ) ? $home_v9['pcwbc1']['content'][2]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_2_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_2_args']['orderby'] ) ? $home_v9['pcwbc1']['content'][2]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_category_2_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['category_2_args']['order'] ) ? $home_v9['pcwbc1']['content'][2]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc1_content_3_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc1][content][2][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['enable_banner'] ) ? $home_v9['pcwbc1']['content'][2]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc1_content_3_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][image]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['image'] ) ? $home_v9['pcwbc1']['content'][2]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc1_content_3_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][content][2][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc1']['content'][2]['img_action_link'] ) ? $home_v9['pcwbc1']['content'][2]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v9_pcwbc1_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v9[pcwbc1][carousel_args]',
                        'value'         => isset( $home_v9['pcwbc1']['carousel_args'] ) ? $home_v9['pcwbc1']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_categories_with_banner_carousel_1 -->

            <div id="product_categories_with_banner_carousel_2" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][section_title]',
                        'value'         => isset( $home_v9['pcwbc2']['section_title'] ) ? $home_v9['pcwbc2']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 1', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_1_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][0][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['enable_category_1'] ) ? $home_v9['pcwbc2']['content'][0]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_1_args']['slugs'] ) ? $home_v9['pcwbc2']['content'][0]['category_1_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_1_args']['number'] ) ? $home_v9['pcwbc2']['content'][0]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_1_args']['child_number'] ) ? $home_v9['pcwbc2']['content'][0]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_1_args']['orderby'] ) ? $home_v9['pcwbc2']['content'][0]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_1_args']['order'] ) ? $home_v9['pcwbc2']['content'][0]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_1_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][0][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['enable_category_2'] ) ? $home_v9['pcwbc2']['content'][0]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_2_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_2_args']['slugs'] ) ? $home_v9['pcwbc2']['content'][0]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_2_args']['number'] ) ? $home_v9['pcwbc2']['content'][0]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_2_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_2_args']['orderby'] ) ? $home_v9['pcwbc2']['content'][0]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_category_2_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['category_2_args']['order'] ) ? $home_v9['pcwbc2']['content'][0]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_1_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][0][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['enable_banner'] ) ? $home_v9['pcwbc2']['content'][0]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc2_content_1_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][image]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['image'] ) ? $home_v9['pcwbc2']['content'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_1_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][0][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][0]['img_action_link'] ) ? $home_v9['pcwbc2']['content'][0]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 2', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_2_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][1][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['enable_category_1'] ) ? $home_v9['pcwbc2']['content'][1]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_1_args']['slugs'] ) ? $home_v9['pcwbc2']['content'][1]['category_1_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_1_args']['number'] ) ? $home_v9['pcwbc2']['content'][1]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_1_args']['child_number'] ) ? $home_v9['pcwbc2']['content'][1]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_1_args']['orderby'] ) ? $home_v9['pcwbc2']['content'][1]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_1_args']['order'] ) ? $home_v9['pcwbc2']['content'][1]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_2_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][1][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['enable_category_2'] ) ? $home_v9['pcwbc2']['content'][1]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_2_args']['slugs'] ) ? $home_v9['pcwbc2']['content'][1]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_2_args']['number'] ) ? $home_v9['pcwbc2']['content'][1]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_2_args']['orderby'] ) ? $home_v9['pcwbc2']['content'][1]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['category_2_args']['order'] ) ? $home_v9['pcwbc2']['content'][1]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_2_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][1][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['enable_banner'] ) ? $home_v9['pcwbc2']['content'][1]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc2_content_2_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][image]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['image'] ) ? $home_v9['pcwbc2']['content'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_2_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][1][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][1]['img_action_link'] ) ? $home_v9['pcwbc2']['content'][1]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 3', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_3_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][2][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['enable_category_1'] ) ? $home_v9['pcwbc2']['content'][2]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['slugs'] ) ? $home_v9['pcwbc2']['content'][2]['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_1_args']['number'] ) ? $home_v9['pcwbc2']['content'][2]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_1_args']['child_number'] ) ? $home_v9['pcwbc2']['content'][2]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_1_args']['orderby'] ) ? $home_v9['pcwbc2']['content'][2]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_1_args']['order'] ) ? $home_v9['pcwbc2']['content'][2]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_3_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][2][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['enable_category_2'] ) ? $home_v9['pcwbc2']['content'][2]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_2_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_2_args']['slugs'] ) ? $home_v9['pcwbc2']['content'][2]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_2_args']['number'] ) ? $home_v9['pcwbc2']['content'][2]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_2_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_2_args']['orderby'] ) ? $home_v9['pcwbc2']['content'][2]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_category_2_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['category_2_args']['order'] ) ? $home_v9['pcwbc2']['content'][2]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc2_content_3_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc2][content][2][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['enable_banner'] ) ? $home_v9['pcwbc2']['content'][2]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc2_content_3_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][image]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['image'] ) ? $home_v9['pcwbc2']['content'][2]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc2_content_3_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][content][2][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc2']['content'][2]['img_action_link'] ) ? $home_v9['pcwbc2']['content'][2]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v9_pcwbc2_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v9[pcwbc2][carousel_args]',
                        'value'         => isset( $home_v9['pcwbc2']['carousel_args'] ) ? $home_v9['pcwbc2']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_categories_with_banner_carousel_2 -->

            <div id="products_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pc_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v9[pc][section_title]',
                        'value'         => isset( $home_v9['pc']['section_title'] ) ? $home_v9['pc']['section_title'] : esc_html__( 'Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pc_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v9[pc][button_text]',
                        'value'         => isset( $home_v9['pc']['button_text'] ) ? $home_v9['pc']['button_text'] : esc_html__( 'See All Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pc_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pc][button_link]',
                        'value'         => isset( $home_v9['pc']['button_link'] ) ? $home_v9['pc']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pc_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v9[pc][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v9['pc']['product_limit'] ) ? $home_v9['pc']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v9_pc_product_columns', 
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
                        'name'          => '_home_v9[pc][product_columns]',
                        'value'         => isset( $home_v9['pc']['product_columns'] ) ? $home_v9['pc']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v9_pc_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v9[pc][content]',
                        'value'         => isset( $home_v9['pc']['content'] ) ? $home_v9['pc']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v9_pc_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v9[pc][carousel_args]',
                        'value'         => isset( $home_v9['pc']['carousel_args'] ) ? $home_v9['pc']['carousel_args'] : '',
                        'fields'        => array( 'dots', 'autoplay' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel -->

            <div id="product_categories_with_banner_carousel_3" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][section_title]',
                        'value'         => isset( $home_v9['pcwbc3']['section_title'] ) ? $home_v9['pcwbc3']['section_title'] : esc_html__( 'Headphones & Virtual Reality', 'electro' ),
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 1', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_1_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][0][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['enable_category_1'] ) ? $home_v9['pcwbc3']['content'][0]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_1_args']['slugs'] ) ? $home_v9['pcwbc3']['content'][0]['category_1_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_1_args']['number'] ) ? $home_v9['pcwbc3']['content'][0]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_1_args']['child_number'] ) ? $home_v9['pcwbc3']['content'][0]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_1_args']['orderby'] ) ? $home_v9['pcwbc3']['content'][0]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_1_args']['order'] ) ? $home_v9['pcwbc3']['content'][0]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_1_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][0][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['enable_category_2'] ) ? $home_v9['pcwbc3']['content'][0]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_2_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_2_args']['slugs'] ) ? $home_v9['pcwbc3']['content'][0]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_2_args']['number'] ) ? $home_v9['pcwbc3']['content'][0]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_2_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_2_args']['orderby'] ) ? $home_v9['pcwbc3']['content'][0]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_category_2_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['category_2_args']['order'] ) ? $home_v9['pcwbc3']['content'][0]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_1_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][0][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['enable_banner'] ) ? $home_v9['pcwbc3']['content'][0]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc3_content_1_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][image]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['image'] ) ? $home_v9['pcwbc3']['content'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_1_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][0][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][0]['img_action_link'] ) ? $home_v9['pcwbc3']['content'][0]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 2', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_2_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][1][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['enable_category_1'] ) ? $home_v9['pcwbc3']['content'][1]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_1_args']['slugs'] ) ? $home_v9['pcwbc3']['content'][1]['category_1_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_1_args']['number'] ) ? $home_v9['pcwbc3']['content'][1]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_1_args']['child_number'] ) ? $home_v9['pcwbc3']['content'][1]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_1_args']['orderby'] ) ? $home_v9['pcwbc3']['content'][1]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_1_args']['order'] ) ? $home_v9['pcwbc3']['content'][1]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_2_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][1][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['enable_category_2'] ) ? $home_v9['pcwbc3']['content'][1]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_2_args']['slugs'] ) ? $home_v9['pcwbc3']['content'][1]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_2_args']['number'] ) ? $home_v9['pcwbc3']['content'][1]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_2_args']['orderby'] ) ? $home_v9['pcwbc3']['content'][1]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['category_2_args']['order'] ) ? $home_v9['pcwbc3']['content'][1]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_2_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][1][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['enable_banner'] ) ? $home_v9['pcwbc3']['content'][1]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc3_content_2_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][image]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['image'] ) ? $home_v9['pcwbc3']['content'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_2_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][1][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][1]['img_action_link'] ) ? $home_v9['pcwbc3']['content'][1]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Carousel Element 3', 'electro' ) ); ?>

                <?php electro_wp_legend( esc_html__( 'Categories List 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_3_enable_category_1',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][2][enable_category_1]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['enable_category_1'] ) ? $home_v9['pcwbc3']['content'][2]['enable_category_1'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_1_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_1_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['slugs'] ) ? $home_v9['pcwbc3']['content'][2]['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_1_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_1_args][number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_1_args']['number'] ) ? $home_v9['pcwbc3']['content'][2]['category_1_args']['number'] : 3,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_1_args_child_number',
                        'label'         => esc_html__( 'Child Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_1_args][child_number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_1_args']['child_number'] ) ? $home_v9['pcwbc3']['content'][2]['category_1_args']['child_number'] : 5,
                        'placeholder'   => esc_html__( 'Enter the child limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_1_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_1_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_1_args']['orderby'] ) ? $home_v9['pcwbc3']['content'][2]['category_1_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_1_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_1_args][order]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_1_args']['order'] ) ? $home_v9['pcwbc3']['content'][2]['category_1_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Categories List 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_3_enable_category_2',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][2][enable_category_2]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['enable_category_2'] ) ? $home_v9['pcwbc3']['content'][2]['enable_category_2'] : 'yes',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_2_args_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_2_args][slugs]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_2_args']['slugs'] ) ? $home_v9['pcwbc3']['content'][2]['category_2_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_2_args_number',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_2_args][number]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_2_args']['number'] ) ? $home_v9['pcwbc3']['content'][2]['category_2_args']['number'] : 7,
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_2_args_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_2_args][orderby]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_2_args']['orderby'] ) ? $home_v9['pcwbc3']['content'][2]['category_2_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_category_2_args_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][category_2_args][order]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['category_2_args']['order'] ) ? $home_v9['pcwbc3']['content'][2]['category_2_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v9_pcwbc3_content_3_enable_banner',
                        'label'         => esc_html__( 'Enable ?', 'electro' ), 
                        'name'          => '_home_v9[pcwbc3][content][2][enable_banner]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['enable_banner'] ) ? $home_v9['pcwbc3']['content'][2]['enable_banner'] : 'yes',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v9_pcwbc3_content_3_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][image]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['image'] ) ? $home_v9['pcwbc3']['content'][2]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_pcwbc3_content_3_img_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][content][2][img_action_link]',
                        'value'         => isset( $home_v9['pcwbc3']['content'][2]['img_action_link'] ) ? $home_v9['pcwbc3']['content'][2]['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v9_pcwbc3_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v9[pcwbc3][carousel_args]',
                        'value'         => isset( $home_v9['pcwbc3']['carousel_args'] ) ? $home_v9['pcwbc3']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_categories_with_banner_carousel_3 -->

            <div id="recently_viewed_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v9_rvp_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v9[rvp][section_title]',
                        'value'         => isset( $home_v9['rvp']['section_title'] ) ? $home_v9['rvp']['section_title'] : esc_html__( 'Your Recently Viewed Products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_rvp_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v9[rvp][shortcode_atts][per_page]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v9['rvp']['shortcode_atts']['per_page'] ) ? $home_v9['rvp']['shortcode_atts']['per_page'] : '20',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v9_rvp_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the columns', 'electro' ),
                        'name'          => '_home_v9[rvp][product_columns]',
                        'value'         => isset( $home_v9['rvp']['product_columns'] ) ? $home_v9['rvp']['product_columns'] : 10,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php

                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v9_rvp_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v9[rvp][carousel_args]',
                        'value'         => isset( $home_v9['rvp']['carousel_args'] ) ? $home_v9['rvp']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#recently_viewed_carousel -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v9'] ) ) {
            $clean_home_v9_options = electro_clean_kses_post( $_POST['_home_v9'] );
            update_post_meta( $post_id, '_home_v9_options',  serialize( $clean_home_v9_options ) );
        }
    }
}
