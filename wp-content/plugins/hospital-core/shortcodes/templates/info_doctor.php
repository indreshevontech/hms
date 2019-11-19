<?php 
add_shortcode('kc_pdr_info', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'             =>'',
        'practicing_level'  =>'',
		'practicing'        =>'',
		'd.o.b_level'       =>'',
		'd.o.b'             =>'',
		'address_level'     =>'',
		'address'           =>'',
		'email_level'       =>'',
		'email'             =>'',
		'phone_number_level'=>'',
		'phone_number'      =>'',
		'vacation_level'    =>'',
		'vacation'          =>''

    ), $atts);

$title           =$atts['title'];
$practicing      =$atts['practicing'];
$practicing_level=$atts['practicing_level'];
$dob             =$atts['d.o.b'];
$dob_level       =$atts['d.o.b_level'];
$address         =$atts['address'];
$address_level   =$atts['address_level'];
$email           =$atts['email'];
$email_level     =$atts['email_level'];
$phone_number    =$atts['phone_number'];
$phone_number_level=$atts['phone_number_level'];
$vacation        =$atts['vacation'];
$vacation_level  =$atts['vacation_level'];
?>


<div class="row text-left mb-5">
<?php if(!empty($title)){?>	
<h3 class="title-thin"><?php echo esc_html($title);?></h3>
<?php }?>
<dl class="dl-horizontal">
	<?php if(!empty($practicing_level)){?>
 	<dt><?php echo esc_html($practicing_level);?></dt>
    <?php }if(!empty($practicing)){?>
 	<dd><?php echo esc_html($practicing);?></dd>
 	<?php }if(!empty($dob_level)){?>
 	<dt><?php echo esc_html($dob_level);?></dt>
    <?php  }if(!empty($dob)){?>
 	<dd><?php echo esc_html($dob)?></dd>
 	<?php }if(!empty($address_level)){?>
 	<dt><?php echo esc_html($address_level);?></dt>
    <?php }if(!empty($address)){?>
 	<dd><?php echo esc_html($address);?></dd>
 	<?php }if(!empty($email_level)){?>
 	<dt><?php echo esc_html($email_level);?></dt>
    <?php }if(!empty($email)){?>
 	<dd><?php echo esc_html($email);?></dd>
 	<?php }if(!empty($phone_number_level)){?>
 	<dt><?php echo esc_html($phone_number_level);?></dt>
    <?php  }if(!empty($phone_number)){?>
 	<dd><?php echo esc_html($phone_number);?></dd>
 	<?php }if(!empty($vacation_level)){?>
 	<dt><?php echo esc_html($vacation_level);?></dt>
    <?php }if(!empty($vacation)){?>
 	<dd><?php echo esc_html($vacation);?></dd>
    <?php }?>
</dl>
</div>




<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'kc_pdr_info', 99 );
 
function kc_pdr_info() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_pdr_info' => array(
	                'name' => __('Personal Info', 'hospital-core'),
					'description' => __('', 'hospital-core'),
					'icon' => 'kc-icon-progress',
					'category' => 'Hospital',
					'css_box' => true,
					'params' => array(
                            array(
								'type' => 'text',
								'label' => 'Personal Information Title',
								'name' => 'title',
								'admin_label' => true,
							),
                            array(
								'type' => 'text',
								'label' => 'Practicing Level',
								'name' => 'practicing_level',
								'admin_label' => true,
							),    

							array(
								'type' => 'text',
								'label' => 'Practicing Years',
								'name' => 'practicing',
								'admin_label' => true,
							),
							
                           array(
								'type' => 'text',
								'label' => 'Birth Day level',
								'name' => 'dob_level',
								'admin_label' => true,
							), 
                           array(
								'type' => 'text',
								'label' => 'Date Of Birth',
								'name' => 'd.o.b',
								'admin_label' => true,
							),
                           array(
								'type' => 'text',
								'label' => 'Address Level',
								'name' => 'address_level',
								'admin_label' => true,
							),
                           array(
								'type' => 'textarea',
								'label' => 'Address',
								'name' => 'address',
								'admin_label' => true,
							),
 							array(
								'type' => 'text',
								'label' => 'E-mail Level',
								'name' => 'email_level',
								'admin_label' => true,
							),
							 array(
								'type' => 'text',
								'label' => 'E-mail',
								'name' => 'email',
								'admin_label' => true,
							),
							array(
								'type' => 'text',
								'label' => 'Phone Number Level',
								'name' => 'phone_number_level',
								'admin_label' => true,
							),
							array(
								'type' => 'text',
								'label' => 'Phone',
								'name' => 'phone_number',
								'admin_label' => true,
							),
							array(
								'type' => 'text',
								'label' => 'Vacation Level',
								'name' => 'vacation_level',
								'admin_label' => true,
							),

							array(
								'type' => 'text',
								'label' => 'Vacation',
								'name' => 'vacation',
								'admin_label' => true,
							),
							
                        

                        
					
					)
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}                         



