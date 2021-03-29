<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permit_model extends CI_Model {
	public function getAllPermit(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getThisPermit($id){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('permit_work_id', $id, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
}