<?php
use Restserver\Libraries\Rest_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Attributes extends CI_Controller {
    
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Attributes_model');
    }
    
    public function index_get(){
        $response = $this->Attributes_model->get_attributes();
        $this->response($response, 200);
    }
    
    public function attribute_get($attribute_id=''){
        //Get attribute list
        if(empty($attribute_id)){
            $response = array(
                "code"=>'USR_02',
                "message"=>'Attribute ID is invalid',
                "field"=>"attribute_id",
                "status"=>"500"
            );
            $this->response($response, 400);
        }else{
            $response = $this->Attributes_model->get_attributes_by_id($attribute_id);
            $this->response($response, 200);
        }
    }
    
    public function values_get($attribute_id=''){
        //Get value attributes from attribute
        if(!empty($attribute_id)){
            $response = $this->Attributes_model->get_attribute_values($attribute_id);
            $this->response($response, 200);
        }else{
            $response = array(
                "code"=>'USR_02',
                "message"=>'Attribute ID is invalid',
                "field"=>"attribute_id",
                "status"=>"500"
            );
            $this->response($response, 400);
        }
    }
    
    public function inProduct_get($product_id=''){
        //Get all attributes with product ID
        if(!empty($product_id)){
            $response = $this->Attributes_model->get_product_attributes($product_id);
            $this->response($response, 200);
        }else{
            $response = array(
                "code"=>'USR_02',
                "message"=>'Product ID is invalid',
                "field"=>"product_id",
                "status"=>"500"
            );
            $this->response($response, 400);
        }
    }
}
