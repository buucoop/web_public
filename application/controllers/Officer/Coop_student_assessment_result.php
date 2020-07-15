<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Coop_student_assessment_result extends CI_Controller {
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
            $data = array();

            // add breadcrumbs
            $this->breadcrumbs->push('รายชื่อนิสิตสหกิจ', '/Officer/Coop_student_assessment_result/index');

            $this->template->view('Officer/Coop_student_assessment_result_list_view', $data);
        }

        public function ajax_list()
        {
            $cache = array();
            // foreach($this->Student->gets_student() as $tmp) {
            //     $cache['student'][$tmp['id']]['fullname'] = $tmp['student_fullname'];
            //     $cache['student'][$tmp['id']]['id'] = $tmp['student_id'];
            // }
            // foreach($this->Job->gets_job() as $tmp) {
            //     $cache['job'][$tmp['job_id']]['job_title'] = $tmp['job_title'];
            // }
            // foreach($this->Company->gets_company() as $tmp) {
            //     $cache['company'][$tmp['company_id']]['company_name_th'] = $tmp['company_name_th'];
            // }
            // foreach($this->Trainer->gets_trainer() as $tmp) {
            //     $cache['trainer'][$tmp['person_id']]['person_fullname'] = $tmp['person_fullname'];
            // }

            $return = array();
            $return['data'] = array();

            foreach($this->Coop_Student->gets_coop_student() as $row) {
                // if(empty($cache['student'][$row['student_id']])) {
                //     continue;
                // }
                // //get student
                $tmp_array = array();
                $tmp_array['student']['student_fullname'] = $row['student_fullname'];
                $tmp_array['student']['student_id'] = $row['student_id'];
                $tmp_array['student']['id_link'] = '<a href="'.site_url('Officer/Students/student_detail/'.$row['student_id']).'">'.$row['student_id'].'</a>';
                $tmp_array['job_position']['job_title'] = $row['job_title'];
                $tmp_array['company']['company_name_th'] = $row['company_name_th'];

                if($row['person_fullname'] == '') {
                    $tmp_array['trainer']['person_fullname'] = ' - ';
                } else {
                    $tmp_array['trainer']['person_fullname'] = $row['person_fullname'];
                }
                
                $tmp_array['button'] = '<a href="'.site_url('Officer/Coop_student_assessment_result/assessment_detail/'.$row['student_id']).'" class="btn btn-info"><i class="fa fa-list-alt"></i> ผลการประเมิน</a>';
                // print_r($tmp_array);
                array_push($return['data'], $tmp_array);
            }
    
            echo json_encode($return['data']);
        }

        public function assessment_detail($student_id)
        {
            $data['student_id'] = $student_id;
            $data['student'] = $this->Student->get_student($data['student_id'])[0];
            $data['data'] = array();
            foreach($this->Coop_Student_Assessment_Form->gets_form_for_coop_student() as $row)
            {
    
                $tmp_array = array();
                $tmp_array['questionnaire_subject'] = $row;
                $tmp_array['questionnaire_item'] = $this->Coop_Student_Assessment_Form->get_coop_student_questionnaire_item_by_subject($row['coop_student_questionnaire_subject_id']);
                array_push($data['data'], $tmp_array);
    
            }
            
            $data['result'] = [];
            $data['sum_score'] = 0;
            $data['total_score'] = 0;
            
            foreach($this->Coop_Student_Assessment_Form->get_coop_student_form_result($student_id) as $result) {
                $data['result'][$result['item_id']] = $result['coop_student_has_coop_student_questionnaire_item_score'];
                $data['sum_score'] += (int) $result['coop_student_has_coop_student_questionnaire_item_score'];
                $data['total_score']++;
            }
            $data['total_score'] = $data['total_score']*5;

		    $data['result_comment'] = @$this->Coop_Student_Assessment_Form->get_coop_student_comment_result($student_id)[0];            
            
                
            // add breadcrumbs
            $this->breadcrumbs->push('รายชื่อนิสิตสหกิจ', '/Officer/Coop_student_assessment_result/index');
            $this->breadcrumbs->push('ผลประเมินนิสิต', '/Officer/Coop_student_assessment_result/assessment_detail');

            $this->template->view('Officer/Coop_student_assessment_result_score_view', $data);
        } 
    
    
    
    }