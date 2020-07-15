<?php
class Daily_Report_model extends CI_model {
    public function insert_report($array)
    {
        return $this->db->insert('tb_coop_student_daily_activity',$array);

    }

    public function update_report($report_id, $array)
    {
        $this->db->where('activity_id',$report_id);
        return $this->db->update('tb_coop_student_daily_activity',$array);

    }

    public function delete_report($report_id)
    {
        $this->db->where('activity_id',$report_id);
        return $this->db->delete('tb_coop_student_daily_activity');

    }

    public function gets_report_by_student($student_id)
    {
        $this->db->where('student_id',$student_id);
        $this->db->from('tb_coop_student_daily_activity');
        $query = $this->db->get();
        return $query->result_array();

    }
    
    public function get_report($report_id)
    {
        $this->db->where('activity_id',$report_id);
        $this->db->from('tb_coop_student_daily_activity');
        $query = $this->db->get();
        return $query->result_array();
        
    }
}