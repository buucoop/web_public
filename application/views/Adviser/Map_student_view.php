<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row">
            <div class="col-lg-4">
                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"></i> รายละเอียดนิสิต</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>รหัสนิสิต: <?php echo $student['student_id']; ?></p>

                                <p>ชื่อ - นามสกุล: <?php echo $student['student_fullname']; ?></p>

                                <p>สาขา: <?php echo $department['department_name']; ?></p>

                                <p>บริษัท: <?php echo $company['company_name_th']." (".$company['company_name_en'].")"; ?></p>

                            </div>
                        </div>
                  
                    </div>
                </div>
            </div>

                <div class="col-lg-8">
                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"></i> พิกัดของบริษัท</div>
                    <div class="card-body">
                        <div class="row">
                                <?php if($map['coop_student_latitude'] != '' && $map['coop_student_longitude'] != '') { ?>
                                <div class="col-sm-12" style="margin-bottom:20px;">
                                    <a target="_blank" href="https://www.google.com/maps/?q=<?php echo $map['coop_student_latitude'].",".$map['coop_student_longitude'];?>" class="btn btn-info btn-block">ไปยัง Google Map</a>
                                </div>
                                <?php } ?>


                                <div id="map" style="height:450px;width:100%;">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>ไม่พบข้อมูล!</strong> แจ้งนิสิตตามรายละเอียดนิสิตด้านซ้ายมือ
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                           
                        </div>
                  
                    </div>
                </div>
            </div>   
        </div>       
  </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcah51LjCiIIFTqdekv78MHZvqT2NpCLo&callback=initMap"></script>
<script>
    function genMap(uluru) {
        jQuery("#map").html();
        // var uluru = {lat: lat, lng: lng};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }

    function initMap() {
        <?php if($map['coop_student_latitude'] != '' && $map['coop_student_longitude'] != '') { ?>
            genMap({lat: <?php echo $map['coop_student_latitude'];?>, lng: <?php echo $map['coop_student_longitude'];?>})
        <?php } ?>
    }

</script>

