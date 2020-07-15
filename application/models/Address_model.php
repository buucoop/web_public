<?php
class Address_model extends CI_model {
    public function get_address_by_company($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->from('tb_company_address');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_address() 
    {
        $this->db->from('tb_company_address');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_address($array) 
    {
        return $this->db->insert('tb_company_address',$array);
    }

    public function update_address($company_id, $array)
    {
        $this->db->where('company_id', $company_id);
        $this->db->from('tb_company_address');
        $query = $this->db->get();
        if(count($query->result_array()) > 0) {
            //update
            $this->db->where('company_id', $company_id);            
            return $this->db->update('tb_company_address',$array);            
        } else {
            //insert
            $array['company_id'] = $company_id;
            return $this->db->insert('tb_company_address', $array);            
        }  
    }

    public function delete_address($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->delete('tb_company_address');

    }

}