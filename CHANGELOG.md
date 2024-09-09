# Changelog

## 4.5.0
*   Added link attribute to REST API products endpoint in `admin/wp-dispensary-rest-api.php`
*   Added 'wp_query_id' to WP_Query instances in various files in the plugin
*   Added `wpd_product_strain_types` helper function and filter in `includes/functions/wp-dispensary-product-functions.php`
*   Added `wpd_menu` shortcode setting to optionally show `strain_types` in `admin/wp-dispensary-shortcodes.php`
*   Added warning label settings for products in `admin/wp-dispensary-admin-settings.php`
*   Added warning label content to data output in `admin/wp-dispensary-data-output.php`
*   Updated various styles throughout the plugin in `public/assets/css/wp-dispensary-public.css`
*   Updated fontawesome icon font for backend and frontend in various files in the plugin
*   Updated `get_wpd_product_details` function output in `includes/functions/wp-dispensary-product-functions.php`
*   Updated star rating output in menu shortcode in `admin/wp-dispensary-product-reviews.php`
*   Updated start rating styles in menu shortcode in `public/assets/sass/shortcodes/_shortcodes.scss`
*   Updated deprecated jQuery codes in `public/assets/js/wp-dispensary-public.js`
*   Updated carousel items to have adaptive height in `public/assets/sass/slick-slider/_slick.scss`
*   General code cleanup throughout various files in the plugin

## 4.4.0
*   Added `WPD_Logging` class to help with debugging in `admin/class-wp-dispensary-wpd-logging.php`
*   Added `wp_dispensary_product_details_array` function and filter in `admin/metaboxes/wpd-metabox-product-details.php`
*   Added `get_wpd_simple_price_keys` helper function and filter in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added harvest date, test date, test lab and pacakge ID to product data in various files in the plugin
*   Added color metadata option to strain types taxonomy in `admin/taxonomies/wpd-taxonomy-color-picker.php`
*   Added `shop_owner` and `shop_manager` user roles in `admin/wp-dispensary-user-roles.php`
*   Updated verified purchase notification styles from eCommerce addon in `public/assets/sass/products/_reviews.scss`
*   Updated body classes to include wpd-archive for taxonomies in `public/class-wp-dispensary-public.php`
*   Updated menu grid to use 2 columns on mobile instead of 3 in `public/assets/sass/shortcodes/_shortcodes.scss`
*   Updated widgets with various upgrades in `admin/widgets/wpd-widget-products.php`
*   Updated admin menu to include Shelf Types and Strain Types in `admin/wp-dispensary-admin-menu-links.php`
*   Updated toolbar menu to include Shelf Types and Strain Types in `admin/class-wp-dispensary-admin.php`
*   Updated widget styles in `public/assets/sass/widgets/_widgets.scss`
*   Updated PHP 8 compatibility in `includes/functions/wp-dispensary-product-functions.php`
*   Updated `.pot` files with text strings for localization in `languages/`
*   General code cleanup throughout various files in the plugin

## 4.3.0
*   Added `CPT_Columns` class for easier admin screen editor in `admin/class-wp-dispensary-cpt-columns.php`
*   Updated product admin screen to show product ratings in `admin/wp-dispensary-admin-screens.php`
*   Updated product search widget to no longer check for a title in `admin/widgets/wpd-widget-product-search.php`
*   Updated product rating average calculations in `includes/functions/wp-dispensary-product-functions.php`
*   Updated blank var for ratings box HTML in comment form in `admin/wp-dispensary-product-reviews.php`
*   Updated CSV export with product ratings details `admin/class-wp-dispensary-csv-export.php`
*   General code cleanup throughout various files in the plugin

## 4.2.1
*   Added `wpd_keep_taxonomy_menu_open` filter in `admin/wp-dispensary-admin-menu-links.php`
*   Added `wpd_csv_export_additional_types` filter in `admin/class-wp-dispensary-csv-export.php`
*   Added `wpd_admin_settings_fields_args` filter in `admin/wp-dispensary-admin-settings.php`
*   Bugfix for ratings calculation fatal error if count/total is not integer in `includes/functions/wp-dispensary-product-functions.php`
*   Updated products widget type dropdown setting in `admin/widgets/wpd-widget-products.php`
*   Updated license to GPL v3.0
*   Updated `.pot` files with text strings for localization in `languages/`
*   General code cleanup throughout various files in the plugin

## 4.2.0
*   Added `get_wpd_all_image_sizes` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `get_wpd_product_price_high` helper function in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `get_wpd_product_price_low` helper function in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `wpd_product_ratings_details` helper function in `includes/functions/wp-dispensary-product-functions.php`
*   Added `get_wpd_product_ratings_stars` helper function in `includes/functions/wp-dispensary-product-functions.php`
*   Added `wpd_shortcodes_product_title` filter in `admin/wp-dispensary-shortcodes.php`
*   Added excerpt to the products post type in `admin/wp-dispensary-products-post-type.php`
*   Added new product ratings feature in `admin/wp-dispensary-product-reviews.php`
*   Added product ratings to schema details in `includes/functions/wp-dispensary-product-functions.php`
*   Added product ratings details to REST API in `admin/wp-dispensary-rest-api.php`
*   Added product ratings stars to `wpd_menu` shortcode in `admin/wp-dispensary-product-reviews.php`
*   Added product SKU metadata option in `admin/metaboxes/wpd-metabox-product-details.php`
*   Added product SKU metadata to table data output in `admin/wp-dispensary-data-output.php`
*   Added product SKU metadata to REST API in `admin/wp-dispensary-rest-api.php`
*   Bugfix for metadata not saving in `admin/metaboxes/wpd-metabox-compound-details.php`
*   Bugfix for metadata not saving in `admin/metaboxes/wpd-metabox-grower-details.php`
*   Bugfix for metadata not saving in `admin/metaboxes/wpd-metabox-product-details.php`
*   Bugfix for metadata not saving in `admin/metaboxes/wpd-metabox-product-prices.php`
*   Bugfix for metadata not saving in `admin/metaboxes/wpd-metabox-product-type.php`
*   Bugfix for product type dropdown displaying on more screens than just products in `admin/wp-dispensary-admin-screens.php`
*   Updated pre_get_posts for product archive and search results in `admin/wp-dispensary-admin-screens.php`
*   Updated product schema to include SKU, description and brand itemtype's in `includes/functions/wp-dispensary-product-functions.php`
*   Updated product schema price to utilize AggregateOffer option when needed in `includes/functions/wp-dispensary-product-functions.php`
*   Updated `get_wpd_product_image` to include width/height in HTML in `includes/functions/wp-dispensary-product-functions.php`
*   Updated JS for star rating selection when leaving a review in `public/assets/js/wp-dispensary-public.js`
*   Updated carousel slider text to center align in `public/assets/sass/slick-slider/_slick.scss`
*   Updated wpd_menu shortcode styles for the new star ratings in `public/assets/sass/shortcodes/_shortcodes.scss`
*   Updated product widget to include star ratings in `admin/widgets/wpd-widget-products.php`
*   Updated `.pot` files with text strings for localization in `languages/`
*   WordPress Coding Standards updates in multiple files throughout the plugin
*   General code cleanup throughout various files in the plugin

