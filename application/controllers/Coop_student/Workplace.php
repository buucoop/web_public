<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workplace extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        $user = $this->Login_session->check_login();
        if($user->login_type != 'coop_student') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
        //add breadcrumbs
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    public function index()
    {
        $status = $this->session->flashdata('status');

        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'UPDATE สถานที่สำเร็จ';
        } else if( $status == 'error'){
            $data['status']['color'] = 'danger';            
            $data['status']['text'] = 'UPDATE ผิดพลาด';
        }else {
            $data['status'] = '';
        }

        $student_id = $this->Login_session->check_login()->login_value;
        $data['map'] = $this->Coop_Student->get_coop_student($student_id)[0];
        $this->breadcrumbs->push('แจ้งพิกัดงาน', '/Coop_student/Daily_activity/index');
        $this->template->view('Coop_student/Workplace_view',$data);
    }

    public function update()
    {
        // get
        $student_id = $this->Login_session->check_login()->login_value;

        $this->form_validation->set_rules('coop_student_latitude', 'ละติจูด', 'required|decimal');
        $this->form_validation->set_rules('coop_student_longitude', 'ลองติจูด', 'required|decimal');

        if ($this->form_validation->run() != FALSE) {
            // update
            $array['coop_student_latitude'] = $this->input->post('coop_student_latitude');
            $array['coop_student_longitude'] = $this->input->post('coop_student_longitude');
            $this->Coop_Student->update_coop_student($student_id, $array);
            $this->session->set_flashdata('status', 'success');
            redirect('Coop_student/Workplace/index/','refresh');
        } else {
            $this->index();
        }
        
    }
}