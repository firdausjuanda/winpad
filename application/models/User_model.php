<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function getAllUser(){
        $this->db->select('*');
        $this->db->from('tb_user');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function userSession($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getThisUser($id){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('user_id', $id, 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
}