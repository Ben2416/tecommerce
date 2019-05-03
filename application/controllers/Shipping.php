<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Shipping_model');
    }
    
    public function regions($shipping_region_id=''){
        //Return shippings regions
        if(empty($shipping_region_id))
            echo json_encode($this->Shipping_model->get_shipping_regions());
        
        else{
            //Return shippings regions
            if(is_nan($shipping_region_id)){
                $error = array("error" => array("status"=>400,
                    "code"=>'USR_03',
                    "message"=>'Shipping Region ID is invalid',
                    "field"=>"shipping_region_id"
                ));
                echo json_encode($error);exit;
            }else
                echo json_encode($this->Shipping_model->get_shipping_region($shipping_region_id));
        }
    }
    
}
