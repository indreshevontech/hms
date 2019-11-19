<?php 
class Msbdt_Booking_Public{

   public static function msbdt_public_data_validation($schedule = null){

     $schedule['name']        = sanitize_text_field( $_POST['schedule_name']  );          
     $schedule['email']       = sanitize_email( $_POST['schedule_email'] );
     $schedule['phone']       = sanitize_text_field( $_POST['schedule_phone']  );
     $schedule['cat_id']      = (isset($_POST['schedule_ser_id']))? 
                                 intval( $_POST['schedule_ser_id'] ):'';
     $schedule['ser_id']      = (isset($_POST['schedule_ser_id']))? 
                                 intval( $_POST['schedule_ser_id'] ):'';
     $schedule['pro_id']      = (isset($_POST['schedule_pro_id']))? 
                                 intval( $_POST['schedule_pro_id'] ):'';
     $schedule['date']        = sanitize_text_field( $_POST['schedule_date'] );
     $schedule['start_time']  = sanitize_text_field( $_POST['schedule_start_time'] );
     $schedule['end_time']    = sanitize_text_field( $_POST['schedule_end_time'] );
     $schedule['payment']     = sanitize_text_field( $_POST['payment'] );
     $schedule['message']     = sanitize_text_field( $_POST['schedule_message'] );
     $schedule['developer']   = sanitize_text_field( 'uzzal mondal(ujjal)' );
     $schedule['author']      = sanitize_text_field( 'uzzal mondal(ujjal mondal)' );

     return $schedule ;

    }

  public static function msbdt_public_data_empty_checker($schedule){

           $schedule['name_empty'] = (empty($schedule['name']))? 'required': '' ;
           $schedule['email_empty'] = (empty($schedule['email']))? 'required': '' ;
           $schedule['phone_empty'] = (empty($schedule['phone']))? 'required': '' ;
           $schedule['category_empty'] = (empty($schedule['cat_id']))? 'required': '' ;
           $schedule['service_empty'] = (empty($schedule['ser_id']))? 'required': '' ;
           $schedule['professional_empty'] = (empty($schedule['pro_id']))? 'required': '' ;
           $schedule['date_empty'] = (empty($schedule['date']))? 'required': '' ;
           $schedule['start_empty'] = (empty($schedule['start_time']))? 'required': '' ;
           $schedule['message_empty'] = (empty($schedule['message']))? 'required': '' ;

          if( (empty($schedule['name']))  &&
              (empty($schedule['email'])) &&
              (empty($schedule['phone'])) &&
              (empty($schedule['ser_id'])) &&
              (empty($schedule['pro_id'])) &&
              (empty($schedule['date'])) &&
              (empty($schedule['start_time'])) &&
              (empty($schedule['message']))){
               $schedule['all_empty_field'] = 'all_empty_field';
               return $schedule;
          }

           return $schedule;

    }

  public static function msbdt_public_data_insert_table($schedule=null){
          
      global $wpdb;      
      $schedule['table_booking'] = $wpdb->prefix.'msbdt_booking';
      $schedule['table_paymentcard'] = $wpdb->prefix .'msbdt_paymentcard';
      return $schedule;

   }

  public static function msbdt_public_data_insert_status($schedule=null){
       $schedule['status'] = '4' ; 
       return $schedule;

   }

   public static function msbdt_public_data_insert($schedule=null){
            global $wpdb;    
            $date = new DateTime($schedule['date']);
            $schedule['date']       = $date->format('Y-m-d');
            $schedule['start_time'] = new DateTime($schedule['start_time']);
            $schedule['start_time'] = $schedule['start_time']->format('H:i:s');
            $schedule['end_time']   = new DateTime($schedule['end_time']);
            $schedule['end_time']   = $schedule['end_time']->format('H:i:s');
            $table_booking = $schedule['table_booking']; 
            $sql = "INSERT INTO  $table_booking  
                   (`id`, `ser_id`, `pro_id`,  `name`, `email`, `phone`, `date`, `start_time`,  `end_time`,`payment`,`message`, `status`)
                    VALUES 
                    ('',
                     '".$schedule['ser_id']."',
                     '".$schedule['pro_id']."',
                     '".$schedule['name']."',
                     '".$schedule['email']."',
                     '".$schedule['phone']."',
                     '".$schedule['date']."',
                     '".$schedule['start_time']."',
                     '".$schedule['end_time']."',
                     '".$schedule['payment']."',
                     '".$schedule['message']."',
                     '".$schedule['status']."' ) " ;
            
                 $schedule['booking_sql'] = $wpdb->query($sql);                                 
                 
                 $schedule['last_applicant_id'] = $wpdb->insert_id  ;
  

          return $schedule;

   }

   public static function msbdt_paymentcard_insert_data( $schedule =null){

         global $wpdb;   
         $schedule['payment'] = sanitize_text_field( $_POST['payment']  ); 
         $schedule['card_number'] = sanitize_text_field( $_POST['card_number']  ); 
         $schedule['card_exp_date'] = sanitize_text_field( $_POST['card_exp_date']  );
         $schedule['card_cvs_code'] = sanitize_text_field( $_POST['card_cvs_code']  );
         $card_exp_date = new DateTime($schedule['card_exp_date']);
         $schedule['card_exp_date'] = $card_exp_date->format('Y-m-d');
         $table_paymentcard = $schedule['table_paymentcard'];  

         $sql = "INSERT INTO  $table_paymentcard  
                (`id`, `applicant_id`, `card_number`, `card_payment`, `card_exp_date`, `card_cvs_code`, `status`)VALUES 
                ('',
                 '".$schedule['last_applicant_id']."',
                 '".$schedule['card_number']."',
                 '".$schedule['payment']."',
                 '".$schedule['card_exp_date']."',
                 '".$schedule['card_cvs_code']."',
                 '".$schedule['status']."' ) " ;
        
         $schedule['payment'] = $wpdb->query($sql);


      return  $schedule ;


   }

