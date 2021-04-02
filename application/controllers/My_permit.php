<?php
class My_permit extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Permit_model');
        $this->load->model('User_model');
        $this->load->model('Work_model');
    }
    public function index()
    {
        $data['title'] = 'My Permit';
        $usernameFromSession = $this->session->userdata('username');
        $data['my_permit'] = $this->Permit_model->getMyPermit($usernameFromSession);
        $this->load->view('templates/header',$data);
        $this->load->view('my_permit',$data);
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
        $this->load->view('this_work_permit',$data);
        $this->load->view('templates/footer',$data);
    }

}