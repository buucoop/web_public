<?php
class Skill_model extends CI_model {
    public function insert_skill($array)
    {
        return $this->db->insert('tb_skill',$array);

    }

    public function update_skill($skill_id, $array)
    {
        $this->db->where('skill_id',$skill_id);
        return $this->db->update('tb_skill',$array);

    }

    public function delete_skill($skill_id)
    {
        $this->db->where('skill_id',$skill_id);
        return $this->db->delete('tb_skill');
        
    }

    public function get_skill($skill_id)
    {
        $this->db->where('skill_id',$skill_id);
        $this->db->from('tb_skill'); 
        $query = $this->db->get();
        return $query->result_array();

    }

    public function gets_skill()
    {
        $this->db->from('tb_skill');
        $query = $this->db->get();
        return $query->result_array();
        
    }

    public function check_dup_skill_name($skill_name)
    {
        $this->db->like('skill_name',$skill_name);
        $this->db->from('tb_skill');
        return $this->db->count_all_results();
    }

    public function gets_skill_category()
    {
        $this->db->from('tb_skill_category');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_skill_category_by_id($skill_category_id)
    {
        $this->db->where('skill_category_id', $skill_category_id);
        $this->db->from('tb_skill_category');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_skill_by_category_id($skill_category_id)
    {
        $this->db->where('skill_category_id', $skill_category_id);
        $this->db->from('tb_skill');
        $query = $this->db->get();
        return $query->result_array();
    }
}