## 4.1.1
*   Added `wp_dispensary_details_metabox_save_detail_keys` filter in `admin/metaboxes/wpd-metabox-product-details.php`
*   Added `wp_dispensary_prices_metabox_save_price_keys` in `admin/metaboxes/wpd-metabox-product-prices.php`
*   Bugfix for metadata not saving correctly in `admin/metaboxes/wpd-metabox-product-details.php`
*   Bugfix for metadata not saving correctly in `admin/metaboxes/wpd-metabox-product-prices.php`
*   Bugfix for filter names that were used twice in `includes/functions/wp-dispensary-pricing-functions.php`
*   Updated prices metabox save meta with array in `admin/metaboxes/wpd-metabox-product-prices.php`
*   Updated inline docs throughout various files in the plugin

## 4.1.0
*   Added 'Curbside pickup' option to payment options in `admin/wp-dispensary-admin-settings.php`
*   Added `convert_user_roles` helper function in `includes/functions/wp-dispensary-helper-functions.php`
*   Added three new filters for products post type archive sort ordering in `admin/wp-dispensary-admin-screens.php`
*   Bugfix for product type selection when editing products in `admin/assets/js/wp-dispensary-admin.js`
*   Updated public facing styles to use SASS instead of CSS in `public/assets/sass`
*   Updated plugin upgrade to use new `convert_user_roles` helper function in `admin/wp-dispensary-plugin-upgrade.php`
*   WordPress Coding Standards updates in multiple files throughout the plugin
*   General code cleanup throughout various files in the plugin

## 4.0
*   Added Spanish language translation in `languages/wp-dispensary-es_ES.po`
*   Added Italian language translation in `languages/wp-dispensary-it_IT.po`
*   Added German language translation in `languages/wp-dispensary-de_DE.po`
*   Added French language translation in `languages/wp-dispensary-fr_FR.po`
*   Added Croatian language translation in `languages/wp-dispensary-hr_HR.po`
*   Added Czech language translation in `languages/wp-dispensary-cs_CZ.po`
*   Added Georgian language translation in `languages/wp-dispensary-ka_GE.po`
*   Added Hebrew language translation in `languages/wp-dispensary-he_IL.po`
*   Added Maltese language translation in `languages/wp-dispensary-mt_MT.po`
*   Added Dutch language translation in `languages/wp-dispensary-nl_NL.po`
*   Added `Products Search` widget in `admin/widgets/wpd-widget-product-search.php`
*   Added `Products` post type in `admin/wp-dispensary-products-post-type.php`
*   Added `wpd_categories` taxonomy for posts in the Products post type in `admin/taxonomies/wpd-taxonomy-categories.php`
*   Added Products submenu item in admin dashboard in `admin/class-wp-dispensary-admin-settings.php`
*   Added `wpd_concentrates_prices_array` helper function in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added products post type permalink settings in `admin/class-wp-dispensary-permalink-settings.php`
*   Added `product_type` metadata to each product in `admin/metaboxes/wpd-metabox-product-type.php`
*   Added `wpd_product_schema` helper function in `includes/functions/wp-dispensary-product-functions.php`
*   Added `Tinctures` and `Edibles` to the `product_type` metadata options in `admin/wp-dispensary-helper-functions.php`
*   Added `wpd_product_type_display_name` helper function in `admin/wp-dispensary-helper-functions.php`
*   Added `wpd_tinctures_prices_simple` helper function in `admin/wp-dispensary-helper-functions.php`
*   Added `wpd_gear_prices_simple` helper function in `admin/wp-dispensary-helper-functions.php`
*   Added `get_wpd_tinctures_prices_simple` helper function in `admin/wp-dispensary-helper-functions.php`
*   Added `get_wpd_gear_prices_simple` helper function in `admin/wp-dispensary-helper-functions.php`
*   Added `wpd_compound_type` helper function in `admin/wp-dispensary-helper-functions.php`
*   Added `wpd_product_prices helper function` helper function in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `wpd_product_types` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `wpd_product_types_simple` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `wp_dispensary_custom_image_sizes` filter and helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `wpd_product_prices_array` helper function in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `wpd_compound_list` helper function in `includes/functions/wp-dispensary-product-functions.php`
*   Added `get_wpd_vendors_details` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `get_wpd_strain_types_details` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `get_wpd_shelf_types_details` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `wpd_product_type_display_name_to_slug` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `get_wpd_product_type_item_count` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `get_wpd_product_type_details` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `get_wpd_product_types_details` helper function in `includes/functions/wp-dispensary-general-functions.php`
*   Added `wpd_csv_export_data_row` filter in `admin/class-wp-dispensary-csv-export.php`
*   Added `wpd_compounds_table_placement_options` filter in `admin/wp-dispensary-admin-settings.php`
*   Added `WPD_Products` class in `includes/class-wp-dispensary-products.php`
*   Added `wpd/v1` REST API route to the WP REST API in `admin/wp-dispensary-rest-api.php`
*   Added `product_type` jQuery to show/hide metaboxes properly in `admin/js/wp-dispensary-admin.js`
*   Added `convert_post_types`, `convert_metadata`, and `convert_taxonomies` helper function for v4.0 upgrade in `includes/functions/wp-dispensary-helper-functions.php`
*   Added Products Export option to the WP Dispensary admin settings in `admin/class-wp-dispensary-csv-export.php`
*   Added parameter to `get_wpd_product_image` function that will link/unlink images in `includes/functions/wp-dispensary-product-functions.php`
*   Added logo field to vendors taxonomy in `admin/class-wp-dispensary-vendors-taxonomy-fields.php`
*   Added product type filter to admin all products screen in `admin/wp-dispensary-admin-screens.php`
*   Added `Activation time` to product details in multiple files throughout the plugin
*   Deprecated `flowers_category`, `concentrates_category`, `edibles_category`, `topicals_category`, and `growers_category`,  taxonomies
*   Deprecated `Flowers`, `Concentrates`, `Edibles`, `Topicals`, `Pre-rolls`, and `Growers` post types
*   Deprecated `Flowers`, `Concentrates`, `Edibles`, `Topicals`, `Pre-rolls`, and `Growers` widgets
*   Deprecated `wpd-flowers`, `wpd-concentrates`, `wpd-edibles`, `wpd-topicals`, `wpd-prerolls`, `wpd-growers`, and `wpd-carousel` shortcodes
*   Updated `wpd_menu` shortcode output styles in `public/assets/css/wp-dispensary-public.css`
*   Updated concentrate prices variable to remove PHP notices in `admin/wp-dispensary-data-output.php`
*   Updated `wpd_menu` shortcode to include an option to display products in a carousel in `admin/wp-dispensary-shortcodes.php`
*   Updated `wpd_menu` div wrappers and class names for each product type in `admin/wp-dispensary-shortcodes.php`
*   Updated shortcode output for pre-rolls product type in `admin/wp-dispensary-shortcodes.php`
*   Updated REST API data for Products post type in `admin/wp-dispensary-rest-api.php`
*   Updated admin 'Products' screen styles in `admin/css/wp-dispensary-admin.css`
*   Updated admin screen styles for multiple taxonomies and Orders in `admin/css/wp-dispensary-admin.css`
*   Updated body classes for WPD menu and products in `public/class-wp-dispensary-public.php`
*   Updated slick.js to v1.8.1 and cleaned up additional JS in `public/js/wp-dispensary-public.js`
*   Updated products archive to display all products in `admin/wp-dispensary-admin-screens.php`
*   Updated `get_wpd_product_details` function's `$wrapper` arg default in `includes/functions/wp-dispensary-product-functions.php`
*   Updated `patient` references to `customers` in multiple file throughout the plugin
*   Updated pricing metabox keys to use a new name structure in multiple file throughout the plugin
*   Updated taxonomies to use a new name structure in multiple file throughout the plugin
*   Updated product data metabox keys to use a new name structure in multiple file throughout the plugin
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   Bugfix to keep WPD `admin_menu` open when various taxonomies are open in `admin/class-wp-dispensary-admin-settings.php`
*   Bugfix for admin settings redirect page array if no pages are found in `admin/wp-dispensary-admin-settings.php`
*   Bugfix for content output of single products in `admin/wp-dispensary-data-output.php` 
*   General code cleanup throughout various files in the plugin

