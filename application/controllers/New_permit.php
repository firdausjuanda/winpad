<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_permit extends CI_Controller {
	
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');

    }
	public function index()
	{	
        $this->form_validation->set_rules('permit_date', 'permit date', 'required');
        $this->form_validation->set_rules('permit_category', 'permit category', 'required');
        $this->form_validation->set_rules('permit_no', 'permit no', 'required');
        $this->form_validation->set_rules('permit_area', 'permit area', 'required');
        $this->form_validation->set_rules('permit_title', 'permit title', 'required');
		if($this->session->userdata('id'))
		{
            
            if($this->form_validation->run()==false)
            {
                // If false
                $data['title'] = "New Permit";
                $usernameFromSession = $this->session->userdata('username');
                $data['userData'] = $this->User_model->userSession($usernameFromSession);
                $data['user'] = $this->User_model->getAllUser();
                $this->load->view('new_permit',$data);
            }
            else
            {
                // If true
                $this->add();
            }
			
		}
		else
		{
			redirect('login');
		}
		
	}

    public function add()
    {
        $permit_date = $this->input->post('permit_date');
        $permit_category = $this->input->post('permit_category');
        $permit_no = $this->input->post('permit_no');
        $permit_status = 'OPN';
        $permit_area = $this->input->post('permit_area');
        $permit_title = $this->input->post('permit_title');
        $permit_description = $this->input->post('permit_description');
        $permit_user = $this->input->post('permit_user');
        $permit_company = $this->input->post('permit_company');

        $data = array(
            'permit_date' => $permit_date,
            'permit_category' => $permit_category,
            'permit_no' => $permit_no,
            'permit_status' => $permit_status,
            'permit_area' => $permit_area,
            'permit_title' => $permit_title,
            'permit_description' => $permit_description,
            'permit_user' => $permit_user,
            'permit_company' => $permit_company,
        );
        $this->db->insert('tb_permit',$data);
        $this->session->set_flashdata('message', 'Permit Successfully added!');
        redirect('home');
    }
}
