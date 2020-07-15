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
            <div class="card-header"><i class="fa fa-align-justify"></i>ประเมินผลการฝึกงานของนิสิตสหกิจ</div>
              <div class="card-body">
              <div class="alert alert-info" role="alert">
              ระดับคะแนน 5 = ดีมาก 4 = ดี 3 = ปานกลาง 2=พอใช้ 1 = ต้องปรับปรุง N/A  ไม่สามารถประเมินได้
                </div>
              <?php
              if($status) {
                echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
              }
              ?>
              <form action="<?php echo site_url('Company/Coop_student_assessment/save/'.$student_id);?>" method="post">
              <input type="hidden" value="<?php echo $student_id;?>" name="student_id">
              <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>หัวข้อประเมิน/Items</th>
                        <th>5</th>
                        <th>4</th>
                        <th>3</th>
                        <th>2</th>
                        <th>1</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data as $row) { ?>
                        <tr>
                          <td><b><?php echo $row['questionnaire_subject']['coop_student_questionnaire_subject_number']." ".$row['questionnaire_subject']['coop_student_questionnaire_subject_title'];?></b></td>
                        </tr>
                    
                      <?php foreach($row['questionnaire_item'] as $item) {?>
                        <tr>
                          <td>
                            <p><?php echo $item['coop_student_questionnaire_item_number']." ".$item['coop_student_questionnaire_item_title'];?></p>
                            <p><?php echo $item['coop_student_questionnaire_item_description'];?></p>
                          </td>
                          <?php for($i=5;$i>=1;$i--) { ?>
                            <td>
                              <input class="form-check-input" type="radio" value="<?php echo $i;?>" name="item[<?php echo $item['coop_student_questionnaire_item_id'];?>]" style="margin-left: unset !important; position: unset !important;" required <?php if(@$result[$item['coop_student_questionnaire_item_id']] == $i) echo 'checked'; ?>>
                            </td>
                          <?php } ?>
                        </tr>

                      <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>


                  <td>
                              
                                
                              <label for="no5">ประเมินนิสิตด้วยผลคะแนน(เต็ม100คะแนน)</label><code>*</code>
                              
                                  <input name="totalscore" type="number" min="0" step="1" max="100"  class="form-control" style="width:80px;" value="<?php echo $result_comment['coop_student_has_coop_student_questionnaire_comment_totalscore'];?>" placeholder="0.00" >
                              
                               
                               
                              
                            </td> 
               


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                       <label for="no5">จุดเด่นของนักศึกษา/Strength</label><code>*</code>
                       <textarea class="form-control" rows="5" id="no5" name="no5"><?php echo $result_comment['coop_student_has_coop_student_questionnaire_comment_no5'];?></textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                       <label for="no6">ข้อควรปรับปรุงของนักศึกษา/Improvement</label><code>*</code>
                       <textarea class="form-control" rows="5" id="no6" name="no6"><?php echo $result_comment['coop_student_has_coop_student_questionnaire_comment_no6'];?></textarea>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                       <label for="no7">ข้อคิดเห็นเพิ่มเติม /Other Comments</label><code>*</code>
                       <textarea class="form-control" rows="5" id="no7" name="no7"><?php echo $result_comment['coop_student_has_coop_student_questionnaire_comment_no7'];?></textarea>
                      </div>
                    </div>

                  </div>

                  

                  <div class="text-center">
                    <button type="reset" class="btn btn-md btn-danger"><i class=""></i> ยกเลิก</button>
                    <button type="submit" class="btn btn-md btn-success"><i class=""></i> บันทึก</button>                    
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      