<?php
add_shortcode('kc_time_table', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'title_dis'        => '',
        'optionss'        => '',
    ), $atts);

    $optionss=$atts['optionss'];

?>
 


   <div class="department">
            <!-- <div class="container"> -->
                
                <div class="row">
                    <?php foreach($optionss as $value){?>
                    <div class="col-6 col-md-4 col-lg-2">
              
                            <div class="box-widget">
                                <div class="box-text">
                                    <div class="event-container">
                                       <b><a class="event_header" href=""><?php echo $value->working_day; ?></a></b>
                                        <div class="before_hour_text"><?php echo $value->working_hour; ?></div>
                                        
                                        <div class="hours_container"><span class="hours"><?php echo $value->department;?></span></div>
                                        <b><a class="event_header"><?php echo $value->hospital_name; ?></a></b>
                                        <div class="before_hour_text"><?php echo $value->hos_address; ?></div>
                                    </div>
                                </div>
                            </div>
                    </div>
               
                     <?php }?>
                    
                  
                </div>
            <!-- </div> -->
        </div>                     



<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'time_table', 99 );
 
function time_table() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_time_table' => array(
	                'name' => 'Time Table',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(
	       
                            array(
                            'type'          => 'group',
                            'label'         => __('Options', 'hospital-core'),
                            'name'          => 'optionss',
                        
                            
                          
                            'params' => array(
                                
                                array(
                                    'type' => 'text',
                                    'label' => 'Time',
                                    'name' => 'working_hour',
                                    
                             
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => 'Day',
                                    'name' => 'working_day',
                                  
                             
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => 'Department',
                                    'name' => 'department',
                                   
                                 
                                ),
                                array(
                                    'name' => 'hospital_name',
                                    'label' => 'Hospital Name',
                                    'type' => 'text',  // USAGE ATTACH_IMAGE TYPE
                                   
                                ),
                                array(
                                    'name' => 'hos_address',
                                    'label' => 'Hospital Address',
                                    'type' => 'text',  // USAGE ATTACH_IMAGE TYPE
                                   
                                ),
                                

                            
                            )
                            


                        ),
                          
                    
	                )
	            ),  
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>