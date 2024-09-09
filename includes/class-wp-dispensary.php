<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/includes
 * @author     WP Dispensary <contact@wpdispensary.com>
 * @license    GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://www.wpdispensary.com
 * @since      4.0.0
 */
class WP_Dispensary {

    /**
     * The loader that's responsible for maintaining and registering all 
     * hooks that power the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    WP_Dispensary_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function __construct() {

        $this->plugin_name = 'wp-dispensary';
        $this->version     = '4.4.0';

        if ( defined( 'WP_DISPENSARY_VERSION' ) ) {
            $this->version = WP_DISPENSARY_VERSION;
        }

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - WP_Dispensary_Loader. Orchestrates the hooks of the plugin.
     * - WP_Dispensary_i18n. Defines internationalization functionality.
     * - WP_Dispensary_Admin. Defines all hooks for the admin area.
     * - WP_Dispensary_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-dispensary-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-dispensary-i18n.php';

        /**
         * The class responsible for defining the custom logging class
         * 
         * @since 4.3.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-dispensary-wpd-logging.php';

        /**
         * The class responsible for customizing the post type admin columns
         * 
         * @since 4.3.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-dispensary-cpt-columns.php';

        /**
         * The class responsible for defining all actions that occur in the 
         * admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-dispensary-admin.php';

        /**
         * The file responsible for defining custom user roles
         * 
         * @since 4.4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-user-roles.php';

        /**
         * The file responsible for defining all admin menu related functionality
         * 
         * @since 4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-admin-menu-links.php';

        /**
         * The class responsible for defining all actions that occur in the 
         * public-facing side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-dispensary-public.php';

        /**
         * The files responsible for defining all oEmbed related functionality
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/wp-dispensary-oembed.php';

        /**
         * Adding in custom functions that are used throughout the rest of the plugin
         *
         * @since 2.0.0 - last updated in version 4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/deprecated-functions.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/wp-dispensary-helper-functions.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/wp-dispensary-general-functions.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/wp-dispensary-settings-functions.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/wp-dispensary-pricing-functions.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/wp-dispensary-product-functions.php';

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-categories.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-taxonomies.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-flowers.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-concentrates.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-edibles.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-prerolls.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-topicals.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/wp-dispensary-growers.php';

        /**
         * The file responsible for defining the product reviews functionality.
         * 
         * @since 4.2.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-product-reviews.php';

        /**
         * The file responsible for defining the custom image sizes.
         * 
         * @since 4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-image-sizes.php';

        /**
         * The functions responsible for updating WP Dispensary data during 
         * the plugin upgrades
         * 
         * @since 4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-plugin-upgrade.php';

        /**
         * The functions responsible for building the custom post types
         *
         * @since 1.0.0 - last updated v4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-taxonomies.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-metaboxes.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-products-post-type.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-widgets.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-dispensary-vendors-taxonomy-fields.php';

        /**
         * Adding custom post type taxonomy and metabox data to WP REST API
         *
         * @since 1.1.0 - last updated v4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-rest-api.php';

        /**
         * Adding deprecated shortcodes
         *
         * @since 3.3.3
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/deprecated/deprecated-shortcodes.php';

        /**
         * Adding shortcode generation
         *
         * @since 1.2.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-shortcodes.php';

        /**
         * Adding admin settings page
         *
         * @since 1.6.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-admin-settings.php';

        /**
         * Adding metaboxes and taxonomy data output in the_content
         *
         * @since 1.6.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-data-output.php';

        /**
         * Adding code to admin screens
         *
         * @since 1.9.16
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wp-dispensary-admin-screens.php';

        /**
         * Adding the Class responsible for defining custom permalink settings
         *
         * @since 2.2
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-dispensary-permalink-settings.php';

        /**
         * Adding the Class responsible for CSV product export.
         * 
         * @since 4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-dispensary-csv-export.php';

        /**
         * Adding the Class responsible managing Products.
         * 
         * @since 4.0
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-dispensary-products.php';

        $this->loader = new WP_Dispensary_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the WP_Dispensary_i18n class in order to set the domain and to 
     * register the hook with WordPress.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function set_locale() {

        $plugin_i18n = new WP_Dispensary_i18n();
        $plugin_i18n->set_domain( $this->get_plugin_name() );

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function define_admin_hooks() {

        $plugin_admin = new WP_Dispensary_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function define_public_hooks() {

        $plugin_public = new WP_Dispensary_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since  1.0.0
     * @access public
     * @return string The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since  1.0.0
     * @access public
     * @return WP_Dispensary_Loader Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since  1.0.0
     * @access public
     * @return string The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }
}
