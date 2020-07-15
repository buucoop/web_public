<?php
class Officer_model extends CI_model {
    var $officer_id;
    var $first_name;
    var $last_name;
    var $profile_picture;
    
    public function get_officer($officer_id)
    {
        $this->db->where('officer_id',$officer_id);
        $this->db->from('tb_officer');
        $query = $this->db->get();
        return $query->result_array();
    }
}