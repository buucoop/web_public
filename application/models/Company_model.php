<?php
class Company_model extends CI_model {
    public function insert_company($array)
    {
        return $this->db->insert('tb_company',$array);

    }

    public function delete_company($company_id)
    {
        $this->db->where('company_id',$company_id);
        return $this->db->update('tb_company', [
            'company_status' => 'deactive'
        ]);

    }

    //////

    public function delete_address($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->delete('tb_company_address');
    }
    public function delete_benefit($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->delete('tb_company_benefit');
    }
    public function delete_comment($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->delete('tb_company_has_coop_company_questionnaire_comment');
    }
    public function delete_item($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->delete('tb_company_has_coop_company_questionnaire_item');
    }
    public function delete_department($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->delete('tb_company_has_department');
    }
    public function delete_com($company_id)
    {
        $this->db->where('company_id', $company_id);
        return $this->db->delete('tb_company');
    }

    /////


    public function showcompay_active()
    {
        $sql = "SELECT * from tb_company where company_status = 'active'";
        $query = $this->db->query($sql);
        return  $query->result_array();
    }


    public function deleteAll()
    {
        $sql = "UPDATE tb_company SET company_status = 'deactive'";
        return $this->db->query($sql);

    }

    public function undelete_company($company_id)
    {
        $this->db->where('company_id',$company_id);
        return $this->db->update('tb_company', [
            'company_status' => 'active'
        ]);

    }

    public function unshow_company($company_id)
    {
        $this->db->where('company_id',$company_id);
        return $this->db->update('tb_company', [
            'company_show' => '0'
        ]);

    }

    public function delete_company_delete($company_id)
    {
        $this->db->where('company_id',$company_id);
        return $this->db->delete('tb_company');

    }    


    public function update_company($company_id, $array)
    {
        $this->db->where('company_id',$company_id);
        return $this->db->update('tb_company',$array);
    }

    public function get_benefit_by_company($company_id)
    {
        $sql = "select benefit_wage_period , benefit_dorm_period , benefit_shuttlebus_period , benefit_other from tb_company_benefit where company_id = $company_id";
        $query = $this->db->query($sql);
        return $query->result_array();
        
    }

    public function get_by_tb_coop_student($company_id)
    {
        $this->db->where('company_id',$company_id);
        $this->db->from('tb_coop_student');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_student_register_by_company_id($company_id)
    {
        $this->db->where('company_id',$company_id);
        $this->db->from('tb_student_register_company_job_position');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_company()
    {
        $this->db->from('tb_company');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function gets_company_active()
    {
        $status = 'active';
        $this->db->where('company_status' ,$status);
        $this->db->from('tb_company');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function gets_company_deactive()
    {
        $status = 'deactive';
        $this->db->where('company_status' ,$status);
        $this->db->from('tb_company');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function gets_company_by_student()
    {
        $status = 'active';
        $this->db->where('company_status' ,$status);
        $this->db->from('tb_company');
        $query = $this->db->get();
        return $query->result_array();

    }


    public function gets_company_has_coop_student()
    {
        $query = $this->db->query('SELECT company_id, company_name_th FROM `tb_company` WHERE `company_id` in (select `company_id` from `tb_coop_student`)');
        return $query->result_array();

    }

    public function gets_company_has_coop_student2($company_checked_id)
    {
        $query = $this->db->query('SELECT * FROM tb_company WHERE company_id ='.$company_checked_id);
        return $query->result_array();

    }    

    public function get_company($company_id)
    {
        $this->db->where('company_id',$company_id);
        $this->db->from('tb_company');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_companys($company_id)
    {
        $status = 'active';
        $this->db->where('company_status' ,$status);
        $this->db->where('company_id',$company_id);
        $this->db->from('tb_company');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_company_status_type()
    {
        $this->db->where('company_status_id !=', 5);        
        $this->db->from('tb_company_status');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_benefit($company_id, $array)
    {
        $array['company_id'] = $company_id;
        return $this->db->replace('tb_company_benefit',$array);
    }

    public function get_benefit($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->from('tb_company_benefit');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_company_has_department($company_id, $department_id) 
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];
        return $this->db->replace('tb_company_has_department', [
            'company_id' => $company_id,
            'department_id' => $department_id,
            'term_id' => $term_id
        ]);
    }

    public function get_company_has_department($company_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];
        $this->db->where('term_id', $term_id);
        $this->db->where('company_id', $company_id);
        $this->db->from('tb_company_has_department');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_company_has_address()
    {
         $query = $this->db->query("select
            tb_company_address.company_id,
            tb_company_address.company_address_latitude,
            tb_company_address.company_address_longitude,
            tb_company.company_name_th
            from tb_company_address
            JOIN tb_company on tb_company_address.company_id = tb_company.company_id
            WHERE company_address_latitude IS NOT NULL");
        return $query->result_array();
    }

    public function get_company_is_null()
    {
         $query = $this->db->query("select
            tb_company_address.company_id,
            tb_company_address.company_address_latitude,
            tb_company_address.company_address_longitude,
            tb_company.company_name_th
            from tb_company_address
            JOIN tb_company on tb_company_address.company_id = tb_company.company_id
            WHERE company_address_latitude IS NULL");
        return $query->result_array();
    }

    public function get_last_id()
        {
            $sql = "SELECT company_id FROM tb_company ORDER BY company_id DESC LIMIT 1";
            $query = $this->db->query($sql);
            return $query->result_array();
            
        }

}
