=== wp-gallery2-image-block ===
Contributors: mattrude
Author URI: http://www.mattrude.com/
Plugin URI: http://www.mattrude.com/2009/07/wp-gallery2-image-block/
Tags: Gallery2, image block, plugin, widget
Requires at least: 2.8
Tested up to: 2.8.1
Stable tag: 0.4
	
Widget to display your Gallery 2 Image Block on your Wordpress sidebar

== Description ==

This plugin will allow you to put one of the meny Gallery2 Image Blocks on your Wordpress site.  You are required to have a running Gallery2 install to use this plugin.
  
This is a complete rewrite of [Chris Schierer (aka Lentil)](http://www.theschierers.net/blog) [Gallery2 Image Block Plugin](http://wordpress.org/extend/plugins/gallery2-image-block-widget) 0.1.4.  This rewrite uses the new Wordpress 2.8 Widget API, so is only compatable with wordpress 2.8+.
  
Options described in the [Gallery 2 Image Block](http://codex.gallery2.org/Gallery2:Modules:imageblock) documentation are included.  
  
User configuration of Image Block options is available through the Widget configuration panel.  Blank (empty) options use the Gallery2 defaults.  
  
*Note:* The widget is written using [lib_curl()](http://www.php.net/curl) to avoid url_fopen issues.
	
== Installation ==

Extract the zip file and just drop the contents in the `wp-content/plugins/` directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

== Change Log ==

= 0.4 =
* Corrcted typo in $gallery_linktarget 

= 0.3 =
* Corrected missing Header text tag

= 0.1 =
* Initial Release

== Screenshots ==

1. Dashboard Wiget Screen

2. Shown on main page
