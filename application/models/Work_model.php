<?php

class Work_model extends CI_Model {

    public function getAllWork()
    {   
        $this->db->select('*');
        $this->db->from('tb_work');
        $this->db->order_by('work_date_open','desc');
        return $this->db->get()->result_array();
    }
}