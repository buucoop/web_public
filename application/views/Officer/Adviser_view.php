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
            <div class="card-header"><i class="fa fa-align-justify"></i> จัดอาจารย์ที่ปรึกษากับนิสิต</div>
          <div class="card-body">
              <table class="table table-bordered" id="student_table">
              <div class="container-fluid row">
                          <div class="col-sm-12">
                            <label>เลือกอาจารย์ที่ปรึกษาสำหรับกลุ่มนิสิต</label>
                          </div>
                          <div class="col-sm-4">
                                <div class="form-group">
                                <select id="update_student_into_adviser_all" name="update_student_into_adviser_all" class="form-control adviser_val">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($adviser as $row){?>
                                    <option value="<?php echo $row['adviser_id'];?>"> <?php echo $row['adviser_fullname'];?></option>
                                    
                                    <?php } ?>
                                </select>
                                </div>
                          </div>
                            <div class="col-sm-4">
                                <label></label>
                                <button type="button" class="btn btn-success" id="select_adviser_btn">ยืนยัน</button>                             
                            </div>
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th class="text-left">รหัสนิสิต</th>
                        <th class="text-left">ชื่อ-สกุล</th>
                        <th class="text-center">เลือกอาจารย์ที่ปรึกษาสำหรับนิสิตรายคน</th>
                        <th class="text-left">ชื่อบริษัท</th>
                        <th class="text-left">แขวง</th>
                        <th class="text-left">จังหวัด</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                   </table>


                 


                   <div class="col-sm-10">
                   <label><br/></label>
                   <label> * ในกรณีที่ท่านได้เลือกอาจารย์ที่ปรึกษาให้กับนิสิตแล้ว ท่านจะไม่สามารถคลิ๊กที่ Checkbox หน้ารหัสนิสิตคนนั้นได้อีก จนกว่าจะยกเลิกอาจารย์ที่ปรึกษาคนนั้น</label>
                    </div>

                   
   

      

   




                </div>     
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</div>

</main>



<script>
$(document).ready(function() {
  document.getElementById("update_student_into_adviser_all").addEventListener("change", confirm);
 //document.getElementById("select_adviser_btn").addEventListener("click", chreckkbox);



    var dataSrc = [];

    var table = $('#student_table').DataTable( {
        'columnDefs': [
          {
            'targets': 0,
            'checkboxes': {
              'selectRow': true
            }
          }, 
          {
            "searchable": false,
            "orderable": false,
            "targets": [1, 4]
          },
          {
            "targets": [ 8 ],
            "visible": false,
            "searchable": true,
          }
        ],
        'select': {
          'style': 'multi'
        },
        'order': [[2, 'asc']],
        "ajax": {
          "url": "<?php echo site_url('Officer/Adviser/ajax_list?company_id='.$this->input->get('company_id'));?>",
          "dataSrc": ""
        },
        "columns": [
            { "data": "student.student_id" },          
            { "data": "student.student_id" },
            { "data": "student.id_link" },            
            { "data": "student.student_fullname" },
            { "data": "adviser.select_box" },
            { "data": "company.company_name_th" },
            { "data": "company_address.company_address_area" },
            { "data": "company_address.company_address_province" },
            { "data": "adviser.adviser_fullname" },
        ],

        'initComplete': function(){
          var api = this.api();

          // Populate a dataset for autocomplete functionality
          // using data from first, second and third columns
          api.cells('tr', [2, 3, 8, 5, 6, 7]).every(function(){
              // Get cell data as plain text
              var data = $('<div>').html(this.data()).text();           
              if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
          });
                
          // Sort dataset alphabetically
          dataSrc.sort();
                
          // Initialize Typeahead plug-in
          $('.dataTables_filter input[type="search"]', api.table().container())
              .typeahead({
                source: dataSrc,
                afterSelect: function(value){
                    api.search(value).draw();
                }
              }
          );
        }
        
    } );

    table.on( 'order.dt search.dt', function () {
        table.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#select_adviser_btn').click( function () {
      var arr = $('#student_table').DataTable().column().checkboxes.selected(); 
      var adviser_id = jQuery(".adviser_val option:selected").val();
      var rows_selected = table.column(0).checkboxes.selected();
      
      update_student_into_adviser_ajax(arr, adviser_id);

    });
    
         $('#student_table').DataTable().clear().draw().ajax.reload(function(){ 
           
          for(var i=0;i< document.getElementsByClassName("dt-checkboxes").length;i++){
              if(document.getElementsByName("update_student_into_adviser")[i].value != "-- รอเลือกอาจารย์ที่ปรึกษา --"){
               document.getElementsByClassName("dt-checkboxes")[i].disabled=true;
         }}
              $('#student_table').DataTable().page( current_table_page ).draw( 'page' ); 
                  
            });    
});

