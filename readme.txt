=== WP Dispensary Menu Management ===
Contributors: deviodigital
Tags: cannabis, dispensary, menu, marijuana, weed, cannabis, wp-dispensary, pot, mmj, mmp, menu-management, medical-marijuana
Requires at least: 3.0.1
Tested up to: 4.9.5
Stable tag: 1.9.18
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The complete marijuana dispensary menu solution for WordPress

== Description ==

### #1 Marijuana WordPress plugin

WP Dispensary is open source canna-tech for dispensary and delivery services who need a simple way to manage product menus and let patients place orders directly through their own website.

### Dispensary Menu Features

WP Dispensary was built with ease of use in mind, so the [setup process](https://www.wpdispensary.com/article/installing-wp-dispensary/) of the plugin is a breeze.

Add your favorite [extensions](https://www.wpdispensary.com/add-ons/) and customize the style to match your brand, taking complete control over your online cannabis menu.

*If WP Dispensary provides value to your cannabiz, please consider leaving a [5 star review](https://wordpress.org/support/plugin/wp-dispensary/reviews/?filter=5)*

### Easy to use shortcodes

The WP Dispensary plugin comes with 7 built in shortcodes that allow you to display your menu with *any* WordPress theme.

You can call your menu anywhere shortcodes are accepted in your theme.

See all shortcode options in the [documentation](https://www.wpdispensary.com/article/introduction-to-shortcodes/)

### Extend WP Dispensary

With our free and commercial add-on's, you can connect your menu items to WooCommerce, manage your inventory, create top sellers lists, add coupons and more.

Our add-on's help you extend the functionality of the WP Dispensary menu plugin, giving your website the competitive edge in the growing medical marijuana market.

Check out all of our [extensions](https://www.wpdispensary.com/add-ons) and customize your menu to suit your needs.

We also have a dispensary WordPress theme for the cannabis industry, [CannaBiz](https://www.wpdispensary.com/downloads/cannabiz), giving you even further creative control over your marijuana menu.

It has a long list of options built in for customization to fit your business branding and is 100% integrated with WP Dispensary and it's add-ons.

== Installation ==

1. Go to `Plugins - Add New` in your WordPress admin panel and search for "WP Dispensary"
2. Install and activate the plugin directly in your admin panel
3. Pat yourself on the back for a job well done :)

== Screenshots ==

1. WP Dispensary shortcode display, using our [CannaBiz](https://www.wpdispensary.com/downloads/cannabiz/) theme
2. WP Dispensary "Flowers" menu type
3. WP Dispensary Settings page
4. WP Dispensary single menu item display, using [CannaBiz](https://www.wpdispensary.com/downloads/cannabiz/) theme

== Changelog ==

= 2.0 =
* 

= 1.9.18 =
* Added new filters for post types in data output in `admin/wp-dispensary-data-output.php`
* Added 'view all' link options to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Fixed nonce errors by adding isset() checks to verify_nonce() lines in `admin/post-types/wp-dispensary-metaboxes.php` - Thx [lucprincen](https://github.com/lucprincen)!
* Updated shortcode titles to center by default in `public/css/wp-dispensary-public.css`

= 1.9.17 =
* BUGFIX error on install/update with version 1.9.16 due to missing file in `includes/class-wp-dispensary.php`

= 1.9.16 =
* Added thumbnail images to all menu type screens in the admin dashboard in `admin/wp-dispensary-admin-screens.php`
* Added CSS for new thumbnail image column in menu type screens in the admin dashboard in `admin/css/wp-dispnsary-admin.css`
* Added functions for updating custom endpoints via the REST API in `admin/wp-dispensary-rest-api.php`

= 1.9.15 =
* Added 'difficulty' to Grower Details metabox in `admin/post-types/wp-dispensary-metaboxes.php`
* Added 'difficulty' to Grower Details table in `admin/wp-dispensary-data-output.php`
* Added 'difficulty' to Grower information endpoint in `admin/wp-dispensary-rest-api.php`
* Added post_type check to determine category type in `admin/wp-dispensary-shortcodes.php`
* Added 'full' image size check to each shortcode in `admin/wp-dispensary-shortcodes.php`
* Fixed widget display issue for list format in `admin/post-types/wp-dispensary-wigets.php`
* Updated filter name to change default shortcode images in `admin/wp-dispensary-shortcodes.php`

= 1.9.14 =
* Added 'details' class name to Details table in `admin/wp-dispensary-data-output.php`
* Added filter to change default shortcode images in `admin/wp-dispensary-shortcodes.php`
* Fixed bug in widgets that caused html output in `admin/post-types/wp-dispenssary-widgets.php`
* Fixed various display issues for shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated Edibles Product Information metabox style in `admin/css/wp-dispensary-admin.css`

= 1.9.13 =
* Added taxonomies to Edibles and Topicals in `admin/post-types/wp-dispensary-taxonomies.php`
* Fixed Concentrates cost phrase output in `admin/wp-dispensary-shortcodes.php`
* Fixed Carousel price output for Pre-rolls in `admin/wp-dispensary-shortcodes.php`
* Updated misspelled ID for compound details in `admin/post-types/wp-dispensary-metaboxes.php`
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

= 1.9.12 =
* Added `yield` option to Growers item details in `admin/post-types/wp-dispensary-metaboxes.php`
* Added `yield` metabox info to data output in `admin/wp-dispensary-data-output.php`
* Added `yield` metabox to REST API in `admin/wp-dispensary-rest-api.php`
* Added CSS for Growers Item Details metabox in `admin/css/wp-dispensary-admin.css`
* Added default images to shortcodes when menu items don't have a featured image added, in `admin/wp-dispensary-shortcodes.php`
* Added default image files for the default shortcode image display in `public/images/`
* Changed metabox title from `Clone Details` to `Grower Item Details` in `admin/post-types/wp-dispensary-metaboxes.php`
* Fixed several potential global namespace errors in `admin/post-types/wp-dispensary-metaboxes.php` Thx [Luc Princen](https://twitter.com/LucP)!
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1)) Thx [William Patton](https://twitter.com/Will_Patton_88)!

= 1.9.11 =
* Added filter parameter shortcode names for each shortcode in `admin/wp-dispensary-shortcodes.php`
* Added CSS class to shortcode item name `<p>` wraps in `admin/wp-dispensary-shortcodes.php`
* Added 'image' option to each shortcode in `admin/wp-dispensary-shortcodes.php`
* Added Flowers category taxonomy to the Pre-rolls menu type in `admin/post-types/wp-dispensary-taxonomies.php`
* Added 14 new action hooks to the shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added new 'vendor' taxonomy in `admin/post-types/wp-dispensary-taxonomies.php`
* Added new 'vendor' option to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added new 'vendor' taxonomy to the Details table in `admin/wp-dispensary-data-output.php`
* Added new 'vendor' taxonomy endpoints for the API in `admin/wp-dispensary-rest-api.php`
* Fixed the THC and CBD amount from % to mg in `admin/wp-dispensary-data-output.php`
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

= 1.9.10 =
* Added filters to post query $args for shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added filters to register_taxonomy types in `admin/post-types/wp-dispensary-taxonomies.php`
* Added filters to $screens for metaboxes in `admin/post-types/wp-dispensary-metaboxes.php`
* Added CSS class names to item info span wraps in `admin/wp-dispensary-shortcodes.php`
* Removed halfgram prices from flowers in various files (see [commit](https://github.com/deviodigital/wp-dispensary/commit/100dfeabb6e6b737f424a74ed1278a9a240330ee))
* Removed support for the Subtitles plugin (we still love it, but it's not something we feel is right for core plugin inclusion)
* Updated action hook names for widgets in `admin/post-types/wp-dispensary-widgets.php`
* Updated price output for Concentrates in the carousel shortcode in `admin/wp-dispensary-shortcodes.php`
* Updated oEmbed filter name in `wp-dispensary.php`
* Updated the_excerpt filter name in `wp-dispensary.php`
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

= 1.9.9 =
* Changed "THC % & CBD %" metabox to "Compound Details" and added 3 new compounds in `admin/post-types/wp-dispensary-metaboxes.php`
* Added 3 new compounds to Details table output in `admin/wp-dispensary-data-output.php`
* Added API endpoints for the 3 new compounds in `admin/wp-dispensary-rest-api.php`
* Added Compound Details to the shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added oEmbed style customization in `wp-dispensary.php`
* Added oEmbed CSS in `public/wp-dispensary-oembed.css` and `public/class-wp-dispensary-public.php`
* Fixed code error in the [wpd-carousel] output in `admin/wp-dispensary-shortcodes.php`
* Updated translation strings in `languages/wp-dispensary.pot`
* Updated Pricing table's title if donation is selected in `admin/wp-dispensary-data-output.php`

= 1.9.8 =
* Added `Settings` link for WP Dispensary on the `plugins` page in `wp-dispensary.php`
* Removed all custom post type's from admin dashboard menu in `admin/post-types/`
* Updated placement of `WP Dispensary` in the admin dashboard menu, and added menu type links to sub-menu in `admin/wp-dispensary-admin-settings.php`

= 1.9.7 =
* Added 12 new Action Hooks to widgets in `admin/wp-dispenesary-widgets.php`
* Added an image size option to all widgets in `admin/wp-dispenesary-widgets.php`
* Fixed flower shortcode price display if no prices are added in `admin/wp-dispenesary-shortcodes.php`
* Fixed empty variables for WPD Settings options in `admin/wp-dispensary-data-output.php`
* Fixed name error for the Edibles widget in `admin/wp-dispensary-widgets.php`
* Updated 12 Action Hook names in `admin/wp-dispenesary-widgets.php`
* Updated call constructor method for all widgets in `admin/wp-dispensary-widgets.php`

= 1.9.6.1 =
* Fatal error bug with the REST API code fixed (thanks @jeherve!) in `admin/wp-dispensary-rest-api.php`
* Fixed Concentrate price output for shortcodes in `admin/wp-dispensary-shortcodes.php`

= 1.9.6 =
* Added imgsize option to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added new image sizes for shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated Action Hooks code for shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated Concentrates pricing in `admin/post-types/wp-dispensary-metaboxes.php`
* Updated Concentrates pricing for data ouput in `admin/wp-dispensary-data-output.php`
* Updated Concentrates pricing for REST API in `admin/wp-dispensary-rest-api.php`
* Updated Concentrates pricing output in shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated CSS for admin Concentrate Prices box in `admin/css/wp-dispensary-admin.css`

= 1.9.5 =
* Added 2 new Action Hooks to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added 8 new Action Hooks to Pricing & Data Tables in `admin/wp-dispensary-data-output.php`
* Added Clone Details metabox to Growers menu type in `admin/wp-dispensary-metaboxes.php`
* Added Clone Details information to Details Table in `admin/wp-dispensary-data-output.php`
* Added Carousel shortcode in `admin/wp-dispensary-shortcodes.php`
* Added CSS styles for the Carousel shortcode in `public/css/wp-dispensary-public.css`
* Added slick.js for the Carousel shortcode in `public/js/wp-dispensary-public.js`
* Updated promotion for premium add-ons for WP Dispensary in `admin/wp-dispensary-admin-settings.php`

= 1.9.4 =
* Added check for all prices, not just grams in `admin/wp-dispensary-shortcodes.php`
* Added category taxonomies to Menus in admin dash `admin/post-types/wp-dispensary-taxonomies.php`
* Added taxonomy options to shortcodes (Flowers, Concentrates, Topicals, Edibles) in `admin/wp-dispensary-shortcodes.php`
* Added orderby option to all shortcodes in `admin/wp-dispensary-shortcodes.php`
* Added THC% and CBD% to Pre-rolls in `admin/post-types/wp-dispensary-metaboxes.php`
* Added THC% and CBD% to the data output Details table in `admin/wp-dispensary-data-output.php`
* Added THC and CBD options to Flowers shortcode in `admin/wp-dispensary-shortcodes.php`
* Fixed ounce price check in `admin/wp-dispensary-data-output.php`

= 1.9.3 =
* Added ingredients to Topicals menu type in `admin/post-types/wp-dispensary-taxonomies.php`
* Added ingredients for Topicals to the data output Details table in `admin/wp-dispensary-data-output.php`
* Added net weight option to the Edibles Product Information metabox in `admin/post-types/wp-dispensary-metaboxes.php`
* Added net weight for Edibles to the data output Details table in `admin/wp-dispensary-data-output.php`
* Added match-height script for better shortcode display in `public/js/wp-dispensary-public.js`
* Updated CSS style for Pricing and Details tables in `public/css/wp-dispensary-public.css`
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

= 1.9.2 =
* Fixed error that caused the Widgets page in dashboards to not show correctly in `admin/post-types/wp-dispensary-widgets.php`

= 1.9.1 =
* Added custom Cost Phrase option to the WPD Settings page in `admin/wp-dispensary-admin-settings.php`
* Added custom Cost Phrase to the data output Pricing table in `admin/wp-dispensary-data-output.php`
* Added custom Cost Phrase to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Updated default Currency Code output to the data output Pricing table in `admin/wp-dispensary-data-output.php`
* Updated default Currency Code output to shortcodes in `admin/wp-dispensary-shortcodes.php`
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

= 1.9 =
* Added custom Currency Code to the data output tables in `admin/wp-dispensary-data-output.php`
* Added custom Currency Code to shortcodes in `admin/wp-dispensary-shortcodes.php`
* Moved WPD Settings to it's own parent menu in the admin dashboard in `admin/wp-dispensary-admin-settings.php`
* Updated WPD Settings code in `admin/wp-dispensary-admin-settings.php`

= 1.8 =
* Added "prerolls" in array to output </table> in `admin/wp-dispensary-data-output.php`
* Added Action Hooks to Pricing & Data Tables in `admin/wp-dispensary-data-output.php`
* Added promotion for premium add-ons for WP Dispensary in `admin/wp-dispensary-admin-settings.php`
* Fixed shortcode [wpd-edibles] serving count output in `admin/wp-dispensary-shortcodes.php`
* Removed unnecessary pricing variable in `admin/wp-dispensary-shortcodes.php`
* Updated shortcode [wpd-edibles] output of THC mg% & servings in `admin/wp-dispensary-shortcodes.php`
* Updated serving count variable name for edibles in `admin/wp-dispensary-shortcodes.php`

= 1.7.1 =
* Added 'placement' and 'display' options to the WP Dispensary settings page
* Updated price output in the flowers shortcode if only the gram price is added

= 1.7 =
* Added Growers menu type
* Added API endpoints for Growers menu type
* Added Widget for Growers menu type
* Added `[wpd-growers]` shortcode for Growers menu type
* Updated `languages/wp-dispensary.pot` file with all current translatable text throughout the plugin

= 1.6 =
* Added WP Dispensary settings page to the WordPress admin menu
* Added in automatic output of menu item details and pricing to `the_content`
* Updated `admin/post-types/wp-dispensary-metaboxes.php` to fix Serving information metabox details
* WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

= 1.5.2 =
* Removed file that was left behind for the plugin recommendation

= 1.5.1 =
* Removed plugin recommendation since it was causing upgrade errors.

= 1.5 =
* Added various new output options for shortcode display
* Added option to randomize menu item output in widgets
* Added plugin recommendation for [Dispensary Coupons](https://wordpress.org/plugins/dispensary-coupons/)
* Added WPD icon to each menu section in dashboard "At A Glance" box
* PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files
* Updated CSS in `public/css/wp-dispensary-public.css` for improved display in the widgets

= 1.4 =
* Added the WP Dispensary icon to each CPT in the admin dashboard for easier visual recognition
* Added `active_plugins` check for "Subtitles" plugin in `admin/wp-dispensary-rest-api.php` API output
* Added sanitization to $_POST in `admin/post-types/wp-dispensary-metaboxes.php` pre-roll flower selection drop down
* Created the Topicals menu type, with Widget, Shortcode and WP-API output options
* PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files
* Updated the output style of the Shortcode item information

= 1.3.1 =
* Fixed CBD being called BCD #typingtoofast

= 1.3 =
* Added THC% and CBD% metaboxes

= 1.2 =
* Added Shortcode output for use with any theme
* Removed code causing error on Menus page

= 1.1 =
* Added WordPress REST API integration

= 1.0 =
* Initial release
