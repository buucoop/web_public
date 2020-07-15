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
        if($user->login_type != 'coop_student') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
        //add breadcrumbs
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    public function lists()
    {
        $student_id = $this->Login_session->check_login()->login_value;
        $data['coop_student_daily'] = $this->Daily_Report->gets_report_by_student($student_id);
        $this->breadcrumbs->push('กิจกรรมในการฝึกงานในแต่ละวัน', '/Coop_student/Daily_activity/lists');
        $this->template->view('Coop_student/Daily_activity_view',$data);
  
    }
    public function update($activity_id)
    {
        $data['form_type'] = 'update';
        $data['row'] = $this->Daily_Report->get_report($activity_id)[0];
        $this->breadcrumbs->push('กิจกรรมในการฝึกงานในแต่ละวัน', '/Coop_student/Daily_activity/lists');
        $this->breadcrumbs->push('แบบฟอร์มเเก้ไขกิจกรรมฝึกงานในแต่ละวัน', '/Coop_student/Daily_activity/lists/update');
        $this->template->view('Coop_student/Daily_activity_form_view', $data);
    }

    public function post_update()
    {
        $this->form_validation->set_rules('activity_id', 'ID', 'trim|required');
        $this->form_validation->set_rules('activity_subject', 'หัวข้อ', 'trim|required');
        $this->form_validation->set_rules('activity_content', 'รายละเอียด', 'trim|required'); 
        $activity_id = $this->input->post('activity_id');

        if ($this->form_validation->run() != FALSE) {
            $array = array();
            $data = $this->Daily_Report->get_report($activity_id)[0];
            if($data) {
                if($this->Login_session->check_login()->login_value == $data['student_id']) {
                    $array['activity_subject'] = $this->input->post('activity_subject');
                    $array['activity_content'] = $this->input->post('activity_content');

                    $this->Daily_Report->update_report($activity_id, $array);
                } else {
                    echo "<script>alert('not owner')</script>";
                }
            } else {
                //error
                echo "<script>alert('not found data')</script>";
            }
            redirect('Coop_student/Daily_activity/lists', 'refresh');                                  
        } else {
            $this->update($activity_id);
        }

        
        
    }

    public function add() 
    {
        $data['form_type'] = 'insert';
        $this->breadcrumbs->push('กิจกรรมในการฝึกงานในแต่ละวัน', '/Coop_student/Daily_activity/lists/');
        $this->breadcrumbs->push('แบบฟอร์มเพิ่มกิจกรรมฝึกงานในแต่ละวัน', '/');
        $this->template->view('Coop_student/Daily_activity_form_view', $data);
    }

    public function post_add()
    {
        $array = array();

        $this->form_validation->set_rules('activity_subject', 'หัวข้อ', 'trim|required');
        $this->form_validation->set_rules('activity_content', 'รายละเอียด', 'trim|required');
        $this->form_validation->set_rules('activity_date', 'วันที่', 'trim');        

        if ($this->form_validation->run() != FALSE) {
            // insert
            if($this->input->post('activity_date')) {
                $array['activity_date'] = $this->input->post('activity_date');
            } else {
                $array['activity_date'] = date('Y-m-d H:i:s');
            }
            $array['activity_subject'] = $this->input->post('activity_subject');
            $array['activity_content'] = $this->input->post('activity_content');
            $array['student_id'] = $this->Login_session->check_login()->login_value;
            $array['term_id'] = $this->Term->get_current_term()[0]['term_id'];

            $this->Daily_Report->insert_report($array);
            redirect('Coop_student/Daily_activity/lists', 'refresh');  
        } else {
            $this->add();
        }
        

              
    }

    public function datail($activity_id)
    {
       
        $data['coop_student_daily_detail'] = $this->Daily_Report->get_report($activity_id)[0];
        $this->breadcrumbs->push('กิจกรรมในการฝึกงานในแต่ละวัน', '/Coop_student/Daily_activity/lists/',$activity_id);
        $this->breadcrumbs->push('แบบฟอร์มเพิ่มกิจกรรมฝึกงานในแต่ละวัน', '/');
        $this->template->view('Coop_student/Daily_activity_detail_view', $data);
    }

    public function delete($activity_id)
    {
        $data = $this->Daily_Report->get_report($activity_id)[0];
        if($data) {
            //has content
            //check student, owner
            if($this->Login_session->check_login()->login_value == $data['student_id']) {
                //delete
                $this->Daily_Report->delete_report($activity_id);
            }
        }

        redirect('Coop_student/Daily_activity/lists', 'refresh');
    }

}