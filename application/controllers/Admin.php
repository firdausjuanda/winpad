<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
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
        if($user_role==0)
        {
            $this->session->set_flashdata('message', "<div class='row col-md-12'><div class='alert alert-danger'>You are not allowed to access admin page!</div></div>");
            $redirect_path = 'work';
            redirect($redirect_path);
        }

        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $data['title'] = 'Administrator';
        $usernameFromSession = $this->session->userdata('username');
        $data['userData'] = $this->User_model->userSession($usernameFromSession);
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('admin/index',$data);
        $this->load->view('templates/footer',$data);
    }

    public function userManage()
    {
		$usernameFromSession = $this->session->userdata('username');
        $data = array(
            'title' => 'User Management',
            'userData' => $this->User_model->userSession($usernameFromSession),
            'allUser' => $this->User_model->getAllUser(),
        );
		$company = $data['userData']['user_company'];
		$user_id = $data['userData']['user_id'];
		$data['notif'] = $this->Notif_model->getMyCompanyNotif($user_id);
		$data['count_notif'] = $this->Notif_model->countMyCompanyNotif($company, $user_id);
        $this->load->view('templates/header',$data);
        $this->load->view('admin/user',$data);
        $this->load->view('templates/footer',$data);
    }

    public function dissable_user($id)
    {
        $user = $this->User_model->getThisUser($id);
        $username = $user['user_username'];
        $data = array(
            'user_status' => 0,
        );
        $this->db->where('user_id',$id);
        $this->db->update('tb_user',$data);
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>$username dissable!</span>");
        $redirect_path = 'admin/userManage/';
        redirect($redirect_path);
    }

    public function enable_user($id)
    {
        $user = $this->User_model->getThisUser($id);
        $username = $user['user_username'];
        $data = array(
            'user_status' => 1,
        );
        $this->db->where('user_id',$id);
        $this->db->update('tb_user',$data);
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>$username enabled!</span>");
        $redirect_path = 'admin/userManage/';
        redirect($redirect_path);
    }
    public function set_admin($id)
    {
        $user = $this->User_model->getThisUser($id);
        $username = $user['user_username'];
        $data = array(
            'user_role' => 1,
        );
        $this->db->where('user_id',$id);
        $this->db->update('tb_user',$data);
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>$username is admin now!</span>");
        $redirect_path = 'admin/userManage/';
        redirect($redirect_path);
    }
    public function unset_admin($id)
    {
        $user = $this->User_model->getThisUser($id);
        $username = $user['user_username'];
        $data = array(
            'user_role' => 0,
        );
        $this->db->where('user_id',$id);
        $this->db->update('tb_user',$data);
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>$username is not admin now!</span>");
        $redirect_path = 'admin/userManage/';
        redirect($redirect_path);
    }
    public function set_manage($id)
    {
        $user = $this->User_model->getThisUser($id);
        $username = $user['user_username'];
        $data = array(
            'user_is_manage' => 1,
        );
        $this->db->where('user_id',$id);
        $this->db->update('tb_user',$data);
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>$username is management now!</span>");
        $redirect_path = 'admin/userManage/';
        redirect($redirect_path);
    }
    public function unset_manage($id)
    {
        $user = $this->User_model->getThisUser($id);
        $username = $user['user_username'];
        $data = array(
            'user_is_manage' => 0,
        );
        $this->db->where('user_id',$id);
        $this->db->update('tb_user',$data);
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>$username is not management now!</span>");
        $redirect_path = 'admin/userManage/';
        redirect($redirect_path);
    }
    public function delete_user($id)
    {
        $this->db->where('user_id',$id);
        $this->db->delete('tb_user');
        $this->session->set_flashdata('message', "<span style='background-color: green; color:white; position: absolute; top:13px; right:50px; border-radius:20px; padding:0px 7px; margin:auto;'>User deleted!</span>");
        $redirect_path = 'admin/userManage/';
        redirect($redirect_path);
    }
}
