<?php
/*-----------------------------------------------------------------------------------*/
/*  WC Catalog Orderby
/*-----------------------------------------------------------------------------------*/
class Electro_WC_Catalog_Orderby extends WP_Widget {

    public $defaults;

    public function __construct() {

        $widget_ops = array(
            'classname'     => 'electro_wc_catalog_orderby',
            'description'   => esc_html__( 'Your site&#8217;s Catalog Orderby', 'electro' )
        );

        parent::__construct( 'electro_wc_catalog_orderby', esc_html__( 'Electro WC Catalog Orderby', 'electro'), $widget_ops );
    }

    public function widget( $args, $instance ) {

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $instance = wp_parse_args( (array) $instance, $this->defaults );


        if ( electro_is_woocommerce_activated() && ! wc_get_loop_prop( 'is_paginated' ) ) {
            return;
        }

        $show_default_orderby    = 'menu_order' === apply_filters( 'electro_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        $catalog_orderby_options = apply_filters( 'electro_catalog_orderby', array(
            'menu_order' => esc_html__( 'Default Sorting', 'electro' ),
            'popularity' => esc_html__( 'Sort by: Popularity', 'electro' ),
            'rating'     => esc_html__( 'Sort by: Rating', 'electro' ),
            'date'       => esc_html__( 'Sort by: Date', 'electro' ) ,
            'price'      => esc_html__( 'Sort by: Price', 'electro' ),
        ) );

        $default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'electro_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
        $orderby         = isset( $_GET['orderby'] ) ? electro_clean_kses_post( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

        if ( wc_get_loop_prop( 'is_search' ) ) {
            $catalog_orderby_options = array_merge( array( 'relevance' => esc_html__( 'Relevance', 'electro' ) ), $catalog_orderby_options );

            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( ! $show_default_orderby ) {
            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
            unset( $catalog_orderby_options['rating'] );
        }

        if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
            $orderby = current( array_keys( $catalog_orderby_options ) );
        }

        echo wp_kses_post( $args['before_widget'] );
        wc_get_template( 'loop/orderby.php', array(
            'catalog_orderby_options' => $catalog_orderby_options,
            'orderby'                 => $orderby,
            'show_default_orderby'    => $show_default_orderby,
        ) );
        echo wp_kses_post( $args['after_widget'] );

    }
}