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
    public function getHistoryWork()
    {   
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->order_by('work_last_modified','desc');
        $this->db->join('tb_user','tb_user.user_username=tb_work.work_user','left'); 
		$this->db->where('work_status', 'CLS');
        return $this->db->get()->result_array();
    }
    public function getThisWork($id)
    {   
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->join('tb_user','tb_user.user_username=tb_work.work_user','tb_work', 'left');
        $this->db->where('work_id',$id);
        $this->db->order_by('work_date_open','desc');
        return $this->db->get()->row_array();
    }
    public function getOpenWork($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->join('tb_user','tb_user.user_username=tb_work.work_user','tb_work', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->where('work_status', 'OPN', 'left');
        $this->db->order_by('work_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMyAllWork($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->join('tb_user','tb_user.user_username=tb_work.work_user','tb_work', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->order_by('work_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function checkOpenWorkPermit($work_id)
    {
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_user=tb_permit.permit_user','tb_permit', 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->where('work_id', $work_id, 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function checkProgWorkPermit($work_id)
    {
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_user=tb_permit.permit_user','tb_permit', 'left');
        $this->db->where('permit_status', 'REL', 'left');
        $this->db->where('work_id', $work_id, 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function checkWorkFinalPic($work_id)
    {
        $this->db->select('work_img_close');
        $this->db->from('tb_work');
        $this->db->where('work_id', $work_id, 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function checkWorkFinalPermit($work_id)
    {
        $this->db->select('work_close_permit');
        $this->db->from('tb_work');
        $this->db->where('work_id', $work_id, 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getWorkToSend($work_id_to_send){
        $this->db->select('*');
        $this->db->from('tb_work');

        foreach($work_id_to_send as $v)
        {
            $this->db->or_where('work_id', $v['permit_work_id']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
