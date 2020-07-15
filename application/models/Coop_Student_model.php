<?php
class Coop_Student_model extends CI_model {
    var $adviser_id;
    var $trainer_id;
    var $job_id;
    var $term_id;
    var $coop_status;


    
    public function insert_coop_student($array)
    {
        return $this->db->insert('tb_coop_student', $array);
    }

    public function delete_coop_student($student_id)
    {
        $this->db->where('term_id', $this->Term->get_current_term()[0]['term_id']);                
        $this->db->where('student_id',$student_id);
        return $this->db->delete('tb_coop_student');
    }

    public function update_coop_student($student_id, $array)
    {
        $this->db->where('student_id',$student_id);
        return $this->db->update('tb_coop_student',$array);
    }

    public function gets_coop_student()
    {
        
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        // $this->db->where('term_id', $term_id);
        // $this->db->from('tb_coop_student');
        // $query = $this->db->get();       
        
        $sql = "SELECT `tb_company`.`company_id`, `tb_department`.`department_name`, `tb_student`.`student_gpax`, `tb_student`.`student_prefix`, `tb_student`.`student_fullname`, `tb_student`.`student_id`, `tb_company_job_position`.`job_title`, `tb_company`.`company_name_th`, `tb_company_person`.`person_fullname`, `tb_adviser`.`adviser_id`, `tb_adviser`.`adviser_fullname`, `tb_company_address`.`company_address_area`, `tb_company_address`.`company_address_province`, 
        `tb_coop_student`.*,
        (`tb_coop_student`.`coop_student_adviser_score` + `tb_coop_student`.`coop_student_company_score`) as `coop_student_sum_score`
        FROM `tb_coop_student` 
        INNER JOIN `tb_student` ON `tb_student`.`student_id` = `tb_coop_student`.`student_id`
        INNER JOIN `tb_department` ON `tb_department`.`department_id` = `tb_student`.`department_id`
        INNER JOIN `tb_company_job_position` ON `tb_company_job_position`.`job_id` = `tb_coop_student`.`job_id`
        INNER JOIN `tb_company` ON `tb_company`.`company_id` = `tb_coop_student`.`company_id`
        INNER JOIN `tb_company_address` ON `tb_company_address`.`company_id` = `tb_coop_student`.`company_id`
        LEFT JOIN `tb_company_person` ON `tb_company_person`.`person_id` = `tb_coop_student`.`trainer_id`
        LEFT JOIN `tb_adviser` ON `tb_adviser`.`adviser_id` = `tb_coop_student`.`adviser_id`
        
        WHERE `tb_coop_student`.`term_id` = '".$term_id."'
        AND `tb_student`.`term_id` = '".$term_id."'";
        
          
            

    
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    public function get_coop_student($student_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        // $this->db->where('term_id', $term_id);
        // $this->db->where('student_id', $student_id);
        // $this->db->from('tb_coop_student');
        $sql = "SELECT `tb_company`.`company_id`, `tb_department`.`department_name`, `tb_student`.`student_gpax`, `tb_student`.`student_prefix`, `tb_student`.`student_fullname`, `tb_student`.`student_id`, `tb_company_job_position`.`job_title`, `tb_company`.`company_name_th`, `tb_company_person`.`person_fullname`,  `tb_adviser`.`adviser_id`, `tb_adviser`.`adviser_fullname`, `tb_company_address`.`company_address_area`, `tb_company_address`.`company_address_province`,`tb_company`.`company_name_en`,
        `tb_coop_student`.*,
        (`tb_coop_student`.`coop_student_adviser_score` + `tb_coop_student`.`coop_student_company_score`) as `coop_student_sum_score`
        FROM `tb_coop_student` 
        INNER JOIN `tb_student` ON `tb_student`.`student_id` = `tb_coop_student`.`student_id`
        INNER JOIN `tb_department` ON `tb_department`.`department_id` = `tb_student`.`department_id`
        INNER JOIN `tb_company_job_position` ON `tb_company_job_position`.`job_id` = `tb_coop_student`.`job_id`
        INNER JOIN `tb_company` ON `tb_company`.`company_id` = `tb_coop_student`.`company_id`
        INNER JOIN `tb_company_address` ON `tb_company_address`.`company_id` = `tb_coop_student`.`company_id`
        LEFT JOIN `tb_adviser` ON `tb_adviser`.`adviser_id` = `tb_coop_student`.`adviser_id`
        LEFT JOIN `tb_company_person` ON `tb_company_person`.`person_id` = `tb_coop_student`.`trainer_id`
        WHERE `tb_coop_student`.`term_id` = '".$term_id."'
        AND `tb_coop_student`.`student_id` = '".$student_id."'
        AND `tb_student`.`term_id` = '".$term_id."'";

        $query = $this->db->query($sql);
        
        return $query->result_array(); 
    }

    public function gets_coop_student_by_company($company_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        // $this->db->where('term_id', $this->Term->get_current_term()[0]['term_id']);
        // $this->db->where('company_id', $company_id);
        // $this->db->from('tb_coop_student');
        // $query = $this->db->get();

        $sql = "SELECT `tb_company`.`company_id`, `tb_department`.`department_name`, `tb_student`.`student_gpax`, `tb_student`.`student_prefix`, `tb_student`.`student_fullname`, `tb_student`.`student_id`, `tb_company_job_position`.`job_title`, `tb_company`.`company_name_th`, `tb_company_person`.`person_fullname`,  `tb_adviser`.`adviser_id`, `tb_adviser`.`adviser_fullname`, `tb_company_address`.`company_address_area`, `tb_company_address`.`company_address_province`,
        `tb_coop_student`.`coop_student_company_score`,
        `tb_coop_student`.`coop_student_adviser_score`,
        (`tb_coop_student`.`coop_student_adviser_score` + `tb_coop_student`.`coop_student_company_score`) as `coop_student_sum_score`
        FROM `tb_coop_student` 
        INNER JOIN `tb_student` ON `tb_student`.`student_id` = `tb_coop_student`.`student_id`
        INNER JOIN `tb_department` ON `tb_department`.`department_id` = `tb_student`.`department_id`
        INNER JOIN `tb_company_job_position` ON `tb_company_job_position`.`job_id` = `tb_coop_student`.`job_id`
        INNER JOIN `tb_company` ON `tb_company`.`company_id` = `tb_coop_student`.`company_id`
        INNER JOIN `tb_company_address` ON `tb_company_address`.`company_id` = `tb_coop_student`.`company_id`
        LEFT JOIN `tb_adviser` ON `tb_adviser`.`adviser_id` = `tb_coop_student`.`adviser_id`
        LEFT JOIN `tb_company_person` ON `tb_company_person`.`person_id` = `tb_coop_student`.`trainer_id`
        WHERE `tb_coop_student`.`term_id` = '".$term_id."'
        AND `tb_coop_student`.`company_id` = '".$company_id."'
        AND `tb_student`.`term_id` = '".$term_id."'";

        $query = $this->db->query($sql);
        
        return $query->result_array();

    }

    public function gets_coop_student_by_trainer($trainer_id)
    {
        $this->db->where('term_id', $this->Term->get_current_term()[0]['term_id']);                
        $this->db->where('trainer_id', $trainer_id);
        $this->db->from('tb_coop_student');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_coop_student_by_adviser($adviser_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        // $this->db->where('term_id', $this->Term->get_current_term()[0]['term_id']);
        // $this->db->where('company_id', $company_id);
        // $this->db->from('tb_coop_student');
        // $query = $this->db->get();

        $sql = "SELECT 
        `tb_company_address`.`company_address_province`, `tb_department`.`department_name`, `tb_student`.`student_gpax`, `tb_student`.`student_prefix`, `tb_student`.`student_fullname`, `tb_student`.`student_id`, `tb_company_job_position`.`job_title`, `tb_company`.`company_name_th`, `tb_company`.`company_name_en`, `tb_company_person`.`person_fullname`,
        `tb_coop_student`.`coop_student_oral_exam_date`,
        `tb_coop_student`.`coop_student_company_score`,
        `tb_coop_student`.`coop_student_adviser_score`,`coop_student_has_coop_student_questionnaire_comment_totalscore`,
        (`tb_coop_student`.`coop_student_adviser_score` + `tb_coop_student`.`coop_student_company_score`) as `coop_student_sum_score`
        FROM `tb_coop_student` 
        INNER JOIN `tb_student` ON `tb_student`.`student_id` = `tb_coop_student`.`student_id`
        INNER JOIN `tb_coop_student_has_coop_student_questionnaire_comment` ON `tb_coop_student_has_coop_student_questionnaire_comment`.`student_id` = `tb_student`.`student_id`
        INNER JOIN `tb_department` ON `tb_department`.`department_id` = `tb_student`.`department_id`
        INNER JOIN `tb_company_job_position` ON `tb_company_job_position`.`job_id` = `tb_coop_student`.`job_id`
        INNER JOIN `tb_company` ON `tb_company`.`company_id` = `tb_coop_student`.`company_id`
        INNER JOIN `tb_company_address` ON `tb_company_address`.`company_id` = `tb_coop_student`.`company_id`        
        LEFT JOIN `tb_company_person` ON `tb_company_person`.`person_id` = `tb_coop_student`.`trainer_id`
        WHERE `tb_coop_student`.`term_id` = '".$term_id."'
        AND `tb_coop_student`.`adviser_id` = '".$adviser_id."'";

        $query = $this->db->query($sql);
        
        return $query->result_array();

    }

    public function gets_coop_student_by_department_company($department_id, $company_id, $term_id = 0)
    {
        if($term_id == 0) {
            $this->db->where('term_id', $this->Term->get_current_term()[0]['term_id']);                            
        } else {
            $this->db->where('term_id', $term_id);                
        }

        $this->db->where('department_id', $department_id);
        $this->db->where('company_id', $company_id);
        $this->db->from('tb_coop_student');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_coop_student_plan($student_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);
        $this->db->where('student_id',$student_id);
        $this->db->from('tb_coop_student_plan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_plan($student_id, $planArr)
    {
        $planArr['student_id'] = $student_id;
        return $this->db->insert('tb_coop_student_plan', $planArr);
    }

    public function delete_plan($student_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);
        $this->db->where('student_id',$student_id);        
        return $this->db->delete('tb_coop_student_plan');
    }

    public function get_permit_form_by_student($student_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);
        $this->db->where('student_id', $student_id);
        $this->db->from('tb_coop_student_permit');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_permit_form_by_student($array)
    {
        return $this->db->replace('tb_coop_student_permit', $array);
    }
    
    public function get_coop_student_dorm_by_student($student_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->from('tb_coop_student_dorm');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_coop_student_dorm($array)
    {
        return $this->db->replace('tb_coop_student_dorm', $array);
    }

    public function get_coop_student_emergency_contact_by_student($student_id)
    {
        $this->db->where('student_id', $student_id);
        $this->db->from('tb_coop_student_emergency_contact');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_emergency_contact($array)
    {
        return $this->db->replace('tb_coop_student_emergency_contact', $array);
    }

    public function gets_coop_student_no_adviser_by_company($company_id)
    {
        $this->db->where('term_id', $this->Term->get_current_term()[0]['term_id']);                
        $this->db->where('adviser_id', '');
        $this->db->where('company_id', $company_id);
        $this->db->from('tb_coop_student');
        $query = $this->db->get();
        
        return $query->result_array();
    }


    public function gets_general_petition_by_student($student_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);
        $this->db->where('student_id', $student_id);
        $this->db->from('tb_coop_student_general_petition');
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function get_general_petition($petition_id)
    {
        $this->db->where('petition_id', $petition_id);
        $this->db->from('tb_coop_student_general_petition');
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function save_general_petition($insertArr)
    {
        $this->db->insert('tb_coop_student_general_petition', $insertArr);
        return $this->db->insert_id();
    }
    
    public function get_coop_student_by_department($department_id)
    {
        $term_id = $this->Term->get_current_term()[0]['term_id'];

        $this->db->where('term_id', $term_id);
        $this->db->where('department_id', $department_id);
        $this->db->from('tb_coop_student');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_oral_exam_date_by_adviser($adviser_id) {
        $term_id = $this->Term->get_current_term()[0]['term_id'];
        
        $sql = "SELECT `tb_company`.`company_id`, `tb_department`.`department_name`, `tb_student`.`student_gpax`, `tb_student`.`student_prefix`, `tb_student`.`student_fullname`, `tb_student`.`student_id`, `tb_company_job_position`.`job_title`, `tb_company`.`company_name_th`, `tb_company_person`.`person_fullname`,  `tb_adviser`.`adviser_id`, `tb_adviser`.`adviser_fullname`, `tb_company_address`.`company_address_area`, `tb_company_address`.`company_address_province`,
        `tb_coop_student`.*

        FROM `tb_coop_student` 
        INNER JOIN `tb_student` ON `tb_student`.`student_id` = `tb_coop_student`.`student_id`
        INNER JOIN `tb_department` ON `tb_department`.`department_id` = `tb_student`.`department_id`
        INNER JOIN `tb_company_job_position` ON `tb_company_job_position`.`job_id` = `tb_coop_student`.`job_id`
        INNER JOIN `tb_company` ON `tb_company`.`company_id` = `tb_coop_student`.`company_id`
        INNER JOIN `tb_company_address` ON `tb_company_address`.`company_id` = `tb_coop_student`.`company_id`
        LEFT JOIN `tb_adviser` ON `tb_adviser`.`adviser_id` = `tb_coop_student`.`adviser_id`
        LEFT JOIN `tb_company_person` ON `tb_company_person`.`person_id` = `tb_coop_student`.`trainer_id`
        WHERE `tb_coop_student`.`term_id` = '".$term_id."'
        AND `tb_coop_student`.`adviser_id` = '".$adviser_id."'
        AND `tb_coop_student`.`coop_student_oral_exam_date` >= '".date('Y-m-d H:i:s')."'
        ORDER BY `tb_coop_student`.`coop_student_oral_exam_date` ASC
        
        ";

        $query = $this->db->query($sql);
        
        return $query->result_array();


    }

    public function update_company_score($totalscore,$student_id)
    {
        $this->db->where('student_id' ,$student_id);
        return $this->db->update('tb_coop_student', [
            'coop_student_company_score' => $totalscore
        ]);
    }

    

}