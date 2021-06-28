<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dept extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Notif_model');
		$this->load->model('Company_model');
		$this->load->model('Dept_model');
	}

	public function index($code)
	{
		$data['title'] = 'Department';
		$data['company'] = $this->Company_model->getCompanyById($code);
		$this->load->view('company/index', $data);
	}
}
