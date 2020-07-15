

$( "#permit_form" ).submit(function( event ) {

    event.preventDefault();

    var student_id = jQuery(this).data('studentid');
    jQuery("#document_check_table tbody").empty();

    var datastring = $("#permit_form").serialize();

    jQuery.post(SITE_URL+"/Coop_student/Permit_form/post", datastring, function(response) {
        //alert
        console.log(response)
        if(response.status) {
            swal({
                title: "บันทึกข้อมูลเรียบร้อย!",
                text: "ทำ",
                icon: "success",
              })
              .then((xxx) => {
                if(response.print) {
                    window.location.replace(SITE_URL+"/Coop_student/Permit_form/print_data");
                } else {
                    window.location.reload();                    
                }
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

function print_form()
{
    $("#print").val('1');
}