<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<ol class="breadcrumb">
  <li class="breadcrumb-item">Home</li>
  <li class="breadcrumb-item"><a href="#">อาจารย์</a></li>
  <li class="breadcrumb-item active">สถิติการฝึกงานที่ผ่านมา</li>
</ol>

<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i> รายงานการไปสหกิจ</div>
                    <div class="card-body">
                        <form action="<?php echo site_url('Officer/Report_cooperative/search');?>" method="post">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>บริษัทที่ไป</label>
                                    <select class="form-control" id="company_id" name="company_id">
                                        <option value="0">ทั้งหมด</option>
                                        <?php foreach($company_name as $row) { ?>
                                            <?php if($row['company_id'] == @$current_company) { ?>
                                                <option value="<?php echo $row['company_id'];?>" selected><?php echo $row['company_name_th']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $row['company_id'];?>"><?php echo $row['company_name_th']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-7">
                                    <label>หลักสูตร</label>
                                    <div class="form-group">
                                    <?php foreach($department_name as $row) { ?>
                                        <div class="form-check form-check-inline mr-5">
                                            <?php if(@in_array($row['department_id'], $current_department)) { ?>
                                                <input type="checkbox" id="department_<?php echo $row['department_id'];?>" value="<?php echo $row['department_id'];?>" name="department_id[]" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" id="department_<?php echo $row['department_id'];?>" value="<?php echo $row['department_id'];?>" name="department_id[]">
                                            <?php } ?>
                                            <label for="department_<?php echo $row['department_id'];?>"><?php echo $row['department_name']; ?></label>
                                        </div>
                                    <?php } ?>    
                                    </div>  
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-block btn-success"> ค้นหา</button>  
                                </div>
                            </div>
                        </form>


                        <div style="width: 100%; margin: 0 auto;">
                            <canvas id="canvas"></canvas>
                        </div>










                    </div>
                </div>
            </div>    
        </div>       
  </div>
</div>



</main>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
        var colors = ['#537bc4', '#00a950', '#4dc9f6'];
        var color = Chart.helpers.color;
        var company = [];
        <?php foreach($reports[0]['company'] as $key => $company) { ?>
            company.push("<?php echo $company['company_name'];?>")
        <?php } ?>

        var barChartData = {
            
            labels: company,
            
            
            
            datasets: [
                
                <?php foreach($reports as $key => $report) { ?>
                {
                label: '<?php echo $report['department_name'];?>',
                backgroundColor: color(colors[<?php echo $key;?>]).alpha(0.5).rgbString(),
                borderColor: colors[<?php echo $key;?>],
                borderWidth: 1,
                data: [
                    <?php 
                    foreach($report['company'] as $row) {
                        echo $row['total_student'].",";                            
                        // if($row['total_student'] > 0) {
                        //     echo $row['total_student'].",";                            
                        // } else {
                        //     // echo rand(1,5).",";
                        // }
                    }
                    ?>
                ]
                },
                <?php } ?>

            ]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'สรุปข้อมูลนิสิตฝึกสหกิจประจำปีการศึกษา <?php echo $this->Term->get_current_term()[0]['term_name'];?>'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true, 
                                callback: function(val) {
                                    return Number.isInteger(val) ? val : null;
                                }
                            }
                        }]
                    }
                }
            });

        };

function randomScalingFactor() {
    return getRandomInt(100);
}

function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}

</script>