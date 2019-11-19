<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    'opt_styling'  => array(
        'title'     => esc_html__("Styling and Color Settings",'hospital'),
        'type'      => 'tab',
        'options'   => array(
            'sec_title' => array(
                'label' => esc_html__('Section Title', 'hospital'),
                'desc'  => esc_html__('Will apply to all post block section title.', 'hospital'),
                'type'  => 'typography-v2',
                'value' => array(
                    'size'          => '30px',
                    'color'         => '#222222'
                ),
                'components' => array(
                    'family'         => false,
                    'size'           => true,
                    'line-height'    => false,
                    'color'          => true,
                    'style'          => false,
                    'script'         => false,
                    'letter-spacing' => false,
                ),
            ),
            'post_meta' => array(
                'label' => esc_html__('Post meta','hospital'),
                'desc'  => esc_html__('Will apply to all post meta (Date and comment count)','hospital'),
                'type'  => 'typography-v2',
                'value' => array(
                    'size'          => '12px',
                    'color'         => '#7f7f7f'
                ),
                'components' => array(
                    'family'         => false,
                    'size'           => true,
                    'line-height'    => false,
                    'color'          => true,
                    'style'          => false,
                    'script'         => false,
                    'letter-spacing' => false,
                ),
            ),
            'cat_styling' => array(
                'label'   => esc_html__('Category styling', 'hospital'),
                'type'    => 'typography-v2',
                'value'   => array(
                    'size'   => '12px',
                    'color'  => '#ffffff',
                ),
                'components' => array(
                    'family'         => false,
                    'size'           => true,
                    'line-height'    => false,
                    'color'          => true,
                    'style'          => false,
                    'script'         => false,
                    'letter-spacing' => false,
                ),
            ),
        )
    )
);
