<?php
class Coop_student extends CI_controller
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
        $this->breadcrumbs->push('รายชื่อนิสิตในสังกัด', '/Adviser/Coop_student/index');


        $this->template->view('Adviser/Coop_student_view',$data);
    }


    public function exam_score()
    {
        $adviser_id = $this->Login_session->check_login()->login_value;
        $data['data'] = $this->Coop_Student->gets_coop_student_by_adviser($adviser_id);

        // print_r($data);
        // add breadcrumbs
        $this->breadcrumbs->push('คะแนนสอบนิสิตในที่ปรึกษา', '/Adviser/Coop_student/index');

        $this->template->view('Adviser/Coop_student_exam_view.php',$data);
    }

    public function post_exam_score()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('coop_student_adviser_score', 'coop_student_adviser_score', 'required|trim|numeric');
        $this->form_validation->set_rules('student_id', 'student_id', 'required|trim|numeric');
    
        $return = [
            'status' => false,
            'sum_score' => 0,
            'student_id' => 0,
        ];
    
        if ($this->form_validation->run() != FALSE) {
            $this->Coop_Student->update_coop_student($this->input->post('student_id'), [
                'coop_student_adviser_score' => $this->input->post('coop_student_adviser_score')
            ]);
            $return['status'] = true;
            $return['student_id'] = $this->input->post('student_id');
            $return['sum_score'] = $this->Coop_Student->get_coop_student($return['student_id'])[0]['coop_student_sum_score'];
            
        }
    
        echo json_encode($return);
    
    }
}