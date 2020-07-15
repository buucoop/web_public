<?php
class News_File_model extends CI_model 
{
    public function add_file($news_id, $filename)
    {
        $array['file_name'] = $filename;
        $array['news_id'] = $news_id;
        return $this->db->insert('tb_news_file', $array);
    }

    public function get_file($file_id)
    {
        $this->db->select('file_name');
        $this->db->where('file_id', $file_id);
        $this->db->from('tb_news_file');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function gets_file_by_news($news_id)
    {
        $this->db->select('file_name, file_id');        
        $this->db->where('news_id', $news_id);
        $this->db->from('tb_news_file');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_file($file_id)
    {
        $this->db->where('file_id', $file_id);
        return $this->db->delete('tb_news_file');
    }


}