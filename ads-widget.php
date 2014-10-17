<?php
/*
Plugin Name: Ads widget
Description: add ads images
Version: 1.0
*/


class adsBanner extends WP_Widget
{

  function adsBanner()
  {
    $widget_ops = array('classname' => 'cwp_ddd_banner', 'description' => 'Ads Banner' );
    $this->WP_Widget('adsBanner', 'Ads Banner', $widget_ops);
  }


  function form($instance)
  {

    $instance = wp_parse_args( (array) $instance, array( 
	'image_uri' => '',
	'destination_uri' => '',
	'width' => '',
	'height' => '',
	'target' => '_blank',
	'align' => 'center',
	'title' => ''
	) );
	
	$image_uri = $instance['image_uri'];
	$destination_uri = $instance['destination_uri'];
	$width = $instance['width'];
	$height = $instance['height'];
	$target = $instance['target'];
	$align = $instance['align'];
	$title = $instance['title'];

  
    // removed the for loop, you can create new instances of the widget instead
    ?>
     <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget title:', 'domain'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image URL:', 'domain'); ?></label><br />
      <input type="text" class="widefat" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>" />
    </p>
    
     <p>
        <label for="<?php echo $this->get_field_id('destination_uri'); ?>"><?php _e('Destination URL:', 'domain'); ?></label>
        <input type="text" class="widefat" name="<?php echo $this->get_field_name('destination_uri'); ?>" id="<?php echo $this->get_field_id('destination_uri'); ?>" value="<?php echo $destination_uri; ?>" />
    </p> 
    
	<p>
    	<span style="margin-right:10px;"><?php _e('Size:', 'cw-magezine'); ?></span><br/>
        <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', 'domain'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" style="width: 40px; text-align: right;" />px
        <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'domain'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" style="width: 40px; text-align: right;" />px
    </p>    
    
    <p>
        <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Target:', 'domain'); ?></label>
        <select name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>" class="widefat" style="width: 100px;">
            <?php
            $options = array('_blank', '_self');
            foreach ($options as $option) {
                echo '<option value="' . $option . '" id="' . $option . '"', $target == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            }
            ?>
        </select>
    </p>
	
    <p>
        <label for="<?php echo $this->get_field_id('align'); ?>"><?php _e('Align:', 'domain'); ?></label>
        <select name="<?php echo $this->get_field_name('align'); ?>" id="<?php echo $this->get_field_id('align'); ?>" class="widefat" style="width: 100px;">
            <?php
            $options = array('center', 'left', 'right');
            foreach ($options as $option) {
                echo '<option value="' . $option . '" id="' . $option . '"', $align == $option ? ' selected="selected"' : '', '>', $option, '</option>';
            }
            ?>
        </select>
    </p>
    

<?php

  }

 

  function update($new_instance, $old_instance)
  {
	  
    $instance = $old_instance;
	
    $instance['image_uri'] = $new_instance['image_uri'];
	$instance['destination_uri'] = $new_instance['destination_uri'];
	$instance['width'] = $new_instance['width'];
	$instance['height'] = $new_instance['height'];
	$instance['target'] = $new_instance['target'];
	$instance['align'] = $new_instance['align'];
	$instance['title'] = $new_instance['title'];
	
    return $instance;

  }

 

  function widget($args, $instance)
{
  	extract($args, EXTR_SKIP);

	
	$image_url = empty($instance['image_uri']) ? ' ' : apply_filters('widget_image_url', $instance['image_uri']);
	$destination_uri = empty($instance['destination_uri']) ? ' ' : apply_filters('widget_destination_uri', $instance['destination_uri']);
	$width = empty($instance['width']) ? ' ' : apply_filters('widget_width', $instance['width']);
	$height = empty($instance['height']) ? ' ' : apply_filters('widget_height', $instance['height']);
	$target = empty($instance['target']) ? ' ' : apply_filters('widget_target', $instance['target']);
	$align = empty($instance['align']) ? ' ' : apply_filters('widget_align', $instance['align']);
	$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);


	echo '<aside class="widget widget_add_banner">';
	
    // basic output just for this example
	if( trim($title) ){
    	echo '<h1 class="widget-title"><span>'.$title.'</span></h1>';
		}
	echo '<div class="banner-wrap" style="text-align: '.$align.'">
	  			<a href="'.esc_url($instance['destination_uri']).'" title="'.esc_html($instance['title']).'" style="width:'.$width.'px; height:'.$height.'px;" class="banner-link" target="'.$target.'">
					<img src="'.esc_url($instance['image_uri']).'" alt="'.esc_html($instance['title']).'" style=" height: '.$height.'px; width: '.$width.'px;">
				</a>
			</div>';

	echo '</aside>';
	
  }


}

add_action( 'widgets_init', create_function('', 'return register_widget("adsBanner");') );

?>
