<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hospital
 */

get_header();
?>





        <div class="blogContent">
              
            <div class="big-title">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <header class="contentHeader">
                                <h1><?php the_title(); ?> </h1>
                                <div class="metaInfo">
                                    <time datetime="2018-09-18 20:00"><?php the_time(get_option('date_format')) ?></time>
                                    <span>|</span>
                                    <span>
                                    <?php $categories = get_the_category();
                                    if ( ! empty( $categories ) ) {
                                        echo esc_html( $categories[0]->name);
                                    }?>

                                    
                                    </span> 


                                </div>

                            </header>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                    	<?php  while ( have_posts() ) : the_post();?>
                        <div class="drtailsText">
                            <figure class="figure">
                 
                       <?php the_post_thumbnail('hospital_1100x475',array('class'=>'figure-img img-fluid'));?>
                            </figure>

                            <?php the_content();?>
                                      <?php 

               ?>
                        </div>
                        <?php endwhile;?>
                        <!-- /.Blog details text -->
                        <div class="socialShare">
                            <ul class="list-unstyled">
                                <li class="shareTitle"><?php echo esc_html('Share this','hospital');?>:</li>
                                
                                <li><a href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="facebook"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://plus.google.com/share?url=<?php the_permalink() ?>" class="google-plus"><i class="fab fa-google-plus"></i></a></li>
                                <li><a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>" class="pinterest"><i class="fab fa-pinterest-p"></i></a></li>
                            </ul>
                        </div>
                        <!-- /.Social share -->
                    </div>
                </div>
                  

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="contentTitle"><?php echo esc_html('Related article','hospital');?></h3>
                        <div class="sep"></div>
                    </div>
                   <?php 

                    global $post;
                    
                  $wpb_all_query = new WP_Query(array('post_type'=>'department', 
                            'post_status'=>'publish',
                            'posts_per_page'=>3, // As per the post below you need to have a set number of posts.
                            'category__in' => wp_get_post_categories($post->ID),
                             'post__not_in' => array($post->ID) 
                            )); 


                   while ($wpb_all_query->have_posts()): $wpb_all_query->the_post();
                    $blog_read_more       = defined('FW') ? fw_get_db_settings_option('blog_read_more') :'';
                    $blog_excerpt       = defined('FW') ? fw_get_db_settings_option('blog_excerpt') :'';

                    ?>
                   
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <article class="grid-content">
                            <a href="<?php the_permalink();?>" class="img-link">
                             
                               <?php  the_post_thumbnail('hospital_683x455',array('class'=>'img-fluid')); ?>
                            </a>
                            <div class="textContent">
                                <div class="post-meta d-flex">
                                    <span class="date"><?php the_time(get_option('date_format')) ?></span>
                                    <span class="categories"><?php echo esc_html('In','hospital');?> 
                                    <?php $categories = get_the_category();
                                    if ( ! empty( $categories ) ) {
                                        echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                    }?>
                                   </span>
                                </div>
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <p><?php echo wp_trim_words(get_the_content(),20,'');?></p>
                                <a href="<?php the_permalink();?>" class="read-more"><?php echo esc_html($blog_read_more,'hospital');?> <i class="ti-arrow-right"></i></a>

                            </div>
                        </article>



                        <!-- /.Grid content -->
                    </div>
                <?php endwhile;wp_reset_query();?>
                
                </div>
                <!-- Related article -->
            </div>

        </div>

        
<?php
// get_sidebar();
get_footer();
