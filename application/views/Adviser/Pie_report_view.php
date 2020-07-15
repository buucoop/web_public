<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>


<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i> รายงานการไปสหกิจ</div>
                    <div class="card-body">
                        <form action="<?php echo site_url('Adviser/Report_cooperative/search');?>" method="post">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>ภาคการศึกษา</label>
                                    <select class="form-control" id="term_id" name="term_id">
                                        <option value="0">ทั้งหมด</option>
                                        <?php foreach($terms as $term) { ?>
                                            <?php if($term['term_id'] == @$term_report['term_id']) { ?>
                                                <option value="<?php echo $term['term_id'];?>" selected><?php echo $term['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $term['term_id'];?>"><?php echo $term['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label>บริษัทที่ไป</label>
                                    <select class="form-control" id="company_id" name="company_id">
                                        <option value="0">ทั้งหมด</option>
                                        <?php foreach($company_name as $row) { ?>
                                            <?php if($row['id'] == @$current_company) { ?>
                                                <option value="<?php echo @$row['id'];?>" selected><?php echo $row['name_th']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo @$row['id'];?>"><?php echo $row['name_th']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-7">
                                    <label>หลักสูตร</label>
                                    <div class="form-group">
                                    <?php foreach(@$department_name as $row) { ?>
                                        <div class="form-check form-check-inline mr-5">
                                            <?php if(@in_array(@$row['id'], @$current_department)) { ?>
                                                <input type="checkbox" id="department_<?php echo @$row['id'];?>" value="<?php echo @$row['id'];?>" name="department_id[]" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" id="department_<?php echo @$row['id'];?>" value="<?php echo @$row['id'];?>" name="department_id[]">
                                            <?php } ?>
                                            <label for="department_<?php echo @$row['id'];?>"><?php echo @$row['name']; ?></label>
                                        </div>
                                    <?php } ?>    
                                    </div>  
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-block btn-success"> ค้นหา</button>  
                                </div>
                            </div>
                        </form>

                        <hr>
                        
                        <div class="col-md-12">
                        <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                        </div>
                       
                        










                    </div>
                </div>
            </div>    
        </div>       
    </div>
</div>
</main>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		title:{
			text: "Gaming Consoles Sold in 2012"
		},
		legend: {
			maxWidth: 700,
			itemWidth: 120
		},
		data: [
		{
			type: "pie",
			showInLegend: true,
			legendText: "{indexLabel}",
			dataPoints: [
                <?php 
                foreach($data as $row){ 
                    if(@$row['count_student'] < 1)
                        continue;
                ?>
				{ y: <?php echo @$row['count_student'];?>, indexLabel: "<?php echo @$row['company_name']['name_th'];?>"},
				
                <?php } ?>
			]
		}
		]
	});
	chart.render();
}
</script>
