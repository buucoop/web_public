<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permit_form  extends CI_Controller {

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

        $status = $this->session->flashdata('status');
        if( $status == 'success'){
            $data['status']['color'] = 'success';            
            $data['status']['text'] = 'บันทึกสำเร็จ';
        }
        else if($status == 'error'){
            $data['status']['color'] = 'warning';            
            $data['status']['text'] = 'ผิดพลาด';
        }
        else {
            $data['status'] = '';
        }

        // $data['permit'] = @$this->Coop_student_Permit_form->get_by_student($student_id)[0];
        $data['permit'] = @$this->Coop_Student->get_permit_form_by_student($student_id)[0];
        $data['student'] = @$this->Student->get_student($student_id)[0];
        $data['department'] = @$this->Student->get_department($data['student']['department_id'])[0];
        $data['profile'] = @$this->Student->get_student_data_from_profile($student_id);
            if(!$data['permit']){
                $data['permit']['permit_fullname'] = $data['profile']['Parent_Name'];
                $data['permit']['permit_relative'] = $data['profile']['Parent_Status'];
                $data['permit']['permit_address_number'] = $data['profile']['Address_Number'];
                $data['permit']['permit_address_district'] = $data['profile']['Address_Tumbon'];
                $data['permit']['permit_address_area'] = $data['profile']['Address_Aumper'];
                $data['permit']['permit_address_province'] = $data['profile']['Address_Province'];
                $data['permit']['permit_address_postal_code'] = $data['profile']['Address_Postcode'];
                $data['permit']['permit_telephone'] = $data['profile']['Address_Phone'];
                $data['permit']['permit_email'] = $data['profile']['Address_Email'];
            }

        // print_r($data);
        $this->breadcrumbs->push('ดาวน์โหลดเอกสารแบบอนุญาติให้นิสิตไปปฏิบัติงานสหกิจ (IN-S003)', '/Coop_student/Permit_form');
        
        $this->template->view('Coop_student/Permit_form_view',$data);

    }

    public function post()
    {


        $student_id = $this->Login_session->check_login()->login_value;
        
        $return['status'] = false;
        $return['print'] = false;
                
        $this->form_validation->set_rules('permit_fullname', 'ชื่อผู้ปกครอง', 'trim|required|thai_en_character');
        $this->form_validation->set_rules('permit_relative', 'ความสัมพันธ์กับนิสิต', 'trim|required|thai_character');
        $this->form_validation->set_rules('permit_address_number', 'บ้านเลขที่', 'trim|required');
        $this->form_validation->set_rules('permit_address_road', 'ถนน', 'trim|required');
        $this->form_validation->set_rules('permit_address_district', 'ตำบล', 'trim|required');
        $this->form_validation->set_rules('permit_address_area', 'อำเภอ', 'trim|required');
        $this->form_validation->set_rules('permit_address_province', 'จังหวัด', 'trim|required');
        $this->form_validation->set_rules('permit_address_postal_code', 'รหัสไปรษณีย์', 'trim|required|numeric|max_length[5]');
        $this->form_validation->set_rules('permit_telephone', 'โทรศัพท์', 'trim|required|numeric|max_length[10]');
        $this->form_validation->set_rules('permit_fax_number', 'โทรสาร', 'trim|numeric|max_length[15]');
        $this->form_validation->set_rules('permit_email', 'E-mail', 'trim|valid_email');
        $this->form_validation->set_rules('permit_choice', 'การตอบรับ', 'trim|required|in_list[0,1]');

        if ($this->form_validation->run() != FALSE) {
            $data['permit_fullname'] =  $this->input->post('permit_fullname');
            $data['permit_relative'] = $this->input->post('permit_relative');
            $data['permit_address_number'] = $this->input->post('permit_address_number');
            $data['permit_address_road'] = $this->input->post('permit_address_road');
            $data['permit_address_district'] = $this->input->post('permit_address_district');
            $data['permit_address_area'] = $this->input->post('permit_address_area');
            $data['permit_address_province'] = $this->input->post('permit_address_province');
            $data['permit_address_postal_code'] = $this->input->post('permit_address_postal_code');
            $data['permit_email'] = $this->input->post('permit_email');
            $data['permit_telephone'] = $this->input->post('permit_telephone');
            $data['permit_fax_number'] = $this->input->post('permit_fax_number');
            $data['permit_choice'] = $this->input->post('permit_choice');
            if(!$data['permit_choice']) {
                $data['permit_choice'] = 0;
            }
            $data['student_id'] =  $student_id;
            $data['term_id'] = $this->Login_session->check_login()->term_id;

            //save
            if($this->Coop_Student->save_permit_form_by_student($data)) {
                if($this->input->post('print') == "1") {
                    //print page
                    $this->print_data();
                } else {
                    $this->session->set_flashdata('status', 'success');
                    redirect('Coop_student/Permit_form?');
                }     
            } else {
                $this->session->set_flashdata('status', 'error');
                redirect('Coop_student/Permit_form?');
            }
        } else {
           
           $this->index();
        }
    }

    public function print_data()
    {
        $student_id = $this->Login_session->check_login()->login_value;

        $data['permit'] = @$this->Coop_Student->get_permit_form_by_student($student_id)[0];
        $data['student'] = @$this->Student->get_student($student_id)[0];

        $template_file = 'template/IN-S003.docx';

        $save_filename = "download/".$student_id."-IN-S003-".time().".docx";
        $data_array = [
            "student_fullname_th" => $data['student']['student_prefix']." ".$data['student']['student_fullname'],
            "student_id" => $student_id,
            "student_course" => $data['student']['student_course'],
            "student_department" => $data['student']['department_name'],
            "yes" => "\u{2610}",
            "no" => "\u{2610}",
        ];

        if($data['permit']['permit_choice'] == 1) {
            $data_array['yes'] = "\u{2611}";
        }

        if($data['permit']['permit_choice'] == 0) {
            $data_array['no'] = "\u{2611}";
        }

        $data_array = array_merge($data_array, $data['permit']);
        // print_r($data_array);
        // die();

        $result = $this->service_docx->print_data($data_array, $template_file, $save_filename);

        //insert to db
        $coop_document_id = $this->Form->get_form_by_name('IN-S003', $this->Login_session->check_login()->term_id)[0]['document_id'];
        $word_file = '/uploads/'.basename($save_filename);
        $this->Form->submit_document($student_id, $coop_document_id, NULL, $word_file);


        // redirect(base_url($result['full_url']), 'refresh');
        echo "
            <img src='".base_url('assets/img/loading.gif')."' />
            <script>
                window.location = '".base_url($result['full_url'])."';
                setTimeout(function(){
                    window.location = '".site_url('Coop_student/Upload_document/?code=IN-S003')."';
                }, 1500);
            </script>
        ";

    }


}