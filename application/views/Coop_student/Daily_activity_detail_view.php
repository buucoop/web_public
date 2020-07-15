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
          <div class="btn btn-dark">
            <i class="fa fa-align-justify"></i> หัวข้อ: <?php echo $coop_student_daily_detail['activity_subject'];?>
          </div>
          </div>
            <div class="card-body">
                <p><?php echo $coop_student_daily_detail['activity_content'];?>
            </div>
            <div class="card-footer">
            <div class="pull-right">
            <div class="btn btn-dark">
            <i class="fa fa-clock-o fa-spin"></i> กิจกรรมการฝึกงานในวันที่: <?php echo thaiDate($coop_student_daily_detail['activity_date']);?>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



</main>