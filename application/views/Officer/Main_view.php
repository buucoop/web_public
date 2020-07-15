    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <?php echo $this->breadcrumbs->show(); ?>

      <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body p-0 clearfix">
                            <a href="<?php echo site_url('Officer/Students');?>" target="_blank">
                                <i class="icon-list bg-primary p-4 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mb-0 pt-3">เปลี่ยนสถานะนิสิต</div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">จัดการนิสิต</div>                                
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body p-0 clearfix">
                            <a href="<?php echo site_url('Officer/Adviser');?>" target="_blank">
                                <i class="fa fa-tripadvisor bg-primary p-4 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mb-0 pt-3">เลือกอาจารย์ที่ปรึกษา</div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">ให้นิสิตสหกิจ</div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body p-0 clearfix">
                            <a href="<?php echo site_url('Officer/Coop_Submitted_Form_Search/by_student');?>" target="_blank">
                                <i class="icon-doc bg-primary p-4 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mb-0 pt-3">การส่งเอกสารรายบุคคล</div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">รายการส่งเอกสาร</div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card">
                        <div class="card-body p-0 clearfix">
                            <a href="<?php echo site_url('Officer/Train_check_student');?>" target="_blank">
                                <i class="fa fa-calendar-check-o bg-primary p-4 font-2xl mr-3 float-left"></i>
                                <div class="h5 text-primary mb-0 pt-3">เช็คชื่อเข้าอบรม</div>
                                <div class="text-muted text-uppercase font-weight-bold font-xs">โครงการอบรม</div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
            <?php foreach($rowNews as $key => $row) { if($key > 0) continue; ?>
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

