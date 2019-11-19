
<?php global $category ; ?>

<!-- //// for gap //////-->
</br>
<div class = "multi-appointment row" > 
   <div class="scheduler_admin">
         <ul class="nav nav-tabs nav-pills" >
            <li class="active"  >
            <a  href="#service" data-toggle="tab">
            <h5><?php esc_html_e('Service','multi-scheduler') ;?></h5></a></li>
            <li><a href="#add_service" data-toggle="tab">
            <h5><?php esc_html_e('Add Service','multi-scheduler') ;?></h5></a></li>              
        </ul>

   <?php 


if(isset($_POST['ser_submit'])):
  $category = Msbdt_Service::msbdt_process_service_data(); 
  if( isset($category['action_status']) ):?> 
  <div class = "row">
    <div class = "col-sm-7">
      <?php if($category['action_status'] == 'no_error_data_save_successfully'): ?>
        <div id="message" class="updated notice is-dismissible">
          <p><strong><?php _e('Add successfully','multi_scheduler') ;?></strong></p>
          <button type="button" class="notice-dismiss">
          <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
          </button>
        </div>          

        <?php elseif($category['action_status'] == 'something_is_error') : ?>
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
 if(isset($_POST['ser_submit_for_change'])):
      $category = Msbdt_Service::msbdt_process_service_update_data(); 
      if( isset($category['action_status']) ):?> 

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($category['action_status'] == 'no_error_data_update_successfully'): ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong><?php _e(' Update successful','multi_scheduler') ;?></strong></p>
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
 if(isset($_POST['ser_submit_for_delete'])):
      $category = Msbdt_Service::msbdt_process_service_delete_data(); 
      if( isset($category['action_status']) ):?> 

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($category['action_status'] == 'delete_successfully'): ?>
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

<!-- //// for gap //////-->
</br>
        <div class="tab-content scheduler_admin">
          <div class="tab-pane active"  
                id ="service" >        
                <table class="table table-bordered textColorForAllPage" 
                         id = "dataTableForService">
                  <thead>
                    <tr>
                      <th><?php _e('SRL','multi-scheduler') ;?></th>
                      <th><?php _e('Name','multi-scheduler') ;?></th>
                      <th><?php _e('Action','multi-scheduler') ;?></th>
                    </tr>
                  </thead>
                  <tbody> 
                        <?php 
                        if(method_exists('Msbdt_Service','msbdt_select_added_all_service')) :
                        global $wpdb ;
                        $service = Msbdt_Service::msbdt_select_added_all_service();    
                        $services = $wpdb->get_results( $service['query']['select_all']  , OBJECT ) ;
                        endif ; ?> 
                        <?php  $serial_no = 1  ; ?>  
                        <?php foreach ($services as $service): ?>
                       <tr>           
                          <td><?php echo $serial_no  ; ?></td>
                          <td><?php echo ucwords($service->ser_name) ; ?></td>
                          <td>                                                                      
                        <span><a class="button btn-warning" 
                                href="#delete<?php echo $service->ser_id ; ?>" 
                                data-toggle="modal"><?php  _e( 'Delete','multi-scheduler' );?></a>
                        </span>                        
                        <div id="delete<?php echo $service->ser_id ;?>" 
                             class="modal fade">                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php  _e('Delete Service','multi-scheduler');?>
                                      </h4>
                                   </div>
                                    <div class="modal-body">                             
                                        <?php msbdt_delete_service_form($service); ?>     
                                    </div><!-- /.modal-body -->
                                </div><!-- /.modal-content -->                               
                             </div><!-- /.modal -->
                        </div><!-- / #professional_delete -->
                        <span><a   class="button btn-primary" 
                           href="#edit<?php echo $service->ser_id ; ?>" 
                           data-toggle="modal">Edit</a>
                        </span>
                        <div id="edit<?php echo $service->ser_id ; ?>" 
                                 class="modal fade" >                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                   <div class="modal-header">
                                     <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php _e('Edit Service','multi-scheduler');?>
                                      </h4>
                                    </div>
                                    <div class="modal-body">
                                    <?php msbdt_edit_service_form($service); ?>     
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
              <script type="text/javascript">

                jQuery("#dataTableForService").DataTable({ 
                  dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
                       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], 
                          
                  buttons: [ 
                            {extend: 'copy', className: 'btn-sm'},

                            {
                              extend: 'csv', 
                              title: 'ExampleFile',
                              className: 'btn-sm',
                              exportOptions: {columns:[0,1], modifier: {page: 'current'} }
                            },

                            {
                            extend: 'excel', 
                            title: 'ExampleFile',
                            className: 'btn-sm',
                            exportOptions: {columns:[0,1],modifier: {page: 'current'} }

                            }, 

                            {
                            extend: 'pdf', 
                            title: 'ExampleFile',
                            className: 'btn-sm',
                            exportOptions: { columns:[0,1],modifier: {page: 'current'} }
                            },

                           {
                            extend: 'print', className: 'btn-sm',
                            exportOptions: { columns:[0,1], modifier: { page: 'current'}}
                           } 
                     ] });
              </script>
              <style type="text/css">
                  #wpbody-content { 
                    width: 98% !important;
                }
              </style>
         </div><!-- / .tab-pane / #category-->
         <div class="tab-pane"  
                id ="add_service" > 
            <?php msbdt_add_service_form('4' ) ; ?>                    
         </div><!-- / .tab-pane / #add_category-->
      </div><!-- / .tab-content -->
   </div><!-- / .scheduler_admin -->
</div><!-- / .multi-appointment -->

<?php $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css(); ?>

<?php 

