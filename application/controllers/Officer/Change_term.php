<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Change_term extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        if($this->Login_session->check_login()->login_type != 'officer') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }
    }

    public function ajax_change()
    {
        $data['term_id'] = $this->input->post('term_id');
                
        $this->load->library('form_validation');
        $this->form_validation->set_rules('term_id', 'term_id', 'required');

        $return['status'] = false;

        if ($this->form_validation->run() != FALSE) {
            $this->Login_session->update($this->Login_session->check_login()->unique_id, $data);
            $return['status'] = true;
        }

        echo json_encode($return);

	} 
}
?>