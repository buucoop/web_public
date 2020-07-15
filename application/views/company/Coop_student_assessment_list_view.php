<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->




<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row" >
      <!--table รายชื่อนิสิต-->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> รายชื่อนิสิตฝึกงานของนิสิตสหกิจ</div>
              <div class="card-body">
              <div class="alert alert-info" role="alert">
              ระดับคะแนน 5 = ดีมาก 4 = ดี 3 = ปานกลาง 2=พอใช้ 1 = ต้องปรับปรุง N/A  ไม่สามารถประเมินได้
                </div>
              <table class="table table-striped datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ-สกุล</th>
                        <th>GPAX</th>
                        <th>สาขาวิชา</th>
                        <th>ตำแหน่งที่สมัคร</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($data as $row) { ?>
                      <tr>
                        <td class="text-center"> <?php echo $i++; ?></td>
                        <td><?php echo $row['student_id'];?></td>
                        <td><?php echo $row['student_fullname'];?></td>
                        <td class="text-right"><?php echo $row['student_gpax'];?></td>
                        <td><?php echo $row['department_name'];?></td>
                        <td><?php echo $row['job_title']?></td>
                        <td class="text-center"><?php echo anchor('Company/Coop_student_assessment/form/'.$row['student_id'], 'ประเมินผล', 'class="btn btn-primary"');?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <!--table รายชื่อนิสิต-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      