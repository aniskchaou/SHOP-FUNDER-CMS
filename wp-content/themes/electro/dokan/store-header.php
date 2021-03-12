<?php
$store_user               = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info               = $store_user->get_shop_info();
$social_info              = $store_user->get_social_profiles();
$store_tabs               = dokan_get_store_tabs( $store_user->get_id() );
$social_fields            = dokan_get_social_profile_fields();

$dokan_appearance         = get_option( 'dokan_appearance' );
$profile_layout           = empty( $dokan_appearance['store_header_template'] ) ? 'default' : $dokan_appearance['store_header_template'];
$store_address            = dokan_get_seller_short_address( $store_user->get_id(), false );

$dokan_store_time_enabled = isset( $store_info['dokan_store_time_enabled'] ) ? $store_info['dokan_store_time_enabled'] : '';
$store_open_notice        = isset( $store_info['dokan_store_open_notice'] ) && ! empty( $store_info['dokan_store_open_notice'] ) ? $store_info['dokan_store_open_notice'] : __( 'Store Open', 'electro' );
$store_closed_notice      = isset( $store_info['dokan_store_close_notice'] ) && ! empty( $store_info['dokan_store_close_notice'] ) ? $store_info['dokan_store_close_notice'] : __( 'Store Closed', 'electro' );
$show_store_open_close    = dokan_get_option( 'store_open_close', 'dokan_appearance', 'on' );

$general_settings         = get_option( 'dokan_general', [] );
$banner_width             = dokan_get_option( 'store_banner_width', 'dokan_appearance', 625 );

if ( ( 'default' === $profile_layout ) || ( 'layout2' === $profile_layout ) ) {
    $profile_img_class = 'profile-img-circle';
} else {
    $profile_img_class = 'profile-img-square';
}

if ( 'layout3' === $profile_layout ) {
    unset( $store_info['banner'] );

    $no_banner_class      = ' profile-frame-no-banner';
    $no_banner_class_tabs = ' dokan-store-tabs-no-banner';

} else {
    $no_banner_class      = '';
    $no_banner_class_tabs = '';
}

$user_data = get_userdata($store_user->get_id());
$registered_date = $user_data->user_registered;
$registered_year = date( "Y", strtotime( $registered_date ) );

$store_id = $user_data->ID;
$is_electro_style = electro_is_dokan_electro_store_style();
$store_version = electro_get_dokan_store_version();

$show_support_btn = isset( $store_info['show_support_btn'] ) && ( $store_info['show_support_btn'] === 'yes' ) ? true : false;

$support_text = isset( $store_info['support_btn_name'] ) && !empty( $store_info['support_btn_name'] ) ? $store_info['support_btn_name'] : __( 'Send Message', 'electro' );

if ( is_user_logged_in() ) {
    $user_logged_in = 'user_logged';
} else {
    $user_logged_in = 'user_logged_out';
}

