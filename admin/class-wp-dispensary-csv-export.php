<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 * @author     Robert DeVore <deviodigital@gmail.com>
 */
class CSVExport {
    /**
    * Constructor
    */
    public function __construct() {
        if ( isset( $_GET['export_products'] ) ) {

            // Run generate CSV function.
            $csv = $this->generate_csv();

            header( "Pragma: public" );
            header( "Expires: 0" );
            header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
            header( "Cache-Control: private", false );
            header( "Content-Type: application/octet-stream" );
            header( "Content-Disposition: attachment; filename=\"wp-dispensary-products.csv\";" );
            header( "Content-Transfer-Encoding: binary" );

            echo $csv;
            exit;
        }

        // Add extra menu items for admins.
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );

        // Create end-points
        add_filter( 'query_vars', array( $this, 'query_vars' ) );
        add_action( 'parse_request', array( $this, 'parse_request' ) );
    }

    /**
    * Add extra menu items for admins
    */
    public function admin_menu() {
        add_submenu_page( 'wpd-settings', 'Export Products', 'Export Products', 'manage_options', 'export_products', array( $this, 'export_products' ) );
        //add_menu_page( 'Export Products', 'Export Products', 'manage_options', 'export_products', array( $this, 'export_products' ) );
    }

    /**
    * Allow for custom query variables
    */
    public function query_vars( $query_vars ) {
        $query_vars[] = 'export_products';
        return $query_vars;
    }

    /**
     * Parse the request
     */
    public function parse_request( &$wp ) {
        if ( array_key_exists( 'export_products', $wp->query_vars ) ) {
            $this->export_products();
            exit;
        }
    }

    /**
     * Export WP Dispensary products
     */
    public function export_products() {
        echo '<div class="wrap">';
        echo '<h2>' . __( 'WP Dispensary\'s Product Export', 'wp-dispensary' ) . '</h2>';
        echo '<p>' . __( 'Export your WP Dispensary products as a CSV file by clicking the button below.', 'wp-dispensary' ) . '</p>';
        echo '<p><a class="button" href="admin.php?page=export_products&export_products&_wpnonce=' . wp_create_nonce( 'download_csv' ) . '">' . __( 'Export', 'wp-dispensary' ) . '</a></p>';
    }

    /**
     * Converting data to CSV
     */
    public function generate_csv() {
        ob_start();

        $domain    = $_SERVER['SERVER_NAME'];
        $file_name = 'wpd-products-' . $domain . '-' . time() . '.csv';

        // Set the headers.
        $header_row = array(
            'ID',
            'Type',
            'Title',
            'Content',
            'Slug',
            'Date',
            'Author',
            '1/2 gram',
            '1 gram',
            '2 grams',
            '1/8 ounce',
            '5 grams',
            '1/4 ounce',
            '1/2 ounce',
            '1 ounce',
            'Price each',
            'Price per pack',
            'Units per pack',
            'Inventory',
            'Categories',
            'Featured Image'
        );

        // Filter headers.
        $header_row = apply_filters( 'wpd_csv_export_header_row', $header_row );

        // Data rows.
        $data_rows = array();

        global $wpdb;

        $sql      = 'SELECT * FROM ' . $wpdb->posts . ' AS P WHERE P.post_type IN ( "flowers", "concentrates", "edibles", "prerolls", "topicals", "growers", "gear", "tinctures" ) and P.post_status = "publish"';
        $products = $wpdb->get_results( $sql, 'ARRAY_A' );

        // Set the rows (matches headers).
        foreach ( $products as $product ) {

            //print_r( $product );

            $cat_id = '';

            if ( 'flowers' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_flowers', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'flowers_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'flowers_category', array( 'fields' => 'ids' ) );
                $price_each       = '';
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } elseif ( 'concentrates' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_concentrates', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'concentrates_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'concentrates_category', array( 'fields' => 'ids' ) );
                $price_each       = get_post_meta( $product['ID'], '_priceeach', TRUE );
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } elseif ( 'edibles' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_edibles', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'edibles_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'edibles_category', array( 'fields' => 'ids' ) );
                $price_each       = get_post_meta( $product['ID'], '_priceeach', TRUE );
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } elseif ( 'prerolls' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_prerolls', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'prerolls_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'flowers_category', array( 'fields' => 'ids' ) );
                $price_each       = get_post_meta( $product['ID'], '_priceeach', TRUE );
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } elseif ( 'topicals' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_topicals', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'topicals_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'topicals_category', array( 'fields' => 'ids' ) );
                $price_each       = get_post_meta( $product['ID'], '_pricetopical', TRUE );
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } elseif ( 'growers' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_growers', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'growers_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'growers_category', array( 'fields' => 'ids' ) );
                $price_each       = get_post_meta( $product['ID'], '_priceeach', TRUE );
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } elseif ( 'gear' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_gear', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'wpd_gear_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'wpd_gear_category', array( 'fields' => 'ids' ) );
                $price_each       = get_post_meta( $product['ID'], '_priceeach', TRUE );
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } elseif ( 'tinctures' == $product['post_type'] ) {
                $inventory_amount = get_post_meta( $product['ID'], '_inventory_tinctures', TRUE );
//                $category_name    = get_the_terms( $product['ID'], 'tinctures_category' );
                $category_name    = wp_get_post_terms( $product['ID'], 'tinctures_category', array( 'fields' => 'ids' ) );
                $price_each       = get_post_meta( $product['ID'], '_priceeach', TRUE );
                if ( $category_name && ! is_wp_error( $category_name ) ) {
                    foreach ( $category_name as $cat=>$value ) {
                        $cat_id .= $value->term_id;
                    }
                }
            } else {
                // Do nothing.
            }

            // Create row.
            $row = array(
                $product['ID'],
                $product['post_type'],
                $product['post_title'],
                $product['post_content'],
                $product['post_name'],
                $product['post_date'],
                $product['post_author'],
                get_post_meta( $product['ID'], '_halfgram', TRUE ),
                get_post_meta( $product['ID'], '_gram', TRUE ),
                get_post_meta( $product['ID'], '_twograms', TRUE ),
                get_post_meta( $product['ID'], '_eighth', TRUE ),
                get_post_meta( $product['ID'], '_fivegrams', TRUE ),
                get_post_meta( $product['ID'], '_quarter', TRUE ),
                get_post_meta( $product['ID'], '_halfounce', TRUE ),
                get_post_meta( $product['ID'], '_ounce', TRUE ),
                $price_each,
                get_post_meta( $product['ID'], '_priceperpack', TRUE ),
                get_post_meta( $product['ID'], '_unitsperpack', TRUE ),
                $inventory_amount,
                $cat_id,
                get_post_thumbnail_id( $product['ID'] ),
            );
            $data_rows[] = apply_filters( 'wpd_csv_export_data_row', $row );
        }

        $fh = @fopen( 'php://output', 'w' );

        fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );

        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
        header( 'Content-Description: File Transfer' );
        header( 'Content-type: text/csv' );
        header( "Content-Disposition: attachment; filename={$file_name}" );
        header( 'Expires: 0' );
        header( 'Pragma: public' );

        fputcsv( $fh, $header_row );

        foreach ( $data_rows as $data_row ) {
            fputcsv( $fh, $data_row );
        }

        fclose( $fh );

        ob_end_flush();

        die();
    }
}

// Instantiate a singleton of this plugin.
$csvExport = new CSVExport();
