-<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row" >
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i>เปลี่ยนสิทธิ์อาจารย์
            <div class="text-right">
            </div>
          </div>
            <div class="card-body">
            
                  <table class="table table-bordered datatable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ชื่อ</th>
                        <th>สถานะการให้สิทธิ์</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($adviser as $row) {?>
                      <tr>
                        <td class="text-center"></td>
                        <td class="text-left"><?php echo $row['adviser_fullname']; ?></td>
                        <td class="text-center">
                          <label class="switch switch-text switch-pill switch-success-outline-alt">
                            <input type="checkbox" class="switch-input" <?php if($row['adviser_is_officer'] == 1) echo 'checked';?> data-adviser-id='<?php echo $row['adviser_id'];?>'>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                          </label>
                          </label>
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

<script>

jQuery(".switch-input").change(function(e) {
  console.log(jQuery(this).data('adviser-id'))
  console.log(jQuery(this).prop('checked'))
  var val_status
  if(jQuery(this).prop('checked')) {
    val_status = '1';
  } else {
    val_status = '0';
  }

  jQuery.post(SITE_URL+"/Officer/Setting/post_adviser_setting/", { adviser_id: jQuery(this).data('adviser-id'), status: val_status }, function(response) {
    console.log(response)
    toastr['success']('เปลี่ยนสิทธิ์สำเร็จ')

  }, 'json')

});
</script>
