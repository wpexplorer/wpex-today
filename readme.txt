=== WPEX Today ===
Authors: WPExplorer
Author URI: https://www.wpexplorer.com
Tags: right-sidebar, fluid-width, custom-background
Requires at least: 5.1
Tested up to: 6.6
Stable tag: 2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Licenses ==

Font Awesome Icons
License: MIT License, https://opensource.org/license/mit/
Source: https://fontawesome.com/v4/icons/

Material Design Icons
License: SIL Open Font License, https://developers.google.com/fonts/faq#can_i_use_any_font_in_a_commercial_product
Source: https://fonts.google.com/icons?icon.set=Material+Icons

== Changelog ==

= 2.1 =
* Added required attribute to the search form.
* Updated default footer copyright.
* Updated CSS to use direction aware CSS for automatic RTL support.

= 2.0 =
* Added licenses added to readme.txt.
* Added wpex-accent and wpex-on-accent CSS variables to easily change the default black accent.
* Added options to enter a custom h1 text and custom text for the homepage which can be useful for SEO.
* Updated twitter to be X.
* Updated entries to use flex styles and equal heights.
* Updated header CSS to use flex styles.
* Updated link color.
* Updated various CSS to use modern styles and be better optimized.
* Updated the body font size to be larger to comfirm to modern standards.
* Updated entries and footer widgets to use a modern CSS grid.
* Updated the entry meta only displays the date now which is better for SEO.
* Updated logo retina functionality to use modern srcset attributes instead of javascript.
* Updated tested up to version.
* Fixed errors with PHP 8.2.
* Fixed some theme check errors.
* Fixed some accessability errors.
* Fixed standard pages not showing the page title.
* Removed all custom fields (video/audio) in favor or using Gutenberg blocks instead - If you are updating to this version you will need to manually update your posts or continue using the older version of the theme to display the video/audio defined in the custom fields.
* Removed the Theme details admin page and admin RSS feed.
* Removed some CSS that was not needed and caused accessibility concerns has been removed.
* Removed font Awesome and updated to use SVG icons instead.
* Removed Google Plus and Vine options.
* Removed Google Fonts and switched to system-ui font stack for speed.
* Removed the featured image on pages which looked weird.

= 1.3 =

* Fixed localization issues.
* Removed Google Plus settings.
* Removed HTML5 shiv js.
* Added ABSPATH check to every php file.
* Added wp_body_open hook.

= 1.2 =

* Added Aria hidden labels to font icons
* Updated Theme about page and added button to disable it
* Updated Footer copyright links and added new Customizer setting to enter your custom copyright and replace the default theme links
* Updated html5 script to load via wp_enqueue_scripts instead of manually added in header.php file
* Updated functions.php to use get_parent_theme_file_path and get_parent_theme_file_uri functions for any required files
* Updated Text Domain to equal theme folder name "wpex-today"
* Updated Translation file and renamed to wpex-today.pot
* Fixed Theme Unit Check errors
* Fixed Issue with custom entry excerpt length not working
* Fixed Issue with comment button in social are displaying even when comments are disabled
* Fixed Accessibility issues with focus states on links and forms
* Fixed Checkbox display issue in comment forms


= 1.1 =

* Updated Theme about panel to fix 4.5 h2 design and moved it under appearance instead of it’s own tab
* Fixed Screenshot

= 1.0 =

* First official release