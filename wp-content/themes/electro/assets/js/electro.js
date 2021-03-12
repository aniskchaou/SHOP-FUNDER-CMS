(function($, window){
	'use strict';

	var arrowWidth = 16;

	$.fn.resizeselect = function(settings) {

		return this.each( function() {

		  	$(this).change( function(){

				var $this = $(this);

				// create test element
				var text = $this.find("option:selected").text();
				var $test = $("<span>").html(text);

				// add to body, get width, and get out
				$test.appendTo('body');
				var width = $test.width();
				$test.remove();

				// set select width
				$this.width(width + arrowWidth);

				// run on start
			}).change();

		});
	};

	$.fn.arrangeObjects = function(wrapWith, maxCols) {

        this.each(function() {
            if ($(this).parent(wrapWith).length) $(this).unwrap();
        });

        this.parent().each(function () {
	        var $subnodes       = $(this).children();

	        // true will cause counter increment
	        // false will cause counter decrement
	        var inc     = true;
	        var cols    = [];

	        for (var i = 0; i < maxCols; i++) {
	            cols.push($('<ul></ul>'));
	            cols[i].appendTo($(this));
	        }

	        function sortByHeight(a, b) {
	            return $(a).height() > $(b).height() ? 0 : 1;
	        }

	        $subnodes = $subnodes.sort(sortByHeight);

	        var i = 0;
	        $subnodes.each(function () {
	            // logic for left and right boundry
	            if (i < 0 || i === maxCols) {
	                inc = !inc;
	                // this will cause node to be added once again to the same column
	                inc ? i++ : i--;
	            }

	            cols[i].append($(this));

	            inc ? i++ : i--;
	        });
	    });
    };

})(jQuery, window);

