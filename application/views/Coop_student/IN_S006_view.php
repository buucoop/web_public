<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>จัดการหัวข้อรายงาน</div>
              <div class="card-body">
              <?php 
                  if($status){
                    echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                  }
                ?>

                        <form action=<?php echo site_url("Coop_student/IN_S006/post_report"); ?> method="post" class="form-horizontal">
                          <div class="form-group row">
                            <div class="col-md-12">
                              <label class="form-control-label" for="report_subject_th">หัวข้อภาษาไทย <?php echo form_error('report_subject_th'); ?></label> <code>*</code>
                              <input type="text" id="report_subject_th" name="report_subject_th" class="form-control" value="<?php echo form_value_db('report_subject_th', $subject_report['report_subject_th']); ?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-12"> 
                              <label class="form-control-label" for="report_subject_en">หัวข้อภาษาอังกฤษ <?php echo form_error('report_subject_en'); ?></label> <code>*</code>
                              <input type="text" id="report_subject_en" name="report_subject_en" class="form-control" value="<?php echo form_value_db('report_subject_en', $subject_report['report_subject_en']); ?>">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-12">
                              <label class="form-control-label" for="textarea-input">รายละเอียดเนื้อหาของรายงาน <?php echo form_error('report_detail'); ?></label> <code>*</code>
                              <textarea id="textarea-input" name="report_detail" rows="9" class="form-control"><?php echo form_value_db('report_detail', $subject_report['report_detail']); ?></textarea>
                            </div>
                          </div>
                        
                          <div class="text-center">
                            <button type="submit" class="btn btn-md btn-primary" value="1" name="print"><i class="fa fa-dot-circle-o"></i>Export</button>
                            <button type="submit" class="btn btn-md btn-success" value="0" name="print"><i class="fa fa-dot-circle-o"></i> บันทึก </button>
                          </div>
                        </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
