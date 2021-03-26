<?php

class Work_model extends CI_Model {

    public function getAllWork()
    {
        return $this->db->get('tb_work')->result_array();
    }
}