<?php
add_shortcode('kc_department_icon', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'title_dis'        => '',
        'optionss'        => '',
    ), $atts);

   $optionss= $atts['optionss'];
?>

 <div class="department">
            <div class="container">
    
                <div class="row">
                       

                    <?php foreach ($optionss as $key => $value) {?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="box-widget">
                            <div class="box-icon">
                                <i class="<?php echo $value->title_dfgdis?>"></i>
                            </div>
                            <div class="box-text">
                                <h5><?php echo $value->title; ?></h5>
                                <p><?php echo $value->title_dis; ?></p>
                            </div>
                        </div>
                        <!-- /.box widget -->
                    </div>
                   <?php }?>
                
                    
                </div>
            </div>
        </div>




<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'department_icon', 99 );
 
function department_icon() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_department_icon' => array(
	                'name' => 'Department List With Icon',
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
                            'name' => 'title',
                            'label' => 'Title',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'Department Title', // remove this if you do not need a default content
                           
                        ), 
                        array(
                            'name' => 'title_dis',
                            'label' => 'Sub Title',
                            'type' => 'text',
                           
                            'value' => 'Description', // remove this if you do not need a default content
                        ),  
                        array(
                            'name' => 'title_dfgdis',
                            'label' => 'Icon',
                            'type' => 'icon_picker',
                           
                            'value' => 'Description', // remove this if you do not need a default content
                        ),
                       )
                      ),    
                          
                    
	                )
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>