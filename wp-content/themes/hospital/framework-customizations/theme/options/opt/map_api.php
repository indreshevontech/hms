<?php

if (!defined('FW')) {
    die('Forbidden');
}
$options = array(
    'blog_optdfgsdfgdsf' => array(
        'title' => esc_html__('Map Api','hospital'),
        'type' => 'tab',
        'options' => array(
            'map_api'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Map API Link','hospital'),
                 'desc'      => wp_kses_post(__("Follow <a href='https://developers.google.com/maps/documentation/javascript/get-api-key' target='_blank'> this link </a> and click on Get a key", 'hospital')),
                'value'         =>'AIzaSyBDHeh9zEbXo-YCWJcicXH2VRwVwAf_tq0'
            ),
           
            
        )
    )
);
