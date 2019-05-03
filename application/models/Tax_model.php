<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_model extends CI_Model {
    
    public function get_all_taxes(){
        $query = $this->db->query("CALL tax_get_taxes()");
        return $query->result();
    }
    
    public function get_tax($tax_id){
        $query = $this->db->query("CALL tax_get_by_id(".$tax_id.")");
        return $query->result()[0];
    }
    
}