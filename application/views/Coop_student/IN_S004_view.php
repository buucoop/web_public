<!-- Main content -->
<main class="main">
<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> แบบแจ้งรายละเอียดการปฏิบัติงาน และแผนที่ตั้งสถานประกอบการ
                    </div>
                    <div class="card-body">
                    <?php 
                    if($status){
                        echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                    }
                    ?>
                    <form action="<?php echo site_url('Coop_student/IN_S004/save');?>" method="post">


                     <!-- ข้อ 1 -->
                     <label for="name"><b>๑.	ชื่อ/ที่อยู่สถานประกอบการ </b></label>
                        <div class="row">
                            <div class="form-group col-sm-6">           
                                <label>ชื่อสถานประกอบการ (ภาษาไทย)</label><code>*</code>
                                <input type="text" class="form-control" id="name_th" name="name_th" value="<?php echo $company['company_name_th']; ?>" required disabled >
                            </div>
                        </div>
                          <div class="row">
                              <div class="form-group col-sm-12">
                                  <label>ที่ตั้ง </label><code>*</code>
                                  <input type="text" class="form-control" id="name_en" name="name_en" value="<?php echo $company_address['company_address_number']." ".$company_address['company_address_building']." ".$company_address['company_address_alley']." ".$company_address['company_address_road']." ".$company_address['company_address_district']." ".$company_address['company_address_area']." ".$company_address['company_address_province']." ".$company_address['company_address_postal_code']; ?>" required disabled >                     
                              </div>
                          </div>
                          <div class="row">
                                <div class="form-group col-sm-3">
                                    <label>โทรศัพท์</label><code>*</code>
                                    <input type="text" class="form-control" id="number" name="number" value="<?php echo $company_person['person_telephone']; ?>" required disabled >                                                        
                                </div>
                                <div class="form-group col-sm-5">
                                    <label>โทรสาร</label>
                                    <input type="text" class="form-control" id="building" name="building" value="<?php echo $company_person['person_fax_number']; ?>" required disabled >                                       
                                </div>
                              <div class="form-group col-sm-4">
                                  <label>E-mail </label><code>*</code>
                                  <input type="text" class="form-control" id="road" name="road" value="<?php echo $company_person['person_email']; ?>" required disabled >                                     
                              </div>
                          </div>
                        <div class="row">
                          <div class="form-group col-sm-6">
                               <label>	ชื่อผู้จัดการสถานประกอบการ </label><code>*</code>
                               <input type="text" class="form-control" id="alley" name="alley" value="<?php echo $company_person['person_fullname']; ?>" required disabled >                                             
                          </div>
                          <div class="form-group col-sm-4">
                               <label>ตำแหน่ง</label><code>*</code>
                               <input type="text" class="form-control" id="alley" name="alley" value="<?php echo $company_person['person_position']; ?>" required disabled >                                              
                          </div>

                            <div class="form-group col-sm-12">
                               <label>การติดต่อประสานงานกับคณะวิทยาการสารสนเทศ (การนิเทศงานนักศึกษา และอื่นๆ) ขอมอบให้</label><code>*</code>       
                                <div class="col-md-9 col-form-label">
                                <?php if($company['headoffice_person_id'] == $company['contact_person_id']) { ?>

                                    <div class="form-check form-check-inline mr-2">
                                      <input class="form-check-input" type="radio" value="option1" name="inline-radios" checked disabled>
                                      <label class="form-check-label" for="inline-radio1">ติดต่อกับผู้จัดการโดยตรง</label>
                                    </div>
                                    <br>
                                    <div class="form-check form-check-inline mr-2">
                                      <input class="form-check-input" type="radio" id="show" value="option2" name="inline-radios" disabled>
                                      <label class="form-check-label" for="inline-radio2">มอบหมายให้บุคคลต่อไปนี้ประสานงานแทน</label>
                                    </div>

                               <?php } else { ?>

                                    <div class="form-check form-check-inline mr-1">
                                    &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="option1" name="inline-radios" disabled>
                                      <label class="form-check-label" for="inline-radio1">ติดต่อกับผู้จัดการโดยตรง</label>
                                    </div>
                                    <br>
                                    <div class="form-check form-check-inline mr-1">
                                    &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="option2" name="inline-radios" checked disabled>
                                    <label class="form-check-label" for="inline-radio2">มอบหมายให้บุคคลต่อไปนี้ประสานงานแทน</label>
                                    </div>

                                <?php } ?>

                                </div>                     
                            </div>
                        </div>
                    <?php if($company['headoffice_person_id'] != $company['contact_person_id']) { ?>    
                        <div class="row" >
                            <div class="form-group col-sm-6">
                                <label>ชื่อ-นามสกุล</label><code>*</code>
                                <input type="text" class="form-control" name="" value="<?php echo $contact_person['person_fullname']; ?>" required disabled >                          
                            </div>

                            <div class="form-group col-sm-4">
                                <label>ตำแหน่ง(เลือก)</label><code>*</code>
                                <input type="text" class="form-control" name="" value="<?php echo $contact_person['person_position']; ?>" required disabled >                          
                            </div>

                            <div class="form-group col-sm-4">
                                <label>แผนก(เลือก)</label><code>*</code>
                                <input type="text" class="form-control" name="" value="<?php echo $contact_person['person_department']; ?>" required disabled >                          
                            </div>

                            <div class="form-group col-sm-4">
                               <label>โทรศัพท์ </label><code>*</code>
                               <input type="text" class="form-control" name="" value="<?php echo $contact_person['person_telephone']; ?>" required disabled >                                                     
                            </div>

                            <div class="form-group col-sm-4">
                               <label>โทรสาร</label>
                               <input type="text" class="form-control" name="" value="<?php echo $contact_person['person_fax_number']; ?>" required disabled >                                   
                            </div>

                            <div class="form-group col-sm-8">
                               <label>E-mail</label><code></code>
                               <input type="text" class="form-control" name="" value="<?php echo $contact_person['person_email']; ?>" required disabled >                                   
                            </div>
                        </div>
                    <?php } ?>

                    <!-- ข้อ 2 -->
                    <label for="name"><b>๒.	พี่เลี้ยง </b></label> <?php echo form_error('trainer_id'); ?><code>*</code>
                        <div class="row">
                            <div class="form-group col-sm-10">
                                <select class="form-control" name="trainer_id" id="trainer_lists">
                                    <option> ------- </option>
                                    <?php 
                                    foreach($company_persons as $person) { 
                                        $checked = '';
                                        // if($person['person_id'] == @$coop_student['trainer_id']) {
                                        //     $checked = 'selected';
                                        // }
                                        if(form_value_db('trainer_id', @$coop_student['trainer_id']) == $person['person_id']) {
                                            $checked = 'selected';
                                        }
                                        echo '<option value="'.$person['person_id'].'" '.$checked.'>'.$person['person_fullname'].' (อีเมล: '.$person['person_email'].') (เบอร์โทรศัพท์: '.$person['person_telephone'].') </option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#company_person_form"> + เพิ่มพี่เลี้ยง</a>
                            </div>
                            
                        </div>
                     <!-- ข้อ 3 -->
                     <label for="name"><b>๓. งานที่มอบหมายนิสิต</b></label>
                        <div class="row">
                            <div class="form-group col-sm-6">
                               <label>ชื่อ – นามสกุล (นิสิต)</label><code>*</code>
                               <input type="text" class="form-control" name="" value="<?php echo $student_name['student_fullname']; ?>" required disabled >                          
                            </div>
                            <div class="form-group col-sm-6">
                               <label>รหัสประจำตัว  (นิสิต)</label><code>*</code>
                               <input type="text" class="form-control" name="" value="<?php echo $student_name['student_id']; ?>" required disabled >                          
                            </div>                         
                            <div class="form-group col-sm-5">
                                <label>สาขาวิชา</label><code>*</code>
                                <input type="text" class="form-control" name="" value="<?php echo $student_department['department_name']; ?>" required disabled >                                                                
                            </div>
                            <div class="form-group col-sm-5">
                                <label>คณะ</label><code>*</code>
                                <input type="text" class="form-control" name="" value="-" required disabled >                                                                    
                            </div>
                            <div class="form-group col-sm-8">
                               <label>ตำแหน่งงานที่นักศึกษาปฏิบัติ (Job Position) </label><code>*</code>
                               <input type="text" class="form-control" name="" value="<?php echo $company_job_position['job_title']; ?>" required disabled >                                                     
                            </div>
                            <div class="form-group col-sm-8">
                               <label>ลักษณะงานที่นักศึกษาปฏิบัติ (Job Description)</label><code></code>
                               <input type="text" class="form-control" name="" value="<?php echo $company_job_position['job_description']; ?>" required disabled >                                   
                            </div>
                        </div>
                    <!-- ปิดข้อ 3 -->
                    <!-- ข้อ 4 -->
                    <label for="name"><b>๔.	ที่อยู่ที่นิสิตพักระหว่างการทำสหกิจศึกษา</b></label>
                    <div class="row">
                          <div class="form-group col-sm-8">
                               <label>ชื่อหอพัก/อพาร์ทเมนท์ </label> <?php echo form_error('dorm_name'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_name" value="<?php echo form_value_db('dorm_name', @$coop_student_dorm['dorm_name']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>ห้อง</label> <?php echo form_error('dorm_room'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_room" value="<?php echo form_value_db('dorm_room', @$coop_student_dorm['dorm_room']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>เลขที่ </label> <?php echo form_error('dorm_number'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_number" value="<?php echo form_value_db('dorm_number', @$coop_student_dorm['dorm_address_number']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>ซอย </label> <?php echo form_error('dorm_alley'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_alley" value="<?php echo form_value_db('dorm_alley', @$coop_student_dorm['dorm_address_alley']) ; ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>ถนน </label> <?php echo form_error('dorm_road'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_road" value="<?php echo form_value_db('dorm_road', @$coop_student_dorm['dorm_address_road']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>แขวง/ตำบล </label> <?php echo form_error('dorm_district'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_district" value="<?php echo form_value_db('dorm_district', @$coop_student_dorm['dorm_address_district']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>เขต/อำเภอ </label> <?php echo form_error('dorm_area'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_area" value="<?php echo form_value_db('dorm_area', @$coop_student_dorm['dorm_address_area']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>จังหวัด </label> <?php echo form_error('dorm_province'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_province" value="<?php echo form_value_db('dorm_province', @$coop_student_dorm['dorm_address_province']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>รหัสไปรษณีย์</label> <?php echo form_error('dorm_postal_code'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_postal_code" value="<?php echo form_value_db('dorm_postal_code', @$coop_student_dorm['dorm_address_postal_code']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>โทรศัพท์</label> <?php echo form_error('dorm_telephone'); ?><code>*</code>
                               <input type="text" class="form-control" name="dorm_telephone" value="<?php echo form_value_db('dorm_telephone', @$coop_student_dorm['dorm_telephone']); ?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>โทรสาร</label> <?php echo form_error('dorm_fax_number'); ?>
                               <input type="text" class="form-control" name="dorm_fax_number" value="<?php echo form_value_db('dorm_fax_number', @$coop_student_dorm['dorm_fax_number']); ?>">                          
                          </div>                
                        </div>
                      <!-- ปิดข้อ 4 -->
                         <!-- ข้อ 5 -->
                    
                    <label for="name"><b>๕. การรับเอกสารติดต่อจากทางมหาวิทยาลัย </b></label>
                        <div class="row">
                
                                    <div class="col-md-6 col-form-label">
                                        <div class="form-check checkbox">
                                        &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="0" id="radio1" name="coop_student_newsletter_receive" <?php if ($coop_student['coop_student_newsletter_receive'] == 0) echo 'checked'; ?> >
                                            <label class="form-check-label" for="radio1">
                                            ไม่รับ โดยจะติดตามข่าวสารจาก <u>http://www.informatics.buu.ac.th/coop</u>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-form-label"></div>

                                    <div class="col-md-6 col-form-label">
                                        <div class="form-check checkbox">
                                        &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="radio2"  name="coop_student_newsletter_receive" <?php if ($coop_student['coop_student_newsletter_receive'] == 1) echo 'checked'; ?> >
                                            <label class="form-check-label" for="radio2">
                                            รับเอกสารจากมหาวิทยาลัย โดยขอให้ส่งไปที่ ที่พัก
                                            </label>
                                        </div>
                                    </div>
                           
                                    <div class="col-md-6 col-form-label">
                                        <div class="form-check checkbox">
                                        &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="2" id="radio3"  name="coop_student_newsletter_receive" <?php if ($coop_student['coop_student_newsletter_receive'] == 2) echo 'checked'; ?> >
                                            <label class="form-check-label" for="radio3">
                                            รับเอกสารจากมหาวิทยาลัย โดยขอให้ส่งไปที่ สถานประกอบการ                            
                                            </label>
                                        </div>
                                    </div>                       
                    
                                                  
                        </div>
                      <!-- ปิดข้อ 5 -->
                       <!-- ข้อ 6 -->
                    <label for="name"><b>๖.	ชื่อที่อยู่ ผู้ที่สามารถติดต่อได้กรณีฉุกเฉิน</b></label>
                    <div class="row">
                          <div class="form-group col-sm-8">
                               <label>ชื่อ - สกุล  </label> <?php echo form_error('contact_fullname'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_fullname" name="contact_fullname" value="<?php echo form_value_db('contact_fullname', @$coop_student_emergency_contact['contact_fullname']) ;?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>เลขที่ </label> <?php echo form_error('contact_address_number'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_address_number" name="contact_address_number" value="<?php echo form_value_db('contact_address_number', @$coop_student_emergency_contact['contact_address_number']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>ซอย </label> <?php echo form_error('contact_address_alley'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_address_alley" name="contact_address_alley" value="<?php echo form_value_db('contact_address_alley', @$coop_student_emergency_contact['contact_address_alley']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>ถนน </label> <?php echo form_error('contact_address_road'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_address_road" name="contact_address_road" value="<?php echo form_value_db('contact_address_road', @$coop_student_emergency_contact['contact_address_road']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>แขวง/ตำบล </label> <?php echo form_error('contact_address_district'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_address_district" name="contact_address_district" value="<?php echo form_value_db('contact_address_district', @$coop_student_emergency_contact['contact_address_district']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>เขต/อำเภอ </label> <?php echo form_error('contact_address_area'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_address_area" name="contact_address_area" value="<?php echo form_value_db('contact_address_area', @$coop_student_emergency_contact['contact_address_area']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>จังหวัด </label> <?php echo form_error('contact_address_province'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_address_province" name="contact_address_province" value="<?php echo form_value_db('contact_address_province', @$coop_student_emergency_contact['contact_address_province']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>รหัสไปรษณีย์</label> <?php echo form_error('contact_address_postal_code'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_address_postal_code" name="contact_address_postal_code" value="<?php echo form_value_db('contact_address_postal_code', @$coop_student_emergency_contact['contact_address_postal_code']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>โทรศัพท์</label> <?php echo form_error('contact_telephone'); ?><code>*</code>
                               <input type="text" class="form-control" id="contact_telephone" name="contact_telephone" value="<?php echo form_value_db('contact_telephone', @$coop_student_emergency_contact['contact_telephone']);?>">                          
                          </div>
                          <div class="form-group col-sm-4">
                               <label>โทรสาร </label> <?php echo form_error('contact_fax_number'); ?>
                               <input type="text" class="form-control" id="contact_fax_number" name="contact_fax_number" value="<?php echo form_value_db('contact_fax_number', @$coop_student_emergency_contact['contact_fax_number']);?>" >                          
                          </div>                       
                        </div>
    
                      <!-- ปิดข้อ 6 -->
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-md btn-primary" value="1" name="print"><i class="fa fa-dot-circle-o"></i>Export</button>
                            <button type="submit" class="btn btn-md btn-success" value="0" name="print"><i class="fa fa-dot-circle-o"></i> บันทึก </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</main>



<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery.thailand/dependencies/JQL.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery.thailand/dependencies/typeahead.bundle.js');?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery.thailand/dist/jquery.Thailand.min.css');?>">
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery.thailand/dist/jquery.Thailand.min.js');?>"></script>
<script>
$.Thailand({
    $district: $('#district'), // input ของตำบล
    $amphoe: $('#area'), // input ของอำเภอ
    $province: $('#province'), // input ของจังหวัด
    $zipcode: $('#postal_code'), // input ของรหัสไปรษณีย์
});
</script>

<style>
.modal-dialog {
    max-width: 800px;
}
</style>
<!-- The Modal -->
<div class="modal fade" id="company_person_form">
    <div class="modal-dialog model-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มผู้นิเทศงาน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form id="save_trainer">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="fullname">ชื่อ-นามสกุล</label><code>*</code>
                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="ชื่อ-นามสกุล" value="" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for"email">E-mail</label><code>*</code>
                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for"position">ตำเเหน่ง</label><code>*</code>
                        <input type="text" id="position" name="position" class="form-control" placeholder="ตำเเหน่ง" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for"department">แผนกงาน</label><code>*</code>
                        <input type="text" id="department" name="department" class="form-control" placeholder="เเผนกงาน" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for"telephone">เบอร์โทร</label><code>*</code>
                        <input type="text" id="telephone" name="telephone" class="form-control" placeholder="เบอร์โทร" required>
                    </div>  
                    <div class="form-group col-md-12">
                        <label for"fax_number">FAX</label>
                        <input type="text" id="fax_number" name="fax_number" class="form-control" placeholder="FAX">
                    </div>
   
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
                
            </div>
            </form>
        </div>
    </div>
</div>
<script>
var validForm = false
jQuery(document).ready(function(){
    jQuery('#save_trainer').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        
    }).on('success.form.fv', function(e) {
        validForm = true;
    });
});



jQuery( "#save_trainer" ).submit(function( event ) {
    event.preventDefault();

    if(validForm) {
        //post ajax
        jQuery.post("<?php echo site_url('Coop_Student/IN_S004/ajax_save_trainer');?>", jQuery("#save_trainer").serialize(), function(result){
            jQuery("#company_person_form").modal('hide');

            if(result.status) {
                jQuery('#trainer_lists').append($('<option>', {
                    selected: true,
                    value: result.last_id,
                    text: jQuery("#save_trainer input[name=fullname]").val()+' (อีเมล: '+jQuery("#save_trainer input[name=email]").val()+') (เบอร์โทรศัพท์: '+jQuery("#save_trainer input[name=telephone]").val()+')'
                }));
                
                swal("สำเร็จ", result.text, result.color);                
            } else {
                swal("ผิดพลาด", result.text, result.color);
            }
            jQuery("#save_trainer input").val(null);
            

            
        }, 'json');

        
    }
});


</script>