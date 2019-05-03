<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model {
    
    public function create_order($cart_id, $cust_id, $ship_id, $tax_id) {
        $data = array(
            'inCartId' => $cart_id,
            'inCustomerId' => $cust_id,
            'inShippingId' => $ship_id,
            'inTaxId' => $tax_id
        );
        $co_proc = "CALL shopping_cart_create_order(?,?,?,?)";
        $query = $this->db->query($co_proc, $data);
        if($query !== NULL)
            return $query->result_array()[0]['orderId'];
        else
            return 0;
    }
    
    public function get_order_info($order_id){
        $query = $this->db->query("CALL orders_get_order_details(".$order_id.")");
        return $query->result();
    }
    
    public function get_customer_orders($customer_id){
        $query = $this->db->query("CALL orders_get_by_customer_id(".$customer_id.")");
        return $query->result();
    }
    
    public function get_order_short_details($order_id){
        $query = $this->db->query("CALL orders_get_order_short_details(".$order_id.")");
        return $query->result();
    }
}