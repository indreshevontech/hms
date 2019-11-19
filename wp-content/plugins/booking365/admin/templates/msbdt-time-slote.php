<br />
<div class = "multi-appointment row" > 
   <div class="scheduler_admin">
         <ul class="nav nav-tabs nav-pills" >
            <li class="active"  >
            <a  href="#schedule" data-toggle="tab">
            <h5><?php esc_html_e('Schedule','multi-scheduler') ;?></h5></a></li>
            <li><a href="#add_schedule" data-toggle="tab">
            <h5><?php esc_html_e('Add Schedule','multi-scheduler') ;?></h5></a></li>              
        </ul>

<!-- //////////////////////////////////////////////////////////////////////////////////
                    message section
/////////////////////////////////////////////////////////////////////////////////////-->     

<?php 
if(isset($_POST['add_schedule_submit'])):
$message = Msbdt_Schedule::msbdt_process_schedule_data(); 
if( isset($message['action_status']) ):?> 
<div class = "row">
    <div class = "col-sm-7">
      <?php if($message['action_status'] == 'no_error_data_save_successfully'): ?>
        <div id="message" class="updated notice is-dismissible">
          <p><strong><?php _e('Add successfully','multi_scheduler') ;?></strong></p>
          <button type="button" class="notice-dismiss">
          <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
          </button>
        </div>          
<?php elseif($message['action_status'] == 'something_is_error'): ?>
	<div id="message" class="updated notice is-dismissible">
	    <p class="red"><strong><?php _e('This​ ​date​ ​&​ ​time​ ​​is​ ​already​ ​scheduled','multi_scheduler') ;?></strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
              </button>
            </div> 
         
        <?php elseif($message['action_status'] == 'something_is_error') : ?>
        <div id="message" class="updated notice is-dismissible">
          <p><strong>
          <?php _e('You are already exist or Some thing is Error . Please try again ! .','multi-scheduler') ;?></strong></p>
          <button type="button" class="notice-dismiss">
          <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
          </button>
        </div>         
     <?php endif ; ?>
   </div><!-- end .col-sm-7 -->
 </div><!-- end .row -->
 <?php endif; ?>
<?php endif ; ?>


<?php
 if(isset($_POST['update_schedule_submit'])):
 $message = Msbdt_Schedule::msbdt_update_schedule_data(); 
 if( isset($message['action_status']) ):?> 
  <div class = "row">
    <div class = "col-sm-7">
      <?php if($message['action_status'] == 'no_error_data_update_successfully'): ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong><?php _e(' Update successful','multi_scheduler') ;?></strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
              </button>
            </div>         
         <?php elseif($message['action_status'] == 'something_is_error'): ?>
	<div id="message" class="updated notice is-dismissible">
	    <p class="red"><strong><?php _e('This​ ​date​ ​&​ ​time​ ​​is​ ​already​ ​scheduled','multi_scheduler') ;?></strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
              </button>
            </div> 
         <?php endif ; ?>
   </div><!-- end .col-sm-7 -->
 </div><!-- end .row -->
 <?php endif; ?>
<?php endif ; ?>


<?php
 if(isset($_POST['slote_delete'])):
 $message = Msbdt_Schedule::msbdt_delete_schedule_data(); 
 if( isset($message['action_status']) ):?> 
  <div class = "row">
    <div class = "col-sm-7">
      <?php if($message['action_status'] == 'delete_successfully'): ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong><?php _e('Delete successful','multi_scheduler') ;?></strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
              </button>
            </div>         
         <?php endif ; ?>
   </div><!-- end .col-sm-7 -->
 </div><!-- end .row -->
 <?php endif; ?>
<?php endif ; ?>

<!-- //////////////////////////////////////////////////////////////////////////////////
        tab-content section
