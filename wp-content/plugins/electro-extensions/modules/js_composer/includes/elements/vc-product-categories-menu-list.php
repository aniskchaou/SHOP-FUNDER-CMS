<?php

if ( ! function_exists( 'electro_product_categories_menu_list_elements' ) ) :

    function electro_product_categories_menu_list_elements( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'         => '',
            'list_categories'       => '',
            'action_text'           => '',
            'action_link'           => '',
            'el_class'              => '',
        ), $atts));

        $list_categories_args = array();

        if( is_object( $list_categories ) || is_array( $list_categories ) ) {
            $list_categories = json_decode( json_encode( $list_categories ), true );
        } else {
            $list_categories = json_decode( urldecode( $list_categories ), true );
        }

        if( is_array( $list_categories ) ) {
            foreach ( $list_categories as $key => $list_category ) {

                extract(shortcode_atts(array(
                    'title'                 => '',
                    'limit'                 => '',
                    'has_no_products'       => false,
                    'orderby'               => 'name',
                    'order'                 => 'ASC',
                    'inslugsclude'               => '',
                    'slugs'                 => '',
                ), $list_category));

                $cat_args = array(
                    'number'            => $limit,
                    'hide_empty'        => $has_no_products,
                    'orderby'           => $orderby,
                    'order'             => $order,
                );

                if( ! empty( $slugs ) ) {
                    $slugs = explode( ",", $slugs );
                    $slugs = array_map( 'trim', $slugs );
                    
                    $slug_include = array();

                    foreach ( $slugs as $slug ) {
                        $slug_include[] = "'" . $slug ."'";
                    }

                    if ( ! empty($slug_include ) ) {
                        $cat_args['slug']       = $slugs;
                        $cat_args['include']    = $slug_include;
                        $cat_args['orderby']    = 'include';
                    }

                } elseif( ! empty( $include ) ) {
                    $include = explode( ",", $include );
                    $include = array_map( 'trim', $include );
                    $cat_args['include'] = $include;
                }
                
                $list_categories_args[] = array(
                    'title'                 => $title,
                    'category_args'         => $cat_args,
                );
            }
        }

        $args = array(
            'section_class'         => $el_class,
            'section_title'         => $section_title,
            'category_list'         => $list_categories_args,
            'action_text'           => $action_text,
            'action_link'           => $action_link,
        );
        
        $html = '';
        if( function_exists( 'electro_product_categories_menu_list' ) ) {
            ob_start();
            electro_product_categories_menu_list( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

    add_shortcode( 'electro_product_categories_menu_list' , 'electro_product_categories_menu_list_elements' );

endif;
