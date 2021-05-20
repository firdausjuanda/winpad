<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif_model extends CI_Model {
	public function getAllNotif(){
        $this->db->select('*');
        $this->db->from('tb_notif');
        $this->db->join('tb_user','tb_user.user_id=tb_notif.notif_user_to','tb_notif', 'left');
        $this->db->order_by('notif_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getThisNotif($id){
        $this->db->select('*');
        $this->db->from('tb_notif');
        $query = $this->db->get();
        return $query->row_array();
    }
	public function getMyCompanyNotif($user_id){
        $this->db->select('*');
        $this->db->from('tb_notif');
        $this->db->join('tb_user','tb_user.user_id=tb_notif.notif_user_by','tb_notif', 'left');
		$this->db->where('notif_user_to',$user_id);
        $this->db->order_by('notif_id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyCompanyNotifNoLimit($user_id){
        $this->db->select('*');
        $this->db->from('tb_notif');
        $this->db->join('tb_user','tb_user.user_id=tb_notif.notif_user_by','tb_notif', 'left');
		$this->db->where('notif_user_to',$user_id);
        $this->db->order_by('notif_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

	public function countMyCompanyNotif($company, $user_id){
		$this->db->select('*');
        $this->db->from('tb_notif');
        // $this->db->join('tb_user','tb_user.user_id=tb_notif.notif_user_by','tb_notif', 'left');
		$this->db->where('notif_company_to',$company);
		$this->db->where('notif_status',0);
		$this->db->where('notif_user_to', $user_id);
        $query = $this->db->get();
        return $query->num_rows();
	}
}
