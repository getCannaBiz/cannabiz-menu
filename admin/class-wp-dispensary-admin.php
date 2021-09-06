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
 * @author     WP Dispensary <contact@wpdispensary.com>
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
		$this->version     = $version;

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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/wp-dispensary-admin.css', array(), $this->version, 'all' );
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
		// Add the main admin js file.
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/wp-dispensary-admin.js', array( 'jquery' ), $this->version, false );
		// Only localize script on the Edit screen.
		if ( 'edit' == $_GET['action'] ) {
			// Localize the js file.
			wp_localize_script( $this->plugin_name, 'wpd_script_vars', array(
				'product_type' => get_post_meta( $_GET['post'], 'product_type', true )
			) );
		}
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
		'public'   => true,
		'_builtin' => false,
	);
	$output     = 'object';
	$operator   = 'and';
	$post_types = get_post_types( $args, $output, $operator );
	// Loop through post types.
	foreach ( $post_types as $post_type ) {
		$count = wp_count_posts( $post_type->name );
		$num   = number_format_i18n( $count->publish );
		$text  = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $count->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$cpt_name = $post_type->name;
		}
		echo '<li class="' . esc_html( $cpt_name ) . '-count"><tr><a href="edit.php?post_type=' . esc_html( $cpt_name ) . '"><td class="first b b-' . esc_html( $post_type->name ) . '"></td>' . esc_html( $num ) . ' <td class="t ' . esc_html( $post_type->name ) . '">' . esc_html( $text ) . '</td></a></tr></li>';
	}
}
add_action( 'dashboard_glance_items', 'wpdispensary_right_now_content_table_end' );

/**
 * WP Dispensary toolbar quick menu
 * 
 * @since  4.0
 * @return void
 */
function toolbar_quick_menu( $wp_admin_bar ) {
	$args = array(
		'id'    => 'wp_dispensary',
		'title' => esc_attr__( 'WP Dispensary', 'wp-dispensary' ),
		'href'  => admin_url() . 'edit.php?post_type=products',
	);
	$wp_admin_bar->add_node( $args );

	// Create menu.
	$menu = array();

	// Add Products.
	$menu[] = array(
		'id'     => 'wpd_products',
		'title'  => esc_attr__( 'Products', 'wp-dispensary' ),
		'href'   => admin_url() . 'edit.php?post_type=products',
		'parent' => 'wp_dispensary'
	);

	// Add Categories.
	$menu[] = array(
		'id'     => 'wpd_categories',
		'title'  => esc_attr__( 'Categories', 'wp-dispensary' ),
		'href'   => admin_url() . 'edit-tags.php?taxonomy=wpd_categories',
		'parent' => 'wp_dispensary'
	);

	// Add Vendors.
	$menu[] = array(
		'id'     => 'wpd_vendors',
		'title'  => esc_attr__( 'Vendors', 'wp-dispensary' ),
		'href'   => admin_url() . 'edit-tags.php?taxonomy=vendors',
		'parent' => 'wp_dispensary'
	);

	// Add Settings.
	$menu[] = array(
		'id'     => 'wpd_settings',
		'title'  => esc_attr__( 'Settings', 'wp-dispensary' ),
		'href'   => admin_url() . 'admin.php?page=wpd-settings',
		'parent' => 'wp_dispensary'
	);

	$menu = apply_filters( 'wp_dispensary_toolbar_menu_items', $menu );

	// Loop through menu items.
	foreach ( $menu as $args ) {
		// Add menu item.
		$wp_admin_bar->add_node( $args );
	}
}
add_action( 'admin_bar_menu', 'toolbar_quick_menu', 999 );
