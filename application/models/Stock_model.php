<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}
	public function getAllStock()
	{
		$this->db->select('*');
		$this->db->from('tb_stock');
		$this->db->join('tb_material','tb_material.mat_id=tb_stock.stock_mat_id', false);
		$this->db->order_by('mat_id', 'asc');
		return $this->db->get()->result_array();
	}
	public function getAllTrans()
	{
		$this->db->select('*');
		$this->db->from('tb_mat_trans');
		$this->db->join('tb_material','tb_material.mat_id=tb_mat_trans.mt_mat_id', false);
		$this->db->order_by('mat_id', 'asc');
		return $this->db->get()->result_array();
	}
	public function getMaterialByMatNo($mat_type){
		return $this->db
		->select('*')
		->from('tb_material')
		->where('mat_type', $mat_type)
		->get()
		->row_array();
	}
	public function countPermitByType($mat_type){
		$this->db->where('permit_category', $mat_type);
		$this->db->from('tb_permit');
		return $this->db->count_all_results();
	}
	public function sumPermitAddedByType($mat_type){
		$this->db->select_sum('pa_qty');
		$this->db->where('pa_type', $mat_type);
		return $this->db->get('tb_permit_add')->row_array();
	}

}
