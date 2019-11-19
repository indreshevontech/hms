<?php 
/**
 *Template Name:Doctors
 */
get_header();
$call_to_action        = defined('FW') ? fw_get_db_settings_option('call_to_action'):'';
$is_title   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_title_bar') : 1;
$is_call_to_action   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_call_to_action') : 1;
$doctors_per_post   = defined('FW') ? fw_get_db_settings_option('breadcurb_per_post') : 12;
?>

        
<?php 
if($is_title){
hospital_title_bar();
}
?>
        <!-- /.Page header -->
        <!-- pb-70 -->
        <div class="doctor-list ">
            <div class="container">
                <section class="grid">
                    <?php
                       global $wp_query;
                       global $paged; 
                    $wp_query = new WP_Query(array(
                    'post_type' =>'doctors_list',
                    'posts_per_page' =>$doctors_per_post,
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

                    <div class="page-meta">
                       
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                             
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
                                echo '<ul class="pagination justify-content-center">';
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
                </section>
            </div>
        </div>
        <!-- /.doctor list -->

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