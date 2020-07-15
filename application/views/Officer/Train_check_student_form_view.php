<!-- Breadcrumb -->

<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <!--code box-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> ใส่รหัสนิสิต, ยิงบาร์โค้ด</div>
                    <div class="card-body"> 
                        <input type="text" name="" class="form-control" id="enter_student_code" autofocus>
                        <input type="hidden" id="train_set_check_id" value="<?php echo $check_id;?>">
                        <br><hr><br>
                        <div class="row" id="student_info_frm" style="display:none;">
                            <div class="col-sm-6 text-center">
                                <img id="student_img">
                            </div>
                            <div class="col-sm-6">
                                <p><b>ชื่อ:</b> <span id="student_name"></span></p>
                                <p><b>รหัสนิสิต:</b> <span id="student_code"></span></p>
                                <p><br></p>
                                <p><b>เข้าเมื่อ:</b> <span id="entry_time"></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> ข้อมูลโครงการ</div>
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-sm-8">
                                <p><b>โครงการอบรม:</b> <?php echo $train['train_title'];?></p>
                                <p><b>Note:</b> <?php echo $training_check_student['check_note'];?></p>                                
                            </div>

                            <div class="col-sm-4 text-center">
                                <p><b>จำนวนนิสิตที่เข้าร่วม</b><br><span style="font-size:28px;"><span id="current_student"></span>/<?php echo $total_student;?></span></p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!--table box-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> รายชื่อนิสิต</div>
                    <div class="card-body"> 
                        <table class="table table-bordered" id="student_table">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">เวลา</th>
                                <th class="text-center">รหัสนิสิต</th>
                                <th class="text-center">ชื่อ - สกุล</th>
                            </tr>
                            </thead>
                            <tbody>
                               

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

</main>


