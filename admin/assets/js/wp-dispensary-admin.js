jQuery(document).ready(function($) {

	// Hide these metaboxes by default.
	$( "#wp_dispensary_product_details" ).hide();
	$( "#wp_dispensary_product_details .inside div.edibles-fields" ).hide();
	$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field" ).hide();
	$( "#wp_dispensary_product_details .inside div.prerolls-fields" ).hide();
	$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field" ).hide();
	$( "#wp_dispensary_product_details .inside div.topicals-fields" ).hide();
	$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field" ).hide();
	$( "#wp_dispensary_product_details .inside div.growers-fields" ).hide();
	$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field" ).hide();
	$( "#wp_dispensary_product_details .inside div.tinctures-fields" ).hide();
	$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field" ).hide();
	$( "#wp_dispensary_grower_details" ).hide();
	$( "#wp_dispensary_compound_details" ).hide();
	$( "#wp_dispensary_product_prices .inside div.input-field" ).hide();
	$( "#wp_dispensary_product_prices .inside div.input-field input" ).prop('disabled', true);
	$( "#wp_dispensary_inventory_flowers" ).hide();
	$( "#wp_dispensary_inventory_concentrates" ).hide();
	$( "#wp_dispensary_inventory_edibles" ).hide();
	$( "#wp_dispensary_inventory_prerolls" ).hide();
	$( "#wp_dispensary_inventory_topicals" ).hide();
	$( "#wp_dispensary_inventory_growers" ).hide();
	$( "#wp_dispensary_inventory_tinctures" ).hide();
	$( "#wp_dispensary_inventory_gear" ).hide();

	// Flowers product type.
	if($("#product_type").val() == "flowers" ) {
		$( "#wp_dispensary_compound_details" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.flower-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.flower-price input" ).prop('disabled', false);
		$( "#wp_dispensary_inventory_flowers" ).show();
	}
	// Edibles product type.
	if($("#product_type").val() == "edibles" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
		$( "#wp_dispensary_inventory_edibles" ).show();
	}
	// Concentrates product type.
	if($("#product_type").val() == "concentrates" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price input" ).prop('disabled', false);
		$( "#wp_dispensary_compound_details" ).show();
		$( "#wp_dispensary_inventory_concentrates" ).show();
	}
	// Pre-rolls product type.
	if($("#product_type").val() == "prerolls" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.preroll-fields div.input-field" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_inventory_prerolls" ).show();
	}
	// Topicals product type.
	if($("#product_type").val() == "topicals" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_inventory_topicals" ).show();
	}
	// Growers product type.
	if($("#product_type").val() == "growers" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
		$( "#wp_dispensary_grower_details" ).show();
		$( "#wp_dispensary_clone_details" ).show();
		$( "#wp_dispensary_inventory_growers" ).show();
	}
	// Tinctures product type.
	if($("#product_type").val() == "tinctures" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
		$( "#wpd_tinctures_details" ).show();
		$( "#wp_dispensary_inventory_tinctures" ).show();
	}
	// Gear product type.
	if($("#product_type").val() == "gear" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
		$( "#wp_dispensary_inventory_gear" ).show();
	}

	$('#product_type').change(function() {
		$( "#wp_dispensary_product_details" ).hide();
		$( "#wp_dispensary_product_details .inside div.edibles-fields" ).hide();
		$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field" ).hide();
		$( "#wp_dispensary_product_details .inside div.prerolls-fields" ).hide();
		$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field" ).hide();
		$( "#wp_dispensary_product_details .inside div.topicals-fields" ).hide();
		$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field" ).hide();
		$( "#wp_dispensary_product_details .inside div.growers-fields" ).hide();
		$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field" ).hide();
		$( "#wp_dispensary_product_details .inside div.tinctures-fields" ).hide();
		$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field" ).hide();
		$( "#wp_dispensary_grower_details" ).hide();
		$( "#wp_dispensary_compound_details" ).hide();
		$( "#wp_dispensary_product_prices .inside div.input-field" ).hide();
		$( "#wp_dispensary_product_prices .inside div.input-field input" ).prop('disabled', true);
		$( "#wp_dispensary_inventory_flowers" ).hide();
		$( "#wp_dispensary_inventory_concentrates" ).hide();
		$( "#wp_dispensary_inventory_edibles" ).hide();
		$( "#wp_dispensary_inventory_prerolls" ).hide();
		$( "#wp_dispensary_inventory_topicals" ).hide();
		$( "#wp_dispensary_inventory_growers" ).hide();
		$( "#wp_dispensary_inventory_tinctures" ).hide();
		$( "#wp_dispensary_inventory_gear" ).hide();

		// Flowers product type.
		if($(this).val() == 'flowers') {
			console.log( 'Flowers has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.flower-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.flower-price input" ).prop('disabled', false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_flowers" ).show();
		}
		// Concentrates product type.
		if($(this).val() == 'concentrates') {
			console.log( 'Concentrates has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price input" ).prop('disabled', false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_concentrates" ).show();
		}
		// Edibles product type.
		if($(this).val() == 'edibles') {
			console.log( 'Edibles has been selected' );
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.edibles-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_edibles" ).show();
		}
		// Pre-rolls product type.
		if($(this).val() == 'prerolls') {
			console.log( 'Pre-rolls has been selected' );
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.prerolls-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_prerolls" ).show();
		}
		// Topicals product type.
		if($(this).val() == 'topicals') {
			console.log( 'Topicals has been selected' );
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.topicals-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
			$( "#wp_dispensary_inventory_details" ).show();
		}
		// Growers product type.
		if($(this).val() == 'growers') {
			console.log( 'Growers has been selected' );
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.growers-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
			$( "#wp_dispensary_grower_details" ).show();
			$( "#wp_dispensary_inventory_growers" ).show();
		}
		// Tinctures product type.
		if($(this).val() == 'tinctures') {
			console.log( 'Tinctures has been selected' );
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.tinctures-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_inventory_tinctures" ).show();
		}
		// Gear product type.
		if($(this).val() == 'gear') {
			console.log( 'Gear has been selected' );
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop('disabled', false);
			$( "#wp_dispensary_inventory_gear" ).show();
		}
	});
});