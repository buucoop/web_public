<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coop_detail extends CI_Controller {

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
      
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    public function index(){
        $student_id = $this->Login_session->check_login()->login_value;
        $data['coop_student'] = $this->Coop_Student->get_coop_student($student_id)[0];
        $data['company_job_position'] = $this->Job->get_job($data['coop_student']['job_id'])[0];
        $data['adviser'] = @$this->Adviser->get_adviser($data['coop_student']['adviser_id'])[0];
        $data['student'] = $this->Student->get_student($student_id)[0];
        $data['company'] = $this->Company->get_company($data['coop_student']['company_id'])[0];     
        $data['department'] = $this->Student->get_department( $data['student']['department_id'])[0];
        $data['coop_status'] = $this->Student->get_by_coop_status_type( $data['student']['coop_status_id'])[0];
        $data['term'] = $this->Term->get_current_term($data['student']['term_id'])[0];

        $data['company_status'] = $this->Student->get_company_status_type($data['student']['company_status_id'])[0];
        

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
        $data['student_profile'] = $this->Student->get_student_data_from_profile($student_id);
        $data['has_profile'] = $this->Student->has_student_data_from_profile($student_id);
        // print_r($data);
        $data['adviser_full_name'] = @$this->Student->get_adviser_name_from_student($student_id);
        $data['sum_credit'] = @$this->Student->get_student_sum_credit($student_id);

        
        $this->breadcrumbs->push('ข้อมูลนิสิต', '/Student/Coop_detail/index');
        $this->template->view('Coop_student/Coop_detail_view',$data);

    }
    public function oral_exam(){

        $status = $this->session->flashdata('status');

        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'กำหนดวันขึ้นสอบสำเร็จ';
        } else if( $status == 'error'){
            $data['status']['color'] = 'danger';            
            $data['status']['text'] = 'ผิดพลาด';
        }else {
            $data['status'] = '';
        }

        $student_id = $this->Login_session->check_login()->login_value;
        $data['coop_student'] = $this->Coop_Student->get_coop_student($student_id)[0];
        //print_r($data['coop_student']);

        $arr_css = [
            base_url('assets/css/fullsize_datetimepicker.css?2')
        ];

        $this->breadcrumbs->push('กำหนดวันขึ้นสอบ', '/Coop_student/Coop_detail/oral_exam');
        
        $this->template->view('Coop_student/Oral_exam_view', $data, [], $arr_css);
    }
    public function post_oral_exam()
    {

        $student_id = $this->Login_session->check_login()->login_value;

        $this->form_validation->set_rules('coop_student_oral_exam_date', 'กำหนดวันสอบ', 'required|trim|checkDateTime');
    
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('status', 'error');
            redirect('Coop_student/Coop_detail/oral_exam/','refresh');
        }
        else
        {
            $array['coop_student_oral_exam_date'] = $this->input->post('coop_student_oral_exam_date');
            $this->Coop_Student->update_coop_student($student_id, $array);
            $this->session->set_flashdata('status', 'success');
            redirect('Coop_student/Coop_detail/oral_exam/','refresh');
        }
   
    }
    
}