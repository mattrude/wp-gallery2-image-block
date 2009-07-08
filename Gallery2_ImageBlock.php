<?php
/*
Plugin Name: External Gallery2 Image Block Plugin
Plugin URI: http://www.theschierers.net/blog/g2-imageblock-plugin
Description: Display a Gallery2 Image Block if you're NOT using WPG2
Version: 0.1.4
Author: Chris Schierer (aka Lentil)
Author URI: http://www.theschierers.net/blog

Thanks to all who came before who I stole code and comments from (particularly Mike Smullin's Authors List plugin (http://www.mikesmullin.com/) which I used as an example.
*/

// 0.1.3  2008-05-07 Initial public release candidate.
// 0.1.4  2008-09-14 Update to mark valid for WP 2.6.2

// Put functions into one big function we'll call at the plugins_loaded
// action. This ensures that all required plugin functions are defined.
function widget_G2_ImageBlock_init() {
  // Check for the required plugin functions. This will prevent fatal
  // errors occurring when you deactivate the dynamic-sidebar plugin.
  if ( !function_exists('register_sidebar_widget') )
    return;


  // Options and default values for this widget
  function widget_G2_ImageBlock_options() {
	return array(
	  'Title' => "Daily Image",
      'Gallery URL' => "http://putyourwebsitehere/gallery",
      'g2_blocks' => "dailyImage",
      'g2_show' => "title|date",
	  'g2_itemId' => "",
	  'g2_maxSize' => "",
	  'g2_exactSize' => "",
	  'link' => "",
	  'linkTarget' => ""
    );
  }

  // This is the function that outputs the actual code.
  function widget_G2_ImageBlock($args) {
    // $args is an array of strings that help widgets to conform to
    // the active theme: before_widget, before_title, after_widget,
    // and after_title are the array keys. Default tags: li and h2.
    extract($args);

    // Each widget can store and retrieve its own options.
    // Here we retrieve any options that may have been set by the user
    // relying on widget defaults to fill the gaps.
    $options = array_merge(widget_G2_ImageBlock_options(), get_option('widget_G2_ImageBlock'));
    unset($options[0]); //returned by get_option(), but we don't need it

    // These lines generate our output. Widgets can be very complex
    // but as you can see here, they can also be very, very simple.
    echo $before_widget . $before_title . $options['Title'] . $after_title;

?>

<!-- G2 ImageBlock -->
<?php /* Work around url_fopen() */
	$ch = curl_init();
	$timeout = 5; // set to zero for no timeout
	curl_setopt ($ch, CURLOPT_URL,
$options['Gallery URL'] . '/main.php?g2_view=imageblock.External&g2_blocks=' . $options['g2_blocks'] . '&g2_show=' . $options['g2_show'] . '&g2_itemId=' . $options['g2_itemId'] . '&g2_maxSize=' . $options['g2_maxSize'] . '&g2_exactSize=' . $options['g2_exactSize'] . '&g2_link=' . $options['g2_link'] . '&g2_linkTarget=' . $options['g2_linkTarget'] );
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$file_contents = curl_exec($ch);
	curl_close($ch);
	echo $file_contents;
?>
<?php
/* This is the default way to load the daily image */
//@readfile('http://www.theschierers.net/gallery/main.php?g2_view=imageblock.External&g2_blocks=dailyImage&g2_show=title');
/* This is the default way to load the random image */
//@readfile('http://www.theschierers.net/gallery/main.php?g2_view=imageblock.External&g2_blocks=randomImage&g2_show=title');
  
   echo $after_widget;
  }
  
// Gallery 2.3 sanitize function
function sanitize($string) {
    if (get_magic_quotes_gpc()) {
        $string = stripslashes($string);
    }
    return $string;
}

// This is the function that outputs the form to let the users edit
// the widget's title. It's an optional feature that users cry for.
function widget_G2_ImageBlock_control() {
  // Each widget can store and retrieve its own options.
  // Here we retrieve any options that may have been set by the user
  // relying on widget defaults to fill the gaps.
  if(($options = get_option('widget_G2_ImageBlock')) === FALSE) $options = array();
    $options = array_merge(widget_G2_ImageBlock_options(), $options);
    unset($options[0]); //returned by get_option(), but we don't need it
  
    // If user is submitting custom option values for this widget
    if ( $_POST['G2_ImageBlock-submit'] ) {
      // Remember to sanitize and format use input appropriately.
      foreach($options as $key => $value)
        if(array_key_exists('G2_ImageBlock-'.sanitize($key), $_POST))
          $options[$key] = strip_tags(stripslashes($_POST['G2_ImageBlock-'.sanitize($key)]));
  
      // Save changes
      update_option('widget_G2_ImageBlock', $options);
    }
  
    // Here is our little form segment. Notice that we don't need as
    // complete form. This will be embedded into the existing form.
    // Be sure you format your options to be valid HTML attributes
    // before displayihng them on the page.
    foreach($options as $key => $value): ?>
      <p style="text-align:left"><label for="G2_ImageBlock-<?=sanitize($key)?>"><?=$key?>: <input style="width: 200px;" id="G2_ImageBlock-<?=sanitize($key)?>" name="G2_ImageBlock-<?=sanitize($key)?>" type="text" value="<?=htmlspecialchars($value, ENT_QUOTES)?>" /></label></p>
    <? endforeach;
    echo '<input type="hidden" id="G2_ImageBlock-submit" name="G2_ImageBlock-submit" value="1" />';
  }
  
  // This registers our widget so it appears with the other available
  // widgets and can be dragged and dropped into any active sidebars.
  register_sidebar_widget('G2 ImageBlock', 'widget_G2_ImageBlock');
  
  // This registers our optional widget control form. Because of this
  // our widget will have a button that reveals a 300x100 pixel form.
  register_widget_control('G2 ImageBlock', 'widget_G2_ImageBlock_control', 220, 50 * count(widget_G2_ImageBlock_options()));
}

// Run our code later in case this loads prior to any required plugins.
add_action('plugins_loaded', 'widget_G2_ImageBlock_init');

?>
