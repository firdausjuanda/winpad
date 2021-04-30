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
			$data['user'] = $this->User_model->getAllUser();
			$data['work'] = $this->Work_model->getAllWork();
			$data['comment'] = $this->Comment_model->getWorkComment();
			$this->load->view('templates/header',$data);
            $this->load->view('work/all_work',$data);
            $this->load->view('templates/footer',$data);
		}
		else
		{	
			$this->session->set_flashdata('message','You cannot go to home page unless you logged in!');
			redirect('login');
		}
    }
    public function new_work()
	{	
        $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Workline will start on Monday, 3 May 2021!</div></div>');
        redirect('work');

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
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        // $config['max_size']             = 4096;
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
            $config['quality'] = '100%';  
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
        $work_last_modified = date('Y-m-j H:i:s');

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
        
        // if($this->Email_model->sendWorkEmail(
        //     $work_date_open, 
        //     $work_area, 
        //     $work_title,
        //     $work_status,
        //     $work_exact_place,
        //     $work_user,
        //     $work_company
        // ) == TRUE)
        // {   
            $this->db->insert('tb_work',$data);
            $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Work Successfully added and email sent!</div></div>');
            redirect('work');
        // }
        // else
        // {   
        //     $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Something went wrong!</div></div>');
        //     redirect('work');
        // }
        // $this->session->set_flashdata('success','<div class="row col-md-12"><div class="alert alert-success">Work Successfully added and email sent!</div></div>');
		// redirect('work');
        
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
        if($this->session->userdata('id'))
		{ 
            $this->form_validation->set_rules('work_id' , 'work' , 'required');
            if($this->form_validation->run()==false)
            {
                $data['title'] = "Complete Work";
                $usernameFromSession = $this->session->userdata('username');
                $data['userData'] = $this->User_model->userSession($usernameFromSession);
                $data['user'] = $this->User_model->getAllUser();
                $data['work'] = $this->Work_model->getThisWork($id);
                $this->load->view('templates/header',$data);
                $this->load->view('work/complete_work',$data);
                $this->load->view('templates/footer',$data);
                // $this->load->view('try', $data);
            }
            else
            {
                $this->upload_img_close();
            }
			
		}
		else
		{	
			$this->session->set_flashdata('message','<div class="row col-md-12"><div class="alert alert-danger">You cannot go to home page unless you logged in!</div></div>');
			redirect('login');
		}
    }
    
    public function upload_img_close()
    {   
        $path                           = './assets/img/work/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 4096;
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
            $config['quality'] = '80%';  
            $config['width'] = 1080;  
            $config['new_image'] = $path.$data["file_name"];  
            $this->load->library('image_lib', $config);  
            $this->image_lib->resize();
            $img_close_filename = $this->upload->data('file_name');
            $this->upload_close_permit($img_close_filename);
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }
    public function upload_close_permit($img_close_filename)
    {   
        $path                           = './assets/img/permit_complete_work/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 4096;
        $config['file_name']            = $this->input->post('work_date_open').'_'.'CP'.'_'.$this->input->post('work_area').'_'.$this->input->post('work_title');
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
            $config['quality'] = '100%';  
            $config['width'] = 1080;  
            $config['new_image'] = $path.$data["file_name"];  
            $this->load->library('image_lib', $config);  
            $this->image_lib->resize();
            $work_close_permit_filename = $this->upload->data('file_name');
            $usernameFromSession = $this->session->userdata('username');
            $user_data = $this->User_model->userSession($usernameFromSession);
            $this->_close($user_data, $img_close_filename, $work_close_permit_filename);
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }
    private function _close($user_data, $img_close_filename, $work_close_permit_filename)
    {   
        $work_status = 'CLS';
        $work_img_close = $img_close_filename;
        $work_close_permit = $work_close_permit_filename;
        $work_title = $this->input->post('work_title');
        $work_date_open = $this->input->post('work_date_open');
        $work_date_close = date('Y-m-j');
        $work_last_modified = date('Y-m-j H:i:s');
        $work_area = $this->input->post('work_area');
        $work_user_close = $this->input->post('work_user');
        $work_company = $this->input->post('work_company');
        $work_id = $this->input->post('work_id');

        $data = array(
            'work_area' => $work_area,
            'work_status' => $work_status,
            'work_date_close' => $work_date_close,
            'work_close_permit' => $work_close_permit,
            'work_last_modified' => $work_last_modified,
            'work_img_close' => $work_img_close,
            'work_user_close' => $work_user_close,
            'work_company' => $work_company,
        );
        $checked = $this->Work_model->checkOpenWorkPermit($work_id);
        $checked2 = $this->Work_model->checkProgWorkPermit($work_id);
        if(!$checked)
        {
            if(!$checked2)
            {
            // if($this->Email_model->sendWorkCompleteEmail(
            //     $user_data, 
            //     $work_area, 
            //     $work_date_open,
            //     $work_date_close,
            //     $work_title,
            //     $work_status,
            //     $work_user_close,
            //     $work_company
            // ) == TRUE)
            // {
                $this->db->where('work_id',$work_id);
                $this->db->update('tb_work', $data);
                $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-success">Work Successfully added and email sent!</div></div>');
                $redirect_path = 'work/complete_work/'.$work_id;
                redirect($redirect_path);
            // }
            // else
            // {
            //     $this->session->set_flashdata('message', '<div class="row col-md-12"><div class="alert alert-danger">Something went wrong!</div></div>');
            //     $redirect_path = 'work/complete_work/'.$work_id;
            //     redirect($redirect_path);
            // }
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
            'work_last_modified' => date('Y-m-j H:i:s'),
        );
        $this->db->where('work_id',$comment_work_id);
        $this->db->update('tb_work',$data_work);
        redirect('work');
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
}