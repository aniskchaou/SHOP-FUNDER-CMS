jQuery( function ( $ ) {

	// Only show the "remove image" button when needed
	if ( ! $('#product_brand_thumbnail_id').val() ) {
		$('.mas_wc_br_remove_image_button').hide();
	}

	// Uploading files
	var file_frame;

	$(document).on( 'click', '.mas_wc_br_upload_image_button', function( event ){

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.downloadable_file = wp.media({
			title: mas_wc_brands_admin_options.media_title,
			button: {
				text: mas_wc_brands_admin_options.media_btn_text
			},
			multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();

			$('#product_brand_thumbnail_id').val( attachment.id );
			$('#product_brand_thumbnail img').attr('src', attachment.url );
			$('.mas_wc_br_remove_image_button').show();
		});

		// Finally, open the modal.
		file_frame.open();
	});

	$(document).on( 'click', '.mas_wc_br_remove_image_button', function( event ){
		$('#product_brand_thumbnail img').attr('src', mas_wc_brands_admin_options.placeholder_img_src);
		$('#product_brand_thumbnail_id').val('');
		$('.mas_wc_br_remove_image_button').hide();
		return false;
	});

	$('#addtag #submit').on( 'click', function() {

		// Look for a div WordPress produces for an invalid form element
		if ( ! $( '#addtag .form-invalid' ).length ) {
			// hide elements and reset hidden field
			$('#product_brand_thumbnail img').attr('src', mas_wc_brands_admin_options.placeholder_img_src);
			$('#product_brand_thumbnail_id').val('');
			$('.mas_wc_br_remove_image_button').hide();
		}
	
	});

});