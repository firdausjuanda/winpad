<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{   
        $this->load->library('form_validation');
        $this->load->model('User_model');
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
            $userDataFromDatabase = $this->db->get_where('tb_user',array('user_name' => $user_username))->row_array();
            if($userDataFromDatabase)
            {   
                $user_password = $this->input->post('user_password');
                $passwordFromDatabase = $userDataFromDatabase['user_password'];
                if($passwordFromDatabase == $user_password)
                {
                    $user_data = array(
                        'username' => $userDataFromDatabase['user_name'],
                        'id' => $userDataFromDatabase['user_id'],
                    );
                    $this->session->set_userdata($user_data);
                    $this->_login();
                }
                else 
                {
                    // Password incorrect
                    echo 'Password Incorrect.';
                }
                
            }
            else 
            {
                
                // User not found
                echo 'User not found.';
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
