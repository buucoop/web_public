        <!-- Main content -->
<main class="main">
      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">ระบบสหกิจ</li>
        <li class="breadcrumb-item"><a href="#">เจ้าหน้าที</a></li>
        <li class="breadcrumb-item active">จัดการแบบประเมินสถานประกอบการ</li>
      </ol>
<div class="card">
<div class="card-header"><i class="fa fa-align-justify"></i>จัดการแบบประเมินบริษัท</div>
      <div class="card-body">
              <form action="<?php echo site_url('officer/Assessment_companyForm/save');?>" method="post" class="form-horizontal">
                <div class="row">    
                    <div class="form-group col-md-12 offset-md-2">
                        <div class="col-md-6">
                        <div class="input-group">
                            <label class="form-control-label" for="hf-text"></label>
                            <div style="width:30px;"></div>
                                <input type="text" id="input2-group2" name="input2-group2" class="form-control" value="">
                                <span class="input-group-btn" >
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-window-close fa-lg"></i> ลบหัวข้อหลัก </button>
                                </span>
                            </div>
                        </div>
                    </div>     
                        <div class="form-group col-md-12 offset-md-3">
                            <div class="col-md-6">
                            <div class="input-group">
                                <label class="form-control-label" for="hf-text"></label>
                                <div style="width:30px;"></div>
                                    <input type="text" id="input2-group2" name="input2-group2" class="form-control" value="">
                                    <span class="input-group-btn" >
                                    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-window-close fa-lg"></i> ลบหัวข้อย่อย </button>
                                    <button type="reset" class="btn btn-sm btn-info"><i class="icon-plus icons font-2xl "></i> เพิ่มหัวข้อย่อย </button>                                    
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
                  <div class="form-group col-md-9 offset-md-2">
                        <div class="col-md-9">
                           <div class="input-group">
                          
                           <button type="reset" class="btn btn-lg btn-info btn-block"><i class="icon-plus icons font-2xl "></i> เพิ่มหัวข้อหลัก </button>  
                          
                           <div class="radio col-sm-3">
                          <label for="radio1">
                            <input type="radio" id="radio1" name="radios" value="option1"> ให้คะเเนน </label>
                        </div>
                        <div class="radio col-sm-3">
                          <label for="radio1">
                            <input type="radio" id="radio1" name="radios" value="option1"> ให้ความเห็น </label>
                             </div>
                            </div>
                       </div>
                    </div>
                  </div>
                  <div class="form-group col-md-6 offset-md-3">
                        <div style="height:50px;"></div>
                        <div class="col-md-9">
                           <div class="input-group">
                                <button type="submit"  class="btn btn-lg btn-success btn-block"><i class="fa fa-dot-circle-o"></i>บันทึก</button>
                            </div>
                        </div>
                 </div>
            </form> 
        </div>
    </div>
</div>


            