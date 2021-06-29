<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Docline extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Doc_model');
        $this->load->model('Notif_model');
        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
		$usernameFromSession = $this->session->userdata('username');
        $userData = $this->User_model->userSession($usernameFromSession);
        if($usernameFromSession == null)
        {
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Please Login!</span>");
            $redirect_path = 'login';
            redirect($redirect_path);
        }
		if($userData['user_docline_access']==0)
        {
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Not allowed!</span>");
            $redirect_path = 'work';
            redirect($redirect_path);
        }
    }

    public function index()
    {
        $data['title'] = "Docline";
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('doc/index',$data);
        $this->load->view('templates/footer',$data);
    }

    public function licence()
    {
        $data['title'] = "Licence List";
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['all_licence'] = $this->Doc_model->getAllLicence();
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('doc/list_licence',$data);
        $this->load->view('templates/footer',$data);
    }

    public function upload_doc($id)
    {
        $data['title'] = "Upload Document";
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
        $data['this_licence'] = $this->Doc_model->getThisLicence($id);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('doc/upload_doc_licence',$data);
        $this->load->view('templates/footer',$data);
    }

    public function add_licence()
    {  
        $this->form_validation->set_rules('licence_name', 'licence name', 'required');
        if($this->form_validation->run()==false)
        {
            // If false
            $data['title'] = "Add Licence";
            $usernameFromSession = $this->session->userdata('username');
            $data['userData'] = $this->User_model->userSession($usernameFromSession);
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
            $this->load->view('templates/header',$data);
            $this->load->view('doc/add_licence',$data);
            $this->load->view('templates/footer',$data);

        }
        else
        {
            // If true
            $licence_start_date = $this->input->post('licence_start_date');
            $licence_expire_date = $this->input->post('licence_expire_date');
            $licence_company = $this->input->post('licence_company');
            $licence_name = $this->input->post('licence_name');
            $licence_category = $this->input->post('licence_category');
            $licence_no = $this->input->post('licence_no');
            $licence_status = 'VALID';
            $licence_person = $this->input->post('licence_person');
            $licence_by = $this->input->post('licence_by');
            $licence_note = $this->input->post('licence_note');
            $licence_user_id = $this->input->post('licence_user_id');

            $data = array(
                'licence_name' => $licence_name,
                'licence_category' => $licence_category,
                'licence_no' => $licence_no,
                'licence_by' => $licence_by,
                'licence_note' => $licence_note,
                'licence_status' => $licence_status,
                'licence_person' => $licence_person,
                'licence_start_date' => $licence_start_date,
                'licence_expire_date' => $licence_expire_date,
                'licence_user_id' => $licence_user_id,
                'licence_company' => $licence_company,
            );
            $this->db->insert('tb_licence',$data);
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Licence added!</span>");
            $redirect_path = 'docline/licence';
            redirect($redirect_path);
            
        }
    }

    public function licence_edit($id)
    {  
        $this->form_validation->set_rules('licence_id', 'licence id', 'required');
        if($this->form_validation->run()==false)
        {
            // If false
            $data['title'] = "Edit Licence";
            $usernameFromSession = $this->session->userdata('username');
            $data['userData'] = $this->User_model->userSession($usernameFromSession);
            $data['this_licence'] = $this->Doc_model->getThisLicence($id);
			$company = $data['userData']['user_company'];
			$user_id = $data['userData']['user_id'];
			$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
			$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
            $this->load->view('templates/header',$data);
            $this->load->view('doc/edit_licence',$data);
            $this->load->view('templates/footer',$data);

        }
        else
        {
            // If true
            $licence_start_date = $this->input->post('licence_start_date');
            $licence_expire_date = $this->input->post('licence_expire_date');
            $licence_company = $this->input->post('licence_company');
            $licence_name = $this->input->post('licence_name');
            $licence_category = $this->input->post('licence_category');
            $licence_no = $this->input->post('licence_no');
            $licence_status = 'VALID';
            $licence_person = $this->input->post('licence_person');
            $licence_by = $this->input->post('licence_by');
            $licence_note = $this->input->post('licence_note');
            $licence_user_id = $this->input->post('licence_user_id');

            $data = array(
                'licence_name' => $licence_name,
                'licence_category' => $licence_category,
                'licence_no' => $licence_no,
                'licence_by' => $licence_by,
                'licence_note' => $licence_note,
                'licence_status' => $licence_status,
                'licence_person' => $licence_person,
                'licence_start_date' => $licence_start_date,
                'licence_expire_date' => $licence_expire_date,
                'licence_user_id' => $licence_user_id,
                'licence_company' => $licence_company,
            );
            $this->db->where('licence_id',$id);
            $this->db->update('tb_licence',$data);
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Licence updated!</span>");
            $redirect_path = 'docline/licence';
            redirect($redirect_path);
            
        }
    }

    public function licence_delete($id)
    {   
        $licence_data = $this->Doc_model->getThislicenceToDelete($id);
        $usernameFromSession = $this->session->userdata('username');
        $user_data = $this->User_model->userSession($usernameFromSession);
        if($user_data['user_docline_super'] == 1)
        {
            $licence = $this->Doc_model->getThisLicence($id);
            $doc = $licence['licence_doc'];
            $path = './assets/doc/licence/';
            $file = $path.$doc;

            if(!unlink($file)){
                $message = "Licence deleted without attachment";

            }
            else{
                    $message = "Licence and attachment deleted";
                }
            
            $this->db->where('licence_id',$id);
            $this->db->delete('tb_licence');
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>$message</span>");
            $redirect_path = 'docline/licence/';
            redirect($redirect_path);
        }

        
        $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Not allowed!</span>");
        $redirect_path = 'docline/licence/';
        redirect($redirect_path);
        
    }

    public function upload_licence_doc($id)
    {   
        $path                           = './assets/doc/licence/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 5120;
        $config['file_name']            = $this->input->post('licence_id').'_'.$this->input->post('licence_name').'_'.$this->input->post('licence_no');
        ini_set('memory_limit', '-1');
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // var_dump($this->load->library('upload', $config));die;

        if ($this->upload->do_upload('upload_licence_doc'))
        {
            $licence_doc = $this->upload->data('file_name');
            $data = array(
                'licence_doc' => $licence_doc,
            );
            $this->db->where('licence_id',$id);
            $this->db->update('tb_licence', $data);
            $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Document uploaded!</span>");
            $redirect_path = 'docline/licence/';
            redirect($redirect_path);
            
        }
        else
        {   
            $err = $this->upload->display_errors();
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Fail! $err</span>");
            $redirect_path = 'docline/licence/'.$id;
            redirect($redirect_path);
        }
    }

    public function delete_licence($id)
    {
        $licence = $this->Doc_model->getThisLicence($id);
        $doc = $licence['licence_doc'];
        $path = './assets/doc/licence/';
        $file = $path.$doc;
        if(!unlink($file)){
            $this->session->set_flashdata('message', "<span style='background-color: red; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Something went wrong!</span>");
            $redirect_path = 'work/complete_work/'.$id;
            redirect($redirect_path);
        }
        else{
        
        $data = array(
            'licence_doc' => '',
        );
        $this->db->where('licence_id',$id);
        $this->db->update('tb_licence',$data);
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>Licence deleted!</span>");
        $redirect_path = 'docline/licence/';
        redirect($redirect_path);
        }
    }

}
