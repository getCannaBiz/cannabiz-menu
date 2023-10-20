<?php
/**
 * Content Blocks
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    wp_die();
}

/**
 * Enqueue custom blocks
 * 
 * @since 4.4.0
 */
function enqueue_custom_block_script() {
    // Products Grid.
    wp_enqueue_script(
        'products-grid',
        plugin_dir_url( __FILE__ ) . '/products-grid/products-grid.js',
        array( 'wp-blocks', 'wp-components', 'wp-element', 'wp-editor' ),
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'enqueue_custom_block_script' );
