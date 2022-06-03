<?php
/**
 * Register the products class for this plugin
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

/**
 * Define the WPD_Products class
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */
class WPD_Products {
    /**
     * WordPress query object.
     *
     * @var WP_Query
     */
    private $_query;

    /**
     * Constructor.
     *
     * @param WP_Query $_query 
     */
    public function __construct( WP_Query $_query ) {
        $this->query = $_query;
    }

    /**
     * Initialize the repository.
     *
     * @uses PHP 5.3
     *
     * @return self
     */
    public static function init() {
        return new self( new WP_Query() );
    }

    /**
     * Find posts written by the given author.
     *
     * @param WP_User $author 
     * @param int     $limit 
     *
     * @return WP_Post[]
     */
    public function find_by_author( WP_User $author, $limit = 10 ) {
        return $this->find( array(
            'author'         => $author->ID,
            'posts_per_page' => $limit,
        ) );
    }

    /**
     * Find a post using the given post ID.
     *
     * @param int $id 
     *
     * @return WP_Post|null
     */
    public function find_by_id( $id ) {
        return $this->find_one( array( 'p' => $id ) );
    }

    /**
     * Get products
     *
     * @param array $post_count 
     *
     * @return WP_Post|null
     */
    public function get_products( $post_count ) {
        // Update query to only find 1 result.
        $_query = array(
            'post_type'      => 'products',
            'posts_per_page' => $post_count,
        );

        return $this->query->query( $_query );
    }

    /**
     * Find all post objects for the given query.
     *
     * @param array $_query 
     *
     * @return WP_Post[]
     */
    private function find( array $_query ) {
        $_query = array_merge( array(
            'post_type'              => 'products',
            'no_found_rows'          => true,
            'update_post_meta_cache' => true,
            'update_post_term_cache' => false,
        ), $_query );

        return $this->query->query( $_query );
    }

    /**
     * Find a single post object for the given query. Returns null
     * if it doesn't find one.
     *
     * @param array $_query 
     *
     * @return WP_Post|null
     */
    private function find_one( array $_query ) {
        // Update query to only find 1 result.
        $_query = array_merge( $_query, array(
            'post_type'      => 'products',
            'posts_per_page' => 1,
        ) );
        // Find the post
        return $this->query->query( $_query );
    }

    /**
     * Save a post into the repository. Returns the post ID or a WP_Error.
     *
     * @param array $product 
     *
     * @return int|WP_Error
     */
    public function save( array $product ) {
        // Update post if $product exists.
        if ( ! empty( $product['ID'] ) ) {
            return wp_update_post( $product, true );
        }
        // Insert post if $product doesn't exist.
        return wp_insert_post( $product, true );
    }

}
