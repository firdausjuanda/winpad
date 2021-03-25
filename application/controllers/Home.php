<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('User_model');
		$this->load->model('Permit_model');
	}
	public function index()
	{	
		if($this->session->userdata('id'))
		{
			$data['title'] = "This is Home";
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			$data['user'] = $this->User_model->getAllUser();
			$data['permit'] = $this->Permit_model->getAllPermit();
			$this->load->view('home',$data);
		}
		else
		{	
			$this->session->set_flashdata('message','You cannot go to home page unless you logged in!');
			redirect('login');
		}
		
	}
}
