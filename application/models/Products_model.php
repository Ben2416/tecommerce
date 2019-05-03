<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {
    
    public function get_products_on_catalog($pdl, $ppp, $ppg){
        //Returns a list of products
        $query = $this->db->query("CALL catalog_get_products_on_catalog(".$pdl.",".$ppp.",".$ppg.")");
        return $query->result();
    }
    
    public function get_product_by_id($product_id){
        //Return product by ID
        $query = $this->db->query("CALL catalog_get_product_info(".$product_id.")");
        return $query->result();
    }
    
    public function search_product($ss, $iaw, $spdl, $ppp, $ppg ){
        //Return products that match query
        $query = $this->db->query("CALL catalog_search('".$ss."','".$iaw."',".$spdl.",".$ppp.",".$ppg.")");
        return $query->result();
    }
    
    public function get_products_in_category($category_id, $pdl, $ppp, $ppg){
        //Return list of products in category
        $query = $this->db->query("CALL catalog_get_products_in_category(".$category_id.",".$pdl.",".$ppp.",".$ppg.")");
        return $query->result();
    }
    
    public function get_products_in_department($department_id, $pdl, $ppp, $ppg){
        //Return list of products in department
        $query = $this->db->query("CALL catalog_get_products_on_department(".$department_id.",".$pdl.",".$ppp.",".$ppg.")");
        return $query->result();
    }
    
    public function get_product_details($product_id){
        //Return details of product
        $query = $this->db->query("CALL catalog_get_product_details(".$product_id.")");
        return $query->result();
    }
    
    public function get_product_locations($product_id){
        //Return location of product
        $query = $this->db->query("CALL catalog_get_product_locations(".$product_id.")");
        return $query->result();
    }
    
    public function get_product_reviews($product_id){
        $query = $this->db->query("CALL catalog_get_product_reviews(".$product_id.")");
        return $query->result();
    }
    
    public function create_product_review($cid, $pid, $review, $rating){
        $data = array(
            'inCustomerId'=>$cid, 
            'inProductId'=>$pid, 
            'inReview'=>$this->security->xss_clean($review),
            'inRating'=>$rating);
        $cpr_proc = "CALL catalog_create_product_review(?,?,?,?)";
        $query = $this->db->query( $cpr_proc, $data );
        //$query = $this->db->query( "CALL catalog_create_product_review(".$cid.",".$pid.",'".$review."',".$rating.")" );
        if($query !== NULL)
            return TRUE;
        return FALSE;
    }
    
    
}