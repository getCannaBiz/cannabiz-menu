<?php
/**
 * The file that defines the taxonomies used by the various custom post types
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

// Allergens.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-allergens.php';

// Aromas.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-aromas.php';

// Categories.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-categories.php';

// Conditions.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-conditions.php';

// Effects.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-effects.php';

// Flavors.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-flavors.php';

// Ingredients.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-ingredients.php';

// Shelf types.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-shelf-types.php';

// Strain types.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-strain-types.php';

// Symptoms.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-symptoms.php';

// Vendors.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/taxonomies/wpd-taxonomy-vendors.php';
