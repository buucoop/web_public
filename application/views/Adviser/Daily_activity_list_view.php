<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>กิจกรรมในการฝึกงานในแต่ละวัน ของ <?php echo $student['student_fullname'].' '.$student['student_id']; ?> 
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
                        <th></td>
                        <th>วันที่</th>
                        <th>หัวข้อ</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php $i=1; foreach ($data as $row){ ?>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo thaiDate($row['activity_date']); ?></td>
                        <td><?php echo $row['activity_subject']; ?></td>
                        <td class="text-center"><?php echo anchor('Adviser/Daily_activity/detail/'.$row['activity_id'], '<i class="fa fa-list-alt"></i> รายละเอียด', 'class="btn btn-primary" target="_blank"');?></td>  
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



</main>