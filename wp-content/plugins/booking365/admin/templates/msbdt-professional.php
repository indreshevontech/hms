<?php Msbdt_Professional::msbdt_select_professional_data() ; ?>
<br/>
<div class = "multi-appointment row" > 
   <div class="scheduler_admin">
         <ul class="nav nav-tabs nav-pills" >
            <li class="active"  >
            <a  href="#professional" data-toggle="tab">
            <h5><?php esc_html_e('Professional','multi-scheduler') ;?></h5></a></li>
            <li><a href="#add_professional" data-toggle="tab">
            <h5><?php esc_html_e('Add Professional','multi-scheduler') ;?></h5></a></li>              
        </ul>

<!-- /////////////////////////// message ///////////////////////////////////-->
<?php
if(isset($_POST['add_professional_submit'])):
      $professional = Msbdt_Professional::msbdt_process_professional_data(); 
      if( isset($professional['action_status']) ):?> 

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($professional['action_status'] == 'no_error_data_save_successfully'): ?>
        <div id="message" class="updated notice is-dismissible">
          <p><strong><?php _e('Add successfully','multi_scheduler') ;?></strong></p>
          <button type="button" class="notice-dismiss">
          <span class="screen-reader-text"><?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
          </button>
        </div>          

        <?php elseif($professional['action_status'] == 'something_is_error') : ?>
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
 if(isset($_POST['edit_professional_submit'])):
      $category = Msbdt_Professional::msbdt_update_professional_data(); 
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
 if(isset($_POST['professional_delete'])):
      $category = Msbdt_Professional::msbdt_delete_professional_data(); 
      if( isset($category['action_status']) ):?> 

  <div class = "row">
    <div class = "col-sm-7">
      <?php if($category['action_status'] == 'delete_successfully'): ?>
            <div id="message" class="updated notice is-dismissible">
              <p><strong><?php _e('Delete successful','multi_scheduler') ;?></strong></p>
              <button type="button" class="notice-dismiss">
              <span class="screen-reader-text">
              <?php _e('Dismiss this notice.','multi-scheduler') ;?></span>
              </button>
            </div>         
         <?php endif ; ?>
   </div><!-- end .col-sm-7 -->
 </div><!-- end .row -->
 <?php endif; ?>
<?php endif ; ?>

<!-- /////////////////////////// End message ///////////////////////////////////-->
      <br/>
        <div class="tab-content scheduler_admin">
          <div class="tab-pane active"  
                id ="professional" >        
                <table class="table table-bordered textColorForAllPage" 
                         id = "dataTableForProfessional">
                 <thead>
                    <tr>
                      <th><?php _e('SRL','multi-scheduler') ;?></th>
                      <th><?php _e('Name','multi-scheduler') ;?></th>
                      <th><?php _e('Email','multi-scheduler') ;?></th>
                      <th><?php _e('Contact No.','multi-scheduler') ;?></th>
                      <th><?php _e('Action','multi-scheduler') ;?></th>
                    </tr>
                  </thead>
                  <tbody> 
                        <?php 
                        if(method_exists('Msbdt_Professional','msbdt_select_professional_data')) :
                        global $wpdb ;
                        $professional = Msbdt_Professional::msbdt_select_professional_data();    
                        $professionals = $wpdb->get_results( $professional['query']['select_all']  , OBJECT ) ;
                        endif ; ?> 
                        <?php  $serial_no = 1  ; ?>  
                        <?php foreach ($professionals as $professional): ?>
                       <tr>           
                          <td><?php echo $serial_no  ; ?></td>
                          <td><?php echo ucwords($professional->fname.' '.$professional->lname) ; ?></td>
                          <td><?php echo $professional->email ; ?></td>
                          <td><?php echo $professional->contact_no ; ?></td>
                          <td>                                                                      
                        <span><a class="button btn-warning" 
                                href="#delete<?php echo $professional->pro_id ; ?>" 
                                data-toggle="modal"><?php  _e( 'Delete','multi-scheduler' );?></a>
                        </span>                        
                        <div id="delete<?php echo $professional->pro_id  ;?>" 
                             class="modal fade">                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php  _e('Delete Service','multi-scheduler');?>
                                      </h4>
                                   </div>
                                    <div class="modal-body">                             
                                        <?php delete_conform_pro($professional); ?>     
                                    </div><!-- /.modal-body -->
                                </div><!-- /.modal-content -->                               
                             </div><!-- /.modal -->
                        </div><!-- / #professional_delete -->
                        <span><a   class="button btn-primary" 
                           href="#edit<?php echo $professional->pro_id ; ?>" 
                           data-toggle="modal"><?php  _e('Edit','multi-scheduler');?></a>
                        </span>
                        <div id="edit<?php echo $professional->pro_id; ?>" 
                                 class="modal fade" >                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                   <div class="modal-header">
                                     <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php _e('Edit Professional','multi-scheduler');?>
                                      </h4>
                                    </div>
                                    <div class="modal-body">
                                    <?php professional_form_edit_html($professional); ?>     
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
                id ="add_professional" > 
            <?php professional_form_html( null , 'col-sm-2','col-sm-4') ; ?>                    
         </div><!-- / .tab-pane / #add_category-->
      </div><!-- / .tab-content -->
   </div><!-- / .scheduler_admin -->
