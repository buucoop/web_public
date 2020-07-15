<?php

class Member extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		//check priv
       
      
    }

    public function login()
    {
        $user = $this->Login_session->check_login();
        // print_r($user);
        if(@$user->login_type) {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }

        
        $data['status'] = $this->session->flashdata('status');
        $this->load->view('login/login_view.php', $data);
    }

    public function post_login() 
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //company login
            $member = $this->Trainer->login($username, $password);
            if($member) {
                $session_ID = $this->Login_session->set($username, 'company', $member['person_fullname']);
                if($session_ID) {
                    redirect('Company/main/index');                    
                }
            }
        } else {
            //ldap login
            $check_ldap = $this->BUUMember->login($username, $password);
            if($check_ldap) {
                $session_ID = $this->Login_session->set($check_ldap['login_value'], $check_ldap['login_type'], $check_ldap['user_fullname']);
                if($session_ID) {
                    $this->session->set_userdata('session_ID', $session_ID);
                    redirect(ucfirst($check_ldap['login_type']).'/main/index');
                }
            }
        }

        $this->session->set_flashdata('status', 'error');
        redirect('member/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('member/login');
    }
}