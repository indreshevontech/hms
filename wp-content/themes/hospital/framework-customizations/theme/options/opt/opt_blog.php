<?php

if (!defined('FW')) {
    die('Forbidden');
}
$options = array(
    'blog_opt' => array(
        'title' => esc_html__('Blog settings','hospital'),
        'type' => 'tab',
        'options' => array(
            'blog_title'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Blog title','hospital'),
                'value'         => 'Blog Post'
            ),
            'blog_subtitle'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Blog subtitle','hospital'),
                'value'         => "Post List"
            ), 

            'blog_you_need_help'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Blog You Need Help Level','hospital'),
                'value'         => "You need help?"
            ), 
            'blog_you_need_help_phne'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Contact Number','hospital'),
                'value'         => "+49 (30) 695 96 415"
            ),
            'blog_read_more'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Read more text','hospital'),
                'value'         => 'Read More'
            ),
            'blog_excerpt'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Post word excerpt','hospital'),
                'value'         => 20
            ),
            'breadcurb'  => array(
                'type'          => 'switch',
                'label'         => esc_html__(' Show Breadcrumbs','hospital'),
                 'desc'      => esc_html__('in blog,category,archive,search page?','hospital'),
                'value'         => 20
            ),
            'blog_title_bg'     => array(
                'type'          => 'multi-upload',
                'label'         => esc_html__('Background image', 'hospital'),
                'desc'          => esc_html__('Upload here the Title bar background image', 'hospital'),
                'images_only'   => true,
            ),

            'breadcurb_per_post'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Doctor Page Post Counter','hospital'),
                 'desc'      => esc_html__('Show Doctors Post Number','hospital'),
                'value'         => 12
            ),
            'dep_per_post'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Department Page Post Counter','hospital'),
                 'desc'      => esc_html__('Show Department Post Number', 'hospital'),
                'value'         => 12
            ),  
            'ser_per_post'  => array(
                'type'          => 'text',
                'label'         => esc_html__('Service Page Post Counter','hospital'),
                 'desc'      => esc_html__('Show Service Post Number','hospital'),
                'value'         => 4
            ),
            
        )
    )
);
