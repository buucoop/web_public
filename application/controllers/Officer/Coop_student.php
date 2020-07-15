<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Coop_student extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        $user = $this->Login_session->check_login();
        if($user->login_type != 'officer') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }

        // $this->breadcrumbs->unshift('ระบบสหกิจ', '/'); //home
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    
        public function index()
        {   
            $data = array();

            // add breadcrumbs
            $this->breadcrumbs->push('รายชื่อนิสิตสหกิจ', '/Officer/Coop_student/index');

            $this->template->view('Officer/List_coop_student_view', $data);
        }

        public function ajax_list()
        {
            $return = array();
            $return['data'] = array();

            foreach($this->Coop_Student->gets_coop_student() as $row) {
                //get student
                $tmp_array = array();
                $tmp_array['student']['student_fullname'] = $row['student_fullname'];
                $tmp_array['student']['student_id'] = $row['student_id'];
                $tmp_array['student']['id_link'] = '<a href="'.site_url('Officer/Students/student_detail/'.$row['student_id']).'">'.$row['student_id'].'</a>';
                $tmp_array['job_position']['job_title'] = $row['job_title'];
                $tmp_array['company']['company_name_th'] = $row['company_name_th'];
                $tmp_array['student']['oral_exam_datetime'] = thaiDate($row['coop_student_oral_exam_date']);

                if($row['person_fullname'] == '') {
                    $tmp_array['trainer']['person_fullname'] = ' - ';
                } else {
                    $tmp_array['trainer']['person_fullname'] = $row['person_fullname'];
                }

                // print_r($tmp_array);
                array_push($return['data'], $tmp_array);
            }
    
            echo json_encode($return['data']);
        }
    
    
        public function exam_score()
        {   
            $data = array();

            // add breadcrumbs
            $this->breadcrumbs->push('รายชื่อนิสิตสหกิจ', '/Officer/Coop_student/index');
            $data['students'] = $this->Coop_Student->gets_coop_student();

            $this->template->view('Officer/List_coop_student_exam_view', $data);
        }
   
}