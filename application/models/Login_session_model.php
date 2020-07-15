<?php
class Login_session_model extends CI_model 
{
    public function __construct()
    {
        parent::__construct();
        if($this->check_login()) {
            $this->db->query("SET @USERNAME = '".$this->check_login()->user_fullname."'");
        }
    }
    
    public function set($login_value, $login_type, $fullname) 
    {
        $insert['login_value'] = $login_value;
        $insert['login_type'] = $login_type;
        $insert['datetime'] = date('Y-m-d H:i:s');
        $insert['unique_id'] = substr(uniqid(), 0, 20);

        $insert['user_fullname'] = $fullname;
        if(!$insert['user_fullname']) {
            $insert['user_fullname'] = $login_value;
        }
        
        $term = @$this->Term->get_current_term()[0];
        $insert['term_id'] = $term['term_id'];
        $insert['term_name'] = $term['term_name'];

        if(is_numeric($login_value)) {
            //get department
            $data['student'] = $this->Student->get_student($login_value)[0];
            $insert['department'] = $this->Student->get_department($data['student']['department_id'])[0];
        }
        

        // $this->db->insert('login_session', $insert);
        
        // $this->session->set_userdata('session_ID', $insert['unique_id']);
        $this->session->set_userdata('user_Array', (object) $insert);
        
        return $insert['unique_id'];
    }

    public function check_login()
    {
        if($this->session->userdata('user_Array')) {
            return $this->session->userdata('user_Array');
        }

        return false;
    }

    public function get()
    {
        return $this->session->userdata('user_Array');

        
        // $this->db->select("login_session.*, term.name as term_name");
        // $this->db->join('term', 'term.term_id = login_session.term_id');
        // $this->db->where('unique_id', $session_ID);
        // $this->db->from('login_session');
        // $query = $this->db->get();
        // return @$query->result()[0];
    }

    public function update($session_ID, $arr)
    {
        $arrX = (array) $this->get();
        $arr = array_merge($arrX, $arr);

        // print_r($arr);
        return $this->session->set_userdata('user_Array', (object) $arr);
        
        // $this->db->where('unique_id', $session_ID);
        // return $this->db->update('login_session', $arr);
    }
}