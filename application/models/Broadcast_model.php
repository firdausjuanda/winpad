<?php

class Broadcast_model extends CI_Model {

    public function getBc()
    {   
        $this->db->select('*');
        $this->db->from('tb_bc');
        $this->db->where('bc_displayed', 'true');
        return $this->db->get()->row_array();
    }
    public function getBcToUpdate()
    {   
        $this->db->select('*');
        $this->db->from('tb_bc');
        return $this->db->get()->row_array();
    }
}
