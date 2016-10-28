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

class WPDispensarySettings {
	private $wp_dispensary_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wp_dispensary_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'wp_dispensary_page_init' ) );
	}

	public function wp_dispensary_add_plugin_page() {
		add_menu_page(
			'WP Dispensary', // page_title
			'WP Dispensary', // menu_title
			'manage_options', // capability
			'wpd-settings', // menu_slug
			array( $this, 'wp_dispensary_create_admin_page' ), // function
			plugin_dir_url( __FILE__ ) . ( 'images/menu-icon.png' ), // icon_url
			100 // position
		);
	}

	public function wp_dispensary_create_admin_page() {
		$this->wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); ?>

		<div class="wrap">
			<h2>WP Dispensary</h2>
			<p>Settings page for the WP Dispensary plugin</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'wp_dispensary_option_group' );
					do_settings_sections( 'wp-dispensary-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function wp_dispensary_page_init() {
		register_setting(
			'wp_dispensary_option_group', // option_group
			'wp_dispensary_option_name', // option_name
			array( $this, 'wp_dispensary_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'wp_dispensary_setting_section', // id
			'Settings', // title
			array( $this, 'wp_dispensary_section_info' ), // callback
			'wp-dispensary-admin' // page
		);

		add_settings_field(
			'hidedetails_0', // id
			'Hide details table', // title
			array( $this, 'hidedetails_0_callback' ), // callback
			'wp-dispensary-admin', // page
			'wp_dispensary_setting_section' // section
		);

		add_settings_field(
			'hidepricing_1', // id
			'Hide pricing table', // title
			array( $this, 'hidepricing_1_callback' ), // callback
			'wp-dispensary-admin', // page
			'wp_dispensary_setting_section' // section
		);

		add_settings_field(
			'movecontent_2', // id
			'Move content', // title
			array( $this, 'movecontent_2_callback' ), // callback
			'wp-dispensary-admin', // page
			'wp_dispensary_setting_section' // section
		);

		add_settings_field(
			'currencycode_3', // id
			'Currency code', // title
			array( $this, 'currencycode_3_callback' ), // callback
			'wp-dispensary-admin', // page
			'wp_dispensary_setting_section' // section
		);
	}

	public function wp_dispensary_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['hidedetails_0'] ) ) {
			$sanitary_values['hidedetails_0'] = $input['hidedetails_0'];
		}

		if ( isset( $input['hidepricing_1'] ) ) {
			$sanitary_values['hidepricing_1'] = $input['hidepricing_1'];
		}

		if ( isset( $input['movecontent_2'] ) ) {
			$sanitary_values['movecontent_2'] = $input['movecontent_2'];
		}

		if ( isset( $input['currencycode_3'] ) ) {
			$sanitary_values['currencycode_3'] = $input['currencycode_3'];
		}

		return $sanitary_values;
	}

	public function wp_dispensary_section_info() {
		
	}

	public function hidedetails_0_callback() {
		printf(
			'<input type="checkbox" name="wp_dispensary_option_name[hidedetails_0]" id="hidedetails_0" value="hidedetails_0" %s> <label for="hidedetails_0">hide details from data output</label>',
			( isset( $this->wp_dispensary_options['hidedetails_0'] ) && $this->wp_dispensary_options['hidedetails_0'] === 'hidedetails_0' ) ? 'checked' : ''
		);
	}

	public function hidepricing_1_callback() {
		printf(
			'<input type="checkbox" name="wp_dispensary_option_name[hidepricing_1]" id="hidepricing_1" value="hidepricing_1" %s> <label for="hidepricing_1">hide pricing from data output</label>',
			( isset( $this->wp_dispensary_options['hidepricing_1'] ) && $this->wp_dispensary_options['hidepricing_1'] === 'hidepricing_1' ) ? 'checked' : ''
		);
	}

	public function movecontent_2_callback() {
		printf(
			'<input type="checkbox" name="wp_dispensary_option_name[movecontent_2]" id="movecontent_2" value="movecontent_2" %s> <label for="movecontent_2">move all menu info below the_content</label>',
			( isset( $this->wp_dispensary_options['movecontent_2'] ) && $this->wp_dispensary_options['movecontent_2'] === 'movecontent_2' ) ? 'checked' : ''
		);
	}

	public function currencycode_3_callback() {
		?> <select name="wp_dispensary_option_name[currencycode_3]" id="currencycode_3">
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'AUD') ? 'selected' : '' ; ?>
			<option value="AUD" <?php echo $selected; ?>>(AUD) Australian Dollar</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'BRL') ? 'selected' : '' ; ?>
			<option value="BRL" <?php echo $selected; ?>>(BRL) Brazilian Real</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'CAD') ? 'selected' : '' ; ?>
			<option value="CAD" <?php echo $selected; ?>>(CAD) Canadian Dollar</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'CZK') ? 'selected' : '' ; ?>
			<option value="CZK" <?php echo $selected; ?>>(CZK) Czech Koruna</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'DKK') ? 'selected' : '' ; ?>
			<option value="DKK" <?php echo $selected; ?>>(DKK) Danish Krone</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'EUR') ? 'selected' : '' ; ?>
			<option value="EUR" <?php echo $selected; ?>>(EUR) Euro</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'HKD') ? 'selected' : '' ; ?>
			<option value="HKD" <?php echo $selected; ?>>(HKD) Hong Kong Dollar</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'HUF') ? 'selected' : '' ; ?>
			<option value="HUF" <?php echo $selected; ?>>(HUF) Hungarian Forint</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'ILS') ? 'selected' : '' ; ?>
			<option value="ILS" <?php echo $selected; ?>>(ILS) Israeli New Sheqel</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'JPY') ? 'selected' : '' ; ?>
			<option value="JPY" <?php echo $selected; ?>>(JPY) Japanese Yen</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'MYR') ? 'selected' : '' ; ?>
			<option value="MYR" <?php echo $selected; ?>>(MYR) Malaysian Ringgit</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'MXN') ? 'selected' : '' ; ?>
			<option value="MXN" <?php echo $selected; ?>>(MXN) Mexican Peso</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'NOK') ? 'selected' : '' ; ?>
			<option value="NOK" <?php echo $selected; ?>>(NOK) Norwegian Krone</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'NZD') ? 'selected' : '' ; ?>
			<option value="NZD" <?php echo $selected; ?>>(NZD) New Zealand Dollar</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'PHP') ? 'selected' : '' ; ?>
			<option value="PHP" <?php echo $selected; ?>>(PHP) Philippine Peso</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'PLN') ? 'selected' : '' ; ?>
			<option value="PLN" <?php echo $selected; ?>>(PLN) Polish Zloty</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'GBP') ? 'selected' : '' ; ?>
			<option value="GBP" <?php echo $selected; ?>>(GBP) Pound Sterling</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'SGD') ? 'selected' : '' ; ?>
			<option value="SGD" <?php echo $selected; ?>>(SGD) Singapore Dollar</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'SEK') ? 'selected' : '' ; ?>
			<option value="SEK" <?php echo $selected; ?>>(SEK) Swedish Krona</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'CHF') ? 'selected' : '' ; ?>
			<option value="CHF" <?php echo $selected; ?>>(CHF) Swiss Franc</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'TWD') ? 'selected' : '' ; ?>
			<option value="TWD" <?php echo $selected; ?>>(TWD) Taiwan New Dollar</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'THB') ? 'selected' : '' ; ?>
			<option value="THB" <?php echo $selected; ?>>(THB) Thai Baht</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'TRY') ? 'selected' : '' ; ?>
			<option value="TRY" <?php echo $selected; ?>>(TRY) Turkish Lira</option>
			<?php $selected = (isset( $this->wp_dispensary_options['currencycode_3'] ) && $this->wp_dispensary_options['currencycode_3'] === 'USD') ? 'selected' : '' ; ?>
			<option value="USD" <?php echo $selected; ?>>(USD) U.S. Dollar</option>
		</select> <?php
	}

}
if ( is_admin() )
	$wp_dispensary = new WPDispensarySettings();

/* 
 * Retrieve this value with:
 * $wp_dispensary_options = get_option( 'wp_dispensary_option_name' ); // Array of All Options
 * $hidedetails_0 = $wp_dispensary_options['hidedetails_0']; // hidedetails
 * $hidepricing_1 = $wp_dispensary_options['hidepricing_1']; // hidepricing
 * $movecontent_2 = $wp_dispensary_options['movecontent_2']; // movecontent
 * $currencycode_3 = $wp_dispensary_options['currencycode_3']; // currencycode
 */
