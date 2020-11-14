<?php
/**
 * The file that defines the taxonomies used by the various custom post types
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types
 */

/**
 * Shelf Type
 *
 * Adds the Shelf Type taxonomy to specific custom post types
 *
 * @since    2.1.0
 */
function wp_dispensary_shelf_type() {

	$labels = array(
		'name'              => _x( 'Shelf Type', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Shelf Type', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Shelf Types', 'wp-dispensary' ),
		'all_items'         => __( 'All Shelf Types', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Shelf Type', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Shelf Type:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Shelf Type', 'wp-dispensary' ),
		'update_item'       => __( 'Update Shelf Type', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Shelf Type', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Shelf Type Name', 'wp-dispensary' ),
		'not_found'         => __( 'No shelf types found', 'wp-dispensary' ),
		'menu_name'         => __( 'Shelf Type', 'wp-dispensary' ),
	);

	$shelftaxtype = apply_filters( 'wpd_tax_shelf_type', array( 'products', 'flowers', 'concentrates', 'prerolls', 'growers' ) );

	register_taxonomy( 'shelf_type', $shelftaxtype, array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'shelf-type',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wp_dispensary_shelf_type', 0 );

/**
 * Strain Type
 *
 * Adds the Strain Type taxonomy to specific custom post types
 *
 * @since    2.3.0
 */
function wp_dispensary_strain_type() {

	$labels = array(
		'name'              => _x( 'Strain Type', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Strain Type', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Strain Types', 'wp-dispensary' ),
		'all_items'         => __( 'All Strain Types', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Strain Type', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Strain Type:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Strain Type', 'wp-dispensary' ),
		'update_item'       => __( 'Update Strain Type', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Strain Type', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Strain Type Name', 'wp-dispensary' ),
		'not_found'         => __( 'No strain types found', 'wp-dispensary' ),
		'menu_name'         => __( 'Strain Type', 'wp-dispensary' ),
	);

	$straintaxtype = apply_filters( 'wpd_tax_strain_type', array( 'products', 'flowers', 'concentrates', 'prerolls', 'growers' ) );

	register_taxonomy( 'strain_type', $straintaxtype, array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'strain-type',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wp_dispensary_strain_type', 0 );

/**
 * Vendor Taxonomy
 *
 * Adds the Vendor taxonomy to all custom post types
 *
 * @since    1.9.11
 */
function wp_dispensary_vendor() {

	$labels = array(
		'name'                       => _x( 'Vendors', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Vendor', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Vendors', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Vendors', 'wp-dispensary' ),
		'all_items'                  => __( 'All Vendors', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Vendor', 'wp-dispensary' ),
		'update_item'                => __( 'Update Vendor', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Vendor', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Vendor Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate vendors with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove vendors', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used vendors', 'wp-dispensary' ),
		'not_found'                  => __( 'No vendors found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Vendors', 'wp-dispensary' ),
	);

	$menu_types       = wpd_menu_types();
	$menu_types_names = array();

	// Loop through menu types
	foreach ( $menu_types as $key=>$value ) {
		// Strip wpd- from the menu type name.
		$name = str_replace( 'wpd-', '', $key );
		// Add menu type name to new array.
		$menu_types_names[] = $name;
	}

	// Add the Products post type.
	$menu_types_names[] = 'products';

	$vendor_tax_type = apply_filters( 'wpd_vendor_tax_type', $menu_types_names );

	register_taxonomy( 'vendor', $vendor_tax_type, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => true,
		'query_var'             => true,
		'update_count_callback' => '_update_post_term_count',
		'rewrite'               => array(
			'slug' => 'vendor',
		),
	) );

}
add_action( 'init', 'wp_dispensary_vendor', 0 );

/**
 * Aroma Taxonomy
 *
 * Adds the Aroma taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_aroma() {

	$labels = array(
		'name'                       => _x( 'Aromas', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Aroma', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Aromas', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Aromas', 'wp-dispensary' ),
		'all_items'                  => __( 'All Aromas', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Aroma', 'wp-dispensary' ),
		'update_item'                => __( 'Update Aroma', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Aroma', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Aroma Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate aromas with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove aromas' , 'wp-dispensary'),
		'choose_from_most_used'      => __( 'Choose from the most used aromas', 'wp-dispensary' ),
		'not_found'                  => __( 'No aromas found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Aromas', 'wp-dispensary' ),
	);

	$aromataxtype = apply_filters( 'wpd_aroma_tax_type', array( 'products', 'flowers', 'concentrates' ) );

	register_taxonomy( 'aroma', $aromataxtype, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'aroma',
		),
	) );

}
add_action( 'init', 'wp_dispensary_aroma', 0 );

/**
 * Flavor Taxonomy
 *
 * Adds the Flavor taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_flavor() {

	$labels = array(
		'name'                       => _x( 'Flavors', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Flavor', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Flavors', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Flavors', 'wp-dispensary' ),
		'all_items'                  => __( 'All Flavors', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Flavor', 'wp-dispensary' ),
		'update_item'                => __( 'Update Flavor', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Flavor', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Flavor Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate flavors with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove flavors', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used flavors', 'wp-dispensary' ),
		'not_found'                  => __( 'No flavors found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Flavors', 'wp-dispensary' ),
	);

	$flavortaxtype = apply_filters( 'wpd_flavor_tax_type', array( 'products', 'flowers', 'concentrates' ) );

	register_taxonomy( 'flavor', $flavortaxtype, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'flavor',
		),
	) );
}
add_action( 'init', 'wp_dispensary_flavor', 0 );

/**
 * Effect Taxonomy
 *
 * Adds the Effect taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_effect() {

	$labels = array(
		'name'                       => _x( 'Effects', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Effect', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Effects', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Effects', 'wp-dispensary' ),
		'all_items'                  => __( 'All Effects', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Effect', 'wp-dispensary' ),
		'update_item'                => __( 'Update Effect', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Effect', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Effect Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate effects with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove effects', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used effects', 'wp-dispensary' ),
		'not_found'                  => __( 'No effects found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Effects', 'wp-dispensary' ),
	);

	$effecttaxtype = apply_filters( 'wpd_effect_tax_type', array( 'products', 'flowers', 'concentrates', 'edibles', 'topicals' ) );

	register_taxonomy( 'effect', $effecttaxtype, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'effect',
		),
	) );
}
add_action( 'init', 'wp_dispensary_effect', 0 );

/**
 * Symptom Taxonomy
 *
 * Adds the Symptom taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_symptom() {

	$labels = array(
		'name'                       => _x( 'Symptoms', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Symptom', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Symptoms', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Symptoms', 'wp-dispensary' ),
		'all_items'                  => __( 'All Symptoms', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Symptom', 'wp-dispensary' ),
		'update_item'                => __( 'Update Symptom', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Symptom', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Symptom Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate symptoms with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove symptoms', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used symptoms', 'wp-dispensary' ),
		'not_found'                  => __( 'No symptoms found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Symptoms', 'wp-dispensary' ),
	);

	$symptomtaxtype = apply_filters( 'wpd_symptom_tax_type', array( 'products', 'flowers', 'concentrates', 'edibles', 'topicals' ) );

	register_taxonomy( 'symptom', $symptomtaxtype, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'symptom',
		),
	) );
}
add_action( 'init', 'wp_dispensary_symptom', 0 );

/**
 * Condition Taxonomy
 *
 * Adds the Condition taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_condition() {

	$labels = array(
		'name'                       => _x( 'Conditions', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Condition', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Conditions', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Conditions', 'wp-dispensary' ),
		'all_items'                  => __( 'All Conditions', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Condition', 'wp-dispensary' ),
		'update_item'                => __( 'Update Condition', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Condition', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Condition Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate conditions with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove conditions', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used conditions', 'wp-dispensary' ),
		'not_found'                  => __( 'No conditions found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Conditions', 'wp-dispensary' ),
	);

	$conditiontaxtype = apply_filters( 'wpd_condition_tax_type', array( 'products', 'flowers', 'concentrates', 'edibles', 'topicals' ) );

	register_taxonomy( 'condition', $conditiontaxtype, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'condition',
		),
	) );
}
add_action( 'init', 'wp_dispensary_condition', 0 );

/**
 * Ingredient Taxonomy
 *
 * Adds the Ingredient taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wp_dispensary_ingredient() {

	$labels = array(
		'name'                       => _x( 'Ingredients', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Ingredient', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Ingredients', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Ingredients', 'wp-dispensary' ),
		'all_items'                  => __( 'All Ingredients', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Ingredient', 'wp-dispensary' ),
		'update_item'                => __( 'Update Ingredient', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Ingredient', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Ingredient Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate ingredients with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove ingredients', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used ingredients', 'wp-dispensary' ),
		'not_found'                  => __( 'No ingredients found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Ingredients', 'wp-dispensary' ),
	);

	$ingredientstaxtype = apply_filters( 'wpd_ingredients_tax_type', array( 'products', 'edibles', 'topicals' ) );

	register_taxonomy( 'ingredients', $ingredientstaxtype, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'ingredient',
		),
	) );
}
add_action( 'init', 'wp_dispensary_ingredient', 0 );

/**
 * Flower Category Taxonomy
 *
 * Adds the Flower Category taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wpdispensary_flowercategory() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Categories', 'wp-dispensary' ),
		'all_items'         => __( 'All Categories', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Category', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Category:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Category', 'wp-dispensary' ),
		'update_item'       => __( 'Update Category', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Category', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Category Name', 'wp-dispensary' ),
		'not_found'         => __( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => __( 'Categories', 'wp-dispensary' ),
	);

	register_taxonomy( 'flowers_category', array( 'flowers', 'prerolls' ), array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'flowers/category',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wpdispensary_flowercategory', 0 );

/**
 * Edible Category Taxonomy
 *
 * Adds the Edible Category taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wpdispensary_ediblecategory() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Categories', 'wp-dispensary' ),
		'all_items'         => __( 'All Categories', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Category', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Category:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Category', 'wp-dispensary' ),
		'update_item'       => __( 'Update Category', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Category', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Category Name', 'wp-dispensary' ),
		'not_found'         => __( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => __( 'Categories', 'wp-dispensary' ),
	);

	register_taxonomy( 'edibles_category', 'edibles', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'edibles/category',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wpdispensary_ediblecategory', 0 );

/**
 * Concentrate Category Taxonomy
 *
 * Adds the Concentrate Category taxonomy to all custom post types
 *
 * @since    1.0.0
 */
function wpdispensary_concentratecategory() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Categories', 'wp-dispensary' ),
		'all_items'         => __( 'All Categories', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Category', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Category:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Category', 'wp-dispensary' ),
		'update_item'       => __( 'Update Category', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Category', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Category Name', 'wp-dispensary' ),
		'not_found'         => __( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => __( 'Categories', 'wp-dispensary' ),
	);

	register_taxonomy( 'concentrates_category', 'concentrates', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'concentrates/category',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wpdispensary_concentratecategory', 0 );

/**
 * Topical Category Taxonomy
 *
 * Adds the Topical Category taxonomy to all custom post types
 *
 * @since    1.4.0
 */
function wpdispensary_topicalcategory() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Categories', 'wp-dispensary' ),
		'all_items'         => __( 'All Categories', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Category', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Category:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Category', 'wp-dispensary' ),
		'update_item'       => __( 'Update Category', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Category', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Category Name', 'wp-dispensary' ),
		'not_found'         => __( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => __( 'Categories', 'wp-dispensary' ),
	);

	register_taxonomy( 'topicals_category', 'topicals', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'topicals/category',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wpdispensary_topicalcategory', 0 );

/**
 * Grower Category Taxonomy
 *
 * Adds the Grower Category taxonomy to all custom post types
 *
 * @since    1.7.0
 */
function wpdispensary_growerscategory() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Categories', 'wp-dispensary' ),
		'all_items'         => __( 'All Categories', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Category', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Category:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Category', 'wp-dispensary' ),
		'update_item'       => __( 'Update Category', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Category', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Category Name', 'wp-dispensary' ),
		'not_found'         => __( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => __( 'Categories', 'wp-dispensary' ),
	);

	register_taxonomy( 'growers_category', 'growers', array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'growers/category',
			'with_front' => false,
		),
	) );

}
add_action( 'init', 'wpdispensary_growerscategory', 0 );

/**
 * Allergens Taxonomy
 *
 * Adds the Allergens taxonomy to specific custom post types
 *
 * @since    2.3.0
 */
function wpdispensary_allergens() {

	$labels = array(
		'name'                       => _x( 'Allergens', 'general name', 'wp-dispensary' ),
		'singular_name'              => _x( 'Allergen', 'singular name', 'wp-dispensary' ),
		'search_items'               => __( 'Search Allergens', 'wp-dispensary' ),
		'popular_items'              => __( 'Popular Allergens', 'wp-dispensary' ),
		'all_items'                  => __( 'All Allergens', 'wp-dispensary' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Allergen', 'wp-dispensary' ),
		'update_item'                => __( 'Update Allergen', 'wp-dispensary' ),
		'add_new_item'               => __( 'Add New Allergen', 'wp-dispensary' ),
		'new_item_name'              => __( 'New Allergen Name', 'wp-dispensary' ),
		'separate_items_with_commas' => __( 'Separate allergens with commas', 'wp-dispensary' ),
		'add_or_remove_items'        => __( 'Add or remove allergens', 'wp-dispensary' ),
		'choose_from_most_used'      => __( 'Choose from the most used allergens', 'wp-dispensary' ),
		'not_found'                  => __( 'No allergens found', 'wp-dispensary' ),
		'menu_name'                  => __( 'Allergens', 'wp-dispensary' ),
	);

	$allergenstaxtype = apply_filters( 'wpd_allergens_tax_type', array( 'products', 'edibles' ) );

	register_taxonomy( 'allergens', $allergenstaxtype, array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_admin_column'     => false,
		'show_in_nav_menus'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'allergens',
		),
	) );

}
add_action( 'init', 'wpdispensary_allergens', 0 );

/**
 * Product Category Taxonomy
 *
 * Adds the default Category taxonomy to all custom post types
 *
 * @since    3.4
 */
function wp_dispensary_product_category() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'wp-dispensary' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'wp-dispensary' ),
		'search_items'      => __( 'Search Categories', 'wp-dispensary' ),
		'all_items'         => __( 'All Categories', 'wp-dispensary' ),
		'parent_item'       => __( 'Parent Category', 'wp-dispensary' ),
		'parent_item_colon' => __( 'Parent Category:', 'wp-dispensary' ),
		'edit_item'         => __( 'Edit Category', 'wp-dispensary' ),
		'update_item'       => __( 'Update Category', 'wp-dispensary' ),
		'add_new_item'      => __( 'Add New Category', 'wp-dispensary' ),
		'new_item_name'     => __( 'New Category Name', 'wp-dispensary' ),
		'not_found'         => __( 'No categories found', 'wp-dispensary' ),
		'menu_name'         => __( 'Categories', 'wp-dispensary' ),
	);

	$menu_types       = wpd_menu_types();
	$menu_types_names = array();

	// Loop through menu types.
	foreach ( $menu_types as $key=>$value ) {
		// Strip wpd- from the menu type name.
		$name = str_replace( 'wpd-', '', $key );
		// Add menu type name to new array.
		$menu_types_names[] = $name;
	}

	// Add Products to menu types list.
	$menu_types_names[] = 'products';

	$product_types = apply_filters( 'wpd_product_tax_type', $menu_types_names );

	register_taxonomy( 'product_category', $product_types, array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'       => 'product-category',
			'with_front' => true,
		),
	) );

}
add_action( 'init', 'wp_dispensary_product_category', 10 );

function acme_test() {
	convert_taxonomies( 'flowers', 'flowers_category', 'product_category' );
	convert_taxonomies( 'concentrates', 'concentrates_category', 'product_category' );
	convert_taxonomies( 'edibles', 'edibles_category', 'product_category' );
	convert_taxonomies( 'prerolls', 'flowers_category', 'product_category' );
	convert_taxonomies( 'topicals', 'topicals_category', 'product_category' );
	convert_taxonomies( 'growers', 'growers_category', 'product_category' );
}
//add_action( 'init', 'acme_test', 12 );
