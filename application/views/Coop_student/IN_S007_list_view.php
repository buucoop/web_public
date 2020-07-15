<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->

 <?php echo $this->breadcrumbs->show(); ?> 

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> รายการแบบคำร้องทั่วไป
            <a class="btn btn-primary float-right" href="<?php echo site_url('Coop_student/IN_S007/form');?>">
                <i class="fa fa-hand-pointer-o"></i> เพิ่มแบบคำร้องทั่วไป
            </a>
          </div>
            <div class="card-body">
              <?php 
                    if($status){
                        echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                    }
                        echo validation_errors('<div class="alert alert-warning">','</div>');
              ?>
              <table class="table table-bordered datatable">
                <thead>
                  <tr>
                    <th></th>
                    <th>วันที่</th>
                    <th>หัวข้อ</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>  
                <?php foreach($rows as $row) { ?>
                  <tr>
                    <td class="text-center"></td>
                    <td class="text-left"><?php echo thaiDate($row['petition_datetime']);?></td>
                    <td class="text-left"><?php echo $row['petition_subject'];?></td>
                    <td>
                      <?php echo anchor('Coop_student/IN_S007/print_data/'.$row['petition_id'] , '<i class="fa fa-list-alt"></i> Export', 'class="btn btn-primary"');?>
                    </td>
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
