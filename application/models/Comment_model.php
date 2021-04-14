<?php

class Comment_model extends CI_Model {

    public function getWorkComment()
    {   
        $this->db->select('*');
        $this->db->from('tb_comment');
        $this->db->join('tb_user','tb_user.user_id=tb_comment.comment_user_id','left');
        return $this->db->get()->result_array();
    }
}