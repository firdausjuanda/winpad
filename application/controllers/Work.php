<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work extends CI_Controller{
    public function __construct()
	{
		parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('Work_model');
        $this->load->model('Email_model');
        $this->load->model('Permit_model');
        $this->load->model('Comment_model');
        $this->load->model('Notif_model');
        $this->load->model('Time_model');
        $this->load->model('Broadcast_model');
        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        if($this->session->userdata('id')) 
		{
			$data['title'] = "Workline";
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			// var_dump($data['userData']);die;
			$data['bc'] = $this->Broadcast_model->getBc();
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
			$data['user'] = $this->User_model->getAllUser();
			$data['work'] = $this->Work_model->getAllWork();
			$data['comment'] = $this->Comment_model->getWorkComment();
			$this->load->view('templates/header',$data);
            $this->load->view('work/all_work',$data);
            $this->load->view('templates/footer',$data);
		}
		else
		{	
			$this->session->set_flashdata('message','Please login!');
			redirect('login');
		}
    }
    public function work_history()
    {
        if($this->session->userdata('id'))
		{
			$data['title'] = "Workline History";
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			$data['user'] = $this->User_model->getAllUser();
			$data['work'] = $this->Work_model->getHistoryWork();
			$data['comment'] = $this->Comment_model->getWorkComment();
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
			$this->load->view('templates/header',$data);
            $this->load->view('work/work_history',$data);
            $this->load->view('templates/footer',$data);
		}
		else
		{	
			$this->session->set_flashdata('message','Please login!');
			redirect('login');
		}
    }
    public function new_work()
	{	
        // $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Workline will start on Monday, 3 May 2021!</div></div>');
        // redirect('work');

        $this->form_validation->set_rules('work_date_open', 'work date', 'required');
        $this->form_validation->set_rules('work_area', 'work area', 'required');
        $this->form_validation->set_rules('work_title', 'work title', 'required');
        $this->form_validation->set_rules('work_description', 'work title', 'required');
        $this->form_validation->set_rules('work_exact_place', 'work exact place', 'required');
        // $this->form_validation->set_rules('work_img_open', 'work image open', 'required');
		if($this->session->userdata('id'))
		{
            
            if($this->form_validation->run()==false)
            {
                // If false
                $data['title'] = "New work";
                $usernameFromSession = $this->session->userdata('username');
                $data['userData'] = $this->User_model->userSession($usernameFromSession);
                $data['user'] = $this->User_model->getAllUser();
				$company = $data['userData']['user_company'];
				$user_id = $data['userData']['user_id'];
				$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
				$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
                $this->load->view('templates/header',$data);
                $this->load->view('work/new_work',$data);
                $this->load->view('templates/footer',$data);

            }
            else
            {
                // If true
                $this->upload_img_open();
            }
			
		}
		else
		{
			redirect('login');
		}
		
	}
    public function upload_img_open()
    {
        $path                           = './assets/img/work/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'png|gif|jpg|jpeg|tiff|pdf';
        $config['max_size']             = 5120;
        $config['file_name']            = $this->input->post('work_date_open').'_'.'O'.'_'.$this->input->post('work_area').'_'.$this->input->post('work_title');
        ini_set('memory_limit', '-1');
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('work_img_open'))
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
            $img_open_filename = $this->upload->data('file_name');
            $usernameFromSession = $this->session->userdata('username');
            $user_data = $this->User_model->userSession($usernameFromSession);
            $this->add($user_data, $img_open_filename);
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }
    public function add($user_data, $img_open_filename)
    {
        $work_date_open = $this->input->post('work_date_open');
        $work_area = $this->input->post('work_area');
        $work_title = $this->input->post('work_title');
        $work_description = $this->input->post('work_description');
        $work_status = 'OPN';
        $work_exact_place = $this->input->post('work_exact_place');
        $work_img_open = $img_open_filename;
        $work_user = $this->input->post('work_user');
        $work_company = $this->input->post('work_company');
        $work_last_modified = date('Y-m-d H:i:s');
        $email_managers = $this->User_model->getEmailManagers();
        $area = $work_area;
        $email_area = $this->User_model->getEmailArea($area);
        $email_user = $user_data['user_email'];
        $user_firstname = $user_data['user_firstname'];
        $user_lastname = $user_data['user_lastname'];
        $data = array(
            'work_date_open' => $work_date_open,
            'work_area' => $work_area,
            'work_title' => $work_title,
            'work_description' => $work_description,
            'work_status' => $work_status,
            'work_exact_place' => $work_exact_place,
            'work_last_modified' => $work_last_modified,
            'work_img_open' => $work_img_open,
            'work_user' => $work_user,
            'work_company' => $work_company,
        );
        $this->db->insert('tb_work',$data);
		
        if(
            $this->Email_model->sendWorkEmail(
            $work_date_open, 
            $work_area, 
            $work_title,
            $work_exact_place,
            $work_company,
            $email_managers,
            $email_area,
            $email_user,
            $user_firstname,
            $user_lastname
            )

        == TRUE)
        {   
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Work Successfully added and email sent!</div></div>');
            redirect('work');
        }
        else
        {   
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Saved, but email not sent!</div></div>');
            redirect('work');
        }
        
    }
    public function detail_work($id)
    {
        if($this->session->userdata('id'))
		{
			$data['title'] = "Detail Work";
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			$data['user'] = $this->User_model->getAllUser();
			$data['work'] = $this->Work_model->getThisWork($id);
			$data['comment'] = $this->Comment_model->getWorkComment();
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
			$this->load->view('templates/header',$data);
            $this->load->view('work/detail_work',$data);
            $this->load->view('templates/footer',$data);
		}
		else
		{	
			$this->session->set_flashdata('message','<div class="row col-md-12"><div class="alert alert-danger">You cannot go to home page unless you logged in!</div></div>');
			redirect('login');
		}
    }
    public function complete_work($id)
    {
        $data['title'] = "Complete Work";
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['user'] = $this->User_model->getAllUser();
        $data['work'] = $this->Work_model->getThisWork($id);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('work/complete_work',$data);
        $this->load->view('templates/footer',$data);
    }
    public function upload_work_img_close($id)
    {
        if($this->session->userdata('id'))
		{ 
            $this->form_validation->set_rules('work_id' , 'work' , 'required');
            if($this->form_validation->run()==false)
            {
                $this->session->set_flashdata('message','<div class="row col-md-12"><div class="alert alert-danger">Something went wrong!</div></div>');
                redirect('work/complete_work/'.$id);
            }
            else
            {
                $this->upload_img_close($id);
            }
			
		}
		else
		{	
			$this->session->set_flashdata('message','<div class="row col-md-12"><div class="alert alert-danger">You cannot go to home page unless you logged in!</div></div>');
			redirect('login');
		}
    }
    
    public function upload_img_close($id)
    {   
        $path                           = './assets/img/work/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'png|gif|jpg|jpeg|tiff|pdf';
        $config['max_size']             = 5120;
        $config['file_name']            = $this->input->post('work_date_open').'_'.'C'.'_'.$this->input->post('work_area').'_'.$this->input->post('work_title');
        ini_set('memory_limit', '-1');
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('work_img_close'))
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
            $img_close_filename = $this->upload->data('file_name');

            $data = array(
                'work_img_close' => $img_close_filename,
            );
            $this->db->where('work_id',$id);
            $this->db->update('tb_work', $data);
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Image uploaded!</div></div>');
            $redirect_path = 'work/complete_work/'.$id;
            redirect($redirect_path);
            
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }

    public function upload_work_permit_close($id)
    {
        if($this->session->userdata('id'))
		{ 
            $this->form_validation->set_rules('work_id' , 'work' , 'required');
            if($this->form_validation->run()==false)
            {
                $this->session->set_flashdata('message','<div class="row col-md-12"><div class="alert alert-danger">Something went wrong!</div></div>');
                redirect('work/complete_work/'.$id);
            }
            else
            {
                $this->upload_permit_close($id);
            }
			
		}
		else
		{	
			$this->session->set_flashdata('message','<div class="row col-md-12"><div class="alert alert-danger">You cannot go to home page unless you logged in!</div></div>');
			redirect('login');
		}
    }
    
    public function upload_permit_close($id)
    {   
        $path                           = './assets/img/permit_complete_work/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'png|gif|jpg|jpeg|tiff|pdf';
        $config['max_size']             = 5120;
        $config['file_name']            = $this->input->post('work_date_open').'_'.'P'.'_'.$this->input->post('work_area').'_'.$this->input->post('work_title');
        ini_set('memory_limit', '-1');
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('work_close_permit'))
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
            $permit_close_filename = $this->upload->data('file_name');

            $data = array(
                'work_close_permit' => $permit_close_filename,
            );
            $this->db->where('work_id',$id);
            $this->db->update('tb_work', $data);
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Closing Permit uploaded!</div></div>');
            $redirect_path = 'work/complete_work/'.$id;
            redirect($redirect_path);
            
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }

    
    public function close_work($work_id)
    {   
        $work_date_close = date('Y-m-d');
        $work_last_modified = date('Y-m-d H:i:s');
        $usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);

        $data = array(
            'work_status' => 'CLS',
            'work_date_close' => $work_date_close,
            'work_last_modified' => $work_last_modified,
            'work_user_close' => $user_data['user_username'],
        );
        $checked = $this->Work_model->checkOpenWorkPermit($work_id);
        $checked2 = $this->Work_model->checkProgWorkPermit($work_id);
        $checked3 = $this->Work_model->checkWorkFinalPic($work_id);
        $checked4 = $this->Work_model->checkWorkFinalPermit($work_id);
        

        if(!$checked)
        {
            if(!$checked2)
            {
                if($checked3['work_img_close'])
                {
                    if($checked4['work_close_permit'])
                    {   
                        $id = $work_id;
                        $work_data = $this->Work_model->getThisWork($id);
                        $work_area = $work_data['work_area'];
                        $work_exact_place = $work_data['work_exact_place'];
                        $work_date_open = $work_data['work_date_open'];
                        $work_date_close = $work_data['work_date_close'];
                        $work_title = $work_data['work_title'];
                        $work_status = $work_data['work_status'];
                        $work_company = $work_data['work_company'];
                        $usernameFromSession = $this->session->userdata('username');
                        $user_data = $this->User_model->userSession($usernameFromSession);
                        $user_firstname = $user_data['user_firstname'];
                        $user_lastname = $user_data['user_lastname'];
                        $email_managers = $this->User_model->getEmailManagers();
                        $area = $work_area;
                        $email_area = $this->User_model->getEmailArea($area);
                        $email_user = $user_data['user_email'];
                        $this->db->where('work_id',$work_id);
                        $this->db->update('tb_work', $data);
                        if($this->Email_model->sendWorkCompleteEmail(
                            $work_area, 
                            $work_exact_place, 
                            $work_date_open,
                            $work_date_close,
                            $work_title,
                            $work_status,
                            $work_company,
                            $user_firstname,
                            $user_lastname,
                            $email_area,
                            $email_user,
                            $email_managers
                        ) == TRUE)
                        {
                            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Work completed and email sent!</div></div>');
                            $redirect_path = 'work/complete_work/'.$work_id;
                            redirect($redirect_path);
                        }
                        else
                        {
                            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Saved, but email not sent!</div></div>');
                            $redirect_path = 'work/complete_work/'.$work_id;
                            redirect($redirect_path);
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Upload closing permit!</div></div>');
                        $redirect_path = 'work/complete_work/'.$work_id;
                        redirect($redirect_path);
                    }
                }
                else
                {
                    $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Upload final picture!</div></div>');
                    $redirect_path = 'work/complete_work/'.$work_id;
                    redirect($redirect_path);
                }
            
            }
            else
            {   
                $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Please complete all permits related to this work!</div></div>');
                $redirect_path = 'work/complete_work/'.$work_id;
                redirect($redirect_path);
            }
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Please complete all permits related to this work!</div></div>');
            $redirect_path = 'work/complete_work/'.$work_id;
            redirect($redirect_path);
        }
    }

    public function add_comment()
    {
        $comment_text = $this->input->post('comment_text');
        $comment_user_id = $this->input->post('comment_user_id');
        $comment_work_id = $this->input->post('comment_work_id');
        $data = array(
            'comment_text' => $comment_text,
            'comment_user_id' => $comment_user_id,
            'comment_work_id' => $comment_work_id,
        );
        $this->db->insert('tb_comment',$data);
        $data_work = array(
            'work_last_modified' => date('Y-m-d H:i:s'),
        );
        $this->db->where('work_id',$comment_work_id);
        $this->db->update('tb_work',$data_work);

        $id = $comment_work_id;
        $work_data = $this->Work_model->getThisWork($id);
        $user_commenter = $this->User_model->getThisUser($comment_user_id);
        $user_commenter_firstname = $user_commenter['user_firstname'];
        $user_commenter_lastname = $user_commenter['user_lastname'];
        $user_commenter_company = $user_commenter['user_company'];
        $uId = $user_commenter['user_id'];
        $work_area = $work_data['work_area'];
        $work_exact_place = $work_data['work_exact_place'];
        $work_title = $work_data['work_title'];
        $work_company = $work_data['work_company'];
        $company = $work_data['work_company'];
        $email_worker = $this->User_model->getThisEmailUser($company);
        $workers_id = $this->User_model->getIdsWorkers($company);
        $usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);
        $email_managers = $this->User_model->getEmailManagers();
        $managers_id = $this->User_model->getIdsManagers();
		$mId = $managers_id;
		$wId = $workers_id;
        $area = $work_area;
		$area_id = $this->User_model->getIdsArea($area);
		$aId = $area_id;
        $email_area = $this->User_model->getEmailArea($area);
        $email_user = $user_data['user_email'];
		//send by admin -> return ke admin
		//send by user -> return 0 admin 0
		foreach($wId as $val){
			if($val['notif_user_to'] != $user_data['user_id']) {
				if($val['user_is_manage']==1){
					} else {
						$data_notif = array(
							'notif_user_by' => $uId,
							'notif_user_to' => $val['notif_user_to'],
							'notif_company_to' => $val['notif_company_to'],
							'notif_message' => 'Commented on work '.$work_data['work_title'],
							'notif_status' => 0,
							'notif_type' => 'comment',
							'notif_link' => 'work/detail_work/'.$id,
						);
						// var_dump($data_notif);die;
						$this->db->insert('tb_notif', $data_notif);
					}
			} else {}
		}

		// send by user -> admin 1 | other user 0
		// send by admin -> admin 0 | other user 1 | coba 0
		foreach($mId as $val){
			if($val['notif_user_to'] != $user_data['user_id']) {
				if($val['user_is_manage'] != 1){
				} else {
					$data_notif = array(
						'notif_user_by' => $uId,
						'notif_user_to' => $val['notif_user_to'],
						'notif_company_to' => $val['notif_company_to'],
						'notif_message' => 'Commented on work '.$work_data['work_title'],
						'notif_status' => 0,
						'notif_type' => 'comment',
						'notif_link' => 'work/detail_work/'.$id,
					);
					// var_dump($data_notif);
					$this->db->insert('tb_notif', $data_notif);
				}
			} else {}
		}
		// send by coba -> admin 0 | other user 0

		foreach($aId as $val){
			if($val['notif_user_to'] != $user_data['user_id']) {
				if($val['user_is_manage'] == 1){
				}else {
					$data_notif = array(
						'notif_user_by' => $uId,
						'notif_user_to' => $val['notif_user_to'],
						'notif_company_to' => $val['notif_company_to'],
						'notif_message' => 'Commented on work '.$work_data['work_title'],
						'notif_status' => 0,
						'notif_type' => 'comment',
						'notif_link' => 'work/detail_work/'.$id,
					);
					// var_dump($data_notif);
					$this->db->insert('tb_notif', $data_notif);
				} 
			} else {}
		}
        if($this->Email_model->sendCommentEmail(
            $work_area, 
            $work_exact_place,
            $work_title,
            $work_company,
            $user_commenter_firstname,
            $user_commenter_lastname,
            $user_commenter_company,
            $email_area,
            $email_user,
            $email_managers,
            $email_worker,
            $comment_text
        ) == TRUE)
        {
            
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Comment posted</div></div>');
            $redirect_path = 'work/';
            redirect($redirect_path);
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-warning">Comment posted, but email not sent!</div></div>');
            $redirect_path = 'work/';
            redirect($redirect_path);
        }
   	}
	

    public function my_work()
    {
        $data['title'] = 'My Work';
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        if($data['userData']['user_role']== 0)
        {
            $data['my_permit'] = $this->Work_model->getOpenWork($usernameFromSession);
        }
        else
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitForAdmin($usernameFromSession);
        }
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('work/my_work',$data);
        $this->load->view('templates/footer',$data);
        
    }
    public function my_all_work()
    {
        $data['title'] = 'My All Work';
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        if($data['userData']['user_role']== 0)
        {
            $data['my_permit'] = $this->Work_model->getMyAllWork($usernameFromSession);
        }
        else
        {
            $data['my_permit'] = $this->Permit_model->getOpenPermitForAdmin($usernameFromSession);
        }
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('work/my_work',$data);
        $this->load->view('templates/footer',$data);
        
    }
    public function revise_work($id)
    {
        $data = array(
            'work_status' => 'OPN',
            'work_is_revised' => 1,
        );
        $this->db->where('work_id',$id);
        $this->db->update('tb_work',$data);
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Work is ready to revise!</div></div>');
        $redirect_path = 'work/complete_work/'.$id;
        redirect($redirect_path);
    }

    public function complete_work_without_pic($id)
    {
        $data = array(
            'work_status' => 'CLS',
            'work_is_revised' => 1,
        );
        $this->db->where('work_id',$id);
        $this->db->update('tb_work',$data);
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Work is completed!</div></div>');
        $redirect_path = 'work/complete_work/'.$id;
        redirect($redirect_path);
    }

    public function delete_img_close($id)
    {   
        $work = $this->Work_model->getThisWork($id);
        $doc = $work['work_img_close'];
        $path = './assets/img/work/';
        $file = $path.$doc;
        if(!unlink($file)){
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Something went wrong.</div></div>');
            $redirect_path = 'work/complete_work/'.$id;
            redirect($redirect_path);
        }
        else{
        
        $data = array(
            'work_img_close' => '',
        );
        $this->db->where('work_id',$id);
        $this->db->update('tb_work',$data);
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Image deleted</div></div>');
        $redirect_path = 'work/complete_work/'.$id;
        redirect($redirect_path);
        }
    }

    public function delete_work_close_permit($id)
    {
        $work = $this->Work_model->getThisWork($id);
        $doc = $work['work_close_permit'];
        $path = './assets/img/permit_complete_work/';
        $file = $path.$doc;
        if(!unlink($file)){
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Something went wrong.</div></div>');
            $redirect_path = 'work/complete_work/'.$id;
            redirect($redirect_path);
        }
        else{
        
        $data = array(
            'work_close_permit' => '',
        );
        $this->db->where('work_id',$id);
        $this->db->update('tb_work',$data);
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Closing permit deleted</div></div>');
        $redirect_path = 'work/complete_work/'.$id;
        redirect($redirect_path);
        }
    }

	public function delete_work($id)
	{
		$work = $this->Work_model->getThisWork($id);
		$permit = $this->Permit_model->getThisPermit($id);

		//Deleting permits
        $path_permit = './assets/img/permit/';

		foreach($permit as $val ){
			if(!$val['permit_attach']){} 
			else {
			$file_permit = $path_permit.$val['permit_attach'];
			if(!unlink($file_permit)){}
			}
		}

		//Deleting permit complete pictures
        $path_permit_comp = './assets/img/permit_complete/';

		foreach($permit as $val_comp ){
			if(!$val_comp['permit_complete_pic']){} 
			else {
			$file_permit_comp = $path_permit_comp.$val_comp['permit_complete_pic'];
			if(!unlink($file_permit_comp)){}
			}
		}

		//Deleting img open
		$img_open = $work['work_img_open'];
        $path_img_open = './assets/img/work/';
        $file_img_open = $path_img_open.$img_open;
		if(!unlink($file_img_open)){}

		//Deleting permits from MySQL
		$this->db->where('permit_work_id',$id);
        $this->db->delete('tb_permit');

		//Deleting comment
        $this->db->where('comment_work_id',$id);
        $this->db->delete('tb_comment');

		//Deleting closing permit
        $close_permit = $work['work_close_permit'];
        $path_close_permit = './assets/img/permit_complete_work/';
        $file_close_permit = $path_close_permit.$close_permit;
		if(!unlink($file_close_permit)){}

		//Deleting img close
		$img_close = $work['work_img_close'];
        $path_img_close = './assets/img/work/';
        $file_img_close = $path_img_close.$img_close;
		if(!unlink($file_img_close)){}

		//Deleting work
        $this->db->where('work_id',$id);
        $this->db->delete('tb_work');
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Work deleted</div></div>');
        $redirect_path = 'work';
        redirect($redirect_path);
	}
}
