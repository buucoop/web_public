<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_document extends CI_Controller {

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
        $this->form();
    }

    public function form()
	{
        $student_id = $this->Login_session->check_login()->login_value;
        $document_code = $this->input->post('code');
        if(!$document_code) 
            $document_code = $this->input->get('code');

        if(!$data['document'] = $this->Form->get_form_by_name($document_code)[0]) {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
        
        if($this->input->post('code')) {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'pdf|jpg|jpeg|png';
            $config['max_size']             = 0;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file-input')) {
                $data['status'] = $this->upload->display_errors();
            } else {
                $file = $this->upload->data();            
                $data['status'] = 'success';

                //insert to db
                $insert['document_pdf_file'] = '/uploads/'.$file['file_name'];
                $insert['coop_document_id'] = $data['document']['document_id'];
                $insert['student_id'] = $student_id;
                if($this->input->post('document_subject')) {
                    $insert['document_subject'] = $this->input->post('document_subject');
                    @$this->Coop_Submitted_Form_Search->delete_form_by_student_and_code($student_id, $data['document']['document_id'], $insert['document_subject']);                    
                    
                } else {
                    @$this->Coop_Submitted_Form_Search->delete_form_by_student_and_code($student_id, $data['document']['document_id']);                    
                }
                $this->Coop_Submitted_Form_Search->insert_form_by_student_and_code($insert);
            }
        } else {
            $data['status'] = '1';

        }
        //check old document        
        $old_doc = @$this->Coop_Submitted_Form_Search->search_form_by_student_and_code($student_id, $data['document']['document_id'])[0];
        $data['old_document'] = '';        
        if($old_doc['document_pdf_file'] != '') {
            $data['old_document'] = $old_doc;
        }
        $this->breadcrumbs->push('อัพโหลดเอกสาร'.$data['document']['document_code'].' ('.$data['document']['document_name'].')', '/Coop_student/Upload_document/?code='.$data['document']['document_code']);
        
        if($data['document']['document_code'] == 'IN-S007') {
            $data['ins007'] = $this->Coop_Student->gets_general_petition_by_student($student_id);            
        }

        $this->template->view('Coop_student/Upload_document_view', $data);
        
       
    }

}