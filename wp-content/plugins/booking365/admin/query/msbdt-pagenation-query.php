<?php


/*==============================================================================
      Development by uzzal mondal (ujjal);
      Email : uzzal131@gmail.com.
      Date:03/05/2017(m/d/y)
 *==============================================================================*/

   /**
   *@param  Msbdt_Pagenation 
   *@since  1.0.0
   */  


class Msbdt_Pagenation{


  /**
   *@param $query2 , sting variable. 
   *@since 1.0.0
   *@return string (query)
   */ 

 public static  function  msbdt_paging( $query , $records_per_page ){

    $starting_position = 0;
    $page_no = ( isset( $_GET['s'] ) )? sanitize_text_field( $_GET['s'] ) : null ;
    if( isset( $page_no ) && $page_no != null):   
    $starting_position = ($page_no - 1) * $records_per_page;
    endif ;
    $query2 = $query."  limit $starting_position , $records_per_page";
    return $query2;

  } /* /  function msbdt_paging */

  /**
   *@param $query , sting variable. 
   *@param $records_per_page , int variable. 
   *@param $table , sting variable. 
   *@since 1.0.0
   *@return no.
   */ 
 public static function  msbdt_paginglink( $query , $records_per_page , $table ){
    
     global $wpdb;
     $self     = sanitize_text_field( $_SERVER['PHP_SELF'] );
     $afterurl = sanitize_text_field( $_SERVER['QUERY_STRING'] ); 
     $res = $wpdb->get_results($query);
     $count  = $wpdb->num_rows; //total row count 
     if(empty($res)) : return ; endif;
     if( $count <= $records_per_page ) : return ; endif; 

     $total_no_of_records = $count;

     if($total_no_of_records > 0):?>
          <ul class="pagination">
          <?php
          $total_no_of_pages = ceil($total_no_of_records/$records_per_page);
          $current_page = 1;
          if(isset($_GET["s"])):
            $current_page = sanitize_text_field( $_GET['s'] );
          endif ;
          if($current_page!=1):

            $previous =$current_page-1;
            echo "<li><a href='".$self."?".$afterurl."&s=1&active=2'>First</a></li>";
            echo "<li><a href='".$self."?".$afterurl."&s=".$previous."&active=2'>Previous</a></li>";

          endif;

          for( $i=1; $i<=$total_no_of_pages; $i++) :

               if( $i == $current_page ):
                 echo "<li><a href='".$self."?".$afterurl."&s=".$i."&active=2' style='color:red;'>".$i."</a></li>";       
               else :       
                 echo "<li><a href='".$self."?".$afterurl."&s=".$i."&active=2'>".$i."</a></li>";
              endif ;
          endfor ;
          if($current_page!=$total_no_of_pages) :

          $next=$current_page+1;
          echo "<li><a href='".$self."?".$afterurl."&s=".$next."&active=2'>Next</a></li>";
          echo "<li><a href='".$self."?".$afterurl."&s=".$total_no_of_pages."&active=2'>Last</a></li>";
          endif ;?>     
        </ul><?php
    endif ;
  } /* / function msbdt_paginglink */


}/* / class Msbdt_Pagenation */