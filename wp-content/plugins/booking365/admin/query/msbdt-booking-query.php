<?php 
class Msbdt_Booking{

  /**
   *@param  mas_booking_action($id = '', $status='' ):- can delete or update. 
   *@since  1.0.0
   *@return true.
   */  

   public static function  msbdt_mas_booking_action($id = '', $status='' ){
         
          global $wpdb;      
          $table_name = $wpdb->prefix.'msbdt_booking';         
          if($status=='3'):       
          $delete = $wpdb->delete( 
                        $table_name ,      // table name 
                        array( 'id' => $id ),  // where clause 
                        array( '%d' )      // where clause data type (int)
                    );
          
          else :
          $action = $wpdb->update($table_name , array('status' => $status) , array('id' => $id) );
          endif;
          return ;
                 
   }

  /**
   *@param $query , sting variable. 
   *@since 1.0.0
   *@return string (query)
   */ 

   public static function  msbdt_mas_booking($args = null){
          global $wpdb;      
          $table_name = $wpdb->prefix.'msbdt_booking';
          $count = 0; 
          $query  = "SELECT * FROM  $table_name  WHERE  ";
        
          if(!empty($args['status'])):
                   $query .= " status = '".$args['status']."'  ";
                   $count++; 
          endif;

          if(!empty($args['location']) && $count == 1):
                   $query .= " AND  loc_id = '".$args['location']."'  "; 

          endif;
          if(!empty($args['professional']) && $count >= 1):
                   $query .= " AND  pro_id = '".$args['professional']."'  "; 

          endif;
          if(!empty($args['date']) && $count >= 1):
                   $query .= " AND  date = '".$args['date']."'  "; 

          endif;
          
          if($count == 0):
                  $query .= " 1 ";
          endif;
          $query  .= " ORDER BY date DESC   "; 

                                          
          return  $query ;        
   }

  /**
   *@param $query , sting variable. 
   *@since 1.0.0
   *@return result
   */ 

   public static function  msbdt_payment_card_info_recoder( $id ){
          global $wpdb;      
          $table_name = $wpdb->prefix.'msbdt_paymentcard';
          $query  = "SELECT * FROM  $table_name  WHERE applicant_id = '".$id."' ";
          $result = $wpdb->get_row( $query );
          return  $result ;        
   }

   

}/* / class Msbdt_Booking */
