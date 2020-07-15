jQuery( ".openActionplanForm" ).click(function() {
    var student_id = jQuery(this).data('studentid');
    jQuery("#actionplan_table tbody").empty();

    jQuery.getJSON( SITE_URL+"/teacher/Actionplanform/ajax_get/"+student_id, function( result ) {
        var items = [];
        jQuery.each( result.data, function( key, val ) {
            $('#actionplan_table tbody').append(
                '<tr>'+
                '<td>ID</td>'+
                '<td>'+val.work_subject+'</td>'+
                '<td>1</td>'+
                '<td>1</td>'+
                '<td>1</td>'+
                '<td>1</td>'+                
                '</tr>');
        });
    });

    $("#actionplan_student").modal()


});