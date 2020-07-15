<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>




<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>จัดการผลการสอบของนิสิต</div>
                 <div class="card-body text-center  ">
                 <div class="alert alert-info" role="alert"><strong>ข้อควรรู้!</strong> โปรดอัพโหลดไฟล์ .xlsx ขนาดไม่เกิน 1,500kb</div>

                 <?php echo form_open_multipart('Officer/Test_result/upload');?>
                  <?php 
                  if($status){
                    echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                  }
          
                  ?>
                  <div class="row">
                  <div class="text-center col-sm-4">
                  
                  </div>
                  <div class="text-center col-sm-4">
                  <div class="form-group">
                      <label for="ccmonth">สอบครั้งที่</label>
                      <select class="form-control" id="coop_test_id" name="coop_test_id">
                        <option>--กรุณาเลือก--</option>
                        <?php foreach ($coop_test as $row) { ?>
                        <option value="<?php echo $row['id']; ?>" ><?php echo $row['name']; ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                 <div class="text-center col-sm-12">
                      <label class="form-control-label" for="file-input">เลือกไฟล์เอกสาร</label>
                        <input type="file" name="file-input">
                </div>
                </div>
                  <input type="hidden" name="code" value="1">
                  
              <div class="text-center" style="margin-top:70px;">
                  <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-upload"></i> อัพโหลดเอกสาร</button>
                </div>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