## 3.3.5
*   Added default image for the Styles add-on in `public/images/wpd-styles-list-image.jpg`
*   Added empty var to remove WP Debug notice in `admin/wp-dispensary-data-output.php`
*   General code cleanup throughout various files in the plugin

## 3.3.4
*   Bugfix fatal error from undefined function (missing underscore) in `admin/wp-dispensary-admin-settings.php`
*   Updated menu shortcodes to display with flexbox instead of floats in `public/css/wp-dispensary-public.css`
*   Updated JavaScript to remove the matchheight.js script in `public/js/wp-dispensary-public.js`

## 3.3.3
*   Added shelf and strain type to Edibles REST API endpoint in `admin/wp-dispensary-rest-api.php`
*   Added file to store the code for 6 upcoming deprecated shortcodes in `admin/deprecated-shortcodes.php`
*   Updated codes used for flower prices in prices table output in `admin/wp-dispensary-data-output.php`
*   Updated admin settings logo file to use the new WP Dispensary logo in `admin/images/wpd-logo.png`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 3.3.2
*   Bugfix product image size variable in `wpd_menu` shortcode in `admin/wp-dispensary-shortcodes.php`
*   Bugfix total THC display in edibles shortcode in `admin/wp-dispensary-shortcodes.php`
*   Updated `wpd-carousel` shortcode default attributes in `admin/wp-dispensary-shortcodes.php`
*   Updated REST API to use `WP_Post` method of getting ID (thanks to github user BigNug) in `admin/wp-dispensary-rest-api.php`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`

## 3.3.1
*   Added `image` to the `wpd-carousel` shortcode atts in `admin/wp-dispensary-shortcodes.php`
*   Updated `wpd-carousel` shortcode to pass `span` as the $wrapper for the `get_wpd_product_details` function in `admin/wp-dispensary-shortcodes.php`
*   Updated shortcodes to allow users to show/hide images via the shortcode atts in `admin/wp-dispensary-shortcodes.php`
*   Updated `wpd_shortcode_top_menu` and `wpd_shortcode_bottom_menu` action hook names in `wpd_menu` shortcode in `admin/wp-dispensary-shortcodes.php`
*   Updated multiple atts for `wpd_menu` shortcode in `admin/wp-dispensary-shortcodes.php`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 3.3
*   Added `product_id` var to `wpd_product_updates_messages` function in `admin/wp-dispensary-functions.php`
*   Added gear and tinctures taxonomies to `$cat_tax_query` for carousel shortcode in `admin/wp-dispensary-shortcodes.php`
*   Added `$wrapper` param to `wpd_product_details` function in `includes/functions/wp-dispensary-product-functions.php`
*   Added `$wrapper` param to `get_wpd_product_details` function in `includes/functions/wp-dispensary-product-functions.php`
*   Added `$wrapper` param to `details` REST API endpoint in `admin/wp-dispensary-rest-api.php`
*   Added `$wrapper` param to `wpd_menu` shortcode product details in `admin/wp-dispensary-shortcodes.php`
*   Added minified CSS for the admin screens in `admin/css/wp-dispensary-admin.min.css`
*   Added admin edit post type styles for coupons in `admin/css/wp-dispensary-admin.css`
*   Updated CSS for search box in admin edit post types screens in `admin/css/wp-dispensary-admin.css`
*   Updated carousel shortcode to use get_wpd_product_details function in `admin/wp-dispensary-shortcodes.php`
*   Updated functions for featured images REST API endpoints in `admin/wp-dispensary-rest-api.php`
*   Updated total THC for edibles shortcode in `admin/wp-dispensary-shortcodes.php`
*   Updated colors for product details in shortcodes and compound details in `public/css/wp-dispensary-public.css`
*   Updated carousel shortcode default atts in `admin/wp-dispensary-shortcodes.php`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 3.2
*   Added `wpd_pricing_phrase` filter in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `wpd_details_phrase` filter in `admin/wp-dispensary-functions.php`
*   Updated admin edit menu type screens style in `admin/css/wp-dispensary-admin.css`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 3.1.1
*   Added CSS classes to body on the `menu` page in `public/class-wp-dispensary-public.php`
*   Bugfix data return for prerolls featured images in REST API in `admin/wp-dispensary-rest-api.php`
*   Bugfix changed `shelf_type` and `strain_type` data names for REST API endpoints in `admin/wp-dispensary-rest-apit.php`
*   Updated data output to hide compounds table if eCommerce plugin is active in `admin/wp-dispensary-data-output.php`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 3.1
*   Added `wpd-thumbnail` size to featured images REST API data in `admin/wp-dispensary-rest-api.php`
*   Added `strain_type` and `shelf_type` to the products REST API data in `admin/wp-dispensary-rest-api.php`
*   Updated widget title strings for localization in `admin/post-types/wp-dispensary-widgets.php`
*   Updated widgets in admin dash to only color new Products widget in `admin/css/wp-dispensary-admin.css`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   WordPress Coding Standards updates throughout various files in the plugin
*   General code cleanup throughout various files in the plugin

## 3.0
*   Added `Dispensary Products` default widget in `admin/post-types/wp-dispensary-widgets.php`
*   Added `wpd-thumbnail` image size in `admin/wp-dispensary-shortcodes.php`
*   Added Tinctures to post type check for mg/% in `admin/wp-dispensary-functions.php`
*   Added `wpd_featured_image_sizes` helper function in `admin/wp-dispensary-functions.php`
*   Added `is_product` helper function in `includes/functions/wp-dispensary-product-functions.php`
*   Added 6 helper functions with a new admin settings file in `includes/functions/wp-dispensary-settings-functions.php`
*   Added eCommerce patient registration redirection setting in `admin/wp-dispensary-admin-settings.php`
*   Added styles for the new `Dispensary Products` widget in `public/css/wp-dispensary-public.css`
*   Bugfix shortcodes topical size variable check in `admin/wp-dispensary-shortcodes.php`
*   Bugfix added closing span tags for clones and seeds in `admin/wp-dispensary-shortcodes.php`
*   Updated margins for product titles in shortcodes in `public/css/wp-dispensary-public.css`
*   Updated mobile wpd_menu shortcode display as one item per row in `public/css/wp-dispensary-public.css`
*   Updated pricebox number input field style in `admin/css/wp-dispensary-admin.css`
*   Updated widgets to use helper function for menu types in `admin/post-types/wp-dispensary-widgets.php`
*   Updated drivers license setting name in `admin/wp-dispensary-admin-settings.php`
*   Updated hide compounds function to return `true` or `false` in `includes/functions/wp-dispensary-settings-functions.php`
*   Updated the redirect_url full with included home_url() in `includes/functions/wp-dispensary-settings-functions.php`
*   Updated shortcodes to use the `get_wpd_product_image` function in `admin/wp-dispensary-shortcodes.php`
*   Updated select options for featured image sizes in `admin/post-types/wp-dispensary-widgets.php`
*   Updated plugin links function name in `wp-dispensary.php`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 2.9
*   Added ground shipping payment method and instructions box in `admin/wp-dispensary-admin-settings.php`
*   Updated menu types simple function to remove `-` from `pre-rolls` in `admin/wp-dispensary-functions.php`
*   Updated Compounds table placement/display based on admin settings in `admin/wp-dispensary-data-output.php`
*   Updated pricing table to be completely removed from data output if eCommerce add-on is active in `admin/wp-dispensary-data-output.php`
*   Updated `.pot` file with text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup

## 2.8
*   Added setting to WPD Settings for eCommerce add-on require login to shop in `admin/wp-dispensary-admin-settings.php`
*   Added `wpd_data_output_compounds_table` filter in `admin/wp-dispensary-data-output.php`
*   Added `wpd_shortcodes_product_price` filter in `admin/wp-dispensary-shortcodes.php`
*   Added `wpd_flowers_pricing_low` filter in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `wpd_flowers_pricing_high` filter in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `wpd_concentrates_pricing_low` filter in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added `wpd_concentrates_pricing_high` filter in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added Total compounds to compound details metabox in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added Total compounds to data output table in `admin/wp-dispensary-data-output.php`
*   Updated the `the wpd_compound_details_screens` filter in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated the `wpd_compound_details_screens` filter in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated Compound details metabox title in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated Pre-roll strain metabox title in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated shortcode product title from p to h2 in `admin/wp-dispensary-shortcodes.php`
*   Updated multiple metabox width on mobile devices in `admin/css/wp-dispensary-admin.css`
*   Updated flowers_weights variable name in `admin/wp-dispensary-functions.php`

## 2.7.1
*   Added empty array for $compounds_new variable by default in `admin/wp-dispensary-shortcodes.php`
*   Bug fix pass the missing ID argument to compounds helper function in `admin/wp-dispensary-data-output.php`
*   Bug fix pass the missing ID argument to prices and compounds helper functions in `admin/wp-dispensary-shortcodes.php`

## 2.7
*   Added featured image endpoints for all menu types in `admin/wp-dispensary-rest-api.php`
*   Added details REST API endpoint for all menu types in `admin/wp-dispensary-rest-api.php`
*   Added prices REST API endpoint for all menu types in `admin/wp-dispensary-rest-api.php`
*   Updated $id to $product_id for all functions in `includes/functions/wp-dispensary-pricing-functions.php`
*   Updated functions to pass the $product_id in `includes/functions/wp-dispensary-product-functions.php`
*   Updated functions to pass the $product_id in `admin/wp-dispensary-shortcodes.php`
*   Updated functions to pass the $product_id in `admin/wp-dispensary-functions.php`
*   Updated functions to pass the $product_id in `admin/post-types/wp-dispensary-wigets.php`

## 2.6
*   Added `wpd_menu` shortcode in `admin/wp-dispensary-shortcodes.php`
*   Added growers to shelf tax type array in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added 4 new product helper functions in `includes/functions/wp-dispensary-product-functions.php`
*   Added get_wpd_all_prices_simple filter in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added default $str variable for `get_wpd_all_prices_simple` function in `includes/functions/wp-dispensary-pricing-functions.php`
*   Updated widget images to use new helper function in `admin/post-types/wp-dispensary-widgets.php`
*   Updated title and shortcode for Menu page created on plugin activation in `includes/class-wp-dispensary-activator.php`
*   General code cleanup

## 2.5.8
*   Added Pricing Currency Codes helper function in `admin/wp-dispensary-functions.php`
*   Added filter for widget image sizes in `admin/post-types/wp-dispensary-widgets.php`
*   Added filter for eCommerce checkout payment options in `admin/wp-dispensary-admin-settings.php`
*   Added 6 filters for REST API endpoint details in `admin/wp-dispensary-rest-api.php`
*   Bug fixed for mixmatched currency codes in `wpd_pricing_currency_codes` helper function in `admin/wp-dispensary-functions.php`
*   Updated Currency Codes option in WPD Settings to use the new helper function in `admin/wp-dispensary-admin-settings.php`
*   Updated `$_POST` values for metaboxes with `esc_html` in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated data output to hide vendors, strain type & shelf type if eCommerce add-on is active in `admin/wp-dispensary-data-output.php`
*   WordPress Coding Standards updates throughout various files in the plugin
*   General code cleanup throughout various files in the plugin

## 2.5.7
*   Removed custom REST API codes for Ingredients, Allergens and Vendor REST API endpoints in `admin/wp-dispensary-rest-api.php`

## 2.5.6
*   Removed custom REST API codes for menu type Categories, Shelf and Strain type endpoints in `admin/wp-dispensary-rest-api.php`
*   Updated the order of taxonomies for Shelf type, Strain type and Vendors in `admin/post-types/wp-dispensary-taxonomies.php`
*   Updated widgets to check `display name` option by default in `admin/post-types/wp-dispensary-widgets.php`
*   WordPress Coding Standards Updates in `admin/post-types/wp-dispensary-widgets.php`

## 2.5.5
*   Added `strain_type` to the Growers menu type in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added `strain_type` to Growers `Details` table in `admin/post-types/wp-dispensary-data-output.php`
*   Added `shelf_type` and `strain_type` to menu item data output in `admin/post-types/wp-dispensary-data-output.php`
*   Added `shelf_type` and `strain_type` to Flowers, Concentrates and Pre-rolls `Details` table in `admin/post-types/wp-dispensary-data-output.php`
*   Updated Vendor spelling in Details table in `admin/post-types/wp-dispensary-data-output.php`

## 2.5.4
*   Bug fix for category option in carousel shortcode args to work with multiple types in `admin/wp-dispensary-shortcodes.php`
*   Updated carousel shortcode CSS to remove extra right margin on pricing in `public/css/wp-dispensary-public.css`
*   Updated additional CSS for the carousel shortcode in `public/css/wp-dispensary-public.css`
*   Updated Topical REST API endpoints to include two new fields in `admin/post-types/wp-dispensary-rest-api.php`
*   Updated text strings for localization in `admin/post-types/wp-dispensary-widgets.php`
*   Updated text strings for localization in `admin/post-types/wp-dispensary-data-output.php`
*   Updated `.pot` file with new text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 2.5.3
*   Bug fix for empty variable notices for compounds in `admin/wp-dispensary=functions.php`
*   Bug fix misspelled `meta_key` variable name for shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Updated mobile display for Edit screen in admin dashboard in `admin/css/wp-dispensary-admin.css`
*   Updated product updated messages with global `$post` variable in `admin/wp-dispensary-functions.php`
*   Updated text strings for localization in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated `.pot` file with new text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 2.5.2
*   Added `wpd_flowers_weights_array` and `wpd_concentrates_weights_array` functions in `admin/wp-dispensary-functions.php`
*   Added minimum order requirement to checkout with eCommerce add-on in `admin/wp-dispensary-admin-settings.php`
*   Added Patients tab + 4 options in admin settings page with eCommerce add-on in `admin/wp-dispensary-admin-settings.php`
*   Bug fix in menu type filter that output `pre-rolls` instead of `prerolls` in `admin/post-types/wp-dispensary-taxonomies.php`
*   Bug fix in menu type filter that output `pre-rolls` instead of `prerolls` in `admin/wp-dispensary-screens.php`
*   Bug fix in menu type filter that output `pre-rolls` instead of `prerolls` in `admin/wp-dispensary-data-output.php`
*   Updated WPD Settings version number styles in `admin/css/wp-dispensary-admin.css`
*   Updated checkout payment options with eCommerce add-on in `admin/wp-dispensary-admin-settings.php`
*   Updated text strings for localization in `admin/wp-dispensary-functions.php`
*   Updated `.pot` file with new text strings for localization in `languages/wp-dispensary.pot`
*   General code cleanup throughout various files in the plugin

## 2.5.1
*   Bug fix in the carousel shortcode product pricing display in `admin/wp-dispensary-shortcodes.php`
*   Bug fix in the carousel shortcode product total THC display for Edibles in `admin/wp-dispensary-shortcodes.php`
*   Updated text strings for localization in `admin/wp-dispensary-admin-settings.php`
*   Updated `.pot` file with new text strings for localization in `languages/wp-dispensary.pot`

## 2.5
*   Added multiple helper functions in `admin/wp-dispensary-functions.php`
*   Added multiple helper functions for pricing in `includes/functions/wp-dispensary-pricing-functions.php`
*   Added 12 action hooks in product type widgets in `admin/post-types/wp-dispensary-widgets.php`
*   Added ID option for shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added body class names for WPD specific pages in `public/class-wp-dispensary-public.php`
*   Added admin settings options for eCommerce add-on in `admin/wp-dispensary-admin-settings.php`
*   Updated Topicals prices and details metaboxes in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated admin settings to set USD as default currency code on activation in `includes/class-wp-dispensary-activator.php`

## 2.4
*   Added thead and tbody tags to tables in `admin/wp-dispensary-data-output.php`
*   Added `wpd_details_phrase` helper function in `admin/wp-dispensary-functions.php`
*   Added `wpd_pricing_phrase` helper function in `admin/wp-dispensary-functions.php`
*   Added `wpd_flowers_prices_simple` helper function in admin/wp-dispensary-functions.php`
*   Added `wpd_compounds_simple` helper function in `admin/wp-dispensary-functions.php`
*   Added `strain_type` to shortcode options for Flowers, Concentrates and Pre-rolls in `admin/wp-dispensary-shortcodes.php`
*   Remove Allergens taxonomy from admin columns in `admin/wp-dispensary-admin-screens.php`
*   Updated Edibles details order in `admin/wp-dispensary-data-output.php`
*   Updated compounds table `wpd_compounds_simple` function in `admin/wp-dispensary-data-output.php`
*   Updated code to use the new `wpd_details_phrase` function in `admin/wp-dispensary-data-output.php`
*   Updated code to use the new `wpd_pricing_phrase` function in `admin/wp-dispensary-data-output.php`
*   Updated code to use the new `wpd_pricing_phrase` function in `admin/wp-dispensary-shortcodes.php`
*   Updated flowers shortcode with `wpd_compounds_simple` function in `admin/wp-dispensary-shortcodes.php`
*   Updated shortcode product details in `admin/wp-dispensary-shortcodes.php`
*   Updated `wpd-carousel` shortcode display updates in multuple areas in `admin/wp-dispensary-shortcodes.php`
*   Updated Prices and Details tables to not display if empty in `public/js/wp-dispensary-public.js`
*   Updated Compounds table to not display if no compounds are added in  `admin/wp-dispensary-data-output`
*   Updated metabox order for Edibles, Pre-rolls and Growers in `admin/wp-dispensary-admin-screens.php`
*   Updated `.pot` file with new text strings for localization in `languages/wp-dispensary.pot`
*   Updated Flower prices weight display text in metabox in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated code for various text strings to be translatable in various files
*   General code cleanup throughout various files in the plugin

