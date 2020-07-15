<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
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

    public function index($status = '')
    {
        if($status == 'success_insert' ) {
            $data['status']['color'] = 'success';
            $data['status']['text'] = 'ทำการเพิ่มสถานประกอบการเรียบร้อย';
        } else if($status == 'error_add' ) {
            $data['status']['color'] = 'danger';
            $data['status']['text'] = 'ผิดพลาด โปรดตรวจสอบ';
        } else if($status == 'error_delete' ) {
            $data['status']['color'] = 'danger';
            $data['status']['text'] = 'ลบไม่สำเร็จ เนื่องจากมีข้อมูลนิสิตอยู่ในบริษัท';
        } else if($status != '' ) {
            $data['status']['color'] = 'success';
            $data['status']['text'] = $status;
        } 
        else {
            $data['status'] = '';
        }

        $data['data'] = $this->Company->gets_company();
    
        // add breadcrumbs
        $this->breadcrumbs->push('จัดการข้อมูลสถานประกอบการ', '/Officer/Company/index');

        $this->template->view('Officer/List_company_view',$data);
    }

    public function company_active()
    {
        $data['data'] = $this->Company->gets_company_active();
        $this->breadcrumbs->push('จัดการข้อมูลสถานประกอบการ', '/Officer/Company/index');

        $this->template->view('Officer/List_company_view',$data);
    }

    public function company_deactive()
    {
        $data['data'] = $this->Company->gets_company_deactive();
        $this->breadcrumbs->push('จัดการข้อมูลสถานประกอบการ', '/Officer/Company/index');

        $this->template->view('Officer/List_company_view',$data);
    }
    
    public function address($company_id){

        $data['data'] = $this->Address->get_address_by_company($company_id)[0];  
        $data['tmp'] = $this->Company->get_company($company_id)[0];  
        $data['contact'] = @$this->Trainer->get_trainer($data['tmp']['contact_person_id'])[0];

        // add breadcrumbs
        $this->breadcrumbs->push('จัดการข้อมูลสถานประกอบการ', '/Officer/Company/index');
        $this->breadcrumbs->push('ที่อยู่สถานประกอบการ', '/Officer/Company/address/'.$company_id);

        $this->template->view('Officer/Address_company_view',$data);
    }


    public function delete($id)
    {
            if(@$this->Company->get_company($id)) {
                //delete
                $this->Company->delete_company($id);
                return $this->index('ซ่อนสำเร็จ');
                die();
            } else {
                return $this->index('ซ่อนไม่สำเร็จ');
                die();
            }
        
    }
    public function show_com_active()
    {

        if ($this->Company->showcompay_active()) {
            return $this->index('โชว์บริษัทที่ไม่ถูกซ่อน');
            die();
        }
        
    }
    public function deleteAll()
    {

        if ($this->Company->deleteAll()) {
            return $this->index('ซ่อนสำเร็จ');
            die();
        }
        
    }

    public function unshow($id)
    {
        if(@$this->Company->get_company($id)) {
            //delete
            $this->Company->unshow_company($id);
            return $this->index('ลบสำเร็จ');
            die();
        } else {
            return $this->index('ลบไม่สำเร็จ');
            die();
        }
    }

    public function undelete($id)
    {
            if(@$this->Company->get_company($id)) {
                //delete
                $this->Company->undelete_company($id);
                return $this->index('โชว์สำเร็จ');
                die();
            } else {
                return $this->index('โชว์ไม่สำเร็จ');
                die();
            }
        
    }

    public function delete_company($id)
    {
        $company_id = $id;
        $get_coop_student = $this->Company->get_by_tb_coop_student($company_id);
        $get_student_register = $this->Company->get_student_register_by_company_id($company_id);
        if($get_coop_student == NULL && $get_student_register == NULL) {
            $this->Company->delete_address($company_id);
            $this->Company->delete_benefit($company_id);
            $this->Company->delete_comment($company_id);
            $this->Company->delete_item($company_id);
            $this->Company->delete_department($company_id);
            $this->Company->delete_com($company_id);
            return $this->index('ลบสำเร็จ');
        } else {
            return $this->index('error_delete');
        }
        // if(@$this->Company->get_by_tb_coop_student($id) == NULL) {
        //     return $this->index('ลบสำเร็จ');
        //     die();
        // } else {
        //     return $this->index('ลบไม่สำเร็จ');
        //     die();
        // }
    }

    public function post_add()
    {
        //insert
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('company_name', 'ชื่อสถานประกอบการ', 'trim|required|is_unique[tb_company.company_name_th]');

        if ($this->form_validation->run() != FALSE) {
            
            $insert['company_name_th'] = $this->input->post('company_name');
            
 
            if($this->Company->insert_company($insert)) {
                // return $this->index('success_insert');
                redirect('/Officer/Company_info/step1/'.$this->db->insert_id(), 'refresh');
                die();
            } else {
                return $this->index('error_add');
                die();
            }
        } else {
            return $this->index(validation_errors());
            die();
        }
    }

    public function Change_pwd_view(){
        $this->template->view('/Officer/Change_pwd_view');
    }

    public function Change_pwd()
    {
        $this->load->model('Change_pwd_model');
        $this->Change_pwd_model->Change_pwd();
        echo "<script>alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว')</script>";
        redirect('http://prepro.informatics.buu.ac.th:8001/index.php/Officer/Company/Change_pwd_view' ,'refresh');

    }
    
}
