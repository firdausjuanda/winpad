<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_model');
		$this->load->model('User_model');
		$this->load->model('Notif_model');
		$this->load->model('Dept_model');
		$this->load->helper('form', 'url');
        
	}
	public function index(){
		$data['title'] = 'Company';
		$usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$data['component_search'] = 'component/search';
		$data['component_companyList'] = 'component/company_list';
		$this->load->view('templates/header',$data);
		$this->load->view('company/index', $data);
		$this->load->view('templates/footer',$data);
	}

	public function c($code){
		$usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$data['company'] = $this->Company_model->getCompanyByCode($code);
		$data['depts'] = $this->Dept_model->getDeptByCompanyCode($data['company']['company_id']);
		$data['title'] = $data['company']['company_name'];
		$data['component_workList'] = 'component/work_list';
		$data['component_deptList'] = 'component/dept_list';
		$data['component_companyProfile'] = 'component/company_profile';
		$data['component_cover'] = 'component/cover';
		$this->load->view('templates/header',$data);
		$this->load->view('company/profile', $data);
		$this->load->view('templates/footer',$data);
	}

	public function create_company(){
		$this->form_validation->set_rules('company_name','company name','required','Company name is required');
		$this->form_validation->set_rules('company_code','company code','required|is_unique[tb_company.company_code]', array('is_unique'=>'Company Code is already exist!'));
		if($this->form_validation->run()==false){
			$data['title'] = 'Create Company';
			$data['company'] = $this->Company_model->getAllCompany();
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			$this->load->view('company/create_company', $data);
		} else {
			$data['company_name'] = $this->input->post('company_name'); 
			$data['company_code'] = $this->input->post('company_code'); 
			$data['company_type'] = $this->input->post('company_type'); 
			$data['company_location'] = $this->input->post('company_location'); 
			$data['company_desc'] = $this->input->post('company_desc'); 
			$data['company_country'] = $this->input->post('company_country'); 
			$data['company_lead'] = $this->input->post('company_lead'); 
			$data['company_status'] = 1; 
			$data['company_create_by'] = $this->input->post('company_created_by'); 
			$data['company_admin1'] = $this->input->post('company_created_by'); 
			$data['company_admin2'] = 1;
			$this->db->insert('tb_company', $data); 
			$this->session->set_flashdata('message', 'Berhasil');
			redirect('company');
		}
	}

}
