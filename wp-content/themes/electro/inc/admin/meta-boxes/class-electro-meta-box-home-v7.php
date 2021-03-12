<?php
/**
 * Home v7 Metabox
 *
 * Displays the home v7 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_v7 Class
 */
class Electro_Meta_Box_Home_v7 {

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

        if ( $template_file !== 'template-homepage-v7.php' ) {
            return;
        }

        self::output_home_v7( $post );
    }

    private static function output_home_v7( $post ) {

        $home_v7 = electro_get_home_v7_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs ec-tabs">
            <?php
                $product_data_tabs = apply_filters( 'electro_home_v7_data_tabs', array(
                    'general' => array(
                        'label'  => __( 'General', 'electro' ),
                        'target' => 'general_block',
                        'class'  => array(),
                    ),
                    'vertical_menu_slider_catergory_banners' => array(
                        'label'  => esc_html__( 'Vertical Menu, Slider, Catergory & banners', 'electro' ),
                        'target' => 'vertical_menu_slider_catergory_banners',
                        'class'  => array(),
                    ),
                    'products_carousel' => array(
                        'label'  => __( 'Products Carousel', 'electro' ),
                        'target' => 'products_carousel',
                        'class'  => array(),
                    ),
                    'banner' => array(
                        'label'  => __( 'Banner', 'electro' ),
                        'target' => 'banner_data',
                        'class'  => array(),
                    ),
                    'products_with_category_image' => array(
                        'label'  => __( 'Products with Category Image', 'electro' ),
                        'target' => 'products_with_category_image',
                        'class'  => array(),
                    ),
                    'two_banners'   => array(
                        'label'     => __( 'Two Banners', 'electro' ),
                        'target'    => 'two_banners',
                        'class'     => array(),
                    ),
                    'products_with_image_1' => array(
                        'label'  => __( 'Products with Image - 1', 'electro' ),
                        'target' => 'products_with_image_1',
                        'class'  => array(),
                    ),
                    'products_with_image_2' => array(
                        'label'  => __( 'Products with Image - 2', 'electro' ),
                        'target' => 'products_with_image_2',
                        'class'  => array(),
                    ),
                    'electro_ads_with_banners' => array(
                        'label'  => __( 'Ads with Banners', 'electro' ),
                        'target' => 'electro_ads_with_banners',
                        'class'  => array(),
                    ),
                    'electro_two_row_products' => array(
                        'label'  => __( 'Two Row Products', 'electro' ),
                        'target' => 'electro_two_row_products',
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
                        'id'        => '_home_v7_header_style',
                        'label'     => esc_html__( 'Header Style', 'electro' ),
                        'name'      => '_home_v7[header_style]',
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
                        'value'     => isset( $home_v7['header_style'] ) ? $home_v7['header_style'] : 'v7',
                    ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_v7_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'electro' ),
                            'vscwa' => esc_html__( 'Vertical Menu, Slider, Catergory & banners', 'electro' ),
                            'pcwt'  => esc_html__( 'Products Carousel', 'electro' ),
                            'bd'    => esc_html__( 'Banner', 'electro' ),
                            'pwci'  => esc_html__( 'Products with Category Image', 'electro' ),
                            'tbrs'  => esc_html__( 'Two Banners', 'electro' ),
                            'pcwi1' => esc_html__( 'Products with Image - 1', 'electro' ),
                            'pcwi2' => esc_html__( 'Products with Image - 2', 'electro' ),
                            'awb'   => esc_html__( 'Ads with Banners', 'electro' ),
                            'trp'   => esc_html__( 'Two Row Products', 'electro' ),
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
                            <?php foreach( $home_v7_blocks as $key => $home_v7_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v7_block ); ?></td>
                                <td><?php electro_wp_animation_dropdown( array(  'id' => '_home_v7_' . $key . '_animation', 'label'=> '', 'name' => '_home_v7[' . $key . '][animation]', 'value' => isset( $home_v7['' . $key . '']['animation'] ) ? $home_v7['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php electro_wp_text_input( array(  'id' => '_home_v7_' . $key . '_priority', 'label'=> '', 'name' => '_home_v7[' . $key . '][priority]', 'value' => isset( $home_v7['' . $key . '']['priority'] ) ? $home_v7['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php electro_wp_checkbox( array( 'id' => '_home_v7_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v7[' . $key . '][is_enabled]', 'value'=> isset( $home_v7['' . $key . '']['is_enabled'] ) ? $home_v7['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /#general_block -->

            <div id="vertical_menu_slider_catergory_banners" class="panel electro_options_panel">
                
                <?php electro_wp_legend( esc_html__( 'Vertical Menu', 'electro' ) ); ?>

                <div class="options_group">
                    <?php
                        electro_wp_checkbox( array(
                            'id'            => '_home_v7_nav_is_enabled',
                            'label'         => esc_html__( 'Enable Vertical Menu', 'electro' ), 
                            'name'          => '_home_v7[vscwa][nav][is_enabled]',
                            'value'         => isset( $home_v7['vscwa']['nav']['is_enabled'] ) ? $home_v7['vscwa']['nav']['is_enabled'] : '',
                        ) );

                        electro_wp_text_input( array(
                            'id'            => '_home_v7_nav_title',
                            'label'         => esc_html__( 'Title', 'electro' ),
                            'placeholder'   => esc_html__( 'Enter the title for your menu here', 'electro' ),
                            'name'          => '_home_v7[vscwa][nav][menu_title]',
                            'value'         => isset( $home_v7['vscwa']['nav']['menu_title'] ) ? $home_v7['vscwa']['nav']['menu_title'] : '',
                        ) );

                        electro_wp_text_input( array(
                            'id'            => '_home_v7_nav_menu_action_text',
                            'label'         => esc_html__( 'Vertical Menu Aside Action Text', 'electro' ),
                            'placeholder'   => esc_html__( 'Enter the Action Text text for your menu here', 'electro' ),
                            'name'          => '_home_v7[vscwa][nav][menu_action_text]',
                            'value'         => isset( $home_v7['vscwa']['nav']['menu_action_text'] ) ? $home_v7['vscwa']['nav']['menu_action_text'] : '',
                        ) );

                        electro_wp_text_input( array(
                            'id'            => '_home_v7_nav_menu_action_link',
                            'label'         => esc_html__( 'Vertical Menu Aside Action Link', 'electro' ),
                            'placeholder'   => esc_html__( 'Enter the action link for your menu here', 'electro' ),
                            'name'          => '_home_v7[vscwa][nav][menu_action_link]',
                            'value'         => isset( $home_v7['vscwa']['nav']['menu_action_link'] ) ? $home_v7['vscwa']['nav']['menu_action_link'] : '',
                        ) );

                        electro_wp_nav_menus_dropdown( array(
                            'id'            => '_home_v7_vertical_nav_menu',
                            'label'         => esc_html__( 'Menu', 'electro' ),
                            'name'          => '_home_v7[vscwa][nav][menu]',
                            'value'         => isset( $home_v7['vscwa']['nav']['menu'] ) ? $home_v7['vscwa']['nav']['menu'] : '',
                        ) );
                    ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Slider', 'electro' ) ); ?>

                <div class="options_group">
                    <?php 
                        electro_wp_text_input( array( 
                            'id'            => '_home_v7_vscwa_slider_shortcode', 
                            'label'         => esc_html__( 'Slider Shortcode', 'electro' ), 
                            'placeholder'   => esc_html__( 'Enter the shorcode for your slider here', 'electro' ),
                            'name'          => '_home_v7[vscwa][slider_shortcode]',
                            'value'         => isset( $home_v7['vscwa']['slider_shortcode'] ) ? $home_v7['vscwa']['slider_shortcode'] : '',
                        ) );
                    ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Category Block', 'electro' ) ); ?>

                <div class="options_group">
                    <?php

                        electro_wp_checkbox( array(
                            'id'            => '_home_v7_vscwa_cat_is_enabled',
                            'label'         => esc_html__( 'Enable Category Block', 'electro' ), 
                            'name'          => '_home_v7[vscwa][cat][is_enabled]',
                            'value'         => isset( $home_v7['vscwa']['cat']['is_enabled'] ) ? $home_v7['vscwa']['cat']['is_enabled'] : '',
                        ) );

                        electro_wp_text_input( array(
                            'id'            => '_home_v7_vscwa_cat_slugs',
                            'label'         => esc_html__( 'Category Slug', 'electro' ),
                            'name'          => '_home_v7[vscwa][cat][slug]',
                            'value'         => isset( $home_v7['vscwa']['cat']['slug'] ) ? $home_v7['vscwa']['cat']['slug'] : '',
                            'placeholder'   => esc_html__( 'Enter category slug separated by comma', 'electro' ),
                        ) );

                        electro_wp_text_input( array(
                            'id'            => '_home_v7_vscwa_cat_number',
                            'label'         => esc_html__( 'Limit', 'electro' ),
                            'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                            'name'          => '_home_v7[vscwa][cat][number]',
                            'value'         => isset( $home_v7['vscwa']['cat']['number'] ) ? $home_v7['vscwa']['cat']['number'] : '5',
                        ) );

                        electro_wp_select( array( 
                            'id'            => '_home_v7_vscwa_cat_columns', 
                            'label'         =>  esc_html__( 'Columns', 'electro' ),
                            'name'          => '_home_v7[vscwa][cat][columns]',
                            'options'       => array(
                                '1'          => esc_html__( '1', 'electro' ),
                                '2'          => esc_html__( '2', 'electro' ),
                                '3'          => esc_html__( '3', 'electro' ),
                                '4'          => esc_html__( '4', 'electro' ),
                                '5'          => esc_html__( '5', 'electro' ),
                                '6'          => esc_html__( '6', 'electro' ),
                                
                            ),
                            'value'         => isset( $home_v7['vscwa']['cat']['columns'] ) ? $home_v7['vscwa']['cat']['columns'] : '',
                        ) );

                        electro_wp_checkbox( array(
                            'id'            => '_home_v7_vscwa_cat_hide_empty',
                            'label'         => esc_html__( 'Hide Empty', 'electro' ),
                            'name'          => '_home_v7[vscwa][cat][hide_empty]',
                            'value'         => isset( $home_v7['vscwa']['cat']['hide_empty'] ) ? $home_v7['vscwa']['cat']['hide_empty'] : '',
                        ) );
                        
                    ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banners Block', 'electro' ) ); ?>

                <div class="options_group">
                    <?php
                        electro_wp_checkbox( array(
                            'id'            => '_home_v7_vscwa_ads_is_enabled',
                            'label'         => esc_html__( 'Enable Ads Block', 'electro' ), 
                            'name'          => '_home_v7[vscwa][ads][is_enabled]',
                            'value'         => isset( $home_v7['vscwa']['ads']['is_enabled'] ) ? $home_v7['vscwa']['ads']['is_enabled'] : '',
                        ) );
                    ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_1_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][0][ad_text]',
                        'value'         => isset( $home_v7['vscwa']['ads'][0]['ad_text'] ) ? $home_v7['vscwa']['ads'][0]['ad_text'] : wp_kses_post( __( 'Catch Big <strong>Deals</strong> on<br>The Consoles', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_1_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][0][action_text]',
                        'value'         => isset( $home_v7['vscwa']['ads'][0]['action_text'] ) ? $home_v7['vscwa']['ads'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_1_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][0][action_link]',
                        'value'         => isset( $home_v7['vscwa']['ads'][0]['action_link'] ) ? $home_v7['vscwa']['ads'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_ads_ad_1_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v7[vscwa][ads][0][ad_image]',
                        'value'         => isset( $home_v7['vscwa']['ads'][0]['ad_image'] ) ? $home_v7['vscwa']['ads'][0]['ad_image'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_2_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][1][ad_text]',
                        'value'         => isset( $home_v7['vscwa']['ads'][1]['ad_text'] ) ? $home_v7['vscwa']['ads'][1]['ad_text'] : wp_kses_post( __( 'Shop the <strong>Hottest</strong><br>Products', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_2_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][1][action_text]',
                        'value'         => isset( $home_v7['vscwa']['ads'][1]['action_text'] ) ? $home_v7['vscwa']['ads'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_2_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][1][action_link]',
                        'value'         => isset( $home_v7['vscwa']['ads'][1]['action_link'] ) ? $home_v7['vscwa']['ads'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_ads_ad_2_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v7[vscwa][ads][1][ad_image]',
                        'value'         => isset( $home_v7['vscwa']['ads'][1]['ad_image'] ) ? $home_v7['vscwa']['ads'][1]['ad_image'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 3', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_3_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][2][ad_text]',
                        'value'         => isset( $home_v7['vscwa']['ads'][2]['ad_text'] ) ? $home_v7['vscwa']['ads'][2]['ad_text'] : wp_kses_post( __( 'Laptops Notebooks<br> <strong>and More</strong>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_3_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][2][action_text]',
                        'value'         => isset( $home_v7['vscwa']['ads'][2]['action_text'] ) ? $home_v7['vscwa']['ads'][2]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_ads_ad_3_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v7[vscwa][ads][2][action_link]',
                        'value'         => isset( $home_v7['vscwa']['ads'][2]['action_link'] ) ? $home_v7['vscwa']['ads'][2]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_ads_ad_3_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v7[vscwa][ads][2][ad_image]',
                        'value'         => isset( $home_v7['vscwa']['ads'][2]['ad_image'] ) ? $home_v7['vscwa']['ads'][2]['ad_image'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#vertical_menu_slider_catergory_banners -->

            <div id="products_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwt_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v7[pcwt][section_title]',
                        'value'         => isset( $home_v7['pcwt']['section_title'] ) ? $home_v7['pcwt']['section_title'] : esc_html__( 'Deals of The Day', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwt_timer_title',
                        'label'         => esc_html__( 'Timer Title', 'electro' ),
                        'name'          => '_home_v7[pcwt][timer_title]',
                        'value'         => isset( $home_v7['pcwt']['timer_title'] ) ? $home_v7['pcwt']['timer_title'] : '',
                    ) );

                     electro_wp_checkbox( array(
                        'id'            => '_home_v7_pcwt_header_timer',
                        'label'         => esc_html__( 'Header Timer?', 'electro' ),
                        'name'          => '_home_v7[pcwt][header_timer]',
                        'value'         => isset( $home_v7['pcwt']['header_timer'] ) ? $home_v7['pcwt']['header_timer'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwt_timer_value',
                        'label'         => esc_html__( 'Timer Value', 'electro' ),
                        'name'          => '_home_v7[pcwt][timer_value]',
                        'value'         => isset( $home_v7['pcwt']['timer_value'] ) ? $home_v7['pcwt']['timer_value'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwt_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v7[pcwt][button_text]',
                        'value'         => isset( $home_v7['pcwt']['button_text'] ) ? $home_v7['pcwt']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwt_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v7[pcwt][button_link]',
                        'value'         => isset( $home_v7['pcwt']['button_link'] ) ? $home_v7['pcwt']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwt_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v7[pcwt][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v7['pcwt']['product_limit'] ) ? $home_v7['pcwt']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v7_pcwt_product_columns', 
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
                        'name'          => '_home_v7[pcwt][product_columns]',
                        'value'         => isset( $home_v7['pcwt']['product_columns'] ) ? $home_v7['pcwt']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v7_pcwt_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v7[pcwt][content]',
                        'value'         => isset( $home_v7['pcwt']['content'] ) ? $home_v7['pcwt']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v7_pcwt_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v7[pcwt][carousel_args]',
                        'value'         => isset( $home_v7['pcwt']['carousel_args'] ) ? $home_v7['pcwt']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel -->

            <div id="banner_data" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_bd_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v7[bd][image]',
                        'value'         => isset( $home_v7['bd']['image'] ) ? $home_v7['bd']['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_bd_link',
                        'label'         => esc_html__( 'Link', 'electro' ),
                        'name'          => '_home_v7[bd][link]',
                        'value'         => isset( $home_v7['bd']['link'] ) ? $home_v7['bd']['link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#banner_data -->

            <div id="products_with_category_image" class="panel electro_options_panel">
                
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pwci_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v7[pwci][section_title]',
                        'value'         => isset( $home_v7['pwci']['section_title'] ) ? $home_v7['pwci']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                    ) );
                ?>
                </div>

                <div class="options_group">

                <?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

                <?php
                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_pwci_enable_categories',
                        'label'         => esc_html__( 'Enable Categories', 'electro' ), 
                        'name'          => '_home_v7[pwci][enable_categories]',
                        'value'         => isset( $home_v7['pwci']['enable_categories'] ) ? $home_v7['pwci']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pwci_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_v7[pwci][categories_title]',
                        'value'         => isset( $home_v7['pwci']['categories_title'] ) ? $home_v7['pwci']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pwci_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v7[pwci][category_args][number]',
                        'default'       => 4,
                        'value'         => isset( $home_v7['pwci']['category_args']['number'] ) ? $home_v7['pwci']['category_args']['number'] : 4,
                        'placeholder'   => 4
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pwci_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v7[pwci][category_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v7['pwci']['category_args']['slugs'] ) ? $home_v7['pwci']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_pwci_hide_empty_categories',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ), 
                        'name'          => '_home_v7[pwci][category_args][hide_empty]',
                        'value'         => isset( $home_v7['pwci']['category_args']['hide_empty'] ) ? $home_v7['pwci']['category_args']['hide_empty'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">

                <?php electro_wp_legend( esc_html__( 'Categories Menu List', 'electro' ) ); ?>

                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pwci_category_menu_limit',
                        'label'         => esc_html__( 'Categories Menu Limit', 'electro' ),
                        'name'          => '_home_v7[pwci][vcategory_args][number]',
                        'default'       => 10,
                        'value'         => isset( $home_v7['pwci']['vcategory_args']['number'] ) ? $home_v7['pwci']['vcategory_args']['number'] : 10,
                        'placeholder'   => 10
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pwci_category_menu_slugs',
                        'label'         => esc_html__( 'Category Menu Slug', 'electro' ),
                        'name'          => '_home_v7[pwci][vcategory_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v7['pwci']['vcategory_args']['slugs'] ) ? $home_v7['pwci']['vcategory_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_pwci_hide_empty_categories_menu',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ), 
                        'name'          => '_home_v7[pwci][vcategory_args][hide_empty]',
                        'value'         => isset( $home_v7['pwci']['vcategory_args']['hide_empty'] ) ? $home_v7['pwci']['vcategory_args']['hide_empty'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_pwci_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v7[pwci][image]',
                        'value'         => isset( $home_v7['pwci']['image'] ) ? $home_v7['pwci']['image'] : '',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_pwci_img_action_link',
                        'label'         => esc_html__( 'Image Action Link', 'electro' ),
                        'name'          => '_home_v7[pwci][img_action_link]',
                        'value'         => isset( $home_v7['pwci']['img_action_link'] ) ? $home_v7['pwci']['img_action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php if ( electro_is_wide_enabled() ) : ?>
                <div class="options_group">
                    <h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
                <?php
                    
                    electro_wp_select( array( 
                        'id'            => '_home_v7_pwci_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '4',
                        'name'          => '_home_v7[pwci][product_columns_wide]',
                        'value'         => isset( $home_v7['pwci']['product_columns_wide'] ) ? $home_v7['pwci']['product_columns_wide'] : 4,
                    ) );
                ?>
                </div>
                <?php endif; ?>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v7_pwci_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_v7[pwci][content]',
                        'value'         => isset( $home_v7['pwci']['content'] ) ? $home_v7['pwci']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );
                ?>
                </div>

            </div><!-- /#products_with_category_image -->

            <div id="two_banners" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Banner 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_tbrs_1_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v7[tbrs][0][image]',
                        'value'         => isset( $home_v7['tbrs'][0]['image'] ) ? $home_v7['tbrs'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_tbrs_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v7[tbrs][0][action_link]',
                        'value'         => isset( $home_v7['tbrs'][0]['action_link'] ) ? $home_v7['tbrs'][0]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_tbrs_2_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v7[tbrs][1][image]',
                        'value'         => isset( $home_v7['tbrs'][1]['image'] ) ? $home_v7['tbrs'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_tbrs_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v7[tbrs][1][action_link]',
                        'value'         => isset( $home_v7['tbrs'][1]['action_link'] ) ? $home_v7['tbrs'][1]['action_link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#two_banners -->

            <div id="products_with_image_1" class="panel electro_options_panel">
                
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi1_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v7[pcwi1][section_title]',
                        'value'         => isset( $home_v7['pcwi1']['section_title'] ) ? $home_v7['pcwi1']['section_title'] : esc_html__( 'Headphones', 'electro' ),
                    ) );
                ?>
                </div>

                <div class="options_group">

                <?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

                <?php
                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_pcwi1_enable_categories',
                        'label'         => esc_html__( 'Enable Categories', 'electro' ), 
                        'name'          => '_home_v7[pcwi1][enable_categories]',
                        'value'         => isset( $home_v7['pcwi1']['enable_categories'] ) ? $home_v7['pcwi1']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi1_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_v7[pcwi1][categories_title]',
                        'value'         => isset( $home_v7['pcwi1']['categories_title'] ) ? $home_v7['pcwi1']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi1_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v7[pcwi1][category_args][number]',
                        'default'       => 4,
                        'value'         => isset( $home_v7['pcwi1']['category_args']['number'] ) ? $home_v7['pcwi1']['category_args']['number'] : 4,
                        'placeholder'   => 4
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi1_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v7[pcwi1][category_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v7['pcwi1']['category_args']['slugs'] ) ? $home_v7['pcwi1']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_pcwi1_hide_empty_categories',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ), 
                        'name'          => '_home_v7[pcwi1][category_args][hide_empty]',
                        'value'         => isset( $home_v7['pcwi1']['category_args']['hide_empty'] ) ? $home_v7['pcwi1']['category_args']['hide_empty'] : '',
                    ) );

                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_pcwi1_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v7[pcwi1][image]',
                        'value'         => isset( $home_v7['pcwi1']['image'] ) ? $home_v7['pcwi1']['image'] : '',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_pcwi1_img_action_link',
                        'label'         => esc_html__( 'Image Action Link', 'electro' ),
                        'name'          => '_home_v7[pcwi1][img_action_link]',
                        'value'         => isset( $home_v7['pcwi1']['img_action_link'] ) ? $home_v7['pcwi1']['img_action_link'] : '#',
                    ) );

                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v7_pcwi1_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v7[pcwi1][content]',
                        'value'         => isset( $home_v7['pcwi1']['content'] ) ? $home_v7['pcwi1']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );
                ?>
                </div>

                <?php if ( electro_is_wide_enabled() ) : ?>
                <div class="options_group">
                    <h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
                <?php
                    
                    electro_wp_select( array( 
                        'id'            => '_home_v7_pcwi1_columns_wide', 
                        'label'         =>  esc_html__( 'Columns Wide', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '4',
                        'name'          => '_home_v7[pcwi1][product_columns_wide]',
                        'value'         => isset( $home_v7['pcwi1']['product_columns_wide'] ) ? $home_v7['pcwi1']['product_columns_wide'] : 6,
                    ) );
                ?>
                </div>
                <?php endif; ?>
            </div><!-- /#products_with_image_1 -->

            <div id="products_with_image_2" class="panel electro_options_panel">
                
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v7[pcwi2][section_title]',
                        'value'         => isset( $home_v7['pcwi2']['section_title'] ) ? $home_v7['pcwi2']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                    ) );
                ?>
                </div>

                <div class="options_group">

                <?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

                <?php
                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_pcwi2_enable_categories',
                        'label'         => esc_html__( 'Enable Categories', 'electro' ), 
                        'name'          => '_home_v7[pcwi2][enable_categories]',
                        'value'         => isset( $home_v7['pcwi2']['enable_categories'] ) ? $home_v7['pcwi2']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi2_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_v7[pcwi2][categories_title]',
                        'value'         => isset( $home_v7['pcwi2']['categories_title'] ) ? $home_v7['pcwi2']['categories_title'] : esc_html__( 'Featured Phones', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi2_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v7[pcwi2][category_args][number]',
                        'default'       => 5,
                        'value'         => isset( $home_v7['pcwi2']['category_args']['number'] ) ? $home_v7['pcwi2']['category_args']['number'] : 5,
                        'placeholder'   => 5
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_pcwi2_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v7[pcwi2][category_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v7['pcwi2']['category_args']['slugs'] ) ? $home_v7['pcwi2']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_pcwi2_hide_empty_categories',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ), 
                        'name'          => '_home_v7[pcwi2][category_args][hide_empty]',
                        'value'         => isset( $home_v7['pcwi2']['category_args']['hide_empty'] ) ? $home_v7['pcwi2']['category_args']['hide_empty'] : '',
                    ) );

                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_pcwi2_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v7[pcwi2][image]',
                        'value'         => isset( $home_v7['pcwi2']['image'] ) ? $home_v7['pcwi2']['image'] : '',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v7_pcwi2_img_action_link',
                        'label'         => esc_html__( 'Image Action Link', 'electro' ),
                        'name'          => '_home_v7[pcwi2][img_action_link]',
                        'value'         => isset( $home_v7['pcwi2']['img_action_link'] ) ? $home_v7['pcwi2']['img_action_link'] : '#',
                    ) );

                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v7_pcwi2_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v7[pcwi2][content]',
                        'value'         => isset( $home_v7['pcwi2']['content'] ) ? $home_v7['pcwi2']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );
                ?>
                </div>

                <?php if ( electro_is_wide_enabled() ) : ?>
                <div class="options_group">
                    <h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
                <?php
                    electro_wp_select( array( 
                        'id'            => '_home_v7_pcwi2_columns_wide', 
                        'label'         =>  esc_html__( 'Columns Wide', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '4',
                        'name'          => '_home_v7[pcwi2][product_columns_wide]',
                        'value'         => isset( $home_v7['pcwi2']['product_columns_wide'] ) ? $home_v7['pcwi2']['product_columns_wide'] : 6,
                    ) );
                ?>
                </div>
                <?php endif; ?>
            </div><!-- /#products_with_image_2 -->

            <div id="electro_ads_with_banners" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v7_awb_title',
                        'label'         => esc_html__( 'Title', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][title]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['title'] ) ? $home_v7['awb']['ads_banners'][0]['title'] : wp_kses_post( __( 'G9 Laptops with<br>Ultra 4K HD Display', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_awb_description',
                        'label'         => esc_html__( 'Description', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][description]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['description'] ) ? $home_v7['awb']['ads_banners'][0]['description'] : wp_kses_post( __( 'and the fastest Intel Core i7 processor ever', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_awb_price',
                        'label'         => esc_html__( 'Price', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][price]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['price'] ) ? $home_v7['awb']['ads_banners'][0]['price'] : wp_kses_post( __( '<span class="prefix">from</span><span class="value"><sup>$</sup>399</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_awb_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][action_link]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['action_link'] ) ? $home_v7['awb']['ads_banners'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_awb_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][image]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['image'] ) ? $home_v7['awb']['ads_banners'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_awb_banner_action_link',
                        'label'         => esc_html__( 'Banner Action Link', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][banner_action_link]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['banner_action_link'] ) ? $home_v7['awb']['ads_banners'][0]['banner_action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v7_awb_banner_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][banner_image]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['banner_image'] ) ? $home_v7['awb']['ads_banners'][0]['banner_image'] : '',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v7_awb_is_align_end',
                        'label'         => esc_html__( 'Is Banner Alignment End?', 'electro' ),
                        'name'          => '_home_v7[awb][ads_banners][0][is_align_end]',
                        'value'         => isset( $home_v7['awb']['ads_banners'][0]['is_align_end'] ) ? $home_v7['awb']['ads_banners'][0]['is_align_end'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#electro_ads_with_banners -->

            <div id="electro_two_row_products" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v7_trp_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v7[trp][section_title]',
                        'value'         => isset( $home_v7['trp']['section_title'] ) ? $home_v7['trp']['section_title'] : esc_html__( 'Recommendation For You', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_trp_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v7[trp][button_text]',
                        'value'         => isset( $home_v7['trp']['button_text'] ) ? $home_v7['trp']['button_text'] : esc_html__( 'View All Recommendations', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v7_trp_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v7[trp][button_link]',
                        'value'         => isset( $home_v7['trp']['button_link'] ) ? $home_v7['trp']['button_link'] : '#',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v7_trp_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v7[trp][content]',
                        'value'         => isset( $home_v7['trp']['content'] ) ? $home_v7['trp']['content'] : '',
                        'fields'        => array( 'order', 'orderby', 'per_page', 'columns' )
                    ) );
                ?>
                </div>
                <?php if ( electro_is_wide_enabled() ) : ?>
                <div class="options_group">
                    <h5 class="options-group__title"><?php echo esc_html__( 'Wide Layout', 'electro' ); ?></h5>
                <?php
                    electro_wp_select( array( 
                        'id'            => '_home_v7_trp_columns_wide', 
                        'label'         =>  esc_html__( 'Columns Wide', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '6',
                        'name'          => '_home_v7[trp][product_columns_wide]',
                        'value'         => isset( $home_v7['trp']['product_columns_wide'] ) ? $home_v7['trp']['product_columns_wide'] : 6,
                    ) );
                ?>
                </div>
                <?php endif; ?>
            </div><!-- /#electro_two_row_products -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v7'] ) ) {
            $clean_home_v7_options = electro_clean_kses_post( $_POST['_home_v7'] );
            update_post_meta( $post_id, '_home_v7_options',  serialize( $clean_home_v7_options ) );
        }
    }
}
