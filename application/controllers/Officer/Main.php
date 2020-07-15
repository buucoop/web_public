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
        $user = $this->Login_session->check_login();
        if($user->login_type != 'officer') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
        
    }

	public function index()
	{
        $this->breadcrumbs->push('ประกาศข่าวสาร', '/Officer/');
        
        $data['rowNews'] = $this->News->gets_news();
		$this->template->view('Officer/Main_view', $data);
    }
    
    public function change_to_adviser()
    {
        $login_data = $this->Login_session->check_login();        
        $data['user_info'] = $this->BUUMember->get($login_data->login_type, $login_data->login_value)[0];
        if(@$data['user_info']['adviser_is_officer'] == 1) {
            $session_ID = $this->Login_session->set($login_data->login_value, 'adviser');
            if($session_ID) {
                $this->session->set_userdata('session_ID', $session_ID);
                redirect($check_ldap['login_type']);                    
            }
        } else {
            redirect('/Officer');                    
        }
    }
}  
  