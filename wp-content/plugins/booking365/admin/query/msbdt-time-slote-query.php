<?php


/*==============================================================================
  Development by uzzal mondal (ujjal);
  Email : uzzal131@gmail.com.
  Date:03/05/2017(m/d/y)
 *==============================================================================*/

   /**
   *@param  Msbdt_Schedule 
   *@since  1.0.0
   */  


class Msbdt_Schedule{

  
/**
 *@var protected. 
 *@since 1.0.0
 */  
  protected static $schedule;

  /**
   *@param  msbdt_process_schedule_data( $schedule = null )/// To Add schedule. 
   *@since  1.0.0
   *@return $schedule (array) .
   */  
  public static function  msbdt_process_schedule_data( $schedule = null ){
      self::$schedule = Msbdt_Schedule::msbdt_schedule_sanitize() ;
      self::$schedule = Msbdt_Schedule::msbdt_schedule_table(  self::$schedule );
      self::$schedule = Msbdt_Schedule::msbdt_add_schedule(  self::$schedule ); 
      return self::$schedule;     
   } 

  
  /**
   *@param  msbdt_select_schedule_data( $schedule = null )/// To Select all schedule. 
   *@since  1.0.0
   *@return $schedule (array) .
   */  
  public static function  msbdt_select_schedule_data( $schedule = null ){
      self::$schedule = Msbdt_Schedule::msbdt_schedule_table(  self::$schedule );
      self::$schedule = Msbdt_Schedule::msbdt_select_all_schedule(  self::$schedule ); 
      return self::$schedule;
   } 

 
  /**
   *@param  msbdt_update_schedule_data( $schedule = null )/// To update. 
   *@since  1.0.0
   *@return $schedule (array) .
   */  
   public static function  msbdt_update_schedule_data( $schedule = null ){
      self::$schedule = Msbdt_Schedule::msbdt_schedule_sanitize() ;
      self::$schedule = Msbdt_Schedule::msbdt_schedule_table(  self::$schedule );
      self::$schedule = Msbdt_Schedule::msbdt_edit_schedule(  self::$schedule ); 
      return self::$schedule;  
   } 
    


  /**
   *@param  msbdt_delete_schedule_data( $schedule = null )/// To delect. 
   *@since  1.0.0
   *@return $schedule (array) .
   */  
   public static function  msbdt_delete_schedule_data( $schedule = null ){
      self::$schedule = Msbdt_Schedule::msbdt_schedule_table(  self::$schedule );
      self::$schedule = Msbdt_Schedule::msbdt_delete_schedule(  self::$schedule ); 
      return self::$schedule; 
      
   } 


  /**
   *@param  msbdt_schedule_table( $schedule = null )/// To findout table name. 
   *@since  1.0.0
   *@return $schedule (array) .
   */ 
   public static function msbdt_schedule_table( $schedule = null ){
      global $wpdb ; 
      $schedule['table'] = $wpdb->prefix .'msbdt_time_slote';
      return $schedule;   
   }
   


   /**
   *@param  msbdt_select_all_schedule( $schedule = null ). 
   *@since  1.0.0
   *@return $schedule (array) .
   */ 
   public static function msbdt_select_all_schedule( $schedule = null  ){
      $table_name = $schedule['table'];
      $schedule['query']['select_all']  = "SELECT * FROM  $table_name  WHERE 1 ORDER BY slot_id DESC " ;       
      return $schedule;      
   }

  

