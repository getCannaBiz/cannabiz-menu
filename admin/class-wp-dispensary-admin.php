<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.wpdispensary.com
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
 * @author     Robert DeVore <me@robertdevore.com>
 */
class WP_Dispensary_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name   The name of this plugin.
	 * @param string $version       The version of this plugin.
	 *
	 * @return void
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since  1.0.0
	 * @access public
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-dispensary-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since  1.0.0
	 * @access public
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-dispensary-admin.js', array( 'jquery' ), $this->version, false );

	}
}

/**
 * Add our custom post types to the "At a Glance" box in the WordPress
 * admin dashboard.
 *
 * @since  1.0.0
 * @access public
 *
 * @return void
 */
function wpdispensary_right_now_content_table_end() {
	$args = array(
		'public'     => true,
		'_builtin'   => false,
	);
	$output     = 'object';
	$operator   = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	foreach ( $post_types as $post_type ) {
		$num_posts     = wp_count_posts( $post_type->name );
		$num           = number_format_i18n( $num_posts->publish );
		$text          = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$cpt_name = $post_type->name;
		}
		// TODO: revisit this echo and convert to string substitution - sprintf.
		echo '<li class="' . esc_attr( $cpt_name ) . '-count"><tr><a href="' . esc_url( 'edit.php?post_type=' . $cpt_name ) . '"><td class="first b b-' . esc_attr( $post_type->name ) . '"></td>' . esc_html( $num ) . ' <td class="t ' . esc_attr( $post_type->name ) . '">' . wp_kses_post( $text ) . '</td></a></tr></li>';
	}

}

add_action( 'dashboard_glance_items' , 'wpdispensary_right_now_content_table_end' );
