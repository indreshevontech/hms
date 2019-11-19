<?php
class Osru_widgets extends WP_Widget { 
	function __construct() {
	   $widget_ops = array(
	   		'classname'   => 'widget_title',
	   		'description' => __('Display your information','hospital')
	   	);
	   	parent::__construct(
	   		'thb_title_widget',
	   		__( 'Service Widget title','hospital'),
	   		$widget_ops
	   	);		
	   	$this->defaults= array( 
	   		'title' => 'call us', 
	   		'image' => '', 
	   		'image_alt' => '',
	   		'description' => '',
	   		'images' => '', 
	   		'image_alts' => '',
	   		'name'=>'', 
	   		'fb'=>'',
	   		'twitter'=>'',
	   		'instagram'=>'',
	   	 );
	   	add_action('admin_enqueue_scripts', array($this, 'thb_assets'));
	}
	
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$description = $instance['description'];
		$image = $instance['image'];
		$name = $instance['name'];

		$subtitle = $instance['subtitle'];
		$subtitle_link = $instance['subtitle_link'];
		$instagram = $instance['instagram'];
		
		$image_alt = $instance['image_alt'];

		$images = $instance['images'];
		
		$image_alts = $instance['image_alts'];
		// Output
		echo $before_widget;
		?>
                        <div class="contactCard">
                            <?php echo ($title ? $before_title . $title . $after_title : '');?>
                            <div class="contactCard-icon"><i class="ti-mobile"></i><?php echo $name; ?>
                            </div>
                            <a href="<?php echo esc_url($subtitle_link);?>" class="link-underlined"><?php echo $subtitle;?></a>
                        </div>
                     
	<?php 
		
		echo $after_widget;
	}
	function thb_assets() {
	    wp_enqueue_media();
	    
	    wp_localize_script( 'thb-admin-meta', 'ThbImageWidget', array(
	    	'frame_title' => __( 'Select an Image','hospital'),
	    	'button_title' => __( 'Insert Into Widget','hospital'),
	    ) );
	}
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['subtitle_link'] = strip_tags( $new_instance['subtitle_link'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );

		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['image_alt'] = strip_tags( $new_instance['image_alt'] );
		$instance['description'] = $new_instance['description'];
       	$instance['images'] = strip_tags( $new_instance['images'] );
		echo $instance['image_alts'] = strip_tags( $new_instance['image_alts'] );
		return $instance;
	}
	// Settings form
	function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:','hospital');?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Title Value:','hospital');?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name'); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('SubTitle:','hospital')?></label>
			<input id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle'); ?>" value="<?php echo $instance['subtitle']; ?>" style="width:100%;" />
		</p>

         <p>
			<label for="<?php echo $this->get_field_id( 'subtitle_link' ); ?>"><?php _e('SubTitle Link:','hospital')?></label>
			<input id="<?php echo $this->get_field_id( 'subtitle_link' ); ?>" name="<?php echo $this->get_field_name( 'subtitle_link'); ?>" value="<?php echo $instance['subtitle_link']; ?>" style="width:100%;" />
		</p>

	
    <?php
	}
}
