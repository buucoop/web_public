<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>แบบอนุญาติให้นิสิตไปปฏิบัติงานสหกิจ</div>

              <div class="card-body">
                <?php 
                // echo validation_errors('<div class="alert alert-warning">', '</div>');
                if(@$status) {
                  echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                }
                ?>

                <div class="card-header"><strong> 1.ข้อมูลทั่วไป</strong></div><br>
              
                

                <form id="permit_form" method="post" action="<?php echo site_url('Coop_student/Permit_form/post/');?>">
                 <div class="row">
                 <div class="form-group col-sm-8">
                   <label for="student_fullname">ชื่อนิสิต นาย/นางสาว</label><code>*</code>
                   <input type="text" class="form-control" name="student_fullname" id="student_fullname" value="<?php echo $student['student_fullname']; ?>" disabled>
                  </div>
                 </div>
                 <div class="row">
                  <div class="form-group col-sm-4">
                   <label for="student_id">รหัสนิสิต</label><code>*</code>
                   <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $student['student_id'] ?>" disabled>
                  </div>
                  <div class="form-group col-sm-4">
                   <label for="department">สาขาวิชา</label><code>*</code>
                   <input type="text" class="form-control" id="department" name="department" value="<?php echo $department['department_name'] ?>" disabled>
                </div>
                <div class="form-group col-sm-4">
                   <label for="city">หลักสูตร</label><code>*</code>
                   <input type="text" class="form-control" id="student_course" name="student_course" value="<?php echo $student['student_course'] ?>" disabled>
                  </div>
              </div>
              <div class="row">
              <div class="form-group col-sm-8">
                   <label for="permit_fullname">ชื่อผู้ปกครอง <?php echo form_error('permit_fullname'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_fullname" name="permit_fullname" value="<?php echo form_value_db('permit_fullname', @$permit['permit_fullname']);?>">
                  </div>
              </div>
              <div class="row">
              <div class="form-group col-sm-8">
                   <label for="permit_relative">ความสัมพันธ์กับนิสิต <?php echo form_error('permit_relative'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_relative" name="permit_relative" value="<?php echo form_value_db('permit_relative', @$permit['permit_relative']);?>">
                  </div>
              </div>
              <div><label for="city">สถานที่ติดต่อสะดวก</label></div>
              <div class="row">
                  <div class="form-group col-sm-4">
                   <label for="permit_address_number">บ้านเลขที่ <?php echo form_error('permit_address_number'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_address_number" name="permit_address_number" value="<?php echo form_value_db('permit_address_number', @$permit['permit_address_number']);?>">
                  </div>
                  <div class="form-group col-sm-4">
                   <label for="permit_address_road">ถนน <?php echo form_error('permit_address_road'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_address_road" name="permit_address_road" value="<?php echo form_value_db('permit_address_road', @$permit['permit_address_road']);?>">
                </div>
                <div class="form-group col-sm-4">
                   <label for="permit_address_district">ตำบล <?php echo form_error('permit_address_district'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_address_district" name="permit_address_district" value="<?php echo form_value_db('permit_address_district', @$permit['permit_address_district']);?>">
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-sm-4">
                   <label for="permit_address_area">อำเภอ <?php echo form_error('permit_address_area'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_address_area" name="permit_address_area" value="<?php echo form_value_db('permit_address_area', @$permit['permit_address_area']);?>">
                  </div>
                  <div class="form-group col-sm-4">
                   <label for="permit_address_province">จังหวัด <?php echo form_error('permit_address_province'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_address_province" name="permit_address_province" value="<?php echo form_value_db('permit_address_province', @$permit['permit_address_province']);?>">
                </div>
                <div class="form-group col-sm-4">
                   <label for="permit_address_postal_code">รหัสไปรษณีย์ <?php echo form_error('permit_address_postal_code'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_address_postal_code" name="permit_address_postal_code" value="<?php echo form_value_db('permit_address_postal_code', @$permit['permit_address_postal_code']);?>">
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-sm-4">
                   <label for="permit_telephone">โทรศัพท์ <?php echo form_error('permit_telephone'); ?></label><code>*</code>
                   <input type="text" class="form-control" id="permit_telephone" name="permit_telephone" value="<?php echo form_value_db('permit_telephone', @$permit['permit_telephone']);?>">
                  </div>
                  <div class="form-group col-sm-4">
                   <label for="permit_fax_number">โทรสาร <?php echo form_error('permit_fax_number'); ?></label>
                   <input type="text" class="form-control" id="permit_fax_number" name="permit_fax_number" value="<?php echo form_value_db('permit_fax_number', @$permit['permit_fax_number']);?>">
                </div>
                <div class="form-group col-sm-4">
                   <label for="permit_email">E-mail <?php echo form_error('permit_email'); ?></label>
                   <input type="text" class="form-control" id="permit_email" name="permit_email" value="<?php echo form_value_db('permit_email', @$permit['permit_email']);?>">
                  </div>
              </div>

               <div class="card-header"><strong> 2.การตอบรับอนุญาติให้นิสิตไปปฏิบัติงานสหกิจศึกษา</strong> <code>*</code></div><br>

              <div class="row">
              <div class="radio col-sm-12">
                          <label for="allow_choice_1">
                            <input type="radio" id="allow_choice_1" name="permit_choice" value="1" <?php if(@$permit['permit_choice']==1) echo 'checked';?>> อนุญาติให้นิสิตในปกครองไปปฏิบัติงานสหกิจศึกษาตามที่มหาวิทยาลัยกำหนด
                          </label>
                        </div>
              </div>
              <div class="row">
              <div class="radio col-sm-12">
                          <label for="allow_choice_0">
                            <input type="radio" id="allow_choice_0" name="permit_choice" value="0" <?php if(@$permit['permit_choice']==0) echo 'checked';?>> ไม่อนุญาติอนุญาติให้นิสิตในปกครองไปปฏิบัติงานสหกิจศึกษา
                          </label>
                        </div>
              </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-md btn-primary" name="print" value="1"><i class="fa fa-dot-circle-o"></i>Export</button>
                  <button type="submit" class="btn btn-md btn-success" name="print" value="0"><i class="fa fa-dot-circle-o"></i>บันทึกเอกสาร</button>                
       
                </div>

                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>