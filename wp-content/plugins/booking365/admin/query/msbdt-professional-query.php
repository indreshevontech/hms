<?php 

  /*==============================================================================
      Development by uzzal mondal (ujjal);
      Email : uzzal131@gmail.com.
      Date:03/05/2017(m/d/y)
   *==============================================================================*/

   /**
   *@param  Msbdt_Professional 
   *@since  1.0.0
   */  

class Msbdt_Professional{


   /**
   *@var protected. 
   *@since 1.0.0
   */ 
   protected static $professional;



   /**
   *@param  msbdt_process_professional_data(  $professional = null  )/// To Add Professional. 
   *@since  1.0.0
   *@return $professional (array) .
   */  
   public static function  msbdt_process_professional_data($professional = null ){
      self::$professional = Msbdt_Professional::msbdt_professional_sanitize() ;
      self::$professional = Msbdt_Professional::msbdt_professional_table(  self::$professional );
      self::$professional = Msbdt_Professional::msbdt_add_professional(  self::$professional ); 
      return self::$professional;
   } 


  /**
   *@param  msbdt_update_professional_data(  $professional = null  )/// To Update Professional. 
   *@since  1.0.0
   *@return $professional (array) .
   */  

   public static function  msbdt_update_professional_data($professional = null ){
      self::$professional = Msbdt_Professional::msbdt_professional_sanitize() ;
      self::$professional = Msbdt_Professional::msbdt_professional_sanitize_pro_id(  self::$professional );
      self::$professional = Msbdt_Professional::msbdt_professional_table(  self::$professional );
      self::$professional = Msbdt_Professional::msbdt_edit_professional(  self::$professional ); 
      return self::$professional;
   } 



  /**
   *@param  msbdt_select_professional_data(  $professional = null  )/// To Update Professional. 
   *@since  1.0.0
   *@return $professional (array) .
   */  

   public static function  msbdt_select_professional_data( $professional = null ){
      self::$professional = Msbdt_Professional::msbdt_professional_table(  self::$professional );
      self::$professional = Msbdt_Professional::msbdt_select_all_professional(  self::$professional ); 
      return self::$professional;
   } 


  /**
   *@param  msbdt_delete_professional_data(  $professional = null  )/// To Delete Professional. 
   *@since  1.0.0
   *@return $professional (array) .
   */  
   public static function  msbdt_delete_professional_data( $professional = null ){
      self::$professional = Msbdt_Professional::msbdt_professional_table(  self::$professional );
      self::$professional = Msbdt_Professional::msbdt_professional_sanitize_pro_id(  self::$professional );
      self::$professional = Msbdt_Professional::msbdt_process_professional_delete_data(  self::$professional ); 
      return self::$professional;
   } 


   
   /**
   *@param  msbdt_professional_sanitize_pro_id(  $professional = null  )/// To Sanitize Professional Id. 
   *@since  1.0.0
   *@return $professional (array) .
   */  
   public static function  msbdt_professional_sanitize_pro_id( $professional = null ){  
      $professional['add']['pro_id']= intval( $_POST['pro_id']  );
      return $professional;
   }


  /**
   *@param  msbdt_professional_sanitize(  $professional = null  )/// To Sanitize Professional data. 
   *@since  1.0.0
   *@return $professional (array) .
   */  
   public static function  msbdt_professional_sanitize( $professional = null ){

      if(isset($_POST['fname']) && !empty($_POST['fname'])):
      $professional['add']['fname']= sanitize_text_field($_POST['fname']);
      else:
      return ;
      endif;

      if(isset($_POST['lname']) && !empty($_POST['lname'])):
      $professional['add']['lname']= sanitize_text_field($_POST['lname']);
      else:
      return ;
      endif;

      if(isset($_POST['service']) && !empty($_POST['service'])):
      $professional['add']['service']= json_encode($_POST['service']);
      else:
      return ;
      endif;

      if(isset($_POST['sex']) && !empty($_POST['sex'])):
      $professional['add']['sex']= sanitize_text_field($_POST['sex']);
      else:
      return ;
      endif;
      
      if(isset($_POST['email']) && !empty($_POST['email'])):
      $professional['add']['email']= sanitize_text_field($_POST['email']);
      else:
      return ;
      endif;
     
      $professional['add']['contact_no']= sanitize_text_field($_POST['contact_no']);
      $professional['add']['website']= sanitize_text_field($_POST['website']);
      $professional['add']['biographical_info']= sanitize_text_field($_POST['biographical_info']);
      return $professional;
   }



  /**
   *@param  msbdt_professional_table(  $professional = null  )/// To Select Professional Table. 
   *@since  1.0.0
   *@return $professional (array) .
   */  
   public static function  msbdt_professional_table($professional = null){
      global $wpdb ; 
      $professional['table'] = $wpdb->prefix .'msbdt_professional';
      return $professional;     
   }
  

