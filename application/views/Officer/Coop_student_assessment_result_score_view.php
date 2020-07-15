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
            <div class="card-header"><i class="fa fa-align-justify"></i>ประเมินผลการฝึกงานของนิสิตสหกิจ ของ <?php echo $student['student_fullname']." ".$student['student_id'];?></div>
              <div class="card-body">
              <?php 
              if($sum_score < 1) { 
                echo '<div class="alert alert-warning"><b>นิสิตคนนี้ยังไม่ถูกประเมิน</b></div>';
              }
              ?>
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
                          <td colspan="6"><b><?php echo $row['questionnaire_subject']['coop_student_questionnaire_subject_number']." ".$row['questionnaire_subject']['coop_student_questionnaire_subject_title'];?></b></td>
                        </tr>
                    
                        <?php foreach($row['questionnaire_item'] as $item) {?>
                          <tr>
                            <td>
                              <p><?php echo $item['coop_student_questionnaire_item_number']." ".$item['coop_student_questionnaire_item_title'];?></p>
                              <p><?php echo $item['coop_student_questionnaire_item_description'];?></p>
                            </td>
                            <?php for($i=5;$i>=1;$i--) { ?>
                              <td>
                                <?php if(@$result[$item['coop_student_questionnaire_item_id']] == $i) echo "\u{2714}"; ?>
                              </td>
                            <?php } ?>
                          </tr>

                        <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>

                  <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                      <table class="table table-bordered" style="font-size: 18px;">
                        <thead>
                          <tr>
                            <th>คะแนนเต็ม</th>
                            <th>คะแนนที่ได้</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="font-size: 32px;text-align:right;"><?php echo $total_score;?></td>
                            <td style="font-size: 32px;text-align:right;color:<?php if($sum_score>49) echo 'green'; else echo 'red';?>;"><?php echo $sum_score;?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                       <label for="no5">จุดเด่นของนักศึกษา/Strength</label><code>*</code>
                       <textarea class="form-control" rows="5" id="no5" name="no5" readonly><?php echo $result_comment['coop_student_has_coop_student_questionnaire_comment_no5'];?></textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                       <label for="no6">ข้อควรปรับปรุงของนักศึกษา/Improvement</label><code>*</code>
                       <textarea class="form-control" rows="5" id="no6" name="no6" readonly><?php echo $result_comment['coop_student_has_coop_student_questionnaire_comment_no6'];?></textarea>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                       <label for="no7">ข้อคิดเห็นเพิ่มเติม /Other Comments</label><code>*</code>
                       <textarea class="form-control" rows="5" id="no7" name="no7" readonly><?php echo $result_comment['coop_student_has_coop_student_questionnaire_comment_no7'];?></textarea>
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
      

<style>
.form-control:disabled, .form-control[readonly] {
  background: #fff !important;
}
</style>      