<!-- Breadcrumb -->

<!-- Main content -->
<main class="main">

<!--Breadcrumb-->
<?php echo $this->breadcrumbs->show(); ?>




<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <!--1 box-->
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"> จัดการเอกสารที่นิสิตต้องส่ง</div></i>
                    <div class="card-body">
                        <?php
                        if(@$status) {
                            echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                        }
                        ?>
                        <div class="row">
                            <!-- แสดงรายการที่เพิ่ม -->                                    
                                        <table class="table table-bordered datatable">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>กำหนดส่ง</th>
                                                <th>เอกสาร</th>
                                                <th>สถานะเอกสาร</th> 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($coop_document as $i => $row){
                                                if($row['document_deadline'] == '0000-00-00 00:00:00') {
                                                    $timestr = time();
                                                } else {
                                                    $timestr = strtotime($row['document_deadline']);
                                                }
                                            ?>                                         
                                                <tr>

                                                    <td class="text-center"></td>
                                                    <td class="text-left">
                                                        <?php echo thaiDate(date('Y-m-d H:i', $timestr)); ?>
                                                    </td>
                                                    <td class="text-left"><?php echo $row['document_code']."-".$row['document_name'];?>
                                                      <a class="badge badge-pill badge-warning open_document_deadline_form clickable" data-document-id="<?php echo $row['document_id'];?>" data-deadline-date="<?php echo date('Y-m-d', $timestr);?>" data-deadline-time="<?php echo date('H:i', $timestr);?>">
                                                      กำหนดส่ง...
                                                      </a>
                                                    </td>
                                                    <td class="text-center">
                                                      <label class="switch switch-text switch-pill switch-success-outline-alt">
                                                        <input type="checkbox" class="switch-input" <?php if($row['document_active'] == 1) echo 'checked'; ?> data-document-id="<?php echo $row['document_id'];?>">
                                                        <span class="switch-label" data-on="On" data-off="Off"></span>
                                                        <span class="switch-handle"></span>       
                                                      </label>                                         
                                                    </td>
                
                                                </tr> 
                                            <?php } ?>       
                                            </tbody>
                                        </table>                      
                            </div>                                    
                            <!-- แสดงรายการที่เพิ่ม -->
                    </div><!-- close card  -->
                </div><!-- close card body -->
                    
            </div><!-- close card col-md-6 -->
        </div><!-- close row -->
    </div><!-- close animated -->
 </div> <!-- close rocontainerw -->
 </main>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.16/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.16/jquery.datetimepicker.css" />
<script>
jQuery(function() {
  jQuery('.datetimepicker').datetimepicker({
    format:'Y-m-d H:i:00',
    inline:true,
    allowTimes:['07:00', '07:05', '07:10', '07:15', '07:20', '07:25', '07:30', '07:35', '07:40', '07:45', '07:50', '07:55', '08:00', '08:05', '08:10', '08:15', '08:20', '08:25', '08:30', '08:35', '08:40', '08:45', '08:50', '08:55', '9:00', '9:05', '9:10', '9:15', '9:20', '9:25', '9:30', '9:35', '9:40', '9:45', '9:50', '9:55', '10:00', '10:05', '10:10', '10:15', '10:20', '10:25', '10:30', '10:35', '10:40', '10:45', '10:50', '10:55', '11:00', '11:05', '11:10', '11:15', '11:20', '11:25', '11:30', '11:35', '11:40', '11:45', '11:50', '11:55', '12:00', '12:05', '12:10', '12:15', '12:20', '12:25', '12:30', '12:35', '12:40', '12:45', '12:50', '12:55', '13:00', '13:05', '13:10', '13:15', '13:20', '13:25', '13:30', '13:35', '13:40', '13:45', '13:50', '13:55', '14:00', '14:05', '14:10', '14:15', '14:20', '14:25', '14:30', '14:35', '14:40', '14:45', '14:50', '14:55', '15:00', '15:05', '15:10', '15:15', '15:20', '15:25', '15:30', '15:35', '15:40', '15:45', '15:50', '15:55', '16:00', '16:05', '16:10', '16:15', '16:20', '16:25', '16:30', '16:35', '16:40', '16:45', '16:50', '16:55', '17:00', '17:05', '17:10', '17:15', '17:20', '17:25', '17:30', '17:35', '17:40', '17:45', '17:50', '17:55', '18:00', '18:05', '18:10', '18:15', '18:20', '18:25', '18:30', '18:35', '18:40', '18:45', '18:50', '18:55', '19:00', '19:05', '19:10', '19:15', '19:20', '19:25', '19:30', '19:35', '19:40', '19:45', '19:50', '19:55', '20:00', '20:05', '20:10', '20:15', '20:20', '20:25', '20:30', '20:35', '20:40', '20:45', '20:50', '20:55', '21:00', '21:05', '21:10', '21:15', '21:20', '21:25', '21:30', '21:35', '21:40', '21:45', '21:50', '21:55', '22:00'],
  });

    jQuery(".open_document_deadline_form").click(function(e) {

        jQuery("#document_id").val(jQuery(this).data('document-id'))

        jQuery('.datetimepicker').datetimepicker({
            defaultDate: jQuery(this).data('deadline-date'),
            formatDate:'Y-m-d',
            defaultTime: jQuery(this).data('deadline-time'),
            formatTime:'H:i',
        });

        jQuery("#document_deadline_form").modal('show')

    })

})


jQuery(".switch-input").change(function(e) {
  console.log(jQuery(this).data('document-id'))
  console.log(jQuery(this).prop('checked'))
  var val_status
  if(jQuery(this).prop('checked')) {
    val_status = '1';
  } else {
    val_status = '0';
  }

  jQuery.post(SITE_URL+"/Officer/Setting/update_document_status/", { document_id: jQuery(this).data('document-id'), status: val_status }, function(response) {
    console.log(response)
    toastr['success']('กำหนดสำเร็จ')

  }, 'json')

});
</script>


<div class="modal fade" id="document_deadline_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('Officer/setting/post_edit_document');?>" method="post">
            <input type="hidden" name="document_id" id="document_id" value="">
            <div class="modal-header">
                <h4 class="modal-title">กำหนดส่ง</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <p for="">กำหนดวันส่งเอกสาร</p>
                    <div class="text-center">
                        <input type="text" class="form-control datetimepicker" id="" placeholder="" name="document_deadline_datetime" style="width: 100%;">    
                    </div>
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-warning">บันทึก</button>
            </div>
            </form>
        </div>
    </div>
</div>