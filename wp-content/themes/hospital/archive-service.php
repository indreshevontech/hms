<?php 
/**
 *Template Name:Service
 */
get_header();


$call_to_action        = defined('FW') ? fw_get_db_settings_option('call_to_action'):'';
$is_title   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_title_bar') : 1;
$is_call_to_action   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_call_to_action') : 1;

$ser_per_post        = defined('FW') ? fw_get_db_settings_option('ser_per_post'):'';
  $blog_read_more       = defined('FW') ? fw_get_db_settings_option('blog_read_more') :'';
?>
<?php 
if($is_title){
hospital_title_bar();
}
?>
        <div class="service-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                    <?php
                    global $wp_query;
                    global $paged;  
                    $wp_query = new WP_Query(array(
                    'post_type' =>'service',
                    'posts_per_page' =>$ser_per_post,
                    'paged' =>$paged,
                     
                 ));
                    
                 while ( $wp_query->have_posts()) :  $wp_query->the_post();?>
                        <div class="article d-flex">
                            <article>
                                <a href="<?php the_permalink();?>" class="article_image">
                                
                                     <?php echo get_the_post_thumbnail($post->ID, array(230,230));?>
                                </a>
                                <div class="article__content">
                                    <h2 class="article__title"><?php the_title();?></h2>
                                    <p class="article__text">
                                       <?php echo wp_trim_words(get_the_content(),40,'');?>
                                    </p>
                                    <div class="article__action">
                                        <a href="<?php the_permalink();?>" class="read-link"><?php echo esc_html($blog_read_more,'hospital');?> <i class="ti-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                      <?php endwhile;?>  

                        <div class="page-meta">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                 
                                    <?php  function bittersweet_pagination() {
									global $wp_query;

									if ( $wp_query->max_num_pages <= 1 ) return; 

									$big = 999999999; // need an unlikely integer

									$pages = paginate_links( array(
									    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
									    'format' => '?paged=%#%',
									    'current' => max( 1, get_query_var('paged') ),
									    'total' => $wp_query->max_num_pages,
									    'prev_text' => esc_html__('Previous','hospital'),
									    'next_text' => esc_html__('Next','hospital'),
									    'type'  => 'array',
									) );
									if( is_array( $pages ) ) {
									$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
									    echo '<ul class="pagination">';
									        foreach ( $pages as $page ) {
									        echo "<li class='page-item'>$page</li>";
									        }
									    echo '</ul>';
									}
									}

									bittersweet_pagination();
									?> 
                                </ul>

                            </nav>
                        </div>
                    </div>
                    <div class="col-md-4 sideber-right">
                     <?php dynamic_sidebar('sidebar-1');?>

                    
                    </div>
             
                </div>
            </div>
        </div>
 <?php if($is_call_to_action){?>
        <div class="appointment text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $call_to_action  ;?></h2>
                    </div>
                </div>
            </div>
        </div> 
 <?php }?>        

<?php
get_footer();