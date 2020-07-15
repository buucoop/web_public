<?php
class Training_Check_Student_model extends CI_model {
    
    public function insert_check($array)
    {
        return $this->db->insert('tb_train_set_check',$array);
    }

    public function get_check($check_id)
    {
        $this->db->where('check_id', $check_id);
        $this->db->from('tb_train_set_check');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_check($training_id = 0)
    {
        if($training_id > 0) {
            $this->db->where('train_id', $training_id);
        }
        $this->db->from('tb_train_set_check');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function gets_check_by_training($training_id)
    {
        $this->db->where('train_id',$training_id);
        $this->db->from('tb_train_check_student');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_total_check_by_train($training_id)
    {
        $this->db->where('train_id',$training_id);
        $this->db->from('tb_train_set_check');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_student($student_id, $check_id)
    {
        $train = $this->get_check($check_id);
        $array['train_id'] = $train[0]['train_id'];
        $array['train_set_check_id'] = $check_id;
        $array['student_id'] = $student_id;
        $term = $this->Term->get_current_term();
        $array['term_id'] = $term[0]['term_id'];
        $array['train_check_student_date'] = date('Y-m-d H:i:s');
        return $this->db->insert('tb_train_check_student',$array);
    }

    public function gets_student_by_check($check_id)
    {
        // $this->db->where('train_set_check_id',$check_id);
        // $this->db->from('tb_train_check_student');
        // $query = $this->db->get();
        $sql = "SELECT `tb_student`.`student_id`, `tb_student`.`student_fullname`, `tb_train_check_student`.`train_check_student_date`
        FROM `tb_train_check_student` 
        INNER JOIN `tb_student` ON `tb_student`.`student_id` = `tb_train_check_student`.`student_id`
        WHERE `train_set_check_id` = ".$check_id." AND `tb_student`.`term_id` = `tb_train_check_student`.`term_id` ";

        $query = $this->db->query($sql);
        
        return $query->result_array();
    }


    public function get_student_by_check($student_id, $check_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('train_set_check_id',$check_id);
        $this->db->from('tb_train_check_student');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_student_by_train($student_id, $train_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('train_id',$train_id);
        $this->db->from('tb_train_check_student');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    
}