<?php 
add_shortcode('kc_main_block', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        
        'selected_posts'       => '',
        'block_title'          => '',
        'block_details'        => '',
        'button_level'         => '',
        'button_link'          => '',
        'background_color'     => '',
        'icon'                 => '',
        'icon_color'           => '',



        'block_title2'        => '',
        'block_subtitle'      => '',
        'icon2'               => '',
       'background_colordd'   =>'',
       'icon_colorasdf'       =>'',
       'options'              => '',

       'block_title3'         =>'',
       'block_subtitle3'      =>'',
       'options3'             =>'',
       'icon3'                =>'',
       'icon_color3'          =>'',
       'background_color3'    =>'',
    ), $atts);


$Quality=$atts['options'];
$working_day_time=$atts['options3'];


?>

  <section class="grid-inner">
                <div class="container">
                    <div class="row">
                        <!-- Service List -->
                      <style type="text/css">
                            .c-box-1{
                                background-color:<?php echo $atts['background_color'];?>
                            }
                           .c-box-1 .icon-widget i{
                                 color:<?php echo $atts['icon_color'];?>;
                            }
                           .c-box-2{
                               background-color:<?php echo $atts['background_colordd'];?>;
                            }
                           .c-box-2 .icon-widget i{
                                color:<?php echo $atts['icon_colorasdf'];?>;
                           }
                           .c-box-3{
                             background-color:<?php echo $atts['background_color3'];?>
                            }
                          .c-box-3 .icon-widget i{
                               color:<?php echo $atts['icon_color3'];?>;               
                          }
                         </style>   
                        <div class="col-md-4 coloumn c-box-1">
                            <div class="icon-widget">
                                <i class="<?php echo $atts['icon'];?> c-box-1"></i>
                            </div>
                            <div class="text-content">
                                <h3><?php echo $atts['block_title']?></h3>
                                <p><?php echo $atts['block_details']?></p>
                                <a href="<?php echo $atts['button_link'];?>" class="btn btn-link"><?php echo $atts['button_level'];?><i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                        
                        <!-- Benefits -->
                        <div class="col-md-4 coloumn c-box-2">
                            <div class="icon-widget">
                                <i class="<?php echo $atts['icon2'];?> c-box-2"></i>
                            </div>
                            <div class="text-content">
                                <h3><?php echo $atts['block_title2']?></h3>
                                <p><?php echo $atts['block_subtitle']?></p>
                                <ul class="list-unstyled">
                                    <?php foreach($Quality as $Quality_list){
                                    ?>
                                    <li><i class="fa fa-caret-right"></i><?php echo $Quality_list->param1;?>  </li>
                                     <?php }?>
                                    
                                </ul>
                            </div>
                        </div>
                       
                        <!-- Working Hours -->
                        <div class="col-md-4 coloumn c-box-3">
                            <div class="icon-widget">
                                <i class="<?php echo $atts['icon3'];?> c-box-3"></i>
                            </div>
                            <div class="text-content">
                                <h3><?php echo  $atts['block_title3'];?></h3>
                                <p><?php echo $atts['block_subtitle3'];?></p>
                                <table class="table">
                                    <tbody>
                                        <?php 
                                        foreach($working_day_time as $working_day){?>
                                        <tr>   
                                        <td><?php echo $working_day->date_name;?></td>
                                        <td class="text-right"><?php echo  $working_day->hour;?></td>
                                        </tr>
                                       <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </section>
            
<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'main_block', 99 );
 
function main_block() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_main_block' => array(
	                'name' => 'Block Overlap',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(
	                     
                         
                 'Doctors Timetable' => array( 
                            array(
                                'type' => 'text',
                                'label' => 'Title',
                                'name' => 'block_title',  
                            ),
                            array(
                                'type' => 'textarea',
                                'label' => 'Title',
                                'name' => 'block_details',     
                            ),
                            array(
                                'type' => 'icon_picker',
                                'label' => 'Icon',
                                'name' => 'icon', 
                                 'value'=>'flaticon-email',    
                            ),
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
                                'name' => 'background_color',
                                'label' => 'Background Color',
                                'type' => 'color_picker', 
                                'value' =>'#037d71', 
                             ), 
                            array(
                                'name' => 'icon_color',
                                'label' => 'Icon Color',
                                'type' => 'color_picker', 
                                'value' =>'#1a8d82', 
                             ),
                       ),
                'Our Benefits' => array(
                       array(
                                'type' => 'text',
                                'label' => 'Title',
                                'name' => 'block_title2', 
                                'value' =>'Our Benefits', 
                            ),
                            array(
                                'type' => 'text',
                                'label' => 'Sub Title',
                                'name' => 'block_subtitle',
                                'value' =>'It is a long established fact that a reader will. '     
                            ),
                            array(
                                'type' => 'icon_picker',
                                'label' => 'Icon',
                                'name' => 'icon2', 
                                 'value'=>'flaticon-world',    
                            ),

                            array(
                            'type'          => 'group',
                            'label'         => __('Options', 'hospital-core'),
                            'name'          => 'options',
                            'description'   => '',
                            'params' => array(
                                array(
                                    'type' => 'text',
                                    'label' => 'Quality List',
                                    'name' => 'param1',
                                ),
                              )
                            ), 

                            array(
                                'name' => 'background_colordd',
                                'label' => 'Background Color',
                                'type' => 'color_picker', 
                                'value' =>'#01756a', 
                             ), 
                            array(
                                'name' => 'icon_colorasdf',
                                'label' => 'Icon Color',
                                'type' => 'color_picker', 
                                'value' =>'#10877c', 
                             ),

                             
                ),
                'Our Working Hours' => array(
                        array(
                            'type' => 'text',
                            'label' => 'Title',
                            'name' => 'block_title3', 
                            'value' =>'Our Working Hours', 
                        ),
                        array(
                            'type' => 'text',
                            'label' => 'Sub Title',
                            'name' => 'block_subtitle3',
                            'value' =>'It is a long established fact that a reader will .'     
                        ),
                        array(
                            'type'          => 'group',
                            'label'         => __('Options', 'hospital-core'),
                            'name'          => 'options3',
                            'description'   => '',
                            'params' => array(
                             array(
                                'type' => 'text',
                                'label' => 'Day Name',
                                'name' => 'date_name',
                             ), 
                             array(
                                'type' => 'text',
                                'label' => 'Hour',
                                'name' => 'hour',
                             ),
                           )
                          ), 
                            array(
                                'type' => 'icon_picker',
                                'label' => 'Icon',
                                'name' => 'icon3', 
                                 'value'=>'flaticon-24-hours',    
                            ),
                            array(
                                'name' => 'background_color3',
                                'label' => 'Background Color',
                                'type' => 'color_picker', 
                                'value' =>'#006c62', 
                             ), 
                            array(
                                'name' => 'icon_color3',
                                'label' => 'Icon Color',
                                'type' => 'color_picker', 
                                'value' =>'#157e74', 
                             ),


                      ), 
                    
	                )

	            ),  
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>