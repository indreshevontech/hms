<?php 

class Msbdt_Email{
 
  public static function  msbdt_template_add_process_data( $args = null ){
     
      global $wpdb ;  
      $table_template = $wpdb->prefix.'msbdt_template';    
      $errors = array();   
      $add_template_submit = isset( $_POST['add_template_submit'] ) ?
                             sanitize_text_field( $_POST['add_template_submit'] ) :'';
           
      if( isset($add_template_submit) && $add_template_submit !== '' ): 
               
             $template['temp_id']       = intval( $_POST['temp_id'] );
             $template['temp_name']     = sanitize_text_field( $_POST['temp_name'] );
             $template['subject']       = htmlentities($_POST['temp_subject'])   ;
             $template['template']      = htmlentities($_POST['template'])   ; 
             $template['status']        = intval($_POST['template_purpose'])   ; 
         
             (empty($template['temp_name']))? $errors['temp_name'] = 'Error: required !':'';
             (empty($template['template']))? $errors['template'] = 'Error:  required !':'';
                                
             if( !empty($errors)  ):
             return $errors ;
             elseif( $template['temp_id'] != '0') :  
             $update_template = $wpdb->update( 
                          $table_template , 
                          array( 
                            'temp_name' => $template['temp_name'] , // column & new value
                            'subject'   => $template['subject'] , // column & new value
                            'template'  => $template['template'] , // column & new value
                            'status'    =>  $template['status']     // column & new value
                          ), 
                          array( 'temp_id' => $template['temp_id'] ) ,  // where clause(s)
                          array( '%s' , '%s' ,'%s' , '%d' ) , // column & new value type.
                          array( '%d' ) // where clause(s) format types  
                        ); 
               
              
              $status = ($update_template)? 
                        'no_error_data_update_successfully' : 
                        'something_is_error';                 
                 return $status;

              else:
                
                 $add_new_template  =  $wpdb->insert( 
                                                $table_template , 
                                                array(                  
                                                  'temp_id'   => '',
                                                  'temp_name' => $template ['temp_name'],
                                                  'subject'   => $template ['subject'],          
                                                  'template'  => $template ['template'],          
                                                  'status'    => $template['status'] ));


               
                   $status = ($add_new_template)? 'no_error_data_save_successfully' : 'something_is_error';                 
                   return $status;

              endif ;
        

        elseif(isset($_POST['template_delete']) ):
          $template['temp_delete_id'] = intval( $_POST['temp_delete_id'] );
          $delete = $wpdb->delete( 
                        $table_template,      // table name 
                        array( 'temp_id' => $template['temp_delete_id'] ),  // where clause 
                        array( '%d' )      // where clause data type (int)
                    );
          $status = ($delete)? 'no_error_data_delete_successfully' : 'something_is_error_for_relative_data';
          return $status;
        
        endif ;
    
    }

    public static function  msbdt_remainder_add_process_data( $args = null ){
    
      global $wpdb ;  
      $table_remainder = $wpdb->prefix.'msbdt_remainder';   
      $errors = array();   
      $add_remainder_submit = isset( $_POST['add_remainder_submit'] ) ?
                             sanitize_text_field( $_POST['add_remainder_submit'] ) :'';         
      if( isset($add_remainder_submit) && $add_remainder_submit !== '' ): 
          
             $remainder['id']      = intval( $_POST['id'] );
             $remainder['temp_id'] = intval( $_POST['template'] );
             $remainder['name']    = sanitize_text_field( $_POST['name'] );
             $remainder['day']     = intval($_POST['day'])   ;
             $remainder['hour']    = intval($_POST['hour'])   ;
             $remainder['minute']  = intval($_POST['minute'])   ;         
             
             if( !empty($errors)  ):
             return $errors ;
             elseif( $remainder['id'] != '0') :              
             $update_remainder = $wpdb->update( 
                          $table_remainder , 
                          array( 
                            'temp_id' => $remainder['temp_id'] , // column & new value
                            'name'    => $remainder['name'] , // column & new value
                            'day'     => $remainder['day'] , // column & new value
                            'hour'    => $remainder['hour'] , // column & new value
                            'minute'  => $remainder['minute'] , // column & new value
                          ), 
                          array( 'id' => $remainder['id'] ) ,  // where clause(s)
                          array( '%d' , '%s' ,'%d' ,'%d' , '%d' ) , // column & new value type.
                          array( '%d' ) // where clause(s) format types  
                        ); 
               
              
              $status = ($update_remainder)? 
                        'no_error_data_update_successfully' : 
                        'something_is_error';                 
                 return $status;

              else:           
                 $add_new_remainder  =  $wpdb->insert( 
                                                $table_remainder , 
                                                array(                  
                                                  'id'        => '',
                                                  'temp_id'   => $remainder['temp_id'],
                                                  'name'      => $remainder['name'],
                                                  'day'       => $remainder['day'],          
                                                  'hour'      => $remainder['hour'],          
                                                  'minute'    => $remainder['minute'],          
                                                  'status' => '1' ));
        
                   $status = ($add_new_remainder)? 'no_error_data_save_successfully' : 'something_is_error';                 
                   return $status;

              endif ;
        

        elseif(isset($_POST['remainder_delete']) ):
          $remainder['remainder_delete_id'] = intval( $_POST['remainder_delete_id'] ) ;
          $delete = $wpdb->delete( 
                        $table_remainder ,  // table name 
                        array( 'id' => $remainder['remainder_delete_id'] ),  // where clause 
                        array( '%d' )      // where clause data type (int)
                    );
          $status = ($delete)? 'no_error_data_delete_successfully' : 'something_is_error_for_relative_data';
          return $status;
        
        endif ;
    
    }



