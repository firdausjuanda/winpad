<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Notif_model');
        $usernameFromSession = $this->session->userdata('username');
        $user = $this->User_model->userSession($usernameFromSession);
        $user_role = $user['user_role'];
        if($usernameFromSession == null)
        {
            $this->session->set_flashdata('message', "<div class='row col-md-12'><div class='alert alert-danger'>Please Login</div></div>");
            $redirect_path = 'login';
            redirect($redirect_path);
        }

        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
    }

	public function index(){
		$data['title'] = 'Company';
		$usernameFromSession = $this->session->userdata('username');
		$data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$data['component_search'] = 'component/search';
		$data['component_area_chart_work'] = 'component/area_chart_work';
		$this->load->view('templates/header',$data);
		$this->load->view('company/dashboard', $data);
		$this->load->view('templates/footer',$data);
	}

}
