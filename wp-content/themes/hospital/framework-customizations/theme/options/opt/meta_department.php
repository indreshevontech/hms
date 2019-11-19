<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    // Package Settings
    'tour_pricing_meta'   => array(
        'title'     => esc_html__('Flact Icon','hospital'),
        'type'      => 'tab',
        'options'   => array(
            'sub_stuff' => array(
              'label' => __( 'Icon Select','hospital'),
              'type'  => 'select',
              'value' => 'Select Icon',
              'help'  => '',
              'desc'  => '',
              'choices' => array(
                'flaticon-sperm-2' => __( 'flaticon-sperm-2','hospital'),
                'flaticon-drug' => __( 'flaticon-drug','hospital'),
                'flaticon-focus' => __( 'flaticon-focus','hospital'),
                'flaticon-heart' => __( 'flaticon-heart','hospital'),
                'flaticon-neurology' => __( 'flaticon-neurology','hospital'),
                'flaticon-herbal' => __( 'flaticon-herbal','hospital'),
                'flaticon-herbal' => __( 'flaticon-herbal','hospital'),
                'flaticon-feeder' => __( 'flaticon-feeder','hospital'),
                'flaticon-tooth' => __( 'flaticon-tooth','hospital'),
                'flaticon-surgery' => __( 'flaticon-surgery','hospital'),
                'flaticon-uterus' => __( 'flaticon-uterus','hospital'),
                'flaticon-x-ray' => __( 'flaticon-x-ray','hospital'),
              )
            ),
        ),
    ),

);
