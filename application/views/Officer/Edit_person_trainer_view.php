<!-- Breadcrumb -->

<!-- Main content -->
<main class="main">
<!--breadcrumb-->
<?php echo $this->breadcrumbs->show(); ?>




<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> แก้ไขข้อมูลเจ้าหน้าที่</div>
                    <div class="card-body "> 
                        <?php 
                            if($status){
                                echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                            }
                        ?>                
                        <form action="<?php echo site_url('Officer/Trainer/edit/'.$person['person_id']);?>" method="post">
                        <input type="hidden" name="company_id" value="<?php echo $person['company_id'];?>">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fullname">ชื่อ</label>
                                        <input type="text" class="form-control" id="person_fullname"  name="person_fullname" value="<?php echo $person['person_fullname'];?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="person_email"  name="person_email" value="<?php echo $person['person_email'];?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="position">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="person_position"  name="person_position" value="<?php echo $person['person_position'];?>" required>
                                    </div>
                            
                                <div class="col-sm-3"></div>
                                </div>
                            </div>
                            <div class="text-center"> 
                                <button type="reset" class="btn btn-danger" >ยกเลิก</button>
                                <button type="submit" class="btn btn-success" >บันทึก</button>   
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
