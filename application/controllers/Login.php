<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
    }
	public function index()
	{   
        
        $usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
        $this->form_validation->set_rules('user_username', 'username', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('user_password', 'password', 'required', array('required' => 'Password blank is not allowed.'));
        if($this->form_validation->run() == false)
        {
            $this->load->model('User_model');
            $data['title'] = "This is Login";
            $data['user'] = $this->User_model->getAllUser();
            $this->load->view('auth/login',$data);
        }
        else
        {
            // Check username
            $user_username = $this->input->post('user_username');
            $userDataFromDatabase = $this->db->get_where('tb_user',array('user_username' => $user_username))->row_array();
            if($userDataFromDatabase)
            {   
                $user_password = $this->input->post('user_password');
                $passwordFromDatabase = $userDataFromDatabase['user_password'];
                if($passwordFromDatabase == $user_password)
                {
                    $user_data = array(
                        'username' => $userDataFromDatabase['user_username'],
                        'id' => $userDataFromDatabase['user_id'],
                    );
                    $this->session->set_userdata($user_data);
                    $this->_login();
                }
                else 
                {
                    // Password incorrect
                    $this->session->set_flashdata('message', 'Password is not correct!');
                    redirect('login');
                }
                
            }
            else 
            {
                
                // User not found
                $this->session->set_flashdata('message', 'User not found!');
                redirect('login');
            }
            
        }
		
	}

    private function _login()
    {
        redirect('home');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
