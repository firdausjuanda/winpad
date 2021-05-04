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
        elseif($data['userData']['user_is_manage']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitForAdmin($usernameFromSession);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
        
    }
    public function this_work_permit($id)
    {
        $data['title'] = 'This Work Permit';
        $usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['my_permit'] = $this->Permit_model->getThisPermit($id);
        $data['this_work'] = $this->Work_model->getThisWork($id);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
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
            $this->upload_attach();
        }
    }

    public function upload_attach()
    {
        $path                           = './assets/img/permit/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'png|gif|jpg|jpeg|tiff|pdf';
        $config['max_size']             = 5120;
        $config['file_name']            = $this->input->post('permit_id').'_'.$this->input->post('permit_area').'_'.$this->input->post('permit_title');
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        ini_set('memory_limit', '-1');
        if ($this->upload->do_upload('permit_attach'))
        {
            $data = $this->upload->data();  
            $config['image_library'] = 'gd2';  
            $config['source_image'] = $path.$data["file_name"];  
            $config['create_thumb'] = FALSE;  
            $config['maintain_ratio'] = TRUE;  
            $config['quality'] = '90%';  
            $config['width'] = 1080;  
            $config['new_image'] = $path.$data["file_name"];  
            $this->load->library('image_lib', $config);  
            $this->image_lib->resize();
            $attach_filename = $this->upload->data('file_name');
            $usernameFromSession = $this->session->userdata('username');
            $user_data = $this->User_model->userSession($usernameFromSession);
            $this->_attaching($attach_filename);
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }

    private function _attaching($attach_filename)
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

    public function add_complete_pic($id)
    {   
        $this->form_validation->set_rules('permit_area', 'permit area', 'required');
		if($this->form_validation->run()==false)
		{
        // If false
        $data['title'] = "Add Complete Picture";
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['workData'] = $this->Permit_model->getWorkByPermit($id);
        $data['user'] = $this->User_model->getAllUser();
        $this->load->view('templates/header',$data);
        $this->load->view('permit/add_complete_pic',$data);
        $this->load->view('templates/footer',$data);
        }
        else
        {
            // If true
            $test = $this->input->post('permit_complete_pic');
            $this->upload_complete_pic();
        }
    }
    public function upload_complete_pic()
    {
        $path                           = './assets/img/permit_complete/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'png|gif|jpg|jpeg|tiff|pdf';
        $config['max_size']             = 5120;
        $config['file_name']            = $this->input->post('permit_id').'_'.$this->input->post('permit_area').'_'.$this->input->post('permit_title');
        ini_set('memory_limit', '-1');
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('permit_complete_pic'))
        {
            $data = $this->upload->data();  
            $config['image_library'] = 'gd2';  
            $config['source_image'] = $path.$data["file_name"];  
            $config['create_thumb'] = FALSE;  
            $config['maintain_ratio'] = TRUE;  
            $config['quality'] = '90%';  
            $config['width'] = 1080;  
            $config['new_image'] = $path.$data["file_name"];  
            $this->load->library('image_lib', $config);  
            $this->image_lib->resize();
            $attach_filename = $this->upload->data('file_name');
            $this->_attachingCompletePic($attach_filename);
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }
    private function _attachingCompletePic($attach_filename)
    {
        $permit_id = $this->input->post('permit_id');
        $permit_complete_pic = $attach_filename;
        $data = array(
            'permit_complete_pic' => $permit_complete_pic,
            'permit_attach_status' => 2,
        );
        $this->db->where('permit_id',$permit_id);
        if($this->db->update('tb_permit',$data))
        {
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Complete Picture successfully added!</div></div>');
            $redirect_path = 'permit/my_prog_permit';
            redirect($redirect_path);
        }
        else
        {  
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Something wrong, try again later!</div></div>');
            $redirect_path = 'permit/my_prog_permit';
            redirect($redirect_path);

        }

    }

    public function new_permit($id)
	{	
        $this->form_validation->set_rules('permit_date', 'permit date', 'required');
        $this->form_validation->set_rules('permit_category', 'permit category', 'required');
        $this->form_validation->set_rules('permit_no', 'permit no', 'required');
        $this->form_validation->set_rules('permit_area', 'permit area', 'required');
        $this->form_validation->set_rules('permit_apd', 'permit APD', 'required');
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
                $this->_add($id);
            }
			
		}
		else
		{
			redirect('login');
		}
		
	}

    private function _add($id)
    {   
        // $thisWork = $this->Work_model->getThisWork($id);
        $permit_date = $this->input->post('permit_date');
        $permit_category = $this->input->post('permit_category');
        $permit_no = $this->input->post('permit_no');
        $permit_status = 'OPN';
        $permit_area = $this->input->post('permit_area');
        $permit_title = $this->input->post('permit_title');
        $permit_apd = $this->input->post('permit_apd');
        $permit_tools = $this->input->post('permit_tools');
        $permit_description = $this->input->post('permit_description');
        $permit_user = $this->input->post('permit_user');
        $permit_company = $this->input->post('permit_company');

        $data = array(
            'permit_date' => $permit_date,
            'permit_work_id' => $id,
            'permit_category' => $permit_category,
            'permit_no' => $permit_no,
            'permit_apd' => $permit_apd,
            'permit_tools' => $permit_tools,
            'permit_status' => $permit_status,
            'permit_area' => $permit_area,
            'permit_title' => $permit_title,
            'permit_description' => $permit_description,
            'permit_user' => $permit_user,
            'permit_company' => $permit_company,
        );
        $this->db->insert('tb_permit',$data);
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Permit Successfully added!</div></div>');
        $redirect_path = 'permit/this_work_permit/'.$id;
        redirect($redirect_path);

    }

    public function delete_permit($id)
    {   
        $permit_data = $this->Permit_model->getThisPermit($id);
        $usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);
        if($user_data['user_username'] == $permit_data[0]['permit_user'])
        {
            $this->db->where('permit_id',$id);
            $this->db->delete('tb_permit');
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Permit deleted</div></div>');
            $redirect_path = 'permit/';
            redirect($redirect_path);
        }
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Not allowed</div></div>');
        $redirect_path = 'permit/';
        redirect($redirect_path);
        
    }

    public function release_permit()
    {
        $user_name = $this->session->userdata('username');
        $permit_to_release = $this->Permit_model->getPermitToRelease($user_name);
        $permit_to_send = $this->Permit_model->getPermitToSend($user_name);
        $work_id_to_send = $this->Permit_model->getPermitWorkIdToSend($user_name);
        $permit_area_to_send = $this->Permit_model->getPermitAreaToSend($user_name);
        $usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);
        if(!$permit_to_release)
        {
            $data = array(
                'permit_status' => 'REL',
            );

            $this->db->where('permit_status','OPN');
            $this->db->where('permit_user',$user_name);
            $this->db->update('tb_permit', $data);
            $user_firstname     = $user_data['user_firstname'];
            $user_lastname      = $user_data['user_lastname'];
            $user_company       = $user_data['user_company'];
            $email_user         = $user_data['user_email'];
            $area               = $permit_area_to_send;
            $email_managers = $this->User_model->getEmailManagers();
            $email_area = $this->User_model->getEmailAreas($area);
           
            if(
                $this->Email_model->sendPermitEmail(
                $permit_to_send,
                $user_company,
                $email_managers,
                $email_area,
                $email_user,
                $user_firstname,
                $user_lastname
                )
    
            == TRUE)
            {   
                $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Permit released and email sent!</div></div>');
                redirect('permit/');
            }
            else
            {   
                $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-warning">Permit released, but email not sent!</div></div>');
                redirect('permit/');
            }

        }
        else
        {
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Please complete all attachments</div></div>');
            $redirect_path = 'permit/';
            redirect($redirect_path);
        }
    }
    public function complete_permit()
    {
        $user_name = $this->session->userdata('username');
        $permit_to_complete = $this->Permit_model->getPermitToComplete($user_name);
        if(!$permit_to_complete)
        {
            $data = array(
                'permit_status' => 'CLS',
            );

            $this->db->where('permit_status','REL');
            $this->db->where('permit_user',$user_name);
            $this->db->update('tb_permit', $data);
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Permit Completed</div></div>');
            $redirect_path = 'permit/my_prog_permit';
            redirect($redirect_path);
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Please complete all permit</div></div>');
            $redirect_path = 'permit/my_prog_permit';
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
            $data['my_permit'] = $this->Permit_model->getMyPermit($usernameFromSession);
        }
        elseif($data['userData']['user_is_manage']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getAllPermit();
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
        
        if($data['userData']['user_role']== 0)
        {
            $data['my_permit'] = $this->Permit_model->getMyProgPermit($usernameFromSession);
        }
        elseif($data['userData']['user_is_manage']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getProgPermitForAdmin();
        }
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
    }


}