<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> รายชื่อนิสิตในสังกัด</div>
            <div class="card-body">
                <table class="table table-bordered datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ - สกุล</th>
                        <th>สาขาวิชา</th>
                        <th>สถานประกอบการ</th>
                        <th>จังหวัด</th>
                        <th>วันขึ้นสอบ</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($data as $row) {?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo $row['student_id']; ?></td>                      
                            <td><?php echo $row['student_fullname']; ?></td>
                            <td><?php echo $row['department_name']; ?></td>
                            <td><?php echo $row['company_name_th']; ?> (<?php echo $row['company_name_en']; ?>)</td>
                            <td><?php echo $row['company_address_province']; ?></td>
                            <td><?php echo thaiDate($row['coop_student_oral_exam_date']);?></td>
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