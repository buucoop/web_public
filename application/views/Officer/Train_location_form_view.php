<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>



<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> แบบฟอร์มข้อมูลสถานที่อบรม</div>
                    <div class="card-body">             
                        <form id="train_location_form" action="<?php echo $form_url;?>" method="post">
                            <input type="hidden" name="location_id" id="location_id" value="<?php echo @$row['location_id'];?>">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="location_building">ชื่อตึก <?php echo form_error('location_building'); ?></label><code>*</code> 
                                    <input value="<?php echo form_value_db('location_building', @$row['location_building']);?>" class="form-control" type="text" name="location_building" id="location_building">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="location_room">ชื่อห้อง <?php echo form_error('location_room'); ?></label><code>*</code> 
                                    <input value="<?php echo form_value_db('location_room', @$row['location_room']);?>" class="form-control" type="text" name="location_room" id="location_room">
                                </div>

                                <div class="col-sm-12 text-center">
                                    <button type="reset" class="btn btn-warning" name="" value="1"><i class="fa fa-dot-circle-o"></i> ยกเลิก</button>                                
                                    <button type="submit" class="btn btn-success" name="save" value="1"><i class="fa fa-dot-circle-o"></i> บันทึกข้อมูล</button>                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>

