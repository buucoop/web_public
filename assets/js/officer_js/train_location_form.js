$( "#train_location_form" ).submit(function( event ) {

    event.preventDefault();
    var datastring = $("#train_location_form").serialize();

    jQuery.post(SITE_URL+"/Officer/Train_location/ajax_post", datastring, function(response) {
        //alert
        if(response.status) {
            swal({
                title: "บันทึกข้อมูลเรียบร้อย!",
                text: "ทำ",
                icon: "success",
              })
              .then((xxx) => {
                window.location.replace(SITE_URL+"/Officer/Train_location/");
              });
        } else {
            swal({
                title: "ผิดพลาด!",
                text: response.message,
                icon: "warning",
              })
        }
        

    }, 'json');


});
