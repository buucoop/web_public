<?php
class Subject_Report_model extends CI_model 
{
    public function get_report($student_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->from('tb_coop_student_subject_report');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function update($student_id, $array)
    {
        $this->db->where('student_id', $student_id);
        return $this->db->update('tb_coop_student_subject_report', $array);

    }

    public function save($array)
    {
        return $this->db->replace('tb_coop_student_subject_report', $array);

    }



}