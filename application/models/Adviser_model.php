<?php
class Adviser_model extends CI_model {
    var $adviser_id;
    var $first_name;
    var $last_name;
    var $profile_picture;
    
    public function insert_adviser($array)
    {
        return $this->db->insert('tb_adviser',$array);

    }

    public function update_adviser($adviser_id, $array) 
    {
        $this->db->where('adviser_id',$adviser_id);
        return $this->db->update('tb_adviser',$array);

    }

    public function delete_adviser($adviser_id)
    {
        $this->db->where('adviser_id',$adviser_id);
        return $this->delete('tb_adviser');

    }

    public function gets_adviser()
    {
        $this->db->from('tb_adviser');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_adviser($adviser_id)
    {
        $this->db->where('adviser_id',$adviser_id);
        $this->db->from('tb_adviser');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function add_coop_student($adviser_id, $student_id)
    {
        $array['adviser_id'] = $adviser_id;
        $this->db->where('student_id',$student_id);
        return $this->db->update('tb_coop_student',$array);

    }

}