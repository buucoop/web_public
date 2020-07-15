<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>
<!-- <ol class="breadcrumb">
  <li class="breadcrumb-item">Home</li>
  <li class="breadcrumb-item"><a href="#"><?php echo $user->login_type;?></a></li>
  <li class="breadcrumb-item active">สมัครเข้าร่วมอบรม</li>
</ol> -->
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
            <?php 
            if($data) { 
              foreach($data as $training) {

              
            ?>
              <div class="col-sm-6 col-md-6">
                <div class="card">
                  <div class="card-header">
                  <?php echo date('Y-m-d H:i', strtotime($training['date']));?> - <?php echo $training['title']; ?>
                    <div class="card-actions">
                      <a href="<?php echo $training['sheet_link'];?>" onclick="window.location.href = '<?php echo $training['sheet_link'];?>';" target="_blank" style="width: 70px;">
                        <small class="text-muted" style="color: green !important;"><b>ลงทะเบียน</b></small>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">

                    <div class="bd-example">
                      <dl class="row">
                       
                        <dd class="col-sm-12">
                          <?php echo $training['description']; ?>
                        </dd>
                      </dl>
                    </div>
                  </div>
                  <div class="card-footer">
                    <span class="badge badge-info"><?php echo $training['train_type'];?></span>
                    <span class="badge badge-warning">จำนวนที่นั่ง: <?php echo $training['number_of_seat'];?> คน</span>
                    <span class="badge badge-danger">จำนวนชั่วโมง: <?php echo $training['number_of_hour'];?> ชั่วโมง</span>
                    
                    
                  </div>
                  
                </div>
              </div>
          <?php  
              }
            } else { 
          ?>
            <div class="col-sm-12 col-md-12">
                <div class="card">
                  <div class="card-header">
                      คำเตือน
                  </div>
                  <div class="card-body">
                    <div class="alert alert-warning">
                      <b>ไม่อยู่ในช่วงลงอบรม</b>
                    </div>
                  </div>
                </div>
              </div>
         <?php } ?>
      
    </div>
  </div>
</div>
