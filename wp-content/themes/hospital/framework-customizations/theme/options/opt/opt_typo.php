<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    'opt_typo'  => array(
        'title'     => esc_html__('Typography Settings','hospital'),
        'type'      => 'tab',
        'options'   => array(
            'main_font' => array(
                'label' => esc_html__('Main Font', 'hospital'),
                'desc'  => esc_html__('Body font properties.','hospital'),
                'type'  => 'typography-v2',
                'value' => array(
                    'family'        => 'Alegreya Sans',
                ),
                'components' => array(
                    'family'         => true,
                    'size'           => false,
                    'line-height'    => false,
                    'color'          => false,
                    'style'          => false,
                    'script'         => false,
                    'letter-spacing' => false,
                ),
            ),
            'font2' => array(
                'label' => esc_html__('Font 2','hospital'),
                'type'  => 'typography-v2',
                'value' => array(
                    'family'        => 'Playfair Display',
                ),
                'components' => array(
                    'family'         => true,
                    'size'           => false,
                    'line-height'    => false,
                    'color'          => false,
                    'style'          => false,
                    'script'         => false,
                    'letter-spacing' => false,
                ),
            ),
            
        )
    )
);
