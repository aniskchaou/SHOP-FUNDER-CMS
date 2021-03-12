jQuery(function($) {
	var CF = CF || {};
	
	CF.postFormats = function($) {
		return {
			switchTab: function(clicked) {
				var $this = $(clicked),
					$tab = $this.closest('.nav-tab');

				if (!$this.hasClass('nav-tab-active')) {
					$this.addClass('nav-tab-active');
					$tab.siblings().removeClass('nav-tab-active');
					this.switchWPFormat($this.attr('href'));
				}
			},
			
			switchWPFormat: function(formatHash) {
				$(formatHash).trigger('click');
				switch (formatHash) {
					case '#post-format-0':
					case '#post-format-aside':
					case '#post-format-chat':
						CF.postFormats.standard();
						break;
					case '#post-format-status':
					case '#post-format-link':
					case '#post-format-image':
					case '#post-format-gallery':
					case '#post-format-video':
					case '#post-format-quote':
					case '#post-format-audio':
						CF.postFormats[formatHash.replace('#post-format-', '')]();
				}
				$(document).trigger('cf-post-formats-switch', formatHash);
			},

			standard: function() {
				$('#cfpf-format-link-url, #cfpf-format-quote-fields, #cfpf-format-video-fields, #cfpf-format-audio-fields, #cfpf-format-gallery-preview').hide();
				$('#titlewrap').show();
				$('#postimagediv-placeholder').replaceWith($('#postimagediv'));
			},
			
			status: function() {
				$('#titlewrap, #cfpf-format-link-url, #cfpf-format-quote-fields, #cfpf-format-video-fields, #cfpf-format-audio-fields, #cfpf-format-gallery-preview').hide();
				$('#postimagediv-placeholder').replaceWith($('#postimagediv'));
				$('#content:visible').focus();
			},

			link: function() {
				$('#cfpf-format-quote-fields, #cfpf-format-video-fields, #cfpf-format-audio-fields, #cfpf-format-gallery-preview').hide();
				$('#titlewrap, #cfpf-format-link-url').show();
				$('#postimagediv-placeholder').replaceWith($('#postimagediv'));
			},
			
			image: function() {
				$('#cfpf-format-link-url, #cfpf-format-quote-fields, #cfpf-format-video-fields, #cfpf-format-audio-fields, #cfpf-format-gallery-preview').hide();
				$('#titlewrap').show();
				$('#postimagediv').after('<div id="postimagediv-placeholder"></div>').insertAfter('#titlediv');
			},

			gallery: function() {
				$('#cfpf-format-link-url, #cfpf-format-quote-fields, #cfpf-format-video-fields, #cfpf-format-audio-fields').hide();
				$('#titlewrap, #cfpf-format-gallery-preview').show();
				$('#postimagediv-placeholder').replaceWith($('#postimagediv'));
			},

			video: function() {
				$('#cfpf-format-link-url, #cfpf-format-quote-fields, #cfpf-format-gallery-preview, #cfpf-format-audio-fields').hide();
				$('#titlewrap, #cfpf-format-video-fields').show();
				$('#postimagediv-placeholder').replaceWith($('#postimagediv'));
			},

			quote: function() {
				$('#cfpf-format-link-url, #cfpf-format-video-fields, #cfpf-format-audio-fields, #cfpf-format-gallery-preview').hide();
				$('#titlewrap, #cfpf-format-quote-fields').show().find(':input:first').focus();
				$('#postimagediv-placeholder').replaceWith($('#postimagediv'));
			},

			audio: function() {
				$('#cfpf-format-link-url, #cfpf-format-quote-fields, #cfpf-format-video-fields, #cfpf-format-gallery-preview').hide();
				$('#titlewrap, #cfpf-format-audio-fields').show();
				$('#postimagediv-placeholder').replaceWith($('#postimagediv'));
			}

		};
	}(jQuery);
	
	// move tabs in to place
	$('#cf-post-format-tabs').insertBefore($('form#post')).show();
	$('#cfpf-format-link-url, #cfpf-format-video-fields, #cfpf-format-audio-fields').insertAfter($('#titlediv'));
	$('#cfpf-format-gallery-preview').find('dt a').each(function() {
		$(this).replaceWith($(this.childNodes)); // remove links
	}).end().insertAfter($('#titlediv'));
	$('#cfpf-format-quote-fields').insertAfter($('#titlediv'));
	
	$(document).trigger('cf-post-formats-init');
	
	// tab switch
	$('#cf-post-format-tabs a').on('click', function(e) {
		CF.postFormats.switchTab(this);
		e.stopPropagation();
		e.preventDefault();
	}).filter('.current').each(function() {
		CF.postFormats.switchWPFormat($(this).attr('href'));
	});


	// Gallery Functions

	jQuery(function($) {
		var frame,
		    images = $('#cfpf-format-gallery-ids-field').val(),   //'<?php echo get_post_meta( $post->ID, 'tz_image_ids', true ); ?>',
		    selection = loadImages(images);

		$('#cfpf-format-gallery-preview .none a').on('click', function(e) {
			e.preventDefault();

			// Set options for 1st frame render
			var options = {
				title: 'Gallery Post Format',
				state: 'gallery-edit',
				frame: 'post',
				selection: selection
			};

			// Check if frame or gallery already exist
			if( frame || selection ) {
				options['title'] = 'Gallery Post Format';
			}

			frame = wp.media(options).open();
			
			// Tweak views
			frame.menu.get('view').unset('cancel');
			frame.menu.get('view').unset('separateCancel');
			frame.menu.get('view').get('gallery-edit').el.innerHTML = 'Edit Gallery';
			frame.content.get('view').sidebar.unset('gallery'); // Hide Gallery Settings in sidebar

			// When we are editing a gallery
			overrideGalleryInsert();
			frame.on( 'toolbar:render:gallery-edit', function() {
				overrideGalleryInsert();
			});
			
			frame.on( 'content:render:browse', function( browser ) {
			    if ( !browser ) return;
			    // Hide Gallery Setting in sidebar
			    browser.sidebar.on('ready', function(){
			        browser.sidebar.unset('gallery');
			    });
			    // Hide filter/search as they don't work 
					browser.toolbar.on('ready', function(){ 
					if(browser.toolbar.controller._state == 'gallery-library'){ 
						browser.toolbar.$el.hide(); 
					} 
					}); 
			});
			
			// All images removed
			frame.state().get('library').on( 'remove', function() {
			    var models = frame.state().get('library');
				if(models.length == 0){
				    selection = false;
					$.post(ajaxurl, { ids: '', action: 'save_gallery_images', post_id: $('#post_ID').val(), nonce: $('#cfpf-format-gallery-nonce-field').val() });
				}
			});
			
			// Override insert button
			function overrideGalleryInsert() {
				frame.toolbar.get('view').set({
					insert: {
						style: 'primary',
						text: 'Create Gallery',

						click: function() {
							var models = frame.state().get('library'),
							    ids = '';
							    items = '';

							models.each( function( attachment ) {
							    console.log('attachment: ', attachment.attributes.sizes.thumbnail);
							    ids += attachment.id + ',';
							    image_thumb = attachment.attributes.sizes.thumbnail;
							    items += '<li><img src="'+ image_thumb.url +'" height="'+ image_thumb.height +'" width="'+ image_thumb.width +'" ></li>';
							});

							ids = ids.substring(0, ids.length - 1); // trim that last comma

							this.el.innerHTML = 'Working...';
							
							// $('#post-format-gallery-items').html( loadImages(ids) );
							
							// frame.close();
							$('#cfpf-format-gallery-ids-field').val( ids );
							$('#post-format-gallery-items').html( '<ul class="gallery">'+ items +'</ul>' );
							frame.close();
							// $.ajax({
							// 	type: 'POST',
							// 	url: ajaxurl,
							// 	data: { 
							// 		ids: ids, 
							// 		// action: 'save_gallery_images', 
							// 		post_id: $('#post_ID').val(),  
							// 		nonce: $('#cfpf-format-gallery-nonce-field').val()
							// 	},
							// 	success: function(){
							// 		selection = loadImages(ids);
							// 		frame.close();
									
							// 		$('#cfpf-format-gallery-ids-field').val( ids );
							// 		$('#post-format-gallery-items').html( '<ul class="gallery">'+ items +'</ul>' );
							// 	},
							// 	dataType: 'html'
							// });
						}
					}
				});
			}
		});
		
		// Load images
		function loadImages(images) {
			if( images ){
			    var shortcode = new wp.shortcode({
					tag:    'gallery',
					attrs:   { ids: images },
					type:   'single'
				});
	
				console.log('Shortcode: ', shortcode);
			    
			    var attachments = wp.media.gallery.attachments( shortcode );

				console.log('Attachments: ', attachments);

				var selection = new wp.media.model.Selection( attachments.models, {
					props:    attachments.props.toJSON(),
					multiple: true
				});

				console.log('Selection: ', selection);
				selection.gallery = attachments.gallery;

				// Fetch the query's attachments, and then break ties from the
				// query to allow for sorting.
				selection.more().done( function() {
					// Break ties with the query.
					selection.props.set({ query: false });
					selection.unmirror();
					selection.props.unset('orderby');
				});
				
				console.log('Selection props: ', selection.props);
				return selection;
			}
			
			return false;
		}
		
	});



});