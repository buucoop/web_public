    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><?php echo strToLevel($user->login_type);?></a></li>
        <li class="breadcrumb-item active">ประกาศข่าวสาร</li>
      </ol>
    
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-12">
            <div class="alert alert-primary">
            
        <a style=" font-size:22px;">ขั้นตอนการรับสมัคร</a><br>
			<b>1. สถานประกอบการสามารถตรวจสอบรายชื่อนิสิตที่สมัครได้ที่นี้</b>
                        <a href="http://prepro.informatics.buu.ac.th:8001/index.php/Company/Job_list_position/company_status_id1" style="color: primary; font-size:18px;">คลิ้กเพื่อไปยังหน้ารายชื่อนิสิตที่สมัคร</a><br>
                        <b>2. สถานประกอบการสามารถดูรายละเอียดของนิสิตที่สมัครได้โดยการกดไปที่รหัสนิสิต</b> </br>  
                        <b>3. เมื่อสถานประกอบการกดไปยังรหัสนิสิตสามารถดาวน์โหลดเอกสารของนิสิตที่สมัครได้ที่ปุ่ม RESUME </b> </br> 
                        <b>4. สำหรับนิสิตที่ไม่ถูกเลือก หมายถึงปฏิเสธการเรียกสัมภาษณ์</b>
                        
                        </div>
                </div>
        <!--a style=" font-size:20px;">TEST</a><br>
			<b>1.TEST</b-->
                                          
                    </div>
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

