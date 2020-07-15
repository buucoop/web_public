  <!-- Main content -->
  <main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

      <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row" >
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"></i>ข้อมูลบริษัท
                  </div>
        
                    <div class="card-body">
                   <table class="table table-striped datatable">
                          <thead>
                            <tr>
                              <th>ตำแหน่งงาน</th>
                              <th>ลักษณะงานที่นิสิตต้องปฏิบัติ (Job Description)</th>
                              <th>จำนวน</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                            
                            </div>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">เพิ่มตำแหน่งงาน</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <div class="row">
                                          <div class="form-group col-sm-4">
                                            <label for="ccmonth">ตำแหน่ง</label><code>*</code>
                                            <select class="form-control" id="ccmonth">
                                              <option>Programer</option>
                                              <option>Testor</option>
                                              <option>IT support</option>
                                            </select>
                                            </div>

                                            <div class="form-group col-sm-3">
                                            <label>จำนวน</label><code>*</code>
                                            <input type="number" class="form-control" id="" name="">
                                            </div>

                                          </div>

                                          
                                          <div class="form-group row">
                                          <div class="col-md-12">
                                          <label class="col-md-8 form-control-label" for="textarea-input">ลักษณะงานที่นิสิตต้องปฏิบัติงาน<code>*</code></label>
                                            <textarea id="textarea-input" name="textarea-input" rows="9" class="form-control" placeholder=""></textarea>
                                          </div>
                                          </div>
                                          

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                    <button type="button" class="btn btn-success">บันทึก</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>

<script>
$('.btn-submit').on('click',function(e){
  e.preventDefault();
  var form = $(this).parents('form');
  swal({
      title: "คุณแน่ใจใช่ไหม",
      text: "ลบคำนิสิตที่เลือก",
      icon: "warning",
      buttons: true,
      dabgerMode: true
  })
  .then((isConfirm) => {
    if (isConfirm) {
      form.submit();
    } else {

    }
  })

});


</script>
    