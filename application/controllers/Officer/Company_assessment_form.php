<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Company_assessment_form extends CI_Controller {
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

        //subject

        public function index($open_modal = false) //get coop student questionaire subject
        {   
            $data['open_modal'] = $open_modal;

            $status = $this->session->flashdata('status');

            if( $status == 'success'){
                $data['status']['color'] = 'success';            
                $data['status']['text'] = 'เพิ่มสำเร็จ';
            } else if( $status == 'error'){
                $data['status']['color'] = 'warning';            
                $data['status']['text'] = 'เลขหัวข้อซ้ำในระบบ';
            }
            else {
                $data['status'] = '';
            }

            $data['company_questionnaire_subject'] = $this->Company_Assessment_Form->gets_form_for_company();
            $data['next_number'] = end($data['company_questionnaire_subject'])['coop_company_questionnaire_subject_number'];
            $data['next_number'] = (int) $data['next_number']+1;

            // add breadcrumbs
            $this->breadcrumbs->push('จัดการแบบฟอร์มประเมินผลสถานประกอบการ', '/Officer/Company_assessment_form/index');

            $this->template->view('Officer/Company_assessment_form_subject_view',$data);
     
        }
        

        public function add_company_questionnaire_subject() //insert coop student questionaire subject
        {
            $this->form_validation->set_rules('number', 'ลำดับหัวข้อ', 'trim|required|numeric|max_length[2]');
            $this->form_validation->set_rules('title', 'ชื่อหัวข้อการประเมิน', 'trim|required');
            
            if ($this->form_validation->run() == FALSE) {
                $this->index(true);
            } else {
                //insert
                $array['coop_company_questionnaire_subject_number'] = $this->input->post('number');
                $array['coop_company_questionnaire_subject_title'] = $this->input->post('title');
                $term_id = $this->Term->get_current_term()[0]['term_id'];
                $array['term_id'] = $term_id; 
            
                if($this->Company_Assessment_Form->check_subject_dup($array['coop_company_questionnaire_subject_number'])) {
                    //is dup, cant insert
                    $this->session->set_flashdata('status', 'error');
                    redirect('Officer/Company_assessment_form/index/', 'refresh');                
                    
                } else {
                    //can insert
                    $this->Company_Assessment_Form->save_company_forms_subject($array);
                    
                    $this->session->set_flashdata('status', 'success');
                    redirect('Officer/Company_assessment_form/index/', 'refresh');                
                }
            }
        }






        //item

        public function get_company_questionnaire_item($subject_id = 0, $open_modal = false, $last_item_id = 0) //get coop student questionaire item ออกมาตาม id
        { 
            $data['open_modal'] = $open_modal;
            $data['last_item_id'] = $last_item_id;
            
            $data['subject'] = $this->Company_Assessment_Form->get_company_questionnaire_subject($subject_id)[0];  

            $data['company_questionnaire_item'] = $this->Company_Assessment_Form->get_company_questionnaire_item_by_subject($subject_id);
            $data['next_number'] = end($data['company_questionnaire_item'])['coop_company_questionnaire_item_number'];
            if($data['next_number'] < 1) {
                $data['next_number'] = $data['subject']['coop_company_questionnaire_subject_number'];
            }
            $data['next_number'] = (float) $data['next_number']+0.1;
           
            $data['form_subject'] = $this->Company_Assessment_Form->gets_form_for_company();

            // add breadcrumbs
            $this->breadcrumbs->push('จัดการแบบฟอร์มประเมินผลสถานประกอบการ', '/Officer/Company_assessment_form/index');
            $this->breadcrumbs->push('จัดการหัวข้อย่อยแบบประเมินผลสถานประกอบการ', '/Officer/Company_assessment_form/get_company_questionnaire_item'.$subject_id);
        
            $this->template->view('Officer/Company_assessment_form_item_view',$data);
        }

        public function add_company_questionnaire_item($subject_id) //insert coop student questionaire item
        {
            // name dup
            $this->form_validation->set_rules('number', 'ลำดับหัวข้อ', 'trim|required|max_length[4]');
            $this->form_validation->set_rules('title', 'ชื่อหัวข้อการประเมิน', 'trim|required');
            $this->form_validation->set_rules('type', 'การให้คะแนน', 'trim|required|in_list[score,comment]');
            $this->form_validation->set_rules('description', 'รายละเอียดหัวข้อ', 'trim');
            
            if ($this->form_validation->run() == FALSE) {
                $this->get_company_questionnaire_item($subject_id, true);

            } else {
                $array['subject_id'] =$this->input->post('subject_id');
                $array['term_id'] = $this->Term->get_current_term()[0]['term_id'];
                $array['coop_company_questionnaire_item_number'] = $this->input->post('number');
                $array['coop_company_questionnaire_item_title'] = $this->input->post('title');
                $array['coop_company_questionnaire_item_type'] = $this->input->post('type');
                $array['coop_company_questionnaire_item_description'] = $this->input->post('description');

                

                if($this->Company_Assessment_Form->check_item_dup($array['coop_company_questionnaire_item_number'], $array['subject_id'])) {
                    //is dup, cant insert
                    echo "<script>alert('xxxxx')</script>";
                } else {
                    //can insert
                    $this->Company_Assessment_Form->insert_company_questionnaire_item($array);
                }

                redirect('Officer/Company_assessment_form/get_company_questionnaire_item/'.$array['subject_id'], 'refresh');

            }


            
        }

        public function delete_company_questionnaire_item($id) //delete coop student questionaire item
        {
            //delete
            $data = @$this->Company_Assessment_Form->get_company_questionnaire_item($id)[0];
            if(!$data) {
                //is dup, cant delete
                echo "<script>alert('ลบสำเร็จ');window.history.back();</script>";
                die();
            } else {
                //can delete
                $this->Company_Assessment_Form->delete_item($id);
            }


            //new sort
            $this->Company_Assessment_Form->sort_item($data['subject_id']);
            

            redirect('Officer/Company_assessment_form/get_company_questionnaire_item/'.$data['subject_id'], 'refresh');
            
            
        }

        public function update_company_questionnaire_item($subject_id)
        {
            //update
            // name dup
            $this->form_validation->set_rules('number', 'ลำดับหัวข้อ', 'trim|required|max_length[4]');
            $this->form_validation->set_rules('title', 'ชื่อหัวข้อการประเมิน', 'trim|required');
            $this->form_validation->set_rules('type', 'การให้คะแนน', 'trim|required|in_list[score,comment]');
            $this->form_validation->set_rules('description', 'รายละเอียดหัวข้อ', 'trim|required');
            $item_id = $this->input->post('item_id');
            
            if ($this->form_validation->run() == FALSE) {
                $this->get_company_questionnaire_item($subject_id, true, $item_id);

            } else {
                $array['coop_company_questionnaire_item_title'] = $this->input->post('title');
                $array['coop_company_questionnaire_item_type'] = $this->input->post('type');
                $array['coop_company_questionnaire_item_description'] = $this->input->post('description');

                $data = @$this->Company_Assessment_Form->get_company_questionnaire_item($item_id)[0];
                if(!$data) {
                    //is dup, cant edit
                    echo "<script>alert('ลบสำเร็จ');window.history.back();</script>";
                    die();
                } else {
                    //can edit
                    $this->Company_Assessment_Form->update_item($item_id, $array);
                }
    
                redirect('Officer/Company_assessment_form/get_company_questionnaire_item/'.$data['subject_id'], 'refresh');
            }
        }

        public function get_ajax_item($id)
        {
            $return['data'] = @$this->Company_Assessment_Form->get_company_questionnaire_item($id)[0];
            echo json_encode($return);
        }
    }
?>
