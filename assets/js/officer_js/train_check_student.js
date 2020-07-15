updateStudentList()

$('#enter_student_code').keyup(function(e){
    if(e.keyCode == 13)
    {
        addStudent($('#enter_student_code').val())
    }
});
 
function addStudent(student_code) 
{
	var student_code = jQuery("#enter_student_code").val();
	if(student_code!="") {
        jQuery('#enter_student_code').val(null)

        var datastring = "train_set_check_id="+$("#train_set_check_id").val()+"&student_code="+student_code;
        jQuery.post(SITE_URL+"/Officer/Train_check_student/ajax_post", datastring, function(response) {
            if(response.status) {
                toastr["success"]("เช็คชื่อเรียบร้อย ID: "+response.student.student_id)

                jQuery("#student_info_frm").show();

		        jQuery("#student_img").attr("src", "http://reg.buu.ac.th/registrar/getstudentimage.asp?id="+response.student.student_id);                
                jQuery("#student_name").html(response.student.student_fullname)
                jQuery("#student_code").html(response.student.student_id)
                jQuery("#entry_time").html(response.entry_time)
                

            } else {
                toastr["error"]("ผิดพลาด")
                jQuery("#student_info_frm").hide();
                
                jQuery("#student_img").attr("src", "");                
                jQuery("#student_name").html(null)
                jQuery("#student_code").html(null)
                jQuery("#entry_time").html(null)

            }
            updateStudentList()
            
        }, 'json');


	} else {
		toastr["error"]("Error ja, please enter student code before enter")
	}
}

function updateStudentList()
{
    $("#student_table").find("tr:gt(0)").remove();

    var datastring = "train_set_check_id="+$("#train_set_check_id").val();
    jQuery.post(SITE_URL+"/Officer/Train_check_student/ajax_get", datastring, function(response) {
        if(response.status) {
            jQuery("#current_student").html(response.rows.length)
            var i = 1;
			$(response.rows).each(function(index, row){ 
				$('#student_table').append('<tr><td>'+ i++ +'</td><td>'+ row.train_check.date_check +'<td> '+row.train_check.student_id+' </td><td> '+row.student.student_fullname+' </td></tr>');       
			})

        } else {
            

            toastr["error"]("err ja")

        }
    }, 'json');
}
