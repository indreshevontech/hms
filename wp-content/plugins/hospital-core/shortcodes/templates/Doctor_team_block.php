<?php
add_shortcode('kc_wp_doctors', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title_level'        => '',
        'button_link'        => '',
        'selected_posts'        => '',
    ), $atts);
?>
 <div class="container">
    <!-- <div class="team-content"> -->
 <div class="row">
                    <div class="col-md-12">
                        <div class="o-separator">
                            <hr><p class="o-separator-text"><?php echo $atts['title_level'];?></p><hr>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?php
                       // global $wp_query;
                       // global $paged; 
                        global $post; 
                    $wp = new WP_Query(array(
                    'post_type' =>'doctors_list',
                    'posts_per_page' =>3,
                    
                     
                 ));
                    while ( $wp->have_posts()) :  $wp->the_post();
                    $doctor_desig = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_desig'): '';
                    $doctor_name = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_name'): '';
                    $doctor_email = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_email'): '';
                    $terms = get_the_terms( $post->ID , 'doctors_list_cat' );
                    ?>
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <article class="team-member">
                            <div class="member-header">
                                <a href="<?php the_permalink()?>">
                                  <!--   <img src="<?php echo get_template_directory_uri();?>/assets/img/avatar/01.jpg" class="img-fluid" alt=""> -->
                                    <?php echo get_the_post_thumbnail($post->ID, array(364, 364), array('class' => 'img-fluid'));?>
                                </a>
                             

                                <?php dr_personal_social_icon2();?>
                            </div>
                            <div class="member-info">
                                <h5 class="member-name m-0"><a href=""><?php echo $doctor_name;?></a></h5>
                                <?php 
                                       foreach ( $terms as $term ) {
                                        $term_link = get_term_link( $term, 'doctors_list_cat' );?>
                                        <p><?php echo  $term->name ?></p>
                                <?php } ?>
                               
                            </div>
                        </article>
                    </div>
                <?php endwhile;?>
                    
                </div>
            <!-- </div> -->
        </div>
<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'alskjflaksdf', 99 );
 
function alskjflaksdf() {
 
    if (function_exists('kc_add_map')) 
    { 
        kc_add_map(
            array(
 
                'kc_wp_doctors' => array(
                    'name' => 'Doctors Team',
                    'description' => __('Display single icon', 'hospital-core'),
                    'icon' => 'sl-paper-plane',
                    'category' => 'Hospital',
                    'params' => array(
                        array(
                            'name' => 'title_level',
                            'label' => 'Title',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => "Doctor's", 
                        ),   
                    
                    )
                ),  // End of elemnt kc_icon 
          
 
            )
        ); // End add map
    
    } // End if
 
}  
 
?>