<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage CannaBiz_Menu/admin
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      4.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

if ( ! class_exists( 'WP_Dispensary_Vendor_Taxonomy_Fields' ) ) {

    /**
     * Class - Vendor Taxonomy Fields
     * 
     * @package    WP_Dispensary
     * @subpackage CannaBiz_Menu/admin
     * @author     CannaBiz Software <contact@cannabizsoftware.com>
     * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
     * @link       https://cannabizsoftware.com
     */
    class WP_Dispensary_Vendor_Taxonomy_Fields {

        /**
         * Construct
         */
        public function __construct() {
            // Do something?
        }

        /**
         * Initialize the class and start calling our hooks and filters
         * 
         * @since  4.0
         * @return void
         */
        public function init() {
            add_action( 'vendors_add_form_fields', array( $this, 'add_vendor_logo_image' ), 10, 2 );
            add_action( 'created_vendors', array( $this, 'save_vendor_logo_image' ), 10, 1 );
            add_action( 'vendors_edit_form_fields', array( $this, 'update_vendor_logo_image' ), 10, 2 );
            add_action( 'edited_vendors', array( $this, 'updated_vendor_logo_image' ), 10, 1 );
            add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
            add_action( 'admin_footer', array( $this, 'add_script' ) );
        }

        /**
         * Load the media
         * 
         * @since  4.0
         * @return void
         */
        public function load_media() {
            wp_enqueue_media();
        }
    
        /**
         * Add a form field in the vendor taxonomy page
         * 
         * @param string $taxonomy 
         * 
         * @since  4.0
         * @return void
         */
        public function add_vendor_logo_image( $taxonomy ) { ?>
        <div class="form-field term-group">
            <label for="vendor_logo"><?php esc_html_e( 'Logo', 'cannabiz-menu' ); ?></label>
            <input type="hidden" id="vendor_logo" name="vendor_logo" class="custom_media_url" value="">
            <div id="vendor-logo-wrapper"></div>
            <p>
                <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_html_e( 'Add Image', 'cannabiz-menu' ); ?>" />
                <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'cannabiz-menu' ); ?>" />
            </p>
        </div>
            <?php
        }
    
        /**
         * Save the form field
         * 
         * @param int $term_id 
         * 
         * @since  4.0
         * @return void
         */
        public function save_vendor_logo_image( $term_id ) {
            if ( null !== filter_input( INPUT_POST, 'vendor_logo' ) && '' !== filter_input( INPUT_POST, 'vendor_logo' ) ) {
                $image = filter_input( INPUT_POST, 'vendor_logo' );
                add_term_meta( $term_id, 'vendor_logo', $image, true );
            }
        }
    
        /**
         * Edit the form field
         * 
         * @param int $term 
         * @param int $taxonomy 
         * 
         * @since  4.0
         * @return void
         */
        public function update_vendor_logo_image( $term, $taxonomy ) { ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="vendor_logo"><?php esc_html_e( 'Logo', 'cannabiz-menu' ); ?></label>
            </th>
            <td>
                <?php $image_id = get_term_meta( $term->term_id, 'vendor_logo', true ); ?>
                <input type="hidden" id="vendor_logo" name="vendor_logo" value="<?php esc_attr_e( $image_id ); ?>">
                <div id="vendor-logo-wrapper">
                    <?php if ( $image_id ) { ?>
                        <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
                    <?php } ?>
                </div>
                <p>
                    <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php esc_html_e( 'Add Image', 'cannabiz-menu' ); ?>" />
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'cannabiz-menu' ); ?>" />
                </p>
            </td>
        </tr>
            <?php
        }

        /**
         * Update the form field value
         * 
         * @param int $term_id 
         * 
         * @since  4.0
         * @return void
         */
        public function updated_vendor_logo_image( $term_id ) {
            if ( null !== filter_input( INPUT_POST, 'vendor_logo' ) && '' !== filter_input( INPUT_POST, 'vendor_logo' ) ) {
                $image = filter_input( INPUT_POST, 'vendor_logo' );
                update_term_meta( $term_id, 'vendor_logo', $image );
            } else {
                update_term_meta( $term_id, 'vendor_logo', '' );
            }
        }

        /**
         * Add script
         * 
         * @since  4.0
         * @return string 
         */
        public function add_script() { ?>
        <script>
            jQuery(document).ready( function($) {
            function ct_media_upload(button_class) {
                var _custom_media = true,
                _orig_send_attachment = wp.media.editor.send.attachment;
                $('body').on('click', button_class, function(e) {
                    var button_id = '#'+$(this).attr('id');
                    var send_attachment_bkp = wp.media.editor.send.attachment;
                    var button = $(button_id);
                    _custom_media = true;
                    wp.media.editor.send.attachment = function(props, attachment){
                        if ( _custom_media ) {
                        $('#vendor_logo').val(attachment.id);
                        $('#vendor-logo-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                        $('#vendor-logo-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                        } else {
                        return _orig_send_attachment.apply( button_id, [props, attachment] );
                        }
                    }
                    wp.media.editor.open(button);
                    return false;
                });
            }
            ct_media_upload('.ct_tax_media_button.button'); 
            $('body').on('click','.ct_tax_media_remove',function(){
                $('#vendor_logo').val('');
                $('#vendor-logo-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
            });
            $(document).ajaxComplete(function(event, xhr, settings) {
                var queryStringArr = settings.data.split('&');
                if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
                    var xml = xhr.responseXML;
                    $response = $(xml).find('term_id').text();
                    if($response!=""){
                        // Clear the thumb image
                        $('#vendor-logo-wrapper').html('');
                    }
                }
            });
        });
        </script>
            <?php
        }
    } // end class.
 
    $WPD_Vendor_Taxonomy_Fields = new WP_Dispensary_Vendor_Taxonomy_Fields();
    $WPD_Vendor_Taxonomy_Fields->init();

}
