<?php
class Company_Assessment_Form_model extends CI_model {
    public function gets_form_for_company()
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];
        
        $this->db->where('term_id', $term_id);
        $this->db->order_by('coop_company_questionnaire_subject_number', 'asc');
        $this->db->from('tb_coop_company_questionnaire_subject');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function save_company_comment_result($array)
    {
        return $this->db->replace('tb_company_has_coop_company_questionnaire_comment',$array);
    }

    public function get_company_comment_result($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->from('tb_company_has_coop_company_questionnaire_comment');
        $query = $this->db->get();
        return $query->result_array();
    }    


    public function save_company_forms_subject($array)
    {
        return $this->db->insert('tb_coop_company_questionnaire_subject',$array);
    }

    public function save_company_form_result($array)
    {
        return $this->db->replace('tb_company_has_coop_company_questionnaire_item',$array);
    }

    public function get_company_form_item_result_by_company_and_student($company_id, $student_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->where('company_id', $company_id);
        
        $this->db->from('tb_company_has_coop_company_questionnaire_item');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_company_questionnaire_item_by_subject_and_student($subject_id, $student_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $sql = "SELECT tb_coop_company_questionnaire_item.coop_company_questionnaire_item_title as title, tb_coop_company_questionnaire_item.coop_company_questionnaire_item_number as number, tb_company_has_coop_company_questionnaire_item.company_has_coop_company_questionnaire_item_score as score FROM `tb_coop_company_questionnaire_item` 
        JOIN `tb_company_has_coop_company_questionnaire_item` 
        ON (`tb_company_has_coop_company_questionnaire_item`.`item_id` = `tb_coop_company_questionnaire_item`.`coop_company_questionnaire_item_id`) 
        AND (`tb_company_has_coop_company_questionnaire_item`.`student_id` = '".$student_id."')
        WHERE `tb_company_has_coop_company_questionnaire_item`.`term_id` = '".$term_id."' AND `subject_id` = '".$subject_id."' ORDER BY `coop_company_questionnaire_item_number` ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }    

    public function get_company_questionnaire_item_by_subject($subject_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);
        $this->db->order_by('coop_company_questionnaire_item_number', 'asc');
        $this->db->where('subject_id', $subject_id);
        $this->db->from('tb_coop_company_questionnaire_item');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_company_questionnaire_item_avg_result_by_subject_and_company($subject_id, $company_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('tb_coop_company_questionnaire_item.term_id', $term_id);
        $this->db->where('tb_company_has_coop_company_questionnaire_item.company_id',$company_id);
        $this->db->where('tb_coop_company_questionnaire_item.subject_id',$subject_id);        
        $this->db->where('tb_coop_company_questionnaire_item.coop_company_questionnaire_item_type','score');
        $this->db->select('avg(tb_company_has_coop_company_questionnaire_item.company_has_coop_company_questionnaire_item_score) as avg_score, 
                            tb_coop_company_questionnaire_item.coop_company_questionnaire_item_number, 
                            tb_coop_company_questionnaire_item.coop_company_questionnaire_item_title, 
                            tb_coop_company_questionnaire_item.coop_company_questionnaire_item_description');
        $this->db->from('tb_coop_company_questionnaire_item');        
        $this->db->join('tb_company_has_coop_company_questionnaire_item', 'tb_company_has_coop_company_questionnaire_item.item_id = tb_coop_company_questionnaire_item.coop_company_questionnaire_item_id');
        $this->db->order_by('tb_coop_company_questionnaire_item.coop_company_questionnaire_item_number', 'asc');
        $this->db->group_by('tb_coop_company_questionnaire_item.coop_company_questionnaire_item_number');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_company_questionnaire_item($id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);        
        $this->db->where('coop_company_questionnaire_item_id', $id);
        $this->db->from('tb_coop_company_questionnaire_item');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_company_questionnaire_item($array)
    {
        return $this->db->insert('tb_coop_company_questionnaire_item',$array);
    } 

    public function get_company_questionnaire_subject($id)
    {        
        $this->db->where('coop_company_questionnaire_subject_id',$id);
        $this->db->from('tb_coop_company_questionnaire_subject');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_subject_dup($number) 
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id); 
        $this->db->where('coop_company_questionnaire_subject_number',$number);
        $this->db->from('tb_coop_company_questionnaire_subject');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function check_item_dup($number, $subject_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);  
        $this->db->where('coop_company_questionnaire_item_number', $number);
        $this->db->where('subject_id', $subject_id);
        
        
        $this->db->from('tb_coop_company_questionnaire_item');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_item($id)
    {
        $this->db->where('coop_company_questionnaire_item_id', $id);
        return $this->db->delete('tb_coop_company_questionnaire_item');
    }

    public function update_item($id, $array)
    {
        $this->db->where('coop_company_questionnaire_item_id', $id);
        return $this->db->update('tb_coop_company_questionnaire_item', $array);
    }

    public function sort_item($subject_id)
    {
        //get subject number
        $main_number = $this->get_company_questionnaire_subject($subject_id)[0]['coop_company_questionnaire_subject_number'];
        //get items
        $i = 1;
        $rows = $this->get_company_questionnaire_item_by_subject($subject_id);
        foreach($rows as $row) {
            $run_number = $main_number.".".$i;

            //update
            $this->update_item($row['coop_company_questionnaire_item_id'], array(
                'coop_company_questionnaire_item_number' => $run_number
            ));

            $i++;
        }
    }
}