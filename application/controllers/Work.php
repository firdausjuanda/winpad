<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work extends CI_Controller{
    public function __construct()
	{
		parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('Work_model');
        $this->load->model('Email_model');
        $this->load->helper(array('form', 'url'));
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
			$this->load->view('templates/header',$data);
            $this->load->view('all_work',$data);
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
                $this->load->view('new_work',$data);
                $this->load->view('templates/footer',$data);

            }
            else
            {
                // If true
                $this->do_upload();
            }
			
		}
		else
		{
			redirect('login');
		}
		
	}
    public function do_upload()
    {
        $config['upload_path']          = './assets/img/img_open/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['file_name']            = $this->input->post('work_date_open').'_'.$this->input->post('work_area').'_'.$this->input->post('work_title');
        
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
        $work_status = 'OPN';
        $work_exact_place = $this->input->post('work_exact_place');
        $work_img_open = $img_open_filename;
        $work_user = $this->input->post('work_user');
        $work_company = $this->input->post('work_company');

        $data = array(
            'work_date_open' => $work_date_open,
            'work_area' => $work_area,
            'work_title' => $work_title,
            'work_status' => $work_status,
            'work_exact_place' => $work_exact_place,
            'work_img_open' => $work_img_open,
            'work_user' => $work_user,
            'work_company' => $work_company,
        );
        $this->db->insert('tb_work',$data);
        if($this->Email_model->workEmail(
            $user_data, 
            $work_date_open, 
            $work_area, 
            $work_title,
            $work_status,
            $work_exact_place,
            $work_user,
            $work_company
            ))
        {   
            $this->session->set_flashdata('success', 'work Successfully added and email sent!');
            redirect('home');
        }
        else
        {
            Echo "error sending email";
        }
        $this->session->set_flashdata('success','Work successfully added and email sent!');
		redirect('work');
        
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
            $this->load->view('detail_work',$data);
            $this->load->view('templates/footer',$data);
		}
		else
		{	
			$this->session->set_flashdata('message','You cannot go to home page unless you logged in!');
			redirect('login');
		}
    }
}