</div><!-- / .multi-appointment -->
<?php msbdt_datatable_calling_for_professional(); ?>
<?php msbdt_multi_selecter_js_and_css(); ?>
<?php $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css(); ?>


<?php 
function professional_form_html( $pro = null , $col_label = null , $col_span = null , $errors = null){ ?>
 
   <form  method = "post" action = "" class = "row">
  
    <div class = "col-sm-4"> 
    <div class = "row"> 

    
    <div class = "col-sm-12 form-group">                  
    <label for = "first_name"><?php _e('First Name','multi-scheduler'); ?></label>
    <input name="fname"; type="text"  id="first_name" class="form-control">     
    </div>
    
    <div class = "col-sm-12 form-group">                  
    <label for = "last_name"><?php _e('Last Name','multi-scheduler'); ?></label>
    <input name="lname"; type="text"  id="last_name" class="form-control">     
    </div>
    
    <div class = "col-sm-12 form-group">
    <label for = "service"><?php _e('Service','multi-scheduler'); ?></label>
    <?php 
    if(method_exists('Msbdt_Service','msbdt_select_added_all_service')) :
    global $wpdb ;
    $service = Msbdt_Service::msbdt_select_added_all_service();    
    $services = $wpdb->get_results( $service['query']['select_all']  , OBJECT ) ;
    endif ; ?>
    <div class="admin_service_area admin_service_area_style"> 
    <?php foreach ($services as $service): ?>   
    <div class="service_span"><input type  = "checkbox"
                  class  = "toggle" 
                  name  = "service[]"  
                  value = "<?php echo $service->ser_id ; ?>">
                  <?php echo $service->ser_name ; ?></div>
    <?php endforeach ;?>
    </div>
    </div>

    <div class = "col-sm-12 form-group">
    <label for="state"><?php echo __('Sex','multi-scheduler'); ?></label>
    <input type = "radio" name = "sex"  value="male" checked>
    <?php esc_html_e('Male','multi-scheduler'); ?></span>
    <input type="radio" name="sex" value="female">
    <?php esc_html_e('Female','multi-scheduler'); ?>
    </div>

    <div class = "col-sm-12 form-group">
    <label  for="email"><?php echo __('Email','multi-scheduler'); ?></label>   
    <input  name  = "email" 
            type  = "email" 
            id    = "email"                         
            value = "<?php if(isset($pro->email)):echo $pro->email ; endif; ?>" 
            class = "form-control">
    </div>


    <div class = "col-sm-12 form-group">
    <label for="contact_no">
    <?php echo __('Contact No','multi-scheduler'); ?>  </label>         
    <input name = "contact_no" 
           type = "text" 
            id  = "contact_no"                         
          value = "<?php if(isset($pro->contact_no)):echo $pro->contact_no; endif; ?>" 
          class = "form-control">
    </div> 

     <div class = "col-sm-12 form-group">
     <label for="website">
     <?php _e('Website','multi-scheduler'); ?>  </label>
     <input name   = "website" 
            type  = "url" 
            id    = "website"                         
            value = "<?php if(isset($pro->website)):echo $pro->website; endif; ?>" 
            class = "form-control">                
      </div> 

        
      <div class = "col-sm-12 form-group">
      <label for="biographical_info">
      <?php echo __('Biographical Information','multi-scheduler'); ?></label>   
      <textarea                      
                 rows = "3"
                 name = "biographical_info" 
                 type = "text" 
                 id   = "biographical_info" 
                 class= "form-control">
                 <?php if(isset($pro->biographical_info)):
                 echo $pro->biographical_info; 
                 endif;  ?>                            
      </textarea>        
      </div>

       </div> 
       </div> 

        <div class = "col-sm-12 form-group admin_submit_button_color">
        <input  type = "submit" name = "add_professional_submit" id   = "" class= "btn btn-primary" 
                value= "<?php echo esc_attr('Add New Professional','multi-scheduler'); ?>">      
        </div>
    </form>               
<?php }

