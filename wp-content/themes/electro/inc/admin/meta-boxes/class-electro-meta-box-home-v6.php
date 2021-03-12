<?php
/**
 * Home v6 Metabox
 *
 * Displays the home v6 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_v6 Class
 */
class Electro_Meta_Box_Home_v6 {

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

        if ( $template_file !== 'template-homepage-v6.php' ) {
            return;
        }

        self::output_home_v6( $post );
    }

    private static function output_home_v6( $post ) {

        $home_v6 = electro_get_home_v6_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs ec-tabs">
            <?php
                $product_data_tabs = apply_filters( 'electro_home_v6_data_tabs', array(
                    'general' => array(
                        'label'  => __( 'General', 'electro' ),
                        'target' => 'general_block',
                        'class'  => array(),
                    ),
                    'products_carousel_banner_vertical_tabs'   => array(
                        'label'     => __( 'Products Carousel Banner Vertical Tabs', 'electro' ),
                        'target'    => 'products_carousel_banner_vertical_tabs',
                        'class'     => array(),
                    ),
                    'two_banners'   => array(
                        'label'     => __( 'Two Banners', 'electro' ),
                        'target'    => 'two_banners',
                        'class'     => array(),
                    ),
                    'category_icon_carousel'   => array(
                        'label'     => __( 'Category Icon Carousel', 'electro' ),
                        'target'    => 'category_icon_carousel',
                        'class'     => array(),
                    ),
                    'product_tabs_carousel_with_deal'   => array(
                        'label'     => __( 'Product Tabs Carousel With Deal', 'electro' ),
                        'target'    => 'product_tabs_carousel_with_deal',
                        'class'     => array(),
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
                    'products_carousel_with_image_1' => array(
                        'label'  => __( 'Products Carousel with Image - 1', 'electro' ),
                        'target' => 'products_carousel_with_image_1',
                        'class'  => array(),
                    ),
                    'products_carousel_with_image_2' => array(
                        'label'  => __( 'Products Carousel with Image - 2', 'electro' ),
                        'target' => 'products_carousel_with_image_2',
                        'class'  => array(),
                    ),
                    'ads_block' => array(
                        'label'  => __( 'Ads Block', 'electro' ),
                        'target' => 'ads_block',
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
                        'id'        => '_home_v6_header_style',
                        'label'     => esc_html__( 'Header Style', 'electro' ),
                        'name'      => '_home_v6[header_style]',
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
                        'value'     => isset( $home_v6['header_style'] ) ? $home_v6['header_style'] : 'v6',
                    ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_v6_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'electro' ),
                            'pcbvt' => esc_html__( 'Products Carousel Banner Vertical Tabs', 'electro' ),
                            'tbrs'  => esc_html__( 'Two Banners', 'electro' ),
                            'cic'   => esc_html__( 'Category Icon Carousel', 'electro' ),
                            'ptcwd' => esc_html__( 'Product Tabs Carousel With Deal', 'electro' ),
                            'pc'    => esc_html__( 'Products Carousel', 'electro' ),
                            'bd'    => esc_html__( 'Banner', 'electro' ),
                            'pcwi1' => esc_html__( 'Products Carousel with Image - 1', 'electro' ),
                            'pcwi2' => esc_html__( 'Products Carousel with Image - 2', 'electro' ),
                            'ad'    => esc_html__( 'Ads Block', 'electro' ),
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
                            <?php foreach( $home_v6_blocks as $key => $home_v6_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v6_block ); ?></td>
                                <td><?php electro_wp_animation_dropdown( array(  'id' => '_home_v6_' . $key . '_animation', 'label'=> '', 'name' => '_home_v6[' . $key . '][animation]', 'value' => isset( $home_v6['' . $key . '']['animation'] ) ? $home_v6['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php electro_wp_text_input( array(  'id' => '_home_v6_' . $key . '_priority', 'label'=> '', 'name' => '_home_v6[' . $key . '][priority]', 'value' => isset( $home_v6['' . $key . '']['priority'] ) ? $home_v6['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php electro_wp_checkbox( array( 'id' => '_home_v6_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v6[' . $key . '][is_enabled]', 'value'=> isset( $home_v6['' . $key . '']['is_enabled'] ) ? $home_v6['' . $key . '']['is_enabled'] : '', ) ); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /#general_block -->

            <div id="products_carousel_banner_vertical_tabs" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcbvt_bg_img',
                        'label'         => esc_html__( 'Background Image', 'electro' ),
                        'name'          => '_home_v6[pcbvt][bg_img]',
                        'value'         => isset( $home_v6['pcbvt']['bg_img'] ) ? $home_v6['pcbvt']['bg_img'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_1_title',
                        'label'         => esc_html__( 'Tab #1 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Gaming Monitors', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][0][title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][0]['title'] ) ? $home_v6['pcbvt']['tabs'][0]['title'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_1_tab_title',
                        'label'         => esc_html__( 'Tab #1 Tab Title', 'electro' ),
                        'placeholder'   => esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][0][tab_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][0]['tab_title'] ) ? $home_v6['pcbvt']['tabs'][0]['tab_title'] : esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_1_tab_sub_title',
                        'label'         => esc_html__( 'Tab #1 Tab Sub Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][0][tab_sub_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][0]['tab_sub_title'] ) ? $home_v6['pcbvt']['tabs'][0]['tab_sub_title'] : esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_1_action_text',
                        'label'         => esc_html__( 'Tab #1 Action Text', 'electro' ),
                        'placeholder'   => esc_html__( 'Start Buying', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][0][action_text]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][0]['action_text'] ) ? $home_v6['pcbvt']['tabs'][0]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_1_action_link',
                        'label'         => esc_html__( 'Tab #1 Action Link', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][0][action_link]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][0]['action_link'] ) ? $home_v6['pcbvt']['tabs'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcbvt_tabs_1_image',
                        'label'         => esc_html__( 'Tab #1 Banner Image', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][0][image]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][0]['image'] ) ? $home_v6['pcbvt']['tabs'][0]['image'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_2_title',
                        'label'         => esc_html__( 'Tab #2 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Gaming Monitors', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][1][title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][1]['title'] ) ? $home_v6['pcbvt']['tabs'][1]['title'] : esc_html__( 'Gaming Monitors', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_2_tab_title',
                        'label'         => esc_html__( 'Tab #2 Tab Title', 'electro' ),
                        'placeholder'   => esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][1][tab_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][1]['tab_title'] ) ? $home_v6['pcbvt']['tabs'][1]['tab_title'] : esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_2_tab_sub_title',
                        'label'         => esc_html__( 'Tab #2 Tab Sub Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][1][tab_sub_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][1]['tab_sub_title'] ) ? $home_v6['pcbvt']['tabs'][1]['tab_sub_title'] : esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_2_action_text',
                        'label'         => esc_html__( 'Tab #2 Action Text', 'electro' ),
                        'placeholder'   => esc_html__( 'Start Buying', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][1][action_text]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][1]['action_text'] ) ? $home_v6['pcbvt']['tabs'][1]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_2_action_link',
                        'label'         => esc_html__( 'Tab #2 Action Link', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][1][action_link]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][1]['action_link'] ) ? $home_v6['pcbvt']['tabs'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcbvt_tabs_2_image',
                        'label'         => esc_html__( 'Tab #2 Banner Image', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][1][image]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][1]['image'] ) ? $home_v6['pcbvt']['tabs'][1]['image'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_3_title',
                        'label'         => esc_html__( 'Tab #3 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Gaming Monitors', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][2][title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][2]['title'] ) ? $home_v6['pcbvt']['tabs'][2]['title'] : esc_html__( 'Gaming Monitors', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_3_tab_title',
                        'label'         => esc_html__( 'Tab #3 Tab Title', 'electro' ),
                        'placeholder'   => esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][2][tab_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][2]['tab_title'] ) ? $home_v6['pcbvt']['tabs'][2]['tab_title'] : esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_3_tab_sub_title',
                        'label'         => esc_html__( 'Tab #3 Tab Sub Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][2][tab_sub_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][2]['tab_sub_title'] ) ? $home_v6['pcbvt']['tabs'][2]['tab_sub_title'] : esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_3_action_text',
                        'label'         => esc_html__( 'Tab #3 Action Text', 'electro' ),
                        'placeholder'   => esc_html__( 'Start Buying', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][2][action_text]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][2]['action_text'] ) ? $home_v6['pcbvt']['tabs'][2]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_3_action_link',
                        'label'         => esc_html__( 'Tab #3 Action Link', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][2][action_link]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][2]['action_link'] ) ? $home_v6['pcbvt']['tabs'][2]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcbvt_tabs_3_image',
                        'label'         => esc_html__( 'Tab #3 Banner Image', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][2][image]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][2]['image'] ) ? $home_v6['pcbvt']['tabs'][2]['image'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_4_title',
                        'label'         => esc_html__( 'Tab #4 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Gaming Monitors', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][3][title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][3]['title'] ) ? $home_v6['pcbvt']['tabs'][3]['title'] : esc_html__( 'Gaming Monitors', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_4_tab_title',
                        'label'         => esc_html__( 'Tab #4 Tab Title', 'electro' ),
                        'placeholder'   => esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][3][tab_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][3]['tab_title'] ) ? $home_v6['pcbvt']['tabs'][3]['tab_title'] : esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_4_tab_sub_title',
                        'label'         => esc_html__( 'Tab #4 Tab Sub Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][3][tab_sub_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][3]['tab_sub_title'] ) ? $home_v6['pcbvt']['tabs'][3]['tab_sub_title'] : esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_4_action_text',
                        'label'         => esc_html__( 'Tab #4 Action Text', 'electro' ),
                        'placeholder'   => esc_html__( 'Start Buying', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][3][action_text]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][3]['action_text'] ) ? $home_v6['pcbvt']['tabs'][3]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_4_action_link',
                        'label'         => esc_html__( 'Tab #4 Action Link', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][3][action_link]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][3]['action_link'] ) ? $home_v6['pcbvt']['tabs'][3]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcbvt_tabs_4_image',
                        'label'         => esc_html__( 'Tab #4 Banner Image', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][3][image]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][3]['image'] ) ? $home_v6['pcbvt']['tabs'][3]['image'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_5_title',
                        'label'         => esc_html__( 'Tab #5 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Gaming Monitors', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][4][title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][4]['title'] ) ? $home_v6['pcbvt']['tabs'][4]['title'] : esc_html__( 'Gaming Monitors', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_5_tab_title',
                        'label'         => esc_html__( 'Tab #5 Tab Title', 'electro' ),
                        'placeholder'   => esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][4][tab_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][4]['tab_title'] ) ? $home_v6['pcbvt']['tabs'][4]['tab_title'] : esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_5_tab_sub_title',
                        'label'         => esc_html__( 'Tab #5 Tab Sub Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][4][tab_sub_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][4]['tab_sub_title'] ) ? $home_v6['pcbvt']['tabs'][4]['tab_sub_title'] : esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_5_action_text',
                        'label'         => esc_html__( 'Tab #5 Action Text', 'electro' ),
                        'placeholder'   => esc_html__( 'Start Buying', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][4][action_text]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][4]['action_text'] ) ? $home_v6['pcbvt']['tabs'][4]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_5_action_link',
                        'label'         => esc_html__( 'Tab #5 Action Link', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][4][action_link]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][4]['action_link'] ) ? $home_v6['pcbvt']['tabs'][4]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcbvt_tabs_5_image',
                        'label'         => esc_html__( 'Tab #5 Banner Image', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][4][image]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][4]['image'] ) ? $home_v6['pcbvt']['tabs'][4]['image'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_6_title',
                        'label'         => esc_html__( 'Tab #6 Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Gaming Monitors', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][5][title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][5]['title'] ) ? $home_v6['pcbvt']['tabs'][5]['title'] : esc_html__( 'Gaming Monitors', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_6_tab_title',
                        'label'         => esc_html__( 'Tab #6 Tab Title', 'electro' ),
                        'placeholder'   => esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][5][tab_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][5]['tab_title'] ) ? $home_v6['pcbvt']['tabs'][5]['tab_title'] : esc_html__( 'End Season <span> Smartphones</span>', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_6_tab_sub_title',
                        'label'         => esc_html__( 'Tab #6 Tab Sub Title', 'electro' ),
                        'placeholder'   => esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][5][tab_sub_title]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][5]['tab_sub_title'] ) ? $home_v6['pcbvt']['tabs'][5]['tab_sub_title'] : esc_html__( 'Last call for up to <span class="price"><span class="symbol">$</span>250<span> off!', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_6_action_text',
                        'label'         => esc_html__( 'Tab #6 Action Text', 'electro' ),
                        'placeholder'   => esc_html__( 'Start Buying', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][5][action_text]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][5]['action_text'] ) ? $home_v6['pcbvt']['tabs'][5]['action_text'] : esc_html__( 'Start Buying', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_tabs_6_action_link',
                        'label'         => esc_html__( 'Tab #6 Action Link', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][5][action_link]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][5]['action_link'] ) ? $home_v6['pcbvt']['tabs'][5]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcbvt_tabs_6_image',
                        'label'         => esc_html__( 'Tab #6 Banner Image', 'electro' ),
                        'name'          => '_home_v6[pcbvt][tabs][5][image]',
                        'value'         => isset( $home_v6['pcbvt']['tabs'][5]['image'] ) ? $home_v6['pcbvt']['tabs'][5]['image'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcbvt_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v6[pcbvt][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v6['pcbvt']['product_limit'] ) ? $home_v6['pcbvt']['product_limit'] : 20,
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v6_pcbvt_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v6[pcbvt][content]',
                        'value'         => isset( $home_v6['pcbvt']['content'] ) ? $home_v6['pcbvt']['content'] : ''
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v6_pcbvt_product_columns', 
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
                        'name'          => '_home_v6[pcbvt][product_columns]',
                        'value'         => isset( $home_v6['pcbvt']['product_columns'] ) ? $home_v6['pcbvt']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v6_pcbvt_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v6[pcbvt][carousel_args]',
                        'value'         => isset( $home_v6['pcbvt']['carousel_args'] ) ? $home_v6['pcbvt']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_banner_vertical_tabs -->

            <div id="two_banners" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Banner 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_tbrs_1_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v6[tbrs][0][image]',
                        'value'         => isset( $home_v6['tbrs'][0]['image'] ) ? $home_v6['tbrs'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_tbrs_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v6[tbrs][0][action_link]',
                        'value'         => isset( $home_v6['tbrs'][0]['action_link'] ) ? $home_v6['tbrs'][0]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_tbrs_2_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v6[tbrs][1][image]',
                        'value'         => isset( $home_v6['tbrs'][1]['image'] ) ? $home_v6['tbrs'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_tbrs_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v6[tbrs][1][action_link]',
                        'value'         => isset( $home_v6['tbrs'][1]['action_link'] ) ? $home_v6['tbrs'][1]['action_link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#two_banners -->

            <div id="category_icon_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_cic_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v6[cic][cat_slugs]',
                        'value'         => isset( $home_v6['cic']['cat_slugs'] ) ? $home_v6['cic']['cat_slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_cic_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v6[cic][cat_args][orderby]',
                        'value'         => isset( $home_v6['cic']['cat_args']['orderby'] ) ? $home_v6['cic']['cat_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_cic_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v6[cic][cat_args][order]',
                        'value'         => isset( $home_v6['cic']['cat_args']['order'] ) ? $home_v6['cic']['cat_args']['order'] : 'ASC',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_cic_limit',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_v6[cic][cat_args][number]',
                        'value'         => isset( $home_v6['cic']['cat_args']['number'] ) ? $home_v6['cic']['cat_args']['number'] : '',
                    ) );

                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v6_cic_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v6[cic][carousel_args]',
                        'value'         => isset( $home_v6['cic']['carousel_args'] ) ? $home_v6['cic']['carousel_args'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_cic_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the columns', 'electro' ),
                        'name'          => '_home_v6[cic][carousel_args][items]',
                        'value'         => isset( $home_v6['cic']['carousel_args']['items'] ) ? $home_v6['cic']['carousel_args']['items'] : '10',
                    ) );
                ?>
                </div>
            </div><!-- /#category_icon_carousel -->

            <div id="product_tabs_carousel_with_deal" class="panel electro_options_panel">
                
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v6[ptcwd][section_title]',
                        'value'         => isset( $home_v6['ptcwd']['section_title'] ) ? $home_v6['ptcwd']['section_title'] : esc_html__( 'Catch Daily Deals!', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v6[ptcwd][button_text]',
                        'value'         => isset( $home_v6['ptcwd']['button_text'] ) ? $home_v6['ptcwd']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v6[ptcwd][button_link]',
                        'value'         => isset( $home_v6['ptcwd']['button_link'] ) ? $home_v6['ptcwd']['button_link'] : '#',
                    ) );
                ?>
                </div>
                
                <?php electro_wp_legend( esc_html__( 'Deal product', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_checkbox( array(
                        'id'            => '_home_v6_ptcwd_deal_is_enabled',
                        'label'         => esc_html__( 'Enable Deal Block', 'electro' ), 
                        'name'          => '_home_v6[ptcwd][deal][is_enabled]',
                        'value'         => isset( $home_v6['ptcwd']['deal']['is_enabled'] ) ? $home_v6['ptcwd']['deal']['is_enabled'] : '',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ptcwd_deal_block_title', 
                        'label'         => esc_html__( 'Deal Block Title', 'electro' ), 
                        'placeholder'   => __( 'Special Offer', 'electro' ),
                        'name'          => '_home_v6[ptcwd][deal][title]',
                        'value'         => isset( $home_v6['ptcwd']['deal']['title'] ) ? $home_v6['ptcwd']['deal']['title'] : esc_html__( 'Special Offer', 'electro' ),
                    ) );

                    electro_wp_select( array(
                        'id'            => '_home_v6_ptcwd_deal_product_choice',
                        'label'         => esc_html__( 'Product Choice', 'electro' ),
                        'options'       => array(
                            'random'    => esc_html__( 'Random On Sale Product', 'electro' ),
                            'recent'    => esc_html__( 'Most Recent On Sale Product', 'electro' ),
                            'specific'  => esc_html__( 'Specify by ID', 'electro' ),
                        ),
                        'class'         => 'show_hide_select',
                        'name'          => '_home_v6[ptcwd][deal][product_choice]',
                        'value'         => isset( $home_v6['ptcwd']['deal']['product_choice'] ) ? $home_v6['ptcwd']['deal']['product_choice'] : 'random',
                    ) );
                    
                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ptcwd_deal_product_id', 
                        'label'         =>  esc_html__( 'Deal Product ID', 'electro' ),
                        'name'          => '_home_v6[ptcwd][deal][product_id]',
                        'value'         => $home_v6['ptcwd']['deal']['product_id']
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v6_ptcwd_deal_savings_in',
                        'label'         => esc_html__( 'Savings in', 'electro' ),
                        'options'       => array(
                            'amount'     => esc_html__( 'Amount', 'electro' ),
                            'percentage' => esc_html__( 'Percentage', 'electro' ),
                        ),
                        'name'          => '_home_v6[ptcwd][deal][savings_in]',
                        'value'         => isset( $home_v6['ptcwd']['deal']['savings_in'] ) ? $home_v6['ptcwd']['deal']['savings_in'] : 'amount',
                    ) );    
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Tab products', 'electro' ) ); ?>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_tabs_1_title',
                        'label'         => esc_html__( 'Tab #1 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-80% off', 'electro' ),
                        'name'          => '_home_v6[ptcwd][tabs][0][title]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][0]['title'] ) ? $home_v6['ptcwd']['tabs'][0]['title'] : esc_html__( '-80% off', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v6_ptcwd_tabs_1_content',
                        'label'         => esc_html__( 'Tab #1 Content', 'electro' ),
                        'default'       => 'featured_products',
                        'name'          => '_home_v6[ptcwd][tabs][0][content]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][0]['content'] ) ? $home_v6['ptcwd']['tabs'][0]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_tabs_2_title',
                        'label'         => esc_html__( 'Tab #2 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-65%', 'electro' ),
                        'name'          => '_home_v6[ptcwd][tabs][1][title]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][1]['title'] ) ? $home_v6['ptcwd']['tabs'][1]['title'] : esc_html__( '-65%', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v6_ptcwd_tabs_2_content',
                        'label'         => esc_html__( 'Tab #2 Content', 'electro' ),
                        'default'       => 'sale_products',
                        'name'          => '_home_v6[ptcwd][tabs][1][content]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][1]['content'] ) ? $home_v6['ptcwd']['tabs'][1]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_tabs_3_title',
                        'label'         => esc_html__( 'Tab #3 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-45%', 'electro' ),
                        'name'          => '_home_v6[ptcwd][tabs][2][title]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][2]['title'] ) ? $home_v6['ptcwd']['tabs'][2]['title'] : esc_html__( '-45%', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v6_ptcwd_tabs_3_content',
                        'label'         => esc_html__( 'Tab #3 Content', 'electro' ),
                        'default'       => 'top_rated_products',
                        'name'          => '_home_v6[ptcwd][tabs][2][content]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][2]['content'] ) ? $home_v6['ptcwd']['tabs'][2]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_tabs_4_title',
                        'label'         => esc_html__( 'Tab #4 Title', 'electro' ),
                        'placeholder'   => esc_html__( '-25%', 'electro' ),
                        'name'          => '_home_v6[ptcwd][tabs][3][title]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][3]['title'] ) ? $home_v6['ptcwd']['tabs'][3]['title'] : esc_html__( '-25%', 'electro' ),
                    ) );

                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v6_ptcwd_tabs_4_content',
                        'label'         => esc_html__( 'Tab #4 Content', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v6[ptcwd][tabs][3][content]',
                        'value'         => isset( $home_v6['ptcwd']['tabs'][3]['content'] ) ? $home_v6['ptcwd']['tabs'][3]['content'] : '',
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_product_limit',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'name'          => '_home_v6[ptcwd][product_limit]',
                        'value'         => isset( $home_v6['ptcwd']['product_limit'] ) ? $home_v6['ptcwd']['product_limit'] : 20,
                        'placeholder'   => esc_html__( 'Enter number of products to show', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_product_rows',
                        'label'         => esc_html__( 'Rows', 'electro' ),
                        'name'          => '_home_v6[ptcwd][product_rows]',
                        'value'         => isset( $home_v6['ptcwd']['product_rows'] ) ? $home_v6['ptcwd']['product_rows'] : 2,
                        'placeholder'   => esc_html__( 'Enter number of rows to display', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_ptcwd_product_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'name'          => '_home_v6[ptcwd][product_columns]',
                        'value'         => isset( $home_v6['ptcwd']['product_columns'] ) ? $home_v6['ptcwd']['product_columns'] : 5,
                        'placeholder'   => esc_html__( 'Enter number of Product column to show', 'electro' ),
                    ) );

                    electro_wp_owl_carousel_options( array( 
                        'id'            => '_home_v6_ptcwd_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v6[ptcwd][carousel_args]',
                        'value'         => isset( $home_v6['ptcwd']['carousel_args'] ) ? $home_v6['ptcwd']['carousel_args'] : '',
                        'fields'        => array( 'autoplay' )
                    ) );
                ?>
                </div>

            </div><!-- /#product_tabs_carousel_with_deal -->

            <div id="products_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pc_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v6[pc][section_title]',
                        'value'         => isset( $home_v6['pc']['section_title'] ) ? $home_v6['pc']['section_title'] : esc_html__( 'Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pc_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v6[pc][button_text]',
                        'value'         => isset( $home_v6['pc']['button_text'] ) ? $home_v6['pc']['button_text'] : esc_html__( 'Go to Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pc_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v6[pc][button_link]',
                        'value'         => isset( $home_v6['pc']['button_link'] ) ? $home_v6['pc']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pc_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v6[pc][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v6['pc']['product_limit'] ) ? $home_v6['pc']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v6_pc_product_columns', 
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
                        'name'          => '_home_v6[pc][product_columns]',
                        'value'         => isset( $home_v6['pc']['product_columns'] ) ? $home_v6['pc']['product_columns'] : 6,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v6_pc_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v6[pc][content]',
                        'value'         => isset( $home_v6['pc']['content'] ) ? $home_v6['pc']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v6_pc_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v6[pc][carousel_args]',
                        'value'         => isset( $home_v6['pc']['carousel_args'] ) ? $home_v6['pc']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel -->

            <div id="banner_data" class="panel electro_options_panel">
                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_bd_image',
                        'label'         => esc_html__( 'Banner Image', 'electro' ),
                        'name'          => '_home_v6[bd][image]',
                        'value'         => isset( $home_v6['bd']['image'] ) ? $home_v6['bd']['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_bd_link',
                        'label'         => esc_html__( 'Link', 'electro' ),
                        'name'          => '_home_v6[bd][link]',
                        'value'         => isset( $home_v6['bd']['link'] ) ? $home_v6['bd']['link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#banner_data -->

            <div id="products_carousel_with_image_1" class="panel electro_options_panel">
                
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi1_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v6[pcwi1][section_title]',
                        'value'         => isset( $home_v6['pcwi1']['section_title'] ) ? $home_v6['pcwi1']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                    ) );
                ?>
                </div>

                <div class="options_group">

                <?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

                <?php
                    electro_wp_checkbox( array(
                        'id'            => '_home_v6_pcwi1_enable_categories',
                        'label'         => esc_html__( 'Enable Categories', 'electro' ), 
                        'name'          => '_home_v6[pcwi1][enable_categories]',
                        'value'         => isset( $home_v6['pcwi1']['enable_categories'] ) ? $home_v6['pcwi1']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi1_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_v6[pcwi1][categories_title]',
                        'value'         => isset( $home_v6['pcwi1']['categories_title'] ) ? $home_v6['pcwi1']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi1_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v6[pcwi1][category_args][number]',
                        'default'       => 6,
                        'value'         => isset( $home_v6['pcwi1']['category_args']['number'] ) ? $home_v6['pcwi1']['category_args']['number'] : 6,
                        'placeholder'   => 6
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi1_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v6[pcwi1][category_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v6['pcwi1']['category_args']['slugs'] ) ? $home_v6['pcwi1']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v6_pcwi1_hide_empty_categories',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ), 
                        'name'          => '_home_v6[pcwi1][category_args][hide_empty]',
                        'value'         => isset( $home_v6['pcwi1']['category_args']['hide_empty'] ) ? $home_v6['pcwi1']['category_args']['hide_empty'] : '',
                    ) );

                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcwi1_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v6[pcwi1][image]',
                        'value'         => isset( $home_v6['pcwi1']['image'] ) ? $home_v6['pcwi1']['image'] : '',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_pcwi1_img_action_link',
                        'label'         => esc_html__( 'Image Action Link', 'electro' ),
                        'name'          => '_home_v6[pcwi1][img_action_link]',
                        'value'         => isset( $home_v6['pcwi1']['img_action_link'] ) ? $home_v6['pcwi1']['img_action_link'] : '#',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v6_pcwi1_is_description',
                        'label'         => esc_html__( 'Show Product Rating and Description?', 'electro' ),
                        'name'          => '_home_v6[pcwi1][description]',
                        'value'         => isset( $home_v6['pcwi1']['description'] ) ? $home_v6['pcwi1']['description'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi1_product_limit',
                        'label'         => esc_html__( 'Product Limit', 'electro' ), 
                        'name'          => '_home_v6[pcwi1][product_limit]',
                        'value'         => isset( $home_v6['pcwi1']['product_limit'] ) ? $home_v6['pcwi1']['product_limit'] : '',
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v6_pcwi1_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '5',
                        'name'          => '_home_v6[pcwi1][product_columns]',
                        'value'         => isset( $home_v6['pcwi1']['product_columns'] ) ? $home_v6['pcwi1']['product_columns'] : 5,
                    ) );

                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v6_pcwi1_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v6[pcwi1][content]',
                        'value'         => isset( $home_v6['pcwi1']['content'] ) ? $home_v6['pcwi1']['content'] : ''
                    ) );

                    electro_wp_owl_carousel_options( array( 
                        'id'            => '_home_v6_pcwi1_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v6[pcwi1][carousel_args]',
                        'value'         => isset( $home_v6['pcwi1']['carousel_args'] ) ? $home_v6['pcwi1']['carousel_args'] : '',
                    ) );
                    
                ?>
                </div>
            </div><!-- /#products_carousel_with_image_1 -->

            <div id="products_carousel_with_image_2" class="panel electro_options_panel">
                
                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v6[pcwi2][section_title]',
                        'value'         => isset( $home_v6['pcwi2']['section_title'] ) ? $home_v6['pcwi2']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                    ) );
                ?>
                </div>

                <div class="options_group">

                <?php electro_wp_legend( esc_html__( 'Header Categories', 'electro' ) ); ?>

                <?php
                    electro_wp_checkbox( array(
                        'id'            => '_home_v6_pcwi2_enable_categories',
                        'label'         => esc_html__( 'Enable Categories', 'electro' ), 
                        'name'          => '_home_v6[pcwi2][enable_categories]',
                        'value'         => isset( $home_v6['pcwi2']['enable_categories'] ) ? $home_v6['pcwi2']['enable_categories'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi2_categories_title',
                        'label'         => esc_html__( 'Categories Title', 'electro' ),
                        'name'          => '_home_v6[pcwi2][categories_title]',
                        'value'         => isset( $home_v6['pcwi2']['categories_title'] ) ? $home_v6['pcwi2']['categories_title'] : esc_html__( 'Top 20', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi2_category_limit',
                        'label'         => esc_html__( 'Categories Limit', 'electro' ),
                        'name'          => '_home_v6[pcwi2][category_args][number]',
                        'default'       => 6,
                        'value'         => isset( $home_v6['pcwi2']['category_args']['number'] ) ? $home_v6['pcwi2']['category_args']['number'] : 6,
                        'placeholder'   => 6
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi2_category_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v6[pcwi2][category_args][slugs]',
                        'default'       => '',
                        'value'         => isset( $home_v6['pcwi2']['category_args']['slugs'] ) ? $home_v6['pcwi2']['category_args']['slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' )
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v6_pcwi2_hide_empty_categories',
                        'label'         => esc_html__( 'Hide Empty?', 'electro' ), 
                        'name'          => '_home_v6[pcwi2][category_args][hide_empty]',
                        'value'         => isset( $home_v6['pcwi2']['category_args']['hide_empty'] ) ? $home_v6['pcwi2']['category_args']['hide_empty'] : '',
                    ) );

                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_pcwi2_image',
                        'label'         => esc_html__( 'Image', 'electro' ),
                        'name'          => '_home_v6[pcwi2][image]',
                        'value'         => isset( $home_v6['pcwi2']['image'] ) ? $home_v6['pcwi2']['image'] : '',
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_pcwi2_img_action_link',
                        'label'         => esc_html__( 'Image Action Link', 'electro' ),
                        'name'          => '_home_v6[pcwi2][img_action_link]',
                        'value'         => isset( $home_v6['pcwi2']['img_action_link'] ) ? $home_v6['pcwi2']['img_action_link'] : '#',
                    ) );

                    electro_wp_checkbox( array(
                        'id'            => '_home_v6_pcwi2_is_description',
                        'label'         => esc_html__( 'Show Product Rating and Description?', 'electro' ),
                        'name'          => '_home_v6[pcwi2][description]',
                        'value'         => isset( $home_v6['pcwi2']['description'] ) ? $home_v6['pcwi2']['description'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_pcwi2_product_limit',
                        'label'         => esc_html__( 'Product Limit', 'electro' ), 
                        'name'          => '_home_v6[pcwi2][product_limit]',
                        'value'         => isset( $home_v6['pcwi2']['product_limit'] ) ? $home_v6['pcwi2']['product_limit'] : '',
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v6_pcwi2_product_columns', 
                        'label'         =>  esc_html__( 'Columns', 'electro' ),
                        'options'       => array(
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ),
                        'class'         => 'columns_select',
                        'default'       => '5',
                        'name'          => '_home_v6[pcwi2][product_columns]',
                        'value'         => isset( $home_v6['pcwi2']['product_columns'] ) ? $home_v6['pcwi2']['product_columns'] : 5,
                    ) );

                    electro_wp_wc_shortcode( array( 
                        'id'            => '_home_v6_pcwi2_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v6[pcwi2][content]',
                        'value'         => isset( $home_v6['pcwi2']['content'] ) ? $home_v6['pcwi2']['content'] : ''
                    ) );

                    electro_wp_owl_carousel_options( array( 
                        'id'            => '_home_v6_pcwi2_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v6[pcwi2][carousel_args]',
                        'value'         => isset( $home_v6['pcwi2']['carousel_args'] ) ? $home_v6['pcwi2']['carousel_args'] : '',
                    ) );
                    
                ?>
                </div>
            </div><!-- /#products_carousel_with_image_2 -->

            <div id="ads_block" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Ads Block', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_1_ad_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v6[ad][0][ad_text]',
                        'value'         => isset( $home_v6['ad'][0]['ad_text'] ) ? $home_v6['ad'][0]['ad_text'] : wp_kses_post( __( 'Catch Big<br> <strong>Deals</strong> on the Cameras', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_1_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v6[ad][0][action_text]',
                        'value'         => isset( $home_v6['ad'][0]['action_text'] ) ? $home_v6['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_1_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v6[ad][0][action_link]',
                        'value'         => isset( $home_v6['ad'][0]['action_link'] ) ? $home_v6['ad'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_ad_1_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v6[ad][0][ad_image]',
                        'value'         => isset( $home_v6['ad'][0]['ad_image'] ) ? $home_v6['ad'][0]['ad_image'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_2_ad_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v6[ad][1][ad_text]',
                        'value'         => isset( $home_v6['ad'][1]['ad_text'] ) ? $home_v6['ad'][1]['ad_text'] : wp_kses_post( __( 'Shop the <strong>Hottest</strong> Products', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_2_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v6[ad][1][action_text]',
                        'value'         => isset( $home_v6['ad'][1]['action_text'] ) ? $home_v6['ad'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_2_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v6[ad][1][action_link]',
                        'value'         => isset( $home_v6['ad'][1]['action_link'] ) ? $home_v6['ad'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_ad_2_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v6[ad][1][ad_image]',
                        'value'         => isset( $home_v6['ad'][1]['ad_image'] ) ? $home_v6['ad'][1]['ad_image'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 3', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_3_ad_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v6[ad][2][ad_text]',
                        'value'         => isset( $home_v6['ad'][2]['ad_text'] ) ? $home_v6['ad'][2]['ad_text'] : wp_kses_post( __( 'Tablets, Smartphones <strong>and more</strong>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_3_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v6[ad][2][action_text]',
                        'value'         => isset( $home_v6['ad'][2]['action_text'] ) ? $home_v6['ad'][2]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_3_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v6[ad][2][action_link]',
                        'value'         => isset( $home_v6['ad'][2]['action_link'] ) ? $home_v6['ad'][2]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_ad_3_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v6[ad][2][ad_image]',
                        'value'         => isset( $home_v6['ad'][2]['ad_image'] ) ? $home_v6['ad'][2]['ad_image'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 4', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_4_ad_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v6[ad][3][ad_text]',
                        'value'         => isset( $home_v6['ad'][3]['ad_text'] ) ? $home_v6['ad'][3]['ad_text'] : wp_kses_post( __( 'The New Standard <br><strong>360 Cameras</strong>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_4_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v6[ad][3][action_text]',
                        'value'         => isset( $home_v6['ad'][3]['action_text'] ) ? $home_v6['ad'][3]['action_text'] : wp_kses_post( __( '<span class="upto"><span class="prefix">Upto</span><span class="value">70</span><span class="suffix">%</span>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v6_ad_4_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v6[ad][3][action_link]',
                        'value'         => isset( $home_v6['ad'][3]['action_link'] ) ? $home_v6['ad'][3]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v6_ad_4_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v6[ad][3][ad_image]',
                        'value'         => isset( $home_v6['ad'][3]['ad_image'] ) ? $home_v6['ad'][3]['ad_image'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#ads_block -->

            <div id="recently_viewed_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v6_rvp_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v6[rvp][section_title]',
                        'value'         => isset( $home_v6['rvp']['section_title'] ) ? $home_v6['rvp']['section_title'] : esc_html__( 'Trending products', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_rvp_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v6[rvp][shortcode_atts][per_page]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v6['rvp']['shortcode_atts']['per_page'] ) ? $home_v6['rvp']['shortcode_atts']['per_page'] : '20',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v6_rvp_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the columns', 'electro' ),
                        'name'          => '_home_v6[rvp][product_columns]',
                        'value'         => isset( $home_v6['rvp']['product_columns'] ) ? $home_v6['rvp']['product_columns'] : 10,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php

                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v6_rvp_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v6[rvp][carousel_args]',
                        'value'         => isset( $home_v6['rvp']['carousel_args'] ) ? $home_v6['rvp']['carousel_args'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#recently_viewed_carousel -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v6'] ) ) {
            $clean_home_v6_options = electro_clean_kses_post( $_POST['_home_v6'] );
            update_post_meta( $post_id, '_home_v6_options',  serialize( $clean_home_v6_options ) );
        }
    }
}
