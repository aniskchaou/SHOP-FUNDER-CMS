<?php
/**
 * Off Canvas Shopping Cart Summary
 *
 * @author 		Transvelo
 * @package 	Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( apply_filters( 'electro_off_canvas_cart', true ) ) { ?>
	<?php if ( is_cart() == false && is_checkout() == false ) { ?>
		<div id="off-canvas-cart-summary" class="off-canvas-cart">
			<header class="off-canvas-cart__header">
				<h3 class="section-title">
					<?php echo esc_html__( 'SHOPPING CART', 'electro' ); ?>
				</h3>
				<span class="electro-close-icon">close</span>
			</header>
			<div class="cart-products widget-area">
				<div class="cart-product-list  dropdown-menu-mini-cart">
					<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
				</div>
			</div>
		</div>
	<?php }
}
