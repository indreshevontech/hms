<?php
add_shortcode('kc_nurses', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'nurses_title'        => '',
        'button_link'        => '',
        'selected_posts'        => '',
        'nurses_list'        => '',
    ), $atts);


   $nurses_list =$atts['nurses_list'];
?>
<div class="container">
<!-- <div class="team-content"> -->
 <div class="row">
                <div class="col-md-12">
                        <div class="o-separator">
                            <hr><p class="o-separator-text"><?php echo $atts['nurses_title'];?></p><hr>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php 
                   foreach ($nurses_list as $key => $value) {
                     $img = wp_get_attachment_image_src($value->nurses_images,'travel_850x395'); 
                   
                    ?>
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <article class="team-member">
                            <div class="member-header">
                                <a href="#"><img src="<?php echo esc_url($img[0]);?>" class="img-fluid" alt=""></a>
                                <ul class="member-social list-unstyled">
                                    <li><a href="<?php echo $value->face_link;?>"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $value->twitter_link;?>"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="<?php echo $value->linkden_link;?>"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="member-info">
                                <h5 class="member-name m-0"><?php echo $value->nurses_name?></h5>
                                <p><?php echo $value->nurses_category?></p>
                            </div>
                        </article>
                    </div>
                    <?php  }?>
                </div>
            <!-- </div> -->
      </div>      
<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'nurses', 99 );
 
function nurses() {
 
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(
 
                'kc_nurses' => array(
                    'name' => 'Nurses Team',
                    'description' => __('Display single icon', 'hospital-core'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'Hospital',
                    'params' => array(
                        array(
                            'name' => 'nurses_title',
                            'label' => 'Title',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => "Nurses", 
                        ),  

                           array(
                            'type'          => 'group',
                            'label'         => __('Nurses', 'hospital-core'),
                            'name'          => 'nurses_list',
                            'description'   => '',
                            'params' => array(
                                array(
                                    'type' => 'text',
                                    'label' => 'Nurses Name',
                                    'name' => 'nurses_name',
                                ),
                                array(
                                    'name' => 'nurses_category',
                                    'label' => 'Nurses Category',
                                    'type' => 'text',  
                                ),
                            
                                array(
                                 'name' =>'nurses_images',
                                 'label'=>'Nurses Image',
                                 'type' =>'attach_image'
                                    
                                ),
                                 array(
                                    'name' => 'face_link',
                                    'label' => 'Facebook Link',
                                    'type' => 'text',  
                                ), 
                                 array(
                                    'name' => 'twitter_link',
                                    'label' => 'Twitter Link',
                                    'type' => 'text',  
                                ), 

                                array(
                                    'name' => 'linkden_link',
                                    'label' => 'Linkden Link',
                                    'type' => 'text',  
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