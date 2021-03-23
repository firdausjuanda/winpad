<?php
class My_permit extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Permit_model');
        $this->load->model('User_model');
    }
    public function index()
    {
        $data['title'] = 'My Permit';
        $usernameFromSession = $this->session->userdata('username');
        $data['my_permit'] = $this->Permit_model->getMyPermit($usernameFromSession);
        $this->load->view('my_permit',$data);
    }

}