  /**
   *@param  msbdt_select_added_all_template($id = null )/Return $query OR $result/can select data //.
   *@since  1.0.0
   *@return String OR Array(when id is set)
   */  
    public static function  msbdt_select_added_all_template( $id = null , $status = null ){
          global $wpdb;      
          $table_name = $wpdb->prefix.'msbdt_template';
          $count = 0; 
          $query  = "SELECT * FROM  $table_name  WHERE  ";       

          if( isset($id) && (! $id ==null) ) :
                   $query .= "  temp_id = '".$id."'  ";                 
                   $count++; 
                   $results = $wpdb->get_row($query);
                   return $results;
          endif;

          if( isset($status) && (! $status ==null) ) :
                   $query .= "  status = '".$status."'  ";                 
                   return $query;
          endif;  
        
          if($count == 0):
                  $query .= " 1 ORDER BY temp_id DESC ";
                  return $query ;
          endif;                                  
         
  }


  /**
   *@param  msbdt_select_added_all_template($id = null )/Return $query OR $result/can select data //.
   *@since  1.0.0
   *@return String OR Array(when id is set)
   */  
    public static function  msbdt_select_added_all_remainder( $id = null ){
          global $wpdb;      
          $table_name = $wpdb->prefix.'msbdt_remainder';
          $count = 0; 
          $query  = "SELECT * FROM  $table_name  WHERE  ";       

          if( isset($id) && (! $id ==null) ) :
                   $query .= "  id = '".$id."'  ";                 
                   $count++; 
                   $results = $wpdb->get_row($query);
                   return $results;
          endif; 
        
          if($count == 0):
                  $query .= " 1 ORDER BY temp_id DESC ";
                  return $query ;
          endif;
                                   
         
  }

  /**
   *@param  msbdt_template_email_process_data($args = null ).
   *@since  1.0.0
   *@param  save data in option table.
   */ 

  public static function  msbdt_template_email_process_data( $args = null ){

  $sending_info_save_submit = isset( $_POST['sending_info_save_submit'] ) ?
                            sanitize_text_field( $_POST['sending_info_save_submit'] ) :'';
           
  if( isset($sending_info_save_submit) && $sending_info_save_submit !== '' ): 
          

    $sender_name = (isset( $_POST['sender_name'] )) ? 
                    sanitize_text_field( $_POST['sender_name'] ) : ''  ;
    $sender_email = (isset( $_POST['sender_email'] )) ? 
                    sanitize_text_field( $_POST['sender_email'] ) :''  ;
    $sender_remender_template =(isset( $_POST['sender_remender_template'] )) ?
                                intval( $_POST['sender_remender_template'] ): ''  ;
    $sender_approved_template =(isset( $_POST['sender_approved_template'] )) ? 
                                intval( $_POST['sender_approved_template'] ) : ''  ;
    $sender_requested_template = (isset( $_POST['sender_requested_template'] )) ? 
                                intval( $_POST['sender_requested_template'] ) : '' ;
    $sender_rejected_template  = (isset( $_POST['sender_rejected_template'] )) ? 
                                intval( $_POST['sender_rejected_template'] ) : '' ;
                                
      // The option hasn't been created yet, so add it with $autoload set to 'no'.
      $deprecated = null;
      $autoload = 'no';
 
      
      // save sender name 
      if ( get_option( 'sender_name' ) !== false ) :  
           update_option( 'sender_name', $sender_name );
      else:          
           add_option( 'sender_name' , $sender_name , $deprecated, $autoload );
      endif ;

      // save sender email 
      if ( get_option( 'sender_email' ) !== false ) :  
           update_option( 'sender_email', $sender_email );
      else:          
           add_option( 'sender_email' , 
                        $sender_email , 
                        $deprecated, 
                        $autoload );
      endif ;

      // save sender remender template
      if ( get_option( 'sender_remender_template' ) !== false ) :  
           update_option( 'sender_remender_template', $sender_remender_template );
       else:
           add_option( 'sender_remender_template' , 
                      $sender_remender_template ,
                      $deprecated,
                      $autoload );
       endif ;

       // save sender requested template
        if ( get_option( 'sender_requested_template' ) !== false ) :  
             update_option( 'sender_requested_template', $sender_requested_template );
        else:          
             add_option( 'sender_requested_template' , 
                          $sender_requested_template , 
                          $deprecated, 
                          $autoload );
        endif ;

        // save sender approved template 
        if ( get_option( 'sender_approved_template' ) !== false ) :  
             update_option( 'sender_approved_template', $sender_approved_template );
        else:          
            add_option( 'sender_approved_template' , 
                        $sender_approved_template , 
                        $deprecated, 
                        $autoload );
        endif ;

        // save sender rejected template
        
        if ( get_option( 'sender_rejected_template' ) !== false ) :  
             update_option( 'sender_rejected_template', $sender_rejected_template );
        else:          
             add_option( 'sender_rejected_template' , 
                          $sender_rejected_template , 
                          $deprecated, 
                          $autoload );
        endif ;

      endif ;

  }/*  /  msbdt_template_email_process_data() */

} /*  / class Msbdt_Professional */