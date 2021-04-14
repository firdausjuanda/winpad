<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work extends CI_Controller{
    public function __construct()
	{
		parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('Work_model');
        $this->load->model('Email_model');
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
        $config['upload_path']          = './assets/img/work/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['file_name']            = $this->input->post('work_date_open').'_'.'O'.'_'.$this->input->post('work_area').'_'.$this->input->post('work_title');
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('work_img_open'))
        {
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
                echo "Success";
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
        $config['upload_path']          = './assets/img/work/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['file_name']            = $this->input->post('work_date_open').'_'.'C'.'_'.$this->input->post('work_area').'_'.$this->input->post('work_title');
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('work_img_close'))
        {
            $img_close_filename = $this->upload->data('file_name');
            $usernameFromSession = $this->session->userdata('username');
            $user_data = $this->User_model->userSession($usernameFromSession);
            $this->_close($user_data, $img_close_filename);
        }
        else
        {   
            echo $this->upload->display_errors();
        }
    }
    private function _close($user_data, $img_close_filename)
    {
        $work_status = 'CLS';
        $work_img_close = $img_close_filename;
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
            'work_last_modified' => $work_last_modified,
            'work_img_close' => $work_img_close,
            'work_user_close' => $work_user_close,
            'work_company' => $work_company,
        );
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
}