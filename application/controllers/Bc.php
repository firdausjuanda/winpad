<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bc extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Notif_model');
        $this->load->model('Bc_model');
        $usernameFromSession = $this->session->userdata('username');
        $user = $this->User_model->userSession($usernameFromSession);
        $user_role = $user['user_role'];
        if($usernameFromSession == null)
        {
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Please login!</span>");
            $redirect_path = 'login';
            redirect($redirect_path);
        }
        if($user_role==0)
        {
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Not allowed!</span>");
            $redirect_path = 'work';
            redirect($redirect_path);
        }

        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
		$this->form_validation->set_rules('bc_title', 'Title', 'required');
		if($this->form_validation->run()==false){
			$data['title'] = 'Broadcast';
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			$data['bc'] = $this->Bc_model->getBcToUpdate();
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
			$this->load->view('templates/header',$data);
			$this->load->view('admin/bc',$data);
			$this->load->view('templates/footer',$data);
		} else {
			$data = array(
			'bc_title' => $this->input->post('bc_title'),
			'bc_message' => $this->input->post('bc_message'),
			'bc_displayed' => $this->input->post('bc_displayed'),
			);
			$this->db->where('bc_id',1);
			$this->db->update('tb_bc', $data);
			$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Broadcast saved!</span>");
            $redirect_path = 'admin';
            redirect($redirect_path);
		}
        
    }
}
