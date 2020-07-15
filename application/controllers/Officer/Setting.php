<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $user = $this->Login_session->check_login();
        
        if(!$user) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        if($user->login_type != 'officer') {
            redirect(ucfirst($user->login_type).'/main/');
            die();
        }

        // $this->breadcrumbs->unshift('ระบบสหกิจ', '/'); //home
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    public function edit_term()
    {
        $data['status'] = [];
        $status = $this->session->flashdata('status');
        if($status == 'success') {
            $data['status'] = [
                'text' => 'สำเร็จ',
                'color' => 'success'
            ];
        } else if($status == 'error') {
            $data['status'] = [
                'text' => 'ผิดพลาด',
                'color' => 'warning'
            ];
        }
        // print_r($data);
        // add breadcrumbs
        $this->breadcrumbs->push('จัดการปีการศึกษา', '/Officer/Setting/edit_term');
        $data['terms'] = $this->Term->gets_term();
        $this->template->view('Officer/Setting_term_view', $data);
    }

    public function post_current_term()
    {
        $return['status'] = false;
        $term_id = $this->input->post('term_id');
        $this->Term->update_term_when_edit($term_id);
        if($this->Term->get_term($term_id)) {
            if($this->Term->set_current_term($term_id)) {
                $return['status'] = true;
            }
        }
        echo json_encode($return);
    }

    public function update_when_edit_term()
    {
        $term_id = $this->input->post('term_id');
        $this->Term->update_tb_company_has_coop_company_questionnaire_item($term_id);
		        $this->Term->update_tb_company_has_department($term_id);
		        $this->Term->update_tb_company_job_position($term_id);
		        $this->Term->update_tb_coop_company_questionnaire_item($term_id);
		        $this->Term->update_tb_coop_company_questionnaire_subject($term_id);
		        $this->Term->update_tb_coop_document($term_id);
		        $this->Term->update_tb_coop_student_questionnaire_item($term_id);
		        $this->Term->update_tb_coop_student_questionnaire_subject($term_id);
		        $this->Term->update_tb_student_core_subject($term_id);
    }

    public function post_new_term()
    {
        //add term
        $this->form_validation->set_rules('semester', 'ภาคเรียน', 'trim|required|in_list[1,2,3]');
        $this->form_validation->set_rules('year', 'ปีการศึกษา', 'trim|required|min_length[4]|max_length[4]');
        

        if ($this->form_validation->run() == FALSE) {
            $this->edit_term();
        } else {
            // check dup
            if(!$this->Term->search_term($this->input->post('semester'), $this->input->post('year'))) {
                $insert['term_name'] = $this->input->post('semester')."/".$this->input->post('year');
                $insert['term_year'] = $this->input->post('year');
                $insert['term_semester'] = $this->input->post('semester');
                $insert['term_is_current'] = 0;
                if($this->Term->add_term($insert)) {
                    $this->session->set_flashdata('status', 'success');
                    redirect('Officer/Setting/edit_term?form_status=success');
                } else {
                    $this->session->set_flashdata('status', 'error');
                    redirect('Officer/Setting/edit_term?form_status=error');
                }
            } else {
                $this->session->set_flashdata('status', 'error');
                redirect('Officer/Setting/edit_term?form_status=error');
            }
        }
        
    }



    public function edit_document()
    {
        $status = $this->session->flashdata('status');
        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'ตั้งค่าสำเร็จ';
        } else if($status == 'error'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'ผิดพลาด';

        } else {
            $data['status'] = '';
        }
        // get coop_document
        $data['coop_document'] = $this->Form->gets_form();

        // add breadcrumbs
        $this->breadcrumbs->push('จัดการเอกสารที่นิสิตต้องส่ง', '/Officer/Setting/edit_document');
        
        $this->template->view('Officer/Setting_document_view',$data);
    }

    public function post_edit_document() 
    {
        $term_id =  $this->Login_session->check_login()->term_id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('document_id', 'เลขเอกสาร', 'required|numeric');
        $this->form_validation->set_rules('document_deadline_datetime', 'วันเวลากำหนดส่ง', 'required');

        if($this->form_validation->run()) {
            $document_id = $this->input->post('document_id');
            if($this->Form->get_form($document_id, $term_id)) {
                $updateArr = [
                    'document_deadline' => $this->input->post('document_deadline_datetime')
                ];
                $this->Form->update_form($document_id, $updateArr);
                $this->session->set_flashdata('status', 'success');
                redirect('Officer/Setting/edit_document?', 'refresh');
            } else {
                $this->session->set_flashdata('status', 'error');
                redirect('Officer/Setting/edit_document?', 'refresh');                
            }
        } else {
            $this->session->set_flashdata('status', 'error');
            redirect('Officer/Setting/edit_document?', 'refresh');
        }
    }

    public function update_document_status()
    {
        $term_id =  $this->Login_session->check_login()->term_id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'สถานะ', 'required|numeric|in_list[0,1]');
        $this->form_validation->set_rules('document_id', 'เลขเอกสาร', 'required|numeric');

        $return['status'] = false;

        if ($this->form_validation->run()) {
            //change in db
            $document_id = $this->input->post('document_id');
            if($this->Form->get_form($document_id, $term_id)) {
                $updateArr = [
                    'document_active' => $this->input->post('status')
                ];
                $this->Form->update_form($document_id, $updateArr);

                $return['status'] = true;                
            }
        }

        echo json_encode($return);
    }

    public function lists_job_title(){
        
        $status = $this->session->flashdata('status');

        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'เพิ่มสำเร็จ';
        }
        else if($status == 'dup_data'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'ไม่สามารถเพิ่มได้ข้อมูลซ้ำ';

        }
        else if($status == 'success_update'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'แก้ไขสำเร็จ';

        }
        else if($status == 'success_delete'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'ลบสำเร็จ';

        }
        else {
            $data['status'] = '';
        }

        $data['form_type'] = 'insert';
        $data['company_job_title'] = $this->Job->gets_company_job_title();

        // add breadcrumbs
        $this->breadcrumbs->push('จัดการตำแหน่งงาน', '/Officer/Setting/lists_job_title');
        $this->breadcrumbs->push('เพิ่มตำแหน่งงาน', '/');
        

        $this->template->view('Officer/Job_position_setting_view',$data);
    }

    public function add_job_title()
    {
        $this->form_validation->set_rules('job_title', 'ตำแหน่งงาน', 'trim|required|thai_en_character|is_unique[tb_company_job_title.job_title]');

        if ($this->form_validation->run() == FALSE) {
            $this->lists_job_title();
        } else {
            $array['job_title'] = $this->input->post('job_title');
            $this->Job->insert_job_title($array);

            $this->session->set_flashdata('status', 'success');
            redirect('Officer/Setting/lists_job_title/?', 'refresh');
        }

    }

    public function update_job_title($job_title_id = 0)
    {
        $this->form_validation->set_rules('job_title', 'ตำแหน่งงาน', 'trim|required|thai_en_character');
        
        if ($this->form_validation->run() == FALSE) {
            if($job_title_id < 1) {
                $job_title_id = $this->input->post('job_title_id');                
            }

            $data['form_type'] = 'update';
            $data['status'] = null;
            $data['job_title_by_id'] = $this->Job->get_company_job_title_by_job_title_id($job_title_id)[0];
            $data['company_job_title'] = $this->Job->gets_company_job_title();

            // add breadcrumbs
            $this->breadcrumbs->push('จัดการตำแหน่งงาน', '/Officer/Setting/lists_job_title');
            $this->breadcrumbs->push('แก้ไขตำแหน่งงาน', '/Officer/Setting/update_job_title'.$job_title_id);

            $this->template->view('Officer/Job_position_setting_view',$data);

        } else {
            //update
            $job_title_id = $this->input->post('job_title_id');
            $array['job_title'] = $this->input->post('job_title');
            
            if($this->Job->get_job_title($job_title_id)) {
                $this->Job->update_job_title($job_title_id, $array);
                $this->session->set_flashdata('status', 'success_update');
                redirect('Officer/Setting/lists_job_title/?', 'refresh');
            }
        }

    }

    public function delete_job_title($job_title_id)
    {
        if($this->Job->get_job_title($job_title_id)) {
            $this->Job->delete_job_title($job_title_id);
            $this->session->set_flashdata('status', 'success_delete');
            redirect('Officer/Setting/lists_job_title/', 'refresh');
        }
    }

    public function lists_skill_name()
    {
        $status = $this->session->flashdata('status');
        
        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'เพิ่มสำเร็จ';
        }
        else if($status == 'dup_data'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'ไม่สามารถเพิ่มได้ข้อมูลซ้ำ';

        }
        else if($status == 'success_update'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'แก้ไขสำเร็จ';

        }
        else if($status == 'success_delete'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'ลบสำเร็จ';

        }
        else {
            $data['status'] = '';
        }

        $data['form_type'] = 'insert';

        $data['data'] = array();
        foreach ($this->Skill->gets_skill_category() as $row) {

            $tmp_array = array();
            $tmp_array['skill_category'] = $row;
            $tmp_array['skill'] = $this->Skill->gets_skill_by_category_id($row['skill_category_id']);
            array_push($data['data'], $tmp_array);
        }
        

        

        // print_r($data);
        // add breadcrumbs
        $this->breadcrumbs->push('จัดการประเภททักษะ', '/Officer/Setting/lists_skill_name');
        $this->breadcrumbs->push('เพิ่มประเภททักษะ', '/');

        $this->template->view('Officer/Skill_position_setting_view', @$data);

    }

    public function add_skill_name()
    {
        $this->form_validation->set_rules('skill_name', 'ชื่อทักษะงาน', 'trim|required|thai_en_character|is_unique[tb_skill.skill_name]');
        $this->form_validation->set_rules('skill_category_id', 'ประเภททักษะ', 'trim|required|integer');
        
        if ($this->form_validation->run() == FALSE) {
            $this->lists_skill_name();
        } else {
            $array['skill_category_id'] = $this->input->post('skill_category_id');
            $array['skill_name'] = $this->input->post('skill_name');
            $this->Skill->insert_skill($array);
            $this->session->set_flashdata('status', 'success');
            redirect('Officer/Setting/lists_skill_name/?', 'refresh');
        }

    }

    public function update_skill_name($skill_id = 0)
    {
        $this->form_validation->set_rules('skill_name', 'ชื่อทักษะงาน', 'trim|required|thai_en_character|is_unique[tb_skill.skill_name]');

        if ($this->form_validation->run() == FALSE) {
            $data['form_type'] = 'update';
            $data['status'] = null;
            // $data['skill'] = $this->Skill->gets_skill();

            $data['skill_by_skill_id'] = $this->Skill->get_skill($skill_id)[0];
            $data['skill_category_by_id'] = $this->Skill->get_skill_category_by_id($data['skill_by_skill_id']['skill_category_id'])[0];

            $data['data'] = array();
            foreach ($this->Skill->gets_skill_category() as $row) {

                $tmp_array = array();
                $tmp_array['skill_category'] = $row;
                $tmp_array['skill'] = $this->Skill->gets_skill_by_category_id($row['skill_category_id']);
                array_push($data['data'], $tmp_array);
            }

            
            // add breadcrumbs
            $this->breadcrumbs->push('จัดการประเภททักษะ', '/Officer/Setting/lists_skill_name');
            $this->breadcrumbs->push('แก้ไขประเภททักษะ', '/Officer/Setting/update_skill_name/'.$skill_id);

            $this->template->view('Officer/Skill_position_setting_view',$data);

        } else {
            $skill_id = $this->input->post('skill_id');
            $array['skill_name'] = $this->input->post('skill_name');
            $this->Skill->update_skill($skill_id , $array);
            $this->session->set_flashdata('status', 'success_update');
            redirect('Officer/Setting/lists_skill_name/?', 'refersh');
        }


    }

    public function delete_skill_name($skill_id)
    {
        $this->Skill->delete_skill($skill_id);
        $this->session->set_flashdata('status', 'success_delete');
        redirect('Officer/Setting/lists_skill_name/?', 'refersh');

    }

    public function adviser_setting()
    {
        $data['adviser'] = $this->Adviser->gets_adviser();
        // print_r($data);

        // add breadcrumbs
        $this->breadcrumbs->push('เปลี่ยนสิทธิ์อาจารย์', '/Officer/Setting/adviser_setting');
        $this->breadcrumbs->push('เปลี่ยนสิทธิ์อาจารย์', '/');
        
        $this->template->view('Officer/Adviser_setting_view',$data);
    }

    public function post_adviser_setting()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'สถานะ', 'required|numeric|in_list[0,1]');

        $return['status'] = false;

        if ($this->form_validation->run()) {
            //change in db
            $array['adviser_is_officer'] = $this->input->post('status');
            $adviser_id = $this->input->post('adviser_id');            
            $this->Adviser->update_adviser($adviser_id, $array);
            
            $return['status'] = true;
        }

        echo json_encode($return);

    }
    public function core_subjects_list()
    {
        $status = $this->session->flashdata('status');

        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'เพิ่มสำเร็จ';
        }
        else if($status == 'dup_data'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'ไม่สามารถเพิ่มได้ข้อมูลซ้ำ';

        }
        else if($status == 'error'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'ไม่สามารถเพิ่มได้';

        }
        else if($status == 'success_update'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'แก้ไขสำเร็จ';

        }
        else if($status == 'success_delete'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'ลบสำเร็จ';

        }
        else {
            $data['status'] = '';
        }

        $data['student_core_subject'] = $this->Student->gets_student_core_subject();
        // print_r($data);
        $this->template->view('Officer/Core_subjects_setting_view', $data);
    }
    public function add_core_subjects()
    {
        $this->form_validation->set_rules('subject_id', 'รหัสวิชาแกน', 'required|numeric|min_length[6]|max_length[6]');
        if ($this->form_validation->run() == FALSE)
        {
            // redirect('Officer/Setting/core_subjects_list?status=error','refresh');
            $this->core_subjects_list();
        }
        else
        {
            $array['subject_id'] = $this->input->post('subject_id');
            $array['term_id'] = $this->Term->get_current_term()[0]['term_id'];
        
            if($this->Student->insert_student_core_subject($array)) {
                $this->session->set_flashdata('status', 'success');
                redirect('Officer/Setting/core_subjects_list?','refresh');
                
            } else {
                $this->session->set_flashdata('status', 'dup_data');
                redirect('Officer/Setting/core_subjects_list','refresh');
            }

        }
    }
    
    public function delete_core_subjects($subject_id)
    {
        if($this->Student->delete_student_core_subject($subject_id)) {
            $this->session->set_flashdata('status', 'success_delete');
        } else {
            $this->session->set_flashdata('status', 'error');
        }
        redirect('Officer/Setting/core_subjects_list?','refresh');

    }
    
}
