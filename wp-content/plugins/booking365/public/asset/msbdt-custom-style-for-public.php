<?php 
class Msbdt_Custom_Style_Public{

public static function msbdt_scheduler_custom(){ ?>
          
<style type="text/css">
.multi-appointment label{
 font-size:<?php echo get_option( 'frontend_fontsize' ); ?>px ;
 color:<?php echo  get_option( 'text_color' ); ?>;
 font-family:<?php echo get_option( 'frontend_fontfamily' ); ?>;
} 
.multi-appointment .schedule input{
  margin:1px; 
  color:<?php echo  get_option( 'text_color' ); ?>;
  min-width:200px;
 }
 .multi-appointment .public_error_message_color{
  color:<?php echo  get_option( 'error_message_color' ); ?>;       
  }
 .multi-appointment .public_submit_button input{
  color:<?php echo  get_option( 'submit_button_text_color' ); ?>;
  background-color:<?php echo  get_option( 'submit_button_color' ); ?>;
      border: 3px solid #36af48;
  }

 .multi-appointment .public_submit_button input.button-primary{
    border: 0;
    padding: 6px 12px;
    color: #fff;
  }
         
  /* Calender default enable div Color */
  .ui-state-default, 
  .ui-widget-content .ui-state-default,  
  .ui-widget-header .ui-state-default {     
  background:<?php echo get_option( 'calender_enable_color' ); ?>; 
  color: <?php echo get_option( 'calender_day_digit_color' ); ?>;     
  }

  .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border:none;/*{borderColorDefault}; */
  } 

  /* Calender active Color */
  .ui-state-active, 
  .ui-widget-content .ui-state-active, 
  .ui-widget-header .ui-state-active {
  background:<?php echo get_option( 'calender_active_color' ); ?> !important; 
  }  

  /* Calender day Text Color */
  .ui-datepicker th {
  color: <?php echo get_option( 'calender_day_text_color' ); ?> !important;
  background: #2e3641;
  }

  /* Calender month Text Color */
  .ui-datepicker .ui-datepicker-title {
  color: <?php echo get_option( 'calender_month_text_color' ); ?> !important; 
  }
  /* Calender Header Backgraund Color */
  .ui-datepicker-header , 
  .ui-datepicker th {
   background-color: <?php echo get_option( 'calender_header_bg_color' ); ?> !important;
   
  }

  /* Calender border-color AND radius */
 .ui-corner-all, 
 .ui-corner-bottom, 
 .ui-corner-right, 
 .ui-corner-br {
  -moz-border-radius-bottom-right: 0px/*{cornerRadius}*/;
  -webkit-border-bottom-right-radius: 0px/*{cornerRadius}; */ -khtml-border-bottom-right-radius: 4px/*{cornerRadius}*/;
   border-bottom-right-radius: 0px/*{cornerRadius};; /* border-color: #81d742 !important; */ */;
   border: none;
   /*border-color: <?php echo get_option( 'calender_border_color' ); ?> !important; */
  } 
 .ui-datepicker table {  
     background-color: <?php echo get_option( 'calender_body_color' ); ?> !important;
  }
 .ui-datepicker td {
    padding: 1px;
    background-color: <?php echo get_option( 'calender_body_color' ); ?> !important;
  }

  .ui-state-disabled, 
  .ui-widget-content .ui-state-disabled, 
  .ui-widget-header .ui-state-disabled {
    background-color: #57B256 !important;
    color:#fff;
  }
  .submit_button_color{
    background-color: <?php echo get_option( 'submit_button_color' ); ?> !important;
    padding:5px;
    text-decoration: none !important;          
   }  
  .submit_button_color:hover{
    text-decoration: none !important;
  }
  #mas_setting_form td{
    height: 30px;
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
    inline:block;
  }
  .multi-appointment .modal-content {    
        margin: auto;
        width: 50%;
        border: 3px solid green;
        padding: 10px;
        top:20px;
    }

  /* Modal Header */
  .modal-header {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
  } 

    .ok_inner {
      padding: 0 20px 20px;
    }

    .radio {
        padding-left: 20px;
    }

    .radio label {
        display: inline-block;
        position: relative;
        padding-left: 5px;
    }

    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out;
    }

    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    }

    .radio input[type="radio"] {
        opacity: 0;
    }

    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1);
    }

    .radio input[type="radio"]:disabled + label {
        opacity: 0.65;
    }

    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed;
    }

    .radio.radio-inline {
        margin-top: 0;
    }

    .radio-danger input[type="radio"] + label::after {
        background-color: #5bbc2e;
    }

    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #5bbc2e;
    }

    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #5bbc2e;
    }

   .modal-footer .btn {
     float: right;
   }

        <?php echo get_option( 'frontend_custom_css' ); ?>
      </style>
     
     <?php
    }   
}