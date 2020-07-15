<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i> ตรวจสอบประวัติการอบรม</div>
            <div class="card-body">
            
              <ul class="nav nav-tabs" role="tablist">
                <?php foreach($train_type as $key => $type) { ?>
                <li class="nav-item">
                  <a class="nav-link <?php if($key == 0) echo 'active';?>" data-toggle="tab" href="#WW_<?php echo $type['train_type_id'];?>" role="tab" aria-controls="WW_<?php echo $type['train_type_id'];?>"><?php echo $type['train_type_name'];?></a>
                </li>

                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach($train_type as $key => $type) { ?>
                  <div class="tab-pane <?php if($key == 0) echo 'active';?>" id="WW_<?php echo $type['train_type_id'];?>" role="tabpanel">
                    <table class="table table-bordered datatable">
                      <thead>
                        <tr>
                          <th></th>
                          <th>วันเวลา</th>
                          <th>จำนวนชั่วโมง</th>
                          <th>หัวข้อ</th>
                          <th>วิทยาการ</th>
                          <th>จำนวนชั่วโมงที่เก็บได้</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach($type['history'] as $row) { ?>
                          <tr>
                            <td class="text-center"><?php echo $i++;?></td>
                            <td><?php echo thaiDate($row['tb_train']['train_start_date']);?></td>
                            <td class="text-right"><?php echo $row['total_hour'];?></td>
                            <td><?php echo $row['tb_train']['train_title'];?></td>
                            <td><?php echo $row['tb_train']['train_lecturer'];?></td>
                            <td class="text-right"><?php echo number_format($row['check_hour'], 2);?></td>


                          </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</main>
