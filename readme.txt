=== Plugin Name ===
Contributors: Lentil
Donate link: http://www.theschierers.net/blog/
Tags: Gallery2, image block, plugin, widget 
Requires at least: 2.5.1?
Tested up to: 2.6.2
Stable tag: trunk

Widget to display a Gallery 2 (not WPG2!) Image Block in Wordpress sidebar

== Description ==

If you use Gallery2 in an external (non WPG2) installation, you may want to display images using the Gallery2 Image Block module.  If so, this is the widget for you.  Options described in the [Gallery 2 Image Block](http://codex.gallery2.org/Gallery2:Modules:imageblock) documentation are included, but not all have been tested.  Your mileage may vary.

User configuration of Image Block options is available through the Widget configuration panel.  Blank (empty) options use the Gallery2 defaults.

*Note:* The widget is written using [lib_curl()](http://www.php.net/curl) to avoid url_fopen issues.

For more information, see the [plugin page](http://www.theschierers.net/blog/g2-imageblock-plugin).

== Installation ==

1. Unpack the zip file.
1. Upload `Gallery2_ImageBlock.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add the G2 ImageBlock widget to an active sidebar from the 'Display:Widget' menu.
1. Configure the `Gallery2 URL` option to match your Gallery install.  Do not include `main.php` or the trailing slash.
1. Save your sidebar changes and view your new Image Block!

== Frequently Asked Questions ==

= What options have been tested? =

RandomImage and DailyImage blocks have been tested along with both at once (using the pipe '|' separator).  Title and date 'show' options have been tested along with both at once.  'maxSize' was also tested.

== Screenshots ==

1. An example of the widget in place on my website.  Not that title and date are being shown and a custom title is in use.
2. The widget form open and active for editing showing the available options.