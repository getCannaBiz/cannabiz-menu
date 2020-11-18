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
     * @since  4.0
     * @return void
     */
    function convert_taxonomies( $product_type, $old_tax, $new_tax ) {
        // Get products.
        $products = get_posts( array(
            'post_type'      => $product_type,
            'posts_per_page' => -1,
            'post_status'    => array( 'publish', 'pending', 'draft', 'future', 'private' ),
            'tax_query'      => array( array(
                'taxonomy' => $old_tax,
                'operator' => 'EXISTS'
            ) )
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

if ( ! function_exists( 'convert_metadata' ) ) {
    /**
     * Convert Metadata.
     * 
     * @param  string $post_type
     * @since  4.0
     * @return void
     */
    function convert_metadata( $post_type = '' ) {
        // Bail early if no post type is passed.
        if ( ! isset( $post_type ) ) {
            return;
        }

        // Get products.
        $products = get_posts( array(
            'numberposts' => -1,
            'post_type'   => $post_type,
            'post_status' => array( 'publish', 'pending', 'draft', 'future', 'private' )
        ) );

        // Make sure products exist.
        if ( $products ) {

            // Loop through all posts.
            foreach( $products as $post ) : setup_postdata( $post );

                if ( 'flowers' == $post_type ) {
                    // Prices metadata.
                    $gram      = get_post_meta( $post->ID, '_gram', true );
                    $twograms  = get_post_meta( $post->ID, '_twograms', true );
                    $eighth    = get_post_meta( $post->ID, '_eighth', true );
                    $fivegrams = get_post_meta( $post->ID, '_fivegrams', true );
                    $quarter   = get_post_meta( $post->ID, '_quarter', true );
                    $halfounce = get_post_meta( $post->ID, '_halfounce', true );
                    $ounce     = get_post_meta( $post->ID, '_ounce', true );

                    // Top Sellers metadata.
                    $top_sellers = get_post_meta( $post->ID, 'wpd_topsellers', true );

                    // Inventory metadata.
                    $inventory_count   = get_post_meta( $post->ID, '_inventory_flowers', true );
                    $inventory_display = get_post_meta( $post->ID, 'wpd_inventory_display', true );

                    // Update new meta.
                    update_post_meta( $post->ID, 'price_gram', $gram );
                    update_post_meta( $post->ID, 'price_two_grams', $twograms );
                    update_post_meta( $post->ID, 'price_eighth', $eighth );
                    update_post_meta( $post->ID, 'price_five_grams', $fivegrams );
                    update_post_meta( $post->ID, 'price_quarter_ounce', $quarter );
                    update_post_meta( $post->ID, 'price_half_ounce', $halfounce );
                    update_post_meta( $post->ID, 'price_ounce', $ounce );
                    update_post_meta( $post->ID, 'top_sellers', $top_sellers );
                    update_post_meta( $post->ID, 'inventory', $inventory_count );
                    update_post_meta( $post->ID, 'inventory_display', $inventory_display );

                    // Delete old meta.
                    delete_post_meta( $post->ID, '_gram' );
                    delete_post_meta( $post->ID, '_twograms' );
                    delete_post_meta( $post->ID, '_eighth' );
                    delete_post_meta( $post->ID, '_fivegrams' );
                    delete_post_meta( $post->ID, '_quarter' );
                    delete_post_meta( $post->ID, '_halfounce' );
                    delete_post_meta( $post->ID, '_ounce' );
                    delete_post_meta( $post->ID, 'wpd_topsellers' );
                    delete_post_meta( $post->ID, '_inventory_flowers' );
                    delete_post_meta( $post->ID, 'wpd_inventory_display' );
                }

            endforeach;	
        }

    }

}