<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shoppingcart extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Shoppingcart_model');
    }
    
    public function generateUniqueId(){
        //Generate the unique CART ID
        $hay = "abcdefghijklmnopqrstuvwxyz0123456789";
        $cart_id = substr(str_shuffle($hay), 0, 11);
        echo json_encode(array("cart_id" => $cart_id));
    }//pcoy2ql9vfz
    
    
    public function add(){
        //Add a product in the cart
        $cart_id = 'pcoy2ql9vfz';//$this->input->post('cart_id');
        $product_id = 1;//$this->input->post('product_id');
        $attributes = 'plenty stories to be told';//$this->input->post('attributes');
        
        if(empty($cart_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Cart ID is empty',
                "field"=>"cart_id"
            ));
            echo json_encode($error);exit;
        }elseif(empty($product_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id"
            ));
            echo json_encode($error);exit;
        }elseif(empty($attributes)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Attributes is empty',
                "field"=>"attributes"
            ));
            echo json_encode($error);exit;
        }else{
            $add_cart = $this->Shoppingcart_model->add_to_cart($cart_id, $product_id, $attributes);
            if($add_cart != 0){
                $this->db->close();
                $get_cart = $this->Shoppingcart_model->get_cart_products($cart_id);
                echo json_encode($get_cart);
            }else echo 'df';
        }
        
    }
    
    public function index($cart_id){
        //Get List of Products in Shopping Cart
        if(empty($cart_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Cart ID is empty',
                "field"=>"cart_id"
            ));
            echo json_encode($error);exit;
        }
        echo  json_encode($this->Shoppingcart_model->get_cart_products($cart_id));
    }
    
    public function update($item_id){
        //Update the cart by item
        $cart_id = 'pcoy2ql9vfz';//$this->input->post('cart_id');
        $quantity = 5;//$this->input->put('quantity');
        if(empty($item_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Item ID is empty',
                "field"=>"item_id"
            ));
            echo json_encode($error);exit;
        }elseif(empty($quantity)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Quantity is empty',
                "field"=>"quantity"
            ));
            echo json_encode($error);exit;
        }else{
            $up_cart = $this->Shoppingcart_model->update_cart($item_id, $quantity);
            if($up_cart != 0){
                $this->db->close();
                echo json_encode($this->Shoppingcart_model->get_cart_products($cart_id));
            }
        }
    }
    
    public function empty($cart_id){
        //Empty cart
        if(empty($cart_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Cart ID is empty',
                "field"=>"cart_id"
            ));
            echo json_encode($error);exit;
        }
        $empty_cart = $this->Shoppingcart_model->empty_cart($cart_id);
        if($empty_cart != 0)
            echo json_encode(array());
    }
    
    public function moveToCart($item_id){
        //Move a product to cart
        if(empty($item_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Item ID is empty',
                "field"=>"item_id"
            ));
            echo json_encode($error);exit;
        }
        $move_to_cart = $this->Shoppingcart_model->move_to_cart($item_id);
        if($move_to_cart != 0)
            echo '';
    }
    
    public function totalAmount($cart_id) {
        //Return a total Amount from Cart
        if(empty($cart_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Cart ID is empty',
                "field"=>"cart_id"
            ));
            echo json_encode($error);exit;
        }
        echo  json_encode($this->Shoppingcart_model->get_cart_total_amount($cart_id));
    }
    
    public function saveForLater($item_id) {
        //Save a Product for latter
        if(empty($item_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Item ID is empty',
                "field"=>"item_id"
            ));
            echo json_encode($error);exit;
        }
        $save_for_later = $this->Shoppingcart_model->save_for_later($item_id);
        if($save_for_later != 0)
            echo '';
    }
    
    public function getSaved($cart_id){
        //Get Products saved for latter
        if(empty($cart_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Cart ID is empty',
                "field"=>"cart_id"
            ));
            echo json_encode($error);exit;
        }
        echo  json_encode($this->Shoppingcart_model->get_saved_for_later($cart_id));
    }
    
    public function removeProduct($item_id){
        //Remove a product in the cart
        if(empty($item_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Item ID is empty',
                "field"=>"item_id"
            ));
            echo json_encode($error);exit;
        }
        $remove_product = $this->Shoppingcart_model->remove_item_from_cart($item_id);
        if($remove_product != 0)
            echo '';
    }
}
