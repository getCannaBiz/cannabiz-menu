(function( $ ) {
	"use strict";

	/**
	 * All of the code for your admin-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

})( jQuery );

jQuery(document).ready(function($) {
	$( '#wpdispensary_prices' ).hide();
	$( '#wpdispensary_concentrateprices' ).hide();
	$( '#wpdispensary_singleprices' ).hide();
	$( '#wpdispensary_topicalprices' ).hide();
	$( '#wpdispensary_heavyweight_prices' ).hide();
	$( '#wpdispensary_grower_product_details' ).hide();
	$( '#wpdispensary_thc_cbd_mg' ).hide();
	$( '#wpdispensary_thccbdtopical' ).hide();
	$( '#wpdispensary_clonedetails' ).hide();
	$( '#wpdispensary_preroll_weight' ).hide();
	$( '#wpdispensary_compounds' ).hide();
	$( '#wpd_tinctures_details' ).hide();

	// Flowers product type.
	if($(this).val() == 'Flowers') {
		console.log( 'Flowers has been selected' );
		$( '#wpdispensary_prices' ).show();
		$( '#wpdispensary_heavyweight_prices' ).show();
		$( '#wpdispensary_compounds' ).show();
	}
	// Edibles product type.
	if($(this).val() == 'Edibles') {
		console.log( 'Edibles has been selected' );
		$( '#wpdispensary_singleprices' ).show();
		$( '#wpdispensary_thc_cbd_mg' ).show();
	}
	// Concentrates product type.
	if($(this).val() == 'Concentrates') {
		console.log( 'Concentrates has been selected' );
		$( '#wpdispensary_concentrateprices' ).show();
		$( '#wpdispensary_heavyweight_prices' ).show();
		$( '#wpdispensary_compounds' ).show();
	}
	// Pre-rolls product type.
	if($(this).val() == 'Pre-rolls') {
		console.log( 'Pre-rolls has been selected' );
		$( '#wpdispensary_singleprices' ).show();
		$( '#wpdispensary_preroll_weight' ).show();
		$( '#wpdispensary_compounds' ).show();
	}
	// Topicals product type.
	if($(this).val() == 'Topicals'){
		console.log( 'Topicals has been selected' );
		$( '#wpdispensary_topicalprices' ).show();
		$( '#wpdispensary_thccbdtopical' ).show();
	}
	// Growers product type.
	if($(this).val() == 'Growers'){
		console.log( 'Growers has been selected' );
		$( '#wpdispensary_singleprices' ).show();
		$( '#wpdispensary_growers_product_details' ).show();
		$( '#wpdispensary_clonedetails' ).show();
	}
	// Tinctures product type.
	if($(this).val() == 'Tinctures'){
		console.log( 'Tinctures has been selected' );
		$( '#wpdispensary_singleprices' ).show();
		$( '#wpd_tinctures_details' ).show();
	}
	// Gear product type.
	if($(this).val() == 'Gear'){
		console.log( 'Gear has been selected' );
		$( '#wpdispensary_singleprices' ).show();
	}

	$('#product_type').change(function() {
		$( '#wpdispensary_prices' ).hide();
		$( '#wpdispensary_concentrateprices' ).hide();
		$( '#wpdispensary_singleprices' ).hide();
		$( '#wpdispensary_topicalprices' ).hide();
		$( '#wpdispensary_heavyweight_prices' ).hide();
		$( '#wpdispensary_grower_product_details' ).hide();
		$( '#wpdispensary_thc_cbd_mg' ).hide();
		$( '#wpdispensary_thccbdtopical' ).hide();
		$( '#wpdispensary_clonedetails' ).hide();
		$( '#wpdispensary_preroll_weight' ).hide();
		$( '#wpdispensary_compounds' ).hide();
		$( '#wpd_tinctures_details' ).hide();

		// Flowers product type.
		if($(this).val() == 'Flowers') {
			console.log( 'Flowers has been selected' );
			$( '#wpdispensary_prices' ).show();
			$( '#wpdispensary_heavyweight_prices' ).show();
			$( '#wpdispensary_compounds' ).show();
		}
		// Edibles product type.
		if($(this).val() == 'Edibles') {
			console.log( 'Edibles has been selected' );
			$( '#wpdispensary_singleprices' ).show();
			$( '#wpdispensary_thc_cbd_mg' ).show();
		}
		// Concentrates product type.
		if($(this).val() == 'Concentrates') {
			console.log( 'Concentrates has been selected' );
			$( '#wpdispensary_concentrateprices' ).show();
			$( '#wpdispensary_heavyweight_prices' ).show();
			$( '#wpdispensary_compounds' ).show();
		}
		// Pre-rolls product type.
		if($(this).val() == 'Pre-rolls') {
			console.log( 'Pre-rolls has been selected' );
			$( '#wpdispensary_singleprices' ).show();
			$( '#wpdispensary_preroll_weight' ).show();
			$( '#wpdispensary_compounds' ).show();
		}
		// Topicals product type.
		if($(this).val() == 'Topicals') {
			console.log( 'Topicals has been selected' );
			$( '#wpdispensary_topicalprices' ).show();
			$( '#wpdispensary_thccbdtopical' ).show();
		}
		// Growers product type.
		if($(this).val() == 'Growers') {
			console.log( 'Growers has been selected' );
			$( '#wpdispensary_singleprices' ).show();
			$( '#wpdispensary_growers_product_details' ).show();
			$( '#wpdispensary_clonedetails' ).show();
		}
		// Tinctures product type.
		if($(this).val() == 'Tinctures') {
			console.log( 'Tinctures has been selected' );
			$( '#wpdispensary_singleprices' ).show();
			$( '#wpd_tinctures_details' ).show();
		}
		// Gear product type.
		if($(this).val() == 'Gear') {
			console.log( 'Gear has been selected' );
			$( '#wpdispensary_singleprices' ).show();
		}
	});
});