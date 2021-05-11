<?php

class Doc_model extends CI_Model {

    public function getAllLicence()
    {   
        $this->db->select('*');
        $this->db->from('tb_licence');
        $this->db->join('tb_user','tb_user.user_id=tb_licence.licence_user_id','left');
        $this->db->order_by('licence_date_created','asc');
        return $this->db->get()->result_array();
    }

    public function getThisLicenceToDelete($id){
        $this->db->select('*');
        $this->db->from('tb_licence');
        $this->db->join('tb_user','tb_user.user_id=tb_licence.licence_user_id','tb_licence', 'left');
        $this->db->where('licence_id', $id, 'left');
        $this->db->order_by('licence_id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getThisLicence($id){
        $this->db->select('*');
        $this->db->from('tb_licence');
        $this->db->join('tb_user','tb_user.user_id=tb_licence.licence_user_id','tb_licence', 'left');
        $this->db->where('licence_id', $id, 'left');
        $this->db->order_by('licence_id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }

    // CREATE TABLE `db_winpad`.`tb_licence` ( 
    //     `licence_id` INT NOT NULL AUTO_INCREMENT ,
    //     `licence_name` VARCHAR(1000) NOT NULL , 
    //     `licence_category` VARCHAR(1000) NOT NULL , 
    //     `licence_company` VARCHAR(1000) NOT NULL , 
    //     `licence_start_date` VARCHAR(1000) NOT NULL , 
    //     `licence_expire_date` VARCHAR(1000) NOT NULL , 
    //     `licence_by` VARCHAR(1000) NOT NULL , 
    //     `licence_person` VARCHAR(1000) NOT NULL , 
    //     `licence_note` TEXT NOT NULL , 
    //     `licence_user_id` INT NOT NULL , 
    //     `licence_date_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    //      PRIMARY KEY (`licence_id`)
    //     ) ENGINE = InnoDB;

    // ALTER TABLE `tb_licence` ADD `licence_no` VARCHAR(1000) NOT NULL AFTER `licence_category`;


}