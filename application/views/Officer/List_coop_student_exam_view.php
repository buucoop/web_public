<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row" >
      <!--table รายชื่อนิสิต-->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i>รายชื่อนิสิตสหกิจ</div>
              <div class="card-body">
                <table class="table table-bordered datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th class="text-left">รหัสนิสิต</th>
                        <th class="text-left">ชื่อ-สกุล</th>
                        <th class="text-left">ตำแหน่งงาน</th>
                        <th class="text-left">บริษัท</th>
                        <th class="text-left">คะแนนสถานประกอบการ</th>
                        <th class="text-left">คะแนนอาจารย์ที่ปรึกษา</th>
                        <th class="text-left">คะแนนรวม</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($students as $row) { ?>
                        <tr>
                          <td></td>
                          <td><?php echo $row['student_id']; ?></td>
                          <td><?php echo $row['student_fullname']; ?></td>
                          <td><?php echo $row['job_title']; ?></td>
                          <td><?php echo $row['company_name_th']; ?></td>
                          <td class="text-right"><?php echo $row['coop_student_company_score']; ?></td>
                          <td class="text-right"><?php echo $row['coop_student_adviser_score']; ?></td>
                          <td class="text-right"><b><?php echo $row['coop_student_sum_score']; ?></b></td>
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
