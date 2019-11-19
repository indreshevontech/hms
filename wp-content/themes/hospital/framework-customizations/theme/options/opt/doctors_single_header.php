<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    'cat_optddddfdf' => array(
        'title' => esc_html__('Doctors Single Page','hospital'),
        'type'  => 'tab',
        'options' => array(

        'headerdsfd' => array(
            'title' => esc_html__('Doctors Header','hospital'),
            'type' => 'tab',
            'options' => array(
                'dr_image' => array(
                    'type'          => 'upload',
                    'label'         => esc_html__('Banner Image','hospital'),
                    'desc'          =>esc_html__('1920 * 400 image size','hospital'),
                    'images_only'   => true,
                ),
            )
        ),
    

    ),
)
);