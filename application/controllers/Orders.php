<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Orders_model');
    }
    
    public function index($order_id=''){
        //Create an order
        if(empty($order_id) && $this->input->method()=='post'){
            $cust = 1;//$this->input->post("customer_id");
            $cart_id = 1;//$this->input->post("cart_id");
            $shipping_id = 1;//$this->input->post("shipping_id");
            $tax_id = 2;//$this->input->post("tax_id");
            
            if(empty($cart_id)){
                $error = array("error" => array("status"=>400,
                    "code"=>'USR_02',
                    "message"=>'Cart ID is empty',
                    "field"=>"cart_id"
                ));
                echo json_encode($error);exit;
            }elseif(empty($shipping_id)){
                $error = array("error" => array("status"=>400,
                    "code"=>'USR_02',
                    "message"=>'Shipping ID is empty',
                    "field"=>"shipping_id"
                ));
                echo json_encode($error);exit;
            }elseif(empty($tax_id)){
                $error = array("error" => array("status"=>400,
                    "code"=>'USR_02',
                    "message"=>'Tax ID is empty',
                    "field"=>"tax_id"
                ));
                echo json_encode($error);exit;
            }else{
                $create_order = $this->Orders_model->create_order($cart_id, $cust, $shipping_id, $tax_id);
                if($create_order != 0){
                    echo json_encode(array("orderId" => $create_order));
                }else echo 'df';
            }
            
            exit;
        }
        
        //Get info about Order
        if(!empty($order_id)){
            if(is_nan($order_id))
                echo json_encode(array("message" => "Endpoint not found."));
            
            echo json_encode($this->Orders_model->get_order_info($order_id));
            exit;
        }
        
        $error = array("error" => array("status"=>400,
            "code"=>'USR_02',
            "message"=>'Order ID is empty',
            "field"=>"order_id"
        ));
        echo json_encode($error);exit;
    }
    
    public function inCustomer(){
        //Get orders by Customer
        $customer_id = 1;
        if(empty($customer_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Customer ID is empty',
                "field"=>"customer_id"
            ));
            echo json_encode($error);exit;
        }
        echo json_encode($this->Orders_model->get_customer_orders($customer_id));
    }
    
    public function shortDetail($order_id=''){
        //Get info about order
        if(empty($order_id)){
            $error = array("error" => array("status"=>400,
                "code"=>'USR_02',
                "message"=>'Order ID is empty',
                "field"=>"order_id"
            ));
            echo json_encode($error);exit;
        }
        
        echo json_encode($this->Orders_model->get_order_short_details($order_id));
    }
}
