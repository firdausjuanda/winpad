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
    public function getThisUserbyUsername($user_username){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('user_username', $user_username, 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function countUserWork($user_username){
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->where('work_user', $user_username, 'left');
        return $this->db->count_all_results();
    }
    public function countUserPermit($user_username){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_user', $user_username, 'left');
        return $this->db->count_all_results();
    }
    public function countUserComment($user_id){
        $this->db->select('*');
        $this->db->from('tb_comment');
        $this->db->where('comment_user_id', $user_id, 'left');
        return $this->db->count_all_results();
    }
    public function getUserComment($comment_user_id){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('user_id', $comment_user_id, 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getEmailManagers()
    {
        $this->db->distinct();
        $this->db->select('user_email');
        $this->db->from('tb_user');
        $this->db->where('user_is_manage', 1, 'left');
        return $this->db->get()->result_array('user_email');
    }
    public function getEmailArea($area)
    {
        $this->db->select('user_email');
        $this->db->from('tb_user');
        $this->db->or_where('user_dept', $area, 'left');
        $this->db->where('user_company', 'NI74', 'left');
        return $this->db->get()->result_array();
    }
    public function getThisEmailUser($company)
    {
        $this->db->select('user_email');
        $this->db->from('tb_user');
        $this->db->or_where('user_company', $company, 'left');
        return $this->db->get()->result_array();
    }
    public function getEmailAreas($area)
    {
        $this->db->distinct();
        $this->db->select('user_email');
        $this->db->from('tb_user');
        foreach($area as $v)
        {
            $this->db->or_where('user_dept', $v['permit_area'], 'left');
        }
        $this->db->where('user_company', 'NI74', 'left');
        return $this->db->get()->result_array();
    }


}