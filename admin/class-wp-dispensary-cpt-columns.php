<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    WP_Dispensary
 * @subpackage CannaBiz_Menu/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.3.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

if ( ! class_exists( 'CPT_Columns' ) ) {
    /**
     * CPT_Columns
     * 
     * Simple class to add, remove, and manage admin post columns.
     * 
     * @package    WP_Dispensary
     * @subpackage CannaBiz_Menu/admin
     * @author     CannaBiz Software <contact@cannabizsoftware.com>
     * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
     * @link       https://cannabizsoftware.com
     * @since      4.3.0
     */
    class CPT_Columns {
        /**
         * $columns
         *
         * Holds columns
         * 
         * @var array
         */
        public $columns = [];

        /**
         * $remove_columns
         *
         * Holds columns to be removed
         * 
         * @var array
         */
        public $remove_columns = [];

        /**
         * $sortable_columns
         *
         * Holds sortable columns
         * 
         * @var array
         */
        public $sortable_columns = [];

        /**
         * $name 
         *
         * Holds custom post type name
         * 
         * @var string
         */
        public $name = '';

        /**
         * $replace 
         *
         * Should coulmns be replace (true) or added (false)
         * 
         * @var boolean
         */
        public $replace = false;

        /**
         * __construct
         * 
         * @param string  $cpt     - custom post type name
         * @param boolean $replace - (optional) replace or add
         * 
         * @since 4.3.0
         */
        function __construct( $cpt = '', $replace = false ) {
            $this->name = $cpt;
            $this->replace  = $replace;
            // add columns.
            add_filter( "manage_{$cpt}_posts_columns", array( $this,'_columns' ), 50 );
            // remove columns.
            add_filter( "manage_{$cpt}_posts_columns", array( $this,'_columns_remove' ), 60 );
            // display columns.
            add_action( "manage_{$cpt}_posts_custom_column", array( $this,'_custom_column' ), 50, 2 );
            // sortable columns.
            add_filter( "manage_edit-{$cpt}_sortable_columns", array( $this, '_sortable_columns' ), 50 );
            // sort order.
            add_filter( 'pre_get_posts', array( $this, '_column_orderby' ), 50 );
        }
 
        /**
         * Columns: _columns 
         * 
         * @param array $defaults 
         * 
         * @since  4.3.0
         * @return array
         */
        function _columns( $defaults ) {
            global $typenow;
            if ( $this->name == $typenow ) {
                $tmp = [];
                if ( $this->replace ) {
                    foreach ( $this->columns as $key => $args ) {
                        $tmp[ $key ] = $args[ 'label' ];
                    }
                    return $tmp;
                } else {
                    foreach ( $this->columns as $key => $args ) {
                        $tmp[ $key ] = $args[ 'label' ];
                        if ( isset( $args[ 'order' ] ) ) {
                            $before   = array_slice( $defaults, 0, $args[ 'order' ] );
                            $after    = array_slice( $defaults, $args[ 'order' ] );
                            $return   = array_merge( $before, ( array ) $tmp );
                            $defaults = array_merge( $return, $after );
                        } else {
                            $defaults = array_merge( $defaults, $tmp );
                        }
                        $tmp = [];
                    }
                }
            }

            return $defaults;
        }
 
        /**
         * Columns remove: _columns_remove 
         *
         * Used to remove columns.
         * 
         * @param array $columns 
         * 
         * @since  4.3.0
         * @return array         
         */
        function _columns_remove( $columns ) {
            // Loop through columns that should be removed.
            foreach ( $this->remove_columns as $key ) {
                if ( isset( $columns[$key] ) ) {
                    unset( $columns[$key] );
                }
            }
            return $columns;
        }

        /**
         * Sortable columns: _sortable_columns 
         *
         * Sets sortable columns
         * 
         * @param array $columns 
         * 
         * @since  4.3.0
         * @return array
         */
        function _sortable_columns( $columns ) {
            global $typenow;
            if ( $this->name == $typenow ) {
                foreach ( $this->sortable_columns as $key => $args ) {
                    $columns[$key] = $key;
                }
            }
            return $columns;
        }

        /**
         * Custom column: _custom_column
         *
         * Calls do_column() when the column is set
         * 
         * @param string $column_name - column name
         * @param int    $post_id     - post ID
         * 
         * @since  4.3.0
         * @return void
         */
        function _custom_column( $column_name, $post_id ) {
            if ( isset( $this->columns[$column_name] ) ) {
                $this->do_column( $post_id, $this->columns[$column_name], $column_name );
            }
        }
 
        /**
         * Do Column: do_column
         *
         * Used to display the column
         * 
         * @param int    $post_id     - post ID
         * @param array  $column      - column args
         * @param string $column_name - column name
         * 
         * @since  4.3.0
         * @return void
         */
        function do_column( $post_id, $column, $column_name ) {
            if ( in_array( $column['type'], array( 'text', 'thumb', 'post_meta', 'custom_tax', 'custom_html' ) ) ) {
                echo $column['prefix'];
            }
            switch ( $column['type'] ) {
            case 'text':
                echo apply_filters( 'columns_text_' . $column_name, $column['text'], $post_id, $column, $column_name );
                break;
            case 'thumb':
                if ( has_post_thumbnail( $post_id ) ) {
                    the_post_thumbnail( $column['size'] );
                } else {
                    echo '';
                }
                break;
            case 'post_meta':
                $tmp = get_post_meta( $post_id, $column['meta_key'], true );
                echo ( ! empty( $tmp ) ) ? $tmp : $column['std'];
                break;
            case 'custom_tax':
                $post_type = get_post_type( $post_id );
                $terms     = get_the_terms( $post_id, $column['taxonomy'] );
                if ( ! empty( $terms ) ) {
                    foreach ( $terms as $term ) {
                        // Set variables.
                        $href = "edit.php?post_type={$post_type}&{$column['taxonomy']}={$term->slug}";
                        $name = esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, $column['taxonomy'], 'edit' ) );
                        // Add post terms.
                        $post_terms[] = "<a href='{$href}'>{$name}</a>";
                    }
                    echo join( ', ', $post_terms );
                } else {
                    echo '';
                }
                break;
            case 'custom_html':
                echo apply_filters( 'columns_custom_html_' . $column_name, $column['html'], $post_id, $column, $column_name );
                break;
            }
            // Display column.
            if ( in_array( $column['type'], array( 'text', 'thumb', 'post_meta', 'custom_tax', 'custom_html' ) ) ) {
                echo $column['suffix'];
            }
        }
 
        /**
         * Column orderby: _column_orderby
         *
         * Used to roder by meta keys
         * 
         * @param object $query 
         * 
         * @since  4.3.0
         * @return void
         */
        function _column_orderby( $query ) {
            // Bail early?
            if ( ! is_admin() ) {
                return;
            }

            $orderby = $query->get( 'orderby' );
            $keys    = array_keys( (array)$this->sortable_columns );

            if ( in_array( $orderby, $keys ) ) {
                // Order by meta.
                if ( 'post_meta' == $this->sortable_columns[$orderby]['type'] ) {
                    $query->set( 'meta_key', $orderby );
                    $query->set( 'orderby', $this->sortable_columns[$orderby]['orderby'] );
                }
            }
        }
 
        /**
         * Add Column: add_column
         *
         * Used to add column
         * 
         * @param string $key  - column ID.
         * @param array  $args - column arguments
         * 
         * @since  4.3.0
         * @return void
         */
        function add_column( $key, $args ) {
            $def = array(
                'label'    => esc_html__( 'Column label', 'cannabiz-menu' ), 
                'size'     => array( '80', '80' ),
                'taxonomy' => '',
                'meta_key' => '',
                'sortable' => false,
                'text'     => '',
                'type'     => 'native', // 'native', 'post_meta', 'custom_tax', text
                'orderby'  => 'meta_value',
                'prefix'   => '',
                'suffix'   => '',
                'std'      => '',
            );

            $this->columns[$key] = array_merge( $def, $args );
 
            if ( $this->columns[$key]['sortable'] ) {
                $this->sortable_columns[$key] = $this->columns[$key];
            }
        }
 
        /**
         * Remove Column: remove_column
         *
         * Used to remove columns
         * 
         * @param string $key - column key to be removed
         * 
         * @since  4.3.0
         * @return void
         */
        function remove_column( $key ) {
            $this->remove_columns[] = $key;
        }
 
    }
}
