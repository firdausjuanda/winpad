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
    public function getOpenPermitForAdmin($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOpenPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllMyPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMyProgPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->where('permit_status', 'REL', 'left');
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
    public function getWorkByPermit($id){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('permit_id', $id);
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getPermitToRelease($user_name){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    
}