<?php


/*==============================================================================
  Development by uzzal mondal (ujjal);
  Email : uzzal131@gmail.com.
  Date:03/05/2017(m/d/y)
  *==============================================================================*/

   /**
   *@param  Msbdt_Category 
   *@since  1.0.0
   */  


class Msbdt_Category{

   /**
   *@var protected. 
   *@since 1.0.0
   */ 
   protected static $category;

   
   /**
   *@param  msbdt_process_category_data($category)/// To Add Category. 
   *@since  1.0.0
   *@return $category (array) .
   */  
   public static function  msbdt_process_category_data($category = null ){
      self::$category = Msbdt_Category::msbdt_category_name_sanitize() ;
      self::$category = Msbdt_Category::msbdt_category_table(  self::$category );
      self::$category = Msbdt_Category::msbdt_add_category(  self::$category );  
      return self::$category;
   }



  /**
   *@param  msbdt_process_category_update_data($category)/// To Update Category. 
   *@since  1.0.0
   *@return $category (array) .
   */  

   public static function  msbdt_process_category_update_data($category = null ){
      self::$category = Msbdt_Category::msbdt_category_id_sanitize() ;
      self::$category = Msbdt_Category::msbdt_category_name_sanitize( self::$category ) ;
      self::$category = Msbdt_Category::msbdt_category_table(  self::$category );
      self::$category = Msbdt_Category::msbdt_update_category(  self::$category );  
      return self::$category;
   }


  /**
   *@param  msbdt_process_category_delete_data($category)/// To Delete Category. 
   *@since  1.0.0
   *@return $category (array) .
   */  

   public static function  msbdt_process_category_delete_data($category = null ){
      self::$category = Msbdt_Category::msbdt_category_id_sanitize() ;
      self::$category = Msbdt_Category::msbdt_category_table(  self::$category );
      self::$category = Msbdt_Category::msbdt_delete_category(  self::$category );  
      return self::$category;
   }



   /**
   *@param  msbdt_process_category_select_data($category)/// To Select Category. 
   *@since  1.0.0
   *@return $category (array) .
   */  

   public static function  msbdt_process_category_select_data($category = null ){
      self::$category = Msbdt_Category::msbdt_category_table(  self::$category );
      self::$category = Msbdt_Category::msbdt_select_category(  self::$category );  
      return self::$category;
   }

  

   /**
   *@param  msbdt_category_id_sanitize($category). 
   *@since  1.0.0
   *@return Category id .
   */  
   public static function  msbdt_category_id_sanitize($category = null ){   
      $category['add']['cat_id'] = intval( $_POST['cat_id']  );
      return $category;
   }



  /**
   *@param  msbdt_category_name_sanitize($category). 
   *@since  1.0.0
   *@return Category name .
   */  
   public static function  msbdt_category_name_sanitize($category = null ){  
      $category['add']['cat_name'] = sanitize_text_field( $_POST['cat_name']  );
      return $category;
   }



  /**
   *@param  msbdt_category_table($category). 
   *@since  1.0.0
   *@return table name .
   */  
   public static function  msbdt_category_table($category){
      global $wpdb ; 
      $category['table'] = $wpdb->prefix .'msbdt_category'; 
      return $category;     
   }



  /**
   *@param  msbdt_add_category($category). 
   *@since  1.0.0
   *@return status .
   */  

   public static function  msbdt_add_category($category){
       global $wpdb ;       
       if( !empty(  $category['add']['cat_name']) ):
       $add_new_category = $wpdb->insert( 
                           $category['table'], 
                           array(                  
                            'cat_id' => '',
                            'cat_name'=> $category['add']['cat_name'],      
                            'status' => '1' ));
       
      $category['action_status'] = ($add_new_category)? 'no_error_data_save_successfully' : 'something_is_error';
      endif;
      return  $category ; 
   }

   /**
   *@param  msbdt_update_category($category). 
   *@since  1.0.0
   *@return status .
   */  
  public static function  msbdt_update_category($category){
         global $wpdb ;            
        
         $update_category = $wpdb->update( 
                          $category['table'], 
                          array( 
                            'cat_name' => $category['add']['cat_name'], // column & new value
                          ), 
                          array( 'cat_id' => $category['add']['cat_id'] ) ,  // where clause(s)
                          array( '%s') , // column & new value type.
                          array( '%d' ) // where clause(s) format types  
                        ); 
       
        $category['action_status'] = ($update_category)? 'no_error_data_update_successfully' : 'something_is_error';
        return  $category ; 
   }


 
   /**
   *@param  msbdt_delete_category($category). 
   *@since  1.0.0
   *@return status.
   */  
  public static function  msbdt_delete_category($category){

         global $wpdb ;        
         $delete = $wpdb->delete( 
                        $category['table'],   // table name 
                        array( 'cat_id' => $category['add']['cat_id'] ),  // where clause 
                        array( '%d' )      // where clause data type (int)
                    );    
        $category['action_status'] = ($delete)? 'delete_successfully' : 'something_is_error';
        return  $category ;
   }

  /**
   *@param  msbdt_select_category($category = null). 
   *@since  1.0.0
   *@return query.
   */  
  public static function  msbdt_select_category( $category = null){     
          $table_name = $category['table'];    
          $category['query']['select_all']  = "SELECT * FROM  $table_name  WHERE 1 ORDER BY cat_id DESC ";    
          return  $category ;                         
  }

 }/*  / class Msbdt_Category */