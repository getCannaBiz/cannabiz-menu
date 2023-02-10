<?php
/**
 * WP Dispensary Taxonomy - Color picker
 *
 * This file is used to define the color picker option for the taxonomy of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin/taxonomies
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * Strain types color field
 * 
 * @param array $taxonomy - 
 * @param array $tag      - 
 * 
 * @since  4.4.0
 * @return string
 */
function wp_dispensary_strain_types_color_field( $tag, $taxonomy ) {
    $strain_type_color = get_term_meta( $tag->term_id, 'strain_type_color', true );
    ?>
    <tr class="form-field term-strain-type-color-wrap">
        <th scope="row"><label for="strain_type_color">Color</label></th>
        <td>
            <input type="text" id="strain_type_color" name="strain_type_color" value="<?php echo esc_attr( $strain_type_color ); ?>" class="strain-type-color-field">
            <p class="description">Select a color for this strain type</p>
        </td>
    </tr>
    <script>
        jQuery(document).ready(function($){
            $('.strain-type-color-field').wpColorPicker();
        });
    </script>
    <?php
}
add_action( 'strain_types_edit_form_fields', 'wp_dispensary_strain_types_color_field', 10, 2 );

/**
 * Save strain types color field
 * 
 * @param int $term_id - 
 * @param int $tt_id   - 
 * 
 * @since  4.4.0
 * @return void
 */
function wp_dispensary_save_strain_types_color_field( $term_id, $tt_id ) {
    if ( isset( $_POST['strain_type_color'] ) ) {
        update_term_meta( $term_id, 'strain_type_color', sanitize_hex_color( $_POST['strain_type_color'] ) );
    }
}
add_action( 'edit_strain_types', 'wp_dispensary_save_strain_types_color_field', 10, 2 );

/**
 * 
 * 
 * @since  4.4.0
 * @return void
 */
function wp_dispensary_enqueue_color_picker() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'wp_dispensary_enqueue_color_picker' );

/**
 * Add strain types color column
 * 
 * @since  4.4.0
 * @return array
 */
function wp_dispensary_add_strain_types_color_column( $columns ) {
    $checkbox_column = array_slice( $columns, 0, 1 );
    $new_columns     = array( 'strain_type_color' => esc_html__( 'Color', 'wp-dispensary' ) );

    return array_merge( $checkbox_column, $new_columns, array_slice( $columns, 1 ) );
}
add_filter( 'manage_edit-strain_types_columns', 'wp_dispensary_add_strain_types_color_column' );

/**
 * Display strain types color
 * 
 * @since  4.4.0
 * @return string
 */
function wp_dispensary_display_strain_types_color( $empty, $column_name, $term_id ) {
    if ( 'strain_type_color' !== $column_name ) {
        return;
    }

    $strain_type_color = get_term_meta( $term_id, 'strain_type_color', true );

    $color_box = '<div style="display:inline-block;width:40px;height:40px;background-color:' . $strain_type_color . '"></div>';
    echo $color_box;
}
add_action( 'manage_strain_types_custom_column', 'wp_dispensary_display_strain_types_color', 10, 3 );

/**
 * Custom column width
 * 
 * @since  4.4.0
 * @return string
 */
function wp_dispensary_custom_column_widths() {
    $screen = get_current_screen();

    if ( 'edit-strain_types' !== $screen->id ) {
        return;
    }

    echo '<style type="text/css">
        #strain_type_color,
        .column-strain_type_color {
            width: 40px;
        }
    </style>';
}
add_action( 'admin_head', 'wp_dispensary_custom_column_widths' );
