<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>ตรวจสอบชั่วโมงการอบรมทั้งหมด</div>
            <div class="card-body">
            
            <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ประเภทโครงการ</th>
                        <th>จำนวนชั่วโมงทั้งหมด</th>
                        <th>จำนวนชั่วโมงที่เก็บ</th>
                        <th>จำนวนชั่วโมงที่ขาด</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i=1; 
                      foreach($train_type as $row) { 
                        $remain_hour = number_format($row['total_hour'] - $row['check_hour'], 2); //คำนวณชั่วโมงคงเหลือ
                        $row['total_hour'] = number_format($row['total_hour'], 2);
                        $row['check_hour'] = number_format($row['check_hour'], 2);
                        
                        if($remain_hour < 1) {
                          $remain_hour = "<span style='color: red;'> - </span>";
                        }

                        if($row['total_hour'] < 1) {
                          $row['total_hour'] = "<span style='color: red;'> - </span>";
                        }

                        if($row['check_hour'] < 1) {
                          $row['check_hour'] = "<span style='color: red;'> - </span>";
                        }

                        if($row['check_hour'] >= $row['total_hour']) {
                          $row['check_hour'] = "<span style='color: green;'> ".$row['check_hour']." </span>";
                        }
                      ?>
                      <tr>
                        <td class="text-center"><?php echo $i++;?></td>
                        <td><?php echo $row['name'];?></td>
                        <td class="text-right"><?php echo $row['total_hour'];?></td>
                        <td class="text-right"><?php echo $row['check_hour'];?></td>
                        <td class="text-right"><?php echo $remain_hour;?></td>
                        
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
