<?php 
add_shortcode('kc_testimonial_slider', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'testimonial_list'        => '',
        'description'        => '',
        'selected_posts'        => '',
        'optionss'        => '',
        'working_year'        => '',
        'designation2'        => '',
        'hospital_dep'        => '',
        'doc_icon'        => '',
        'hos_description'        => '',


    ), $atts);

$testimonials=$atts['testimonial_list'];
$testimonialsa=$atts['optionss'];

?>
<?php if($atts['selected_posts']=='style_01'){?>
<div class="testimonialContent text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               	 <h2 class="contentTitle"><?php echo esc_html($atts['title']);?></h2>
                <div class="owl-testimonial owl-carousel owl-theme">
                    <?php
                     if(!empty($testimonials)){
                        $i=0;
                         $b=array_slice($testimonials,1);

                        foreach ($b as $item) {
                          @$postImage = wp_get_attachment_image_src($item->tes_image);
                          $i++;

                         ?> 
                    <div class="testimonial">
                    <?php 
                    if($i==1){
                    ?>
	                    <style type="text/css">
	                        .owl-testimonial.owl-theme .owl-dots .owl-dot span {
	                        width: 80px;
	                        height: 80px;
	                        border-radius: 0;
	                        opacity: .5;
	                        position: relative;
	                        transition: all 0.3s ease-in-out 0s;
	                        background: url("<?php echo @$postImage[0];?>") no-repeat!important;
	                        background-size: cover !important;
	                    }
	                    </style>
	                    <?php } else{
                      
	                     ?>
	                   <style type="text/css">
	                    .owl-testimonial.owl-theme .owl-dots .owl-dot:nth-child(<?php echo $i;?>) span {
	                        background: url("<?php echo @$postImage[0]?>") no-repeat!important;
	                        background-size: cover !important;
	                    }
	                    </style>
                        <?php } 
                        ?>
                    
                        <p class="description">
                           <?php echo @$item->description; ?>
                        
                        </p>
                        <div class="mt-4">
                            <h3 class="title"><?php echo @$item->profile_name;?></h3>
                            <span class="post"><?php echo @$item->profile_deg;?></span>
                        </div>
                    </div>
                    <?php  } } ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.testimonial -->
<?php  }elseif($atts['selected_posts']=='style_02'){?>


            <div class="row">
                <div class="col-md-12">
                	
                    <div class="main-timeline">
                    	<?php  

                    	if(!empty($testimonialsa)){?>
                    	<?php 
                         $i=0; 
                    	 foreach ($testimonialsa as $items) {
                    	 $i++;
                    	
                    	 if($i>1){
                    	?>
               
                        <a href="#" class="timeline">
                        	<?php if(!empty($items->doc_icon)){?>
                            <div class="timeline-icon"><i class="fa <?php echo (isset($items->doc_icon)?$items->doc_icon:""); ?>"></i></div>
                        <?php } ?>

                            <div class="timeline-content">
                                <div class="date"><?php echo (isset($items->working_year)?$items->working_year:"");?></div>
                                <div class="post"><?php echo (isset($items->hospital_dep))?$items->hospital_dep:"";?></div>
                                <h3 class="title"><?php echo (isset($items->designation2)?$items->designation2:"");?></h3>
                                <p class="description">
                               <?php echo (isset($items->hos_description)?$items->hos_description:"");?> 
                                    
                                </p>
                            </div>
                        </a>
                       <?php } } }?>
                    </div>
                
                </div>
            </div>
<?php } ?>


<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'kc_testimonial_slider', 99 );
 
function kc_testimonial_slider() {
 global $kc;
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
                  'kc_testimonial_slider' => array(
	                'name' => 'Testimonial',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(



						    array(
                                "type" => "dropdown",
                                "label" => esc_html__( "Style", "stylemag" ),
                                "name" => "selected_posts",
                                "options" => array(
                                    "style_01"  => "Style 01",
                                    "style_02" => "Style 02",
                                ),
                                "value" => "style_01"
                            ),

                            array(
								'type' => 'text',
								'label' => 'Title',
								'name' => 'title',
								'relation' => array(
						        'parent'    => 'selected_posts',
						        'show_when' => 'style_01'
						     ),
								
							),

							array(
							'type'			=> 'group',
							'relation' => array(
						        'parent'    => 'selected_posts',
						        'show_when' => 'style_01'
						     ),
							'label'			=> __('Options', 'hospital-core'),
							'name'			=> 'testimonial_list',
							'params' => array(
								

								array(
                                 'name' =>'tes_image',
                                 'label'=>'Profil Image',
                                 'type' =>'attach_image_url',
                                 'admin_label' => false,
                                 'value'=>'imgage'   
                                ),
								array(
									'type' => 'text',
									'label' => 'Name',
									'name' => 'profile_name',
									'value' => 'name'
								),
								array(
									'type' => 'text',
									'label' => 'Designation',
									'name' => 'profile_deg',
									
									'value' => 'webdeveloper',
									
								),
								array(
									'name' => 'description',
									'label' => 'Description',
									'type' => 'textarea',  // USAGE ATTACH_IMAGE TYPE
									'value' => 'this is description',
									
								),




							
							)
						),

                        

                        
                        	array(
							'type'			=> 'group',
							'label'			=> __('Options', 'hospital-core'),
							'name'			=> 'optionss',
							
							'relation' => array(
						        'parent'    => 'selected_posts',
						        'show_when' => 'style_02'
						     ),
								

							'params' => array(
								
								array(
									'type' => 'text',
									'label' => 'Working Years',
									'name' => 'working_year',
									
								'relation' => array(
						        'parent'    => 'selected_posts',
						        'show_when' => 'style_02'
						          ),
								),
								array(
									'type' => 'text',
									'label' => 'Designation',
									'name' => 'designation2',
									'value'=>'Designation',
									
									
									
								),
								array(
									'name' => 'hospital_dep',
									'label' => 'Department',
									'type' => 'text',  // USAGE ATTACH_IMAGE TYPE
									'value'=>'department',
									
									
								),
								array(
									'name' => 'hos_description',
									'label' => 'Description',
									'type' => 'textarea',  // USAGE ATTACH_IMAGE TYPE
									'value'=>'description',
									
								),
								array(
									'name' => 'doc_icon',
									'label' => 'Icon',
									'type' => 'icon_picker',  // USAGE ATTACH_IMAGE TYPE
									'admin_label' =>true,
									
								),

							
							)
						),







					
					)
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}                         