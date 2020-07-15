<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IN_S005 extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		//check priv
        $user = $this->Login_session->check_login();
        if($user->login_type != 'coop_student') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }

        
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

        public function index()
        {
            $status = $this->session->flashdata('status');
            if( $status == 'success'){
                $data['status']['color'] = 'success';            
                $data['status']['text'] = 'บันทึกสำเร็จ';
            }
            else if($status == 'error'){
                $data['status']['color'] = 'warning';            
                $data['status']['text'] = 'ผิดพลาด';
            }
            else {
                $data['status'] = '';
            }
        
            $student_id = $this->Login_session->check_login()->login_value;            
            $data['student'] = $this->Student->get_student($student_id)[0];
            $data['rows'] = $this->Coop_Student->get_coop_student_plan($student_id);
                
            // add breadcrumbs
            $this->breadcrumbs->push('แบบแจ้งแผนปฏิบัติงานสหกิจศึกษา', 'Coop_student/IN_S005_view');
            $this->template->view('Coop_student/IN_S005_view', $data);
        }


        public function save()
        {
            $validForm = false;
            $student_id = $this->Login_session->check_login()->login_value;           
            $term_id = $this->Login_session->check_login()->term_id; 
            $this->Coop_Student->delete_plan($student_id);
            $array_work = array_filter($this->input->post('plan_work_subject'));
            $array_period = array_filter($this->input->post('plan_time_period'));
            
            if( count($array_period) > count($array_work) ) {
                $array_loop = count($array_period);
            } else {
                $array_loop = count($array_work);
            }

            for($i=0;$i<$array_loop;$i++) {
                if(@$array_period[$i] && $array_work[$i] != '') {
                    $insert['term_id'] = $term_id;
                    $insert['plan_work_subject'] = $this->input->post('plan_work_subject')[$i];
                    $insert['plan_time_period'] = implode(",", $this->input->post('plan_time_period')[$i]);
                    if($this->Coop_Student->insert_plan($student_id, $insert)) {
                        $validForm = true;
                    } else {
                        $validForm = false;
                    }
                } else {
                    $validForm = false;
                }
            }

            //save
            if($this->input->post('print') == "1") {
                //print page
                $this->print_data();
            } else {
                $this->session->set_flashdata('status', 'error');
                if($validForm) {
                    $this->session->set_flashdata('status', 'success');
                }

                redirect('Coop_student/IN_S005');
            }     
           
        }

        public function print_data()
        {
            $student_id = $this->Login_session->check_login()->login_value;
    
            $data['coop_student'] = @$this->Coop_Student->get_coop_student($student_id)[0];
            $data['student'] = @$this->Student->get_student($student_id)[0];

            $data['company'] = @$this->Company->get_company($data['coop_student']['company_id'])[0];
            $term_id = $this->Login_session->check_login()->term_id;
            $template_file = "template/IN-S005.docx";
    
            $save_filename = "download/".$student_id."-IN-S005-".time().".docx";
            $data_array = [
                "student_fullname" => $data['student']['student_fullname'],
                "student_id" => $student_id,
                "department_name" => $data['student']['department_name'],
                "company_name" => $data['company']['company_name_th'],
            ];

            $cache_plans = $this->Coop_Student->get_coop_student_plan($student_id);
            for($i=0;$i<count($cache_plans);$i++) {
            // foreach($this->Coop_Student->get_coop_student_plan($student_id) as $i => $row) {
                if(!@$cache_plans[$i]['plan_work_subject']) {
                    $cache_plans[$i]['plan_work_subject'] = ' ';
                }
                
                $tmp_array = [
                    'plan_work_subject' => $cache_plans[$i]['plan_work_subject'],                    
                    'n' => $i,
                    'w1' => '',
                    'w2' => '',
                    'w3' => '',
                    'w4' => '',
                    'w5' => '',
                    'w6' => '',
                    'w7' => '',
                    'w8' => '',
                    'w9' => '',
                    'w10' => '',
                    'w11' => '',
                    'w12' => '',
                    'w13' => '',          
                    'w14' => '',          
                    'w15' => '',          
                    'w16' => ''      
                ];


                if(@$cache_plans[$i]['plan_time_period']) {
                    $choice = explode(",", $cache_plans[$i]['plan_time_period']);
                } else {
                    $choice = [];
                }
                for($K=0;$K<16;$K++) {
                    if(in_array($K, $choice)) {
                        $tmp_array['w'.$K] = "\u{2713}";
                    }
                }

                $tmp_array['n'] = ++$tmp_array['n'];


                $data_array['wl'][] = $tmp_array;
            }
                
            // print_r($data_array);
            // die();
    
            $result = $this->service_docx->print_data($data_array, $template_file, $save_filename);
    
            //insert to db
            $coop_document_id = $this->Form->get_form_by_name('IN-S005', $this->Login_session->check_login()->term_id)[0]['document_id'];
            $word_file = '/uploads/'.basename($save_filename);
            $this->Form->submit_document($student_id, $coop_document_id, NULL, $word_file);
    
    
            // redirect(base_url($result['full_url']), 'refresh');
            echo "
                <img src='".base_url('assets/img/loading.gif')."' />
                <script>
                    window.location = '".base_url($result['full_url'])."';
                    setTimeout(function(){
                        window.location = '".site_url('Coop_student/Upload_document/?code=IN-S005')."';
                    }, 1500);
                </script>
            ";
    
        }

}