?>
<div class="profile-frame <?php echo esc_attr( $no_banner_class ); ?>">

    <div class="profile-info-box profile-layout-<?php echo esc_attr( $is_electro_style ? 'electro' : $profile_layout ); ?>">
        <?php if ( ! ( $is_electro_style && $store_version === 'store-v3' ) ) : ?>
            <div class="bg-image-wrapper">
                <?php if ( $store_user->get_banner() ) { ?>
                    <img src="<?php echo esc_url( $store_user->get_banner() ); ?>"
                         alt="<?php echo esc_attr( $store_user->get_shop_name() ); ?>"
                         title="<?php echo esc_attr( $store_user->get_shop_name() ); ?>"
                         class="profile-info-img">
                <?php } else { ?>
                    <div class="profile-info-img dummy-image">&nbsp;</div>
                <?php } ?>
            </div>
        <?php endif; ?>
        <div class="profile-info-summery-wrapper dokan-clearfix">
            <div class="profile-info-summery">
                <?php if ( $is_electro_style ) { ?>
                    <div class="profile-info-head">
                        <div class="profile-img profile-img-circle">
                            <img src="<?php echo esc_url( $store_user->get_avatar() ) ?>"
                                alt="<?php echo esc_attr( $store_user->get_shop_name() ) ?>"
                                size="160">
                        </div>
                    </div>
                    <?php if ( $store_version === 'store-v3' ) : ?>
                        <div class="profile-summery-info-buttons-wrapper">
                    <?php endif; ?>
                    <div class="profile-summery-info-wrapper">
                        <?php if ( $store_version === 'store-v5' ) : ?>
                            <div class="store-title-buttons-wrapper">
                        <?php endif; ?>
                        <?php if ( $store_version !== 'store-v2' && $store_version !== 'store-v3' ) : ?>
                            <div class="title-and-rating">
                                <?php if ( ! empty( $store_user->get_shop_name() ) && ( 'default' === $profile_layout || $is_electro_style ) ) { ?>
                                    <h1 class="store-name"><?php echo esc_html( $store_user->get_shop_name() ); ?></h1>
                                <?php } ?>

                                <div class="dokan-store-rating">
                                    <?php
                                    $vendor = dokan()->vendor->get( $store_id );
                                    $rating = dokan_get_seller_rating($store_id);

                                    if ( ! $rating['count'] ) {
                                        $html = __( 'No ratings found yet!', 'electro' );
                                    } else {
                                        $long_text   = _n( '%d review', '%d reviews', $rating['count'], 'electro' );
                                        $text        = sprintf( __( 'Rated %s out of %d', 'electro' ), $rating['rating'], number_format( 5 ) );
                                        $width       = ( $rating['rating']/5 ) * 100;
                                        $review_text = sprintf( $long_text, $rating['count'] );

                                        if ( function_exists( 'dokan_get_review_url' ) ) {
                                            $review_text = sprintf( '<span>%s</span>', $review_text );
                                        }
                                        $html = '<span class="seller-rating">
                                                    <span title=" '. esc_attr( $text ) . '" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                        <span class="width" style="width: ' . $width . '%"></span>
                                                        <span style=""><strong itemprop="ratingValue">' . $rating['rating'] . '</strong></span>
                                                    </span>
                                                </span>
                                                <span class="text">(' . $review_text . ')</span>';
                                    }

                                    echo wp_kses_post( $html );

                                    ?>
                                </div>

                            </div> <!-- .title-and-rating -->
                        <?php endif; ?>
                        <?php if ( $store_version === 'store-v5' ) : ?>
                            <?php if ( is_dokan_pro_activated() && ( ( electro_dokan_store_support_exists() && $show_support_btn ) || electro_dokan_store_follow_exists() || electro_dokan_store_share_exists() ) ) : ?>
                                <div class="dokan-store-support-and-follow-wrap">
                                    <?php
                                        $vendor = dokan()->vendor->get( $store_id );
                                        $store_info = dokan_get_store_info( $store_id );

                                        if( electro_dokan_store_support_exists() && $show_support_btn ) {
                                            if( version_compare( dokan_pro()->version, '3.0.0' , '<' ) ) {
                                                electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Store_Support', 'generate_support_button' );
                                            } else {
                                                electro_remove_class_action( 'dokan_after_store_tabs', 'WeDevs\DokanPro\Modules\StoreSupport\Module', 'generate_support_button' );
                                            }

                                            ?><div class="dokan-store-support-btn-wrap">
                                                <button data-store_id="<?php echo $store_id; ?>" class="dokan-store-support-btn dokan-btn dokan-btn-theme dokan-btn-sm <?php echo $user_logged_in ?>"><?php echo esc_html( $support_text ); ?></button>
                                            </div><?php
                                        }

                                        if( electro_dokan_store_follow_exists() ) {
                                            $follow_button = new Dokan_Follow_Store_Follow_Button();
                                            electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Follow_Store_Follow_Button', 'add_follow_button_after_store_tabs', 99 );

                                            ?><div class="dokan-store-follow-store-button-container dokan-store-follow-store-btn-wrap">
                                                <?php $follow_button->add_follow_button( $vendor->data, array( 'dokan-btn-sm' ) ); ?>
                                            </div><?php
                                        }

                                        if( electro_dokan_store_share_exists() ) {
                                            $dokan_social = version_compare( dokan_pro()->version, '3.0.0' , '<' ) ? Dokan_Pro_Store_Share::init() : dokan_pro()->store_share;
                                            echo $dokan_social->render_html();
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>        
                            </div>
                        <?php endif; ?>

                        <div class="profile-info">
                            <?php if ( ! empty( $store_user->get_shop_name() ) && ( $store_version === 'store-v2' || $store_version === 'store-v3' ) ) { ?>
                                <h1 class="store-name"><?php echo esc_html( $store_user->get_shop_name() ); ?></h1>
                            <?php } ?>

                            <ul class="dokan-store-info">
                                <?php if ( isset( $store_address ) && !empty( $store_address ) ) { ?>
                                    <li class="dokan-store-address"><i class="ec ec-map-pointer"></i>
                                        <?php echo $store_address; ?>
                                    </li>
                                <?php } ?>

                                <?php if ( !empty( $store_user->get_phone() ) ) { ?>
                                    <li class="dokan-store-phone">
                                        <i class="fa fa-mobile"></i>
                                        <a href="tel:<?php echo esc_html( $store_user->get_phone() ); ?>"><?php echo esc_html( $store_user->get_phone() ); ?></a>
                                    </li>
                                <?php } ?>

                                <?php if ( $store_user->show_email() == 'yes' ) { ?>
                                    <li class="dokan-store-email">
                                        <i class="fa fa-envelope-o"></i>
                                        <a href="mailto:<?php echo esc_attr( antispambot( $store_user->get_email() ) ); ?>"><?php echo esc_attr( antispambot( $store_user->get_email() ) ); ?></a>
                                    </li>
                                <?php } ?>

                                <li class="dokan-sold-products">
                                    <?php $sold_prod_coutnt = dokan_count_orders($store_id); ?>
                                    
                                    <span class="sold-products-count">
                                        <?php echo '<i class="ec ec-add-to-cart"></i>' . sprintf( $sold_prod_coutnt->{'wc-completed'} . ' %s', esc_html__( 'products sold', 'electro' ) ); ?>
                                    </span>
                                </li>

                                <li class="dokan-user-date">
                                    <?php
                                        echo '<i class="far fa-calendar-check"></i>' . sprintf( '%1s ' . get_bloginfo() . ' %2s ' . $registered_year, esc_html__( 'On', 'electro' ), esc_html__( 'from', 'electro' ) );
                                    ?>
                                </li>

                                <li class="dokan-owner-name">
                                    <?php
                                        echo '<i class="ec ec-user"></i>' . sprintf( '%s: ' . $user_data->display_name, esc_html__( 'Owner', 'electro' ) );
                                    ?>
                                </li>

                                <?php if ( $show_store_open_close == 'on' && $dokan_store_time_enabled == 'yes') : ?>
                                    <li class="dokan-store-open-close">
                                        <i class="fas fa-store-alt"></i>
                                        <?php if ( dokan_is_store_open( $store_user->get_id() ) ) {
                                            echo esc_attr( $store_open_notice );
                                        } else {
                                            echo esc_attr( $store_closed_notice );
                                        } ?>
                                    </li>
                                <?php endif ?>

                                <?php do_action( 'dokan_store_header_info_fields',  $store_user->get_id() ); ?>
                            </ul>

                            <?php if ( $social_fields && $store_version !== 'store-v2' ) : ?>
                                <div class="store-social-wrapper">
                                    <ul class="store-social">
                                        <?php foreach( $social_fields as $key => $field ) { ?>
                                            <?php if ( !empty( $social_info[ $key ] ) ) { ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $social_info[ $key ] ); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $field['icon'] ); ?>"></i></a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div> <!-- .profile-info -->
                        <?php if ( $store_version === 'store-v3' ) : ?>
                            <div class="dokan-store-rating">
                                <?php
                                $vendor = dokan()->vendor->get( $store_id );
                                $rating = dokan_get_seller_rating($store_id);

                                if ( ! $rating['count'] ) {
                                    $html = __( 'No ratings found yet!', 'electro' );
                                } else {
                                    $long_text   = _n( '%d review', '%d reviews', $rating['count'], 'electro' );
                                    $text        = sprintf( __( 'Rated %s out of %d', 'electro' ), $rating['rating'], number_format( 5 ) );
                                    $width       = ( $rating['rating']/5 ) * 100;
                                    $review_text = sprintf( $long_text, $rating['count'] );

                                    if ( function_exists( 'dokan_get_review_url' ) ) {
                                        $review_text = sprintf( '<span>%s</span>', $review_text );
                                    }
                                    $html = '<span class="seller-rating">
                                                <span title=" '. esc_attr( $text ) . '" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                    <span class="width" style="width: ' . $width . '%"></span>
                                                    <span style=""><strong itemprop="ratingValue">' . $rating['rating'] . '</strong></span>
                                                </span>
                                            </span>
                                            <span class="text">(' . $review_text . ')</span>';
                                }

                                echo wp_kses_post( $html );

                                ?>
                            </div>
                        <?php endif; ?>
                    </div> <!-- .profile-summery-info-wrapper -->

                    <?php if ( is_dokan_pro_activated() && $store_version !== 'store-v5' ) : ?>
                        <?php if( ( $store_version !== 'store-v2' ) && ( ( electro_dokan_store_support_exists() && $show_support_btn ) || electro_dokan_store_follow_exists() || ( electro_dokan_store_share_exists() && ( $store_version === 'store-v3' || $store_version === 'store-v4' ) ) ) ) : ?>
                            <div class="dokan-store-support-and-follow-wrap">
                                <?php
                                    $vendor = dokan()->vendor->get( $store_id );
                                    $store_info = dokan_get_store_info( $store_id );

                                    if( electro_dokan_store_support_exists() && $show_support_btn ) {
                                        if( version_compare( dokan_pro()->version, '3.0.0' , '<' ) ) {
                                            electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Store_Support', 'generate_support_button' );
                                        } else {
                                            electro_remove_class_action( 'dokan_after_store_tabs', 'WeDevs\DokanPro\Modules\StoreSupport\Module', 'generate_support_button' );
                                        }

                                        ?><div class="dokan-store-support-btn-wrap dokan-right">
                                            <button data-store_id="<?php echo $store_id; ?>" class="dokan-store-support-btn dokan-btn dokan-btn-theme dokan-btn-sm <?php echo $user_logged_in ?>"><?php echo esc_html( $support_text ); ?></button>
                                        </div><?php
                                    }

                                    if( electro_dokan_store_follow_exists() ) {
                                        $follow_button = new Dokan_Follow_Store_Follow_Button();
                                        electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Follow_Store_Follow_Button', 'add_follow_button_after_store_tabs', 99 );

                                        ?><div class="dokan-store-follow-store-button-container dokan-store-follow-store-btn-wrap">
                                            <?php $follow_button->add_follow_button( $vendor->data, array( 'dokan-btn-sm' ) ); ?>
                                        </div><?php
                                    }

                                    if( ( $store_version === 'store-v3' || $store_version === 'store-v4' ) && electro_dokan_store_share_exists() ) {
                                        $dokan_social = version_compare( dokan_pro()->version, '3.0.0' , '<' ) ? Dokan_Pro_Store_Share::init() : dokan_pro()->store_share;
                                        echo $dokan_social->render_html();
                                    }
                                ?>
                            </div>
                        <?php elseif ( ( $store_version == 'store-v2' ) ) : ?>
                            <div class="dokan-store-support-and-rating-wrap">
                                <?php if ( electro_dokan_store_support_exists() && $show_support_btn ) : ?>
                                    <?php
                                        if( version_compare( dokan_pro()->version, '3.0.0' , '<' ) ) {
                                            electro_remove_class_action( 'dokan_after_store_tabs', 'Dokan_Store_Support', 'generate_support_button' );
                                        } else {
                                            electro_remove_class_action( 'dokan_after_store_tabs', 'WeDevs\DokanPro\Modules\StoreSupport\Module', 'generate_support_button' );
                                        }
                                    ?>

                                    <div class="dokan-store-support-btn-wrap">
                                        <button data-store_id="<?php echo $store_id; ?>" class="dokan-store-support-btn dokan-btn dokan-btn-theme dokan-btn-sm <?php echo $user_logged_in ?>"><?php echo esc_html( $support_text ); ?></button>
                                    </div>
                                <?php endif; ?>
                                <div class="dokan-store-rating">
                                    <?php
                                    $vendor = dokan()->vendor->get( $store_id );
                                    $rating = dokan_get_seller_rating($store_id);

                                    if ( ! $rating['count'] ) {
                                        $html = __( 'No ratings found yet!', 'electro' );
                                    } else {
                                        $long_text   = _n( '%d review', '%d reviews', $rating['count'], 'electro' );
                                        $text        = sprintf( __( 'Rated %s out of %d', 'electro' ), $rating['rating'], number_format( 5 ) );
                                        $width       = ( $rating['rating']/5 ) * 100;
                                        $review_text = sprintf( $long_text, $rating['count'] );

                                        if ( function_exists( 'dokan_get_review_url' ) ) {
                                            $review_text = sprintf( '<span>%s</span>', $review_text );
                                        }
                                        $html = '<span class="seller-rating">
                                                    <span title=" '. esc_attr( $text ) . '" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                        <span class="width" style="width: ' . $width . '%"></span>
                                                        <span style=""><strong itemprop="ratingValue">' . $rating['rating'] . '</strong></span>
                                                    </span>
                                                </span>
                                                <span class="text">(' . $review_text . ')</span>';
                                    }

                                    echo wp_kses_post( $html );
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php elseif ( $store_version == 'store-v2' ) : ?>
                        <div class="dokan-store-rating">
                            <?php
                            $vendor = dokan()->vendor->get( $store_id );
                            $rating = dokan_get_seller_rating($store_id);

                            if ( ! $rating['count'] ) {
                                $html = __( 'No ratings found yet!', 'electro' );
                            } else {
                                $long_text   = _n( '%d review', '%d reviews', $rating['count'], 'electro' );
                                $text        = sprintf( __( 'Rated %s out of %d', 'electro' ), $rating['rating'], number_format( 5 ) );
                                $width       = ( $rating['rating']/5 ) * 100;
                                $review_text = sprintf( $long_text, $rating['count'] );

                                if ( function_exists( 'dokan_get_review_url' ) ) {
                                    $review_text = sprintf( '<span>%s</span>', $review_text );
                                }
                                $html = '<span class="seller-rating">
                                            <span title=" '. esc_attr( $text ) . '" class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                                <span class="width" style="width: ' . $width . '%"></span>
                                                <span style=""><strong itemprop="ratingValue">' . $rating['rating'] . '</strong></span>
                                            </span>
                                        </span>
                                        <span class="text">(' . $review_text . ')</span>';
                            }
                            echo wp_kses_post( $html );
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $store_version === 'store-v3' ) : ?>
                        </div>
                    <?php endif; ?>
                <?php } else { ?>
                    <div class="profile-info-head">
                        <div class="profile-img <?php echo esc_attr( $profile_img_class ); ?>">
                            <img src="<?php echo esc_url( $store_user->get_avatar() ) ?>"
                                alt="<?php echo esc_attr( $store_user->get_shop_name() ) ?>"
                                size="150">
                        </div>
                        <?php if ( ! empty( $store_user->get_shop_name() ) && 'default' === $profile_layout ) { ?>
                            <h1 class="store-name"><?php echo esc_html( $store_user->get_shop_name() ); ?></h1>
                        <?php } ?>
                    </div>

                    <div class="profile-info">
                        <?php if ( ! empty( $store_user->get_shop_name() ) && 'default' !== $profile_layout ) { ?>
                            <h1 class="store-name"><?php echo esc_html( $store_user->get_shop_name() ); ?></h1>
                        <?php } ?>

                        <ul class="dokan-store-info">
                            <?php if ( isset( $store_address ) && !empty( $store_address ) ) { ?>
                                <li class="dokan-store-address"><i class="fa fa-map-marker"></i>
                                    <?php echo $store_address; ?>
                                </li>
                            <?php } ?>

                            <?php if ( !empty( $store_user->get_phone() ) ) { ?>
                                <li class="dokan-store-phone">
                                    <i class="fa fa-mobile"></i>
                                    <a href="tel:<?php echo esc_html( $store_user->get_phone() ); ?>"><?php echo esc_html( $store_user->get_phone() ); ?></a>
                                </li>
                            <?php } ?>

                            <?php if ( $store_user->show_email() == 'yes' ) { ?>
                                <li class="dokan-store-email">
                                    <i class="fa fa-envelope-o"></i>
                                    <a href="mailto:<?php echo esc_attr( antispambot( $store_user->get_email() ) ); ?>"><?php echo esc_attr( antispambot( $store_user->get_email() ) ); ?></a>
                                </li>
                            <?php } ?>

                            <li class="dokan-store-rating">
                                <i class="fa fa-star"></i>
                                <?php echo dokan_get_readable_seller_rating( $store_user->get_id() ); ?>
                            </li>

                            <?php if ( $show_store_open_close == 'on' && $dokan_store_time_enabled == 'yes') : ?>
                                <li class="dokan-store-open-close">
                                    <i class="fas fa-store-alt"></i>
                                    <?php if ( dokan_is_store_open( $store_user->get_id() ) ) {
                                        echo esc_attr( $store_open_notice );
                                    } else {
                                        echo esc_attr( $store_closed_notice );
                                    } ?>
                                </li>
                            <?php endif ?>

                            <?php do_action( 'dokan_store_header_info_fields',  $store_user->get_id() ); ?>
                        </ul>

                        <?php if ( $social_fields ) { ?>
                            <div class="store-social-wrapper">
                                <ul class="store-social">
                                    <?php foreach( $social_fields as $key => $field ) { ?>
                                        <?php if ( !empty( $social_info[ $key ] ) ) { ?>
                                            <li>
                                                <a href="<?php echo esc_url( $social_info[ $key ] ); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $field['icon'] ); ?>"></i></a>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div> <!-- .profile-info -->
                <?php } ?>
            </div><!-- .profile-info-summery -->
        </div><!-- .profile-info-summery-wrapper -->
    </div> <!-- .profile-info-box -->
</div> <!-- .profile-frame -->

<?php if ( $store_tabs && ( !$is_electro_style || ( $is_electro_style && in_array( $store_version, array( 'store-v1', 'store-v5' ) ) ) ) ) { ?>
    <div class="dokan-store-tabs<?php echo esc_attr( $no_banner_class_tabs ); ?>">
        <ul class="dokan-list-inline">
            
            <?php foreach( $store_tabs as $key => $tab ) { ?>
                <?php if ( $tab['url'] ): ?>
                    <li class="<?php echo esc_attr( $key ); ?>"><a href="<?php echo esc_url( $tab['url'] ); ?>"><?php echo esc_html( $tab['title'] ); ?></a></li>
                <?php endif; ?>
            <?php } ?>
            <?php do_action( 'dokan_after_store_tabs', $store_user->get_id() ); ?>
        </ul>
    </div>
<?php } ?>