function professional_form_edit_html( $pro = null , $col_label = null , $col_span = null , $errors = null){ ?>
 
   <form  method = "post" action = "" class = "row">
  
    <!-- //////////////// Section one  //////////////////// -->
    <div class = "col-sm-4 col-md-4 col-xs-12"> 
    <div class = "row"> 
    <input name ="pro_id"; 
          type ="hidden" 
          id   ="pro_id"                     
          value="<?php if(isset($pro->pro_id)):echo $pro->pro_id; endif; ?>" >

    <div class = "col-sm-12 form-group">                  
    <label for = "first_name"><?php _e('First Name','multi-scheduler'); ?></label>
    <input name="fname"; type="text"  id="first_name" class="form-control"
     value="<?php if(isset($pro->fname)):echo $pro->fname; endif; ?>" >     
    </div>
    
    <div class = "col-sm-12 form-group">                  
    <label for = "last_name"><?php _e('Last Name','multi-scheduler'); ?></label>
    <input name="lname"; type="text"  id="last_name" class="form-control"
     value = "<?php if(isset($pro->lname)):echo $pro->lname; endif; ?>" >     
    </div>

    <div class = "col-sm-12 form-group">
    <label for = "service"><?php _e('Service','multi-scheduler'); ?></label>
    <?php 
    if(method_exists('Msbdt_Service','msbdt_select_added_all_service')) :
    global $wpdb ;
    $service = Msbdt_Service::msbdt_select_added_all_service();    
    $services = $wpdb->get_results( $service['query']['select_all']  , OBJECT ) ;
    endif ; ?>
    <?php $sellect_categories = json_decode($pro->ser_id); ?>
    <div class="admin_service_area admin_service_area_style"> 
    <?php foreach ($services as $service): ?>
    <?php
         // findout  exist select category.  
         if( in_array( $service->ser_id , $sellect_categories)):
         $set = 'checked';
         else:
         $set = '';
         endif;
        ?>   
    <div class="service_span"><input type  = "checkbox"
                  class  = "toggle" 
                  name  = "service[]"
                  <?php echo $set ; ?>   
                  value = "<?php echo $service->ser_id ; ?>">
                  <?php echo $service->ser_name ; ?></div>
    <?php endforeach ;?>
    </div>
    </div>
    </div>
    </div><!-- col-sm-4 -->


    <!-- //////////////// Section two  //////////////////// -->

    <div class = "col-sm-4 col-md-4 col-xs-12"> 
    <div class = "row"> 

    <div class = "col-sm-12 form-group">
    <label for="state"><?php echo __('Sex','multi-scheduler'); ?></label>
    <input type = "radio"  name = "sex" value="male"
    <?php if(isset($pro->sex) && $pro->sex=='male'):echo 'checked="checked"'; endif; ?> 
    checked="checked"><span class="date-time-text format-i18n">
    <?php esc_html_e('Male','multi-scheduler'); ?></span>
    <input type="radio" name="sex"
    <?php if(isset($pro->sex) && $pro->sex=='female'):echo 'checked="checked"'; endif; ?>  
    value="female"><span class="date-time-text format-i18n">
    <?php esc_html_e('Female','multi-scheduler'); ?></span>
    </div>

    <div class = "col-sm-12 form-group">
    <label  for="email"><?php echo __('Email','multi-scheduler'); ?></label>   
    <input  name  = "email" 
            type  = "email" 
            id    = "email"                         
            value = "<?php if(isset($pro->email)):echo $pro->email ; endif; ?>" 
            class = "form-control">
    </div>


    <div class = "col-sm-12 form-group">
     <label for="website">
     <?php _e('Website','multi-scheduler'); ?>  </label>
     <input name   = "website" 
            type  = "url" 
            id    = "website"                         
            value = "<?php if(isset($pro->website)):echo $pro->website; endif; ?>" 
            class = "form-control">                
    </div> 


    <div class = "col-sm-12 form-group">
    <label for="contact_no">
    <?php echo __('Contact No','multi-scheduler'); ?>  </label>         
    <input name = "contact_no" 
           type = "text" 
            id  = "contact_no"                         
          value = "<?php if(isset($pro->contact_no)):echo $pro->contact_no; endif; ?>" 
          class = "form-control">
    </div> 
    </div> 
    </div> 

    <!-- //////////////// Section three  //////////////////// -->

    <div class = "col-sm-4 col-md-4 col-xs-12"> 
    <div class = "row"> 
    <div class = "col-sm-12 form-group">
    <label for="biographical_info">
    <?php echo __('Biographical Information','multi-scheduler'); ?></label>   
    <textarea                      
               rows = "3"
               name = "biographical_info" 
               type = "text" 
               id   = "biographical_info" 
               class= "form-control">
               <?php if(isset($pro->biographical_info)):
               echo $pro->biographical_info; 
               endif;  ?>                            
    </textarea>        
    </div>
    </div> 
    </div>
   <!-- //////////////// Section Submit updated  //////////////////// -->

    <div class = "col-sm-12 form-group admin_submit_button_color">
    <input  type = "submit" name = "edit_professional_submit" id   = "" class= "btn btn-primary" 
     value= "<?php echo esc_attr('Change','multi-scheduler'); ?>">      
    </div>
    </form>               
               
                
<?php }

