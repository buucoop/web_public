<!-- Main content -->
<main class="main">

<?php echo $this->breadcrumbs->show() ;?>

<div class="container-fluid">
    <div class="animated fadeIn">
   
    <div class="col-md-12">
        <div class="alert alert-primary">
    <a href= "index2" style="color: info; font-size:22px;">ขั้นตอนการสมัครสหกิจ</a><br>
    <!-- <a href="<?php echo site_url('Student/Job/register_status');?>"style="color: primary; font-size:22px;"> ประกาศผลการสมัคร</a> -->
        <!--b>โปรดอัพเดทข้อมูลนิสิตก่อนเข้าใช้งาน</b-->
                    <!--a href="http://prepro.informatics.buu.ac.th:8003/index.php/c_login/login" style="color: info; font-size:18px;">คลิ๊กเพื่ออัพเดทข้อมูลนิสิต (สำคัญ** ให้อัพเดทข้อมูลประวัติของตัวเองหากไม่กรอก ข้อมูลใน IN-S001 จะไม่ครบถ้วน)</a><br-->
                    <!--b>2.โปรดสมัครเข้าร่วมเป็นนิสิตสมัครสหกิจก่อนเข้าใช้งานค่ะ</b>
                    <a href="<?php echo site_url('Student/Main/coop_register');?>" style="color: red; font-size:18px;"> คลิ้กเพื่อดาวน์โหลด IN-S001</a>
                   <b> หลังจากดาวน์โหลดเอกสารเสร็จแล้วให้นำส่งเจ้าหน้าที่ของคณะ เพื่อสมัครเป็นนิสิตสหกิจ</b><br>
                    <b>3.ดูผลการสมัครสหกิจ : </b>
                    <a href="http://prepro.informatics.buu.ac.th:8001/index.php/Student/Job/register_status" style="color: red; font-size:18px;"> คลิ๊กเพื่อตรวจสอบผลการสมัคร</a><br-->
                    <!--b>4.สามารถส่งเอกสารได้ที่นี้ : </b>
                    <a href="http://prepro.informatics.buu.ac.th:8001/index.php/Student/Upload_document/" style="color: red; font-size:18px;"> คลิ๊กเพื่อไปหน้าอัพโหลดเอกสาร</a-->
                    </div>
            </div>

            <!-- Document Status Here -->
            <div class="container-fluid">
