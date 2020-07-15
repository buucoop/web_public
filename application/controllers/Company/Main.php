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
        if($this->Login_session->check_login()->login_type != 'company') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
    }

	public function index()
	{
        $data['rowNews'] = $this->News->gets_news();
        $this->template->view('template/news_view', $data);
    }
    
    public function index2()
	{
        $data['rowNews'] = $this->News->gets_news();
        $this->template->view('template/news_view2', $data);
	}
}  
  