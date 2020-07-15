<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pie_Report extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
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
        $data['term_report'] = $this->Term->get_current_term()[0];
        $data['data'] = array();        
        foreach ($this->Company->gets_company() as $row) {
            $tmp_array = array();
            $tmp_array['company_name'] = $row;
            $tmp_array['count_student'] = count($this->Coop_Student->gets_coop_student_by_company($row['id']));
            
            array_push($data['data'],$tmp_array);
        }
        $data['department_name'] = $this->Student->gets_department();
        //    get all
        // $data['reports'] = $this->get_stat_all($data['term_report']['term_id']);
        $data['current_department'] = array();
        $data['terms'] = $this->Term->gets_term();

        // add breadcrumbs
         print_r($data);
        $this->breadcrumbs->push('สถิติการฝึกงานที่ผ่านมา', '/Adviser/Pie_Report/index');

        $this->template->view('Adviser/Pie_report_view', $data);
    }
 
}