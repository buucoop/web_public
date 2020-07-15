<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> รายการสถานที่ฝึกงาน</div>
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
                        <th></th>
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
                            <td>
                            <?php echo anchor('Adviser/Map_student_list/map/'.$row['student_id']  , '<i class="fa fa-map-o"></i> แผนที่', 'class="btn btn-primary" target="_blank"');?>
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