## 2.3
*   Added Strain Type taxonomy in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added Strain Type to activator permalink flush in `includes/class-wp-dispensary-activator.php`
*   Added REST API endpoint for Strain Types in `admin/wp-dispensary-rest-api.php`
*   Added Allergens taxonomy for Edibles in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added Allergens taxonomy to data output in `admin/wp-dispensary-data-output.php`
*   Added Allergens to activator permalink flush in `includes/class-wp-dispensary-activator.php`
*   Added REST API endpoint for Allergens in `admin/wp-dispensary-rest-api.php`
*   Added Edibles shortcode options for servings, THC mg & total THC in `admin/wp-dispensary-shortcodes.php`
*   Added shortcode options for ordering by `meta_key` in `admin/wp-dispensary-shortcodes.php`
*   Added `wpd_topicals_shortcode_args` filter for Topicals shortcode `$args` in `admin/wp-dispensary-shortcodes.php`
*   Added `per unit` pricing for Edibles, Pre-rolls and Growers in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added `per unit` pricing to Edibles, Pre-rolls and Growers data output in `admin/wp-dispensary-data-output.php`
*   Added `per unit` pricing to Edibles, Pre-rolls and Growers shortcode output in `admin/wp-dispensary-shortcodes.php`
*   Added REST API endpoints for `per unit` pricing in `admin/wp-dispensary-rest-api.php`
*   Added Pre-roll weight metabox for Pre-rolls in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added Pre-roll weight to data output for Pre-rolls in `admin/wp-dispensary-data-output.php`
*   Added Pre-roll weight to shortcode details for Pre-rolls in `admin/wp-dispensary-shortcodes.php`
*   Added REST API endpoint for Pre-roll weight in `admin/wp-dispensary-rest-api.php`
*   Added 2g and 5g prices for Flowers in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added 2g and 5g prices to data output for Flowers in `admin/wp-dispensary-data-output.php`
*   Added 2g and 5g prices to shortcode details for Flowers in `admin/wp-dispensary-shortcodes.php`
*   Added REST API endpoints for Flowers 2g and 5g prices in `admin/wp-dispensary-rest-api.php`
*   Updated columns on edit screens to clean up what data displays for each menu type in `admin/wp-dispensary-admin-screens.php`
*   Updated Shelf Type taxonomy name and filter in `admin/post-types/wp-dispensary-taxonomies.php`
*   Updated how Compound Details display in data output in `admin/wp-dispensary-data-output.php`
*   Updated `.pot` file with new text strings for localization in `languages/wp-dispensary.pot`
*   Updated code for various text strings to be translatable in various files

