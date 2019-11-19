<?php 
add_shortcode('kc_dr_info', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'options'        => '',
        'language_name'        => '',
        'language_ratings'        => '',
        'language_checkbox'        => '',
      

    ), $atts);

$testimonials=$atts['options'];
?>
                    <div class="row text-left mb-5">
                       
                        <div class="col-md-6">
                     
                        <h3 class="title-thin"><?php echo $atts['title'];?></h3>
                        <div class="progress-bullets" role="progressbar" aria-valuenow="97" aria-valuemin="0" aria-valuemax="10">
                            <?php foreach($testimonials as $testimonials){?>
                             <strong class="progress-title"><?php echo $testimonials->language_name;?></strong> 
                             <span class="progress-bars"> 
                                <?php $i=$testimonials->language_ratings;
                                  $s=1;
                                ?>
                                <?php for($s=0;$s<=$i;$s++){?>
                                <span class="bullet fill"></span> 
                                 
                               <?php }?> 
                            </span> 
                            <span class="progress-text text-muted"><?php echo $testimonials->language_checkbox;?></span>
                        <?php } ?>
                        </div>
                  
                        
                        </div>
                    </div>






<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'kc_dr_info', 99 );
 
function kc_dr_info() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_dr_info' => array(
	                'name' => __('Doctor language Info', 'hospital-core'),
					'description' => __('', 'hospital-core'),
					'icon' => 'kc-icon-progress',
					'category' => 'Hospital',
					'css_box' => true,
					'params' => array(
						    
                            array(
								'type' => 'text',
								'label' => 'Title',
								'name' => 'title',
								'admin_label' => true,
							),
							array(
							'type'			=> 'group',
							'label'			=> __('Options', 'hospital-core'),
							'name'			=> 'options',
							'description'	=> '',
							'params' => array(
								array(
									'type' => 'text',
									'label' => 'Language Name',
									'name' => 'language_name',
								),
								array(
									'name' => 'language_ratings',
									'label' => 'Ratings',
									'type' => 'text',  
								),
							
								array(
							    'name' => 'language_checkbox',
							    'label' => 'Field Label',
							    'type' => 'checkbox',  // USAGE CHECKBOX TYPE
							    'options' => array(    // REQUIRED
							        'native' => 'native',
							        'fluent' => 'Fluent',
							        'beginner' => 'Beginner',
							    ),
							    'value' => 'DEFAULT-CONTENT', // remove this if you do not need a default content
							    'description' => 'Field Description',
							   )

							
							)
						),

                        

                        







					
					)
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}                         



