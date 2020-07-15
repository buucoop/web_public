    <!-- Main content -->
    <main class="main">

    <?php echo $this->breadcrumbs->show() ;?>

    <div class="container-fluid">
        <div class="animated fadeIn">
       
        <div class="col-md-12">
		    <div class="alert alert-primary"-->
        <a style=" font-size:22px;">ขั้นตอนการสมัครสหกิจ</a><br><br>
        <a style=" font-size:18px;"><a>1.</a><b> โปรดอัพเดทข้อมูลนิสิตก่อนเข้าใช้งาน<b></a> <a href="http://prepro.informatics.buu.ac.th:8003/index.php/c_login/login"style="color: primary; font-size:18px;">คลิ๊กเพื่ออัพเดทข้อมูลนิสิต Click (สำคัญ** ให้อัพเดทข้อมูลประวัติของตัวเองหากไม่กรอก ข้อมูลใน IN-S001 จะไม่ครบถ้วน)</a><br>
                                        
                                        <a>2.</a> <a href="<?php echo site_url('Student/Skill/');?>"style="color: primary; font-size:18px;"> คลิ้กเพื่อกำหนดทักษะที่ถนัด Click</a><br>
                                        <a>3.</a> <a href="<?php echo site_url('Student/Main/coop_register');?>"style="color: primary; font-size:18px;"> คลิ้กเพื่อดาวน์โหลด IN-S001 Click</a><a style=" font-size:18px;"><b> **กรุณาอัพโหลดเอกสารด้วย** </b></a><br>
                                        <a>4.</a> <a href="<?php echo site_url('Student/Job/lists');?>"style="color: primary; font-size:18px;"> คลิ้กเพื่อเลือกสมัครบริษัทที่ต้องการ และ ดาวน์โหลด IN-S002 Click</a><a style=" font-size:18px;"><b> **กรุณาอัพโหลดเอกสารด้วย**</b></a> </br>
                                        <a>5.</a>  หลังจากที่นิสิตกรอกข้อมูลและดาวน์โหลดเอกสารครบแล้วนิสิตสามารถเช็คผลการสมัครของนิสิตได้ที่หน้าแรกหรือคลิ๊ก<a href="<?php echo site_url('Student/Job/register_status');?>"style="color: primary; font-size:22px;"> ประกาศผลการสมัคร Click!</a> </a><br>
                                        <!--a href="<?php echo site_url('Student/Job/register_status');?>"style="color: primary; font-size:18px;"> ประกาศผลการสมัคร Click</a><br-->
                                        
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

