<?php

class Register extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        if($this->session->userdata('id')!=0)
        {

            $this->session->set_flashdata('message','You cannot register unless you logged out!');
            redirect('home');
        }
        else
        {
            '';
        }
    }

    public function index()
   {    
        
        $this->form_validation->set_rules('user_username', 'username', 'required|is_unique[tb_user.user_username]', array('is_unique'=>'Username is already exist!'));
        $this->form_validation->set_rules('user_firstname', 'firstname', 'required');
        $this->form_validation->set_rules('user_lastname', 'lastname', 'required');
        $this->form_validation->set_rules('user_phone', 'phone', 'required');
        $this->form_validation->set_rules('user_company', 'company', 'required');
        $this->form_validation->set_rules('user_password', 'password', 'required');
        $this->form_validation->set_rules('user_password_check', 'confirmation password', 'required|matches[user_password]');
        if($this->form_validation->run()==false)
        {   
            $data['title'] = 'Registration';
            $this->load->view('auth/register', $data);
        }
        else
        {
            $this->add_user();
        }
        
   }
   public function add_user()
   {
        $username = $this->input->post('user_username');
        $firstname = $this->input->post('user_firstname');
        $lastname = $this->input->post('user_lastname');
        $phone = $this->input->post('user_phone');
        $company = $this->input->post('user_company');
        $password = $this->input->post('user_password');

        $data = array(
            'user_username' => $username,
            'user_firstname' => $firstname,
            'user_lastname' => $lastname,
            'user_phone' => $phone,
            'user_dept' => '',
            'user_company' => $company,
            'user_password' => md5($password),
            'user_status' => 1,
        );
        $this->db->insert('tb_user',$data);
        $this->session->set_flashdata('message','Successfully registered! Please login');
        redirect('login');
   }
}