<?php
/**
 * The file that builds the widgets to display recent items from each custom post type
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/post-types/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Create custom featured image size for the widget.
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'wpdispensary-widget', 312, 156, true );
}

// Products.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'post-types/widgets/wpd-widget-products.php';

// Product search.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'post-types/widgets/wpd-widget-product-search.php';
