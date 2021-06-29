<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permit_model extends CI_Model {
	public function getAllPermit(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyPermit($usernameFromSession){ 
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyPermitByCompany($company){ 
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOpenPermitForAdmin(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getProgPermitForAdmin(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('permit_status', 'PRG', 'left');
        $this->db->where('permit_is_approved1', 1, 'left');
        $this->db->where('permit_is_approved2', 1, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPendPermitForAdmin(){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        // $this->db->where('permit_status', 'REL', 'left');
        $this->db->where("permit_status = 'REL'");
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getOpenPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getOpenPermitByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
        $this->db->where('permit_status', 'OPN', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getAllMyPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getMyProgPermit($usernameFromSession){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_username', $usernameFromSession, 'left');
        $this->db->where('permit_status', 'REL', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyProgPermitByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
        $this->db->where('permit_status', 'PRG', 'left');
        $this->db->where('permit_is_approved1', 1, 'left');
        $this->db->where('permit_is_approved2', 1, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getMyPendPermitByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_user','tb_user.user_username=tb_permit.permit_user','tb_permit', 'left');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('user_company', $company, 'left');
        $this->db->where('permit_status', 'REL', 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getThisPermit($id){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('permit_work_id', $id, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getThisPermitToDelete($id){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('permit_id', $id, 'left');
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getWorkByPermit($id){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->join('tb_work','tb_work.work_id=tb_permit.permit_work_id','tb_permit', 'left');
        $this->db->join('tb_dept','tb_dept.dept_id=tb_permit.permit_area','tb_permit', 'left');
        $this->db->where('permit_id', $id);
        $this->db->order_by('permit_id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getPermitToRelease($user_name){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getPermitToReleaseByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_company',$company);
        $this->db->where('permit_attach_status', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getPermitEmptyByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_company',$company);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitToSend($user_name){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $this->db->order_by('permit_work_id','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitWorkIdToSend($user_name){
        $this->db->distinct();
        $this->db->select('permit_work_id');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitAreaToSend($user_name){
        $this->db->distinct();
        $this->db->select('permit_area');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','OPN');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getPermitToComplete($user_name){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','REL');
        $this->db->where('permit_user',$user_name);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPermitToCompleteByCompany($company){
        $this->db->select('*');
        $this->db->from('tb_permit');
        $this->db->where('permit_status','PRG');
        $this->db->where('permit_company',$company);
        $this->db->where('permit_attach_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
	public function getPermitById($id){
		return $this->db
		->select('*')
		->from('tb_permit')
		->where('permit_id', $id)
		->get()
		->row_array();
	}
	public function getPermitType(){
		return $this->db
		->select('*')
		->from('tb_material')
		->get()
		->result_array();
	}
	// Count permit used
	public function countUsedHOWP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'HOWP')
		->count_all_results();
	}
	public function countUsedCOWP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'COWP')
		->count_all_results();
	}
	public function countUsedWAHP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'WAHP')
		->count_all_results();
	}
	public function countUsedCSEP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'CSEP')
		->count_all_results();
	}
	public function countUsedLOWP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'LOWP')
		->count_all_results();
	}
	public function countUsedLIWP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'LIWP')
		->count_all_results();
	}
	public function countUsedEXWP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'EXWP')
		->count_all_results();
	}
	public function countUsedHLWP(){
		return $this->db
		->from('tb_permit')
		->where('permit_category', 'HLWP')
		->count_all_results();
	}
	// Count permit added
	public function countAddedCOWP(){
		$this->db->select_sum('pa_qty');
		$this->db->from('tb_permit_add');
		$this->db->where('pa_type', 'COWP');
		return $this->db->get()->row_array();
	}
	public function countAddedWAHP(){
		$this->db->select_sum('pa_qty');
		$this->db->from('tb_permit_add');
		$this->db->where('pa_type', 'WAHP');
		return $this->db->get()->row_array();
	}
	public function countAddedCSEP(){
		$this->db->select_sum('pa_qty');
		$this->db->from('tb_permit_add');
		$this->db->where('pa_type', 'CSEP');
		return $this->db->get()->row_array();
	}
	public function countAddedLOWP(){
		$this->db->select_sum('pa_qty');
		$this->db->from('tb_permit_add');
		$this->db->where('pa_type', 'LOWP');
		return $this->db->get()->row_array();
	}
	public function countAddedLIWP(){
		$this->db->select_sum('pa_qty');
		$this->db->from('tb_permit_add');
		$this->db->where('pa_type', 'LIWP');
		return $this->db->get()->row_array();
	}
	public function countAddedEXWP(){
		$this->db->select_sum('pa_qty');
		$this->db->from('tb_permit_add');
		$this->db->where('pa_type', 'EXWP');
		return $this->db->get()->row_array();
	}
	public function countAddedHLWP(){
		$this->db->select_sum('pa_qty');
		$this->db->from('tb_permit_add');
		$this->db->where('pa_type', 'HLWP');
		return $this->db->get()->row_array();
	}
	public function countAddedHOWP(){
		$this->db->select_sum('pa_qty');
		$this->db->where('pa_type', 'HOWP');
		return $this->db->get('tb_permit_add')->row_array();
	}

	public function getPermitByFilter($permit_type, $date_start, $date_finish, $company_name, $dept_name){
		$this->db->select('*');
		$this->db->from('tb_permit');
		$this->db->join('tb_work', 'tb_work.work_id=tb_permit.permit_work_id', 'left');
		$this->db->join('tb_material', 'tb_material.mat_type=tb_permit.permit_category', 'left');
		if($permit_type == '*'){
		}else{
			$this->db->where('permit_category', $permit_type, 'false');
		}
		$this->db->where('permit_date >=', $date_start);
		$this->db->where('permit_date <=', $date_finish);
		$this->db->where('work_company', $company_name);
		if($dept_name == '*'){
		}else{
			$this->db->where('permit_area', $dept_name);
		}
		return $this->db->get()->result_array();
	} 
    
}
