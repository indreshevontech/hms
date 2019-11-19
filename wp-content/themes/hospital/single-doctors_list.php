<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hospital
 */

get_header();
$call_to_action        = defined('FW') ? fw_get_db_settings_option('call_to_action'):'';
?>
<?php 
if($post && preg_match( '/kc_row/', $post->post_content)){$vc_active = "true";}else{$vc_active = "false";}
if($vc_active == "true"){
     $margin = " yes-vc";
    $vc_row = "row ";
    
}else{
     $vc_row = "";
    $margin = " margint40 marginb40 no-vc";
}


$dr_image  = defined('FW') ? fw_get_db_settings_option('dr_image') : '';
$dr_image  = isset($dr_image['url']) ? $dr_image['url'] : '';

?>

 <div class="profile-header" style="margin-bottom:0px !important;">
            <div id="author-header">
                <img src="<?php echo esc_url($dr_image);?>" alt="">
            </div>
            <div class="author-text">
                <div class="container">
                    <div class="author-avatar">
                         <?php
                          while( have_posts() ) : the_post();
                    $doctor_name = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_name'): '';
               
                        ?>
                        <h2 class="author-name"><?php echo $doctor_name;?>
                             <?php 
                             $terms = get_the_terms( $post->ID , 'doctors_list_cat' );
                                foreach ( $terms as $term ) {
                                        $term_link = get_term_link( $term, 'doctors_list_cat' );?>
                                        <small>
                                        <?php echo  $term->name ?>
                               
                                      </small>
                                <?php } ?>
                        </h2>
                       
                        <div class="author-social-link">
                  
                            <?php dr_personal_social_icon();?>
                        </div>
           
                      <?php the_post_thumbnail();?>
                       <?php endwhile;?>
                    </div>
             
                </div>
            </div>
        </div>

<div class="container <?php echo esc_attr($margin); ?>">
<div class="<?php echo esc_attr($vc_row); ?>">
 <?php
 while( have_posts() ) : the_post();

        the_content();
 endwhile;
?>
</div>
</div>

  <div class="appointment text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php echo $call_to_action  ;?></h2>
                    </div>
                </div>
            </div>
        </div>        
<?php
get_footer();