  /**
   *@param  msbdt_schedule_sanitize( $schedule = null )/
   *@since  1.0.0
   *@return $schedule (array) .
   */ 
   public static function msbdt_schedule_sanitize( $schedule = null ){

       
       $schedule['slot_id']    = isset( $_POST['slot_id'] ) ?
                                 intval( $_POST['slot_id'] ) :'';
       $schedule['pro_id']     = intval($_POST['pro_id']);
       $schedule['work_date']  = sanitize_text_field($_POST['work_date']);      
       $schedule['start_time'] = sanitize_text_field($_POST['start_time']);
       $schedule['end_time']   = sanitize_text_field($_POST['end_time']);
       $schedule['int_val']    = isset( $_POST['int_val'] ) ?
                                 intval( $_POST['int_val'] ) :'';
       return $schedule;   
   }


  
  /**
   *@param  msbdt_add_schedule( $schedule = null )/// $count times , add schedule 
   *@since  1.0.0
   *@return $schedule (array) .
   */ 
   public static function msbdt_add_schedule( $schedule = null ){
        
        global $wpdb ; 
        $dateArray = explode(",", $schedule['work_date']);  
        $count = count( $dateArray);            
        $table_name = $schedule['table'];
        $syn = 0;
                           
        for($i = 0; $i < $count ; $i++):
                                   
          $date = new DateTime($dateArray[$i]);
          $schedule['work_date'] = $date->format('Y:m:d');

          $schedule['start_time'] = new DateTime($schedule['start_time']);
          $schedule['start_time'] = $schedule['start_time']->format('H:i:s');

          $schedule['end_time'] = new DateTime($schedule['end_time']);
          $schedule['end_time'] = $schedule['end_time']->format('H:i:s');
	  
	    $result_conflict = $wpdb->get_var( "SELECT count(slot_id) FROM `wp_msbdt_time_slote` WHERE pro_id='".$schedule['pro_id']."' AND work_date='".$schedule['work_date']."' AND (('".$schedule['start_time']."' >= start_time AND '".$schedule['start_time']."' < end_time) OR ('".$schedule['end_time']."' > start_time AND '".$schedule['end_time']."' <= end_time))" );
      
      if($result_conflict>0){
	  $schedule['action_status'] =  'something_is_error';                    
     return $schedule;  
      }

          $query = $wpdb->get_results("
                           INSERT INTO `$table_name`
                           (`slot_id`, `pro_id`, `work_date`, `start_time`, `end_time`, `int_val`, `status`)
                           VALUES (  
                                  '', 
                                  '".$schedule['pro_id']."',
                                  '".$schedule['work_date']."',
                                  '".$schedule['start_time']."',
                                  '".$schedule['end_time']."',
                                  '".$schedule['int_val']."',
                                  '1' ) ;" 
                            ) ;             

            $syn++;
       
        endfor ;

         $schedule['action_status'] = ( $syn  == $count )? 'no_error_data_save_successfully' : 'something_is_error';

    return $schedule;
   }
  
   
   /**
   *@param  msbdt_edit_schedule( $schedule = null )/
   *@since  1.0.0
   *@return $schedule (array) .
   */ 
   public static function msbdt_edit_schedule( $schedule = null  ){

      global $wpdb ; 
      $table_name = $schedule['table'];
      $date = new DateTime($schedule['work_date']);
      $schedule['work_date'] = $date->format('Y:m:d');

      $schedule['start_time'] = new DateTime($schedule['start_time']);
      $schedule['start_time'] = $schedule['start_time']->format('H:i:s');

      $schedule['end_time'] = new DateTime($schedule['end_time']);
      $schedule['end_time'] = $schedule['end_time']->format('H:i:s');
      
      
      $result_conflict = $wpdb->get_var( "SELECT count(slot_id) FROM `wp_msbdt_time_slote` WHERE pro_id='".$schedule['pro_id']."' AND work_date='".$schedule['work_date']."' AND (('".$schedule['start_time']."' >= start_time AND '".$schedule['start_time']."' < end_time) OR ('".$schedule['end_time']."' > start_time AND '".$schedule['end_time']."' <= end_time))" );
      
      if($result_conflict>0){
	  $schedule['action_status'] =  'something_is_error';                    
     return $schedule;  
      }
     
      $update_schedule = $wpdb->update( 
      $table_name , 
      array( 
      'pro_id'     => $schedule['pro_id'] , // column & new value
      'work_date'  => $schedule['work_date'] , // column & new value
      'start_time' => $schedule['start_time'] , // column & new value
      'end_time'   => $schedule['end_time']  // column & new value  
       ), 
      array( 'slot_id' => $schedule['slot_id'] ) ,  // where clause(s)
      array( '%d', '%s', '%s', '%s') , // column & new value type.
      array( '%d' ) // where clause(s) format types  
      ); 

     $schedule['action_status'] = ($update_schedule)? 'no_error_data_update_successfully' : 'something_is_error';                    
     return $schedule;      
   }



  /**
   *@param  msbdt_delete_schedule( $schedule = null )/// To delete Schedule
   *@since  1.0.0
   *@return $schedule (array) .
   */ 
  public static function msbdt_delete_schedule($schedule = null){

      global $wpdb ; 
      $table_name = $schedule['table']; 
      $schedule['slot_delete_id'] = intval($_POST['slot_delete_id']);
      $delete = $wpdb->delete( 
      $table_name ,      // table name 
      array( 'slot_id' => $schedule['slot_delete_id'] ),  // where clause 
      array( '%d' )      // where clause data type (int)
      );
      $schedule['action_status'] = ($delete)? 'delete_successfully' : '';
      return $schedule;  
        
  } 

} /* / class Msbdt_Schedule */