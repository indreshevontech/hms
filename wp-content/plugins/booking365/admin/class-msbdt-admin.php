<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://scheduler.bdtask.com/
 * @since      1.0.0
 *
 * @package    Msbdt
 * @subpackage Msbdt/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Msbdt
 * @subpackage Msbdt/admin
 * @author     bdtask <bdtask@gmail.com>
 */
class Msbdt_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		
		add_action( 'admin_init',array($this,'msbdt_dependence_loader')  ) ;
		add_action( 'admin_menu',array($this,'msbdt_page_creater')  ) ;
    add_action( 'admin_menu',array($this,'msbdt_setting_api')  ) ;
		
		
		
		if ( ! wp_next_scheduled( 'msbdt_add_every_three_minutes' ) ) {
                   wp_schedule_event( time(), 'every_three_minutes', 'msbdt_add_every_three_minutes' );
                }

               add_filter( 'cron_schedules', array($this ,'msbdt_add_every_three_minutes' ) );
               add_action( 'msbdt_add_every_three_minutes', array($this , 'every_three_minutes_event_func' ) );

	    }
	
	
       public function msbdt_add_every_three_minutes( $schedules ) {
            $schedules['every_three_minutes'] = array(
            'interval'  => 180,
            'display'   => __( 'Every 3 Minutes', 'textdomain' )
            );
              return $schedules;
        }

       public function every_three_minutes_event_func() {

       global $wpdb;         
	     $table_scheduler = $wpdb->prefix .'msbdt_scheduler'; 
	     $table_booking = $wpdb->prefix .'msbdt_booking';
	     $table_remainder = $wpdb->prefix .'msbdt_remainder';
	     $table_professional = $wpdb->prefix .'msbdt_professional';
	     $table_location = $wpdb->prefix .'msbdt_location';
	     $table_template = $wpdb->prefix.'msbdt_template';   
	

	     $applicants_query  = "SELECT * FROM  $table_booking   WHERE  status='5' "; 
	     $applicants = $wpdb->get_results($applicants_query , OBJECT ) ; 
	     $applicants_count_row = count($applicants);
	     $applicants_info = array();       
	     $index = 0 ;
	       
	     for ( $index=0; $index < $applicants_count_row ; $index++){  
	     
	                $sender_template = get_option( 'sender_template' );
	                $remainder_query  = "SELECT * FROM  $table_remainder WHERE temp_id = $sender_template "; 
                    $remainder = $wpdb->get_row($remainder_query);  
                    
                    $pro_query  = "SELECT * FROM  $table_professional   WHERE pro_id = '".$applicants[$index]->pro_id."'"; 
                    $professional = $wpdb->get_row($pro_query);
                    
                    $loc_query  = "SELECT * FROM  $table_location   WHERE loc_id = '".$applicants[$index]->loc_id."'"; 
                    $location = $wpdb->get_row($loc_query);
                    
                    $sender_template_id = get_option( 'sender_template' ); // intiger value
                    $sender_template_query  = "SELECT * FROM  $table_template  WHERE temp_id = '".$sender_template_id."' ";       
                    $sender_template_object = $wpdb->get_row($sender_template_query); 
                    $template = $sender_template_object->template;
                    // for  template data htmlentities
                    $template  = html_entity_decode ($template);
                    // for style
                    $template  = str_replace("\\"," ",$template);
                    
                    $professional_name = $professional->fname .' '.$professional->lname;
                    
                    // date & time
                    $applicant_date_time_str = $applicants[$index]->date.' '.$applicants[$index]->start_time ;
                    $sending_date_time_int   =  strtotime( $applicant_date_time_str ) - (86400 * $remainder->day);
                    $sending_date_time_int   =  $sending_date_time_int - (3600 * $remainder->hour);
                    $sending_date_time_int   =  $sending_date_time_int - (60 * $remainder->minute);
                    $sending_date_time_str   =  date("Y-m-d H:i:s" ,  $sending_date_time_int ) ;
                    
                    
                    // template
                    $template = str_replace("{applicant}", $applicants[$index]->name , $template);
                    $template = str_replace("{professional}",  $professional_name , $template);                   
                    $template = str_replace("{applicant_id}", $applicants[$index]->id , $template);                  
                    $template = str_replace("{date}", $applicant_date_time_str , $template); 
                    
                    // mail setup 
		        $sender = get_option( 'sender_email' );
				    $to = $applicants[$index]->email; 
				    $subject =  $sender_template_object->subject; 
				    $message =  $template; 
				    $headers = 'From:'.$sender. "\r\n" . 
				               'Reply-To:'.$sender. "\r\n" .
				               'Content-type: text/html; charset=UTF-8' . "\r\n".  
				               'X-Mailer: PHP/' . phpversion();
		               
		               
			      // condition check 
			          $current_time_int = strtotime("now") ;
	              // $current_time_max_int is 30 minute added than current_time_int.
	              $current_time_max_int = strtotime("now") + (30*60) ; 
	              if(( $sending_date_time_int >= $current_time_int ) 
	              && ( $sending_date_time_int <= $current_time_max_int )){ 
	              wp_mail( $to, $subject,  $message, $headers ); 
                 }
	       }// end for         
        }



