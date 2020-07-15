<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {

    function view($file, $data = array(), $src_js = array(), $src_css = array())
    {

        $default_src_js = [
            base_url('assets/theme/popper.js/dist/umd/popper.min.js'),
            base_url('assets/theme/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/theme/pace-progress/pace.min.js'),
            base_url('assets/js/app.js'),
            base_url('assets/plugins/sweetalert/sweetalert.min.js'),
            base_url('assets/plugins/toastr.js/toastr.min.js'),
            base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.full.js'),
            base_url('assets/plugins/formValidation.js/formValidation.min.js'),
            base_url('assets/plugins/formValidation.js/bootstrap.min.js'),
            base_url('assets/plugins/bootstrap3-typeahead.js'),

            
            
            base_url('assets/plugins/datatables/jquery.dataTables.min.js'),
            base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js'),
            base_url('assets/plugins/datatables/dataTables.checkboxes.min.js'),
            base_url('assets/plugins/datatables/dataTables.buttons.min.js'),
            base_url('assets/plugins/datatables/jszip.min.js'),
            base_url('assets/plugins/datatables/buttons.html5.min.js'),
            base_url('assets/plugins/datatables/buttons.print.min.js'),
            base_url('assets/plugins/datatables/pdfmake.min.js'),

        ];

        $default_src_css = [
            base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css'),
            base_url('assets/plugins/datatables/dataTables.checkboxes.css'),
            base_url('assets/plugins/datatables/buttons.dataTables.min.css'),
            base_url('assets/plugins/datatables/select.dataTables.min.css'),

            base_url('assets/css/custom.css'),
            base_url('assets/plugins/toastr.js/toastr.min.css'),
            base_url('assets/plugins/jquery.datetimepicker/jquery.datetimepicker.css'),
            

        ];
        

        error_reporting(E_ALL ^ E_NOTICE); //close error hahaha
        $CI =& get_instance();

        
        $login_data = $CI->Login_session->check_login();          
        $data['user'] = $login_data;
        $data['user_info'] = $CI->BUUMember->get($login_data->login_type, $login_data->login_value);
        if( count($data['user_info']) < 1 ) {
            redirect('Member/logout', 'refresh');
        }
        $data['user_info'] = $data['user_info'][0];

        if($login_data->login_type == 'student' ||
            $login_data->login_type == 'coop_student') {
            $data['user_info']['fullname'] = $data['user_info']['student_fullname'];
        } else if($login_data->login_type == 'adviser') {
            $data['user_info']['fullname'] = $data['user_info']['adviser_fullname'];
        } else if($login_data->login_type == 'officer') {
            // check adviser before
            $data['user_info']['fullname'] = $data['user_info']['officer_fullname'];
            if(!$data['user_info']['fullname']) {
                $data['user_info']['fullname'] = $data['user_info']['adviser_fullname'];
            }
        } else if($login_data->login_type == 'company') {
            $data['user_info']['fullname'] = $data['user_info']['person_fullname'];
        }


        
        if($login_data->login_type == 'officer') {
            $data['terms'] = $CI->Term->gets_term(); //get terms
        }

        $data['current_term'] = $CI->Term->get_current_term()[0];
        // print_r($data);
        //profile
        if(
            $login_data->login_type == 'student' ||
            $login_data->login_type == 'coop_student'
        ) {
            $data['profile_image'] = 'http://reg.buu.ac.th/registrar/getstudentimage.asp?id='.$data['user']->login_value;
        } else {
            $data['profile_image'] = 'http://via.placeholder.com/150x150/000/fff?text='.strtoupper($data['user']->login_value[0]);
        }

        $CI->load->view('template/header.php', $data);

        if($login_data->login_type == 'company') {
            $CI->load->view('menu/company_menu.php', $data);
        } else if($login_data->login_type == 'student') {
            $CI->load->view('menu/student_menu.php', $data);
        } else if($login_data->login_type == 'coop_student') {
            $CI->load->view('menu/coop_student_menu.php', $data);
        } else if($login_data->login_type == 'adviser') {
            $CI->load->view('menu/adviser_menu.php', $data);
        } else if($login_data->login_type == 'officer') {
            $CI->load->view('menu/officer_menu.php', $data);
        }

        $CI->load->view($file, $data);

        $data['src_scripts'] = array_merge($default_src_js, $src_js);
        $data['src_css'] = array_merge($default_src_css, $src_css);
        
        $CI->load->view('template/footer.php', $data);
    }

}