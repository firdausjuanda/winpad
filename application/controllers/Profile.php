<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Notif_model');
        $usernameFromSession = $this->session->userdata('username');
        $user = $this->User_model->userSession($usernameFromSession);
        $user_username = $user['user_username'];
        if($user_username != $user['user_username'])
        {
            $this->session->set_flashdata('message', "<div class='row col-md-12'><div class='alert alert-danger'>You are not allowed to access profile page!</div></div>");
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
            $user_company = $this->input->post('user_company');
            $user_dept = $this->input->post('user_dept');

            $data = array(
                'user_username' => $user_username,
                'user_firstname' => $user_firstname,
                'user_lastname' => $user_lastname,
                'user_email' => $user_email,
                'user_phone' => $user_phone,
                'user_company' => $user_company,
                'user_dept' => $user_dept,
            );
            $this->db->where('user_id', $id);
            $this->db->update('tb_user', $data);

            $this->session->set_flashdata('message', "<div class='row col-md-12'><div class='alert alert-success'>Changes Saved</div></div>");
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

		$this->session->set_flashdata('message', "<div class='row col-md-12'><div class='alert alert-success'>Dark mode changed</div></div>");
		$redirect_path = 'work';
		redirect($redirect_path);	
		}

	}
}
