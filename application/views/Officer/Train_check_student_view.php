<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>




<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> รายการเช็คชื่อ</div>
                    <div class="card-body">
                        <table class="table table-bordered" id="ajax_table">
                            <thead>
                                <tr>
                                    <th>ครั้งที่</th>
                                    <th>วันที่</th>
                                    <th>บันทึกช่วยทำ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> เช็คชื่อเข้าอบรม</div>
                    <div class="card-body">     
                        
                        <form action="<?php echo site_url('Officer/Train_check_student/check');?>" method="post">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="building">โครงการ</label> <?php echo form_error('train_id'); ?>         
                                    <select class="form-control" name="train_id" id="train_id">
                                        <option value="">--- please select ----</option>
                                        <?php foreach($data as $row) { ?>
                                            <option value="<?php echo $row['train']['train_id'];?>"><?php echo thaiDate($row['train']['train_start_date']);?> - <?php echo $row['train']['train_title'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="check_note">บันทึกช่วยจำ</label> <?php echo form_error('check_note'); ?>         
                                    <input class="form-control" type="text" name="check_note" id="check_note">
                                </div>

                                <div class="col-sm-12 text-center">
                                    <button type="reset" class="btn btn-danger" name="" value="1"> ยกเลิก</button>                                
                                    <button type="submit" class="btn btn-success" name="save" value="1"> บันทึกข้อมูล</button>                
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



<script>
var table;
$('#train_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

    if(table)
      table.destroy();


    var dataSrc = [];
    table = $('#ajax_table').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        'order': [[1, 'asc']],
        "ajax": {
          "url": SITE_URL+"/Officer/Train_check_student/get_train_check_set_by_train/"+valueSelected,
          "dataSrc": ""
        },
        "columns": [
            { "data": "check_no" },          
            { "data": "check_date" },
            { "data": "check_title" },            
            { "data": "check_button" }
        ],
        'initComplete': function(){
          var api = this.api();

          // Populate a dataset for autocomplete functionality
          // using data from first, second and third columns
          api.cells('tr', [1, 2]).every(function(){
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
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();


});

</script>