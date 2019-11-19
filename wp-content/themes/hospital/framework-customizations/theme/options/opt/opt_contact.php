<?php

if (!defined('FW')) {
    die('Forbidden');
}
$options = array(
    'contact_page_opt' => array(
            'title' => esc_html__('Contact page settings','hospital'),
            'type' => 'tab',
            'options' => array(
                'contact_header' => array(
                    'title' => esc_html__('Header settings','hospital'),
                    'type' => 'tab',
                    'options' => array(
                        'contact_header_boxes' => array(
                            'type'  => 'addable-box',
                            'label' => esc_html__('Header info boxes','hospital'),
                            'desc'  => esc_html__('Add header info boxes with icon','hospital'),
                            'box-options' => array(
                                'icon' => array( 'type' => 'icon', 'label' => esc_html__('Icon','hospital'), 'value' => 'fa fa-facebook-official' ),
                                'link' => array( 'type' => 'text', 'label' => esc_html__('Link','hospital'), 'value' => '#' ),
                                'text' => array( 'type' => 'text', 'label' => esc_html__('Text content', 'hospital'), 'value' => esc_html__('Facebook','hospital')),
                            ),
                            'template' => '{{- text }}', // box title
                            'box-controls' => array( 
                                'control-id' => '<small class="dashicons dashicons-share"></small>',
                            ),
                            'limit' => 0,
                            'add-button-text' => esc_html__('Add box','hospital'),
                            'sortable' => true,
                        ),
                    ),
                ),

                'contact_form' => array(
                    'title' => esc_html__('Contact form','hospital'),
                    'type' => 'tab',
                    'options' => array(
                        'cf7_shortcode' => array(
                            'type'      => 'text',
                            'label'     => esc_html__('Contact form shortcode','hospital'),
                            'desc'      => esc_html__("Generate the contact form shortcode by Contact Form 7 plugin.",'hospital'),
                        ),
                        'cf7_submit_btn' => array(
                            'type'      => 'text',
                            'label'     => esc_html__('Submit button label','hospital'),
                            'value'     => 'Send'
                        ),
                    )
                ),

                'contact_map' => array(
                    'title' => esc_html__('Map settings','hospital'),
                    'type' => 'tab',
                    'options' => array(
                        'map_lat' => array(
                            'type'      => 'text',
                            'label'     => esc_html__('Latitude','hospital'),
                            'desc'      => wp_kses_post(__("Get latitude from <a href='http://www.mapcoordinates.net/en' target='_blank'>here</a>",'hospital')),
                            'value'     => '23.8103968'
                        ),
                        'map_lng' => array(
                            'type'      => 'text',
                            'label'     => esc_html__('Longitude','hospital'),
                            'desc'      => wp_kses_post(__("Get Longitude from <a href='http://www.mapcoordinates.net/en' target='_blank'>here</a>",'hospital')),
                            'value'     => '90.41256666'
                        ),
                        'map_icon' => array(
                            'type'      => 'upload',
                            'label'     => esc_html__('Marker icon','hospital'),
                            'images_only' => true
                        ),
                    )
                ),
        )
    )
);