function msbdt_add_service_form($col_label){?>
<form  method = "post" action = "" class  = "row">
<div class = "col-sm-6 form-group " >
<div class = "row" >

    <!-- //////////// Service Name  ///////////////////////////// -->
    <div class = "col-sm-12 form-group " >                  
    <label for = "ser_name"><?php _e('Service Name','multi-scheduler'); ?></label>
    <input name = "ser_name"; 
          type = "text" 
            id = "ser_name"                     
         class = "form-control">    
    </div>     

    <!-- //////////// Category Name  ///////////////////////////// -->
   <div class = "col-sm-12 form-group" >
   <label for = "ser_name"><?php _e('Select Category','multi-scheduler'); ?></label>  
    <?php 
    if(method_exists('Msbdt_Category','msbdt_process_category_select_data')) :
    global $wpdb ;
    $category = Msbdt_Category::msbdt_process_category_select_data();    
    $categories = $wpdb->get_results( $category['query']['select_all']  , OBJECT ) ;
    
    endif ; ?> 
    <div class="admin_category_area admin_category_area_style"> 
    <?php foreach ($categories as $cat): ?>
    <div class = "col-sm-12 form-group"> 
    <label><input type  = "checkbox" 
                  name  = "category[]"  
                  value = "<?php echo $cat->cat_id ; ?>">
                  <?php echo $cat->cat_name ; ?></label>
    </div>  
    <?php endforeach ;  ?>
    </div>
    </div>                          
    <div class = "col-sm-12 form-group admin_submit_button_color">      
    <input  type = "submit" 
            name = "ser_submit" 
            id   = "" 
            class= "btn btn-primary" 
            value= "<?php echo esc_attr('Add Service','multi-scheduler'); ?>">      
    
     </div>
   </div>
  </div>
  </form>
<?php
msbdt_multi_selecter_js_and_css();
}

function msbdt_edit_service_form($service){?>
<div class="container-fluid">
   <form  method = "post" action = "" class  = "row">
  <!-- //////////// Service id  ///////////////////////////// -->
   <div class = "col-md-12 form-group">                  
   <input name = "ser_id"; type = "hidden" id = "ser_id"                     
           value = "<?php if(isset($service->ser_id)):echo $service->ser_id; endif; ?>" 
           class = "form-control">    
   </div>    
    
   <!-- //////////// Service Name  ///////////////////////////// -->
   <div class = "col-sm-12 form-group">                  
   <label for = "ser_name"><?php _e('Service Name','multi-scheduler'); ?></label></br>
   <div class = "form-group"> 
   <input name = "ser_name"; type = "text" id = "ser_name"                     
         value = "<?php if(isset($service->ser_name)):echo $service->ser_name; endif; ?>" 
         class = "form-control">    
   </div>   
   </div>   


    <!-- //////////// Category Name  ///////////////////////////// -->
    <div class = "col-sm-12 form-group">
    <label for = "ser_name"><?php _e('Category Name','multi-scheduler'); ?></label> 
    <?php 
    if(method_exists('Msbdt_Category','msbdt_process_category_select_data')) :
    global $wpdb ;
    $category = Msbdt_Category::msbdt_process_category_select_data();    
    $categories = $wpdb->get_results( $category['query']['select_all']  , OBJECT ) ;
    endif ; ?> 
    <?php $sellect_categories = json_decode($service->cat_id); ?>
    <div class="admin_category_area admin_category_area_style"> 
    <?php foreach ($categories as $cat): ?>
    <div class = "col-sm-12 form-group">
    <?php
     // findout  exist select category.  
     if( in_array( $cat->cat_id , $sellect_categories)):
     $set = 'checked';
     else:
     $set = '';
     endif;
    ?>
    <label><input type  = "checkbox" 
                  name  = "category[]"
                  <?php echo $set ; ?>  
                  value = "<?php echo $cat->cat_id ; ?>">
                  <?php echo $cat->cat_name ; ?></label>
    </div>  
    <?php endforeach ;  ?>
    </div>
    </div> 
    <!-- //////////// End Category Name  ///////////////////////////// --> 
                          
         
     <div class = "row"> 
     <div class = "col-sm-12 form-group">        
     <div class  = "modal-footer">
     <button class = "btn btn-default" type  = "button" data-dismiss="modal">
     <?php  esc_html_e('Close','multi-scheduler'); ?></button>        
     <input  type = "submit" 
            name = "ser_submit_for_change" 
            id   = "" 
            class= "btn btn-primary" 
            value= "<?php echo esc_attr('Change','multi-scheduler'); ?>" >                                          
      </div>    
      </div>    
      </div>    
    
  </div>
  </div>
  </form>
</div>              
    
   
<?php
}

function msbdt_delete_service_form($service){?>

<form  method = "post" 
       action = "" 
       class  = "row">

    <div class = "col-sm-4 form-group">                  
       <input name = "ser_id"; 
              type = "hidden" 
                id = "ser_id"                     
             value = "<?php if(isset($service->ser_id)):echo $service->ser_id; endif; ?>" 
             class = "form-control">    
    </div>                    
     <div class = "col-sm-12 form-group">      
        <input  type = "submit" 
                name = "ser_submit_for_delete" 
                id   = "" 
                class= "btn btn-primary" 
                value= "<?php echo esc_attr('Delete','multi-scheduler'); ?>">      
        
     </div>
    </form>
<?php
}


function msbdt_multi_selecter_js_and_css(){?>

<script type="text/javascript">
 jQuery('.admin_category_area').slimScroll({
     height: '100px',
     size: '3px',           
     color: '#5bbc2e'
     });  
</script>
<style type="text/css">      
.service_span{
    display: block;
    padding: 2px 10px;
 }
 .admin_category_area_style{
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    line-height: 1.42857143;
    color: #555;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    padding: 5px 1px;
 }
</style>

<?php
}