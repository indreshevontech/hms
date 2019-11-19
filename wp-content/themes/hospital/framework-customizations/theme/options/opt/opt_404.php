<?php
if (!defined('FW')) {
    die('Forbidden');
}
$options = array(
    '404' => array(
        'title' => esc_html__('404 Settings','hospital'),
        'type' => 'tab',
        'options' => array(
            'general-box' => array(
                'title' => esc_html__('404 Page Settings','hospital'),
                'type' => 'tab',
                'options' => array(
                    'four_image' => array(
                        'label'         => esc_html__('404 Image','hospital'),
                        'type'          => 'upload',
                        'value'         => '404',
                        'images_only'   => true,
                    ),
                    'four_heading'  => array(
                        'label'     => esc_html__('Heading','hospital'),
                        'type'      => 'text',
                        'value'     => '404',
                        'desc'      => esc_html__('404 heading text.','hospital')
                    ),
                    'four_subtitle' => array(
                        'label'     => esc_html__('Subtitle','hospital'),
                        'type'      => 'wp-editor',
                        'value'     => '<h4>The page you were looking for dosent exist.</h4>',
                        'desc'      => esc_html__('Enter 404 page subtitle text.','hospital'),
                        'reinit'    => true,
                        'size'      => 'small',
                        'editor_type' => false,
                    ),
                    'four_button_label' => array(
                        'label' => esc_html__('Button Label','hospital'),
                        'desc' => esc_html__('Enter button label','hospital'),
                        'type' => 'text',
                        'value' => 'Go To the home page'
                    ),
                    'four_button_link' => array(
                        'label' => esc_html__('Button Link','hospital'),
                        'desc' => esc_html__('Enter link URL related to the button','hospital'),
                        'type' => 'text',
                        'value' => '#'
                    )
                )
            ),
        )
    )
);
