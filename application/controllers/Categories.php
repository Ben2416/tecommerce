<?php
use Restserver\Libraries\Rest_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Categories extends CI_Controller {
    
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Categories_model');
    }
    
    public function index_get(){
        //Get Categories
        $response = $this->Categories_model->get_categories();
        $response = array("count"=>count($response), "rows"=>$response);
        $this->response($response, 200);
    }
    
    public function category_get($category_id=''){
        if(empty($category_id) || !is_numeric($category_id)){
            $response = array(
                "code"=>'USR_02',
                "message"=>'Category ID is invalid',
                "field"=>"category_id",
                "status"=>"500"
            );
            $this->response($response, 400);
        }else{
            //Get Category by ID
            $response = $this->Categories_model->get_category_by_id( $category_id );
            $this->response($response, 200);
        }
    }
    
    public function inProduct_get($product_id=''){
        //Get categories of a product
        if(!empty($product_id)){
            $response = $this->Categories_model->get_product_categories( $product_id ) ;
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
    
    public function inDepartment_get($department_id=''){
        //Get categories of a department
        if(!empty($department_id)){
            $response = $this->Categories_model->get_department_categories( $department_id );
            $this->response($response, 200);
        }else{
            $response = array(
                "code"=>'USR_02',
                "message"=>'Department ID is invalid',
                "field"=>"department_id",
                "status"=>"500"
            );
            $this->response($response, 400);
        }
    }
}
