<?php
/**
 * Enqueue scripts and styles.
 */
function hospital_scripts() {

     
$main_font  = defined('FW') ? fw_get_db_settings_option('main_font') : '';
$main_ff    = isset($main_font['family']) ? esc_attr($main_font['family']) : 'Raleway';

$secondary_font = defined('FW') ? fw_get_db_settings_option('font2') : '';
$secondary_ff   = isset($secondary_font['family']) ? esc_attr($secondary_font['family']) : 'Nanum Myeongjo';
    function hospital_fonts_url() {

        $fonts_url = '';
        $fonts     = array();
        $subsets   = '';

        $main_font  = defined('FW') ? fw_get_db_settings_option('main_font') : '';
        $main_ff    = isset($main_font['family']) ? esc_attr($main_font['family']) : 'Raleway';

        $secondary_font = defined('FW') ? fw_get_db_settings_option('font2') : '';
        $secondary_ff   = isset($secondary_font['family']) ? esc_attr($secondary_font['family']) : 'Nanum Myeongjo';

        /* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== esc_html_x( 'on', esc_html($secondary_ff).' font: on or off','hospital' ) ) {
            $fonts[] = esc_html($secondary_ff).':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
        }

        /* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== esc_html_x( 'on', esc_html($main_ff).' font: on or off','hospital') ) {
            $fonts[] = esc_html($main_ff).':400,700,800';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }

   fw()->backend->option_type('icon-v2')->packs_loader->enqueue_frontend_css();
   wp_enqueue_style( 'theme-slug-fonts', hospital_fonts_url(),array(), null );

   wp_enqueue_style( 'hospital-style1',get_template_directory_uri().'/assets/vendor/bootstrap/css/bootstrap.min.css');
   wp_enqueue_style( 'hospital-style2',get_template_directory_uri().'/assets/css/animate.min.css');
  
   wp_enqueue_style( 'font-awesome',get_template_directory_uri().'/assets/vendor/fontawesome/css/all.min.css');
   wp_enqueue_style( 'hospital-style4',get_template_directory_uri().'/assets/vendor/themify-icons/themify-icons.min.css');  
   wp_enqueue_style( 'hospital-style5',get_template_directory_uri().'/assets/vendor/et-line-font/et-line.min.css');  
   wp_enqueue_style( 'hospital-style6',get_template_directory_uri().'/assets/vendor/metismenu/metisMenu.min.css');  

   wp_enqueue_style( 'hospital-style7',get_template_directory_uri().'/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css');  
   wp_enqueue_style( 'hospital-style8',get_template_directory_uri().'/assets/vendor/OwlCarousel2/dist/assets/owl.carousel.min.css'); 
   wp_enqueue_style( 'hospital-style9',get_template_directory_uri().'/assets/vendor/OwlCarousel2/dist/assets/owl.theme.default.min.css');
   wp_enqueue_style( 'hospital-style10',get_template_directory_uri().'/assets/vendor/select2/dist/css/select2.min.css');
   wp_enqueue_style( 'hospital-style11',get_template_directory_uri().'/assets/vendor/select2/dist/css/select2-bootstrap.min.css');
   wp_enqueue_style( 'hospital-style12',get_template_directory_uri().'/assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
   wp_enqueue_style( 'hospital-style13',get_template_directory_uri().'/assets/css/style.css');
   wp_enqueue_style( 'hospitalbd-root', get_stylesheet_uri() );


   

    wp_enqueue_script( 'hospital-navigation2', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '20151215', true );     

    wp_enqueue_script( 'hospital-navigation3', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js', array(), '20151215', true ); 

    wp_enqueue_script( 'hospital-navigation4', get_template_directory_uri() . '/assets/vendor/metismenu/metisMenu.min.js',array('jquery'), '20151215', true ); 
    wp_enqueue_script( 'hospital-navigation5', get_template_directory_uri() . '/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js',array('jquery'), '20151215', true ); 

    wp_enqueue_script( 'hospital-navigation6', get_template_directory_uri() . '/assets/vendor/OwlCarousel2/dist/owl.carousel.min.js',array('jquery'), '20151215', true );  
    wp_enqueue_script( 'hospital-navigation7', get_template_directory_uri() . '/assets/vendor/select2/dist/js/select2.min.js',array('jquery'), '20151215', true );  
    wp_enqueue_script( 'hospital-navigation8', get_template_directory_uri() . '/assets/vendor/masonry/dist/masonry.pkgd.min.js',array('jquery'), '20151215', true ); 
    wp_enqueue_script( 'hospital-navigation9', get_template_directory_uri() . '/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',array('jquery'), '20151215', true );
    wp_enqueue_script( 'hospital-navigation10', get_template_directory_uri() . '/assets/js/file-upload.js',array('jquery'), '20151215', true );
    wp_enqueue_script( 'hospital-navigation11', get_template_directory_uri() . '/assets/js/jquery.easing.min.js',array('jquery'), '20151215', true );
    wp_enqueue_script( 'hospital-navigation12', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '20151215', true );


    $main_font = fw_get_db_settings_option('main_font');
    $main_ff = isset($main_font['family']) ? esc_attr($main_font['family']) : 'Raleway';
    



    $page_ptop = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'page_ptop') : '70px';
    $page_pbtm = defined('FW') ? fw_get_db_post_option(get_the_ID(), 'page_pbtm') : '40px';

    $accent_color = defined('FW') ? fw_get_db_settings_option('accent_color') : '';
    $button_color = defined('FW') ? fw_get_db_settings_option('button_color') : '';
    $header_1 = defined('FW') ? fw_get_db_settings_option('header_1') : '';
    $header_4 = defined('FW') ? fw_get_db_settings_option('header_4') : '';
    $mobile_menu = defined('FW') ? fw_get_db_settings_option('mobile_menu') : '';


function hex2rgb($accent_color ) {
        if ( $accent_color[0] == '#' ) {
                $accent_color = substr( $accent_color, 1 );
        }
        if ( strlen( $accent_color ) == 6 ) {
                list( $r, $g, $b ) = array( $accent_color[0] . $accent_color[1], $accent_color[2] . $accent_color[3], $accent_color[4] . $accent_color[5] );
        } elseif ( strlen( $accent_color ) == 3 ) {
                list( $r, $g, $b ) = array( $accent_color[0] . $accent_color[0], $accent_color[1] . $accent_color[1], $accent_color[2] . $accent_color[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
$value=hex2rgb($accent_color );
$rgb=$value['red'].','.$value['green'].','.$value['blue'];

      
     $dynamic_css='';
     $dynamic_css .= '
                    body{
                        font-family: \''.esc_attr($main_ff).'\', sans-serif;
                    }
                    .testimonial .description,.text-block .quote-text p,a.appointment-link{
                     font-family: \''.$secondary_ff.'\', serif;
                     }
                     .blog-content{
                         padding:'.esc_attr($page_ptop).' 0 '.esc_attr($page_pbtm).';
                     }
                    
                     .service-list {
                          padding: '.esc_attr($page_ptop).'  '.esc_attr($page_pbtm).';
                      }
                      .doctor-list {
                          padding: '.esc_attr($page_ptop).' 0 '.esc_attr($page_pbtm).';
                      }
                      .department-list{
                           padding:'.esc_attr($page_ptop).' 0 '.esc_attr($page_pbtm).';
                      }
                    .appointment,.navbar-nav .nav-btn .nav-link,.navbar-nav .nav-btn .nav-link::before, .navbar-nav .nav-btn .nav-link::after,.btn-top,.page-header,.catLink .catLink-title::before,.load_more a:hover,.load_more a,.btn-link:hover,.navbar .dropdown-menu,.btn-primary,.text-block .heading-sm::before,.contactCard,a.read-link::before,.member-social,.page-item.active .page-link,.testimonial2,.partners-content,.footer-dark .addressLink ul li a.linkUnderlined:hover,.read-more,.read-more:hover, .btn-primary:hover,.progress-bullets .bullet.fill,.timeline-icon i,.main-timeline .timeline:before,.main-timeline .timeline-content::after{
                        background-color:'.esc_attr( $accent_color).';
                    }
                    
                   .main-timeline .timeline-icon::before{
                    content: "";
                    width: 100px;
                    height: 4px;
                    background:'.esc_attr( $accent_color).';
                    position: absolute;
                    top: 50%;
                    right: -100px;
                    transform: translateY(-50%);
                    }

                    .animation-slide.owl-theme .owl-nav [class*="owl-"]{
                          box-shadow: 0px 0 0 '.esc_attr( $accent_color).' inset;
                    }
                    .animation-slide.owl-theme .owl-nav .owl-prev:hover {
                        box-shadow: 100px 0 0 '.esc_attr( $accent_color).' inset;
                    }
                   .animation-slide.owl-theme .owl-nav .owl-next:hover {
                         -webkit-box-shadow: -100px 0 0 '.esc_attr( $accent_color).' inset; 
                    }
                    .catLink .catLink-title::after{
                      background-color: rgba('.esc_attr($rgb).',.3);
                    }


                    
                    #animation-slide .item::after,#author-header::after{
                        background: linear-gradient(to right, rgba('.esc_attr($rgb).', 0.9), rgba(0, 24, 49, 0));
                  }
                    .carousel-item-img::after{
                          background-image: linear-gradient(36deg,rgba('.esc_attr($rgb).',0.7) 20%,'.esc_attr( $accent_color).' 90%);
                    }
                    
                    .form-control:hover{
                          -webkit-box-shadow: 0 0 2px '.esc_attr($accent_color).';
                          box-shadow: 0 0 2px '.esc_attr($accent_color).';
                    }

                    .helpInfo .icon i,.navbar-nav .active .nav-link,.catLink ul li a:hover,.post-meta .categories a,.textContent h3 a:hover,.contentHeader h1,.contact-service i,.text-block .heading-sm,.grid__item:hover .title, .grid__item:hover .dr-name,a.read-link,.page-link:hover,.box-icon i,.page-link,.owl-testimonial.owl-theme .owl-nav [class*="owl-"]:hover,.main-timeline .timeline-icon i,.main-timeline .title{
                       color:'.esc_attr( $accent_color).'!important;
                    }

                   .grid__item:hover::before, .grid__item:focus::before,.main-timeline .timeline-icon{
                     border: 3px solid '.esc_attr( $accent_color).'!important;
                   }
                   .main-timeline .timeline-content::before{
                      content: "";
                      width: 70%;
                      height: 100%;
                      border: 3px solid '.esc_attr( $accent_color).';
                      border-top: none;
                      border-right: none;
                      position: absolute;
                      bottom: -13px;
                      left: 35px;
                     }
                   .appointment-text h1,.appointment-text h3,.alert-success{
                     color:'.esc_attr($header_1).'!important;
                  }

                  .btn-link:hover,.footer-dark .addressLink ul li a.linkUnderlined:hover,.btn-primary,.load_more a,.page-item.active .page-link,.btn-primary,.form-control:hover, .form-control:focus{
                      border-color: '.esc_attr( $accent_color).'!important;
                  }

                   .read-more:hover {
                    background-color:'.esc_attr($button_color).';
                    color: #fff;
                }

                #sidebar,.dropdown-menu{
                 
                     background:'.esc_html($mobile_menu).';
                }
                  

                  .meta__email{
                    border-bottom: 1px solid #037d71;
                  }


                  .quotes-marks svg{
                    fill:'.esc_attr($header_4).';
                  }

                  
                  .btn-top:hover,.text-content .btn-link,.icon-box,.slide-tablecell .slide-btn{
                    background-color:'.esc_attr($header_4).';
                  }
                  ';



   wp_add_inline_style('hospital-style13', $dynamic_css);


   wp_enqueue_script( 'popper',  get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '1.1', true );     

   wp_enqueue_script( 'bootstrap',  get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js', array('jquery'), '1.1', true );     

   wp_enqueue_script( 'metisMenu',  get_template_directory_uri() . '/assets/vendor/metismenu/metisMenu.min.js', array('jquery'), '1.1', true );

   wp_enqueue_script( 'malihu',  get_template_directory_uri() . '/assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '1.1', true ); 

   wp_enqueue_script( 'ow-carousel',  get_template_directory_uri() . '/assets/vendor/OwlCarousel2/dist/owl.carousel.min.js', array('jquery'), '1.1', true );

   wp_enqueue_script( 'select2-min',  get_template_directory_uri() . '/assets/vendor/select2/dist/js/select2.min.js', array('jquery'), '1.1', true );  

    wp_enqueue_script( 'masonry',  get_template_directory_uri() . '/assets/vendor/masonry/dist/masonry.pkgd.min.js', array('jquery'), '1.1', true );    

 wp_enqueue_script( 'date-picker',  get_template_directory_uri() . '/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', array('jquery'), '1.1', true );  

  wp_enqueue_script( 'file-upload',  get_template_directory_uri() . '/assets/js/file-upload.js', array('jquery'), '1.1', true );     

  wp_enqueue_script( 'easing-js',  get_template_directory_uri() . '/assets/js/jquery.easing.min.js', array('jquery'), '1.1', true ); 

  wp_enqueue_script( 'custom-js', get_template_directory_uri(). '/assets/js/script.js', array('jquery'), '1.1', true );    

	wp_enqueue_script( 'hospital-navigation13', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'hospital-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hospital_scripts' );


add_action('admin_enqueue_scripts', function($hook) {
 wp_enqueue_script('thb-admin-meta',get_template_directory_uri() .'/assets/js/admin-meta.min.js', array('jquery'));
});


