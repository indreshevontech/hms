<?php 
add_image_size('hospital_683x455', 683, 455 , true);
add_image_size('hospital_683x762', 683, 762 , true);
add_image_size( 'hospital_624x595', 540, 515, array( 'left', 'top' ) );
add_image_size('hospital_1100x475',1100, 475 , true);




function header_social_icon(){
       if(defined('FW')) {
        $header_facebook   = fw_get_db_settings_option('header_facebook');
        $header_twitter    = fw_get_db_settings_option('header_twitter');
        $header_instagram         = fw_get_db_settings_option('header_instagram');
        $header_dribbble  = fw_get_db_settings_option('header_dribbble');
        $header_skype      = fw_get_db_settings_option('header_skype');
        $header_more_social_links = fw_get_db_settings_option('header_more_social_links');
?>
         <ul>
            <li><a href="<?php echo esc_url($header_facebook);?>"><i class="fab fa-facebook"></i></a></li>
            <li><a href="<?php echo esc_url($header_twitter);?>"><i class="fab fa-twitter"></i></a></li>
            <li><a href="<?php echo esc_url($header_instagram);?>"><i class="fab fa-instagram"></i></a></li>
           
            <li><a href="<?php echo esc_url($header_dribbble);?>"><i class="fab fa-dribbble"></i></a></li>
            <li><a href="<?php echo esc_url($header_skype);?>"><i class="fab fa-skype"></i></a></li>
     
<?php 

 if(is_array($header_more_social_links)) {

            foreach ($header_more_social_links as $more_linkd) {
            	
                echo '<li><a href="'. esc_url($more_linkd['link']).'"><i class="fab  '.esc_attr($more_linkd['icon']).'"></i></a></li>
                      ';
            }
        }
}
?>
</ul>
<?php 
}

function hospital_title_bar(){
$blog_title = defined('FW') ? fw_get_db_settings_option('blog_title'):'';
$blog_subtitle = defined('FW') ? fw_get_db_settings_option('blog_subtitle'):'';
$blog_you_need_help = defined('FW') ? fw_get_db_settings_option('blog_you_need_help'):'';
$blog_you_need_help_phne = defined('FW') ? fw_get_db_settings_option('blog_you_need_help_phne'):'';
$blog_title_bg        = defined('FW') ? fw_get_db_settings_option('blog_title_bg'):'';
?>


        <div class="page-header">
            <div class="page-header-carousel owl-carousel owl-theme">
              <?php foreach ($blog_title_bg as $key => $value) {
                  $gallery_item= $value['attachment_id'];
                   $img = wp_get_attachment_image_src($gallery_item,'travel_850x395');
                    
                ?>
                <div class="carouselItem">
                    <div class="carousel-item-img" style="background-image: url(<?php echo $img[0];?>)"></div>
                </div>
               <?php }?>
             
            </div>
              <div class="page-header-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 d-none d-lg-block">
                            <a href="" class="carousel-item-content">
                                <?php if(!empty($blog_you_need_help)){?>
                                <h3><?php echo esc_html($blog_you_need_help);?></h3>
                                <?php } if(!empty($blog_you_need_help_phne)){?>
                                <div><?php echo esc_html($blog_you_need_help_phne);?></div>
                              <?php }?>
                            </a>
                        </div>
                        <div class="col-md-12 col-lg-9">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="header-text">
                                        <?php if(!empty($blog_title)){?>
                                        <h2><?php echo esc_html($blog_title);?></h2>
                                         <?php } if(!empty($blog_subtitle)){?>
                                        <p><?php echo esc_html($blog_subtitle);?></p>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <nav class="breadcrumbs">
                                       
                                             <?php custom_breadcrumbs();?>
                                       
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
        </div>

<?php 
}            


function dr_personal_social_icon(){
       if(defined('FW')) {
        $doctor_name = defined('FW') ? fw_get_db_post_option(get_the_ID(),'doctor_name'): '';
        $header_facebook   = fw_get_db_post_option(get_the_ID(),'facebooks');
        $header_twitter    = fw_get_db_post_option(get_the_ID(),'twitters');
        $header_dribbble  = fw_get_db_post_option(get_the_ID(),'linkedins');
        $header_skype      = fw_get_db_post_option(get_the_ID(),'skype');
        $header_youtubes     = fw_get_db_post_option(get_the_ID(),'youtubes');
        $header_more_social_links = fw_get_db_post_option(get_the_ID(),'more_social_linkss');
?>
         
            <a class="social-link" href="<?php echo esc_url($header_facebook);?>"><i class="fab fa-facebook"></i></a>
            <a class="social-link" href="<?php echo esc_url($header_twitter);?>"><i class="fab fa-twitter"></i></a>
            <a class="social-link" href="<?php echo esc_url($header_dribbble);?>"><i class="fab fa-dribbble"></i></a>
            <a class="social-link" href="<?php echo esc_url($header_skype);?>"><i class="fab fa-skype"></i></a>
            <a class="social-link" href="<?php echo esc_url($header_youtubes);?>"><i class="fab fa-youtube"></i></a>

     
<?php 

 if(is_array($header_more_social_links)) {

            foreach ($header_more_social_links as $more_linkd) {
                
                echo '<a class="social-link"  href="'. esc_url($more_linkd['link']).'"><i class="fab  '.esc_attr($more_linkd['icon']).'"></i></a>
                      ';
            }
        }
}
?>
<?php 
}

function dr_personal_social_icon2(){
       if(defined('FW')) {
        $doctor_name = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'doctor_name'): '';
        $header_facebook   = fw_get_db_post_option(get_the_ID(),'facebooks');
        $header_twitter    = fw_get_db_post_option(get_the_ID(),'twitters');
        $header_dribbble  = fw_get_db_post_option(get_the_ID(),'linkedins');
        $header_skype      = fw_get_db_post_option(get_the_ID(),'skype');
        $header_youtubes     = fw_get_db_post_option(get_the_ID(),'youtubes');
        $header_more_social_links = fw_get_db_post_option(get_the_ID(),'more_social_linkss');
?>
         
<ul class="member-social list-unstyled">
        <li><a href="<?php echo esc_url($header_facebook);?>"><i class="fab fa-facebook"></i></a></li>
        <li><a href="<?php echo esc_url($header_twitter);?>"><i class="fab fa-twitter"></i></a></li>
        <li><a href="<?php echo esc_url($header_skype);?>"><i class="fab fa-skype"></i></a></li>
</ul>
<?php 
}
}