/*function chreckkbox(){
  
  for(var i=0;i<=rows_selected.length;i++){

    rows_selected[i].disabled=true;


  }

}*/

function confirm(){
  swal({
        title: "warning",
        text: "หลังจากเลือกอาจารย์แล้วให้คลิ๊ก Checkbox ก่อนกดปุ่มยืนยัน",
        buttons: true,
        dangerMode: true,
      })
.then((willDelete) => {
  if (willDelete) {
    
    for(var i=0;i<document.getElementsByName("update_student_into_adviser").length;i++){
      if(document.getElementsByName("update_student_into_adviser")[i].value != null ){
        document.getElementsByName("update_student_into_adviser")[i].disabled=true;}
        
      }
  } else {
    swal("Your imaginary file is safe!");
  }
});
      
     
}

function update_student_into_adviser(student_id, adviser_id)
{
  update_student_into_adviser_ajax([student_id], adviser_id)
}

function update_student_into_adviser_ajax(arr, adviser_id)
{
  var current_table_page = $('#student_table').DataTable().page.info().page
      
      if(!arr){
        swal("โปรดเลือกนิสิตที่ต้องการเพิ่ม", {
          icon: "warning",
        });
        return;
      }

      for(var i = 0;i<document.getElementsByName("update_student_into_adviser").length;i++){
      if(!adviser_id || document.getElementsByName("update_student_into_adviser").value != null  ) {
        swal("โปรดเลือกอาจารย์ที่ปรึกษา", {
          icon: "warning",
        });
        document.getElementsByName("update_student_into_adviser").value = null;
        return;
      }
      }
     swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
     

      .then((willUpdate) => {
        if (willUpdate) {
          var student_arr = []
          jQuery.each(arr, function(index, value ) {            
            student_arr.push(value)

          });

          for(var i=0;i< document.getElementsByClassName("dt-checkboxes").length;i++){
           if(document.getElementsByClassName("dt-checkboxes")[i].checked == true){

          document.getElementsByClassName("dt-checkboxes")[i].disabled=true;
         }}
          




          var data = { students: student_arr, adviser: adviser_id }
          jQuery.post(SITE_URL+"/Officer/Adviser/ajax_change_status/", data, function(response) {
            if(response.status) {
              swal("เพิ่มนิสิตในอาจารย์เรียบร้อย", {
                icon: "success",

              });
            } else {
              swal("ผิดพลาด", {
                icon: "warning",
              });
            }
          
            $('.adviser_val').prop('selectedIndex', 0)
            $('#student_table').DataTable().clear().draw().ajax.reload(function(){ 
              $('#student_table').DataTable().page( current_table_page ).draw( 'page' ); 
                  
            });             
            $('#student_table').DataTable().clear().draw().ajax.reload(function(){ 
              for(var i=0;i< document.getElementsByClassName("dt-checkboxes").length;i++){
                if(document.getElementsByName("update_student_into_adviser")[i].value != "-- รอเลือกอาจารย์ที่ปรึกษา --"){
               document.getElementsByClassName("dt-checkboxes")[i].disabled=true;
         }}
              $('#student_table').DataTable().page( current_table_page ).draw( 'page' ); 
                  
            });
           
          
          
          }, 'json');

          

          
          
        }


      });
}

</script>