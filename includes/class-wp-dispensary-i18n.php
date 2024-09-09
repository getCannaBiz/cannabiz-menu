<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      1.0.0
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 * @author     CannaBiz Software <contact@cannabizsoftware.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://cannabizsoftware.com
 * @since      1.0.0
 */
class WP_Dispensary_i18n {

    /**
     * The domain specified for this plugin.
     *
     * @since  1.0.0
     * @access private
     *
     * @var string $_domain The domain identifier for this plugin.
     */
    private $_domain;

    /**
     * Load the plugin text domain for translation.
     *
     * @since  1.0.0
     * @access public
     *
     * @return void
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
            $this->domain,
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );

    }

    /**
     * Set the domain equal to that of the specified domain.
     *
     * @param string $_domain The domain that represents the locale of this plugin.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function set_domain( $_domain ) {
        $this->domain = $_domain;
    }
}
