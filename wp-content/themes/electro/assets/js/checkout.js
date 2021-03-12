(function($) {
	'use strict';

	$( window ).load( function() {

		var stickynavbarHeight	= 0;
		if ( $( '.sticky-wrapper .navbar' ).length !== 0 ) {
			$( 'body' ).addClass( 'has-sticky-navbar' );
			stickynavbarHeight = $( '.sticky-wrapper .navbar' ).height();
		}

		var windowHeight	= $( window ).height();
		var paymentHeight	= $( '.order-review-wrapper' ).height();

		// Figure out which payment method has the largest payment box
		var tallestPaymentBox = -1;
		$( '.payment_box' ).each( function() {
			tallestPaymentBox = tallestPaymentBox > $( this ).outerHeight() ? tallestPaymentBox : $( this ).outerHeight();
		});

		// Figure out the height of the current payment box
		var currentPaymentBox = $( '.wc_payment_method input:checked' ).siblings( '.payment_box' ).outerHeight();

		if ( windowHeight > paymentHeight + ( tallestPaymentBox - currentPaymentBox + stickynavbarHeight + 30 ) ) {
			// If we're in desktop orientation...
			if ( $( window ).width() > 768 ) {
				var paymentWidth		= $( '.order-review-wrapper' ).outerWidth();
				var	checkoutWidth		= $( 'form.woocommerce-checkout' ).outerWidth();
				var	addressWidth		= $( '#customer_details' ).outerWidth();
				var	gutter				= checkoutWidth - addressWidth - paymentWidth;
				var	paymentOffset		= addressWidth + gutter - 15;

				var sticky_header = new Waypoint.Sticky({
					element: $('.order-review-wrapper')[0],
					handler: function(direction) {
						if (direction == 'down') {
							$( '.order-review-wrapper' ).css({
								'margin-left':		paymentOffset,
								'width':			paymentWidth
							});
						} else if (direction == 'up') {
							$( '.order-review-wrapper' ).removeAttr( 'style' );
						}
					},
				});
			}
		}
	});
})(jQuery);