## 2.2
*   Added updates to `.pot` file for localization in `languages/wp-dispensary.pot`
*   Added all default WP Dispensary menu types to the Permalinks Settings page in `admin/class-wp-dispensary-permalink-settings.php`
*   Bugfix with the `WP_Dispensary_Version` name in `includes/class-wp-dispensary.php`
*   Updated permalink base codes for the `flowers` permalink base in `admin/post-types/wp-dispensary-flowers.php`
*   Updated permalink base codes for the `concentrates` permalink base in `admin/post-types/wp-dispensary-concentrates.php`
*   Updated permalink base codes for the `edibles` permalink base in `admin/post-types/wp-dispensary-edibles.php`
*   Updated permalink base codes for the `prerolls` permalink base in `admin/post-types/wp-dispensary-prerolls.php`
*   Updated permalink base codes for the `topicals` permalink base in `admin/post-types/wp-dispensary-topicals.php`
*   Updated permalink base codes for the `growers` permalink base in `admin/post-types/wp-dispensary-growers.php`

## 2.1
*   Added "Shelf Type" taxonomy in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added "Shelf Type" taxonomy to shortcode options in `admin/wp-dispensary-shortcodes.php`
*   Added "Shelf Type" taxonomy REST API endpoints in `admin/wp-dispensary-rest-api.php`
*   Updated admin menu function name prefix in `admin/class-wp-dispensary-admin-settings.php`
*   Updated display text for menu type admin screens in various files
 
