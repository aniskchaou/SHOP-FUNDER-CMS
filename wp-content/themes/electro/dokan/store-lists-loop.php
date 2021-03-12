<?php $store_list_style = electro_is_dokan_electro_store_list_version(); ?>
<div id="dokan-seller-listing-wrap">
    <div class="seller-listing-content">
        <?php if ( $sellers['users'] ) : ?>
            <ul class="dokan-seller-wrap">
                <?php
                foreach ( $sellers['users'] as $seller ) {
                    $vendor            = dokan()->vendor->get( $seller->ID );
                    $store_banner_id   = $vendor->get_banner_id();
                    $store_name        = $vendor->get_shop_name();
                    $store_url         = $vendor->get_shop_url();
                    $store_rating      = $vendor->get_rating();
                    $is_store_featured = $vendor->is_featured();
                    $store_phone       = $vendor->get_phone();
                    $store_info        = dokan_get_store_info( $seller->ID );
                    $store_address     = dokan_get_seller_short_address( $seller->ID );
                    $store_banner_url  = $store_banner_id ? wp_get_attachment_image_src( $store_banner_id, $image_size ) : DOKAN_PLUGIN_ASSEST . '/images/default-store-banner.png';
                    ?>

                    <li class="dokan-single-seller woocommerce coloum-<?php echo esc_attr( $per_row ); ?>">
                        <?php if( ! empty( $store_list_style ) ) : ?>
                            <?php if( $store_list_style === 'style-v1'  ) : ?>
                                <?php
                                $products = dokan()->product->latest( array(
                                    'author' => $seller->ID,
                                    'posts_per_page' => 2,
                                ) );
                                ?>
                                <div class="dokan-single-seller__inner">
                                    <div class="dokan-single-seller__logo">
                                        <?php echo get_avatar( $seller->ID, 150 ); ?>
                                    </div>
                                    <?php if( $products->have_posts() ) : ?>
                                        <div class="dokan-single-seller__inner--products">
                                            <?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
                                                <div class="dokan-seller-product">
                                                    <?php woocommerce_template_loop_product_thumbnail(); ?>
                                                </div>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="dokan-single-seller__inner--bottom">
                                    <h2><a href="<?php echo esc_attr( $store_url ); ?>">
                                        <?php echo !empty( $store_name ) ? esc_html( $store_name ) : esc_html__( 'Visit Store', 'electro' ); ?>
                                    </a></h2>
                                </div>
                                <div style="display: none !important;">
                                    <?php do_action( 'dokan_seller_listing_footer_content', $seller, $store_info ); ?>
                                </div>
                            <?php elseif( $store_list_style === 'style-v2'  ) : ?>
                                <?php
                                $products = dokan()->product->latest( array(
                                    'author' => $seller->ID,
                                    'posts_per_page' => 3,
                                ) );
                                ?>
                                <div class="dokan-single-seller__inner">
                                    <?php if( $products->have_posts() ) : ?>
                                        <div class="dokan-single-seller__inner--products products-<?php echo esc_attr( $products->post_count ); ?>">
                                            <?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
                                                <div class="dokan-seller-product">
                                                    <?php woocommerce_template_loop_product_thumbnail(); ?>
                                                </div>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="dokan-single-seller__inner--bottom">
                                        <div class="dokan-single-seller__logo">
                                            <?php echo get_avatar( $seller->ID, 150 ); ?>
                                        </div>
                                        <div class="store-data">
                                            <?php if ( !empty( $store_rating['count'] ) ): ?>
                                                <div class="store-ratings">
                                                    <div class="star-rating dokan-seller-rating" title="<?php echo sprintf( esc_attr__( 'Rated %s out of 5', 'electro' ), esc_attr( $store_rating['rating'] ) ) ?>">
                                                        <span style="width: <?php echo ( esc_attr( ( $store_rating['rating'] / 5 ) ) * 100 - 1 ); ?>%">
                                                            <strong class="rating"><?php echo esc_html( $store_rating['rating'] ); ?></strong> <?php _e( 'out of 5', 'electro' ); ?>
                                                        </span>
                                                    </div>
                                                    <span class="rating-count">( <?php echo esc_html( $store_rating['count'] ); ?> )</span>
                                                </div>
                                            <?php endif ?>

                                            <h2><a href="<?php echo esc_attr( $store_url ); ?>">
                                                <?php echo !empty( $store_name ) ? esc_html( $store_name ) : esc_html__( 'Visit Store', 'electro' ); ?>
                                            </a></h2>

                                            <?php if ( $store_address ): ?>
                                                <?php
                                                    $allowed_tags = array(
                                                        'span' => array(
                                                            'class' => array(),
                                                        ),
                                                    );
                                                ?>
                                                <p class="store-address"><i class="ec ec-map-pointer"></i><?php echo wp_kses( $store_address, $allowed_tags ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: none !important;">
                                    <?php do_action( 'dokan_seller_listing_footer_content', $seller, $store_info ); ?>
                                </div>
                            <?php elseif( $store_list_style === 'style-v3'  ) : ?>
                                <?php
                                $products = dokan()->product->latest( array(
                                    'author' => $seller->ID,
                                    'posts_per_page' => 4,
                                ) );
                                ?>
                                <div class="dokan-single-seller__inner">
                                    <?php if( $products->have_posts() ) : ?>
                                        <div class="dokan-single-seller__inner--products products-<?php echo esc_attr( $products->post_count ); ?>">
                                            <?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
                                                <div class="dokan-seller-product">
                                                    <?php woocommerce_template_loop_product_thumbnail(); ?>
                                                </div>
                                            <?php endwhile; wp_reset_postdata(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="dokan-single-seller__inner--bottom">
                                    <div class="dokan-single-seller__logo">
                                        <?php echo get_avatar( $seller->ID, 150 ); ?>
                                    </div>
                                    <div class="store-data">
                                        <h2><a href="<?php echo esc_attr( $store_url ); ?>">
                                            <?php echo !empty( $store_name ) ? esc_html( $store_name ) : esc_html__( 'Visit Store', 'electro' ); ?>
                                        </a></h2>

                                        <?php if ( $store_address ): ?>
                                            <?php
                                                $allowed_tags = array(
                                                    'span' => array(
                                                        'class' => array(),
                                                    ),
                                                );
                                            ?>
                                            <p class="store-address"><i class="ec ec-map-pointer"></i><?php echo wp_kses( $store_address, $allowed_tags ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div style="display: none !important;">
                                    <?php do_action( 'dokan_seller_listing_footer_content', $seller, $store_info ); ?>
                                </div>
                            <?php elseif( $store_list_style === 'style-v4'  ) : ?>
                                <?php
                                $products = dokan()->product->latest( array(
                                    'author' => $seller->ID,
                                    'posts_per_page' => 4,
                                ) );
                                ?>
                                <div class="dokan-single-seller__outter">
                                    <div class="dokan-single-seller__inner">
                                        <div class="dokan-single-seller__info">
                                            <div class="dokan-single-seller__logo">
                                                <?php echo get_avatar( $seller->ID, 100 ); ?>
                                            </div>
                                            <div class="dokan-store-name-address">
                                                <h2 class="store-name"><a href="<?php echo esc_attr( $store_url ); ?>">
                                                    <?php echo !empty( $store_name ) ? esc_html( $store_name ) : esc_html__( 'Visit Store', 'electro' ); ?>
                                                </a></h2>
                                                <?php if ( $store_address ): ?>
                                                    <?php
                                                        $allowed_tags = array(
                                                            'span' => array(
                                                                'class' => array(),
                                                            ),
                                                        );
                                                    ?>
                                                    <p class="store-address"><i class="ec ec-map-pointer"></i><?php echo wp_kses( $store_address, $allowed_tags ); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="store-data">
                                            <?php if( electro_dokan_store_follow_exists() ) : ?>
                                                <?php
                                                $follow_button = new Dokan_Follow_Store_Follow_Button();
                                                electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Follow_Store_Follow_Button', 'add_follow_button_after_store_tabs', 99 );
                                                ?>

                                                <div class="dokan-store-follow-store-button-container dokan-store-follow-store-btn-wrap">
                                                    <?php $follow_button->add_follow_button( $vendor->data, array( 'dokan-btn-sm' ) ); ?>
                                                </div>
                                            <?php endif ?>
                                            <span class="sold-products-count">
                                                <?php $sold_prod_coutnt = dokan_count_orders($seller->ID);
                                                echo sprintf( $sold_prod_coutnt->{'wc-completed'} . ' %s', esc_html__( 'products sold', 'electro' ) ); ?>
                                            </span>
                                            <?php if ( !empty( $store_rating['count'] ) ): ?>
                                                <div class="store-ratings">
                                                    <div class="star-rating dokan-seller-rating" title="<?php echo sprintf( esc_attr__( 'Rated %s out of 5', 'electro' ), esc_attr( $store_rating['rating'] ) ) ?>">
                                                        <span style="width: <?php echo ( esc_attr( ( $store_rating['rating'] / 5 ) ) * 100 - 1 ); ?>%">
                                                            <strong class="rating"><?php echo esc_html( $store_rating['rating'] ); ?></strong> <?php _e( 'out of 5', 'electro' ); ?>
                                                        </span>
                                                    </div>
                                                    <span class="rating-count">( <?php echo esc_html( $store_rating['count'] ); ?> )</span>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <?php if( $products->have_posts() ) : ?>
                                            <div class="dokan-single-seller__products">
                                                <?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
                                                    <div class="dokan-seller-product">
                                                        <?php woocommerce_template_loop_product_thumbnail(); ?>
                                                    </div>
                                                <?php endwhile; ?>
                                                <?php if( $products->found_posts > 4 ) : ?>
                                                    <div class="dokan-seller-remaining-product">
                                                        <div class="dokan-seller-remaining-product__inner">
                                                            <span class="remaining-products-count">
                                                                <?php echo esc_html( ( $products->found_posts - 4 ) . '+' ); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php endif; wp_reset_postdata(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div style="display: none !important;">
                                    <?php do_action( 'dokan_seller_listing_footer_content', $seller, $store_info ); ?>
                                </div>
                            <?php elseif( $store_list_style === 'style-v5'  ) : ?>
                                <div class="dokan-single-seller__outter">
                                    <div class="dokan-single-seller__inner">
                                        <div class="dokan-single-seller__info">
                                            <div class="dokan-single-seller__logo">
                                                <?php echo get_avatar( $seller->ID, 100 ); ?>
                                            </div>
                                            <div class="dokan-store-name-info">
                                                <h2 class="store-name"><a href="<?php echo esc_attr( $store_url ); ?>">
                                                    <?php echo !empty( $store_name ) ? esc_html( $store_name ) : esc_html__( 'Visit Store', 'electro' ); ?>
                                                </a></h2>
                                                <div class="dokan-store-address-sold-products">
                                                    <?php if ( $store_address ): ?>
                                                        <?php
                                                            $allowed_tags = array(
                                                                'span' => array(
                                                                    'class' => array(),
                                                                ),
                                                            );
                                                        ?>
                                                        <p class="store-address"><i class="ec ec-map-pointer"></i><?php echo wp_kses( $store_address, $allowed_tags ); ?></p>
                                                    <?php endif; ?>
                                                    <span class="sold-products-count">
                                                        <?php $sold_prod_coutnt = dokan_count_orders($seller->ID);
                                                        echo sprintf( $sold_prod_coutnt->{'wc-completed'} . ' %s', esc_html__( 'products sold', 'electro' ) ); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if( electro_dokan_store_follow_exists() ) : ?>
                                            <?php
                                            $follow_button = new Dokan_Follow_Store_Follow_Button();
                                            electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Follow_Store_Follow_Button', 'add_follow_button_after_store_tabs', 99 );
                                            ?>

                                            <div class="dokan-store-follow-store-button-container dokan-store-follow-store-btn-wrap">
                                                <?php $follow_button->add_follow_button( $vendor->data, array( 'dokan-btn-sm' ) ); ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div style="display: none !important;">
                                    <?php do_action( 'dokan_seller_listing_footer_content', $seller, $store_info ); ?>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="store-wrapper">
                                <div class="store-content">
                                    <div class="store-info" style="background-image: url( '<?php echo is_array( $store_banner_url ) ? esc_attr( $store_banner_url[0] ) : esc_attr( $store_banner_url ); ?>');">
                                        <div class="store-data-container">
                                            <div class="featured-favourite">
                                                <?php if ( $is_store_featured ) : ?>
                                                    <div class="featured-label"><?php esc_html_e( 'Featured', 'electro' ); ?></div>
                                                <?php endif ?>

                                                <?php do_action( 'dokan_seller_listing_after_featured', $seller, $store_info ); ?>
                                            </div>

                                            <div class="store-data">
                                                <h2><a href="<?php echo esc_attr( $store_url ); ?>"><?php echo esc_html( $store_name ); ?></a></h2>

                                                <?php if ( !empty( $store_rating['count'] ) ): ?>
                                                    <div class="star-rating dokan-seller-rating" title="<?php echo sprintf( esc_attr__( 'Rated %s out of 5', 'electro' ), esc_attr( $store_rating['rating'] ) ) ?>">
                                                        <span style="width: <?php echo ( esc_attr( ( $store_rating['rating'] / 5 ) ) * 100 - 1 ); ?>%">
                                                            <strong class="rating"><?php echo esc_html( $store_rating['rating'] ); ?></strong> <?php _e( 'out of 5', 'electro' ); ?>
                                                        </span>
                                                    </div>
                                                <?php endif ?>

                                                <?php if ( $store_address ): ?>
                                                    <?php
                                                        $allowed_tags = array(
                                                            'span' => array(
                                                                'class' => array(),
                                                            ),
                                                            'br' => array()
                                                        );
                                                    ?>
                                                    <p class="store-address"><?php echo wp_kses( $store_address, $allowed_tags ); ?></p>
                                                <?php endif ?>

                                                <?php if ( $store_phone ) { ?>
                                                    <p class="store-phone">
                                                        <i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $store_phone ); ?>
                                                    </p>
                                                <?php } ?>

                                                <?php do_action( 'dokan_seller_listing_after_store_data', $seller, $store_info ); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="store-footer">
                                    <div class="seller-avatar">
                                        <?php echo get_avatar( $seller->ID, 150 ); ?>
                                    </div>
                                    <a href="<?php echo esc_url( $store_url ); ?>" class="dokan-btn dokan-btn-theme"><?php esc_html_e( 'Visit Store', 'electro' ); ?></a>

                                    <?php do_action( 'dokan_seller_listing_footer_content', $seller, $store_info ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>

                <?php } ?>
                <div class="dokan-clearfix"></div>
            </ul> <!-- .dokan-seller-wrap -->

            <?php
            $user_count   = $sellers['count'];
            $num_of_pages = ceil( $user_count / $limit );

            if ( $num_of_pages > 1 ) {
                echo '<div class="pagination-container clearfix">';

                $pagination_args = array(
                    'current'   => $paged,
                    'total'     => $num_of_pages,
                    'base'      => $pagination_base,
                    'type'      => 'array',
                    'prev_text' => __( '&larr; Previous', 'electro' ),
                    'next_text' => __( 'Next &rarr;', 'electro' ),
                );

                if ( ! empty( $search_query ) ) {
                    $pagination_args['add_args'] = array(
                        'dokan_seller_search' => $search_query,
                    );
                }

                $page_links = paginate_links( $pagination_args );

                if ( $page_links ) {
                    $pagination_links  = '<div class="pagination-wrap">';
                    $pagination_links .= '<ul class="pagination"><li>';
                    $pagination_links .= join( "</li>\n\t<li>", $page_links );
                    $pagination_links .= "</li>\n</ul>\n";
                    $pagination_links .= '</div>';

                    echo $pagination_links; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
                }

                echo '</div>';
            }
            ?>

        <?php else:  ?>
            <p class="dokan-error"><?php esc_html_e( 'No vendor found!', 'electro' ); ?></p>
        <?php endif; ?>
    </div>
    <?php if( $store_list_style === 'style-v5' ) : ?>
        <?php do_action( 'dokan_electro_store_list_after', $sellers ); ?>
    <?php endif; ?>
</div>