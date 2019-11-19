<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    'cat_optddd' => array(
        'title' => esc_html__('Header settings','hospital'),
        'type'  => 'tab',
        'options' => array(

        'header' => array(
            'title' => esc_html__('Header Options','hospital'),
            'type' => 'tab',
            'options' => array(
                'main_logo' => array(
                    'type'          => 'upload',
                    'label'         => esc_html__('Main Logo','hospital'),
                    'images_only'   => true,
                ),
                'favicon'  => array(
                    'type'          => 'upload',
                    'label'         => esc_html__('Favicon icon','hospital'),
                    'images_only'   => true,
                ),
                 'hospital_open_info'       => array(
                        'type'          => 'text',
                        'label'         => esc_html__('Hospital Open Info','hospital'),
                        'value'         =>'MON - FRI: 08:00AM - 20:00PM',
                ),
                 'hospital_close_info'       => array(
                                'type'          => 'text',
                                'label'         => esc_html__('Hospital Close Info','hospital'),
                                'value'         =>'Saturday and Sunday - CLOSED',
                ),  

                'hospital_contact_info'       => array(
                                'type'          => 'text',
                                'label'         => esc_html__('Hospital Contact Info','hospital'),
                                'value'         =>'+ 0800 2466 7921',
                ),
                'hospital_contact_level'       => array(
                                'type'          => 'text',
                                'label'         => esc_html__(' Hospital Contact Level','hospital'),
                                'value'         =>'Contact Us For Help',
                ), 

                'hospital_road_name'       => array(
                                'type'          => 'text',
                                'label'         => esc_html__(' Hospital Road Name','hospital'),
                                'value'         =>'34th Avenue',
                ),
              'hospital_city_name'       => array(
                                'type'          => 'text',
                                'label'         => esc_html__(' Hospital City Name','hospital'),
                                'value'         =>'New York, W2 3XE',
                ),
              
               'is_top_menu'     => array(
                    'type'          => 'switch',
                    'label'         => esc_html__('Show Top menu bar?','hospital'),
                    'value'         => true,
                ),    
                 
                 'hospital_menu_appoin'       => array(
                                'type'          => 'text',
                                'label'         => esc_html__('Menu Appiontment Title','hospital'),
                                'value'         =>'Appiontment',
                ), 

                'hospital_menu_ap_link'       => array(
                                'type'          => 'text',
                                'label'         => esc_html__('Menu Appiontment Link','hospital'),
                                'value'         =>'#appiontment',
                ), 

            )
        ),
    


          'newsticker' => array(
                'title' => esc_html__('Top Bar','hospital'),
                'type' => 'tab',
                'options' => array(
                    
                    'hospital_email'     => array(
                        'type'          => 'text',
                        'label'         => esc_html__('Email ','hospital'),
                        'value'         => 'companyname@mail.com'
                    ),


                  'hospital_phone'       => array(
                        'type'          => 'text',
                        'label'         => esc_html__('Phone Number','hospital'),
                        'value'         =>'(732) 803-010-03',
                    ),

                    'header_facebook'     => array(
                    'type'      => 'text',
                    'label'     => esc_html__('Facebook','hospital'),
                    'value'     => '#',
                    ),  
                    'header_twitter'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Twitter','hospital'),
                        'value'     => '#',
                    ),
         
                    'header_instagram'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Instagram','hospital'),
                        'value'     => '#',
                    ),  

                    'header_dribbble'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Dribbble','hospital'),
                        'value'     => '#',
                    ),
                    'header_skype'     => array(
                        'type'      => 'text',
                        'label'     => esc_html__('Skype','hospital'),
                        'value'     => '#',
                    ),
                   
                    'header_more_social_links' => array(
                        'type'  => 'addable-box',
                        'label' => esc_html__('Add more', 'hospital'),
                        'desc'  => esc_html__('Add more social links with icons', 'hospital'),
                        'box-options' => array(
                            'icon' => array( 'type' => 'icon', 'label' => esc_html__('Icon', 'hospital') ),
                            'link' => array( 'type' => 'text', 'label' => esc_html__('Link', 'hospital') ),
                           
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

    ),
)
);