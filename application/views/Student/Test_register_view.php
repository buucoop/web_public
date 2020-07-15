    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <?php echo $this->breadcrumbs->show(); ?>

      <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i>
                            สมัครสอบวัดผลสหกิจ
                        </div>
                        <div class="card-body">
                            <?php 
                            if($status){
                                echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                            } 
                            ?>
                            <div class="row">
                                <div class="text-center col-sm-12">
                                    <label class="form-control-label" for="">รอบการสอบ</label>
                                    <b>รอบที่ <?php echo $coop_test['coop_test_name'];?>: <?php echo $coop_test['coop_test_date'];?></b>
                                </div>
                            </div>

                            
                            <div class="text-center" style="margin-top:70px;">
                                <?php if(!$already_register) { ?>
                                <form action="<?php echo site_url('student/test/register');?>" method="post">
                                    <input type="hidden" name="confirm" value="1">
                                    <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-registered"></i> ลงชื่อสมัครสอบ</button>
                                </form>
                                <?php } ?>
                            </div>



                        </div>

                        
                    </div>
                </div>  
            </div>  
        </div>
      </div>
      <!-- /.conainer-fluid -->
    </main>