<div class="animated fadeIn">
    <div class="row" >
        <!--1 box-->
        <div class="col-md-12">
            <div class="card">
              <div class="card-header"><i class="fa fa-align-justify"> จัดการเอกสารที่นิสิตต้องส่ง</div></i>
                <div class="card-body">
                    <?php
                    if(@$status) {
                        echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                    }
                    ?>
                    <div class="row">
                    <div class="col-md-12">               
                                    <table class="table table-bordered datatable">
                                    <div class = "alert alert-info"><b>โปรดทราบ</b> กรณีไม่มีข้อมูลในตาราง ให้นิสิตทำตามขั้นตอนการสมัครสหกิจ
                                    </div>&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <?php
                                    
                              
                                    


                                    ?>
                                    <!--div class = "alert alert-info"><b>โปรดอัพเดทข้อมูลนิสิตก่อนเข้าใช้งาน<b> <a href="http://prepro.informatics.buu.ac.th:8003/index.php/c_login/login">คลิ๊กเพื่ออัพเดทข้อมูลนิสิต (สำคัญ** ให้อัพเดทข้อมูลประวัติของตัวเองหากไม่กรอก ข้อมูลใน IN-S001 จะไม่ครบถ้วน)</a><br>
                                    <style="width: 100%"><b>โปรดทราบ</b> กรณีไม่มีข้อมูลในตาราง นิสิตต้องโหลด IN-S001 และ IN-S002 จากระบบก่อนจึงจะเห็นวันเวลาที่ต้องส่ง<br>
                                    <a href="<?php echo site_url('Student/Main/coop_register');?>"> คลิ้กเพื่อดาวน์โหลด IN-S001</a><b> **กรุณาอัพโหลดเอกสารด้วย**</b><br>
                                    <a href="<?php echo site_url('Student/Skill/');?>"> คลิ้กเพื่อกำหนดทักษะที่ถนัด</a><br>
                                    <a href="<?php echo site_url('Student/Job/lists');?>"> คลิ้กเพื่อกรอกใบสมัครบริษัทที่ต้องการ และ ดาวน์โหลด IN-S002</a><b> **กรุณาอัพโหลดเอกสารด้วย**</b><br>
                                    <a href="<?php echo site_url('Student/Job/register_status');?>"> ประกาศผลสมัคร</a><br>
                                    </div-->
                                    
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>กำหนดส่ง</th>
                                            <th>เอกสาร</th>
                                            <th>สถานะส่งเอกสาร</th>
                                        </tr>

                                        </thead>
                                        
                                        <tbody>
                                        <?php 
                                        $values = 0;
                                        foreach($files as $_key => $row){ 
                                            ?>                                         
                                            <tr>
                                         <?php
                                          
                                            ?>
                                                <td class="text-center"></td>
                                                <td class="text-left">
                                                  <?php echo $row['document_deadline'] ?>
                                                </td>
                                                <td class="text-left"><?php 
                                                    if ($row['document_id'] != 1) {
                                                      echo "IN-S002-ใบสมัครงาน";
                                                    }else{
                                                      echo "IN-S001-ใบสมัครเป็นนิสิตสหกิจ";
                                                };?></td>
                                                <td class="text-left"> <?php  
                                                        if($row['document_pdf_file'] != '') {
                                                      echo '<font color="#006600">อัพโหลดไฟล์แล้ว</font>';
                                                      $values++;
                                                    } else {
                                                      echo '<font color="red">ยังไม่ได้อัพโหลดไฟล์</font>';
                                                    } ?>&nbsp;&nbsp;<a class="" href="<?php echo site_url('Student/Upload_document/');?>" target="_top"><i class="fa fa-upload"></i> Upload</a></td>
                                                </tr>    
                                                    
                                        <?php }
                                        // $values = $_key;
                                        
                                        if ($values == 2 ) {
                                            $message = " รอบริษัทนัดสัมภาษณ์ และประกาศผล ";
                                            echo "<script type='text/javascript'>alert('$message');</script>";
                                            echo '<font color="red"> รอบริษัทนัดสัมภาษณ์ และประกาศผล</font> ';
                                            
                                        } else if ($values == 1 ) {
                                        $message = " เลือกสมัครบริษัท และอัพโหลดเอกสาร IN-S002";
                                        echo "<script type='text/javascript'>alert('$message');</script>";
                                        echo '<font color="red"> เลือกสมัครบริษัท และอัพโหลดเอกสาร IN-S002</font> ';
                                      
                                        } else if ($values == 0 ) {
                                        $message = " อัพโหลดเอกสาร IN-S001 ให้เรียบร้อย";
                                        echo "<script type='text/javascript'>alert('$message');</script>";
                                        echo '<font color="red"> อัพโหลดเอกสาร IN-S001 ให้เรียบร้อย</font> ';
                                        } 
                                        
                                        ?> 
                                        
                                        <div>
                                        <br>
                                        </div>     
                                        </tbody>
                                    </table>    
                                      
                                    
                </div>      
                
                        </div>                                    
                </div>
                
            </div>
            <div class="">
            <p class="text-center">
                <a href="<?php echo site_url('Student/Job/register_status');?>"style="color: primary; font-size:22px;"> ประกาศผลการสมัคร</a>
                </p>
                </div>
                
                           
        </div>
    </div>
</div>
</div> 

            <!-- End Document status -->


            <?php if($status) : ?>
            <div class="col-md-12">
                <div class="alert alert-<?php echo $status['color'];?>">
                    <b><?php echo $status['text'];?></b>
                </div>

            </div>
            <?php endif; ?>

            <?php if($session_alert) : ?>
            <div class="col-md-12">
                <?php echo $session_alert;?>

            </div>
            <?php endif; ?>

            

        <?php foreach($rowNews as $row) { ?>
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <?php echo $row['news_title'];?>
                        <span class="btn btn-danger float-right"><?php echo thaiDate(date('Y-m-d H:i', strtotime($row['news_date'])), false, false);?></span>                            
                    </div>
                    <div class="card-body">
                        <?php echo $row['news_detail'];?>
                    </div>

                    <?php if(@$row['file']) { ?>                        
                    <div class="card-footer">
                        ดาวน์โหลดไฟล์:
                        <?php 
                        foreach($row['file'] as $rowFile) {
                            echo '<a href="'.base_url('uploads/'.$rowFile).'" class="btn btn-xs btn-info">'.basename($rowFile).'</a>';
                        }
                        ?>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>  
        <?php } ?> 
      </div>  
    </div>
  </div>
  <!-- /.conainer-fluid -->
</main>