  /**
   *@param  msbdt_select_all_professional(  $professional = null  )/// To Select Professional data. 
   *@since  1.0.0
   *@return $professional (array) .
   */  
   public static function msbdt_select_all_professional( $professional = null ){
      $table_name = $professional['table'];
      $professional['query']['select_all']  = "SELECT * FROM  $table_name  WHERE 1 ORDER BY pro_id DESC " ;       
      return $professional;                       
   } 


   /**
   *@param  msbdt_select_professional(  $id   )/// To Select One Professional data. 
   *@since  1.0.0
   *@return $professional (array) .
   */  
   public static function msbdt_select_professional( $id ){
      global $wpdb ; 
      $professional['table'] = $wpdb->prefix .'msbdt_professional';
      $table_name = $professional['table'];
      $professional['query']['select']  = "SELECT * FROM  $table_name  WHERE pro_id = $id ORDER BY pro_id DESC " ;       
      return $professional;                       
   } 


   /**
   *@param  msbdt_add_professional(  $id   )/// To Add Professional data. 
   *@since  1.0.0
   *@return $professional (array) /// status .
   */  
   public static function  msbdt_add_professional($professional){  
      global $wpdb ;           
       $add_professional =  $wpdb->insert( 
                                 $professional['table'], 
                                 array(                  
                                    'pro_id'            => '',
                                    'fname'             => $professional['add']['fname'],
                                    'lname'             => $professional['add']['lname'],
                                    'ser_id'            => $professional['add']['service'],
                                    'sex'               => $professional['add']['sex'],
                                    'email'             => $professional['add']['email'],
                                    'contact_no'        => $professional['add']['contact_no'],
                                    'website'           => $professional['add']['website'] ,
                                    'biographical_info' => $professional['add']['biographical_info'],
                                    'status'            => '1'));

      $professional['action_status'] = ($add_professional)? 
      'no_error_data_save_successfully' : 
      'something_is_error';
     
      return  $professional ; 
     
   }



  /**
   *@param  msbdt_edit_professional( $professional   )/// To Update Professional data. 
   *@since  1.0.0
   *@return $professional (array) /// status .
   */  
  public static function msbdt_edit_professional($professional){
     global $wpdb ;        
     $update_professional = $wpdb->update( 
                      $professional['table'],
                      array( 
                        'fname'             => $professional['add']['fname'] , // column & new value
                        'lname'             => $professional['add']['lname'] , // column & new value
                        'ser_id'            => $professional['add']['service'],
                        'sex'               => $professional['add']['sex'] , // column & new value
                        'email'             => $professional['add']['email'] , // column & new value
                        'contact_no'        => $professional['add']['contact_no'] , // column & new value
                        'website'           => $professional['add']['website'] , // column & new value
                        'biographical_info' => $professional['add']['biographical_info']  // column & new value
                     ), 
                      array( 'pro_id' => $professional['add']['pro_id'] ) ,  // where clause(s)
                      array( '%s' , '%s','%s','%s', '%s' , '%s' , '%s', '%s') , 
                      // column & new value type.
                      array( '%d' ) // where clause(s) format types  
                    ); 
                          
       $professional['action_status'] = ($update_professional)? 'no_error_data_update_successfully' : 'something_is_error'; 
       return  $professional ;
  } 

  /**
   *@param  msbdt_process_professional_delete_data( $professional   )/// To Delete Professional data. 
   *@since  1.0.0
   *@return $professional (array) /// status .
   */   
  public static function msbdt_process_professional_delete_data($professional){

         global $wpdb ;   
	  /* delete data from time slot */
	 $table_time_slote   = $wpdb->prefix .'msbdt_time_slote';
         $delete_slote =  $wpdb->delete( 
                    $table_time_slote,  // table name 
                    array( 'pro_id' => $professional['add']['pro_id'] ),  // where clause 
                    array( '%d' )      // where clause data type (int)
                    );    
	 /* delete data from booking */
	$table_booking      = $wpdb->prefix .'msbdt_booking';
         $delete_booking =  $wpdb->delete( 
                    $table_booking,  // table name 
                    array( 'pro_id' => $professional['add']['pro_id'] ),  // where clause 
                    array( '%d' )      // where clause data type (int)
                    );    
         $delete =  $wpdb->delete( 
                    $professional['table'],  // table name 
                    array( 'pro_id' => $professional['add']['pro_id'] ),  // where clause 
                    array( '%d' )      // where clause data type (int)
                    );   
	
	   
        $category['action_status'] = ($delete)? 'delete_successfully' : 'something_is_error';
        return  $category ;
  } 
  
} /*  / class Msbdt_Professional */