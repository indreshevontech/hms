<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hospital
 */
$main_logo  = defined('FW') ? fw_get_db_settings_option('main_logo') : '';
$main_logo  = isset($main_logo['url']) ? $main_logo['url'] : '';
$favicon = defined('FW') ? fw_get_db_settings_option('favicon', HOSPITAL_DIR_IMG . '/favicon.png') : '';
$favicon = isset($favicon['url']) ? $favicon['url'] : HOSPITAL_DIR_IMG . '/favicon.png';
$is_top_menu        = defined('FW') ? fw_get_db_settings_option('is_top_menu') : 1;


$hospital_phone        = defined('FW') ? fw_get_db_settings_option('hospital_phone'):'';
$hospital_email        = defined('FW') ? fw_get_db_settings_option('hospital_email'):'';

$hospital_open_info = defined('FW') ? fw_get_db_settings_option('hospital_open_info'):'';
$hospital_close_info = defined('FW') ? fw_get_db_settings_option('hospital_close_info'):'';
$hospital_contact_info = defined('FW') ? fw_get_db_settings_option('hospital_contact_info'):'';
$hospital_contact_level = defined('FW') ? fw_get_db_settings_option('hospital_contact_level'):'';
$hospital_road_name = defined('FW') ? fw_get_db_settings_option('hospital_road_name'):'';
$hospital_city_name = defined('FW') ? fw_get_db_settings_option('hospital_city_name'):'';
$hospital_menu_appoin = defined('FW') ? fw_get_db_settings_option('hospital_menu_appoin'):'';
$hospital_menu_ap_link = defined('FW') ? fw_get_db_settings_option('hospital_menu_ap_link'):'';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- Required meta tags -->
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {  ?>
        <link rel="shortcut icon" href="<?php echo esc_url($favicon);?>">
        <?php }?>
         
        <?php wp_head();?>
        
    </head>
    <body <?php body_class();?>>
        <header class="mainHeader">
             <?php if($is_top_menu==1) { ?>
            <div class="topBar">
                <div class="container">
                    <div class="d-flex justify-content-between">
                        <div class="info-outer d-flex align-items-center">
                            <div class="info-box d-none d-md-block">
                                <div class="icon"><span class="icon-envelope "></span></div>
                                <?php if($hospital_email){?>
                                <a href="mailt:companyname@mail.com"><?php echo esc_html($hospital_email);?></a>
                                <?php }?>
                            </div>
                            <div class="info-box">
                                <div class="icon"><span class="icon-mobile"></span></div>
                                 <?php if($hospital_phone){?>
                                <a class="phone" href="#"><?php echo esc_html($hospital_phone);?></a>
                                <?php }?>
                            </div>
                        </div>
                        <div class="social">
                           <?php  header_social_icon();?>
                        </div>
                       
                    </div>
                </div>
            </div>
            <?php }?>
            <!-- /.Top bar -->
            <div class="middBar">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-lg-3 col-xl-4">
                            <div class="d-flex align-items-center logo-wrap">
                                <div class="main-logo">
                                    <?php if(!empty($main_logo)){?>
                                    <a href="<?php echo esc_url(home_url('/'));?>" class="headerLogo"><img src="<?php echo esc_url($main_logo);?>" alt="logo"></a>
                                    <?php }?>
                                </div>
                                <div class="order-md-first sidebar-toggle-btn">
                                    <button type="button" id="sidebarCollapse" class="btn">
                                        <i class="ti-menu"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9 col-xl-8 d-none d-md-block">
                            <div class="d-flex justify-content-end">
                                <div class="media helpInfo">
                                    <div class="icon"><i class="icon-clock "></i></div>
                                    <div class="media-body">
                                        <?php if(!empty($hospital_open_info)){?>
                                        <h6 class="mb-0 helpInfo-title"><?php echo esc_html($hospital_open_info); ?></h6>
                                       <?php }?>
                                        <?php if(!empty($hospital_close_info)){?>
                                        <p class="subText"><?php echo esc_html($hospital_close_info);?></p>
                                       <?php }?>
                                    </div>
                                </div>
                                <div class="media helpInfo">
                                    <div class="icon"><i class="icon-mobile"></i></div>
                                    <div class="media-body">
                                        <?php if(!empty($hospital_contact_info)){?>
                                        <h6 class="mb-0"><?php echo esc_html($hospital_contact_info);?></h6>
                                        <?php }?>
                                        <?php if(!empty($hospital_contact_level)){?>
                                        <p class="subText"><?php echo esc_html($hospital_contact_level);?></p>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="media helpInfo">
                                    <div class="icon"><i class="icon-map-pin "></i></div>
                                    <div class="media-body">
                                        <?php if(!empty($hospital_road_name)){?>
                                        <h6 class="mb-0"><?php echo esc_html($hospital_road_name);?></h6>
                                        <?php }?>
                                        <?php if(!empty($hospital_city_name)){?>
                                        <p class="subText"><?php echo esc_html($hospital_city_name);?></p>
                                       <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.Middle bar -->
            <nav class="navbar navbar-expand-lg d-none d-lg-block header-sticky">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                      
                    <?php
                       wp_nav_menu([
                         'menu'            => 'menu-1',
                         'theme_location'  => 'menu-1',
                         'container'       => false,
                         'container_id'    => false,
                         'container_class' => false,
                         'menu_id'         => false,
                         'menu_class'      => 'navbar-nav mr-auto',
                         'depth' => 4,
                         'fallback_cb'     => 'bs4navwalker::fallback',
                         'walker'          => new bs4navwalker()
                       ]);
                       ?>
                       
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item nav-btn">
                                <a class="nav-link js-scroll-trigger" href="<?php echo esc_url($hospital_menu_ap_link);?>"><i class="icon-calendar"></i><?php echo esc_html($hospital_menu_appoin);?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /. Navbar -->
            <nav id="sidebar" class="sidebar-nav  side-mobile">
                <div id="dismiss">
                    <i class="ti-arrow-right"></i>
                </div>
              
                <?php
                       wp_nav_menu([
                         'menu'            => 'menu-1',
                         'theme_location'  => 'menu-1',
                         'container'       => false,
                         'container_id'    => false,
                         'container_class' => false,
                         // 'menu_id'         => 'mobile-menu',
                         'menu_class'      => 'metismenu list-unstyled',
                         'depth' => 4,
                         'fallback_cb'     => 'bs4navwalker::fallback',
                         'walker'          => new bs4navwalker()
                       ]);
                       ?>
            </nav>
            <div class="overlays"></div>
            <!-- /.End of mobile menu side bar -->
        </header>
        <!-- /.Main header -->

