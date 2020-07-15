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
        if($user->login_type != 'adviser') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }

        
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    public function index()
    {
        // $data['company'] = $this->DB_company->gets();
        $data['company'] = '';

        // add breadcrumbs
        $this->breadcrumbs->push('แผนที่ตั้งบริษัท', '/Adviser/Company_map/index');

        $this->template->view('Adviser/Map_list_view', $data);
    }

    public function ajax_post()
    {
        $data = array();
        $data['data'] = array();
        foreach($this->input->post('company_id') as $company_id) {
            //get map
            $tmp_array['company'] = $this->DB_company->get($company_id);            
            $tmp_array['company_address'] = $this->DB_company_address->get($company_id);

            

            array_push($data['data'], $tmp_array);
        }

        echo json_encode($data);
    }


}