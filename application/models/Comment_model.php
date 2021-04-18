<?php

class Comment_model extends CI_Model {

    public function getWorkComment()
    {   
        $this->db->select('*');
        $this->db->from('tb_comment');
        $this->db->join('tb_user','tb_user.user_id=tb_comment.comment_user_id','left');
        $this->db->order_by('comment_date_created','asc');
        return $this->db->get()->result_array();
    }
    public function countComment()
    {   
        $this->db->select('*');
        $this->db->from('tb_comment');
        return $this->db->get()->result_array();
    }
}