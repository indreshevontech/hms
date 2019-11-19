<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://scheduler.bdtask.com/
 * @since      1.0.0
 *
 * @package    Msbdt
 * @subpackage Msbdt/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Msbdt
 * @subpackage Msbdt/public
 * @author     bdtask <bdtask@gmail.com>
 */
class Msbdt_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


        add_action('init',array($this,'msbdt_public_dependence_file'));
       
        add_action('init',array($this,'msbdt_shortcode_register'));
        add_action('init',array($this,'msbdt_select_service_agnist_category_ajax'));
        add_action('init',array($this,'msbdt_select_disable_date_agnist_doctor_ajax'));
        
        add_action('init',array($this,'msbdt_public_professional_display_ajax'));


         /*======================== service define ==========================*/
        add_action( 'wp_ajax_service_ajaxProsessData',
                  array($this,'msbdt_select_service_agnist_category'));
        add_action( 'wp_ajax_nopriv_service_ajaxProsessData',
                  array($this,'msbdt_select_service_agnist_category'));

         /*======================== professional define ==========================*/
        add_action( 'wp_ajax_professional_ajaxProsessData',
                  array($this,'msbdt_professional_ajaxProsessData'));
        add_action( 'wp_ajax_nopriv_professional_ajaxProsessData',
                  array($this,'msbdt_professional_ajaxProsessData'));
        

        /*======================== Enable date define ==========================*/
        add_action( 'wp_ajax_disableDate_ajaxProsessData',
	  	            array($this,'msbdt_select_disable_date_agnist_professional'));
        add_action( 'wp_ajax_nopriv_disableDate_ajaxProsessData',
                  array($this,'msbdt_select_disable_date_agnist_professional'));
        
        /*========================  define ==========================*/
	      add_action( 'wp_ajax_selectTimeSlote_ajaxProsessData',
	  	            array($this,'msbdt_select_time_slote_date_agnist_professional'));
        add_action( 'wp_ajax_nopriv_selectTimeSlote_ajaxProsessData',
      	            array($this,'msbdt_select_time_slote_date_agnist_professional'));

        
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style( 'msbdt-bootstrap-style',
                           plugin_dir_url( __FILE__ ).'css/msbdt-bootstrap.css', 
                           array(), $this->version, 'all' );

        wp_enqueue_style( 'msbdt-ui-style',
                           plugin_dir_url( __FILE__ ) .'css/msbdt-ui.css', 
                           array(), $this->version, 'all' );

        wp_enqueue_style('msbdt-fontawesome', 
                           plugin_dir_url( __FILE__ ) .'font-awesome/css/font-awesome.min.css', 
                           array(), $this->version, 'all' );

        wp_enqueue_style('msbdt-custom', 
                           plugin_dir_url( __FILE__ ).'css/msbdt-custom-style.css', 
                           array(), $this->version, 'all' );

		    wp_enqueue_style( $this->plugin_name, 
                           plugin_dir_url( __FILE__ ) . 'css/msbdt-public.css',
                           array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
        
      wp_enqueue_script('jquery');
      wp_enqueue_script('jquery-ui-core'); 
      wp_enqueue_script( 'wp-color-picker' );
      wp_enqueue_script('jquery-ui-datepicker');


       wp_enqueue_script(  'msbdt-bootstrap-jquery', 
                          plugin_dir_url( __FILE__ ) . 'js/msbdt-bootstrap.min.js',
                          array( 'jquery' ), $this->version,true );

	      wp_enqueue_script( 'msbdt-ui-jquery', 
                            plugin_dir_url( __FILE__ ) . 'js/msbdt-jquery-ui.js',
                            array( 'jquery' ), $this->version, true );

        wp_enqueue_script( 'msbdt-ui-jqueryd', 
                            plugin_dir_url( __FILE__ ) .'js/msbdt-jquery-1.12.4.js',
                            array( 'jquery' ), $this->version, true );
      
        wp_enqueue_script( 'msbdt-slimscroll-jquery', 
                            plugin_dir_url( __FILE__ ) .'js/msbdt-jquery.slimscroll.min.js',
                            array( 'jquery' ), $this->version, true );
      
		    wp_enqueue_script( $this->plugin_name, 
                             plugin_dir_url( __FILE__ ) . 'js/msbdt-public.js', 
                             array( 'jquery' ), $this->version, true );

	}

   public function msbdt_public_dependence_file(){

        require_once plugin_dir_path( __FILE__ ) . '/../admin/query/msbdt-category-query.php';
        require_once plugin_dir_path( __FILE__ ) . '/../admin/query/msbdt-service-query.php';
        require_once plugin_dir_path( __FILE__ ) . '/../admin/query/msbdt-professional-query.php';
        require_once plugin_dir_path( __FILE__ ) . 'query/msbdt-booking-query-for-public.php';
        require_once plugin_dir_path( __FILE__ ) . 'asset/msbdt-custom-style-for-public.php';
   }


   public function msbdt_select_service_agnist_category_ajax(){

         wp_enqueue_script( 'msbdt-public-service-display_ajax', 
                        plugin_dir_url( __FILE__ ).'ajax/msbdt-public-service-display-ajax.js', 
                        array( 'jquery' ), $this->version, true ); 

         wp_localize_script( 'msbdt-public-service-display_ajax', 
                        'object',
                         array(  'ajaxurl'  => admin_url( 'admin-ajax.php' ),
                                 'nonce'    => wp_create_nonce('randomnonce'),
                             )
                    );

    }


   public function msbdt_select_disable_date_agnist_doctor_ajax(){

         wp_enqueue_script( 'mas_select_disable_date_agnist_doctor_ajax', 
			                  plugin_dir_url( __FILE__ ).'ajax/multi-appointment-select-disable-date-agnist-doctor-ajax.js', 
			                  array( 'jquery' ), $this->version, true ); 

         wp_localize_script( 'mas_select_disable_date_agnist_doctor_ajax', 
                        'object',
                         array(  'ajaxurl'  => admin_url( 'admin-ajax.php' ),
                                 'nonce'    => wp_create_nonce('randomnonce'),
                             )
                    );

    }

  /**
   * @since 1.0.0
   * @param localize 
   */
   public function msbdt_public_professional_display_ajax(){

         wp_enqueue_script( 'msbdt-public-professional-display-ajax', 
                        plugin_dir_url( __FILE__ ).'ajax/msbdt-public-professional-display-ajax.js', 
                        array( 'jquery' ), $this->version, true ); 

         wp_localize_script( 'msbdt-public-professional-display-ajax', 
                        'object',
                         array(  'ajaxurl'  => admin_url( 'admin-ajax.php' ),
                                 'nonce'    => wp_create_nonce('randomnonce'),
                             )
                    );

    }
  

  
   public function msbdt_select_service_agnist_category(){
       global $wpdb;
       $table_name = $wpdb->prefix.'msbdt_service'; 
       $id = intval($_POST['data'] );
       $sql = "SELECT * FROM  $table_name  WHERE cat_id LIKE '%".$id."%'";
       $select_services = $wpdb->get_results( $sql  , OBJECT ) ;
       ?>
       <option> --- select ---  </option>
       <?php      
       foreach ($select_services as $service) {
       $sellect_categories = json_decode($service->cat_id);
       if( in_array( $id , $sellect_categories)): ?> 
            <option 
             value="<?php echo  $service->ser_id ; ?>">
            <?php echo ucwords( $service->ser_name ) ; ?>        
            </option><?php 
       endif;   
       }
       //var_dump($services);
       
       wp_die();   

   }

  /**
   * @since 1.0.0
   * @param findout frofessional without duplicate.
   * @var $professionalDateArray is array. hold professional.
   */
   public function msbdt_professional_ajaxProsessData(){
       global $wpdb;
       $table_professional = $wpdb->prefix .'msbdt_professional';
       $id = intval($_POST['data'] ); 
       $query = "SELECT * FROM  $table_professional  WHERE `ser_id` LIKE '%".$id."%'" ;
       $professionals = $wpdb->get_results($query, OBJECT );
       ?>
       <option> --- select ---  </option>
       <?php      
       foreach ($professionals as $professional) {
       $sellect_services = json_decode($professional->ser_id);
       if( in_array( $id , $sellect_services)): ?> 
            <option 
             value="<?php echo  $professional->pro_id ; ?>">
            <?php echo ucwords( $professional->fname.' '.$professional->lname ) ; ?>        
            </option><?php 
       endif;   
       }
       wp_die();   

   }

   /**
   * @since 1.0.0
   * @param localize calback function . Display active date. 
   */
    public function msbdt_select_disable_date_agnist_professional($id=''){
         
         global $wpdb;
         $table_name = $wpdb->prefix.'msbdt_time_slote'; 
    	   $work_date  ='';
    	   $start_time ='';
    	   $end_time   ='';
    	   $interval   ='';
    	   $total_time_per_day = '';
    	   $enableDateArray = array();
    	   $id = intval($_POST['data'] );     
           $query  = "SELECT * FROM  $table_name  WHERE `pro_id` = $id ";
           $results = $wpdb->get_results($query, OBJECT );
           $i = 0;
           foreach ($results as $result ): 
           	 if(date('yy-mm-dd') <= date('yy-mm-dd',strtotime($result->work_date))) :                  
                 $enableDateArray[$i] = $result->work_date ;
                 $i++;

             endif;         
           endforeach ;
          return wp_send_json($enableDateArray)  ;  	
    	 wp_die();    

    }

  /**
   * @since 1.0.0
   * @param Create time slote (schedule) agnist Select date. 
   */

    public function msbdt_select_time_slote_date_agnist_professional(){
    
    /*======================================   
  	      html status color showing 	
     ========================================*/

        ?>
        <script>
            jQuery(function () {            
                jQuery('.button_inner').slimScroll({
                    height:'100px',
                    size: '3px',
                    color: '#5bbc2e'
                });
            });
        </script>

        <div class = "public_status_button">

         <button class  =  "button btn" style = "background-color:<?php echo get_option('avoilable_color'); ?> ">
         <?php esc_html_e('Available','multi-scheduler');?></button>
       
         <button class  =  "button btn" style  =  "background-color:<?php echo get_option('request_color'); ?> ">
          <?php esc_html_e('Requested','multi-scheduler');?></button>
         
         <button class  =  "button btn" style = "background-color:<?php echo get_option('approve_color'); ?> ">
           <?php esc_html_e('Booked','multi-scheduler');?></button>       
        </div>
        
        <?php
    	/*==================================*/
    	 
    	   global $wpdb; 
         $table_time_slote  = $wpdb->prefix .'msbdt_time_slote';
         $table_mps_booking = $wpdb->prefix .'msbdt_booking';

    	   $work_date  ='';
    	   $start_time ='';
    	   $end_time   ='';
    	   $interval   ='';
    	   $date       ='';
    	   $pro_id     ='';      
    	   $date       = sanitize_text_field( $_POST['date'] );;
    	   $pro_id     = intval( $_POST['pro_id'] ); 
    	  	          
           $query = $wpdb->prepare( "SELECT * FROM $table_time_slote
                                     WHERE `pro_id`   = %d 
                                     AND  `work_date` = %s", $pro_id, $date );
      
           $time_slote = $wpdb->get_row($query);

           $booking_start_time = $time_slote->work_date .'  '. $time_slote->start_time;
           $booking_end_time   = $time_slote->work_date .'  '.$time_slote->end_time; 			
           // The slot frequency per hour, expressed in minutes.
           $booking_frequency  = $time_slote->int_val;
           // Calculate how many slots there are per day
	       $slots_per_day = 0;	
        ?>
        <div class="button_inner">
        <?php
	       for($i = strtotime($booking_start_time); $i<= strtotime($booking_end_time); $i = $i + $booking_frequency * 60):
		     
                 $startTime = date('h:i a', $i );
                 $endTime   = date('h:i a', $i + $booking_frequency * 60 );

                /*==============  cheack status============== */
                 $startTime_dbf = date('H:i:s', $i );  
                 $date          = date('Y-m-d', $i) ;
               
                 $sql_check_status   = " SELECT * 
                                         FROM  $table_mps_booking
                                         WHERE  `start_time` = '".$startTime_dbf."' " ; 
              
                 $check_status = $wpdb->get_row( $wpdb->prepare($sql_check_status,ARRAY_A)); 
                 if(($check_status ->status == '4') && ($check_status ->date == $date)):
                    $request_color  = (get_option('request_color'))? 
                                       get_option('request_color') : 
                                       '#9b5800';
                   
                    $this->msbdt_onclick_inputbutton($startTime,$endTime,$time_slote->work_date, $request_color ) ;

                 elseif(($check_status ->status == '5') && ($check_status ->date == $date)):
                    $booked_color   = (get_option('approve_color'))? 
                                       get_option('approve_color') : 
                                       '#ff0000';
                    $this->msbdt_onclick_inputbutton($startTime,$endTime,$time_slote->work_date,$booked_color) ; 
                 else:
                 	$avoilable_color = (get_option('avoilable_color'))? 
                                        get_option('avoilable_color') : 
                                        '#ff0000';
                 	$this->msbdt_onclick_inputbutton($startTime,$endTime,$time_slote->work_date,$avoilable_color) ;
                 endif;

		     $slots_per_day ++;
	       endfor;
         ?>
        </div>
        <div class="col-sm-12 theme-padding">  
              <div class="ok_inner">
                 <?php if(get_option( 'local_enable' )) : ?>
                    <div class="radio radio-danger">
                        <input type="radio" name="payment" id="radio1" value="local">
                        <label for="radio1" data-toggle="modal" data-target=".modal0">
                        <?php esc_html_e(get_option( 'local_language' )); ?>  
                        </label>
                    </div>
                <?php endif ; ?>
                <?php  if(get_option( 'paypal_enable' )) : ?>
                    <div class="radio radio-danger">
                        <input type="radio" name="payment" id="radio2" value="paypal">
                        <label for="radio2" data-toggle="modal" data-target=".modal1">
                        <?php esc_html_e(get_option( 'paypal_language' )); ?>
                        </label>
                    </div>
                <?php endif ; ?>
                <?php  if(get_option( 'card_enable' )) : ?>
                    <div class="radio radio-danger">
                        <input type="radio" name="payment" id="radio3" value="card">
                        <label for="radio3" data-toggle="modal" data-target=".modal2">
                         <?php esc_html_e(get_option( 'card_language' )); ?>
                        </label>
                    </div>
                <?php endif ; ?>
                </div>
           </div>
      <?php
	   wp_die();    	 

    }

  /**
   * @since 1.0.0
   * @param Display slote agnist Select date. 
   */

    public function msbdt_onclick_inputbutton($startTime,$endTime,$work_date,$status_color){
  	echo $status ;

    ?>
    <span class="schedule">
   
              <a class  =  "btn thme-btn"
                 style  =  "background-color:<?php echo $status_color ; ?> ;" 
                  id    =  "<?php echo 'bts'.strtotime($startTime) ; ?>"
                onclick =  "clickTimeSloteButton( '<?php echo esc_js($startTime) ; ?>' ,
                                                  '<?php echo esc_js($endTime) ; ?>'  , 
                                                  '<?php echo esc_js($work_date) ; ?>' ,
                                                  '<?php echo esc_js("bts".strtotime($startTime)) ; ?>' ) ">
     <i class="glyphicon glyphicon-time"></i>
     <?php echo sprintf(__( '%s', 'appointment' ), $startTime ); ?></a>                     
    </span>
   <?php
   }

  /**
   * @since 1.0.0
   * @param Create shortcode . 
   */
	  public function msbdt_shortcode_register(){
          
          add_shortcode('mas_bdtask',array($this,'msbdt_shortcode_cb'));
    }
    
  /**
   * @since 1.0.0
   * @param Create shortcode calback function . 
   */
    public function msbdt_shortcode_cb($atts , $content = null){ ?>

    <?php 
    global $pagenow , $wpdb ; 

    $errors = '';
    $msbdt_scheduler_custom_css = Msbdt_Custom_Style_Public::msbdt_scheduler_custom();  
    $errors = Msbdt_Booking_Public::msbdt_public_appointment_process();
	  ob_start();

    ?>

    <script type="text/javascript">	
	  var count  =0;
    var pre_id ='' ;

	  function clickTimeSloteButton(start_time = null , end_time = null , date = null, btn = null ){
          
	     if(start_time != null && 
	        end_time   != null && 
	        date       != null && 
	        btn        != null ){
	        var schedule_start_time = start_time;
	        var schedule_end_time   = end_time ;
	        var schedule_date       = date ;
	       

            if(count == 0){
            	  document.getElementById('schedule_date').value       = '' ;
                document.getElementById('schedule_start_time').value = '' ;
                document.getElementById('schedule_end_time').value   = '' ;  
                document.getElementById(btn).style.backgroundColor ="<?php echo get_option( 'request_color' ) ; ?>";
                document.getElementById('schedule_date').value       = schedule_date ;
                document.getElementById('schedule_start_time').value = schedule_start_time ;
                document.getElementById('schedule_end_time').value   = schedule_end_time ;
                count = 1 ;
              
            }else if(count == 1){
                document.getElementById('schedule_date').value       = '' ;
                document.getElementById('schedule_start_time').value = '' ;
                document.getElementById('schedule_end_time').value   = '' ;     
                document.getElementById(btn).style.backgroundColor = 
                "<?php echo get_option( 'avoilable_color' ) ; ?>";

                count = 0 ;
            }                       
             
          }	 
            
        }

	   </script>
           <input id="book36_hidden_1" type="hidden" value=<?php echo get_option( 'request_color' ) ; ?> />
	   <input id="book36_hidden_2"  type="hidden"  value=<?php echo get_option( 'avoilable_color' ) ; ?> />
    <div class="multi-appointment ">
    <div class="multi-appointment row public_include_border">
      <!-- <div class="col-md-10 col-md-offset-2"> -->
      <div class="col-md-12">
        <div class="booking_area">

             <!---    Message Section --> 
             <div class = "row">
                 <div class = "col-sm-12">
                    <?php if( $errors['booking_sql']): ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                       <strong> <?php echo get_option('frontend_success_message') ;  ?> </strong>
                     </div>
                  <span>
                   <a class  = "btn btn-primary" 
                      style = "float:right"
                      href="<?php echo $errors['link']  ; ?>" 
                      target="_blank" rel="nofollow"><?php echo esc_html('Add to calendar'); ?></a>
                  </span>  
                  <?php elseif($errors == 'something_is_error') : ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?php _e('Error !! Please try again') ?></strong> 
                     </div>              
                <?php endif ; ?>               
              </div><!-- end .col-sm-7 --> 
             </div><!-- end .row -->  
          <!---   / Message Section -->                  
            

<form method="post" action=""> 
  <div class="form-area"> 
      <div class="row theme-margin">

      <!-- name -->
      <div class="col-xs-12  col-sm-4 col-md-4 theme-padding">
      <div class="form-group">      
    	<label for="name"><?php echo esc_html( get_option('name_language') ); ?></label>
    	<span class="public_error_message_color">
    	<?php if(isset( $errors['name_empty'])){echo $errors['name_empty'];}?>
    	</span>                       
      <input name = "schedule_name" 
      type = "text"
      id   = ""
      required
      placeholder=" Your Name " 
      class= "form-control">	                            
      </div>
      </div>

      <!-- frontend_email -->
      <div class=" col-xs-12  col-sm-4 col-md-4 theme-padding">
      <div class = "form-group">
      <label for   = "email">
      <?php echo esc_html( get_option('email_language') );  ?></label>
      <span class="public_error_message_color" >
     <?php if(isset( $errors['email_empty'])){echo $errors['email_empty'];}?>
      </span>                                                                                     
      <input  name = "schedule_email" type = "email" id = "" placeholder = "Your Email Address" 
	            class  =  "form-control"  required >	                   
       </div>
       </div>

        <!-- frontend_contact -->
        <div class="col-xs-12  col-sm-4 col-md-4 theme-padding">
        <div class = "form-group">
        <label for="phone">
        <?php echo esc_html( get_option('contact_language') ) ; ?></label>
        <span class="public_error_message_color" >
        <?php if(isset( $errors['phone_empty'])){echo $errors['phone_empty'];}?>
        </span>
      
          <input name  = "schedule_phone" 
                  type = "" 
                    id = ""
              required
           placeholder ="Your Phone Number "          
              class    = "form-control">	                         
    
        </div>
        </div>


        <!-- frontend_location -->
        <div class="col-xs-12  col-sm-4 col-md-4 theme-padding">                    
            <div class = "form-group">
                <label for="loc_id">
                <?php echo esc_html( get_option('category_language') ) ; ?></label>
                <div class="select-filters">
                <select   name = "schedule_cat_id" 
                          type = "text" 
                          id   = "mas_public_category_id"
                          required
                         class = "form-control">
                        <option> --- select ---  </option>
                       <?php 
                          if(method_exists('Msbdt_Category','msbdt_process_category_select_data')) :
                          global $wpdb ;
                          $category = Msbdt_Category::msbdt_process_category_select_data();    
                          $categories = $wpdb->get_results( $category['query']['select_all'], OBJECT ) ;
                               foreach ($categories as $category) : ?>                                 
                                  <option 
                                          value="<?php echo $category->cat_id ; ?>">
                                          <?php 
                                          echo ucwords($category->cat_name) ;

                                         ?>                                             
                                  </option>

                              <?php endforeach ; ?>
                        <?php endif ; ?>                      
                  </select>                                      
                 </div>                        
              </div>
          </div>

         

          <div class="col-xs-12  col-sm-4 col-md-4  theme-padding">
          <div class = "form-group">
          <label for="pro_id">
          <?php echo esc_html( get_option('service_language') ) ; ?></label>
          <span class="public_error_message_color" >
          <?php if(isset( $errors['phone_empty'])){echo $errors['phone_empty'];}?>
          </span> 
          <div class="select-filters" id = "display_service">       
          <select name = "schedule_ser_id"; 
                  type = "text"                   
                  id = "mas_public_service_id"                   
                            class= "form-control">      
           </select> 
           </div> 
           </div> 
           </div>  

           

            <div class="col-xs-12  col-sm-4 col-md-4 theme-padding">
            <div class = "form-group">
            <label for="pro_id">
            <?php echo esc_html( get_option('professional_language') ) ; ?></label> 
            <span class="public_error_message_color" >
            <?php if(isset( $errors['phone_empty'])){echo $errors['phone_empty'];}?>
            </span>
            <div class="select-filters" id = "">       
            <select name = "schedule_pro_id"; 
                    type = "text"                   
                      id = "display_professional"                   
                              class= "form-control">      
             </select> 
             </div> 
             </div> 
             </div>           
                        
                         <input type = "hidden" 
                                name = "schedule_date" 
                                id   = "schedule_date">

                         <input type = "hidden"  
                                name = "schedule_start_time" 
                                id   = "schedule_start_time">
                        
                         <input type = "hidden"  
                                name = "schedule_end_time" 
                                id   = "schedule_end_time">                      
                   
                    <div class="col-xs-12  col-sm-12 col-md-12 theme-padding">
                         <div class="calender_area">           
                             <div class="row theme-margin">
                                <div class="theme-padding">
                                       <p id="date">
                                       <span type="text" id="datepicker"></span>
                                       </p>
                                      
                                </div>
                             </div>
                          </div>
                    </div>
                                     
                    <div class="col-xs-12  col-sm-12 col-md-12  theme-padding">
                          <div class="calender_area">   
                              <div class="row theme-margin">
                                <div class="theme-padding">
                                    <div class="theme-padding">
                                      <p id="showTimeSlote"></p>
                                    </div> 
                                </div> 
                              </div> 
                           </div> 
                    </div> <!-- /. calender_area -->                  
                    <?php Msbdt_Public::msbdt_credit_card_modal();?>
                    <div class="col-sm-12 theme-padding">        
                                <div class = "form-group">
                                     <label for="int_val">
                                     <?php echo esc_html( get_option('message_language') ) ; ?></label>
                                     <span class="public_error_message_color">
                                     <?php if(isset($errors['message_empty'])){echo $errors['message_empty'];}?>
                                     </span> 
                                     <textarea name  = "schedule_message"
                                               class = "form-control"
                                               type  = "text"  
                                               id    = "altField"
                                               rows  = "5"
                                               required 
                                         placeholder = "Please Write Your Message"       
                                               ></textarea>
                                                                                      
                                </div>
                          </div>
                         <div class="col-xs-12  col-sm-12 col-md-12 theme-padding">           
                               <div class="public_submit_button">
              	                   <input type="submit" 
              	                    name="add_schedule_submit" 
              	                    class="submit_button_color" 
              	                    value="<?php echo esc_attr( get_option('frontend_button_language') ); ?>"> 
                              </div>              
                        </div>              
                     </div> <!-- .row theme-margin -->     
                  </div> <!-- .form-area -->     
                </form>
              </div><!-- .booking_area -->
            </div><!-- .col-md-8 col-md-offset-2 -->
          </div><!-- . row -->
      </div><!-- .multi-appointment row  -->

    <?php
    $output = ob_get_clean();
    return $output;
    } 

  /**
   * @since 1.0.0
   * @param Card modal calback function . 
   */
  public static function msbdt_credit_card_modal(){?>
     <div class="modal fade modal2" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
           <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">I will pay with Credit card</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Card Number</label>
                            <div class="col-sm-9">
                            <input class="form-control"
                                   type="text" 
                                   name = "card_number"
                                   placeholder="Card Number" 
                                   id="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Expiry Date</label>
                            <div class="col-sm-9">                                                                          
                              <input class="form-control date_slote" 
                                     type="date" 
                                     placeholder=""  
                                     name ="card_exp_date"
                                     id="">
                                        
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">CVS Code</label>
                            <div class="col-sm-9">
                                <input class  = "form-control" 
                                        type  = "number" 
                                        placeholder="CVS Code"  
                                        name  = "card_cvs_code" 
                                        id    = "example-number-input">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <div class="public_submit_button">
                         <input type="button" 
                                class="btn btn" 
                                data-dismiss="modal" 
                                value="Save">
                       </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal 2 -->
      <?php 
   
   }

}