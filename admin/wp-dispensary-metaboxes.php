<?php
/**
 * The file that defines the metaboxes used by the various custom post types
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

// Product Type.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metaboxes/wpd-metabox-product-type.php';

// Product Prices.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metaboxes/wpd-metabox-product-prices.php';

// Product Details.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metaboxes/wpd-metabox-product-details.php';

// Compound Details.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metaboxes/wpd-metabox-compound-details.php';

// Grower Details.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/metaboxes/wpd-metabox-grower-details.php';
