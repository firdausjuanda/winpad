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
        $this->load->model('Notif_model');
        $this->load->helper(array('form', 'url'));
        $usernameFromSession = $this->session->userdata('username');
		if($usernameFromSession == null)
        {
            $this->session->set_flashdata('message', "Please login!");
            $redirect_path = 'login';
            redirect($redirect_path);
        }
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data['title'] = 'Unreleased Permit';
        $usernameFromSession = $this->session->userdata('username');
        $user_row_data = $this->User_model->userAndCompanySession($usernameFromSession);
		if(!$user_row_data){
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
		}else{
			$data['userData'] = $this->User_model->userAndCompanySession($usernameFromSession);
		}
		$company = $data['userData']['user_company'];
        if($data['userData']['user_role']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitForAdmin();
        }
        elseif($data['userData']['user_is_manage']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitForAdmin();
		}
        else
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitByCompany($company);
        }
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
        
    }
    public function this_work_permit($id)
    {
        $data['title'] = 'This Work Permit';
        $usernameFromSession = $this->session->userdata('username');
		$user_row_data = $this->User_model->userAndCompanySession($usernameFromSession);
		if(!$user_row_data){
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
		}else{
			$data['userData'] = $this->User_model->userAndCompanySession($usernameFromSession);
		}
        $data['my_permit'] = $this->Permit_model->getThisPermit($id);
        $data['this_work'] = $this->Work_model->getThisWork($id);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
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
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
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
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Attachment added!</span>");
            $redirect_path = 'permit';
            redirect($redirect_path);
        }
        else
        {  
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Somthing went wrong!</span>");
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
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
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
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Completed picture added!</span>");
            $redirect_path = 'permit/my_prog_permit';
            redirect($redirect_path);
        }
        else
        {  
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Something went wrong!</span>");
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
                $data['permit_type'] = $this->Permit_model->getPermitType();
				$company = $data['userData']['user_company']; 
				$user_id = $data['userData']['user_id'];
				$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
				$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
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
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Permit added!</span>");
        $redirect_path = 'permit/this_work_permit/'.$id;
        redirect($redirect_path);

    }

    public function delete_permit($id)
    {   
        $permit_data = $this->Permit_model->getThisPermitToDelete($id);
        $usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);
        if($user_data['user_username'] == $permit_data['permit_user'])
        {
            $this->db->where('permit_id',$id);
            $this->db->delete('tb_permit');
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Permit deleted!</span>");
            $redirect_path = 'permit/';
            redirect($redirect_path);
        }
        $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Not allowed!</span>");
        $redirect_path = 'permit/';
        redirect($redirect_path);
        
    }

    public function release_permit()
    {
        $user_name = $this->session->userdata('username');
        $permit_to_send = $this->Permit_model->getPermitToSend($user_name);
        $permit_area_to_send = $this->Permit_model->getPermitAreaToSend($user_name);
        $usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);
		$company = $user_data['user_company'];
		$permit_to_release = $this->Permit_model->getPermitToReleaseByCompany($company);
		$permit_empty = $this->Permit_model->getPermitEmptyByCompany($company);
		if($permit_empty!=null)
		{
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
					$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Permit released and email sent!</span>");
					redirect('permit/');
				}
				else
				{   
				    $this->session->set_flashdata('message', "<span style='background-color: orange; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Permit release, but email not sent!</span>");
				    redirect('permit/');
				}

			}
			else
			{
				$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Please complete all attachments!</span>");
				$redirect_path = 'permit/';
				redirect($redirect_path);
			}
		}
		else 
		{
			$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>No permit to be released!</span>");
			$redirect_path = 'permit/';
			redirect($redirect_path);
		}
    }
    public function complete_permit()
    {
		$usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);
		$company = $user_data['user_company'];
		$user_name = $user_data['user_username'];
        $permit_to_complete = $this->Permit_model->getPermitToCompleteByCompany($company);
        if(!$permit_to_complete)
        {
            $data = array(
                'permit_status' => 'CLS',
            );
            $this->db->where('permit_status','PRG');
            $this->db->where('permit_user',$user_name);
            $this->db->update('tb_permit', $data);
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Permit completed!</span>");
            $redirect_path = 'permit/my_prog_permit';
            redirect($redirect_path);
        }
        else
        {
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Please complete all permits!</span>");
            $redirect_path = 'permit/my_prog_permit';
            redirect($redirect_path);
        }
    }

    public function my_all_permit()
    {
        $data['title'] = 'My All Permit';
        $usernameFromSession = $this->session->userdata('username');
		$user_row_data = $this->User_model->userAndCompanySession($usernameFromSession);
		if(!$user_row_data){
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
		}else{
			$data['userData'] = $this->User_model->userAndCompanySession($usernameFromSession);
		}
		$company = $data['userData']['user_company'];
        if($data['userData']['user_role']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getAllPermit();
        }
        elseif($data['userData']['user_is_manage']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getAllPermit();
        }
        else 
        {
            $data['my_permit'] = $this->Permit_model->getMyPermitByCompany($company);
        }
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
    }
    public function my_prog_permit()
    {
        $data['title'] = 'In Progress Permit';
        $usernameFromSession = $this->session->userdata('username');
		$user_row_data = $this->User_model->userAndCompanySession($usernameFromSession);
		if(!$user_row_data){
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
		}else{
			$data['userData'] = $this->User_model->userAndCompanySession($usernameFromSession);
		}
		$company = $data['userData']['user_company'];
        
        if($data['userData']['user_role']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getProgPermitForAdmin();
        }
        elseif($data['userData']['user_is_manage']== 1) 
        {
            $data['my_permit'] = $this->Permit_model->getProgPermitForAdmin();
        }
        else 
        {
            $data['my_permit'] = $this->Permit_model->getMyProgPermitByCompany($company);
        }
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
    }
    public function pending_permit()
    {
        $data['title'] = 'Pending Permit';
        $usernameFromSession = $this->session->userdata('username');
		$user_row_data = $this->User_model->userAndCompanySession($usernameFromSession);
		if(!$user_row_data){
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
		}else{
			$data['userData'] = $this->User_model->userAndCompanySession($usernameFromSession);
		}
		$company = $data['userData']['user_company'];
        
        if($data['userData']['user_is_approver1'] == 1 || $data['userData']['user_is_approver2'] == 1)
        {
            $data['my_permit'] = $this->Permit_model->getPendPermitForAdmin();
        }
        elseif($data['userData']['user_is_manage']== 1)
        {
            $data['my_permit'] = $this->Permit_model->getPendPermitForAdmin();
        }
        else 
        {
            $data['my_permit'] = $this->Permit_model->getMyPendPermitByCompany($company);
        }
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('permit/my_permit',$data);
        $this->load->view('templates/footer',$data);
    }

	public function app1($id)
	{
		$app1 = $this->input->post('permit_is_approved1');
		$user_id = $this->session->userdata('id');
		$user_data = $this->User_model->getThisUser($user_id);
		$permit_data = $this->Permit_model->getPermitById($id);
		// Check Authorization L1
		if($user_data['user_is_approver1'] == 1){
			if($permit_data['permit_status'] == 'REL'){
				$data = array(
					'permit_is_approved1' => 1,
					'permit_approved1_by' => $user_id,
				);
				$this->db->where('permit_id', $id);
				$this->db->update('tb_permit', $data);
	
				$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>L1 approved!</span>");
				$redirect_path = 'permit/pending_permit';
				redirect($redirect_path);	
			}else{
				$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Permit is not ready yet!</span>");
				$redirect_path = 'permit/pending_permit';
				redirect($redirect_path);	
			}
		}
		else {
			$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>You don't have authorization!</span>");
			$redirect_path = 'permit/pending_permit';
			redirect($redirect_path);	
		}
	}
	public function dapp1($id)
	{
		$app1 = $this->input->post('permit_is_approved1');
		$user_id = $this->session->userdata('id');
		$user_data = $this->User_model->getThisUser($user_id);
		$permit_data = $this->Permit_model->getPermitById($id);
		// Check Authorization L1
		if($user_data['user_is_approver1'] == 1){
			if($permit_data['permit_is_approved2'] == 0){
				$data = array(
					'permit_is_approved1' => 0,
					'permit_approved1_by' => $user_id,
				);
				$this->db->where('permit_id', $id);
				$this->db->update('tb_permit', $data);
	
				$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Approval L1 canceled!</span>");
				$redirect_path = 'permit/pending_permit';
				redirect($redirect_path);	
			}
			else {
				$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>L2 still approved!</span>");
				$redirect_path = 'permit/my_prog_permit';
				redirect($redirect_path);	
			}
		}
		else {
			$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>You don't have authorization!</span>");
			$redirect_path = 'permit/my_prog_permit';
			redirect($redirect_path);	
		}
	}
	public function app2($id)
	{
		$app2 = $this->input->post('permit_is_approved2');
		$user_id = $this->session->userdata('id');
		$user_data = $this->User_model->getThisUser($user_id);
		$permit_data = $this->Permit_model->getPermitById($id);
		if($user_data['user_is_approver2'] == 1){
			if($permit_data['permit_status'] == 'REL'){
				if($permit_data['permit_is_approved1'] == 1){
					$data = array(
						'permit_is_approved2' => 1,
						'permit_approved2_by' => $user_id,
						'permit_status' => 'PRG',
					);
					$this->db->where('permit_id', $id);
					$this->db->update('tb_permit', $data);
		
					$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>L2 approved!</span>");
					$redirect_path = 'permit/pending_permit';
					redirect($redirect_path);	
				}else{
					$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>L1 not approved yet!</span>");
					$redirect_path = 'permit/pending_permit';
					redirect($redirect_path);
				}
			}else{
				$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Permit is not ready yet!</span>");
				$redirect_path = 'permit/pending_permit';
				redirect($redirect_path);
			}
		}
		else {
			$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>You don't have authorization!</span>");
			$redirect_path = 'permit/pending_permit';
			redirect($redirect_path);	
		}
	}
	public function dapp2($id)
	{
		$app2 = $this->input->post('permit_is_approved2');
		$user_id = $this->session->userdata('id');
		$user_data = $this->User_model->getThisUser($user_id);
		// Check Authorization L2
		if($user_data['user_is_approver2'] == 1){

			$data = array(
				'permit_is_approved2' => 0,
				'permit_approved2_by' => $user_id,
				'permit_status' => 'REL',
			);
			// var_dump($data);die;
			$this->db->where('permit_id', $id);
			$this->db->update('tb_permit', $data);

			$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Approval L2 canceled!</span>");
			$redirect_path = 'permit/my_prog_permit';
			redirect($redirect_path);	
		}
		else {
			$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>You don't have authorization!</span>");
			$redirect_path = 'permit/my_prog_permit';
			redirect($redirect_path);	
		}
	}


}
