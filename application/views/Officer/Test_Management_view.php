<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header"><i class="fa fa-align-justify"></i>จัดการข้อมูลนิสิตเข้าสอบ
          <div class="text-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-hand-pointer-o"></i> เพิ่ม</button>
            </div>
          </div>
            <div class="card-body">
            <?php 
            if($status){
              echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
            }
     
             ?>

              <div class="container-fluid">
                  <form action="" method="post" class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-md-2 col-form-label" for="hf-email">เลือกครั้งการสอบ</label>
                      <div class="col-md-10">
                        <select name="test_id" id="test_id" class="form-control">
                          <option> ------ </option>
                          <?php
                          foreach($coop_test_list as $test) { 
                            echo '<option value="'.$test['id'].'">'.$test['name'].' - '.$test['test_date'].'</option>';
                          }
                          ?>
                        </select>
                        <!-- <span class="help-block">Please enter your email</span> -->
                      </div>
                    </div>
                  </form>
                </div>


            <table class="table table-bordered" id="test_student_list_result">
                    <thead>
                      <tr>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อนิสิต</th>
                        <th>สาขา</th>
                        <th>สอบรอบที่</th>
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

<!--ส่วนของ ModalLabel -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title icon-magnifier-add"> เพิ่ม</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
              </div>
              <div class="modal-body">
              <!--รหัสนิสิต-->
              <form action="<?php echo site_url('Officer/Test_Management/add');?>" method="post">
                    <div class="form-group">
                      <label class=" form-control-label" for="text-input"> รหัสนิสิต</label>
                      <input type="text" class="form-control" id="" name="id"  required placeholder="กรุณากรอก" >
                    </div>  
                    <!--รหัสนิสิต-->
                    <!--สอบรอบที่-->
                    <div class="form-group">
                      <label class="form-control-label" for="text-input">สอบรอบที่</label>
                      <select id="select" name="select" class="form-control" required>
                        <option value="">Please select</option>
                          <?php foreach ($coop_test_list as $row) { 
                          if($row['register_status'] != 1){
                            continue;
                          }
                          ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <!--สอบรอบที่-->
              </div>
              <div class="modal-footer">
                <button type="close" class="btn btn-danger" data-dismiss="modal"> ปิด</button>
                <button type="submit" class="btn btn-success"> บันทึก</button>
              </div>
            </div>
            </div>
            </div>
            <!--ส่วนของ ModalLabel -->
<script>


// $('.btn-submit').on('click',function(e){
function confirmDelete()
{
    // e.preventDefault();
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

    return false;
}
// });


</script>



<script>
var table
$('#test_id').on('change', function (e) {
    var optionSelected = $("option:selected", this)
    var valueSelected = this.value

    //get student test search by test id
    jQuery("#test_student_list_result tbody").empty()

    if(table)
      table.destroy();



    table = $('#test_student_list_result').DataTable( {
        'order': [[0, 'asc']],
        "ajax": {
          "url": SITE_URL+"/Officer/Test_Management/gets_student_by_test/"+valueSelected,
          "dataSrc": ""
        },
        "columns": [
            { "data": "student.id" },
            { "data": "student.fullname" },            
            { "data": "department.name" },
            { "data": "coop_test.name" }
            
        ],
        "initComplete": function(settings, json) {
          //style here
          $("#test_student_list_result tbody").find('tr').each(function(){
            var td = $(this).children('td').eq(3);
            jQuery(td).css('text-align', 'right')
          });
        }
        
    } );

    

});


</script>