	 public static function msbdt_public_appointment_process($schedule = ''){
   
        global $wpdb;      
        $table_mps_booking  = $wpdb->prefix.'msbdt_booking';
        $table_paymentcard  = $wpdb->prefix .'msbdt_paymentcard';       
        $errors = array();        
        $add_schedule_submit = isset( $_POST['add_schedule_submit'] ) ?
                               sanitize_text_field( $_POST['add_schedule_submit'] ) :'';

        if( isset($add_schedule_submit) && $add_schedule_submit !== '' ):                      
          
           $schedule = Msbdt_Booking_Public::msbdt_public_data_validation();
           $schedule = Msbdt_Booking_Public::msbdt_public_data_empty_checker($schedule);
           $schedule = Msbdt_Booking_Public::msbdt_public_data_insert_table($schedule);         
           $schedule = Msbdt_Booking_Public::msbdt_public_data_insert_status($schedule);                     
           if(!empty($schedule['all_empty_field'])) :
             return $schedule ;
           else :   
               $schedule = Msbdt_Booking_Public::msbdt_public_data_insert($schedule);
                // mail to applicant for requesting	
               if($schedule['last_applicant_id']){
          
              $mail = Msbdt_Admin::msbdt_email_sender_with_action($schedule['last_applicant_id'] , '4' );    
               }

               if ( isset($_POST['payment']) && $_POST['payment'] == 'card') {    

                  $schedule = Msbdt_Booking_Public::msbdt_paymentcard_insert_data( $schedule );

                }elseif (isset($_POST['payment']) && $_POST['payment'] == 'paypal'){
                      if( get_option('paypal_enable') ) : 
                       $action = '';
                       $action .= 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&' ;
                       $action .= 'business='.get_option('paypal_resciver_email') ;
                       $action .= '&lc=BM&' ;
                       $action .= 'item_name=appointment' ; 
                       $action .= '%20pay&' ;
                       $action .= 'amount='.get_option('paypal_amount') ;
                       $action .= '&currency_code='.get_option('paypal_currency') ;
                       $action .= '&button_subtype=services&no_note=0&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHostedGuest' ;
                       else:
                       $action = $_SERVER['QUERY_STRING'];
                       endif ;
                      ?>
                      <script>
                      window.location.replace("<?php echo $action; ?>");
                      </script>
                  <?php 
                 }                                                   
                 return Msbdt_Booking_Public::msbdt_google_calender_date_time($schedule);           
           endif ;
        endif ;
    }
 
 public static function msbdt_google_calender_date_time( $calender){
              
                      $dateArray = explode("-",$calender['date']);
                      $dateConcatenet ='';
                      foreach ($dateArray as $date) {
                        $dateConcatenet .= $date;
                      }

                      $start_timeArray = explode(":",$calender['start_time']);
                      $start_timeConcatenet ='';
                      foreach ($start_timeArray as $time) {
                        $start_timeConcatenet .= $time;
                      }
                      

                      $start_timeArray = explode(":",$calender['end_time']);
                      $end_timeConcatenet ='';
                      foreach ($start_timeArray as $time) {
                        $end_timeConcatenet .= $time;
                      }

                      $calender['dateConcatenet'] = $dateConcatenet;
                      $calender['start_timeConcatenet'] = $start_timeConcatenet;
                      $calender['end_timeConcatenet'] = $end_timeConcatenet;
                      $calender['status'] = 'success';
                      
                      return  Msbdt_Booking_Public::msbdt_google_calender_address($calender);  ;
                     
    }

  public static function msbdt_google_calender_title(){        
      $title = 'Booking365'; 
      return $title ;
   } 
    
   public static function msbdt_google_calender_address( $calender){ 
        $calender['title'] = Msbdt_Booking_Public::msbdt_google_calender_title($calender);
        $address = Msbdt_Service::msbdt_select_added_one_service( $calender['ser_id']  ) ;
        $calender['address'] = $address->ser_name; 
        return  Msbdt_Booking_Public::msbdt_google_calender_link($calender);  ;
   }

   public static function msbdt_google_calender_link( $calender){
                    
                     $calendarLink  = 'https://calendar.google.com/calendar/render?';
                     $calendarLink .= 'action=TEMPLATE';
                     $calendarLink .= '&text=';
                     $calendarLink .=  $calender['title'];
                     $calendarLink .= '&dates=';
                     $calendarLink .= $calender['dateConcatenet'];
                     $calendarLink .= 'T';
                     $calendarLink .= $calender['start_timeConcatenet'];
                     $calendarLink .= 'Z';
                     $calendarLink .= '/';
                     $calendarLink .= $calender['dateConcatenet'];
                     $calendarLink .= 'T';
                     $calendarLink .=  $calender['end_timeConcatenet'];
                     $calendarLink .= 'Z';
                     $calendarLink .= '&details=';
                     $calendarLink .=  $calender['message'];
                     $calendarLink .= '&location=';
                     $calendarLink .=  $calender['address'] ;
                     $calendarLink .= '&sf=true&output=xml#eventpage_6';
                     $calender['link'] =  $calendarLink ;
                     
                     return $calender;
   }
} /* / class Msbdt_Booking_Public  */