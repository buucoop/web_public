<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>



<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row" >
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i>การประเมินผลการฝึกงานของนักศึกษา</div>
              <div class="card-body">

              <table class="table table-bordered datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>สาขาวิชา</th>
                        <th>สถานประกอบการที่ได้</th>
                        <th>จังหวัด</th>
                        <th>คะแนนรวม</th>                        
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php $i=1; foreach ($data as $row){ ?>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo $row['student_id']?></td>
                        <td><?php echo $row['student_fullname']?></td>
                        <td><?php echo $row['department_name']?></td>
                        <td><?php echo $row['company_name_th']?></td>
                        <td><?php echo $row['company_address_province']?></td>
                        <td><?php echo $row['coop_student_company_score']?></td>                        
                        <td><a class="btn btn-primary" href="<?php echo site_url('Adviser/Coop_student_assessment/form/'.$row['student_id']);?>" target="_blank"><i class="fa fa-list-alt"></i> รายละเอียด</a></td> 
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
    </div>
  </div>
</div>