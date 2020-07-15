<!-- Breadcrumb -->

<!-- Main content -->
<main class="main">

<!-- Breadcrumb -->
<?php echo $this->breadcrumbs->show(); ?>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row" >
            <!--1 box-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-home"></i> บริษัท <?php echo $tmp['company_name_th'];?> ( <?php echo $tmp['company_name_en'];?> )
                    </div>
                    <div class="card-body">
                        <?php if( $data['company_address_latitude'] && $data['company_address_longitude'] ) { ?>
                            <div id="map" style="height:450px;width:100%;"></div>
                        <?php } ?>
                             <br>
                             <div class="row">
                                <div class="col-sm-5">
                                    <div class="card-body p-3 clearfix" class="border-(3)" >
                                        <i class="icon-map p-3 font-2xl mr-3 float-left"></i>
                                        <div class="">
                                            ที่อยู่: &nbsp;&nbsp;เลขที่ &nbsp;&nbsp;<?php echo $data['company_address_number'];?>&nbsp;&nbsp;อาคาร &nbsp;&nbsp; <?php echo $data['company_address_building'];?>&nbsp;&nbsp; ถนน<?php echo $data['company_address_road'];?>&nbsp;&nbsp;
                                            เเขวง <?php echo $data['company_address_district'];?>&nbsp;&nbsp;เขต<?php echo $data['company_address_area'];?>&nbsp;&nbsp;อำเภอ<?php echo $data['company_address_area'];?>&nbsp;&nbsp;จังหวัด<?php echo $data['company_address_province'];?>&nbsp;&nbsp;<?php echo $data['company_address_postal_code'];?>&nbsp;&nbsp;ประเทศไทย
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body p-3 clearfix" class="border-(3)">
                                        <i class="icon-phone p-3 font-2xl mr-3 float-left"></i>
                                        <div class= "text-clearfix font-weight-bold font-xs"><?php echo $contact['person_telephone'];?></div>
                                        <div class= "text-clearfix font-weight-bold font-xs"><?php echo $contact['person_email'];?></div>
                                        <div class="text-muted text-clearfix font-weight-bold font-xs"><a href="<?php echo $tmp['company_website'];?>" target="_blank"><?php echo $tmp['company_website'];?></a></div>
                                     </div>
                                </div>
                            </div>     
                    </div><!-- close card  -->
                </div><!-- close card body -->
            </div><!-- close card col-md-6 -->


        </div><!-- close row -->
    </div><!-- close animated -->
 </div> <!-- close rocontainerw -->
 
 </main>

 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcah51LjCiIIFTqdekv78MHZvqT2NpCLo&callback=initMap"></script>
 <script>
    function initMap() {
        var uluru = {lat: <?php echo $data['company_address_latitude'];?>, lng: <?php echo $data['company_address_longitude'];?>};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
    </script>