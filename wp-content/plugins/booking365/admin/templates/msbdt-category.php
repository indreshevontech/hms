
<?php global $category ; ?>

</br>
<div class = "multi-appointment row" > 
   <div class="scheduler_admin">
         <ul class="nav nav-tabs nav-pills" >
            <li class="active"  >
            <a  href="#category" data-toggle="tab">
            <h5><?php esc_html_e('Category','multi-scheduler') ;?></h5></a></li>
            <li><a href="#add_category" data-toggle="tab">
            <h5><?php esc_html_e('Add category','multi-scheduler') ;?></h5></a></li>              
        </ul>

   <?php 


if(isset($_POST['cat_submit'])):
      $category = Msbdt_Category::msbdt_process_category_data(); 
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
 if(isset($_POST['cat_submit_for_change'])):
      $category = Msbdt_Category::msbdt_process_category_update_data(); 
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
 if(isset($_POST['cat_submit_for_delete'])):
      $category = Msbdt_Category::msbdt_process_category_delete_data(); 
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

      </br>
        <div class="tab-content scheduler_admin">
          <div class="tab-pane active "  
                id ="category" >        
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
                        if(method_exists('Msbdt_Category','msbdt_process_category_select_data')) :
                        global $wpdb ;
                        $category = Msbdt_Category::msbdt_process_category_select_data();    
                        $categories = $wpdb->get_results( $category['query']['select_all'], OBJECT ) ;
                        endif ; ?> 
                        <?php  $serial_no = 1  ; ?>  
                        <?php foreach ($categories as $cat): ?>
                       <tr>           
                          <td><?php echo $serial_no  ; ?></td>
                          <td><?php echo ucwords($cat->cat_name) ; ?></td>
                          <td>                                                                      
                        <span><a class="button btn-warning" 
                                href="#delete<?php echo $cat->cat_id ; ?>" 
                                data-toggle="modal"><?php  _e( 'Delete','multi-scheduler' );?></a>
                        </span>                        
                        <div id="delete<?php echo $cat->cat_id;?>" 
                             class="modal fade">                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php  _e('Delete Category','multi-scheduler');?>
                                      </h4>
                                   </div>
                                    <div class="modal-body">                             
                                        <?php msbdt_delete_category_form($cat); ?>     
                                    </div><!-- /.modal-body -->
                                </div><!-- /.modal-content -->                               
                             </div><!-- /.modal -->
                        </div><!-- / #professional_delete -->
                        <span><a   class="button btn-primary" 
                           href="#edit<?php echo $cat->cat_id; ?>" 
                           data-toggle="modal">Edit</a>
                        </span>
                        <div id="edit<?php echo $cat->cat_id; ?>" 
                                 class="modal fade" >                               
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                   <div class="modal-header">
                                     <button class="close" type="button" data-dismiss="modal">×</button>
                                      <h4 class="modal-title"><?php _e('Edit Category','multi-scheduler');?>
                                      </h4>
                                    </div>
                                    <div class="modal-body">
                                    <?php msbdt_edit_category_form($cat); ?>     
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
                id ="add_category" > 
            <?php msbdt_add_category_form('4 ' ) ; ?>                    
         </div><!-- / .tab-pane / #add_category-->
      </div><!-- / .tab-content -->
   </div><!-- / .scheduler_admin -->
</div><!-- / .multi-appointment -->

<?php $scheduler_admin_custom_css = Msbdt_Custom_Admin_Style::msbdt_scheduler_admin_custom_css(); ?>

<?php 

function msbdt_add_category_form($col_label){?>

<form  method = "post" 
       action = "" 
       class  = "row">
  
    <div class = "col-sm-4 form-group">                  
       <label for = "cat_name"><?php _e('Category Name','multi-scheduler'); ?></label>
       <input name = "cat_name"; 
              type = "text" 
                id = "cat_name"                     
             value = "<?php if(isset($pro->fname)):echo $pro->fname; endif; ?>" 
             class = "form-control">    
    </div>                       
     <div class = "col-sm-12 form-group admin_submit_button_color">      
        <input  type = "submit" 
                name = "cat_submit" 
                id   = "" 
                class= "btn btn-primary" 
                value= "<?php echo esc_attr('Add Category','multi-scheduler'); ?>">      
        
     </div>
    </form>
<?php
}

function msbdt_edit_category_form($cat){?>

<form  method = "post" 
       action = "" 
       class  = "row">

    <div class = "col-sm-4 form-group">                  
       <input name = "cat_id"; 
              type = "hidden" 
                id = "cat_name"                     
             value = "<?php if(isset($cat->cat_id)):echo $cat->cat_id; endif; ?>" 
             class = "form-control">    
    </div>      
  
    <div class = "col-sm-4 form-group">                  
       <label for = "cat_name"><?php _e('Category Name','multi-scheduler'); ?></label>
       <input name = "cat_name"; 
              type = "text" 
                id = "cat_name"                     
             value = "<?php if(isset($cat->cat_name)):echo $cat->cat_name; endif; ?>" 
             class = "form-control">    
    </div>                       
     <div class = "col-sm-12 form-group admin_submit_button_color">      
        <input  type = "submit" 
                name = "cat_submit_for_change" 
                id   = "" 
                class= "btn btn-primary" 
                value= "<?php echo esc_attr('Change','multi-scheduler'); ?>">      
        
     </div>
    </form>
<?php
}

function msbdt_delete_category_form($cat){?>

<form  method = "post" 
       action = "" 
       class  = "row">

    <div class = "col-sm-4 form-group">                  
       <input name = "cat_id"; 
              type = "hidden" 
                id = "cat_name"                     
             value = "<?php if(isset($cat->cat_id)):echo $cat->cat_id; endif; ?>" 
             class = "form-control">    
    </div>                    
     <div class = "col-sm-12 form-group">      
        <input  type = "submit" 
                name = "cat_submit_for_delete" 
                id   = "" 
                class= "btn btn-primary" 
                value= "<?php echo esc_attr('Delete','multi-scheduler'); ?>">      
        
     </div>
    </form>
<?php
}