<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Stock_model');
		$this->load->model('User_model');
		$this->load->model('Notif_model');
		$this->load->model('Permit_model');
        date_default_timezone_set('Asia/Jakarta');
		$usernameFromSession = $this->session->userdata('username');
        $user = $this->User_model->userSession($usernameFromSession);
        $user_role = $user['user_role'];
        if($usernameFromSession == null)
        {
            $this->session->set_flashdata('message', "<div class='row col-md-12'><div class='alert alert-danger'>Please Login</div></div>");
            $redirect_path = 'login';
            redirect($redirect_path);
        }
	}

	public function index() {
		$data['title'] = 'Stock Management';
		$data['all_stock'] = $this->Stock_model->getAllStock();
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->load->view('templates/header', $data);
		$this->load->view('stock/index', $data);
		$this->load->view('templates/footer');

	}
	public function all_stock() {
		// Count permit used
		$data['HOWPused'] = $this->Permit_model->countUsedHOWP();
		$data['WAHPused'] = $this->Permit_model->countUsedWAHP();
		$data['COWPused'] = $this->Permit_model->countUsedCOWP();
		$data['CSEPused'] = $this->Permit_model->countUsedCSEP();
		$data['LOWPused'] = $this->Permit_model->countUsedLOWP();
		$data['LIWPused'] = $this->Permit_model->countUsedLIWP();
		$data['EXWPused'] = $this->Permit_model->countUsedEXWP();
		$data['HLWPused'] = $this->Permit_model->countUsedHLWP();

		// Count permit added
		$data['HOWPadded'] = $this->Permit_model->countAddedHOWP();
		$data['WAHPadded'] = $this->Permit_model->countAddedWAHP();
		$data['COWPadded'] = $this->Permit_model->countAddedCOWP();
		$data['CSEPadded'] = $this->Permit_model->countAddedCSEP();
		$data['LOWPadded'] = $this->Permit_model->countAddedLOWP();
		$data['LIWPadded'] = $this->Permit_model->countAddedLIWP();
		$data['EXWPadded'] = $this->Permit_model->countAddedEXWP();
		$data['HLWPadded'] = $this->Permit_model->countAddedHLWP();

		// Count stock permit

		$data['title'] = 'All Stocks';
		$data['permits'] = $this->Permit_model->getPermitType();
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->load->view('templates/header', $data);
		$this->load->view('stock/all_stock', $data);
		$this->load->view('templates/footer');

	}
	public function transaction() {
		$data['title'] = 'Transaction';
		$data['all_trans'] = $this->Stock_model->getAllTrans();
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->load->view('templates/header', $data);
		$this->load->view('stock/transaction', $data);
		$this->load->view('templates/footer');

	}
	public function detail_transaction($id) {
		$data['title'] = 'Stock Management';
		$data['all_stock'] = $this->Stock_model->getAllStock();
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->load->view('templates/header', $data);
		$this->load->view('stock/index', $data);
		$this->load->view('templates/footer');

	}

	public function topup($mat_type){
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$data['mat_data'] = $this->Stock_model->getMaterialByMatNo($mat_type);
		$count_permit_used = $this->Stock_model->countPermitByType($mat_type);
		$count_permit_added = $this->Stock_model->sumPermitAddedByType($mat_type);
		$data['permit_stock'] = $count_permit_added['pa_qty'] - $count_permit_used;
		$data['title'] = $data['mat_data']['mat_desc'];
		if($data['mat_data']){
			$this->load->view('templates/header', $data);
			$this->load->view('stock/topup', $data);
			$this->load->view('templates/footer');
		} else {
			$this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Material not found!</span>");
			$this->load->view('templates/header', $data);
			$this->load->view('stock/topup_filter', $data);
			$this->load->view('templates/footer');
		}

	}
	public function topup_filter(){
		$data['title'] = 'Top Up Permit';
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['permit_type'] = $this->Permit_model->getPermitType();
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->load->view('templates/header', $data);
		$this->load->view('stock/topup_filter', $data);
		$this->load->view('templates/footer');
	}

	public function get_topup_filter(){
		$mat_type = $this->input->post('mat_type');
		redirect('stock/topup/'.$mat_type);
	}

	public function topup_posting($mat_id){
		$qty = $this->input->post('stock_add');
		$type = $this->input->post('stock_type');
		$data = [
			'pa_qty' => $qty,
			'pa_type' => $type,
		];
		$this->db->insert('tb_permit_add', $data);
		$this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Success!</span>");
		$redirect_path = 'stock/all_stock';
		redirect($redirect_path);
	}
}
