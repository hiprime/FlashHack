=== Featured Image in Content ===
Contributors: celloexpressions, annenbergdl
Tags: featured image, post thumbnail
Requires at least: 4.4
Tested up to: 4.8
Stable tag: 1.0
Description: If you switch to a theme that doesn't show featured images on single posts, activate this plugin to show them in the content area.
License: GPLv2

== Description ==
Not all themes work the same way, and sometimes switching themes can lead to a lot of headaches. If you've previously used a theme that supports featured images and displays them on single post views, you probably want to ensure that these images are still shown if you switch to a theme that doesn't show featured images here, without editing all of your old content.

This plugin automatically displays featured images at the top of the content area on single post views. It doesn't check whether your theme displays them, so you'll get double featured images if it does. IT works via a filter, so if you ever switch themes again to one that does support featured images on single views, you can deactivate this plugin and things will go right back to normal. No information is saved in the database and no additional special image sizes are generated in this plugin.

= Possible Core Material =
This plugin may be material for WordPress core if it were to display featured images that exist when the current theme doesn't support featured images. While this would reduce the potential for content loss, it would also have a significant affect on existing content.

== Installation ==
1. Take the easy route and install through the WordPress plugin adder OR
1. Download the .zip file and upload the unzipped folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Featured images that have been added will start showing up on single views immediately, at the top of the content.

== Frequently Asked Questions ==
= Where's the settings page? =
For simplicity's sake, no settings page is included. While there are a few potential options, I don't feel that they would be worth the extra bloat of a settings page. If you would like to make adjustments, I suggest implementing your own plugin based on this one (feel free to copy/paste, then rename it) - the code is very simple and can be easily adjusted to related needs. 

== Screenshots ==
1. Featured image in an image-format post with only a title and featured, displayed in Twenty Ten (which doesn't support featured images). Without the plugin, only the post title displays.

== Changelog ==
= 1.0 =
* Initial release.

== Upgrade Notice ==
= 1.0 =
* Initial release.