<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    'cat_optghgh' => array(
        'title' => esc_html__('Footer settings','hospital'),
        'type'  => 'tab',
        'options' => array(


                'footer_config_tab' => array(
                'title' => esc_html__('Footer configurations','hospital'),
                'type' => 'tab',
                'options' => array(
                    'copyright_text'  => array(
                    'type'          => 'textarea',
                    'label'         => esc_html__('Copyright text','hospital'),
                    'value'         => '<p> Copyright  2017. All rights reserved </p>'
                    ),
                   
                )
            ),
            'footer_config_call' => array(
                'title' => esc_html__('Call To Action','hospital'),
                'type' => 'tab',
                'options' => array(
                    'call_to_action'  => array(
                    'type'          => 'textarea',
                    'label'         => esc_html__('Footer Top Call to action','hospital'),
                    'value'         => '<p> Copyright  2017. All rights reserved </p>'
                    ),
                   
                )
            ),


        ),
    )
);