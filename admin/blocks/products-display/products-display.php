<?php
/**
 * Block - Products Display
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
 * Enqueue assets
 * 
 * @since  4.5.0
 * @return void
 */
function wpd_enqueue_assets() {
    wp_enqueue_script(
        'wpd-block-js',
        plugin_dir_url( __FILE__ ) . 'build/index.js',
        [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data', 'wp-api-fetch' ],
        filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' )
    );

    wp_enqueue_style(
        'wpd-block-css',
        plugin_dir_url( __FILE__ ) . 'build/style.css',
        [],
        filemtime( plugin_dir_path( __FILE__ ) . 'build/style.css' )
    );
}
add_action( 'enqueue_block_editor_assets', 'wpd_enqueue_assets' );

function wpd_register_block() {
    register_block_type( 'wpd/product-display', array(
        'editor_script'   => 'wpd-block-js',
        'editor_style'    => 'wpd-block-css',
        'render_callback' => 'wpd_render_block',
        'attributes'      => array(
            'selectedTaxonomy' => array(
                'type'    => 'object',
                'default' => array(
                    'strain_type'    => '',
                    'shelf_type'     => '',
                    'wpd_categories' => '',
                ),
            ),
        ),
    ));
}
add_action( 'init', 'wpd_register_block' );

function wpd_render_block( $attributes ) {
    $tax_query = [ 'relation' => 'AND' ];
    $columns = isset($attributes['columns']) ? (int) $attributes['columns'] : 3;

    // Loop through selected taxonomies.
    foreach ( $attributes['selectedTaxonomy'] as $taxonomy => $term) {
        if ( ! empty( $term ) ) {
            $tax_query[] = [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $term,
            ];
        }
    }

    $query_args = [
        'post_type' => 'products',
        'tax_query' => $tax_query,
    ];

    $query = new WP_Query( $query_args );

    if ( ! $query->have_posts() ) {
        return '<p>No products found.</p>';
    }

    ob_start();
    echo '<div class="wpd-product-grid wpd-columns-' . $columns . '">';
    while ( $query->have_posts() ) {
        $query->the_post();
        echo '<div class="wpd-product">';
        the_title( '<h3>', '</h3>' );
        echo '</div>';
    }
    echo '</div>';
    wp_reset_postdata();
    return ob_get_clean();
}
