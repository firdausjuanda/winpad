<?php
class Notif extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Permit_model');
        $this->load->model('User_model');
        $this->load->model('Work_model');
        $this->load->model('Permit_model');
        $this->load->model('Comment_model');
        $this->load->model('Email_model');
        $this->load->model('Notif_model');
        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        if($this->session->userdata('id'))
		{
			$data['title'] = "Notification";
			$usernameFromSession = $this->session->userdata('username');
			$data['userData'] = $this->User_model->userSession($usernameFromSession);
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotifNoLimit($company);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
			$data['user'] = $this->User_model->getAllUser();
			$data['work'] = $this->Work_model->getAllWork();
			$data['comment'] = $this->Comment_model->getWorkComment();
			$this->load->view('templates/header',$data);
            $this->load->view('notif/all_notif',$data);
            $this->load->view('templates/footer',$data);
		}
		else
		{	
			$this->session->set_flashdata('message','Please login!');
			redirect('login');
		}
    }

	public function goto($id)
    {
		
		$notif_data = $this->Notif_model->getThisNotif($id);
		$link = $notif_data['notif_link'];

		$data = array(
			'notif_status' => 1,
		);
		$this->db->where('notif_id',$id);
		$this->db->update('tb_notif', $data);
		redirect($link);
	}
}
