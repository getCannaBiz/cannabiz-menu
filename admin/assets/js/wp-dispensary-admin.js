jQuery(document).ready(function($) {

	// Hide these metaboxes by default.
	$( "#wp_dispensary_product_details" ).hide();
	$( "#wp_dispensary_product_details .inside div.flowers-fields" ).hide();
	$( "#wp_dispensary_product_details .inside div.flowers-fields div.input-field" ).hide();
	$( "#wp_dispensary_product_details .inside div.concentrates-fields" ).hide();
	$( "#wp_dispensary_product_details .inside div.concentrates-fields div.input-field" ).hide();
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
	$( "#wp_dispensary_product_details .inside div.input-field input" ).prop("disabled", true);
	$( "#wp_dispensary_grower_details" ).hide();
	$( "#wp_dispensary_compound_details" ).hide();
	$( "#wp_dispensary_product_prices .inside div.input-field" ).hide();
	$( "#wp_dispensary_product_prices .inside div.input-field input" ).prop("disabled", true);
	$( "#wp_dispensary_inventory_management .wpd-inventory.grams" ).hide();
	$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).hide();
	$( "#wp_dispensary_inventory_management .wpd-inventory.growers" ).hide();

	// Flowers product type.
	if($("#product_type").val() == "flowers" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.flowers-fields" ).show();
		$( "#wp_dispensary_product_details .inside div.flowers-fields div.input-field" ).show();
		$( "#wp_dispensary_product_details .inside div.flowers-fields div.input-field input" ).prop("disabled", false);
		$( "#wp_dispensary_compound_details" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.flower-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.flower-price input" ).prop("disabled", false);
		$( "#wp_dispensary_inventory_management .wpd-inventory.grams" ).show();
	}
	// Edibles product type.
	if($("#product_type").val() == "edibles" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.edibles-fields" ).show();
		$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field" ).show();
		$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field input" ).prop("disabled", false);
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
		$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
	}
	// Concentrates product type.
	if($("#product_type").val() == "concentrates" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.concentrates-fields" ).show();
		$( "#wp_dispensary_product_details .inside div.concentrates-fields div.input-field" ).show();
		$( "#wp_dispensary_product_details .inside div.concentrates-fields div.input-field input" ).show();
		$( "#wp_dispensary_product_details .inside div.concentrates-fields div.input-field input" ).prop("disabled", false);
		$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price input" ).prop("disabled", false);
		$( "#wp_dispensary_compound_details" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.grams" ).show();
	}
	// Pre-rolls product type.
	if($("#product_type").val() === "prerolls" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.prerolls-fields" ).show();
		$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field" ).show();
		$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field input" ).show();
		$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field input" ).prop("disabled", false);
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
	}
	// Topicals product type.
	if($("#product_type").val() === "topicals" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.topicals-fields" ).show();
		$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field" ).show();
		$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field input" ).show();
		$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field input" ).prop("disabled", false);
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
	}
	// Growers product type.
	if($("#product_type").val() === "growers" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.growers-fields" ).show();
		$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field" ).show();
		$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field input" ).prop("disabled", false);
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
		$( "#wp_dispensary_grower_details" ).show();
		$( "#wp_dispensary_clone_details" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.growers" ).show();
	}
	// Tinctures product type.
	if($("#product_type").val() === "tinctures" ) {
		$( "#wp_dispensary_product_details" ).show();
		$( "#wp_dispensary_product_details .inside div.tinctures-fields" ).show();
		$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field" ).show();
		$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field input" ).prop("disabled", false);
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
		$( "#wpd_tinctures_details" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
	}
	// Gear product type.
	if($("#product_type").val() === "gear" ) {
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
		$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
		$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
	}

	$('#product_type').change(function() {
		$( "#wp_dispensary_product_details" ).hide();
		$( "#wp_dispensary_product_details .inside div.flowers-fields" ).hide();
		$( "#wp_dispensary_product_details .inside div.flowers-fields div.input-field" ).hide();
		$( "#wp_dispensary_product_details .inside div.concentrates-fields" ).hide();
		$( "#wp_dispensary_product_details .inside div.concentrates-fields div.input-field" ).hide();
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
		$( "#wp_dispensary_product_details .inside div.input-field input" ).prop("disabled", true);
		$( "#wp_dispensary_grower_details" ).hide();
		$( "#wp_dispensary_compound_details" ).hide();
		$( "#wp_dispensary_product_prices .inside div.input-field" ).hide();
		$( "#wp_dispensary_product_prices .inside div.input-field input" ).prop("disabled", true);
		$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.grams" ).show();
		$( "#wp_dispensary_inventory_management .wpd-inventory.growers" ).show();

		// Flowers product type.
		if($(this).val() === 'flowers') {
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.flowers-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.flowers-fields div.input-field" ).show();
			$( "#wp_dispensary_product_details .inside div.flowers-fields div.input-field input" ).prop("disabled", false);
			$( "#wp_dispensary_product_prices .inside div.input-field.flower-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.flower-price input" ).prop("disabled", false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_management .wpd-inventory.grams" ).show();
		}
		// Concentrates product type.
		if($(this).val() === 'concentrates') {
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.concentrates-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.concentrates-fields div.input-field" ).show();
			$( "#wp_dispensary_product_details .inside div.concentrates-fields div.input-field input" ).prop("disabled", false);
			$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.concentrates-price input" ).prop("disabled", false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
			$( "#wp_dispensary_inventory_management .wpd-inventory.grams" ).show();
		}
		// Edibles product type.
		if($(this).val() === 'edibles') {
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.edibles-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field" ).show();
			$( "#wp_dispensary_product_details .inside div.edibles-fields div.input-field input" ).prop("disabled", false);
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_edibles" ).show();
			$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
		}
		// Pre-rolls product type.
		if($(this).val() === 'prerolls') {
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.prerolls-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field" ).show();
			$( "#wp_dispensary_product_details .inside div.prerolls-fields div.input-field input" ).prop("disabled", false);
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
			$( "#wp_dispensary_compound_details" ).show();
			$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
		}
		// Topicals product type.
		if($(this).val() === 'topicals') {
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.topicals-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field" ).show();
			$( "#wp_dispensary_product_details .inside div.topicals-fields div.input-field input" ).prop("disabled", false);
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
			$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
		}
		// Growers product type.
		if($(this).val() === 'growers') {
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.growers-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field" ).show();
			$( "#wp_dispensary_product_details .inside div.growers-fields div.input-field input" ).prop("disabled", false);
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
			$( "#wp_dispensary_grower_details" ).show();
			$( "#wp_dispensary_inventory_management .wpd-inventory.growers" ).show();
		}
		// Tinctures product type.
		if($(this).val() === 'tinctures') {
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_product_details .inside div.tinctures-fields" ).show();
			$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field" ).show();
			$( "#wp_dispensary_product_details .inside div.tinctures-fields div.input-field input" ).prop("disabled", false);
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
			$( "#wp_dispensary_product_details" ).show();
			$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
		}
		// Gear product type.
		if($(this).val() === 'gear') {
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price" ).show();
			$( "#wp_dispensary_product_prices .inside div.input-field.product-price input" ).prop("disabled", false);
			$( "#wp_dispensary_inventory_management .wpd-inventory.units" ).show();
		}
	});
});