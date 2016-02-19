<?php
/**
 * The file that defines the metaboxes used by the various custom post types
 *
 * @link       http://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */
 
/**
 * THC% & BCD% metabox
 *
 * Adds the THC% & BCD% metabox to specific custom post types
 *
 * @since    1.3.0
 */

function add_thcbcd_metaboxes() {
	
	$screens = array( 'flowers', 'concentrates', 'edibles', 'prerolls' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_thcbcd',
			__( 'THC% & BCD%', 'wp-dispensary' ),
			'wpdispensary_thcbcd',
			$screen,
			'side',
			'default'
		);
	}

}

add_action( 'add_meta_boxes', 'add_thcbcd_metaboxes' );

function wpdispensary_thcbcd() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="thcbcdmeta_noncename" id="thcbcdmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the thcbcd data if its already been entered
	$thc = get_post_meta($post->ID, '_thc', true);
	$bcd = get_post_meta($post->ID, '_bcd', true);
	
	// Echo out the fields
	echo '<div class="pricebox">';
	echo '<p>THC %:</p>';
	echo '<input type="number" name="_thc" value="' . $thc  . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>BCD %:</p>';
	echo '<input type="number" name="_bcd" value="' . $bcd  . '" class="widefat" />';
	echo '</div>';

}

// Save the Metabox Data

function wpdispensary_save_thcbcd_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['thcbcdmeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$thcbcd_meta['_thc'] = $_POST['_thc'];
	$thcbcd_meta['_bcd'] = $_POST['_bcd'];
	
	// Add values of $thcbcd_meta as custom fields
	
	foreach ($thcbcd_meta as $key => $value) { // Cycle through the $thcbcd_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpdispensary_save_thcbcd_meta', 1, 2); // save the custom fields


/**
 * Prices metabox
 *
 * Adds the Prices metabox to specific custom post types
 *
 * @since    1.0.0
 */

function add_prices_metaboxes() {
	
	$screens = array( 'flowers', 'concentrates' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_prices',
			__( 'Product Prices', 'wp-dispensary' ),
			'wpdispensary_prices',
			$screen,
			'normal',
			'default'
		);
	}

}

add_action( 'add_meta_boxes', 'add_prices_metaboxes' );

function wpdispensary_prices() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="pricesmeta_noncename" id="pricesmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the prices data if its already been entered
	$halfgram = get_post_meta($post->ID, '_halfgram', true);
	$gram = get_post_meta($post->ID, '_gram', true);
	$eighth = get_post_meta($post->ID, '_eighth', true);
	$quarter = get_post_meta($post->ID, '_quarter', true);
	$halfounce = get_post_meta($post->ID, '_halfounce', true);
	$ounce = get_post_meta($post->ID, '_ounce', true);
	
	// Echo out the fields
	echo '<div class="pricebox">';
	echo '<p>1/2 Gram:</p>';
	echo '<input type="number" name="_halfgram" value="' . $halfgram  . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>Gram:</p>';
	echo '<input type="number" name="_gram" value="' . $gram  . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>1/8 Ounce:</p>';
	echo '<input type="number" name="_eighth" value="' . $eighth  . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>1/4 Ounce:</p>';
	echo '<input type="number" name="_quarter" value="' . $quarter  . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>1/2 Ounce:</p>';
	echo '<input type="number" name="_halfounce" value="' . $halfounce  . '" class="widefat" />';
	echo '</div>';
	echo '<div class="pricebox">';
	echo '<p>Ounce:</p>';
	echo '<input type="number" name="_ounce" value="' . $ounce  . '" class="widefat" />';
	echo '</div>';

}

// Save the Metabox Data

