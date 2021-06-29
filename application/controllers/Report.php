<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_model');
		$this->load->model('User_model');
		$this->load->model('Notif_model');
		$this->load->model('Dept_model');
		$this->load->model('Permit_model');
		$this->load->helper('form', 'url');
        date_default_timezone_set('Asia/Jakarta');
        
	}

	public function permit(){
		$data['title'] = 'Report';
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userAndCompanyAndDepSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['permit_type'] = $this->Permit_model->getPermitType();
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$this->load->view('templates/header', $data);
		$this->load->view('report/report_filter', $data);
		$this->load->view('templates/footer');
	}

	public function permit_filter_post(){
		$data['title'] = 'Report';
		$usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userAndCompanyAndDepSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['permit_type'] = $this->Permit_model->getPermitType();
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
		$data['what_user'] = $this->User_model->getAllUser();
		
		// Collection data from filter
		$permit_type = $this->input->post('permit_type');
		$date_start = $this->input->post('date_start');
		$date_finish = $this->input->post('date_finish');
		$company_name = $this->input->post('company_name');
		$dept_name = $this->input->post('dept_name');

		// Call model 
		$data['permit_data'] = $this->Permit_model->getPermitByFilter($permit_type, $date_start, $date_finish, $company_name, $dept_name);
		$this->load->view('templates/header', $data);
		$this->load->view('report/report_table', $data);
		$this->load->view('templates/footer');
	
	}

	public function exportExcel(){
		$data_export_xlsx = $this->Permit_model->getPermitType();

		include_once APPPATH.'/third_party/xlsxwriter.class.php';
		ini_set('display_errors', 0);
		ini_set('log_errors', 1);
		error_reporting(E_ALL & ~E_NOTICE);

		$filename = "Report-".date('d-m-Y-H-i-s').".xlsx";
		header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');

		$styles = array('widths'=>[3,20,30,30,30,30,30,30,30], 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom');
		$styles2 = array( ['font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'left', 'border'=>'left,right,top,bottom','fill'=>'#ffc'],[],[],[],);

		$header = array(
			'No'=>'integer',
			'Date'=>'string',
			'Type'=>'string',
			'Status'=>'string',
			'Permit No'=>'integer',
			'Description'=>'string',
			'Work'=>'string',
			'Work detail'=>'string',
			'Giver'=>'string',
		);

		$writer = new XLSXWriter();
		$writer->setAuthor('Winpad System');

		$writer->writeSheetHeader('Sheet1', $header, $styles);
		$no = 1;
		foreach($data_export_xlsx as $row){
			$writer->writeSheetRow('Sheet1', [$no, $row['permit_date'], $row['permit_category'], $row['permit_no'], $row[' mat_desc'], $row['work_title'], $row['permit_description'], $row['permit_giver']], $styles2);
			$no++;
		}
		$writer->writeToStdOut();
	}
}
