<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        $user = $this->Login_session->check_login();
        if($user->login_type != 'student') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
      
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    // public function register()
    // {
    //     $data['data'] = array();
    //     foreach($this->Training->get_current_register_period() as $row) {
    //         $row['train_type'] = $this->Training->get_type($row['train_type_id'])[0]['name'];
            
    //         array_push($data['data'], $row);
    //     }
    //     $this->breadcrumbs->push('สมัครเข้าร่วมอบรม', '/Student/Training/register');
    //     $this->template->view('Student/Train_register_view',$data);
        
    // }
    
    public function check_hour(){
        $student_id = $this->Login_session->check_login()->login_value;

        $train_type = $this->Training->get_student_stat_of_training($student_id)['train_type'];
        $data['train_type'] = array();
        foreach($train_type as $type) {
            $tmp['name'] = $type['train_type_name'];
            $tmp['total_hour'] = $type['train_type_total_hour'];
            $tmp['check_hour'] = 0;
            //calc total hour
            foreach($type['history'] as $history) {
                $tmp['check_hour'] += $history['check_hour'];
            }

            array_push($data['train_type'], $tmp);
        }

        // $data['train_type'] = $this->Training->gets_type();
        $this->breadcrumbs->push('ตรวจสอบชั่วโมงการอบรมทั้งหมด', '/Student/Training/check_hour');
        $this->template->view('Student/Check_hour_view', $data);
    }

    public function check_history(){
        $student_id = $this->Login_session->check_login()->login_value;

        $data = $this->Training->get_student_stat_of_training($student_id);
        
        //add breadcrumbs
        $this->breadcrumbs->push('ตรวจสอบประวัติการอบรม', '/Student/Training/check_history');
        $this->template->view('Student/Check_history_view', $data);
    }

   
}
