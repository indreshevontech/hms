<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hospital
 */

get_header();
$call_to_action        = defined('FW') ? fw_get_db_settings_option('call_to_action'):'';
$is_title   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_title_bar') : 1;
$is_call_to_action   = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'is_call_to_action') : 1;


if($post && preg_match( '/kc_row/', $post->post_content)){$vc_active = "true";}else{$vc_active = "false";}
if($vc_active == "true"){
     $margin = " yes-vc";
    $vc_row = "row ";
   
}else{
     $vc_row = "";
    $margin = " margint40 marginb40 no-vc";
}
?>

<?php 
if($is_title){
hospital_title_bar();
}
?>

<div class="blog-content <?php echo esc_attr($margin); ?>">
    <div class="<?php echo esc_attr($vc_row); ?>">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:','hospital'),
                'after'  => '</div>',
            ) );
            endwhile; endif;
           
            ?>
     





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
//get_sidebar();
get_footer();