(function($) {
	'use strict';


	if( typeof $.blockUI !== "undefined" ) {
		$.blockUI.defaults.message                      = null;
		$.blockUI.defaults.overlayCSS.background        = '#fff url(' + electro_options.ajax_loader_url + ') no-repeat center';
		$.blockUI.defaults.overlayCSS.backgroundSize    = '16px 16px';
		$.blockUI.defaults.overlayCSS.opacity           = 0.6;
	}

	/**
	 * Initialize all tooltips on the page
	 */
	$( '[data-toggle="tooltip"]').tooltip();

	/**
	 * Once add to cart button is updated, add tooltip for view cart and remove the tooltip of add to cart
	 */
	$( document ).on ( 'wc_cart_button_updated', function( event, button ) {
		$( button ).siblings( '.added_to_cart' ).tooltip();
		$( button ).parents( '.add-to-cart-wrap' ).addClass( 'added' ).tooltip( 'hide' ).tooltip( 'dispose' );
	} );

	/*===================================================================================*/
	/*  Visual Composer Row Behavior
	/*===================================================================================*/

	var is_rtl = $('body,html').hasClass('rtl');

	if ( is_rtl ) {

		window.vc_rowBehaviour = function () {
			var $ = window.jQuery;
			var local_function = function () {
				var $elements = $( '[data-vc-full-width="true"]' );
				$.each( $elements, function ( key, item ) {
					var $el = $( this );
					var $el_full = $el.next( '.vc_row-full-width' );
					var $el_wrapper = $( '#page' );
					var el_margin_left = parseInt( $el.css( 'margin-left' ), 10 );
					var el_margin_right = parseInt( $el.css( 'margin-right' ), 10 );
					var offset = 0 - $el_full.offset().left - el_margin_left + $el_wrapper.offset().left;
					var width = $el_wrapper.width();
					if( is_rtl ){
						$el.css( {
							'position': 'relative',
							'right': offset,
							'box-sizing': 'border-box',
							'width': $el_wrapper.width()
						} );
					} else {
						$el.css( {
							'position': 'relative',
							'left': offset,
							'box-sizing': 'border-box',
							'width': $el_wrapper.width()
						} );
					}

					if ( ! $el.data( 'vcStretchContent' ) ) {
						var padding = (- 1 * offset);
						if ( padding < 0 ) {
							padding = 0;
						}
						var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
						if ( paddingRight < 0 ) {
							paddingRight = 0;
						}
						$el.css( { 'padding-left': padding + 'px', 'padding-right': paddingRight + 'px' } );
					}
					$el.attr( "data-vc-full-width-init", "true" );
				} );
			};
			/**
			 * @todo refactor as plugin.
			 * @returns {*}
			 */
			var parallaxRow = function () {
				var vcSkrollrOptions,
					callSkrollInit = false;
				if ( vcParallaxSkroll ) {
					vcParallaxSkroll.destroy();
				}
				$( '.vc_parallax-inner' ).remove();
				$( '[data-5p-top-bottom]' ).removeAttr( 'data-5p-top-bottom data-30p-top-bottom' );
				$( '[data-vc-parallax]' ).each( function () {
					var skrollrSpeed,
						skrollrSize,
						skrollrStart,
						skrollrEnd,
						$parallaxElement,
						parallaxImage;
					callSkrollInit = true; // Enable skrollinit;
					if ( $( this ).data( 'vcParallaxOFade' ) == 'on' ) {
						$( this ).children().attr( 'data-5p-top-bottom', 'opacity:0;' ).attr( 'data-30p-top-bottom',
							'opacity:1;' );
					}

					skrollrSize = $( this ).data( 'vcParallax' ) * 100;
					$parallaxElement = $( '<div />' ).addClass( 'vc_parallax-inner' ).appendTo( $( this ) );
					$parallaxElement.height( skrollrSize + '%' );

					parallaxImage = $( this ).data( 'vcParallaxImage' );

					if ( parallaxImage !== undefined ) {
						$parallaxElement.css( 'background-image', 'url(' + parallaxImage + ')' );
					}

					skrollrSpeed = skrollrSize - 100;
					skrollrStart = - skrollrSpeed;
					skrollrEnd = 0;

					$parallaxElement.attr( 'data-bottom-top', 'top: ' + skrollrStart + '%;' ).attr( 'data-top-bottom',
						'top: ' + skrollrEnd + '%;' );
				} );

				if ( callSkrollInit && window.skrollr ) {
					vcSkrollrOptions = {
						forceHeight: false,
						smoothScrolling: false,
						mobileCheck: function () {
							return false;
						}
					};
					vcParallaxSkroll = skrollr.init( vcSkrollrOptions );
					return vcParallaxSkroll;
				}
				return false;
			};

			$( window ).unbind( 'resize.vcRowBehaviour' ).bind( 'resize.vcRowBehaviour', local_function );

			local_function();
			parallaxRow();
		}
	}

	/*===================================================================================*/
	/*  Set Height of Products li
	/*===================================================================================*/

	// these are (ruh-roh) globals. You could wrap in an
	// immediately-Invoked Function Expression (IIFE) if you wanted to...
	var currentTallest = 0,
		currentRowStart = 0,
		rowDivs = new Array();

	function setConformingHeight(el, newHeight) {
		// set the height to something new, but remember the original height in case things change
		el.data("originalHeight", (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight")));
		el.height(newHeight);
	}

	function getOriginalHeight(el) {
		// if the height has changed, send the originalHeight
		return (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight"));
	}

	function columnConform() {
		if( $( window ).width() > 992 ) {
			$( '.columns-1:not(.exclude-auto-height) .product-outer' ).each( function() {
				var $this = $(this);
				if ( 0 != $this.height() ) {
					$this.height( $this.height() );
				}
			});
		}
	}

	function columnConformV2() {
		if( $( window ).width() > 992 ) {
			$( 'li.product.first:last-child .product-outer' ).each( function() {
				var $this = $(this);
				var $wrap = '';
				var $shop_products = $this.parents( '[data-toggle="shop-products"]' );
				var $regular_products = $this.parents( '[data-toggle="regular-products"]' );

				if( $shop_products.length > 0 && ! $shop_products.parents( '.exclude-auto-height' ).length > 0 ) {
					$wrap = $shop_products;
				} else if( $regular_products.length > 0 && ! $regular_products.parents( '.exclude-auto-height' ).length > 0 ) {
					$wrap = $regular_products;
				}

				if ( $wrap.length > 0 ) {
					$this.height( 'auto' );
					if( $wrap.attr( 'data-view' ) == 'grid' || $wrap.attr( 'data-view' ) == 'grid-extended' ) {
						if ( 0 != $this.height() ) {
							$this.height( $this.height() );
						}
					}
				}
			});
		}
	}

	$( window ).on( 'resize', function() {
		columnConform();
		columnConformV2();
	});

	$( '.ec-tabs > li > a' ).on( 'click', function() {
		if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

			if ( target.length ) {

				scrollTo = target.offset().top;

					if ( $('.sticky-wrapper > .stuck' ).length > 0 ) {
					scrollTo = scrollTo - 40;
				}

				$('html, body').animate({
					scrollTop: scrollTo
				}, 1000);
			}
		}
	});

	$('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {

		if ( e.target == '#grid' || e.target == '#grid-extended' ) {
			columnConform();
		}
	});

	$( window ).load( function() {
		columnConform();
		columnConformV2();

		if ( $( window ).width() > 1200 ) {
			$(".off-canvas-navigation").mCustomScrollbar( electro_options.offcanvas_mcs_options );
		}
	});

	// Bootstrap Multi level dropdown trigger
	$('li.dropdown-submenu > a').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		var $this = $(this);
		var $current_dd = $this.closest('li.dropdown-submenu');
		if ( $current_dd.hasClass('open') ) {
			$current_dd.removeClass('open').find('li.dropdown-submenu.open').removeClass('open');
		} else {
			$current_dd.removeClass('open');
			$current_dd.siblings('li.dropdown-submenu.open').removeClass('open').find('li.dropdown-submenu.open').removeClass('open');
			$current_dd.addClass('open');
		}
	});

	// Bootstrap Multi level dropdown remove on outside click
	$( document ).on('hidden.bs.dropdown', function ( event ) {
		$(this).find('li.dropdown-submenu.open').removeClass('open');
	});

	$(document).ready( function() {

		// Set a cookie and hide the store notice when the dismiss button is clicked
		$( '.woocommerce-store-notice__dismiss-link' ).on( 'click', function() {
			$('body').addClass( 'woocommerce-store-notice-dismissed' );
		} );

		// Check the value of that cookie and show/hide the notice accordingly

		if ( typeof Cookies != 'undefined' ) {
			var matchedCookieNames = Object.keys( Cookies.getJSON() ).filter( function ( name ) { return name.indexOf("store_notice") === 0 } );
			if( matchedCookieNames.length > 0 && 'hidden' === Cookies.get( matchedCookieNames[0] ) ) {
				$('body').addClass( 'woocommerce-store-notice-dismissed' );
			} else {
				$('body').removeClass( 'woocommerce-store-notice-dismissed' );
			}
		}

		// Resize Select

		$( "select.resizeselect" ).resizeselect();

		/*===================================================================================*/
		/*  YITH Wishlist
		/*===================================================================================*/

		$( '.add_to_wishlist' ).on( 'click', function() {
			$( this ).closest( '.images-and-summary' ).block();
			$( this ).closest( '.product-inner' ).block();
			$( this ).closest( '.product-list-view-inner' ).block();
			$( this ).closest( '.product-item-inner' ).block();
		});

		$( '.yith-wcwl-wishlistaddedbrowse > .feedback' ).on( 'click', function() {
			var browseWishlistURL = $( this ).next().attr( 'href' );
			window.location.href = browseWishlistURL;
		});

	});

	$( document ).on( 'added_to_wishlist', function() {
		$( '.images-and-summary' ).unblock();
		$( '.product-inner' ).unblock();
		$( '.product-list-view-inner' ).unblock();
		$( '.product-item-inner' ).unblock();
	});

	/*===================================================================================*/
	/*  WooCompare
	/*===================================================================================*/


	$( document ).on( 'click', '.add-to-compare-link:not(.added)', function(e) {

		e.preventDefault();

		var button = $(this),
			data = {
				_yitnonce_ajax: yith_woocompare.nonceadd,
				action: yith_woocompare.actionadd,
				id: button.data('product_id'),
				context: 'frontend'
			},
			widget_list = $('.yith-woocompare-widget ul.products-list');

		// add ajax loader
		if( typeof woocommerce_params != 'undefined' ) {
			button.closest( '.images-and-summary' ).block();
			button.closest( '.product-inner' ).block();
			button.closest( '.product-list-view-inner' ).block();
			button.closest( '.product-item-inner' ).block();
			widget_list.block();
		}

		$.ajax({
			type: 'post',
			url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
			data: data,
			dataType: 'json',
			success: function(response){

				if( typeof woocommerce_params != 'undefined' ) {
					$( '.images-and-summary' ).unblock();
					$( '.product-inner' ).unblock();
					$( '.product-list-view-inner' ).unblock();
					$( '.product-item-inner' ).unblock();
					widget_list.unblock()
				}

				button.addClass('added')
						.attr( 'href', electro_options.compare_page_url )
						.text( yith_woocompare.added_label );

				// add the product in the widget
				widget_list.html( response.widget_table );
			}
		});
	});

	/*===================================================================================*/
	/*  Add to Cart animation
	/*===================================================================================*/

	$( 'body' ).on( 'adding_to_cart', function( e, $btn, data){
		$btn.closest( '.product' ).block();
	});

	$( 'body' ).on( 'added_to_cart', function(){
		$( '.product' ).unblock();
	});

	/*===================================================================================*/
	/*  Bg-yamm-extend-outside
	/*===================================================================================*/

	$('.bg-yamm-extend-outside').closest('ul.dropdown-menu').addClass('bg-yamm-extend');

	/*===================================================================================*/
	/*  Add to cart off-canvas-cart
	/*===================================================================================*/

	$( 'body' ).on( 'added_to_cart', function(){
        $('.off-canvas-cart').toggleClass( "active" );
        $('.electro-overlay').toggleClass( "electro-close-off-canvas" );
    });

	/*===================================================================================*/
    /*  Off Canvas Cart Sidebar
    /*===================================================================================*/

    $( '.header-icon__cart a' ).on( 'click', function() {
        $('.off-canvas-cart').toggleClass( "active" );
        $('.electro-overlay').toggleClass( "electro-close-off-canvas" );
    } );

	$( '.handheld-header-links .cart a' ).on( 'click', function() {
        $('.off-canvas-cart').toggleClass( "active" );
        $('.electro-overlay').toggleClass( "electro-close-off-canvas" );
    } );

    $( '.electro-close-icon' ).on( 'click', function() {
        $( this ).closest('.off-canvas-cart').removeClass( "active" );
        $('.electro-overlay').removeClass('electro-close-off-canvas');
    } );

    $('body').on("click", ".electro-close-off-canvas", function (event) {
        $('.electro-overlay').removeClass('electro-close-off-canvas');
        $('.off-canvas-cart').removeClass('active');
    });


    $( '.mini-cart-toggle a' ).on( 'click', function() {
        $('.off-canvas-cart').toggleClass( "active" );
        $('.electro-overlay').toggleClass( "electro-close-off-canvas" );
    } );

	/*===================================================================================*/
	/*  WC Variation Availability
	/*===================================================================================*/

	$( 'body' ).on( 'woocommerce_variation_has_changed', function( e ) {
		var $singleVariationWrap = $( 'form.variations_form' ).find( '.single_variation_wrap' );
		var $availability = $singleVariationWrap.find( '.woocommerce-variation-availability' ).html();
		if ( typeof $availability !== "undefined" && $availability !== false ) {
			$( '.electro-stock-availability' ).html( $availability );
		}
	});

	/*===================================================================================*/
	/*  Deal Countdown timer
	/*===================================================================================*/

	$( '.deal-countdown-timer' ).each( function() {
		var deal_countdown_text = electro_options.deal_countdown_text;

		// set the date we're counting down to
		var deal_time_diff = $(this).children('.deal-time-diff').text();
		var countdown_output = $(this).children('.deal-countdown');
		var target_date = ( new Date().getTime() ) + ( deal_time_diff * 1000 );

		// variables for time units
		var days, hours, minutes, seconds;

		// update the tag with id "countdown" every 1 second
		setInterval( function () {

			// find the amount of "seconds" between now and target
			var current_date = new Date().getTime();
			var seconds_left = (target_date - current_date) / 1000;

			// do some time calculations
			days = parseInt(seconds_left / 86400);
			seconds_left = seconds_left % 86400;

			hours = parseInt(seconds_left / 3600);
			seconds_left = seconds_left % 3600;

			minutes = parseInt(seconds_left / 60);
			seconds = parseInt(seconds_left % 60);

			// format countdown string + set tag value
			countdown_output.html( '<span data-value="' + days + '" class="days"><span class="value">' + days +  '</span><b>' + deal_countdown_text.days_text + '</b></span><span class="hours"><span class="value">' + hours + '</span><b>' + deal_countdown_text.hours_text + '</b></span><span class="minutes"><span class="value">'
			+ minutes + '</span><b>' + deal_countdown_text.mins_text + '</b></span><span class="seconds"><span class="value">' + seconds + '</span><b>' + deal_countdown_text.secs_text + '</b></span>' );

		}, 1000 );
	});


	$( document ).ready( function() {

		var is_rtl;

		if( electro_options.rtl == '1' ) {
			is_rtl = true;
		} else {
			is_rtl = false;
		}

		var hash_value = window.location.hash;

		switch( hash_value ) {
			case '#grid-extended':
			case '#list-view':
			case '#list-view-small':
			case '#grid':
				$( '.shop-view-switcher a[href="' + hash_value +'"]' ).tab( 'show' );
			break;
			case '#tab-accessories': case '#tab-description':
			case '#tab-specification':
			case '#tab-reviews':
				$( '.wc-tabs a[href="' + hash_value + '"]' ).trigger( 'click' );
			break;
		}

		// Set Home Page Sidebar margin-top
		var departments_menu_height = $( '.page-template-template-homepage-v2 .departments-menu > .dropdown > ul.dropdown-menu' ).height(),
			home_fullwidth_slider_height = $( '.page-template-template-homepage-v2 .home-v2-slider' ).height(),
			sidebar_margin_top = 0;

		if ( departments_menu_height > home_fullwidth_slider_height ) {
			sidebar_margin_top = departments_menu_height + 24;
		} else {
			sidebar_margin_top = home_fullwidth_slider_height;
		}

		sidebar_margin_top = sidebar_margin_top + 35;
		//$( '.page-template-template-homepage-v2 #sidebar').css( 'margin-top', sidebar_margin_top );

		// Detect wrapping of price
		$( '.price-add-to-cart > .price' ).each( function() {
			var $this = $( this );
			if ( $this[0].scrollWidth >  $this.innerWidth() ) {
				//Text has over-flowed
				$this.find( '.electro-price' ).css( 'position', 'relative' );
				if( is_rtl ){
					$this.find( 'del' ).attr( 'style', 'position:absolute;right:0;top:-14px;');
				}else {
					$this.find( 'del' ).attr( 'style', 'position:absolute;left:0;top:-14px;');
				}
			}
		});

		$( '.shop-view-switcher' ).on( 'click', '.nav-link', function() {
			$( '[data-toggle="shop-products"]' ).attr( 'data-view', $(this).data( 'archiveClass' ) );
			columnConformV2();
		} );

		if ( $( window ).width() > 768 ) {
			// Vertical Menu dropdown min-height
			var $vertical_menu = $( '.vertical-menu' ),
				vertical_menu_height = $vertical_menu.height(),
				vm_header_height = 52.25,
				dd_menu_min_height = vertical_menu_height - vm_header_height;

			$vertical_menu.find( '.dropdown > .dropdown-menu, .dropdown-submenu > .dropdown-menu' ).each( function() {
				$(this).css( 'min-height', dd_menu_min_height );
				$(this).find( '.menu-item-object-static_block' ).css( 'min-height', dd_menu_min_height );
			});

			var $list_group_dd = $( '.vertical-menu > .list-group-item > .dropdown-menu' ),
				list_group_dd_style = $list_group_dd.attr( 'style' ),
				list_group_dd_height = 0;

			$list_group_dd.css({
				visibility: 'hidden',
				display: 	'none'
			});

			list_group_dd_height = $list_group_dd.height() + 15;

			$list_group_dd.attr( 'style', list_group_dd_style ? list_group_dd_style : '' );

			$list_group_dd.find( '.dropdown-menu' ).each( function() {
				$(this).css( 'min-height', list_group_dd_height );
				$(this).find( '.menu-item-object-static_block' ).css( 'min-height', list_group_dd_height );
			});

			// Departments menu Height
			var $departments_menu_dropdown = $( '.departments-menu-dropdown' ),
				departments_menu_dropdown_height = $departments_menu_dropdown.height();

			$departments_menu_dropdown.find( '.dropdown-submenu > .dropdown-menu' ).each( function() {
				$(this).find( '.menu-item-object-static_block' ).css( 'min-height', departments_menu_dropdown_height + 24 );
				$(this).css( 'min-height', departments_menu_dropdown_height + 28 );
			});

			$( '.vertical-menu, .departments-menu-dropdown' ).on( 'mouseleave', function() {
				var $this = $(this);
				$this.removeClass( 'animated-dropdown' );
			});

			$( '.vertical-menu .menu-item-has-children, .departments-menu-dropdown .menu-item-has-children' ).on({
	            mouseenter: function() {
	                var $this = $(this),
	                    $dropdown_menu = $this.find( '> .dropdown-menu' ),
	                    $vertical_menu = $this.parents( '.vertical-menu' ),
	                    $departments_menu = $this.parents( '.departments-menu-dropdown' ),
	                    css_properties = {
	                        width:      540,
	                        opacity:    1
	                    },
	                    animation_duration = 300,
	                    has_changed_width = true,
	                    animated_class = '',
	                    $container = '';

	                if ( $vertical_menu.length > 0 ) {
	                    $container = $vertical_menu;
	                } else if ( $departments_menu.length > 0 ) {
	                    $container = $departments_menu;
	                }

	                if ( $this.hasClass( 'yamm-tfw' ) ) {
	                    css_properties.width = 540;

	                    if ( $departments_menu.length > 0 ) {
	                        css_properties.width = 600;
	                    }
	                } else if ( $this.hasClass( 'yamm-fw' ) ) {
	                    css_properties.width = 900;
	                } else if ( $this.hasClass( 'yamm-hw' ) ) {
	                    css_properties.width = 450;
	                } else {
	                    css_properties.width = 277;
	                }

	                $dropdown_menu.css( {
	                    visibility: 'visible',
	                    display:    'block'
	                } );

	                if ( ! $container.hasClass( 'animated-dropdown' ) ) {
	                    $dropdown_menu.animate( css_properties, animation_duration, function() {
	                        $container.addClass( 'animated-dropdown' );
	                    });
	                } else {
	                    $dropdown_menu.css( css_properties );
	                }
	            }, mouseleave: function() {
	                $(this).find( '> .dropdown-menu' ).css({
	                    visibility: 'hidden',
	                    opacity:    0,
	                    width:      0,
	                    display:    'none'
	                });
	            }
	        });

            $( '.electro-animate-dropdown, .departments-menu-v2' ).on( 'mouseleave', function() {
                var $this = $(this);
                $this.removeClass( 'animated-dropdown' );
            });

            $( '.electro-animate-dropdown .menu-item, .departments-menu-v2 .menu-item' ).on( 'mouseenter', function() {
                var $this = $(this),
                    $departments_menu = $this.parents( '.departments-menu-v2' ),
                    $container = $this.parents( '.electro-animate-dropdown' );

                if ( $departments_menu.length > 0 ) {
                    $container = $departments_menu;
                }

                if ( $this.hasClass( 'menu-item-has-children' ) ) {
                    if ( ! $container.hasClass( 'animated-dropdown' ) ) {
                        setTimeout(function(){
                            $container.addClass( 'animated-dropdown' );
                        }, 200);
                    }
                } else if ( $container.hasClass( 'animated-dropdown' ) ) {
                    var $parent = $this.parents( '.menu-item-has-children' );
                    if ( $parent.length <= 0 ) {
                        $container.removeClass( 'animated-dropdown' );
                    }
                }
            });
		}

		// Handheld Footer Bottom Widgets Collapse
		$( '.handheld-footer.v1 .handheld-widget-menu .widget-title' ).on( 'click', function() {
			$( this ).siblings('div,ul').collapse( 'toggle' );
		});
		$( '.handheld-footer.v1 .handheld-widget-menu .widget-title' ).each( function() {
			$( this ).siblings('div,ul').addClass( 'collapse' );
		});

		/*===================================================================================*/
        /*  Handheld Sidebar
        /*===================================================================================*/
        // Hamburger Sidebar Toggler
        $( '.handheld-sidebar-toggle .sidebar-toggler' ).on( 'click', function() {
            $( this ).closest('.site-content').toggleClass( "active-hh-sidebar" );
        } );

        // Hamburger Sidebar Close Trigger
        $( '.tmhh-sidebar-close' ).on( 'click', function() {
            $( this ).closest('.site-content').toggleClass( "active-hh-sidebar" );
        } );

        // Hamburger Sidebar Close Trigger when click outside menu slide
        $( document ).on("click", function(event) {
            if ( $( '.site-content' ).hasClass( 'active-hh-sidebar' ) ) {
                if ( ! $( '.handheld-sidebar-toggle' ).is( event.target ) && 0 === $( '.handheld-sidebar-toggle' ).has( event.target ).length && ! $( '#sidebar' ).is( event.target ) && 0 === $( '#sidebar' ).has( event.target ).length && ! $( '.select2-container' ).is( event.target ) && 0 === $( '.select2-container' ).has( event.target ).length ) {
                    $( '.site-content' ).toggleClass( "active-hh-sidebar" );
                }
            }
        });

		$( '.electro-handheld-footer-bar .search > a' ).on( 'click', function(e) {
			$( this ).parent().toggleClass( 'active' );
			e.preventDefault();
		});

		$( '.handheld-header-links .search > a' ).on( 'click', function(e) {
			$( this ).closest('.search').toggleClass( 'active' );
			$('body').toggleClass( 'disableScroll' );
			e.preventDefault();
		});

		$( document ).on("click", function(event) {
			if ( $( '.handheld-header-links .search' ).hasClass( 'active' ) ) {
				if ( ! $( '.handheld-header-links .search' ).is( event.target ) && 0 === $( '.handheld-header-links .search' ).has( event.target ).length ) {
					$( 'body' ).removeClass( 'disableScroll' );
					$( '.handheld-header-links .search' ).removeClass( "active" );
				}
			}
		});

		// Hamburger Menu Toggler
		$( '.handheld-navigation-wrapper .navbar-toggler' ).on( 'click', function() {
			$( this ).closest('.handheld-navigation-wrapper').toggleClass( "toggled" );
		} );

		// Hamburger Menu Close Trigger
		$( '.ehm-close' ).on( 'click', function() {
			$( this ).closest('.handheld-navigation-wrapper').toggleClass( "toggled" );
		} );

		// Hamburger Menu Close Trigger when click outside menu slide
		$( document ).on("click", function(event) {
			if ( $( '.handheld-navigation-wrapper' ).hasClass( 'toggled' ) ) {
				if ( ! $( '.handheld-navigation-wrapper' ).is( event.target ) && 0 === $( '.handheld-navigation-wrapper' ).has( event.target ).length ) {
					$( '.handheld-navigation-wrapper' ).toggleClass( "toggled" );
				}
			}
		});

		$( '.off-canvas-navigation-wrapper .navbar-toggle-hamburger' ).on( 'click', function() {
			var css_properties = {
				transform:	'translateX(250px)',
				transition:	'all .5s'
			};
			if( is_rtl ) {
				css_properties.transform = 'translateX(-250px)';
			}

			if ( $( this ).parents( '.stuck' ).length > 0 ) {
				$('html, body').animate({
					scrollTop: $('body')
				}, 0);
			}

			$( this ).closest('.off-canvas-navigation-wrapper').toggleClass( "toggled" );
			$('#page').toggleClass( "off-canvas-bg-opacity" ).css( css_properties );
			$('body').toggleClass( "off-canvas-active" );
		} );

		$( '.off-canvas-navigation-wrapper .navbar-toggle-close' ).on( 'click', function() {
			$( this ).closest('.off-canvas-navigation-wrapper').removeClass( "toggled" );
			$('#page').css({'transform': 'none','transition': 'all .5s'}).removeClass( "off-canvas-bg-opacity" );
			$('body').removeClass( "off-canvas-active" );
		} );

		$( document ).on("click", function(event) {
			if ( $( '.off-canvas-navigation-wrapper' ).hasClass( 'toggled' ) ) {
				if ( ! $( '.off-canvas-navigation-wrapper' ).is( event.target ) && 0 === $( '.off-canvas-navigation-wrapper' ).has( event.target ).length ) {
					$( '.off-canvas-navigation-wrapper' ).removeClass( "toggled" );
					$('#page').css({'transform': 'none','transition': 'all .5s'}).removeClass( "off-canvas-bg-opacity" );
					$('body').removeClass( "off-canvas-active" );
				}
			}
		});

		// Animate on scroll into view
		$( '.animate-in-view' ).each( function() {
			var $this = $(this), animation = $this.data( 'animation' );
			var waypoint_animate = new Waypoint({
				element: $this,
				handler: function(e) {
					$this.addClass( $this.data( 'animation' ) + ' animated' );
				},
				offset: '90%'
			});
		});

		/*===================================================================================*/
		/*  STICKY NAVIGATION
		/*===================================================================================*/

		// If we're in desktop orientation...
		if ( $( window ).width() >= 1200 ) {
			if( electro_options.enable_sticky_header == '1' && $( "#page" ).find( '.stick-this' ).length > 0 ) {
				var sticky_header = new Waypoint.Sticky({
					element: $('.stick-this')[0],
						stuckClass: 'stuck animated fadeInDown faster',
					offset: function() {
						return -this.element.clientHeight
					}
				});
			}
		}

		// If we're in hand-held navigation...
		if ( $( window ).width() < 1200 ) {
			if( electro_options.enable_sticky_header == '1' && $( "#page" ).find( '.handheld-navbar-toggle-buttons' ).length > 0 ) {
				var sticky_hh_nav = new Waypoint.Sticky({
					element: $('.handheld-navbar-toggle-buttons')[0],
							stuckClass: 'stuck animated fadeInDown faster'
				});
			}

			if( electro_options.enable_hh_sticky_header == '1' && $( '#page' ).find( '.handheld-stick-this' ).length > 0 ) {
				var sticky_header = new Waypoint.Sticky({
					element: $('.handheld-stick-this')[0],
							stuckClass: 'stuck animated fadeInDown faster',
					offset: function() {
						return -this.element.clientHeight
					}
				});
			}
		}

		// Owl Carousel
		$( '.slider-next' ).on( 'click', function() {
			var owl = $( $( this ).data( 'target' ) + ' .owl-carousel' );
			owl.trigger( 'next.owl.carousel' );
			return false;
		});

		$( '.slider-prev' ).on( 'click', function() {
			var owl = $( $( this ).data( 'target' ) + ' .owl-carousel' );
			owl.trigger( 'prev.owl.carousel' );
			return false;
		});

		/*===================================================================================*/
		/*  Electro Product Gallery Carousel
		/*===================================================================================*/

		$( 'body' ).on( 'woocommerce_variation_has_changed', function( event ) {
			var $product_img = $(this).find( '.product div.electro-gallery img:eq(0)' );
			var $product_link = $(this).find( '.product div.electro-gallery a.zoom:eq(0)' );
			var image_url = $product_link.attr('href');

			if ( typeof variation !== "undefined" && variation ) {
				$(this).wc_variations_image_update( variation );
			} else {
				$(this).wc_variations_image_update( false );
			}

			$('.single-product .electro-gallery > .thumbnails-single .owl-item').each( function() {
				if( $(this).find('a').attr( 'href' ) == image_url ) {
					$( '.single-product .electro-gallery .thumbnails-single' ).trigger('to.owl.carousel', [$(this).index(), 300, true]);
				}
			});
		});

		$( '[data-ride="owl-carousel"]').each( function() {
			var $this = $( this ), carouselDiv = $this.data( 'carouselSelector' ), carouselOptions = $this.data( 'carouselOptions' ),
			shouldReplaceActiveClass = $this.data( 'replaceActiveClass' ), $carousel_elem;

			if ( 'self' === carouselDiv ) {
				$carousel_elem = $this.owlCarousel( carouselOptions );
			} else {
				$carousel_elem = $this.find( carouselDiv );
			}

			if ( true === shouldReplaceActiveClass ) {
				$carousel_elem.on( 'initialized.owl.carousel translated.owl.carousel', function() {
					var $this = $(this);

					$this.find( '.owl-item.last-active' ).each( function() {
						$(this).removeClass( 'last-active' );
					});

					$(this).find( '.owl-item.active' ).last().addClass( 'last-active' );
				});
			}

			$carousel_elem.owlCarousel( carouselOptions );
		});

		$( '.single-product .electro-gallery' ).each( function() {
			var $sync1 = $(this).children('.thumbnails-single');
			var $sync2 = $(this).children('.thumbnails-all');
			var flag = false;
			var duration = 300;

			$sync1.owlCarousel( {
				items: 1,
				margin: 0,
				dots: false,
				nav: false,
				rtl: is_rtl,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:1
					},
					768:{
						items:1
					},
				}
			});

			$sync1.on('changed.owl.carousel', function (e) {
				if (!flag) {
					flag = true;
					$sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
				$sync2.find(".owl-item").removeClass("synced").eq(e.item.index).addClass("synced");
			});

			$sync2.on('initialized.owl.carousel',function (e) {
				$sync2.find(".owl-item").eq(0).addClass("synced");
			});

			var thumbnail_column_class = $sync2.attr( 'class' );
			var cols = 4;
			if( typeof thumbnail_column_class !== 'undefined' ) {
				cols = parseInt( thumbnail_column_class.replace( 'thumbnails-all columns-', '' ) );
			}

			$sync2.owlCarousel( {
				items: cols,
				margin: 8,
				dots: true,
				nav: false,
				rtl: is_rtl,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:3
					},
					768:{
						items:cols
					},
				}
			});

			$sync2.on('click', 'a', function (e) {
				e.preventDefault();
			});

			$sync2.on('click', '.owl-item', function () {
				$sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);
			});

			$sync2.on('changed.owl.carousel', function (e) {
				if (!flag) {
					flag = true;
					$sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}
			});
		});

		$(".electro-store-directory .product-categories > li").arrangeObjects('ul', 4);

		/*===================================================================================*/
		/*  Products LIVE Search
		/*===================================================================================*/

		if( electro_options.enable_live_search == '1' ) {

			if ( electro_options.ajax_url.indexOf( '?' ) > 1 ) {
				var prefetch_url    = electro_options.ajax_url + '&action=products_live_search&fn=get_ajax_search';
				var remote_url      = electro_options.ajax_url + '&action=products_live_search&fn=get_ajax_search&terms=%QUERY';
			} else {
				var prefetch_url    = electro_options.ajax_url + '?action=products_live_search&fn=get_ajax_search';
				var remote_url      = electro_options.ajax_url + '?action=products_live_search&fn=get_ajax_search&terms=%QUERY';
			}

			var searchProducts = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				prefetch: prefetch_url,
				remote: {
					url: remote_url,
					wildcard: '%QUERY',
				},
				identify: function(obj) {
					return obj.id;
				}
			});

			searchProducts.initialize();

			$( '.navbar-search .product-search-field, .handheld-header-v2 .woocommerce-product-search .search-field, .mobile-header-v1 .woocommerce-product-search .search-field, .mobile-header-v2 .woocommerce-product-search .search-field' ).typeahead( electro_options.typeahead_options,
				{
					name: 'search',
					source: searchProducts.ttAdapter(),
					displayKey: 'value',
					limit: electro_options.live_search_limit,
					templates: {
						empty : [
							'<div class="empty-message">',
							electro_options.live_search_empty_msg,
							'</div>'
						].join('\n'),
						suggestion: Handlebars.compile( electro_options.live_search_template )
					}
				}
			);
		}

		/*===================================================================================*/
		/*  PRODUCT CATEGORIES TOGGLE
		/*===================================================================================*/

		$('.product-categories .show-all-cat-dropdown').each(function(){
			if( $(this).siblings('ul').length > 0 ) {
				var $childIndicator = $('<span class="child-indicator"><i class="fa fa-angle-right"></i></span>');

				$(this).siblings('ul').hide();
				if($(this).siblings('ul').is(':visible')){
					$childIndicator.addClass( 'open' );
					$childIndicator.html('<i class="fa fa-angle-up"></i>');
				}

				$(this).on( 'click', function(){
					$(this).siblings('ul').toggle( 'fast', function(){
						if($(this).is(':visible')){
							$childIndicator.addClass( 'open' );
							$childIndicator.html('<i class="fa fa-angle-up"></i>');
						}else{
							$childIndicator.removeClass( 'open' );
							$childIndicator.html('<i class="fa fa-angle-right"></i>');
						}
					});
					return false;
				});
				$(this).append($childIndicator);
			}
		});

		$('.product-categories .cat-item > a').each(function(){
			if( $(this).siblings('ul.children').length > 0 ) {
				var $childIndicator = $('<span class="child-indicator"><i class="fa fa-angle-right"></i></span>');

				$(this).siblings('.children').hide();
				$('.current-cat > .children').show();
				$('.current-cat-parent > .children').show();
				if($(this).siblings('.children').is(':visible')){
					$childIndicator.addClass( 'open' );
					$childIndicator.html('<i class="fa fa-angle-up"></i>');
				}

				$childIndicator.on( 'click', function(){
					$(this).parent().siblings('.children').toggle( 'fast', function(){
						if($(this).is(':visible')){
							$childIndicator.addClass( 'open' );
							$childIndicator.html('<i class="fa fa-angle-up"></i>');
						}else{
							$childIndicator.removeClass( 'open' );
							$childIndicator.html('<i class="fa fa-angle-right"></i>');
						}
					});
					return false;
				});
				$(this).prepend($childIndicator);
			} else {
				$(this).prepend('<span class="no-child"></span>');
			}
		});
	});

	/*===================================================================================*/
    /*  Dokan add class
    /*===================================================================================*/

    if ($(".dokan-store #vendor-biography").length > 0) {
        $(".dokan-store-tabs ul li.vendor_biography").addClass('active');
    } else if ($(".dokan-store #store-toc-wrapper").length > 0) {
        $(".dokan-store-tabs ul li.terms_and_conditions").addClass('active');
    } else if ($(".dokan-store #reviews").length > 0) {
        $(".dokan-store-tabs ul li.reviews").addClass('active');
    } else if ($(".dokan-store #dokan-content").hasClass("store-page-wrap")) {
        $(".dokan-store-tabs ul li.products").addClass('active');
    }

})(jQuery);