public static function msbdt_email_sender_with_action($id = null , $status = null) {           
global $wpdb;         
 $table_scheduler = $wpdb->prefix .'msbdt_scheduler'; 
 $table_booking = $wpdb->prefix .'msbdt_booking';
 $table_remainder = $wpdb->prefix .'msbdt_remainder';
 $table_professional = $wpdb->prefix .'msbdt_professional';
 $table_service = $wpdb->prefix .'msbdt_service';
 $table_template = $wpdb->prefix.'msbdt_template';   


 if( $status == '5' ) :       
 $sender_template = get_option( 'sender_approved_template' );	            
 elseif( $status == '4' ):        
 $sender_template = get_option( 'sender_requested_template' );
 elseif( $status == '6' ):
 $sender_template = get_option( 'sender_rejected_template' ); 
 else :	
 return ;     
 endif;

 
 $applicants_query  = "SELECT * FROM  {$table_booking}  
                               WHERE  id = {$id}  AND status = {$status} ";
 $applicant = $wpdb->get_row($applicants_query) ;


 $template_query  = "SELECT * FROM  {$table_template} 
                              WHERE temp_id = {$sender_template} ";	      
 $get_template = $wpdb->get_row($template_query); 
 
 $pro_query  = "SELECT * FROM  {$table_professional}   
                         WHERE pro_id = {$applicant->pro_id} " ; 

 $professional = $wpdb->get_row($pro_query); 

 $ser_query  = "SELECT * FROM  {$table_service}   
                         WHERE ser_id = {$applicant->ser_id}"; 

 $service    = $wpdb->get_row($ser_query);
 $template   = $get_template->template;

 
 // for  template data htmlentities
 $template  = html_entity_decode ($template);
 // for style
 $template  = str_replace("\\"," ",$template);



 $professional_name = $professional->fname .' '.$professional->lname;
 // date & time
 $applicant_date_time_str = $applicant->date.' '.$applicant->start_time ;
    
    // template
  $template = str_replace("{applicant}", $applicant->name , $template);
  $template = str_replace("{professional}",  $professional_name , $template);                   
  $template = str_replace("{applicant_id}", $applicant->id , $template);                  
  $template = str_replace("{date}", $applicant_date_time_str , $template);          
	       
  $link = get_site_url().'/wp-admin/admin.php?page=msbdt_appointment' ;
	           
	   // set mail  
	    $sender = get_option('sender_email');
		  $to = $applicant->email; 
		  $subject =  $get_template->subject; 
		  $message =  $template; 
		  $headers = 'From:<'.$sender.'>'. "\r\n" . 
		               'Reply-To:'.$sender. "\r\n" .
		               'Content-type: text/html; charset=UTF-8' . "\r\n".  
		               'X-Mailer: PHP/' . phpversion();

	       if(mail( $to, $subject,  $message, $headers )) :
                  if(is_admin()): ?>
                      <script>
                      window.location.replace('<?php echo $link ; ?>');
                      </script> 
                 <?php endif ; ?>
	       <?php endif ;
                
	            
      }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Msbdt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Msbdt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        
      global $pagenow, $current_screen;
      $page = (isset($_REQUEST['page'])) ? sanitize_text_field( $_REQUEST['page']) : '' ;    
      if(  is_admin() && 
        ( $page == 'msbdt_appointment' ||
  	      $page == 'msbdt_report'      ||
  	      $page == 'msbdt_schedule'    ||
  	      $page == 'msbdt_category'    ||
  	      $page == 'msbdt_professional'||
  	      $page == 'msbdt_service'     ||
  	      $page == 'msbdt_email_notification'||
  	      $page == 'msbdt_setting'  ) ){

       wp_enqueue_style( 'wp-color-picker' );
       wp_enqueue_media();      
	     wp_enqueue_style( 'msbdt-bootstrap-style',
                           plugin_dir_url( __FILE__ ) . 'css/msbdt-bootstrap.css', 
                           array(), $this->version, 'all' );

        wp_enqueue_style( 'msbdt-ui-style',
                           plugin_dir_url( __FILE__ ).'css/msbdt-ui.css', 
                           array(), $this->version, 'all' );

        wp_enqueue_style( 'msbdt-bootstrap-toggle.min-style',
                           plugin_dir_url( __FILE__ ).'css/msbdt-bootstrap-toggle.min.css', 
                           array(), $this->version, 'all' );  
         
        wp_enqueue_style( 'msbdt-dataTables.min-style',
                           plugin_dir_url( __FILE__ ).'css/msbdt-dataTables.min.css', 
                           array(), $this->version, 'all' );
         
        wp_enqueue_style( 'msbdt-ui-timepiker-style',
                           plugin_dir_url( __FILE__ ).'css/msbdt-timepiker-ui.css', 
                           array(), $this->version, 'all' ); 

        wp_enqueue_style('msbdt-ptTimeSelect-style',
                           plugin_dir_url( __FILE__ ).'css/msbdt-ptTimeSelect.css', 
                           array(), $this->version, 'all' );   

		   wp_enqueue_style( $this->plugin_name, 
			               plugin_dir_url( __FILE__ ) . 'css/msbdt-admin.css', 
			               array(), $this->version, 'all' );

        if( isset($_REQUEST['page']) && $_REQUEST['page']=='msbdt_schedule'):
         wp_enqueue_style('msbdt-mdp',
                            plugin_dir_url( __FILE__ ).'css/msbdt-mdp.css', 
                            array(), $this->version, 'all' );
        endif ;

       }

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Msbdt_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Msbdt_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

      global $pagenow, $current_screen;
      $page = (isset($_REQUEST['page'])) ? sanitize_text_field( $_REQUEST['page']) : '' ;    
      if(  is_admin() && 
        ( $page == 'msbdt_appointment' ||
  	      $page == 'msbdt_report'      ||
  	      $page == 'msbdt_schedule'    ||
  	      $page == 'msbdt_professional'||
  	      $page == 'msbdt_category'    ||
  	      $page == 'msbdt_service'     ||
  	      $page == 'msbdt_email_notification'||
  	      $page == 'msbdt_setting'  ) ){

        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core'); 
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script( 'msbdt-ui',
        	                plugin_dir_url( __FILE__ ).'js/msbdt-ui.js' );

        wp_enqueue_script( 'msbdt_bootstrap-min', 
                            plugin_dir_url( __FILE__ ).'js/msbdt-bootstrap.min.js',
                            array( 'jquery' ), $this->version,false );

        wp_enqueue_script( 'msbdt-bootstrap-toggle.min', 
                            plugin_dir_url( __FILE__ ).'js/msbdt-bootstrap-toggle.min.js',
                            array( 'jquery' ), $this->version,false );

        wp_enqueue_script( 'msbdt-jquery.slimscroll.min', 
                            plugin_dir_url( __FILE__ ).'js/msbdt-jquery.slimscroll.min.js',
                            array( 'jquery' ), $this->version,false );
        
        wp_enqueue_script( 'msbdt-dataTables.min', 
                            plugin_dir_url( __FILE__ ).'js/msbdt-dataTables.min.js',
                            array( 'jquery' ), $this->version,false );

        wp_enqueue_script( 'msbdt-multidatespicker',
                            plugin_dir_url( __FILE__ ).'js/msbdt-multidatespicker.js', 
                            array( 'jquery' ), $this->version,false );

        wp_enqueue_script( 'msbdt-ptTimeSelect',
                            plugin_dir_url( __FILE__ ).'js/msbdt-ptTimeSelect.js', 
                            array( 'jquery' ), $this->version,false );

        wp_enqueue_script( 'msbdt-setting', 
                            plugin_dir_url( __FILE__ ).'js/msbdt-setting.js', 
                            array( 'jquery' ), $this->version,false );

        
        wp_enqueue_script( 'colorpiker',
                            plugin_dir_url( __FILE__ ).'js/msbdt-colorpiker.js', 
                             array( 'wp-color-picker' ), false, true ); 

		wp_enqueue_script( $this->plugin_name, 
			                      plugin_dir_url( __FILE__ ) . 'js/msbdt-admin.js', 
			                      array( 'jquery' ), $this->version, false );
		}

	}

  public function msbdt_dependence_loader(){
    require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-booking-query.php';
    require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-category-query.php';
    require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-service-query.php';
    require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-professional-query.php';
    require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-pagenation-query.php';
    require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-time-slote-query.php';
    require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-email-query.php';
    require_once plugin_dir_path( __FILE__ ) . 'asset/msbdt-custom-admin-style-class.php';
    
  }
  
	public function msbdt_define_page(){
		
		$parents = array(
			            array(
			           'page_title'  => 'appointment',              //$parent_slug
						     'menu_title'  => 'Booking365',          //$page_title
						     'capability'  => 'manage_options',           //$capability
						     'menu_slug'   => 'msbdt_appointment',              //$menu_title
						     'dashicons'   => 'dashicons-calendar-alt'    //$dashicons
			            ));

		 return $parents ;

	}

	public function msbdt_define_subpage(){

		$parents = array(
			            array(
			           'parent_slug' => 'msbdt_appointment',     //$parent_slug
						     'page_title'  => 'Appointment',     //$page_title
						     'menu_title'  => 'Appointment',     //$menu_title
						     'capability'  => 'manage_options',  //$capability
						     'menu_slug'   => 'msbdt_appointment', 
			            ),
		           
			           array(
			           'parent_slug' => 'msbdt_appointment',    //$parent_slug
						     'page_title'  => 'Report',       //$page_title
						     'menu_title'  => 'Report',       //$menu_title
						     'capability'  => 'manage_options', //$capability
						     'menu_slug'   => 'msbdt_report', 
			            ),

			            array(

			           'parent_slug' => 'msbdt_appointment',    //$parent_slug
						     'page_title'  => 'Schedule',       //$page_title
						     'menu_title'  => 'Schedule',       //$menu_title
						     'capability'  => 'manage_options', //$capability
						     'menu_slug'   => 'msbdt_schedule', 
			            ),

			            array(

			           'parent_slug' => 'msbdt_appointment',    //$parent_slug
						     'page_title'  => 'Category',       //$page_title
						     'menu_title'  => 'Category',       //$menu_title
						     'capability'  => 'manage_options', //$capability
						     'menu_slug'   => 'msbdt_category', 
			            ),

			          
			            array(

			           'parent_slug' => 'msbdt_appointment',    //$parent_slug
						     'page_title'  => 'Service',       //$page_title
						     'menu_title'  => 'Service',       //$menu_title
						     'capability'  => 'manage_options', //$capability
						     'menu_slug'   => 'msbdt_service', 
			            ),

			            array(

			           'parent_slug' => 'msbdt_appointment',    //$parent_slug
						     'page_title'  => 'Professional',       //$page_title
						     'menu_title'  => 'Professional',       //$menu_title
						     'capability'  => 'manage_options', //$capability
						     'menu_slug'   => 'msbdt_professional', 
			            ),


                  array(

                 'parent_slug' => 'msbdt_appointment',    //$parent_slug
                 'page_title'  => 'Email Notifications ',       //$page_title
                 'menu_title'  => 'Email Notifications',       //$menu_title
                 'capability'  => 'manage_options', //$capability
                 'menu_slug'   => 'msbdt_email_notification', 
                  ),
                      
			            array(

			           'parent_slug' => 'msbdt_appointment',    //$parent_slug
						     'page_title'  => 'Settings',       //$page_title
						     'menu_title'  => 'Settings',       //$menu_title
						     'capability'  => 'manage_options', //$capability
						     'menu_slug'   => 'msbdt_setting', 
			            )		         
			         
                  );

		return $parents ;
	}

	public function msbdt_create_menu_page(){
        $parents = $this->msbdt_define_page();
        if ( $parents ) {
            foreach ($parents as $parent) {
                add_menu_page(   $parent['page_title'], 
                	             $parent['menu_title'],
                	             $parent['capability'],
                	             $parent['menu_slug'],
                	             array( $this , $parent['menu_slug'].'_callback'),
                	             $parent['dashicons'] ) ; 
             }
        
        }
        
    }

    public function msbdt_create_submenu_page(){
        $parents = $this->msbdt_define_subpage();
        if ( $parents ) {
            foreach ($parents as $parent) {
                add_submenu_page($parent['parent_slug'] , 
                	             $parent['page_title'],
                	             $parent['menu_title'],
                	             $parent['capability'],
                	             $parent['menu_slug'],
                	             array( $this , $parent['menu_slug'].'_callback' )) ; 
             }
        
        }
      }

    public function msbdt_page_creater(){
       	   $this->msbdt_create_menu_page();
       	   $this->msbdt_create_submenu_page();
     }
     
     public function  msbdt_appointment_callback(){
        
         require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-appointment.php';     
          
     }  

     public function  msbdt_report_callback(){
         
         require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-report.php';       
           
     }  

     public function  msbdt_schedule_callback(){
         require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-time-slote.php';       
          
     } 
    
     public function  msbdt_category_callback(){
           require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-category.php';
     }

     public function  msbdt_service_callback(){
           require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-service.php';

     }

    public function  msbdt_professional_callback(){
          
          require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-professional.php';
         
     } 
    
     public function  msbdt_email_notification_callback(){
           require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-email.php';
           $email_notification = (current_user_can('manage_options') && is_admin())?
                           msbdt_appointment_email_notification_form(): 
                           wp_die();     
     }
  
     public function  msbdt_setting_callback(){
           require_once plugin_dir_path( __FILE__ ) . '/templates/msbdt-appointment-setting.php';
		       $setting = (current_user_can('manage_options') && is_admin())?
		                    msbdt_appointment_setting_form(): 
		                    wp_die();
     }

      public function msbdt_setting_api(){

        /**
         * @package    admin
         * @author     bdtask<uzzal131@gmail.com> <bdtask@gmail.com>
         * @since      1.0.0
         * @param Frontend Settings Section name change to Advance Setting Section.
         */         
                   
         /*//////////////////////////////////////////////////////////////////////////////////////
                           Language setting   
         ///////////////////////////////////////////////////////////////////////////////////////*/

        /* register_setting( $option_group, $option_name, $sanitize_callback );  */  
          register_setting('mas-frontend-language-setting','name_language',
                           array($this,'msbdt_frontend_name_sanitize'));

          register_setting('mas-frontend-language-setting','email_language',
                           array($this,'msbdt_frontend_email_sanitize'));

          register_setting('mas-frontend-language-setting','contact_language',
                            array($this,'msbdt_frontend_contact_sanitize'));

          register_setting('mas-frontend-language-setting','category_language',
                            array($this,'msbdt_frontend_category_sanitize'));

          register_setting('mas-frontend-language-setting','service_language',
                            array($this,'msbdt_frontend_location_sanitize'));

          register_setting('mas-frontend-language-setting','professional_language',
                            array($this,'msbdt_frontend_professional_sanitize'));

          register_setting('mas-frontend-language-setting','message_language',
                            array($this,'msbdt_frontend_message_sanitize'));

          register_setting('mas-frontend-language-setting','frontend_button_language',
                            array($this,'msbdt_frontend_button_sanitize'));

          add_settings_section( 
                            'mas_language_setting',
                            '',
                             array($this,'msbdt_mas_section_cb'), 
                            'mas_language_setting' );
                           

          add_settings_field('frontend_name' ,                                       // $id
                            __( 'Name', 'multi-scheduler' ),                         // $title
                               array($this,'msbdt_frontend_langues_setting_cb_for_name'),  // $callback
                              'mas_language_setting',                                // $page
                              'mas_language_setting',                                // $section
                               array( 'id' => 'professional_title',                  // $args 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'name_language' ));
           
           add_settings_field('frontend_email' , 
                              __( 'Email', 'multi-scheduler' ), 
                               array($this,'msbdt_frontend_langues_setting_cb_for_email'),
                              'mas_language_setting',
                              'mas_language_setting',
                               array( 'id' => 'frontend_email', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'email_language' ));

           add_settings_field('frontend_contact' , 
                               __( 'Contact', 'multi-scheduler' ), 
                               array($this,'msbdt_frontend_langues_setting_cb_for_contact'),
                              'mas_language_setting',
                              'mas_language_setting',
                               array( 'id' => 'frontend_contact', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'contact_language' ));

           add_settings_field('category_language' , 
                               __( 'Category', 'multi-scheduler' ), 
                               array($this,'msbdt_frontend_langues_setting_cb_for_category'),
                              'mas_language_setting',
                              'mas_language_setting',
                               array( 'id' => 'frontend_location', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'category_language' ));

            add_settings_field('frontend_location' , 
                               __( 'Service', 'multi-scheduler' ), 
                               array($this,'msbdt_frontend_langues_setting_cb_for_service'),
                              'mas_language_setting',
                              'mas_language_setting',
                               array( 'id' => 'frontend_location', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'service_language' ));

           add_settings_field('frontend_professional' , 
           	                  __( 'Professional', 'multi-scheduler' ), 
           	                   array($this,'msbdt_frontend_langues_setting_cb_for_professional'),
           	                  'mas_language_setting',
           	                  'mas_language_setting',
           	                   array( 'id' => 'frontend_professional', 
           	                  	     'class'=>'form-group',
           	                  	     'type' => 'text' , 
           	                  	     'name'=>'professional_language' ));

           add_settings_field('frontend_message' , 
                               __( 'Message', 'multi-scheduler' ), 
                               array($this,'msbdt_frontend_langues_setting_cb_for_message'),
                              'mas_language_setting',
                              'mas_language_setting',
                               array( 'id' => 'frontend_message', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'message_language' ));

           add_settings_field('frontend_button' , 
                               __( 'Message Button', 'multi-scheduler' ), 
                               array($this,'msbdt_frontend_langues_setting_cb_for_button'),
                              'mas_language_setting',
                              'mas_language_setting',
                               array( 'id' => 'frontend_button', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name' => 'frontend_button_language' ));

  /*//////////////////////////////////////////////////////////////////////////////////////
                           Status setting   
 ///////////////////////////////////////////////////////////////////////////////////////*/ 

           register_setting('mas-frontend-color-setting','text_color');
           register_setting('mas-frontend-color-setting','request_color');
           register_setting('mas-frontend-color-setting','approve_color');
           register_setting('mas-frontend-color-setting','reject_color');

           add_settings_section( 
                            'mas_color_setting',
                            '',
                             array($this,'msbdt_mas_section_cb'), 
                            'mas_color_setting' );

          
          /* request color */
           add_settings_field('request_color' , 
                              __( 'Request', 'multi-scheduler' ), 
                              array($this,'msbdt_request_color_cb'),
                              'mas_color_setting',
                              'mas_color_setting',
                              array( 'id' => 'request_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'request_color' ));
            /* approve color */
           add_settings_field('approve_color' , 
                               __( 'Approve', 'multi-scheduler' ), 
                              array($this,'msbdt_approve_color_cb'),
                              'mas_color_setting',
                              'mas_color_setting',
                              array( 'id' => 'request_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'approve_color' ));
            /* reject color */
           add_settings_field('reject_color' , 
                               __( 'Reject', 'multi-scheduler' ), 
                              array($this,'msbdt_reject_color_cb'),
                              'mas_color_setting',
                              'mas_color_setting',
                              array( 'id' => 'request_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'reject_color' ));
           /* available color */ 
           add_settings_field('available_color' , 
                               __( 'Available', 'multi-scheduler' ), 
                              array($this,'msbdt_avoilable_color_cb'),
                              'mas_color_setting',
                              'mas_color_setting',
                              array( 'id' => 'avoilable_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'avoilable_color' ));

             /* Error message color */ 
           add_settings_field('error_message_color' , 
                              __( 'Error Message Color', 'multi-scheduler' ),
                              array($this,'msbdt_error_message_color_cb'),
                              'frontend_setting',
                              'mas_frontend_section',
                              array( 'id' => 'error_message_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'error_message_color' ));

  /*//////////////////////////////////////////////////////////////////////////////////////
                           Calender setting   
 ///////////////////////////////////////////////////////////////////////////////////////*/   
                 
           register_setting('mas-calender-setting','calender_enable_color');
           register_setting('mas-calender-setting','calender_active_color');
           register_setting('mas-calender-setting','calender_day_text_color');
           register_setting('mas-calender-setting','calender_day_digit_color');
           register_setting('mas-calender-setting','calender_month_text_color');
           register_setting('mas-calender-setting','calender_header_bg_color');
           register_setting('mas-calender-setting','calender_body_color');
           
            add_settings_section( 
                            'mas_calender_setting',
                            '',
                             array($this,'msbdt_mas_section_cb'), 
                            'mas_calender_setting' );

           /* calender enable color */
           add_settings_field('calender_enable_color' , 
                              __( 'Enable Color', 'multi-scheduler' ),
                              array($this,'msbdt_calender_enable_color_cb'),
                              'mas_calender_setting',
                              'mas_calender_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'calender_enable_color' ));

           /* calender active color */
           add_settings_field('calender_active_color' , 
                             __( 'Active Color', 'multi-scheduler' ),
                              array($this,'msbdt_calender_active_color_cb'),
                              'mas_calender_setting',
                              'mas_calender_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'calender_active_color' ));
            /* calender calender_day_text_color */
           add_settings_field('calender_day_text_color' , 
                              __( 'Day Text Color', 'multi-scheduler' ),
                              array($this,'msbdt_calender_day_text_color_cb'),
                              'mas_calender_setting',
                              'mas_calender_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'calender_day_text_color' ));
             /* calender calender_day_digit_color */
           add_settings_field('calender_day_digit_color' , 
                              __( 'Day Digit Color', 'multi-scheduler' ),
                              array($this,'msbdt_calender_day_digit_color_cb'),
                              'mas_calender_setting',
                              'mas_calender_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'calender_day_digit_color' ));
            /* calender calender_month_text_color */
           add_settings_field('calender_month_text_color' , 
                              __( 'Month text Color', 'multi-scheduler' ),
                              array($this,'msbdt_calender_month_text_color_cb'),
                              'mas_calender_setting',
                              'mas_calender_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'calender_month_text_color' ));
            /* calender calender_header_bg_color */
           add_settings_field('calender_header_bg_color' , 
                              __( 'Header Backgraund Color', 'multi-scheduler' ),
                              array($this,'msbdt_calender_header_bg_color_cb'),
                              'mas_calender_setting',
                              'mas_calender_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'calender_header_bg_color' ));
            /* calender calender_border_color */
           add_settings_field('calender_body_color' , 
                             __( 'Body Backgraund Color', 'multi-scheduler' ),
                              array($this,'msbdt_calender_body_color_cb'),
                              'mas_calender_setting',
                              'mas_calender_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'calender_body_color' ));

  /*/////////////////////////////////////////////////////////////////////////////////
                             Admin Setting
  ///////////////////////////////////////////////////////////////////////////////////*/
           register_setting('mas_admin_setting','admin_text_color');
           register_setting('mas_admin_setting','admin_text_color_active_page');
           register_setting('mas_admin_setting','admin_edit_button_color');
           register_setting('mas_admin_setting','admin_delete_button_color');
           register_setting('mas_admin_setting','admin_submit_button_color');
           register_setting('mas_admin_setting','admin_submit_button_text_color');
           register_setting('mas_admin_setting','org_title',array($this,'msbdt_orgTitle_sanitize'));
           register_setting('mas_admin_setting','org_email',array($this,'msbdt_orgEmail_sanitize'));
           register_setting('mas_admin_setting','org_contact',array($this,'msbdt_orgContact_sanitize'));
           register_setting('mas_admin_setting','org_url',array($this,'msbdt_orgContact_sanitize'));
           register_setting('mas_admin_setting','admin_fontfamily',
                                          array($this,'msbdt_admin_fontfamily_sanitize'));
           register_setting('mas_admin_setting','admin_fontsize',
                                          array($this,'msbdt_admin_fontsize_sanitize'));        
           register_setting('mas_admin_setting','admin_pagination',
                                          array($this,'msbdt_admin_pagination_sanitize')); 

          
     
           add_settings_section( 
                            'mas_admin_section',
                            '',
                             array($this,'msbdt_mas_section_cb'), 
                            'mas_admin_section' );

              /* text color */
          
            add_settings_field('text_color' , 
                              __( 'Text Color', 'multi-scheduler' ),
                              array($this,'msbdt_admin_text_color_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                              array( 'id' => 'admin_text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_text_color' ));

            add_settings_field('admin_text_color_active_page' , 
                              __( 'Text Color Effected On Page', 'multi-scheduler' ),
                              array($this,'msbdt_admin_text_color_active_page_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                              array( 'id' => 'admin_text_color_active_page', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_text_color_active_page' ));

           /* Button color */ 
           add_settings_field('submit_button_color' , 
                             __( 'Edit Button Color', 'multi-scheduler' ),
                              array($this,'msbdt_admin_edit_button_color_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                              array( 'id' => 'admin_edit_button_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_edit_button_color' ));
             /* Button color */ 
           add_settings_field('admin_delete_button_color' , 
                              __( 'Delete Button Color', 'multi-scheduler' ),
                              array($this,'msbdt_admin_delete_button_color_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                              array( 'id' => 'admin_delete_button_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_delete_button_color' ));
             /* Button color */ 
           add_settings_field('admin_submit_button_color' , 
                              __( 'Submit Button Color', 'multi-scheduler' ),
                              array($this,'msbdt_admin_submit_button_color_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                              array( 'id' => 'admin_submit_button_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_submit_button_color' ));
            /* submit_button_text_color  */ 
           add_settings_field('submit_button_text_color' , 
                              __( 'Submit Button Text Color', 'multi-scheduler' ),
                              array($this,'msbdt_admin_submit_button_text_color_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                              array( 'id' => 'admin_submit_button_text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_submit_button_text_color' ));               
                                 

           add_settings_field('organization_title' , 
           	                  __( 'Organization Title', 'multi-scheduler' ),
           	                  array($this,'msbdt_organigation_title_cb'),
           	                 'mas_admin_section',
           	                 'mas_admin_section',
           	                  array( 'id' => 'organization_title', 
           	                  	     'class'=>'form-group',
           	                  	     'type' => 'text' ,
           	                  	     'name'=>'org_title' ));

          add_settings_field('organization_email' , 
           	                 __( 'Organization Email', 'multi-scheduler' ),
           	                  array($this,'msbdt_organigation_email_cb'),
           	                 'mas_admin_section',
           	                 'mas_admin_section',
           	                  array( 'id' => 'organization_email', 
           	                  	     'class'=>'form-group',
           	                  	     'type'=>'email', 
           	                  	     'name'=>'org_email' ));

          add_settings_field('organization_contact' , 
           	                __( 'Organization Contact', 'multi-scheduler' ),
           	                  array($this,'msbdt_organigation_contact_cb'),
           	                 'mas_admin_section',
           	                 'mas_admin_section',
           	                  array( 'id' => 'organization_contact',
           	                         'class'=>'form-group', 
           	                         'type'=>'',
           	                         'name'=>'org_contact' ));

          add_settings_field('organization_url' , 
           	                __( 'Organization Web Address ', 'multi-scheduler' ),
           	                  array($this,'msbdt_organigation_url_cb'),
           	                 'mas_admin_section',
           	                 'mas_admin_section',
           	                  array( 'id' => 'organization_contact',
           	                         'class'=>'form-group', 
           	                         'type'=>'',
           	                         'name'=>'org_url' ));

          add_settings_field('admin_fontfamily' , 
                              __( 'Font Family ', 'multi-scheduler' ),
                               array($this,'msbdt_admin_fontfamily_setting_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                               array( 'id' => 'admin_fontfamily', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_fontfamily' )); 

          add_settings_field('admin_fontsize' , 
                               __( 'Font size', 'multi-scheduler' ),
                               array($this,'msbdt_admin_fontsize_setting_cb'),
                              'mas_admin_section',
                              'mas_admin_section',
                               array( 'id' => 'admin_fontsize', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_fontsize' )); 

          add_settings_field('admin_pagination' , 
                               __( 'Display Record Per Page', 'multi-scheduler' ),
                               array($this,'msbdt_admin_pagination_setting'),
                              'mas_admin_section',
                              'mas_admin_section',
                               array( 'id' => 'admin_pagination', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'admin_pagination' )); 

  /*//////////////////////////////////////////////////////////////////////////////////////
                           Frontend setting   
 ///////////////////////////////////////////////////////////////////////////////////////*/

           register_setting('mas-frontend-color-setting','avoilable_color');
           register_setting('mas-frontend-setting','submit_button_color'); 
           register_setting('mas-frontend-setting','text_color'); 
           register_setting('mas-frontend-setting','error_message_color'); 
           register_setting('mas-frontend-setting','frontend_fontfamily',
                         array($this,'msbdt_frontend_fontfamily_sanitize'));
           register_setting('mas-frontend-setting','frontend_fontsize',
                         array($this,'msbdt_frontend_fontsize_sanitize'));
           register_setting('mas-frontend-setting','submit_button_text_color');
           register_setting('mas-frontend-setting','error_message_color');
           
           register_setting('mas-frontend-setting','frontend_success_message',
                         array($this,'msbdt_frontend_success_message_sanitize'));

           register_setting('mas-frontend-setting','frontend_custom_css');
         

           add_settings_section( 
                            'mas_frontend_setting',
                            '',
                             array($this,'msbdt_mas_section_cb'), 
                            'mas_frontend_setting' );
        
                /* text color */
           add_settings_field('text_color' , 
                               __( 'Text Color', 'multi-scheduler' ),
                              array($this,'msbdt_text_color_cb'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                              array( 'id' => 'text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'text_color' )); 
      /* error_message_color */
           add_settings_field('error_message_color' , 
                              __( 'Error Message Color', 'multi-scheduler' ),
                              array($this,'msbdt_error_message_color_cb'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                              array( 'id' => 'error_message_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'error_message_color' )); 


           /* Button color */ 
           add_settings_field('submit_button_color' , 
                              __( 'Button Color', 'multi-scheduler' ),
                              array($this,'msbdt_submit_button_color_cb'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                              array( 'id' => 'submit_button_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'submit_button_color' ));
            /* submit_button_text_color  */ 
           add_settings_field('submit_button_text_color' , 
                              __( 'Button Text Color', 'multi-scheduler' ),
                              array($this,'msbdt_submit_button_text_color_cb'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                              array( 'id' => 'submit_button_text_color', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'submit_button_text_color' ));               

            add_settings_field('frontend_fontfamily' , 
                              __( 'Font Family', 'multi-scheduler' ),
                               array($this,'msbdt_frontend_fontfamily_setting_cb_for_button'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                               array( 'id' => 'frontend_fontfamily', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'frontend_fontfamily' )); 
           
            add_settings_field('frontend_fontsize' , 
                              __( 'Font size (px)', 'multi-scheduler' ),
                               array($this,'msbdt_frontend_fontsize_setting_cb_for_button'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                               array( 'id' => 'frontend_fontsize', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'frontend_fontsize' ));

            add_settings_field('frontend_success_message' , 
                              __( 'Success Message', 'multi-scheduler' ),
                               array($this,'msbdt_frontend_success_message_setting_cb'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                               array( 'id' => 'frontend_success_message', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'frontend_success_message' ));

            add_settings_field('frontend_custom_css' , 
                              __( 'Frontend Custom CSS', 'multi-scheduler' ),
                               array($this,'msbdt_frontend_custom_css_setting_cb'),
                              'mas_frontend_setting',
                              'mas_frontend_setting',
                               array( 'id' => 'frontend_custom_css', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'frontend_custom_css' )); 


 /*//////////////////////////////////////////////////////////////////////////////////////
                           Paypal setting   
 ///////////////////////////////////////////////////////////////////////////////////////*/

           register_setting('mas-paypal-setting','local_enable');
           register_setting('mas-paypal-setting','local_language',
                         array($this,'msbdt_local_language_sanitize'));
           
           register_setting('mas-paypal-setting','paypal_enable');
           register_setting('mas-paypal-setting','paypal_language',
                         array($this,'msbdt_paypal_language_sanitize'));

           register_setting('mas-paypal-setting','card_enable');
           register_setting('mas-paypal-setting','card_language',
                         array($this,'msbdt_card_language_sanitize'));

           register_setting('mas-paypal-setting','paypal_resciver_email',
                         array($this,'msbdt_paypal_resciver_email_sanitize'));
           register_setting('mas-paypal-setting','paypal_currency',
                         array($this,'msbdt_paypal_currency_sanitize'));       
           register_setting('mas-paypal-setting','paypal_amount',
                         array($this,'msbdt_paypal_amount_sanitize'));
           register_setting('mas-paypal-setting','paypal_button');

           add_settings_section( 
                            'mas_paypal_setting',
                            '',
                             array($this,'msbdt_mas_section_cb'), 
                            'mas_paypal_setting' );
        
        

          add_settings_field('local_enable' , 
                               __( 'Local Enable', 'multi-scheduler' ),
                              array($this,'msbdt_local_enable_cb'),
                              'mas_paypal_setting',
                              'mas_paypal_setting',
                              array( 'id' => 'local_enable', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'local_enable' ));

           add_settings_field('paypal_enable' , 
                               __( 'Paypal Enable', 'multi-scheduler' ),
                              array($this,'msbdt_paypal_enable_cb'),
                              'mas_paypal_setting',
                              'mas_paypal_setting',
                              array( 'id' => 'paypal_enable', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'paypal_enable' ));

          add_settings_field('card_enable' , 
                               __( 'Card Enable', 'multi-scheduler' ),
                              array($this,'msbdt_card_enable_cb'),
                              'mas_paypal_setting',
                              'mas_paypal_setting',
                              array( 'id' => 'card_enable', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'card_enable' ));                            
        
           
           add_settings_field('paypal_resciver_email' , 
                               __( 'Paypal Email', 'multi-scheduler' ),
                              array($this,'msbdt_paypal_resciver_email_cb'),
                              'mas_paypal_setting',
                              'mas_paypal_setting',
                              array( 'id' => 'paypal_resciver_email', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'paypal_resciver_email' ));

            
            add_settings_field('paypal_currency' , 
                               __( 'Currency', 'multi-scheduler' ),
                              array($this,'msbdt_paypal_currency_cb'),
                              'mas_paypal_setting',
                              'mas_paypal_setting',
                              array( 'id' => 'paypal_currency', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'paypal_currency' )); 

             add_settings_field('paypal_amount' , 
                               __( 'Amount', 'multi-scheduler' ),
                              array($this,'msbdt_paypal_amount_cb'),
                              'mas_paypal_setting',
                              'mas_paypal_setting',
                              array( 'id' => 'paypal_amount', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'paypal_amount' )); 

            add_settings_field('paypal_button' , 
                               __( 'Button', 'multi-scheduler' ),
                              array($this,'msbdt_paypal_button_cb'),
                              'mas_paypal_setting',
                              'mas_paypal_setting',
                              array( 'id' => 'paypal_button', 
                                     'class'=>'form-group',
                                     'type' => 'text' , 
                                     'name'=>'paypal_button' )); 

 
    }
    //section cb
    public function msbdt_mas_section_cb(){
      return ;
    }
    

    // field callback 

    /*/////////////////// paypal ///////////////////////// */


    public function msbdt_local_enable_cb($args){
      
      $value_checkbox = esc_attr(get_option($args['name']));
      $value_language = esc_attr(get_option('local_language'));
      $output = '<input type = "checkbox" 
                        id = "checkbox_example"
                      name = "'.$args['name'].'" 
                     value = "1"' . checked( 1, $value_checkbox , false ) . '/>';   
     
      $output .= sprintf( '<span style="margin:2px 10px"><input id="%1s" 
                                 class = "" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" </span>',$args['id'],$args['type'],'local_language',$value_language );
      echo $output;  
       
     }

    public function msbdt_paypal_enable_cb($args){
      
      $value_checkbox = esc_attr(get_option($args['name']));
      $value_language = esc_attr(get_option('paypal_language'));
      $output = '<input type = "checkbox" 
                        id = "checkbox_example"
                      name = "'.$args['name'].'" 
                     value = "1"' . checked( 1, $value_checkbox , false ) . '/>';   
     
      $output .= sprintf( '<span style="margin:2px 10px"><input id="%1s" 
                                 class = "" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" </span>',$args['id'],$args['type'],'paypal_language',$value_language );
      echo $output;  
       
     }

      public function msbdt_card_enable_cb($args){
      
      $value_checkbox = esc_attr(get_option($args['name']));
      $value_language = esc_attr(get_option('card_language'));
      $output = '<input type = "checkbox" 
                        id = "checkbox_example"
                      name = "'.$args['name'].'" 
                     value = "1"' . checked( 1, $value_checkbox , false ) . '/>';   
     
      $output .= sprintf( '<span style="margin:2px 10px"><input id="%1s" 
                                 class = "" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" </span>',$args['id'],$args['type'],'card_language',$value_language );
      echo $output;  
       
     }

     public function msbdt_paypal_resciver_email_cb($args){
      
      $value = esc_attr(get_option($args['name']));
      $output = sprintf( '<p><input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" </p>',$args['id'],$args['type'],$args['name'],$value );
      echo $output;       
     }

     public function msbdt_paypal_currency_cb($args){
      
      $ExqAllCurencies = array(

        'USD' => __('U.S. Dollar'),
        'EUR' => __('Australian Dollar'),
        'AUD' => __('Canadian Dollar'),
        'CAD' => __('Canadian Dollar'),
        'CZK' => __('Czech Koruna'),
        'DKK' => __('Danish Krone'),
        'HKD' => __('Euro'),
        'HUF' => __('Hong Kong Dollar'),
        'JPY' => __('Hungarian Forint'),
        'NOK' => __('Norwegian Krone'),
        'NZD' => __('New Zealand Dollar') ,
        'PLN' => __('Polish Zloty'),
        'GBP' => __('Pound Sterling'),
        'SGD' => __('Singapore Dollar'),
        'SEK' => __('Swedish Krona'),
        'CHF' =>__('Pound Sterling'),
        'SGD' =>__('Singapore Dollar') ,
        'RUB' =>__('Russian Ruble'),
        'PHP' =>__('Philippine Peso'),
        'MXN' =>__('Mexican Peso'),
        'ILS' =>__('Israeli New Sheqel') );

      $value = esc_attr(get_option($args['name']));
      $html = '<p><select id="time_options" name="paypal_currency"  class = "form-control" >';
      foreach ( $ExqAllCurencies as $currency_key => $currency) { 
      ($value == $currency_key)?  $set = 'selected' :  $set = '';
      $html .= '<option value="'.$currency_key.'" '.$set .'>' . $currency. '</option>';        
      }
      $html .= '</select></p>';
     echo $html;
     }

     
      public function msbdt_paypal_amount_cb($args){
      
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);
      $output = sprintf( '<p><input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" </p>',$args['id'],$args['type'],$args['name'],$value );
      echo $output;       
     }

     public function msbdt_paypal_button_cb($args){?>
     <div><br/><input type="radio" 
             name="paypal_button" 
             value="1" <?php checked( 1 , get_option($args['name']), true); ?>>
             <span><img style="vertical-align: middle;" 
                        alt="large" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynow_LG.gif"></span></div>
      <br />
      <div><input type="radio" 
             name="paypal_button" 
             value="2" <?php checked( 2 , get_option($args['name']), true); ?>>
             <span><img style="vertical-align: middle;" 
                         alt="large" 
                         src="https://www.paypalobjects.com/en_AU/i/btn/btn_buynow_LG.gif"></span></div><br/> 

      <?php  
      } 

    

     /*/////////////////// Langues ///////////////////////// */

    public function msbdt_frontend_langues_setting_cb_for_name($args){
      
    	$value = esc_attr(get_option($args['name']));
    	$value = str_replace("@"," ",$value);
        $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;       
     }

     public function msbdt_frontend_langues_setting_cb_for_email($args){
      
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);     
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;    
    }

    public function msbdt_frontend_langues_setting_cb_for_contact($args){
      
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);     
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }

     public function msbdt_frontend_langues_setting_cb_for_category($args){
      
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);    
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );

      echo $output;    
    }


    public function msbdt_frontend_langues_setting_cb_for_service($args){
      
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);    
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );

      echo $output;    
    }

     public function msbdt_frontend_langues_setting_cb_for_professional($args){
      
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);    
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;     
    }

     public function msbdt_frontend_langues_setting_cb_for_message($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;    
    }

   
     public function msbdt_frontend_langues_setting_cb_for_button($args){
      
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value); 
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );

      echo $output;    
     }

     public function msbdt_frontend_success_message_setting_cb($args){ 
      
     $value = esc_attr(get_option($args['name']));
     // Render the output
     echo '<textarea id="textarea_example" 
                     name="frontend_success_message" 
                     rows="2" cols="50">' . $value . '</textarea>';
     }

     public function msbdt_frontend_custom_css_setting_cb($args){ 
      
     $value = esc_attr(get_option($args['name']));
     // Render the output
     echo '<textarea id="textarea_example" 
                     name="frontend_custom_css" 
                     rows="5" cols="50">' . $value . '</textarea>';   
     }

     public function msbdt_admin_pagination_setting($args){

        $value = esc_attr(get_option($args['name']));
        $value = str_replace("@"," ",$value);      
        $output = sprintf( '<input id="%1s" 
                                   class = "form-control" 
                                   type = "%2s"  
                                   name ="%3s" 
                                   value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
        echo $output;
     }

     public function msbdt_admin_text_color_active_page_cb($args){ ?>

      <div><input type="radio" 
             name="admin_text_color_active_page" 
             value="1" <?php checked( 1 , get_option($args['name']), true); ?>>
             <span><?php esc_html_e('Appointment page','multi-scheduler');?></span></div>
      
      <div><input type="radio" 
             name="admin_text_color_active_page" 
             value="2" <?php checked( 2 , get_option($args['name']), true); ?>>
             <span><?php esc_html_e('All Page','multi-scheduler');?></span></div><br/> 

       <?php  
        
     }


    public function msbdt_admin_fontfamily_setting_cb($args){

        $value = esc_attr(get_option($args['name']));
        $value = str_replace("@"," ",$value);      
        $output = sprintf( '<input id="%1s" 
                                   class = "form-control" 
                                   type = "%2s"  
                                   name ="%3s" 
                                   value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
        echo $output;
     }

     public function msbdt_admin_fontsize_setting_cb($args){
       
        $value = esc_attr(get_option($args['name']));
        $value = str_replace("@"," ",$value);      
        $output = sprintf( '<input id="%1s" 
                                   class = "form-control" 
                                   type = "%2s"  
                                   name ="%3s" 
                                   value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
        echo $output;
     }

      public function msbdt_frontend_fontfamily_setting_cb_for_button($args){

        $value = esc_attr(get_option($args['name']));
        $value = str_replace("@"," ",$value);      
        $output = sprintf( '<input id="%1s" 
                                   class = "form-control" 
                                   type = "%2s"  
                                   name ="%3s" 
                                   value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
        echo $output;
     }

     public function msbdt_frontend_fontsize_setting_cb_for_button($args){
       
        $value = esc_attr(get_option($args['name']));
        $value = str_replace("@"," ",$value);      
        $output = sprintf( '<input id="%1s" 
                                   class = "form-control" 
                                   type = "%2s"  
                                   name ="%3s" 
                                   value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
        echo $output;
     }

     public function msbdt_text_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);      
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;   
    }

   public function msbdt_request_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);      
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;   
    }
    public function msbdt_approve_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);  
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;   
    }
    public function msbdt_reject_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);  
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;
        
    }
    public function msbdt_avoilable_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;       
    }

    public function msbdt_submit_button_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);      
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
       echo $output;    
    }

    public function msbdt_submit_button_text_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);      
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
       echo $output;    
     }


     public function msbdt_error_message_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }

    // calender setting
    public function msbdt_calender_enable_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }

    public function msbdt_calender_active_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }
     public function msbdt_calender_day_text_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }

    public function msbdt_calender_day_digit_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }

    public function msbdt_calender_month_text_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }

    public function msbdt_calender_header_bg_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }

   public function msbdt_calender_body_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);       
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );

      echo $output;       
    }


    public function msbdt_admin_text_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;       
    }
   public function msbdt_admin_edit_button_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;       
    }
    public function msbdt_admin_delete_button_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
      echo $output;       
    }
    public function msbdt_admin_submit_button_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);      
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
       echo $output;    
    }

    public function msbdt_admin_submit_button_text_color_cb($args){
     
      $value = esc_attr(get_option($args['name']));
      $value = str_replace("@"," ",$value);      
      $output = sprintf( '<input id="%1s" 
                                 class = "color-field" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s" ',$args['id'],$args['type'],$args['name'],$value );
       echo $output;    
     }

     public function msbdt_organigation_title_cb($args){

    	$value = esc_attr(get_option($args['name']));
    	$value = str_replace("@"," ",$value);        
    	$output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;
    }
     public function msbdt_organigation_email_cb($args){

    	$value = esc_attr(get_option($args['name']));
      $output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;  
    }

    public function msbdt_organigation_contact_cb($args){

    	$value = esc_attr(get_option($args['name']));
    	$output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;     
    }

    public function msbdt_organigation_url_cb($args){

    	$value = esc_attr(get_option($args['name']));
    	$output = sprintf( '<input id="%1s" 
                                 class = "form-control" 
                                 type = "%2s"  
                                 name ="%3s" 
                                 value = "%4s"',$args['id'],$args['type'],$args['name'],$value );
      echo $output;
    }

    
   
    public function msbdt_frontend_name_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }
    public function msbdt_frontend_email_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }
    public function msbdt_frontend_contact_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }
    public function msbdt_frontend_category_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }
    public function msbdt_frontend_location_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }
    public function msbdt_frontend_professional_sanitize($input){
	     $output = sanitize_text_field($input);
	     return $output;
    }
    public function msbdt_frontend_message_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }
    public function msbdt_frontend_required_message_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }

    
    public function msbdt_frontend_fontfamily_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }
   
    public function msbdt_frontend_fontsize_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }

  
    public function msbdt_frontend_button_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }

    public function msbdt_admin_pagination_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }

    public function msbdt_admin_fontfamily_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }

    public function msbdt_admin_fontsize_sanitize($input){
       $output = sanitize_text_field($input);
       return $output;
    }

    public function msbdt_orgTitle_sanitize($input){
	     $output = sanitize_text_field($input);
	     return $output;
    }
    public function msbdt_orgEmail_sanitize($input){
	     $output = sanitize_text_field($input);
	     return $output;
    }
    public function msbdt_orgContact_sanitize($input){
	     $output = sanitize_text_field($input);
	     return $output;
    }
     public function msbdt_orgUrl_sanitize($input){
	     $output = sanitize_text_field($input);
	     return $output;
    }

    // paypal sanitize
    public function msbdt_paypal_resciver_email_sanitize($input){
        $output = sanitize_text_field($input);
        return $output;
    }
  
   public function msbdt_paypal_currency_sanitize($input){
        $output = sanitize_text_field($input);
        return $output;
    }
    
   public function msbdt_paypal_amount_sanitize($input){
        $output = sanitize_text_field($input);
        return $output;
    }

    public function msbdt_paypal_language_sanitize($input){
        $output = sanitize_text_field($input);
        return $output;
    }

    public function msbdt_card_language_sanitize($input){
        $output = sanitize_text_field($input);
        return $output;
    }
    public function msbdt_local_language_sanitize($input){
        $output = sanitize_text_field($input);
        return $output;
    }
    public function msbdt_frontend_success_message_sanitize($input){
        $output = sanitize_text_field($input);
        return $output;
    }
    
    
    
 } /* / class Msbdt_Admin */  