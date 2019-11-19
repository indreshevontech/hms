<?php
add_shortcode('kc_custom_blog', function($atts, $content) {
    ob_start();
    $atts = shortcode_atts(array(
        'title'        => '',
        'title_dis'        => '',
        'selected_posts'        => '',
        'cat_list'        => '',
    ), $atts);


    $cat_list  = $atts['cat_list'];
    $cat_list  = explode(', ', $cat_list);

    // global $wp_query;
    // global $paged;
    // $temp = $wp_query;
    // $wp_query = null;

                $wp_query = new WP_Query(array(
                             'post_type'=>'post', 
                            'post_status'=>'publish',
                            'posts_per_page'=>$atts['title'],
                            // 'category__in' => wp_get_post_categories($post->ID),
                         
                    )); 
        // $wp_query = new WP_Query(array(
        //     'post_type'         => 'post',
        //     'paged'             => $paged,
        //     'posts_per_page'     =>3,
        //     'orderby' =>'post_date', 
        //      'order' =>'DESC',
           
        // ));



?>




 
  <div class="blog-content">
            <div class="container">
          
                <div class="row">

                     <?php  while(  $wp_query->have_posts()) :   $wp_query->the_post();?>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <article class="grid-content">
                            <a href="<?php the_permalink();?>" class="img-link">
                         
                          <?php the_post_thumbnail('',array('class' => 'img-fluid'));?>
                            </a>
                            <div class="textContent">
                                <div class="post-meta d-flex">
                                    <span class="date"><?php the_time(get_option('date_format')) ?> </span>
                                    <span class="categories">In <a href="#">
                                    <?php $categories = get_the_category();
                                     
                                    if ( ! empty( $categories ) ) {
                                        echo esc_html( $categories[0]->name );   
                                    } ?>
                                    </a>
                                    </span>
                                </div>
                                <h3><a href="<?php the_permalink();?>"><?php echo wp_trim_words(get_the_title(),13,'');?></a></h3>
                                <p><?php echo  wp_trim_words(get_the_content(),22,'');?></p>
                                <a href="<?php the_permalink();?>" class="read-more"><?php echo esc_html($atts['title_dis'],'hospital-core'); ?><i class="ti-arrow-right"></i></a>
                            </div>
                        </article>
                        <!-- /.Grid content -->
                    </div>
                    <?php endwhile;  wp_reset_query();?>
                    
                </div>
            </div>
        </div>



<?php 
    $html = ob_get_clean();
    return $html;
});
add_action('init', 'kc_custom_blog', 99 );
 

function kc_custom_blog() {


	if (function_exists('kc_add_map')) 
	{ 
	    kc_add_map(
	        array(
 
	            'kc_custom_blog' => array(
	                'name' => 'Post Blog',
	                'description' => __('Display single icon', 'hospital-core'),
	                'icon' => 'sl-paper-plane',
	                'category' => 'Hospital',
	                'params' => array(
	                    array(
                            'name' => 'title',
                            'label' => 'Per Page Post',
                            'type' => 'text',  // USAGE TEXT TYPE
                            'value' => '3', // remove this if you do not need a default content
                        ), 
                        array(
                            'name' => 'title_dis',
                            'label' => 'Read More',
                            'type' => 'text',
                           
                            'value' => 'Read More', // remove this if you do not need a default content
                        ),
                        
                  
	                )
	            ),  // End of elemnt kc_icon 
          
 
	        )
	    ); // End add map
	
	} // End if
 
}  
 
?>