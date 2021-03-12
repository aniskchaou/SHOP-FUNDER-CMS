<?php
/**
 * Product Deals
 *
 * @package Electro/WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;
?>
<div class="product-deal">
    
    <?php 
    /**
     * 
     */
    do_action( 'electro_deal_products_with_featured_content', $product ); ?>

</div>