<?php
function hospital_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Service Page','hospital'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.','hospital'),
        'before_widget' => '',
        'after_widget'  => '
                            ',
        'before_title'  => ' <h4 class="contactCard-title">',
        'after_title'   => '</h4>',
    ) );    
    register_sidebar( array(
        'name'          => esc_html__( 'Footer widgets','hospital'),
        'id'            => 'footer_widgets',
        'description'   => esc_html__( 'Add widgets here.','hospital'),
        'before_widget' => '<div id="%1$s" class="widget %2$s col-block ">',
        'after_widget'  => '</div>',
        'before_title'  => ' <h3 class="footer-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'hospital_widgets_init' );







// Register Widgets
add_action('widgets_init', function() {
    register_widget('Osru_widgets');
    register_widget('about_widgets');
    register_widget('osru_recent_posts');
    register_widget('footer_contact');
});

require get_template_directory() . '/widgets/title.php';
require get_template_directory() . '/widgets/about.php';
require get_template_directory() . '/widgets/department_category.php';
require get_template_directory() . '/widgets/contact_details.php';