/////////////////////////////////////////////////////////////////////////////////////-->   
     </br>
        <div class="tab-content scheduler_admin">
          <div class="tab-pane active"  
                id ="schedule" >        
                <table class="table table-bordered textColorForAllPage" 
                         id = "dataTableForSchedule">
                  <thead>
                    <tr>
                      <th><?php _e('SRL','multi-scheduler') ;?></th>
                      <th><?php _e('Professional','multi-scheduler') ;?></th>
                      <th><?php _e('Date','multi-scheduler') ;?></th>
                      <th><?php _e('Start Time','multi-scheduler') ;?></th>
                      <th><?php _e('End Time','multi-scheduler') ;?></th>
                      <th><?php _e('Action','multi-scheduler') ;?></th>
                    </tr>
                  </thead>
                  <tbody> 
                        <?php 
                        if(method_exists('Msbdt_Schedule','msbdt_select_schedule_data')) :
                        global $wpdb ;
                        $schedule = Msbdt_Schedule::msbdt_select_schedule_data();    
                        $schedules = $wpdb->get_results( $schedule['query']['select_all']  , OBJECT ) ;
                        endif ; ?> 
                        <?php  $serial_no = 1  ; ?>  
                        <?php foreach ($schedules as $schedule): ?>
                       <tr>           
                          <td><?php echo $serial_no  ; ?></td>
                          <td><?php                          
                          $professional = Msbdt_Professional::msbdt_select_professional($schedule->pro_id);    
                          $professional = $wpdb->get_row( $professional['query']['select']) ;
                          echo ucwords($professional->fname.'  '.$professional->lname) ; ?></td>
                          <td><?php echo ucwords($schedule->work_date) ; ?></td>
                          <td><?php echo ucwords($schedule->start_time) ; ?></td>
                          <td><?php echo ucwords($schedule->end_time) ; ?></td>
                          <td>                                                                      
                        <span><a class="button btn-warning" 
                                href="#delete<?php echo $schedule->slot_id ; ?>" 
                                data-toggle="modal"><?php  _e( 'Delete','multi-scheduler' );?></a>
                        </span>                        
                        <div id="delete<?php echo $schedule->slot_id ;?>" 
                             class="modal fade">                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php  _e('Delete Schedule','multi-scheduler');?>
                                      </h4>
                                   </div>
                                    <div class="modal-body">                             
                                        <?php delete_conform_slote( $schedule ); ?>     
                                    </div><!-- /.modal-body -->
                                </div><!-- /.modal-content -->                               
                             </div><!-- /.modal -->
                        </div><!-- / #professional_delete -->
                        <span><a   class="button btn-primary" 
                           href="#edit<?php echo $schedule->slot_id; ?>" 
                           data-toggle="modal">Edit</a>
                        </span>
                        <div id="edit<?php echo $schedule->slot_id ; ?>" 
                                 class="modal fade" >                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                   <div class="modal-header">
                                     <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php _e('Edit Schedule','multi-scheduler');?>
                                      </h4>
                                    </div>
                                    <div class="modal-body">
                                    <?php schedule_form_html( $schedule ,'col-sm-12' , $errors = null); ?>     
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->                               
                            </div><!-- /.modal -->
                          </div><!-- #edit --> 
                        </td>               
                      </tr>
                       <?php $serial_no++ ?>
                      <?php endforeach ;?>
                  </tbody>
                </table>
            </div><!-- / .tab-pane / #category-->
         <div class="tab-pane"  
                id ="add_schedule" > 
            <?php schedule_form_html( $slote = null , $col_span = null , $errors = null) ; ?>                    
         </div><!-- / .tab-pane / #add_category-->
      </div><!-- / .tab-content -->
   </div><!-- / .scheduler_admin -->
</div><!-- / .multi-appointment -->

<?php msbdt_datatable_calling_for_schedule(); ?>
<?php $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css(); ?>

