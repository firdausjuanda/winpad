<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{	
		if($this->session->userdata('id'))
		{
			$this->load->model('User_model');
			$data['title'] = "This is Home";
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			$data['user'] = $this->User_model->getAllUser();
			$this->load->view('home',$data);
		}
		else
		{
			redirect('login');
		}
		
	}
}
