<?php
class about_widgets extends WP_Widget { 
	function __construct() {
	   $widget_ops = array(
	   		'classname'   => 'widget_about',
	   		'description' => __('Display your information','hospital')
	   	);
	   	parent::__construct(
	   		'thb_about_widget',
	   		__( 'About' ,'hospital'),
	   		$widget_ops
	   	);		
	   	$this->defaults= array( 
	   		'title' => 'About us', 
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

		$fb = $instance['fb'];
		$twitter = $instance['twitter'];
		
		
		$image_alt = $instance['image_alt'];

		$images = $instance['images'];
		
		$image_alts = $instance['image_alts'];
		// Output
		echo $before_widget;
		
		
		?>



                       <article class="about-content">
                            <a href="<?php echo esc_url($twitter);?>" class="m-content-teaser-stacked__image">
                                <img alt="" src="<?php echo esc_url($image); ?>" class="img-fluid">
                            </a>
                            <div class="a-text-info">
                                <h3><?php echo ($title ? $before_title . $title . $after_title : '');?></h3>
                                <p><?php echo wpautop($description);?></p>
                                <a href="<?php echo esc_url($twitter);?>" class="read-link"><?php echo $fb;?><i class="ti-arrow-right"></i></a>
                            </div>
                        </article>


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
		$instance['fb'] = strip_tags( $new_instance['fb'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
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
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
	    <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:','hospital'); ?></label>
	    <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo $instance['image']; ?>" />
	    <input class="thb-upload-image button" type="button" value="Upload Image" onclick="ThbImage.uploader( '<?php echo $this->id; ?>', '<?php echo $this->get_field_id( 'image' ); ?>', '<?php echo $this->get_field_id( 'image_alt' ); ?>' ); return false;" />
	    <input name="<?php echo $this->get_field_name( 'image_alt' ); ?>" id="<?php echo $this->get_field_id( 'image_alt' ); ?>"  type="hidden" value="<?php echo $instance['image_alt']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Your Description:','hospital');?></label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" class="widefat" rows="5"><?php echo esc_textarea($instance['description']); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'fb' ); ?>"><?php _e('SubTitle:','hospital');?></label>
			<input id="<?php echo $this->get_field_id( 'fb' ); ?>" name="<?php echo $this->get_field_name( 'fb' ); ?>" value="<?php echo $instance['fb']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Subtitle Link:','hospital');?></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" style="width:100%;" />
		</p>
		
    <?php
	}
}
