<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments_model extends CI_Model {
    
    public function get_departments(){
        //Return a list of departments
        $query = $this->db->query("CALL catalog_get_departments()");
        return $query->result();
    }
    
    public function get_department_by_id($department_id){
        //Return a department by ID
        $query = $this->db->query("CALL catalog_get_department_details(".$department_id.")");
        return $query->result();
    }
    
}