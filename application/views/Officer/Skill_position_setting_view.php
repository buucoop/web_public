<!-- Breadcrumb -->

<!-- Main content -->
<main class="main">
<!--Breadcrumb-->
<?php echo $this->breadcrumbs->show(); ?>



<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
        <!-- เพิ่ม -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                 <?php if($form_type == 'insert') { ?>
                 <form action="<?php echo site_url('Officer/Setting/add_skill_name');?>" method="post">
                 <?php } else { ?>
                 <form action="<?php echo site_url('Officer/Setting/update_skill_name/'.$skill_by_skill_id['skill_id']);?>" method="post">
                 <input type="hidden" name="skill_id" value="<?php echo $skill_by_skill_id['skill_id'];?>">

                 <?php } ?>

                    <div class="form-group">
                      <label for="">ชื่อทักษะงาน <?php echo form_error('skill_name');?></label><code>*</code>
                      <input type="text" id="skill_name" name="skill_name" class="form-control" value="<?php echo form_value_db('skill_name', @$skill_by_skill_id['skill_name']);?>" placeholder="กรุณากรอก" autofocus>
                    </div>

                    <div class="form-group">
                     <label for="ccmonth">ประเภททักษะ</label>
                     <?php if($form_type == 'insert') { ?>
                        <select class="form-control" id="skill_category_id" name="skill_category_id"> 
                        <?php foreach ($data as $skill_category) { ?>
                            <option value="<?php echo $skill_category['skill_category']['skill_category_id'];?>" <?php if(@$skill_category_by_id['skill_category_id'] == $skill_category['skill_category']['skill_category_id']) echo 'selected'; ?>><?php echo $skill_category['skill_category']['skill_category_name'];?></option>
                        <?php } ?>
                        </select>
                        <?php }else {?>
                        <select class="form-control" id="skill_category_id" name="skill_category_id"> 
                        <?php foreach ($data as $skill_category) { ?>
                            <option value="<?php echo $skill_category['skill_category']['skill_category_id'];?>" <?php if(@$skill_category_by_id['skill_category_id'] == $skill_category['skill_category']['skill_category_id']) echo 'selected'; ?> disabled><?php echo $skill_category['skill_category']['skill_category_name'];?></option>
                        <?php } ?>
                        </select>
                        <?php } ?>
                    </div>
                                            
                    <div class="form-group">
                     <button type="submit" class="btn btn-md btn-success"> บันทึก</button>
                    </div>
                 </form>
                </div>
                        
            </div>
        </div>
            <!-- เพิ่ม -->
            <!--1 box-->
            <div class="col-md-12">
                <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"> จัดการประเภททักษะ</div></i>
                    <div class="card-body">
                    <?php 
                        if($status){
                            echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                        }
                     ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" role="tablist">
                                    <?php foreach ($data as $skill_category) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#<?php echo $skill_category['skill_category']['skill_category_id'];?>" role="tab" aria-controls="home"><?php echo $skill_category['skill_category']['skill_category_name'] ?></a>
                                        </li>
                                    <?php } ?>
                                    </ul>

                                    <div class="tab-content">
                                        <?php foreach ($data as $skills) { ?>                                        
                                        <div class="tab-pane" id="<?php echo $skills['skill_category']['skill_category_id']; ?>" role="tabpanel">
                                    
                                            <table class="table table-bordered " id="tabletable_<?php echo $skills['skill_category']['skill_category_id']; ?>">
                                                <thead>
                                                    <tr>
                                                        <td></td>
                                                        <td>ทักษะ</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php foreach($skills['skill'] as $i => $skill) { ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo ++$i; ?></td>
                                                        <td class="text-left"><?php echo $skill['skill_name'];?></td>
                                                        <td>
                                                            <?php echo anchor('Officer/Setting/update_skill_name/'.$skill['skill_id'], '<i class="fa fa-eraser"></i> แก้ไข', 'class="btn  btn-primary"');?>                                 
                                                            <?php echo anchor('Officer/Setting/delete_skill_name/'.$skill['skill_id'], '<i class="fa fa-trash-o"></i> ลบ', 'class="btn btn-danger" onclick="return confirmDelete(this)"');?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            
                                            </table>

                                        </div> 
                                        <script>
                                        $(document).ready(function(){
                                            var table = $('#tabletable_<?php echo $skills['skill_category']['skill_category_id']; ?>').DataTable({
                                                "autoWidth": false, 'columnDefs': [{"searchable": false, "orderable": false, "targets": 0}],
                                            });
                                            table.on( 'order.dt search.dt', function () {
                                                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                                                    cell.innerHTML = i+1;   
                                                } );
                                            } ).draw();
                                        })
                                        </script>
                                        <?php } ?>
                                    </div>  
                                                                            
                                </div>
                            </div>
                            
                                <!-- แสดงรายการที่เพิ่ม -->
                            

                        </div>
                      
                            <!-- แสดงรายการที่เพิ่ม -->

                    </div><!-- close card  -->
                </div><!-- close card body -->
            </div><!-- close card col-md-6 -->


        </div><!-- close row -->
    </div><!-- close animated -->
 </div> <!-- close rocontainerw -->
 
 </main>

<script>
$(document).ready(function(){
    jQuery(".nav-link[href='#1']").click()
});
</script>