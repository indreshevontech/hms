<?php


/*==============================================================================
  Development by uzzal mondal (ujjal);
  Email : uzzal131@gmail.com.
  Date:03/05/2017(m/d/y)
 *==============================================================================*/

  /**
   *@param  Msbdt_Service 
   *@since  1.0.0
   */  

class Msbdt_Service{

   
  /**
   *@var protected. 
   *@since 1.0.0
   */ 
   protected static $service;


   /**
   *@param  msbdt_process_service_data($service)/// To Add Service. 
   *@since  1.0.0
   *@return $service (array) .
   */  

   public static function  msbdt_process_service_data($service = null ){
      self::$service = Msbdt_Service::msbdt_service_sanitize() ;
      self::$service = Msbdt_Service::msbdt_service_table(  self::$service );
      self::$service = Msbdt_Service::msbdt_add_service(  self::$service ); 
      return self::$service;
   }


  /**
   *@param  msbdt_process_service_update_data($service)/// To Update Service. 
   *@since  1.0.0
   *@return $service (array) .
   */  
    public static function  msbdt_process_service_update_data($service = null ){
      self::$service = Msbdt_Service::msbdt_service_id_sanitize() ;
      self::$service = Msbdt_Service::msbdt_service_sanitize( self::$service ) ;
      self::$service = Msbdt_Service::msbdt_service_table(  self::$service );
      self::$service = Msbdt_Service::msbdt_update_service(  self::$service );  
      return self::$service;
   }
   

  /**
   *@param  msbdt_process_service_delete_data($service)/// To Delete Service. 
   *@since  1.0.0
   *@return $service (array) .
   */  
   public static function  msbdt_process_service_delete_data($service = null ){
      self::$service = Msbdt_Service::msbdt_service_id_sanitize() ;
      self::$service = Msbdt_Service::msbdt_service_table(  self::$service );
      self::$service = Msbdt_Service::msbdt_delete_service(  self::$service );  
      return self::$service;
   }

   /**
   *@param  msbdt_service_id_sanitize($service)/// To Sanitize Service Id. 
   *@since  1.0.0
   *@return $service (array) .
   */  
   public static function  msbdt_service_id_sanitize($service = null ){   
      $service['add']['ser_id'] = intval( $_POST['ser_id']  );
      return $service;
   }


  /**
   *@param  msbdt_service_sanitize($service)/// To json_encode and Sanitize Service Name. 
   *@since  1.0.0
   *@return $service (array) .
   */  
   public static function  msbdt_service_sanitize($service = null ){  
       $service['add']['category'] = json_encode($_POST['category']);
       $service['add']['ser_name'] = sanitize_text_field( $_POST['ser_name']  );
      return $service;
   }


   /**
   *@param  msbdt_service_table($service)/// 
   *@since  1.0.0
   *@return $service (array) .
   */  
  public static function  msbdt_service_table($service){
      global $wpdb ; 
      $service['table'] = $wpdb->prefix .'msbdt_service';
      return $service;     
   }


  /**
   *@param  msbdt_add_service($service)/// To Add
   *@since  1.0.0
   *@return $service (array) .
   */  
   public static function  msbdt_add_service($service){
    
        global $wpdb ;
        $table_name = $service['table'];       
        $sql = " INSERT INTO  $table_name (`ser_id`, `cat_id`, `ser_name`, `status`) 
                 VALUES ( 
                 '', 
                 '".$service['add']['category']."' ,
                 '".$service['add']['ser_name']."' ,
                 '1')";
        $add_new_service  =  $wpdb->query($sql);
        $service['action_status'] = ($add_new_service)? 'no_error_data_save_successfully' : 'something_is_error';
    
      return  $service ;
   }
   

 /**
   *@param  msbdt_update_service($service)/// 
   *@since  1.0.0
   *@return $service (array) .
   */  
   public static function  msbdt_update_service($service){
          
          global $wpdb ;          
          $table = $service['table'];
          $id = $service['add']['ser_id'];
          $cat_id = $service['add']['category'];
          $ser_name = $service['add']['ser_name']; 
          $sql = " UPDATE {$table}  SET `cat_id`='".$cat_id."',`ser_name`='".$ser_name."' WHERE `ser_id`= '".$id."' ";
          $update_service = $wpdb->query($sql);
          $category['action_status'] = ($update_service)? 'no_error_data_update_successfully' : 'something_is_error';
          return  $category ; 
                   
        
   }


 /**
   *@param msbdt_delete_service($category)
   *@since  1.0.0
   *@return $service (array) .
   */  
  public static function msbdt_delete_service($category){

         global $wpdb ;        
         $delete =  $wpdb->delete( 
                    $category['table'],   // table name 
                    array( 'ser_id' => $category['add']['ser_id'] ),  // where clause 
                    array( '%d' )      // where clause data type (int)
                    );    
        $category['action_status'] = ($delete)? 'delete_successfully' : 'something_is_error';
        return  $category ;
  } 


  /**
   *@param  msbdt_select_added_all_service( $service = null)
   *@since  1.0.0
   *@return $service (array) .
   */  
  public static function  msbdt_select_added_all_service( $service = null){
          global $wpdb ;  
          $table_name = $wpdb->prefix .'msbdt_service';    
          $service['query']['select_all']  = "SELECT * FROM  $table_name  WHERE 1 ORDER BY ser_id DESC ";       
          return  $service ;                         
  }



  /**
   *@param  msbdt_select_added_one_service( $id = null )/// 
   *@since  1.0.0
   *@return $service (array) .
   */  
  public static function  msbdt_select_added_one_service( $id = null ){
          global $wpdb ;  
          $table_name = $wpdb->prefix .'msbdt_service';    
          $service = "SELECT * FROM  $table_name  WHERE ser_id = $id "; 
          $service = $wpdb->get_row($service);      
          return  $service ;                         
  }
   
 }/*  / class Msbdt_Category */

