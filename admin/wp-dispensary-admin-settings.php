<?php
/**
 * Adding the Admin Settings Page
 *
 * @link       https://www.wpdispensary.com
 * @since      1.6.0
 *
 * @package    WP_Dispensary
 * @subpackage WP_Dispensary/admin
 */

/**
 * Building the class for the WP Dispensary admin settings page.
 */
class WPDispensarySettings {
	/**
	 * Defines the options.
	 *
	 * @access private
	 *
	 * @var [type] The options.
	 */
	private $wp_dispensary_options;

	/**
	 * Constructor for WPDispensarySettings.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wp_dispensary_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'wp_dispensary_page_init' ) );
	}

	/**
	 * Adding WP Dispensary to admin dashboard menu.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wp_dispensary_add_plugin_page() {
		add_menu_page(
			'WP Dispensary', /** Paramater: page_title */
			'WP Dispensary', /** Paramater: menu_title */
			'manage_options', /** Paramater: capability */
			'wpd-settings', /** Paramater: menu_slug */
			array( $this, 'wp_dispensary_create_admin_page' ), /** Paramater: function */
			'none', /** Paramater: icon_url */
			3 /** Paramater: position */
		);

		add_submenu_page( 'wpd-settings', 'Flowers', 'Flowers', 'manage_options', 'edit.php?post_type=flowers', NULL );
		add_submenu_page( 'wpd-settings', 'Concentrates', 'Concentrates', 'manage_options', 'edit.php?post_type=concentrates', NULL );
		add_submenu_page( 'wpd-settings', 'Edibles', 'Edibles', 'manage_options', 'edit.php?post_type=edibles', NULL );
		add_submenu_page( 'wpd-settings', 'Pre-rolls', 'Pre-rolls', 'manage_options', 'edit.php?post_type=prerolls', NULL );
		add_submenu_page( 'wpd-settings', 'Topicals', 'Topicals', 'manage_options', 'edit.php?post_type=topicals', NULL );
		add_submenu_page( 'wpd-settings', 'Growers', 'Growers', 'manage_options', 'edit.php?post_type=growers', NULL );
		add_submenu_page( 'wpd-settings', 'WP Dispensary Settings', 'Settings', 'manage_options', 'wpd-settings' );
		remove_submenu_page('wpd-settings','wpd-settings');

	}

	/**
	 * Creating WP Dispensary admin page.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wp_dispensary_create_admin_page() {
		$this->wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); ?>

		<div class="wpd-settings-wrap">
			<div class="wpd-settings-page-ads">
			<?php $url = plugins_url(); ?>
			<?php if ( ! class_exists( 'Menu_Sync' ) ) { ?>
				<a href="https://www.wpdispensary.com/downloads/menu-sync" target="_blank"><img src="<?php echo esc_url( $url ); ?>/wp-dispensary/admin/images/ad_dispensary-menusync.png" /></a>
			<?php } ?>
			<?php if ( ! class_exists( 'Wpd_Wooconnect' ) ) { ?>
				<a href="https://www.wpdispensary.com/downloads/wooconnect-for-woocommerce/" target="_blank"><img src="<?php echo esc_url( $url ); ?>/wp-dispensary/admin/images/ad_dispensary-wooconnect.png" /></a>
			<?php } ?>
			</div>
			<div class="wpd-settings-content">
				<img src="<?php echo esc_url( $url ); ?>/wp-dispensary/admin/images/wpd-logo.png" />
				<p>Settings &middot; <a href="https://www.wpdispensary.com/documentation/" target="_blank">Documentation</a> &middot; <a href="https://www.wpdispensary.com/add-ons/" target="_blank">Add-on's</a></p>
				<?php settings_errors(); ?>

				<form method="post" action="options.php">
					<?php
						settings_fields( 'wp_dispensary_option_group' );
						do_settings_sections( 'wp-dispensary-admin' );
						submit_button();
					?>
				</form>
			</div>
		</div>
	<?php }

	/**
	 * Registering settings for WP Dispensary.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wp_dispensary_page_init() {
		register_setting(
			'wp_dispensary_option_group', /** Paramater: option_group */
			'wp_dispensary_option_name', /** Paramater: option_name */
			array( $this, 'wp_dispensary_sanitize' ) /** Paramater: sanitize_callback */
		);

		add_settings_section(
			'wp_dispensary_setting_section', /** Paramater: id */
			'Settings', /** Paramater: title */
			array( $this, 'wp_dispensary_section_info' ), /** Paramater: callback */
			'wp-dispensary-admin' /** Paramater: page */
		);

		add_settings_field(
			'wpd_hide_details', /** Paramater: id */
			'Hide details table', /** Paramater: title */
			array( $this, 'wpd_hide_details_callback' ), /** Paramater: callback */
			'wp-dispensary-admin', /** Paramater: page */
			'wp_dispensary_setting_section' /** Paramater: section */
		);

		add_settings_field(
			'wpd_hide_pricing', /** Paramater: id */
			'Hide pricing table', /** Paramater: title */
			array( $this, 'wpd_hide_pricing_callback' ), /** Paramater: callback */
			'wp-dispensary-admin', /** Paramater: page */
			'wp_dispensary_setting_section' /** Paramater: section */
		);

		add_settings_field(
			'wpd_content_placement', /** Paramater: id */
			'Move content', /** Paramater: title */
			array( $this, 'wpd_content_placement_callback' ), /** Paramater: callback */
			'wp-dispensary-admin', /** Paramater: page */
			'wp_dispensary_setting_section' /** Paramater: section */
		);

		add_settings_field(
			'wpd_currency', /** Paramater: id */
			'Currency code', /** Paramater: title */
			array( $this, 'wpd_currency_callback' ), /** Paramater: callback */
			'wp-dispensary-admin', /** Paramater: page */
			'wp_dispensary_setting_section' /** Paramater: section */
		);

		add_settings_field(
			'wpd_cost_phrase', /** Paramater: id */
			'Cost phrase', /** Paramater: title */
			array( $this, 'wpd_cost_phrase_callback' ), /** Paramater: callback */
			'wp-dispensary-admin', /** Paramater: page */
			'wp_dispensary_setting_section' /** Paramater: section */
		);
	}

	/**
	 * Sanitize input from WP Dispensary admin page.
	 *
	 * @access public
	 *
	 * @return array The sanitized values.
	 */
	public function wp_dispensary_sanitize( $input ) {
		$sanitary_values = array();
		if ( isset( $input['wpd_hide_details'] ) ) {
			$sanitary_values['wpd_hide_details'] = $input['wpd_hide_details'];
		}

		if ( isset( $input['wpd_hide_pricing'] ) ) {
			$sanitary_values['wpd_hide_pricing'] = $input['wpd_hide_pricing'];
		}

		if ( isset( $input['wpd_content_placement'] ) ) {
			$sanitary_values['wpd_content_placement'] = $input['wpd_content_placement'];
		}

		if ( isset( $input['wpd_currency'] ) ) {
			$sanitary_values['wpd_currency'] = $input['wpd_currency'];
		}

		if ( isset( $input['wpd_cost_phrase'] ) ) {
			$sanitary_values['wpd_cost_phrase'] = $input['wpd_cost_phrase'];
		}

		return $sanitary_values;
	}

	/**
	 * Adding WP Dispensary section info to admin page.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wp_dispensary_section_info() {

	}

	/**
	 * Option to hide Details box from data output.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wpd_hide_details_callback() {
		printf(
			'<input type="checkbox" name="wp_dispensary_option_name[wpd_hide_details]" id="wpd_hide_details" value="wpd_hide_details" %s> <label for="wpd_hide_details">hide details from data output</label>',
			( isset( $this->wp_dispensary_options['wpd_hide_details'] ) && $this->wp_dispensary_options['wpd_hide_details'] === 'wpd_hide_details' ) ? 'checked' : ''
		);
	}

	/**
	 * Option to hide Pricing box from data output.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wpd_hide_pricing_callback() {
		printf(
			'<input type="checkbox" name="wp_dispensary_option_name[wpd_hide_pricing]" id="wpd_hide_pricing" value="wpd_hide_pricing" %s> <label for="wpd_hide_pricing">hide pricing from data output</label>',
			( isset( $this->wp_dispensary_options['wpd_hide_pricing'] ) && $this->wp_dispensary_options['wpd_hide_pricing'] === 'wpd_hide_pricing' ) ? 'checked' : ''
		);
	}

	/**
	 * Option to move Details and Pricing boxes data output to top or bottom of content.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wpd_content_placement_callback() {
		printf(
			'<input type="checkbox" name="wp_dispensary_option_name[wpd_content_placement]" id="wpd_content_placement" value="wpd_content_placement" %s> <label for="wpd_content_placement">move all menu info below the_content</label>',
			( isset( $this->wp_dispensary_options['wpd_content_placement'] ) && $this->wp_dispensary_options['wpd_content_placement'] === 'wpd_content_placement' ) ? 'checked' : ''
		);
	}

	/**
	 * Option to choose currency code for data output.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wpd_currency_callback() {

		$currencies = array(
			'AUD' => '(AUD) Australian Dollar',
			'BRL' => '(BRL) Brazilian Real',
			'CAD' => '(CAD) Canadian Dollar',
			'CZK' => '(CZK) Czech Koruna',
			'DKK' => '(DKK) Danish Krone',
			'EUR' => '(EUR) Euro',
			'HKD' => '(HKD) Hong Kong Dollar',
			'HUF' => '(HUF) Hungarian Forint',
			'ILS' => '(ILS) Israeli New Sheqel',
			'JPY' => '(JPY) Japanese Yen',
			'MYR' => '(MYR) Malaysian Ringgit',
			'MYR' => '(MXN) Mexican Peso',
			'MXN' => '(NOK) Norwegian Krone',
			'NOK' => '(NZD) New Zealand Dollar',
			'NZD' => '(PHP) Philippine Peso',
			'PHP' => '(PLN) Polish Zloty',
			'PLN' => '(GBP) Pound Sterling',
			'GBP' => '(SGD) Singapore Dollar',
			'SGD' => '(SEK) Swedish Krona',
			'CHF' => '(CHF) Swiss Franc',
			'TWD' => '(TWD) Taiwan New Dollar',
			'THB' => '(THB) Thai Baht',
			'TRY' => '(TRY) Turkish Lira',
			'USD' => '(USD) U.S. Dollar',
		);

		$current = $this->wp_dispensary_options['wpd_currency'];

		?>

		<select name="wp_dispensary_option_name[wpd_currency]" id="wpd_currency">
			<?php foreach ( $currencies as $symbol => $name ) : ?>
				<option value="<?php esc_html_e( $symbol ) ?>" <?php selected( $symbol, $current ); ?>><?php esc_html_e( $name ); ?></option>
			<?php endforeach; ?>
		</select>

		<?php
	}

	/**
	 * Option to choose cost phrasing for data output.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function wpd_cost_phrase_callback() {
		?> <select name="wp_dispensary_option_name[wpd_cost_phrase]" id="wpd_cost_phrase">
			<?php $selected = (isset( $this->wp_dispensary_options['wpd_cost_phrase'] ) && $this->wp_dispensary_options['wpd_cost_phrase'] === 'Price') ? 'selected' : '' ; ?>
			<option value="Price" <?php echo esc_html_e( $selected ); ?>>Price</option>
			<?php $selected = (isset( $this->wp_dispensary_options['wpd_cost_phrase'] ) && $this->wp_dispensary_options['wpd_cost_phrase'] === 'Donation') ? 'selected' : '' ; ?>
			<option value="Donation" <?php echo esc_html_e( $selected ); ?>>Donation</option>
		</select> <?php
	}
}

// If within the admin, instantiate the WPDispensarySettings class.
if ( is_admin() ) {
	$wp_dispensary = new WPDispensarySettings();
}

/*
 * Retrieve this value with:
 * $wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options
 * $wpd_hide_details = $wp_dispensary_options['wpd_hide_details']; // hidedetails
 * $wpd_hide_pricing = $wp_dispensary_options['wpd_hide_pricing']; // hidepricing
 * $wpd_content_placement = $wp_dispensary_options['wpd_content_placement']; // movecontent
 * $wpd_currency = $wp_dispensary_options['wpd_currency']; // currencycode
 * $wpd_cost_phrase = $wp_dispensary_options['wpd_cost_phrase']; // costphrase
 */
