# Changelog

### 1.9.6.1
* Fatal error bug with the REST API code fixed (thanks @jeherve!) in `admin/wp-dispensary-rest-api.php`
* Fixed Concentrate price output for shortcodes in `admin/wp-dispensary-shortcodes.php`

### 1.9.6
* Added imgsize option to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added new image sizes for shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated Action Hooks code for shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated Concentrates pricing in `admin/post-types/wp-dispensary-metaboxes.php`
* Updated Concentrates pricing for data ouput in `admin/wp-dispensary-data-output.php`
* Updated Concentrates pricing for REST API in `admin/wp-dispensary-rest-api.php`
* Updated Concentrates pricing output in shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated CSS for admin Concentrate Prices box in `admin/css/wp-dispensary-admin.css`

### 1.9.5
* Added 2 new Action Hooks to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added 8 new Action Hooks to Pricing & Data Tables in `admin/wp-dispensary-data-output.php`
* Added Clone Details metabox to Growers menu type in `admin/wp-dispensary-metaboxes.php`
* Added Clone Details information to Details Table in `admin/wp-dispensary-data-output.php`
* Added Carousel shortcode in `admin/wp-dispensary-shortcodes.php`
* Added CSS styles for the Carousel shortcode in `public/css/wp-dispensary-public.css`
* Added slick.js for the Carousel shortcode in `public/js/wp-dispensary-public.js`
* Updated promotion for premium add-ons for WP Dispensary in `admin/wp-dispensary-admin-settings.php`

### 1.9.4
* Added check for all prices, not just grams in `admin/wp-dispensary-shortcodes.php`
* Added category taxonomies to Menus in admin dash `admin/post-types/wp-dispensary-taxonomies.php`
* Added taxonomy options to shortcodes (Flowers, Concentrates, Topicals, Edibles) in `admin/wp-dispensary-shortcodes.php`
* Added orderby option to all shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added THC% and CBD% to Pre-rolls in `admin/post-types/wp-dispensary-metaboxes.php`
* Added THC% and CBD% to the data output Details table in `admin/wp-dispensary-data-output.php`
* Added THC and CBD options to Flowers shortcode in `admin/wp-dispensary-shortcodes.php`
* Fixed ounce price check in `admin/wp-dispensary-data-output.php`

### 1.9.3
* Added ingredients to Topicals menu type in `admin/post-types/wp-dispensary-taxonomies.php`
* Added ingredients for Topicals to the data output Details table in `admin/wp-dispensary-data-output.php`
* Added net weight option to the Edibles Product Information metabox in `admin/post-types/wp-dispensary-metaboxes.php`
* Added net weight for Edibles to the data output Details table in `admin/wp-dispensary-data-output.php`
* Added match-height script for better shortcode display in `public/js/wp-dispensary-public.js`
* Updated CSS style for Pricing and Details tables in `public/css/wp-dispensary-public.css`
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

### 1.9.2
* Fixed error that caused the Widgets page in dashboards to not show correctly in `admin/post-types/wp-dispensary-widgets.php`

### 1.9.1
* Added custom Cost Phrase option to the WPD Settings page in `admin/wp-dispensary-admin-settings.php`
* Added custom Cost Phrase to the data output Pricing table in `admin/wp-dispensary-data-output.php`
* Added custom Cost Phrase to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated default Currency Code output to the data output Pricing table in `admin/wp-dispensary-data-output.php`
* Updated default Currency Code output to shortcodes in `admin/wp-dispensary-shortcodes.php`
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

### 1.9
* Added custom Currency Code to the data output tables in `admin/wp-dispensary-data-output.php`
* Added custom Currency Code to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Moved WPD Settings to it's own parent menu in the admin dashboard in `admin/wp-dispensary-admin-settings.php`
* Updated WPD Settings options in `admin/wp-dispensary-admin-settings.php`

### 1.8
* Added "prerolls" in array to output </table> in `admin/wp-dispensary-data-output.php`
* Added Action Hooks to Pricing & Data Tables in `admin/wp-dispensary-data-output.php`
* Added promotion for premium add-ons for WP Dispensary in `admin/wp-dispensary-admin-settings.php`
* Fixed shortcode [wpd-edibles] serving count output in `admin/wp-dispensary-shortcodes.php`
* Removed unnecessary pricing variable in `admin/wp-dispensary-shortcodes.php`
* Updated shortcode [wpd-edibles] output of THC mg% & servings in `admin/wp-dispensary-shortcodes.php`
* Updated serving count variable name for edibles in `admin/wp-dispensary-shortcodes.php`

### 1.7.1
* Added 'placement' and 'display' options to the WP Dispensary settings page
* Added 'category' option to shortcodes to allow for separation of menu type by category
* Updated price output in the flowers shortcode if only the gram price is added
* Updated metaboxes to use text input rather than number input, so decimals can be used

### 1.7
* Added Growers menu type
* Added API endpoints for Growers menu type
* Added Widget for Growers menu type
* Added `[wpd-growers]` shortcode for Growers menu type
* Updated `languages/wp-dispensary.pot` file with all current translatable text throughout the plugin

### 1.6
* Added WP Dispensary settings page to the WordPress admin menu
* Added in automatic output of menu item details and pricing to `the_content`
* Updated `admin/post-types/wp-dispensary-metaboxes.php` to fix Serving information metabox details
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

### 1.5.2
* Removed file that was left behind for the plugin recommendation

### 1.5.1
* Removed plugin recommendation since it was causing upgrade errors

### 1.5
* Added various new output options for shortcode display
* Added WPD icon to each menu section in dashboard "At A Glance" box
* Added option to randomize menu item output in widgets
* Added plugin recommendation for [Dispensary Coupons](https://wordpress.org/plugins/dispensary-coupons/)
* PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files
* Updated CSS in `public/css/wp-dispensary-public.css` for improved display in the widgets

### 1.4
* Added the WP Dispensary icon to each CPT in the admin dashboard for easier visual recognition
* Added `active_plugins` check for "Subtitles" plugin in `admin/wp-dispensary-rest-api.php` API output
* Added sanitization to $_POST in `admin/post-types/wp-dispensary-metaboxes.php` pre-roll flower selection drop down
* Created the Topicals menu type, with Widget, Shortcode and WP-API output options
* PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files
* Updated the output style of the Shortcode item information

### 1.3.1
* Fixed CBD being called BCD #typingtoofast

### 1.3
* Added THC% and CBD% metaboxes
* Added custom image size for the shortcodes

### 1.2
* Added Shortcode output for use with any theme
* Removed code causing error on Menus page

### 1.1
* Added WordPress REST API integration

### 1.0
* Initial release
