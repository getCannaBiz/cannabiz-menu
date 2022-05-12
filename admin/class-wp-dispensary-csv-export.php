<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     WP Dispensary <contact@wpdispensary.com>
 */
class WP_Dispensary_CSV_Export {
	/**
	* Constructor
	*/
	public function __construct() {
		if ( null !== filter_input( INPUT_GET, 'export_products' ) ) {

			// Run generate CSV function.
			$csv = $this->generate_csv();

			header( "Pragma: public" );
			header( "Expires: 0" );
			header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
			header( "Cache-Control: private", false );
			header( "Content-Type: application/octet-stream" );
			header( "Content-Disposition: attachment; filename=\"wp-dispensary-products.csv\";" );
			header( "Content-Transfer-Encoding: binary" );

			echo $csv;
			wp_die();
		}

		// Create end-points.
		add_filter( 'query_vars', array( $this, 'query_vars' ) );
		add_action( 'parse_request', array( $this, 'parse_request' ) );
	}

	/**
	* Allow for custom query variables
	*/
	public function query_vars( $query_vars ) {
		$query_vars[] = 'export_products';
		return $query_vars;
	}

	/**
	 * Parse the request
	 */
	public function parse_request( &$wp ) {
		if ( array_key_exists( 'export_products', $wp->query_vars ) ) {
			$this->export_products();
			wp_die();
		}
	}

	/**
	 * Export WP Dispensary products
	 */
	public function export_products() {
		$wrap = '<div class="wrap">';
		$wrap .= '<h2>' . esc_html__( 'WP Dispensary\'s Product Export', 'wp-dispensary' ) . '</h2>';
		$wrap .= '<p>' . esc_html__( 'Export your WP Dispensary products as a CSV file by clicking the button below.', 'wp-dispensary' ) . '</p>';
		$wrap .= '<p><a class="button" href="admin.php?page=export_products&export_products&_wpnonce=' . wp_create_nonce( 'download_csv' ) . '">' . esc_html__( 'Export', 'wp-dispensary' ) . '</a></p>';
		echo wp_kses( $wrap, wp_kses_allowed_html( 'post' ) );
	}

