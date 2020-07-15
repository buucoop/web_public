<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>กิจกรรมในการฝึกงานในแต่ละวัน
          <div class="text-right">
        
            </div>
          </div>
            <div class="card-body">
            <!--<?php 
            if($status){
              echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
            }
     
             ?>-->
            <table class="table table-bordered datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ-สกุล</th>
                        <th>สาขา</th>
                        <th>สาขาประกอบการที่ได้</th>
                        <th>จังหวัด</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $row) {?>
                      <tr>
                        <td></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['student_fullname']; ?></td>
                        <td><?php echo $row['department_name']; ?></td>
                        <td><?php echo $row['company_name_th']; ?></td>
                        <td><?php echo $row['company_address_province']; ?></td>  
                        <td><?php echo anchor('Adviser/Daily_activity/lists/'.$row['student_id']  , '<i class="fa fa-list-alt"></i> รายละเอียด', 'class="btn btn-primary"');?></td>
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
