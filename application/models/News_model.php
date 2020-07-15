<?php
class News_model extends CI_model 
{
    public function gets_news($limit = 10, $show_hide = 0) 
    {
        if($show_hide < 1) {
            $this->db->where('news_hide', 0);
        }
        $arr = array();
        $this->db->from('tb_news');
        $this->db->join('tb_officer', 'tb_officer.officer_id = tb_news.officer_id');
        $this->db->order_by('news_id', 'DESC');
        $query = $this->db->get();

        foreach($query->result_array() as $row) {
            foreach($this->db->select('file_name')->where('news_id', $row['news_id'])->from('tb_news_file')->get()->result_array() as $rowFile) {
                $row['file'][] = $rowFile['file_name'];
            }
            array_push($arr, $row);
        }
        return $arr;
    }

    public function get_news($news_id)
    {
        $this->db->where('news_id', $news_id);
        $this->db->from('tb_news');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function insert_news($array)
    {
        return $this->db->insert('tb_news',$array);

    }

    public function update_news($news_id,$array)
    {
        $this->db->where('news_id',$news_id);
        return $this->db->update('tb_news',$array);

    }

    public function delete_news($news_id)
    {
        $this->db->where('news_id',$news_id);
        $this->db->delete('tb_news_file');
        
        $this->db->where('news_id',$news_id);
        return $this->db->delete('tb_news');

    }


}