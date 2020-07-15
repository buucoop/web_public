<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $user = $this->Login_session->check_login();
        
        if(!$user) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        if($user->login_type != 'company') {
            redirect(ucfirst($user->login_type).'/main/');
            die();
        }
        //add breadcrumbs
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }


    public function student_detail($student_id)
    {
        $data['student'] = @$this->Student->get_student($student_id)[0];
        $data['department']['department_name'] = $data['student']['department_name'];
        $data['coop_status_type']['coop_status_name'] = $data['student']['coop_status_name'];
        $data['company_status']['company_status_name'] = $data['student']['company_status_name'];

        if($data['student']['company_status_id'] == 5)
        {
            $data['coop_student'] = @$this->Coop_Student->get_coop_student($student_id)[0];
            
            $data['company'] = @$this->Company->get_company($data['coop_student']['company_id'])[0];
            $data['trainer'] = @$this->Trainer->get_trainer($data['coop_student']['trainer_id'])[0];
            $data['adviser'] = @$this->Adviser->get_adviser($data['coop_student']['adviser_id'])[0];
            $data['job'] = $this->Job->get_job($data['coop_student']['job_id'])[0];
        }
        $data['train_type'] = array();
        $train_type = $this->Training->get_student_stat_of_training($student_id);

        foreach($train_type['train_type'] as $type) {
            $tmp['name'] = $type['train_type_name'];
            $tmp['total_hour'] = $type['train_type_total_hour'];
            $tmp['check_hour'] = 0;
            //calc total hour
            foreach($type['history'] as $history) {
                $tmp['check_hour'] += $history['check_hour'];
            }

            array_push($data['train_type'], $tmp);
        }

        $data['student_profile'] = $this->Student->get_student_data_from_profile($student_id);
        // print_r($data);
        // die();

        // add breadcrumbs
        $this->breadcrumbs->push('รายละเอียดเกี่ยวกับสถานประกอบการ', '/Company/Job_list_position/index');

        $this->breadcrumbs->push('รายละเอียดนิสิต', '/Company/Student/student_detail/'.$student_id);

        $this->template->view('Company/Student_detail_view', $data);
       
    }

    public function training_history_student($student_id)
    {

        $data['train_type'] = array();
        $train_type = $this->Training->get_student_stat_of_training($student_id);
        foreach($train_type['train_type'] as $type) {
            $tmp['name'] = $type['train_type_name'];
            $tmp['total_hour'] = $type['train_type_total_hour'];
            $tmp['check_hour'] = 0;
            //calc total hour
            foreach($type['history'] as $history) {
                $tmp['check_hour'] += $history['check_hour'];
            }
            $tmp['history'] = $type['history'];

            array_push($data['train_type'], $tmp);
        }
        $this->breadcrumbs->push('รายละเอียดนิสิต', '/Company/Student/student_detail/'.$student_id);

        $this->breadcrumbs->push('รายละเอียดเกี่ยวกับประวัติการเข้ากิจกรรมอบรม ', '/Company/Student/training_history_student/'.$student_id);

        $this->template->view('Officer/Training_history_student_view', $data);
    }

    



}  
  