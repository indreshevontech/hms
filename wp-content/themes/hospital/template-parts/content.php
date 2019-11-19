<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hospital
 */

$blog_read_more       = defined('FW') ? fw_get_db_settings_option('blog_read_more') :'';
$blog_excerpt       = defined('FW') ? fw_get_db_settings_option('blog_excerpt') :'';
?>


<div   class="col-sm-6 col-md-4">
    <article class="grid-content">
        
        <a href="<?php the_permalink();?>" class="img-link">
            <?php 
            the_post_thumbnail('hospital_683x455',array('class'=>'img-fluid')); 
            
             ?>
        </a>
        <div class="textContent">
            <div class="post-meta d-flex">
                <span class="date"><?php the_time(get_option('date_format')) ?></span>
                <span class="categories"><?php echo esc_html('In','hospital');?>  
                <?php 
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                }?>
                                    
                </span>
            </div>
            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
            <p><?php echo wp_trim_words(get_the_content(),$blog_excerpt,'');?></p>
            <a href="<?php the_permalink();?>" class="read-more"><?php echo esc_html($blog_read_more,'hospital');?> <i class="ti-arrow-right"></i></a>
        </div>
    </article>
    <!-- /.Grid content -->
</div>
                           

                         
