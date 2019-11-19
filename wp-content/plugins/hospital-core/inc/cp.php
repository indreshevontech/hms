<?php
add_action('init', function() {
    
    // Tour
    register_post_type('department', array(
        'public'    => true,
        'supports'  => array('title','editor', 'thumbnail', 'taxonomy', 'comments', 'excerpt'),
        'labels'    => array(
            'name'          => __('Departments', 'hospital'),
            'singular_name' => __('Department', 'hospital'),
            'all_items'     => __('All Departments','hospital'),
            'add_new_item'  => __('Add New Department','hospital'),
            'add_new'       => __('Add Department','hospital'),
        ),
        'taxonomies'            => array( 'categories'),
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,

    ));
    register_taxonomy('department_cat', 'department', array(
        'public'                    => true,
        'hierarchical'              => true,
        'show_admin_column'         => true,
        'show_in_nav_menus'         => false,
        'labels'                    => array(
            'name'  => esc_html__('Category','hospital'),
        )
    ));

    
    
    // Hotel
    register_post_type('doctors_list', array(
        'public'    => true,
        'supports'  => array('title','editor','thumbnail','taxonomy'),
        'labels'    => array(
            'name'          => esc_html__('Doctors List','hospital'),
            'add_new_item'  => esc_html__('Add Doctors List','hospital'),
            'add_new'       => esc_html__('Add Doctors List','hospital')
        ),
        'taxonomies'            => array( 'categories' ),
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'menu_icon'             => 'dashicons-admin-home'
    ));
    register_taxonomy('doctors_list_cat', 'doctors_list', array(
        'public'                    => true,
        'hierarchical'              => true,
        'show_admin_column'         => true,
        'show_in_nav_menus'         => false,
        'labels'                    => array(
            'name'  => esc_html__('Department','hospital'),
        )
    ));



// service

    register_post_type('service', array(
        'public'    => true,
        'supports'  => array('title','editor','thumbnail','taxonomy'),
        'labels'    => array(
            'name'          => esc_html__('Service List','hospital'),
            'add_new_item'  => esc_html__('Add Service List','hospital'),
            'add_new'       => esc_html__('Add Service List','hospital')
        ),
        'taxonomies'            => array( 'categories' ),
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'menu_icon'             => 'dashicons-admin-home'
    ));
  
    
});








