<?php

class Company_model extends CI_Model {
	public function getAllCompany(){
		$this->db->select('*');
		$this->db->from('tb_company');
		return $this->db->get()->result_array();
	}

	public function getCompanyByCode($code){
		$this->db->select('*');
		$this->db->from('tb_company');
		$this->db->where('company_code', $code);
		return $this->db->get()->row_array();
	}
	public function getCompanyById($id){
		$this->db->select('*');
		$this->db->from('tb_company');
		$this->db->where('company_id', $id);
		return $this->db->get()->row_array();
	}
}
