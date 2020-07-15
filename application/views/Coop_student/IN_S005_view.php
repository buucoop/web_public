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
            <form action="<?php echo site_url('Coop_student/IN_S005/save');?>" method="post">
            <div class="card-header"><i class="fa fa-align-justify"></i>แผนปฏิบัติงานสหกิจศึกษา</div>
              <div class="card-body">
                <?php 
                if(@$status) {
                  echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                }   
                ?>
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
                                <?php for($i=0;$i<12;$i++) { $no = $i; ?>
                                    <tr>
                                      <td class="text-left">
                                        <?php echo ++$no; ?>
                                      </td>
                                      <td colspan="6">
                                        <input type="text" class="form-control" name="plan_work_subject[<?php echo $i;?>]" placeholder="ชื่องาน" value="<?php echo form_value_db('plan_work_subject['.$i.']', @$rows[$i]['plan_work_subject']);?>">
                                      </td>
                                          <?php 
                                            if(@$rows[$i]['plan_time_period']) {
                                              $choice = explode(",", $rows[$i]['plan_time_period']);
                                            } else {
                                              $choice = [];
                                            }
                                            for($K=0;$K<16;$K++) { ?>
                                              <td>                       
                                                <input <?php if(in_array($K, $choice)) echo 'checked'; ?> class="form-check-input" type="checkbox" value="<?php echo $K;?>" name="plan_time_period[<?php echo $i;?>][]" style="margin-left: unset !important; position: unset !important;">
                                              </td>    
                                            <?php } ?>                                             
                                      </tr>                                                             
                                <?php } ?>
                            </tbody>
                    </table>
                    <center>
                      <button type="submit" class="btn btn-md btn-primary" name="print" value="1"><i class="fa fa-dot-circle-o"></i> Export</button>
                      <button type="submit" class="btn btn-md btn-success" name="print" value="0"><i class="fa fa-dot-circle-o"></i> บันทึกเอกสาร</button>     
                    </center>                           
                 </div>
                 </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      