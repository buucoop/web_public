<?php
class Daily_activity extends CI_controller
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
        $this->breadcrumbs->push('กิจกรรมในการฝึกงานในแต่ละวัน', '/Adviser/Daily_activity/index');
        

        $this->template->view('Adviser/Daily_activity_lists_student_view',$data);
    }

    public function lists($student_id)
    {
       if(!$this->Coop_Student->get_coop_student($student_id)){
           return $this->index();

       }
        $data['student'] = $this->Student->get_student($student_id)[0];
        $data['data'] = $this->Daily_Report->gets_report_by_student($student_id);

        // add breadcrumbs
        $this->breadcrumbs->push('กิจกรรมในการฝึกงานในแต่ละวัน', '/Adviser/Daily_activity/index');
        $this->breadcrumbs->push('รายการกิจกรรมฝึกงาน', '/Adviser/Daily_activity/lists/'.$student_id);

        $this->template->view('Adviser/Daily_activity_list_view',$data);
    }

    public function detail($id)
    {
        $data['data'] = @$this->Daily_Report->get_report($id)[0];

        if(!$data['data']){
            show_404();
        }


        // add breadcrumbs
        $this->breadcrumbs->push('กิจกรรมในการฝึกงานในแต่ละวัน', '/Adviser/Daily_activity/index');
        $this->breadcrumbs->push('รายการกิจกรรมฝึกงาน', '/Adviser/Daily_activity/lists/'.$data['data']['student_id']);
        $this->breadcrumbs->push('รายละเอียดกิจกรรมฝึกงาน', '/Adviser/Daily_activity/detail/'.$id);

        $this->template->view('Adviser/Daily_detail_view',$data);

    }

}