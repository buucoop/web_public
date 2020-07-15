<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat extends CI_Controller {

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
    public function index(){
        $this->template->view('Teacher/Stat_view');
    }
}