<?php
/**
 * The file that defines the metaboxes used by the various custom post types
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

/**
 * Product Type metabox
 *
 * Adds the product type metabox to specific custom post types
 *
 * @since    4.0
 */
function wp_dispensary_add_product_type_meta() {
	add_meta_box(
		'wp_dispensary_product_types',
		esc_html__( 'Product type', 'wp-dispensary' ),
		'wp_dispensary_product_types',
		$screen,
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'wp_dispensary_add_product_type_meta' );

/**
 * Building the metabox
 */
function wp_dispensary_product_types() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="product_type_meta_noncename" id="product_type_meta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the product type data if its already been entered */
	$product_type = get_post_meta( $post->ID, 'product_type', true );

	echo '<div class="wpd-product-type-meta">';
	echo '<select name="product_type" id="product_type">';
	echo '<option value="">--</option>';
	foreach ( wpd_menu_types_simple() as $product_type_name ) {
		// Check if current loop item is the same as the saved product_type.
		if ( $product_type_name == $product_type ) {
			$selected = 'selected';
		} else {
			$selected = '';
		}
		echo '<option ' . $selected . ' value="' . $product_type_name . '">' . $product_type_name . '</option>';
	}
	echo '</select>';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wp_dispensary_save_product_type_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['product_type_meta_noncename' ] ) ||
		! wp_verify_nonce( $_POST['product_type_meta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$product_type_meta['product_type'] = $_POST['product_type'];

	/** Add product type meta as custom fields */

	foreach ( $product_type_meta as $key => $value ) { /** Cycle through the $product_type_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); // If $value is an array, make it a CSV (unlikely)
		if ( get_post_meta( $post->ID, $key, false ) ) { // If the custom field already has a value.
			update_post_meta( $post->ID, $key, $value );
		} else { // If the custom field doesn't have a value.
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wp_dispensary_save_product_type_meta', 1, 2 ); // Save the custom fields.


/**
 * Flower Prices metabox
 *
 * Adds the Prices metabox to specific custom post types
 *
 * @since    1.0.0
 */
function wpdispensary_add_prices_metaboxes() {

	$screens = apply_filters( 'wpd_prices_screens', array( 'products', 'flowers' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_prices',
			esc_html__( 'Product pricing', 'wp-dispensary' ),
			'wpdispensary_prices',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_prices_metaboxes' );

/**
 * WP Dispensary Prices
 */
function wpdispensary_prices() {
	global $post;

	/**
	 * @todo add filters for Heavyweights add-on to use.
	 */

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="pricesmeta_noncename" id="pricesmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the prices data if its already been entered */
	$gram      = get_post_meta( $post->ID, '_gram', true );
	$twograms  = get_post_meta( $post->ID, '_twograms', true );
	$eighth    = get_post_meta( $post->ID, '_eighth', true );
	$fivegrams = get_post_meta( $post->ID, '_fivegrams', true );
	$quarter   = get_post_meta( $post->ID, '_quarter', true );
	$halfounce = get_post_meta( $post->ID, '_halfounce', true );
	$ounce     = get_post_meta( $post->ID, '_ounce', true );

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( '1 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_gram" value="' . esc_html( $gram ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '2 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_twograms" value="' . esc_html( $twograms ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '1/8 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_eighth" value="' . esc_html( $eighth ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '5 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_fivegrams" value="' . esc_html( $fivegrams ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '1/4 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_quarter" value="' . esc_html( $quarter ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '1/2 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_halfounce" value="' . esc_html( $halfounce ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '1 oz', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_ounce" value="' . esc_html( $ounce ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_prices_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['pricesmeta_noncename' ] ) ||
		! wp_verify_nonce( $_POST['pricesmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$prices_meta['_gram']      = esc_html( $_POST['_gram'] );
	$prices_meta['_twograms']  = esc_html( $_POST['_twograms'] );
	$prices_meta['_eighth']    = esc_html( $_POST['_eighth'] );
	$prices_meta['_fivegrams'] = esc_html( $_POST['_fivegrams'] );
	$prices_meta['_quarter']   = esc_html( $_POST['_quarter'] );
	$prices_meta['_halfounce'] = esc_html( $_POST['_halfounce'] );
	$prices_meta['_ounce']     = esc_html( $_POST['_ounce'] );

	/** Add values of $prices_meta as custom fields */

	foreach ( $prices_meta as $key => $value ) { /** Cycle through the $prices_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_prices_meta', 1, 2 ); /** Save the custom fields */


/**
 * Concentrate Prices metabox
 *
 * Adds the Prices metabox to Concentrates menu type
 *
 * @since    1.9.6
 */
function wpdispensary_add_concentrateprices_metaboxes() {

	$screens = apply_filters( 'wpd_concentrateprices_screens', array( 'products', 'concentrates' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_concentrateprices',
			__( 'Product pricing', 'wp-dispensary' ),
			'wpdispensary_concentrateprices',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_concentrateprices_metaboxes' );

/**
 * WP Dispensary Concentrate Prices
 */
function wpdispensary_concentrateprices() {
	global $post;

	/**
	 * @todo add filter for Heavyweights add-on.
	 */

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="concentratepricesmeta_noncename" id="concentratepricesmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the prices data if its already been entered */
	$priceeach = get_post_meta( $post->ID, '_priceeach', true );
	$halfgram  = get_post_meta( $post->ID, '_halfgram', true );
	$gram      = get_post_meta( $post->ID, '_gram', true );
	$twograms  = get_post_meta( $post->ID, '_twograms', true );

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( 'Price each', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_priceeach" value="' . esc_html( $priceeach ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '1/2 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_halfgram" value="' . esc_html( $halfgram ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '1 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_gram" value="' . esc_html( $gram ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>' . __( '2 g', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_twograms" value="' . esc_html( $twograms ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_concentrateprices_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['concentratepricesmeta_noncename'] ) ||
		! wp_verify_nonce( $_POST['concentratepricesmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$concentrateprices_meta['_priceeach'] = esc_html( $_POST['_priceeach'] );
	$concentrateprices_meta['_halfgram']  = esc_html( $_POST['_halfgram'] );
	$concentrateprices_meta['_gram']      = esc_html( $_POST['_gram'] );
	$concentrateprices_meta['_twograms']  = esc_html( $_POST['_twograms'] );

	/** Add values of $prices_meta as custom fields */

	foreach ( $concentrateprices_meta as $key => $value ) { /** Cycle through the $prices_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_concentrateprices_meta', 1, 2 ); /** Save the custom fields */


/**
 * Pre-Roll Flower Type metabox
 *
 * Adds the Flower Type metabox to all the pre-roll custom post type
 *
 * @since    1.0.0
 */
class WPDispensary_Prerolls {
	var $FOR_POST_TYPE     = 'prerolls';
	var $SELECT_POST_TYPE  = 'flowers';
	var $SELECT_POST_LABEL = 'Flower';
	var $box_id;
	var $box_label;
	var $field_id;
	var $field_label;
	var $field_name;
	var $meta_key;
	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}
	function admin_init() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
		$this->meta_key    = "_selected_{$this->SELECT_POST_TYPE}";
		$this->box_id      = "select-{$this->SELECT_POST_TYPE}-metabox";
		$this->field_id    = "selected_{$this->SELECT_POST_TYPE}";
		$this->field_name  = "selected_{$this->SELECT_POST_TYPE}";
		$this->box_label   = __( 'Pre-roll strain', 'wp-dispensary' );
		$this->field_label = __( "Choose {$this->SELECT_POST_LABEL}", 'wp-dispensary' );
	}
	/**
	 * Add meta boxes
	 */
	function add_meta_boxes() {
		add_meta_box(
			$this->box_id,
			$this->box_label,
			array( $this, 'select_box' ),
			$this->FOR_POST_TYPE,
			'side'
		);
	}
	function select_box( $post ) {
		$selected_post_id = get_post_meta( $post->ID, $this->meta_key, true );
		global $wp_post_types;
		$save_hierarchical = $wp_post_types[ $this->SELECT_POST_TYPE ]->hierarchical;
		$wp_post_types[ $this->SELECT_POST_TYPE ]->hierarchical = true;
		wp_dropdown_pages( array(
			'id'               => $this->field_id,
			'name'             => $this->field_name,
			'selected'         => empty( $selected_post_id ) ? 0 : $selected_post_id,
			'post_type'        => $this->SELECT_POST_TYPE,
			'show_option_none' => $this->field_label,
		));
		$wp_post_types[ $this->SELECT_POST_TYPE ]->hierarchical = $save_hierarchical;
	}
	/**
	 * Save post
	 */
	function save_post( $post_id, $post ) {
		if ( $post->post_type === $this->FOR_POST_TYPE && isset( $_POST[ $this->field_name ] ) ) {
			$prerollflower = sanitize_text_field( $_POST['selected_flowers'] );
			update_post_meta( $post_id, $this->meta_key, $prerollflower );
		}
	}
}
new WPDispensary_Prerolls();

/**
 * Grower Flower Type metabox
 *
 * Adds a drop down of all flowers to the Growers menu type
 *
 * @since    1.7.0
 */
class WPDispensary_Growers {
	var $FOR_POST_TYPE     = 'growers';
	var $SELECT_POST_TYPE  = 'flowers';
	var $SELECT_POST_LABEL = 'Flower';
	var $box_id;
	var $box_label;
	var $field_id;
	var $field_label;
	var $field_name;
	var $meta_key;
	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}
	function admin_init() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
		$this->meta_key    = "_selected_{$this->SELECT_POST_TYPE}";
		$this->box_id      = "select-{$this->SELECT_POST_TYPE}-metabox";
		$this->field_id    = "selected_{$this->SELECT_POST_TYPE}";
		$this->field_name  = "selected_{$this->SELECT_POST_TYPE}";
		$this->box_label   = __( 'Flower Strain', 'wp-dispensary' );
		$this->field_label = __( "Choose {$this->SELECT_POST_LABEL}", 'wp-dispensary' );
	}
	/**
	 * Add meta boxes
	 */
	function add_meta_boxes() {
		add_meta_box(
			$this->box_id,
			$this->box_label,
			array( $this, 'select_box' ),
			$this->FOR_POST_TYPE,
			'side'
		);
	}
	function select_box( $post ) {
		$selected_post_id = get_post_meta( $post->ID, $this->meta_key, true );
		global $wp_post_types;
		$save_hierarchical                                      = $wp_post_types[ $this->SELECT_POST_TYPE ]->hierarchical;
		$wp_post_types[ $this->SELECT_POST_TYPE ]->hierarchical = true;
		wp_dropdown_pages( array(
			'id'               => $this->field_id,
			'name'             => $this->field_name,
			'selected'         => empty( $selected_post_id ) ? 0 : $selected_post_id,
			'post_type'        => $this->SELECT_POST_TYPE,
			'show_option_none' => $this->field_label,
		));
		$wp_post_types[ $this->SELECT_POST_TYPE ]->hierarchical = $save_hierarchical;
	}
	/**
	 * Save post
	 */
	function save_post( $post_id, $post ) {
		if ( $post->post_type === $this->FOR_POST_TYPE && isset( $_POST[ $this->field_name ] ) ) {
			$growerflower = sanitize_text_field( $_POST['selected_flowers'] );
			update_post_meta( $post_id, $this->meta_key, $growerflower );
		}
	}
}
new WPDispensary_Growers();

/**
 * Prices metabox for the following menu types:
 * Pre-rolls, Edibles, Growers
 *
 * Adds a price metabox to all of the above custom post types
 *
 * @since    1.0.0
 */
function wpdispensary_add_singleprices_metaboxes() {

	$screens = apply_filters( 'wpd_singleprices_screens', array( 'products', 'edibles', 'prerolls', 'growers' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_singleprices',
			__( 'Product pricing', 'wp-dispensary' ),
			'wpdispensary_singleprices',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_singleprices_metaboxes' );

/**
 * Single Prices
 */
function wpdispensary_singleprices() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="singlepricesmeta_noncename" id="singlepricesmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the prices data if its already been entered */
	$priceeach    = get_post_meta( $post->ID, '_priceeach', true );
	$priceperpack = get_post_meta( $post->ID, '_priceperpack', true );
	$unitsperpack = get_post_meta( $post->ID, '_unitsperpack', true );

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( 'Price per unit', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_priceeach" value="' . esc_html( $priceeach ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( 'Price per pack', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_priceperpack" value="' . esc_html( $priceperpack ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( 'Units per pack', 'wp-dispensary' ) . '</p>';
	echo '<input type="number" name="_unitsperpack" value="' . esc_html( $unitsperpack ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_singleprices_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['singlepricesmeta_noncename'] ) ||
		! wp_verify_nonce( $_POST['singlepricesmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$prices_meta['_priceeach']    = esc_html( $_POST['_priceeach'] );
	$prices_meta['_priceperpack'] = esc_html( $_POST['_priceperpack'] );
	$prices_meta['_unitsperpack'] = esc_html( $_POST['_unitsperpack'] );

	/** Add values of $prices_meta as custom fields */

	foreach ( $prices_meta as $key => $value ) { /** Cycle through the $prices_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_singleprices_meta', 1, 2 ); /** Save the custom fields */


/**
 * Prices metabox for the following menu types:
 * Topicals
 *
 * Adds a price metabox to all of the above custom post types
 *
 * @since    1.0.0
 */
function wpdispensary_add_topicalprices_metaboxes() {

	$screens = apply_filters( 'wpd_topicalprices_screens', array( 'products', 'topicals' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_topicalprices',
			__( 'Product pricing', 'wp-dispensary' ),
			'wpdispensary_topicalprices',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_topicalprices_metaboxes' );

/**
 * Single Prices
 */
function wpdispensary_topicalprices() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="topicalpricesmeta_noncename" id="topicalpricesmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the prices data if its already been entered */
	$priceeach    = get_post_meta( $post->ID, '_pricetopical', true );
	$priceperpack = get_post_meta( $post->ID, '_priceperpack', true );
	$unitsperpack = get_post_meta( $post->ID, '_unitsperpack', true );

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( 'Price per unit', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_pricetopical" value="' . esc_html( $priceeach ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( 'Price per pack', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_priceperpack" value="' . esc_html( $priceperpack ) . '" class="widefat" />';
	echo '</div>';

	/** Echo out the fields */
	echo '<div class="pricebox">';
	echo '<p>' . __( 'Units per pack', 'wp-dispensary' ) . '</p>';
	echo '<input type="number" name="_unitsperpack" value="' . esc_html( $unitsperpack ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_topicalprices_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['topicalpricesmeta_noncename'] ) ||
		! wp_verify_nonce( $_POST['topicalpricesmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$prices_meta['_pricetopical'] = esc_html( $_POST['_pricetopical'] );
	$prices_meta['_priceperpack'] = esc_html( $_POST['_priceperpack'] );
	$prices_meta['_unitsperpack'] = esc_html( $_POST['_unitsperpack'] );

	/** Add values of $prices_meta as custom fields */

	foreach ( $prices_meta as $key => $value ) { /** Cycle through the $prices_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_topicalprices_meta', 1, 2 ); /** Save the custom fields */


/**
 * Grower Product Details metabox for the following menu types:
 * Growers
 *
 * Adds a product details metabox to all of the above custom post types
 *
 * @since    2.0.0
 */
function wpdispensary_add_grower_product_details_metaboxes() {

	$screens = apply_filters( 'wpd_grower_product_details_screens', array( 'products', 'growers' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_grower_product_details',
			__( 'Product Details', 'wp-dispensary' ),
			'wpdispensary_grower_product_details',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_grower_product_details_metaboxes' );

/**
 * Grower Product Details
 */
function wpdispensary_grower_product_details() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="grower_product_detailsmeta_noncename" id="grower_product_detailsmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the clone count data if it has already been entered */
	$clonecount = get_post_meta( $post->ID, '_clonecount', true );

	/** Get the seed count data if it has already been entered */
	$seedcount = get_post_meta( $post->ID, '_seedcount', true );

	echo '<div class="growerbox">';
	echo '<p>' . __( 'Seeds per unit', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_seedcount" value="' . esc_html( $seedcount ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="growerbox">';
	echo '<p>' . __( 'Clones per unit', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_clonecount" value="' . esc_html( $clonecount ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_grower_product_details_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['grower_product_detailsmeta_noncename'] ) ||
		! wp_verify_nonce( $_POST['grower_product_detailsmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	 $grower_product_details['_clonecount'] = esc_html( $_POST['_clonecount'] );
	 $grower_product_details['_seedcount']  = esc_html( $_POST['_seedcount'] );

	/** Add values of $clonecount as custom fields */

	foreach ( $grower_product_details as $key => $value ) { /** Cycle through the $clonecount array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_grower_product_details_meta', 1, 2 ); /** Save the custom fields */


/**
 * Edibles THC content metabox
 *
 * Adds a THC content metabox to the edibles custom post type
 *
 * @since    1.0.0
 */
function wpdispensary_add_thc_cbd_mg_metaboxes() {

	$screens = apply_filters( 'wpd_thc_cbd_mg_screens', array( 'products', 'edibles' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_thc_cbd_mg',
			__( 'Product details', 'wp-dispensary' ),
			'wpdispensary_thc_cbd_mg',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_thc_cbd_mg_metaboxes' );

/**
 * THC and CBD mg
 */
function wpdispensary_thc_cbd_mg() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="thccbdmgmeta_noncename" id="thccbdmgmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the thc mg data if its already been entered */
	$thcmg          = get_post_meta( $post->ID, '_thcmg', true );
	$cbdmg          = get_post_meta( $post->ID, '_cbdmg', true );
	$thccbdservings = get_post_meta( $post->ID, '_thccbdservings', true );
	$netweight      = get_post_meta( $post->ID, '_netweight', true );

	/** Echo out the fields */
	echo '<div class="ediblebox">';
	echo '<p>' . __( 'THC mg per serving', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_thcmg" value="' . esc_html( $thcmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="ediblebox">';
	echo '<p>' . __( 'CBD mg per serving', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_cbdmg" value="' . esc_html( $cbdmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="ediblebox">';
	echo '<p>' . __( 'Servings', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_thccbdservings" value="' . esc_html( $thccbdservings ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="ediblebox">';
	echo '<p>' . __( 'Net weight (grams)', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_netweight" value="' . esc_html( $netweight ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_thc_cbd_mg_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['thccbdmgmeta_noncename'] ) ||
		! wp_verify_nonce( $_POST['thccbdmgmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$thc_cbd_mg_meta['_thcmg']          = esc_html( $_POST['_thcmg'] );
	$thc_cbd_mg_meta['_cbdmg']          = esc_html( $_POST['_cbdmg'] );
	$thc_cbd_mg_meta['_thccbdservings'] = esc_html( $_POST['_thccbdservings'] );
	$thc_cbd_mg_meta['_netweight']      = esc_html( $_POST['_netweight'] );

	/** Add values of $thccbdmg_meta as custom fields */

	foreach ( $thc_cbd_mg_meta as $key => $value ) { /** Cycle through the $thc_cbd_mg_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_thc_cbd_mg_meta', 1, 2 ); /** Save the custom fields */


/**
 * Topicals THC & CBD content metabox
 *
 * Adds a THC & CBD content metabox to the topicals custom post type
 *
 * @since    1.4.0
 */
function wpdispensary_add_thccbdtopical_metaboxes() {

	$screens = apply_filters( 'wpd_thccbdtopical_screens', array( 'products', 'topicals' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_thccbdtopical',
			__( 'Product details', 'wp-dispensary' ),
			'wpdispensary_thccbdtopical',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_thccbdtopical_metaboxes' );

/**
 * Building the metabox
 */
function wpdispensary_thccbdtopical() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="thccbdtopical_noncename" id="thccbdtopical_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the topical data if its already been entered */
	$thctopicals  = get_post_meta( $post->ID, '_thctopical', true );
	$cbdtopicals  = get_post_meta( $post->ID, '_cbdtopical', true );
	$sizetopicals = get_post_meta( $post->ID, '_sizetopical', true );

	/** Echo out the fields */
	echo '<div class="topicalbox">';
	echo '<p>' . __( 'Size (oz)', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_sizetopical" value="' . esc_html( $sizetopicals ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="topicalbox">';
	echo '<p>' . __( 'THC mg', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_thctopical" value="' . esc_html( $thctopicals ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="topicalbox">';
	echo '<p>' . __( 'CBD mg', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_cbdtopical" value="' . esc_html( $cbdtopicals ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_thccbdtopical_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['thccbdtopical_noncename'] ) ||
		! wp_verify_nonce( $_POST['thccbdtopical_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$thcmgtopical_meta['_thctopical']  = esc_html( $_POST['_thctopical'] );
	$thcmgtopical_meta['_cbdtopical']  = esc_html( $_POST['_cbdtopical'] );
	$thcmgtopical_meta['_sizetopical'] = esc_html( $_POST['_sizetopical'] );

	/** Add values of $thcmg_meta as custom fields */

	foreach ( $thcmgtopical_meta as $key => $value ) { /** Cycle through the $thcmg_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_thccbdtopical_meta', 1, 2 ); /** Save the custom fields */

/**
 * Growers Clone Details metabox
 *
 * Adds the clone details metabox to specific custom post types
 *
 * @since    1.9.5
 */
function wpdispensary_add_clonedetails_metaboxes() {

	$screens = apply_filters( 'wpd_clonedetails_screens', array( 'products', 'growers' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_clonedetails',
			__( 'Grow details', 'wp-dispensary' ),
			'wpdispensary_clonedetails',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_clonedetails_metaboxes' );

/**
 * Building the metabox
 */
function wpdispensary_clonedetails() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="clonedetailsmeta_noncename" id="clonedetailsmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the origin data if its already been entered */
	$origin     = get_post_meta( $post->ID, '_origin', true );
	$time       = get_post_meta( $post->ID, '_time', true );
	$yield      = get_post_meta( $post->ID, '_yield', true );
	$difficulty = get_post_meta( $post->ID, '_difficulty', true );

	/** Echo out the fields */
	echo '<div class="growerbox">';
	echo '<p>' . __( 'Origin', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_origin" value="' . esc_html( $origin ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="growerbox">';
	echo '<p>' . __( 'Grow time', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_time" value="' . esc_html( $time ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="growerbox">';
	echo '<p>' . __( 'Yield', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_yield" value="' . esc_html( $yield ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="growerbox">';
	echo '<p>' . __( 'Difficulty', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_difficulty" value="' . esc_html( $difficulty ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_clonedetails_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['clonedetailsmeta_noncename'] ) ||
		! wp_verify_nonce( $_POST['clonedetailsmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$clonedetails_meta['_origin']     = esc_html( $_POST['_origin'] );
	$clonedetails_meta['_time']       = esc_html( $_POST['_time'] );
	$clonedetails_meta['_yield']      = esc_html( $_POST['_yield'] );
	$clonedetails_meta['_difficulty'] = esc_html( $_POST['_difficulty'] );

	/** Add values of $clonedetails_meta as custom fields */

	foreach ( $clonedetails_meta as $key => $value ) { /** Cycle through the $thccbd_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); // If $value is an array, make it a CSV (unlikely)
		if ( get_post_meta( $post->ID, $key, false ) ) { // If the custom field already has a value.
			update_post_meta( $post->ID, $key, $value );
		} else { // If the custom field doesn't have a value.
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_clonedetails_meta', 1, 2 ); // Save the custom fields.


/**
 * Compound Details metabox
 *
 * Adds the compound details metabox to specific custom post types
 *
 * @since    1.9.9
 */
function wpdispensary_add_compounddetails_metaboxes() {
	// Default screens array.
	$screens = array( 'products', 'flowers', 'concentrates', 'prerolls' );
	// Filter screens array.
	$screens = apply_filters( 'wpd_compound_details_screens', $screens );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_compounds',
			esc_html__( 'Compound details', 'wp-dispensary' ),
			'wpdispensary_compounddetails',
			$screen,
			'normal',
			'default'
		);
	}
}
add_action( 'add_meta_boxes', 'wpdispensary_add_compounddetails_metaboxes' );

/**
 * Building the metabox
 */
function wpdispensary_compounddetails() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="compounddetailsmeta_noncename" id="compounddetailsmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the thccbd data if its already been entered */
	$thc   = get_post_meta( $post->ID, '_thc', true );
	$thca  = get_post_meta( $post->ID, '_thca', true );
	$cbd   = get_post_meta( $post->ID, '_cbd', true );
	$cba   = get_post_meta( $post->ID, '_cba', true );
	$cbn   = get_post_meta( $post->ID, '_cbn', true );
	$cbg   = get_post_meta( $post->ID, '_cbg', true );
	$total = get_post_meta( $post->ID, '_total_compounds', true );

	/** Echo out the fields */
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'THC', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="_thc" value="' . esc_html( $thc ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'THCA', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="_thca" value="' . esc_html( $thca ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBD', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="_cbd" value="' . esc_html( $cbd ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBA', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="_cba" value="' . esc_html( $cba ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBN', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="_cbn" value="' . esc_html( $cbn ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'CBG', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="_cbg" value="' . esc_html( $cbg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="compoundbox">';
	echo '<p>' . esc_html__( 'Total', 'wp-dispensary' ) . ' %</p>';
	echo '<input type="text" name="_total_compounds" value="' . esc_html( $total ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_compounddetails_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['compounddetailsmeta_noncename' ] ) ||
		! wp_verify_nonce( $_POST['compounddetailsmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$thccbd_meta['_thc']             = $_POST['_thc'];
	$thccbd_meta['_thca']            = $_POST['_thca'];
	$thccbd_meta['_cbd']             = $_POST['_cbd'];
	$thccbd_meta['_cba']             = $_POST['_cba'];
	$thccbd_meta['_cbn']             = $_POST['_cbn'];
	$thccbd_meta['_cbg']             = $_POST['_cbg'];
	$thccbd_meta['_total_compounds'] = $_POST['_total_compounds'];

	/** Add values of $compounddetails_meta as custom fields */

	foreach ( $thccbd_meta as $key => $value ) { /** Cycle through the $thccbd_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); // If $value is an array, make it a CSV (unlikely)
		if ( get_post_meta( $post->ID, $key, false ) ) { // If the custom field already has a value.
			update_post_meta( $post->ID, $key, $value );
		} else { // If the custom field doesn't have a value.
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_compounddetails_meta', 1, 2 ); // Save the custom fields.


/**
 * Pre-rolls Weight metabox
 *
 * Adds the weight metabox to specific custom post types
 *
 * @since    2.4.0
 */
function wpdispensary_add_preroll_weight_metaboxes() {

	$screens = apply_filters( 'wpd_preroll_weight_screens', array( 'products', 'prerolls' ) );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_preroll_weight',
			__( 'Pre-roll weight', 'wp-dispensary' ),
			'wpdispensary_preroll_weight',
			$screen,
			'side',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wpdispensary_add_preroll_weight_metaboxes' );

/**
 * Building the metabox
 */
function wpdispensary_preroll_weight() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="preroll_weightmeta_noncename" id="preroll_weightmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the origin data if its already been entered */
	$preroll_weight = get_post_meta( $post->ID, '_preroll_weight', true );

	/** Echo out the fields */
	echo '<div class="weightbox">';
	echo '<p>' . __( 'Weight (g)', 'wp-dispensary' ) . '</p>';
	echo '<input type="text" name="_preroll_weight" value="' . esc_html( $preroll_weight ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wpdispensary_save_preroll_weight_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if (
		! isset( $_POST['preroll_weightmeta_noncename'] ) ||
		! wp_verify_nonce( $_POST['preroll_weightmeta_noncename'], plugin_basename( __FILE__ ) )
	) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */

	$preroll_weight_meta['_preroll_weight'] = esc_html( $_POST['_preroll_weight'] );

	/** Add values of $preroll_weight_meta as custom fields */

	foreach ( $preroll_weight_meta as $key => $value ) { /** Cycle through the $thccbd_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); // If $value is an array, make it a CSV (unlikely)
		if ( get_post_meta( $post->ID, $key, false ) ) { // If the custom field already has a value.
			update_post_meta( $post->ID, $key, $value );
		} else { // If the custom field doesn't have a value.
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wpdispensary_save_preroll_weight_meta', 1, 2 ); // Save the custom fields.

/**
 * Details metabox for the Tinctures menu type
 *
 * Adds a details metabox
 *
 * @since    4.0.0
 */
function wp_dispensary_tinctures_details_metaboxes() {

	$screens = array( 'products', 'tinctures' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpd_tinctures_details',
			esc_attr__( 'Product Details', 'wpd-tinctures' ),
			'wp_dispensary_tinctures_details',
			$screen,
			'normal',
			'default'
		);
	}

}
add_action( 'add_meta_boxes', 'wp_dispensary_tinctures_details_metaboxes' );

/**
 * Tincture Details
 */
function wp_dispensary_tinctures_details() {
	global $post;

	/** Noncename needed to verify where the data originated */
	echo '<input type="hidden" name="tincturesdetailsmeta_noncename" id="tincturesdetailsmeta_noncename" value="' .
	wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';

	/** Get the details data if its already been entered */
	$thcmg          = get_post_meta( $post->ID, '_thcmg', true );
	$cbdmg          = get_post_meta( $post->ID, '_cbdmg', true );
	$mlserving      = get_post_meta( $post->ID, '_mlserving', true );
	$thccbdservings = get_post_meta( $post->ID, '_thccbdservings', true );
	$netweight      = get_post_meta( $post->ID, '_netweight', true );

	/** Echo out the fields */
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . esc_attr__( 'Servings', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_thccbdservings" value="' . esc_html( $thccbdservings ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . esc_attr__( 'THC mg per serving', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_thcmg" value="' . esc_html( $thcmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . esc_attr__( 'CBD mg per serving', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_cbdmg" value="' . esc_html( $cbdmg ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . esc_attr__( 'mL per serving', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_mlserving" value="' . esc_html( $mlserving ) . '" class="widefat" />';
	echo '</div>';
	echo '<div class="tincturesdetailsbox">';
	echo '<p>' . esc_attr__( 'Net weight (ounces)', 'wpd-tinctures' ) . '</p>';
	echo '<input type="text" name="_netweight" value="' . esc_html( $netweight ) . '" class="widefat" />';
	echo '</div>';

}

/**
 * Save the Metabox Data
 */
function wp_dispensary_tinctures_details_save_meta( $post_id, $post ) {

	/**
	 * Verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times
	 */
	if ( ! isset( $_POST['tincturesdetailsmeta_noncename' ] ) || ! wp_verify_nonce( $_POST['tincturesdetailsmeta_noncename'], plugin_basename( __FILE__ ) ) ) {
		return $post->ID;
	}

	/** Is the user allowed to edit the post or page? */
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	/**
	 * OK, we're authenticated: we need to find and save the data
	 * We'll put it into an array to make it easier to loop though.
	 */
	$details_meta['_thcmg']          = esc_html( $_POST['_thcmg'] );
	$details_meta['_cbdmg']          = esc_html( $_POST['_cbdmg'] );
	$details_meta['_mlserving']      = esc_html( $_POST['_mlserving'] );
	$details_meta['_thccbdservings'] = esc_html( $_POST['_thccbdservings'] );
	$details_meta['_netweight']      = esc_html( $_POST['_netweight'] );

	/** Add values of $details_meta as custom fields */

	foreach ( $details_meta as $key => $value ) { /** Cycle through the $details_meta array! */
		if ( 'revision' === $post->post_type ) { /** Don't store custom data twice */
			return;
		}
		$value = implode( ',', (array) $value ); /** If $value is an array, make it a CSV (unlikely) */
		if ( get_post_meta( $post->ID, $key, false ) ) { /** If the custom field already has a value */
			update_post_meta( $post->ID, $key, $value );
		} else { /** If the custom field doesn't have a value */
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) { /** Delete if blank */
			delete_post_meta( $post->ID, $key );
		}
	}

}
add_action( 'save_post', 'wp_dispensary_tinctures_details_save_meta', 1, 2 ); /** Save the custom fields */
