<?php

class Dept_model extends CI_Model{
	public function getAllDept(){
		$this->db->select('*');
		$this->db->from('tb_dept');
		return $this->db->get()->result_array();
	}
	public function getDeptByCompanyCode($id){
		$this->db->select('*');
		$this->db->from('tb_dept');
		$this->db->where('dept_company_id', $id);
		return $this->db->get()->result_array();
	}
	public function getDeptById($id){
		$this->db->select('*');
		$this->db->from('tb_dept');
		$this->db->where('dept_id', $id);
		return $this->db->get()->row_array();
	}
	public function GetDeptByCompany($company){
		$this->db->select('*');
		$this->db->from('tb_dept');
		$this->db->where('dept_company_id', $company);
		return $this->db->get()->result_array();
	}
	public function GetAllDeptCompany(){
		$this->db->select('*');
		$this->db->from('tb_dept');
		$this->db->join('tb_company', 'tb_company.company_id=tb_dept.dept_company_id', 'left');
		return $this->db->get()->result_array();
	}
}
