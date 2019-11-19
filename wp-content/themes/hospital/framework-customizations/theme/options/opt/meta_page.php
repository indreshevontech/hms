<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(

    // Pricing meta
    'page_meta'   => array(
        'title'     => esc_html__('Page Settings','hospital'),
        'type'      => 'tab',
        'options'   => array(
          
             'is_title_bar' => array(
                'type'          => 'switch',
                'label'         => esc_html__('Show Breadcrumbs ?','hospital'),
                'desc'          => esc_html__('Switch to no if want to hide the page Breadcrumbs.','hospital'),
                'value'         => true,
            ),
            'is_call_to_action' => array(
                'type'          => 'switch',
                'label'         => esc_html__('Show Call To Action?','hospital'),
                'desc'          => esc_html__('Switch to no if want to hide the page instagram.','hospital'),
                'value'         => true,
            ), 

             'page_ptop'     => array(
                'type'          => 'text',
                'label'         => esc_html__('Padding top','hospital'),
                'desc'          => esc_html__('Padding top before page content.','hospital'),
                'value'         => '0px',
               ),
              'page_pbtm'     => array(
                'type'          => 'text',
                'label'         => esc_html__('Padding bottom','hospital'),
                'desc'          => esc_html__('Padding bottom after page content.','hospital'),
                'value'         => '0px',
               ),
            
            
        )
    ),

);
