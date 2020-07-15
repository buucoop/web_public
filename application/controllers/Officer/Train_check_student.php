<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Train_check_student extends CI_Controller {
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
        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
        
    }

    public function index($status = '')
    {
        if($status == 'error_train_id' ){
            $data['status']['color'] = 'danger';
            $data['status']['text'] = 'ไม่พบโครงการการอบรม';
        } else if($status != '' ){
            $data['status']['color'] = 'danger';
            $data['status']['text'] = $status;
        }  
        else {
            $data['status'] = '';
        }

        $data['data'] = array();
        //get student has test
        foreach($this->Training->gets_training() as $row) {
            //get train_type_id
            $tmp_array = array();
            $tmp_array['train'] = $row;
            $tmp_array['train_type'] = $this->Training->get_type($row['train_type_id']);
            array_push($data['data'], $tmp_array);
        }

        // add breadcrumbs
        $this->breadcrumbs->push('เช็คชื่อเข้าอบรม', '/Officer/Train_check_student/index');

        $this->template->view('Officer/Train_check_student_view',$data);
    }

    public function check()
    {
        //insert
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('train_id', 'โครงการ', 'trim|required|numeric');
        $this->form_validation->set_rules('check_note', 'บันทึกช่วยจำ', 'trim|required');

        if ($this->form_validation->run() != FALSE) {
            if(!$this->Training->get_training($this->input->post('train_id'))) {
                return $this->index('error_train_id');
                die();
            }

            //create train_set_check
            $train_set_check['train_id'] = $this->input->post('train_id');
            $train_set_check['check_note'] = $this->input->post('check_note');
            $train_set_check['check_datetime'] = date('Y-m-d H:i:s');
            
            $train_set_check_id = $this->Training_Check_Student->insert_check($train_set_check);
            $train_set_check_id = $this->db->insert_id();
            redirect('Officer/Train_check_student/check_student/'.$train_set_check_id);
        } else {
            return $this->index(validation_errors());
            die();
        }
    }

    public function check_student($check_id)
    {
        if(!$this->Training_Check_Student->get_check($check_id)) {
            return $this->index('error_train_id');
            die();
        }
        $data['check_id'] = $check_id;   
        $data['training_check_student'] = $this->Training_Check_Student->get_check($check_id)[0];
        $data['train'] = $this->Training->get_training($data['training_check_student']['train_id'])[0];
        $data['total_student'] = count($this->Training->gets_student_register_train($data['training_check_student']['train_id']));


        $this->template->view('Officer/Train_check_student_form_view', $data, [
            base_url('assets/js/officer_js/train_check_student.js')
        ]);
    }

    public function ajax_get()
    {
        //get list
        //check train set
        $return['status'] = false;
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('train_set_check_id', 'train_set_check_id', 'trim|required|numeric');

        if ($this->form_validation->run() != FALSE) {
            $train_set_check_id = $this->input->post('train_set_check_id');
        
            $data['train_set_check'] = @$this->Training_Check_Student->get_check($train_set_check_id);
            if(!@$data['train_set_check']) {
                $return['status'] = false;
            } else {
                $return['status'] = true;
                
                $return['rows'] = array();
                //has
                foreach($this->Training_Check_Student->gets_student_by_check($train_set_check_id) as $row) {
                    $tmp = array();
                    $tmp['train_check'] = $row;
                    $tmp['train_check']['date_check'] = thaiDate($row['train_check_student_date']);
                    $tmp['student']['student_id'] = $row['student_id'];
                    $tmp['student']['student_fullname'] = $row['student_fullname'];
                    
                    array_push($return['rows'], $tmp);
                }
            }
        } else {
            $return['status'] = false;
        }

        echo json_encode($return);

    }

    public function ajax_post()
    {
        $return['status'] = false;
        //post student
        //insert
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('student_code', 'รหัสนิสิต', 'trim|required|numeric');
        $this->form_validation->set_rules('train_set_check_id', 'train_set_check_id', 'trim|required');

        if ($this->form_validation->run() != FALSE) {
            $return['status'] = true; // เช็คสถานะการเช็คชื่อ
            $student_code = $this->input->post('student_code');

            //check barcode
            if(strlen($student_code) > 8) {
                $student_code = substr( substr($student_code, 5), 0, 8 );
            }
            // echo $student_code;

            //check student
            $data['student'] = @$this->Student->get_student($student_code)[0];
            if(!@$data['student']) {
                $return['status'] = false;                
            }

            //check train set
            $data['train_set_check'] = @$this->Training_Check_Student->get_check($this->input->post('train_set_check_id'))[0];
            if(!@$data['train_set_check']) {
                $return['status'] = false;
            }

            //check student_train_register
            if(!@$this->Training->check_student_in_training($data['train_set_check']['train_id'], $student_code)) {
                $return['status'] = false;
            }

            //check train_check_student
            if(@$this->Training_Check_Student->get_student_by_check($student_code, $this->input->post('train_set_check_id'))) {
                $return['status'] = false;
            }

            

            if($return['status']) {
                $return['student'] = $data['student'];                            
                //insert
                // $array['train_id'] = $data['train_set_check']->train_id;
                $array['train_set_check_id'] = $this->input->post('train_set_check_id');                
                $array['student_id'] = $student_code;
                $array['date_check'] = date('Y-m-d H:i:s');
                // $array['term_id'] = $this->Login_session->check_login()->term_id;
                
                $this->Training_Check_Student->add_student($array['student_id'], $array['train_set_check_id']);
                $return['entry_time'] = $array['date_check'];
                $return['status'] = true;            
            }
        } else {
            $return['status'] = false;            
        }

        
        echo json_encode($return);
    }


    function get_train_check_set_by_train($training_id)
    {
        $return = array();
        foreach($this->Training_Check_Student->gets_check($training_id) as $key => $row) {
            $return[] = array(
                'check_id' => (int) $row['check_id'],
                'check_no' => ++$key,
                'check_date' => thaiDate($row['check_datetime']),
                'check_title' => $row['check_note'],
                'check_button' => '<a href="'.site_url('/Officer/Train_check_student/Students/'.$row['check_id']).'" class="btn btn-info"><i class="fa fa-list"></i> รายชื่อนิสิต</a> <a href="'.site_url('/Officer/Train_check_student/check_student/'.$row['check_id']).'" class="btn btn-warning"><i class="fa fa-list"></i> เช็คชื่อนิสิต</a>'
            );
        }

        echo json_encode($return);
    }

    public function students($check_id)
    {
        $data['students'] = [];
        //to pdf
        foreach($this->Training_Check_Student->gets_student_by_check($check_id) as $key => $student) {
            $student_info = $this->Student->get_student($student['student_id'])[0];
            $data['students'][] = array(
                'student_id' => $student['student_id'],
                'student_fullname' => $student_info['student_fullname'],
                // 'student_barcode' => 'http://project.devss.pw/barcode.php?student_id='.$student['student_id'].'',
                'student_barcode' => 'https://barcode.tec-it.com/barcode.ashx?data='.$student['student_id'].'&code=Code128&dpi=96&dataseparator=',
                // 'student_barcode' => 'https://www.barcodesinc.com/generator/image.php?code='.$student['student_id'].'&style=196&type=C128B&width=158&height=100&xres=1&font=3',
            );
        }

        //training info
        //get training id
        $data['train_check_set'] = $this->Training_Check_Student->get_check($check_id)[0];
        $training_id = $data['train_check_set']['train_id'];
        $data['training'] = $this->Training->get_training($training_id)[0];
        $data['training']['train_type'] = $this->Training->get_type($data['training']['train_type_id'])[0];
        $data['training']['train_location'] = $this->Training->get_location($data['training']['train_location_id'])[0];

        $data['training']['note'] = $data['train_check_set']['check_note']." เช็คชื่อเมื่อ: ".thaiDate($data['train_check_set']['check_datetime'], true);
        
        // add breadcrumbs
        $this->breadcrumbs->push('เช็คชื่อเข้าอบรม', '/Officer/Train_check_student/index');
        $this->breadcrumbs->push('รายชื่อนิสิตเข้าร่วมอบรม', '/Officer/training/Students/'.$training_id);

        $data['status'] = [];
        $data['is_uploadform'] = false;
        $this->template->view('Officer/Student_list_report', $data);

    }





}