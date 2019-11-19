<?php
if (!defined('FW')) {
    die('Forbidden');
}
$options = array(
    'colors' => array(
        'title' => esc_html__('Color Style Settings','hospital'),
        'type' => 'tab',
        'options' => array(
            'color_scheme_tab' => array(
                'title' => esc_html__('Color Scheme','hospital'),
                'type' => 'tab',
                'options' => array(
                    'accent_color' => array(
                        'type'          => 'color-picker',
                        'label'         => esc_html__('Accent color','hospital'),
                        'desc'          => esc_html__('Change the main color scheme of the theme #fec107','hospital'),
                        'value'         => '#d17c78',
                    ),
                    'button_color' => array(
                        'type'          => 'color-picker',
                        'label'         => esc_html__('Read More Hover color','hospital'),
                        'desc'          => esc_html__('Change the main color scheme of the theme #303030','hospital'),
                        'value'         => '#303030',
                    ),

                    'header_1' => array(
                        'type'          => 'color-picker',
                        'label'         => esc_html__('Bookig Title and Note Background color','hospital'),
                        'value'         => '#006057',
                    ), 

                    'header_4' => array(
                        'type'          => 'color-picker',
                        'label'         => esc_html__('Slider Icon Box','hospital'),
                        'value'         => '#0e9e8f',
                    ),
                    
                    'mobile_menu' => array(
                        'type'          => 'color-picker',
                        'label'         => esc_html__('Mobile Menu Color','hospital'),
                        'value'         => '#0f635b',
                    ),
                    
                   
                )
            ),
        )
    )
);
