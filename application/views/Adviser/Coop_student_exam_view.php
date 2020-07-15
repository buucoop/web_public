<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> คะแนนสอบนิสิตในที่ปรึกษา</div>
            <div class="card-body">
                <table class="table table-bordered datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ - สกุล</th>
                        <th>สาขาวิชา</th>
                        <th>สถานประกอบการ</th>
                        <th>คะแนนสถานประกอบการ</th>
                        <th>คะแนนอาจารย์ที่ปรึกษา</th>
                        <th>คะแนนรวม</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($data as $row) {?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo $row['student_id']; ?></td>                      
                            <td><?php echo $row['student_fullname']; ?></td>
                            <td><?php echo $row['department_name']; ?></td>
                            <td><?php echo $row['company_name_th']; ?> (<?php echo $row['company_name_en']; ?>)</td>
                            <!-- คะแนนสถานประกอบการ -->
                            <td class="text-right"><?php echo $row['coop_student_has_coop_student_questionnaire_comment_totalscore']/2;?></td>

                            <td>
                              <form class="form-inline save_adviser_score">
                                <div class="form-group mx-sm-3 mb-2">
                                  <input type="hidden" name="student_id" value="<?php echo $row['student_id'];?>">
                                  <input name="coop_student_adviser_score" type="number" min="0" step="0.01" max="50" value="<?php echo $row['coop_student_adviser_score'];?>" class="form-control" style="width:80px;" placeholder="0.00">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-floppy-o"></i></button>
                              </form>
                            </td> 
                            <td class="text-right">
                              <span class="sum_score" data-studentid="<?php echo $row['student_id'];?>"><?php echo $row['coop_student_sum_score'];?></span>
                            </td>                         
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



</main>

<script>
jQuery.ajaxSetup({
  async: false
})

jQuery( document ).ready(function() {
  jQuery( ".save_adviser_score" ).submit(function( event ) {
    
    jQuery.post(SITE_URL+"/Adviser/Coop_student/post_exam_score", jQuery(this).serialize(), function(data, status){
        if(data.status) {
          swal("สำเร็จ", 'ทำการบันทึกคะแนนสำเร็จ', 'success');       
          jQuery(".sum_score[data-studentid='"+data.student_id+"']").html(data.sum_score)
        } else {
          swal("ผิดพลาด", 'มีข้อผิดพลาดระหว่างการบันทึกคะแนน', 'warning');                          
        }
    }, 'json');
        

    
    event.preventDefault();
  })
})
</script>