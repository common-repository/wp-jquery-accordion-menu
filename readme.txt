=== WP jQuery Accordion Menu ===
Contributors: tuncaydemirtepe
Donate link: http://tuncay.demirtepe.com/wordpress-plugin-wp-jquery-accordion-menu/
Tags: jquery, menu, vertical accordion, animated, css, navigation, widget, page
Requires at least: 2.8
Tested up to: 3.3
Stable tag: 1.2.1

Creates vertical dropdown menus from wordpress pages with wp_list_pages function using jQuery.

== Description ==

Creates vertical dropdown menus from wordpress pages with wp_list_pages function using jQuery. You can add menu using either widgets or function in theme file. Handles just 2 levels and supports every parameters wp_list_pages has. Also you can set menu div's id and class by additional parameters.

= Widget Options for Menu =

ID for container UL: You can set an ID of menu div. Default: nav

CSS class for container UL: You can set an class of menu div. Default: null

All other parameters comes from wp_list_pages function. You can check function page for further information: http://codex.wordpress.org/Function_Reference/wp_list_pages#Parameters

For more information please check out the plugin home page:

[__Plugin Home Page__](http://tuncay.demirtepe.com/wordpress-plugin-wp-jquery-accordion-menu/)
[__See Demo__](http://demo2.mtdsoft.us/blue_ocean/)

== Installation ==

This section describes how to install the plugin and get it working.

== Installation ==

1. Upload the plugin through `Plugins > Add New > Upload` interface or upload `wp-jquery-accordion-menu` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In the widgets section, select the "WP JQuery Accordion Menu" widget and add to one of your widget areas and set the parameters. Also you can call "get_menu" function from your theme files. Please check plugin page for using function.
4. Please make sure jQuery library is added.

== Frequently Asked Questions ==

= Menu doesnt work =

First - Make sure you have parent and child pages. If your pages all parents menu wont work.

Second - Make sure jQuery library is in <head> section.

== Screenshots ==

http://tuncay.demirtepe.com/wp-content/uploads/screenshot-1.gif
http://tuncay.demirtepe.com/wp-content/uploads/screenshot-2.gif

== Changelog ==

= 1.0 =
* First release

= 1.1 =
* A bug about css classes fixed.

= 1.2 =
* "Extra code" field added into widget settings. You can add your own jquery code to control menu. (ie: to use links to load content in a div on the same page).

= 1.2.1 =
* I find out a confict between my plugin and some others and fixed it. Thanks to Daniel K. for his help to address the issue.



== Upgrade Notice ==
No note right now.