## 2.0.2
*   Added categories endpoint to the REST API in `admin/wp-dispensary-rest-api.php`
*   Updated Growers category REST API endpoint in `admin/wp-dispensary-rest-api.php`
*   Updated public CSS to fix a couple of issues in `public/css/wp-dispensary-public.css`
*   Updated spelling/capitalization in various areas throughout the entire plugin

## 2.0.1
*   Added CBG% options to Flowers, Concentrates and Carousel shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added 'pricing' CSS class to span tags for various shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added missing ajax loader image in `public/images/`
*   Fixed bug in compound details REST API in `admin/wp-dispensary-rest-api.php`
*   Fixed bug with shortcode cost phrase not using WPD Settings option in `admin/wp-dispensary-shortcodes.php`
*   Fixed bug with Donations title display if selected as WPD Settings option in `admin/wp-dispensary-data-output.php`

## 2.0
*   Added "Dispensary Menu" page creation (with default shortcodes) on plugin activation in ` includes/class-wp-dispensary-activator.php`
*   Added featured image title for admin menu type screens in `admin/wp-dispensary-admin-screens.php`
*   Added post type filter for admin menu type screen thumbnails in `admin/wp-dispensary-admin-screens.php`
*   Added file to house all custom functions in `admin/wp-dispensary-functions.php`
*   Added CBG to list of compound details in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added CBG to list of compound details in `admin/wp-dispensary-data-output.php`
*   Added CBG to list of compound details in `admin/wp-dispensary-rest-api.php`
*   Added vendor taxonomy to flush rewrite rules on plugin activation in `includes/wp-dispensary-activator.php`
*   Fixed various debug errors for undefined variables in `admin/wp-dispensary-shortcodes.php`
*   Fixed deprecated string value in get_bloginfo function in `admin/wp-dispensary-shortcodes.php`
*   Fixed bug in CBA variable names in `admin/wp-dispensary-shortcodes.php`
*   Fixed bug in Concentrates widget form category default `admin/post-types/wp-dispensary-widgets.php`
*   Rebuilt the admin Settings for WP Dispensary in `admin/wp-dispensary-admin-settings.php`
*   Updated undefined variables for Details and Pricing tables in `admin/wp-dispensary-data-output.php`
*   Updated the admin WP Dispensary sub-menu link order in `admin/wp-dispensary-admin-settings.php`
*   Updated default variable values for pricinglow & pricinghigh in `admin/wp-dispensary-shortcodes.php`
*   Updated default order for taxonomies & metaboxes in Edit screens in `admin/wp-dispensary-admin-screens.php`
*   Updated Seed & Clone counts to be in a single metabox in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated default widget title's in `admin/post-types/wp-dispensary-widgets.php`
*   Updated Category taxonomy name updates in `admin/post-types/wp-dispensary-taxonomies.php`
*   Updated widget title background color in admin dashboard in `admin/css/wp-dispensary-admin.css`
*   Updated code to use new wpd_currency_code function in `admin/wp-dispensary-data-output.php`
*   Updated price output for carousel if all prices are empty in `admin/wp-dispensary-shortcodes.php`
*   Updated $content for non-WPD post types in `admin/wp-dispensary-data-output.php`
*   Updated CSS styles for WPD metaboxes in Woo + At a Glance box updates in `admin/css/wp-dispensary-admin.css`
*   Removed data tables from archive view by default in `admin/wp-dispensary-data-output.php`
*   Removed unncessary file to help reduce plugin size in `admin/post-types/wp-dispensary-build.php`
*   WordPress Coding Standards Updates throughout the entire plugin

