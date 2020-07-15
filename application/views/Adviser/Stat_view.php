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
      <div class="row" >
      <!--table รายชื่อนิสิต-->
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                Bar Chart
                <div class="card-actions">
                  <a href="http://www.chartjs.org">
                    <small class="text-muted">docs</small>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-wrapper">
                  <canvas id="canvas-2"></canvas>
                  <script>
                  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
  var barChartData = {
    labels : ['January','February','March','April','May','June','July'],
    datasets : [
      {
        backgroundColor : 'rgba(220,220,220,0.5)',
        borderColor : 'rgba(220,220,220,0.8)',
        highlightFill: 'rgba(220,220,220,0.75)',
        highlightStroke: 'rgba(220,220,220,1)',
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      },
      {
        backgroundColor : 'rgba(151,187,205,0.5)',
        borderColor : 'rgba(151,187,205,0.8)',
        highlightFill : 'rgba(151,187,205,0.75)',
        highlightStroke : 'rgba(151,187,205,1)',
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      }
    ]
  }
  var ctx = document.getElementById('canvas-2');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: barChartData,
    options: {
      responsive: true
    }
  });
  </script>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

