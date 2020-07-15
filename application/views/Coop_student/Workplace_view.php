<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
  <div class="animated fadeIn">
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"></i> แจ้งพิกัดงาน</div>
                    <div class="card-body">
                        <div id="alert_bar">
                        <?php 
                            if($status){
                            echo '<div class="alert alert-'.$status['color'].'">'.$status['text'].'</div>';
                            }
                            if(!$map['coop_student_latitude'] && !$map['coop_student_longitude']) {
                                echo '<div class="alert alert-warning">โปรดระบุพิกัดที่ทำงาน</div>';

                            }
                        ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                              <div id="map" style="height:450px;width:100%;"></div>
                            </div>
                            
                            <div class="col-md-6">
                                <form action="<?php echo site_url('Coop_student/Workplace/update');?>" method="post">
                                    <div class="form-group">
                                      <label class="form-col-form-label" for="">ละติจูด <?php echo form_error('coop_student_latitude');?></label>
                                      <input type="text" class="form-control map_val" id="coop_student_latitude" name="coop_student_latitude" value="<?php echo form_value_db('coop_student_latitude', $map['coop_student_latitude']);?>">
                                    </div>

                                    <div class="form-group">
                                      <label class="form-col-form-label" for="">ลองติจูด <?php echo form_error('coop_student_longitude');?></label>
                                      <input type="text" class="form-control map_val" id="coop_student_longitude" name="coop_student_longitude" value="<?php echo form_value_db('coop_student_longitude', $map['coop_student_longitude']);?>">
                                    </div>

                                    <div class="form-group">
                                      <a onclick="get_live_map()" class="btn btn-md btn-warning"> ดึงพิกัดปัจจุบัน</a>     
                                      <button type="submit" class="btn btn-md btn-success"> บันทึก</button>                                      
                                    </div>
                                </form>
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
            center: uluru,
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map,
            draggable:true,
        });
        google.maps.event.addListener(marker, 'dragend', function() {
            geocodePosition(marker.getPosition());
        });
    }

    function initMap() {
        <?php if($map['coop_student_latitude'] && $map['coop_student_longitude']) { ?>
            genMap({lat: <?php echo $map['coop_student_latitude'];?>, lng: <?php echo $map['coop_student_longitude'];?>})
        <?php } ?>
    }



    function get_live_map() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
            jQuery("#alert_bar").html('<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i> โปรดรอสักครู่</div>');
            
        } else {
            jQuery("#alert_bar").html('<div class="alert alert-warning">Geolocation is not supported by this browser.</div>');
        }
    }
    function showPosition(position) {
        jQuery("#alert_bar").html('<div class="alert alert-warning">โปรดกดบันทึก เพื่อเปลี่ยนแปลงค่า</div>');
        
        jQuery("#coop_student_latitude").val(position.coords.latitude)
        jQuery("#coop_student_longitude").val(position.coords.longitude)
        genMap({ lat: position.coords.latitude, lng: position.coords.longitude })
    }

    

    function geocodePosition(pos) 
    {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode
        ({
            latLng: pos
        }, 
            function(results, status) 
            {
                if (status == google.maps.GeocoderStatus.OK) 
                {
                    console.log(pos.lat())
                    console.log(pos.lng())
                    jQuery("#coop_student_latitude").val(pos.lat())
                    jQuery("#coop_student_longitude").val(pos.lng())                      
                } 
                else 
                {

                }
            }
        );
    }

    jQuery(".map_val").change(function(){
        // genMap({ lat: jQuery("#coop_student_latitude").val(), lng: jQuery("#coop_student_longitude").val() })
    })
</script>

