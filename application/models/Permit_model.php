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
	public function userSession($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('user_name', $usernameFromSession, 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
}