<?php 
add_shortcode('kc_main_slider', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'optionss'        => '',
        'selected_posts'        => '',
        'box'        => '',
    ), $atts);


$testimonialsa=$atts['optionss'];
$box=$atts['box'];


?>
      <div class="header-slider header-slider-preloader" id="header-slider">
                <div class="animation-slide owl-carousel owl-theme" id="animation-slide">
                    <!-- Slide 1-->
                    <?php 
                    $i=1;
                    foreach ($testimonialsa as $key => $value) {

                    $postImage = wp_get_attachment_image_src($value->image,true);
                    if($i==4){
                    break; 
                   
                    }
                    
                   if($i==1){?>
               <div class="item slide-one" style="background-image: url(<?php echo $postImage[0];?>)">
                        <div class="slide-table">
                            <div class="slide-tablecell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="slide-text text-center">
                                                <h2><?php echo  $value->slider_title;?></h2>
                                                <p><?php echo $value->slider_details;?></p>
                                                <div class="service-icon d-flex justify-content-center">
                                                    <?php foreach ($box as $key => $values){?>
                                                    <div class="icon-box" data-toggle="tooltip" data-placement="top" title="<?php echo $values->department_title;?>">
                                                        <i class="<?php echo $values->department_icon?>"></i>
                                                    </div>
                                                   <?php }?>
                                                   <?php if(!empty($value->button_level)){?>
                                                    <a href="<?php echo $value->button_link;?>" class="icon-box view-all">
                                                        <span><i class="ti-plus"></i><?php echo $value->button_level;?></span>
                                                    </a>
                                                <?php  }?>
                                                </div>
                                                <!-- Service icon -->
                                      
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php }elseif($i==2){?>
                    <!-- Slide 2-->
                    <div class="item slide-two" style="background-image: url(<?php echo $postImage[0];?>)">
                        <div class="slide-table">
                            <div class="slide-tablecell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="slide-text">
                                                <h2><?php echo  $value->slider_title;?></h2>
                                                <p><?php echo $value->slider_details;?></p>
                                                <div class="slide-buttons">
                                                    <?php if(!empty($value->button_level)){?>
                                                    <a href="<?php echo $value->button_link;?>" class="btn btn-primary slide-btn"><?php echo $value->button_level;?></a>
                                                    <?php  }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }elseif($i==3){?>
                    <!-- Slide 3-->
       
                    <div class="item slide-three" style="background-image: url(<?php echo $postImage[0];?>)">
                        <div class="slide-table">
                            <div class="slide-tablecell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="slide-text text-right">
                                                <h2><?php echo  $value->slider_title;?></h2>
                                                <p><?php echo $value->slider_details;?></p>
                                                <div class="slide-buttons">
                                                    <?php if(!empty($value->button_level)){?>
                                                    <a href="<?php echo $value->button_link;?>" class="btn btn-primary slide-btn"><?php echo $value->button_level;?></a>
                                                    
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php }?>
                    <?php $i++; }?>

                </div>
                <!-- /.End of slider -->
                <!-- Preloader -->
                <div class="slider_preloader">
                    <div class="slider_preloader_status">&nbsp;</div>
                </div>
            </div>
            <!-- /.End of slider -->

            
<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'main_slider', 99 );
 
function main_slider() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_main_slider' => array(
	                'name' => 'Main Slider',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
                    'css_box' => true,
	                'params' => array(

	                'Slider' => array( 
                            array(
                            'type'          => 'group',
                            'label'         => __('Options', 'hospital-core'),
                            'name'          => 'optionss',
                            
                            'params' => array(
                                array(
                                    'type' => 'text',
                                    'label' => 'Title',
                                    'name' => 'slider_title',
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => 'Details',
                                    'name' => 'slider_details',
                                ),
								// array(
								// 	'name' => 'select_text_style',
								// 	'label' => 'Select Text Styole',
								 
								// 	'type' => 'select',  
								// 	'options' => array(
								// 		'left' => 'Left Side Text',
								// 		'right' => 'Right Side Text',
								// 		'center' => 'Center Side Text',
								// 	),
								 
								// 	'value' => 'DEFAULT-CONTENT', 
								// 	// 'description' => 'Field Description',
								// ),
                                array(
                                    'type' => 'text',
                                    'label' => 'Button Level',
                                    'name' => 'button_level',
                                    'value' => '', 
                                 
                                ),
                                array(
                                    'name' => 'button_link',
                                    'label' => 'Button Link',
                                    'type' => 'text',  
                                   
                                ),
                                array(
									'name' => 'image',
									'label' => 'Profil Image',
									'type' => 'attach_image',  // USAGE ATTACH_IMAGE TYPE
								),

                            )  

                         

                        ),
                        


                     ),
                     'Department Icon' => array(
                        

                        array(
                            'type'          => 'group',
                            'label'         => __('Department Icon', 'hospital-core'),
                            'name'          => 'box',
                            // "relation" => Array('parent' => "selected_posts", 'show_when' => array('please_yes')), 
                        'params' => array(
                         array(
                            'name' => 'department_title',
                            'label' => 'Title',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'Department Title', // remove this if you do not need a default content
                           
                         ), 
                        
                        array(
                            'name' => 'department_icon',
                            'label' => 'Department Icon',
                            'type' => 'icon_picker',
                           
                            'value' => 'icon', // remove this if you do not need a default content
                        ),
                       )
                      ), 



                        ),     
                          
                    
	                )
	            ),  
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>