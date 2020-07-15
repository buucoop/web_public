<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Coop_student_assessment extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        $user = $this->Login_session->check_login();
        if($user->login_type != 'adviser') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }

        
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

        public function index()
        {
            $adviser_id = $this->Login_session->check_login()->login_value;
            $data['data'] = $this->Coop_Student->gets_coop_student_by_adviser($adviser_id);

                // add breadcrumbs
                $this->breadcrumbs->push('การประเมินผลการฝึกงานของนักศึกษา', '/Adviser/Coop_student_assessment/index');

                $this->template->view('Adviser/Coop_student_assessment_list_view',$data);
          
        }

        public function form($student_id)
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

		    $data['result_comment'] = @$this->Coop_Student_Assessment_Form->get_coop_student_comment_result($student_id)[0];            

            // $data['result'] = [];
            // foreach($this->Coop_Student_Assessment_Form->get_coop_student_form_result($student_id) as $result) {
            //     $data['result'][$result['item_id']] = $result['coop_student_has_coop_student_questionnaire_item_score'];
            // }

            // $data['result'] = [];
            // $data['sum_score'] = 0;
            // $data['total_score'] = 0;
            
            // foreach($this->Coop_Student_Assessment_Form->get_coop_student_form_result($student_id) as $result) {
            //     $data['result'][$result['item_id']] = $result['coop_student_has_coop_student_questionnaire_item_score'];
            //     $data['sum_score'] += (int) $result['coop_student_has_coop_student_questionnaire_item_score'];
            //     $data['total_score']++;
            // }
            // $data['total_score'] = $data['total_score']*5;

            foreach($this->Coop_Student_Assessment_Form->get_coop_student_form_result($student_id) as $result) {
                $data['result'][$result['item_id']] = $result['coop_student_has_coop_student_questionnaire_item_score'];
                // $data['sum_score'] += (int) $result['coop_student_has_coop_student_questionnaire_item_score'];
                // $data['total_score']++;
            }
            // $data['total_score'] = $data['total_score']*5;
            // $data['sum_score'] = 10;

            $data['sum_score'] = $data['result_comment']['coop_student_has_coop_student_questionnaire_comment_totalscore'];
            // print_r($data);
                
            // add breadcrumbs
            $this->breadcrumbs->push('การประเมินผลการฝึกงานของนักศึกษา', '/Adviser/Coop_student_assessment/index');
            $this->breadcrumbs->push('แบบการประเมินผลการฝึกงานของนิสิตสหกิจ', '/Adviser/Coop_student_assessment/form');

            $this->template->view('Adviser/Coop_student_assessment_form_view', $data);
        }

}