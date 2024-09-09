<?php

/**
 * The file that builds the widgets to display recent items from 
 * each custom post type
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

// Products.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/wpd-widget-products.php';

// Product search.
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/wpd-widget-product-search.php';
