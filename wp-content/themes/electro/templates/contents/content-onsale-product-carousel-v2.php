<?php
/**
 * Product Card View v2
 *
 * @package Electro/WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<div class="onsale-product">

	<?php
	/**
	 *
	 */
	do_action( 'electro_onsale_product_carousel_content_v2', $product ); ?>

</div>
