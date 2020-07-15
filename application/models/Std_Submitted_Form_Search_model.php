<?php
class Std_Submitted_Form_Search_model extends CI_model {
    public function search_form_by_student($student_id)
    {
        $this->db->where('statudent_id',$student_id);
        $this->db->from('coop_student_has_coop_document');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function search_form_by_code($form_code)
    {
        $this->db->where('coop_document_id',$form_code);
        $this->db->from('coop_student_has_coop_document');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function search_form_by_student_and_code($student_id, $form_code)
    {
        $this->db->where('student_id',$student_id);
        $this->db->where('coop_document_id',$form_code);
        $this->db->from('coop_student_has_coop_document');
        $query = $this->db->get();
        return $query->result_array();
        
    }
}