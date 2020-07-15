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
            <div class="card-header"><i class="fa fa-align-justify"></i> รายละเอียดแบบแจ้งแผนปฎิบัติการสหกิจ ของ <?php echo $student['fullname'].' '.$student['id']; ?></div>
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
                          <?php for($i=1;$i<=12;$i++) { ?>
                              <tr>
                              <th class="text-left"> <?php echo $i?></th>
                                  <td colspan="6"><input type="text" class="form-control" id="name" placeholder="ชื่องาน"></td>
                            
                                  <?php for($K=0;$K<=15;$K++) { ?>
                                      <td>                       
                                      <input class="form-check-input" type="checkbox" value=" " name=" " style="margin-left: unset !important; position: unset !important;">
                                      </td>    <?php } ?>                            
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
      