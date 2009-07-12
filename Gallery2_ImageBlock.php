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

function widget_G2_ImageBlock_init() {
  if ( !function_exists('register_sidebar_widget') )
    return;


  // Options and default values for this widget
  function widget_G2_ImageBlock_options() {
	return array(
	  'Title' => "Daily Image",
      'Gallery URL' => "http://localhost/gallery",
      'g2_blocks' => "dailyImage",
      'g2_show' => "title|date",
	  'g2_itemId' => "",
	  'g2_maxSize' => "",
	  'g2_exactSize' => "200",
	  'link' => "",
	  'linkTarget' => ""
    );
  }

  // This is the function that outputs the actual code.
  function widget_G2_ImageBlock($args) {
    extract($args);
  
    $options = array_merge(widget_G2_ImageBlock_options(), get_option('widget_G2_ImageBlock'));
    unset($options[0]); //returned by get_option(), but we don't need it
  
    echo $before_widget . $before_title . $options['Title'] . $after_title;
  
    ?><!-- G2 ImageBlock --><?php 
  
    $ch = curl_init();
    $timeout = 5; // set to zero for no timeout
    curl_setopt ($ch, CURLOPT_URL,
    $options['Gallery URL'] . '/main.php?g2_view=imageblock.External&g2_blocks=' . $options['g2_blocks'] . '&g2_show=' . $options['g2_show'] . '&g2_itemId=' . $options['g2_itemId'] . '&g2_maxSize=' . $options['g2_maxSize'] . '&g2_exactSize=' . $options['g2_exactSize'] . '&g2_link=' . $options['g2_link'] . '&g2_linkTarget=' . $options['g2_linkTarget'] );
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    curl_close($ch);
    echo $file_contents;
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
    if(($options = get_option('widget_G2_ImageBlock')) === FALSE) $options = array();
      $options = array_merge(widget_G2_ImageBlock_options(), $options);
      unset($options[0]); //returned by get_option(), but we don't need it
      if ( $_POST['G2_ImageBlock-submit'] ) {
        foreach($options as $key => $value)
          if(array_key_exists('G2_ImageBlock-'.sanitize($key), $_POST))
            $options[$key] = strip_tags(stripslashes($_POST['G2_ImageBlock-'.sanitize($key)]));
          update_option('widget_G2_ImageBlock', $options);
    }
    foreach($options as $key => $value): ?>
    <p style="text-align:left"><label for="G2_ImageBlock-<?=sanitize($key)?>"><?=$key?>: <input style="width: 200px;" id="G2_ImageBlock-<?=sanitize($key)?>" name="G2_ImageBlock-<?=sanitize($key)?>" type="text" value="<?=htmlspecialchars($value, ENT_QUOTES)?>" /></label></p>
    <? endforeach;
    echo '<input type="hidden" id="G2_ImageBlock-submit" name="G2_ImageBlock-submit" value="1" />';
  }
  
  register_sidebar_widget('G2 ImageBlock', 'widget_G2_ImageBlock');
  register_widget_control('G2 ImageBlock', 'widget_G2_ImageBlock_control', 220, 50 * count(widget_G2_ImageBlock_options()));
}

// Run our code later in case this loads prior to any required plugins.
add_action('plugins_loaded', 'widget_G2_ImageBlock_init');

?>
