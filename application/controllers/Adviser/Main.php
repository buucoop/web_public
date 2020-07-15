<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        if($this->Login_session->check_login()->login_type != 'adviser') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
    }

	public function index()
	{
        $data['rowNews'] = $this->News->gets_news();
        $data['exam_reminder'] = $this->Coop_Student->gets_oral_exam_date_by_adviser($this->Login_session->check_login()->login_value);

		$this->template->view('Adviser/News_view', $data);
    }
    
    public function change_to_officer()
    {
        $login_data = $this->Login_session->check_login();        
        $data['user_info'] = $this->BUUMember->get($login_data->login_type, $login_data->login_value)[0];
        if($data['user_info']['adviser_is_officer'] == 1) {
            $session_ID = $this->Login_session->set($login_data->login_value, 'officer');
            if($session_ID) {
                $this->session->set_userdata('session_ID', $session_ID);
                redirect('/Officer');                    
            }
        } else {
            redirect('/Adviser');                    
        }
    }
}  
  