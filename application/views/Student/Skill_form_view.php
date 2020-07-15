<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"></i> ทักษะที่ถนัด</div>
                    <div class="card-body">
                        <?php 
                            if($status){
                                echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                            }
                        ?>

                        <form action="<?php echo site_url('Student/Skill/save');?>" method="post">
                        <div class="row">
                            <?php foreach ($skills as $skill_category) { ?>
                            <div class="col">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo $skill_category['skill_category_name']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($skill_category['skills'] as $key => $skill) { 
                                    $checked = false;
                                    if(in_array($skill['skill_id'], @$has_skill)) {
                                        $checked = true;
                                    } else {
                                       $checked = false;
                                    }    
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="key_<?php echo $skill['skill_id'];?>" value="<?php echo $skill['skill_id'];?>" name="skill[]" <?php if($checked) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="key_<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></label>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>

                            <div style="height:40px;"></div>
                            <button type="submit" class="btn btn-success btn-block">บันทึก</button>
                            
                        </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-check-input {
    margin-left: unset;
}
</style>

 <!-- <form action="<?php echo site_url('Student/Skill/save');?>" method="post">
                            <div class="form-group row">
                              <label class="col-md-2 col-form-label">เลือกทักษะที่ถนัด</label>
                                <div class="col-md-10 col-form-label">
                                //
                                //$checked = false;
                                //foreach(@$skill as $key => $row) { 
                                    //if(in_array($row['skill_id'], @$has_skill)) {
                                       // $checked = true;
                                    //} else {
                                      //  $checked = false;
                                    //}
                                
                                    <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="<?php echo $key;?>" value="<?php echo $row['skill_id'];?>" name="skill[]" <?php if($checked) echo 'checked'; ?>>
                                    <label class="form-check-label" for="<?php echo $key;?>"><?php echo $row['skill_name'];?></label>
                                    </div>
                                //
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                  <button type="submit" class="btn btn-sm btn-success"><i class=""></i> บันทึก</button>
                                </div>  
                                    
                            </div>
                        </form> -->
 
