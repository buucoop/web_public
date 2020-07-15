<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IN_S004 extends CI_Controller {
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

        public function index($status = '')
        {
            $status = $this->session->flashdata('status');
    
            if( $status == 'success'){
                $data['status']['color'] = 'success';            
                $data['status']['text'] = 'บันทึกสำเร็จ';
            }
            else if($status == 'error_input'){
                $data['status']['color'] = 'warning';            
                $data['status']['text'] = 'เพิ่มไม่สำเร็จ';
    
            }
            else {
                $data['status'] = '';
            }

            $student_id = $this->Login_session->check_login()->login_value;            
            $data['coop_student'] = @$this->Coop_Student->get_coop_student($student_id)[0];
            $data['company'] = @$this->Company->get_company($data['coop_student']['company_id'])[0];
            $data['company_address'] = @$this->Address->get_address_by_company($data['coop_student']['company_id'])[0];
            $data['company_persons'] = @$this->Trainer->gets_trainer_by_company($data['company']['company_id']);
            $data['company_person'] = @$this->Trainer->get_trainer($data['company']['headoffice_person_id'])[0];
            // $data['contact_person'] = @$this->Trainer->get_trainer($data['company']['contact_person_id'])[0];
            $data['trainer'] = @$this->Trainer->get_trainer($data['coop_student']['trainer_id'])[0];
            $data['student_name'] = @$this->Student->get_student($data['coop_student']['student_id'])[0];
            $data['student_department'] = @$this->Student->get_department($data['student_name']['department_id'])[0];
            $data['company_job_position'] = @$this->Job->get_job($data['coop_student']['job_id'])[0];
            $data['coop_student_dorm'] = @$this->Coop_Student->get_coop_student_dorm_by_student($data['coop_student']['student_id'])[0];
            $data['coop_student_emergency_contact'] = @$this->Coop_Student->get_coop_student_emergency_contact_by_student($student_id)[0];
            $data['profile'] = @$this->Student->get_student_data_from_profile($student_id);
            if(!@$data['coop_student_emergency_contact']){
                $data['coop_student_emergency_contact']['contact_fullname'] = $data['profile']['Contact_Name'];
                $data['coop_student_emergency_contact']['contact_address_number'] = $data['profile']['Contact_Address_Number']; 
                
                $data['coop_student_emergency_contact']['contact_address_district'] = $data['profile']['Contact_Address_Tumbon']; 
                $data['coop_student_emergency_contact']['contact_address_area'] = $data['profile']['Contact_Address_Aumper']; 
                $data['coop_student_emergency_contact']['contact_address_province'] = $data['profile']['Contact_Address_Province']; 
                $data['coop_student_emergency_contact']['contact_address_postal_code'] = $data['profile']['Contact_Address_Postcode']; 
                $data['coop_student_emergency_contact']['contact_telephone'] = $data['profile']['Contact_Phone']; 
                $data['coop_student_emergency_contact']['contact_fax_number'] = $data['profile']['Contact_Email']; 

            }
            // print_r($data);
                
            // add breadcrumbs
            $this->breadcrumbs->push('แบบแจ้งแผนปฏิบัติงานสหกิจศึกษา', 'Coop_student/IN_S005_view');
            $this->template->view('Coop_student/IN_S004_view', $data);
            
        }


        public function save()
        {
            $student_id = $this->Login_session->check_login()->login_value;            
            // print_r($_POST);

            $this->form_validation->set_rules('coop_student_newsletter_receive', 'ตั้งค่ารับข่าวสาร');

            //emergency contact
            $this->form_validation->set_rules('contact_fullname', 'ชื่อ - สกุล', 'trim|required');
            $this->form_validation->set_rules('contact_address_number', 'เลขที่', 'trim|required');
            $this->form_validation->set_rules('contact_address_alley', 'ซอย', 'trim');
            $this->form_validation->set_rules('contact_address_road', 'ถนน', 'trim');
            $this->form_validation->set_rules('contact_address_district', 'แขวง/ตำบล', 'trim|required');
            $this->form_validation->set_rules('contact_address_area', 'เขต/อำเภอ', 'trim|required');
            $this->form_validation->set_rules('contact_address_province', 'จังหวัด', 'trim|required');
            $this->form_validation->set_rules('contact_address_postal_code', 'รหัสไปรษณีย์', 'trim|required|numeric|max_length[5]');
            $this->form_validation->set_rules('contact_telephone', 'เบอร์โทรศัพท์', 'trim|required|numeric|max_length[10]');
            $this->form_validation->set_rules('contact_fax_number', 'เบอร์โทรสาร', 'trim');

            //coop student dorm
            $this->form_validation->set_rules('dorm_name', 'ชื่อหอพัก/อพาร์ทเมนท์', 'trim|required');
            $this->form_validation->set_rules('dorm_room', 'ห้อง', 'trim|required');
            $this->form_validation->set_rules('dorm_number', 'เลขที่', 'trim|required');
            $this->form_validation->set_rules('dorm_alley', 'ซอย', 'trim');
            $this->form_validation->set_rules('dorm_road', 'ถนน', 'trim');
            $this->form_validation->set_rules('dorm_district', 'แขวง/ตำบล', 'trim|required');
            $this->form_validation->set_rules('dorm_area', 'เขต/อำเภอ', 'trim|required');
            $this->form_validation->set_rules('dorm_province', 'จังหวัด', 'trim|required');
            $this->form_validation->set_rules('dorm_postal_code', 'รหัสไปรษณีย์', 'trim|required|numeric|max_length[5]');
            $this->form_validation->set_rules('dorm_telephone', 'เบอร์โทรศัพท์', 'trim|required|numeric|max_length[10]');
            $this->form_validation->set_rules('dorm_fax_number', 'เบอร์โทรสาร', 'trim');
            $this->form_validation->set_rules('trainer_id', 'ผู้นิเทศงาน', 'required|numeric');
            


            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                    $array_emergency_contact = [];
                    $array_emergency_contact['student_id'] = $student_id;
                    $array_emergency_contact['contact_fullname'] = $this->input->post('contact_fullname');
                    $array_emergency_contact['contact_address_number'] = $this->input->post('contact_address_number');
                    $array_emergency_contact['contact_address_alley'] = $this->input->post('contact_address_alley');
                    $array_emergency_contact['contact_address_road'] = $this->input->post('contact_address_road');
                    $array_emergency_contact['contact_address_district'] = $this->input->post('contact_address_district');
                    $array_emergency_contact['contact_address_area'] = $this->input->post('contact_address_area');
                    $array_emergency_contact['contact_address_province'] = $this->input->post('contact_address_province');
                    $array_emergency_contact['contact_address_postal_code'] = $this->input->post('contact_address_postal_code');
                    $array_emergency_contact['contact_telephone'] = $this->input->post('contact_telephone');
                    $array_emergency_contact['contact_fax_number'] = $this->input->post('contact_fax_number');
                    $array['coop_student_newsletter_receive'] = $this->input->post('coop_student_newsletter_receive');
                    $array['trainer_id'] = $this->input->post('trainer_id');

                    $array_coop_student_dorm = [];
                    $array_coop_student_dorm['student_id'] = $student_id;
                    $array_coop_student_dorm['dorm_name'] = $this->input->post('dorm_name');
                    $array_coop_student_dorm['dorm_room'] = $this->input->post('dorm_room');
                    $array_coop_student_dorm['dorm_address_number'] = $this->input->post('dorm_number');
                    $array_coop_student_dorm['dorm_address_alley'] = $this->input->post('dorm_alley');
                    $array_coop_student_dorm['dorm_address_road'] = $this->input->post('dorm_road');
                    $array_coop_student_dorm['dorm_address_district'] = $this->input->post('dorm_district');
                    $array_coop_student_dorm['dorm_address_area'] = $this->input->post('dorm_area');
                    $array_coop_student_dorm['dorm_address_province'] = $this->input->post('dorm_province');
                    $array_coop_student_dorm['dorm_address_postal_code'] = $this->input->post('dorm_postal_code');
                    $array_coop_student_dorm['dorm_telephone'] = $this->input->post('dorm_telephone');
                    $array_coop_student_dorm['dorm_fax_number'] = $this->input->post('dorm_fax_number');
                    
                    

                    $sql_status = false;
                    $sql_status = $this->Coop_Student->save_emergency_contact($array_emergency_contact);
                    $sql_status = $this->Coop_Student->update_coop_student($student_id,$array);
                    $sql_status = $this->Coop_Student->save_coop_student_dorm($array_coop_student_dorm);
                    if($sql_status) {
                        //chek=c if print
                        if($this->input->post('print') == 1){
                            $this->print_data();

                        }else {
                            $this->session->set_flashdata('status', 'success');
                            redirect('Coop_student/IN_S004/index/','refresh');
                        }
                        
                    } else {
                        $this->session->set_flashdata('status', 'error_input');
                        redirect('Coop_student/IN_S004/index/','refresh');
                    }
                    
                
                }
        }

    public function print_data()
    {
        $student_id = $this->Login_session->check_login()->login_value;

        $data['coop_student'] = @$this->Coop_Student->get_coop_student($student_id)[0];
        $data['company'] = @$this->Company->get_company($data['coop_student']['company_id'])[0];
        $data['company_address'] = @$this->Address->get_address_by_company($data['coop_student']['company_id'])[0];
        $data['company_person'] = @$this->Trainer->get_trainer($data['company']['headoffice_person_id'])[0];
        $data['contact_person'] = @$this->Trainer->get_trainer($data['company']['contact_person_id'])[0];
        $data['trainer'] = @$this->Trainer->get_trainer($data['coop_student']['trainer_id'])[0];
        $data['student_name'] = @$this->Student->get_student($data['coop_student']['student_id'])[0];
        $data['company_job_position'] = @$this->Job->get_job($data['coop_student']['job_id'])[0];
        $data['coop_student_dorm'] = @$this->Coop_Student->get_coop_student_dorm_by_student($data['coop_student']['student_id'])[0];
        $data['coop_student_emergency_contact'] = @$this->Coop_Student->get_coop_student_emergency_contact_by_student($student_id)[0];

        $company_address = $data['company_address']['company_address_number']." อาคาร ".
            $data['company_address']['company_address_building']." ซอย ".
            $data['company_address']['company_address_alley']." ถนน ".
            $data['company_address']['company_address_road']." แขวง/ตำบล ".
            $data['company_address']['company_address_district']." เขต/อำเภอ ".
            $data['company_address']['company_address_area']." จังหวัด ".
            $data['company_address']['company_address_province']." ".
            $data['company_address']['company_address_postal_code'] ;
            
        $template_file = "template/IN-S004.docx";        

        $save_filename = "download/".$student_id."-IN-S004-".time().".docx";
        $data_array = [
            "company_name_th" => $data['company']['company_name_th'],
            "company_address" => $company_address,
            "company_telephone" => $data['company_person']['person_telephone'],
            "company_fax_number" => $data['company_person']['person_fax_number'],
            "company_email" => $data['company_person']['person_email'],
            "company_person_fullname" => $data['company_person']['person_fullname'],
            "company_person_position" => $data['company_person']['person_position'],
            "contact_person_fullname" => $data['contact_person']['person_fullname'],
            "contact_person_position" => $data['contact_person']['person_position'],
            "contact_person_department" => $data['contact_person']['person_department'],
            "contact_person_telephone" => $data['contact_person']['person_telephone'],
            "contact_person_fax_number" => $data['contact_person']['person_fax_number'],
            "contact_person_email" => $data['contact_person']['person_email'],

            "cn_a" => "\u{2610}",
            "cn_b" => "\u{2610}",

            "trainer_fullname" => $data['trainer']['person_fullname'],
            "trainer_position" => $data['trainer']['person_position'],
            "trainer_dapartment" => $data['trainer']['person_department'],
            "trainer_telephone" => $data['trainer']['person_telephone'],
            "trainer_fax_number" => $data['trainer']['person_fax_number'],
            "trainer_email" => $data['trainer']['person_email'],
            "student_name_fullname" => $data['student_name']['student_fullname'],
            "student_name_id" => $data['student_name']['student_id'],
            "student_department_name" => $data['student_name']['department_name'],
            "student_faculty" => 'คณะวิทยาการสารสนเทศ',
            "company_job_position_title" => $data['company_job_position']['job_title'],
            "company_job_job_description" => $data['company_job_position']['job_description'],
            "coop_student_dorm_name" => $data['coop_student_dorm']['dorm_name'],
            "copp_student_dorm_room" => $data['coop_student_dorm']['dorm_room'],
            "coop_student_dorm_number" => $data['coop_student_dorm']['dorm_address_number'],
            "coop_student_dorm_alley" => $data['coop_student_dorm']['dorm_address_alley'],
            "coop_student_road" => $data['coop_student_dorm']['dorm_address_road'],
            "coop_student_dorm_district" => $data['coop_student_dorm']['dorm_address_district'],
            "coop_student_dorm_area" => $data['coop_student_dorm']['dorm_address_area'],
            "coop_student_dorm_province" => $data['coop_student_dorm']['dorm_address_province'],
            "coop_student_dorm_postal_code" => $data['coop_student_dorm']['dorm_address_postal_code'],
            "coop_student_dorm_telephone" => $data['coop_student_dorm']['dorm_telephone'],
            "coop_student_dorm_fax_number" => $data['coop_student_dorm']['dorm_fax_number'],
            "emergency_contact_fullname" => $data['coop_student_emergency_contact']['contact_fullname'],
            "emergency_contact_number" => $data['coop_student_emergency_contact']['contact_address_number'],
            "emergency_contact_alley" => $data['coop_student_emergency_contact']['contact_address_alley'],
            "emergency_contact_road" => $data['coop_student_emergency_contact']['contact_address_road'],
            "emergency_contact_district" => $data['coop_student_emergency_contact']['contact_address_district'],
            "emergency_contact_area" => $data['coop_student_emergency_contact']['contact_address_area'],
            "emergency_contact_province" => $data['coop_student_emergency_contact']['contact_address_province'],
            "emergency_contact_postal_code" => $data['coop_student_emergency_contact']['contact_address_postal_code'],
            "emergency_contact_telephone" => $data['coop_student_emergency_contact']['contact_telephone'],
            "emergency_contact_fax_number" => $data['coop_student_emergency_contact']['contact_fax_number'],

            "yes_1" => "\u{2610}",
            "yes_2" => "\u{2610}",
            "no" => "\u{2610}",

        ];

        $data_array['map_image'] = 'http://maps.googleapis.com/maps/api/staticmap?zoom=13&size=600x450&maptype=roadmap&markers=color:blue%7Clabel:*%7C'.$data['company_address']['company_address_latitude'].','.$data['company_address']['company_address_longitude'].'';


        if($data['company']['headoffice_person_id'] == $data['company']['contact_person_id']) {
            $data_array['cn_a'] = "\u{2611}";
        }else{
            $data_array['cn_b'] = "\u{2611}";
        }

        if($data['coop_student']['coop_student_newsletter_receive'] == 1) {
            $data_array['yes_1'] = "\u{2611}";
        }else if($data['coop_student']['coop_student_newsletter_receive'] == 2) {
            $data_array['yes_2'] = "\u{2611}";
        }else{
            $data_array['no'] = "\u{2611}";
        }
 
       
        // print_r($data_array);
        // die();

        $result = $this->service_docx->print_data($data_array, $template_file, $save_filename);
        // print_r($result);
        // redirect(base_url($result['full_url']), 'refresh');

        //insert to db
        $coop_document_id = $this->Form->get_form_by_name('IN-S004', $this->Login_session->check_login()->term_id)[0]['document_id'];
        $word_file = '/uploads/'.basename($save_filename);
        $this->Form->submit_document($student_id, $coop_document_id, NULL, $word_file);


        // redirect(base_url($result['full_url']), 'refresh');
        echo "
            <img src='".base_url('assets/img/loading.gif')."' />
            <script>
                window.location = '".base_url($result['full_url'])."';
                setTimeout(function(){
                    window.location = '".site_url('Coop_student/Upload_document/?code=IN-S004')."';
                }, 1500);
            </script>
        ";


    }

    public function ajax_save_trainer()
    {
        $data = array();
        $data['status'] = false;
        $data['text'] = 'ผิดพลาด';
        $data['color'] = 'warning';
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname','ชื่อ-นามสกุล','required');
        $this->form_validation->set_rules('position','ตำเเหน่ง','required');
        $this->form_validation->set_rules('department','เเผนกงาน','required');
        $this->form_validation->set_rules('telephone','เบอร์โทร','required|numeric');
        $this->form_validation->set_rules('fax_number','FAX');
        $this->form_validation->set_rules('email','E-mail','required|valid_email|is_unique[company_person.email]');

        if($this->form_validation->run() != false){

            $company_person = @$this->Trainer->get_trainer_by_email($this->input->post('email'))[0];
            if($company_person) {
                $data['text'] = 'มีพนักงานนิเทศงานอยู่แล้ว โปรดเลือกจากรายชื่อ';
            } else {

                $password_gen = generateStrongPassword(8);
                $password_gen_db = password_hash($password_gen, PASSWORD_DEFAULT);

                $student_id = $this->Login_session->check_login()->login_value;
                $coop_student = @$this->Coop_Student->get_coop_student($student_id)[0];

                $array['company_id'] = $coop_student['company_id'];

                $array['fullname'] = $this->input->post('fullname');
                $array['position'] = $this->input->post('position');
                $array['department'] = $this->input->post('department');
                $array['telephone'] = $this->input->post('telephone');
                $array['fax_number'] = $this->input->post('fax_number');
                $array['email'] = $this->input->post('email');
                $array['person_username'] = $array['email'];

                $array['person_password'] = $password_gen_db;
                
                $this->Trainer->insert_trainer($array);
                $data['last_id'] = $this->db->insert_id();

                $to = $array['person_email'];
                $subject = 'แจ้งข้อมูลเข้าใช้งานระบบสหกิจศึกษา มหาวิทยาลัยบูรพา';
                $msg = 'Username: '.$array['person_username'].' | Password: '.$password_gen.' | '.site_url();
                //sentmail here
                $this->load->library('email');
                $this->email->from('buu.coopsystem@gmail.com', 'Informatics CoOp');
                $this->email->to($array['person_email']);
                $this->email->subject('แจ้งรายละเอียดข้อมูลเข้าระบบสหกิจ');
                $this->email->message($msg);
                $this->email->send();
                // echo $this->email->print_debugger();


                // $this->cache->file->save('userpass_'.$data['last_id'], $msg, 86400*365);

                $data['status'] = true;
                $data['text'] = 'ระบบได้ส่ง username / password ไปที่ email ที่กรอกมาเรียบร้อยค่ะ';
                $data['color'] = 'success';
            }
            
        } else {
            $data['text'] = strip_tags(validation_errors());
            
        }

        echo json_encode($data);
    }


            


}
