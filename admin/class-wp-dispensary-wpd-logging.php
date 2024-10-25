<?php

/**
 * The file that defines the WPD_Logging plugin class
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.3.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

if ( ! class_exists( 'WPD_Logging' ) ) {
    /**
     * Class for logging events and errors
     * 
     * Original code for this class (c) 2012, Pippin Williamson
     *
     * @package    WP_Dispensary
     * @subpackage WP_Dispensary/admin
     * @author     CannaBiz Software <contact@cannabizsoftware.com>
     * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
     * @link       https://cannabizsoftware.com
     * @since      4.3.0
     */
    class WPD_Logging {
        /**
         * Class constructor.
         *
         * @access public
         * @since  1.0
         * @return void
         */
        function __construct() {
            // Create the log post type.
            add_action( 'init', array( $this, 'register_post_type' ) );
            // Create types taxonomy and default types.
            add_action( 'init', array( $this, 'register_taxonomy' ) );
            // Make a cron job for this hook to start pruning.
            add_action( 'wpd_logging_prune_routine', array( $this, 'prune_logs' ) );
        }

        /**
         * Allows you to tie in a cron job and prune old logs.
         *
         * @access public
         * @uses   $this->get_logs_to_prune() - Returns array of posts via get_posts of logs to prune
         * @uses   $this->prune_old_logs()    - Deletes the logs that we don't want anymore
         * @since  4.3.0
         * @return void
         */
        public function prune_logs() {

            $should_we_prune = apply_filters( 'wpd_logging_should_we_prune', false );

            if ( $should_we_prune === false ) {
                return;
            }

            $logs_to_prune = $this->get_logs_to_prune();

            if ( isset( $logs_to_prune ) && ! empty( $logs_to_prune ) ){
                $this->prune_old_logs( $logs_to_prune );
            }

        }

        /**
         * Deletes the old logs that we don't want
         *
         * @param array|object $logs - required - The array of logs we want to prune
         *
         * @filter wpd_logging_force_delete_log - Allows user to override the force delete setting which bypasses the trash
         * @uses   wp_delete_post() - Deletes the post from WordPress
         * @access private
         * @since  4.3.0
         * @return void
         */
        private function prune_old_logs( $logs ) {

            $force = apply_filters( 'wpd_logging_force_delete_log', true );

            foreach ( $logs as $l ) {
                $id = is_int( $l ) ? $l : $l->ID;
                wp_delete_post( $id, $force );
            }

        }

        /**
         * Returns an array of posts that are prune candidates.
         *
         * @filter wpd_logging_prune_when           Users can change how long ago we are looking for logs to prune
         * @filter wpd_logging_prune_query_args     Gives users access to change any query args for pruning
         * 
         * @access private
         * @uses   apply_filters() - Allows users to change given args
         * @uses   get_posts()     - Returns an array of posts from given args
         * @since  4.3.0
         * @return array
         */
        private function get_logs_to_prune() {

            $how_old = apply_filters( 'wpd_logging_prune_when', '2 weeks ago' );

            $args = array(
                'post_type'      => 'wpd_log',
                'posts_per_page' => '100',
                'date_query'     => array(
                    array(
                        'column' => 'post_date_gmt',
                        'before' => (string) $how_old,
                    )
                )
            );

            $old_logs = get_posts( apply_filters( 'wpd_logging_prune_query_args', $args ) );

            return $old_logs;
        }

        /**
         * Log types
         *
         * Sets up the default log types and allows for new ones to be created
         *
         * @access private
         * @since  4.3.0
         * @return array
         */
        private static function log_types() {
            $terms = array(
                'error', 'event', 'payment'
            );

            return apply_filters( 'wpd_log_types', $terms );
        }

        /**
         * Registers the wpd_log Post Type
         *
         * @access public
         * @uses   register_post_type()
         * @since  4.3.0
         * @return void
         */
        public function register_post_type() {
            $log_args = array(
                'labels'          => array( 'name' => esc_html__( 'Logs', 'cannabiz-menu' ) ),
                'public'          => apply_filters( 'wpd_logging_is_public', false ),
                'query_var'       => false,
                'rewrite'         => false,
                'capability_type' => 'post',
                'supports'        => array( 'title', 'editor' ),
                'can_export'      => false
            );
            register_post_type( 'wpd_log', apply_filters( 'wpd_logging_post_type_args', $log_args ) );

        }

        /**
         * Registers the Type Taxonomy
         *
         * The Type taxonomy is used to determine the type of log entry
         *
         * @access public
         * @uses   register_taxonomy()
         * @uses   term_exists()
         * @uses   wp_insert_term()
         * @since  4.3.0
         * @return void
         */
        public function register_taxonomy() {

            register_taxonomy( 'wpd_log_type', 'wpd_log', array( 'public' => defined( 'WP_DEBUG' ) && WP_DEBUG ) );

            $types = self::log_types();

            foreach ( $types as $type ) {
                if ( ! term_exists( $type, 'wpd_log_type' ) ) {
                    wp_insert_term( $type, 'wpd_log_type' );
                }
            }
        }

        /**
         * Check if a log type is valid
         *
         * Checks to see if the specified type is in the registered list of types
         *
         * @access private
         * @since  4.3.0
         * @return array
         */
        private static function valid_type( $type ) {
            return in_array( $type, self::log_types() );
        }

        /**
         * Create new log entry
         *
         * This is just a simple and fast way to log something. Use self::insert_log()
         * if you need to store custom meta data
         *
         * @access private
         * @uses   self::insert_log()
         * @since  4.3.0
         * @return int
         */
        public static function add( $title = '', $message = '', $parent = 0, $type = null ) {

            $log_data = array(
                'post_title'   => $title,
                'post_content' => $message,
                'post_parent'  => $parent,
                'log_type'     => $type
            );

            return self::insert_log( $log_data );
        }

        /**
         * Stores a log entry
         *
         * @access private
         * @uses   wp_parse_args()
         * @uses   wp_insert_post()
         * @uses   update_post_meta()
         * @uses   wp_set_object_terms()
         * @uses   sanitize_key()
         * @since  4.3.0
         * @return int
         */
        public static function insert_log( $log_data = [], $log_meta = [] ) {

            $defaults = array(
                'post_type'    => 'wpd_log',
                'post_status'  => 'publish',
                'post_parent'  => 0,
                'post_content' => '',
                'log_type'     => false
            );

            $args = wp_parse_args( $log_data, $defaults );

            do_action( 'wpd_pre_insert_log' );

            // Store the log entry.
            $log_id = wp_insert_post( $args );

            // Set the log type, if any.
            if ( $log_data['log_type'] && self::valid_type( $log_data['log_type'] ) ) {
                wp_set_object_terms( $log_id, $log_data['log_type'], 'wpd_log_type', false );
            }

            // Set log meta, if any.
            if ( $log_id && ! empty( $log_meta ) ) {
                foreach ( (array) $log_meta as $key => $meta ) {
                    update_post_meta( $log_id, '_wpd_log_' . sanitize_key( $key ), $meta );
                }
            }

            do_action( 'wpd_post_insert_log', $log_id );

            return $log_id;
        }

        /**
         * Update and existing log item
         *
         * @access private
         * @uses   wp_parse_args()
         * @uses   wp_update_post()
         * @uses   update_post_meta()
         * @since  4.3.0
         * @return bool
         */
        public static function update_log( $log_data = [], $log_meta = [] ) {

            $defaults = array(
                'post_type'   => 'wpd_log',
                'post_status' => 'publish',
                'post_parent' => 0
            );

            $args = wp_parse_args( $log_data, $defaults );

            // store the log entry
            $log_id = wp_update_post( $args );

            do_action( 'wpd_pre_update_log', $log_id );

            if( $log_id && ! empty( $log_meta ) ) {
                foreach( (array) $log_meta as $key => $meta ) {
                    if( ! empty( $meta ) )
                        update_post_meta( $log_id, '_wpd_log_' . sanitize_key( $key ), $meta );
                }
            }

            do_action( 'wpd_post_update_log', $log_id );

        }


        /**
         * Easily retrieves log items for a particular object ID
         *
         * @access private
         * @uses   self::get_connected_logs()
         * @since  4.3.0
         * @return array
        */
        public static function get_logs( $object_id = 0, $type = null, $paged = null ) {
            return self::get_connected_logs( array( 'post_parent' => $object_id, 'paged' => $paged, 'log_type' => $type ) );
        }


        /**
         * Retrieve all connected logs
         *
         * Used for retrieving logs related to particular items, such as a specific purchase.
         *
         * @access private
         * @uses   wp_parse_args()
         * @uses   get_posts()
         * @uses   get_query_var()
         * @uses   self::valid_type()
         * @since  4.3.0
         * @return array|false
        */
        public static function get_connected_logs( $args = [] ) {

            $defaults = array(
                'post_parent'    => 0,
                'post_type'      => 'wpd_log',
                'posts_per_page' => 10,
                'post_status'    => 'publish',
                'paged'          => get_query_var( 'paged' ),
                'log_type'       => false
            );

            $query_args = wp_parse_args( $args, $defaults );

            if ( $query_args['log_type'] && self::valid_type( $query_args['log_type'] ) ) {

                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'wpd_log_type',
                        'field'    => 'slug',
                        'terms'    => $query_args['log_type']
                    )
                );

            }

            // Get logs.
            $logs = get_posts( $query_args );

            // Logs found.
            if ( $logs ) {
                return $logs;
            }

            // No logs found.
            return false;
        }

        /**
         * Retrieves number of log entries connected to particular object ID
         *
         * @access private
         * @uses   WP_Query()
         * @uses   self::valid_type()
         * @since  4.3.0
         * @return int
         */
        public static function get_log_count( $object_id = 0, $type = null, $meta_query = null ) {
            // Define query args.
            $query_args = array(
                'post_parent'    => $object_id,
                'post_type'      => 'wpd_log',
                'posts_per_page' => -1,
                'post_status'    => 'publish'
            );

            // Check if a type was passed to the function.
            if ( ! empty( $type ) && self::valid_type( $type ) ) {
                // Add tax_query data to array.
                $query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'wpd_log_type',
                        'field'    => 'slug',
                        'terms'    => $type
                    )
                );

            }

            // Add custom meta query to array?
            if ( ! empty( $meta_query ) ) {
                $query_args['meta_query'] = $meta_query;
            }

            // Get logs.
            $logs = new WP_Query( $query_args );

            // Return post count
            return (int) $logs->post_count;
        }

    }

    // Add WPD_Logging class to globals.
    $GLOBALS['wpd_logs'] = new WPD_Logging();
}
