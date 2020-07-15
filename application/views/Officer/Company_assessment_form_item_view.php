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
                      <i class="fa fa-align-justify"></i> จัดการหัวข้อย่อยแบบประเมินผลสถานประกอบการ

                      <a href="<?php echo site_url('Officer/Company_assessment_form');?>" class="btn btn-warning  float-right" >กลับไปยังหัวข้อหลัก</a>
                        
                    </div>
                      <div class="card-body">
                      <div class="row">
                          <div class="col-lg-6">
                            <select name="form_subject" id="form_subject" class="form-control">
                              <option disabled>----</option>
                                <?php
                                foreach($form_subject as $form) {
                                  if($subject['coop_company_questionnaire_subject_id'] == $form['coop_company_questionnaire_subject_id']) {
                                    echo '<option value="'.$form['coop_company_questionnaire_subject_id'].'" selected>'.$form['coop_company_questionnaire_subject_number'].' - '.$form['coop_company_questionnaire_subject_title'].'</option>';
                                  } else {
                                    echo '<option value="'.$form['coop_company_questionnaire_subject_id'].'">'.$form['coop_company_questionnaire_subject_number'].' - '.$form['coop_company_questionnaire_subject_title'].'</option>';
                                  }
                                }
                                ?>
                            </select>
                            </div>
                            <div class="col-lg-6 text-right">
                              <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#add_item_form">
                                <i class="icon-plus"></i>
                                เพิ่มหัวข้อการประเมิน
                              </button>
                            </div>
                        </div>
                        <br><br>
                      <table class="table table-bordered " >
                            <thead>
                              <tr bgcolor="">
                                <th>ลำดับ</th>
                                <th>ประเภท</th>
                                <th>หัวข้อย่อยการประเมิน</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach($company_questionnaire_item as $row) { ?>
        
                              <tr>
                                <td><?php echo $row['coop_company_questionnaire_item_number'];?></td>
                                <td><?php echo $row['coop_company_questionnaire_item_type'];?></td>
                                <td><?php echo $row['coop_company_questionnaire_item_title'];?></td>
                                <td>
                                  <a href="#" data-itemid="<?php echo $row['coop_company_questionnaire_item_id'];?>" class="btn btn-info editBtn"><i class="icon-pencil"></i> แก้ไข</a>
                                  <a href="<?php echo site_url('Officer/Company_assessment_form/delete_company_questionnaire_item/'.$row['coop_company_questionnaire_item_id']);?>" class="btn btn-danger" onclick="return confirmDelete(this)"><i class="icon-trash"></i> ลบ</a>
                
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</main>

<div class="modal fade" id="add_item_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มหัวข้อย่อยการประเมิน</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <form action="<?php echo site_url('Officer/Company_assessment_form/add_company_questionnaire_item/'.$subject['coop_company_questionnaire_subject_id']);?>" method="post">
              <div class="modal-body">
                <input type="hidden" name="subject_id" value="<?php echo $subject['coop_company_questionnaire_subject_id']; ?>">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ลำดับหัวข้อย่อย <?php echo form_error('number');?></label>
                    <input type="text" id="number" name="number" class="form-control" placeholder="กรุณากรอก" value="<?php echo $next_number;?>" >
                  </div>
                  
                  <div class="form-group">
                    <label>ชื่อหัวข้อย่อยการประเมิน <?php echo form_error('title');?></label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="กรุณากรอก" value="<?php echo set_value('title');?>">
                  </div>

                  <div class="form-group">
                    <label>รายละเอียดหัวข้อ <?php echo form_error('description');?></label>
                    <textarea class="form-control" name="description" value="<?php echo set_value('description');?>"></textarea>
                  </div>
                

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">การให้คะแนน <?php echo form_error('type');?></label>
                    <div class="col-md-4 col-form-label">
                      <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" type="radio" id="inline-radio1" value="score" name="type" <?php echo set_checkbox('type', 'score');?>>
                      <label class="form-check-label" for="inline-radio1">คะแนน 1 - 5</label>
                      </div>
                    </div>
                    <div class="col-md-4 col-form-label">
                      <div class="form-check form-check-inline mr-2">
                      <input class="form-check-input" type="radio" id="inline-radio2" value="comment" name="type" <?php echo set_checkbox('type', 'comment');?>>
                      <label class="form-check-label" for="inline-radio2">ความคิดเห็น</label>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">บันทึก</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
</div>






<div class="modal fade" id="edit_item_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขหัวข้อย่อยการประเมิน</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <form action="<?php echo site_url('Officer/Company_assessment_form/update_company_questionnaire_item/'.$subject['coop_company_questionnaire_subject_id']);?>" method="post">
              <div class="modal-body">
                <input type="hidden" name="item_id" id="item_id">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ลำดับหัวข้อย่อย <span id="edit_form_number"></span></label>
                    <input type="text" id="item_number" name="number" class="form-control" placeholder="กรุณากรอก">
                  </div>
                  
                  <div class="form-group">
                    <label>ชื่อหัวข้อย่อยการประเมิน <span id="edit_form_title"></span></label>
                    <input type="text" id="item_title" name="title" class="form-control" placeholder="กรุณากรอก">
                  </div>

                  <div class="form-group">
                    <label>รายละเอียดหัวข้อ <span id="edit_form_description"></span></label>
                    <textarea class="form-control" name="description" id="item_description"></textarea>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">การให้คะแนน <span id="edit_form_type"></span></label>
                    <div class="col-md-4 col-form-label">
                      <div class="form-check form-check-inline mr-1">
                      <input class="form-check-input" type="radio" id="type_score" value="score" name="type">
                      <label class="form-check-label" for="type_score">คะแนน 1 - 5</label>
                      </div>
                    </div>
                    <div class="col-md-4 col-form-label">
                      <div class="form-check form-check-inline mr-2">
                      <input class="form-check-input" type="radio" id="type_comment" value="comment" name="type">
                      <label class="form-check-label" for="type_comment">ความคิดเห็น</label>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success">บันทึก</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
</div>
<script>
jQuery(".dataTables_length").hide(); jQuery(".dataTables_filter").hide();
</script>
<script>
jQuery(".editBtn").click(function(event) {
  var item_id = jQuery(this).data('itemid')
  call_assessment_item(item_id)
})

jQuery("#form_subject").change(function(event) {
  window.location.assign(SITE_URL+"/Officer/Company_assessment_form/get_company_questionnaire_item/"+jQuery(this).val())
})


function call_assessment_item(item_id) {
  //ajax get
  jQuery.get( SITE_URL+"/Officer/Company_assessment_form/get_ajax_item/"+item_id, function( result ) {
    var data = result.data
    jQuery("#item_title").val(data.coop_company_questionnaire_item_title)
    jQuery("#item_number").val(data.coop_company_questionnaire_item_number)
    jQuery("#item_id").val(data.coop_company_questionnaire_item_id)
    jQuery("#item_description").val(data.coop_company_questionnaire_item_description)

    if(data.coop_company_questionnaire_item_type == 'score') {
      jQuery("#type_score").prop('checked', true);
    }
    if(data.coop_company_questionnaire_item_type == 'comment') {
      jQuery("#type_comment").prop('checked', true);
    }

    jQuery('#edit_item_form').modal('show')
    
    
  }, "json" );
}
</script>

<?php if($open_modal && $last_item_id) { ?>
<script>
jQuery( document ).ready(function() {
  jQuery("#edit_form_number").html('<?php echo form_error('number');?>')
  jQuery("#edit_form_title").html('<?php echo form_error('title');?>')
  jQuery("#edit_form_description").html('<?php echo form_error('description');?>')
  jQuery("#edit_form_type").html('<?php echo form_error('type');?>')
  
  
  call_assessment_item(<?php echo @$last_item_id;?>)
  
})
</script>
<?php } else if($open_modal) { ?>
<script>
jQuery( document ).ready(function() {
  jQuery("#add_item_form").modal('show')
  
})
</script>
<?php } ?>