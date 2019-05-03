<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Tax_model');
    }
    
    public function index($tax_id=''){
        
        if(empty($tax_id))//Get All Taxes
            echo json_encode($this->Tax_model->get_all_taxes());
        
        else{//Get Tax by ID
            if (is_nan($tax_id)) {
                $error = array("error" => array("status"=>400,
                    "code"=>'USR_03',
                    "message"=>'Tax ID is invalid',
                    "field"=>"tax_id"
                ));
                echo json_encode($error);exit;
            }else
                echo json_encode($this->Tax_model->get_tax($tax_id));
        }
    }
}