	/**
	 * Converting data to CSV
	 */
	public function generate_csv() {
		ob_start();

		$domain = 'domain';

		if ( null !== filter_input( INPUT_POST, 'SERVER_NAME' ) ) {
			$domain = filter_input( INPUT_POST, 'SERVER_NAME' );
		}

		// Create file name.
		$file_name = 'wpd-products-' . $domain . '-' . time() . '.csv';

		// Set the headers.
		$header_row = array(
			esc_html__( 'ID', 'wp-dispensary' ),
			esc_html__( 'Type', 'wp-dispensary' ),
			esc_html__( 'Title', 'wp-dispensary' ),
			esc_html__( 'Content', 'wp-dispensary' ),
			esc_html__( 'Slug', 'wp-dispensary' ),
			esc_html__( 'Date', 'wp-dispensary' ),
			esc_html__( 'Author', 'wp-dispensary' ),
			esc_html__( 'Prices', 'wp-dispensary' ),
			esc_html__( 'Inventory', 'wp-dispensary' ),
			esc_html__( 'Categories', 'wp-dispensary' ),
			esc_html__( 'Vendors', 'wp-dispensary' ),
			esc_html__( 'Shelf type', 'wp-dispensary' ),
			esc_html__( 'Strain type', 'wp-dispensary' ),
			esc_html__( 'Allergens', 'wp-dispensary' ),
			esc_html__( 'Aromas', 'wp-dispensary' ),
			esc_html__( 'Conditions', 'wp-dispensary' ),
			esc_html__( 'Effects', 'wp-dispensary' ),
			esc_html__( 'Flavors', 'wp-dispensary' ),
			esc_html__( 'Ingredients', 'wp-dispensary' ),
			esc_html__( 'Symptoms', 'wp-dispensary' ),
			esc_html__( 'Featured image', 'wp-dispensary' )
		);

		// Filter headers.
		$header_row = apply_filters( 'wpd_csv_export_header_row', $header_row );

		// Data rows.
		$data_rows = array();

		global $wpdb;

		$sql      = 'SELECT * FROM ' . $wpdb->posts . ' AS P WHERE P.post_type IN ( "products" ) and P.post_status = "publish"';
		$products = $wpdb->get_results( $sql, 'ARRAY_A' );

		// Set the rows (matches headers).
		foreach ( $products as $product ) {

			// Cat ID.
			$cat_id = array();

			// Category name.
			$category_name = wp_get_post_terms( $product['ID'], 'wpd_categories', array( 'fields' => 'names' ) );

			// Category ID's.
			if ( $category_name && ! is_wp_error( $category_name ) ) {
				foreach ( $category_name as $cat=>$value ) {
					$cat_id[] = $value;
				}
			}

			// Empty category ID's.
			$category_ids = '';

			// Get category ID's.
			if ( ! empty( $cat_id ) ) {
				$category_ids = json_encode( $cat_id, JSON_FORCE_OBJECT );
			}

			// Vendors ID.
			$vendors_id = array();

			// Vendors name.
			$vendors_name = wp_get_post_terms( $product['ID'], 'vendors', array( 'fields' => 'names' ) );

			// Vendors ID's.
			if ( $vendors_name && ! is_wp_error( $vendors_name ) ) {
				foreach ( $vendors_name as $cat=>$value ) {
					$vendors_id[] = $value;
				}
			}

			// Empty vendors ID's.
			$vendors_ids = '';

			// Get vendors ID's.
			if ( ! empty( $vendors_id ) ) {
				$vendors_ids = json_encode( $vendors_id, JSON_FORCE_OBJECT );
			}

			// Shelf Type ID.
			$shelf_types_id = array();

			// Shelf Type name.
			$shelf_types_name = wp_get_post_terms( $product['ID'], 'shelf_types', array( 'fields' => 'names' ) );

			// Shelf Type ID's.
			if ( $shelf_types_name && ! is_wp_error( $shelf_types_name ) ) {
				foreach ( $shelf_types_name as $cat=>$value ) {
					$shelf_types_id[] = $value;
				}
			}

			// Empty shelf type ID's.
			$shelf_types_ids = '';

			// Get shelf type ID's.
			if ( ! empty( $shelf_types_id ) ) {
				$shelf_types_ids = json_encode( $shelf_types_id, JSON_FORCE_OBJECT );
			}

			// Strain Type ID.
			$strain_types_id = array();

			// Strain Type name.
			$strain_types_name = wp_get_post_terms( $product['ID'], 'strain_types', array( 'fields' => 'names' ) );

			// Strain Type ID's.
			if ( $strain_types_name && ! is_wp_error( $strain_types_name ) ) {
				foreach ( $strain_types_name as $cat=>$value ) {
					$strain_types_id[] = $value;
				}
			}

			// Empty strain type ID's.
			$strain_types_ids = '';

			// Get strain type ID's.
			if ( ! empty( $strain_types_id ) ) {
				$strain_types_ids = json_encode( $strain_types_id, JSON_FORCE_OBJECT );
			}

			// Allergens ID.
			$allergens_id = array();

			// Allergens name.
			$allergens_name = wp_get_post_terms( $product['ID'], 'allergens', array( 'fields' => 'names' ) );

			// Allergens ID's.
			if ( $allergens_name && ! is_wp_error( $allergens_name ) ) {
				foreach ( $allergens_name as $cat=>$value ) {
					$allergens_id[] = $value;
				}
			}

			// Empty allergens ID's.
			$allergens_ids = '';

			// Get allergens ID's.
			if ( ! empty( $allergens_id ) ) {
				$allergens_ids = json_encode( $allergens_id, JSON_FORCE_OBJECT );
			}

			// Aromas ID.
			$aromas_id = array();

			// Aromas name.
			$aromas_name = wp_get_post_terms( $product['ID'], 'aromas', array( 'fields' => 'names' ) );

			// Aromas ID's.
			if ( $aromas_name && ! is_wp_error( $aromas_name ) ) {
				foreach ( $aromas_name as $cat=>$value ) {
					$aromas_id[] = $value;
				}
			}

			// Empty aromas ID's.
			$aromas_ids = '';

			// Get aromas ID's.
			if ( ! empty( $aromas_id ) ) {
				$aromas_ids = json_encode( $aromas_id, JSON_FORCE_OBJECT );
			}

			// Conditions ID.
			$conditions_id = array();

			// Conditions name.
			$conditions_name = wp_get_post_terms( $product['ID'], 'conditions', array( 'fields' => 'names' ) );

			// Conditions ID's.
			if ( $conditions_name && ! is_wp_error( $conditions_name ) ) {
				foreach ( $conditions_name as $cat=>$value ) {
					$conditions_id[] = $value;
				}
			}

			// Empty conditions ID's.
			$conditions_ids = '';

			// Get conditions ID's.
			if ( ! empty( $conditions_id ) ) {
				$conditions_ids = json_encode( $conditions_id, JSON_FORCE_OBJECT );
			}

			// Effects ID.
			$effects_id = array();

			// Effects name.
			$effects_name = wp_get_post_terms( $product['ID'], 'effects', array( 'fields' => 'names' ) );

			// Effects ID's.
			if ( $effects_name && ! is_wp_error( $effects_name ) ) {
				foreach ( $effects_name as $cat=>$value ) {
					$effects_id[] = $value;
				}
			}

			// Empty effects ID's.
			$effects_ids = '';

			// Get effects ID's.
			if ( ! empty( $effects_id ) ) {
				$effects_ids = json_encode( $effects_id, JSON_FORCE_OBJECT );
			}

			// Flavors ID.
			$flavors_id = array();

			// Flavors name.
			$flavors_name = wp_get_post_terms( $product['ID'], 'flavors', array( 'fields' => 'names' ) );

			// Flavors ID's.
			if ( $flavors_name && ! is_wp_error( $flavors_name ) ) {
				foreach ( $flavors_name as $cat=>$value ) {
					$flavors_id[] = $value;
				}
			}

			// Empty flavors ID's.
			$flavors_ids = '';

			// Get flavors ID's.
			if ( ! empty( $flavors_id ) ) {
				$flavors_ids = json_encode( $flavors_id, JSON_FORCE_OBJECT );
			}

			// Ingredients ID.
			$ingredients_id = array();

			// Ingredients name.
			$ingredients_name = wp_get_post_terms( $product['ID'], 'ingredients', array( 'fields' => 'names' ) );

			// Ingredients ID's.
			if ( $ingredients_name && ! is_wp_error( $ingredients_name ) ) {
				foreach ( $ingredients_name as $cat=>$value ) {
					$ingredients_id[] = $value;
				}
			}

			// Empty ingredients ID's.
			$ingredients_ids = '';

			// Get ingredients ID's.
			if ( ! empty( $ingredients_id ) ) {
				$ingredients_ids = json_encode( $ingredients_id, JSON_FORCE_OBJECT );
			}

			// Symptoms ID.
			$symptoms_id = array();

			// Symptoms name.
			$symptoms_name = wp_get_post_terms( $product['ID'], 'symptoms', array( 'fields' => 'names' ) );

			// Symptoms ID's.
			if ( $symptoms_name && ! is_wp_error( $symptoms_name ) ) {
				foreach ( $symptoms_name as $cat=>$value ) {
					$symptoms_id[] = $value;
				}
			}

			// Empty symptoms ID's.
			$symptoms_ids = '';

			// Get symptoms ID's.
			if ( ! empty( $symptoms_id ) ) {
				$symptoms_ids = json_encode( $symptoms_id, JSON_FORCE_OBJECT );
			}

			// Flowers data.
			if ( 'flowers' == get_post_meta( $product['ID'], 'product_type', true ) ) {
				if ( get_post_meta( $product['ID'], 'inventory_grams', TRUE ) ) {
					$inventory_amount = get_post_meta( $product['ID'], 'inventory_grams', TRUE );
					$inventory_type   = 'grams';
				} else {
					$inventory_amount = get_post_meta( $product['ID'], 'inventory_units', TRUE );
					$inventory_type   = 'units';
				}
			}

			// Concentrates data.
			if ( 'concentrates' == get_post_meta( $product['ID'], 'product_type', true ) ) {
				if ( get_post_meta( $product['ID'], 'inventory_grams', TRUE ) ) {
					$inventory_amount = get_post_meta( $product['ID'], 'inventory_grams', TRUE );
					$inventory_type   = 'grams';
				} else {
					$inventory_amount = get_post_meta( $product['ID'], 'inventory_units', TRUE );
					$inventory_type   = 'units';
				}
			}

			// Additional types.
			$types = array(
				'edibles',
				'prerolls',
				'topicals',
				'growers',
				'gear',
				'tinctures'
			);

			// Loop through types.
			foreach ( $types as $type ) {
				// Additional data.
				if ( $type == get_post_meta( $product['ID'], 'product_type', true ) ) {
					$inventory_amount = get_post_meta( $product['ID'], 'inventory_units', TRUE );
					$inventory_type   = 'units';
				}
			}

			// Create array.
			$inventory = array(
				'type'   => $inventory_type,
				'amount' => $inventory_amount,
			);

			// Create array.
			$prices_by_weight = array();

			// Flower prices.
			$flower_prices = wpd_product_prices( 'flowers' );

			// Concentrates prices.
			$concentrates_prices = wpd_product_prices( 'concentrates' );

			// Prices by weight.
			$weight_prices = array_merge( $flower_prices, $concentrates_prices );

			// Loop through flower prices.
			foreach ( $weight_prices as $key=>$value ) {
				// Add item to array.
				$prices_by_weight[$value] = get_post_meta( $product['ID'], $key, true );
			}

			// Create row.
			$row = array(
				$product['ID'],
				get_post_meta( $product['ID'], 'product_type', true ),
				$product['post_title'],
				$product['post_content'],
				$product['post_name'],
				$product['post_date'],
				$product['post_author'],
				json_encode( $prices_by_weight, JSON_FORCE_OBJECT ),
				json_encode( $inventory, JSON_FORCE_OBJECT ),
				$category_ids,
				$vendors_ids,
				$shelf_types_ids,
				$strain_types_ids,
				$allergens_ids,
				$aromas_ids,
				$conditions_ids,
				$effects_ids,
				$flavors_ids,
				$ingredients_ids,
				$symptoms_ids,
				get_the_post_thumbnail_url( $product['ID'] ),
			);
			$data_rows[] = apply_filters( 'wpd_csv_export_data_row', $row, $product );
		}

		$fh = @fopen( 'php://output', 'w' );

		fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );

		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		header( 'Content-Description: File Transfer' );
		header( 'Content-type: text/csv' );
		header( "Content-Disposition: attachment; filename={$file_name}" );
		header( 'Expires: 0' );
		header( 'Pragma: public' );

		fputcsv( $fh, $header_row );

		foreach ( $data_rows as $data_row ) {
			fputcsv( $fh, $data_row );
		}

		fclose( $fh );

		ob_end_flush();

		wp_die();
	}
}

/**
 * Initialize the CSV Export class
 * 
 * @since  4.0
 * @return void
 */
function wpd_csv_export() {
	// Instantiate a singleton of this plugin.
	$csvExport = new WP_Dispensary_CSV_Export();
}
add_action( 'init', 'wpd_csv_export' );
