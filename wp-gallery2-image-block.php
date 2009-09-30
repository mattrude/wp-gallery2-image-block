<?php
/*
Plugin Name: Gallery2 Image Block
Plugin URI: http://mattrude.com/projects/wp-gallery2-image-block/
Description: Display a Gallery2 Image Block on your Wordpress site, this is requires a connection to a Gallery2 install.
Version: 0.6
Author: Matt Rude
Author URI: http://mattrude.com/
*/

class Gallery2_Block extends WP_Widget {
  function Gallery2_Block() {
    $currentLocale = get_locale();
    if(!empty($currentLocale)) {
      $moFile = dirname(__FILE__) . "/languages/wp-gallery2-image-block_" .  $currentLocale . ".mo";
      if(@file_exists($moFile) && is_readable($moFile)) load_textdomain('wp-gallery2-image-block', $moFile);
    }
    $gallery_name = __('Gallery2 Image Block', 'wp-gallery2-image-block');
    $gallery_description = __('Gallery2 Image Block for Wordpress', 'wp-gallery2-image-block');
    $widget_ops = array('classname' => 'Gallery2_Block', 'description' => $gallery_description );
    $this->WP_Widget('Gallery2_Block', $gallery_name, $widget_ops);
  }  

  function widget($args, $instance) {
    extract($args);
    $title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
    $gallery_url = empty($instance['url']) ? '&nbsp;' : apply_filters('url', $instance['url']);
    $gallery_block = empty($instance['block']) ? '&nbsp;' : apply_filters('block', $instance['block']);
    $gallery_show = empty($instance['show']) ? '&nbsp;' : apply_filters('show', $instance['show']);
    $gallery_itemid = empty($instance['itemid']) ? '&nbsp;' : apply_filters('itemid', $instance['itemid']);
    $gallery_maxsize = empty($instance['maxsize']) ? '&nbsp;' : apply_filters('maxsize', $instance['maxsize']);
    $gallery_exactsize = empty($instance['exactsize']) ? '&nbsp;' : apply_filters('exactsize', $instance['exactsize']);
    $gallery_link = empty($instance['link']) ? '&nbsp;' : apply_filters('link', $instance['link']);
    $gallery_linktarget = empty($instance['linktarget']) ? '&nbsp;' : apply_filters('linktarget', $instance['linktarget']);

    //Grab the image and meta data from the Gallery 2 install
    $request = new WP_Http;
    $result = $request->request( $gallery_url . '/main.php?g2_view=imageblock.External&g2_blocks=' . $gallery_block . '&g2_show=' . $gallery_show . '&g2_itemId=' . $gallery_itemid . '&g2_maxSize=' . $gallery_maxsize . '&g2_exactSize=' . $gallery_exactsize . '&g2_link=' . $gallery_link . '&g2_linkTarget=' . $gallery_linktarget );
    $file_contents = $result['body'];

    // Output the wigget to the browser
    echo $before_widget.$before_title.$title.$after_title;
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
    $title = strip_tags($instance['title']);
    $gallery_url = strip_tags($instance['url']);
    $gallery_block = strip_tags($instance['block']);
    $gallery_show = strip_tags($instance['show']);
    $gallery_itemid = strip_tags($instance['itemid']);
    $gallery_maxsize = strip_tags($instance['maxsize']);
    $gallery_exactsize = strip_tags($instance['exactsize']);
    $gallery_link = strip_tags($instance['link']);
    $gallery_linktarget = strip_tags($instance['linktarget']);?>
    
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Gallery2 URL', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo attribute_escape($gallery_url); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('block'); ?>"><?php _e('Image Block to use', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('block'); ?>" name="<?php echo $this->get_field_name('block'); ?>" type="text" value="<?php echo attribute_escape($gallery_block); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Fields to display', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>" type="text" value="<?php echo attribute_escape($gallery_show); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('itemid'); ?>"><?php _e('Item ID', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('itemid'); ?>" name="<?php echo $this->get_field_name('itemid'); ?>" type="text" value="<?php echo attribute_escape($gallery_itemid); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('maxsize'); ?>"><?php _e('Max Size', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('maxsize'); ?>" name="<?php echo $this->get_field_name('maxsize'); ?>" type="text" value="<?php echo attribute_escape($gallery_maxsize); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('exactsize'); ?>"><?php _e('Exact Size', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('exactsize'); ?>" name="<?php echo $this->get_field_name('exactsize'); ?>" type="text" value="<?php echo attribute_escape($gallery_exactsize); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link Images To', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo attribute_escape($gallery_link); ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('linktarget'); ?>"><?php _e('Open above Links in', 'wp-gallery2-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('linktarget'); ?>" name="<?php echo $this->get_field_name('linktarget'); ?>" type="text" value="<?php echo attribute_escape($gallery_linktarget); ?>" /></label></p>

    <?php 
  }
  
}

add_action('widgets_init', 'widget_gallery2_init');
function widget_gallery2_init() {
        register_widget('Gallery2_Block');
}

?>
