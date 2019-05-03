<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_model extends CI_Model {
    
    public function get_shipping_regions(){
        $query = $this->db->query("CALL customer_get_shipping_regions()");
        return $query->result();
    }
    
    public function get_shipping_region($srid){
        $query = $this->db->query("CALL shipping_region_get_by_id(".$srid.")");
        return $query->result()[0];
    }
    
}