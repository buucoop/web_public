<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// coop_student
class News extends CI_Controller {

	public function view($news_id=17)
	{


		if($news_id == ''){
			redirect('Member/login/');
		}else{
			$data['row'] = $this->News->get_news($news_id);
			if(!$data['row']) {
				redirect('Member/login/');				
			}
			$data['row'] = $data['row'][0];

			preg_match_all('/(alt|title|src)=("[^"]*")/i', $data['row']['news_detail'], $result);

			$data['cover_image'] = str_replace('"', '', @$result[2][0]);
			if($data['cover_image'] == '') {
				$data['cover_image'] = base_url('assets/img/new_logo.png');
			}
			$this->load->view('template/news_index_view', $data);
		}
		
	}
	public function company_status_id1()
    {

        $tmp = $this->Trainer->get_trainer($this->Login_session->check_login()->login_value)[0];
        $company_id = $tmp['company_id'];
        $data['trainer_id'] = $tmp['person_id'];
        $data['company_status_Type'] = $this->Job->gets_company_status_type();
        // print_r($this->Job->get_student_by_company_id($data['trainer_id']));
        $this->breadcrumbs->push('รายละเอียดเกี่ยวกับสถานประกอบการ ', '/Company/Job_list_position/company_status_id1');
        $this->template->view('company/Company_status_id1_view', $data);
    }
}  
  