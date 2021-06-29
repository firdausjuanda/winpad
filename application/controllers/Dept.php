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

	public function create_dept(){
		$data['title'] = 'Create Dept';
		$usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['company'] = $this->Company_model->getCompanyById($company);
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->form_validation->set_rules('dept_name','department name','required','department name is required');
		if($this->form_validation->run()==false){
			$this->load->view('templates/header',$data);
			$this->load->view('dept/create_dept', $data);
			$this->load->view('templates/footer',$data);
		} else {
			$data_input['dept_company_id'] = $this->input->post('company_id'); 
			$data_input['dept_name'] = $this->input->post('dept_name'); 
			$data_input['dept_code'] = $this->input->post('dept_code'); 
			$data_input['dept_status'] = 1; 
			$data_input['dept_admin'] = $this->input->post('dept_admin'); 
			$this->db->insert('tb_dept', $data_input);
			$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Department Created!</span>");
            $redirect_path = 'company/c/'.$data['company']['company_code'];
            redirect($redirect_path);
		}
	}
}