function delete_conform_pro($pro){?>

    <form  method = "post" 
           action = "" 
           class  = "row">

        <input name = "pro_id"; 
              type  = "hidden" 
              id    = "pro_id"                     
              value = "<?php if(isset($pro->pro_id)):echo $pro->pro_id; endif; ?>" 
              class = "form-control"> 

         <?php  _e('Are you sure to delete ?.','multi-scheduler') ; ?>

         <div class="modal-footer">
        <button class = "btn btn-default" 
                type  = "button" 
                data-dismiss = "modal"><?php _e('Close','multi-scheduler');?></button>        
         <input type  = "submit" 
                name  = "professional_delete" 
                id    = "" 
                class = "btn btn-warning" 
                value = "<?php echo esc_attr('Delete','multi-scheduler'); ?>">                                            
        </div> 

   </form>
                
  <?php 
}

function msbdt_datatable_calling_for_professional(){?> 
  <script type="text/javascript">
    jQuery("#dataTableForProfessional").DataTable({ 
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
         #wpbody-content { width: 98% !important;}
         .multiselect {
           width: 200px;
          }



  </style>
<?php 
}

function msbdt_multi_selecter_js_and_css(){?>

<script type="text/javascript">
 jQuery('.admin_service_area').slimScroll({
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
 .admin_service_area_style{
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