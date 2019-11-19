
<?php

/**
 * @package    admin
 * @subpackage admin/templates
 * @author     bdtask<uzzal131@gmail.com> <bdtask@gmail.com>
 */

/**=============================
     status
     1 = active
     2 = inactive
     3 = delete
     4 = request => #dda108
     5 = approve => 
     6 = reject

===================================*/  
    if(isset($_GET['approve_id']) && isset($_GET['status'])):
       $approve_id = intval( $_GET['approve_id']  );
       $status = intval( $_GET['status']  );
       $acton = Msbdt_Booking::msbdt_mas_booking_action(  $approve_id  ,  $status );
       $mail = Msbdt_Admin::msbdt_email_sender_with_action( $approve_id  ,  $status );
      
    elseif(isset($_GET['reject_id']) && isset($_GET['status'])):
       $reject_id  = intval( $_GET['reject_id']  );
       $status = intval( $_GET['status']  );
       $acton = Msbdt_Booking::msbdt_mas_booking_action( $reject_id  , $status ); 
       $mail = Msbdt_Admin::msbdt_email_sender_with_action( $reject_id  , $status );

    elseif(isset($_GET['delete_id']) && isset($_GET['status'])):
       $delete_id  = intval( $_GET['delete_id']  );
       $status = intval( $_GET['status']  );
       $acton = Msbdt_Booking::msbdt_mas_booking_action( $delete_id  , $status ); 
    endif;
?>
</br>
<div class = "multi-appointment row scheduler_admin" > 
   <table class = "table table-bordered textColorForAppointmentPage" 
            id  = "dataTableForAppointment">
      <thead class="scheduler_admin_tbody">
          <tr>
          <th><?php _e('SRL','multi-scheduler') ;?></th>
          <th><?php _e('Professional','multi-scheduler') ;?></th>
          <th><?php _e('Name','multi-scheduler') ;?></th>
          <th><?php _e('Email','multi-scheduler') ;?></th>
          <th><?php _e('Contact No','multi-scheduler') ;?></th>
          <th><?php _e('Date','multi-scheduler') ;?></th>
          <th><?php _e('Time','multi-scheduler') ;?></th>
          <th><?php _e('Status','multi-scheduler') ;?></th>
          <th><?php _e('Action','multi-scheduler') ;?></th>
          </tr>
          </thead>
          <tbody> 
                <?php 
                if(method_exists('Msbdt_Booking','msbdt_mas_booking')) :
                global $wpdb ;
                $booking_sql = Msbdt_Booking::msbdt_mas_booking();    
                $results = $wpdb->get_results( $booking_sql, OBJECT ) ;
                endif ; ?> 
                <?php  $serial_no = 1  ; ?>  
                <?php foreach ($results as $result): ?>
                 
                 <tr <?php if($result->status !== '4'):
                              if($result->status == '5'): 
                              echo 'style= background-color:'.get_option('approve_color');
                              elseif($result->status =='6'):
                              echo 'style= background-color:'.get_option('reject_color'); 
                              endif ;
                         else: echo 'style= background-color:'.get_option('request_color');
                         endif;?>>
                  <td><?php                   
                   echo $serial_no;
                   ?>
                  </td>                
                  <td><?php 
                    $professional = Msbdt_Professional::msbdt_select_professional( $result->pro_id );
                    $professional = $wpdb->get_row($professional['query']['select']);
                    echo ucwords($professional->fname.' '.$professional->lname) ; 
                   ;?></td>                
                  <td><?php echo ucwords($result->name); ?></td>
                  <td><?php echo $result->email; ?></td>
                  <td><?php echo $result->phone; ?></td>
                  <td><?php 
                  $date  = new DateTime($result->date);
                  $date = $date->format('m-d-Y');
                  echo $date; ?></td>
                  <td><?php 
                       $start_time = new DateTime($result->start_time);
                       $start_time = $start_time->format('H:i');
                       $end_time = new DateTime($result->end_time);
                       $end_time = $end_time->format('H:i');
                       echo $start_time.' - '.$end_time; ?></td>
                  
                   <td><?php  
                        if($result->status !== '4'):
                           if($result->status == '5'):  esc_html_e('Approve','multi-scheduler');
                           elseif($result->status =='6'): esc_html_e('Reject','multi-scheduler'); 
                           endif ;
                        else: esc_html_e('Request','multi-scheduler');
                        endif;

                   ?></td>
                   <td><?php  
                        if($result->status !== '4'):
                           if($result->status == '5'):?>
                               <!--<button type='button' class='button btn-defult'>-->
                               <a class='button btn-defult' href="?page=msbdt_appointment&status=6&reject_id=<?php echo $result->id;?>">
                               <?php esc_html_e('Reject','multi-scheduler')?></a>
                               <!--</button>--> 
                            <?php 
                           elseif($result->status =='6'):?>
                               <!--<button type='button' class='button btn-defult'>-->
                               <a class='button btn-defult' href="?page=msbdt_appointment&status=3&delete_id=<?php echo $result->id; ?>">
                               <?php esc_html_e('Delete','multi-scheduler')?></a>
                               <!--</button>-->
                               <!--<button type='button' class='button btn-defult'>-->
                               <a class='button btn-defult' href="?page=msbdt_appointment&status=5&approve_id=<?php echo $result->id; ?>">
                               <?php esc_html_e('Approve','multi-scheduler')?></a>
                              <!--</button>-->  
                            <?php 
                           endif ; 
                        else:?>
                              <!--<button type='button' class='button btn-defult'>-->
                              <a class='button btn-defult' href="?page=msbdt_appointment&status=5&approve_id=<?php echo $result->id; ?>">
                              <?php esc_html_e('Approve','multi-scheduler')?></a>
                              <!--</button>-->
                              <!--<button class='button btn-defult' type='button' class='button btn-defult'>-->
                               <a class='button btn-defult' href="?page=msbdt_appointment&status=6&reject_id=<?php echo $result->id;?>">
                               <?php esc_html_e('Reject','multi-scheduler')?></a>
                               <!--</button>-->  
                            <?php 
                        endif;
                   ?></td>
               </tr> 
             <?php  $serial_no++ ; ?> 
          <?php endforeach ; ?>
          </tbody>
        </table>   
    </div><!-- / .multi-appointment -->
<?php msbdt_datatable_calling_for_appointment(); ?>
<?php $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css(); ?>
<?php 
function msbdt_datatable_calling_for_appointment(){?> 
  <script type="text/javascript">
    jQuery("#dataTableForAppointment").DataTable({ 
      dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
              
      buttons: [ 
                {extend: 'copy', className: 'btn-sm'},

                {
                  extend: 'csv', 
                  title: 'Appointment',
                  className: 'btn-sm',
                  exportOptions: {columns:[0,1,2,3,4,5,6,7], modifier: {page: 'current'} }
                },

                {
                extend: 'excel', 
                title: 'Appointment',
                className: 'btn-sm',
                exportOptions: {columns:[0,1,2,3,4,5,6,7],modifier: {page: 'current'} }

                }, 

                {
                extend: 'pdf', 
                title: 'Appointment',
                className: 'btn-sm',
                exportOptions: { columns:[0,1,2,3,4,5,6,7],modifier: {page: 'current'} }
                },

               {
                extend: 'print', 
                className: 'btn-sm',
                exportOptions: { columns:[0,1,2,3,4,5,6,7], modifier: { page: 'current'}}
               } 
         ] });
  </script>
  <style type="text/css">
         #wpbody-content { width: 98% !important;}
         .multiselect {
           width: 200px;
          }

  </style>
<?php 
}
