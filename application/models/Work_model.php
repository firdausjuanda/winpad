<?php

class Work_model extends CI_Model {

    public function getAllWork()
    {   
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->order_by('work_last_modified','desc');
        $this->db->join('tb_user','tb_user.user_username=tb_work.work_user','left');
        return $this->db->get()->result_array();
    }
    public function getThisWork($id)
    {   
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->where('work_id',$id);
        $this->db->order_by('work_date_open','desc');
        return $this->db->get()->row_array();
    } 
}