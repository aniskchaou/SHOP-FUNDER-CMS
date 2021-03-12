(function($){

	$( document ).ajaxComplete(function( event, xhr, settings ) {
		$( '[data-vc-shortcode-param-name="shortcode_tag"] select' ).on( 'change', function() {
			
			var selected_value = $(this).val(),
				$form = $(this).parents( '.vc_edit_form_elements' );

			$form.find( '[data-vc-shortcode-param-name="products_choice"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="product_id"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="category"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="cat_operator"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="attribute"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="terms"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="terms_operator"]' ).hide();
			switch( selected_value ) {
				case 'products':
					$form.find( '[data-vc-shortcode-param-name="products_choice"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="product_id"]' ).show();
					break;
				case 'product_category':
					$form.find( '[data-vc-shortcode-param-name="category"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="cat_operator"]' ).show();
					break;
				case 'product_attribute':
					$form.find( '[data-vc-shortcode-param-name="attribute"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="terms"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="terms_operator"]' ).show();
					break;
				default:
					break;
			}
		}).change();

		$( '[data-vc-shortcode-param-name="tabs_shortcode_tag"] select' ).on( 'change', function() {
			
			var selected_value = $(this).val(),
				$form = $(this).parents( '.vc_param_group-wrapper' );

			$form.find( '[data-vc-shortcode-param-name="tabs_products_choice"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="tabs_product_id"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="tabs_category"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="tabs_cat_operator"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="tabs_attribute"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="tabs_terms"]' ).hide();
			$form.find( '[data-vc-shortcode-param-name="tabs_terms_operator"]' ).hide();
			switch( selected_value ) {
				case 'products':
					$form.find( '[data-vc-shortcode-param-name="tabs_products_choice"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="tabs_product_id"]' ).show();
					break;
				case 'product_category':
					$form.find( '[data-vc-shortcode-param-name="tabs_category"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="tabs_cat_operator"]' ).show();
					break;
				case 'product_attribute':
					$form.find( '[data-vc-shortcode-param-name="tabs_attribute"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="tabs_terms"]' ).show();
					$form.find( '[data-vc-shortcode-param-name="tabs_terms_operator"]' ).show();
					break;
				default:
					break;
			}
		}).change();
	});

})(jQuery);