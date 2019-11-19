<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hospital
 */



get_header();
$blog_title_bg        = defined('FW') ? fw_get_db_settings_option('blog_title_bg'):'';
$breadcurb        = defined('FW') ? fw_get_db_settings_option('breadcurb'):1;
if($breadcurb){
  hospital_title_bar();
}

?>
        <!-- /.Page header -->
        <div class="blog-content" style="padding:70px 0px 40px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <div id="sobuj">
                        <?php if (have_posts()) : ?>
                        <div id="masonry" class="row">
                             
                            
                            <?php 
                           $i=0;
                            while (have_posts()) : the_post(); ?>
                              
                              <?php get_template_part(  'template-parts/content', get_post_format() );?>
                            
                            <?php 
                           
                          endwhile; ?>
                           
                        </div>
                          
                        <?php endif;  ?>

                    </div>
                      <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                            
                        <div class="row">
                                <div class="col-md-12 text-center load_more">
                              
                                      <?php next_posts_link( 'Load More' ); ?>
                                </div>
                        </div>

                      <?php endif;  ?>

                    </div>
                </div>
            </div>
        </div>


  <script type="text/javascript">
      jQuery(document).ready(function(){
          jQuery('.load_more a').on('click', function(e){
              e.preventDefault();
              var link = jQuery(this).attr('href');
              jQuery('.load_more').html('<span class="loader ">Loading More Posts...</span>');
              jQuery.get(link, function(data) {
                  var post = jQuery("#masonry", data);
                  jQuery('#sobuj').append(post);
              });
              jQuery('.load_more').load(link+' .load_more a');
          });
      });
</script>



<?php 
get_footer();