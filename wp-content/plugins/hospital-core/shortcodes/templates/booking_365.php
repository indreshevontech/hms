<?php
add_shortcode('kc_custom_booking', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'title_dis'        => '',
        'selected_posts'        => '',
        'cat_list'        => '',
    ), $atts);

?>



<?php echo do_shortcode('[mas_bdtask]');?>


<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'kc_custom_booking', 99 );
 

function kc_custom_booking() {


	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_custom_booking' => array(
	                'name' => 'Booking 365',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(
	                    // array(
                     //        'name' => 'title',
                     //        'label' => 'Booking 365',
                            
                     //    ), 
                       
                  
	                )
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>