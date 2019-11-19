<?php
/**
 *Template Name:department
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hospital
 */
get_header();

$call_to_action        = defined('FW') ? fw_get_db_settings_option('call_to_action'):'';
$is_title   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_title_bar') : 1;
$is_call_to_action   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_call_to_action') : 1;
$dep_per_post        = defined('FW') ? fw_get_db_settings_option('dep_per_post'):12;

?>
<?php 
if($is_title){
hospital_title_bar();
}
?>

     <header class="headerContent">
            <div class="container">
                <div class="row">
<?php 
$taxonomyName = "department_cat";
$parent_terms = get_terms($taxonomyName, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));
                  
foreach ($parent_terms as $pterm) {
    $terms = get_terms($taxonomyName,array('parent' => $pterm->term_id, 'orderby' => 'slug',
     'hide_empty' => false
 ));
?>
                    <div class="col-sm-6 col-md-3">
                        <div class="catLink">
                            <h3 class="catLink-title"><?php echo $pterm->name;?></h3>
                            <ul class="list-unstyled">
                                <?php 
                                foreach ($terms as $term) {
                                ?>
                                <li><a href="<?php echo get_term_link( $term->name, $taxonomyName );?>"><?php echo $term->name;?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                <?php }?>
                  
                </div>
            </div>
        </header>

        <!-- /.Header -->

        <div class="department-list">
            <div class="container">
                <div id="masonry" class="row">

                    <?php 

                 $hotels = new WP_Query(array(
                    'post_type' =>'department',
                    'posts_per_page' =>$dep_per_post,
                     
                 ));


                 while ( $hotels->have_posts()) :  $hotels->the_post();
                   $terms = get_the_terms( $post->ID , 'department_cat' );

$icon     = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'sub_stuff'): '';

                    ?>
                    <div class="col-sm-6 col-md-6">
                        <a href="<?php the_permalink();?>" class="department-item">
                            <div class="img-container">
                               <?php echo get_the_post_thumbnail($post->ID, array(540, 530), array('class' => 'img-responsive'));?>
                            </div>
                            <div class="mask">
                                <div class="content">
                                    <?php 
                                    
                                    foreach ( $terms as $term ) {
                                            $term_link = get_term_link( $term, 'department_cat' );?>
                                           <h2>
                                            <!-- <a href="<?php echo esc_url($term_link);?>"> -->
                                            <?php echo  $term->name ?>
                                            <!-- </a> -->
                                        </h2>
                                        <?php } ?>

                                    <span><?php the_title();?><?php echo esc_html('…','hospital');?></span>
                                    <div class="svg-wrap">
                                        <svg width="28px" height="12px" viewBox="0 0 28 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g class="icon-arrow" transform="translate(-714.000000, -120.000000)" fill="#000000">
                                        <path d="M737.608907,124.700519 L734.322602,121.414214 L735.736815,120 L739.990251,124.253436 L740.001047,124.242641 L741.41526,125.656854 L741.404465,125.66765 L741.41526,125.678445 L740.001047,127.092659 L739.990251,127.081863 L735.736815,131.3353 L734.322602,129.921086 L737.543169,126.700519 L714,126.700519 L714,124.700519 L737.608907,124.700519 Z"></path>
                                        </g>
                                        </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="mask-icon"><i class="<?php echo $icon;?>"></i></div>
                        </a>
                    </div>
                 <?php endwhile;?>   

                </div>
            </div>
        </div>
        <!-- /.department list -->
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
