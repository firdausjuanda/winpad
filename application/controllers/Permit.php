<?php
class Permit extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Permit_model');
        $this->load->model('User_model');
        $this->load->model('Work_model');
        $this->load->model('Email_model');
    }
    public function index()
    {
        $data['title'] = 'My Permit';
        $usernameFromSession = $this->session->userdata('username');
        $data['my_permit'] = $this->Permit_model->getMyPermit($usernameFromSession);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
    }
    public function this_work_permit($id)
    {
        $data['title'] = 'My Permit';
        $usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['this_work_permit'] = $this->Permit_model->getThisPermit($id);
        $data['this_work'] = $this->Work_model->getThisWork($id);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/this_work_permit',$data);
        $this->load->view('templates/footer',$data);
    }
    public function new_permit($id)
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
                $data['workData'] = $this->Work_model->getThisWork($id);
                $data['user'] = $this->User_model->getAllUser();
                $this->load->view('templates/header',$data);
                $this->load->view('permit/new_permit',$data);
                $this->load->view('templates/footer',$data);
            }
            else
            {
                // If true
                $usernameFromSession = $this->session->userdata('username');
                $user_data = $this->User_model->userSession($usernameFromSession);
                $this->_add($user_data, $id);
            }
			
		}
		else
		{
			redirect('login');
		}
		
	}

    private function _add($user_data,$id)
    {   
        // $thisWork = $this->Work_model->getThisWork($id);
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
            'permit_work_id' => $id,
            'permit_category' => $permit_category,
            'permit_no' => $permit_no,
            'permit_status' => $permit_status,
            'permit_area' => $permit_area,
            'permit_title' => $permit_title,
            'permit_description' => $permit_description,
            'permit_user' => $permit_user,
            'permit_company' => $permit_company,
        );
        
        if($this->Email_model->sendEmail(
            $user_data, 
            $permit_date, 
            $permit_category, 
            $permit_no,
            $permit_status,
            $permit_area,
            $permit_title,
            $permit_description,
            $permit_user,
            $permit_company
            ))
        {
            $this->db->insert('tb_permit',$data);
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Permit Successfully added and email sent!</div></div>');
            $redirect_path = 'permit/this_work_permit/'.$id;
            redirect($redirect_path);
        }
        else
        {   
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Something wrong, try again adding permit!</div></div>');
            $redirect_path = 'permit/this_work_permit/'.$id;
            redirect($redirect_path);
        }
    }

}