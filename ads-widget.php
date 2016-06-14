<?php
/*
Description: Simple Image Banner
Author: Duong.NS
Author URI: http://duongns.com
Version: 0.1
*/

function register_banner_widget() {
    register_widget( 'Banner_Widget' );
}
add_action( 'widgets_init', 'register_banner_widget' );
class Banner_Widget extends WP_Widget {
    function __construct() {
        $this->defaults = array(
            'title'             => '',
            'image_uri'         => '',
            'destination_uri'   => '',
            'target'            => '_blank',
            'align'             => 'center',
        );
        parent::__construct( 'user-profile', 'Ads Banner' );
    }

    function widget( $args, $instance ) {
        extract($args, EXTR_SKIP);
    
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $image_url = empty($instance['image_uri']) ? ' ' : apply_filters('widget_image_url', $instance['image_uri']);
        $destination_uri = empty($instance['destination_uri']) ? ' ' : apply_filters('widget_destination_uri', $instance['destination_uri']);
        $target = empty($instance['target']) ? ' ' : apply_filters('widget_target', $instance['target']);
        $align = empty($instance['align']) ? ' ' : apply_filters('widget_align', $instance['align']);
        echo '<aside class="banner widget widget_add_banner">';
        
        echo '<div class="" style="text-align: '.$align.'">
            <a href="'.esc_url($instance['destination_uri']).'" title="'.esc_html($instance['title']).'" class="banner-link" target="'.$target.'">
                <img src="'.esc_url($instance['image_uri']).'" alt="'.esc_html($instance['title']).'">
            </a>
        </div>';
        echo '</aside>';
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, $this->defaults );

        $title = $instance['title'];
        $image_uri = $instance['image_uri'];
        $destination_uri = $instance['destination_uri'];
        $target = $instance['target'];
        $align = $instance['align'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'domain'); ?></label>
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
    <?php }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
    
        $instance['title'] = $new_instance['title'];
        $instance['image_uri'] = $new_instance['image_uri'];
        $instance['destination_uri'] = $new_instance['destination_uri'];
        $instance['target'] = $new_instance['target'];
        $instance['align'] = $new_instance['align'];
        
        return $instance;
    }
}
