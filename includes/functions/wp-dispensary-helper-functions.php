<?php
/**
 * The file that defines the general helper functions.
 *
 * @link       https://www.wpdispensary.com
 * @since      3.4
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 */

if ( ! function_exists( 'convert_taxonomies' ) ) {
    /**
     * Convert Taxonomies
     *
     * @param  string $product_type
     * @param  string $old_tax
     * @param  string $new_tax
     * @return void
     */
    function convert_taxonomies( $product_type, $old_tax, $new_tax ) {
        // Get products.
        $products = get_posts( array(
            'post_type'      => $product_type,
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => $old_tax,
                    'operator' => 'EXISTS'
                )
            )
        ) );
        // Loop through products.
        foreach( $products as $product ) {
            $terms      = get_the_terms( $product->ID, $old_tax );
            $term       = array();
            $term_array = array();
            // Loop through terms.
            foreach( $terms as $t ) {
                $term_array[] = $t->name;
                if ( false == get_term_by( 'name', $t->name, $new_tax ) ) {
                   wp_insert_term( $t->name, $new_tax, $args = array() );
                }
                wp_set_object_terms( $product->ID, $term_array, $new_tax ); 
            }
        }
    }
}
