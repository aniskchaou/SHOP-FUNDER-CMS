<?php
/**
 * Home v8 Metabox
 *
 * Displays the home v8 meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Electro_Meta_Box_Home_v8 Class
 */
class Electro_Meta_Box_Home_v8 {

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

        if ( $template_file !== 'template-homepage-v8.php' ) {
            return;
        }

        self::output_home_v8( $post );
    }

    private static function output_home_v8( $post ) {

        $home_v8 = electro_get_home_v8_meta();

        ?>
        <div class="panel-wrap meta-box-home">
            <ul class="home_data_tabs ec-tabs">
            <?php
                $product_data_tabs = apply_filters( 'electro_home_v8_data_tabs', array(
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
                    'category_icon_carousel'   => array(
                        'label'     => __( 'Category Icon Carousel', 'electro' ),
                        'target'    => 'category_icon_carousel',
                        'class'     => array(),
                    ),
                    'ads_block' => array(
                        'label'  => __( 'Ads Block', 'electro' ),
                        'target' => 'ads_block',
                        'class'  => array(),
                    ),
                    'products_carousel_1' => array(
                        'label'  => __( 'Products Carousel - 1', 'electro' ),
                        'target' => 'products_carousel_1',
                        'class'  => array(),
                    ),
                    'product_category_tags' => array(
                        'label'  => __( 'Product Category Tags', 'electro' ),
                        'target' => 'product_category_tags',
                        'class'  => array(),
                    ),
                    'products_carousel_2' => array(
                        'label'  => __( 'Products Carousel - 2', 'electro' ),
                        'target' => 'products_carousel_2',
                        'class'  => array(),
                    ),
                    'products_carousel_3' => array(
                        'label'  => __( 'Products Carousel - 3', 'electro' ),
                        'target' => 'products_carousel_3',
                        'class'  => array(),
                    ),
                    'product_categories_1_6' => array(
                        'label'  => __( 'Product Categories 1-6', 'electro' ),
                        'target' => 'product_categories_1_6',
                        'class'  => array(),
                    ),
                    'products_carousel_4' => array(
                        'label'  => __( 'Products Carousel - 4', 'electro' ),
                        'target' => 'products_carousel_4',
                        'class'  => array(),
                    ),
                    'products_carousel_5' => array(
                        'label'  => __( 'Products Carousel - 5', 'electro' ),
                        'target' => 'products_carousel_5',
                        'class'  => array(),
                    ),
                    'two_banners'   => array(
                        'label'     => __( 'Two Banners', 'electro' ),
                        'target'    => 'two_banners',
                        'class'     => array(),
                    ),
                    'products_carousel_6' => array(
                        'label'  => __( 'Products Carousel - 6', 'electro' ),
                        'target' => 'products_carousel_6',
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
                        'id'        => '_home_v8_header_style',
                        'label'     => esc_html__( 'Header Style', 'electro' ),
                        'name'      => '_home_v8[header_style]',
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
                        'value'     => isset( $home_v8['header_style'] ) ? $home_v8['header_style'] : 'v1',
                    ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                        $home_v8_blocks = array(
                            'hpc'   => esc_html__( 'Page content', 'electro' ),
                            'sdr'   => esc_html__( 'Slider', 'electro' ),
                            'cic'   => esc_html__( 'Category Icon Carousel', 'electro' ),
                            'ad'    => esc_html__( 'Ads Block', 'electro' ),
                            'pc1'   => esc_html__( 'Products Carousel - 1', 'electro' ),
                            'pct'   => esc_html__( 'Product Category Tags', 'electro' ),
                            'pc2'   => esc_html__( 'Products Carousel - 2', 'electro' ),
                            'pc3'   => esc_html__( 'Products Carousel - 3', 'electro' ),
                            'pcos'  => esc_html__( 'Product Categories 1-6', 'electro' ),
                            'pc4'   => esc_html__( 'Products Carousel - 4', 'electro' ),
                            'pc5'   => esc_html__( 'Products Carousel - 5', 'electro' ),
                            'tbrs'  => esc_html__( 'Two Banners', 'electro' ),
                            'pc6'   => esc_html__( 'Products Carousel - 6', 'electro' ),
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
                            <?php foreach( $home_v8_blocks as $key => $home_v8_block ) : ?>
                            <tr>
                                <td><?php echo esc_html( $home_v8_block ); ?></td>
                                <td><?php electro_wp_animation_dropdown( array(  'id' => '_home_v8_' . $key . '_animation', 'label'=> '', 'name' => '_home_v8[' . $key . '][animation]', 'value' => isset( $home_v8['' . $key . '']['animation'] ) ? $home_v8['' . $key . '']['animation'] : '', )); ?></td>
                                <td><?php electro_wp_text_input( array(  'id' => '_home_v8_' . $key . '_priority', 'label'=> '', 'name' => '_home_v8[' . $key . '][priority]', 'value' => isset( $home_v8['' . $key . '']['priority'] ) ? $home_v8['' . $key . '']['priority'] : 10, ) ); ?></td>
                                <td><?php electro_wp_checkbox( array( 'id' => '_home_v8_' . $key . '_is_enabled', 'label' => '', 'name' => '_home_v8[' . $key . '][is_enabled]', 'value'=> isset( $home_v8['' . $key . '']['is_enabled'] ) ? $home_v8['' . $key . '']['is_enabled'] : '', ) ); ?></td>
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
                        'id'            => '_home_v8_sdr_shortcode', 
                        'label'         => esc_html__( 'Shortcode', 'electro' ), 
                        'placeholder'   => __( 'Enter the shorcode for your slider here', 'electro' ),
                        'name'          => '_home_v8[sdr][shortcode]',
                        'value'         => isset( $home_v8['sdr']['shortcode'] ) ? $home_v8['sdr']['shortcode'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#slider -->

            <div id="category_icon_carousel" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_cic_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v8[cic][cat_slugs]',
                        'value'         => isset( $home_v8['cic']['cat_slugs'] ) ? $home_v8['cic']['cat_slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_cic_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v8[cic][cat_args][orderby]',
                        'value'         => isset( $home_v8['cic']['cat_args']['orderby'] ) ? $home_v8['cic']['cat_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_cic_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v8[cic][cat_args][order]',
                        'value'         => isset( $home_v8['cic']['cat_args']['order'] ) ? $home_v8['cic']['cat_args']['order'] : 'ASC',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_cic_limit',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_v8[cic][cat_args][number]',
                        'value'         => isset( $home_v8['cic']['cat_args']['number'] ) ? $home_v8['cic']['cat_args']['number'] : '',
                    ) );

                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v8_cic_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v8[cic][carousel_args]',
                        'value'         => isset( $home_v8['cic']['carousel_args'] ) ? $home_v8['cic']['carousel_args'] : '',
                        'fields'        => array( 'nav', 'autoplay', 'responsive' ),
                        'screens'       => array( '0' => array( 'items' ), '480' => array( 'items' ), '768' => array( 'items' ), '992' => array( 'items' ), '1200' => array( 'items' ), '1480' => array( 'items' ) )
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_cic_columns',
                        'label'         => esc_html__( 'Columns', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the columns', 'electro' ),
                        'name'          => '_home_v8[cic][carousel_args][items]',
                        'value'         => isset( $home_v8['cic']['carousel_args']['items'] ) ? $home_v8['cic']['carousel_args']['items'] : '10',
                    ) );
                ?>
                </div>
            </div><!-- /#category_icon_carousel -->

            <div id="ads_block" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Ads Block', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_1_ad_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v8[ad][0][ad_text]',
                        'value'         => isset( $home_v8['ad'][0]['ad_text'] ) ? $home_v8['ad'][0]['ad_text'] : wp_kses_post( __( '<strong>#STAYHOME</strong> AND CATCH BIG <strong>DEALS</strong> ON THE GAMES &amp; CONSOLES', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_1_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v8[ad][0][action_text]',
                        'value'         => isset( $home_v8['ad'][0]['action_text'] ) ? $home_v8['ad'][0]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_1_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v8[ad][0][action_link]',
                        'value'         => isset( $home_v8['ad'][0]['action_link'] ) ? $home_v8['ad'][0]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v8_ad_1_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v8[ad][0][ad_image]',
                        'value'         => isset( $home_v8['ad'][0]['ad_image'] ) ? $home_v8['ad'][0]['ad_image'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_2_ad_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v8[ad][1][ad_text]',
                        'value'         => isset( $home_v8['ad'][1]['ad_text'] ) ? $home_v8['ad'][1]['ad_text'] : wp_kses_post( __( 'SHOP THE <strong>HOTTEST</strong> PRODUCTS', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_2_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v8[ad][1][action_text]',
                        'value'         => isset( $home_v8['ad'][1]['action_text'] ) ? $home_v8['ad'][1]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_2_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v8[ad][1][action_link]',
                        'value'         => isset( $home_v8['ad'][1]['action_link'] ) ? $home_v8['ad'][1]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v8_ad_2_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v8[ad][1][ad_image]',
                        'value'         => isset( $home_v8['ad'][1]['ad_image'] ) ? $home_v8['ad'][1]['ad_image'] : '',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Ads Block 3', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_3_ad_text', 
                        'label'         => esc_html__( 'Ad Text', 'electro' ), 
                        'name'          => '_home_v8[ad][2][ad_text]',
                        'value'         => isset( $home_v8['ad'][2]['ad_text'] ) ? $home_v8['ad'][2]['ad_text'] : wp_kses_post( __( 'TABLETS, SMARTPHONES <strong>AND MORE</strong>', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_3_action_text', 
                        'label'         => esc_html__( 'Action Text', 'electro' ), 
                        'name'          => '_home_v8[ad][2][action_text]',
                        'value'         => isset( $home_v8['ad'][2]['action_text'] ) ? $home_v8['ad'][2]['action_text'] : wp_kses_post( __( 'Shop now', 'electro' ) ),
                    ) );

                    electro_wp_text_input( array( 
                        'id'            => '_home_v8_ad_3_action_link', 
                        'label'         => esc_html__( 'Action Link', 'electro' ), 
                        'name'          => '_home_v8[ad][2][action_link]',
                        'value'         => isset( $home_v8['ad'][2]['action_link'] ) ? $home_v8['ad'][2]['action_link'] : '#',
                    ) );

                    electro_wp_upload_image( array(
                        'id'            => '_home_v8_ad_3_ad_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v8[ad][2][ad_image]',
                        'value'         => isset( $home_v8['ad'][2]['ad_image'] ) ? $home_v8['ad'][2]['ad_image'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#ads_block -->

            <div id="products_carousel_1" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc1_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v8[pc1][section_title]',
                        'value'         => isset( $home_v8['pc1']['section_title'] ) ? $home_v8['pc1']['section_title'] : esc_html__( 'Deals of The Day', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc1_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v8[pc1][button_text]',
                        'value'         => isset( $home_v8['pc1']['button_text'] ) ? $home_v8['pc1']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc1_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[pc1][button_link]',
                        'value'         => isset( $home_v8['pc1']['button_link'] ) ? $home_v8['pc1']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc1_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v8[pc1][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v8['pc1']['product_limit'] ) ? $home_v8['pc1']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v8_pc1_product_columns', 
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
                        'name'          => '_home_v8[pc1][product_columns]',
                        'value'         => isset( $home_v8['pc1']['product_columns'] ) ? $home_v8['pc1']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v8_pc1_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v8[pc1][content]',
                        'value'         => isset( $home_v8['pc1']['content'] ) ? $home_v8['pc1']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v8_pc1_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v8[pc1][carousel_args]',
                        'value'         => isset( $home_v8['pc1']['carousel_args'] ) ? $home_v8['pc1']['carousel_args'] : '',
                        'fields'        => array( 'autoplay', 'responsive', 'dots', 'nav' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_1 -->

            <div id="product_category_tags" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pct_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v8[pct][section_title]',
                        'value'         => isset( $home_v8['pct']['section_title'] ) ? $home_v8['pct']['section_title'] : esc_html__( 'Popular Search', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pct_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v8[pct][cat_slugs]',
                        'value'         => isset( $home_v8['pct']['cat_slugs'] ) ? $home_v8['pct']['cat_slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pct_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v8[pct][cat_args][orderby]',
                        'value'         => isset( $home_v8['pct']['cat_args']['orderby'] ) ? $home_v8['pct']['cat_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pct_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v8[pct][cat_args][order]',
                        'value'         => isset( $home_v8['pct']['cat_args']['order'] ) ? $home_v8['pct']['cat_args']['order'] : 'ASC',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pct_limit',
                        'label'         => esc_html__( 'Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the limit', 'electro' ),
                        'name'          => '_home_v8[pct][cat_args][number]',
                        'value'         => isset( $home_v8['pct']['cat_args']['number'] ) ? $home_v8['pct']['cat_args']['number'] : '',
                    ) );
                ?>
                </div>
            </div><!-- /#product_category_tags -->

            <div id="products_carousel_2" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc2_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v8[pc2][section_title]',
                        'value'         => isset( $home_v8['pc2']['section_title'] ) ? $home_v8['pc2']['section_title'] : esc_html__( 'Laptops & Computers', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc2_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v8[pc2][button_text]',
                        'value'         => isset( $home_v8['pc2']['button_text'] ) ? $home_v8['pc2']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc2_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[pc2][button_link]',
                        'value'         => isset( $home_v8['pc2']['button_link'] ) ? $home_v8['pc2']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc2_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v8[pc2][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v8['pc2']['product_limit'] ) ? $home_v8['pc2']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v8_pc2_product_columns', 
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
                        'name'          => '_home_v8[pc2][product_columns]',
                        'value'         => isset( $home_v8['pc2']['product_columns'] ) ? $home_v8['pc2']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v8_pc2_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v8[pc2][content]',
                        'value'         => isset( $home_v8['pc2']['content'] ) ? $home_v8['pc2']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v8_pc2_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v8[pc2][carousel_args]',
                        'value'         => isset( $home_v8['pc2']['carousel_args'] ) ? $home_v8['pc2']['carousel_args'] : '',
                        'fields'        => array( 'autoplay', 'responsive', 'dots', 'nav' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_2 -->

            <div id="products_carousel_3" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc3_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v8[pc3][section_title]',
                        'value'         => isset( $home_v8['pc3']['section_title'] ) ? $home_v8['pc3']['section_title'] : esc_html__( 'Headphones', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc3_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v8[pc3][button_text]',
                        'value'         => isset( $home_v8['pc3']['button_text'] ) ? $home_v8['pc3']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc3_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[pc3][button_link]',
                        'value'         => isset( $home_v8['pc3']['button_link'] ) ? $home_v8['pc3']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc3_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v8[pc3][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v8['pc3']['product_limit'] ) ? $home_v8['pc3']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v8_pc3_product_columns', 
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
                        'name'          => '_home_v8[pc3][product_columns]',
                        'value'         => isset( $home_v8['pc3']['product_columns'] ) ? $home_v8['pc3']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v8_pc3_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v8[pc3][content]',
                        'value'         => isset( $home_v8['pc3']['content'] ) ? $home_v8['pc3']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v8_pc3_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v8[pc3][carousel_args]',
                        'value'         => isset( $home_v8['pc3']['carousel_args'] ) ? $home_v8['pc3']['carousel_args'] : '',
                        'fields'        => array( 'autoplay', 'responsive', 'dots', 'nav' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_3 -->

            <div id="product_categories_1_6" class="panel electro_options_panel">

                <div class="options_group">
                <?php

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pcos_slugs',
                        'label'         => esc_html__( 'Category Slug', 'electro' ),
                        'name'          => '_home_v8[pcos][cat_slugs]',
                        'value'         => isset( $home_v8['pcos']['cat_slugs'] ) ? $home_v8['pcos']['cat_slugs'] : '',
                        'placeholder'   => esc_html__( 'Enter category slugs separated by comma', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pcos_orderby',
                        'label'         => esc_html__( 'Order By', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the order by', 'electro' ),
                        'name'          => '_home_v8[pcos][cat_args][orderby]',
                        'value'         => isset( $home_v8['pcos']['cat_args']['orderby'] ) ? $home_v8['pcos']['cat_args']['orderby'] : 'title',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pcos_order',
                        'label'         => esc_html__( 'Order', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the Order', 'electro' ),
                        'name'          => '_home_v8[pcos][cat_args][order]',
                        'value'         => isset( $home_v8['pcos']['cat_args']['order'] ) ? $home_v8['pcos']['cat_args']['order'] : 'ASC',
                    ) );

                ?>
                </div>
            </div><!-- /#product_categories_1_6 -->

            <div id="products_carousel_4" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc4_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v8[pc4][section_title]',
                        'value'         => isset( $home_v8['pc4']['section_title'] ) ? $home_v8['pc4']['section_title'] : esc_html__( 'TV Entertainment', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc4_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v8[pc4][button_text]',
                        'value'         => isset( $home_v8['pc4']['button_text'] ) ? $home_v8['pc4']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc4_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[pc4][button_link]',
                        'value'         => isset( $home_v8['pc4']['button_link'] ) ? $home_v8['pc4']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc4_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v8[pc4][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v8['pc4']['product_limit'] ) ? $home_v8['pc4']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v8_pc4_product_columns', 
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
                        'name'          => '_home_v8[pc4][product_columns]',
                        'value'         => isset( $home_v8['pc4']['product_columns'] ) ? $home_v8['pc4']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v8_pc4_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v8[pc4][content]',
                        'value'         => isset( $home_v8['pc4']['content'] ) ? $home_v8['pc4']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v8_pc4_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v8[pc4][carousel_args]',
                        'value'         => isset( $home_v8['pc4']['carousel_args'] ) ? $home_v8['pc4']['carousel_args'] : '',
                        'fields'        => array( 'autoplay', 'responsive', 'dots', 'nav' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_4 -->

            <div id="products_carousel_5" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc5_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v8[pc5][section_title]',
                        'value'         => isset( $home_v8['pc5']['section_title'] ) ? $home_v8['pc5']['section_title'] : esc_html__( 'Smartphones & Tablets', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc5_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v8[pc5][button_text]',
                        'value'         => isset( $home_v8['pc5']['button_text'] ) ? $home_v8['pc5']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc5_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[pc5][button_link]',
                        'value'         => isset( $home_v8['pc5']['button_link'] ) ? $home_v8['pc5']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc5_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v8[pc5][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v8['pc5']['product_limit'] ) ? $home_v8['pc5']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v8_pc5_product_columns', 
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
                        'name'          => '_home_v8[pc5][product_columns]',
                        'value'         => isset( $home_v8['pc5']['product_columns'] ) ? $home_v8['pc5']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v8_pc5_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v8[pc5][content]',
                        'value'         => isset( $home_v8['pc5']['content'] ) ? $home_v8['pc5']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v8_pc5_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v8[pc5][carousel_args]',
                        'value'         => isset( $home_v8['pc5']['carousel_args'] ) ? $home_v8['pc5']['carousel_args'] : '',
                        'fields'        => array( 'autoplay', 'responsive', 'dots', 'nav' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_5 -->

            <div id="two_banners" class="panel electro_options_panel">

                <?php electro_wp_legend( esc_html__( 'Banner 1', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v8_tbrs_1_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v8[tbrs][0][image]',
                        'value'         => isset( $home_v8['tbrs'][0]['image'] ) ? $home_v8['tbrs'][0]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_tbrs_1_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[tbrs][0][action_link]',
                        'value'         => isset( $home_v8['tbrs'][0]['action_link'] ) ? $home_v8['tbrs'][0]['action_link'] : '#',
                    ) );
                ?>
                </div>

                <?php electro_wp_legend( esc_html__( 'Banner 2', 'electro' ) ); ?>

                <div class="options_group">
                <?php

                    electro_wp_upload_image( array(
                        'id'            => '_home_v8_tbrs_2_image',
                        'label'         => esc_html__( 'Ad Image', 'electro' ),
                        'name'          => '_home_v8[tbrs][1][image]',
                        'value'         => isset( $home_v8['tbrs'][1]['image'] ) ? $home_v8['tbrs'][1]['image'] : '',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_tbrs_2_action_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[tbrs][1][action_link]',
                        'value'         => isset( $home_v8['tbrs'][1]['action_link'] ) ? $home_v8['tbrs'][1]['action_link'] : '#',
                    ) );
                ?>
                </div>
            </div><!-- /#two_banners -->

            <div id="products_carousel_6" class="panel electro_options_panel">

                <div class="options_group">
                <?php
                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc6_section_title',
                        'label'         => esc_html__( 'Section Title', 'electro' ),
                        'name'          => '_home_v8[pc6][section_title]',
                        'value'         => isset( $home_v8['pc6']['section_title'] ) ? $home_v8['pc6']['section_title'] : esc_html__( 'Cameras', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc6_button_text',
                        'label'         => esc_html__( 'Action Text', 'electro' ),
                        'name'          => '_home_v8[pc6][button_text]',
                        'value'         => isset( $home_v8['pc6']['button_text'] ) ? $home_v8['pc6']['button_text'] : esc_html__( 'Go to Daily Deals Section', 'electro' ),
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc6_button_link',
                        'label'         => esc_html__( 'Action Link', 'electro' ),
                        'name'          => '_home_v8[pc6][button_link]',
                        'value'         => isset( $home_v8['pc6']['button_link'] ) ? $home_v8['pc6']['button_link'] : '#',
                    ) );

                    electro_wp_text_input( array(
                        'id'            => '_home_v8_pc6_product_limit',
                        'label'         =>  esc_html__( 'Products Limit', 'electro' ),
                        'placeholder'   => esc_html__( 'Enter the number of products to show', 'electro' ),
                        'name'          => '_home_v8[pc6][product_limit]',
                        'class'         => 'product_limit',
                        'size'          => 20,
                        'value'         => isset( $home_v8['pc6']['product_limit'] ) ? $home_v8['pc6']['product_limit'] : 20,
                    ) );

                    electro_wp_select( array( 
                        'id'            => '_home_v8_pc6_product_columns', 
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
                        'name'          => '_home_v8[pc6][product_columns]',
                        'value'         => isset( $home_v8['pc6']['product_columns'] ) ? $home_v8['pc6']['product_columns'] : 7,
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_wc_shortcode( array(
                        'id'            => '_home_v8_pc6_content',
                        'label'         => esc_html__( 'Products', 'electro' ),
                        'default'       => 'recent_products',
                        'name'          => '_home_v8[pc6][content]',
                        'value'         => isset( $home_v8['pc6']['content'] ) ? $home_v8['pc6']['content'] : ''
                    ) );
                ?>
                </div>

                <div class="options_group">
                <?php
                    electro_wp_owl_carousel_options( array(
                        'id'            => '_home_v8_pc6_carousel_args',
                        'label'         => esc_html__( 'Carousel Args', 'electro' ),
                        'name'          => '_home_v8[pc6][carousel_args]',
                        'value'         => isset( $home_v8['pc6']['carousel_args'] ) ? $home_v8['pc6']['carousel_args'] : '',
                        'fields'        => array( 'autoplay', 'responsive', 'dots', 'nav' ),
                    ) );
                ?>
                </div>
            </div><!-- /#products_carousel_6 -->

        </div>
        <?php
    }

    public static function save( $post_id, $post ) {
        if ( isset( $_POST['_home_v8'] ) ) {
            $clean_home_v8_options = electro_clean_kses_post( $_POST['_home_v8'] );
            update_post_meta( $post_id, '_home_v8_options',  serialize( $clean_home_v8_options ) );
        }
    }
}
