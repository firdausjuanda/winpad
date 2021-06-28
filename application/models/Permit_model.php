<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permit_model extends CI_Model {
	public function getAllPermit(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyPermit($usernameFromSession){ 
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyPermitByCompany($company){ 
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOpenPermitForAdmin(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getProgPermitForAdmin(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('permit_status', 'PRG', 'left');
        $this->db->where('permit_is_approved1', 1, 'left');
        $this->db->where('permit_is_approved2', 1, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPendPermitForAdmin(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        // $this->db->where('permit_status', 'REL', 'left');
        $this->db->where("permit_status = 'REL'");
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOpenPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getOpenPermitByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllMyPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMyProgPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->where('permit_status', 'REL', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyProgPermitByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
        $this->db->where('permit_status', 'PRG', 'left');
        $this->db->where('permit_is_approved1', 1, 'left');
        $this->db->where('permit_is_approved2', 1, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyPendPermitByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
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
    public function getThisPermitToDelete($id){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->where('permit_id', $id, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
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
	public function getPermitToReleaseByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_company',$company);
        $this->db->where('permit_attach_status', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getPermitEmptyByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_company',$company);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitToSend($user_name){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $this->db->order_by('permit_work_id','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitWorkIdToSend($user_name){
        $this->db->distinct();
        $this->db->select('permit_work_id');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitAreaToSend($user_name){
        $this->db->distinct();
        $this->db->select('permit_area');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getPermitToComplete($user_name){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','REL');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitToCompleteByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','PRG');
        $this->db->where('permit_company',$company);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getPermitById($id){
		return $this->db
		->select('*')
		->from('tb_permit')
		->where('permit_id', $id)
		->get()
		->row_array();
	}
    
}
