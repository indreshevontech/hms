<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(

    // Pricing meta
    'hotel_pkg_settings'   => array(
        'title'     => esc_html__('Doctor Info','hospital'),
        'type'      => 'tab',
        'options'   => array(
            'doctor_desig' => array(
                'type'     => 'text',
                'label'    => esc_html__('Designation','hospital'),
              
                'value'    => ''
            ),
            
         'doctor_name' => array(
                'type'     => 'text',
                'label'    => esc_html__('Doctor Name','hospital'),
              
                'value'    => ''
            ),
         'doctor_email' => array(
                'type'     => 'text',
                'label'    => esc_html__('Doctor Email','hospital'),
              
                'value'    => ''
            ),
            'social_links_boxddd' => array(
                'title' => esc_html__('Social links with icon','hospital'),
                'type' => 'box',
                'options' => array(
                    'facebooks'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Facebook','hospital'),
                        'value'     => '#',
                    ),   
                    'skype'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Skype','hospital'),
                        'value'     => '#',
                    ),  

                    'linkedins'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Dribbble','hospital'),
                        'value'     => '#',
                    ),
                    'twitters'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Twitter','hospital'),
                        'value'     => '#',
                    ),

                    'youtubes'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Youtube','hospital'),
                        'value'     => '#',
                    ),
        
                    'more_social_linkss' => array(
                        'type'  => 'addable-box',
                        'label' => esc_html__('Add more','hospital'),
                        'desc'  => esc_html__('Add more social links with icons', 'hospital'),
                        'box-options' => array(
                            'icon' => array( 'type' => 'icon', 'label' => esc_html__('Icon','hospital') ),
                            'link' => array( 'type' => 'text', 'label' => esc_html__('Link','hospital') ),
                           
                        ),
                        'box-controls' => array( 
                            'control-id' => '<small class="dashicons dashicons-share"></small>',
                        ),
                        'limit' => 0, 
                        'add-button-text' => esc_html__('Add link','hospital'),
                        'sortable' => true,
                    )
                )
            ),
       
    
        )
    ),

);
