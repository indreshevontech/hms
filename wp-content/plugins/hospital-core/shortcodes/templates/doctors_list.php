<?php
add_shortcode('kc_doctors_list', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'button_level'        => '',
        'button_link'        => '',
        'selected_posts'        => '',
    ), $atts);
?>
 
<div class="doctor-list">
            <div class="main">
                <div class="container">
                   
                    <section class="grid">
                     <?php
                       global $wp_query;
                       global $paged; 
                       global $post; 
                    $wp_query = new WP_Query(array(
                    'post_type' =>'doctors_list',
                    'posts_per_page' =>3,
                    'paged' =>$paged,
                     
                 ));
                 while ( $wp_query->have_posts()) :  $wp_query->the_post();
                    $doctor_desig = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_desig'): '';
                    $doctor_name = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_name'): '';
                    $doctor_email = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_email'): '';
                    $terms = get_the_terms( $post->ID , 'doctors_list_cat' );
                    ?>
                        <a class="grid__item" href="<?php the_permalink(); ?>">
                            <h2 class="title title--preview"><?php echo  $doctor_desig;?></h2>
                            <div class="loader"></div>
                            <span class="dr-name"><?php echo $doctor_name;?></span>
                            <div class="meta meta--preview">
                                <?php echo get_the_post_thumbnail($post->ID, array(540, 530), array('class' => 'meta__avatar'));?>
                                    <?php 
                                       foreach ( $terms as $term ) {
                                        $term_link = get_term_link( $term, 'doctors_list_cat' );?>
                                       <span class="meta__position">
                                        <?php echo  $term->name ?>
                                       </span>
                                <?php } ?>
                                <span class="meta__email"><?php echo $doctor_email;?></span>
                            </div>
                        </a>
                        <?php endwhile;?>
                    </section>
                    <div class="text-center mt-5">
                        <a href="<?php echo esc_url($atts['button_link']);?>" class="btn btn-primary"><?php echo esc_html($atts['button_level']);?></a>
                    </div>
                </div>
            </div>
        </div>


<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'doctors_list', 99 );
 
function doctors_list() {
 
	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_doctors_list' => array(
	                'name' => 'Doctors List',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(
	                    array(
                            'name' => 'button_level',
                            'label' => 'Button Level',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => 'View our team of surgeons', 
                        ), 
                        array(
                            'name' => 'button_link',
                            'label' => 'Button Link',
                            'type' => 'text',
                            'value' => '#', // remove this if you do not need a default content
                        ),
                          
                          
                    
	                )
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>