<?php 
add_shortcode('kc_custom_info_box', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'title_dis'        => '',
        'selected_posts'        => '',
        'field_id'        => '',
        'content'        => '',
        'sub_title'        => '',
        'title_dis2'        => '',
        'image'        => '',
        'imaged'        => '',

        'description'  =>'',
        'title_name'  =>''
    ), $atts);
?>
 
 <?php if($atts['selected_posts']=='style_01'){?>
           <div class="media contact-service">
                <i class="<?php echo $atts['field_id'];?> mr-3"></i>
                <div class="media-body">
                    <h4 class="mt-0"><?php echo $atts['title'];?></h4>
                    <div><?php echo $atts['title_dis'];?></div>
                </div>
            </div>          
    <?php } elseif($atts['selected_posts']=='style_02'){?>

           <!-- <div class="text-block">
	            <h6 class="heading-sm"><?php echo $atts['title'];?></h6>
	            <h3><?php echo $atts['sub_title'];?></h3>
	            <?php echo $atts['content'];?>
	            <hr>
	            <blockquote class="blockquote quote-text">
	                
	                <?php echo $atts['title_dis2'];?>
	            </blockquote> 
            </div> -->
 <?php  
 $img = wp_get_attachment_image_src($atts['imaged'],'travel_850x395');  
?>
            <div class="about-wrapper">
            <div class="container">
                <div class="row align-items-center justify-content-between about-text">
                    <div class="col-md-12 col-lg-7">
                        <div class="feature-img">
                            <img src="<?php echo $img[0];?>" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div class="text-block">
                            <h6 class="heading-sm"><?php echo $atts['title'];?></h6>
                            <h3><?php echo $atts['sub_title'];?></h3>
                            <?php echo $atts['content'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <?php }elseif($atts['selected_posts']=='style_03'){?>
<div class="partners-content">
            <div class="container">
                <div class="row align-items-center">
                  <?php
                  $value= $atts['image'];
                  $image_ids = explode(',',$value);
              
                 foreach ($image_ids as $key => $values) {
                $img = wp_get_attachment_image_src($values,'travel_850x395');  
                  ?>

                    <div class="col-6 col-sm-4 col-md-2">
                        <div class="partner-logo">
                            <a href="#"><img src="<?php  echo $img[0];?>" alt="" class="img-fluid"></a>
                        </div>
                    </div>
                <?php }?>
               
                </div>
            </div>
        </div>  
    <?php }elseif($atts['selected_posts']=='style_04'){?>
     <div class="testimonial2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-10 offset-lg-1">
                        <div class="testimonial2-text">
                            <span class="quotes-marks mark-left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="70" viewBox="0 0 205 141">
                                <g>
                                <path d="M69.8 60.7C82.9 69.1 89.4 80.4 89.4 94.7 89.4 108.9 85.2 120.1 76.8 128.3 68.4 136.4 57.9 140.5 45.3 140.5 32.7 140.5 22.1 136.5 13.5 128.6 4.8 120.7 0.5 110.3 0.5 97.5 0.5 84.6 4.7 72.1 13.1 60L54.4 0.5 97.1 0.5 69.8 60.7ZM176.9 60.7C190 69.1 196.5 80.4 196.5 94.7 196.5 108.9 192.3 120.1 183.9 128.3 175.5 136.4 165 140.5 152.4 140.5 139.8 140.5 129.2 136.5 120.6 128.6 111.9 120.7 107.6 110.3 107.6 97.5 107.6 84.6 111.8 72.1 120.2 60L161.5 0.5 204.2 0.5 176.9 60.7Z"></path>
                                </g>
                                </svg>          
                            </span>
                            <span class="quotes-marks mark-right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="70" viewBox="0 0 205 141">
                                <g>
                                <path d="M69.8 60.7C82.9 69.1 89.4 80.4 89.4 94.7 89.4 108.9 85.2 120.1 76.8 128.3 68.4 136.4 57.9 140.5 45.3 140.5 32.7 140.5 22.1 136.5 13.5 128.6 4.8 120.7 0.5 110.3 0.5 97.5 0.5 84.6 4.7 72.1 13.1 60L54.4 0.5 97.1 0.5 69.8 60.7ZM176.9 60.7C190 69.1 196.5 80.4 196.5 94.7 196.5 108.9 192.3 120.1 183.9 128.3 175.5 136.4 165 140.5 152.4 140.5 139.8 140.5 129.2 136.5 120.6 128.6 111.9 120.7 107.6 110.3 107.6 97.5 107.6 84.6 111.8 72.1 120.2 60L161.5 0.5 204.2 0.5 176.9 60.7Z"></path>
                                </g>
                                </svg>      
                            </span>
                            <h2 class="testimonial-quote mb-5">
                              <?php echo $atts['description'];?>
                            </h2>
                            <div class="testimonial2-author d-flex justify-content-center align-items-center">
                                <div class="testimonial2-author-name">
                                   <?php echo $atts['title_name'];?> 
                                </div>
                                <!-- <div class="testimonial2-author-link">
                                    <a href="#">https://themeforest.net/user/naeemkhan</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>                
<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'kc_custom_info_box', 99 );
 
function kc_custom_info_box() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_custom_info_box' => array(
	                'name' => 'Info Box',
	                'description' => __('title with icon', 'hospital-core'),
	                'icon' => 'fa-boxes',
	                'category' => 'Hospital',
	                'is_container' => true,
	                'params' => array(
	                    array(
                            'name' => 'title',
                            'label' => 'Title',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'Contact Info', // remove this if you do not need a default content
                             "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_01','style_02')),
                        ), 
                        array(
                            'name' => 'title_dis',
                            'label' => 'Description',
                            'type' => 'textarea',
                             "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_01')
                                  ),  // USAGE TEXT TYPE
                            'value' => 'Description', // remove this if you do not need a default content
                        ) ,
                        

						array(
							'name' => 'field_id',
							'label' => 'Field Label',

							'type' => 'icon_picker',  // USAGE ICON_PICKER TYPE
                             "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_01')),
							'description' => 'Field Description',
						),


                          array(
                            'name' => 'sub_title',
                            'label' => 'Sub Title',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'We make a Difference in your lives', // remove this if you do not need a default content
                             "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_02')),
                        ),

                        array(
                                'name' => 'imaged',
                                'label' => 'Upload Images',
                                'type' => 'attach_image',
                                'admin_label' => true,
                                "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_02')
                                  ),  // USAGE TEXT TYPE
                        ),
						 array(
                            'name' => 'content',
                            'label' => 'Description',
                            'type' => 'textarea_html',
                             "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_02')
                                  ),  // USAGE TEXT TYPE
                            'value' => 'Description', // remove this if you do not need a default content
                        ) ,

                            array(
                                'name' => 'image',
                                'label' => 'Upload Images',
                                'type' => 'attach_images',
                                'admin_label' => true,
                                "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_03')
                                  ),  // USAGE TEXT TYPE
                            ),   
                          

                        // style_04

                        array(
                            'name' => 'title_name',
                            'label' => 'Name',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'name', // remove this if you do not need a default content
                            "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_04')),
                        ), 
                        array(
                            'name' => 'description',
                            'label' => 'Comments',
                            'type' => 'textarea',
                            "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_04')),
                            'value' => 'Write comment', // remove this if you do not need a default content
                        ),


                         array(
                                "type" => "dropdown",
                                "label" => esc_html__( "Style", "stylemag" ),
                                "name" => "selected_posts",
                                "options" => array(
                                    "style_01"  => "Style 01(Icon Left)",
                                    "style_02" => "Style 02(Image with Description)",
                                    "style_03" => "Style 03(Image)",
                                    "style_04" => "Style 04(Description and Title)",
                                ),
                                "value" => "style_01"
                            ),
                          
                    
	                )
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>