<?php
function schedule_form_html( $slote = null , $col_span = null , $errors = null){ ?>
<?php global $wpdb ; ?>
<form  method = "post" 
       action = "" 
       class  = "row  form-group">

 <?php if(!isset($slote->slot_id)): $col_span = 'col-sm-5'; endif ; ?>                    
 <?php if(!isset($slote->slot_id)):  ?>

    <div class = "col-sm-4"> 
    <div><label for=""><?php  echo esc_html( 'Available Date', 'multi-scheduler' ); ?></label></div>
    <div id    = "withAltField"  
         class = "form-group" >
      <div id  = "with-altField"></div>
        <input  name = "work_date"
               class = "form-control"
                type = "hidden"  
                  id = "altField" 
               value = ""> 
               <span class="mas_required">
                          <?php if(isset($errors['work_date'])){echo $errors['work_date'];}?>
              </span>
      </div>
    </div><!-- .col-sm-7 -->
  <?php endif ; ?>
 
  <div  class="<?php echo esc_attr(  $col_span ) ; ?>">
    <input  name   = "slot_id"; 
            type   = "hidden" 
            id     = "slote_edit_id"                     
            value  = "<?php if(isset($slote->slot_id)): echo $slote->slot_id ; endif; ?>" 
            class  = "form-control"> 

    <div class = "form-group" >
      <label  for  = "pro_id"><?php echo esc_html( get_option( 'frontend_professional' ) ) ;?></label>
      <select name = "pro_id"; 
              type = "text"                                    
              class= "form-control">
             <?php 
             $professional = Msbdt_Professional::msbdt_select_professional_data();
             $professionals = $wpdb->get_results($professional['query']['select_all']  , OBJECT ) ;
             foreach ($professionals as $professional) : ?>
             <?php  $display = $professional->fname.' '.$professional->lname ; ?>  
             <?php if( $slote->pro_id == $professional->pro_id ): 
             $set= "selected";
             else : $set = ""; endif ; ?>                                                    
             <?php  echo  '<option class="form-control"  
                                    value="'. $professional->pro_id.'" '.$set.'>'.$display.'</option>'; ?>                             
            <?php endforeach ; ?>                               
         </select>                  
    </div> 

    <?php if( $slote !== null ): ?>  
      <div class = "form-group" >
        <label for   = "work_date"><?php esc_html_e('Work Date','multi-scheduler'); ?></label>
        <span style  = "color:red;"><?php if(isset($errors['city'])){echo $errors['city'];}?></span>
        <?php  ?>
        <input name  = "work_date" 
               type  = "text"
               id    = ""                       
               value = "<?php if(isset($slote->work_date)):echo $slote->work_date; endif; ?>" 
               class = "form-control date_slote">        
      </div>
    <?php endif ; ?> 

    <?php if(!isset($slote->int_val)):  ?>
      <div class = "form-group">
        <label for   =  "int_val"><?php echo __('Time per schedule','multi-scheduler'); ?></label>
        <input name  =  "int_val" 
               type  =  "" 
               id    =  ""
               value =  "" 
               class =  "form-control">
         <span class =  "mas_required">
                      <?php if(isset($errors['int_val'])){echo $errors['int_val'];}?>
         </span>                                  
      </div>
      <?php endif ; ?>  
  </div>


<div  class="<?php echo esc_attr( $col_span ); ?>"> 

     <div class = "form-group" >
          <label for  = "start_time" ><?php  esc_html_e('Start Time','multi-scheduler'); ?></label>
          <span style = "color:red;"><?php if(isset($errors['zip'])){echo $errors['zip'];}?></span>
          <input name = "start_time" 
                 type = "text"                                               
                 value= "<?php if(isset($slote->start_time)):
                          $start_time = date("h:i A", strtotime($slote->work_date.' '. $slote->start_time  ));
                          echo $start_time; endif; ?>" 
                class ="<?php echo esc_attr('form-control timepiker'); ?> ">                      
     </div>  
      <div class = "form-group">
          <label for  =  "end_time"><?php esc_html_e('End Time','multi-scheduler'); ?></label>
          <span style =  "color:red;"><?php if(isset($errors['zip'])){echo $errors['zip'];}?></span>
          <input name =  "end_time" 
                 type =  "text"                                               
                 value=  "<?php if(isset($slote->end_time)):
                           $end_time = date("h:i A", strtotime($slote->work_date.' '. $slote->end_time  ));
                           echo $end_time; endif; ?>" 
                 class="form-control timepiker">     
              
     </div>    
  </div>    
        
  <?php if( $slote !== null ): ?>
    <div class="col-sm-12"> 
       <div class="modal-footer">
          <button class       = "btn btn-default" 
                  type        = "button" 
                  data-dismiss= "modal"><?php  esc_html_e('Close','multi-scheduler'); ?></button>        
           <input type        = "submit" 
                  name        = "update_schedule_submit" 
                  id          = "" 
                 class        = "btn btn-primary" 
                 value        = "<?php  esc_attr_e('Save Change','multi-scheduler'); ?>">                                            
      </div> 
    </div>    
    <?php else : ?>
        <div class="col-sm-12 admin_submit_button_color">  
        <label><input  type  = "submit" 
                       name  = "add_schedule_submit"                      
                       class = "btn btn-primary" 
                       value = "<?php  esc_attr_e('Add New Schedule','multi-scheduler'); ?>"> 
                       </label>   
        </div>  
      <?php endif ; ?>                                 
  </form>
<?php }

function delete_conform_slote($slote){?>

    <form  method = "post" 
           action = "" 
           class  = "row ">

        <input name = "slot_delete_id"; 
               type = "hidden" 
               id   = "slot_id"                     
              value = "<?php if(isset($slote->slot_id)):echo $slote->slot_id; endif; ?>" 
              class = "form-control"> 

         <?php  esc_html_e('Are you sure to delete ?.','multi-scheduler') ; ?>

         <div class="modal-footer">
          <button class        = "btn btn-default" 
                  type         = "button" 
                  data-dismiss = "modal"><?php  esc_attr_e('Close','multi-scheduler'); ?></button>        
           <input type  = "submit" 
                  name  = "slote_delete" 
                  id    = "" 
                  class = "btn btn-warning" 
                  value = "<?php esc_attr_e('Delete','multi-scheduler'); ?>">                                            
        </div> 

   </form>
                
 <?php }

 function msbdt_datatable_calling_for_schedule(){?> 
  <script type="text/javascript">
    jQuery("#dataTableForSchedule").DataTable({ 
      dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
              
      buttons: [ 
                {extend: 'copy', className: 'btn-sm'},

                {
                  extend: 'csv', 
                  title: 'ExampleFile',
                  className: 'btn-sm',
                  exportOptions: {columns:[0,1,2,3,4], modifier: {page: 'current'} }
                },

                {
                extend: 'excel', 
                title: 'ExampleFile',
                className: 'btn-sm',
                exportOptions: {columns:[0,1,2,3,4],modifier: {page: 'current'} }

                }, 

                {
                extend: 'pdf', 
                title: 'ExampleFile',
                className: 'btn-sm',
                exportOptions: { columns:[0,1,2,3,4],modifier: {page: 'current'} }
                },

               {
                extend: 'print', className: 'btn-sm',
                exportOptions: { columns:[0,1,2,3,4], modifier: { page: 'current'}}
               } 
         ] });
  </script>
  <style type="text/css">
         #wpbody-content { width: 98% !important;}
  </style>
<?php 
} 

