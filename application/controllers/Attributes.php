<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Attributes_model');
    }
    
    public function index($attribute_id=''){
        //Get attribute list
        if(empty($attribute_id)){
            echo json_encode( $this->Attributes_model->get_attributes() );
        }else{
            echo json_encode( $this->Attributes_model->get_attributes_by_id($attribute_id) );
        }
    }
    
    public function values($attribute_id=''){
        //Get value attributes from attribute
        if(!empty($attribute_id))
            echo json_encode( $this->Attributes_model->get_attribute_values($attribute_id) );
        else 
            echo "no id";
    }
    
    public function inProduct($product_id=''){
        //Get all attributes with product ID
        if(!empty($product_id))
            echo json_encode( $this->Attributes_model->get_product_attributes($product_id) );
        else 
            echo "no id";
    }
}
