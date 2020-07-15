<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Train_location extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if(!$this->Login_session->check_login()) {
            $this->session->sess_destroy();
            redirect('member/login');
		}
		
		$user = $this->Login_session->check_login();
        if($user->login_type != 'officer') {
            redirect(ucfirst($this->Login_session->check_login()->login_type).'/main/');
            die();
        }

        $this->breadcrumbs->push(strToLevel($user->login_type), '/'.ucfirst($user->login_type)); //actor
    }

    public function index($status = '')
    {
        if($status == '') {
            $status = $this->session->flashdata('form-alert');
        }
        if($status == 'success_delete' ){
            $data['status']['color'] = 'success';
            $data['status']['text'] = 'ทำการลบสำเร็จ';
        } else if($status == 'success_add' ){
            $data['status']['color'] = 'success';
            $data['status']['text'] = 'เพิ่มสำเร็จ';
        } else if($status == 'success_edit' ){
            $data['status']['color'] = 'success';
            $data['status']['text'] = 'แก้ไขสำเร็จ';
        }  else if($status == 'error_delete' ){
            $data['status']['color'] = 'danger';
            $data['status']['text'] = 'ผิดพลาด โปรดตรวจสอบ';
        } 
        else {
            $data['status'] = '';
        }

        $data['train_locations'] = $this->Training->gets_location();

        // add breadcrumbs
        $this->breadcrumbs->push('จัดการสถานที่อบรม', '/');

        $this->template->view('Officer/Train_location_view',$data);
    }

    public function add($status = '')
    {
        // add breadcrumbs
        $this->breadcrumbs->push('จัดการสถานที่อบรม', '/Officer/Train_location/index');
        $this->breadcrumbs->push('จัดการสถานที่อบรม', '/Officer/Train_location/add');

        $data['form_url'] = site_url('Officer/Train_location/post_add');

        $this->template->view('Officer/Train_location_form_view', $data);
    }

    public function edit($room_id)
    {
        $data['row'] = $this->Training->get_location($room_id)[0];

        // add breadcrumbs
        $this->breadcrumbs->push('จัดการสถานที่อบรม', '/Officer/Train_location/index');
        $this->breadcrumbs->push('จัดการสถานที่อบรม', '/Officer/Train_location/edit'.$room_id);

        $data['form_url'] = site_url('Officer/Train_location/post_edit');
        

        $this->template->view('Officer/Train_location_form_view',$data);
    }    

    public function post_add()
    {
        $return['status'] = false;
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('location_building', 'ชื่อตึก', 'trim|required');
        $this->form_validation->set_rules('location_room', 'ชื่อห้อง', 'trim|required');
        
        if ($this->form_validation->run() != FALSE) {
            $data['location_building'] =  $this->input->post('location_building');
            $data['location_room'] = $this->input->post('location_room');

            $this->Training->insert_location($data);                
            $this->session->set_flashdata('form-alert', 'success_add');
            redirect('Officer/Train_location/', 'refresh');
        } else {
            $this->add();
        }


    }


    public function post_edit()
    {
        $return['status'] = false;
        $return['print'] = false;
                
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('location_building', 'ชื่อตึก', 'trim|required');
        $this->form_validation->set_rules('location_room', 'ชื่อห้อง', 'trim|required');
        $this->form_validation->set_rules('location_id', 'id', 'trim|required|numeric');
        $room_id = $this->input->post('location_id');
        
        if ($this->form_validation->run() != FALSE) {
            $data['location_building'] =  $this->input->post('location_building');
            $data['location_room'] = $this->input->post('location_room');
            
            //save
            if(@$this->Training->get_location($room_id)) {
                //update                
                $this->Training->update_location($room_id, $data);
            }
            $this->session->set_flashdata('form-alert', 'success_edit');
            redirect('Officer/Train_location/', 'refresh');
        } else {
            $this->edit($room_id);
        }


    }

    public function delete()
    {
        //check if exist
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('location_id', 'id', 'trim|required|numeric');
        if ($this->form_validation->run() != FALSE) {
            $location_id = $this->input->post('location_id');            
            if($this->Training->get_location($location_id)) {
                //delete
                $this->Training->delete_location($location_id);
                return $this->index('success_delete');
                die();
            } else {
                return $this->index('error_delete');
                die();
            }
        } else {
            return $this->index('error_delete');
            die();
        }
        
    }

}