<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IN_S007 extends CI_Controller {
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

    public function index()
    {
        $student_id = $this->Login_session->check_login()->login_value;            

        $this->breadcrumbs->push('แบบคำร้องทั่วไป', 'Coop_student/IN_S007');
        $data['rows'] = $this->Coop_Student->gets_general_petition_by_student($student_id);

        $status = $this->session->flashdata('status');
        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'บันทึกสำเร็จ';
        } else if($status == 'error_document'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'ไม่สามารถเข้าถึงได้';
        } else {
            $data['status'] = '';
        }

        $this->template->view('Coop_student/IN_S007_list_view', $data);
    }

    public function form() 
    {
        $status = $this->session->flashdata('status');
    
        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'บันทึกสำเร็จ';
        } else if($status == 'error_input'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'เพิ่มไม่สำเร็จ';
        } else {
            $data['status'] = '';
        }

        $this->breadcrumbs->push('แบบคำร้องทั่วไป', 'Coop_student/IN_S007');
        $this->breadcrumbs->push('เพิ่มแบบคำร้องทั่วไป', 'Coop_student/IN_S007/form');

        
        $student_id = $this->Login_session->check_login()->login_value;            
        $data['coop_student'] = @$this->Coop_Student->get_coop_student($student_id)[0];
        $data['adviser'] = @$this->Adviser->get_adviser($data['coop_student']['adviser_id'])[0];
        $data['student'] = @$this->Student->get_student($student_id)[0];
        $data['department'] = @$this->Student->get_department($data['student']['department_id'])[0];
        $data['profile_student'] = @$this->Student->get_student_data_from_profile($student_id);
        // print_r($data);
        $this->template->view('Coop_student/IN_S007_view', $data);
    }
    
    public function save()
    {
        $student_id = $this->Login_session->check_login()->login_value;            
        // print_r($_POST);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('petition_subject', 'หัวข้อเรื่องแบบคำร้องทั่วไป', 'trim|required');
        $this->form_validation->set_rules('petition_purpose', 'วัตถุประสงค์', 'trim|required');
        $this->form_validation->set_rules('petition_reason', 'เนื่องจาก', 'trim|required');
        if ($this->form_validation->run()) {
            //save
            $insertArr['student_id'] = $student_id;
            $insertArr['petition_subject'] = $this->input->post('petition_subject');
            $insertArr['petition_purpose'] = $this->input->post('petition_purpose');
            $insertArr['petition_reason'] = $this->input->post('petition_reason');
            $insertArr['term_id'] = $this->Login_session->check_login()->term_id;
            
            if($last_id = $this->Coop_Student->save_general_petition($insertArr)) {
                if($this->input->post('print') == 1){
                    $this->print_data($last_id);
                }else {
                    $this->session->set_flashdata('status', 'success');                                    
                    redirect('Coop_student/IN_S007/','refresh');
                }

            } else {
                $this->session->set_flashdata('status', 'error_input');                
                redirect('Coop_student/IN_S007/form/?','refresh');   
                             
            }
            

        } else {
            //redirect
            $this->form();
        }
    }

    public function print_data($petition_id)
    {
        //check, is owner document
        $student_id = $this->Login_session->check_login()->login_value;    
        $petition_data = $this->Coop_Student->get_general_petition($petition_id)[0];

        $data['coop_student'] = @$this->Coop_Student->get_coop_student($student_id)[0];
        $data['adviser'] = @$this->Adviser->get_adviser($data['coop_student']['adviser_id'])[0];
        $data['student'] = @$this->Student->get_student($student_id)[0];

        //student profile
        $api['student'] = @$this->Student->get_student_data_from_profile($student_id);

        if($petition_data['student_id'] != $student_id) {
            //redirect
            $this->session->set_flashdata('status', 'error_document');
            redirect('Coop_student/IN_S007/','refresh');                
        } else {
            //print
            $template_file = "template/IN-S007.docx";
            $save_filename = "download/".$student_id."-IN-S007-id".$petition_data['petition_id'].".docx";
            $data_array = [
                'student_fullname' => $data['student']['student_prefix']." ".$data['student']['student_fullname'],
                'student_telephone' => $api['student']['Student_Phone'],
                'student_email' => $api['student']['Student_Email'],
                'student_id' => $student_id,
                'student_course' => $data['student']['student_course'],
                'department_name' => $data['student']['department_name'],
                'adviser_fullname' => $data['adviser']['adviser_fullname'],
                'date' => thaiDate(date('Y-m-d H:i:s')),
            ];
            $data_array = array_merge($data_array, $petition_data);

            $result = $this->service_docx->print_data($data_array, $template_file, $save_filename);

            //insert to db
            $coop_document_id = $this->Form->get_form_by_name('IN-S007', $this->Login_session->check_login()->term_id)[0]['document_id'];
            $word_file = '/uploads/'.basename($save_filename);
            $this->Form->submit_document($student_id, $coop_document_id, NULL, $word_file, $petition_data['petition_subject']);


            // redirect(base_url($result['full_url']), 'refresh');
            echo "
                <img src='".base_url('assets/img/loading.gif')."' />
                <script>
                    window.location = '".base_url($result['full_url'])."';
                    setTimeout(function(){
                        window.location = '".site_url('Coop_student/Upload_document/?code=IN-S007')."';
                    }, 1500);
                </script>
            ";
        }

    }

}
