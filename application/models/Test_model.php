<?php
class Test_model extends CI_model {
    public function gets_test() 
    {
        $this->db->where('term_id', $this->Term->get_current_term()[0]['term_id']);        
        $this->db->from('tb_coop_test');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_test($test_id)
    {
        $this->db->where('id',$test_id);
        $this->db->from('tb_coop_test');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function insert_test($array)
    {
        return $this->db->insert('tb_coop_test',$arrray);

    }

    public function update_test($test_id, $array)
    {
        $this->db->where('id',$test_id);
        return $this->db->update('tb_coop_test',$array);

    }

    public function get_test_result_by_student($student_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->from('tb_student_register_coop_test');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_test_pass_by_student($student_id)
    {
        $this->db->where('coop_test_status', 1);
        $this->db->where('student_id', $student_id);
        $this->db->from('tb_student_register_coop_test');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_student($student_id, $test_id)
    {
        $array['coop_test_id'] = $test_id;
        $term = $this->Term->get_current_term();
        $array['coop_test_term_id'] = $term[0]['term_id'];
        $array['student_id'] = $student_id;
        $array['student_term_id'] = $term[0]['term_id'];
        $array['coop_test_status'] = 0;
        return $this->db->insert('tb_student_register_coop_test',$array);

    }

    public function delete_student($student_id, $test_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('coop_test_id',$test_id);
        return $this->db->delete('tb_student_register_coop_test');

    }

    public function get_test_result_by_test($test_id)
    {
        $this->db->where('coop_test_id',$test_id);
        $this->db->from('tb_student_register_coop_test');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function add_test_result_by_student($student_id, $test_id, $result)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('coop_test_id',$test_id);
        $array['coop_test_status'] = $result;
        return $this->db->update('tb_student_register_coop_test',$result);
        
    }

    public function get_student_by_test_and_student($student_id, $test_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('coop_test_id',$test_id);
        $this->db->from('tb_student_register_coop_test');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_student_by_test($test_id)
    {
        $this->db->where('coop_test_id',$test_id);
        $this->db->from('tb_student_register_coop_test');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function check_student($student_id,$coop_test_id){
        $this->db->where('student_id',$student_id);
        $this->db->where('coop_test_id',$coop_test_id);
        $this->db->from('tb_student_register_coop_test');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_open_register()
    {
        $this->db->where('term_id', $this->Login_session->check_login()->term_id);
        $this->db->where('register_status', '1');
        $this->db->order_by('name', 'ASC');
        $this->db->from('tb_coop_test');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_student_to_test($array)
    {
        return $this->db->insert('tb_student_register_coop_test',$array);
    }
}