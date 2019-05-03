<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {
    
    public function get_categories(){
        $query = $this->db->query("CALL catalog_get_categories()");
        return $query->result();
    }
    
    public function get_category_by_id($category_id){
        //Return a department by ID
        $query = $this->db->query("CALL catalog_get_category_details(".$category_id.")");
        return $query->result();
    }
    
    public function get_product_categories($product_id){
        //Return a list of categories from a product ID
        $query = $this->db->query("CALL catalog_get_categories_for_product(".$product_id.")");
        return $query->result();
    }
    
    public function get_department_categories($department_id){
        $query = $this->db->query("CALL catalog_get_department_categories(".$department_id.")");
        return $query->result();
    }
    
}