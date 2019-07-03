<?php
use Restserver\Libraries\Rest_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Products extends CI_Controller {
    
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Products_model');
    }
    
    public function index_get($product_id='', $products_page='1', $products_per_page='20', $products_description_length='200' ){
        $response = $this->Products_model->get_products_on_catalog(
            $products_description_length,
            $products_per_page, $products_page );
        $response = array("count"=>count($response), "rows"=>$response);
        $this->response($response, 200);
    }
    
    public function product_get($product_id=''){
        //Get all products
        if(empty($product_id)){
            $error = array(
                "code"=>'USR_02',
                "message"=>'Product ID is invalid',
                "field"=>"product_id",
                "status"=>"500"
            );
            $this->response($error, 400);
        }else{//Product by ID
            $response = $this->Products_model->get_product_by_id($product_id);
            $this->response($response, 200);
        }
    }
    
    public function search_get($query_string='', $products_page = '1',
            $products_per_page = '20',
            $products_description_length = '200'){
        //Search Products
        if(!empty($query_string)){
            $query_string = urldecode($query_string);
            $all_words = "on";
            
            $response = $this->Products_model->search_product(
                    $query_string,
                    $all_words,
                    $products_description_length,
                    $products_per_page,
                    $products_page
            );
            $this->response($response, 200);
        }else{
            $error = array(
                "code"=>'USR_02',
                "message"=>'Query String is empty',
                "field"=>"query_string",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
    }
    
    public function inCategory_get($category_id='', $products_page = '1',
            $products_per_page = '20', $products_description_length = '200'){
        //Get a list of products of categories
        if(!empty($category_id)){
            $response = $this->Products_model->get_products_in_category(
                    $category_id,
                    $products_description_length,
                    $products_per_page,
                    $products_page
                );
            $response = array("count"=>count($response), "rows"=>$response);
            $this->response($response, 200);
        }else{
            $error = array(
                "code"=>'USR_02',
                "message"=>'Category ID is empty',
                "field"=>"category_id",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
    }
    
    public function inDepartment_get($department_id='', $products_page = '1',
            $products_per_page = '20', $products_description_length = '200'){
        //Get a list of products on department
        if(!empty($department_id)){
            $response = $this->Products_model->get_products_in_department(
                    $department_id,
                    $products_description_length,
                    $products_per_page,
                    $products_page
                );
            $response = array("count"=>count($response), "rows"=>$response);
            $this->response($response, 200);
        }else{
            $error = array(
                "code"=>'USR_02',
                "message"=>'Department ID is empty',
                "field"=>"department_id",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
    }
    
    public function details_get($product_id=''){
        //Get details of a product
        if(!empty($product_id)){
            $response = $this->Products_model->get_product_details($product_id) ;
            $this->response($response, 200);
        }else{
            $error = array(
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
    }
    
    public function locations_get($product_id=''){
        //Get locations of a Product
        if(!empty($product_id)){
            $response = $this->Products_model->get_product_locations($product_id);
            $this->response($response, 200);
        }else{
            $error = array(
                "code"=>'USR_02',
                "message"=>'Product ID is empty',
                "field"=>"product_id",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
                
    }
    
    public function reviews_get($product_id=''){
        if(!empty($product_id)){
            //GET - Get reviews of a Product
            $response = $this->Products_model->get_product_reviews($product_id);
            $this->response($response, 200);
        }else{
            $error = array(
                "code"=>'USR_02',
                "message"=>'Product ID is invalid',
                "field"=>"product_id",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
    }
    
    public function reviews_post($product_id=''){
        //POST- Post reviews of a Product
        if(empty($this->post("review"))){
            $error = array(
                "code"=>'USR_02',
                "message"=>'Review is empty',
                "field"=>"review",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
        if(empty($this->post("rating"))){
            $error = array(
                "code"=>'USR_02',
                "message"=>'Rating is empty',
                "field"=>"rating",
                "status"=>"500"
            );
            $this->response($error, 400);
        }
        
        $customerId = 1;
        $review = $this->input->post('review');
        $rating = $this->input->post('rating');
        
        if( $this->Products_model->create_product_review($customerId, $product_id, $review, $rating) );
        echo '';
    }
}
