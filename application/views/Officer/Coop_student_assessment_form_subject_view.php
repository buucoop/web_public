<!-- Main content -->

<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


        <div class="container-fluid">
          <div class="animated fadeIn">
              <div class="row" >
              <!--table รายชื่อนิสิต-->
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> จัดการแบบฟอร์มประเมินผลการฝึกงานของนิสิต
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#formModal">
                        เพิ่มหัวข้อการประเมิน
                        </button>
                    </div>
                      <div class="card-body">
                      <?php 
                          if($status){
                            echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                          }
                        ?>
                      <table class="table table-bordered datatable" >
                            <thead>
                              <tr bgcolor="">
                                <th>ลำดับหัวข้อ</th>
                                <th>หัวข้อการประเมิน</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach($coop_student_questionnaire_subject as $row){ ?>
                              <tr>
                                <td><?php echo $row['coop_student_questionnaire_subject_number'];?></td>
                                <td><?php echo $row['coop_student_questionnaire_subject_title'];?></td>
                                <td class="text-center">
                                    <?php echo anchor('Officer/Coop_student_assessment_form/get_coop_student_questionnaire_item/'.$row['coop_student_questionnaire_subject_id'], 'จัดการหัวข้อย่อย', 'class="btn btn-primary"');?>                              
                                </td>
                              </tr>
                                <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</main>
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มหัวข้อการประเมิน</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <form action="<?php echo site_url('Officer/Coop_student_assessment_form/add_coop_student_questionnaire_subject');?>" method="post">
              <div class="modal-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ลำดับหัวข้อ <?php echo form_error('number');?></label>
                    <input type="text" id="number" name="number" class="form-control" placeholder="กรุณากรอก" value="<?php echo $next_number;?>" >
                  </div>

                  <div class="form-group">
                    <label>ชื่อหัวข้อการประเมิน <?php echo form_error('title');?></label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="กรุณากรอก" value="<?php echo set_value('title');?>">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">บันทึก</button>
              </div>
            </form>

            
          </div>
          <!-- /.modal-content -->
        </div>
        
      <!-- /.modal-dialog -->
</div>


<?php if($open_modal) { ?>
<script>
jQuery( document ).ready(function() {
  jQuery("#formModal").modal('show')
})
</script>
<?php } ?>