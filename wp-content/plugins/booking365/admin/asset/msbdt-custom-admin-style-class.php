<?php
class Msbdt_Custom_Admin_Style{

public static function msbdt_scheduler_admin_custom_css(){

$textColorForAllPage = ( get_option( 'admin_text_color_active_page') == '2' )?
                         get_option( 'admin_text_color') :
                        '#000000';


$textColorForAppointmentPage = ( ( get_option( 'admin_text_color_active_page') == '1') ||
                                 ( get_option( 'admin_text_color_active_page') == '2') )?
                                   get_option( 'admin_text_color') :
                                   '#000000';
    ?>
      <style type="text/css">

        .multi-appointment .scheduler_admin,
        .multi-appointment .scheduler_admin_tbody,
        .multi-appointment .textColorForAllPage,
        .multi-appointment .textColorForAppointmentPage{          
             font-family:<?php echo get_option( 'admin_fontfamily' ); ?> ;
             font-size:<?php echo get_option( 'admin_fontsize' ); ?>px ;       
        }
        .multi-appointment .scheduler_admin .scheduler_admin_tbody{         
             color:<?php echo  get_option( 'admin_text_color' ); ?>;         
        } 
        .multi-appointment .textColorForAllPage{
             color:<?php echo $textColorForAllPage ; ?>;            
        }
        .multi-appointment .textColorForAppointmentPage{
             color:<?php echo $textColorForAppointmentPage ; ?>;            
        }
        .multi-appointment .scheduler_admin .btn-warning {
            color:<?php echo  get_option( 'admin_submit_button_text_color' ); ?> ;  
            background-color:<?php echo  get_option( 'admin_delete_button_color' ); ?>;
            border-color: #eee;
        }
        .multi-appointment .scheduler_admin .btn-primary {
            color:<?php echo  get_option( 'admin_submit_button_text_color' ); ?>;  
            background-color:<?php echo  get_option( 'admin_edit_button_color' ); ?>; 
            border-color: #eee;
          }
        .multi-appointment .admin_submit_button_color .btn-primary {
           color:<?php echo  get_option( 'admin_submit_button_text_color' ); ?>;  
           background-color:<?php echo  get_option( 'admin_submit_button_color' ); ?>; 
        }
         
        .multi-appointment .table > tbody > tr > td,
        .multi-appointment .table > tfoot > tr > td {        
          vertical-align:none;           
        }

        .multi-appointment .table > thead > tr {
            background-color: rgb(28, 40, 56);
            color:#fff;
        }
        .multi-appointment .admin_custom_css td, 
        .multi-appointment .admin_custom_css th {
            padding:5px;
        }

        .multi-appointment .scheduler_admin_thead_form{
            padding: 10px;
            background-color:  rgb(28, 40, 56);
            margin: 10px 0px;
        }

        .multi-appointment .nav-pills > li.active > a,
        .multi-appointment .nav-pills > li.active > a:hover,
        .multi-appointment .nav-pills > li.active > a:focus {
          color: #fff;
          background-color: #5cba47;
        }

        .multi-appointment .nav > li > a {
            position: relative;
            display: block;
            padding: 1px 15px;
            background:rgb(28, 40, 56);
            color:#fff;
        }
        .multi-appointment .nav > li > a:hover {
            position: relative;
            display: block;
            padding: 1px 15px;
            background:rgb(28, 40, 56);
            color:#fff;
        }
        .admin_status_button button {
            border-radius: 2px;
        }
        
        /* admin datepiker*/
        .ui-datepicker 
        .ui-datepicker-header {
          position:relative;
          padding:.2em 0;
          color:#fff;
          background: #5CBA47;}

         .multi-appointment .form-inline .form-group {
          /* display: inline-block; */
          display: block;
          margin-bottom: 0;
          vertical-align: middle;
        }
         
        @media (min-width: 768px){
         
          .multi-appointment .form-inline .form-control {
              display:block;
              width:100%; 
              vertical-align: middle;
          } 
       }  
      </style>
     
     <?php
   }
}