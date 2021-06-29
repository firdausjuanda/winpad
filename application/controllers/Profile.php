<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Notif_model');
        $this->load->model('Company_model');
        $this->load->model('Dept_model');
        $usernameFromSession = $this->session->userdata('username');
        $user = $this->User_model->userSession($usernameFromSession);
        $user_username = $user['user_username'];
        if($user_username != $user['user_username'])
        {
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Not allowed!</span>");
            $redirect_path = 'work';
            redirect($redirect_path);
        }

        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data['title'] = "Profile";
        $usernameFromSession = $this->session->userdata('username');
        $user_username = $usernameFromSession;
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $user_id = $data['userData']['user_id'];
        $data['count_user_work'] = $this->User_model->countUserWork($user_username);
        $data['count_user_permit'] = $this->User_model->countUserPermit($user_username);
        $data['count_user_comment'] = $this->User_model->countUserComment($user_id);
		$company = $data['userData']['user_company'];
		$dept = $data['userData']['user_dept'];
        $data['userDataCompany'] = $this->Company_model->getCompanyById($company);
        $data['userDataDept'] = $this->Dept_model->GetDeptById($dept);
        $data['userDataDeptByCompany'] = $this->Dept_model->GetDeptByCompany($company);
		// var_dump($data['userDataDept']);die;
		// var_dump($data['userDataCompany']);die;
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('profile/index',$data);
        $this->load->view('templates/footer',$data);
    }
    public function user($user_username)
    {
        $data['title'] = "User Profile";
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['user'] = $this->User_model->getThisUserbyUsername($user_username);
        if(!$data['user'])
        {
            $data['user'] = [];
        }
        else
        {
            $user_id = $data['user']['user_id'];
            $data['count_user_work'] = $this->User_model->countUserWork($user_username);
            $data['count_user_permit'] = $this->User_model->countUserPermit($user_username);
            $data['count_user_comment'] = $this->User_model->countUserComment($user_id);
        }
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('profile/user_profile',$data);
        $this->load->view('templates/footer',$data);
    }

    public function edit_profile($id)
    {
        $usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
        $this->form_validation->set_rules('user_username', 'username', 'required', array('required' => 'You must provide a %s.'));
        if($this->form_validation->run() == false)
        {
            $data['title'] = "Profile";
            $usernameFromSession = $this->session->userdata('username');
            $data['userData'] = $this->User_model->userSession($usernameFromSession);
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
            $this->load->view('templates/header',$data);
            $this->load->view('profile/index',$data);
            $this->load->view('templates/footer',$data);
        }
        else
        {
            $user_username = $this->input->post('user_username');
            $user_firstname = $this->input->post('user_firstname');
            $user_lastname = $this->input->post('user_lastname');
            $user_email = $this->input->post('user_email');
            $user_phone = $this->input->post('user_phone');
            $user_dept = $this->input->post('user_dept');

            $data = array(
                'user_username' => $user_username,
                'user_firstname' => $user_firstname,
                'user_lastname' => $user_lastname,
                'user_email' => $user_email,
                'user_phone' => $user_phone,
                'user_dept' => $user_dept,
            );
            $this->db->where('user_id', $id);
            $this->db->update('tb_user', $data);

            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Changes saved!</span>");
            $redirect_path = 'profile';
            redirect($redirect_path);

        }

    }

	public function dark_mode()
	{
		
        $this->form_validation->set_rules('user_id', 'id', 'required', array('required' => 'You must provide a %s.'));
        
		if($this->form_validation->run() == false)
		{
			echo "false";
		}
		else
		{
		
		$user_dark = $this->input->post('user_dark');
		$user_id = $this->input->post('user_id');

		$data = array(
			'user_dark' => $user_dark,
			'user_id' => $user_id,
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('tb_user', $data);

		$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Dark mode changed!</span>");
		$redirect_path = 'profile';
		redirect($redirect_path);	
		}

	}

	public function join_company($id){
        $usernameFromSession = $this->session->userdata('username');
        $data_user = $this->User_model->userSession($usernameFromSession);
		$user_id = $data_user['user_id'];
		$company = $this->Company_model->getCompanyById($id);
		$company_code = $company['company_code'];
		$user_current_company = $data_user['user_company'];
		if($user_current_company){
			$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>You can not join in multiple companies!</span>");
			$path = 'company/c/'.$company_code;
			redirect($path);
		} else {
			$data['user_company'] = $id;
			$this->db->where('user_id', $user_id);
			$this->db->update('tb_user', $data);
			$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Join successfully!</span>");
			$path = 'company/c/'.$company_code;
			redirect($path);
		}
	}
	public function unjoin_company($id){
        $usernameFromSession = $this->session->userdata('username');
        $data_user = $this->User_model->userSession($usernameFromSession);
		$company = $this->Company_model->getCompanyById($id);
		$company_code = $company['company_code'];
		$user_id = $data_user['user_id'];
		$data['user_company'] = "";
		$data['user_dept'] = "";
		$this->db->where('user_id', $user_id); 
		$this->db->update('tb_user', $data);
		$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Unjoin successfully!</span>");
		$path = 'company/c/'.$company_code;
		redirect($path);

	}
}
