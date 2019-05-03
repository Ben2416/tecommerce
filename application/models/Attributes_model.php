<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes_model extends CI_Model {
    
    public function get_attributes(){
        //Get Attributes list
        $query = $this->db->query("CALL catalog_get_attributes()");
        return $query->result();
    }
    
    public function get_attributes_by_id($attribute_id){
        //Return attributes by ID
        $query = $this->db->query("CALL catalog_get_attribute_details(".$attribute_id.")");
        return $query->result();
    }
    
    public function get_attribute_values($attribute_id){
        //Get attribute from attribute
        $query = $this->db->query("CALL catalog_get_attribute_values(".$attribute_id.")");
        return $query->result();
    }
    
    public function get_product_attributes($product_id){
        //Get all attributes with product ID
        $query = $this->db->query("CALL catalog_get_product_attributes(".$product_id.")");
        return $query->result();
    }
    
}