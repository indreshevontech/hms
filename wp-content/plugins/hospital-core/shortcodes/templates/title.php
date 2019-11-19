<?php
add_shortcode('kc_custom_title', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'title_dis'        => '',
        'selected_posts'        => '',
    ), $atts);
?>
 

<?php if($atts['selected_posts']=='style_01'){?>
<div class="contect-des">
    <div class="contact-header">
        <h2>
            <span class="headline"><?php echo $atts['title'];?></span>
        </h2>

        <p><?php echo $atts['title_dis'];?></p>
    </div>
   
</div>
<?php }elseif ($atts['selected_posts']=='style_02') {?>
<div class="col-md-10 offset-md-1 col-lg-6 offset-lg-3">
    <div class="section-title">
        <h2><?php echo $atts['title'];?></h2>
        <?php echo $atts['title_dis'];?>
    </div>
</div>
<?php }elseif($atts['selected_posts']=='style_03'){?>

        <h2 class="contentTitle text-center"><?php echo $atts['title'];?></h2>
           
<?php }?> 

<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'custom_title', 99 );
 
function custom_title() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_custom_title' => array(
	                'name' => 'Title',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(
	                    array(
                            'name' => 'title',
                            'label' => 'Title',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'Contact Info', // remove this if you do not need a default content
                            "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_01','style_02','style_03')),
                        ), 
                        array(
                            'name' => 'title_dis',
                            'label' => 'Description',
                            'type' => 'textarea',
                            "relation" => Array('parent' => "selected_posts", 'show_when' => array('style_01','style_02')),
                            'value' => 'Description', // remove this if you do not need a default content
                        )
                        ,
                          array(
                                "type" => "dropdown",
                                "label" => esc_html__( "Style", "stylemag" ),
                                "name" => "selected_posts",
                                "options" => array(
                                    "style_01"  => "Style 01(Left)",
                                    "style_02" => "Style 02(Center)",
                                    "style_03" => "Style 03(without description)",
                                 
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