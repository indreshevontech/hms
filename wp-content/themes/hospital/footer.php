<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hospital
 */

$copyright_text = defined('FW') ? fw_get_db_settings_option('copyright_text') :'';
?>
        <footer class="main-footer footer-dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                        <?php dynamic_sidebar('footer_widgets');?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.Footer -->
        <div class="sub-footer dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <?php if(!empty($copyright_text)){?>
                        <div class="coptText">
                            <?php echo esc_html($copyright_text);?> 
                        </div>
                       <?php }?>
                    </div>
                </div>
            </div>
        </div>

<?php wp_footer(); ?>


</body>
</html>
