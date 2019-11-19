<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hospital
 */



get_header();
$breadcurb        = defined('FW') ? fw_get_db_settings_option('breadcurb'):1;
?>

<?php
if($breadcurb){
  hospital_title_bar();
}
?>
        <div class="blogContent">
            <div class="container">
                <div class="row">
                   <div class="col-md-10">
                        <div class="header-text" style="color:red;">
                            <h2><?php echo esc_html_e( 'Oops! That page can&rsquo;t be found.404 Error','hospital'); ?></h2>
                            <p><?php echo esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?','hospital'); ?></p>
                             <a href="<?php echo esc_url(home_url('/')); ?>"> <button type="button" class="btn btn-primary"> <?php echo esc_html__('Back Home','hospital'); ?> </button> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>		
	

<?php
get_footer();
