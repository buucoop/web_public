<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Company_assessment_result extends CI_Controller {
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

        // $this->breadcrumbs->unshift('ระบบสหกิจ', '/'); //home
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    
        public function index()
        {   
            // $data = array();
            $data['data'] = array();

            foreach($this->Company->gets_company() as $row) {
                $tmp_array = array();
                $tmp_array = $row;
                $tmp_array['count'] = count($this->Coop_Student->gets_coop_student_by_company($row['company_id']));
                array_push($data['data'], $tmp_array);
            }

            // add breadcrumbs
            $this->breadcrumbs->push('รายชื่อสถานประกอบการ', '/Officer/Company_assessment_result/index');

            $this->template->view('Officer/Company_assessment_result_list_view', $data);
        }


        public function assessment_detail($company_id)
        {

            $data['data'] = array();
            foreach($this->Company_Assessment_Form->gets_form_for_company() as $row)
            {
                $tmp_array = array();
                $tmp_array['questionnaire_subject'] = $row;
                $tmp_array['questionnaire_item'] = $this->Company_Assessment_Form->get_company_questionnaire_item_avg_result_by_subject_and_company($row['coop_company_questionnaire_subject_id'], $company_id);
                if( count($tmp_array['questionnaire_item']) > 0 ) {
                    array_push($data['data'], $tmp_array);
                }
            }

            $data['comment'] = [
                'no4' => '',
                'no5' => '',
                'no6' => [
                    'y' => 0,
                    'n' => 0
                ],
                'no7' => ''
            ];
            // foreach($this->Company_Assessment_Form->get_company_comment_result($company_id) as $comment) {
            //     $data['comment']['no4'] .= $comment['company_has_coop_company_questionnaire_comment_no4']."\n";
            //     $data['comment']['no5'] .= $comment['company_has_coop_company_questionnaire_comment_no5']."\n";
            //     $data['comment']['no7'] .= $comment['company_has_coop_company_questionnaire_comment_no7']."\n";

            //     if($comment['company_has_coop_company_questionnaire_comment_no6'] == "1") {
            //         $data['comment']['no6']['y']++;
            //     } else {
            //         $data['comment']['no6']['n']++;
            //     }
                
                
            // }

            // add breadcrumbs
            $this->breadcrumbs->push('รายชื่อสถานประกอบการ', '/Officer/Company_assessment_result/index');
            $this->breadcrumbs->push('ผลประเมินบริษัท', '/Officer/Company_assessment_result/assessment_detail');

            $this->template->view('Officer/Company_assessment_result_score_view', $data);
        } 
    
    
    
    }