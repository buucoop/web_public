<?php
class Report_Form_plan extends CI_controller
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
        $adviser_id = $this->Login_session->check_login()->login_value;
        $data['data'] = $this->Coop_Student->gets_coop_student_by_adviser($adviser_id);

        // add breadcrumbs
        $this->breadcrumbs->push('แบบแจ้งแผนปฎิบัติการสหกิจ', '/Adviser/Report_Form_plan/index');

        $this->template->view('Adviser/Report_Form_plan_list',$data);
    }

    public function student_plan($student_id)
    {
        

        $data['coop_student_plan'] = $this->Coop_Student->get_coop_student_plan($student_id);

        $data['rows'] = $this->Coop_Student->get_coop_student_plan($student_id);

        $data['student'] = $this->Student->get_student($student_id)[0];
        

         // add breadcrumbs
        $this->breadcrumbs->push('แบบแจ้งแผนปฎิบัติการสหกิจ', '/Adviser/Report_Form_plan/index');
        $this->breadcrumbs->push('รายละเอียดแบบแจ้งแผนปฎิบัติการสหกิจ', '/Adviser/Report_Form_plan/title_plan');

        $this->template->view('Adviser/Report_Form_plan_view',@$data);
    }

}