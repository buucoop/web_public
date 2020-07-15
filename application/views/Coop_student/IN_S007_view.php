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
            <form action="<?php echo site_url('Coop_student/IN_S007/save');?>" method="post">
                <div class="card-header"><i class="fa fa-align-justify"></i>แบบคำร้องทั่วไป</div>
                    <div class="card-body">
                    <?php 
                    if($status){
                        echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                    }
                    ?>
                    <div class="row">
                            <div class="form-group col-sm-10">           
                                <label>เรื่อง</label> <?php echo form_error('petition_subject'); ?><code>*</code>
                                <input type="text" class="form-control" id="petition_subject" name="petition_subject" value="">
                            </div>
                            <div class="form-group col-sm-8">           
                                <label>ชื่อ - นามสกุล (ภาษาไทย)</label><code>*</code>
                                <input type="text" class="form-control" value="<?php echo $student['student_fullname'];?>" disabled>
                            </div>
                            <div class="form-group col-sm-4">           
                                <label>รหัสนิสิต </label><code>*</code>
                                <input type="text" class="form-control" value="<?php echo $student['student_id'];?>" disabled>
                            </div>
                              <div class="form-group col-sm-4">
                                <label>หลักสูตร(เลือก)</label><code>*</code>
                                <input type="text" class="form-control" value="<?php echo $student['student_course'];?>" disabled>                                                                            
                            </div>
                            <div class="form-group col-sm-4">
                               <label>สาขาวิชา(เลือก)</label><code>*</code>
                               <input type="text" class="form-control" value="<?php echo $department['department_name'];?>" disabled>
                          </div>
                            <div class="form-group col-sm-6">           
                                <label>ชื่ออาจารย์ที่ปรึกษาวิชาการ (ภาษาไทย)</label><code>*</code>
                                <input type="text" class="form-control" value="<?php echo $adviser['adviser_fullname'];?>" disabled>
                            </div>
                            <div class="form-group col-sm-4">           
                                <label>โทรศัพท์มือถือ </label><code>*</code>
                                <input type="text" class="form-control" value="<?php echo @$profile_student['Student_Phone']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-8">           
                                <label>อีเมล์  </label><code>*</code>
                                <input type="text" class="form-control" value="<?php echo @$profile_student['Student_Email']; ?>" disabled>
                            </div>
                            <div class="form-group col-sm-8">           
                                <label>มีความประสงค์  </label> <?php echo form_error('petition_purpose'); ?><code>*</code>
                                <textarea id="petition_purpose" name="petition_purpose" rows="4" class="form-control" placeholder="Content.."></textarea>
                            </div>
                            <div class="form-group col-sm-8">           
                                <label>เนื่องจาก   </label> <?php echo form_error('petition_reason'); ?><code>*</code>
                                <textarea id="petition_reason" name="petition_reason" rows="4" class="form-control" placeholder="Content.."></textarea>
                            </div>
                        </div>




                        <center>
                          <button type="submit" class="btn btn-md btn-primary" name="print" value="1"><i class="fa fa-dot-circle-o"></i>Export</button>
                          <button type="submit" class="btn btn-md btn-success" name="save" value="1"><i class="fa fa-dot-circle-o"></i>บันทึกเอกสาร</button>     
                        </center>                           
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
      