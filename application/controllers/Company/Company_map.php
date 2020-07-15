<?php
class Company_map extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        //check session
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
        }

        //check priv
        $user = $this->Login_session->check_login();
        if($user->login_type != 'company') {
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

        $tmp = $this->Trainer->get_trainer($this->Login_session->check_login()->login_value)[0];

        $company_id = $tmp['company_id'];

        $data['map'] = @$this->Address->get_address_by_company($company_id)[0];
        $this->breadcrumbs->push('ปักหมุดแผนที่สถานประกอบการ', '/Company/Company_map');
        $this->template->view('Company/Map_view', $data);
    }

    public function ajax_post()
    {
        $this->form_validation->set_rules('company_address_latitude', 'ละติจูด', 'required|decimal');
        $this->form_validation->set_rules('company_address_longitude', 'ลองติจูด', 'required|decimal');

        $arr = array(
            'status' => false,
            'txt' => 'err',            
        );

        if ($this->form_validation->run() != FALSE) {
            $insert['company_address_latitude'] = $this->input->post('company_address_latitude');
            $insert['company_address_longitude'] = $this->input->post('company_address_longitude');

            $tmp = $this->Trainer->get_trainer($this->Login_session->check_login()->login_value)[0];
            $company_id = $tmp['company_id'];

            if($this->Address->update_address($company_id, $insert)) {
                // echo $this->db->last_query();
                $arr['status'] = true;
                $arr['txt'] = 'ok';            
            }
        }
        
        echo json_encode($arr);
    }

    public function update()
    {
        // get
        $student_id = $this->Login_session->check_login()->login_value;

        $this->form_validation->set_rules('company_address_latitude', 'ละติจูด', 'required|decimal');
        $this->form_validation->set_rules('company_address_longitude', 'ลองติจูด', 'required|decimal');

        if ($this->form_validation->run() != FALSE) {
            $tmp = $this->Trainer->get_trainer($this->Login_session->check_login()->login_value)[0];
            $company_id = $tmp['company_id'];
            // update
            $array['company_address_latitude'] = $this->input->post('company_address_latitude');
            $array['company_address_longitude'] = $this->input->post('company_address_longitude');
            $this->Address->update_address($company_id, $array);
            $this->session->set_flashdata('status', 'success');
            redirect('Company/Company_map/index/','refresh');
        } else {
            $this->session->set_flashdata('status', 'error');            
            redirect('Company/Company_map/index/','refresh');
        }
        
    }


}