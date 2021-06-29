<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_model');
		$this->load->model('User_model');
		$this->load->model('Notif_model');
		$this->load->model('Work_model');
		$this->load->model('Comment_model');
		$this->load->model('Dept_model');
		$this->load->helper('form', 'url');
        date_default_timezone_set('Asia/Jakarta');
        
	}
	public function index(){
		$data['title'] = 'Company';
		$usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['company_data'] = $this->Company_model->getAllCompany();
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		// $data['component_search'] = 'component/search';
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
		$data['user'] = $this->User_model->getAllUser();
		$data['work'] = $this->Work_model->getAllWork();
		$data['comment'] = $this->Comment_model->getWorkComment();
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
		$data['title'] = 'Create Company';
		$usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->form_validation->set_rules('company_name','company name','required','Company name is required');
		$this->form_validation->set_rules('company_code','company code','required|is_unique[tb_company.company_code]', array('is_unique'=>'Company Code is already exist!'));
		if($this->form_validation->run()==false){
			$this->load->view('templates/header',$data);
			$this->load->view('company/create_company', $data);
			$this->load->view('templates/footer',$data);
		} else {
			$data_input['company_name'] = $this->input->post('company_name'); 
			$data_input['company_code'] = $this->input->post('company_code'); 
			$data_input['company_type'] = $this->input->post('company_type'); 
			$data_input['company_location'] = $this->input->post('company_location'); 
			$data_input['company_desc'] = $this->input->post('company_desc'); 
			$data_input['company_country'] = $this->input->post('company_country'); 
			$data_input['company_lead'] = $this->input->post('company_lead'); 
			$data_input['company_status'] = 1; 
			$data_input['company_create_by'] = $this->input->post('company_created_by'); 
			$data_input['company_admin1'] = $this->input->post('company_created_by'); 
			$data_input['company_admin2'] = 1;
			$this->db->insert('tb_company', $data_input);
			$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Company Created!</span>");
            $redirect_path = 'profile';
            redirect($redirect_path);
		}
	}

}
