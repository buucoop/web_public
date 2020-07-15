<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        $user = $this->Login_session->check_login();
        if($user->login_type != 'student') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
      
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

	public function lists($status = '')
	{
        $student_id = $this->Login_session->check_login()->login_value;

        //get current test id
        $data['coop_test'] = @$this->Test->gets_test()[0];
        if( count($data['coop_test']) < 1 ) {
            $this->session->set_flashdata('session_alert', '<div class="alert alert-warning">ยังไม่เปิดการสอบ</div>');
            redirect('student/main', 'refresh');
        }
        //check already register?
        $data['already_register'] = false;
        if($status == 'error_unknown' ){
            $data['status']['color'] = 'danger';
            $data['status']['text'] = 'ผิดพลาด โปรดรอการตรวจสอบ';
        } else if($status == 'error_student_dup') {
            $data['status']['color'] = 'warning';
            $data['status']['text'] = 'คุณเคยลงทะเบียนไปแล้ว โปรดมาสอบตามวันเวลาที่นัดหมาย';
            $data['already_register'] = true;            
        } else if($status == 'success'){
            $data['status']['color'] = 'success';
            $data['status']['text'] = 'ลงสมัครสอบเรียบร้อย โปรดมาสอบตามวันเวลาที่นัดหมาย';
            $data['already_register'] = true;            
        } else if(@$this->Test->check_student($student_id, $data['coop_test']['coop_test_id'])) {
            $data['status']['color'] = 'warning';
            $data['status']['text'] = 'คุณเคยลงทะเบียนไปแล้ว โปรดมาสอบตามวันเวลาที่นัดหมาย';
            $data['already_register'] = true;
        }
        else {
            $data['status'] = '';
        }

        // print_r($data);
        $this->breadcrumbs->push('สมัครสอบวัดผลสหกิจ', '/Student/Training/lists');
		$this->template->view('student/test_register_view', $data);
		
    }
    
    public function register()
    {
        $student_id = $this->Login_session->check_login()->login_value;
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm','Confirm','required|in_list[1]');
        if($this->form_validation->run() == false){
            return $this->index('error_unknown');
            die();
        } else {
            //get current test id
            $data['coop_test'] = $this->Test->get_open_register()[0];
            $data['student'] = $this->Student->get_student($student_id)[0];
    

            //check already register?
            if(@$this->Test->check_student($student_id, $data['coop_test']['id'])) {
                return $this->lists('error_student_dup');
                die();
            }
           
            //register
            $array['coop_test_id'] = $data['coop_test']['id'];
            $array['coop_test_term_id'] = $data['coop_test']['term_id'];
            $array['student_term_id'] = $data['student']['term_id'];
            $array['student_id'] = $data['student']['id'];
            $array['coop_test_status'] = '0';
            
            $this->Test->insert_student_to_test($array);

            return $this->lists('success');

        }
    }


    public function result()
    {
        $student_id = $this->Login_session->check_login()->login_value;
        
        $data['data'] = array();
        foreach($this->Test->get_test_result_by_student($student_id) as $row) {
            $temp_array = array();
            $temp_array['test_result'] = $row;
            $temp_array['coop_test'] = $this->Test->get_test($row['coop_test_id'])[0];

            array_push($data['data'], $temp_array);
        }
        $this->breadcrumbs->push('ประกาศผลสอบวัดผลสหกิจ', '/Student/Training/result');
		$this->template->view('student/test_result_view', $data);        
    }
}  
  