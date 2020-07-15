<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> แบบฟอร์มกิจกรรมฝึกงานในแต่ละวัน</div>
                    <div class="card-body">             
                        <?php if($form_type == 'update') { ?>
                            <form action="<?php echo site_url('Coop_student/Daily_activity/post_update');?>" method="post">
                            <input type="hidden" name="activity_id" value="<?php echo $row['activity_id'];?>">                        
                        <?php } else { ?>
                            <form action="<?php echo site_url('Coop_student/Daily_activity/post_add');?>" method="post">                        
                        <?php } ?>

                            <div class="row">
                                <?php if($form_type == 'update') { ?>
                                    <div class="form-group col-md-12">
                                        <label for="activity_date">ประจำวันที่</label>          
                                        <input value="<?php echo @$row['activity_date'];?>" class="form-control" type="text" name="activity_date" id="activity_date" disabled>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group col-md-12">
                                        <label>เลือกวันที่ <?php echo form_error('activity_date'); ?></label>
                                        <br>
                                        <input type="text" class="form-control datetimepicker" id="activity_date" placeholder="" name="activity_date" value="">    

                                    </div> 
                                <?php } ?>

                                <div class="form-group col-md-12">
                                    <label for="activity_subject">หัวข้อ <?php echo form_error('activity_subject'); ?></label>          
                                    <input value="<?php echo form_value_db('activity_subject', @$row['activity_subject']);?>" class="form-control" type="text" name="activity_subject" id="activity_subject" >
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="activity_content">รายละเอียด <?php echo form_error('activity_content'); ?></label>          
                                    <textarea id="summernote" name="activity_content" ><?php echo form_value_db('activity_content', @$row['activity_content']);?></textarea>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="reset" class="btn btn-warning"><i class="fa fa-dot-circle-o"></i> ยกเลิก</button>                                
                                    <button type="submit" class="btn btn-primary" name="save" value="1"><i class="fa fa-dot-circle-o"></i> บันทึกข้อมูล</button>                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>

<link href="<?php echo base_url('assets/plugins/summernote/summernote-lite.css');?>" rel="stylesheet">
<script src="<?php echo base_url('assets/plugins/summernote/summernote-lite.js');?>"></script>
<script>
window.onload = function() {
    $('#summernote').summernote({
        height:300,
    });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.16/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.16/jquery.datetimepicker.css" />
<script>
jQuery(function() {
  jQuery('.datetimepicker').datetimepicker({
    format:'Y-m-d H:i:00',
    inline:true,
    allowTimes:['07:00', '07:05', '07:10', '07:15', '07:20', '07:25', '07:30', '07:35', '07:40', '07:45', '07:50', '07:55', '08:00', '08:05', '08:10', '08:15', '08:20', '08:25', '08:30', '08:35', '08:40', '08:45', '08:50', '08:55', '9:00', '9:05', '9:10', '9:15', '9:20', '9:25', '9:30', '9:35', '9:40', '9:45', '9:50', '9:55', '10:00', '10:05', '10:10', '10:15', '10:20', '10:25', '10:30', '10:35', '10:40', '10:45', '10:50', '10:55', '11:00', '11:05', '11:10', '11:15', '11:20', '11:25', '11:30', '11:35', '11:40', '11:45', '11:50', '11:55', '12:00', '12:05', '12:10', '12:15', '12:20', '12:25', '12:30', '12:35', '12:40', '12:45', '12:50', '12:55', '13:00', '13:05', '13:10', '13:15', '13:20', '13:25', '13:30', '13:35', '13:40', '13:45', '13:50', '13:55', '14:00', '14:05', '14:10', '14:15', '14:20', '14:25', '14:30', '14:35', '14:40', '14:45', '14:50', '14:55', '15:00', '15:05', '15:10', '15:15', '15:20', '15:25', '15:30', '15:35', '15:40', '15:45', '15:50', '15:55', '16:00', '16:05', '16:10', '16:15', '16:20', '16:25', '16:30', '16:35', '16:40', '16:45', '16:50', '16:55', '17:00', '17:05', '17:10', '17:15', '17:20', '17:25', '17:30', '17:35', '17:40', '17:45', '17:50', '17:55', '18:00', '18:05', '18:10', '18:15', '18:20', '18:25', '18:30', '18:35', '18:40', '18:45', '18:50', '18:55', '19:00', '19:05', '19:10', '19:15', '19:20', '19:25', '19:30', '19:35', '19:40', '19:45', '19:50', '19:55', '20:00', '20:05', '20:10', '20:15', '20:20', '20:25', '20:30', '20:35', '20:40', '20:45', '20:50', '20:55', '21:00', '21:05', '21:10', '21:15', '21:20', '21:25', '21:30', '21:35', '21:40', '21:45', '21:50', '21:55', '22:00'],

  });

})
</script>