function wpdispensary_save_prices_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['pricesmeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$prices_meta['_halfgram'] = $_POST['_halfgram'];
	$prices_meta['_gram'] = $_POST['_gram'];
	$prices_meta['_eighth'] = $_POST['_eighth'];
	$prices_meta['_quarter'] = $_POST['_quarter'];
	$prices_meta['_halfounce'] = $_POST['_halfounce'];
	$prices_meta['_ounce'] = $_POST['_ounce'];
	
	// Add values of $prices_meta as custom fields
	
	foreach ($prices_meta as $key => $value) { // Cycle through the $prices_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpdispensary_save_prices_meta', 1, 2); // save the custom fields

/**
 * Pre-Roll Prices metabox
 *
 * Adds the Prices metabox to all the pre-roll custom post type
 *
 * @since    1.0.0
 */
	
class WPDispensary_Prerolls {
	var $FOR_POST_TYPE = 'prerolls';
	var $SELECT_POST_TYPE = 'flowers';
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
		$this->meta_key     = "_selected_{$this->SELECT_POST_TYPE}";
		$this->box_id       = "select-{$this->SELECT_POST_TYPE}-metabox";
		$this->field_id     = "selected_{$this->SELECT_POST_TYPE}";
		$this->field_name   = "selected_{$this->SELECT_POST_TYPE}";
		$this->box_label    = __( "Pre-roll Strain", 'wp-dispensary' );
		$this->field_label  = __( "Choose {$this->SELECT_POST_LABEL}", 'wp-dispensary' );
	}
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
		$save_hierarchical = $wp_post_types[$this->SELECT_POST_TYPE]->hierarchical;
		$wp_post_types[$this->SELECT_POST_TYPE]->hierarchical = true;
		wp_dropdown_pages( array(
			'id' => $this->field_id,
			'name' => $this->field_name,
			'selected' => empty( $selected_post_id ) ? 0 : $selected_post_id,
			'post_type' => $this->SELECT_POST_TYPE,
			'show_option_none' => $this->field_label,
		));
		$wp_post_types[$this->SELECT_POST_TYPE]->hierarchical = $save_hierarchical;
	}
	function save_post( $post_id, $post ) {
		if ( $post->post_type == $this->FOR_POST_TYPE && isset( $_POST[$this->field_name] ) ) {
		  update_post_meta( $post_id, $this->meta_key, $_POST[$this->field_name] );
		}
	}
}
new WPDispensary_Prerolls();
	
/**
 * Pre-roll Prices metabox
 *
 * Adds a price metabox to the pre-roll custom post type
 *
 * @since    1.0.0
 */

function add_singleprices_metaboxes() {
	
	$screens = array( 'prerolls', 'edibles' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_singleprices',
			__( 'Product Price', 'wp-dispensary' ),
			'wpdispensary_singleprices',
			$screen,
			'side',
			'default'
		);
	}

}

add_action( 'add_meta_boxes', 'add_singleprices_metaboxes' );

function wpdispensary_singleprices() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="singlepricesmeta_noncename" id="singlepricesmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the prices data if its already been entered
	$priceeach = get_post_meta($post->ID, '_priceeach', true);
	
	// Echo out the fields
	echo '<p>Price per unit:</p>';
	echo '<input type="number" name="_priceeach" value="' . $priceeach  . '" class="widefat" />';

}

// Save the Metabox Data

function wpdispensary_save_singleprices_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['singlepricesmeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$prices_meta['_priceeach'] = $_POST['_priceeach'];
	
	// Add values of $prices_meta as custom fields
	
	foreach ($prices_meta as $key => $value) { // Cycle through the $prices_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpdispensary_save_singleprices_meta', 1, 2); // save the custom fields

	
/**
 * Edibles THC content metabox
 *
 * Adds a THC content metabox to the edibles custom post type
 *
 * @since    1.0.0
 */

function add_thcmg_metaboxes() {
	
	$screens = array( 'edibles' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'wpdispensary_thcmg',
			__( 'THC MG Content', 'wp-dispensary' ),
			'wpdispensary_thcmg',
			$screen,
			'side',
			'default'
		);
	}

}

add_action( 'add_meta_boxes', 'add_thcmg_metaboxes' );

function wpdispensary_thcmg() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="thcmgmeta_noncename" id="thcmgmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the thc mg data if its already been entered
	$thcmg = get_post_meta($post->ID, '_thcmg', true);
	$thcservings = get_post_meta($post->ID, '_thcservings', true);
	
	// Echo out the fields
	echo '<p>mg per serving:</p>';
	echo '<input type="number" name="_thcmg" value="' . $thcmg  . '" class="widefat" />';
	echo '<p>Servings:</p>';
	echo '<input type="number" name="_thcservings" value="' . $thcservings  . '" class="widefat" />';

}

// Save the Metabox Data

function wpdispensary_save_thcmg_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['thcmgmeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$thcmg_meta['_thcmg'] = $_POST['_thcmg'];
	$thcmg_meta['_thcservings'] = $_POST['_thcservings'];
	
	// Add values of $thcmg_meta as custom fields
	
	foreach ($thcmg_meta as $key => $value) { // Cycle through the $thcmg_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpdispensary_save_thcmg_meta', 1, 2); // save the custom fields

?>