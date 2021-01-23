jQuery(document).ready(function($) {

	var productType = wpd_script_vars.product_type;

	// Hide these metaboxes by default.
	$( "#wp_dispensary_product_details" ).hide();
	$( "#wp_dispensary_grower_details" ).hide();
	$( "#wp_dispensary_compound_details" ).hide();
	$( "#wp_dispensary_product_prices .inside div.input-field" ).hide();

	// Flowers product type.
	if($("#product_type").val() == "flowers" || productType == "flowers" ) {
		$( "#wp_dispensary_compound_details" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.flower-price" ).show();
	}
	// Edibles product type.
	if($("#product_type").val() == "edibles" || productType == "edibles" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
	}
	// Concentrates product type.
	if($("#product_type").val() == "concentrates" || productType == "concentrates" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price" ).show();
		$( "#wp_dispensary_compound_details" ).show();
	}
	// Pre-rolls product type.
	if($("#product_type").val() == "prerolls" || productType == "prerolls" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_details" ).show();
	}
	// Topicals product type.
	if($("#product_type").val() == "topicals" || productType == "topicals" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_details" ).show();
	}
	// Growers product type.
	if($("#product_type").val() == "growers" || productType == "growers" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_grower_details" ).show();
		$( "#wp_dispensary_clone_details" ).show();
	}
	// Tinctures product type.
	if($("#product_type").val() == "tinctures" || productType == "tinctures" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wpd_tinctures_details" ).show();
	}
	// Gear product type.
	if($("#product_type").val() == "gear" || productType == "gear" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
	}

	$('#product_type').change(function() {
		$( "#wp_dispensary_product_details" ).hide();
		$( "#wp_dispensary_grower_details" ).hide();
		$( "#wp_dispensary_compound_details" ).hide();
		$( "#wp_dispensary_product_prices .inside div.input-field" ).hide();

		// Flowers product type.
		if($(this).val() == 'flowers') {
			console.log( 'Flowers has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.flower-price" ).show();
			$( "#wp_dispensary_compound_details" ).show();
		}
		// Concentrates product type.
		if($(this).val() == 'concentrates') {
			console.log( 'Concentrates has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price" ).show();
			$( "#wp_dispensary_compound_details" ).show();
		}
		// Edibles product type.
		if($(this).val() == 'edibles') {
			console.log( 'Edibles has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_compound_details" ).show();
		}
		// Pre-rolls product type.
		if($(this).val() == 'prerolls') {
			console.log( 'Pre-rolls has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_compound_details" ).show();
		}
		// Topicals product type.
		if($(this).val() == 'topicals') {
			console.log( 'Topicals has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_details" ).show();
		}
		// Growers product type.
		if($(this).val() == 'growers') {
			console.log( 'Growers has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_grower_details" ).show();
		}
		// Tinctures product type.
		if($(this).val() == 'tinctures') {
			console.log( 'Tinctures has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_details" ).show();
		}
		// Gear product type.
		if($(this).val() == 'gear') {
			console.log( 'Gear has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		}
	});
});