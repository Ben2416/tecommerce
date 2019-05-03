<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shoppingcart_model extends CI_Model {
    
    public function add_to_cart($cart_id, $product_id, $attributes){
        $data = array(
            'inCartId' => $cart_id,
            'inProductId' => $product_id,
            'inAttributes' => $this->security->xss_clean($attributes)
        );
        
        $ac_proc = "CALL shopping_cart_add_product(?,?,?)";
        $query = $this->db->query($ac_proc, $data);
        if($query !== NULL)
            return 1;
        else return 0;
    }
    
    public function get_cart_products($cart_id){
        $cart_id = $this->security->xss_clean($cart_id);
        $query = $this->db->query("CALL shopping_cart_get_products('".$cart_id."')");
        return $query->result();
    }
    
    public function update_cart($item_id, $quantity){
        $data = array(
            'inItemId' => $item_id,
            'inQuantity' => $quantity
        );
        $uc_proc = "CALL shopping_cart_update(?,?)";
        $query = $this->db->query($uc_proc, $data);
        if($query !== NULL)
            return 1;
        else 
            return 0;
    }
    
    public function empty_cart($cart_id){
        $query = $this->db->query("CALL shopping_cart_empty('".$cart_id."')");
        if($query !== NULL)
            return 1;
        else 
            return 0;
    }
    
    public function move_to_cart($item_id){
        $query = $this->db->query("CALL shopping_cart_move_product_to_cart(".$item_id.")");
        if($query !== NULL)
            return 1;
        else 
            return 0;
    }
    
    public function get_cart_total_amount($cart_id){
        $query = $this->db->query("CALL shopping_cart_get_total_amount('".$cart_id."')");
        return $query->result()[0];
    }
    
    public function save_for_later($item_id){
        $query = $this->db->query("CALL shopping_cart_save_product_for_later(".$item_id.")");
        if($query !== NULL)
            return 1;
        else 
            return 0;
    }
    
    public function get_saved_for_later($cart_id){
        $query = $this->db->query("CALL shopping_cart_get_saved_products('".$cart_id."')");
        return $query->result();
    }
    
    public function remove_item_from_cart($item_id){
        $query = $this->db->query("CALL shopping_cart_remove_product(".$item_id.")");
        if($query !== NULL)
            return 1;
        else 
            return 0;
    }
    
}