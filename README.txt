=== WP Dispensary ===
Contributors: deviodigital
Donate link: http://www.wpdispensary.com
Tags: menu, dispensary, medical, marijuana, mmj, cannabis
Requires at least: 3.0.1
Tested up to: 4.5.1
Stable tag: 1.5.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The complete marijuana dispensary menu solution for WordPress

== Description ==

![WP Dispensary](http://www.wpdispensary.com/wp-content/uploads/2016/05/wpdispensary-logo-updated.png)

The world's first (and best) marijuana dispensary menu management plugin for WordPress.

### Features Overview

WP Dispensary was built with ease of use in mind, so the setup process of the plugin is as simple as adding and activating the plugin, adding your content and sitting back to bask in the glory of how easy it was to set up.

*if you enjoy using this plugin, please consider giving it a 5 star rating* &rarr;

There's also a lot of cool things baked right into the WP Dispensary menu plugin.

### Easy to manage menu

We've made every effort to have the adding and editing of your dispensary menu content as seamless as possible with the normal WordPress experience.

This means that each menu category has it's own section in the WordPress dashboard and content can be added just like you would normally add content with posts or pages.

When you log into your WordPress dashboard, you will also be able to see an overview of your dispensary menu in the at a glance box, letting you quickly see how many items are in your dispensary menu.

But that's not all...

### Complete control over menu item details

With the WP Dispensary menu plugin, you'll be able to have 100% control over all of the information that you would like to include for each of your menu items.

Let your patients easily see menu items based on the type of effects they have, as well as what flowers are good for specific symptoms. Patients can also find menu items based on flavor, aroma and specific conditions.

You can also include the pricing for each item as well, directly from the content editor, giving you the ease of editing menu prices whenever you have a sale, run out of certain items, etc.

But wait, there's more...

### Your content is exportable

One thing that we wanted to make sure of when creating this plugin was that you have the ability to easily export your content at any time.

Luckily, WordPress comes built with a great content exporter, and we've included your menu content in the export options so you can instantly have your dispensary menu backed up.

If you ever need to move your website to another server, or would just like to have a backup of the current content, you're able to easily export your dispensary menu content with WordPress' built in export tool.

### 100% Open Source

WP Dispensary is free to use with no license restrictions or expensive setup fees. It's as simple as downloading the plugin, installing it on your WordPress powered website, and adding content.

We believe in the power of open source, and this plugin is a shining example of that. Not only can you download and freely use this plugin as you see fit, developers are free to contribute to the [code on Github](https://www.github.com/deviodigital/wp-dispensary/)

This means that more eyes are looking at the code base to make sure everything is built with WordPress standards in mind, giving you the peace of mind that the plugin you're using is of the highest quality possible.

### Easy to use shortcodes

As of version 1.2, the WP Dispensary menu plugin comes with built in shortcodes which allow you to display your menu with any theme.

You can call your menu anywhere shortcodes are accepted in your theme. Samples of the shortcodes are below. See all shortcode options in the [documentation](http://www.wpdispensary.com/section/shortcodes/)

`[wpd-flowers posts="6"]`

`[wpd-concentrates posts="6"]`

`[wpd-edibles posts="6"]`

`[wpd-prerolls posts="6"]`

`[wpd-topicals posts="6"]`

*please note that more options to customize shortcode output are being worked into the shortcode for future versions*

### Extend WP Dispensary

When building this plugin, we made sure to keep it lean, including only the core needs of every menu. While this works well in most cases, we're aware there are additional needs that dispensary owners will need to address, which is where the add-on's come in.

With our free and commercial add-on's, you'll be able to extend the functionality of the WP Dispensary menu plugin, giving your website the competitive edge in the growing medical marijuana market.

You can view our current add-on's on the [offical WP Dispensary website](http://www.wpdispensary.com/add-ons)

== Installation ==

1. Go to `Plugins - Add New` in your WordPress admin panel and search for "WP Dispensary"
2. Install and activate the plugin directly in your admin panel
3. Pat yourself on the back for a job well done :)

== Screenshots ==

1. Overview of content added to the "Flowers" section of your menu
2. The content editor for a post in the "Flowers" section of your menu
3. Example of how the menu content is output in the "Dispensary Display" theme
4. Example of how the individual menu item is output in the "Dispensary Display" theme

== Changelog ==

= 1.5.1 =
* Removed plugin recommendation since it was causing upgrade errors.

= 1.5 =
* Added various new output options for shortcode display
* Updated CSS in `public/css/wp-dispensary-public.css` for improved display in the widgets
* Added WPD icon to each menu section in dashboard "At A Glance" box
* Added option to randomize menu item output in widgets
* Added plugin recommendation for [Dispensary Coupons](https://wordpress.org/plugins/dispensary-coupons/)
* PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files

= 1.4 =
* PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files
* Created the Topicals menu type, with Widget, Shortcode and WP-API output options
* Updated the output style of the Shortcode item information
* Added the WP Dispensary icon to each CPT in the admin dashboard for easier visual recognition
* Added `active_plugins` check for "Subtitles" plugin in `admin/wp-dispensary-rest-api.php` API output
* Added sanitization to $_POST in `admin/post-types/wp-dispensary-metaboxes.php` pre-roll flower selection drop down

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
