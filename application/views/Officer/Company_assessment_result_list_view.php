<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row" >
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i>  รายชื่อสถานประกอบการ</div>
            <div class="card-body">
              <!--table รายชื่อนิสิต-->
              <table class="table table-bordered datatable" >
                <thead>
                  <tr>
                    <th class="text-left"></th>
                    <th class="text-left">ชื่อสถานประกอบการ</th>
                    <th class="text-left">จำนวนนิสิตสหกิจ</th>
                    <th></th>
                  </tr>
                </thead>
                  <tbody>
                    <?php $i=1; foreach ($data as $row){?>
                      <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td class="text-left"><?php echo $row['company_name_th'];?> (<?php echo $row['company_name_en'];?>)</td>
                        <td class="text-right"><?php echo $row['count']; ?></td>
                        <td class="text-center">
                          <?php echo anchor('Officer/Company_assessment_result/assessment_detail/'.$row['company_id'], '<i class="fa fa-list-alt"></i> รายละเอียด', 'class="btn  btn-primary"');?>                            
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
  </div>
</div>

</main>