## 1.9.18
*   Added filters for post types in data output in `admin/wp-dispensary-data-output.php`
*   Added 'view all' link options to shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Fixed nonce errors by adding isset() checks to verify_nonce() lines in `admin/post-types/wp-dispensary-metaboxes.php` - Thx [lucprincen](https://github.com/lucprincen)!
*   Updated shortcode titles to center by default in `public/css/wp-dispensary-public.css`

## 1.9.17
*   BUGFIX error on install/update with version 1.9.16 due to missing file in `includes/class-wp-dispensary.php`

## 1.9.16
*   Added thumbnail images to all menu type screens in the admin dashboard in `admin/wp-dispensary-admin-screens.php`
*   Added CSS for new thumbnail image column in menu type screens in the admin dashboard in `admin/css/wp-dispnsary-admin.css`
*   Added functions for updating custom endpoints via the REST API in `admin/wp-dispensary-rest-api.php`

## 1.9.15
*   Added 'difficulty' to Grower Details metabox in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added 'difficulty' to Grower Details table in `admin/wp-dispensary-data-output.php`
*   Added 'difficulty' to Grower information endpoint in `admin/wp-dispensary-rest-api.php`
*   Added post_type check to determine category type in `admin/wp-dispensary-shortcodes.php`
*   Added 'full' image size check to each shortcode in `admin/wp-dispensary-shortcodes.php`
*   Fixed widget display issue for list format in `admin/post-types/wp-dispensary-wigets.php`
*   Updated filter to change default shortcode images in `admin/wp-dispensary-shortcodes.php`

## 1.9.14
*   Added 'details' class name to Details table in `admin/wp-dispensary-data-output.php`
*   Added filter to change default shortcode images in `admin/wp-dispensary-shortcodes.php`
*   Fixed bug in widgets that caused html output in `admin/post-types/wp-dispenssary-widgets.php`
*   Fixed various display issues for shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Updated Edibles Product Information metabox style in `admin/css/wp-dispensary-admin.css`

## 1.9.13
*   Added taxonomies to Edibles and Topicals in `admin/post-types/wp-dispensary-taxonomies.php`
*   Fixed Concentrates cost phrase output in `admin/wp-dispensary-shortcodes.php`
*   Fixed Carousel price output for Pre-rolls in `admin/wp-dispensary-shortcodes.php`
*   Updated misspelled ID for compound details in `admin/post-types/wp-dispensary-metaboxes.php`
*   WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

## 1.9.12
*   Added `yield` option to Growers item details in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added `yield` metabox info to data output in `admin/wp-dispensary-data-output.php`
*   Added `yield` metabox to REST API in `admin/wp-dispensary-rest-api.php`
*   Added CSS for Growers Item Details metabox in `admin/css/wp-dispensary-admin.css`
*   Added default images to shortcodes when menu items don't have a featured image added, in `admin/wp-dispensary-shortcodes.php`
*   Added default image files for the default shortcode image display in `public/images/`
*   Changed metabox title from `Clone Details` to `Grower Item Details` in `admin/post-types/wp-dispensary-metaboxes.php`
*   Fixed several potential global namespace errors in `admin/post-types/wp-dispensary-metaboxes.php` Thx [Luc Princen](https://twitter.com/LucP)!
*   WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1)) Thx [William Patton](https://twitter.com/Will_Patton_88)!

## 1.9.11
*   Added filter parameter shortcode names for each shortcode in `admin/wp-dispensary-shortcodes.php`
*   Added CSS class to shortcode item name `<p>` wraps in `admin/wp-dispensary-shortcodes.php`
*   Added 'image' option to each shortcode in `admin/wp-dispensary-shortcodes.php`
*   Added Flowers category taxonomy to the Pre-rolls menu type in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added 14 new action hooks to the shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added 'vendor' taxonomy in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added 'vendor' option to shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added 'vendor' taxonomy to the Details table in `admin/wp-dispensary-data-output.php`
*   Added 'vendor' taxonomy endpoints for the API in `admin/wp-dispensary-rest-api.php`
*   Fixed the THC and CBD amount from % to mg in `admin/wp-dispensary-data-output.php`
*   WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

## 1.9.10
*   Added filters to post query $args for shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added filters to register_taxonomy types in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added filters to $screens for metaboxes in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added CSS class names to item info span wraps in `admin/wp-dispensary-shortcodes.php`
*   Removed halfgram prices from flowers in various files (see [commit](https://github.com/deviodigital/wp-dispensary/commit/100dfeabb6e6b737f424a74ed1278a9a240330ee))
*   Removed support for the Subtitles plugin (we still love it, but it's not something we feel is right for core plugin inclusion)
*   Updated action hook names for widgets in `admin/post-types/wp-dispensary-widgets.php`
*   Updated price output for Concentrates in the carousel shortcode in `admin/wp-dispensary-shortcodes.php`
*   Updated oEmbed filter name in `wp-dispensary.php`
*   Updated the_excerpt filter name in `wp-dispensary.php`
*   WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

## 1.9.9
*   Changed "THC % & CBD %" metabox to "Compound Details" and added 3 new compounds in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added 3 new compounds to Details table output in `admin/wp-dispensary-data-output.php`
*   Added API endpoints for the 3 new compounds in `admin/wp-dispensary-rest-api.php`
*   Added Compound Details to the shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added oEmbed style customization in `wp-dispensary.php`
*   Added oEmbed CSS in `public/wp-dispensary-oembed.css` and `public/class-wp-dispensary-public.php`
*   Fixed code error in the `[wpd-carousel]` output in `admin/wp-dispensary-shortcodes.php`
*   Updated translation strings in `languages/wp-dispensary.pot`
*   Updated Pricing table's title if donation is selected in `admin/wp-dispensary-data-output.php`

## 1.9.8
*   Added `Settings` link for WP Dispensary on the `plugins` page in `wp-dispensary.php`
*   Removed all custom post type's from admin dashboard menu in `admin/post-types/`
*   Updated placement of `WP Dispensary` in the admin dashboard menu, and added menu type links to sub-menu in `admin/wp-dispensary-admin-settings.php`

## 1.9.7
*   Added 12 new Action Hooks to widgets in `admin/wp-dispenesary-widgets.php`
*   Added an image size option to all widgets in `admin/wp-dispenesary-widgets.php`
*   Fixed flower shortcode price display if no prices are added in `admin/wp-dispenesary-shortcodes.php`
*   Fixed empty variables for WPD Settings options in `admin/wp-dispensary-data-output.php`
*   Fixed name error for the Edibles widget in `admin/wp-dispensary-widgets.php`
*   Updated 12 Action Hook names in `admin/wp-dispenesary-widgets.php`
*   Updated call constructor method for all widgets in `admin/wp-dispensary-widgets.php`

## 1.9.6.1
*   Fatal error bug with the REST API code fixed (thanks @jeherve!) in `admin/wp-dispensary-rest-api.php`
*   Fixed Concentrate price output for shortcodes in `admin/wp-dispensary-shortcodes.php`

## 1.9.6
*   Added imgsize option to shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added image sizes for shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Updated Action Hooks code for shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Updated Concentrates pricing in `admin/post-types/wp-dispensary-metaboxes.php`
*   Updated Concentrates pricing for data ouput in `admin/wp-dispensary-data-output.php`
*   Updated Concentrates pricing for REST API in `admin/wp-dispensary-rest-api.php`
*   Updated Concentrates pricing output in shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Updated CSS for admin Concentrate Prices box in `admin/css/wp-dispensary-admin.css`

## 1.9.5
*   Added 2 new Action Hooks to shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added 8 new Action Hooks to Pricing & Data Tables in `admin/wp-dispensary-data-output.php`
*   Added Clone Details metabox to Growers menu type in `admin/wp-dispensary-metaboxes.php`
*   Added Clone Details information to Details Table in `admin/wp-dispensary-data-output.php`
*   Added Carousel shortcode in `admin/wp-dispensary-shortcodes.php`
*   Added CSS styles for the Carousel shortcode in `public/css/wp-dispensary-public.css`
*   Added slick.js for the Carousel shortcode in `public/js/wp-dispensary-public.js`
*   Updated promotion for premium add-ons for WP Dispensary in `admin/wp-dispensary-admin-settings.php`

## 1.9.4
*   Added check for all prices, not just grams in `admin/wp-dispensary-shortcodes.php`
*   Added category taxonomies to Menus in admin dash `admin/post-types/wp-dispensary-taxonomies.php`
*   Added taxonomy options to shortcodes (Flowers, Concentrates, Topicals, Edibles) in `admin/wp-dispensary-shortcodes.php`
*   Added orderby option to all shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Added THC% and CBD% to Pre-rolls in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added THC% and CBD% to the data output Details table in `admin/wp-dispensary-data-output.php`
*   Added THC and CBD options to Flowers shortcode in `admin/wp-dispensary-shortcodes.php`
*   Fixed ounce price check in `admin/wp-dispensary-data-output.php`

## 1.9.3
*   Added ingredients to Topicals menu type in `admin/post-types/wp-dispensary-taxonomies.php`
*   Added ingredients for Topicals to the data output Details table in `admin/wp-dispensary-data-output.php`
*   Added net weight option to the Edibles Product Information metabox in `admin/post-types/wp-dispensary-metaboxes.php`
*   Added net weight for Edibles to the data output Details table in `admin/wp-dispensary-data-output.php`
*   Added match-height script for better shortcode display in `public/js/wp-dispensary-public.js`
*   Updated CSS style for Pricing and Details tables in `public/css/wp-dispensary-public.css`
*   WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

## 1.9.2
*   Fixed error that caused the Widgets page in dashboards to not show correctly in `admin/post-types/wp-dispensary-widgets.php`

## 1.9.1
*   Added custom Cost Phrase option to the WPD Settings page in `admin/wp-dispensary-admin-settings.php`
*   Added custom Cost Phrase to the data output Pricing table in `admin/wp-dispensary-data-output.php`
*   Added custom Cost Phrase to shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Updated default Currency Code output to the data output Pricing table in `admin/wp-dispensary-data-output.php`
*   Updated default Currency Code output to shortcodes in `admin/wp-dispensary-shortcodes.php`
*   WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

## 1.9
*   Added custom Currency Code to the data output tables in `admin/wp-dispensary-data-output.php`
*   Added custom Currency Code to shortcodes in `admin/wp-dispensary-shortcodes.php`
*   Moved WPD Settings to it's own parent menu in the admin dashboard in `admin/wp-dispensary-admin-settings.php`
*   Updated WPD Settings options in `admin/wp-dispensary-admin-settings.php`

## 1.8
*   Added "prerolls" in array to output </table> in `admin/wp-dispensary-data-output.php`
*   Added Action Hooks to Pricing & Data Tables in `admin/wp-dispensary-data-output.php`
*   Added promotion for premium add-ons for WP Dispensary in `admin/wp-dispensary-admin-settings.php`
*   Fixed shortcode `[wpd-edibles]` serving count output in `admin/wp-dispensary-shortcodes.php`
*   Removed unnecessary pricing variable in `admin/wp-dispensary-shortcodes.php`
*   Updated shortcode `[wpd-edibles]` output of THC mg% & servings in `admin/wp-dispensary-shortcodes.php`
*   Updated serving count variable name for edibles in `admin/wp-dispensary-shortcodes.php`

## 1.7.1
*   Added 'placement' and 'display' options to the WP Dispensary settings page
*   Added 'category' option to shortcodes to allow for separation of menu type by category
*   Updated price output in the flowers shortcode if only the gram price is added
*   Updated metaboxes to use text input rather than number input, so decimals can be used

## 1.7
*   Added Growers menu type
*   Added API endpoints for Growers menu type
*   Added Widget for Growers menu type
*   Added `[wpd-growers]` shortcode for Growers menu type
*   Updated `languages/wp-dispensary.pot` file with all current translatable text throughout the plugin

## 1.6
*   Added WP Dispensary settings page to the WordPress admin menu
*   Added in automatic output of menu item details and pricing to `the_content`
*   Updated `admin/post-types/wp-dispensary-metaboxes.php` to fix Serving information metabox details
*   WordPress Coding Standards updates ([issue](https://github.com/deviodigital/wp-dispensary/issues/1))

## 1.5.2
*   Removed file that was left behind for the plugin recommendation

## 1.5.1
*   Removed plugin recommendation since it was causing upgrade errors

## 1.5
*   Added various new output options for shortcode display
*   Added WPD icon to each menu section in dashboard "At A Glance" box
*   Added option to randomize menu item output in widgets
*   Added plugin recommendation for [Dispensary Coupons](https://wordpress.org/plugins/dispensary-coupons/)
*   PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files
*   Updated CSS in `public/css/wp-dispensary-public.css` for improved display in the widgets

## 1.4
*   Added the WP Dispensary icon to each CPT in the admin dashboard for easier visual recognition
*   Added `active_plugins` check for "Subtitles" plugin in `admin/wp-dispensary-rest-api.php` API output
*   Added sanitization to $_POST in `admin/post-types/wp-dispensary-metaboxes.php` pre-roll flower selection drop down
*   Created the Topicals menu type, with Widget, Shortcode and WP-API output options
*   PHP_CodeSniffer WordPress Coding Standards updates throughout various plugin files
*   Updated the output style of the Shortcode item information

## 1.3.1
*   Fixed CBD being called BCD #typingtoofast

## 1.3
*   Added THC% and CBD% metaboxes
*   Added custom image size for the shortcodes

## 1.2
*   Added Shortcode output for use with any theme
*   Removed code causing error on Menus page

## 1.1
*   Added WordPress REST API integration

## 1.0
*   Initial release
