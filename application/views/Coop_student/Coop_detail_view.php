<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-8 offset-sm-2">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>ข้อมูลนิสิต
          </div>
            <div class="card-body">
              
                <div class="row">
                    <div class="col-sm-4">
                        <center>
                        <img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $student['student_id']; ?>" class="img-circle" style="width:280px;">
                        <br></br>
                        <h4><?php echo $student['student_id']; ?></h4>
                        <h5><?php echo $student_profile['Student_Prefix'].' '.$student_profile['Student_Name_Th'].' '.$student_profile['Student_Lname_Th'];?></h5>
                        </center>
                        </div>
                    <div class="col-sm-8">
                    <table class="table table-bordered ">
                            <tr><h3>ข้อมูลทั่วไป</h3></tr>
                            <tr><td width="25%">ชื่อภาษาอังกฤษ</td><td><font color="#0000ff"><?php echo $student_profile['Student_Name_Eng'].' '.$student_profile['Student_Lname_Eng'];?></font></td</tr>
                            <tr><td>คณะ</td><td><font color="#0000ff">วิทยาการสารสนเทศ</font></td></tr>
                            <tr><td>สาขา</td><td><font color="#0000ff"><?php echo $department['department_name']; ?></font></td></tr>
                            <tr><td>ปีการศึกษา </td><td><font color="#0000ff"><?php echo $term['term_year']; ?>&nbsp;<?php echo $term['term_name']; ?></font></td></tr>
                            <tr><td>หลักสูตร</td><td><font color="#0000ff"><?php echo $student_profile['Course'];?></font></td></tr>
                            <tr>
                              <td>อาจารย์ที่ปรึกษา</td>
                              <td>
                                <font color="#0000ff">
                                  <?php 
                                  echo @$adviser_full_name;
                                  ?>
                                </font>
                              </td>
                            </tr>
                            <tr><td>หน่วยกิตที่ผ่าน </td><td><font color="#0000ff"><?php echo @$sum_credit;?></font></td></tr>
                            <tr><td>GPAX</td><td><font color="#0000ff"><?php echo $student_profile['GPAX'];?></font></td></tr>
                          </table>
                          
                        <table class="table table-bordered ">
                            <tr><h3>ข้อมูลสหกิจ</h3></tr>
                            <tr><td width="25%">ชั่วโมงอบรม</td><td>
                            <?php if($pass_training) { ?>
                              <font color="#006600">ผ่าน</font>
                            <?php } else { ?>
                              <font color="">ไม่ผ่าน</font>
                            <?php } ?>
                            </td></tr>
                            <tr><td >วิชาแกน</td><td>
                            <?php if($student['student_core_subject_status'] == '1') { ?>
                              <font color="">ผ่านวิชาแกน</font>                            
                            <?php } else { ?>
                              <font color="">ยังไม่ผ่านวิชาแกน</font>
                            <?php } ?>
                            </td></tr>
                            <tr><td>เกรด</td><td><font color="#ff3300"><?php echo $student_profile['GPAX'];?></font></td></tr>
                            <tr><td>สถานะสถานประกอบการ</td><td><?php echo $company_status['company_status_name']; ?></td></tr>
                            
                            <tr><td>สถานะการสอบวัดผลรอบ</td><td><font color=""><?php echo $coop_status['coop_status_name']; ?></font></td></tr>
                          </table>
                          <table class="table table-bordered ">
                            <tr><h3>ข้อมูลสถานประกอบการ</h3></tr>
                            <tr><td width="25%">บริษัท</td><td>
                              <font color="#006600"><?php echo $company['company_name_th']; ?></font>
                            </td></tr>
                            <tr><td >ตำแหน่ง</td><td><?php echo $company_job_position['job_title']; ?></td></tr>
                            <tr><td>อาจารย์ที่ปรึกษา</td><td><font color="#ff3300"><?php echo $adviser['adviser_fullname']; ?></font></td></tr>                                                                                                     
                            </td></tr>
                          </table>
                    </div>
                  </div>

            </div>
        </div>
      </div>
    </div>
  </div>
</div>

 
