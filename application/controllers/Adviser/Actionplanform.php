<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Actionplanform extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        if($this->Login_session->check_login()->login_type != 'adviser') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
    }

		public function index(){
         $data['data'] = $this->Teacher_Actionplanform->gets_student_list_by_teacher();
        $this->template->view('Teacher/Actionplanform_view',$data);
        }

        public function planform (){
        $data['data'] = $this->Teacher_Actionplanform->gets_student_list_by_teacher();
        print_r($data);
    }

    public function ajax_get($student_id)
    {
        $data['data'] = $this->Teacher_Actionplanform->get_by_student($student_id);
        echo json_encode($data);        
    }
}