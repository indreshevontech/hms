<?php
// About us
class footer_contact extends WP_Widget {
    public function __construct()  { // 'About us' Widget Defined
        parent::__construct('contact_us', esc_html__('Contact Us(Footer)','hospital'), array(
            'description'   => esc_html__('Contact us widget by hospital','hospital'),
            'classname'     => 'address-inner'
        ));
    }

    // Front End
    public function widget($args, $instance) {
        $about_txt  = isset($instance['about_txt']) ? wp_kses_post($instance['about_txt']) : '';
        $address    = isset($instance['address']) ? $instance['address'] : '';
        $contact_no = isset($instance['contact_no']) ? $instance['contact_no'] : '';
        $contact_Fex = isset($instance['contact_fex']) ? $instance['contact_fex'] : '';


        $go_direction_level = isset($instance['go_direction_level']) ? $instance['go_direction_level'] : '';
        $go_direction_link = isset($instance['go_direction_link']) ? $instance['go_direction_link'] : '';
        $title = isset($instance['title']) ? $instance['title'] : '';


        $email      = isset($instance['email']) ? $instance['email'] : '';
        $image_alt = isset($instance['image_alt']) ? $instance['image_alt'] : '';
        $images = isset($instance['images']) ? $instance['images'] : '';

        echo $args['before_widget'];
        
        ?>

     
<?php echo  $args['before_title'] . $title . $args['after_title'];?>
<div class="addressLink"><?php echo esc_html($address); ?>
    <ul class="list-unstyled">
        <li><i class="ti-mobile"></i> Tel: <a href="tel:808-526-0030"><?php echo esc_html($contact_no); ?></a></li>
        <!-- <li><i class="icon-mobile"></i> text: <a href="sms:808-526-0030">(123) 456-7890</a></li> -->
        <li><i class="ti-email"></i> Email: <a class="linkUnderlined" href="<?php echo esc_url($email);?>"><?php echo sanitize_email($email); ?></a></li>
        <li><i class="ti-printer"></i> Fax: <?php echo esc_html($contact_Fex);?></li>
    </ul>
<div class="btnBlock "><a class="btn btn-link" href="<?php echo esc_url($go_direction_link);?>" target="_blank" rel="noopener"><?php echo esc_html(
    $go_direction_level);?><i class="ti-arrow-right"></i></a></div>
</div>

        <?php
        echo $args['after_widget'];
    }


    function thb_assets() {
        wp_enqueue_media();
        
        wp_localize_script( 'thb-admin-meta', 'ThbImageWidget', array(
            'frame_title' => __( 'Select an Image','hospital'),
            'button_title' => __( 'Insert Into Widget','hospital'),
        ) );
    }
    // Backend
    public function form($instance) {
        $about_txt  = isset($instance['about_txt']) ? wp_kses_post($instance['about_txt']) : '';
        $address    = isset($instance['address']) ? $instance['address'] : '';
        $contact_no = isset($instance['contact_no']) ? $instance['contact_no'] : '';
        $contact_Fex = isset($instance['contact_fex']) ? $instance['contact_fex'] : '';
        $email      = isset($instance['email']) ? $instance['email'] : '';
        $title      = isset($instance['title']) ? $instance['title'] : '';

        $go_direction_level      = isset($instance['go_direction_level']) ? $instance['go_direction_level'] : '';
        $go_direction_link      = isset($instance['go_direction_link']) ? $instance['go_direction_link'] : '';

        $image_alt =isset($instance['image_alt']) ? $instance['image_alt']:'';
        $images = isset($instance['images']) ? $instance['images']:'';
    ?>
          <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','hospital') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <table style="width:100%">
        
            <!-- Address -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address','hospital') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name('address')); ?>" id="<?php echo esc_attr($this->get_field_id('address')); ?>" class="widefat" value="<?php echo esc_attr($address); ?>" placeholder="<?php esc_html_e('Enter the address','hospital'); ?>"> </td> </tr>

            <!-- Mobile number -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id('contact_no')); ?>"><?php esc_html_e('Contact number','hospital') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name('contact_no')); ?>" id="<?php echo esc_attr($this->get_field_id('contact_no')); ?>" class="widefat" value="<?php echo esc_attr($contact_no); ?>" placeholder="<?php esc_html_e('Enter the contact number.', 'hospital'); ?>"> </td> </tr> 

             <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id('contact_fex')); ?>"><?php esc_html_e('Fex number','hospital') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name('contact_fex')); ?>" id="<?php echo esc_attr($this->get_field_id('contact_fex')); ?>" class="widefat" value="<?php echo esc_attr($contact_Fex); ?>" placeholder="<?php esc_html_e('Enter the contact number.', 'hospital'); ?>"> </td> </tr>

            <!-- Email -->
            <tr> <th style="text-align: left"> <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email','hospital') ?></label> </th> </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name('email')); ?>" id="<?php echo esc_attr($this->get_field_id('email')); ?>" class="widefat" value="<?php echo esc_attr($email); ?>" placeholder="<?php esc_html_e('Enter the email address.','hospital'); ?>"> </td> </tr> 

            <tr> 
                <th style="text-align: left"> 
                    <label for="<?php echo esc_attr($this->get_field_id('go_direction_level')); ?>"><?php esc_html_e('Direction Level','hospital') ?></label> 
                </th> 
            </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name('go_direction_level')); ?>" id="<?php echo esc_attr($this->get_field_id('go_direction_level')); ?>" class="widefat" value="<?php echo esc_attr($go_direction_level); ?>" placeholder="<?php esc_html_e('Enter the email address.','hospital'); ?>"> </td> </tr>

            <tr> 
                <th style="text-align: left"> 
                    <label for="<?php echo esc_attr($this->get_field_id('go_direction_link')); ?>"><?php esc_html_e('Direction Link','hospital') ?></label> 
                </th> 
            </tr>
            <tr> <td> <input type="text" name="<?php echo esc_attr($this->get_field_name('go_direction_link')); ?>" id="<?php echo esc_attr($this->get_field_id('go_direction_link')); ?>" class="widefat" value="<?php echo esc_attr($go_direction_link); ?>" placeholder="<?php esc_html_e('Enter the link.','hospital'); ?>"> </td> </tr>

        </table>
    <?php
    }

    // Update Data
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title']      = $new_instance['title'];
        $instance['about_txt']  = $new_instance['about_txt'];
        $instance['address']   = $new_instance['address'];
        $instance['contact_no'] = $new_instance['contact_no'];
        $instance['contact_fex'] = $new_instance['contact_fex'];
        $instance['email']      = $new_instance['email'];
        $instance['go_direction_level']      = $new_instance['go_direction_level'];
        $instance['go_direction_link']      = $new_instance['go_direction_link'];
        $instance['image_alt']      = $new_instance['image_alt'];
        $instance['images']      = $new_instance['images'];
      
        return $instance;
    }

}