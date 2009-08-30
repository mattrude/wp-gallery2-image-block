=== Gallery2 Image Block ===
Contributors: mattrude
Author URI: http://mattrude.com/
Plugin URI: http://mattrude.com/plugins/wp-gallery2-image-block/
Donate link: http://mattrude.com/donate/
Tags: Gallery2, images, image block, plugin, widget
Requires at least: 2.8
Tested up to: 2.8.4
Stable tag: 0.5.2
	
Widget to display your Gallery 2 Image Block on your Wordpress sidebar

== Description ==

This plugin will allow you to put one of the meny [Gallery2](http://gallery.menalto.com/) Image Blocks on your Wordpress site.  You are required to have a running Gallery2 install to use this plugin.
  
This is a complete rewrite of [Chris Schierer (aka Lentil)](http://www.theschierers.net/blog) [Gallery2 Image Block Plugin](http://wordpress.org/extend/plugins/gallery2-image-block-widget) 0.1.4.  This rewrite uses the new Wordpress 2.8 Widget API, so is only compatable with wordpress 2.8+.
  
All options described in the [Gallery 2 Image Block](http://codex.gallery2.org/Gallery2:Modules:imageblock) documentation are included. User configuration of Image Block options are available in the Widget configuration panel.  Blank (empty) options use the Gallery2 defaults.  

As of version 0.5, wp-gallery2-image-block has full localization support, and ships with 5 languages besides English. Please contact me if you would like to translate it into more langages, I would love for as meny peaple as posible to be able to use this plugin.

= Fully Translated into: =

* Dutch (0.5.1)
* French
* English
* German
* Portuguese (0.5.1)
* Spanish
  
*Note:* This widget was written using [lib_curl()](http://www.php.net/curl) to avoid url_fopen issues.
	
== Installation ==

Extract the zip file and just drop the contents in the `wp-content/plugins/` directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

You may ask questions or ask for support form the [Gallery2 Image Block Forums](http://mattrude.com/bbpress/forum/wp-gallery2-image-block).

= Q: Will this plugin work without Gallery2? =
A: Sorry No, [Gallery2](http://gallery.menalto.com/) is required.

= Q: Will I be able to add a random image to a page with this plugin? =
A: Sorry, this plugin will only work in the wiget sidebar.

== Changelog ==

= Version: 0.5.2 =
* Tested with wordpress 2.8.3 & 2.8.4 - no code change
* Corrected URL's
* Updated README

= Version: 0.5.1 =
* Tested with Wordpress 2.8.2 - no code changes
* Updated POT file do to typo
* Added Dutch translation
* Added Portuguese translation

= Version: 0.5 =
* Added full localization support
* Added French translation
* Added Spanish translation

= Version: 0.4 =
* Corrcted typo in $gallery_linktarget 

= Version: 0.3 =
* Corrected missing Header text tag

= Version: 0.1 =
* Initial Release

== Screenshots ==

1. Dashboard Wiget Screen
2. Shown on main page
