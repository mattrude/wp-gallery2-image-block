<?php
/*
Plugin Name: Gallery2 Image Block
Plugin URI: http://www.mattrude.com/gallery2-image-block
Description: Display a Gallery2 Image Block on your Wordpres site, this is requires a connection to a Gallery2 install.
Version: 0.1
Author: Matt Rude
Author URI: http://www.mattrude.com
*/

class Gallery2_Block extends WP_Widget {
  function Gallery2_Block() {
    $widget_ops = array('classname' => 'Gallery2_Block', 'description' => 'Gallery2 Image Block for Wordpress' );
    $this->WP_Widget('Gallery2_Block', 'Gallery2 Image Block', $widget_ops);
  }  

  function widget($args, $instance) {
    extract($args);
  
    echo $before_widget;
    $gallery_widget_title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
    $gallery_url = empty($instance['url']) ? '&nbsp;' : apply_filters('url', $instance['url']);
    $gallery_block = empty($instance['block']) ? '&nbsp;' : apply_filters('block', $instance['block']);
    $gallery_show = empty($instance['show']) ? '&nbsp;' : apply_filters('show', $instance['show']);
    $gallery_itemid = empty($instance['itemid']) ? '&nbsp;' : apply_filters('itemid', $instance['itemid']);
    $gallery_maxsize = empty($instance['maxsize']) ? '&nbsp;' : apply_filters('maxsize', $instance['maxsize']);
    $gallery_exactsize = empty($instance['exactsize']) ? '&nbsp;' : apply_filters('exactsize', $instance['exactsize']);
    $gallery_link = empty($instance['link']) ? '&nbsp;' : apply_filters('link', $instance['link']);
    $gallery_linktarget = empty($instance['linktarget']) ? '&nbsp;' : apply_filters('linktarget', $instance['linktarget']);


     echo $gallery_show;
    $ch = curl_init();
    $timeout = 5; // set to zero for no timeout
    curl_setopt ($ch, CURLOPT_URL,
    $gallery_url . '/main.php?g2_view=imageblock.External&g2_blocks=' . $gallery_block . '&g2_show=' . $gallery_show . '&g2_itemId=' . $gallery_itemid . '&g2_maxSize=' . $gallery_maxsize . '&g2_exactSize=' . $gallery_exactsize . '&g2_link=' . $gallery_link . '&g2_linkTarget=' . $gallary_linktarget );
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    curl_close($ch);
    echo $file_contents;
    echo $after_widget;
  }
  
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['url'] = strip_tags($new_instance['url']);
    $instance['block'] = strip_tags($new_instance['block']);
    $instance['show'] = strip_tags($new_instance['show']);
    $instance['itemid'] = strip_tags($new_instance['itemid']);
    $instance['maxsize'] = strip_tags($new_instance['maxsize']);
    $instance['exactsize'] = strip_tags($new_instance['exactsize']);
    $instance['link'] = strip_tags($new_instance['link']);
    $instance['linktarget'] = strip_tags($new_instance['linktarget']);

    return $instance;
  }

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'url' => '', 'block' => '' ) );
    $gallery_widget_title = strip_tags($instance['title']);
    $gallery_url = strip_tags($instance['url']);
    $gallery_block = strip_tags($instance['block']);
    $gallery_show = strip_tags($instance['show']);
    $gallery_itemid = strip_tags($instance['itemid']);
    $gallery_maxsize = strip_tags($instance['maxsize']);
    $gallery_exactsize = strip_tags($instance['exactsize']);
    $gallery_link = strip_tags($instance['link']);
    $gallery_linktarget = strip_tags($instance['linktarget']);

?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($gallery_widget_title); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('url'); ?>">Gallery2 URL: <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo attribute_escape($gallery_url); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('block'); ?>">Image Block to use: <input class="widefat" id="<?php echo $this->get_field_id('block'); ?>" name="<?php echo $this->get_field_name('block'); ?>" type="text" value="<?php echo attribute_escape($gallery_block); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('show'); ?>">Fields to display: <br />
	Title: <input class="widefat" id="<?php echo $this->get_field_id('show'); ?> . title" name="<?php echo $this->get_field_name('show'); ?>" type="checkbox" value="<?php echo attribute_escape($gallery_show); ?> . title" />
	Date:  <input class="widefat" id="<?php echo $this->get_field_id('show'); ?> . date" name="<?php echo $this->get_field_name('show'); ?>" type="checkbox" value="<?php echo attribute_escape($gallery_show); ?> . date" />
	<p style="position:absolute; right: 10px; width:300px;"><a href="#" class="help" title="Tooltip">Hover me long-long way, baby!</a></p>
	Views:  <input class="widefat" id="<?php echo $this->get_field_id('show'); ?> . views" name="<?php echo $this->get_field_name('show'); ?>" type="checkbox" value="<?php echo attribute_escape($gallery_show); ?> . views" />
	Owner:  <input class="widefat" id="<?php echo $this->get_field_id('show'); ?> . owner" name="<?php echo $this->get_field_name('show'); ?>" type="checkbox" value="<?php echo attribute_escape($gallery_show); ?> . owner" />
	Heading:  <input class="widefat" id="<?php echo $this->get_field_id('show'); ?> . heading" name="<?php echo $this->get_field_name('show'); ?>" type="checkbox" value="<?php echo attribute_escape($gallery_show); ?> . heading" />
	Full Size:  <input class="widefat" id="<?php echo $this->get_field_id('show'); ?> . fullSize" name="<?php echo $this->get_field_name('show'); ?>" type="checkbox" value="<?php echo attribute_escape($gallery_show); ?> . fullSize" />
	Raw Image:  <input class="widefat" id="<?php echo $this->get_field_id('show'); ?> . rawImage" name="<?php echo $this->get_field_name('show'); ?>" type="checkbox" value="<?php echo attribute_escape($gallery_show); ?> . rawImage" />

   </label></p>

    <p><label for="<?php echo $this->get_field_id('itemid'); ?>">Item ID: <input class="widefat" id="<?php echo $this->get_field_id('itemid'); ?>" name="<?php echo $this->get_field_name('itemid'); ?>" type="text" value="<?php echo attribute_escape($gallery_itemid); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('maxsize'); ?>">Max Size: <input class="widefat" id="<?php echo $this->get_field_id('maxsize'); ?>" name="<?php echo $this->get_field_name('maxsize'); ?>" type="text" value="<?php echo attribute_escape($gallery_maxsize); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('exactsize'); ?>">Exact Size: <input class="widefat" id="<?php echo $this->get_field_id('exactsize'); ?>" name="<?php echo $this->get_field_name('exactsize'); ?>" type="text" value="<?php echo attribute_escape($gallery_exactsize); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('link'); ?>">Link Images To: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo attribute_escape($gallery_link); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('linktarget'); ?>">Open above Links in: <input class="widefat" id="<?php echo $this->get_field_id('linktarget'); ?>" name="<?php echo $this->get_field_name('linktarget'); ?>" type="text" value="<?php echo attribute_escape($gallery_linktarget); ?>" /></label></p>




    <?php 
  }
  
}

add_action('widgets_init', 'widget_gallery2_init');
function widget_gallery2_init() {
        register_widget('Gallery2_Block');
}

?>
