<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<ol class="breadcrumb">
  <li class="breadcrumb-item">Home</li>
  <li class="breadcrumb-item"><a href="#"><?php echo $user->login_type;?></a></li>
  <li class="breadcrumb-item active">ประวัติการเข้าร่วมกิจกรรมมอบรม</li>
</ol>
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>ประวัติการเข้าร่วมกิจกรรมอบรม</div>
              <div class="card-body">

              <ul class="nav nav-tabs" role="tablist">
          
                <?php foreach($train_type as $key => $type) { ?>
                <li class="nav-item">
                  <a class="nav-link <?php if($key == 0) echo 'active';?>" data-toggle="tab" href="#WW_<?php echo $type['id'];?>" role="tab" aria-controls="WW_<?php echo $type['id'];?>"><?php echo $type['name'];?></a>
                </li>

                <?php } ?>
              </ul>
              <div class="tab-content">

                  <div class="tab-pane <?php if($key == 0) echo 'active';?>" id="WW_<?php echo $type['id'];?>" role="tabpanel">
                    <table class="table table-bordered datatable">
                      <thead>
                        <tr>
                          <th>วันเวลา</th>
                          <th>จำนวนชั่วโมง</th>
                          <th>หัวข้อ</th>
                          <th>วิทยาการ</th>
                          <th>จำนวนชั่วโมงที่เก็บได้</th>
                        </tr>
                      </thead>
                      <tbody>
                  
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>


                          </tr>

                 
                      </tbody>
                    </table>
                  </div>
           
              
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
