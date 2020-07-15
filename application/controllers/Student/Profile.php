<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $user = $this->Login_session->check_login();
        
        if(!$user) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
        //check priv
        if($user->login_type != 'student') {
            redirect(ucfirst($user->login_type).'/main/');
            die();
        }
      
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
        // $this->output->enable_profiler(TRUE);
        
    }


    public function view(){

        $student_id = $this->Login_session->check_login()->login_value;
        $data['student'] = $this->Student->get_student($student_id)[0];     
        // $data['department'] = $this->Login_session->check_login()->department;
        // $data['coop_status_type'] = $this->Student->gets_coop_status_type( $data['student']['coop_status_id'])[0];
        // $data['term'] = $this->Term->get_current_term()[0];
        $data['term']['term_name'] = $this->Login_session->check_login()->term_name;
        // $data['company_status'] = $this->Student->get_company_status_type( $data['student']['company_status_id'])[0];
        
        $data['department']['department_name'] = $data['student']['department_name'];
        $data['coop_status_type']['coop_status_name'] = $data['student']['coop_status_name'];
        $data['company_status']['company_status_name'] = $data['student']['company_status_name'];

        $data['pass_training'] = false;
        $train_type = $this->Training->get_student_stat_of_training($student_id)['train_type'];
        $data['train_type'] = array();
        foreach($train_type as $type) {
            $tmp['name'] = $type['train_type_name'];
            $tmp['total_hour'] = $type['train_type_total_hour'];
            $tmp['check_hour'] = 0;
            //calc total hour
            foreach($type['history'] as $history) {
                $tmp['check_hour'] += $history['check_hour'];
            }

            if($tmp['check_hour'] == $tmp['total_hour']) {
                $data['pass_training'] = true;
            } else {
                $data['pass_training'] = false;
            }
        }
        $this->breadcrumbs->push('ข้อมูลนิสิต', '/Student/Profile/view');

        $data['student_profile'] = $this->Student->get_student_data_from_profile($student_id);
        $data['has_profile'] = $this->Student->has_student_data_from_profile($student_id);
        $data['adviser_full_name'] = @$this->Student->get_adviser_name_from_student($student_id);
        $data['sum_credit'] = @$this->Student->get_student_sum_credit($student_id);
        
        $this->template->view('Student/Student_data_view',$data);
        

    }
  



}