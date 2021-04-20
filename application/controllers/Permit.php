<?php
class Permit extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Permit_model');
        $this->load->model('User_model');
        $this->load->model('Work_model');
        $this->load->model('Permit_model');
        $this->load->model('Email_model');
    }
    public function index()
    {
        $data['title'] = 'Unreleased Permit';
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        if($data['userData']['user_role']== 0)
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermit($usernameFromSession);
        }
        else
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitForAdmin($usernameFromSession);
        }
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
    public function add_attach($id)
    {   
        $this->form_validation->set_rules('permit_area', 'permit area', 'required');
		if($this->form_validation->run()==false)
		{
        // If false
        $data['title'] = "Add Attachment";
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['workData'] = $this->Permit_model->getWorkByPermit($id);
        $data['user'] = $this->User_model->getAllUser();
        $this->load->view('templates/header',$data);
        $this->load->view('permit/add_attach',$data);
        $this->load->view('templates/footer',$data);
        }
        else
        {
            // If true
            $test = $this->input->post('permit_attach');
            var_dump($test);
            $this->upload_attach();
        }
    }

    public function upload_attach()
    {
        $config['upload_path']          = './assets/img/permit/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['file_name']            = $this->input->post('permit_id').'_'.$this->input->post('permit_area').'_'.$this->input->post('permit_title').'_'.$this->input->post('permit_description');
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('permit_attach'))
        {
            $attach_filename = $this->upload->data('file_name');
            $usernameFromSession = $this->session->userdata('username');
            $user_data = $this->User_model->userSession($usernameFromSession);
            $this->_attaching($user_data, $attach_filename);
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }

    private function _attaching($user_data, $attach_filename)
    {
        $permit_giver = $this->input->post('permit_giver');
        $permit_id = $this->input->post('permit_id');
        $permit_attach = $attach_filename;
        $data = array(
            'permit_giver' => $permit_giver,
            'permit_attach' => $permit_attach,
            'permit_attach_status' => 1,
        );
        $this->db->where('permit_id',$permit_id);
        if($this->db->update('tb_permit',$data))
        {
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Attachment successfully added!</div></div>');
            $redirect_path = 'permit';
            redirect($redirect_path);
        }
        else
        {  
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Something wrong, try again later!</div></div>');
            $redirect_path = 'permit';
            redirect($redirect_path);

        }

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
        // $send_mail = $this->Email_model->sendPermitEmail(
        //     $user_data, 
        //     $permit_date, 
        //     $permit_category, 
        //     $permit_no,
        //     $permit_status,
        //     $permit_area,
        //     $permit_title,
        //     $permit_description,
        //     $permit_user,
        //     $permit_company
        // );
        // if($send_mail == TRUE)
        // {
            if($this->db->insert('tb_permit',$data)==TRUE)
            {
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
            
        // }
        // else
        // { 
        // }
    }

    public function delete_permit($id)
    {
        $this->db->where('permit_id',$id);
        $this->db->delete('tb_permit');
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Permit deleted</div></div>');
        $redirect_path = 'permit/';
        redirect($redirect_path);
    }

    public function release_permit()
    {
        $user_name = $this->session->userdata('username');
        $permit_to_release = $this->Permit_model->getPermitToRelease($user_name);
        if(!$permit_to_release)
        {
            $data = array(
                'permit_status' => 'REL',
            );

            $this->db->where('permit_status','OPN');
            $this->db->where('permit_user',$user_name);
            $this->db->update('tb_permit', $data);
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Permit Release</div></div>');
            $redirect_path = 'permit/';
            redirect($redirect_path);
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Please complete all attachments</div></div>');
            $redirect_path = 'permit/';
            redirect($redirect_path);
        }
    }

    public function my_all_permit()
    {
        $data['title'] = 'My All Permit';
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        if($data['userData']['user_role']== 0)
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermit($usernameFromSession);
        }
        else
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitForAdmin($usernameFromSession);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
    }
    public function my_prog_permit()
    {
        $data['title'] = 'In Progress Permit';
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['my_permit'] = $this->Permit_model->getMyProgPermit($usernameFromSession);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
    }


}