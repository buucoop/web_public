
<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row" >

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> แบบประเมินสถานประกอบการ</div>
              <div class="card-body">

                <?php 
                if( count($data) < 1 ) {
                  echo '<div class="alert alert-warning">ไม่พบข้อมูล</div>';
                } else {
                ?>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>หัวข้อประเมิน/Items</th>
                        <th>คะแนน</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data as $row) { ?>
                        <tr>
                          <td><b><?php echo $row['questionnaire_subject']['coop_company_questionnaire_subject_number']." ".$row['questionnaire_subject']['coop_company_questionnaire_subject_title'];?></b></td>
                          <td></td>
                        </tr>
                    
                      <?php foreach($row['questionnaire_item'] as $item) {?>
                        <tr>
                          <td>
                            <p><?php echo $item['coop_company_questionnaire_item_number']." ".$item['coop_company_questionnaire_item_title'];?></p>
                            <p><?php echo $item['coop_company_questionnaire_item_description'];?></p>
                          </td>
                          <td class="text-right">
                            <?php echo number_format($item['avg_score'], 2); ?>
                          </td>
                        </tr>

                      <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>

                  <div class="row">
                    <div class="col-md-12" style="margin-bottom:10px;">
                      <lable><b>4. ตามข้อ 1.2 สถานประกอบการได้สนับสนุนสิ่งอำนวยความสะดวกต่าง ๆ ได้แก่</b></lable><code>*</code>
                      <textarea id="textarea-input" name="no4" rows="6" class="form-control" placeholder="......"><?php echo $comment['no4'];?></textarea>
                    </div>
                    <div class="col-md-12" style="margin-bottom:10px;">
                      <lable><b>5 .ตามข้อ 1.3 สถานประกอบการได้ให้การสนับสนุนด้านสวัสดิการ ได้แก่</b></lable><code>*</code>
                      <textarea id="textarea-input" name="no5" rows="6" class="form-control" placeholder="......"><?php echo $comment['no5'];?></textarea>
                    </div>
                    <div class="col-md-12" style="margin-bottom:10px;">
                      <lable><b>6. ในปีการศึกษาถัดไป ท่านคิดว่าสมควรส่งนักศึกษาไปปฏิบัติสหกิจศึกษา/ฝึกงาน ณ สถานประกอบการแห่งนี้หรือไม่</b></lable><code>*</code>
                      <div class="custom-controls-stacked">
                          <label class="custom-control custom-radio">
                            <span class="custom-control-description"><?php echo $comment['no6']['y'];?> คน เห็นสมควรส่งไป</span>
                          </label>
                          <label class="custom-control custom-radio">
                            <span class="custom-control-description"><?php echo $comment['no6']['n'];?> คน ไม่สมควรส่งไป</span>
                          </label>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-12" style="margin-bottom:10px;">
                      <lable><b>7.ข้อคิดเห็นเพิ่มเติม</b></lable> <?php form_error('no7'); ?><code>*</code>
                      <textarea id="textarea-input" name="no7" rows="6" class="form-control"><?php echo $comment['no7'];?></textarea>
                    </div>
                  </div>
                  <?php } ?>
                  

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      