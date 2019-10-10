<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/public
 * @author     Robert DeVore <deviodigital@gmail.com>
 */
class WP_Dispensary_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 *
	 * @param string $plugin_name   The name of the plugin.
	 * @param string $version       The version of this plugin.
	 *
	 * @return void
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Dispensary_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Dispensary_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-dispensary-public.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Dispensary_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Dispensary_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-dispensary-public.js', array( 'jquery' ), $this->version, false );

	}
}

/**
 * Register WP Dispensary's oEmbed stylesheet
 */
function wpd_oembed_styles() {

	wp_register_style( 'wpd-oembed', plugin_dir_url( __FILE__ ) . 'css/wp-dispensary-oembed.css', false, $this->version );
	wp_enqueue_style( 'wpd-oembed' );

}
add_action( 'enqueue_embed_scripts', 'wpd_oembed_styles' );

/**
 * Add wp-dispensary body class to related pages.
 * 
 * @since 2.5
 */
function wp_dispensary_body_class( $classes ) {

	if ( is_page( 'dispensary-menu' ) || is_page( 'menu' ) ) {
		$classes[] = 'wp-dispensary';
		$classes[] = 'dispensary-menu';
	}
	if ( is_singular( 'flowers' ) || is_post_type_archive( 'flowers' ) ) {
		$classes[] = 'wp-dispensary';
		$classes[] = 'wpd-flowers';
	}
	if ( is_singular( 'concentrates' ) || is_post_type_archive( 'concentrates' ) ) {
		$classes[] = 'wp-dispensary';
		$classes[] = 'wpd-concentrates';
	}
	if ( is_singular( 'edibles' ) || is_post_type_archive( 'edibles' ) ) {
		$classes[] = 'wp-dispensary';
		$classes[] = 'wpd-edibles';
	}
	if ( is_singular( 'prerolls' ) || is_post_type_archive( 'prerolls' ) ) {
		$classes[] = 'wp-dispensary';
		$classes[] = 'wpd-prerolls';
	}
	if ( is_singular( 'topicals' ) || is_post_type_archive( 'topicals' ) ) {
		$classes[] = 'wp-dispensary';
		$classes[] = 'wpd-topicals';
	}
	if ( is_singular( 'growers' ) || is_post_type_archive( 'growers' ) ) {
		$classes[] = 'wp-dispensary';
		$classes[] = 'wpd-growers';
	}

	return $classes; 
}
add_filter( 'body_class', 'wp_dispensary_body_class' );
