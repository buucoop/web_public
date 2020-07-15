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
            <div class="card-header"><i class="fa fa-align-justify"></i> รายละเอียดแบบแจ้งแผนปฎิบัติการสหกิจ ของ <?php echo $student['student_fullname'].' '.$student['student_id']; ?></div>
              <div class="card-body">
              <form action="" method="post">
              <table class="table table-bordered">
              <thead>
                  <tr>
                      <th rowspan="2" class="text-left">ลำดับ</th>
                      <th rowspan="2" colspan="6" style="width:60%">หัวข้องาน</th>      
                      <td colspan="4" >เดือนที่ 1</td>
                      <td colspan="4" >เดือนที่ 2</td>
                      <td colspan="4" >เดือนที่ 3</td>
                      <td colspan="4" >เดือนที่ 4</td>
                  </tr>
                  <tr>
                      <!-- <th>หัวข้อประเมิน/Items</th>       -->
                      <th>1</th><th>2</th><th>3</th> <th>4</th>
                      <th>1</th><th>2</th><th>3</th> <th>4</th>
                      <th>1</th><th>2</th><th>3</th> <th>4</th>
                      <th>1</th><th>2</th><th>3</th> <th>4</th> 
                  </tr>
              </thead>
                      <tbody>
                      <?php // for($i=0;$i<12;$i++) { $no = $i; ?>
                      <?php foreach($rows as $i => $row) { $no = $i; ?>
                                    <tr>
                                    <td class="text-left">
                                      <?php echo ++$no; ?>
                                    </td>
                                    <td colspan="6">
                                      <input type="text" class="form-control" name="work_subject[<?php echo $i;?>]" placeholder="ชื่องาน" value="<?php echo @$row['plan_work_subject'];?>" disabled>
                                    </td>
                                  
                                        <?php 
                                        if(@$row['plan_time_period']) {
                                          $choice = explode(",", $row['plan_time_period']);
                                        } else {
                                          $choice = [];
                                        }
                                        for($K=0;$K<16;$K++) { ?>
                                          <td>                       
                                            <input <?php if(in_array($K, $choice)) echo 'checked'; ?> class="form-check-input" type="checkbox" value="<?php echo $K;?>" name="date_period[<?php echo $i;?>][]" style="margin-left: unset !important; position: unset !important;" disabled>
                                          </td>    
                                        <?php } ?>                            
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
      